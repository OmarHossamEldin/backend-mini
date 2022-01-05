<?php

namespace App\Repositories\Admin;

use App\Models\RecordPayment;

class RecordPaymentRepository
{

    /**
     * List resources in the database
     *
     * @return array
     */
    public function list(): array
    {
        $recordPayments = RecordPayment::all()->toArray();
        return $recordPayments;
    }
    /**
     * Saves the resource in the database
     *
     * @param array $validatedData
     * @return object
     */
    public function create(array $validatedData): object
    {
        $recordPayment = RecordPayment::create($validatedData);
        return $recordPayment;
    }

    /**
     * Show RecordPayment with it's details
     *
     * @param object $recordPayment
     * @return object
     */
    public function get_details(object $recordPayment): object
    {
        $recordPayment = $recordPayment->load('transaction');
        return $recordPayment;
    }

    /**
     * Updates the resource in the database
     *
     * @param array $validatedData
     * @param object $recordPayment
     * @return object
     */
    public function update(array $validatedData, object $recordPayment): object
    {
        $recordPayment->update($validatedData);
        return $recordPayment;
    }

    /**
     * Deletes the resource in the database
     *
     * @param object $recordPayment
     * @return string
     */
    public function delete(object $recordPayment): int
    {
        $recordPayment->delete();
        return $recordPayment->id;
    }
}
