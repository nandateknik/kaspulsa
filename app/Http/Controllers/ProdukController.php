<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Bank;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Log;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $produk = Produk::paginate(20);
        return view('produk/data',compact('produk'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $action = '/produk';
        $action_method = 'POST';
        return view('produk/input',compact('action','action_method'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_produk' => 'required|unique:produk',
            'nama_produk' => 'required',
        ]);

        DB::beginTransaction();
        try {
            $produk = new Produk;
            $produk->nama_produk = $request->nama_produk;
            $produk->kode_produk = $request->kode_produk;
            $produk->save();
            DB::commit();
            // all good
            return redirect ('/produk')->with('success', 'Produk berhasil ditambahkan.');
        } catch (\Exception $e) {
            DB::rollback();
            // something went wrong
            Log::debug('produk store rollback '.$e->getMessage());
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
        $produk = Produk::find($id);
        if($produk){
            $action = '/produk/'.$produk->id_produk;
            $action_method = 'PUT';
            return view('produk/input',compact('produk','action','action_method'));
        }else{
            return redirect()->back()->withErrors(['Produk tidak ditemukan.']);
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
        
        $validated = $request->validate([
            'kode_produk' => ['required',Rule::unique('produk', 'kode_produk')->ignore($id,'id_produk')],
            'nama_produk' => 'required',
        ]);

        $produk = Produk::find($id);
        if($produk){ 
            DB::beginTransaction();
            try {
                $produk->nama_produk = $request->nama_produk;
                $produk->kode_produk = $request->kode_produk;
                $produk->save();
                DB::commit();
                // all good
                return redirect ('/produk')->with('success', 'Produk berhasil diupdate.');
            } catch (\Exception $e) {
                DB::rollback();
                // something went wrong
                Log::debug('produk update rollback '.$e->getMessage());
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
        $produk = Produk::find($id);
        if($produk){ 
            try {
                    $transaksi = Transaksi::where('produk_id',$id)->first();
                    if(!$transaksi){
                        Produk::where('id_produk',$id)->delete();
                
                        // all good
                        return redirect ('/produk')->with('success', 'Produk berhasil dihapus.');
                    }else{
                        return redirect()->back()->withErrors(['Produk dipakai pada transaksi, tidak bisa dihapus.']);
                    }
            } catch (\Exception $e) {
                // something went wrong
                Log::debug('produk delete rollback '.$e->getMessage());
                return redirect()->back()->withErrors(['Terjadi kesalahan saat simpan, silahkan coba kembali.']);
            }
        }else{
            return redirect()->back()->withErrors(['Terjadi kesalahan saat simpan, silahkan coba kembali.']);
        }
    }
}
