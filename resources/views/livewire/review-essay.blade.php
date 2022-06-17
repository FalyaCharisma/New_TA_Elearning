<div class="card">
    <div class="card-header">
        <div class="row">
            <h4><i class="fas fa-exam"></i> {{ $exam['name'] }} </h4>
        </div>
    </div>
    @php
        $count = 1;
    @endphp
    @foreach ($questions as  $index => $question)
    <div class="card-body">
        <b>Soal No. {{ $count++ }}</b>
        <p>{{ $question['detail'] }}</p>
        @if ($question['video_id'])
                <video width="160" height="120" controls>
                    <source src="{{ asset('storage/public/videos/'. $video->getLink($question['video_id'])) }}" type="video/mp4">
                    <source src="{{ asset('storage/public/videos/'. $video->getLink($question['video_id'])) }}" type="video/mpeg">
                </video>
            @elseif($question['audio_id'])
                <audio width="160" height="120" controls>
                    <source src="{{ asset('storage/public/audios/'.$audio->getLink($question['audio_id'])) }}" type="audio/mp3">
                    <source src="{{ asset('storage/public/audios/'.$audio->getLink($question['audio_id'])) }}" type="audio/wav">
                </audio>
            @elseif($question['document_id'])
                <a href=" {{ asset('storage/public/documents/'.$document->getLink($question['document_id'])) }}">DOCUMENT</a>
            @elseif($question['image_id'])
            <img src="{{ asset('storage/public/images/'.$image->getLink($question['image_id'])) }}" style="width: 150px">
            @elseif ($question['video_id'] && $question['audio_id'])
                <video width="160" height="120" controls>
                    <source src="{{ asset('storage/public/videos/'. $video->getLink($question['video_id'])) }}" type="video/mp4">
                    <source src="{{ asset('storage/public/videos/'. $video->getLink($question['video_id'])) }}" type="video/mpeg">
                </video>
                <audio width="160" height="120" controls>
                    <source src="{{ asset('storage/public/audios/'.$audio->getLink($question['audio_id'])) }}" type="audio/mp3">
                    <source src="{{ asset('storage/public/audios/'.$audio->getLink($question['audio_id'])) }}" type="audio/wav">
                </audio>
            @elseif ($question['video_id'] && $question['document_id'])
                <video width="160" height="120" controls>
                    <source src="{{ asset('storage/public/videos/'. $video->getLink($question['video_id'])) }}" type="video/mp4">
                    <source src="{{ asset('storage/public/videos/'. $video->getLink($question['video_id'])) }}" type="video/mpeg">
                </video>
                <a href=" {{ asset('storage/public/documents/'.$document->getLink($question['document_id'])) }}">DOCUMENT</a>
            @elseif ($question['video_id'] && $question['image_id'])
                <video width="160" height="120" controls>
                    <source src="{{ asset('storage/public/videos/'. $video->getLink($question['video_id'])) }}" type="video/mp4">
                    <source src="{{ asset('storage/public/videos/'. $video->getLink($question['video_id'])) }}" type="video/mpeg">
                </video>
                <img src="{{ asset('storage/public/images/'.$image->getLink($question['image_id'])) }}" style="width: 150px">
            @elseif($question['audio_id'] && $question['document_id'])
                <audio width="160" height="120" controls>
                    <source src="{{ asset('storage/public/audios/'.$audio->getLink($question['audio_id'])) }}" type="audio/mp3">
                    <source src="{{ asset('storage/public/audios/'.$audio->getLink($question['audio_id'])) }}" type="audio/wav">
                </audio>
                <a href=" {{ asset('storage/public/documents/'.$document->getLink($question['document_id'])) }}">DOCUMENT</a>
            @elseif($question['audio_id'] && $question['image_id'])
                <audio width="160" height="120" controls>
                    <source src="{{ asset('storage/public/audios/'.$audio->getLink($question['audio_id'])) }}" type="audio/mp3">
                    <source src="{{ asset('storage/public/audios/'.$audio->getLink($question['audio_id'])) }}" type="audio/wav">
                </audio>
                <img src="{{ asset('storage/public/images/'.$image->getLink($question['image_id'])) }}" style="width: 150px">
            @elseif($question['document_id'] && $question['image_id'])
                <a href=" {{ asset('storage/public/documents/'.$document->getLink($question['document_id'])) }}">DOCUMENT</a>
                <img src="{{ asset('storage/public/images/'.$image->getLink($question['image_id'])) }}" style="width: 150px">
            @else
                
            @endif
        <br>
        <i>Jawaban Anda:</i> 
        <div class="form-group">
                <div class="row">       
                    <div class="col-md-10" wire:ignore>
                        <textarea type="text" id="jawaban_siswa"  wire:model="jawaban_siswa.{{$index}}" name="jawaban_siswa"
                            class="form-control @error('jawaban_siswa') is-invalid @enderror" disabled> 
                        </textarea>         
                    </div>
                </div>
            </div>
        <i>Jawaban Benar:</i>     
        <div>
            {{ $question['answer'] }}
        </div>
        <i>Pembahasan:</i>     
        <div>
            {{ $question['explanation'] }}
        </div>
        
    </div>
    @endforeach
    
    
    <div class="d-flex justify-content-center">
        {{$questions->links()}}
    </div>
    <div class="card-footer">
        @if ($questions->currentPage() == $questions->lastPage())
        <a href="{{ route('exam_essays.index') }}" class="btn btn-primary btn-lg btn-block" role="button" aria-pressed="true">BACK</a>
        @endif
    </div>
</div>


