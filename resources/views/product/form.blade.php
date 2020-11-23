@extends('layout.dashboard')

@section('content')
<form method="POST" action="<?= route(($product ?? null ? 'product.update' : 'product.store'), ($product ?? null ? [$product] : [])) ?>">
    <fieldset>
        @if($product??null)
        @method('PUT')
        @endif
        @csrf
        <input placeholder="Nome" type="text" name="name" required value="<?= old('name') ?? ($product->name ?? '') ?>" />
        <input placeholder="Preço" type="number" min="0" step="0.01" name="price_cents" required value="<?= old('price_cents') ?? ($product->price_cents ?? '') ?>" />
        <input placeholder="Promoção Preço" type="number" min="0" step="0.01" name="price_cents_promotion" value="<?= old('price_cents_promotion') ?? ($product->price_cents_promotion ?? '') ?>" />
        <input placeholder="Código de Barras" type="text" name="bar_code" required value="<?= old('bar_code') ?? ($product->bar_code ?? '') ?>" />
        <input placeholder="Fornecedor" type="text" name="provider" required value="<?= old('provider') ?? ($product->provider ?? '') ?>" />
        <button type="submit">Gravar</button>
    </fieldset>
</form>
@if($product??null)
<hr>
<form method="POST" action="<?= route('product_stock_add', [$product]) ?>">
    <fieldset>
        @csrf
        <h2>ADIÇÃO DE {{$product->name}}</h2>
        <input type="hidden" name="product_id" value="<?= $product->id ?>" />
        <input placeholder="Quantidade adicionada" min="1" type="number" name="input" required value="<?= old('input') ?>" />
        <button type="submit">Registrar adição de itens</button>
    </fieldset>
</form>
<hr>
<h1>Quantidade de Itens no Estoque: {{ $product->balance }}</h1>
<h2>Histórico de Operações no Estoque</h2>
<table>
    <tr>
        <th>Data de Operação</th>
        <th>Quantidade Adicionada</th>
        <th>Quantidade Retirada</th>
    </tr>
    @foreach($product->stock as $stock)
    <tr>
        <td>{{$stock->created_at}}</td>
        <td>{{$stock->input}}</td>
        <td>{{$stock->output}}</td>
    </tr>
    @endforeach
</table>
@endif
@endsection