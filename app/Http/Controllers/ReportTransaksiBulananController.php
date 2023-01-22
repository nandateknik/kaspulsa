<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\Bank;
use App\Models\Kas;
use App\Models\Pelanggan;
use App\Models\Produk;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Log;

class ReportTransaksiBulananController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $tahun   = $request->get('tahun') != null ? $request->get('tahun') : date('Y');
        $list_tahun = Transaksi::selectRaw('distinct(year(waktu)) as tahun')->get();
        $search = null != ($request->get('search')) ? $request->get('search') : '';

        $transaksi = Transaksi::
        selectRaw("date_format(concat('$tahun-',month(waktu),'-01'),'%M %Y') as periode")
        ->selectRaw('sum(saldo_deposit) as saldo_deposit')->whereRaw("year(waktu) = $tahun")
        ->groupBy(DB::raw("date_format(concat('$tahun-',month(waktu),'-01'),'%M %Y')"))
        ->paginate(20);

        return view('report/report_transaksi_bulanan',compact('transaksi','tahun','list_tahun'));
    }

}
