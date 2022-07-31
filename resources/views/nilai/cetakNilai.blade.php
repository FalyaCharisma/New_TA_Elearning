<!DOCTYPE html>
<html>
<head>
	<title>LAPORAN HASIL UJIAN SISWA</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
	<style type="text/css">
		table tr td,
		table tr th{
			font-size: 9pt;
		}
	</style>

	<center>
	<h4>LAPORAN HASIL REKAPAN UJIAN</h4>
        <h5>Nama : {{$users->getName($users->id)}}</h5>
	
	<table class='table table-bordered'>
		<thead>
			<tr>
			<th>NO</th>
            <th>NAMA</th>
            <!-- <th>FOTO</th> -->
            <th>Score</th>
            <th>TANGGAL</th>
			</tr>
		</thead>
		<tbody>
	
		@php
        	$count = 1;
   		@endphp
        @foreach ($users->exams as $no => $exam_user)
        <tr>            
            <td>{{ $count++}}</td>
            <td>{{ $exam_user->name}}</td>
            @if( $exam_user->pivot->score === null)
            <td>0</td>
            @else
            <td>{{ $exam_user->pivot->score }}</td>
            @endif
            <td>{{ $exam_user->pivot->created_at}}</td>
        </tr>
        @endforeach
    
		</tbody>
	</table>
    </center>

</body>
</html>