<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\Bank;
use App\Models\Kas;
use App\Models\Pengeluaran;
use App\Models\Pelanggan;
use App\Models\Produk;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Log;

class ReportSaldoAkhirController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $tgl_mulai = null != ($request->get('tgl_awal')) ? $request->get('tgl_awal') : date('Y-m-d');
        $tgl_akhir = null != ($request->get('tgl_akhir')) ? $request->get('tgl_akhir') : date('Y-m-d');
        $bank = null != ($request->get('bank')) ? $request->get('bank') : '';
        $list_bank = Bank::all();

        $kasbank = Bank::select('bank.nama_bank','bank.nama_rekening','bank.no_rekening','kas.kas_awal','kas.tanggal')
        ->selectRaw('ifnull(sum(saldo_deposit),0) as deposit')
        ->join('kas','bank.id_bank','=','kas.bank_id')
        ->leftJoin('transaksi', function($join)
        {
            $join->on('transaksi.bank_id','=','kas.bank_id');
            $join->on('transaksi.waktu','=','kas.tanggal');
        })
        ->whereBetween('kas.tanggal',["$tgl_mulai","$tgl_akhir"])
        ->where('kas.bank_id',$bank)
        ->groupBy(['kas.tanggal','nama_bank','nama_rekening','no_rekening','kas_awal'])->paginate(20);

        /** Pengeluaran */
        $pengeluaran = Pengeluaran::select('waktu')
        ->selectRaw('ifnull(sum(nominal_biaya),0) as total')
        ->whereBetween('waktu',["$tgl_mulai","$tgl_akhir"])
        ->groupBy(['waktu'])->get();

        return view('report/report_saldoakhir',compact('pengeluaran','kasbank','tgl_mulai','tgl_akhir','list_bank','bank','list_bank'));
    }

}
