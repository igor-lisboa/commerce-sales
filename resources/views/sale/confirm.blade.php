@extends('layout.dashboard')

@section('content')

@if($sale->used_points!=0)
<h2>Subtotal: R${{$sale->total_amount}}</h2>
<h3>Pontos usados: {{$sale->used_points}}</h3>
<hr>
@endif
<h1>Total: R${{$sale->total_due}}</h1>
<h4>Método de Pagamento Escolhido: {{$sale->payment_method->method}}</h4>
@if($sale->payment_method->can_have_change)
<input type="number" name="amount_paid_cents" step="0.01" min="{{$sale->total_due}}" placeholder="Valor Pago (R$)" />
@endif
<hr>
<small>Algo errado ou faltando na Venda?</small>
<button type="button" onclick="window.location.replace('<?= route('sale.edit', [$sale]) ?>')">Editar Venda</button>
<hr>
<h4>Por favor confirme os dados do CLIENTE:</h4>
<table>
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
    <tr>
        <td>Algum dado inválido ou desatualizado?</td>
        <td>
            <button type="button" onclick="window.location.replace('<?= route('client.edit', [$sale->client]) ?>')">Edite o Cliente</button>
        </td>
    </tr>
</table>
<hr>
<form method="POST" action="<?= route('sale_pay', [$sale]) ?>">
    @csrf
    <button type="submit">Confirmar pagamento</button>
</form>
@endsection