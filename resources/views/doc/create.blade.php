@extends('layouts.admin')
@extends('layouts.sidebar')
@section('title', 'Doctor ')
@section('content-header', 'Department Create')
@section('content-actions')
<a href="{{route('doc.index')}}" class="btn btn-primary">Home</a>
@endsection
@section('content')
<div class='card m-auto col-sm-12 col-lg-6 mt-2 shadow p-2'>
    <div class="card-header text-center">
        <h4>Doctor Create </h4>
    </div>
    <form action="{{route('doc.store')}}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Doctor Name</label>
            <input type="text" class="form-control  @error('name') is-invalid @enderror"  id="name" name="name" placeholder="Enter Doctor Name">
            @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="form-group" >
            <label for="description">Doctor Description</label>
            <textarea class="form-control  @error('speciality') is-invalid @enderror"" id="speciality" name="speciality" rows="3"></textarea>
            @error('speciality')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="form-group">
            <input type="head" class="form-control @error('qualification') is-invalid @enderror" id="qualification" name="qualification" placeholder="Enter Doctor Qualification">
            @error('qualification')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="status">Department</label>
            <input type="text" class="form-control @error('department') is-invalid @enderror" id="department" name="department" placeholder="Enter Doctor Department">
            @error('department')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
<div class="form-group">
            <label for="status">status</label>
            <input type="radio" class="form-control @error('status') is-invalid @enderror" id="status" name="status" value="1">Active
            <input type="radio" class="form-control @error('status') is-invalid @enderror" id="status" name="status" value="0">Inactive
            @error('status')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection
