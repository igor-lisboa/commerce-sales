@extends('layout.dashboard')

@section('content')
@if($canBeManager)
<form method="POST" action="<?= route('manager.store') ?>">
    @csrf
    <input type="hidden" name="user_id" value="{{auth()->user()->id}}">
    <button type="submit">Clique aqui para ser Gerente!</button>
</form>
@endif
{{auth()->user()}}
@endsection