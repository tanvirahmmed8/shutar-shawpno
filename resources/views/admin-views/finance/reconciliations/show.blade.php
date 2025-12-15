@extends('layouts.back-end.app')
@section('title', translate('reconciliation_details'))
@section('content')
    <div class="content container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="h1 mb-0 text-capitalize">{{ translate('reconciliation_details') }}</h2>
                <p class="text-muted mb-0">{{ translate('match_statement_rows_to_journal_entries') }}</p>
            </div>
            <a href="{{ route('admin.accounts-finance.reconciliations.index') }}" class="btn btn-outline-primary">
                <i class="tio-arrow-long-left"></i> {{ translate('back_to_reconciliations') }}
            </a>
        </div>

        <div class="card mb-4">
            <div class="card-body row g-3">
                <div class="col-md-4">
                    <h6 class="text-muted text-uppercase">{{ translate('statement_name') }}</h6>
                    <p class="h5 mb-0">{{ $reconciliation->statement_name }}</p>
                </div>
                <div class="col-md-4">
                    <h6 class="text-muted text-uppercase">{{ translate('account') }}</h6>
                    <p class="mb-0">{{ $reconciliation->account->code ?? '' }} - {{ $reconciliation->account->name ?? '' }}</p>
                </div>
                <div class="col-md-4">
                    <h6 class="text-muted text-uppercase">{{ translate('status') }}</h6>
                    <span class="badge badge-soft-info text-uppercase">{{ translate($reconciliation->status) }}</span>
                </div>
                <div class="col-md-4">
                    <h6 class="text-muted text-uppercase">{{ translate('statement_date') }}</h6>
                    <p class="mb-0">{{ optional($reconciliation->statement_date)->format('M d, Y') }}</p>
                </div>
                <div class="col-md-4">
                    <h6 class="text-muted text-uppercase">{{ translate('matched') }}</h6>
                    <p class="mb-0">{{ $reconciliation->matched_row_count }} / {{ $reconciliation->statement_row_count }}</p>
                </div>
                <div class="col-12">
                    <h6 class="text-muted text-uppercase">{{ translate('notes') }}</h6>
                    <p class="mb-0">{{ $reconciliation->notes ?? translate('not_provided') }}</p>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">{{ translate('statement_rows') }}</h4>
            </div>
            <div class="table-responsive">
                <table class="table align-middle mb-0">
                    <thead class="bg-light">
                    <tr>
                        <th>{{ translate('date') }}</th>
                        <th>{{ translate('description') }}</th>
                        <th>{{ translate('reference') }}</th>
                        <th class="text-end">{{ translate('amount') }}</th>
                        <th>{{ translate('match_status') }}</th>
                        <th class="text-center">{{ translate('actions') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($reconciliation->rows as $row)
                        <tr>
                            <td>{{ optional($row->transaction_date)->format('M d, Y') }}</td>
                            <td>{{ $row->description }}</td>
                            <td>{{ $row->reference }}</td>
                            <td class="text-end">{{ number_format($row->amount, 2) }} {{ $reconciliation->account->currency ?? \App\Utils\Helpers::currency_code() }}</td>
                            <td class="text-capitalize">{{ $row->match_status }}</td>
                            <td class="text-center">
                                @if($row->match_status === 'matched')
                                    <form action="{{ route('admin.accounts-finance.reconciliations.rows.unmatch', [$reconciliation, $row]) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-sm btn-outline-warning">{{ translate('unmatch') }}</button>
                                    </form>
                                @else
                                    <form action="{{ route('admin.accounts-finance.reconciliations.rows.match', [$reconciliation, $row]) }}" method="POST" class="d-flex gap-2">
                                        @csrf
                                        <select name="journal_row_id" class="form-select form-select-sm" required>
                                            <option value="">{{ translate('select_journal_row') }}</option>
                                            @foreach($matchableRows as $journalRow)
                                                <option value="{{ $journalRow->id }}">
                                                    #{{ $journalRow->journal_id }} - {{ number_format($journalRow->amount, 2) }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <button type="submit" class="btn btn-sm btn-outline-success">{{ translate('match') }}</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
