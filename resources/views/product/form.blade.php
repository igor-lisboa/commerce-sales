@extends('layout.dashboard')

@section('content')
<form method="POST" action="<?= route(($product ?? null ? 'product.update' : 'product.store'), ($product ?? null ? [$product] : [])) ?>">
    <fieldset>
        @if($product??null)
        @method('PUT')
        @endif
        @csrf
        <input placeholder="Nome" type="text" name="name" required value="<?= old('name') ?? ($product->name ?? '') ?>" />
        <button type="submit">Gravar</button>
    </fieldset>
</form>
@endsection