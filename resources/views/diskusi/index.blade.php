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
                                <!-- <input type="text" class="form-control" name="q"
                                       placeholder="cari berdasarkan materi">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> CARI
                                    </button>
                                </div> -->
                            </div>
                        </div>
                    @endcan
                    </form>
                    
                    <!-- <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                            <tr> 
                    
                                <th scope="col">MATERI</th>
                                <th scope="col">PERTANYAAN</th>
                                <th scope="col">TANGGAL</th>
                                <th scope="col">NAMA</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($diskusi as $diskusi)
                            @if ($diskusi->user_id == Auth::user()->id)
                                <tr>
                                   
                                    <td>{{ $diskusi->materi }}</td>
                                    <td>{{ $diskusi->pertanyaan }}</td>
                                    <td>{{ $diskusi->created_at }}</td>
                                    <td>{{ $diskusi->user->name }}</td>
                                </tr>
                            @endif
                            @endforeach
                            </tbody>
                        </table>
               
                    </div> -->

                    <div class="card card-default  mb-2">
                    @if ($diskusi->user_id == Auth::user()->id)
                        <div class="card-header">
                            <span class="">{{$diskusi->user->name}}, <b>{{$diskusi->created_at->diffForhumans()}}</b></span>
                        </div>
                        <div class="card-body">
                            <h5 class="">{{$diskusi->materi}}</h5>
                            <hr>
                            <p class="">{{($diskusi->pertanyaan)}} </p> 
                        </div>
                        <div class="card-footer">
                            <p> Replies</p>
                        </div>
                    @endif
                    </div>
              
                </div>
            </div>
        </div>

    </section>
</div>

@stop