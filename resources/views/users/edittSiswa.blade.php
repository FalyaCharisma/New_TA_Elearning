@extends('layouts.app')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Edit Siswa</h1>
        </div>

        <div class="section-body">

            <div class="card">
                <div class="card-header">
                    <h4><i class="fas fa-unlock"></i> Edit Siswa</h4>
                </div>

                <div class="card-body">
                    <form action="{{ route('users.update', $siswa->user_id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label>USERNAME</label>
                            <input type="text" name="username" value="{{ old('username', $siswa->user->username) }}"
                                placeholder="Masukkan User Name"
                                class="form-control @error('username') is-invalid @enderror">

                            @error('username')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>PASSWORD</label>
                                    <input type="password" name="password" value="{{ old('password') }}"
                                        placeholder="Masukkan Password"
                                        class="form-control @error('password') is-invalid @enderror">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>PASSWORD</label>
                                    <input type="password" name="password_confirmation"
                                        value="{{ old('password_confirmation') }}"
                                        placeholder="Masukkan Konfirmasi Password" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="font-weight-bold">ROLE</label>
                           
                            @foreach ($roles as $role)
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="role[]" value="{{ $role->name }}"
                                        id="check-{{ $role->id }}" {{ $siswa->user->roles->contains($role->id) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="check-{{ $role->id }}">
                                        {{ $role->name }}
                                    </label>
                                </div>
                            @endforeach
                        </div>

                        <button class="btn btn-primary mr-1 btn-submit" type="submit"><i class="fa fa-paper-plane"></i>
                            UPDATE</button>
                        <button class="btn btn-warning btn-reset" type="reset"><i class="fa fa-redo"></i> RESET</button>

                    </form>
                </div>
 
                <div class="card-body">
                    <form action="{{ url('users/siswa/updateSiswa', $siswa->id) }}" method="POST"
                        enctype="multipart/form-data"> 
                        @csrf
    
                        <div class="form-group">
                            <label>NAMA SISWA</label>
                            <input type="text" name="name" value="{{ old('name', $siswa->name) }}"
                                class="form-control" required>
                            @error('name')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>JENJANG</label>
                            <select class="form-control select-jenjang @error('jenjang') is-invalid @enderror" name="jenjang" required>
                                <option value="">- SELECT JENJANG -</option>
                                    @if ($siswa->jenjang !== null )
                                    <option value="{{ $siswa->jenjang }}" selected>{{ $siswa->jenjang }}</option>
                                    @else
                                        <option value="{{ $siswa->jenjang }}">{{ $siswa->jenjang }}</option>
                                    @endif
                            </select>
                            @error('jenjang')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>NO. WA</label>
                            <input type="text" name="no_wa" value="{{ old('no_wa', $siswa->no_wa) }}"
                                class="form-control">

                            @error('no_wa')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>ASAL SEKOLAH</label>
                            <input type="text" name="asal_sekolah" value="{{ old('asal_sekolah', $siswa->asal_sekolah) }}"
                                class="form-control" required>

                            @error('asal_sekolah')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>ALAMAT</label>
                            <input type="text" name="alamat" value="{{ old('alamat', $siswa->alamat) }}"
                                class="form-control" required>

                            @error('alamat')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>NAMA TENTOR</label>
                            <select class="form-control select-nama_tentor @error('nama_tentor') is-invalid @enderror" name="nama_tentor" required>
                                @foreach ($tentor as $no => $tentor)   
                                @if($siswa->nama_tentor == $tentor->name) 
                                <option value="{{ $tentor->name }}" selected>{{ $tentor->name }}</option>  
                                @else
                                <option value="{{ $tentor->name }}">{{ $tentor->name }}</option> 
                                @endif
                                @endforeach
                            </select>
                            @error('nama_tentor')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <button class="btn btn-primary mr-1 btn-submit" type="submit"><i class="fa fa-paper-plane"></i>
                            UPDATE</button>
                        <button class="btn btn-warning btn-reset" type="reset"><i class="fa fa-redo"></i> RESET</button>

                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
@stop