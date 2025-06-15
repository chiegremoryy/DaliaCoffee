<h2>Login</h2>

@if ($errors->any())
    <div style="color:red;">{{ $errors->first() }}</div>
@endif

<form method="POST" action="{{ route('login') }}">
    @csrf
    <input type="email" name="email" placeholder="Email" required><br>
    <input type="password" name="password" placeholder="Password" required><br>
    <button type="submit">Login</button>
</form>

<p>Belum punya akun? <a href="{{ route('register') }}">Register</a></p>
