@extends('admin.layouts.master')

@section('title', 'Edit Account')

@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">

                <div class="col-lg-10 offset-1">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                <h3 class="text-center title-2 text-success">Admin Profile</h3>
                            </div>

                            <hr>

                            <form action="{{ route('admin#update', Auth::user()->id) }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-6 offset-3 d-flex justify-content-center">
                                        @if (Auth::user()->image == null)
                                            @if (Auth::user()->gender == 'male')
                                                <img src="{{ asset('image/default-male-user.png') }}"
                                                    class=" rounded-circle img-thumbnail">
                                            @else
                                                <img src="{{ asset('image/default-female-user.png') }}"
                                                    class=" rounded-circle img-thumbnail">
                                            @endif
                                        @else
                                            <img src="{{ asset('storage/' . Auth::user()->image) }}"
                                                class="col-6 rounded-circle" />
                                        @endif

                                    </div>
                                    <div class="row">
                                        <div class="col-6 offset-3">
                                            <input type="file" name="image" class="form-control @error('image') is-invalid @enderror">
                                            @error('image')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1"><i
                                                    class="text-success me-2 fa-solid fa-user"></i> Name</label>

                                            <input id="cc-pament" name="name" type="text"
                                                value="{{ old('name', Auth::user()->name) }}"
                                                class="form-control @error('name') is-invalid @enderror"
                                                aria-required="true" aria-invalid="false" placeholder="Enter Admin Name...">
                                            @error('name')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1"><i
                                                    class="text-success me-2 fa-solid fa-envelope"></i> Email</label>
                                            <input id="cc-pament" name="email" type="email"
                                                value="{{ old('email', Auth::user()->email) }}"
                                                class="form-control @error('email') is-invalid @enderror"
                                                aria-required="true" aria-invalid="false"
                                                placeholder="Enter admin Email...">
                                            @error('email')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1"><i
                                                    class="text-success me-2 fa-solid fa-user-group"></i> Role</label>
                                            <input id="cc-pament" name="role" type="text"
                                                value="{{ old('role', Auth::user()->role) }}"
                                                class="form-control @error('role') is-invalid @enderror"
                                                aria-required="true" aria-invalid="false" disabled>
                                            @error('role')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1"><i
                                                    class="text-success me-2 fa-solid fa-phone"></i> Phone</label>
                                            <input id="cc-pament" name="phone" type="text"
                                                value="{{ old('phone', Auth::user()->phone) }}"
                                                class="form-control @error('phone') is-invalid @enderror"
                                                aria-required="true" aria-invalid="false"
                                                placeholder="Enter Admin Phone...">
                                            @error('phone')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1"><i
                                                    class="text-success me-2 fa-solid fa-mars-and-venus"></i> Gender</label>
                                            <select name="gender"
                                                class="form-control @error('gender') is-invalid @enderror">
                                                <option value="">Choose gender</option>
                                                <option value="male" @if (Auth::user()->gender == 'male') selected @endif>
                                                    Male</option>
                                                <option value="female" @if (Auth::user()->gender == 'female') selected @endif>
                                                    Female</option>
                                            </select>
                                            @error('gender')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1"><i
                                                    class="text-success me-2 fa-solid fa-map-location"></i> Address</label>

                                            <textarea name="address" class="form-control py-2 @error('address') is-invalid @enderror" cols="30" rows="4"
                                                placeholder="Enter Admin Address">{{ old('address', Auth::user()->address) }}</textarea>
                                            @error('address')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-3 offset-9 ">
                                        <button type="submit" class="btn btn-dark col-12">
                                            <span class="text-center">Update <i
                                                    class="fa-solid fa-circle-chevron-right"></i></span>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection
