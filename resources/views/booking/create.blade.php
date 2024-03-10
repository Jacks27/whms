@extends('layouts.admin')
@section('title', 'Department ')
@section('content-header', 'Book an Appointment')
@section('content-actions')
<a href="{{route('booking.index')}}" class="btn btn-primary">Home</a>
@endsection
@section('content')

<div class='card m-auto col-sm-12 col-lg-6 mt-2 shadow p-2'>
    <div class="card-header text-center mt-2">
        <h4>Book An Appointment </h4>
    </div>
<div id='bk_appnmt' class="mt-2">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

