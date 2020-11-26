@extends('layout.dashboard')

@section('content')
<button type="button" onclick="window.location.replace('<?= route('sale.create') ?>')">Inserir nova Venda</button>
<button type="button" onclick="window.location.replace('<?= route('complaint.create') ?>')">Registra Reclamação</button>
<button type="button" onclick="window.location.replace('<?= route('product-exchange.create') ?>')">Realiza Troca</button>
<hr>
<h1>O trabalho foi feito por:</h1>
<ul>
    <li>Caio Wey</li>
    <li>Igor Lisboa</li>
</ul>
<h3>Usamos <a href="https://laravel.com">Laravel</a> para desenvolver.</h3>
<a href="https://drive.google.com/drive/folders/1VbdfnAtDPqReQlx2Qnu7xCf6Et_zDrnx" target="_blank">Os diagramas podem ser encontrados aqui!</a>
@endsection