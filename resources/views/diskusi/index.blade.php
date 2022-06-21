@extends('layouts.app')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Forum Diskusi</h1>
        </div>

        <div class="section-body">

            <div class="card">
                <div class="card-header">
                    <h4><i class="fas fa-question"></i> Forum Diskusi</h4>
                </div>

                <div class="card-body">
                    
                    <form action="{{ route('diskusi.index') }}" method="GET">
                    @can('diskusi.create')
                        <div class="form-group">
                            <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <a href="{{ route('diskusi.create') }}" class="btn btn-primary" style="padding-top: 10px;"><i class="fa fa-plus-circle"></i> Ajukan Pertanyaan</a>
                                    </div>
                            </div>
                        </div>
                    @endcan
                    </form>
                    
                    @can('diskusi.siswa')
                    @foreach($diskusi as $diskusi)
                    <div class="card card-default mb-2">
                    @if ($diskusi->user_id == Auth::user()->id)
                        <div class="card-header">
                             <span class="">{{$diskusi->user->siswa->name}}, <b>{{$diskusi->created_at }}</b></span>
                        </div>
                        <div class="card-body">
                            <h5 class="">{{ $materi->getMapel($diskusi->materi_id) }} - {{ $materi->getJudul($diskusi->materi_id) }}</h5>
                            <hr>
                            {{$diskusi->pertanyaan }}
                            <hr>
                            <div class="input-group-prepend">
                                <a href="diskusi/showDiskusi/{{ $diskusi->id }}" class="btn btn-primary" style="padding-top: 10px;"> Lihat Diskusi</a>
                            @can('diskusi.edit')
                            <a href="{{ route('diskusi.edit', $diskusi->id) }}" class="btn btn-sm btn-primary" style="padding-top: 10px; margin-left:5px">Edit</a>
                            @endcan
                            </div>
                        </div>
                    @endif
                    </div>
                    @endforeach
                    @endcan

                    @can('diskusi.tentor')
                    @foreach($diskusi as $diskusi)
                    <div class="card card-default mb-2"> 
                    @if ($diskusi->user->siswa->nama_tentor == Auth::user()->tentor->name)
                        <div class="card-header">
                             <span class="">{{$diskusi->user->siswa->name}}, <b>{{$diskusi->created_at }}</b></span>
                        </div>
                        <div class="card-body">
                            <h5 class="">{{ $materi->getMapel($diskusi->materi_id) }} - {{ $materi->getJudul($diskusi->materi_id) }}</h5>
                            <hr>
                            {{$diskusi->pertanyaan }}
                            <hr>
                            <div class="input-group-prepend">
                                <a href="diskusi/showDiskusi/{{ $diskusi->id }}" class="btn btn-primary" style="padding-top: 10px;"> Lihat Diskusi </a>
                            @can('diskusi.delete')
                            <button onClick="Delete(this.id)" class="btn btn-sm btn-danger" style="margin-left: 10px;" id="{{ $diskusi->id }}">
                                Hapus
                            </button>
                            @endcan
                            </div>
                        </div>
                    @endif
                    </div>
                    @endforeach
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
                        url: "{{ route("diskusi.index") }}/"+id,
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