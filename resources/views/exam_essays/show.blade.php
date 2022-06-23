@extends('layouts.app')

@section('content')

<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>DETAIL UJIAN ESAI</h1>
        </div>

        <div class="section-body">

            <div class="card">
                <div class="card-header">
                    <h4><i class="fas fa-exam"></i> Ujian {{ $exam_essay->name }} </h4>
                </div>
                {{-- $exam_essay --}}
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Durasi Ujian : {{ $exam_essay->time }} Menit</li>
                        <li class="list-group-item">Jumlah Soal : {{ $exam_essay->total_question }} buah</li>
                        <li class="list-group-item">Ujian dibuka : {{ TanggalID($exam_essay->start) }}</li>
                        <li class="list-group-item">Ujian ditutup : {{ TanggalID($exam_essay->end) }}</li>
                    </ul>
                </div>
                <div class="card-footer">
                    @if (now() > $exam_essay->start && now()  < $exam_essay->end)
                        <a href="{{ route('exam_essays.start', $exam_essay->id) }}" class="btn btn-primary btn-lg btn-block" role="button" aria-pressed="true">START</a>
                    @elseif (now() < $exam_essay->start)
                    <a onclick="goBack()" class="btn btn-warning btn-lg btn-block" role="button" aria-pressed="true">UJIAN BELUM DIBUKA - KEMBALI</a>
                    @elseif(now() > $exam_essay->end)
                    <a onclick="goBack()" class="btn btn-danger btn-lg btn-block" role="button" aria-pressed="true">UJIAN SUDAH DITUTUP - KEMBALI</a>
                    @endif
                </div>
            </div>
        </div>
    </section>
</div>

<script type="text/javascript">
    function goBack() {
    window.history.back();
}
</script>

@stop