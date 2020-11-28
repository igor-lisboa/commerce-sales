<h2>O troco é de: R${{$sale->change}}</h2>
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
@if($sale->used_points!=0)
<h2>Subtotal: R${{$sale->total_amount}}</h2>
<h3>Pontos usados: {{$sale->used_points}}</h3>
@endif
<h1>Total: R${{$sale->total_due}}</h1>
<h2>Valor Pago: R${{$sale->amount_paid}}</h2>
<h4>Método de Pagamento Escolhido: {{$sale->payment_method->method}}</h4>
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
<hr>
<a href="<?= route('home') ?>">Ir para Home</a>