@extends('layouts.app')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Edit Jadwal</h1>
        </div>

        <div class="section-body">

            <div class="card">
                <div class="card-header">
                    <h4><i class="fas fa-info"></i> Edit Jadwal</h4>
                </div>

                <div class="card-body">
                    <form action="{{ route('jadwal.update',$jadwals->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label>NAMA SISWA</label>
                            <select class="form-control select-nama_siswa @error('nama_siswa') is-invalid @enderror" name="nama_siswa" required>
                                <option value="">- SELECT SISWA -</option>
                                @foreach ($allJadwal as $no => $jadwal)
                                @if($jadwals->nama_siswa == $jadwal->nama_siswa)
                                <option value="{{ $jadwal->nama_siswa }}" selected>{{ $jadwal->nama_siswa }}</option>
                                @else
                                <option value="{{ $jadwal->nama_siswa }}">{{ $jadwal->nama_siswa }}</option>
                                @endif         
                                @endforeach
                            </select>
                            @error('nama_siswa')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>SENIN</label><br>
                                <b>Jam Mulai : </b><input type="time" name="senin[]"  class="form-control" value="{{$jadwals->senin[0]}}">
                                <b>Jam Selesai : </b><input type="time" name="senin[]"  class="form-control" value="{{$jadwals->senin[1]}}">
                        </div>

                        <div class="form-group">
                            <label>SELASA</label><br>
                                <b>Jam Mulai : </b><input type="time" name="selasa[]"  class="form-control" value="{{$jadwals->selasa[0]}}">
                                <b>Jam Selesai : </b><input type="time" name="selasa[]"  class="form-control" value="{{$jadwals->selasa[1]}}">
                        </div>

                        <div class="form-group">
                            <label>RABU</label><br>
                                <b>Jam Mulai : </b><input type="time" name="rabu[]"  class="form-control" value="{{$jadwals->rabu[0]}}">
                                <b>Jam Selesai : </b><input type="time" name="rabu[]"  class="form-control" value="{{$jadwals->rabu[1]}}">
                        </div>

                        <div class="form-group">
                            <label>KAMIS</label><br>
                                <b>Jam Mulai : </b><input type="time" name="kamis[]"  class="form-control" value="{{$jadwals->kamis[0]}}">
                                <b>Jam Selesai : </b><input type="time" name="kamis[]"  class="form-control" value="{{$jadwals->kamis[1]}}">
                        </div>

                        <div class="form-group">
                            <label>JUMAT</label><br>
                                <b>Jam Mulai : </b><input type="time" name="jumat[]"  class="form-control" value="{{$jadwals->jumat[0]}}">
                                <b>Jam Selesai : </b><input type="time" name="jumat[]"  class="form-control" value="{{$jadwals->jumat[1]}}">
                        </div>

                        <div class="form-group">
                            <label>SABTU</label><br>
                                <b>Jam Mulai : </b><input type="time" name="sabtu[]"  class="form-control" value="{{$jadwals->sabtu[0]}}">
                                <b>Jam Selesai : </b><input type="time" name="sabtu[]"  class="form-control" value="{{$jadwals->sabtu[1]}}">
                        </div>

                        <div class="form-group">
                            <label>MINGGU</label><br>
                                <b>Jam Mulai : </b><input type="time" name="minggu[]"  class="form-control" value="{{$jadwals->minggu[0]}}">
                                <b>Jam Selesai : </b><input type="time" name="minggu[]"  class="form-control" value="{{$jadwals->minggu[1]}}">
                        </div>

                        <button class="btn btn-primary mr-1 btn-submit" type="submit"><i class="fa fa-paper-plane"></i>
                            SIMPAN</button>
                        <button class="btn btn-warning btn-reset" type="reset"><i class="fa fa-redo"></i> RESET</button>

                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
@stop