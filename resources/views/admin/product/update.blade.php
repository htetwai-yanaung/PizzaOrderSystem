@extends('admin.layouts.master')

@section('title', 'Edit Pizza')

@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">

                <div class="col-lg-10 offset-1">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                <h3 class="text-center title-2 text-success">Update Pizza</h3>
                            </div>
                            <hr>

                            <form action="{{ route('product#update') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-6 offset-3 d-flex justify-content-center">
                                        <input type="hidden" name="pizzaId" value="{{ $pizza->id }}">
                                        <img src="{{ asset('storage/'.$pizza->image) }}" class="col-6 rounded-circle"/>
                                    </div>
                                    <div class="row">
                                        <div class="col-6 offset-3">
                                            <input type="file" name="pizzaImage" id="" class="form-control @error('pizzaImage') is-invalid @enderror">

                                                @error('pizzaImage')
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
                                            <label for="cc-payment" class="control-label mb-1"><i class="text-success me-2 fa-solid fa-pizza-slice"></i> Name</label>

                                            <input id="cc-pament" name="pizzaName" type="text" value="{{ old('pizzaName', $pizza->name) }}" class="form-control @error('pizzaName') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter pizza Name...">
                                            @error('pizzaName')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1"><i class="text-success me-2 fa-solid fa-money-bill-1"></i> Price</label>
                                            <input id="cc-pament" name="pizzaPrice" type="number" value="{{ old('pizzaPrice', $pizza->price) }}" class="form-control @error('pizzaPrice') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter pizza price...">
                                            @error('pizzaPrice')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1"><i class="text-success me-2 fa-solid fa-eye"></i> View Count</label>
                                            <input id="cc-pament" name="view_count" type="text" value="{{ old('view_count', $pizza->view_count) }}" class="form-control @error('view_count') is-invalid @enderror" aria-required="true" aria-invalid="false"  disabled>
                                            @error('view_count')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1"><i class="text-success me-2 fa-solid fa-calendar-days"></i> Created Date</label>
                                            <input id="cc-pament" name="created_at" type="text" value="{{ old('created_at', $pizza->created_at) }}" class="form-control @error('created_at') is-invalid @enderror" aria-required="true" aria-invalid="false"  disabled>
                                            @error('created_at')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1"><i class="text-success me-2 fa-solid fa-clock-rotate-left"></i> Waiting Time</label>
                                            <input id="cc-pament" name="pizzaWaitingTime" type="number" value="{{ old('pizzaWaitingTime', $pizza->waiting_time) }}" class="form-control @error('pizzaWaitingTime') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter pizza WaitingTime...">
                                            @error('pizzaWaitingTime')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1"><i class="text-success me-2 fa-solid fa-tag"></i> Category</label>
                                            <select name="pizzaCategory" class="form-control @error('pizzaCategory') is-invalid @enderror">
                                                <option value="">Choose pizzaCategory</option>
                                                @foreach ($categories as $c)
                                                    <option value="{{ $c->id }}" @if ($c->id == $pizza->category_id) selected @endif>{{ $c->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('pizzaCategory')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1"><i class="text-success me-2 fa-solid fa-table-list"></i> Description</label>

                                            <textarea name="pizzaDescription" class="form-control py-2 @error('pizzaDescription') is-invalid @enderror" cols="30" rows="5" placeholder="Enter pizza Description">{{ old('pizzaDescription', $pizza->description) }}</textarea>
                                            @error('pizzaDescription')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-3 ">
                                        <button type="button" class="btn btn-danger col-12">
                                            <span class="text-center" onclick="history.back()"><i class="fa-solid fa-circle-chevron-left"></i> Cancle</span>
                                        </button>
                                    </div>
                                    <div class="col-3 offset-6 ">
                                        <button type="submit" class="btn btn-dark col-12">
                                            <span class="text-center">Update <i class="fa-solid fa-circle-chevron-right"></i></span>
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
