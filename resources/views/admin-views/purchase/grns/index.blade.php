@extends('layouts.back-end.app')
@section('title', translate('goods_receipts'))
@section('content')
    <div class="content container-fluid">
        <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
            <div>
                <h2 class="h1 mb-1 text-capitalize">{{ translate('goods_receipts') }}</h2>
                <p class="text-muted mb-0">{{ translate('purchase_grn_workspace_intro') }}</p>
            </div>
            @can('create', \App\Models\Purchase\PurchaseGrn::class)
                <a href="{{ route('admin.purchase.orders.index') }}" class="btn btn--primary">
                    <i class="tio-add"></i>
                    <span class="ps-1">{{ translate('start_from_purchase_order') }}</span>
                </a>
            @endcan
        </div>

        <div class="card mb-4">
            <div class="card-body">
                <form method="get" class="row g-3 align-items-end">
                    <div class="col-md-3">
                        <label class="form-label text-capitalize">{{ translate('search') }}</label>
                        <input type="search" name="search" class="form-control" value="{{ $filters['search'] }}" placeholder="{{ translate('search_by_grn_code_po_vendor') }}">
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
                        <label class="form-label text-capitalize">{{ translate('inventory_status') }}</label>
                        <select name="inventory_status" class="form-control">
                            <option value="">{{ translate('all_statuses') }}</option>
                            @foreach($inventoryStatuses as $status)
                                <option value="{{ $status }}" {{ $filters['inventory_status'] === $status ? 'selected' : '' }}>{{ translate($status) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label text-capitalize">{{ translate('vendor') }}</label>
                        <select name="vendor_id" class="form-control select2">
                            <option value="">{{ translate('all_vendors') }}</option>
                            @foreach($vendors as $vendor)
                                <option value="{{ $vendor->id }}" {{ (string) $filters['vendor_id'] === (string) $vendor->id ? 'selected' : '' }}>{{ $vendor->display_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-1">
                        <label class="form-label text-capitalize">{{ translate('date_from') }}</label>
                        <input type="date" name="date_from" class="form-control" value="{{ $filters['date_from'] }}">
                    </div>
                    <div class="col-md-1">
                        <label class="form-label text-capitalize">{{ translate('date_to') }}</label>
                        <input type="date" name="date_to" class="form-control" value="{{ $filters['date_to'] }}">
                    </div>
                    <div class="col-12 d-flex gap-2">
                        <button type="submit" class="btn btn--primary">{{ translate('filter') }}</button>
                        <a href="{{ route('admin.purchase.grns.index') }}" class="btn btn-outline-secondary">{{ translate('clear') }}</a>
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
                                <th>{{ translate('grn_code') }}</th>
                                <th>{{ translate('purchase_order') }}</th>
                                <th>{{ translate('vendor') }}</th>
                                <th>{{ translate('status') }}</th>
                                <th>{{ translate('inventory_status') }}</th>
                                <th>{{ translate('received_at') }}</th>
                                <th class="text-end">{{ translate('actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($grns as $grn)
                                <tr>
                                    <td class="fw-semibold">{{ $grn->code }}</td>
                                    <td>
                                        <a href="{{ route('admin.purchase.orders.show', $grn->order_id) }}" class="text-decoration-none">
                                            {{ $grn->order->code ?? translate('not_set') }}
                                        </a>
                                    </td>
                                    <td>{{ optional($grn->order->vendor)->display_name ?? translate('not_set') }}</td>
                                    <td>
                                        <span class="badge badge-soft-primary text-capitalize">{{ translate($grn->status) }}</span>
                                    </td>
                                    <td>
                                        <span class="badge badge-soft-info text-capitalize">{{ translate($grn->inventory_sync_status ?? 'pending') }}</span>
                                    </td>
                                    <td>{{ $grn->received_at?->format('M d, Y') }}</td>
                                    <td class="text-end">
                                        <div class="btn-group">
                                            <a href="{{ route('admin.purchase.grns.show', $grn->id) }}" class="btn btn-outline--primary btn-sm">{{ translate('view') }}</a>
                                            <button type="button" class="btn btn-outline-secondary btn-sm dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <span class="sr-only">{{ translate('toggle_actions') }}</span>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                @can('update', $grn)
                                                    <a class="dropdown-item" href="{{ route('admin.purchase.grns.edit', $grn->id) }}">{{ translate('edit') }}</a>
                                                    <form action="{{ route('admin.purchase.grns.submit', $grn->id) }}" method="post" onsubmit="return confirm('{{ translate('confirm_submit_grn') }}');">
                                                        @csrf
                                                        <button type="submit" class="dropdown-item">{{ translate('submit_for_review') }}</button>
                                                    </form>
                                                @endcan
                                                @can('approve', $grn)
                                                    @if($grn->status === \App\Services\Purchase\GoodsReceiptWorkflowService::STATUS_PENDING_REVIEW)
                                                        <form action="{{ route('admin.purchase.grns.approve', $grn->id) }}" method="post" onsubmit="return confirm('{{ translate('confirm_approve_grn') }}');">
                                                            @csrf
                                                            <button type="submit" class="dropdown-item text-success">{{ translate('approve') }}</button>
                                                        </form>
                                                        <button type="button" class="dropdown-item text-danger" data-action="reject" data-target="#grn-reject-modal" data-url="{{ route('admin.purchase.grns.reject', $grn->id) }}">{{ translate('reject') }}</button>
                                                    @endif
                                                @endcan
                                                @can('markReturned', $grn)
                                                    @if($grn->status === \App\Services\Purchase\GoodsReceiptWorkflowService::STATUS_APPROVED)
                                                        <button type="button" class="dropdown-item" data-action="mark-returned" data-target="#grn-return-modal" data-url="{{ route('admin.purchase.grns.mark-returned', $grn->id) }}">{{ translate('mark_returned') }}</button>
                                                    @endif
                                                @endcan
                                                @can('retryInventory', $grn)
                                                    @if($grn->inventory_sync_status === 'failed')
                                                        <form action="{{ route('admin.purchase.grns.retry-inventory', $grn->id) }}" method="post" onsubmit="return confirm('{{ translate('confirm_retry_inventory') }}');">
                                                            @csrf
                                                            <button type="submit" class="dropdown-item">{{ translate('retry_inventory_sync') }}</button>
                                                        </form>
                                                    @endif
                                                @endcan
                                                @can('delete', $grn)
                                                    <form action="{{ route('admin.purchase.grns.destroy', $grn->id) }}" method="post" onsubmit="return confirm('{{ translate('confirm_delete_grn') }}');">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="submit" class="dropdown-item text-danger">{{ translate('delete') }}</button>
                                                    </form>
                                                @endcan
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center text-muted py-5">{{ translate('purchase_grn_empty_state') }}</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-3">
                    {{ $grns->links() }}
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="grn-reject-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form method="post" class="modal-content" id="grn-reject-form">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title text-capitalize">{{ translate('reject_goods_receipt') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="{{ translate('close') }}">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="form-label">{{ translate('rejection_reason') }}</label>
                        <textarea name="reason" class="form-control" rows="3" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ translate('cancel') }}</button>
                    <button type="submit" class="btn btn-danger">{{ translate('reject') }}</button>
                </div>
            </form>
        </div>
    </div>

    <div class="modal fade" id="grn-return-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form method="post" class="modal-content" id="grn-return-form">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title text-capitalize">{{ translate('mark_grn_returned') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="{{ translate('close') }}">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="form-label">{{ translate('return_reference_optional') }}</label>
                        <input type="text" name="reference" class="form-control" placeholder="{{ translate('reference_number_optional') }}">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ translate('cancel') }}</button>
                    <button type="submit" class="btn btn--primary">{{ translate('mark_returned') }}</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('script')
<script>
(function () {
    const rejectModal = document.getElementById('grn-reject-modal');
    const rejectForm = document.getElementById('grn-reject-form');
    const returnModal = document.getElementById('grn-return-modal');
    const returnForm = document.getElementById('grn-return-form');

    document.addEventListener('click', function (event) {
        const trigger = event.target.closest('[data-action]');
        if (!trigger) {
            return;
        }

        const url = trigger.getAttribute('data-url');
        if (!url) {
            return;
        }

        if (trigger.dataset.action === 'reject') {
            rejectForm.action = url;
            $(rejectModal).modal('show');
        }

        if (trigger.dataset.action === 'mark-returned') {
            returnForm.action = url;
            $(returnModal).modal('show');
        }
    });
})();
</script>
@endpush
