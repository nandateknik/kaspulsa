@extends('layouts.main')
@section('content')

<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Form Bank</h3>
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
                        <li class="breadcrumb-item"><a href="index.html">Bank</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Form Input</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <!-- // Basic multiple Column Form section start -->
    <section id="multiple-column-form">
        <div class="row match-height">
            <div class="offset-2 col-8">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Registrasi Bank</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form" method="POST" action="{{$action}}">
                                
                                @csrf
                                <input name="_method" type="hidden" value="{{$action_method}}">
                                <input type="hidden" name="id_bank" value="{{old('id_bank', isset($bank) ? $bank->id_bank : '')}}">
                                <div class="form-group">
                                    <label for="nama_bank">Nama Bank</label>
                                    <select required name="nama_bank" id="nama_bank" value="{{old('nama_bank', isset($bank) ? $bank->nama_bank : '')}}" class="form-control">
                                        <option value="">--Silahkan Pilih--</option>
                                        
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="nama_bank">Nama Rekening</label>
                                    <input type="text" id="nama_rekening" class="form-control" name="nama_rekening" value="{{old('nama_rekening', isset($bank) ? $bank->nama_rekening : '')}}">
                                </div>
                                <div class="form-group">
                                    <label for="nama_bank">No Rekening</label>
                                    <input type="text" id="no_rekening" class="form-control" name="no_rekening" value="{{old('no_rekening', isset($bank) ? $bank->no_rekening : '')}}">
                                </div>
                                <div hidden class="form-group">
                                    <label for="saldo_akhir">Saldo Akhir</label>
                                    <input type="text" id="saldo_akhir" class="form-control" name="saldo_akhir" value="{{old('saldo_akhir', isset($bank) ? $bank->saldo_akhir : '')}}">
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

@section('script')
<script>
    
        // setTimeout(() => {
        //     $("#nama_bank").select2();
        // }, 800);
    $(document).ready(function(){
        $.getJSON("/storage/list-bank.json", function(result){
            $.each(result, function(i, field){
                var o = new Option(field.name, field.name);
                $(o).html(field.name);
                $("#nama_bank").append(o);
            });
            
            $('#nama_bank').select2();
        });
    })
</script>
@endsection