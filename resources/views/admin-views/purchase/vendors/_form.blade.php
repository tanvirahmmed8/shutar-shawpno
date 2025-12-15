@php($isEdit = isset($vendor))
@php($vendorPrimaryContact = $isEdit ? $vendor->primaryContact : null)
@php($contractDateValue = old('contract_expires_at', ($isEdit && $vendor->contract_expires_at) ? $vendor->contract_expires_at->format('Y-m-d') : ''))
<form action="{{ $isEdit ? route('admin.purchase.vendors.update', $vendor->id) : route('admin.purchase.vendors.store') }}" method="post">
    @csrf
    @if($isEdit)
        @method('put')
    @endif
    <div class="row g-4">
        <div class="col-md-4">
            <label class="form-label">{{ translate('vendor_code') }}</label>
            <input type="text" name="code" class="form-control" value="{{ old('code', $vendor->code ?? '') }}" required>
        </div>
        <div class="col-md-4">
            <label class="form-label">{{ translate('display_name') }}</label>
            <input type="text" name="display_name" class="form-control" value="{{ old('display_name', $vendor->display_name ?? '') }}" required>
        </div>
        <div class="col-md-4">
            <label class="form-label">{{ translate('legal_name') }}</label>
            <input type="text" name="legal_name" class="form-control" value="{{ old('legal_name', $vendor->legal_name ?? '') }}">
        </div>
        <div class="col-md-4">
            <label class="form-label">{{ translate('category') }}</label>
            <input type="text" name="category" class="form-control" value="{{ old('category', $vendor->category ?? '') }}">
        </div>
        <div class="col-md-4">
            <label class="form-label">{{ translate('vendor_type') }}</label>
            <input type="text" name="vendor_type" class="form-control" value="{{ old('vendor_type', $vendor->vendor_type ?? '') }}">
        </div>
        <div class="col-md-4">
            <label class="form-label">{{ translate('status') }}</label>
            <select name="status" class="form-control" required>
                @foreach($statusOptions as $option)
                    <option value="{{ $option }}" {{ old('status', $vendor->status ?? 'draft') === $option ? 'selected' : '' }}>{{ translate($option) }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-4">
            <label class="form-label">{{ translate('currency') }}</label>
            <select name="currency" class="form-control">
                @foreach($currencyOptions as $currency)
                    <option value="{{ $currency }}" {{ old('currency', $vendor->currency ?? 'USD') === $currency ? 'selected' : '' }}>{{ $currency }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-4">
            <label class="form-label">{{ translate('payment_terms') }}</label>
            <input type="text" name="payment_terms" class="form-control" value="{{ old('payment_terms', $vendor->payment_terms ?? '') }}">
        </div>
        <div class="col-md-4">
            <label class="form-label">{{ translate('incoterm') }}</label>
            <select name="incoterm" class="form-control">
                <option value="">{{ translate('select_incoterm') }}</option>
                @foreach($incoterms as $incoterm)
                    <option value="{{ $incoterm }}" {{ old('incoterm', $vendor->incoterm ?? '') === $incoterm ? 'selected' : '' }}>{{ $incoterm }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-4">
            <label class="form-label">{{ translate('primary_email') }}</label>
            <input type="email" name="primary_email" class="form-control" value="{{ old('primary_email', $vendor->primary_email ?? '') }}">
        </div>
        <div class="col-md-4">
            <label class="form-label">{{ translate('primary_phone') }}</label>
            <input type="text" name="primary_phone" class="form-control" value="{{ old('primary_phone', $vendor->primary_phone ?? '') }}">
        </div>
        <div class="col-md-4">
            <label class="form-label">{{ translate('lead_time_days') }}</label>
            <input type="number" name="lead_time_days" class="form-control" min="0" value="{{ old('lead_time_days', $vendor->lead_time_days ?? 0) }}">
        </div>
        <div class="col-md-4">
            <label class="form-label">{{ translate('min_order_value') }}</label>
            <input type="number" step="0.01" min="0" name="min_order_value" class="form-control" value="{{ old('min_order_value', $vendor->min_order_value ?? 0) }}">
        </div>
        <div class="col-md-4">
            <label class="form-label">{{ translate('contract_expiry') }}</label>
            <input type="date" name="contract_expires_at" class="form-control" value="{{ $contractDateValue }}">
        </div>
        <div class="col-md-4">
            <label class="form-label">{{ translate('compliance_status') }}</label>
            <input type="text" name="compliance_status" class="form-control" value="{{ old('compliance_status', $vendor->compliance_status ?? '') }}">
        </div>
        <div class="col-12">
            <label class="form-label">{{ translate('notes') }}</label>
            <textarea name="notes" class="form-control" rows="3">{{ old('notes', $vendor->notes ?? '') }}</textarea>
        </div>
    </div>

    <div class="border rounded p-3 mt-4">
        <h5 class="mb-3 text-capitalize">{{ translate('primary_contact') }}</h5>
        <div class="row g-3">
            <div class="col-md-4">
                <label class="form-label">{{ translate('name') }}</label>
                <input type="text" name="contact_name" class="form-control" value="{{ old('contact_name', $vendorPrimaryContact->name ?? '') }}">
            </div>
            <div class="col-md-4">
                <label class="form-label">{{ translate('role') }}</label>
                <input type="text" name="contact_role" class="form-control" value="{{ old('contact_role', $vendorPrimaryContact->role ?? '') }}">
            </div>
            <div class="col-md-4">
                <label class="form-label">{{ translate('email') }}</label>
                <input type="email" name="contact_email" class="form-control" value="{{ old('contact_email', $vendorPrimaryContact->email ?? '') }}">
            </div>
            <div class="col-md-4">
                <label class="form-label">{{ translate('phone') }}</label>
                <input type="text" name="contact_phone" class="form-control" value="{{ old('contact_phone', $vendorPrimaryContact->phone ?? '') }}">
            </div>
            <div class="col-md-4">
                <label class="form-label">{{ translate('preferred_channel') }}</label>
                <input type="text" name="contact_channel" class="form-control" value="{{ old('contact_channel', $vendorPrimaryContact->preferred_channel ?? '') }}">
            </div>
            <div class="col-12">
                <label class="form-label">{{ translate('contact_notes') }}</label>
                <textarea name="contact_notes" class="form-control" rows="2">{{ old('contact_notes', $vendorPrimaryContact->notes ?? '') }}</textarea>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-end gap-3 mt-4">
        <a href="{{ route('admin.purchase.vendors.index') }}" class="btn btn-secondary">{{ translate('cancel') }}</a>
        <button type="submit" class="btn btn--primary">{{ $isEdit ? translate('update') : translate('create') }}</button>
    </div>
</form>
