@extends('layouts.app')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Edit Tentor</h1>
        </div>

        <div class="section-body">

            <div class="card">
                <div class="card-header">
                    <h4><i class="fas fa-unlock"></i> Edit Tentor</h4>
                </div>

                <div class="card-body">
                    <form action="{{ route('users.update', $tentor->user_id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label>USERNAME</label>
                            <input type="text" name="username" value="{{ old('username', $tentor->user->username) }}"
                                placeholder="Masukkan Username"
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

                        <!-- <div class="form-group">
                            <label class="font-weight-bold">ROLE</label>
                           
                            @foreach ($roles as $role)
                            @if($role->name=='teacher')
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="role[]" value="{{ $role->name }}"
                                        id="check-{{ $role->id }}" {{ $tentor->user->roles->contains($role->id) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="check-{{ $role->id }}">
                                        {{ $role->name }}
                                    </label>
                                </div>
                            @endif
                            @endforeach
                        </div> -->

                        <button class="btn btn-primary mr-1 btn-submit" type="submit"><i class="fa fa-paper-plane"></i>
                            UPDATE</button>
                        <button class="btn btn-warning btn-reset" type="reset"><i class="fa fa-redo"></i> RESET</button>

                    </form>
                </div>
 
                <div class="card-body">
                    <form action="{{ url('users/tentor/updateTentor', $tentor->id) }}" method="POST"
                        enctype="multipart/form-data"> 
                        @csrf
    
                        <div class="form-group">
                            <label>NAMA TENTOR</label>
                            <input type="text" name="name" value="{{ old('name', $tentor->name) }}"
                                class="form-control" required>
                            @error('name')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>NO. WA</label>
                            <input type="text" name="no_wa" value="{{ old('no_wa', $tentor->no_wa) }}" 
                                class="form-control">

                            @error('no_wa')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>ALAMAT</label>
                            <input type="text" name="alamat" value="{{ old('alamat', $tentor->alamat) }}" 
                                class="form-control" required>

                            @error('alamat')
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