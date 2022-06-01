@extends('layouts.app')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Tambah Materi</h1>
        </div>

        <div class="section-body">

            <div class="card">
                <div class="card-header">
                    <h4><i class="fas fa-unlock"></i> Tambah Materi</h4>
                </div>

                <div class="card-body">
                    <form action="{{ route('materi.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label>MATA PELAJARAN</label>
                            <select class="form-control select-mapel @error('mapel') is-invalid @enderror" name="mapel">
                                <option value="">- SELECT MAPEL -</option>
                                @foreach ($mataPelajaran as $mapel)
                                    <option value="{{ $mapel->mata_pelajaran }}">{{ $mapel->mata_pelajaran }}</option>
                                @endforeach 
                            </select>
                            @error('mapel')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>KELAS</label>
                            <select class="form-control select-kelas @error('kelas') is-invalid @enderror" name="kelas">
                                <option value="">- SELECT KELAS -</option>
                                @foreach ($kelass as $kelas)
                                    <option value="{{ $kelas->nama_kelas }}">{{ $kelas->nama_kelas }}</option>
                                @endforeach 
                            </select>
                            @error('kelas')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>JUDUL</label>
                            <input type="text" name="judul" value="{{ old('judul') }}" placeholder="Masukkan Judul"
                                class="form-control @error('judul') is-invalid @enderror">

                            @error('judul')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>ISI MATERI</label>
                            <textarea id="ckeditor" name="isi" value="{{ old('isi') }}" class="ckeditor" placeholder="Place some text here"
                            style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>

                            @error('isi')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Ringkasan</label>
                            <input type="text" name="ringkasan" value="{{ old('ringkasan') }}" placeholder="Masukkan Ringkasan"
                                class="form-control @error('ringkasan') is-invalid @enderror">

                            @error('ringkasan')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="font-weight-bold">Siswa</label>
                            
                            @foreach ($siswa as $siswa)
                            @if($siswa->nama_tentor==Auth::user()->tentor->name)
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="siswa" value="{{ $siswa->name }}">
                                <label class="form-check-label" for="check-{{ $siswa->id }}">
                                    {{ $siswa->name }}
                                </label>
                            </div>
                            @endif
                            @endforeach
                            @error('siswa')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>DOCUMENT</label>
                            <input type="file" name="document" class="form-control @error('document') is-invalid @enderror">

                            @error('document')
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