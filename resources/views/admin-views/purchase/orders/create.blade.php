@extends('layouts.back-end.app')
@section('title', translate('add_purchase_order'))
@section('content')
    <div class="content container-fluid">
        <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
            <div>
                <h2 class="h1 mb-1 text-capitalize">{{ translate('add_purchase_order') }}</h2>
                <p class="text-muted mb-0">{{ translate('purchase_order_workspace_intro') }}</p>
            </div>
            <a href="{{ route('admin.purchase.orders.index') }}" class="btn btn-outline-secondary">
                <i class="tio-arrow-back"></i>
                <span class="ps-1">{{ translate('back') }}</span>
            </a>
        </div>

        <div class="card">
            <div class="card-body">
                @include('admin-views.purchase.orders._form')
            </div>
        </div>
    </div>
@endsection
