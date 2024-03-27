@extends('layouts.admin')

@section('title', 'Create Roles')
@section('content-header', 'Create Roels')
@section('content-actions')
    <a href="{{route('customers.create')}}" class="btn btn-primary">Add Role</a>
@endsection
@section('css')
    <link rel="stylesheet" href="{{ asset('plugins/sweetalert2/sweetalert2.min.css') }}">
@endsection
@section('content')
<div class="content-page">
    <div class="content">

            <!-- end row -->


            <div class="row">
                <div class="col-md-12">
                    <div class="card-box">
                        <h2 class="mt-0 mb-3">Role</h2>
                        @if (Session::has('success'))
                            {{-- expr --}}

                        <div class="alert alert-success">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <strong>Success!</strong> <span>{{Session::get('success')}}</span>

                        </div>
                        @endif
                        <form action="{{ route('role.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputEmail1">Role</label>
                                <input type="text" class="form-control" name="name" aria-describedby="emailHelp" placeholder="Enter Role Name" required>
                                @error('role')
                                <span>
                                    <strong class="text-danger">{{$message}}</strong>
                                </span>
                                @enderror()

                                <div>
                                @error('permission')
                                    <span class="text-danger">{{$message}}</span>
                                </div>
                                @enderror()

                            <div class="card" style="margin-top: 20px;">
                            <div class="card-header">Permissions</div>
                            <div class="card-body">
                                <div class="row">

                                @foreach ($permissions as $permission)

                                    <div class="col-md-2 col-sm-2 col-4">
                                    <label class="switch checkbox-inline">
                                    <input type="checkbox" name="permission[]" value="{{$permission->name}}"
                                    >
                                    <span class="slider round"></span>

                                    </label>
                                    <p>{{$permission->name}}</p>
                                    </div>


                                @endforeach

                                </div>

                            </div>


                        </div>

                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
                <!-- end col -->



            </div>
            <!-- end row -->

    </div>

@endsection
