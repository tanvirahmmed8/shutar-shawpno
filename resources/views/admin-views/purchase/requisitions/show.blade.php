@extends('layouts.back-end.app')
@section('title', $requisition->code)
@section('content')
    <div class="content container-fluid">
        <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
            <div>
                <h2 class="h1 mb-1">{{ $requisition->code }}</h2>
                <div class="d-flex gap-2 align-items-center">
                    <span class="badge badge-soft-{{ $statusColors[$requisition->status] ?? 'secondary' }} text-uppercase">{{ translate($requisition->status) }}</span>
                    <span class="text-muted">{{ translate('requester') }}: {{ optional($requisition->requester)->name ?? translate('not_set') }}</span>
                </div>
            </div>
            <div class="d-flex gap-2">
                <a href="{{ route('admin.purchase.requisitions.edit', $requisition->id) }}" class="btn btn-outline-secondary">{{ translate('edit') }}</a>
                <a href="{{ route('admin.purchase.requisitions.index') }}" class="btn btn-outline-secondary">{{ translate('back') }}</a>
            </div>
        </div>

        <div class="row g-4">
            <div class="col-lg-8">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="mb-4 text-capitalize">{{ translate('requisition_details') }}</h5>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <span class="text-muted text-capitalize">{{ translate('priority') }}</span>
                                <p class="fw-semibold text-capitalize mb-0">{{ $requisition->priority }}</p>
                            </div>
                            <div class="col-md-6">
                                <span class="text-muted text-capitalize">{{ translate('status') }}</span>
                                <p class="fw-semibold text-capitalize mb-0">{{ translate($requisition->status) }}</p>
                            </div>
                            <div class="col-md-6">
                                <span class="text-muted text-capitalize">{{ translate('currency') }}</span>
                                <p class="fw-semibold mb-0">{{ $requisition->currency }}</p>
                            </div>
                            <div class="col-md-6">
                                <span class="text-muted text-capitalize">{{ translate('needed_by') }}</span>
                                <p class="fw-semibold mb-0">{{ optional($requisition->needed_by)->format('M d, Y') ?? '—' }}</p>
                            </div>
                            <div class="col-md-6">
                                <span class="text-muted text-capitalize">{{ translate('approval_route') }}</span>
                                <p class="fw-semibold mb-0">{{ optional($requisition->approvalRoute)->name ?? translate('not_set') }}</p>
                            </div>
                            <div class="col-md-6">
                                <span class="text-muted text-capitalize">{{ translate('cost_center') }}</span>
                                <p class="fw-semibold mb-0">{{ $requisition->cost_center_id ?? '—' }}</p>
                            </div>
                        </div>
                        @if($requisition->justification)
                            <div class="mt-4">
                                <span class="text-muted text-capitalize d-block mb-1">{{ translate('justification') }}</span>
                                <p class="mb-0">{{ $requisition->justification }}</p>
                            </div>
                        @endif
                        @if($requisition->rejected_reason)
                            <div class="mt-4">
                                <span class="text-muted text-capitalize d-block mb-1 text-danger">{{ translate('rejected_reason') }}</span>
                                <p class="mb-0 text-danger">{{ $requisition->rejected_reason }}</p>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <h5 class="mb-4 text-capitalize">{{ translate('line_items') }}</h5>
                        <div class="table-responsive">
                            <table class="table table-borderless align-middle">
                                <thead class="thead-light">
                                    <tr>
                                        <th>#</th>
                                        <th>{{ translate('description') }}</th>
                                        <th>{{ translate('uom') }}</th>
                                        <th class="text-end">{{ translate('quantity') }}</th>
                                        <th class="text-end">{{ translate('unit_price') }}</th>
                                        <th class="text-end">{{ translate('line_total') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($requisition->items as $index => $item)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>
                                                <div class="fw-semibold">{{ $item->description }}</div>
                                                <small class="text-muted">{{ $item->product_id ? translate('product') . ' #' . $item->product_id : translate('product_sku_optional') }}</small>
                                            </td>
                                            <td>{{ $item->uom }}</td>
                                            <td class="text-end">{{ number_format($item->quantity, 2) }}</td>
                                            <td class="text-end">{{ number_format($item->unit_price, 2) }}</td>
                                            <td class="text-end fw-semibold">{{ number_format($item->line_total, 2) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="border-top pt-3 mt-3">
                            <div class="d-flex justify-content-between">
                                <span class="text-muted text-capitalize">{{ translate('subtotal') }}</span>
                                <span class="fw-semibold">{{ number_format($requisition->subtotal, 2) }}</span>
                            </div>
                            <div class="d-flex justify-content-between">
                                <span class="text-muted text-capitalize">{{ translate('tax') }}</span>
                                <span class="fw-semibold">{{ number_format($requisition->tax_total, 2) }}</span>
                            </div>
                            <div class="d-flex justify-content-between">
                                <span class="text-muted text-capitalize">{{ translate('grand_total') }}</span>
                                <span class="fw-bold">{{ number_format($requisition->grand_total, 2) }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="mb-4 text-capitalize">{{ translate('approval_timeline') }}</h5>
                        <ul class="list-unstyled timeline">
                            @forelse($requisition->approvals as $approval)
                                <li class="mb-4">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <span class="fw-semibold">{{ translate('step') }} {{ $approval->step }}</span>
                                            <div class="text-muted">{{ $approval->approver->name ?? translate('not_set') }}</div>
                                        </div>
                                        <span class="badge badge-soft-{{ $statusColors[$approval->status] ?? 'secondary' }} text-uppercase">{{ translate($approval->status) }}</span>
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

                @if($canActOnApproval)
                    <div class="card">
                        <div class="card-body">
                            <h5 class="text-capitalize mb-3">{{ translate('approval_actions') }}</h5>
                            <form action="{{ route('admin.purchase.requisitions.approve', $requisition->id) }}" method="post" class="mb-3">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label text-capitalize">{{ translate('approval_comments') }}</label>
                                    <textarea name="comments" class="form-control" rows="2"></textarea>
                                </div>
                                <button type="submit" class="btn btn--primary w-100">{{ translate('approve') }}</button>
                            </form>
                            <form action="{{ route('admin.purchase.requisitions.reject', $requisition->id) }}" method="post">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label text-capitalize">{{ translate('approval_comments') }}</label>
                                    <textarea name="comments" class="form-control" rows="2" required></textarea>
                                </div>
                                <button type="submit" class="btn btn-outline-danger w-100">{{ translate('reject') }}</button>
                            </form>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
