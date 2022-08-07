@extends('layouts.app')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Ajukan Pertanyaan</h1>
        </div>

        <div class="section-body">

            <div class="card">
                <div class="card-header">
                    <h4><i class="fas fa-question"></i> Ajukan Pertanyaan</h4>
                </div>

                <div class="card-body">
                    <form action="{{ route('diskusi.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label>MATERI</label>
                            <select class="form-control select-materi @error('materi_id') is-invalid @enderror" name="materi_id">
                                <option value="">- SELECT MATERI -</option>
                                @foreach ($materi as $materi) 
                                    <option value="{{ $materi->id }}">{{ $materi->judul }}</option>
                                @endforeach  
                            </select>
                            @error('materi_id')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>ISI PERTANYAAN</label>
                            <textarea name="pertanyaan" value="{{ old('pertanyaan') }}" class="form-control @error('pertanyaan') is-invalid @enderror" placeholder="Place some text here"
                            style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>

                            @error('pertanyaan')
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