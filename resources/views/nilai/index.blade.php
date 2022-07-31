@extends('layouts.app')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Ujian</h1>
        </div>

        <div class="section-body">

            <div class="card">
                <div class="card-header">
                    <h4><i class="fas fa-exam"></i> Nilai Ujian </h4>
                </div>

                <div class="card-body">
                    <div class="my-2">
                        <!-- <form action="{{ route('nilai.exportPDF') }}" method="GET"> -->
                            <div class="input-group mb-3">
                            <a href="/nilai/exportPDF" target="_blank" class="btn btn-danger" style="padding-top: 10px; margin-left: 5px;"> Cetak PDF</a>
                            </div>
                        <!-- </form> -->
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th scope="col" style="text-align: center;width: 6%">NO.</th>
                                <th scope="col">NAME</th>
                                @hasrole('student')
                                <th scope="col">SCORE</th>
                                @endhasrole
                                <th scope="col">TANGGAL</th>
                                <!-- <th scope="col">END</th> -->
                                <!-- <th scope="col" style="width: 15%;text-align: center">AKSI</th> -->
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($exams as $no => $exam)
                                <tr>
                                    <th scope="row" style="text-align: center">{{ ++$no + ($exams->currentPage()-1) * $exams->perPage() }}</th>
                                    <td>{{ $exam->name }}</td>
                                    <!-- <td>{{ $exam->time }}</td> -->
                                    <!-- <td>{{ $exam->questions->count() }}</td> -->
                                    @hasanyrole('teacher|admin')
                                    <td>{{ $exam->users->count() }}</td>
                                    @endhasanyrole
                                    @hasrole('student')
                                    <td>{{  $user->getScore(Auth()->id(), $exam->id) !== null ? $user->getScore(Auth()->id(), $exam->id) : "Belum dikerjakan"  }}</td>
                                    @endhasrole
                                    <td>{{ $exam->created_at }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div style="text-align: center">
                            {{$exams->links("vendor.pagination.bootstrap-4")}}
                        </div>
                    </div>
                </div>
                
            </div>            
        </div>

    </section>
    
</div>
@stop