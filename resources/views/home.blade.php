@extends('layout.dashboard')

@section('content')
{{auth()->user()}}
@endsection