@extends('layout.dashboard')

@section('content')
<table>
    <thead>
        <tr>
            <th></th>
            <th>Cliente</th>
            <th>Produto Trocado</th>
            <th>Momento</th>
        </tr>
    </thead>
    <tbody>
        @foreach($productExchanges as $productExchange)
        <tr>
            <td>{{ $productExchange->id }}</td>
            <td>{{$productExchange->client->name}}</td>
            <td>{{$productExchange->sale_product->product->name}}</td>
            <td>{{$productExchange->created_at}}</td>
        </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <td colspan="4">
                <button type="button" onclick="window.location.replace('<?= route('product-exchange.create') ?>')">Nova Troca de Produto</button>
            </td>
        </tr>
    </tfoot>
</table>
{{$productExchanges->withQueryString()->links('vendor.pagination.bootstrap-4')}}
@endsection