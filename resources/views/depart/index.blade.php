@extends('layouts.app')
@section('title', 'Department ')
@section('content-header', 'Department Edit')

@section('content-actions')
<a href="{{route('department.create')}}" class="btn btn-primary">Create Product</a>
@endsection
@section('content')


                <div class="card">
                     <div class="card-header">
                          <h4>Department List </h4>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Department Name</th>
                                        <th>Department Description</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>



@endsection
