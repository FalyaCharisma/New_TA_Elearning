@extends('layouts.app')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Jadwal</h1>
        </div> 

        <div class="section-body">

            <div class="card">
                <div class="card-header">
                    <h4><i class="fas fa-info"></i> Jadwal</h4>
                </div>

                <div class="card-body">
                    <form action="{{ route('jadwal.index') }}" method="GET">
                        <div class="form-group">
                            <div class="input-group mb-3">
                                @can('jadwal.create')
                                    <div class="input-group-prepend">
                                        <a href="{{ route('jadwal.create') }}" class="btn btn-primary" style="padding-top: 10px;"><i class="fa fa-plus-circle"></i> TAMBAH</a>
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
             
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th scope="col" style="text-align: center;width: 6%">NO.</th>
                                <th scope="col">Nama Tentor</th>
                                <th scope="col">Nama Siswa</th>
                                <th scope="col">Senin</th>
                                <th scope="col">Selasa</th>
                                <th scope="col">Rabu</th>
                                <th scope="col">Kamis</th>
                                <th scope="col">Jumat</th>
                                <th scope="col">Sabtu</th>
                                <th scope="col">Minggu</th>
                                <!-- <th scope="col">Jam Masuk</th> -->
                                <!-- <th scope="col">Jam pulang</th> -->
                                <!-- <th scope="col">Jadwal Hari</th> -->      
                                <!-- <th scope="col">END</th> -->
                                @hasrole('admin')
                                <th scope="col" style="width: 15%;text-align: center">AKSI</th>
                                @endhasrole
                            </tr>
                            </thead>
                            <tbody>
                                @php
                                    $count=1;
                                @endphp
                            @foreach ($jadwals as $no => $jadwal)
                                <tr>
                                    <th>{{ $count++ }}</th>
                                    @if($jadwal->nama_siswa!==null)
                                    @foreach($siswa as $siswa)
                                    @if($jadwal->nama_siswa == $siswa->name)
                                    <td>{{ $siswa->nama_tentor  }}</td>
                                    @endif
                                    @endforeach
                                    @endif
                                    <td>{{ $jadwal->nama_siswa }}</td>
                                    <td>{{ $jadwal->senin[0] }} - {{ $jadwal->senin[1] }}</td>
                                    <td>{{ $jadwal->selasa[0] }} - {{ $jadwal->selasa[1] }}</td>
                                    <td>{{ $jadwal->rabu[0] }} - {{ $jadwal->rabu[1] }}</td>
                                    <td>{{ $jadwal->kamis[0] }} - {{ $jadwal->kamis[1] }}</td>
                                    <td>{{ $jadwal->jumat[0] }} - {{ $jadwal->jumat[1] }}</td>
                                    <td>{{ $jadwal->sabtu[0] }} - {{ $jadwal->sabtu[1] }}</td>
                                    <td>{{ $jadwal->minggu[0] }} - {{ $jadwal->minggu[1] }}</td>
                                   
                                    <td class="text-center">
                                    @can('jadwal.edit')
                                            <a href="{{route('jadwal.edit', $jadwal->id)}}" class="btn btn-sm btn-primary">
                                                <i class="fa fa-pencil-alt"></i>
                                            </a>
                                    @endcan 
                                    @can('jadwal.delete')
                                            <button onClick="Delete(this.id)" class="btn btn-sm btn-danger" id="{{ $jadwal->id }}">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                    @endcan
                                    </td>
                                
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div style="text-align: center">
                        {{ $jadwals->links('vendor.pagination.bootstrap-4') }}
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
                        url: "{{ route("jadwal.index") }}/"+id,
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