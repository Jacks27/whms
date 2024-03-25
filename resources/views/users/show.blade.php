@extends('layouts.admin')

@section('title', 'Update Roles')
@section('content-header', 'Update Roels')
@section('content')
@section('css')
    <link rel="stylesheet" href="{{ asset('plugins/sweetalert2/sweetalert2.min.css') }}">
@endsection
@section('content')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<table class="table table-striped-columns table-light">
    <thead>
        <tr class="table-active">

            <th>Names</th>
            <th> Assign Branch</th>
            <th>Role</th>
            <th>Action</th>

        </tr>
    </thead>
    <tr>

        <td>{{$user->first_name }}  {{$user->last_name }}</td><td>

        </td><td>
            <form method="POST" action="{{route('user.revokeRole')}}" id='revoke-roles'>
                @csrf()
                <input type="hidden" name="id" value="{{$user->id}}">
                <ul>
                @forelse ($user->roles as $role)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    {{$role->name}}
                    <span class="badge  rounded-pill">
                        <input  value={{$role->name}} type="checkbox" class="@error('roles') is-invalid @enderror" name="roles[]" id="flexRadioDefault1">
                    </span>
                </li>

                @empty
                No roles assigned
                @endforelse

            </ul>

        </td>

        <td>


                </ul>
            <button type="submit" @if(!$user->roles->isNotEmpty()) disabled @endif class="btn btn-sm btn-info btn-delete">Revoke</button>

            </form>
        </td>
    </tr>




    <tbody>
  </table>
    <hr>
    <div class="row">
        <div class="col-md-4 col-lg-4">

            <form  method="POST" action="{{route('user.assignRole')}}" id='assign-right'>
                @csrf()

                <ul class="list-group">
                    <li class="list-group-item active" aria-current="true">Please Assign a role for the user
                        <input type="hidden" value="{{$user->id}}" name='id'>
                    </li>
                    @foreach ($rolenames as $name )
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                {{$name}}
                                <span class="badge  rounded-pill">
                                    <input  value={{$name}} type="radio" name="roles" id="flexRadioDefault1">
                                </span>
                            </li>  {{--  --}}


                    @endforeach
            </ul>
            <button type="submit" class="btn btn-info shadow mt-2">submit</button>
        </form>

        </div>
        <div class="col-md-8 col-lg-8">
            <h1>Branch name</h1>
            @foreach ($brch as $name )
                 <strong>branch</strong>: {{$name->name}}<br>
                 <strong>address</strong>: {{$name->address}}<br>
                 <strong>location</strong>: {{$name->location}}
            @endforeach
            <hr>
            <button class="btn btn-danger">remove branch</button>
            <form  method="POST" action="{{route('user.assignRole')}}" id='assign-right'>
                @csrf()
                @if(!$brch)
                    <ul class="list-group">
                        <li class="list-group-item active" aria-current="true">Please assign a branch to user
                            <input type="hidden" value="{{$user->id}}" name='id'>
                        </li>
                    </ul>
                @endif

            </ul>



        </form>

        </div>
    </div>

@endsection




