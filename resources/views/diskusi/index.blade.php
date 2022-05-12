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

                </div>
            </div>
        </div>

    </section>
</div>

@stop