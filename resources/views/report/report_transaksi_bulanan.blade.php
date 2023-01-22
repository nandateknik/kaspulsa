@extends('layouts.main')
@section('content')

<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Laporan Transaksi</h3>
                @if(Session::has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                  <strong>Info!</strong> {{ Session::get('success') }}
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif

            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Laporan</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Laporan Transaksi Per Tanggal</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <!-- // Basic multiple Column Form section start -->
    <section id="multiple-column-form">
        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <!-- <h4 class="card-title">Data Transaksi</h4> -->
                      <div class="container">
                        <div class="row">
                          <div class="col-md-3">
                            <div class="form-group">
                              <label for="">Tahun</label>
                              <select name="tahun" id="tahun" class="form-control">
                                @if(isset($list_tahun))
                                  @foreach($list_tahun as $th)
                                    <option value="{{$th->tahun}}">{{$th->tahun}}</option>
                                  @endforeach
                                @else
                                    <option value="{{date('Y')}}">{{date('Y')}}</option>
                                @endif
                              </select>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                           <div class="container">
                            <div class="table-responsive">
                                <table class="table table-bordered mb-0">
                                  <thead>
                                    <tr>
                                      <th>Tanggal</th>
                                      <th class="text-end">Saldo Deposit</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                  @if(sizeof($transaksi) !== 0)
                                    @foreach($transaksi as $key => $row)
                                    <tr>
                                      <td class="text-bold-500">{{$row->periode}}</td>
                                      <td class="text-end">{{number_format($row->saldo_deposit)}}</td>
                                    </tr>
                                    @endforeach     
                                  @else
                                  <tr>
                                      <td colspan="2" align="center">
                                          <h4 class="text-center">No Data Available</h4>
                                      </td>
                                  </tr>
                                  @endif
                                  </tbody>
                                  <tfoot>
                                    <tr>
                                      <td colspan="1" ></td>
                                      <td align="right" class="fw-bold">{{number_format($transaksi->sum('saldo_deposit'))}}</td>
                                    </tr>
                                    @if($transaksi->hasPages())
                                    <tr>
                                      <td colspan="2" align="center">
                                      {!! $transaksi->withQueryString()->links() !!}
                                      </td>
                                    </tr>
                                    @endif
                                  </tfoot>
                                </table>
                              </div>
                            </div>
                            
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

  $(document).on('change','#tahun', function(){
    realoadPage();
  })

  $(document).on('keyup','#search', function(e){  
    
    if (e.key === 'Enter' || e.keyCode === 13) {
      realoadPage();
    }
  })

  function realoadPage(){
    let url = (window.location.href.split("?")[0]) + '?tgl_awal='+$('#tgl_awal').val()+'&tgl_akhir='+$('#tgl_akhir').val()+'&search='+$('#search').val();
    window.location.href = url;
  }

</script>
@endsection