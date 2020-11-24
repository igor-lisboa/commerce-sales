@extends('layout.dashboard')

@section('content')
<table>
    <thead>
        <tr>
            <th></th>
            <th>Nome</th>
            <th>Preço(R$)</th>
            <th>Preço Promocional(R$)</th>
            <th>Quantidade em Estoque</th>
            <th>Fornecedor</th>
            <th>Opções</th>
        </tr>
    </thead>
    <tbody>
        @foreach($products as $product)
        <tr>
            <td>{{ $product->id }}</td>
            <td>{{$product->name}}</td>
            <td>{{ $product->price }}</td>
            <td>{{ ($product->price_promotion ? $product->price_promotion : '') }}</td>
            <td>{{$product->balance}}</td>
            <td>{{$product->provider}}</td>
            <td>
                <div class="d-flex">
                    <form action="<?= route('product.destroy', [$product]) ?>" method="POST">
                        @method('DELETE')
                        @csrf
                        <button type="submit" onclick="return confirm('<?= __('product_msg_confirm_destroy', ['product' => $product->name]) ?>')">Remover Produto</button>
                    </form>
                    <button type="button" onclick="window.location.replace('<?= route('product.edit', [$product]) ?>')">Editar</button>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <td colspan="4">
                <button type="button" onclick="window.location.replace('<?= route('product.create') ?>')">Inserir novo Produto</button>
            </td>
        </tr>
    </tfoot>
</table>
{{$products->withQueryString()->links('vendor.pagination.bootstrap-4')}}
@endsection