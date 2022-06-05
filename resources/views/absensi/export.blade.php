<table>
    <thead>
        <tr>
            <th>Nama</th>
            <th>Keterangan</th>
            <th>Tanggal</th> --}}
        </tr>
    </thead>
    <tbody>
    @foreach ($absens as $no => $absensis)
        <tr>
            <td>{{ $absensis->name }}</td>
            <!-- <td><img src="{{ asset('storage/public/absensis/'. $absensis->link) }}" width="150" ></td> -->
            <td>{{ $absensis->keterangan }}</td>
            <td>{{ $absensis->created_at }}</td>
            </tr>
        @endforeach
    </tbody>
</table>