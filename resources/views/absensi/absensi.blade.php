<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Keterangan</th>
            <th>Tanggal</th> --}}
        </tr>
    </thead>
    <tbody>
    @php
        $count = 1;
   	@endphp
    @foreach ($absens as $no => $absensis)
        <tr>
            <td>{{ $count++ }}</td>
            <td>{{ $absensis->user->tentor->name }}</td> 
            <td>{{ $absensis->keterangan }}</td>
            <td>{{ $absensis->created_at }}</td>
            </tr>
        @endforeach
    </tbody>
</table>