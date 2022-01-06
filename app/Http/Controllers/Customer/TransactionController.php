<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Helpers\JsonResponse;
use App\Repositories\Customer\TransactionRepository;
class TransactionController extends Controller
{
    /**
     * return user (customer) owen transactions function
     *
     * @param TransactionRepository $transactionRepository
     * @return JsonResponse
     */
    public function index(TransactionRepository $transactionRepository)
    {
        $transactions = $transactionRepository->list();

        return JsonResponse::response(data: ['transactions' => $transactions], statusCode: 200);
    }
}
