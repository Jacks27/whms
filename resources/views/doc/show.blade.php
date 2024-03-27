@extends('layouts.admin')
@extends('layouts.sidebar')
@section('title', 'Doctor ')
@section('content-header', 'User Rights and Roles')
@section('content-actions')
<a href="{{route('doctor.index')}}" class="btn btn-primary">Home</a>
@endsection
@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-sm-12 col-lg-6 ">
    <table class="table table-bordered table-responsive">
        <thead>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Email</th>
                <th>Roles</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>

            <tr>
                <td>{{1}}</td>
                <td>{{$doc->name}}</td>
                <td>{{$doc->email}}</td>
                <td>
                    <form method="POST" action="{{route('profile.roleRevoke')}}" id='revoke-roles'>
                        @csrf()
                        <input type="hidden" name="id" value="{{$doc->id}}">
                        <ul>
                        @forelse ($roles as $role)
                        <li class="">
                            {{$role}}
                            <span class="badge  rounded-pill">
                                <input  value={{$role}} type="checkbox" class="@error('roles') is-invalid @enderror" name="role[]" id="flexRadioDefault1">
                            </span>
                        </li>

                        @empty
                        No roles assigned
                        @endforelse
                        </ul>
                    </td>

                    <td>


                            </ul>
                        <button type="submit" @if(!$roles->isNotEmpty()) disabled @endif class="btn btn-sm btn-info btn-delete">Revoke</button>

                        </form>







                    <a href="{{route('doctor.edit', $doc->id)}}" class="btn btn-primary"><i class="fa-solid fa-list-check"></i></a>
                    <form action="{{route('doctor.destroy', $doc->id)}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger"><i class="fa-solid fa-trash"></i></button>
                    </form>
                </td>
            </tr>
        </tbody>
    </table>
</div>
<div class="col-sm-12 col-lg-6 ">

    <div class="col-sm-12 col-lg-12 m-auto card">
    <form method="POST" action="{{route('profile.roleAssign')}}" enctype="multipart/form-data"  >
        @csrf
        <div class="form-group">
        <label for='pms'>Roles</label>
        <input type="hidden" value="{{$doc->id}}" name='id'>
        <select class="form-control" name="role" id='pms'>
            <option  value="">Select Role</option>
            @foreach($rolenames as $role)
            <option value={{$role}}>{{$role}}</option>
            @endforeach
        </select>
        </div>
        <input type="submit" class="from-control" value="submit"/>
    </form>
</div>
</div>
</div>
</div>
@endsection

