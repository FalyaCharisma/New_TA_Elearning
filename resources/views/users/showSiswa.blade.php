@extends('layouts.app')

@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Data Siswa</h1>
            </div>

            <div class="section-body">

                <div class="card">
                    <div class="card-header">
                        <h4><i class="fas fa-users"></i> Data Siswa</h4>
                    </div>


                    <div class="card-body">
                        @can('users.showSiswa')
                        <div class="form-group">
                            <label>USERNAME</label>
                            <input type="text" name="username" value="{{ old('username', $user->username) }}"
                                placeholder="Masukkan User Name"
                                class="form-control @error('username') is-invalid @enderror">

                            @error('username')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        @endcan

                        <form action="{{ url('users/dataSiswa', $user->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('POST')
                        <div class="form-group">
                            <label>NAMA USER</label>
                            <input type="text" name="name" value="{{ old('name') }}" placeholder="Masukkan Nama User"
                                class="form-control @error('name') is-invalid @enderror">

                            @error('name')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
 
                        <div class="form-group">
                            <label>JENJANG</label>
                            <select class="form-control select-jenjang @error('jenjang') is-invalid @enderror" name="jenjang">
                                <option value="">- SELECT JENJANG -</option>
                                    <option value="PAUD">PAUD</option>
                                    <option value="TK">TK</option>
                                    <option value="SD/MI">SD/MI</option>
                                    <option value="SMP/MTS">SMP/MTS</option>
                                    <option value="SMA/SMK/MA">SMA/SMK/MA</option>
                                    <option value="UMUM">UMUM</option>
                            </select>
                            @error('jenjang')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>NAMA TENTOR</label>
                            <select class="form-control select-nama_tentor @error('nama_tentor') is-invalid @enderror" name="nama_tentor">
                                <option value="">- SELECT TENTOR -</option>
                                @foreach ($tentor as $no => $tentor)         
                                <option value="{{ $tentor->name }}">{{ $tentor->name }}</option>
                                @endforeach
                            </select>
                            @error('nama_tentor')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>ASAL SEKOLAH</label>
                            <input type="text" name="asal_sekolah" value="{{ old('asal_sekolah') }}" placeholder="Masukkan Asal Sekolah"
                                class="form-control @error('asal_sekolah') is-invalid @enderror">

                            @error('asal_sekolah')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>NO. WA</label>
                            <input type="text" name="no_wa" value="{{ old('no_wa') }}" placeholder="Masukkan Nomor WhatsApp"
                                class="form-control @error('no_wa') is-invalid @enderror">

                            @error('no_wa')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>ALAMAT</label>
                            <input type="text" name="alamat" value="{{ old('alamat') }}" placeholder="Masukkan Alamat"
                                class="form-control @error('alamat') is-invalid @enderror">

                            @error('alamat')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                            @enderror
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
