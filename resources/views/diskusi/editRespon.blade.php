@extends('layouts.app')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Edit Tanggapan</h1>
        </div>

        <div class="section-body">

            <div class="card">
                <div class="card-header">
                    <h4><i class="fas fa-question"></i> Edit Tanggapan</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ url('diskusi/respon/responUpdate', $respon->id) }}"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label>Tanggapan</label>
                            <textarea name="respon" value="{{ old('respon', $respon->respon) }}" class="form-control"
                                style="width: 100%; height: 100px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" required>{{ $respon->respon }}</textarea>
                            @error('respon') 
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
