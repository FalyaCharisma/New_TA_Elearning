@extends('layouts.app')

@section('content')

<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>PERTANYAAN</h1>
        </div>
        <div class="section-body">
            
            
        <div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-12">
                <h4><i class="fas fa-exam"></i> {{ $penilaian['name'] }} </h4>
            </div>
            <div class="col-12">
                <!-- Display the countdown timer in an element -->
                <span class="badge badge-danger" id="timer"></span>
            </div>
        </div>
    </div>

    <div class="card-body">
    <form action="{{ url('penilaian/evaluasi', $penilaian->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label>Pilih Nama Tentor</label>
            <select class="form-control select-nama_tentor @error('nama_tentor') is-invalid @enderror" name="nama_tentor">
                <option value="">- SELECT TENTOR -</option>
                @foreach ($users as $no => $user)
                @if(!empty($user->getRoleNames()))
                @foreach($user->getRoleNames() as $role)
                @if($role=='teacher')
                <option value="{{ $user->name }}">{{ $user->name }}</option>
                @endif
                @endforeach
                @endif
                @endforeach
            </select>
            @error('kelas')
            <div class="invalid-feedback" style="display: block">
                {{ $message }}
            </div>
            @enderror
        </div>
        <b>Pertanyaan No. 1</b>
        <div class="form-group">
        <p>Bagaimanakah kualitas tentor yang mengajar?</p>
            <input type="radio" name="kualitas" value="Sangat Baik"> Sangat Baik<br>
            <input type="radio" name="kualitas" value="Baik"> Baik<br>
            <input type="radio" name="kualitas" value="Cukup Baik"> Cukup<br>
            <input type="radio" name="kualitas" value="Kurang Baik"> Kurang Baik<br>
            <input type="radio" name="kualitas" value="Tidak Baik"> Tidak Baik
            @error('kualitas')
            <div class="invalid-feedback" style="display: block">
                {{ $message }}
            </div>
            @enderror
        </div>
        <b>Pertanyaan No. 2</b>
        <div class="form-group">
        <p>Bagaimanakah pembelajaran yang telah dilaksanakan?</p>
            <input type="radio" name="pembelajaran" value="Sangat Baik"> Sangat Baik<br>
            <input type="radio" name="pembelajaran" value="Baik"> Baik<br>
            <input type="radio" name="pembelajaran" value="Cukup Baik"> Cukup<br>
            <input type="radio" name="pembelajaran" value="Kurang Baik"> Kurang Baik<br>
            <input type="radio" name="pembelajaran" value="Tidak Baik"> Tidak Baik
            @error('pembelajaran')
            <div class="invalid-feedback" style="display: block">
                {{ $message }}
            </div>
            @enderror
        </div>
        <b>Pertanyaan No. 3</b>
        <p>Berikan saran dan masukan sebagai bahan evaluasi tentor.</p>
        <i>Tulis di sini:</i> 
        <div class="form-group">
            <textarea name="isi" value="{{ old('isi') }}"  
            style="width: 60%; height: 100px; font-size: 12px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">
            </textarea>
            @error('isi')
            <div class="invalid-feedback" style="display: block">
                {{ $message }}
            </div>
        @enderror
        </div> 
        <button class="btn btn-primary mr-1 btn-submit" type="submit"><i class="fa fa-paper-plane"></i>
                            SUBMIT</button>
    </form>
    </div>

</div>

<script>
    var add_minutes =  function (dt, minutes) {
    return new Date(dt.getTime() + minutes*60000);
    }
    
    // Get today's date and time
    var now = new Date();

    // Set the date we're counting down to
    var countDownDate = add_minutes(now, {{ $penilaian->time }});

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

            
        </div>
    </section>
</div>
@stop





