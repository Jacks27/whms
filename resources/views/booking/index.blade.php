@extends('layouts.admin')
@section('title', 'Booking')
@section('content-header', 'Booking List')
@section('content-actions')
    <a href="{{ route('department.create') }}" class="btn btn-primary">Create Product</a>
@endsection
@section('content')
    <div class="card content-wrapper">
        <div class="card-header">
            <h4>My Appointments</h4>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>SL</th>
                        <th>Department Name</th>
                        <th>Doctor</th>
                        <th>Appointment Time</th>
                        <th>Message</th>
                        <th>Status</th>
                        <th>Payment (Kshs)</th>
                        <th>Done</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($appointments as $data)
                        <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td>{{ $data->department }}</td>
                            <td>{{ $data->username }}</td>
                            <td>{{ $data->time }}</td>
                            <td>{{ $data->message }}</td>
                            <td class="
                            @if($data->nstatus== 'pedding') bg-primary @endif
                            @if($data->nstatus=='rejected') bg-warning @endif
                            @if($data->nstatus=='accepted') bg-success @endif
                            @if($data->nstatus==null) bg-info @endif
                                ">@if($data->nstatus== null) Action Pedding @else {{$data->nstatus}} @endif</td>
                            <td> @if ($data->fee >=0)
                                pendding
                            @else
                                paid
                            @endif</td>
                            <td>  @if($data->status==0) Not Started @else Completed @endif</td>
                            <td>
                                <a href="{{ route('booking.edit', $data->id) }}" class="btn btn-primary"><i class="fa-solid fa-pen"></i></a>
                                <a href="{{ route('booking.show', $data->id) }}" class="btn btn-info"><i class="fa-solid fa-eye"></i></a>
                                <a href="{{ route('booking.destroy', $data->id) }}" class="btn btn-danger"><i class="fa-solid fa-trash"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
# Compare this snippet from whms/resources/views/booking/show.blade.php:
