@extends('layout.dashboard')

@section('content')
<table>
    <thead>
        <tr>
            <th></th>
            <th>Nome</th>
            <th>Vendedor desde</th>
            <th>Opções</th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
        <tr>
            <td>{{ $user->id }}</td>
            <td>{{$user->name}}</td>
            <td>{{$user->created_at}}</td>
            <td>
                <div class="d-flex">
                    @if($user->id != auth()->user()->id)
                    <form action="<?= route('user.destroy', [$user]) ?>" method="POST">
                        @method('DELETE')
                        @csrf
                        <button type="submit" onclick="return confirm('<?= __('user_msg_confirm_destroy', ['user' => $user->name]) ?>')">Remover Vendedor</button>
                    </form>
                    @endif
                    <button type="button" onclick="window.location.replace('<?= route('user.edit', [$user]) ?>')">Editar</button>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <td colspan="4">
                <button type="button" onclick="window.location.replace('<?= route('user.create') ?>')">Inserir novo Vendedor</button>
            </td>
        </tr>
    </tfoot>
</table>
{{$users->withQueryString()->links('vendor.pagination.bootstrap-4')}}
@endsection