<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bank;
use Illuminate\Support\Facades\DB;

class BankController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bank = Bank::paginate(20);
        return view('bank/data',compact('bank'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $action = '/bank';
        $action_method = 'POST';
        return view('bank/input',compact('action','action_method'));
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
            $bank = new Bank;
            $bank->nama_bank = $request->nama_bank;
            $bank->no_rekening = $request->no_rekening;
            $bank->nama_rekening = $request->nama_rekening;
            $bank->saldo_akhir = $request->saldo_akhir;
            $bank->save();
            DB::commit();
            // all good
            return redirect ('/bank')->with('success', 'Bank berhasil ditambahkan.');
        } catch (\Exception $e) {
            DB::rollback();
            // something went wrong
            Log::debug('bank store rollback '.$e->getMessage());
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
        $bank = Bank::find($id);
        if($bank){
            $action = '/bank/'.$bank->id_bank;
            $action_method = 'PUT';
            return view('bank/input',compact('bank','action','action_method'));
        }else{
            return redirect()->back()->withErrors(['Bank tidak ditemukan.']);
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
        $bank = Bank::find($id);
        if($bank){ 
            DB::beginTransaction();
            try {
                $bank->nama_bank = $request->nama_bank;
                $bank->nama_rekening = $request->nama_rekening;
                $bank->no_rekening = $request->no_rekening;
                $bank->saldo_akhir = $request->saldo_akhir;
                $bank->save();

                DB::commit();
                // all good
                return redirect ('/bank')->with('success', 'Bank berhasil diupdate.');
            } catch (\Exception $e) {
                DB::rollback();
                // something went wrong
                Log::debug('Bank update rollback '.$e->getMessage());
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
        $bank = Bank::find($id);
        if($bank){ 
            DB::beginTransaction();
            try {
                    $bankDelete = Bank::where('id_bank',$id)->delete();
                
                    DB::commit();
                    // all good
                    return redirect ('/bank')->with('success', 'Bank berhasil dihapus.');
            } catch (\Exception $e) {
                DB::rollback();
                // something went wrong
                Log::debug('bank delete rollback '.$e->getMessage());
                return redirect()->back()->withInput()->withErrors(['Terjadi kesalahan saat simpan, silahkan coba kembali.']);
            }
        }else{
            return redirect()->back()->withInput()->withErrors(['Terjadi kesalahan saat simpan, silahkan coba kembali.']);
        }
    }
}
