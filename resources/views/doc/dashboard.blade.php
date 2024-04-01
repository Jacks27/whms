@extends('layouts.app')
@section('title', 'Doctor Dashboard ')
@section('content-header', 'Doctor')
@section('content-actions')
{{-- <a href="{{route('booking.index')}}" class="btn btn-primary">All bookings</a> --}}
@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="hstack gap-3">
  <div class="bg-light"><div class="card m-1" style="width: 10rem;">
    <div class="card-body bg-info text-center">
      <h5 class="card-title ">Active records</h5>
      <h6 class="card-subtitle mb-2 text-muted">{{$A_records}}</h6>
      <p class="card-text"></p>
      <a href="/whms/booking/" class="card-link"> <i class="fa-solid fa-chart-simple"></i> more</a>
    </div>
  </div>
</div>
  <div class="bg-light  ms-auto">
  <div class="card m-1" style="width: 10rem;">
    <div class="card-body bg-default shadow text-center">
      <h5 class="card-title ">Pedding</h5>
      <h6 class="card-subtitle mb-2 text-muted">{{$I_records}}</h6>
      <p class="card-text"></p>
      <a href="/whms/booking/" class="card-link"> <i class="fa-solid fa-chart-simple"></i> more</a>
    </div>
</div></div>
  <div class="vr"></div>
  <div class="bg-light border">
    <div class="card-body bg-info text-center">
        <h5 class="card-title ">Clients</h5>
        <h6 class="card-subtitle mb-2 text-muted">{{$users}}</h6>
        <p class="card-text"></p>
        <a href="/whms/booking/" class="card-link"> <i class="fa-solid fa-arrow-up-short-wide"></i>more</a>
      </div>
</div>
</div>

    </div>
    <div class="row">

        <div class="col-sm-12 col-lg-12">

            <div class="card">
                <div class="card-header">
                Appointments
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table caption-top">
                            <caption>List of appointments</caption>
                            <thead>

                              <tr>
                                <th scope="col">#</th>
                                <th scope="col">Date</th>
                                <th scope="col">Info</th>
                                <th scope="col">Name</th>
                                <th scope="col">DOB</th>
                                <th scope="col">Gender</th>
                                <th scope="col">B Group</th>
                                <th scope="col">County</th>
                                <th scope="col">County</th>
                                <th scope="col">Action</th>
                              </tr>

                            </thead>
                            <tbody>
                                @foreach ($appointments as $appts)
                              <tr>
                                <th scope="row">{{$loop->index+1}} </th>
                                <td>{{$appts->time}}</td>
                                <td>{{$appts->description}}</td>
                                <td>{{$appts->patient_name}}</td>
                                <td>{{$appts->patient_date_of_birth}}</td>
                                <td>{{$appts->patient_gender}}</td>
                                <td>{{$appts->patient_blood_group}}</td>
                                <td>{{$appts->patient_county}}</td>
                                <td>{{$appts->patient_city}}</td>
                                <td>
                                    <a href="{{route('booking.show', $appts->appointment_id)}}" class="btn btn-primary position-relative">

                                        <i class="fa-regular fa-eye"> </i>
                                        @if($appts->status==1)
                                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-success">
                                            &nbsp;
                                            <span class="visually-hidden">unread messages</span>
                                          </span>
                                                @else
                                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                                    &nbsp;
                                                    <span class="visually-hidden">unread messages</span>
                                                  </span>
                                                @endif

                                    </a></td>
                              </tr>
                              @endforeach
                          </table>
                    </div>
                    {{ $appointments->render() }}<a href="{{route('booking.index')}}" class="btn btn-primary">All bookings</a>
                </div>
              </div>
        </div>
    </div>
</div>
@endsection
