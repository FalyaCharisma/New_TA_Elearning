@extends('layouts.app')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Dashboard</h1>
        </div>
        @hasanyrole('teacher|admin')
          <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-primary">
                  <i class="fa fa-book-open text-white fa-2x"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>EXAMS</h4>
                  </div>
                  <div class="card-body">
                    {{ App\Models\Exam::count() ?? '0' }}
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-danger">
                  <i class="fa fa-bell text-white fa-2x"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>QUESTIONS</h4>
                  </div>
                  <div class="card-body">
                    {{ App\Models\Question::count() ?? '0' }}
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-warning">
                  <i class="fa fa-tags text-white fa-2x"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>SUBJECTS</h4>
                  </div>
                  <div class="card-body">
                    {{ App\Models\Subject::count() ?? '0' }}
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-success">
                  <i class="fa fa-users text-white fa-2x"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>STUDENTS</h4>
                  </div>
                  <div class="card-body">
                    {{ App\Models\User::role('student')->count() ?? '0' }}
                  </div>
                </div>
              </div>
            </div>                  
          </div>
        @endhasanyrole
        @hasrole('student')
        <div class="row">
          <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
              <div class="card-icon bg-primary">
                <i class="fa fa-book-open text-white fa-2x"></i>
              </div>
              <div class="card-wrap">
                <div class="card-header">
                  <h4>MY EXAMS</h4>
                </div>
                <div class="card-body">
                  {{ $exams->count() ?? '0' }}
                </div>
              </div>
            </div>
          </div>
        </div>
        @endhasrole

        @hasrole('student')
        @foreach ($mapels->chunk(4) as $mapel)
        <div class="row">
          <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
              <div class="card-icon bg-primary">
                <i class="fa fa-book-open text-white fa-2x"></i>
              </div>
              <div class="card-wrap">
                <div class="card-header">
                @foreach($mapel as $m)
                  <h4>{{ $m->mata_pelajaran }}</h4>
                  <h4>{{ $user->kelas }}</h4>
                </div>
              
              </div>
              <a href="../Student/Materi/List/{{ $m->id }}" class="small-box-footer">Lihat List Materi <i class="fas fa-arrow-circle-right"></i></a>
            </div>
            
            @endforeach
          </div>
          
          @endforeach
        </div>
        @endhasrole
    </section>
</div>
@endsection