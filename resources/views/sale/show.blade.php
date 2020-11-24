<table>
    <tr>
        <td colspan="2">Cliente</td>
    </tr>
    <tr>
        <td>Preferencial:</td>
        <td>{{$sale->client->preferential ? 'Sim' : 'Não'}}</td>
    </tr>
    <tr>
        <td>Nome:</td>
        <td>{{$sale->client->name}}</td>
    </tr>
    <tr>
        <td>E-Mail:</td>
        <td>{{$sale->client->email}}</td>
    </tr>
    <tr>
        <td>CPF:</td>
        <td>{{$sale->client->cpf}}</td>
    </tr>
    <tr>
        <td>Identidade:</td>
        <td>{{$sale->client->identity}}</td>
    </tr>
    <tr>
        <td>Endereço:</td>
        <td>{{$sale->client->address}}</td>
    </tr>
</table>
<hr>
<table>
    <tr>
        <td colspan="5">
            Itens da Compra
        </td>
    </tr>
    <tr>
        <th></th>
        <th>Produto</th>
        <th>Preço Unitário (R$)</th>
        <th>Quantidade</th>
        <th>Total (R$)</th>
    </tr>
    @foreach($sale->products as $saleProduct)
    <tr>
        <td>{{ $saleProduct->id }}</td>
        <td>{{ $saleProduct->product->name }}</td>
        <td>{{ $saleProduct->price }}</td>
        <td>{{ $saleProduct->quantity }}</td>
        <td>{{ $saleProduct->total_price }}</td>
    </tr>
    @endforeach
</table>
<hr>
<h1>TOTAL: R${{$sale->total_amount}}</h1>
<hr>
<table>
    <tr>
        <td colspan="2">Vendedor</td>
    </tr>
    <tr>
        <td>Nome:</td>
        <td>{{$sale->user->name}}</td>
    </tr>
    <tr>
        <td>E-Mail:</td>
        <td>{{$sale->user->email}}</td>
    </tr>
</table>