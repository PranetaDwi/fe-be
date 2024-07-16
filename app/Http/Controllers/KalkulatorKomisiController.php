<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\job;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KalkulatorKomisiController extends Controller
{
    public function index(){
        return view('dashboard');
    }

    public function create(){
        $employees = Employee::all();
        return view('kalkulatorForm', compact('employees'));
    }

    public function store(Request $request){
        $request->validate([
            'employee_id' => 'required',
            'period_job' => 'required',
            'amount' => 'required',
            'gross_profit' => 'required',
            'komisi' => 'required'
        ]);

        $job = new Job;
        $job->employee_id = $request->employee_id;
        $job->period_job = $request->period_job;
        $job->amount = $request->amount;
        $job->gross_profit = $request->gross_profit;
        $job->komisi = $request->komisi;
        $job->save();

        return redirect()->route('dashboard')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    public function getDataChart(){
        $chart_ones = Job::with('employee')
        ->select('employee_id', DB::raw('count(*) as count'))
        ->groupBy('employee_id')
        ->orderByDesc('count')
        ->get();

        $formattedChartOnes = $chart_ones->map(function ($item) {
            return [
                'employee_name' => $item->employee->name,
                'count' => $item->count,
            ];
        });

        $chart_twos = DB::table('jobs')
        ->select(DB::raw('DATE_FORMAT(period_job, "%Y-%m") as month'), DB::raw('SUM(gross_profit) as total_profit'))
        ->groupBy(DB::raw('DATE_FORMAT(period_job, "%Y-%m")'))
        ->get();

        $formattedChartTwos = $chart_twos->map(function ($item) {
            return [
                'month' => Carbon::createFromFormat('Y-m', $item->month)->format('F Y'),
                'total_profit' => $item->total_profit,
            ];
        });

        return response()->json(['chart_ones' => $formattedChartOnes, 'chart_twos' => $formattedChartTwos]);
    }
}