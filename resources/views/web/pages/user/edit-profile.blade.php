@extends('web.layouts.layout')

@section('content')

<div class="page-content-wrapper">
    <div class="container">
        <!-- Profile Wrapper-->
        <div class="profile-wrapper-area py-3">
            <!-- User Information-->
            <form action="{{ route('b2e.profile.update', ['id'=>encrypt(auth()->user()->id)]) }}" method="post"
                enctype="multipart/form-data">
                @csrf
                <div class="card user-info-card">
                    <div class="card-body p-4 d-flex align-items-center">
                        <div class="user-profile me-3">
                            <img class="profile-pic" src="{{ \App\Helper::getUserAvatar() }}"
                                alt="{{ auth()->user()->name }}">
                            <div class="change-user-thumb">
                                <input accept="image/*" class="form-control-file" type="file" name="avatar"
                                    id="avatar-upload">
                                <button><i class="lni lni-pencil"></i></button>
                            </div>
                        </div>
                        <div class="user-info">
                            <p class="mb-0 text-dark">{{ '@'.auth()->user()->username }}</p>
                            <h5 class="mb-0">{{ auth()->user()->name }}</h5>
                        </div>
                    </div>
                </div>
                <!-- User Meta Data-->
                <div class="card user-data-card">
                    <div class="card-body">
                        <div class="mb-3">
                            <div class="title mb-2"><i class="lni lni-lock"></i><span>Password</span></div>
                            <input class="form-control" type="password" name="password">
                        </div>
                        <div class="mb-3">
                            <div class="title mb-2"><i class="lni lni-map-marker"></i><span>Shipping Address</span>
                            </div>
                            <textarea class="form-control" name="shipping" id="shipping"
                                rows="1">{{ old('shipping', auth()->user()->shipping )}}</textarea>
                        </div>
                        <button class="btn btn-success w-100" type="submit">Save All Changes</button>

                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@push('front-script')
<script>
    $(document).ready(function () {


            var readURL = function (input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        $('.profile-pic').attr('src', e.target.result);
                    }

                    reader.readAsDataURL(input.files[0]);
                }
            }


            $("#avatar-upload").on('change', function () {
                readURL(this);
            });

            $(".upload-button").on('click', function () {
                $(".file-upload").click();
            });
        });
</script>
@endpush