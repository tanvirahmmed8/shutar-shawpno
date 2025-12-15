@extends('layouts.back-end.app')
@section('title', translate('edit_goods_receipt'))
@section('content')
    <div class="content container-fluid">
        <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
            <div>
                <h2 class="h1 mb-1 text-capitalize">{{ translate('edit_goods_receipt') }}</h2>
                <p class="text-muted mb-0">{{ translate('purchase_grn_edit_help_text') }}</p>
            </div>
            <a href="{{ route('admin.purchase.grns.show', $grn->id) }}" class="btn btn-outline-secondary">
                <i class="tio-arrow-backward"></i>
                <span class="ps-1">{{ translate('view_details') }}</span>
            </a>
        </div>

        @include('admin-views.purchase.grns._form')
    </div>
@endsection
