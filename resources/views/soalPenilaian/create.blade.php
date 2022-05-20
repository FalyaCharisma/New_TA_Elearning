@extends('layouts.app')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Tambah Pertanyaan Penilaian Tentor</h1>
        </div>

        <div class="section-body">

            <div class="card">
                <div class="card-header">
                    <h4><i class="fas fa-question"></i> Tambah Pertanyaan</h4>
                </div>

                <div class="card-body">
                    <form action="{{ route('soalPenilaian.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label>PERTANYAAN</label>
                            <textarea name="pertanyaan" cols="30" rows="30" class="form-control">{{ old('pertanyaan') }}</textarea>
                            @error('pertanyaan')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>PILIHAN A</label>
                            <input type="text" name="pilihan_A" value="Sangat Setuju" class="form-control" >

                            @error('pilihan_A')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>PILIHAN B</label>
                            <input type="text" name="pilihan_B" value="Setuju" class="form-control" >

                            @error('pilihan_B')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>PILIHAN C</label>
                            <input type="text" name="pilihan_C" value="Kurang Setuju" class="form-control" >

                            @error('pilihan_C')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>PILIHAN D</label>
                            <input type="text" name="pilihan_D" value="Tidak Setuju" class="form-control" >

                            @error('pilihan_D')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>PILIHAN E</label>
                            <input type="text" name="pilihan_E" value="Sangat Tidak Setuju" class="form-control" >

                            @error('pilihan_E')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>POIN A</label>
                            <input type="text" name="poin1" value=1 class="form-control" >

                            @error('poin1')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>POIN B</label>
                            <input type="text" name="poin2" value=2 class="form-control" >

                            @error('poin2')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>POIN C</label>
                            <input type="text" name="poin3" value=3 class="form-control" >

                            @error('poin3')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>POIN D</label>
                            <input type="text" name="poin4" value=4 class="form-control" >

                            @error('poin4')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>POIN E</label>
                            <input type="text" name="poin5" value=5 class="form-control" >

                            @error('poin5')
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