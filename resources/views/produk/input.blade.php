@extends('layouts.main')
@section('content')

<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Form Produk</h3>
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
                        <li class="breadcrumb-item"><a href="index.html">Produk</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Form Input</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <!-- // Basic multiple Column Form section start -->
    <section id="multiple-column-form">
        <div class="row match-height">
            <div class="col-8 offset-2">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Registrasi Produk</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form" method="POST" action="{{$action}}">
                                @csrf
                                <input name="_method" type="hidden" value="{{$action_method}}">
                                <input type="hidden" name="id_produk" value="{{old('id_produk', isset($produk) ? $produk->id_produk : '')}}">
                                <div class="form-group">
                                    <label for="nama_produk">Kode Produk</label>
                                    <input required type="text" id="kode_produk" class="form-control" name="kode_produk" value="{{old('kode_produk', isset($produk) ? $produk->kode_produk : '')}}">
                                </div>
                                <div class="form-group">
                                    <label for="nama_produk">Nama Produk</label>
                                    <input required type="text" id="nama_produk" class="form-control" name="nama_produk" value="{{old('nama_produk', isset($produk) ? $produk->nama_produk : '')}}">
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn-primary btn">Simpan Data</button>
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