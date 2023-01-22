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

class ReportTransaksiController extends Controller
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
        $search = null != ($request->get('search')) ? $request->get('search') : '';

        $transaksi = Transaksi::
        join('pelanggan','pelanggan.id_pelanggan','=','transaksi.pelanggan_id')
        ->join('produk','produk.id_produk','=','transaksi.produk_id')
        ->whereBetween('waktu',["$tgl_mulai","$tgl_akhir"]);
        if($search != ''){
            
            $transaksi = $transaksi->where(function($queries) use ($search){
                $queries = $queries->where('nama_pelanggan','like','%'.$search.'%');    
                $transaksi = $queries->orWhere('nama_produk','like','%'.$search.'%');    
                $queries = $queries->orWhere('kode_produk','like','%'.$search.'%'); 
            });   
        }
        $transaksi = $transaksi->paginate(20);

        return view('report/report_transaksi',compact('transaksi','tgl_mulai','tgl_akhir','search'));
    }

}
