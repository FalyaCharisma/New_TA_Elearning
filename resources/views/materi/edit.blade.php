@extends('layouts.app')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Edit Materi</h1>
        </div>

        <div class="section-body">

            <div class="card">
                <div class="card-header">
                    <h4><i class="fas fa-unlock"></i> Edit Materi</h4>
                </div>

                <div class="card-body">
                    <form action="{{ route('materi.update', $materi->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label>MAPEL</label>
                            <select class="form-control select-mapel @error('mapel') is-invalid @enderror" name="mapel">
                                <option value="">- SELECT MAPEL -</option>
                                @foreach ($mataPelajaran as $mapel)
                                    @if ($materi->mapel == $mapel->mata_pelajaran)
                                    <option value="{{ $mapel->mata_pelajaran }}" selected>{{ $mapel->mata_pelajaran }}</option>
                                    @else
                                        <option value="{{ $mapel->mata_pelajaran }}">{{ $mapel->mata_pelajaran }}</option>
                                    @endif
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
                                    @if ($materi->kelas == $kelas->nama_kelas )
                                    <option value="{{ $kelas->nama_kelas }}" selected>{{ $kelas->nama_kelas }}</option>
                                    @else
                                        <option value="{{ $kelas->nama_kelas }}">{{ $kelas->nama_kelas }}</option>
                                    @endif
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
                            <input type="text" name="judul" value="{{ old('judul', $materi->judul) }}"
                                placeholder="Masukkan Judul"
                                class="form-control @error('judul') is-invalid @enderror">

                            @error('judul')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>ISI MATERI</label>
                            <textarea name="isi" value="{{ old('isi', $materi->isi) }}" class="form-control @error('isi') is-invalid @enderror" placeholder="Place some text here"
                            style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{ $materi->isi }}</textarea>

                            @error('isi')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>DOCUMENT</label>
                            <input type="file" name="document" value="{{ old('document', $materi->document) }}" class="form-control @error('document') is-invalid @enderror">

                            @error('document')
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