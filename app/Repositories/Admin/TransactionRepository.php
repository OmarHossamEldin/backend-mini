<?php

namespace App\Repositories\Admin;

use App\Models\Transaction;

class TransactionRepository
{

    /**
     * List resources in the database
     *
     * @return array
     */
    public function list(): array
    {
        $transactions = Transaction::all()->toArray();
        return $transactions;
    }
    /**
     * Saves the resource in the database
     *
     * @param array $validatedData
     * @return object
     */
    public function create(array $validatedData): object
    {
        $transaction = Transaction::create($validatedData);
        return $transaction;
    }

    /**
     * Show Transaction with it's details
     *
     * @param object $transaction
     * @return object
     */
    public function get_details(object $transaction): object
    {
        $transaction = $transaction->load('category:id,name', 'subCategory:id,name');
        return $transaction;
    }

    /**
     * Updates the resource in the database
     *
     * @param array $validatedData
     * @param object $transaction
     * @return object
     */
    public function update(array $validatedData, object $transaction): object
    {
        $transaction->update($validatedData);
        return $transaction;
    }

    /**
     * Deletes the resource in the database
     *
     * @param object $transaction
     * @return string
     */
    public function delete(object $transaction): int
    {
        $transaction->delete();
        return $transaction->id;
    }
}
