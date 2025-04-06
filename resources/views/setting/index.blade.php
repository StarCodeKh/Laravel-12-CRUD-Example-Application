@extends('layouts.master')
@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/tab.css') }}">
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="fw-bold py-2">Setting</div>
                <div class="p-2">Setting - 
                    <a href="{{ route('home') }}" class="text-decoration-none fw-semibold">Dashboard</a>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card p-3 shadow-sm">
                <div class="container my-3">
                    <ul class="nav nav-tabs" id="stepTab" role="tablist">
                        <ul class="nav nav-tabs d-flex w-100" id="stepTab" role="tablist">
                            <li class="nav-item fw-bold flex-fill">
                                <button class="nav-link active w-100" id="1step-tab" data-bs-toggle="tab" data-bs-target="#1step">Account Settings</button>
                            </li>
                            <li class="nav-item fw-bold flex-fill">
                                <button class="nav-link w-100" id="2step-tab" data-bs-toggle="tab" data-bs-target="#2step">Security & Privacy</button>
                            </li>
                            <li class="nav-item fw-bold flex-fill">
                                <button class="nav-link w-100" id="3step-tab" data-bs-toggle="tab" data-bs-target="#3step">Notifications & Preferences</button>
                            </li>
                        </ul>
                        
                    </ul>
            
                    <div class="tab-content mt-3" id="stepTabContent">
                        <div class="tab-pane show active" id="1step">
                            <h2 class="mb-3">1 Step</h2>
                            <p class="lead">This is the 1 Step tab content.</p>
                        </div>
                        <div class="tab-pane" id="2step">
                            <h2 class="mb-3">2 Step</h2>
                            <p class="lead">This is the 2 Step tab content.</p>
                        </div>
                        <div class="tab-pane" id="3step">
                            <h2 class="mb-3">3 Step</h2>
                            <p class="lead">This is the 3 Step tab content.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
