<?php

namespace App\Services\impl;

use App\Exceptions\ModelNotFoundException as ExceptionsModelNotFoundException;
use App\Http\Requests\Dashboard\StoreDashboardRequest;
use App\Http\Requests\Dashboard\UpdateDashboardRequest;
use App\Http\Resources\FiscalYear\FiscalYearResource;
use App\Http\Resources\Dashboard\DashboardCollection;
use App\Http\Resources\Dashboard\DashboardResource;
use App\Http\Resources\Fee\FeeCollection;
use App\Http\Resources\Fee\FeeResource;
use App\Models\FiscalYear;
use App\Models\Dashboard;
use App\Models\Expense;
use App\Models\Fee;
use App\Models\Rider;
use App\Models\User;
use App\Models\UserInitialValue;
use App\Models\Vehicle;
use App\Services\IDashboardService;
use DB;
use Exception;

class DashboardService implements IDashboardService
{
    protected $resourceLoader;

    public function __construct()
    {
        $this->resourceLoader = [];
    }

    public function getAll()
    {
        // $currentFiscalyear = FiscalYear::where('is_current', 1)->first();
        // $selectedFiscalyear = UserInitialValue::where('user_id', auth()->user()->id)
        //     ->whereIn('key', ['current_fiscal_year', 'fiscalYearId', 'fiscal_year_id', 'selectedFiscalYear'])
        //     ->first()->value;

        // if (!$selectedFiscalyear) {
        //     $selectedFiscalyear = $currentFiscalyear->name;
        // }

        // // $studentCount = User::where('user_type', 'student')->count();
        // // $teacherCount = User::where('user_type', 'teacher')->count();
        // // $totalRevenue = Fee::where('is_deleted',0)->sum('total_amount');
        // // $totalExpense = Expense::sum('total_amount');
        // $selectedFiscalYear = FiscalYear::where('name', $selectedFiscalyear)->first();
        // $riderCount = Rider::count();
        // $vehicleCount = Vehicle::count();
        // $totalRevenue =   Fee::where('is_deleted', 0)
        //     ->where('fiscal_year_id', $selectedFiscalYear->id)
        //     ->sum('total_amount');
        // $totalExpense = Expense::where('fiscal_year_id', $selectedFiscalYear->id)
        //     ->sum('total_amount');

        // $recentFees = Fee::with('rider')->where('is_deleted', 0)
        //     ->where('fiscal_year_id', $selectedFiscalYear->id)
        //     ->orderBy('created_at', 'desc')->take(5)->get();
        // $feesByMonth =Fee::selectRaw('
        //     MONTH(fee_date) as month,
        //     YEAR(fee_date) as year,
        //     SUM(total_amount) as total_amount
        // ')
        //         ->where('is_deleted', 0)
        //         ->where('fiscal_year_id', $selectedFiscalYear->id)
        //         ->groupBy(DB::raw('YEAR(fee_date), MONTH(fee_date)'))
        //         ->orderBy('year')
        //         ->orderBy('month')
        //         ->get();
        // $feesByMonth =   $feesByMonth->map(function ($item) {
        //     $item->month_name = date('M', mktime(0, 0, 0, $item->month, 1));
        //     return $item;
        // });

        return response()->json([
            'data' => [
                // 'riderCount' => $riderCount,
                // 'vehicleCount' => $vehicleCount,
                // 'totalRevenue' => $totalRevenue,
                // 'totalExpense' => $totalExpense,
                // // 'selectedSession' => FiscalYearResource::make($selectedFiscalYear),
                // // 'recentFees' =>  FeeCollection::make($recentFees),
                // 'feesByMonth' => $feesByMonth,
                'feesByDate'=>[]
            ],
            "status" => true,
            "code" => 200,
            "message" => "Record Fetched Successfully",
        ]);
    }

}
