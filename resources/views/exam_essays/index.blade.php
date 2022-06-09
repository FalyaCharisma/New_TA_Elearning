@extends('layouts.app')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Exams</h1>
        </div>

        <div class="section-body">

            <div class="card">
                <div class="card-header">
                    <h4><i class="fas fa-exam"></i> Exam</h4>
                </div>

                <div class="card-body">
                    <form action="{{ route('exam_essays.index') }}" method="GET">
                        @hasanyrole('teacher|admin')
                        <div class="form-group">
                            <div class="input-group mb-3">
                                @can('exam_essays.create')
                                    <div class="input-group-prepend">
                                        <a href="{{ route('exam_essays.create') }}" class="btn btn-primary" style="padding-top: 10px;"><i class="fa fa-plus-circle"></i> TAMBAH</a>
                                    </div>
                                @endcan
                                <input type="text" class="form-control" name="q"
                                       placeholder="cari berdasarkan nama exam">
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
                                <th scope="col" style="text-align: center;width: 6%">NO.</th>
                                <th scope="col">NAME</th>
                                <th scope="col">TIME</th>
                                <th scope="col">TOTAL QUESTION</th>
                                @hasanyrole('teacher|admin')
                                <th scope="col">ASSIGN STUDENT</th>
                                @endhasanyrole
                                @hasrole('student')
                                <th scope="col">SCORE</th>
                                @endhasrole
                                <th scope="col">START</th>
                                <th scope="col">END</th>
                                <th scope="col" style="width: 15%;text-align: center">AKSI</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($exam_essays as $no => $exam)
                                <tr>
                                    <th scope="row" style="text-align: center">{{ ++$no + ($exam_essays->currentPage()-1) * $exam_essays->perPage() }}</th>
                                    <td>{{ $exam->name }}</td>
                                    <td>{{ $exam->time }}</td>
                                    <td>{{ $exam->questions->count() }}</td>
                                    @hasanyrole('teacher|admin')
                                    <td>{{ $exam->users->count() }}</td>
                                    @endhasanyrole
                                    @hasrole('student')
                                    <td>{{  $user->getScore(Auth()->id(), $exam->id) !== null ? $user->getScore(Auth()->id(), $exam->id) : "Belum dikerjakan"  }}</td>
                                    @endhasrole
                                    <td>{{ TanggalID($exam->start) }}</td>
                                    <td>{{ TanggalID($exam->end) }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('exam_essays.show', $exam->id) }}" class="btn btn-sm btn-info">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        @can('exam_essays.edit')
                                            <a href="{{ route('exam_essays.edit', $exam->id) }}" class="btn btn-sm btn-primary">
                                                <i class="fa fa-pencil-alt"></i>
                                            </a>
                                        @endcan
                                        
                                        @hasanyrole('teacher|admin')
                                        <a href="{{ route('exam_essays.student', $exam->id) }}" class="btn btn-sm btn-primary">
                                            <i class="fa fa-door-open"></i>
                                        </a>
                                        @endhasanyrole
                                        
                                        @can('exam_essays.delete')
                                            <button onClick="Delete(this.id)" class="btn btn-sm btn-danger" id="{{ $exam->id }}">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div style="text-align: center">
                            {{$exam_essays->links("vendor.pagination.bootstrap-4")}}
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('exam_essays.index') }}" method="GET">
                        @hasanyrole('teacher|admin')
                        <div class="form-group">
                            <div class="input-group mb-3">
                                @can('exam_essays.create')
                                    <div class="input-group-prepend">
                                        <a href="{{ route('exam_essays.create') }}" class="btn btn-primary" style="padding-top: 10px;"><i class="fa fa-plus-circle"></i> TAMBAH ESSAY</a>
                                    </div>
                                @endcan
                                <input type="text" class="form-control" name="q"
                                       placeholder="cari berdasarkan nama exam">
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
                                <th scope="col" style="text-align: center;width: 6%">NO.</th>
                                <th scope="col">NAME</th>
                                <th scope="col">TIME</th>
                                <th scope="col">TOTAL QUESTION</th>
                                @hasanyrole('teacher|admin')
                                <th scope="col">ASSIGN STUDENT</th>
                                @endhasanyrole
                                @hasrole('student')
                                <th scope="col">SCORE</th>
                                @endhasrole
                                <th scope="col">START</th>
                                <th scope="col">END</th>
                                <th scope="col" style="width: 15%;text-align: center">AKSI</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($exam_essays as $no => $exam)
                                <tr>
                                    <th scope="row" style="text-align: center">{{ ++$no + ($exam_essays->currentPage()-1) * $exam_essays->perPage() }}</th>
                                    <td>{{ $exam->name }}</td>
                                    <td>{{ $exam->time }}</td>
                                    <td>{{ $exam->questions->count() }}</td>
                                    @hasanyrole('teacher|admin')
                                    <td>{{ $exam->users->count() }}</td>
                                    @endhasanyrole
                                    @hasrole('student')
                                    <td>{{  $user->getScore(Auth()->id(), $exam->id) !== null ? $user->getScore(Auth()->id(), $exam->id) : "Belum dikerjakan"  }}</td>
                                    @endhasrole
                                    <td>{{ TanggalID($exam->start) }}</td>
                                    <td>{{ TanggalID($exam->end) }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('exam_essays.show', $exam->id) }}" class="btn btn-sm btn-info">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        @can('exam_essays.edit')
                                            <a href="{{ route('exam_essays.edit', $exam->id) }}" class="btn btn-sm btn-primary">
                                                <i class="fa fa-pencil-alt"></i>
                                            </a>
                                        @endcan
                                        
                                        @hasanyrole('teacher|admin')
                                        <a href="{{ route('exam_essays.student', $exam->id) }}" class="btn btn-sm btn-primary">
                                            <i class="fa fa-door-open"></i>
                                        </a>
                                        @endhasanyrole
                                        
                                        @can('exam_essays.delete')
                                            <button onClick="Delete(this.id)" class="btn btn-sm btn-danger" id="{{ $exam->id }}">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div style="text-align: center">
                            {{$exam_essays->links("vendor.pagination.bootstrap-4")}}
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
                        url: "{{ route("exams.index") }}/"+id,
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