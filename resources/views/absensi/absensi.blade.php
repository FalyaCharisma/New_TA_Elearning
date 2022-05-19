<!DOCTYPE html>
<html>
<head>
	<title>Export Laporan Excel Pada Laravel</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
 
	<div class="container">
		<center>
			<h4>Export Laporan Excel Pada Laravel</h4>
			<h5><a target="_blank" href="https://www.malasngoding.com/">www.malasngoding.com</a></h5>
		</center>
		
		<a href="/siswa/export_excel" class="btn btn-success my-3" target="_blank">EXPORT EXCEL</a>
		
		<table class='table table-bordered'>
        <thead>
                            <tr>
                                <th scope="col" style="text-align: center;width: 6%">NO.</th>
                                <th scope="col">NAMA</th>
                                <th scope="col">KETERANGAN</th>
                                <th scope="col">TANGGAL</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($absens as $no => $absensis)
                                <tr>
                                    <th scope="row" style="text-align: center">{{ ++$no + ($absens->currentPage()-1) * $absens->perPage() }}</th>
                                    <td>{{ $absensis->name }}</td>
                                    <td>{{ $absensis->keterangan }}</td>
                                    <td>{{ $absensis->created_at }}</td>
                                    <td class="text-center">
                                        @can('absensi.delete')
                                            <button onClick="Delete(this.id)" class="btn btn-sm btn-danger" id="{{ $absensis->id }}">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        @endcan
                                    </td>
                                </tr>
				@endforeach
			</tbody>
		</table>
	</div>
 
</body>
</html>