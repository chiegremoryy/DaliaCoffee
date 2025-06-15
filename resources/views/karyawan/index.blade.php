<!DOCTYPE html>
<html>
<head>
    <title>Daftar Karyawan</title>
</head>
<body>
    <h1>Daftar Karyawan/Kasir</h1>

    <a href="{{ route('karyawan.create') }}">Tambah Karyawan</a>

    <table border="1" cellpadding="8" cellspacing="0">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Email</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        <a href="{{ route('karyawan.edit', $user->id) }}">Edit</a>
                        <form action="{{ route('karyawan.destroy', $user->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Yakin hapus?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
