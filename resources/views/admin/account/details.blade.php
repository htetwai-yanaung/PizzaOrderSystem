@extends('admin.layouts.master')

@section('title', 'Account Information')

@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">

                @if (session('updateSuccess'))
                    <div class="col-4 offset-8">
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <span>{{ session('updateSuccess') }}</span>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                @endif
                <div class="col-lg-10 offset-1">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                <h3 class="text-center title-2 text-success">Account Information</h3>
                            </div>

                            <hr>

                            <div class="row">
                                <div class="col-3 offset-1 d-flex align-items-center">
                                    @if (Auth::user()->image == null)
                                        @if (Auth::user()->gender == 'male')
                                            <img src="{{ asset('image/default-male-user.png') }}"
                                                class=" rounded-circle img-thumbnail">
                                        @else
                                            <img src="{{ asset('image/default-female-user.png') }}"
                                                class=" rounded-circle img-thumbnail">
                                        @endif
                                    @else
                                        <img src="{{ asset('storage/' . Auth::user()->image) }}" alt="{{ Auth::user()->image }}"/>
                                    @endif
                                </div>
                                <div class="col-5 offset-1">
                                    <h4 class="my-1 text-secondary"><i
                                            class="shadow-sm rounded-circle bg-success p-2 text-white me-2 fa-solid fa-user"></i>
                                        {{ Auth::user()->name }}</h4>
                                    <h4 class="my-1 text-secondary"><i
                                            class="shadow-sm rounded-circle bg-success p-2 text-white me-2 fa-solid fa-envelope"></i>
                                        {{ Auth::user()->email }}</h4>
                                    <h4 class="my-1 text-secondary"><i
                                            class="shadow-sm rounded-circle bg-success p-2 text-white me-2 fa-solid fa-phone"></i>
                                        {{ Auth::user()->phone }}</h4>
                                    <h4 class="my-1 text-secondary"><i
                                            class="shadow-sm rounded-circle bg-success p-2 text-white me-2 fa-solid fa-map-location"></i>
                                        {{ Auth::user()->address }}</h4>
                                    <h4 class="my-1 text-secondary"><i
                                            class="shadow-sm rounded-circle bg-success p-2 text-white me-2 fa-solid fa-mars-and-venus"></i>
                                        {{ Auth::user()->gender }}</h4>
                                    <h4 class="my-1 text-secondary"><i
                                            class="shadow-sm rounded-circle bg-success p-2 text-white me-2 fa-solid fa-user-clock"></i>
                                        {{ Auth::user()->created_at }}</h4>
                                </div>

                                <div class="row">
                                    <div class="d-flex justify-content-center mt-3">
                                        <a href="{{ route('admin#edit') }}">
                                            <button class="btn btn-dark">
                                                <i class="me-2 fa-solid fa-pen-to-square"></i> Edit Profile
                                            </button></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection
