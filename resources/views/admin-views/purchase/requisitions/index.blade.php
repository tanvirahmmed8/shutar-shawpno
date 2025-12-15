@extends('layouts.back-end.app')
@section('title', translate('purchase_requisitions'))
@section('content')
    <div class="content container-fluid">
        <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
            <div>
                <h2 class="h1 mb-1 text-capitalize">{{ translate('purchase_requisitions') }}</h2>
                <p class="text-muted mb-0">{{ translate('requisition_workspace_intro') }}</p>
            </div>
            @can('create', App\Models\Purchase\PurchaseRequisition::class)
                <a href="{{ route('admin.purchase.requisitions.create') }}" class="btn btn--primary">
                    <i class="tio-add"></i>
                    <span class="ps-1">{{ translate('add_requisition') }}</span>
                </a>
            @endcan
        </div>

        <div class="card mb-4">
            <div class="card-body">
                <form method="get" class="row g-3 align-items-end">
                    <div class="col-md-4">
                        <label class="form-label text-capitalize">{{ translate('search') }}</label>
                        <input type="search" name="search" class="form-control" value="{{ $filters['search'] }}" placeholder="{{ translate('search_by_code_name_email') }}">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label text-capitalize">{{ translate('status') }}</label>
                        <select name="status" class="form-control select2">
                            <option value="">{{ translate('all_statuses') }}</option>
                            @foreach($statusOptions as $option)
                                <option value="{{ $option }}" {{ $filters['status'] === $option ? 'selected' : '' }}>{{ translate($option) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label text-capitalize">{{ translate('priority') }}</label>
                        <select name="priority" class="form-control select2">
                            <option value="">{{ translate('all') }}</option>
                            @foreach($priorityOptions as $option)
                                <option value="{{ $option }}" {{ $filters['priority'] === $option ? 'selected' : '' }}>{{ ucfirst($option) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2 d-flex gap-2">
                        <button type="submit" class="btn btn--primary w-100">{{ translate('filter') }}</button>
                        <a href="{{ route('admin.purchase.requisitions.index') }}" class="btn btn-outline-secondary w-100">{{ translate('clear') }}</a>
                    </div>
                </form>
            </div>
        </div>

        <div class="card">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="thead-light">
                            <tr>
                                <th>{{ translate('requisition_code') }}</th>
                                <th>{{ translate('requester') }}</th>
                                <th>{{ translate('priority') }}</th>
                                <th>{{ translate('status') }}</th>
                                <th class="text-end">{{ translate('grand_total') }}</th>
                                <th class="text-end">{{ translate('actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($requisitions as $requisition)
                                <tr>
                                    <td>
                                        <a href="{{ route('admin.purchase.requisitions.show', $requisition->id) }}" class="fw-semibold text-decoration-none">
                                            {{ $requisition->code }}
                                        </a>
                                        <div class="small text-muted">{{ translate('needed_by') }}: {{ optional($requisition->needed_by)->format('M d, Y') ?? '—' }}</div>
                                    </td>
                                    <td>
                                        <div class="d-flex flex-column">
                                            <span class="fw-semibold">{{ optional($requisition->requester)->name ?? translate('not_set') }}</span>
                                            <small class="text-muted">{{ optional($requisition->requester)->email }}</small>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge badge-soft-info text-capitalize">{{ $requisition->priority }}</span>
                                    </td>
                                    <td>
                                        <span class="badge badge-soft-{{ $statusColors[$requisition->status] ?? 'secondary' }} text-capitalize">{{ translate($requisition->status) }}</span>
                                    </td>
                                    <td class="text-end fw-semibold">{{ $requisition->currency }} {{ number_format($requisition->grand_total, 2) }}</td>
                                    <td class="text-end">
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('admin.purchase.requisitions.edit', $requisition->id) }}" class="btn btn-outline--primary btn-sm" title="{{ translate('edit') }}">
                                                <i class="tio-edit"></i>
                                            </a>
                                            <a href="{{ route('admin.purchase.requisitions.show', $requisition->id) }}" class="btn btn-outline-secondary btn-sm" title="{{ translate('view') }}">
                                                <i class="tio-visible"></i>
                                            </a>
                                            @can('delete', $requisition)
                                                <form action="{{ route('admin.purchase.requisitions.destroy', $requisition->id) }}" method="post" onsubmit="return confirm('{{ translate('requisition_delete_confirmation') }}');">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="btn btn-outline-danger btn-sm" title="{{ translate('delete') }}">
                                                        <i class="tio-delete"></i>
                                                    </button>
                                                </form>
                                            @endcan
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center text-muted py-5">{{ translate('no_requisition_found') }}</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="px-3 py-4">
                    {{ $requisitions->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
