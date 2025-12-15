@extends('layouts.back-end.app')
@section('title', translate('purchase_orders'))
@section('content')
    <div class="content container-fluid">
        <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
            <div>
                <h2 class="h1 mb-1 text-capitalize">{{ translate('purchase_orders') }}</h2>
                <p class="text-muted mb-0">{{ translate('purchase_order_workspace_intro') }}</p>
            </div>
            <a href="{{ route('admin.purchase.orders.create') }}" class="btn btn--primary">
                <i class="tio-add"></i>
                <span class="ps-1">{{ translate('add_purchase_order') }}</span>
            </a>
        </div>

        <div class="card mb-4">
            <div class="card-body">
                <form method="get" class="row g-3 align-items-end">
                    <div class="col-md-3">
                        <label class="form-label text-capitalize">{{ translate('search') }}</label>
                        <input type="search" name="search" class="form-control" value="{{ $filters['search'] }}" placeholder="{{ translate('search_by_code_name_email') }}">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label text-capitalize">{{ translate('vendor') }}</label>
                        <select name="vendor_id" class="form-control select2">
                            <option value="">{{ translate('all_vendors') }}</option>
                            @foreach($vendors as $vendor)
                                <option value="{{ $vendor->id }}" {{ (string) $filters['vendor_id'] === (string) $vendor->id ? 'selected' : '' }}>{{ $vendor->display_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label text-capitalize">{{ translate('status') }}</label>
                        <select name="status" class="form-control">
                            <option value="">{{ translate('all_statuses') }}</option>
                            @foreach($statusOptions as $status)
                                <option value="{{ $status }}" {{ $filters['status'] === $status ? 'selected' : '' }}>{{ translate($status) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label text-capitalize">{{ translate('date_from') }}</label>
                        <input type="date" name="date_from" class="form-control" value="{{ $filters['date_from'] }}">
                    </div>
                    <div class="col-md-2">
                        <label class="form-label text-capitalize">{{ translate('date_to') }}</label>
                        <input type="date" name="date_to" class="form-control" value="{{ $filters['date_to'] }}">
                    </div>
                    <div class="col-12 d-flex gap-2">
                        <button type="submit" class="btn btn--primary">{{ translate('filter') }}</button>
                        <a href="{{ route('admin.purchase.orders.index') }}" class="btn btn-outline-secondary">{{ translate('clear') }}</a>
                    </div>
                </form>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="thead-light">
                            <tr>
                                <th>{{ translate('code') }}</th>
                                <th>{{ translate('vendor') }}</th>
                                <th>{{ translate('status') }}</th>
                                <th class="text-end">{{ translate('grand_total') }}</th>
                                <th>{{ translate('created_at') }}</th>
                                <th class="text-end">{{ translate('actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($orders as $order)
                                <tr>
                                    <td class="fw-semibold">{{ $order->code }}</td>
                                    <td>{{ optional($order->vendor)->display_name ?? translate('not_set') }}</td>
                                    <td>
                                        <span class="badge badge-soft-primary text-capitalize">{{ translate($order->status) }}</span>
                                    </td>
                                    <td class="text-end">{{ $order->currency }} {{ number_format($order->grand_total, 2) }}</td>
                                    <td>{{ $order->created_at?->format('M d, Y') }}</td>
                                    <td class="text-end">
                                        <a href="{{ route('admin.purchase.orders.show', $order->id) }}" class="btn btn-outline--primary btn-sm">{{ translate('view') }}</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center text-muted py-5">{{ translate('purchase_order_empty_state') }}</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-3">
                    {{ $orders->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
