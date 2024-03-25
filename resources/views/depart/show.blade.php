@extends('layouts.admin')
@extends('layouts.sidebar')
@section('title', 'Department ')
@section('content-header', 'Department Show')
@section('content-actions')
<a href="{{route('department.index')}}" class="btn btn-primary">Home</a>
@endsection
@section('content')
<div class="content-wrapper">
<div class='card m-auto col-sm-12  mt-2 shadow" p-2'>
    <div class="card-header text-center">
        <h4>Department Show </h4>
    </div>
    <div class="form-group">
        <label for="name">Department Name</label>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>SL</th>
                    <th>Department Name</th>
                    <th>Department Description</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tr>
                <td>{{ $department->id }}</td>
                <td>{{ $department->name }}</td>
                <td>{{ $department->description }}</td>
                <td>
                    <a href="{{ route('department.edit', $department->id) }}" class="btn btn-primary"><i class="fa-solid fa-pen"></i></a>
                    <a href="{{ route('department.destroy', $department->id) }}" class="btn btn-danger"><i class="fa-solid fa-trash"></i></a>
                </td>
            </tr>

        </table>
    </div>
</div>
<div class='card m-auto col-sm-12  mt-2 shadow" p-2'>
    <div class="card-header text-center">
        <h4>List Of Doctors In The Department</h4>
    </div>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>SL</th>
                <th>Doctor Name</th>
                <th>Doctor Phone</th>
                <th>Qualification</th>
                <th>Specialist</th>
                <th>Exprience</th>
                <th>Roles</th>
            </tr>
        </thead>
        @foreach ($doctors as $data)
        <tr>
            <td>{{ $loop->index + 1 }}</td>
            <td>{{ $data->users->first()->username }}</td>
            <td>{{ $data->users->first()->phno}}</td>
            <td>{{ $data->qualification }}</td>
            <td>{{ $data->speciality }}</td>
            <td>{{ $data->experience }}</td>
            <td>
                <a href="{{ route('doctor.edit', $data->id) }}" class="btn btn-primary"><i class="fa-solid fa-pen"></i></a>
                <a href="{{ route('doctor.destroy', $data->id) }}" class="btn btn-danger"><i class="fa-solid fa-trash"></i></a>
            </td>
        </tr>
        @endforeach
        <tfoot>
        <tbody>
        </tbody>
    </table>
</div>
</div>
@endsection


