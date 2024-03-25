@extends('layouts.app')
@section('title', 'Home')
@section('content')

<div class="container">
    <div class="row mt-2">
        <div class="col-sm-12 col-lg-3 col-md-3">
            @if(isset($userprofile))
                        <div class="card shadow mt-4">
                            <div class="card-header">
                                <h4>Profile</h4>
                            </div>
                            <div class="card-body">
                                @foreach ($userprofile as $data)
                                    <div class="row">
                                        <div class="col-6">
                                            <img src="{{ Storage::url($data->image) }}" alt="profile" class="img-prof" />
                                        </div>
                                        <div class="col-6">
                                            <h3>{{ $data->username }}</h3>
                                            <p><b>{{ $data->phno }}</b></p>
                                        </div>
                                    </div>
                                    <hr>
                                    <ul class="list-group list-group-flush list-group-item-dark">
                                        <li class="list-group-item">{{ $data->address }}</li>
                                        <li class="list-group-item">{{ $data->blg }}</li>
                                        <li class="list-group-item">{{ $data->gender }}</li>
                                        <li class="list-group-item">{{ $data->dob }}</li>
                                        <li class="list-group-item">{{ $data->city }}</li>
                                        <li class="list-group-item">{{ $data->county }}</li>
                                    </ul>
                                @endforeach
                            </div>
                        </div>
                        @else

                                <div class="card shadow">

                                                            <div class="card-body">
                                                        <h4>Complete your profile</h4>
                                                        <form action="{{route('profile.store')}}" method="POST" enctype="multipart/form-data">
                                                            @csrf
                                                            <div class="form-group">
                                                                <label for="image">Profile Picture</label>
                                                                <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image">
                                                                @error('image')
                                                                            <span class="invalid-feedback" role="alert">
                                                                                <strong>{{ $message }}</strong>
                                                                            </span>
                                                                @enderror
                                                                <label for="phno">Phone Number</label>
                                                                <input type="number" class="form-control @error('phno') is-invalid @enderror"  id="phno" name="phno" placeholder="Enter Phone Number">
                                                                @error('phno')
                                                                            <span class="invalid-feedback" role="alert">
                                                                                <strong>{{ $message }}</strong>
                                                                            </span>
                                                                @enderror

                                                                <label for="addrss">Address</label>
                                                                <input type="text" class="form-control @error('address') is-invalid @enderror" id="addrss" name="address"  placeholder="Enter Phone Number">
                                                                @error('address')
                                                                            <span class="invalid-feedback" role="alert">
                                                                                <strong>{{ $message }}</strong>
                                                                            </span>
                                                                @enderror
                                                                <label for="blg">Blood Group</label>
                                                                <input type="text" class="form-control @error('blg') is-invalid @enderror" id="blg" name="blg" placeholder="Enter Blood Group">
                                                                @error('blg')
                                                                            <span class="invalid-feedback" role="alert">
                                                                                <strong>{{ $message }}</strong>
                                                                            </span>
                                                                @enderror

                                                                <label for="gender">Gender</label>
                                                                <select class="form-control @error('gender') is-invalid @enderror" name="gender" id="gender">
                                                                    <option value="male">Male</option>
                                                                    <option value="female">Female</option>
                                                                    <option value="other">Other</option>
                                                                </select>
                                                                @error('gender')
                                                                            <span class="invalid-feedback" role="alert">
                                                                                <strong>{{ $message }}</strong>
                                                                            </span>
                                                                @enderror
                                                            </div>
                                                            <label for="dob">Date of Birth</label>
                                                            <input type="date" class="form-control @error('dob') is-invalid @enderror" id="dob" name="dob" placeholder="Enter Date of Birth">
                                                            @error('dob')
                                                                            <span class="invalid-feedback" role="alert">
                                                                                <strong>{{ $message }}</strong>
                                                                            </span>
                                                            @enderror
                                                            <label for="city">City</label>
                                                            <input type="text" class="form-control @error('city') is-invalid @enderror" id="city" name="city" placeholder="Enter City">
                                                            @error('city')
                                                                            <span class="invalid-feedback" role="alert">
                                                                                <strong>{{ $message }}</strong>
                                                                            </span>
                                                            @enderror

                                                            <label for="county">County</label>
                                                            <input type="text" class="form-control @error('county') is-invalid @enderror" id="county" name="county" placeholder="Enter County">
                                                            @error('county')
                                                                            <span class="invalid-feedback" role="alert">
                                                                                <strong>{{ $message }}</strong>
                                                                            </span>
                                                            @enderror

                                                            <button type="submit" class="btn btn-primary">Submit</button>
                                                        </form>
                                                </div>


                                            </div>
                                            @endif




                    </div>


                    <div class="col-sm-12 col-lg-6 col-md-6">
                        <div class="col-md-12 text-center">
                            <h1>Welcome to HMS</h1>
                            <p>Health Care Management System</p>
                        </div>
                        <input type="text" name="search" id="search" class="search-input form-control shadow" placeholder="Search">
                        <div class="card shadow mt-4">

                            <div class="card-header">
                                <h4>Appointments</h4>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <td>SL</td>
                                            <td>Date</td>
                                            <td>Description</td>
                                            <td>Action</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(isset($userAppointments))
                                        @foreach ($userAppointments as $appointment)
                                            <tr>
                                                <td>{{ $loop->index + 1 }}</td>
                                                <td>{{ $appointment->date }}</td>
                                                <td>{{ $appointment->description }}</td>
                                                <td><a href="{{ route('booking.edit', $appointment->id) }}">Edit</a></td>
                                            </tr>
                                        @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12 col-lg-3 col-md-3">
                        <div class="card shadow mt-4">
                            <div class="card-header">
                                Notifications
                            </div>
                            <div class="card-body">
                                <ul class="list-group">
                                    <li class="list-group-item">
                                        <a href="{{ route('department.index') }}" class="btn btn-primary">Departments <span class="badge badge-light">4</span></a>

                                    </li>
                                    <li class="list-group-item">
                                        <a href="{{ route('booking.create') }}" class="btn btn-primary">Appointments <span class="badge badge-light">4</span></a>
                                    </li>
                                    <li class="list-group-item">
                                        <a href="{{ route('profile.index') }}" class="btn btn-primary">Profile <span class="badge badge-light">4</span></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>



        </div>
    </div>
</div>

@endsection
