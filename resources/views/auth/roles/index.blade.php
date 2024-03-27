@extends('layouts.admin')
@extends('layouts.sidebar')
@section('title', 'Doctor ')
@section('content-header', 'Department Create')
@section('content-actions')
<a href="{{route('doctor.index')}}" class="btn btn-primary">Home</a>
@endsection
@section('css')
    <link rel="stylesheet" href="{{ asset('plugins/sweetalert2/sweetalert2.min.css') }}">
@endsection
@section('content')
        <!-- Left Sidebar End -->

            <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->

            <div class="content-wrapper">
                <div class="content">

                    <!-- Start Content-->
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">
                                <div class="card-box">
                                    <div class="responsive-table-plugin" style="padding-bottom: 15px;">

                                        <ul class="list-group">
                                            <li class="list-group-item active" aria-current="true"><h3>List  Of Admins</h3></li>
                                        </ul>
                                            <table id="tech-companies-1 table-hover" class="table table-striped mb-0 shadow">
                                                <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th data-priority="1">User Name</th>
                                                    <th>email</th>
                                                    <th>Verified</th>
                                                    <th>Role</th>
                                                    <th>update</th>
                                                    <th>Delete</th>

                                                </tr>
                                                </thead>


                                            @foreach ($sudo as $su )
                                            <tr>
                                            <td>{{$su->id}}</td>
                                           <td>{{$su->name}}</td>
                                           <td>{{$su->email}}</td>
                                           <td>{{$su->email_verified_at}}</td>

                                           <td>
                                            <a href="{{ route('doctor.show', $su->id) }}" class="btn btn-info">
                                            @if ($su->roles->count() > 0)
                                                        {{$su->roles[0]->name}}
                                                    @else
                                                        No Role Assigned
                                                    @endif
                                            </a>

                                            </td>
                                           <td><a href="{{ route('users.edit', $su->id) }}" class="btn btn-info"><i class="fa-solid fa-pen-to-square" style="color: #ebeef4;"></i></a></td>
                                           <td>

                                            <form id="del-form-{{$su->id}}" action="{{url('users/'.$su->id)}}" method="POST">
                                                @method('DELETE')
                                                @csrf
                                                {{-- <input type="hidden" name="id" value="{{$su->id}}"/> --}}
                                                <button class=" btn btn-small btn-danger "><i class="fa-regular fa-trash-can" style="color: #e0e6f0;"></i></button>
                                            </form>
                                           </td>
                                            </tr>
                                            @endforeach
                                            <tbody>
                                            </table>

<hr>

<ul class="list-group">            <div class="content-page">
    <div class="content">

        <!-- Start Content-->
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
    <li class="list-group-item active" aria-current="true"><h3>List of Users & Roles</h3></li>
</ul>

                                        <div class="table-rep-plugin">
                                            <div class="table-responsive" data-pattern="priority-columns">

                                                <table id="tech-companies-1" class="table table-striped mb-0 shadow">
                                                    <thead>
                                                    <tr>
                                                        <th>ID</th>
                                                        <th data-priority="1">Name</th>
                                                        <th>Guard Name</th>
                                                        <th>Edit</th>
                                                        <th>Delete</th>

                                                    </tr>
                                                    </thead>
                                                    <tbody>

                                                        @foreach ($roles as $role)
                                                    <tr>
                                                        <th>{{$role->id}}</th>
                                                        <td>{{$role->name }}</td>
                                                        <td>{{$role->guard_name}}</td>

                                                        <td><a href="{{url('role/'.$role->id.'/edit')}}" class="btn btn-bordred-primary waves-effect  width-md waves-light">Edit</a></td>
                                                        <td><p  onclick="event.preventDefault();document.getElementById('del-form-{{$role->id}}').submit()" class="btn btn-bordred-danger waves-effect  width-md waves-light">Delete</p></td>

                                                        <form id="del-form-{{$role->id}}" action="/admin/role/{{$role->id}}" method="POST" style="display:none;">
                                                            @method('DELETE')
                                                            @csrf
                                                            <input type="hidden" name="id" value="{{$role->id}}">
                                                        </form>

                                                    </tr>
                                                @endforeach


                                                    </tbody>
                                                </table>
                                            </div>



                                        </div>

                                    </div>
                                    {{$roles->links()}}
                                </div>

                            </div>
                        </div>
                        <!-- end row -->

                    </div> <!-- container-fluid -->

                </div> <!-- content -->



      @endsection()
