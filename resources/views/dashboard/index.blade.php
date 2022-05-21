@extends('layouts.app')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Dashboard</h1>
        </div>
        @hasanyrole('teacher')
          <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-danger">
                  <i class="fa fa-book-open text-white fa-2x"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>UJIAN</h4>
                  </div>
                  <div class="card-body">
                    {{ App\Models\Exam::count() ?? '0' }}
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-warning">
                  <i class="fa fa-book text-white fa-2x"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>MATERI</h4>
                  </div>
                  <div class="card-body">
                    {{ App\Models\Materi::count() ?? '0' }}
                  </div>
                </div>
              </div>
            </div>
            
          </div>
        @endhasrole
        @hasanyrole('admin')
          <div class="row">
          <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-warning">
                  <i class="fa fa-users text-white fa-2x"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>SISWA</h4>
                  </div>
                  <div class="card-body">
                    {{ App\Models\User::role('student')->count() ?? '0' }}
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
                    <h4>TENTOR</h4>
                  </div>
                  <div class="card-body">
                    {{ App\Models\User::role('teacher')->count() ?? '0' }}
                  </div>
                </div>
              </div>
            </div>   
          <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-primary">
                  <i class="fa fa-book text-white fa-2x"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>MATA PELAJARAN</h4>
                  </div>
                  <div class="card-body">
                    {{ App\Models\mataPelajaran::count() ?? '0' }}
                  </div>
                </div>
              </div>
            </div>  
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-danger">
                  <i class="fa fa-graduation-cap text-white fa-2x"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>KELAS</h4>
                  </div>
                  <div class="card-body">
                    {{ App\Models\Kelas::count() ?? '0' }}
                  </div>
                </div>
              </div>
            </div>              
          </div>
        @endhasrole
        @hasrole('student')
        <div class="row">
          <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
              <div class="card-icon bg-danger">
                <i class="fa fa-book-open text-white fa-2x"></i>
              </div>
              <div class="card-wrap">
                <div class="card-header">
                  <h4>UJIAN</h4>
                </div>
                <div class="card-body">
                  {{ $exams->count() ?? '0' }}
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
              <div class="card-icon bg-primary">
                <i class="fa fa-book text-white fa-2x"></i>
              </div>
              <div class="card-wrap">
                <div class="card-header">
                  <h4>MATERI</h4>
                </div>
                <div class="card-body">
                {{ App\Models\Materi::count() ?? '0' }}
                </div>
              </div>
            </div>
          </div>
        </div>
        @endhasrole

       
    </section>
</div>
@endsection