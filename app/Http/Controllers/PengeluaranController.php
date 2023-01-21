<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengeluaran;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Log;

class PengeluaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pengeluaran = Pengeluaran::paginate(20);
        return view('pengeluaran/data',compact('pengeluaran'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $action = '/pengeluaran';
        $action_method = 'POST';
        return view('pengeluaran/input',compact('action','action_method'));
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
            $pengeluaran = new Pengeluaran;
            $pengeluaran->item = $request->item;
            $pengeluaran->nominal_biaya = $request->nominal_biaya;
            $pengeluaran->waktu = $request->waktu;
            $pengeluaran->save();
            DB::commit();
            // all good
            return redirect ('/pengeluaran')->with('success', 'Pengeluaran berhasil ditambahkan.');
        } catch (\Exception $e) {
            DB::rollback();
            // something went wrong
            Log::debug('Pengeluaran store rollback '.$e->getMessage());
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
        $pengeluaran = Pengeluaran::find($id);
        if($pengeluaran){
            $action = '/pengeluaran/'.$pengeluaran->id_pengeluaran;
            $action_method = 'PUT';
            return view('pengeluaran/input',compact('pengeluaran','action','action_method'));
        }else{
            return redirect()->back()->withErrors(['Pengeluaran tidak ditemukan.']);
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
        $pengeluaran = Pengeluaran::find($id);
        if($pengeluaran){ 
            DB::beginTransaction();
            try {
                $pengeluaran->item = $request->item;
                $pengeluaran->nominal_biaya = $request->nominal_biaya;
                $pengeluaran->waktu = $request->waktu;
                $pengeluaran->save();

                DB::commit();
                // all good
                return redirect ('/pengeluaran')->with('success', 'Pengeluaran berhasil diupdate.');
            } catch (\Exception $e) {
                DB::rollback();
                // something went wrong
                Log::debug('pengeluaran update rollback '.$e->getMessage());
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
        $pengeluaran = Pengeluaran::find($id);
        if($pengeluaran){ 
            DB::beginTransaction();
            try {
                    $pengeluaranDelete = Pengeluaran::where('id_pengeluaran',$id)->delete();
                
                    DB::commit();
                    // all good
                    return redirect ('/pengeluaran')->with('success', 'Pengeluaran berhasil dihapus.');
            } catch (\Exception $e) {
                DB::rollback();
                // something went wrong
                Log::debug('pengeluaran delete rollback '.$e->getMessage());
                return redirect()->back()->withInput()->withErrors(['Terjadi kesalahan saat simpan, silahkan coba kembali.']);
            }
        }else{
            return redirect()->back()->withInput()->withErrors(['Terjadi kesalahan saat simpan, silahkan coba kembali.']);
        }
    }
}
