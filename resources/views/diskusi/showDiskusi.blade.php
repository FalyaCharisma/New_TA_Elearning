@extends('layouts.app')

@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Forum Diskusi</h1>
            </div>

            <div class="section-body">

                <div class="card">
                    <div class="card-header">
                        <h4><i class="fas fa-question"></i> Forum Diskusi</h4>
                    </div>


                    <div class="card-body">
                        @can('diskusi.showDiskusi')
                            <div class="card card-default  mb-2">
                                <div class="card-header">
                                    <h5 class="">{{ $diskusi->materi }}</h5>
                                </div>
                                <div class="card-body">
                                    <span class="">{{ $diskusi->user->username }},
                                        <b>{{ $diskusi->created_at }}</b></span>
                                    <hr>
                                    <p class="">{{ $diskusi->pertanyaan }} </p>
                                </div>
                                <!-- <div class="card-footer">
                                    <p> Replies</p>
                                </div> -->
                            </div>
                        @endcan

                        @foreach ($respon as $item)
                            @can('diskusi.showDiskusi')
                                <div class="card card-default  mb-2">
                                    <div class="card-header">
                                        <span class="">{{ $item->user->username }},
                                            <b>{{ $item->created_at }}</b></span>
                                    </div>
                                    <div class="card-body">
                                        <p class="">{{ $item->respon }} </p>
                                    </div>
                                    <div class="card-footer">
                                    @can('diskusi.respon')
                                <form action="{{ url('diskusi/respon', $diskusi->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('POST')
                                    <div class="form-group">
                                        <label>Beri Tanggapan</label>
                                        <textarea name="respon" value="{{ old('respon') }}" class="form-control @error('respon') is-invalid @enderror"
                                            placeholder="Place some text here"
                                            style="width: 100%; height: 100px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                                        @error('respon')
                                            <div class="invalid-feedback" style="display: block">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-primary mr-1 btn-submit" type="submit"><i
                                                class="fa fa-paper-plane"></i>Kirim</button>
                                    </div>
                                </form>
                            @endcan
                                    </div>
                                </div>
                            @endcan
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    </div>
@stop
