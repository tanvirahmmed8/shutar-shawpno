<?php

namespace App\Http\Controllers\Admin\Purchase;

use App\Http\Controllers\BaseController;
use App\Models\Purchase\PurchaseVendor;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Brian2694\Toastr\Facades\Toastr;

class VendorController extends BaseController
{
    public function index(?Request $request, string $type = null): View
    {
        $this->authorize('viewAny', PurchaseVendor::class);

        $request = $request ?? request();
        $search = trim((string) $request->get('search'));
        $status = $request->get('status');

        $vendors = PurchaseVendor::with(['primaryContact', 'metrics'])
            ->when($search, function ($query, $value) {
                $query->where(function ($builder) use ($value) {
                    $builder->where('code', 'like', "%{$value}%")
                        ->orWhere('display_name', 'like', "%{$value}%")
                        ->orWhere('primary_email', 'like', "%{$value}%");
                });
            })
            ->when($status, function ($query, $value) {
                return $query->where('status', $value);
            })
            ->orderByDesc('updated_at')
            ->paginate(15)
            ->appends($request->query());

        $statusOptions = ['draft', 'active', 'inactive', 'blacklisted'];

        return view('admin-views.purchase.vendors.index', compact('vendors', 'search', 'status', 'statusOptions'));
    }

    public function create(): View
    {
        $this->authorize('create', PurchaseVendor::class);

        return view('admin-views.purchase.vendors.create', [
            'statusOptions' => ['draft', 'active', 'inactive', 'blacklisted'],
            'currencyOptions' => ['USD', 'EUR', 'GBP', 'BDT'],
            'incoterms' => ['EXW', 'FOB', 'CIF', 'DAP'],
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $this->authorize('create', PurchaseVendor::class);
        $validated = $this->validatePayload($request);

        DB::transaction(function () use ($validated, $request) {
            $vendor = PurchaseVendor::create(array_merge($validated, [
                'created_by' => auth('admin')->id(),
            ]));

            $this->upsertPrimaryContact($vendor, $request);
        });

        Toastr::success(translate('purchase_vendor_created_successfully'));
        return redirect()->route('admin.purchase.vendors.index');
    }

    public function edit(PurchaseVendor $vendor): View
    {
        $this->authorize('update', $vendor);

        return view('admin-views.purchase.vendors.edit', [
            'vendor' => $vendor->load('primaryContact'),
            'statusOptions' => ['draft', 'active', 'inactive', 'blacklisted'],
            'currencyOptions' => ['USD', 'EUR', 'GBP', 'BDT'],
            'incoterms' => ['EXW', 'FOB', 'CIF', 'DAP'],
        ]);
    }

    public function update(Request $request, PurchaseVendor $vendor): RedirectResponse
    {
        $this->authorize('update', $vendor);
        $validated = $this->validatePayload($request, $vendor->id);

        DB::transaction(function () use ($vendor, $validated, $request) {
            $vendor->update(array_merge($validated, [
                'updated_by' => auth('admin')->id(),
            ]));

            $this->upsertPrimaryContact($vendor, $request);
        });

        Toastr::success(translate('purchase_vendor_updated_successfully'));
        return redirect()->route('admin.purchase.vendors.index');
    }

    public function destroy(PurchaseVendor $vendor): RedirectResponse
    {
        $this->authorize('delete', $vendor);
        $vendor->delete();
        Toastr::success(translate('purchase_vendor_deleted_successfully'));
        return back();
    }

    private function validatePayload(Request $request, ?int $ignoreId = null): array
    {
        return $request->validate([
            'code' => ['required', 'max:50', Rule::unique('purchase_vendors')->ignore($ignoreId)],
            'display_name' => ['required', 'max:120'],
            'legal_name' => ['nullable', 'max:150'],
            'vendor_type' => ['nullable', 'max:60'],
            'category' => ['nullable', 'max:60'],
            'website' => ['nullable', 'max:191'],
            'primary_email' => ['nullable', 'email', 'max:120'],
            'primary_phone' => ['nullable', 'max:40'],
            'payment_terms' => ['nullable', 'max:120'],
            'incoterm' => ['nullable', 'max:32'],
            'currency' => ['nullable', 'size:3'],
            'lead_time_days' => ['nullable', 'integer', 'min:0', 'max:365'],
            'min_order_value' => ['nullable', 'numeric', 'min:0'],
            'tax_id' => ['nullable', 'max:64'],
            'rating' => ['nullable', 'numeric', 'min:0', 'max:5'],
            'status' => ['required', Rule::in(['draft', 'active', 'inactive', 'blacklisted'])],
            'contract_expires_at' => ['nullable', 'date'],
            'compliance_status' => ['nullable', 'max:60'],
            'notes' => ['nullable', 'string'],
            'tags' => ['nullable', 'array'],
            'tags.*' => ['nullable', 'string', 'max:40'],
        ]);
    }

    private function upsertPrimaryContact(PurchaseVendor $vendor, Request $request): void
    {
        $contactName = trim((string) $request->get('contact_name'));
        if ($contactName === '') {
            return;
        }

        $contactData = [
            'name' => $contactName,
            'role' => $request->get('contact_role'),
            'email' => $request->get('contact_email'),
            'phone' => $request->get('contact_phone'),
            'is_primary' => true,
            'preferred_channel' => $request->get('contact_channel'),
            'notes' => $request->get('contact_notes'),
            'created_by' => auth('admin')->id(),
            'updated_by' => auth('admin')->id(),
        ];

        $vendor->contacts()->updateOrCreate(
            ['vendor_id' => $vendor->id, 'is_primary' => true],
            $contactData
        );
    }
}
