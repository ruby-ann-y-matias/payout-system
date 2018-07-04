<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Lava;
use App\Payout;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $wagePerJob = Lava::DataTable();
        $wagePerJob->addStringColumn('Job')
                ->addNumberColumn('Wage');

        $payouts = Payout::all();
        // dd($payout);
        foreach ($payouts as $payout) {
            $wagePerJob->addRow([
                $payout->job->job,
                $payout->wage
            ]);
        }
        // dd($wagePerJob);

        Lava::DonutChart('JobDonut', $wagePerJob, [
            'title' => 'Wage Distribution per Job'
        ]);

        // Lava::getScriptManager()->bypassLavaJsOutput();

        return view('home');
    }
}
