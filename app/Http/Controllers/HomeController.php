<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\Pengeluaran;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $deposit = Transaksi::selectRaw('sum(saldo_deposit) as total')->where('waktu',date('Y-m-d'))->first();
        $pengeluaran = Pengeluaran::selectRaw('sum(nominal_biaya) as total')->where('waktu',date('Y-m-d'))->first();
        
        $deposit_bulanan = [];
        for($i = 0;$i<12; $i++){
            array_push($deposit_bulanan,0);
        }
        $getDeposit = Transaksi::selectRaw('month(waktu) as bulan')->selectRaw('sum(saldo_deposit) as total')
        ->whereRaw('year(waktu)',date('Y'))->groupBy(DB::raw('month(waktu)'))->orderBy('bulan')->get();
        if($getDeposit){
            foreach($getDeposit as $k => $dep){
                $deposit_bulanan[(int)$dep->bulan-1] = $dep->total;
            }
        }

        return view('home',compact('deposit','pengeluaran','deposit_bulanan'));
    }
}
