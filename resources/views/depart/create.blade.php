@extends('layouts.admin')
@extends('layouts.sidebar')
@section('title', 'Department ')
@section('content-header', 'Department Create')
@section('content-actions')
<a href="{{route('department.index')}}" class="btn btn-primary">Home</a>
@endsection
@section('content')
<div class='card m-auto col-sm-12 col-lg-6 mt-2 shadow p-2'>
    <div class="card-header text-center">
        <h4>Department Create </h4>
    </div>
    <form action="{{route('department.store')}}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Department Name</label>
            <input type="text" class="form-control  @error('name') is-invalid @enderror"  id="name" name="name" placeholder="Enter Department Name">
            @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="form-group" >
            <label for="description">Department Description</label>
            <textarea class="form-control  @error('description') is-invalid @enderror"" id="description" name="description" rows="3"></textarea>
            @error('description')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="form-group">
            <input type="head" class="form-control @error('head') is-invalid @enderror" id="head" name="head" placeholder="Enter Department Head">
            @error('head')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="status">Fee</label>
            <input type="number" class="form-control @error('fee') is-invalid @enderror" id="fee" name="fee" placeholder="Enter Department Fee">
            @error('fee')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
@endsection
