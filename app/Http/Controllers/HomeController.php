<?php

namespace App\Http\Controllers;

use App\Models\Transactions;
use Illuminate\Http\Request;

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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $income = Transactions::where('transaction_status', 'SUCCESS')->sum('transaction_total');
        $sales  = Transactions::count();
        $datas  = Transactions::orderBy('id', 'DESC')->take(5)->get();
        $pie    = [
            'pending' => Transactions::where('transaction_status', 'PENDING')->count(),
            'success' => Transactions::where('transaction_status', 'SUCCESS')->count(),
            'failed' => Transactions::where('transaction_status', 'FAILED')->count(),
        ];

        return view('pages.dash', [
            'income'=>$income,
            'sales'=>$sales,
            'datas'=>$datas,
            'pie'=>$pie,
        ]);
    }
}
