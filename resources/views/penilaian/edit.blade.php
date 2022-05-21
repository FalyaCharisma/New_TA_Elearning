@extends('layouts.app')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Edit Penilaian Tentor</h1>
        </div>

        <div class="section-body">

            <div class="card">
                <div class="card-header">
                    <h4><i class="fas fa-exam"></i> Edit Penilaian Tentor</h4>
                </div>

                <div class="card-body">
                    <form action="{{ route('penilaian.update', $penilaian->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label>NAME</label>
                            <input type="text" name="name" value="{{ old('name', $penilaian->name) }}" class="form-control" >
                            @error('name')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>TIME (MINUTE)</label>
                            <input type="number" name="time" value="{{ old('time', $penilaian->time) }}" class="form-control" >

                            @error('time')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>TOTAL PERTANYAAN</label>
                            <input type="number" name="total_pertanyaan" value="{{ old('total_pertanyaan', $penilaian->total_pertanyaan) }}" class="form-control" >

                            @error('total_pertanyaan')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>START</label>
                            <input type="datetime-local" name="start" value="<?php echo date('Y-m-d\TH:i:s', strtotime($penilaian->start)); ?>" class="form-control @error('start') is-invalid @enderror">

                            @error('start')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>END</label>
                            <input type="datetime-local" name="end" value="<?php echo date('Y-m-d\TH:i:s', strtotime($penilaian->end)); ?>" class="form-control @error('end') is-invalid @enderror">

                            @error('end')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        @livewire('soal-penilaian-checklist', ['selectedPertanyaan' => $penilaian->id])


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