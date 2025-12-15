@extends('layouts.back-end.app')
@section('title', translate('reconciliations'))
@section('content')
    <div class="content container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="h1 mb-0 text-capitalize">{{ translate('reconciliations') }}</h2>
                <p class="text-muted mb-0">{{ translate('track_statement_imports_and_matching_status') }}</p>
            </div>
            <a href="{{ route('admin.accounts-finance.reconciliations.create') }}" class="btn btn--primary">
                <i class="tio-add"></i> {{ translate('new_reconciliation') }}
            </a>
        </div>

        <div class="card mb-4">
            <div class="card-body">
                <form action="{{ route('admin.accounts-finance.reconciliations.index') }}" method="GET" class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label">{{ translate('status') }}</label>
                        <select name="status" class="form-select">
                            <option value="">{{ translate('all_status') }}</option>
                            <option value="pending" {{ ($filters['status'] ?? '') === 'pending' ? 'selected' : '' }}>{{ translate('pending') }}</option>
                            <option value="in_progress" {{ ($filters['status'] ?? '') === 'in_progress' ? 'selected' : '' }}>{{ translate('in_progress') }}</option>
                            <option value="completed" {{ ($filters['status'] ?? '') === 'completed' ? 'selected' : '' }}>{{ translate('completed') }}</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">{{ translate('account') }}</label>
                        <select name="account_id" class="form-select">
                            <option value="">{{ translate('all_accounts') }}</option>
                            @foreach($accounts as $account)
                                <option value="{{ $account->id }}" {{ ($filters['accountId'] ?? '') == $account->id ? 'selected' : '' }}>
                                    {{ $account->code }} - {{ $account->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4 d-flex align-items-end">
                        <button type="submit" class="btn btn--primary w-100">{{ translate('filter') }}</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="card">
            <div class="table-responsive">
                <table class="table align-middle mb-0">
                    <thead class="bg-light">
                    <tr>
                        <th>{{ translate('statement_name') }}</th>
                        <th>{{ translate('account') }}</th>
                        <th>{{ translate('statement_date') }}</th>
                        <th>{{ translate('matched_rows') }}</th>
                        <th>{{ translate('status') }}</th>
                        <th class="text-center">{{ translate('actions') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($reconciliations as $reconciliation)
                        <tr>
                            <td>{{ $reconciliation->statement_name }}</td>
                            <td>{{ $reconciliation->account->code ?? '' }} - {{ $reconciliation->account->name ?? '' }}</td>
                            <td>{{ optional($reconciliation->statement_date)->format('M d, Y') }}</td>
                            <td>{{ $reconciliation->matched_row_count }}/{{ $reconciliation->statement_row_count }}</td>
                            <td>
                                <span class="badge badge-soft-info text-uppercase">{{ translate($reconciliation->status) }}</span>
                            </td>
                            <td class="text-center">
                                <div class="btn-group">
                                    <a href="{{ route('admin.accounts-finance.reconciliations.show', $reconciliation) }}" class="btn btn-sm btn-outline-secondary">{{ translate('view') }}</a>
                                    <form action="{{ route('admin.accounts-finance.reconciliations.destroy', $reconciliation) }}" method="POST" onsubmit="return confirm('{{ translate('are_you_sure') }}');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">{{ translate('delete') }}</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-5">{{ translate('no_reconciliations_found') }}</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                {{ $reconciliations->links() }}
            </div>
        </div>
    </div>
@endsection
