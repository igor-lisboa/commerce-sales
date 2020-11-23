@extends('layout.dashboard')

@section('content')
<form method="POST" action="<?= route('auth') ?>">
    <fieldset>
        <h2>Login</h2>
        @csrf
        <input type="hidden" name="redirect" value="<?= old('redirect') ?? $redirect ?>">
        <input placeholder="E-Mail" autocomplete="username" type="email" name="email" required value="<?= old('email') ?>" />
        <input placeholder="Senha" autocomplete="current-password" type="password" name="password" required value="<?= old('password') ?>" />
        <label for="remember">
            <input type="checkbox" name="remember" id="remember" value="1" <?= (old('remember') ? 'checked' : '') ?> />
            <span>Lembrar</span>
        </label>
        <button type="submit">Entrar</button>
    </fieldset>
</form>
<a href="<?= route('set_user_change_password') ?>">Esqueci minha senha</a>
@endsection