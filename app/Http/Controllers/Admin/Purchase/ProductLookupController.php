<?php

namespace App\Http\Controllers\Admin\Purchase;

use App\Http\Controllers\BaseController;
use App\Models\Product;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class ProductLookupController extends BaseController
{
    public function index(?Request $request, string $type = null): View|Collection|LengthAwarePaginator|null|callable|RedirectResponse
    {
        abort(404);
    }

    public function __invoke(Request $request): JsonResponse
    {
        $validated = $this->validateAjaxRequest($request);

        $query = $this->applyFilters($validated);

        if ($search = $validated['q'] ?? null) {
            $query->where(function ($builder) use ($search) {
                $builder->where('name', 'like', "%{$search}%")
                    ->orWhere('code', 'like', "%{$search}%");
            });
        }

        $perPage = (int) ($validated['per_page'] ?? 15);
        $page = (int) ($validated['page'] ?? 1);
        $paginator = $query->paginate($perPage, ['*'], 'page', $page);

        $results = $paginator->getCollection()->map(fn(Product $product) => $this->transformProduct($product));

        return response()->json([
            'results' => $results,
            'pagination' => [
                'more' => $paginator->hasMorePages(),
            ],
        ]);
    }

    public function manual(Request $request): View
    {
        $filters = $request->validate([
            'sku' => ['nullable', 'string', 'max:191'],
            'vendor_id' => ['nullable', 'integer', 'exists:purchase_vendors,id'],
        ]);

        $results = collect();
        $searched = ! empty($filters['sku']);

        if ($searched) {
            $results = $this->applyFilters($filters)
                ->where(function ($builder) use ($filters) {
                    $sku = $filters['sku'];
                    $builder->where('code', $sku)
                        ->orWhere('code', 'like', "{$sku}%")
                        ->orWhere('name', 'like', "%{$sku}%");
                })
                ->limit(25)
                ->get()
                ->map(fn(Product $product) => $this->transformProduct($product));
        }

        return view('admin-views.purchase.catalog.manual-lookup', [
            'results' => $results,
            'filters' => $filters,
            'searched' => $searched,
        ]);
    }

    private function validateAjaxRequest(Request $request): array
    {
        return $request->validate([
            'q' => ['nullable', 'string', 'max:191'],
            'page' => ['nullable', 'integer', 'min:1'],
            'per_page' => ['nullable', 'integer', 'min:1', 'max:50'],
            'vendor_id' => ['nullable', 'integer', 'exists:purchase_vendors,id'],
        ]);
    }

    private function applyFilters(array $filters = []): Builder
    {
        $query = Product::query()
            ->select(['id', 'name', 'code', 'unit', 'purchase_price'])
            ->orderBy('name');

        if (! empty($filters['vendor_id'])) {
            $vendorId = (int) $filters['vendor_id'];
            $query->whereExists(function ($sub) use ($vendorId) {
                $sub->selectRaw('1')
                    ->from('purchase_order_items as poi')
                    ->join('purchase_orders as po', 'po.id', '=', 'poi.order_id')
                    ->whereColumn('poi.product_id', 'products.id')
                    ->where('po.vendor_id', $vendorId);
            });
        }

        return $query;
    }

    private function transformProduct(Product $product): array
    {
        return [
            'id' => $product->id,
            'text' => trim(($product->code ? '[' . $product->code . '] ' : '') . $product->name),
            'sku' => $product->code,
            'name' => $product->name,
            'unit' => $product->unit,
            'purchase_price' => $product->purchase_price,
        ];
    }
}
