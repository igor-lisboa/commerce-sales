@extends('layout.dashboard')

@section('content')
<table>
    <thead>
        <tr>
            <th></th>
            <th>Vendedor (Caixa)</th>
            <th>Cliente</th>
            <th>Método de Pagamento</th>
            <th>Total da Venda (R$)</th>
            <th>Status</th>
            <th>Iniciada em</th>
            <th>Opções</th>
        </tr>
    </thead>
    <tbody>
        @foreach($sales as $sale)
        <tr>
            <td>{{ $sale->id }}</td>
            <td>{{$sale->user->name}}</td>
            <td>{{$sale->client->name}}</td>
            <td>{{ ($sale->method?$sale->method->method:'-') }}</td>
            <td>{{$sale->total_amount}}</td>
            <td>{{$sale->status}}</td>
            <td>{{$sale->created_at}}</td>
            <td>
                <div class="d-flex">
                    @if($sale->status==__("Opened"))
                    @if(auth()->user()->manager)
                    <form action="<?= route('sale.destroy', [$sale]) ?>" method="POST">
                        @method('DELETE')
                        @csrf
                        <button type="submit" onclick="return confirm('<?= __('sale_msg_confirm_cancel', ['client' => $sale->client->name, 'created_at' => $sale->created_at]) ?>')">Cancelar Venda</button>
                    </form>
                    @endif
                    @if(auth()->user()->id == $sale->user_id || auth()->user()->manager)
                    <button type="button" onclick="window.location.replace('<?= route('sale.edit', [$sale]) ?>')">Continuar com a Venda</button>
                    @endif
                    @endif
                    <button type="button" onclick="window.location.replace('<?= route('sale.show', [$sale]) ?>')">Visualizar Venda</button>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <td colspan="7">
                <button type="button" onclick="window.location.replace('<?= route('sale.create') ?>')">Inserir nova Venda</button>
            </td>
        </tr>
    </tfoot>
</table>
{{$sales->withQueryString()->links('vendor.pagination.bootstrap-4')}}
@endsection