@extends('layouts.back-end.app')
@section('title', translate('goods_receipt_details'))
@section('content')
    <div class="content container-fluid">
        <div class="d-flex flex-wrap justify-content-between align-items-start gap-3 mb-4">
            <div>
                <div class="d-flex align-items-center gap-2 mb-2">
                    <h2 class="h1 mb-0 text-capitalize">{{ translate('goods_receipt') }} {{ $grn->code }}</h2>
                    <span class="badge badge-soft-primary text-capitalize">{{ translate($grn->status) }}</span>
                    <span class="badge badge-soft-info text-capitalize">{{ translate($grn->inventory_sync_status ?? 'pending') }}</span>
                </div>
                <p class="text-muted mb-0">{{ translate('last_updated') }} {{ $grn->updated_at?->diffForHumans() }}</p>
                @if($grn->rejection_reason)
                    <div class="text-danger mt-2">{{ translate('rejection_reason') }}: {{ $grn->rejection_reason }}</div>
                @endif
            </div>
            <div class="d-flex flex-wrap gap-2">
                <a href="{{ route('admin.purchase.grns.index') }}" class="btn btn-outline-secondary">
                    <i class="tio-arrow-backward"></i>
                    <span class="ps-1">{{ translate('back_to_list') }}</span>
                </a>
                @can('update', $grn)
                    @if($grn->status === \App\Services\Purchase\GoodsReceiptWorkflowService::STATUS_DRAFT)
                        <a href="{{ route('admin.purchase.grns.edit', $grn->id) }}" class="btn btn-outline--primary">{{ translate('edit') }}</a>
                        <form action="{{ route('admin.purchase.grns.submit', $grn->id) }}" method="post" onsubmit="return confirm('{{ translate('confirm_submit_grn') }}');">
                            @csrf
                            <button type="submit" class="btn btn--primary">{{ translate('submit_for_review') }}</button>
                        </form>
                    @endif
                @endcan
                @can('approve', $grn)
                    @if($grn->status === \App\Services\Purchase\GoodsReceiptWorkflowService::STATUS_PENDING_REVIEW)
                        <form action="{{ route('admin.purchase.grns.approve', $grn->id) }}" method="post" onsubmit="return confirm('{{ translate('confirm_approve_grn') }}');">
                            @csrf
                            <button type="submit" class="btn btn-success">{{ translate('approve') }}</button>
                        </form>
                        <button type="button" class="btn btn-danger" data-action="reject" data-target="#grn-reject-modal" data-url="{{ route('admin.purchase.grns.reject', $grn->id) }}">{{ translate('reject') }}</button>
                    @endif
                @endcan
                @can('markReturned', $grn)
                    @if($grn->status === \App\Services\Purchase\GoodsReceiptWorkflowService::STATUS_APPROVED)
                        <button type="button" class="btn btn-outline-warning" data-action="mark-returned" data-target="#grn-return-modal" data-url="{{ route('admin.purchase.grns.mark-returned', $grn->id) }}">
                            {{ translate('mark_returned') }}
                        </button>
                    @endif
                @endcan
                @can('retryInventory', $grn)
                    @if($grn->inventory_sync_status === 'failed')
                        <form action="{{ route('admin.purchase.grns.retry-inventory', $grn->id) }}" method="post" onsubmit="return confirm('{{ translate('confirm_retry_inventory') }}');">
                            @csrf
                            <button type="submit" class="btn btn-outline-info">{{ translate('retry_inventory_sync') }}</button>
                        </form>
                    @endif
                @endcan
                @can('delete', $grn)
                    @if($grn->status === \App\Services\Purchase\GoodsReceiptWorkflowService::STATUS_DRAFT)
                        <form action="{{ route('admin.purchase.grns.destroy', $grn->id) }}" method="post" onsubmit="return confirm('{{ translate('confirm_delete_grn') }}');">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger">{{ translate('delete') }}</button>
                        </form>
                    @endif
                @endcan
            </div>
        </div>

        <div class="row g-3 mb-4">
            <div class="col-xl-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="mb-3 text-capitalize">{{ translate('receipt_summary') }}</h5>
                        <ul class="list-unstyled mb-0">
                            <li class="mb-2 d-flex justify-content-between">
                                <span>{{ translate('purchase_order') }}</span>
                                <a href="{{ route('admin.purchase.orders.show', $grn->order_id) }}">{{ $grn->order->code }}</a>
                            </li>
                            <li class="mb-2 d-flex justify-content-between">
                                <span>{{ translate('vendor') }}</span>
                                <span>{{ optional($grn->order->vendor)->display_name ?? translate('not_set') }}</span>
                            </li>
                            <li class="mb-2 d-flex justify-content-between">
                                <span>{{ translate('warehouse_id') }}</span>
                                <span>{{ $grn->warehouse_id ?? '--' }}</span>
                            </li>
                            <li class="mb-2 d-flex justify-content-between">
                                <span>{{ translate('received_at') }}</span>
                                <span>{{ $grn->received_at?->format('M d, Y H:i') }}</span>
                            </li>
                            <li class="mb-2 d-flex justify-content-between">
                                <span>{{ translate('received_by') }}</span>
                                <span>{{ optional($grn->receiver)->name ?? '--' }}</span>
                            </li>
                            <li class="mb-2 d-flex justify-content-between">
                                <span>{{ translate('approved_at') }}</span>
                                <span>{{ $grn->approved_at?->format('M d, Y H:i') ?? '--' }}</span>
                            </li>
                            <li class="mb-2 d-flex justify-content-between">
                                <span>{{ translate('inventory_status') }}</span>
                                <span class="badge badge-soft-info text-capitalize">{{ translate($grn->inventory_sync_status ?? 'pending') }}</span>
                            </li>
                            @if($grn->inventory_sync_status === 'failed' && $grn->inventory_sync_payload)
                                <li class="text-danger small">{{ translate('inventory_payload_ready_retry') }}</li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-xl-8">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="mb-3 text-capitalize">{{ translate('goods_receipt_items') }}</h5>
                        <div class="table-responsive">
                            <table class="table table-sm table-borderless align-middle">
                                <thead class="thead-light">
                                    <tr>
                                        <th>{{ translate('item') }}</th>
                                        <th class="text-end">{{ translate('ordered') }}</th>
                                        <th class="text-end">{{ translate('received') }}</th>
                                        <th class="text-end">{{ translate('accepted') }}</th>
                                        <th class="text-end">{{ translate('rejected') }}</th>
                                        <th>{{ translate('uom') }}</th>
                                        <th>{{ translate('batch') }}</th>
                                        <th>{{ translate('lot') }}</th>
                                        <th>{{ translate('expiry') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($grn->items as $item)
                                        <tr>
                                            <td>
                                                <div class="fw-semibold">{{ optional($item->orderItem)->description ?? ('#' . $item->order_item_id) }}</div>
                                                <small class="text-muted">{{ translate('storage') }}: {{ $item->storage_location ?? '--' }}</small>
                                            </td>
                                            <td class="text-end">{{ number_format(optional($item->orderItem)->quantity ?? 0, 2) }}</td>
                                            <td class="text-end">{{ number_format($item->received_qty, 2) }}</td>
                                            <td class="text-end">{{ number_format($item->accepted_qty, 2) }}</td>
                                            <td class="text-end">{{ number_format($item->rejected_qty, 2) }}</td>
                                            <td>{{ $item->uom }}</td>
                                            <td>{{ $item->batch_number ?? '--' }}</td>
                                            <td>{{ $item->lot_number ?? '--' }}</td>
                                            <td>{{ $item->expiry_date?->format('M d, Y') ?? '--' }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @can('initiateReturn', $grn)
            @if($grn->status === \App\Services\Purchase\GoodsReceiptWorkflowService::STATUS_APPROVED)
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0 text-capitalize">{{ translate('initiate_return_to_vendor') }}</h5>
                        <button class="btn btn-outline-secondary btn-sm" type="button" data-toggle="collapse" data-target="#grn-return-form-collapse">{{ translate('toggle_form') }}</button>
                    </div>
                    <div class="collapse" id="grn-return-form-collapse">
                        <div class="card-body">
                            <form action="{{ route('admin.purchase.grns.returns.store', $grn->id) }}" method="post" enctype="multipart/form-data" id="grn-return-create-form">
                                @csrf
                                <div class="row g-3 mb-3">
                                    <div class="col-md-3">
                                        <label class="form-label text-capitalize">{{ translate('carrier') }}</label>
                                        <input type="text" name="carrier" class="form-control" placeholder="{{ translate('optional') }}">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label text-capitalize">{{ translate('tracking_number') }}</label>
                                        <input type="text" name="tracking_number" class="form-control" placeholder="{{ translate('optional') }}">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label text-capitalize">{{ translate('return_reason') }}</label>
                                        <input type="text" name="return_reason" class="form-control" placeholder="{{ translate('optional') }}">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label text-capitalize">{{ translate('supporting_document') }}</label>
                                        <input type="file" name="document" class="form-control">
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label text-capitalize">{{ translate('notes') }}</label>
                                        <textarea name="notes" rows="2" class="form-control" placeholder="{{ translate('optional') }}"></textarea>
                                    </div>
                                </div>
                                <div class="table-responsive mb-3">
                                    <table class="table table-bordered align-middle">
                                        <thead class="thead-light">
                                            <tr>
                                                <th>{{ translate('select') }}</th>
                                                <th>{{ translate('item') }}</th>
                                                <th class="text-end">{{ translate('accepted_qty') }}</th>
                                                <th class="text-end">{{ translate('return_qty') }}</th>
                                                <th>{{ translate('disposition') }}</th>
                                                <th>{{ translate('remarks') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($grn->items as $index => $item)
                                                <tr data-return-line>
                                                    <td>
                                                        <input type="checkbox" class="form-check-input" data-return-toggle>
                                                        <input type="hidden" name="items[{{ $index }}][grn_item_id]" value="{{ $item->id }}" disabled>
                                                    </td>
                                                    <td>
                                                        <div class="fw-semibold">{{ optional($item->orderItem)->description ?? ('#' . $item->order_item_id) }}</div>
                                                        <small class="text-muted">{{ translate('accepted_qty') }}: {{ number_format($item->accepted_qty, 2) }}</small>
                                                    </td>
                                                    <td class="text-end">{{ number_format($item->accepted_qty, 2) }}</td>
                                                    <td>
                                                        <input type="number" step="0.01" min="0.01" name="items[{{ $index }}][return_qty]" class="form-control" value="0" disabled>
                                                    </td>
                                                    <td>
                                                        <select name="items[{{ $index }}][disposition]" class="form-control" disabled>
                                                            <option value="vendor">{{ translate('return_to_vendor') }}</option>
                                                            <option value="scrap">{{ translate('scrap') }}</option>
                                                            <option value="rework">{{ translate('rework') }}</option>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <input type="text" name="items[{{ $index }}][remarks]" class="form-control" placeholder="{{ translate('optional') }}" disabled>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="text-end">
                                    <button type="submit" class="btn btn--primary">{{ translate('create_return') }}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endif
        @endcan

        <div class="card mb-4">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="mb-0 text-capitalize">{{ translate('returns_to_vendor') }}</h5>
                </div>
                <div class="row g-3">
                    @forelse($grn->returns as $return)
                        <div class="col-md-6">
                            <div class="border rounded h-100 p-3">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <div>
                                        <h6 class="mb-0">{{ translate('return_reference') }} #{{ $return->id }}</h6>
                                        <small class="text-muted">{{ translate('status') }}: {{ translate($return->status) }}</small>
                                    </div>
                                    <div class="d-flex gap-2">
                                        @can('updateReturn', $grn)
                                            @if(in_array($return->status, ['draft', 'in_transit']))
                                                <button type="button" class="btn btn-outline-secondary btn-sm" data-action="ship-return" data-url="{{ route('admin.purchase.grns.returns.ship', $return->id) }}" data-carrier="{{ $return->carrier }}" data-tracking="{{ $return->tracking_number }}">
                                                    {{ translate('update_shipping') }}
                                                </button>
                                            @endif
                                        @endcan
                                        @can('updateReturn', $grn)
                                            @if($return->status !== 'closed')
                                                <form action="{{ route('admin.purchase.grns.returns.close', $return->id) }}" method="post" onsubmit="return confirm('{{ translate('confirm_close_return') }}');">
                                                    @csrf
                                                    <button type="submit" class="btn btn-outline-success btn-sm">{{ translate('close_return') }}</button>
                                                </form>
                                            @endif
                                        @endcan
                                    </div>
                                </div>
                                <ul class="list-unstyled small mb-3">
                                    <li>{{ translate('carrier') }}: {{ $return->carrier ?? '--' }}</li>
                                    <li>{{ translate('tracking_number') }}: {{ $return->tracking_number ?? '--' }}</li>
                                    <li>{{ translate('initiated_by') }}: {{ optional($return->initiator)->name ?? '--' }}</li>
                                    <li>{{ translate('shipped_at') }}: {{ $return->shipped_at?->format('M d, Y') ?? '--' }}</li>
                                    <li>{{ translate('closed_at') }}: {{ $return->closed_at?->format('M d, Y') ?? '--' }}</li>
                                </ul>
                                <div class="table-responsive">
                                    <table class="table table-sm">
                                        <thead>
                                            <tr>
                                                <th>{{ translate('item') }}</th>
                                                <th class="text-end">{{ translate('qty') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($return->items as $returnItem)
                                                <tr>
                                                    <td>{{ optional($returnItem->grnItem->orderItem)->description ?? ('#' . $returnItem->grn_item_id) }}</td>
                                                    <td class="text-end">{{ number_format($returnItem->return_qty, 2) }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12 text-center text-muted py-5">{{ translate('no_returns_created_yet') }}</div>
                    @endforelse
                </div>
            </div>
        </div>

        <div class="row g-3">
            <div class="col-lg-6">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="mb-3 text-capitalize">{{ translate('grn_events') }}</h5>
                        <ul class="list-unstyled timeline-list mb-0">
                            @forelse($events as $event)
                                <li class="mb-3">
                                    <div class="fw-semibold text-capitalize">{{ translate($event->event_type ?? 'event') }}</div>
                                    <small class="text-muted">{{ $event->created_at?->format('M d, Y H:i') }}</small>
                                    @if($event->payload)
                                        <pre class="small bg-light rounded p-2 mt-1 mb-0">{{ json_encode($event->payload, JSON_PRETTY_PRINT) }}</pre>
                                    @endif
                                </li>
                            @empty
                                <li class="text-muted">{{ translate('no_grn_events_logged') }}</li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="mb-3 text-capitalize">{{ translate('global_purchase_events') }}</h5>
                        <ul class="list-unstyled mb-0">
                            @forelse($globalEvents as $event)
                                <li class="mb-3">
                                    <div class="fw-semibold text-capitalize">{{ $event->event_type }}</div>
                                    <small class="text-muted">{{ $event->created_at?->format('M d, Y H:i') }}</small>
                                </li>
                            @empty
                                <li class="text-muted">{{ translate('no_global_events_logged') }}</li>
                            @endforelse
                        </ul>
                    </div>
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

    <div class="modal fade" id="grn-return-ship-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form method="post" class="modal-content" id="grn-return-ship-form">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title text-capitalize">{{ translate('update_return_shipping') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="{{ translate('close') }}">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="form-label">{{ translate('carrier') }}</label>
                        <input type="text" name="carrier" class="form-control">
                    </div>
                    <div class="form-group">
                        <label class="form-label">{{ translate('tracking_number') }}</label>
                        <input type="text" name="tracking_number" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ translate('cancel') }}</button>
                    <button type="submit" class="btn btn--primary">{{ translate('save') }}</button>
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
    const shipModal = document.getElementById('grn-return-ship-modal');
    const shipForm = document.getElementById('grn-return-ship-form');

    document.addEventListener('click', function (event) {
        const trigger = event.target.closest('[data-action]');
        if (!trigger) {
            return;
        }
        const url = trigger.getAttribute('data-url');
        if (trigger.dataset.action === 'reject') {
            rejectForm.action = url;
            $(rejectModal).modal('show');
        }
        if (trigger.dataset.action === 'mark-returned') {
            returnForm.action = url;
            $(returnModal).modal('show');
        }
        if (trigger.dataset.action === 'ship-return') {
            shipForm.action = url;
            shipForm.querySelector('[name="carrier"]').value = trigger.dataset.carrier || '';
            shipForm.querySelector('[name="tracking_number"]').value = trigger.dataset.tracking || '';
            $(shipModal).modal('show');
        }
    });

    const returnFormEl = document.getElementById('grn-return-create-form');
    if (returnFormEl) {
        returnFormEl.addEventListener('change', function (event) {
            if (event.target.matches('[data-return-toggle]')) {
                const row = event.target.closest('[data-return-line]');
                row.querySelectorAll('input, select, textarea').forEach(function (input) {
                    if (input === event.target) {
                        return;
                    }
                    input.disabled = !event.target.checked;
                });
            }
        });
    }
})();
</script>
@endpush
