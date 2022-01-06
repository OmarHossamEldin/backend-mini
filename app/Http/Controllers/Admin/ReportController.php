<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Report\GenerateRequest;
use App\Repositories\Admin\ReportRepository;

class ReportController extends Controller
{
    /**
     * generate the report
     *
     * @param GenerateRequest $request
     * @param ReportRepository $reportRepository
     * @return void
     */
    public function generate_report(GenerateRequest $request, ReportRepository $reportRepository)
    {
        $report = $reportRepository->generate($request->validated());

        return JsonResponse::response(data: ['report' => $report], statusCode: 200);
    }
}
