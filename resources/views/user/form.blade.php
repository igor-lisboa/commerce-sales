@extends('layout.dashboard')

@section('content')
<form method="POST" action="<?= route(($user ?? null ? 'user.update' : 'user.store'), ($user ?? null ? [$user] : [])) ?>">
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
@if($user??null)
@if($user->id==auth()->user()->id)
<form action="<?= route('user_request_change_password') ?>" method="POST">
    @csrf
    <input type="hidden" name="email" value="{{$user->email}}" />
    <button type="submit" onclick="alert('<?= __('msg_change_password_mail_send') ?>')">Trocar senha</button>
</form>
@endif
@endif

@endsection