@extends('layout.dashboard')

@section('content')
@if($sale??null)
<h4>Cliente: {{$sale->client->cpf}} | {{$sale->client->name}} {{ ($sale->client->preferential ? '(Preferencial)':'') }}</h4>
<hr>
<h2>Produtos da Venda</h2>
<table>
    <thead>
        <tr>
            <th></th>
            <th>Produto</th>
            <th>Preço Unitário (R$)</th>
            <th>Quantidade</th>
            <th>Total (R$)</th>
            <th>Opções</th>
        </tr>
    </thead>
    <tbody>
        @foreach($sale->products as $saleProduct)
        <tr>
            <td>{{ $saleProduct->id }}</td>
            <td>{{ $saleProduct->product->name }}</td>
            <td>{{ $saleProduct->price }}</td>
            <td>{{ $saleProduct->quantity }}</td>
            <td>{{ $saleProduct->total_price }}</td>
            <td>
                <div class="d-flex">
                    @if(auth()->user()->manager)
                    <form action="<?= route('sale-product.destroy', [$saleProduct, 'sale' => $sale]) ?>" method="POST">
                        @method('DELETE')
                        @csrf
                        <button type="submit" onclick="return confirm('<?= __('sale_product_msg_confirm_destroy', ['product' => $saleProduct->product->name]) ?>')">Remover Produto</button>
                    </form>
                    <form method="POST" action="<?= route('sale-product.update', [$saleProduct, 'sale' => $sale]) ?>">
                        @csrf
                        @method('PUT')
                        <input type="number" name="quantity" placeholder="Nova Quantidade" required min="1" />
                        <button type="submit">Atualizar Quantidade do Produto</button>
                    </form>
                    @endif
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <td colspan="6">
                <hr>
                <form method="POST" action="<?= route('sale.sale-product.store', [$sale]) ?>">
                    @csrf
                    <select name="product_id" required>
                        @foreach($products as $product)
                        <option value="{{$product->id}}">{{$product->bar_code}} | {{$product->name}} (R${{$product->price}} {{($product->price_promotion ? '[promoção: R$'.$product->price_promotion.']':'')}})</option>
                        @endforeach
                    </select>
                    <input type="number" name="quantity" placeholder="Quantidade" required min="1" />
                    <button type="submit">Incluir Produto</button>
                </form>
            </td>
        </tr>
    </tfoot>
</table>
<hr>
<h2>Subtotal: R${{$sale->total_amount}}</h2>
@endif
<form method="POST" action="<?= route(($sale ?? null ? 'sale.update' : 'sale.store'), ($sale ?? null ? [$sale] : [])) ?>">
    <fieldset>
        @if($sale??null)
        @method('PUT')
        <select name="payment_method_id" required>
            @foreach($paymentMethods as $paymentMethod)
            <option value="{{$paymentMethod->id}}" <?= ((old('payment_method_id') ?? ($sale->payment_method_id ?? '')) == $paymentMethod->id ? 'selected' : '') ?>>{{$paymentMethod->method}}</option>
            @endforeach
        </select>
        @if($sale->client->preferential)
        <input type="number" name="used_points" placeholder="Pontos que serão usados" min="1" />
        <small>Cada ponto equivale a 1 centavo (R$0.01)</small>
        @endif
        <button type="submit" onclick="return confirm('<?= __('msg_confirm_finish_sale', ['total' => $sale->total_amount]) ?>')">Finalizar</button>
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
        @else
        <h2>Por favor, informe o Cliente</h2>
        <select name="client_id" required>
            @foreach($clients as $client)
            <option value="{{$client->id}}" <?= (old('client_id') == $client->id ? 'selected' : '') ?>>{{$client->cpf}} | {{$client->name}} {{ ($client->preferential ? '(Preferencial)':'') }}</option>
            @endforeach
        </select>
        <button type="submit">Informar Cliente</button>
        <hr>
        <small>O cliente não está cadastrado?</small>
        <button type="button" onclick="window.location.replace('<?= route('client.create') ?>')">Inserir novo Cliente</button>
        @endif
        @csrf
    </fieldset>
</form>
@endsection