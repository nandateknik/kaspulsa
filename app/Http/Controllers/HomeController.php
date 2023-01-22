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
        return view('home',compact('deposit','pengeluaran'));
    }
}
