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
        $bank = Bank::all();
        $produk = Produk::all();
        $kas = Kas::where('tanggal',date('Y-m-d'))->first();
        return view('transaksi/input',compact('action','action_method','pelanggan','produk','bank','kas'));
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
            $transaksi->saldo_deposit = $request->saldo_deposit;
            $transaksi->waktu = $request->waktu;
            $transaksi->bank_id = $request->bank_id;
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
            $bank = Bank::all();
            $kas = Kas::where('tanggal',date('Y-m-d'))->first();
            $action = '/transaksi/'.$transaksi->id_transaksi;
            $action_method = 'PUT';
            return view('transaksi/input',compact('transaksi','action','action_method','pelanggan','produk','bank','kas'));
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
                $transaksi->saldo_deposit = $request->saldo_deposit;
                $transaksi->waktu = $request->waktu;
                $transaksi->bank_id = $request->bank_id;
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

    public function setKasAwal(Request $request){
        $validator = Validator::make($request->all(), [
            'kas_awal' => 'required|numeric'
        ]);
        if ($validator->fails()) {
            $data['status'] = 'failed';
            $data['message'] = $validator->errors()->first();
            return response()->json([$data],400);
        }

        $kas = new Kas;
        $kas->kas_awal = $request->kas_awal;
        $kas->tanggal = date('Y-m-d');
        $kas->save();

        $data['status'] = 'success';
        $data['message'] = 'success';
        return response()->json([$data],201);
    }
}
