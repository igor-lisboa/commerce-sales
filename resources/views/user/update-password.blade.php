@extends('layout.dashboard')

@section('content')
<form method="POST" action="<?= route('update_password', [$user->remember_token]) ?>">
    <fieldset>
        @csrf
        <input placeholder="Nova Senha" autocomplete="current-password" type="password" name="password" required value="<?= old('password') ?>" />
        <input placeholder="Confirmação da Nova Senha" autocomplete="current-password" type="password" name="confirm_password" required value="<?= old('confirm_password') ?>" />
        <button type="submit">Atualizar senha</button>
    </fieldset>
</form>
@endsection