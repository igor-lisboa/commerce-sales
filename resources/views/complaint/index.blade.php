@extends('layout.dashboard')

@section('content')
@include('partials.complaint.index',['complaints'=>$complaints])
@endsection