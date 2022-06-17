@extends('layouts.app')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Edit Question</h1>
        </div>

        <div class="section-body">

            <div class="card">
                <div class="card-header">
                    <h4><i class="fas fa-question"></i> Edit Question</h4>
                </div>

                <div class="card-body">
                    <form action="{{ route('question_essays.update', $questionEssay->id) }}" method="POST" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label>SUBJECT</label>
                            <select class="form-control select-subject @error('subject_id') is-invalid @enderror" name="subject_id">
                                <option value="">- SELECT SUBJECT -</option>
                                @foreach ($subjects as $subject)
                                    @if ($questionEssay->subject_id == $subject->id )
                                    <option value="{{ $subject->id }}" selected>{{ $subject->name }}</option>
                                    @else
                                        <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                            @error('subject_id')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-3">
                                <div class="form-group">
                                    <label>VIDEO</label>
                                    <select class="form-control select-video @error('video_id') is-invalid @enderror" name="video_id">
                                        <option value="">- SELECT VIDEO -</option>
                                        @foreach ($videos as $video)
                                            @if ($questionEssay->video_id == $video->id)
                                                <option value="{{ $video->id }}" selected>{{ $video->title }}</option>
                                            @else
                                                <option value="{{ $video->id }}">{{ $video->title }}</option>
                                            @endif  
                                        @endforeach
                                    </select>
                                    @error('video_id')
                                    <div class="invalid-feedback" style="display: block">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-3">
                                <div class="form-group">
                                    <label>AUDIO</label>
                                    <select class="form-control select-audio @error('audio_id') is-invalid @enderror" name="audio_id">
                                        <option value="">- SELECT AUDIO -</option>
                                        @foreach ($audios as $audio)
                                            @if ($questionEssay->audio_id == $audio->id)
                                                <option value="{{ $audio->id }}" selected>{{ $audio->title }}</option>
                                            @else
                                                <option value="{{ $audio->id }}">{{ $audio->title }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    @error('audio_id')
                                    <div class="invalid-feedback" style="display: block">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-3">
                                <div class="form-group">
                                    <label>IMAGE</label>
                                    <select class="form-control select-image @error('image_id') is-invalid @enderror" name="image_id">
                                        <option value="">- SELECT IMAGE -</option>
                                        @foreach ($images as $image)
                                            @if ($questionEssay->image_id == $image->id)
                                                <option value="{{ $image->id }}" selected>{{ $image->title }}</option>
                                            @else
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
                                        @foreach ($documents as $document)
                                            @if ($questionEssay->document_id == $document->id)
                                                <option value="{{ $document->id }}" selected>{{ $document->title }}</option>
                                            @else
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

                        <div class="form-group">
                            <label>PERTANYAAN</label>
                            <textarea name="detail" cols="30" rows="30" class="form-control">{{ old('detail', $questionEssay->detail) }}</textarea>
                            @error('detail')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>JAWABAN</label>
                            <textarea name="answer" cols="30" rows="30" class="form-control">{{ old('answer', $questionEssay->answer) }}</textarea>
                            @error('answer')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>PENJELASAN</label>
                            <textarea name="explanation" cols="30" rows="30" class="form-control">{{ old('explanation', $questionEssay->explanation) }}</textarea>
                            @error('explanation')
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