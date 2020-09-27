<?php
/**
 * Created by PhpStorm.
 * User: Vlad
 * Date: 13.09.2020
 * Time: 6:29
 */

namespace App\Http\Controllers;


use Controllers\Services\PlanServices\DisplayPlanService as PlanService;
use Controllers\Services\PlanServices\DayInfoService;

class HistController
{
    private $planService;
    private $dayInfoService;

    public function __construct(PlanService $planService,
                                DayInfoService $dayInfoService)
    {
        $this->planService    = $planService;
        $this->dayInfoService = $dayInfoService;
    }

    public function index()
    {
        $id = \Illuminate\Support\Facades\Auth::id();
        $result = $this->planService->getAllPlansOfUser($id);

        return response()->json([
            'message' => "План на день успешно сформирован. Желаю удачи в работе!",
            "decoration" => "alert alert-success"
        ]);
    }
} 