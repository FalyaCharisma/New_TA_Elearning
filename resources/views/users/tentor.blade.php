@extends('layouts.app')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Data Tentor</h1>
        </div>

        <div class="section-body">

            <div class="card">
                <div class="card-header">
                    <h4><i class="fas fa-users"></i> Data Tentor</h4>
                </div>

                <div class="card-body">
                    <form action="{{ route('users.tentor') }}" method="GET">
                        <div class="form-group">
                            <div class="input-group mb-3">
                                @can('users.createTentor')
                                    <div class="input-group-prepend">
                                        <a href="{{ route('users.createTentor') }}" class="btn btn-primary" style="padding-top: 10px;"><i class="fa fa-plus-circle"></i> TAMBAH</a>
                                    </div>
                                @endcan
                                <input type="text" class="form-control" name="q"
                                       placeholder="cari berdasarkan nama user">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> CARI
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>

                    @can('users.tentor')
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th scope="col" style="text-align: center;width: 6%">NO.</th>
                                <th scope="col">NAMA</th>
                                <th scope="col">NO. WA</th>
                                <th scope="col">ALAMAT</th>
                                @hasrole('superadmin')
                                <th scope="col">CABANG</th>
                                @endhasrole
                                <th scope="col" style="width: 15%;text-align: center">AKSI</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php
                                $count = 1;
                            @endphp
                            @foreach ($users as $no => $user)
                            @if(!empty($user->getRoleNames()))
                            @foreach($user->getRoleNames() as $role)
                            @if($role=='teacher')
                            @hasrole('admin')
                            @if(Auth::user()->admin->cabang == $user->tentor->cabang)
                                <tr>
                                <td>{{ $count++ }}</td>
                                    <td>{{ $user->tentor->name }}</td>
                                    <td>{{ $user->tentor->no_wa }}</td>
                                    <td>{{ $user->tentor->alamat }}</td>
                                    <td class="text-center">
                                            <a href="{{ route('edittTentor', $user->tentor->id) }}"  class="btn btn-sm btn-primary">
                                                <i class="fa fa-pencil-alt"></i>
                                            </a>                   
                                        @can('users.delete')
                                            <button onClick="Delete(this.id)" class="btn btn-sm btn-danger" id="{{ $user->id }}">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        @endcan
                                    </td>
                                </tr>
                            @endif
                            @endhasrole

                            @hasrole('superadmin')
                                <tr>
                                <td>{{ $count++ }}</td>
                                    <td>{{ $user->tentor->name }}</td>
                                    <td>{{ $user->tentor->no_wa }}</td>
                                    <td>{{ $user->tentor->alamat }}</td>
                                    <td>{{ $user->tentor->cabang }}</td>
                                    <td class="text-center">
                                            <a href="{{ route('edittTentor', $user->tentor->id) }}"  class="btn btn-sm btn-primary">
                                                <i class="fa fa-pencil-alt"></i>
                                            </a>                   
                                        @can('users.delete')
                                            <button onClick="Delete(this.id)" class="btn btn-sm btn-danger" id="{{ $user->id }}">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        @endcan
                                    </td>
                                </tr>
                            @endhasrole

                            @endif
                            @endforeach
                            @endif
                            @endforeach
                            </tbody>
                        </table>
                        <div style="text-align: center">
                            {{$users->links("vendor.pagination.bootstrap-4")}}
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
                        url: "{{ route("users.index") }}/"+id,
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