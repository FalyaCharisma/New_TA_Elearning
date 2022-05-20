@extends('layouts.app')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Edit Soal Penilaian Tentor</h1>
        </div>

        <div class="section-body">

            <div class="card">
                <div class="card-header">
                    <h4><i class="fas fa-question"></i> Edit Soal Penilaian Tentor</h4>
                </div>

                <div class="card-body">
                    <form action="{{ route('soalPenilaian.update', $soalPenilaian->id) }}" method="POST" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf

                        <div class="form-group">
                            <label>PERTANYAAN</label>
                            <textarea name="pertanyaan" cols="30" rows="30" class="form-control">{{ old('pertanyaan', $soalPenilaian->pertanyaan) }}</textarea>
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