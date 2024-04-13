@extends('layouts.admin')
@section('title', 'Department ')
@section('content-header', 'Department List')
@section('content-actions')
<a href="{{route('department.create')}}" class="btn btn-primary">Create Product</a>
@endsection

@section('content')

                <div class="card content-wrapper">
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
                                @foreach ($department as $data)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ $data->name }}</td>
                                        <td>{{ $data->description }}</td>
                                        <td>
                                            <a href="{{ route('department.edit', $data->id) }}" class="btn btn-primary"><i class="fa-solid fa-pen"></i></a>
                                            <a href="{{ route('department.show', $data->id) }}" class="btn btn-info"><i class="fa-solid fa-eye"></i></a>
                                            <a href="{{ route('department.destroy', $data->id) }}" class="btn btn-danger"><i class="fa-solid fa-trash"></i></a>
                                        </td>
                                    </tr>
                                @endforeach

                                <tfoot>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>



@endsection
