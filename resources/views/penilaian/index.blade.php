@extends('layouts.app')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Penilaian Tentor</h1>
        </div>

        <div class="section-body">

            <div class="card">
                <div class="card-header">
                    <h4><i class="fas fa-exam"></i> Penilaian Tentor</h4>
                </div>

                <div class="card-body">
                    <form action="{{ route('penilaian.index') }}" method="GET">
                        @hasanyrole('admin')
                        <div class="form-group">
                            <div class="input-group mb-3">
                                @can('penilaian.create')
                                    <div class="input-group-prepend">
                                        <a href="{{ route('penilaian.create') }}" class="btn btn-primary" style="padding-top: 10px;"><i class="fa fa-plus-circle"></i> TAMBAH</a>
                                    </div>
                                @endcan
                                <input type="text" class="form-control" name="q"
                                       placeholder="cari berdasarkan nama penilaian">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> CARI
                                    </button>
                                </div>
                            </div>
                        </div>
                        @endhasanyrole
                    </form>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                          
                                <th scope="col">NAME</th>
                                <th scope="col">TIME</th>
                                <th scope="col">TOTAL PERTANYAAN</th>
                                @hasrole('admin')
                                <th scope="col">ASSIGN STUDENT</th>
                                @endhasrole
                                <th scope="col">START</th>
                                <th scope="col">END</th>
                                <th scope="col" style="width: 15%;text-align: center">AKSI</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($penilaian as $no => $penilaian)
                                <tr>
                                    
                                    <td>{{ $penilaian->name }}</td>
                                    <td>{{ $penilaian->time }}</td>
                                    <td>{{ $penilaian->total_pertanyaan }}</td>
                                    @hasrole('admin')
                                    <td>{{ $penilaian->user->count() }}</td>
                                    @endhasrole
                                    <td>{{ TanggalID($penilaian->start) }}</td>
                                    <td>{{ TanggalID($penilaian->end) }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('penilaian.show', $penilaian->id) }}" class="btn btn-sm btn-info">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        @can('penilaian.edit')
                                            <a href="{{ route('penilaian.edit', $penilaian->id) }}" class="btn btn-sm btn-primary">
                                                <i class="fa fa-pencil-alt"></i>
                                            </a>
                                        @endcan

                                        @can('penilaian.riwayat')
                                        <a href="penilaian/riwayat/{{ $penilaian->id }}" class="btn btn-sm btn-primary"><i class="fa fa-list"></i></a>
                                        @endcan
                                        @hasrole('admin')
                                        <a href="{{ route('penilaian.student', $penilaian->id) }}" class="btn btn-sm btn-primary">
                                            <i class="fa fa-door-open"></i>
                                        </a>
                                        @endhasrole
                                        
                                        @can('penilaian.delete')
                                            <button onClick="Delete(this.id)" class="btn btn-sm btn-danger" id="{{ $penilaian->id }}">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                      
                    </div>
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
                        url: "{{ route("penilaian.index") }}/"+id,
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