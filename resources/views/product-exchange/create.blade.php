@extends('layout.dashboard')

@section('content')
<form action="<?= route('product-exchange.store') ?>" method="POST">
    @csrf
    <select required name="client_id">
        @foreach($clients as $client)
        <option value="{{$client->id}}" <?= (old('client_id') == $client->id ? 'selected' : '') ?>>{{$client->cpf}} | {{$client->name}} {{ ($client->preferential ? '(Preferencial)':'') }}</option>
        @endforeach
    </select>
    <input type="number" name="sale_product_id" value="<?= old('sale_product_id') ?? '' ?>" required placeholder="Número de identificação do produto vendido, é o número antes do nome do produto na NOTA FISCAL" />
    <button type="submit">Trocar Produto</button>
</form>
@endsection