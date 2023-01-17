<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\Pelanggan;
use App\Models\Produk;
use Illuminate\Support\Facades\DB;
use Log;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transaksi = Transaksi::with('pelanggan')->paginate(20);
        return view('transaksi/data',compact('transaksi'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $action = '/transaksi';
        $action_method = 'POST';
        $pelanggan = Pelanggan::all();
        $produk = Produk::all();
        return view('transaksi/input',compact('action','action_method','pelanggan','produk'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $transaksi = new Transaksi;
            $transaksi->pelanggan_id = $request->pelanggan_id;
            $transaksi->produk_id = $request->produk_id;
            $transaksi->jenis_payment = $request->jenis_payment;
            $transaksi->saldo_akhir = $request->saldo_akhir;
            $transaksi->waktu = $request->waktu;
            $transaksi->save();
            DB::commit();
            // all good
            return redirect ('/transaksi')->with('success', 'Transaksi berhasil ditambahkan.');
        } catch (\Exception $e) {
            DB::rollback();
            // something went wrong
            Log::debug('Transaksi store rollback '.$e->getMessage());
            return redirect()->back()->withInput()->withErrors(['Terjadi kesalahan saat simpan, silahkan coba kembali.']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $transaksi = Transaksi::with('pelanggan')->find($id);
        if($transaksi){
            $pelanggan = Pelanggan::all();
            $produk = Produk::all();
            $action = '/transaksi/'.$transaksi->id_transaksi;
            $action_method = 'PUT';
            return view('transaksi/input',compact('transaksi','action','action_method','pelanggan','produk'));
        }else{
            return redirect()->back()->withErrors(['Transaksi tidak ditemukan.']);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $transaksi = Transaksi::find($id);
        if($transaksi){ 
            DB::beginTransaction();
            try {
                $transaksi->pelanggan_id = $request->pelanggan_id;
                $transaksi->produk_id = $request->produk_id;
                $transaksi->jenis_payment = $request->jenis_payment;
                $transaksi->saldo_akhir = $request->saldo_akhir;
                $transaksi->waktu = $request->waktu;
                $transaksi->save();

                DB::commit();
                // all good
                return redirect ('/transaksi')->with('success', 'Transaksi berhasil diupdate.');
            } catch (\Exception $e) {
                DB::rollback();
                // something went wrong
                Log::debug('transaksi update rollback '.$e->getMessage());
                return redirect()->back()->withInput()->withErrors(['Terjadi kesalahan saat simpan, silahkan coba kembali.']);
            }
        }else{
            return redirect()->back()->withInput()->withErrors(['Terjadi kesalahan saat simpan, silahkan coba kembali.']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $transaksi = Transaksi::find($id);
        if($transaksi){ 
            DB::beginTransaction();
            try {
                    $transaksiDelete = Transaksi::where('id_transaksi',$id)->delete();
                
                    DB::commit();
                    // all good
                    return redirect ('/transaksi')->with('success', 'Transaksi berhasil dihapus.');
            } catch (\Exception $e) {
                DB::rollback();
                // something went wrong
                Log::debug('transaksi delete rollback '.$e->getMessage());
                return redirect()->back()->withInput()->withErrors(['Terjadi kesalahan saat simpan, silahkan coba kembali.']);
            }
        }else{
            return redirect()->back()->withInput()->withErrors(['Terjadi kesalahan saat simpan, silahkan coba kembali.']);
        }
    }
}
