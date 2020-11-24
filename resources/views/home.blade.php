@extends('layout.dashboard')

@section('content')
<button type="button" onclick="window.location.replace('<?= route('sale.create') ?>')">Inserir nova Venda</button>
<button type="button" onclick="window.location.replace('<?= route('complaint.create') ?>')">Registra Reclamação</button>
<hr>
@endsection