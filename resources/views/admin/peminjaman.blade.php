<h2>Data Peminjaman</h2>

<table border="1">
<tr>
    <th>User</th>
    <th>Buku</th>
    <th>Status</th>
    <th>Aksi</th>
</tr>

@foreach($peminjaman as $p)
<tr>
    <td>{{ $p->user->name }}</td>
    <td>{{ $p->buku->judul ?? 'Buku tidak ditemukan' }}</td>
    <td>{{ $p->status }}</td>

    <td>
        @if($p->status == 'menunggu')
            <a href="/admin/approve/{{ $p->id }}">Approve</a>
        @endif

        @if($p->status == 'dipinjam')
            <a href="/admin/kembalikan/{{ $p->id }}">Kembalikan</a>
        @endif
    </td>
</tr>
@endforeach

</table>