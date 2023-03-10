@extends('layouts.main')
@section('content')

<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
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
            
            <div class="col-4">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Cari Pelanggan</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="nama_pelanggan">Nama Pelanggan</label>
                                <select name="pelanggan_id" form="transaksi" id="nama_pelanggan" class="select-pelanggan form-control">
                                    
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="no_telp">No Telphone</label>
                                <input readonly type="text" name="no_telp" id="no_telp" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="status">Status</label>
                                <input readonly type="text" name="status" id="status" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-8 ">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Registrasi Transaksi</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form id="transaksi" class="form" method="POST" action={{$action}}>
                                @csrf
                                <input id="kas" type="hidden" value="{{($kas) ? 0 : 1}}">
                                <input name="_method" type="hidden" value="{{$action_method}}">
                                <input type="hidden" name="id_transaksi" value="{{old('id_transaksi', isset($transaksi) ? $transaksi->id_transaksi : '')}}">
                                
                                <div class="form-group">
                                    <label for="saldo_akhir">Waktu</label>
                                    <input type="date" id="waktu" class="form-control" name="waktu"  value="{{old('waktu', isset($transaksi) ? $transaksi->waktu : date('Y-m-d'))}}">
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
                               
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="saldo_akhir">Deposit Nominal</label>
                                            <input required type="number" id="saldo_deposit" class="form-control" name="saldo_deposit"  value="{{old('saldo_deposit', isset($transaksi) ? $transaksi->saldo_deposit : '0')}}">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="id_produk">Jenis Payment</label>
                                            <div class="row">
                                                <div class="col-4">
                                                    <div class="form-check">
                                                    <input class="form-check-input" value="bonus" type="radio" name="jenis_payment" id="jenis_payment1" {{'bonus' == (old('jenis_payment', isset($transaksi) ? $transaksi->jenis_payment : '')) ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="jenis_payment1">
                                                        Bonus
                                                    </label>
                                                    </div>
                                                </div>
                                                <div class="col-4">        
                                                    <div class="form-check">
                                                    <input class="form-check-input" value="deposit" type="radio" name="jenis_payment" id="jenis_payment2" {{'deposit' == (old('jenis_payment', isset($transaksi) ? $transaksi->jenis_payment : '')) ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="jenis_payment2">
                                                        Deposit
                                                    </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <h6 class="mt-4">Deposit dari Bank</h6>
                                <hr>
                                <div class="row">
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="bank_id">Bank</label>
                                            <select required name="bank_id" id="bank_id" value="{{old('bank_id', isset($transaksi) ? $transaksi->bank_id : '')}}" class="form-control">
                                                <option value="">--Silahkan Pilih--</option>
                                                @if($bank)
                                                    @foreach($bank as $b)
                                                        <option data-bank='<?=json_encode($b)?>' {{$b->id_bank == (old('bank_id', isset($transaksi) ? $transaksi->bank_id : '')) ? 'selected' : '' }} value="{{$b->id_bank}}">{{$b->nama_bank}}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="nama_rekening">Nama Rekening</label>
                                            <input disabled type="text" name="nama_rekening" id="nama_rekening" class="form-control"  value="{{old('nama_rekening', '')}}">
                                        </div>
                                    </div>
                                    <div class="col-4">    
                                        <div class="form-group">
                                            <label for="no_rekening">No. Rekening</label>
                                            <input disabled type="test" id="no_rekening" class="form-control" name="no_rekening"  value="{{old('no_rekening', '')}}">
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group mt-4">
                                    <hr>
                                    <div class="text-end">
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

<div class="modal" id="modal_kas" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Input Kas Awal Tanggal : {{date('d M Y')}}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
            <div hidden class="col-md-12">
                <div class="form-group">
                    <label for="no_rekening">Kas Awal</label>
                    <input form="form-kas" type="number" id="kas_awal" class="form-control" name="kas_awal"  value="{{old('kas_awal', '')}}">
                </div>
            </div>
            <div class="col-md-12">
                <hr>
                <h6>Saldo Awal Bank</h6>
                @isset($bank)
                    @foreach($bank as $b)
                    <div class="d-flex">
                        <div style="width:50%" class="form-group">
                            <label class="fw-bold" style="font-size:12px" for="no_rekening">{{$b->nama_bank}}</label>
                            <p style="font-size:12px;margin-bottom:0">Nama Rekening : {{$b->nama_rekening}}</p>
                            <p style="font-size:12px;margin-bottom:0">No Rekening : {{$b->no_rekening}}</p>
                        </div>
                        <div style="width:50%" class="form-group">
                            <input form="form-kas" type="number" id="kas_bank_{{$b->id_bank}}" class="form-control" name="kas_bank[]"  value="">
                            <input form="form-kas" type="hidden" id="id_bank_{{$b->id_bank}}" class="form-control" name="id_bank[]"  value="{{$b->id_bank}}">
                        </div>
                    </div>
                    @endforeach
                @endisset
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary kas_submit">Submit</button>
        <form id="form-kas" method="POST" action="">
          @csrf
        </form>
      </div>
    </div>
  </div>
</div>


@endsection

@section('script')
<script>
    $(document).ready(function(){
        if($('#kas').val() == 1){
            openKasModal();
        }
    })

    $('#bank_id').change(function(){
        var selectedBank = $(this).children("option:selected").data('bank');
        $("#nama_rekening").val(selectedBank.nama_rekening);
        $("#no_rekening").val(selectedBank.no_rekening);
    })
    
  function openKasModal(){
    $('#modal_kas').find('form').attr('action','/transaksi/set-kas-awal');
    $('#modal_kas').modal('show');
    setTimeout(() => {
        $('#modal_kas').find('#kas_awal').focus();
    }, 500);
  }

  $('.kas_submit').click(function(e){
    e.preventDefault();
    
    let form = $('#form-kas')[0];
    let data = new FormData(form); 

    $.ajax({
        url:'/transaksi/set-kas-awal',
        data:data,
        type:"POST",
        contentType:false,
        cache: false,
        processData:false,
        success:function(result){
            location.reload();
        }
    });
  })
  
  $('.select-pelanggan').select2({
    minimumInputLength: 2,
    placeholder: 'Select an item',
    ajax: {
        url: '{{url('/transaksi/pelanggan-search')}}',
        type: "get",
        dataType: 'json',
        delay: 250,
        data: function (term) {
            return {
                term: term,
                q: term['term']
            };
        },
        results: function (data) {
            return {
                results: $.map(data, function (item) {
                    return item;
                })
            };
        }
    }
});

$('.select-pelanggan').on("select2:select", function(e) { 
    id = $(this).find(':selected').val();

    $.ajax({
        url:'/pelanggan/'+id+'/lookup',
        type:"get",
        contentType:false,
        cache: false,
        processData:false,
        success:function(result){
            $('#no_telp').val(result.no_telp);
            if(result.status == '1')
                $('#status').val('Aktif');
            else
                $('#status').val('Nonaktif');
        }
    });

});

</script>
@endsection