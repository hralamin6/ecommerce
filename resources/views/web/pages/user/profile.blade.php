@extends('web.layouts.layout')
@section('content')

<div class="page-content-wrapper">
  <div class="container">
    <!-- Profile Wrapper-->
    <div class="profile-wrapper-area py-3">
      <!-- User Information-->
      <div class="card user-info-card">
        <div class="card-body p-4 d-flex align-items-center">
          <div class="user-profile me-3"><img src="{{ \App\Helper::getUserAvatar() }}" alt=""></div>
          <div class="user-info">
            <p class="mb-0">{{ '@'.auth()->user()->username }}</p>
            <h5 class="mb-0">{{ auth()->user()->name }}</h5>
          </div>
        </div>
      </div>
      <!-- User Meta Data-->
      <div class="card user-data-card">
        <div class="card-body">
          <div class="single-profile-data d-flex align-items-center justify-content-between">
            <div class="title d-flex align-items-center"><i class="lni lni-user"></i><span>Rank</span></div>
            <div class="data-content">{{ \App\Helper::generateRank() }}</div>
          </div>
          <div class="single-profile-data d-flex align-items-center justify-content-between">
            <div class="title d-flex align-items-center"><i class="lni lni-user"></i><span>Username</span></div>
            <div class="data-content">{{ '@'.auth()->user()->username }}</div>
          </div>
          <div class="single-profile-data d-flex align-items-center justify-content-between">
            <div class="title d-flex align-items-center"><i class="lni lni-user"></i><span>Full Name</span></div>
            <div class="data-content">{{ auth()->user()->name }}</div>
          </div>
          <div class="single-profile-data d-flex align-items-center justify-content-between">
            <div class="title d-flex align-items-center"><i class="lni lni-phone"></i><span>Phone</span></div>
            <div class="data-content">{{ auth()->user()->phon ?? '-' }}</div>
          </div>
          <div class="single-profile-data d-flex align-items-center justify-content-between">
            <div class="title d-flex align-items-center"><i class="lni lni-envelope"></i><span>Email Address</span>
            </div>
            <div class="data-content">{{ auth()->user()->email }} </div>
          </div>
          <div class="single-profile-data d-flex align-items-center justify-content-between">
            <div class="title d-flex align-items-center"><i class="lni lni-map-marker"></i><span>Shipping</span></div>
            <div class="data-content">{{ auth()->user()->shipping ?? '-' }}</div>
          </div>
          <!-- Edit Profile-->
          <div class="edit-profile-btn mt-3"><a class="btn btn-info w-100" href="{{ route('b2e.profile') }}"><i
                class="lni lni-pencil me-2"></i>Edit Profile</a></div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection