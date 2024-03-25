@extends('layouts.admin')
@extends('layouts.sidebar')
@section('title', 'Doctor ')
@section('content-header', 'Department Create')
@section('content-actions')
<a href="{{route('doctor.index')}}" class="btn btn-primary">Home</a>
@endsection
@section('content')
<div class='card m-auto col-sm-12 col-lg-6 mt-2 shadow p-2'>
    <div class="card-header text-center">
        <h4>Doctor Create </h4>
    </div>
    <form action="{{route('doctor.store')}}" method="POST">
        @csrf
        <div class="form-group">
            <label for="department_id">Department</label>
            <select class="form-control  @error('dep_id') is-invalid @enderror"  id="department_id" name="dep_id">
                <option value="">Select Department</option>
                @foreach($deprt as  $id => $name)
                <option value="{{$id}}">{{$name}}</option>
                @endforeach
            </select>
            @error('dep_id')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="name">Doctor Name</label>
        <select class="form-control  @error('prof_id') is-invalid @enderror"  id="name" name="prof_id">
            <option value="">Select Doctor</option>
            @foreach($docs as $doctor)
            <option value="{{$doctor->id}}">{{$doctor->username}}</option>
            @endforeach
        </select>
        @error('prof_id')
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
            <label for="speciality">Speciality</label>
            <input type="text" class="form-control @error('speciality') is-invalid @enderror" id="speciality" name="speciality" placeholder="speciality">
            @error('speciality')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="experience">Experience</label>
            <input type="number" class="form-control @error('experience') is-invalid @enderror" id="experience" name="experience" placeholder="experience">
            @error('experience')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
<div class="form-group">
            <label for="status">status</label>
            <select class="form-control  @error('status') is-invalid @enderror"  id="status" name="status">
                <option value="">Select Status</option>
                <option value=1>Active</option>
                <option value=0>Inactive</option>
            </select>

            @error('status')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="rights">Rights</label>
            <select name="role" class="form-control">
                <option value="">Assign a Role</option>
                @foreach($roles as $role)
                    <option value="{{ $role->name }}">{{ $role->name }}</option>
                @endforeach
            </select>
        </div>

        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection
