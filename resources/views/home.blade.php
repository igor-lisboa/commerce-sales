@extends('layout.dashboard')

@section('content')
@if($canBeManager)
<a href="<?= route('manager_register') ?>">Clique aqui para ser Gerente!</a>
@endif
{{auth()->user()}}
@endsection