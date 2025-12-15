@extends('layouts.back-end.app')
@section('title', translate('create_goods_receipt'))
@section('content')
    <div class="content container-fluid">
        <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
            <div>
                <h2 class="h1 mb-1 text-capitalize">{{ translate('create_goods_receipt') }}</h2>
                <p class="text-muted mb-0">{{ translate('purchase_grn_create_help_text') }}</p>
            </div>
            <a href="{{ route('admin.purchase.grns.index') }}" class="btn btn-outline-secondary">
                <i class="tio-arrow-backward"></i>
                <span class="ps-1">{{ translate('back_to_list') }}</span>
            </a>
        </div>

        @include('admin-views.purchase.grns._form')
    </div>
@endsection
