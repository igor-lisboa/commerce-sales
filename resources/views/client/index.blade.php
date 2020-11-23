@extends('layout.dashboard')

@section('content')
<table>
    <thead>
        <tr>
            <th></th>
            <th>Nome</th>
            <th>CPF</th>
            <th>Identidade</th>
            <th>Endereço</th>
            <th>E-Mail</th>
            <th>Preferêncial</th>
            <th>Reclamações</th>
            <th>Opções</th>
        </tr>
    </thead>
    <tbody>
        @foreach($clients as $client)
        <tr>
            <td>{{ $client->id }}</td>
            <td>{{$client->name}}</td>
            <td>{{ $client->cpf }}</td>
            <td>{{$client->identity}}</td>
            <td>{{$client->address}}</td>
            <td>{{$client->email}}</td>
            <td>{{ ($client->preferential ? 'Sim' : 'Não') }}</td>
            <td>{{$client->complaints()->count()}}</td>
            <td>
                <div class="d-flex">
                    <form action="<?= route('client.destroy', [$client]) ?>" method="POST">
                        @method('DELETE')
                        @csrf
                        <button type="submit" onclick="return confirm('<?= __('client_msg_confirm_destroy', ['client' => $client->name]) ?>')">Remover Cliente</button>
                    </form>
                    <button type="button" onclick="window.location.replace('<?= route('client.edit', [$client]) ?>')">Editar</button>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <td colspan="4">
                <button type="button" onclick="window.location.replace('<?= route('client.create') ?>')">Inserir novo Cliente</button>
            </td>
        </tr>
    </tfoot>
</table>
{{$clients->withQueryString()->links('vendor.pagination.bootstrap-4')}}
@endsection