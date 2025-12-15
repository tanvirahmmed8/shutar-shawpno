@extends('layouts.back-end.app')
@section('title', translate('add_finance_journal'))
@section('content')
    <div class="content container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="h1 mb-0 text-capitalize">{{ translate('add_finance_journal') }}</h2>
                <p class="text-muted mb-0">{{ translate('capture_balanced_debit_credit_rows') }}</p>
            </div>
            <a href="{{ route('admin.accounts-finance.journals.index') }}" class="btn btn-outline-primary">
                <i class="tio-arrow-long-left"></i> {{ translate('back_to_journals') }}
            </a>
        </div>

        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin.accounts-finance.journals.store') }}" method="POST">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label">{{ translate('journal_number') }}</label>
                            <input type="text" name="journal_number" value="{{ old('journal_number') }}" class="form-control" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">{{ translate('entry_date') }}</label>
                            <input type="date" name="entry_date" value="{{ old('entry_date', now()->toDateString()) }}" class="form-control" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">{{ translate('fiscal_period') }}</label>
                            <select name="fiscal_period_id" class="form-select">
                                <option value="">{{ translate('select_period_optional') }}</option>
                                @foreach($periods as $period)
                                    <option value="{{ $period->id }}" {{ old('fiscal_period_id') == $period->id ? 'selected' : '' }}>
                                        {{ $period->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">{{ translate('currency') }}</label>
                            <input type="text" name="currency" value="{{ old('currency', config('app.currency', 'USD')) }}" class="form-control" maxlength="3" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">{{ translate('exchange_rate') }}</label>
                            <input type="number" step="0.0001" name="exchange_rate" value="{{ old('exchange_rate', 1) }}" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">{{ translate('category') }}</label>
                            <input type="text" name="category" value="{{ old('category') }}" class="form-control">
                        </div>
                        <div class="col-12">
                            <label class="form-label">{{ translate('memo') }}</label>
                            <textarea name="memo" class="form-control" rows="2">{{ old('memo') }}</textarea>
                        </div>
                    </div>

                    <hr class="my-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="mb-0">{{ translate('journal_lines') }}</h4>
                        <button type="button" class="btn btn-outline-primary" id="addJournalLine">{{ translate('add_row') }}</button>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-sm" id="journalLinesTable">
                            <thead class="bg-light">
                            <tr>
                                <th style="width: 35%">{{ translate('account') }}</th>
                                <th style="width: 15%">{{ translate('entry_type') }}</th>
                                <th style="width: 20%">{{ translate('amount') }}</th>
                                <th style="width: 25%">{{ translate('description') }}</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @for($i = 0; $i < max(2, old('lines') ? count(old('lines')) : 2); $i++)
                                <tr>
                                    <td>
                                        <select name="lines[{{ $i }}][account_id]" class="form-select" required>
                                            <option value="">{{ translate('select_account') }}</option>
                                            @foreach($accounts as $account)
                                                <option value="{{ $account->id }}" {{ old("lines.$i.account_id") == $account->id ? 'selected' : '' }}>
                                                    {{ $account->code }} - {{ $account->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <select name="lines[{{ $i }}][entry_type]" class="form-select" required>
                                            <option value="debit" {{ old("lines.$i.entry_type") === 'debit' ? 'selected' : '' }}>{{ translate('debit') }}</option>
                                            <option value="credit" {{ old("lines.$i.entry_type") === 'credit' ? 'selected' : '' }}>{{ translate('credit') }}</option>
                                        </select>
                                    </td>
                                    <td>
                                        <input type="number" name="lines[{{ $i }}][amount]" step="0.01" class="form-control" value="{{ old("lines.$i.amount") }}" required>
                                    </td>
                                    <td>
                                        <input type="text" name="lines[{{ $i }}][description]" class="form-control" value="{{ old("lines.$i.description") }}">
                                    </td>
                                    <td class="text-end">
                                        <button type="button" class="btn btn-link text-danger p-0 remove-line">{{ translate('remove') }}</button>
                                    </td>
                                </tr>
                            @endfor
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="btn btn--primary">{{ translate('save_journal') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('script_2')
<script>
    (function () {
        const tableBody = document.querySelector('#journalLinesTable tbody');
        const addButton = document.getElementById('addJournalLine');
        if (!tableBody || !addButton) {
            return;
        }

        addButton.addEventListener('click', () => {
            const index = tableBody.children.length;
            const template = `
                <tr>
                    <td>
                        <select name="lines[${index}][account_id]" class="form-select" required>
                            <option value="">{{ translate('select_account') }}</option>
                            @foreach($accounts as $account)
                                <option value="{{ $account->id }}">{{ $account->code }} - {{ $account->name }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <select name="lines[${index}][entry_type]" class="form-select" required>
                            <option value="debit">{{ translate('debit') }}</option>
                            <option value="credit">{{ translate('credit') }}</option>
                        </select>
                    </td>
                    <td>
                        <input type="number" name="lines[${index}][amount]" step="0.01" class="form-control" required>
                    </td>
                    <td>
                        <input type="text" name="lines[${index}][description]" class="form-control">
                    </td>
                    <td class="text-end">
                        <button type="button" class="btn btn-link text-danger p-0 remove-line">{{ translate('remove') }}</button>
                    </td>
                </tr>`;
            tableBody.insertAdjacentHTML('beforeend', template);
        });

        tableBody.addEventListener('click', (event) => {
            if (event.target.classList.contains('remove-line')) {
                const row = event.target.closest('tr');
                if (tableBody.children.length > 2) {
                    row.remove();
                }
            }
        });
    })();
</script>
@endpush
