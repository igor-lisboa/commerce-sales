@extends('layout.dashboard')

@section('content')
<button type="button" onclick="window.location.replace('#')">Cria Venda</button>
<button type="button" onclick="window.location.replace('<?= route('complaint.create') ?>')">Registra Reclamação</button>
<hr>
@endsection