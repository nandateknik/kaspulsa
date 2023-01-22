@extends('layouts.main')
@section('content')

<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Data Pengeluaran</h3>
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
                        <li class="breadcrumb-item"><a href="index.html">Pengeluaran</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Data Pengeluaran</li>
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
                        <h4 class="card-title">Data Pengeluaran</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                           <div class="container">
                            <div class="table-responsive">
                                <table class="table table-bordered mb-0">
                                  <thead>
                                    <tr>
                                      <th>Waktu</th>
                                      <th>Item</th>
                                      <th class="text-end">Biaya Pengeluaran</th>
                                      <th>Action</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    
                                  @if(sizeof($pengeluaran) !== 0)
                                    @foreach($pengeluaran as $key => $row)
                                    <tr>
                                      <td class="text-bold-500">{{Carbon\Carbon::parse($row->waktu)->format('d M Y')}}</td>
                                      <td>{{$row->item}}</td>
                                      <td class="text-end">{{number_format($row->nominal_biaya)}}</td>
                                      <td>
                                        <a href="{{route('pengeluaran.edit',$row->id_pengeluaran)}}" class="text-warning m-2" title="Edit">Edit</a> |
                                        <a href="#" class="text-danger m-2 delete_act" data-id="{{$row->id_pengeluaran}}" data-nama="{{$row->item}}" title="Delete">Hapus</a>
                                      </td>
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
                                    @if($pengeluaran->hasPages())
                                    <tr>
                                      <td colspan="6" align="center">
                                      {!! $pengeluaran->withQueryString()->links() !!}
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

<div class="modal" id="modal_delete" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Hapus Pengeluaran</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>Apakah anda yakin ingin mengahpus pengeluaran <span class="fw-bold" id="pengeluaran_delete"></span></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary delete_submit">Delete</button>
        <form id="form-delete" method="POST" action="">
          @csrf
          <input name="_method" type="hidden" value="DELETE">
          <input name="id_pengeluaran" id="id_pengeluaran_delete" type="hidden">
        </form>
      </div>
    </div>
  </div>
</div>

@endsection

@section('script')
<script>
  $('.delete_act').click(function(e){
    e.preventDefault();
    $('#modal_delete').find('form').attr('action','/pengeluaran/'+$(this).data('id'));
    $('#modal_delete').find('#pengeluaran_delete').html($(this).data('nama'));
    $('#modal_delete').find('#id_pengeluaran_delete').val($(this).data('id'));
    $('#modal_delete').modal('show');
  })

  $('.delete_submit').click(function(e){
    $('#form-delete').submit();
  })
</script>
@endsection