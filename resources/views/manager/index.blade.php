@extends('layout.dashboard')

@section('content')
<table>
    <thead>
        <tr>
            <th></th>
            <th>Nome</th>
            <th>Gerente desde</th>
            <th>Opções</th>
        </tr>
    </thead>
    <tbody>
        @foreach($managers as $manager)
        <tr>
            <td>{{ ($loop->index + 1) }}</td>
            <td>{{$manager->user->name}}</td>
            <td>{{$manager->created_at}}</td>
            <td>
                <form action="<?= route('manager.destroy', [$manager]) ?>" method="POST">
                    @method('DELETE')
                    @csrf
                    <button type="submit" onclick="return confirm('<?= __('manager_msg_confirm_destroy', ['manager' => $manager->user->name]) ?>')">Remover da Gerência</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <td colspan="4">
                <button type="submit" onclick="window.location.replace('<?= route('manager.create') ?>')">Inserir novo Gerente</button>
            </td>
        </tr>
    </tfoot>
</table>
{{$managers->links()}}
@endsection