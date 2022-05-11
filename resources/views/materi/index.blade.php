@extends('layouts.app')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Materi</h1>
        </div>

        <div class="section-body">

            <div class="card">
                <div class="card-header">
                    <h4><i class="fas fa-question"></i> Materi</h4>
                </div>

                <div class="card-body">
                    
                    <form action="{{ route('materi.index') }}" method="GET">
                    @can('materi.create')
                        <div class="form-group">
                            <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <a href="{{ route('materi.create') }}" class="btn btn-primary" style="padding-top: 10px;"><i class="fa fa-plus-circle"></i> TAMBAH</a>
                                    </div>
                                <input type="text" class="form-control" name="q"
                                       placeholder="cari berdasarkan judul">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> CARI
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endcan
                    </form>

                    @can('materi.tentor')
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                            <tr> 
                                <th scope="col" style="text-align: center;width: 6%">NO.</th>
                                <th scope="col">JUDUL</th>
                                <th scope="col">MATA PELAJARAN</th>
                                <th scope="col">DOKUMEN MATERI</th>
                                <th scope="col" style="width: 15%;text-align: center">AKSI</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($materis as $no => $materi)
                            @if ($materi->user_id_teacher == Auth::user()->id)
                                <tr>
                                    <th scope="row" style="text-align: center">{{ ++$no + ($materis->currentPage()-1) * $materis->perPage() }}</th>
                                    <td>{{ $materi->judul }}</td>
                                    <td>{{ $materi->mapel }}</td>
                                    <td>
                                        <a href="{{ asset('storage/public/materis/'.$materi->link) }}" download> <i class="fas fa-file-download"></i> Download
                                    </td>
                                    <td class="text-center">
                                        @can('materi.edit')
                                            <a href="{{ route('materi.edit', $materi->id) }}" class="btn btn-sm btn-primary">
                                                <i class="fa fa-pencil-alt"></i>
                                            </a>
                                        @endcan
                                        
                                        @can('materi.delete')
                                            <button onClick="Delete(this.id)" class="btn btn-sm btn-danger" id="{{ $materi->id }}">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        @endcan
                                    </td>
                                </tr>
                            @endif
                            @endforeach
                            </tbody>
                        </table>
                        <div style="text-align: center">
                            {{$materis->links("vendor.pagination.bootstrap-4")}}
                        </div>
                    </div>
                    @endcan

                    @can('materi.showlist')
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th scope="col" style="text-align: center;width: 6%">NO.</th>
                                <th scope="col">Mata Pelajaran</th>
                                <th scope="col">JUDUL</th>
                                <th scope="col">Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($materis as $no => $materi)
                            @if ($materi->kelas == Auth::user()->kelas)
                                <tr>
                                    <th scope="row" style="text-align: center">{{ ++$no + ($materis->currentPage()-1) * $materis->perPage() }}</th>
                                    <td>{{ $materi->mapel }}</td>
                                    <td>{{ $materi->judul }}</td>
                                    <td>
                                        <a href="materi/showMateri/{{ $materi->id }}" class="btn btn-sm btn-info">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endif
                            @endforeach
                            </tbody>
                        </table>
                        <div style="text-align: center">
                            {{$materis->links("vendor.pagination.bootstrap-4")}}
                        </div>
                    </div>
                    @endcan

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
                        url: "{{ route("materi.index") }}/"+id,
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