@extends('layouts.master')
<?php  
    $hour   = date ("G");
    $minute = date ("i");
    $second = date ("s");
    $msg = " Today is " . date ("l, M. d, Y.");

    $greet = '';
    if ($hour == 00 && $hour <= 9 && $minute <= 59 && $second <= 59) {
        $greet = "Good Morning,";
    } else if ($hour >= 10 && $hour <= 11 && $minute <= 59 && $second <= 59) {
        $greet = "Good Day,";
    } else if ($hour <= 12 && $hour <= 15 && $minute <= 59 && $second <= 59) {
        $greet = "Good Afternoon,";
    } else if ($hour >= 16 && $hour <= 23 && $minute <= 59 && $second <= 59) {
        $greet = "Good Evening,";
    }
?>
@section('content')
<div class="row">
    <div class="col-lg-12 col-md-8 col-sm-12 mx-auto">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div class="fw-bold py-2">Dashboard</div>
            <div class="p-2">Dashboard - 
                <a href="{{ route('home') }}" class="text-decoration-none fw-semibold">Dashboard</a>
            </div>
        </div>
        <div class="card p-3 shadow-sm">
            <h3 class="fw-bold">{{ $greet  }}<span class="text-primary">{{ Auth::user()->name }}</span></h3>
            <h6 >{{ $msg }}</h6>
            <p class="fs-6">Today Was Good, and Tomorrow Will Be Even Better.</p>
        </div>
    </div>
</div>
@endsection
