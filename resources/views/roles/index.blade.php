@extends('layouts.admin')
@extends('layouts.sidebar')
@section('title', 'Department ')
@section('content-header', 'Department Create')
@section('content-actions')
<a href="{{route('department.create')}}" class="btn btn-primary">Home</a>
@endsection
{{-- get all the permisiion and create more rights --}}

@endsection