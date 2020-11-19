@extends('layout.dashboard')

@section('content')
{{auth()->user()}}
<a href="#">Cria Venda</a>
@endsection