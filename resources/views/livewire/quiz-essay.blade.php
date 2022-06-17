<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-12">
                <h4><i class="fas fa-exam"></i> {{ $exam['name'] }} </h4>
            </div>
            <div class="col-12">
                <!-- Display the countdown timer in an element -->
                <span class="badge badge-danger" id="timer"></span>
            </div>
        </div>
    </div>
    @php
        $count = 1;
    @endphp
    @foreach ($questions as $index => $question)
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
        <i>Tulis jawaban dibawah ini:</i> 
        <br>
      
        <form action="" method="POST">
        @csrf
            <div class="form-group">
                <div class="row">
                    <div class="col-md-10" wire:ignore>
                        <textarea type="text" id="jawaban_siswa"  wire:model="jawaban_siswa.{{$index}}" name="jawaban_siswa"
                            class="form-control @error('jawaban_siswa') is-invalid @enderror"> 
                        </textarea>         
                    </div>
                </div>
            </div>
        </form>   
    </div>
    @endforeach

    {{-- @foreach ($jawaban_siswa as $item)
        {{ $item }}
    @endforeach --}}
    
    <div class="d-flex justify-content-center">
        {{$questions->links()}}
    </div>
    <div class="card-footer">
            <button wire:click="submitAnswers" class="btn btn-primary btn-lg btn-block" data-toggle="modal" data-target="#mdlSimpan">Submit</button> 
    </div>
</div>



<script>
    var add_minutes =  function (dt, minutes) {
    return new Date(dt.getTime() + minutes*60000);
    }
    
    // Get today's date and time
    var now = new Date();

    // Set the date we're counting down to
    var countDownDate = add_minutes(now, {{ $exam->time }});

    // Update the count down every 1 second
    var x = setInterval(function() {

    // Get today's date and time
    var now2 = new Date().getTime();

    // Find the distance between now and the count down date
    var distance = countDownDate - now2;

    // Time calculations for days, hours, minutes and seconds
    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    var seconds = Math.floor((distance % (1000 * 60)) / 1000);

    // Display the result in the element with id="demo"
    document.getElementById("timer").innerHTML = "Sisa Waktu : " + hours + " jam "
    + minutes + " menit "+ seconds + " detik ";

    // If the count down is finished, write some text
    if (distance < 0) {
        clearInterval(x);
        Livewire.emit('endTimer');
    }
    }, 1000);
</script>
