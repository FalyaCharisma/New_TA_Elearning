@extends('layouts.app')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Materi</h1>
        </div>

        <div class="section-body">

            <div class="card">
                <div class="card-header">
                    <h4><i class="fas fa-question"></i> Materi</h4>
                </div>
                <div class="card-body">

                    @can('materi.showMateri')
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                            <tr>                      
                                <th scope="col">Mata Pelajaran</th>
                                <th scope="col">JUDUL</th>
                                <th scope="col">ISI</th>
                            </tr>
                            </thead>
                            <tbody>          
                                <tr>                                   
                                    <td>{{ $materis->mapel }}</td>
                                    <td>{{ $materis->judul }}</td>
                                    <td>{{ $materis->isi }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    @endcan

                </div>
            </div>
        </div>

    </section>
</div>

@stop