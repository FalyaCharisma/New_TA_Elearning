@extends('layouts.app')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Informasi</h1>
        </div> 

        <div class="section-body">

            <div class="card">
                <div class="card-header">
                    <h4><i class="fas fa-info"></i>Informasi</h4>
                </div>

                <div class="card-body">
                    <form action="{{ route('informasi.index') }}" method="GET">
                        <div class="form-group">
                            <div class="input-group mb-3">
                                @can('informasi.create')
                                    <div class="input-group-prepend">
                                        <a href="{{ route('informasi.create') }}" class="btn btn-primary" style="padding-top: 10px;"><i class="fa fa-plus-circle"></i> TAMBAH</a>
                                    </div>
                                @endcan
                                <input type="text" class="form-control" name="q"
                                       placeholder="cari berdasarkan informasi">
                                 <div class="input-group-append">
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> CARI
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
             
                    @foreach ($infos as $info)
                    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="card card-statistic-1">
                            <div class="card-wrap">
                                <div class="card-body">
                                <h4>Isi Informasi </h4>
                                @if($info['document_id'])
                                    <a href=" {{ asset('storage/public/documents/'.$document->getLink($info['document_id'])) }}">{{$document->getLink($info['document_id'])}}</a>
                                @elseif($info['image_id'])
                                    <img src="{{ asset('storage/public/images/'.$image->getLink($info['image_id'])) }}" style="width: 800px">
                                @else
                                @endif
                                <p>{{ $info->isi_informasi }}</p>
                                </div>
                                <div class="card-footer">
                                {{ $info->created_at }}<br>
                                @can('informasi.edit')
                                            <a href="{{ route('informasi.edit', $info->id) }}" class="btn btn-sm btn-primary">
                                                <i class="fa fa-pencil-alt"></i>
                                            </a>
                                @endcan 
                                @can('informasi.delete')
                                            <button onClick="Delete(this.id)" class="btn btn-sm btn-danger" id="{{ $info->id }}">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                @endcan
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

    </section>
</div>

<script>
    //ajax delete
    function Delete(id)
        {
            var id = id;
            var token = $("meta[name='csrf-token']").attr("content");

            swal({
                title: "APAKAH KAMU YAKIN ?",
                text: "INGIN MENGHAPUS DATA INI!",
                icon: "warning",
                buttons: [
                    'TIDAK',
                    'YA'
                ],
                dangerMode: true,
            }).then(function(isConfirm) {
                if (isConfirm) {

                    //ajax delete
                    jQuery.ajax({
                        url: "{{ route("informasi.index") }}/"+id,
                        data:   {
                            "id": id,
                            "_token": token
                        },
                        type: 'DELETE',
                        success: function (response) {
                            if (response.status == "success") {
                                swal({
                                    title: 'BERHASIL!',
                                    text: 'DATA BERHASIL DIHAPUS!',
                                    icon: 'success',
                                    timer: 1000,
                                    showConfirmButton: false,
                                    showCancelButton: false,
                                    buttons: false,
                                }).then(function() {
                                    location.reload();
                                });
                            }else{
                                swal({
                                    title: 'GAGAL!',
                                    text: 'DATA GAGAL DIHAPUS!',
                                    icon: 'error',
                                    timer: 1000,
                                    showConfirmButton: false,
                                    showCancelButton: false,
                                    buttons: false,
                                }).then(function() {
                                    location.reload();
                                });
                            }
                        }
                    });

                } else {
                    return true;
                }
            })
        }
</script>
@stop