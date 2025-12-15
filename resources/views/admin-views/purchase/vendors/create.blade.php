@extends('layouts.back-end.app')
@section('title', translate('add_vendor'))
@section('content')
    <div class="content container-fluid">
        <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
            <div>
                <h2 class="h1 mb-1 text-capitalize">{{ translate('add_vendor') }}</h2>
                <p class="text-muted mb-0">{{ translate('capture_vendor_contract_payment_and_contact_details') }}</p>
            </div>
            <a href="{{ route('admin.purchase.vendors.index') }}" class="btn btn-outline--primary">
                <i class="tio-arrow-back"></i>
                <span class="ps-2">{{ translate('back_to_list') }}</span>
            </a>
        </div>

        <div class="card">
            <div class="card-body">
                @include('admin-views.purchase.vendors._form')
            </div>
        </div>
    </div>
@endsection
