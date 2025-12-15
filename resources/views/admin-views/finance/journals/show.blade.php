@extends('layouts.back-end.app')
@section('title', translate('journal_details'))
@section('content')
    <div class="content container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="h1 mb-0 text-capitalize">{{ translate('journal_details') }}</h2>
                <p class="text-muted mb-0">{{ translate('review_balanced_rows_and_metadata') }}</p>
            </div>
            <a href="{{ route('admin.accounts-finance.journals.index') }}" class="btn btn-outline-primary">
                <i class="tio-arrow-long-left"></i> {{ translate('back_to_journals') }}
            </a>
        </div>

        <div class="card mb-4">
            <div class="card-body row g-3">
                <div class="col-md-3">
                    <h6 class="text-muted text-uppercase">{{ translate('journal_number') }}</h6>
                    <p class="h5 mb-0">{{ $journal->journal_number }}</p>
                </div>
                <div class="col-md-3">
                    <h6 class="text-muted text-uppercase">{{ translate('entry_date') }}</h6>
                    <p class="h5 mb-0">{{ $journal->entry_date->format('M d, Y') }}</p>
                </div>
                <div class="col-md-3">
                    <h6 class="text-muted text-uppercase">{{ translate('status') }}</h6>
                    <span class="badge badge-soft-{{ $journal->status === 'posted' ? 'success' : 'secondary' }} text-uppercase">
                        {{ translate($journal->status) }}
                    </span>
                </div>
                <div class="col-md-3">
                    <h6 class="text-muted text-uppercase">{{ translate('fiscal_period') }}</h6>
                    <p class="mb-0">{{ $journal->fiscalPeriod->name ?? translate('unassigned') }}</p>
                </div>
                <div class="col-12">
                    <h6 class="text-muted text-uppercase">{{ translate('memo') }}</h6>
                    <p class="mb-0">{{ $journal->memo ?? translate('not_provided') }}</p>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title mb-0">{{ translate('journal_lines') }}</h4>
                <div>
                    <span class="badge bg-soft-info">{{ translate('total_lines') }}: {{ $journal->rows->count() }}</span>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-striped mb-0">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>{{ translate('account') }}</th>
                        <th>{{ translate('type') }}</th>
                        <th class="text-end">{{ translate('amount') }}</th>
                        <th>{{ translate('description') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($journal->rows as $row)
                        <tr>
                            <td>{{ $row->line_number }}</td>
                            <td>{{ $row->account->code ?? '' }} - {{ $row->account->name ?? translate('account_removed') }}</td>
                            <td class="text-capitalize">{{ $row->entry_type }}</td>
                            <td class="text-end">{{ number_format($row->amount, 2) }} {{ $journal->currency }}</td>
                            <td>{{ $row->description }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
