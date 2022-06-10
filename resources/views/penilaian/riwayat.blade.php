@extends('layouts.app')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Riwayat Penilaian Evaluasi Tentor</h1>
        </div>
 
        <div class="section-body">
            @can('penilaian.riwayat')
            <div class="card">
                <div class="card-header">
                    <h4><i class="fas fa-exam"></i>{{ $penilaian->name }}</h4>
                </div>

                <div class="card-body">
                    <form action="{{ url('penilaian/riwayat', $penilaian->id) }}" method="GET">
                        <div class="form-group">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name="q"
                                       placeholder="cari berdasarkan nama tentor">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> CARI
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                    
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                               
                                <th scope="col">NAMA TENTOR</th>
                                <th scope="col">KUALITAS</th>
                                <th scope="col">PEMBELAJARAN</th>
                                <th scope="col">ISI EVALUASI</th>
                                <th scope="col">NAMA SISWA</th>
                                <th scope="col">TANGGAL</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($evaluasis as $no => $evaluasi)
                                <tr>
                                    
                                    <td>{{ $evaluasi->user->siswa->nama_tentor }}</td>
                                    <td>{{ $evaluasi->kualitas }}</td>
                                    <td>{{ $evaluasi->pembelajaran }}</td>
                                    <td>{{ $evaluasi->isi }}</td>
                                    <td>{{ $evaluasi->user->siswa->name }}</td>
                                    <td>{{ $evaluasi->created_at }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                       
                    </div>
                </div>
            </div>
            @endcan
        </div>

    </section>
</div>

@stop