<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Controllers\Services\PlanServices\DisplayPlanService as Display;
use Controllers\Services\AuthServices\AuthService as AuS;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    private $planService = null;

    public function __construct(Display $planService)
    {
        $this->middleware('auth');
        $this->planService = $planService;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $dayPlan = $this->planService->getDayPlan(\Illuminate\Support\Facades\Auth::id());
        //dd($dayPlan);
        return view('home')->with(["plan" => $dayPlan,
            'date' => \Illuminate\Support\Carbon::today()->toDateString(),
            "message" => "У вас не составлен план на день! Исправить это можно здесь",
            'day_status' => $this->planService->getDayStatus(\Illuminate\Support\Facades\Auth::id() ) ]
        );

    }

    public function displayTimetable()
    {

    }
}