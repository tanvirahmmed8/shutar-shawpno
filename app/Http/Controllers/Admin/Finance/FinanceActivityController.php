<?php

namespace App\Http\Controllers\Admin\Finance;

use App\Http\Controllers\BaseController;
use App\Services\Finance\FinanceTransactionService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FinanceActivityController extends BaseController
{
    public function __construct(private readonly FinanceTransactionService $transactionService)
    {
    }

    public function store(Request $request): JsonResponse
    {
        $data = $this->validateRequest($request);
        $journal = $this->transactionService->record($data['event_key'], $data['payload'], $data['context']);

        return response()->json([
            'journal_id' => $journal->id,
            'journal_number' => $journal->journal_number,
            'status' => $journal->status,
        ], 201);
    }

    public function preview(Request $request): JsonResponse
    {
        $data = $this->validateRequest($request);
        $preview = $this->transactionService->preview($data['event_key'], $data['payload'], $data['context']);

        return response()->json($preview);
    }

    private function validateRequest(Request $request): array
    {
        $validated = $request->validate([
            'event_key' => ['required', 'string'],
            'payload' => ['required', 'array'],
            'context' => ['nullable', 'array'],
        ]);

        return [
            'event_key' => $validated['event_key'],
            'payload' => $validated['payload'],
            'context' => $validated['context'] ?? [],
        ];
    }
}
