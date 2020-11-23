<table>
    <thead>
        <tr>
            <th></th>
            <th>Cliente</th>
            <th>Reclamação</th>
            <th>Realizada em</th>
            <th>Opções</th>
        </tr>
    </thead>
    <tbody>
        @foreach($complaints as $complaint)
        <tr>
            <td>{{ $complaint->id }}</td>
            <td>{{$complaint->client->name}}</td>
            <td>{!! nl2br($complaint->complaint) !!}</td>
            <td>{{$complaint->created_at}}</td>
            <td>
                <div class="d-flex">
                    <form action="<?= route('complaint.destroy', [$complaint]) ?>" method="POST">
                        @method('DELETE')
                        @csrf
                        <button type="submit" onclick="return confirm('<?= __('complaint_msg_confirm_destroy', ['complaint' => $complaint->complaint]) ?>')">Remover Reclamação</button>
                    </form>
                    <button type="button" onclick="window.location.replace('<?= route('complaint.edit', [$complaint]) ?>')">Editar</button>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <td colspan="5">
                <button type="button" onclick="window.location.replace('<?= route('complaint.create', ($client_id ?? null ? ['client_id' => $client_id] : [])) ?>')">Inserir nova Reclamação</button>
            </td>
        </tr>
    </tfoot>
</table>
{{$complaints->withQueryString()->links('vendor.pagination.bootstrap-4')}}