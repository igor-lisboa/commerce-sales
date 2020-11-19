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
@endsection