<?php

namespace App\Repositories\Admin;

use App\Models\Transaction;

class ReportRepository
{
    /**
     * generate the report 
     *
     * @param array $validatedData
     * @return array
     */
    public function generate(array $validatedData): array
    {
        $paidAmount = Transaction::withSum('recordPayments', 'amount')
            ->whereBetween('due_on', $validatedData)
            ->where('status', 'paid')
            ->get()->reduce(fn ($carry, $transaction) => $carry + $transaction['record_payments_sum_amount']);

        $outStandingAmount = Transaction::whereBetween('due_on', $validatedData)
            ->where('status', 'outstanding')->sum('amount');

        $overDueAmount = Transaction::whereBetween('due_on', $validatedData)
            ->where('status', 'overdue')->sum('amount');


        $period = implode(' - ', $validatedData);

        $report = [
            'period' => $period,
            'paidAmount' => $paidAmount,
            'outStandingAmount' => $outStandingAmount,
            'overDueAmount' => $overDueAmount,
        ];
        return $report;
    }
}
