@extends('layout.dashboard')

@section('content')
<form method="POST" action="<?= route(($user ?? null ? 'user.update' : 'user.store')) ?>">
    <fieldset>
        @if($user??null)
        @method('PUT')
        @endif
        @csrf
        <input placeholder="Nome" type="text" name="name" required value="<?= old('name') ?? ($user->name ?? '') ?>" />
        <input placeholder="E-Mail" autocomplete="username" type="email" name="email" required value="<?= old('email') ?? ($user->email ?? '') ?>" />
        <button type="submit">Registrar</button>
    </fieldset>
</form>
@endsection