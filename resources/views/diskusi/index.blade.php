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
                             <span class="">{{$diskusi->user->username}}, <b>{{$diskusi->created_at }}</b></span>
                        </div>
                        <div class="card-body">
                            <h5 class="">{{$diskusi->materi}}</h5>
                            <hr>
                            <div class="input-group-prepend">
                                <a href="diskusi/showDiskusi/{{ $diskusi->id }}" class="btn btn-primary" style="padding-top: 10px;"> Lihat Diskusi</a>
                            </div>
                        </div>
                        <div class="card-footer">
                       
                        </div>
                    @endif
                    </div>
                    @endforeach
                    @endcan

                    @can('diskusi.tentor')
                    @foreach($diskusi as $diskusi)
                    <div class="card card-default mb-2">
                   
                        <div class="card-header">
                             <span class="">{{$diskusi->user->username}}, <b>{{$diskusi->created_at }}</b></span>
                        </div>
                        <div class="card-body">
                            <h5 class="">{{$diskusi->materi}}</h5>
                            <hr>
                            <div class="input-group-prepend">
                                <a href="diskusi/showDiskusi/{{ $diskusi->id }}" class="btn btn-primary" style="padding-top: 10px;"> Lihat Diskusi</a>
                            </div>
                        </div>
                        <div class="card-footer">   
                        </div>
                    
                
                    </div>
                    @endforeach
                    @endcan
                  
                </div>
            </div>
        </div>

    </section>
</div>

@stop