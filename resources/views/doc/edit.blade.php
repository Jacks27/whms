@extends('layouts.admin')
@section('title', 'Doctor ')
@section('content-header', 'Department Update')
@section('content-actions')
<a href="{{route('doctor.create')}}" class="btn btn-primary">Create</a>
@endsection
@section('content')
<div class="content-wrapper">
    <div class="card m-auto col-sm-12 col-lg-6 mt-2 shadow p-2">
        <div class="card-header text-center">
            <h4>Doctor Update </h4>
        </div>
        <form action="{{route('doctor.update', $doctor->id)}}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="department_id">Department</label>
                <select class="form-control  @error('dep_id') is-invalid @enderror"  id="department_id" name="dep_id">
                    <option value="">Select Department</option>
                    @foreach($departments as $id => $name)
                    <option value="{{ $id }}">{{ $name }} </option>
                @endforeach
                </select>
                @error('dep_id')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-group">
            <input type="text" class="form-control" hidden="true" value="{{$doctor->prof_id}}" @error('prof_id') is-invalid @enderror  id="name" name="prof_id">
            @error('prof_id')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror

            </div>
            <div class="form-group" >
                <label for="description">Doctor Description</label>
                <textarea class="form-control  @error('speciality') is-invalid @enderror"" id="speciality" name="speciality" rows="3">{{$doctor->speciality}}</textarea>
                @error('speciality')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-group">
                <input type="head" class="form-control @error('qualification') is-invalid @enderror" value="{{$doctor->qualification}}" id="qualification" name="qualification" placeholder="Enter Doctor Qualification">
                @error('qualification')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="speciality">Speciality</label>
                <input type="text" class="form-control" value='{{$doctor->speciality}}' @error('speciality') is-invalid @enderror" id="speciality" name="speciality" placeholder="speciality">
                @error('speciality')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="status">Experience</label>
                <input type="number" class="form-control @error('experience') is-invalid @enderror" value='{{$doctor->experience}}' id="experience" name="experience" placeholder="Enter Doctor Experience">
                @error('experience')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="status">Status</label>
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
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>
@endsection
