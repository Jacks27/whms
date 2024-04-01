@extends('layouts.admin')

@section('title', 'Booking')
@section('content-header', 'Booking List')
@section('content-actions')
    <a href="{{ route('booking.create') }}" class="btn btn-primary">New booking</a>
@endsection
@section('content')
    <div class="card content-wrapper">
        <div class="card-header">
            <h4>Action</h4>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>SL</th>
                        <th>Description</th>
                        <th>Appointment Time</th>
                        <th>Appointment Date</th>
                        <th>Feed back</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>

                        <tr>
                            <td>1</td>
                            <td>{{ $appointment->description }}</td>
                            <td>{{ $appointment->time }}</td>
                            <td>{{ $appointment->date }}</td>
                            <form action="/whms/ntfn" method="POST" enctype="multipart/form-data">
                                @csrf
                            <td>
                            <input type="hidden" name="bk_id" value="{{ $appointment->id}}" />
                            <textarea class="form-control" name="description" placeholder="Message"></textarea>
                            </td>
                            <td>
                                <select class="form-control" name="status" @required(true)>
                                <option value="">select action</option>
                                <option value="accepted" >accepted</option>
                                <option value="rejected" >rejected</option>
                                <option value="rejected" >Pedding</option>
                                </select>
</td>
                            <td>
                                <input type="submit" class="btn btn-info" name="submit"/>

                                </td>
                        </tr>

                </tbody>
            </table>
<div> Comments </div>
<div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th>SL</th>
                <th>Feed back</th>
                <th>Status</th>
            </tr>
        </thead>
        @foreach($comments as $comm)
        <tr>
            <td>{{ $loop->index + 1 }}</td>
            <td>{{$comm->description}}</td>
            <td>{{$comm->status}}</td>
        </tr>
        @endforeach

    </table>
  </div>


        {{ $comments->render()}}
        </div>

    </div>
@endsection

