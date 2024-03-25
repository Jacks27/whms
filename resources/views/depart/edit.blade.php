@extends('layouts.admin')
@extends('layouts.sidebar')
@section('title', 'Department ')
@section('content-header', 'Department Update')
@section('content-actions')
<a href="{{route('department.index')}}" class="btn btn-primary">Home</a>
@endsection
@section('content')
<div class='card m-auto col-sm-12 col-lg-6 shadow p-2'>
    <div class="card-header text-center mt-2">
        <h4>Department Update </h4>

    </div>
    <form action="{{route('department.update', $department->id)}}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group" >
            <label for="name">Department Name</label>
            <input type="text" class="form-control  @error('name') is-invalid @enderror"  id="name" name="name" value="{{$department->name}}">
            @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="form-group" >
            <label for="description">Department Description</label>
            <textarea class="form-control  @error('description') is-invalid @enderror"" id="description" name="description" rows="3">{{$department->description}}</textarea>
            @error('description')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="form-group">
            <input type="head" class="form-control @error('head') is-invalid @enderror" id="head" name="head" value="{{$department->head}}">
            @error('head')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="status">Fee</label>
            <input type="number" class="form-control @error('fee') is-invalid @enderror" id="fee" name="fee" value="{{$department->fee}}">
            @error('fee')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection
