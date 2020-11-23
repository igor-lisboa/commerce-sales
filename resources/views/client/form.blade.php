@extends('layout.dashboard')

@section('content')
<form method="POST" action="<?= route(($client ?? null ? 'client.update' : 'client.store'), ($client ?? null ? [$client] : [])) ?>">
    <fieldset>
        @if($client??null)
        @method('PUT')
        @endif
        @csrf
        <input placeholder="Nome" type="text" name="name" required value="<?= old('name') ?? ($client->name ?? '') ?>" />
        <input placeholder="E-Mail" type="email" name="email" required value="<?= old('email') ?? ($client->email ?? '') ?>" />
        <input placeholder="CPF" type="text" name="cpf" required value="<?= old('cpf') ?? ($client->cpf ?? '') ?>" />
        <input placeholder="Identidade" type="text" name="identity" required value="<?= old('identity') ?? ($client->identity ?? '') ?>" />
        <input placeholder="Endereço" type="text" name="address" required value="<?= old('address') ?? ($client->address ?? '') ?>" />
        <button type="submit">Gravar</button>
    </fieldset>
</form>
@endsection