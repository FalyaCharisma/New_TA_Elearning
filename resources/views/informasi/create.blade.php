@extends('layouts.app')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Tambah Informasi</h1>
        </div>

        <div class="section-body">

            <div class="card">
                <div class="card-header">
                    <h4><i class="fas fa-unlock"></i>Tambah Informasi</h4>
                </div>

                <div class="card-body">
                    <form action="{{ route('informasi.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-3">
                                <div class="form-group">
                                    <label>IMAGE</label>
                                    <select class="form-control select-image @error('image_id') is-invalid @enderror" name="image_id">
                                        <option value="">- SELECT IMAGE -</option>
                                        @foreach ($image as $image)
                                        @if($image->user_id == Auth::user()->id)
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
                                        @if($document->user_id == Auth::user()->id)
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
                        </div>
                    </div>
                    <div class="col-10">
                        <div class="form-group">
                            <label>ISI INFORMASI</label> 
                            <textarea name="isi_informasi" value="{{ old('isi_informasi') }}" class="form-control @error('isi_informasi') is-invalid @enderror" placeholder="Place some text here"
                            style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>

                            @error('isi_informasi')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <button class="btn btn-primary mr-1 btn-submit" type="submit"><i class="fa fa-paper-plane"></i>
                            SIMPAN</button>
                        <button class="btn btn-warning btn-reset" type="reset"><i class="fa fa-redo"></i> RESET</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
@stop