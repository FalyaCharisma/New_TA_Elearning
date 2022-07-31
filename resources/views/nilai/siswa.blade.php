@extends('layouts.app')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Nilai Ujian Siswa</h1>
        </div>

        <div class="section-body">

            <div class="card">
                <div class="card-header">
                    <h4><i class="fas fa-exam"></i> Nilai Ujian Siswa</h4>
                </div>

                <div class="card-body">
                    <div class="my-2">
                        <!-- <form action="{{ route('nilai.exportPDF') }}" method="GET"> -->
                            <div class="input-group mb-3">
                            <a href="/nilai/cetakNilai/{{ $users->id }}" target="_blank" class="btn btn-danger" style="padding-top: 10px; margin-left: 5px;"> Cetak PDF</a>
                            </div>
                        <!-- </form> -->
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th scope="col" style="text-align: center;width: 6%">NO.</th>
                                <th scope="col">NAMA UJIAN</th>     
                                <th scope="col">NILAI</th>
                                <th scope="col">TANGGAL</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php
                                $count=1;
                            @endphp
                            @foreach ($users->exams as $no => $exam_user)
                                <tr>            
                                    <td>{{ $count++}}</td>
                                    <td>{{ $exam_user->name}}</td>
                                    @if( $exam_user->pivot->score === null)
                                    <td>0</td>
                                    @else
                                    <td>{{ $exam_user->pivot->score }}</td>
                                    @endif
                                    <td>{{ $exam_user->pivot->created_at}}</td>
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
@stop