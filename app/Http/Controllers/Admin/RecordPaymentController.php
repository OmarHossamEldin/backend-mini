<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\RecordPayment\StoreRequest;
use App\Http\Requests\Admin\RecordPayment\UpdateRequest;
use App\Repositories\Admin\RecordPaymentRepository;
use App\Http\Controllers\Controller;
use App\Models\RecordPayment;
use App\Helpers\JsonResponse;
use Lang;

class RecordPaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param RecordPaymentRepository $recordPaymentRepository
     * @return JsonResponse
     */
    public function index(RecordPaymentRepository $recordPaymentRepository)
    {
        $recordPayment = $recordPaymentRepository->list();

        return JsonResponse::response(data: ['recordPayment' => $recordPayment], statusCode: 200);
    }

    /**
     * store a newly created resource in storage
     *
     * @param StoreRequest $request
     * @param RecordPaymentRepository $recordPaymentRepository
     * @return JsonResponse
     */
    public function store(StoreRequest $request, RecordPaymentRepository $recordPaymentRepository)
    {
        $recordPayment = $recordPaymentRepository->create($request->validated());

        return JsonResponse::response(message: Lang::get('db.success'), data: ['recordPayment' => $recordPayment], statusCode: 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  RecordPayment  $recordPayment
     * @param RecordPaymentRepository $recordPaymentRepository
     * @return JsonResponse
     */
    public function show(RecordPayment $recordPayment, RecordPaymentRepository $recordPaymentRepository)
    {
        $recordPayment = $recordPaymentRepository->get_details($recordPayment);

        return JsonResponse::response(data: ['recordPayment' => $recordPayment], statusCode: 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateRequest $request
     * @param  RecordPayment  $recordPayment
     * @param RecordPaymentRepository $recordPaymentRepository
     * @return JsonResponse
     */
    public function update(UpdateRequest  $request, RecordPayment $recordPayment, RecordPaymentRepository $recordPaymentRepository)
    {
        $recordPayment = $recordPaymentRepository->update($request->validated(), $recordPayment);

        return JsonResponse::response(message: Lang::get('db.success'), data: ['recordPayment' => $recordPayment], statusCode: 206);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  RecordPayment $recordPayment
     * @param RecordPaymentRepository $recordPaymentRepository
     * @return JsonResponse
     */
    public function destroy(RecordPayment $recordPayment, RecordPaymentRepository $recordPaymentRepository)
    {
        $result = $recordPaymentRepository->delete($recordPayment);
        return $result ? JsonResponse::response(message: Lang::get('db.success'), statusCode: 200) : 'error';
    }
}
