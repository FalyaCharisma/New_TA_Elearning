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
        <h5>Nama : {{$user->getName(Auth()->id())}}</h5>
	
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
        @foreach ($nilai as $no => $n)
        <tr>
		<td>{{ $count++ }}</td>
        <td>{{ $n->name }}</td> 
            <td>{{ $user->getScore(Auth()->id(), $n->id) !== null ? $user->getScore(Auth()->id(), $n->id) : "Belum dikerjakan" }}</td>
            <td>{{ $n->created_at }}</td>
            </tr>
        @endforeach
    
		</tbody>
	</table>
    </center>

</body>
</html>