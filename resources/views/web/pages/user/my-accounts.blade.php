@extends('web.layouts.layout')
@section('content')
@php $users = auth()->user()->child()->paginate(10) @endphp
<div class="page-content-wrapper">
    <div class="container ">
        <!-- Profile Wrapper-->
        <div class="profile-wrapper-area py-3">
            <!-- User Information-->
            <div class="card">
                <div class="card-header">
                    <span class="h3">All child accounts</span>
                    {{--                        <a href="{{ route('b2e.child.account.form') }}" class="btn btn-secondary
                    float-end">Create new child account</a>--}}
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Username</th>
                                <th>E-Balance</th>
                                <th>I-Balance</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($users as $user)
                            <tr>
                                <td>{{ $user->username }}</td>
                                <td>{{ $user->point }}</td>
                                <td>@taka($user->balance)</td>
                                <td>
                                    <a href="{{ route('b2e.child.login', $user) }}" class="btn btn-primary">Log in</a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4">No child account yet!</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="card-footer d-flex justify-content-end">
                    @if($users->links())
                    {{ $users->render() }}
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection