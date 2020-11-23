@extends('layout.dashboard')

@section('content')
<table>
    <thead>
        <tr>
            <th>Nome</th>
            <th>Tipo</th>
            <th>Última Atualização</th>
        </tr>
    </thead>
    <tbody>
        @foreach($activeUserSessions as $activeUserSession)
        <tr>
            <td>{{ $activeUserSession->user->name }}</td>
            <td>{{ ($activeUserSession->user->manager!=null?'Gerente':'Vendedor (Caixa)') }}</td>
            <td>{{ \Carbon\Carbon::createFromTimestamp($activeUserSession->last_activity)->setTimezone('-3')->toDateTimeString() }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection