<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Log;

class PelangganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pelanggan = Pelanggan::paginate(20);
        return view('pelanggan/data',compact('pelanggan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $action = '/pelanggan';
        $action_method = 'POST';
        return view('pelanggan/input',compact('action','action_method'));
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
            $pelanggan = new Pelanggan;
            $pelanggan->nama_pelanggan = $request->nama_pelanggan;
            $pelanggan->no_telp = $request->no_telp;
            $pelanggan->status = $request->status;
            $pelanggan->save();
            
            DB::commit();
            // all good
            return redirect ('/pelanggan')->with('success', 'Pelanggan berhasil ditambahkan.');
        } catch (\Exception $e) {
            DB::rollback();
            // something went wrong
            Log::debug('pelanggan store rollback '.$e->getMessage());
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
        $pelanggan = Pelanggan::find($id);
        if($pelanggan){
            $action = '/pelanggan/'.$pelanggan->id_pelanggan;
            $action_method = 'PUT';
            return view('pelanggan/input',compact('pelanggan','action','action_method'));
        }else{
            return redirect()->back()->withErrors(['Pelanggan tidak ditemukan.']);
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
        $pelanggan = Pelanggan::find($id);
        if($pelanggan){ 
            DB::beginTransaction();
            try {
                $pelanggan->nama_pelanggan = $request->nama_pelanggan;
                $pelanggan->no_telp = $request->no_telp;
                $pelanggan->status = $request->status;
                $pelanggan->save();
                
                DB::commit();
                // all good
                return redirect ('/pelanggan')->with('success', 'Pelanggan berhasil diupdate.');
            } catch (\Exception $e) {
                DB::rollback();
                // something went wrong
                Log::debug('pelanggan update rollback '.$e->getMessage());
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
        $pelanggan = Pelanggan::find($id);
        if($pelanggan){ 
            DB::beginTransaction();
            try {
                    $trDelete = Transaksi::where('pelanggan_id',$id)->delete();
                    if(!$trDelete){
                        Pelanggan::where('id_pelanggan',$id)->delete();
                        DB::commit();
                        // all good
                        return redirect ('/pelanggan')->with('success', 'Pelanggan berhasil dihapus.');
                    }else{
                        return redirect()->back()->withErrors(['Pelanggan telah melakukan transaksi, tidak bisa dihapus.']);
                    }
            } catch (\Exception $e) {
                DB::rollback();
                // something went wrong
                Log::debug('pelanggan delete rollback '.$e->getMessage());
                return redirect()->back()->withInput()->withErrors(['Terjadi kesalahan saat simpan, silahkan coba kembali.']);
            }
        }else{
            return redirect()->back()->withInput()->withErrors(['Terjadi kesalahan saat simpan, silahkan coba kembali.']);
        }
    }
    
    public function getPelanggan(Request $request)
    {
        $data = [];
        if(NULL != ($request->get('id'))){
            $search = $request->get('id');
            $data = Pelanggan::find($search);
        }else{
            $data = [];
        }
        return response()->json(['results' => $data]);
    }

    public function lookup(Request $request,$id)
    {
        $data = Pelanggan::find($id);
        return response()->json($data);
    }

}
