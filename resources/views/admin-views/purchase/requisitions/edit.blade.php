@extends('layouts.back-end.app')
@section('title', $requisition->code)
@section('content')
    <div class="content container-fluid">
        <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
            <div>
                <h2 class="h1 mb-1">{{ $requisition->code }}</h2>
                <div class="d-flex gap-2 align-items-center">
                    <span class="badge badge-soft-{{ $statusColors[$requisition->status] ?? 'secondary' }} text-uppercase">{{ translate($requisition->status) }}</span>
                    <span class="text-muted">{{ translate('updated_at') }}: {{ optional($requisition->updated_at)->format('M d, Y H:i') ?? '—' }}</span>
                </div>
            </div>
            <div class="d-flex gap-2">
                <a href="{{ route('admin.purchase.requisitions.show', $requisition->id) }}" class="btn btn-outline-secondary">{{ translate('view') }}</a>
                @can('submit', $requisition)
                    @if(in_array($requisition->status, ['draft', 'rejected']))
                        <form action="{{ route('admin.purchase.requisitions.submit', $requisition->id) }}" method="post">
                            @csrf
                            <button type="submit" class="btn btn--primary">{{ translate('submit_for_approval') }}</button>
                        </form>
                    @endif
                @endcan
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                @include('admin-views.purchase.requisitions._form', [
                    'requisition' => $requisition,
                    'priorityOptions' => $priorityOptions,
                    'currencyOptions' => $currencyOptions,
                    'approvalRoutes' => $approvalRoutes,
                    'generatedCode' => $requisition->code,
                ])
            </div>
        </div>
    </div>
@endsection
