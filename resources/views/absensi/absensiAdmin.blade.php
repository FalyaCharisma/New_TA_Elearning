@extends('layouts.app')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Absensi</h1>
        </div>

        <div class="section-body">

            <div class="card">
                <div class="card-header">
                    <h4><i class="fas fa-image"></i> Riwayat Absensi Tentor</h4>
                </div>

                <div class="card-body">
                    
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th scope="col" style="text-align: center;width: 6%">NO.</th>
                                <th scope="col">NAMA</th>
                                <th scope="col">FOTO</th>
                                <th scope="col">KETERANGAN</th>
                                <th scope="col">TANGGAL</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($absens as $no => $absensis)
                                <tr>
                                    <th scope="row" style="text-align: center">{{ ++$no + ($absens->currentPage()-1) * $absens->perPage() }}</th>
                                    <td>{{ $absensis->user->name }}</td>
                                    <td><img src="{{ asset('storage/public/absensis/'. $absensis->link) }}" width="150" ></td>
                                    <td>{{ $absensis->keterangan }}</td>
                                    <td>{{ $absensis->created_at }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div style="text-align: center">
                            {{$absens->links("vendor.pagination.bootstrap-4")}}
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
</div>

@stop