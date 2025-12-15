@extends('layouts.back-end.app')
@section('title', translate('edit_finance_journal'))
@section('content')
    <div class="content container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="h1 mb-0 text-capitalize">{{ translate('edit_finance_journal') }}</h2>
                <p class="text-muted mb-0">{{ translate('update_journal_lines_before_posting') }}</p>
            </div>
            <a href="{{ route('admin.accounts-finance.journals.index') }}" class="btn btn-outline-primary">
                <i class="tio-arrow-long-left"></i> {{ translate('back_to_journals') }}
            </a>
        </div>

        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin.accounts-finance.journals.update', $journal) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label">{{ translate('journal_number') }}</label>
                            <input type="text" name="journal_number" value="{{ old('journal_number', $journal->journal_number) }}" class="form-control" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">{{ translate('entry_date') }}</label>
                            <input type="date" name="entry_date" value="{{ old('entry_date', $journal->entry_date->toDateString()) }}" class="form-control" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">{{ translate('fiscal_period') }}</label>
                            <select name="fiscal_period_id" class="form-select">
                                <option value="">{{ translate('select_period_optional') }}</option>
                                @foreach($periods as $period)
                                    <option value="{{ $period->id }}" {{ old('fiscal_period_id', $journal->fiscal_period_id) == $period->id ? 'selected' : '' }}>
                                        {{ $period->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">{{ translate('currency') }}</label>
                            <input type="text" name="currency" value="{{ old('currency', $journal->currency) }}" class="form-control" maxlength="3" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">{{ translate('exchange_rate') }}</label>
                            <input type="number" step="0.0001" name="exchange_rate" value="{{ old('exchange_rate', $journal->exchange_rate) }}" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">{{ translate('category') }}</label>
                            <input type="text" name="category" value="{{ old('category', $journal->category) }}" class="form-control">
                        </div>
                        <div class="col-12">
                            <label class="form-label">{{ translate('memo') }}</label>
                            <textarea name="memo" class="form-control" rows="2">{{ old('memo', $journal->memo) }}</textarea>
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
                            @foreach(old('lines', $journal->rows->toArray()) as $index => $row)
                                <tr>
                                    <td>
                                        <select name="lines[{{ $index }}][account_id]" class="form-select" required>
                                            <option value="">{{ translate('select_account') }}</option>
                                            @foreach($accounts as $accountOption)
                                                <option value="{{ $accountOption->id }}"
                                                    {{ ($row['account_id'] ?? null) == $accountOption->id ? 'selected' : '' }}>
                                                    {{ $accountOption->code }} - {{ $accountOption->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <select name="lines[{{ $index }}][entry_type]" class="form-select" required>
                                            <option value="debit" {{ ($row['entry_type'] ?? 'debit') === 'debit' ? 'selected' : '' }}>{{ translate('debit') }}</option>
                                            <option value="credit" {{ ($row['entry_type'] ?? '') === 'credit' ? 'selected' : '' }}>{{ translate('credit') }}</option>
                                        </select>
                                    </td>
                                    <td>
                                        <input type="number" name="lines[{{ $index }}][amount]" step="0.01" class="form-control" value="{{ $row['amount'] ?? '' }}" required>
                                    </td>
                                    <td>
                                        <input type="text" name="lines[{{ $index }}][description]" class="form-control" value="{{ $row['description'] ?? '' }}">
                                    </td>
                                    <td class="text-end">
                                        <button type="button" class="btn btn-link text-danger p-0 remove-line">{{ translate('remove') }}</button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="btn btn--primary">{{ translate('update_journal') }}</button>
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
                            @foreach($accounts as $accountOption)
                                <option value="{{ $accountOption->id }}">{{ $accountOption->code }} - {{ $accountOption->name }}</option>
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
                if (tableBody.children.length > 2) {
                    event.target.closest('tr').remove();
                }
            }
        });
    })();
</script>
@endpush
