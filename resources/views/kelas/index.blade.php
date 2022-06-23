@extends('layouts.app')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Kelas</h1>
        </div>

        <div class="section-body">

            @can('kelas.create')
                <div class="card">
                    <div class="card-header">
                        <h4><i class="fas fa-graduation-cap"></i> New Class</h4>
                    </div>

                    <div class="card-body">

                        <form action="{{ route('kelas.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <label>NAME</label>
                                <input type="text" name="nama_kelas" value="{{ old('nama_kelas') }}" placeholder="Masukkan Nama Kelas" class="form-control @error('nama_kelas') is-invalid @enderror">

                                @error('nama_kelas')
                                <div class="invalid-feedback" style="display: block">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <button class="btn btn-primary mr-1 btn-submit" type="submit"><i class="fa fa-check-circle"></i> SUBMIT</button>
                            <button class="btn btn-warning btn-reset" type="reset"><i class="fa fa-redo"></i> RESET</button>


                        </form>

                    </div>
                </div>
            @endcan

            <div class="card">
                <div class="card-header">
                    <h4><i class="fas fa-graduation-cap"></i>Kelas</h4>
                </div>

                <div class="card-body">
                    
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th scope="col" style="text-align: center;width: 6%">NO.</th>
                                <th scope="col">NAMA KELAS</th>
                                <th scope="col" style="width: 15%;text-align: center">AKSI</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($kelass as $no => $kelas)
                                <tr>
                                    <th scope="row" style="text-align: center">{{ ++$no + ($kelass->currentPage()-1) * $kelass->perPage() }}</th>
                                    <td>{{ $kelas->nama_kelas }}</td>
                                    <td class="text-center">
                                        @can('kelas.delete')
                                            <button onClick="Delete(this.id)" class="btn btn-sm btn-danger" id="{{ $kelas->id }}">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div style="text-align: center">
                            {{$kelass->links("vendor.pagination.bootstrap-4")}}
                        </div>
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
                        url: "{{ route("kelas.index") }}/"+id,
                        data:     {
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