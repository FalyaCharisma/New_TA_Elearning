@extends('layouts.app')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Absensi</h1>
        </div>

        <div class="section-body">

            @can('absensi.create')
                <div class="card">
                    <div class="card-header">
                        <h4><i class="fas fa-image"></i> Upload Image</h4>
                    </div>

                    <div class="card-body">

                        <form action="{{ route('absensi.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <label>FOTO</label>
                                <input type="file" name="image" id="image" class="form-control @error('image') is-invalid @enderror">

                                @error('image')
                                <div class="invalid-feedback" style="display: block">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>


                            <div class="form-group">
                            <label>KETERANGAN</label><br>
                            <input type="radio" name="keterangan" value="Hadir" checked> Hadir
                            <input type="radio" name="keterangan" value="Izin"> Izin
                            <input type="radio" name="keterangan" value="Sakit"> Sakit
                            @error('keterangan')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                            @enderror
                            </div>

                            <button class="btn btn-primary mr-1 btn-submit" type="submit" id="submit"><i class="fa fa-upload"></i> UPLOAD</button>
                            <button class="btn btn-warning btn-reset" type="reset"><i class="fa fa-redo"></i> RESET</button>


                        </form>

                    </div>
                </div>
            @endcan

            <div class="card">
                <div class="card-header">
                    <h4><i class="fas fa-image"></i>Riwayat Absensi</h4>
                </div>

                <div class="card-body">
                    
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th scope="col" style="text-align: center;width: 6%">NO.</th>
                                <th scope="col">FOTO</th>
                                <th scope="col">KETERANGAN</th>
                                <th scope="col">TANGGAL</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($absens as $no => $absensis)
                                <tr>
                                    <th scope="row" style="text-align: center">{{ ++$no + ($absens->currentPage()-1) * $absens->perPage() }}</th>
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