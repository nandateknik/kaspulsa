@extends('layouts.main')
@section('content')

<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="offset-2 col-8 col-md-6 order-md-1 order-last">
                <h3>Form Transaksi</h3>
                @if($errors->any())
                    @foreach($errors->all() as $err)
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Maaf!</strong> {{ $err }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endforeach
                @endif
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Transaksi</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Form Input</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <!-- // Basic multiple Column Form section start -->
    <section id="multiple-column-form">
        <div class="row match-height">
            <div class="offset-2 col-8 ">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Registrasi Transaksi</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form" method="POST" action={{$action}}>
                                @csrf
                                <input name="_method" type="hidden" value="{{$action_method}}">
                                <input type="hidden" name="id_transaksi" value="{{old('id_transaksi', isset($transaksi) ? $transaksi->id_transaksi : '')}}">
                                
                                <div class="form-group">
                                    <label for="saldo_akhir">Waktu</label>
                                    <input type="date" id="waktu" class="form-control" name="waktu"  value="{{old('waktu', isset($transaksi) ? $transaksi->waktu : date('Y-m-d'))}}">
                                </div>
                                <div class="form-group">
                                    <label for="id_pelanggan">Pelanggan</label>
                                    <select required name="pelanggan_id" id="pelanggan_id" value="{{old('pelanggan_id', isset($transaksi) ? $transaksi->pelanggan_id : '')}}" class="form-control">
                                        <option value="">--Silahkan Pilih--</option>
                                        @if($pelanggan)
                                            @foreach($pelanggan as $pel)
                                                <option {{$pel->id_pelanggan == (old('pelanggan_id', isset($transaksi) ? $transaksi->pelanggan_id : '')) ? 'selected' : '' }} value="{{$pel->id_pelanggan}}">{{$pel->nama_pelanggan}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="id_transaksi">Produk</label>
                                    <select required name="produk_id" id="produk_id" value="{{old('produk_id', isset($transaksi) ? $transaksi->produk_id : '')}}" class="form-control">
                                        <option value="">--Silahkan Pilih--</option>
                                        @if($produk)
                                            @foreach($produk as $pr)
                                                <option {{$pr->id_produk == (old('produk_id', isset($transaksi) ? $transaksi->produk_id : '')) ? 'selected' : '' }} value="{{$pr->id_produk}}">{{$pr->nama_produk}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="id_produk">Jenis Payment</label>
                                    <select name="jenis_payment" id="jenis_payment" class="form-control">
                                        <option value="">--Silahkan Pilih--</option>
                                        <option {{'bonus' == (old('jenis_payment', isset($transaksi) ? $transaksi->jenis_payment : '')) ? 'selected' : '' }} value="bonus">Bonus</option>
                                        <option {{'deposit' == (old('jenis_payment', isset($transaksi) ? $transaksi->jenis_payment : '')) ? 'selected' : '' }} value="deposit">Deposit</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="saldo_akhir">Saldo Akhir</label>
                                    <input type="number" id="saldo_akhir" class="form-control" placeholder="Saldo Akhir" name="saldo_akhir"  value="{{old('saldo_akhir', isset($transaksi) ? $transaksi->saldo_akhir : '')}}">
                                </div>
                                <div class="text-center">
                                    <button class="btn-primary btn">Simpan Data</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- // Basic multiple Column Form section end -->
</div>

@endsection