<?php

namespace App\Repositories\Admin;

use App\Models\Transaction;
use Carbon\CarbonPeriod;

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
        $periods = CarbonPeriod::create($validatedData['start_date'], '1 month', $validatedData['end_date'])->toArray();
        foreach ($periods as &$period) {
            $paidAmount = Transaction::withSum('recordPayments', 'amount')
                ->whereBetween('due_on', $validatedData)
                ->where('status', 'paid')
                ->get()->reduce(fn ($carry, $transaction) => $carry + $transaction['record_payments_sum_amount']);
            $outStandingAmount = Transaction::whereBetween('due_on', $validatedData)
                ->where('status', 'outstanding')->sum('amount');

            $overDueAmount = Transaction::whereBetween('due_on', $validatedData)
                ->where('status', 'overdue')->sum('amount');

            $period = [
                'month' =>  $period->month,
                'year' =>  $period->year,
                'paid' => $paidAmount,
                'outstanding' => $outStandingAmount,
                'overdue' => $overDueAmount,
            ];
        }
        unset($period);

        return $periods;
    }
}
