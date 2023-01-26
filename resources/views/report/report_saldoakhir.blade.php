@extends('layouts.main')
@section('content')

<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Laporan saldo Akhir</h3>
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
                        <li class="breadcrumb-item active" aria-current="page">Laporan saldo Akhir</li>
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
                              <label for="">Waktu mulai</label>
                              <input type="date" id="tgl_awal" name="tgl_awal" value="{{old('tgl_mulai',isset($tgl_mulai) ? $tgl_mulai : date('Y-m-d') )}}" class="form-control form-control-sm">
                            </div>
                          </div>
                          <div class="col-md-3">
                            <div class="form-group">
                              <label for="">Waktu berakhir</label>
                              <input type="date" id="tgl_akhir" name="tgl_akhir" value="{{old('tgl_akhir',isset($tgl_akhir) ? $tgl_akhir : date('Y-m-d') )}}" class="form-control form-control-sm">
                            </div>
                          </div>
                          <div class="col-md-3">
                            <div class="form-group">
                              <label for="">Daftar Bank</label>
                              <select required name="bank" id="bank" value="{{old('bank', isset($bank) ? $bank : '')}}" class="form-control">
                                <option value="">--Silahkan Pilih--</option>
                                @if($list_bank)
                                    @foreach($list_bank as $b)
                                        <option {{$b->id_bank == (old('bank', isset($bank) ? $bank : '')) ? 'selected' : '' }} value="{{$b->id_bank}}">{{$b->nama_bank}}</option>
                                    @endforeach
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
                            <div class="row">
                              <div class="col-12">

                              <div class="table-responsive">
                                  <table class="table table-bordered mb-0">
                                    <thead>
                                      <tr>
                                        <th>Tanggal</th>
                                        <th class="text-end">Saldo Awal</th>
                                        <th class="text-end">Deposit Pelanggan</th>
                                        <th class="text-end">Saldo Akhir</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                    @if(sizeof($kasbank) !== 0)
                                      @foreach($kasbank as $key => $row)
                                      <tr>
                                        <td class="text-bold-500">{{Carbon\Carbon::parse($row->tanggal)->format('d M Y')}}</td>
                                        <td class="text-end">{{number_format($row->kas_awal)}}</td>
                                        <td class="text-end"><span class="fw-bold">- </span>{{number_format($row->deposit)}}</td>
                                        <td class="text-end">{{number_format($row->kas_awal-$row->deposit)}}</td>
                                      </tr>
                                      @endforeach     
                                    @else
                                    <tr>
                                        <td colspan="6" align="center">
                                            <h4 class="text-center">No Data Available</h4>
                                        </td>
                                    </tr>
                                    @endif
                                    </tbody>
                                    <tfoot>
                                      <tr>
                                        <td class="fw-bold" align="right">TOTAL</td>
                                        <td align="right" class="fw-bold">{{number_format($kasbank->sum('kas_awal'))}}</td>
                                        <td align="right" class="fw-bold"><span>- </span>{{number_format($kasbank->sum('deposit'))}}</td>
                                        <td align="right" class="fw-bold">{{number_format($kasbank->sum('kas_awal')-$kasbank->sum('deposit'))}}</td>
                                      </tr>
                                      @if($kasbank->hasPages())
                                      <tr>
                                        <td colspan="6" align="center">
                                        {!! $kasbank->withQueryString()->links() !!}
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
            </div>
        </div>
    </section>
    <!-- // Basic multiple Column Form section end -->

     <!-- // Basic multiple Column Form section start -->
     <section id="multiple-column-form">
      <div class="row match-height">
          <div class="col-12">
              <div class="card">
                  <div class="card-header">
                      <h4>Laporan Pengeluaran</h4>
                  </div>
                  <div class="card-content">
                      <div class="card-body">
                         <div class="container">
                          <div class="row">
                            <div class="col-12">

                            <div class="table-responsive">
                                <table class="table table-bordered mb-0">
                                  <thead>
                                    <tr>
                                      <th>Tanggal</th>
                                      <th class="text-end">Total Pengeluaran</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                  @if(sizeof($pengeluaran) !== 0)
                                    @foreach($pengeluaran as $key2 => $row2)
                                    <tr>
                                      <td class="text-bold-500">{{Carbon\Carbon::parse($row2->waktu)->format('d M Y')}}</td>
                                      <td class="text-end">{{number_format($row2->total)}}</td>
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
                                      <td class="fw-bold" align="right">TOTAL</td>
                                      <td align="right" class="fw-bold">{{number_format($pengeluaran->sum('total'))}}</td>
                                    </tr>
                                  </tfoot>
                                </table>
                              </div>
                            </div>
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

  $(document).on('change','#tgl_awal,#tgl_akhir,#bank', function(){
    realoadPage();
  })

  function realoadPage(){
    let url = (window.location.href.split("?")[0]) + '?tgl_awal='+$('#tgl_awal').val()+'&tgl_akhir='+$('#tgl_akhir').val()+'&bank='+$('#bank').val();
    window.location.href = url;
  }

</script>
@endsection