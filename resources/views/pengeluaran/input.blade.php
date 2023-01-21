@extends('layouts.main')
@section('content')

<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="offset-2 col-8 col-md-6 order-md-1 order-last">
                <h3>Form Pengeluaran</h3>
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
                        <li class="breadcrumb-item"><a href="index.html">Pengeluaran</a></li>
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
                        <h4 class="card-title">Form Pengeluaran</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form" method="POST" action={{$action}}>
                                @csrf
                                <input name="_method" type="hidden" value="{{$action_method}}">
                                <input type="hidden" name="id_pengeluaran" value="{{old('id_pengeluaran', isset($pengeluaran) ? $pengeluaran->id_pengeluaran : '')}}">
                                
                                <div class="form-group">
                                    <label for="saldo_akhir">Waktu</label>
                                    <input type="date" id="waktu" class="form-control" name="waktu"  value="{{old('waktu', isset($pengeluaran) ? $pengeluaran->waktu : date('Y-m-d'))}}">
                                </div>
                                
                                <div class="form-group">
                                    <label for="saldo_akhir">Item Pengeluaran</label>
                                    <input type="text" id="item" class="form-control" name="item"  value="{{old('item', isset($pengeluaran) ? $pengeluaran->item : '')}}">
                                </div>
                                
                                <div class="form-group">
                                    <label for="saldo_akhir">Nominal Pengeluaran</label>
                                    <input type="number" id="nominal_biaya" class="form-control" name="nominal_biaya"  value="{{old('nominal_biaya', isset($pengeluaran) ? $pengeluaran->nominal_biaya : '')}}">
                                </div><br>
                                
                                <div class="form-group">
                                    <div class="text-center">
                                        <button class="btn-primary btn">Simpan Data</button>
                                    </div>
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
