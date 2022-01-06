<?php

namespace App\Repositories\Customer;


class TransactionRepository
{

    /**
     * List resources in the database
     *
     * @return array
     */
    public function list(): array
    {
        $transactions = auth()->user()->load('transactions')->toArray()['transactions'];
        return $transactions;
    }

}
