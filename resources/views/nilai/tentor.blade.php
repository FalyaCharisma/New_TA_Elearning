@extends('layouts.app')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Nilai Ujian</h1>
        </div>

        <div class="section-body">

            <div class="card">
                <div class="card-header">
                    <h4><i class="fas fa-exam"></i> Nilai Ujian </h4>
                </div>

                <div class="card-body">
                    
                    <div class="table-responsive">
                        
                                @php
                                 $count=1;
                                @endphp
                            @foreach ($users as $no => $user)
                               
                                   
                                    @if(!empty($user->getRoleNames()))
                                    @foreach($user->getRoleNames() as $role)
                                    @if($role=='student')
                                    @if(Auth::user()->tentor->name==$user->siswa->nama_tentor)
                                    <a href="siswa/{{ $user->id }}" class="btn btn-sm btn-primary">{{ $user->siswa->name }}</a>
                                    @endif
                                    @endif
                                    @endforeach
                                    @endif
                                   
                            
                            @endforeach
                       
                       
                    </div>
                </div>
                
            </div>            
        </div>

    </section>
    
</div>
@stop