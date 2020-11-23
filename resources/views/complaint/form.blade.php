@extends('layout.dashboard')

@section('content')
<form method="POST" action="<?= route(($complaint ?? null ? 'complaint.update' : 'complaint.store'), ($complaint ?? null ? [$complaint] : [])) ?>">
    <fieldset>
        @if($complaint??null)
        @method('PUT')
        @endif
        @csrf
        <select name="client_id" required>
            @foreach($clients as $client)
            <option value="{{$client->id}}" <?= ((old('client_id') ?? ($complaint->client_id ?? ($client_id ?? null ? $client_id : ''))) == $client->id ? 'selected' : '') ?>>{{$client->cpf}} | {{$client->name}}</option>
            @endforeach
        </select>
        <textarea name="complaint" required placeholder="Reclamação"><?= old('complaint') ?? ($complaint->complaint ?? '') ?></textarea>
        <button type="submit">Gravar</button>
    </fieldset>
</form>
@endsection