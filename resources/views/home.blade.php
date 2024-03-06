
@extends('layouts.app')
@section('title', 'Home')
@section('content')
<div class="row">
                <div class="col-sm-12 col-lg-3 col-md-3">
                    <div class="card shadow">
                        <div class="card-header">
                            <h4>Profile</h4>
                            @isset($userprofile)
                            @foreach ($userprofile as $data)
                            <div class="row">
                            <div class="col-6">
                                <img src="{{Storage::url($data->image) }}" alt="profile" class="img-prof" />
                            </div>
                            <div class="col-6">
                                <h3>{{$data->username }}</h3>
                                <p><b>{{$data->phno}}</b></p>
                            </div>
                        </div>
                        <hr>
                        <ul class="list-group list-group-flush list-group-item-dark">
                            <li class="list-group-item">{{$data->address}}</li>
                            <li class="list-group-item">{{$data->blg}}</li>
                            <li class="list-group-item">{{$data->gender}}</li>
                            <li class="list-group-item">{{$data->dob}}</li>
                            <li class="list-group-item">{{$data->city}}</li>
                            <li class="list-group-item">{{$data->county}}</li>
                          </ul>
              @endforeach
            </div>
        </div>
    </div>
                @endisset

            <div class="col-sm-12 col-lg-6 col-md-6">
                <div class="col-md-12 text-center">
                    <h1>Welcome to WHMS</h1>
                    <p>Winnie's Hospital Management System</p>
                </div>
                <input type="text" name="search" id="search" class=" search-input form-control shadow" placeholder="Search">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card shadow">
                            <div class="card-header">
                                <h6>Appointments</h6>
                            </div>
                            <div class="card-body">
                                <h1>20</h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card shadow">
                            <div class="card-header">
                                <h6>Patients</h6>
                            </div>
                            <div class="card-body">
                                <h1>20</h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card shadow">
                            <div class="card-header">
                                <h6>My Doctor</h6>
                            </div>
                            <div class="card-body">
                                <h1>20</h1>
                            </div>
                        </div>
                    </div>
                </div>
                @empty($userprofile)
                <div class="card shadow">
                    <div class="card-header">
                        <h4>Profile</h4>
                    </div>
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
    @endempty
    </div>
    <div class="col-sm-12 col-lg-3 col-md-3">
        <div class="card shadow">
            <div class="card-header">
               Notifications
            </div>
            <div class="card-body">

                <ul class="list-group">
                    <li class="list-group">
                        <button type="button" class="btn btn-primary">
                            Appointments <span class="badge badge-light">4</span>
                          </button>
                          <button type="button" class="btn btn-primary mt-2">
                            Appointment status <span class="badge badge-light">4</span>
                          </button>
                          <button type="button" class="btn btn-primary mt-2">
                            View Doctors <span class="badge badge-light">4</span>
                          </button>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<hr>


</div></div></div>
<hr>

@endsection
