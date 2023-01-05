@extends('web.layouts.layout')

@section('content')

<div class="page-content-wrapper">
    <div class="container">
        <!-- Profile Wrapper-->
        <div class="profile-wrapper-area py-3">
            <!-- User Information-->
            <form action="{{ route('upgrade', ['id'=>encrypt(auth()->user()->id)]) }}" method="post"
                enctype="multipart/form-data">
                @csrf
                <div class="card user-info-card">
                    <div class="card-body p-4 d-flex align-items-center">
                        <h5> {{ __('crud.common.upgrade_notice', ['number'=> $payment_number ]) }}
                        </h5>
                    </div>
                </div>
                <!-- User Meta Data-->
                <div class="card user-data-card">
                    <div class="card-body">
                        <div class="mb-3 row">
                            <div class="col-12 col-sm-6">
                                <div class="title mb-2"><i class="lni lni-user"></i><span>Your Photo</span></div>
                                <input class="form-control" name="avatar" type="file"
                                    value="{{ old('avatar', auth()->user()->avatar) }}"
                                    onchange="document.getElementById('avatar-preview').src = window.URL.createObjectURL(this.files[0])"
                                    required>
                                @error('avatar')
                                <div class="invalid-feedback d-block">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="col-12 col-sm-6">
                                <img id="avatar-preview" style="max-height: 4em;">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <div class="col-12 col-sm-6">
                                <div class="title mb-2"><i class="lni lni-user"></i><span>Your NID (Front side)</span>
                                </div>
                                <input class="form-control" name="nid1" type="file"
                                    value="{{ old('nid1', auth()->user()->nid1) }}"
                                    onchange="document.getElementById('nid1-preview').src = window.URL.createObjectURL(this.files[0])"
                                    required>
                                @error('nid1')
                                <div class="invalid-feedback d-block">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="col-12 col-sm-6">
                                <img id="nid1-preview" style="max-height: 4em;">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <div class="col-12 col-sm-6">
                                <div class="title mb-2"><i class="lni lni-user"></i><span>Your NID (Back side)</span>
                                </div>
                                <input class="form-control" name="nid2" type="file"
                                    value="{{ old('nid2', auth()->user()->nid2) }}"
                                    onchange="document.getElementById('nid2-preview').src = window.URL.createObjectURL(this.files[0])"
                                    required>
                                @error('nid2')
                                <div class="invalid-feedback d-block">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="col-12 col-sm-6">
                                <img id="nid2-preview" style="max-height: 4em;">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <div class="col-12 mb-3">
                                <div class="title mb-2"><i class="lni lni-user"></i><span>NID No.</span></div>
                                <input class="form-control" type="number" name="nid"
                                    value="{{ old('nid', auth()->user()->nid  ) }}" maxlength="255" required>
                                @error('nid')
                                <div class="invalid-feedback d-block">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="col-12 col-sm-6 mb-3">
                                <div class="title mb-2"><i class="lni lni-user"></i><span>Referral User</span></div>
                                <input class="form-control" type="text" name="referral_user"
                                    value="{{ old('referral_user', auth()->user()->referral_user  ) }}" maxlength="255"
                                    required>
                                @error('referral_user')
                                <div class="invalid-feedback d-block">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="col-12 col-sm-6 mb-3">
                                <div class="title mb-2"><i class="lni lni-phone"></i><span>Phone</span></div>
                                <input class="form-control" type="text" name="phone"
                                    value="{{ old('phone', auth()->user()->phone  ) }}" maxlength="255" required>
                                @error('phone')
                                <div class="invalid-feedback d-block">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="col-12 col-sm-6 mb-3">
                                <div class="title mb-2"><i class="lni lni-phone"></i><span>Phone Number (Payment)</span>
                                </div>
                                <input class="form-control" type="text" name="sender_number"
                                    value="{{ old('sender_number') }}" maxlength="255" required>
                                @error('sender_number')
                                <div class="invalid-feedback d-block">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="col-12 col-sm-6 mb-3">
                                <div class="title mb-2"><i class="lni lni-phone"></i><span>Transection ID</span></div>
                                <input class="form-control" type="text" name="trx" value="{{ old('trx') }}"
                                    maxlength="255" required>
                                @error('trx')
                                <div class="invalid-feedback d-block">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                        </div>
                        <div class="mb-3">
                            <div class="title mb-2"><i class="lni lni-map-marker"></i><span>Address</span>
                            </div>
                            <textarea class="form-control" name="shipping" id="shipping" rows="1"
                                required>{{ old('shipping', auth()->user()->shipping )}}</textarea>
                            @error('shipping')
                            <div class="invalid-feedback d-block">
                                {{ $message }}
                            </div>
                            @enderror
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
