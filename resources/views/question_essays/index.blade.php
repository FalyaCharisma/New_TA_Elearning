@extends('layouts.app')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Bank Soal</h1>
        </div>

        <div class="section-body">

            <div class="card">
                <div class="card-header">
                    <h4><i class="fas fa-question"></i> Soal Esai</h4>
                </div>

                <div class="card-body">
                    <form action="{{ route('questions.index') }}" method="GET">
                        <div class="form-group">
                            <div class="input-group mb-3">
                                @can('questions.create')
                                    <div class="input-group-prepend">
                                        <a href="{{ route('question_essays.create') }}" class="btn btn-primary" style="padding-top: 10px;"><i class="fa fa-plus-circle"></i> TAMBAH SOAL</a>
                                    </div>
                                @endcan
                                <input type="text" class="form-control" name="q"
                                       placeholder="cari berdasarkan pertanyaan">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> CARI
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
          
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th scope="col" style="text-align: center;width: 6%">NO.</th>
                                <th scope="col">SUBJECT</th>
                                <th scope="col">PERTANYAAN</th> 
                                <th scope="col">ATTACHMENT</th>
                                <th scope="col">JAWABAN</th>
                                <th scope="col">PENJELASAN</th>                               
                                <th scope="col">CREATED BY</th>
                                <th scope="col" style="width: 15%;text-align: center">AKSI</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($questionEssays as $no => $question)
                                <tr>
                                    <th scope="row" style="text-align: center">{{ ++$no + ($questionEssays->currentPage()-1) * $questionEssays->perPage() }}</th>
                                    <td>{{ $subject->getName($question->subject_id) }}</td>
                                    <td>{{ $question->detail }}</td>
                                    <td>
                                        @if ($question->video_id)
                                            <a href=" {{  asset('storage/public/videos/'.$video->getLink($question->video_id)) }}">VIDEO</a>
                                        @elseif($question->audio_id)
                                            <a href=" {{  asset('storage/public/audios/'.$audio->getLink($question->audio_id)) }}">AUDIO</a>
                                        @elseif($question->document_id)
                                            <a href=" {{  asset('storage/public/documents/'.$document->getLink($question->document_id)) }}">DOCUMENT</a>
                                        @elseif($question->image_id)
                                            <a href=" {{  asset('storage/public/images/'.$image->getLink($question->image_id)) }}">IMAGE</a>
                                        @elseif ($question->video_id && $question->audio_id)
                                            <a href=" {{  asset('storage/public/videos/'.$video->getLink($question->video_id)) }}">VIDEO</a>
                                            <a href=" {{  asset('storage/public/audios/'.$audio->getLink($question->audio_id)) }}">AUDIO</a>
                                        @elseif ($question->video_id && $question->document_id)
                                            <a href=" {{  asset('storage/public/videos/'.$video->getLink($question->video_id)) }}">VIDEO</a>
                                            <a href=" {{  asset('storage/public/documents/'.$document->getLink($question->document_id)) }}">DOCUMENT</a>
                                        @elseif ($question->video_id && $question->image_id)
                                            <a href=" {{  asset('storage/public/videos/'.$video->getLink($question->video_id)) }}">VIDEO</a>
                                            <a href=" {{  asset('storage/public/images/'.$image->getLink($question->image_id)) }}">IMAGE</a>
                                        @elseif ($question->audio_id && $question->document_id)
                                            <a href=" {{  asset('storage/public/audios/'.$audio->getLink($question->audio_id)) }}">AUDIO</a>
                                            <a href=" {{  asset('storage/public/documents/'.$document->getLink($question->document_id)) }}">DOCUMENT</a>
                                        @elseif ($question->audio_id && $question->image_id)
                                            <a href=" {{  asset('storage/public/audios/'.$audio->getLink($question->audio_id)) }}">AUDIO</a>
                                            <a href=" {{  asset('storage/public/images/'.$image->getLink($question->image_id)) }}">IMAGE</a>
                                        @elseif ($question->document_id && $question->image_id)
                                            <a href=" {{  asset('storage/public/documents/'.$document->getLink($question->document_id)) }}">DOCUMENT</a>
                                            <a href=" {{  asset('storage/public/images/'.$image->getLink($question->image_id)) }}">IMAGE</a>
                                        @else
                                            NO
                                        @endif
                                    </td>
                                    <td>{{ $question->answer }}</td>
                                    <td>{{ $question->explanation }}</td>
                                    <td>{{ $user->getName($question->created_by) }}</td>
                                    <td class="text-center">
                                        @can('question_essays.edit')
                                            <a href="{{ route('question_essays.edit', $question->id) }}" class="btn btn-sm btn-primary">
                                                <i class="fa fa-pencil-alt"></i>
                                            </a>
                                        @endcan
                                        
                                        @can('question_essays.delete')
                                            <button onClick="Delete(this.id)" class="btn btn-sm btn-danger" id="{{ $question->id }}">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div style="text-align: center">
                            {{$questionEssays->links("vendor.pagination.bootstrap-4")}}
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
</div>

<script>
    //ajax delete
    function Delete(id)
        {
            var id = id;
            var token = $("meta[name='csrf-token']").attr("content");

            swal({
                title: "APAKAH KAMU YAKIN ?",
                text: "INGIN MENGHAPUS DATA INI!",
                icon: "warning",
                buttons: [
                    'TIDAK',
                    'YA'
                ],
                dangerMode: true,
            }).then(function(isConfirm) {
                if (isConfirm) {

                    //ajax delete
                    jQuery.ajax({
                        url: "{{ route("question_essays.index") }}/"+id,
                        data:   {
                            "id": id,
                            "_token": token
                        },
                        type: 'DELETE',
                        success: function (response) {
                            if (response.status == "success") {
                                swal({
                                    title: 'BERHASIL!',
                                    text: 'DATA BERHASIL DIHAPUS!',
                                    icon: 'success',
                                    timer: 1000,
                                    showConfirmButton: false,
                                    showCancelButton: false,
                                    buttons: false,
                                }).then(function() {
                                    location.reload();
                                });
                            }else{
                                swal({
                                    title: 'GAGAL!',
                                    text: 'DATA GAGAL DIHAPUS!',
                                    icon: 'error',
                                    timer: 1000,
                                    showConfirmButton: false,
                                    showCancelButton: false,
                                    buttons: false,
                                }).then(function() {
                                    location.reload();
                                });
                            }
                        }
                    });

                } else {
                    return true;
                }
            })
        }
</script>
@stop