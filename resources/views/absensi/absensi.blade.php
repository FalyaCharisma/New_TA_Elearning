<!-- <table>
    <thead>
    <title>Belajar Membuat Tabel HTML</title>

        <tr>
            <th>NAMA</th>
            <th>KETERANGAN</th>
            <th>TANGGAL</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($absens as $no => $absensis)
            <td>{{ $absensis->name }}</td>
            <td>{{ $absensis->keterangan }}</td>
            <td>{{ $absensis->created_at }}</td>
        @endforeach
    </tbody>
</table> -->

<!DOCTYPE html>
<html>
<head>
	<title>LAPORAN ABSENSI TENTOR</title>
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
		<h5>LAPORAN ABSENSI TENTOR</h4>
	</center>
        <center>
	<table class='table table-bordered'>
		<thead>
			<tr>
            <th>NAMA</th>
            <th>KETERANGAN</th>
            <th>TANGGAL</th>
			</tr>
		</thead>
		<tbody>
        @foreach ($absens as $no => $absensis)
        <tr>
            <td>{{ $absensis->name }}</td>
            <td>{{ $absensis->keterangan }}</td>
            <td>{{ $absensis->created_at }}</td>
            </tr>
        @endforeach
    
		</tbody>
	</table>
    </center>

</body>
</html>