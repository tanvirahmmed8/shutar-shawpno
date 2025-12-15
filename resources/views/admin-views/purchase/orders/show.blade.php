@extends('layouts.back-end.app')
@section('title', $order->code)
@section('content')
    <div class="content container-fluid">
        <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
            <div>
                <h2 class="h1 mb-1">{{ $order->code }}</h2>
                <div class="d-flex gap-3 align-items-center flex-wrap text-muted">
                    <span class="badge badge-soft-primary text-uppercase">{{ translate($order->status) }}</span>
                    <span>{{ translate('vendor') }}: {{ optional($order->vendor)->display_name ?? translate('not_set') }}</span>
                    <span>{{ translate('created_at') }}: {{ $order->created_at?->format('M d, Y') ?? '—' }}</span>
                </div>
            </div>
            <div class="d-flex gap-2">
                @can('update', $order)
                    <a href="{{ route('admin.purchase.orders.edit', $order->id) }}" class="btn btn-outline-secondary">{{ translate('edit') }}</a>
                @endcan
                <a href="{{ route('admin.purchase.orders.index') }}" class="btn btn-outline-secondary">{{ translate('back') }}</a>
            </div>
        </div>

        <div class="row g-4">
            <div class="col-lg-8">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="mb-4 text-capitalize">{{ translate('purchase_order_summary') }}</h5>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <span class="text-muted text-capitalize">{{ translate('vendor') }}</span>
                                <p class="fw-semibold mb-0">{{ optional($order->vendor)->display_name ?? translate('not_set') }}</p>
                                @php($primaryContact = optional($order->vendor)->primaryContact)
                                @if($primaryContact)
                                    <small class="d-block text-muted">{{ $primaryContact->name }} • {{ $primaryContact->email }}</small>
                                @endif
                            </div>
                            <div class="col-md-3">
                                <span class="text-muted text-capitalize">{{ translate('currency') }}</span>
                                <p class="fw-semibold mb-0">{{ $order->currency }}</p>
                            </div>
                            <div class="col-md-3">
                                <span class="text-muted text-capitalize">{{ translate('expected_delivery') }}</span>
                                <p class="fw-semibold mb-0">{{ optional($order->expected_delivery)->format('M d, Y') ?? '—' }}</p>
                            </div>
                            <div class="col-md-4">
                                <span class="text-muted text-capitalize">{{ translate('payment_terms') }}</span>
                                <p class="fw-semibold mb-0">{{ $order->payment_terms ?? '—' }}</p>
                            </div>
                        </div>
                        <div class="border-top pt-3 mt-3">
                            <div class="d-flex justify-content-between">
                                <span class="text-muted text-capitalize">{{ translate('subtotal') }}</span>
                                <span class="fw-semibold">{{ number_format($order->subtotal, 2) }}</span>
                            </div>
                            <div class="d-flex justify-content-between">
                                <span class="text-muted text-capitalize">{{ translate('freight_cost') }}</span>
                                <span class="fw-semibold">{{ number_format($order->freight_cost, 2) }}</span>
                            </div>
                            <div class="d-flex justify-content-between">
                                <span class="text-muted text-capitalize">{{ translate('tax_total') }}</span>
                                <span class="fw-semibold">{{ number_format($order->tax_total, 2) }}</span>
                            </div>
                            <div class="d-flex justify-content-between">
                                <span class="text-muted text-capitalize">{{ translate('discount_total') }}</span>
                                <span class="fw-semibold">-{{ number_format($order->discount_total, 2) }}</span>
                            </div>
                            <div class="d-flex justify-content-between">
                                <span class="text-muted text-capitalize">{{ translate('grand_total') }}</span>
                                <span class="fw-bold">{{ $order->currency }} {{ number_format($order->grand_total, 2) }}</span>
                            </div>
                        </div>
                        @if($order->notes_internal)
                            <div class="mt-3">
                                <span class="text-muted text-capitalize d-block mb-1">{{ translate('internal_notes') }}</span>
                                <p class="mb-0">{{ $order->notes_internal }}</p>
                            </div>
                        @endif
                        @if($order->notes_vendor)
                            <div class="mt-3">
                                <span class="text-muted text-capitalize d-block mb-1">{{ translate('vendor_notes') }}</span>
                                <p class="mb-0">{{ $order->notes_vendor }}</p>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="mb-4 text-capitalize">{{ translate('line_items') }}</h5>
                        <div class="table-responsive">
                            <table class="table table-borderless align-middle">
                                <thead class="thead-light">
                                    <tr>
                                        <th>#</th>
                                        <th>{{ translate('description') }}</th>
                                        <th class="text-end">{{ translate('quantity') }}</th>
                                        <th class="text-end">{{ translate('unit_price') }}</th>
                                        <th class="text-end">{{ translate('tax_percent') }}</th>
                                        <th class="text-end">{{ translate('discount_percent') }}</th>
                                        <th class="text-end">{{ translate('line_total') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($order->items as $index => $item)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>
                                                <div class="fw-semibold">{{ $item->description }}</div>
                                                <small class="text-muted">{{ $item->uom }}</small>
                                            </td>
                                            <td class="text-end">{{ number_format($item->quantity, 2) }}</td>
                                            <td class="text-end">{{ number_format($item->unit_price, 2) }}</td>
                                            <td class="text-end">{{ number_format($item->tax_percent, 2) }}%</td>
                                            <td class="text-end">{{ number_format($item->discount_percent, 2) }}%</td>
                                            <td class="text-end fw-semibold">{{ number_format($item->line_total, 2) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="mb-4 text-capitalize">{{ translate('communication_log') }}</h5>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>{{ translate('channel') }}</th>
                                        <th>{{ translate('recipient') }}</th>
                                        <th>{{ translate('status') }}</th>
                                        <th>{{ translate('sent_at') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($order->communications as $communication)
                                        <tr>
                                            <td class="text-capitalize">{{ $communication->channel }}</td>
                                            <td>{{ $communication->recipient ?? '—' }}</td>
                                            <td><span class="badge badge-soft-primary text-uppercase">{{ $communication->status }}</span></td>
                                            <td>{{ $communication->sent_at?->format('M d, Y H:i') ?? '—' }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center text-muted py-4">{{ translate('purchase_order_no_communications') }}</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <h5 class="mb-4 text-capitalize">{{ translate('activity_timeline') }}</h5>
                        <ul class="timeline list-unstyled">
                            @forelse($events as $event)
                                <li class="mb-4">
                                    <div class="d-flex justify-content-between">
                                        <span class="fw-semibold text-capitalize">{{ str_replace('_', ' ', $event->event_type) }}</span>
                                        <span class="text-muted">{{ $event->created_at?->format('M d, Y H:i') }}</span>
                                    </div>
                                    @if(!empty($event->payload['comments']))
                                        <p class="mb-0 text-muted small">{{ $event->payload['comments'] }}</p>
                                    @endif
                                </li>
                            @empty
                                <li class="text-muted">{{ translate('activity_log_empty_state') }}</li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                @can('send', $order)
                    @if(in_array($order->status, [\App\Services\Purchase\PurchaseOrderWorkflowService::STATUS_APPROVED, \App\Services\Purchase\PurchaseOrderWorkflowService::STATUS_SENT]))
                        <div class="card mb-4">
                            <div class="card-body">
                                <h5 class="mb-3 text-capitalize">{{ translate('send_to_vendor') }}</h5>
                                <form action="{{ route('admin.purchase.orders.send', $order->id) }}" method="post">
                                    @csrf
                                    <div class="mb-3">
                                        <label class="form-label">{{ translate('recipient_email') }}</label>
                                        <input type="email" name="recipient" class="form-control" value="{{ old('recipient') }}" placeholder="{{ optional($primaryContact)->email ?? optional($order->vendor)->primary_email }}">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">{{ translate('subject') }}</label>
                                        <input type="text" name="subject" class="form-control" value="{{ old('subject', translate('purchase_order_email_subject', ['code' => $order->code])) }}">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">{{ translate('message_optional') }}</label>
                                        <textarea name="message" class="form-control" rows="3">{{ old('message') }}</textarea>
                                    </div>
                                    <button type="submit" class="btn btn--primary w-100">{{ translate('send_purchase_order') }}</button>
                                </form>
                            </div>
                        </div>
                    @endif
                @endcan

                @can('approve', $order)
                    @if($order->status === \App\Services\Purchase\PurchaseOrderWorkflowService::STATUS_PENDING_APPROVAL)
                        <div class="card mb-4">
                            <div class="card-body">
                                <h5 class="mb-3 text-capitalize">{{ translate('approval_actions') }}</h5>
                                <form action="{{ route('admin.purchase.orders.approve', $order->id) }}" method="post" class="mb-3">
                                    @csrf
                                    <div class="mb-3">
                                        <label class="form-label">{{ translate('comments_optional') }}</label>
                                        <textarea name="comments" class="form-control" rows="2"></textarea>
                                    </div>
                                    <button type="submit" class="btn btn--primary w-100">{{ translate('approve') }}</button>
                                </form>
                                <form action="{{ route('admin.purchase.orders.reject', $order->id) }}" method="post">
                                    @csrf
                                    <div class="mb-3">
                                        <label class="form-label">{{ translate('comments_required') }}</label>
                                        <textarea name="comments" class="form-control" rows="2" required></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-outline-danger w-100">{{ translate('reject') }}</button>
                                </form>
                            </div>
                        </div>
                    @endif

                    @if($order->status === \App\Services\Purchase\PurchaseOrderWorkflowService::STATUS_SENT)
                        <div class="card mb-4">
                            <div class="card-body">
                                <h5 class="mb-3 text-capitalize">{{ translate('acknowledgement') }}</h5>
                                <form action="{{ route('admin.purchase.orders.acknowledge', $order->id) }}" method="post" class="mb-2">
                                    @csrf
                                    <button type="submit" class="btn btn-outline-primary w-100">{{ translate('mark_acknowledged') }}</button>
                                </form>
                            </div>
                        </div>
                    @endif

                    @if(in_array($order->status, [\App\Services\Purchase\PurchaseOrderWorkflowService::STATUS_SENT, \App\Services\Purchase\PurchaseOrderWorkflowService::STATUS_ACKNOWLEDGED]))
                        <div class="card mb-4">
                            <div class="card-body">
                                <h5 class="mb-3 text-capitalize">{{ translate('close_purchase_order') }}</h5>
                                <form action="{{ route('admin.purchase.orders.close', $order->id) }}" method="post">
                                    @csrf
                                    <button type="submit" class="btn btn-outline-secondary w-100">{{ translate('mark_closed') }}</button>
                                </form>
                            </div>
                        </div>
                    @endif
                @endcan

                <div class="card">
                    <div class="card-body">
                        <h5 class="mb-3 text-capitalize">{{ translate('approval_timeline') }}</h5>
                        <ul class="list-unstyled timeline">
                            @forelse($order->approvals as $approval)
                                <li class="mb-3">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <span class="fw-semibold">{{ translate('step') }} {{ $approval->step }}</span>
                                            <div class="text-muted">{{ $approval->approver->name ?? translate('pending_assignment') }}</div>
                                        </div>
                                        <span class="badge badge-soft-primary text-uppercase">{{ translate($approval->status) }}</span>
                                    </div>
                                    @if($approval->comments)
                                        <p class="mb-0 mt-2 small text-muted">{{ $approval->comments }}</p>
                                    @endif
                                </li>
                            @empty
                                <li class="text-muted">{{ translate('no_approval_steps_configured') }}</li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
