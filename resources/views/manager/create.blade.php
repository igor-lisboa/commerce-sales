@extends('layout.dashboard')

@section('content')
<form action="<?= route('manager.store') ?>" method="POST">
    @csrf
    <select required name="user_id">
        @foreach($usersNotManagers as $usersNotManager)
        <option value="{{$usersNotManager->id}}">{{$usersNotManager->name}}</option>
        @endforeach
    </select>
    <button type="submit">Definir novo Gerente</button>
</form>
@endsection