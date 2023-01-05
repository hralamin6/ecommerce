@extends('web.layouts.layout')
@push('front-style')
<style>
    /* Accordion Avatar */
    .accrodion-avater {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        margin: 0 auto .5rem;
        display: block;
        object-fit: cover;
    }
</style>
@endpush
@section('content')

<div class="page-content-wrapper">
    <div class="container">
        <!-- Profile Wrapper-->
        <div class="profile-wrapper-area py-3">


            <!-- Support Wrapper-->
            <div class="support-wrapper py-3">
                {{--            <div class="card">--}}
                {{--                <div class="card-body">--}}
                {{--                    <!-- Search Form-->--}}
                {{--                    <form class="faq-search-form" action="#" method="">--}}
                {{--                        <input class="form-control" type="search" name="search" placeholder="Search">--}}
                {{--                        <button type="submit"><i class="fa fa-search"></i></button>--}}
                {{--                    </form>--}}
                {{--                </div>--}}
                {{--            </div>--}}
                <!-- Accordian Area Wrapper-->
                <div class="accordian-area-wrapper mt-3">
                    <!-- Accordian Card-->
                    <div class="card accordian-card clearfix">
                        <div class="card-body">
                            @for ($i = 0; $i < 10; $i++) @if (!isset($generation[$i])) @break @endif
                                @include('web.partials.teamlist',[$i, 'team'=>$generation[$i]])
                                @endfor
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection