@extends('layouts.back-end.app')
@section('title', translate('expense_details'))
@section('content')
    <div class="content container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="h1 mb-0 text-capitalize">{{ translate('expense_details') }}</h2>
                <p class="text-muted mb-0">{{ translate('review_the_supporting_information_before_posting') }}</p>
            </div>
            <a href="{{ route('admin.accounts-finance.expenses.index') }}" class="btn btn-outline-primary">
                <i class="tio-arrow-long-left"></i> {{ translate('back_to_expenses') }}
            </a>
        </div>

        <div class="row g-4">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-4">
                                <h6 class="text-muted text-uppercase">{{ translate('expense_number') }}</h6>
                                <p class="h5 mb-0">{{ $expense->expense_number }}</p>
                            </div>
                            <div class="col-md-4">
                                <h6 class="text-muted text-uppercase">{{ translate('status') }}</h6>
                                <span class="badge badge-soft-{{ $expense->status === 'approved' ? 'success' : 'secondary' }} text-uppercase">{{ translate($expense->status) }}</span>
                            </div>
                            <div class="col-md-4">
                                <h6 class="text-muted text-uppercase">{{ translate('expense_date') }}</h6>
                                <p class="mb-0">{{ optional($expense->expense_date)->format('M d, Y') ?? translate('not_set') }}</p>
                            </div>
                            <div class="col-md-6">
                                <h6 class="text-muted text-uppercase">{{ translate('account') }}</h6>
                                <p class="mb-0">{{ $expense->account->code ?? translate('unassigned') }} - {{ $expense->account->name ?? '' }}</p>
                            </div>
                            <div class="col-md-6">
                                <h6 class="text-muted text-uppercase">{{ translate('amount') }}</h6>
                                <p class="mb-0 h4">{{ number_format($expense->amount, 2) }} {{ $expense->currency }}</p>
                            </div>
                            <div class="col-md-6">
                                <h6 class="text-muted text-uppercase">{{ translate('category') }}</h6>
                                <p class="mb-0">{{ $expense->category ?? translate('not_provided') }}</p>
                            </div>
                            <div class="col-md-6">
                                <h6 class="text-muted text-uppercase">{{ translate('exchange_rate') }}</h6>
                                <p class="mb-0">{{ $expense->exchange_rate ?? 1 }}</p>
                            </div>
                            <div class="col-md-6">
                                <h6 class="text-muted text-uppercase">{{ translate('payee_type') }}</h6>
                                <p class="mb-0">{{ $expense->payee_type ?? translate('not_provided') }}</p>
                            </div>
                            <div class="col-md-6">
                                <h6 class="text-muted text-uppercase">{{ translate('payee_id') }}</h6>
                                <p class="mb-0">{{ $expense->payee_id ?? translate('not_provided') }}</p>
                            </div>
                            <div class="col-12">
                                <h6 class="text-muted text-uppercase">{{ translate('purpose') }}</h6>
                                <p class="mb-0">{{ $expense->purpose ?? translate('not_provided') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="mb-3">{{ translate('approval_activity') }}</h5>
                        <ul class="list-unstyled mb-0">
                            <li class="mb-2"><strong>{{ translate('submitted_by') }}:</strong> {{ $expense->submitter->name ?? translate('system') }}</li>
                            <li class="mb-2"><strong>{{ translate('reviewed_by') }}:</strong> {{ $expense->reviewer->name ?? translate('pending') }}</li>
                            <li class="mb-2"><strong>{{ translate('approved_by') }}:</strong> {{ $expense->approver->name ?? translate('pending') }}</li>
                            <li class="mb-2"><strong>{{ translate('approved_at') }}:</strong> {{ optional($expense->approved_at)->format('M d, Y H:i') ?? translate('pending') }}</li>
                        </ul>
                    </div>
                </div>

                @if($expense->status !== 'approved')
                    <div class="card">
                        <div class="card-body">
                            <h5 class="mb-3">{{ translate('approve_or_update_status') }}</h5>
                            @php($statusOptions = ['draft', 'submitted', 'approved', 'rejected'])
                            <form action="{{ route('admin.accounts-finance.expenses.approve', $expense) }}" method="POST" class="row g-3">
                                @csrf
                                <div class="col-12">
                                    <label class="form-label">{{ translate('status') }}</label>
                                    <select name="status" class="form-select">
                                        <option value="approved">{{ translate('approved') }}</option>
                                        @foreach($statusOptions as $status)
                                            @if($status !== 'approved')
                                                <option value="{{ $status }}">{{ translate($status) }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-12">
                                    <label class="form-label">{{ translate('link_journal_optional') }}</label>
                                    <input type="number" name="journal_id" value="{{ old('journal_id', $expense->journal_id) }}" class="form-control" placeholder="{{ translate('enter_journal_id') }}">
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn--primary w-100">{{ translate('update_status') }}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                @else
                    <div class="card">
                        <div class="card-body text-center">
                            <i class="tio-checkmark-circle-outlined display-4 text-success mb-3"></i>
                            <p class="mb-0">{{ translate('expense_is_approved_and_locked') }}</p>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
