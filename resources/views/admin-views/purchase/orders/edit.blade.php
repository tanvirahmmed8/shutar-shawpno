@extends('layouts.back-end.app')
@section('title', $order->code)
@section('content')
    <div class="content container-fluid">
        <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
            <div>
                <h2 class="h1 mb-1">{{ $order->code }}</h2>
                <div class="d-flex gap-2 align-items-center">
                    <span class="badge badge-soft-primary text-uppercase">{{ translate($order->status) }}</span>
                    <span class="text-muted">{{ translate('vendor') }}: {{ optional($order->vendor)->display_name ?? translate('not_set') }}</span>
                </div>
            </div>
            <div class="d-flex gap-2">
                <a href="{{ route('admin.purchase.orders.show', $order->id) }}" class="btn btn-outline-secondary">{{ translate('view') }}</a>
                <a href="{{ route('admin.purchase.orders.index') }}" class="btn btn-outline-secondary">{{ translate('back') }}</a>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                @include('admin-views.purchase.orders._form')
            </div>
        </div>
    </div>
@endsection
