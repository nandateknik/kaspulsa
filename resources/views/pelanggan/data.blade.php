@extends('layouts.main')
@section('content')

<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Data Pelanggan</h3>
                
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
                        <li class="breadcrumb-item"><a href="index.html">Pelanggan</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Data Pelanggan</li>
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
                        <h4 class="card-title">Data Pelanggan</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                           <div class="container">
                            <div class="table-responsive">
                                <table class="table table-bordered mb-0">
                                  <thead>
                                    <tr>
                                      <th>Nama</th>
                                      <th>No Rekening</th>
                                      <th>Bank</th>
                                      <th>No Telphone</th>
                                      <th>Status</th>
                                      <th>Action</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    
                                  @if(sizeof($pelanggan) !== 0)
                                    @foreach($pelanggan as $key => $row)
                                    <tr>
                                      <td class="text-bold-500">{{$row->nama_pelanggan}}</td>
                                      <td>{{$row->banks[0]->no_rekening}}</td>
                                      <td>{{$row->banks[0]->nama_bank}}</td>
                                      <td>{{$row->no_telp}}</td>
                                      <td>{!! $row->status == 1 ? '<span class="badge bg-info">Aktif</span>' : '<span class="badge bg-secondary">Nonaktif</span>' !!}</td>
                                      <td>
                                        <a href="{{route('pelanggan.edit',$row->id_pelanggan)}}" class="text-warning m-2" title="Edit">Edit</a> |
                                        <a href="#" class="text-danger m-2 delete_act" data-id="{{$row->id_pelanggan}}" data-nama="{{$row->nama_pelanggan}}" title="Delete">Hapus</a>
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
                                    @if($pelanggan->hasPages())
                                    <tr>
                                      <td colspan="6" align="center">
                                      {!! $pelanggan->withQueryString()->links() !!}
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
        <h5 class="modal-title">Hapus Pelanggan</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>Apakah anda yakin ingin mengahpus pelanggan <span class="fw-bold" id="pelanggan_delete"></span></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary delete_submit">Delete</button>
        <form id="form-delete" method="POST" action="">
          @csrf
          <input name="_method" type="hidden" value="DELETE">
          <input name="id_pelanggan" id="id_pelanggan_delete" type="hidden">
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
    $('#modal_delete').find('form').attr('action','/pelanggan/'+$(this).data('id'));
    $('#modal_delete').find('#pelanggan_delete').html($(this).data('nama'));
    $('#modal_delete').find('#id_pelanggan_delete').val($(this).data('id'));
    $('#modal_delete').modal('show');
  })

  $('.delete_submit').click(function(e){
    $('#form-delete').submit();
  })
</script>
@endsection