
@extends('layouts.admin')
@section('title', 'Department ')
@section('content-header', 'Manage appointment')
@section('content-actions')
<a href="{{route('booking.index')}}" class="btn btn-primary">Create Appointment</a>
@endsection
@section('content')
<div class='card m-auto col-sm-12 col-lg-8 mt-2 shadow p-2'>
    <div class="card-header text-center mt-2">
        <h4>Manage Appointment </h4>
    </div>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>SL</th>
                <th>Department Name</th>
                <th>Data</th>
                <th>Time</th>
                <th>Status</th>
                <th>Payment Mode</th>
                <th>Doctor</th>
                <th>Phone</th>
                <th>Image</th>
                <th>Fee</th>
                <th>Action</th>
            </tr>
        </thead>
        @foreach ($appointments as $data)
        <tr>
            <td>{{ $loop->index + 1 }}</td>
            <td>{{ $data->department}}</td>
            <td>{{ $data->date }}</td>
            <td>{{ $data->time }}</td>
            <td>{{ $data->status }}</td>
            <td>{{ $data->payment_mode }}</td>
            <td>{{ $data->username}}</td>
            <td>{{ $data->phno}}</td>

            <td><img src="{{ asset('storage/'.$data->image) }}" alt="image" width="50px" height="50px"></td>
            <td>{{ $data->fee }}</td>
            <td>
                <a href="{{ route('schedule.edit', $data->id) }}" class="btn btn-primary"><i class="fa-solid fa-pen"></i></a>
                <a href="{{ route('schedule.show', $data->id) }}" class="btn btn-info"><i class="fa-solid fa-eye"></i></a>
                <a href="{{ route('schedule.destroy', $data->id) }}" class="btn btn-danger"><i class="fa-solid fa-trash"></i></a>
            </td>
        </tr>
        @endforeach
    </table>
</div>
@endsection
