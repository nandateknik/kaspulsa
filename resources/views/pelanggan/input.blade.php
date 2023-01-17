@extends('layouts.main')
@section('content')

<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Form Pelanggan</h3>
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
                        <li class="breadcrumb-item"><a href="index.html">Pelanggan</a></li>
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
                        <h4 class="card-title">Registrasi Pelanggan</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form" method="POST" action="{{$action}}">
                                @csrf
                                <input name="_method" type="hidden" value="{{$action_method}}">
                                <input type="hidden" name="id_pelanggan" value="{{old('id_pelanggan', isset($pelanggan) ? $pelanggan->id_pelanggan : '')}}">
                                <input type="hidden" name="id_bank" value="{{old('id_pelanggan', isset($pelanggan) ? $pelanggan->banks[0]->id_bank : '')}}">
                                <div class="form-group">
                                    <label for="nama_pelanggan">Nama Pelanggan</label>
                                    <input required type="text" id="nama_pelanggan" class="form-control" name="nama_pelanggan" value="{{old('nama_pelanggan', isset($pelanggan) ? $pelanggan->nama_pelanggan : '')}}">
                                </div>
                                <div class="form-group">
                                    <label for="no_rekening">No Rekening</label>
                                    <input type="text" id="no_rekening" class="form-control" name="no_rekening" value="{{old('no_rekening', isset($pelanggan) ? $pelanggan->banks[0]->no_rekening : '')}}">
                                </div>
                                <div class="form-group">
                                    <label for="nama_bank">Bank</label>
                                    <select required name="nama_bank" id="nama_bank" value="{{old('nama_bank', isset($pelanggan) ? $pelanggan->nama_bank : '')}}" class="form-control">
                                        <option value="">--Silahkan Pilih--</option>
                                        <option {{'mandiri' == (old('nama_bank', isset($pelanggan) ? $pelanggan->banks[0]->nama_bank : '')) ? 'selected' : '' }} value="mandiri">Bank Mandiri</option>
                                        <option {{'bni' == (old('nama_bank', isset($pelanggan) ? $pelanggan->banks[0]->nama_bank : '')) ? 'selected' : '' }} value="bni">Bank BNI</option>
                                        <option {{'bca' == (old('nama_bank', isset($pelanggan) ? $pelanggan->banks[0]->nama_bank : '')) ? 'selected' : '' }} value="bca">Bank BCA</option>
                                        <option {{'bri' == (old('nama_bank', isset($pelanggan) ? $pelanggan->banks[0]->nama_bank : '')) ? 'selected' : '' }} value="bri">Bank BRI</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="no_telp">No Telphone</label>
                                    <input type="number" id="no_telp" class="form-control" name="no_telp" value="{{old('no_telp', isset($pelanggan) ? $pelanggan->no_telp : '')}}">
                                </div>
                                <div class="form-group">
                                    <label for="id_bank">Status</label>
                                    <select name="status" id="status" class="form-control">
                                        <option value="">--Silahkan Pilih--</option>
                                        <option {{'1' == (old('status', isset($pelanggan) ? $pelanggan->status : '')) ? 'selected' : '' }} value="1">Aktif</option>
                                        <option {{'0' == (old('status', isset($pelanggan) ? $pelanggan->status : '')) ? 'selected' : '' }} value="0">Nonaktif</option>
                                    </select>
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