@extends('layouts.app')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Riwayat Exam</h1>
        </div>
 
        <div class="section-body">
  
            <div class="card">
                <div class="card-header">
                    <h4><i class="fas fa-exam"></i>{{ $exam->name }}</h4>
                </div>

                <div class="card-body">
                    
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                               
                                <th scope="col">NAMA SISWA</th>
                                <th scope="col">SCORE</th>
                                <th scope="col">LIHAT</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($exam->users as $no => $exam_user)
                                <tr>            
                                    <td>{{ $users->getName($exam_user->pivot->user_id) }}</td>
                                    @if( $exam_user->pivot->score === null)
                                    <td>Belum Dikerjakan</td>
                                    @else
                                    <td>{{ $exam_user->pivot->score }}</td>
                                    @endif
                                    <td>
                                        <a href="{{ route('exams.review', [$exam_user->pivot->user_id, $exam->id]) }}"><i class="fa fa-eye"></i></a>
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

@stop