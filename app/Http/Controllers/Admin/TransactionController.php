<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\Transaction\StoreRequest;
use App\Http\Requests\Admin\Transaction\UpdateRequest;
use App\Repositories\Admin\TransactionRepository;
use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Helpers\JsonResponse;
use Lang;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param TransactionRepository $transactionRepository
     * @return JsonResponse
     */
    public function index(TransactionRepository $transactionRepository)
    {
        $transactions = $transactionRepository->list();

        return JsonResponse::response(data: ['transactions' => $transactions], statusCode: 200);
    }

    /**
     * store a newly created resource in storage
     *
     * @param StoreRequest $request
     * @param TransactionRepository $transactionRepository
     * @return JsonResponse
     */
    public function store(StoreRequest $request, TransactionRepository $transactionRepository)
    {
        $transaction = $transactionRepository->create($request->validated());

        return JsonResponse::response(message: Lang::get('db.success'), data: ['transaction' => $transaction], statusCode: 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  Transaction  $transaction
     * @param TransactionRepository $transactionRepository 
     * @return JsonResponse
     */
    public function show(Transaction $transaction, TransactionRepository $transactionRepository)
    {
        $transaction = $transactionRepository->get_details($transaction);

        return JsonResponse::response(data: ['transaction' => $transaction], statusCode: 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateRequest $request
     * @param  Transaction  $transaction
     * @param TransactionRepository $transactionRepository
     * @return JsonResponse
     */
    public function update(UpdateRequest  $request, Transaction $transaction, TransactionRepository $transactionRepository)
    {
        $transaction = $transactionRepository->update($request->validated(), $transaction);

        return JsonResponse::response(message: Lang::get('db.success'), data: ['transaction' => $transaction], statusCode: 206);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Transaction $transaction
     * @param TransactionRepository $transactionRepository
     * @return JsonResponse
     */
    public function destroy(Transaction $transaction, TransactionRepository $transactionRepository)
    {
        $result = $transactionRepository->delete($transaction);
        return $result ? JsonResponse::response(message: Lang::get('db.success'), statusCode: 200) : 'error';
    }
}
