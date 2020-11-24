@extends('layout.dashboard')

@section('content')
<form method="POST" action="<?= route('sale.store') ?>">
    <fieldset>
        <h2>Por favor, informe o Cliente</h2>
        <select name="client_id" required>
            @foreach($clients as $client)
            <option value="{{$client->id}}" <?= (old('client_id') == $client->id ? 'selected' : '') ?>>{{$client->cpf}} | {{$client->name}} {{ ($client->preferential ? '(Preferencial)':'') }}</option>
            @endforeach
        </select>
        <button type="submit">Informar Cliente</button>
        <hr>
        <small>O cliente não está cadastrado?</small>
        <button type="button" onclick="window.location.replace('<?= route('client.create') ?>')">Inserir novo Cliente</button>
        @csrf
    </fieldset>
</form>
@endsection