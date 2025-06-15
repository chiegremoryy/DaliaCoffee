<!DOCTYPE html>
<html>
<head>
    <title>Tambah Karyawan</title>
</head>
<body>
    <h1>Tambah Karyawan</h1>

    <form action="{{ route('karyawan.store') }}" method="POST">
        @csrf
        <label>Nama:</label>
        <input type="text" name="name" required><br><br>

        <label>Email:</label>
        <input type="email" name="email" required><br><br>

        <label>Password:</label>
        <input type="password" name="password" required><br><br>

        <button type="submit">Simpan</button>
    </form>

    <br>
    <a href="{{ route('karyawan.index') }}">Kembali</a>
</body>
</html>
