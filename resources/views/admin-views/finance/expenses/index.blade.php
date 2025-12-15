@extends('layouts.back-end.app')
@section('title', translate('finance_expenses'))
@section('content')
    <div class="content container-fluid">
        <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
            <div>
                <h2 class="h1 mb-0 text-capitalize">{{ translate('finance_expenses') }}</h2>
                <p class="text-muted mb-0">{{ translate('track_non_inventory_spend_and_requests') }}</p>
            </div>
            <a href="{{ route('admin.accounts-finance.expenses.create') }}" class="btn btn--primary">
                <i class="tio-add"></i> {{ translate('add_expense') }}
            </a>
        </div>

        <div class="card mb-4">
            <div class="card-body">
                <form action="{{ route('admin.accounts-finance.expenses.index') }}" method="GET" class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label">{{ translate('search') }}</label>
                        <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="{{ translate('search_by_number_or_purpose') }}">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">{{ translate('status') }}</label>
                        <select name="status" class="form-select">
                            <option value="">{{ translate('all_status') }}</option>
                            @foreach($statuses as $status)
                                <option value="{{ $status }}" {{ $statusFilter === $status ? 'selected' : '' }}>{{ translate($status) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2 d-flex align-items-end">
                        <button type="submit" class="btn btn--primary w-100">{{ translate('filter') }}</button>
                    </div>
                    <div class="col-md-3 d-flex align-items-end">
                        <a href="{{ route('admin.accounts-finance.expenses.index') }}" class="btn btn-outline-secondary w-100">{{ translate('reset') }}</a>
                    </div>
                </form>
            </div>
        </div>

        <div class="card">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                    <tr>
                        <th>{{ translate('expense_number') }}</th>
                        <th>{{ translate('expense_date') }}</th>
                        <th>{{ translate('account') }}</th>
                        <th class="text-end">{{ translate('amount') }}</th>
                        <th>{{ translate('status') }}</th>
                        <th class="text-center">{{ translate('actions') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($expenses as $expense)
                        <tr>
                            <td>{{ $expense->expense_number }}</td>
                            <td>{{ optional($expense->expense_date)->format('M d, Y') ?? translate('not_set') }}</td>
                            <td>{{ $expense->account->code ?? translate('unassigned') }} - {{ $expense->account->name ?? '' }}</td>
                            <td class="text-end">{{ number_format($expense->amount, 2) }} {{ $expense->currency }}</td>
                            <td>
                                <span class="badge badge-soft-{{ $expense->status === 'approved' ? 'success' : 'secondary' }} text-uppercase">
                                    {{ translate($expense->status) }}
                                </span>
                            </td>
                            <td class="text-center">
                                <div class="btn-group" role="group">
                                    <a href="{{ route('admin.accounts-finance.expenses.show', $expense) }}" class="btn btn-sm btn-outline-secondary">{{ translate('view') }}</a>
                                    @if($expense->status !== 'approved')
                                        <a href="{{ route('admin.accounts-finance.expenses.edit', $expense) }}" class="btn btn-sm btn-outline-primary">{{ translate('edit') }}</a>
                                        <form action="{{ route('admin.accounts-finance.expenses.destroy', $expense) }}" method="POST" onsubmit="return confirm('{{ translate('are_you_sure') }}');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger">{{ translate('delete') }}</button>
                                        </form>
                                        <form action="{{ route('admin.accounts-finance.expenses.approve', $expense) }}" method="POST" onsubmit="return confirm('{{ translate('confirm_mark_expense_approved') }}');">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-outline-success">{{ translate('approve') }}</button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-5">{{ translate('no_expenses_found') }}</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                {{ $expenses->links() }}
            </div>
        </div>
    </div>
@endsection
