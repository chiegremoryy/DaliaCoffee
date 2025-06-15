<!DOCTYPE html>
<html>
<head>
    <title>Edit Karyawan</title>
</head>
<body>
    <h1>Edit Karyawan</h1>

    <form action="{{ route('karyawan.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label>Nama:</label>
        <input type="text" name="name" value="{{ $user->name }}" required><br><br>

        <label>Email:</label>
        <input type="email" name="email" value="{{ $user->email }}" required><br><br>

        <button type="submit">Update</button>
    </form>

    <br>
    <a href="{{ route('karyawan.index') }}">Kembali</a>
</body>
</html>
