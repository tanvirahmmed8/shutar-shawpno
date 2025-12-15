@extends('layouts.back-end.app')
@section('title', translate('add_requisition'))
@section('content')
    <div class="content container-fluid">
        <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
            <div>
                <h2 class="h1 mb-1 text-capitalize">{{ translate('add_requisition') }}</h2>
                <p class="text-muted mb-0">{{ translate('requisition_workspace_intro') }}</p>
            </div>
            <a href="{{ route('admin.purchase.requisitions.index') }}" class="btn btn-outline-secondary">{{ translate('back') }}</a>
        </div>

        <div class="card">
            <div class="card-body">
                @include('admin-views.purchase.requisitions._form', [
                    'requisition' => null,
                    'priorityOptions' => $priorityOptions,
                    'currencyOptions' => $currencyOptions,
                    'approvalRoutes' => $approvalRoutes,
                    'generatedCode' => $generatedCode,
                ])
            </div>
        </div>
    </div>
@endsection
