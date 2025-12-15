<?php

namespace App\Http\Controllers\Admin\Finance;

use App\Contracts\Repositories\BusinessSettingRepositoryInterface;
use App\Enums\ViewPaths\Admin\AccountsFinance;
use App\Http\Controllers\BaseController;
use App\Support\PaymentAccountMapper;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Validation\ValidationException;

class PaymentAccountMappingController extends BaseController
{
    public function __construct(
        private readonly BusinessSettingRepositoryInterface $businessSettingRepo,
    ) {
    }

    public function edit(): View
    {
        $methods = PaymentAccountMapper::methods();
        $accounts = PaymentAccountMapper::accounts();

        return view(AccountsFinance::PAYMENT_MAPPINGS_EDIT[VIEW], [
            'methods' => $methods,
            'accounts' => $accounts,
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        $methods = PaymentAccountMapper::methods();
        $accounts = PaymentAccountMapper::accounts();
        $methodKeys = array_values(array_filter(array_keys($methods), fn ($key) => $key !== 'default'));
        $payload = $request->input('methods', []);
        $normalized = [];

        foreach ($methodKeys as $methodKey) {
            $methodInput = $payload[$methodKey] ?? null;
            if (!$methodInput) {
                throw ValidationException::withMessages([
                    "methods.$methodKey.accounts" => translate('please_select_at_least_one_account'),
                ]);
            }

            $selectedAccounts = array_values(array_unique(array_filter(
                Arr::wrap($methodInput['accounts'] ?? []),
                fn ($accountKey) => isset($accounts[$accountKey])
            )));

            if (empty($selectedAccounts)) {
                throw ValidationException::withMessages([
                    "methods.$methodKey.accounts" => translate('please_select_at_least_one_account'),
                ]);
            }

            $defaultAccount = $methodInput['default_account'] ?? null;
            if (!$defaultAccount || !in_array($defaultAccount, $selectedAccounts, true)) {
                throw ValidationException::withMessages([
                    "methods.$methodKey.default_account" => translate('please_select_a_default_account'),
                ]);
            }

            $normalized[$methodKey] = [
                'accounts' => $selectedAccounts,
                'default_account' => $defaultAccount,
            ];
        }

        $this->businessSettingRepo->updateOrInsert('payment_account_mapping', json_encode([
            'methods' => $normalized,
        ]));

        PaymentAccountMapper::refresh();

        Toastr::success(translate('payment_account_mapping_updated_successfully'));
        return back();
    }
}
