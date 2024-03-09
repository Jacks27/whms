@extends('layouts.admin')
@extends('layouts.sidebar')
@section('title', 'Doctor ')
@section('content-header', 'Department list')
@section('content-actions')
<a href="{{route('doctor.create')}}" class="btn btn-primary">Create</a>
@endsection
@section('content')
<div class="content-wrapper">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Speciality</th>
                <th>Qualification</th>
                <th>Department</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($docs as $doc)
            <tr>
                <td>{{$doc->id}}</td>
                <td>{{$doc->username}}</td>
                <td>{{$doc->speciality}}</td>
                <td>{{$doc->qualification}}</td>
                <td>{{$doc->department}}</td>
                <td>{{$doc->status}}</td>
                <td>
                    <a href="{{route('doctor.edit', $doc->id)}}" class="btn btn-primary"><i class="fa-solid fa-pen"></i></a>
                    <form action="{{route('doctor.destroy', $doc->id)}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger"><i class="fa-solid fa-trash"></i></button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

