@extends('layouts.app')

@section('content')

<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>HASIL UJIAN ESAI</h1>
        </div>

        <div class="section-body">

            <div class="card">
                <div class="card-header">
                    <h4><i class="fas fa-exam"></i> Hasil {{ $exam->name.' '.$user->name }}</h4>
                </div>

                <div class="card-body">
                    <h4>Terimakasih Jawaban Esai Berhasil Dikirimkan!</h4>
                    <h4>Score Anda Akan Muncul Setelah Dikoreksi Tentor</h4>
                </div>
                <div class="card-footer">
                    <a href="{{ route('exam_essays.review', [$user->id, $exam->id]) }}" class="btn btn-primary mr-1 btn-submit" role="button" aria-pressed="true">REVIEW</a>
                    <a href="{{ route('exam_essays.index') }}" class="btn btn-warning btn-resetk" role="button" aria-pressed="true">BACK</a>
                </div>
            </div>
        </div>
    </section>
</div>

@stop