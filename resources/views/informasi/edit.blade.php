@extends('layouts.app')

@section('title', 'isi_informasi')
@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Edit Informasi</h1>
        </div>

        <div class="section-body">

            <div class="card">
                <div class="card-header">
                    <h4><i class="fas fa-unlock"></i> Edit Informasi</h4>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ url('informasi', $informasi->id ) }}"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="col-3">
                                <div class="form-group">
                                    <label>IMAGE</label>
                                    <select class="form-control select-image @error('image_id') is-invalid @enderror" name="image_id">
                                        <option value="">- SELECT IMAGE -</option>
                                        @foreach ($image as $image)
                                            @if ($informasi->image_id == $image->id)
                                                <option value="{{ $image->id }}" selected>{{ $image->title }}</option>
                                            @elseif($image->user_id == Auth::user()->id)
                                                <option value="{{ $image->id }}">{{ $image->title }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    @error('image_id')
                                    <div class="invalid-feedback" style="display: block">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-3">
                                <div class="form-group">
                                    <label>DOCUMENT</label>
                                    <select class="form-control select-document @error('document_id') is-invalid @enderror" name="document_id">
                                        <option value="">- SELECT DOCUMENT -</option>
                                        @foreach ($document as $document)
                                            @if ($informasi->document_id == $document->id)
                                                <option value="{{ $document->id }}" selected>{{ $document->title }}</option>
                                            @elseif($document->user_id == Auth::user()->id)
                                                <option value="{{ $document->id }}">{{ $document->title }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    @error('document_id')
                                    <div class="invalid-feedback" style="display: block">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        <div class="form-group">
                            <label>ISI INFORMASI</label>

                            <textarea name="isi_informasi" value="{{ old('isi_informasi', $informasi->isi_informasi) }}" placeholder="Place some text here" class="form-control @error('isi_informasi') is-invalid @enderror" 
                            style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{ $informasi->isi_informasi}}</textarea>

                            @error('isi_informasi')
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