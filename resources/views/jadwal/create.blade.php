@extends('layouts.app')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Tambah Jadwal</h1>
        </div>

        <div class="section-body">

            <div class="card">
                <div class="card-header">
                    <h4><i class="fas fa-info"></i> Tambah Jadwal</h4>
                </div>

                <div class="card-body">
                    <form action="{{ route('jadwal.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('POST')
                   
                        <div class="form-group">
                            <label>NAMA SISWA</label>
                            <select class="form-control select-nama_siswa @error('nama_siswa') is-invalid @enderror" name="nama_siswa" required>
                                <option value="">- SELECT SISWA -</option>
                                @foreach ($siswa as $no => $siswa)         
                                <option value="{{ $siswa->name }}">{{ $siswa->name }}</option>
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
                                <b>Jam Mulai : </b><input type="time" name="senin[]"  class="form-control" value="<?= date('Y-m-d', time()); ?>">
                                <b>Jam Selesai : </b><input type="time" name="senin[]"  class="form-control" value="<?= date('Y-m-d', time()); ?>">
                        </div>

                        <div class="form-group">
                            <label>SELASA</label><br>
                                <b>Jam Mulai : </b><input type="time" name="selasa[]"  class="form-control" value="<?= date('Y-m-d', time()); ?>">
                                <b>Jam Selesai : </b><input type="time" name="selasa[]"  class="form-control" value="<?= date('Y-m-d', time()); ?>">
                        </div>

                        <div class="form-group">
                            <label>RABU</label><br>
                                <b>Jam Mulai : </b><input type="time" name="rabu[]"  class="form-control" value="<?= date('Y-m-d', time()); ?>">
                                <b>Jam Selesai : </b><input type="time" name="rabu[]"  class="form-control" value="<?= date('Y-m-d', time()); ?>">
                        </div>

                        <div class="form-group">
                            <label>KAMIS</label><br>
                                <b>Jam Mulai : </b><input type="time" name="kamis[]"  class="form-control" value="<?= date('Y-m-d', time()); ?>">
                                <b>Jam Selesai : </b><input type="time" name="kamis[]"  class="form-control" value="<?= date('Y-m-d', time()); ?>">
                        </div>

                        <div class="form-group">
                            <label>JUMAT</label><br>
                                <b>Jam Mulai : </b><input type="time" name="jumat[]"  class="form-control" value="<?= date('Y-m-d', time()); ?>">
                                <b>Jam Selesai : </b><input type="time" name="jumat[]"  class="form-control" value="<?= date('Y-m-d', time()); ?>">
                        </div>

                        <div class="form-group">
                            <label>SABTU</label><br>
                                <b>Jam Mulai : </b><input type="time" name="sabtu[]"  class="form-control" value="<?= date('Y-m-d', time()); ?>">
                                <b>Jam Selesai : </b><input type="time" name="sabtu[]"  class="form-control" value="<?= date('Y-m-d', time()); ?>">
                        </div>

                        <div class="form-group">
                            <label>MINGGU</label>
                                <b>Jam Mulai : </b><input type="time" name="minggu[]"  class="form-control" value="<?= date('Y-m-d', time()); ?>">
                                <b>Jam Selesai : </b><input type="time" name="minggu[]"  class="form-control" value="<?= date('Y-m-d', time()); ?>">
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