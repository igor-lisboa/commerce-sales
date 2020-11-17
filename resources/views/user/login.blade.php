@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
<form method="POST" action="<?= route('auth') ?>">
    <fieldset>
        <h2>Login</h2>
        @csrf
        <input placeholder="E-Mail" type="email" name="email" required value="<?= old('email') ?>" />
        <input placeholder="Senha" type="password" name="password" required value="<?= old('password') ?>" />
        <label for="remember">
            <input type="checkbox" name="remember" id="remember" value="1" <?= (old('remember') ? 'checked' : '') ?> />
            <span>Lembrar</span>
        </label>
        <button type="submit">Entrar</button>
    </fieldset>
</form>
<form method="POST" action="<?= route('register') ?>">
    <fieldset>
        <h2>Registro</h2>
        @csrf
        <input placeholder="Nome" type="text" name="name" required value="<?= old('name') ?>" />
        <input placeholder="E-Mail" type="email" name="email" required value="<?= old('email') ?>" />
        <input placeholder="Senha" type="password" name="password" required value="<?= old('password') ?>" />
        <button type="submit">Registrar</button>
    </fieldset>
</form>