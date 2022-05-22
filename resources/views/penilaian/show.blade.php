@extends('layouts.app')

@section('content')

<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>PENILAIAN TENTOR DETAIL</h1>
        </div>

        <div class="section-body">

            <div class="card">
                <div class="card-header">
                    <h4><i class="fas fa-exam"></i> Penilaian Tentor {{ $penilaian->name }} </h4>
                </div>

                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Durasi Pengerjaan : {{ $penilaian->time }} Menit</li>
                        <li class="list-group-item">Jumlah Soal : {{ $penilaian->total_pertanyaan }} buah</li>
                        <li class="list-group-item">Pengerjaan dibuka : {{ TanggalID($penilaian->start) }}</li>
                        <li class="list-group-item">Pengerjaan ditutup : {{ TanggalID($penilaian->end) }}</li>
                    </ul>
                </div>
                <div class="card-footer">
                    @if (now() > $penilaian->start && now()  < $penilaian->end)
                        <a href="{{ route('penilaian.start', $penilaian->id) }}" class="btn btn-primary btn-lg btn-block" role="button" aria-pressed="true">START</a>
                    @elseif (now() < $penilaian->start)
                    <a onclick="goBack()" class="btn btn-warning btn-lg btn-block" role="button" aria-pressed="true">UJIAN BELUM DIBUKA - KEMBALI</a>
                    @elseif(now() > $penilaian->end)
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