@extends('admin.layouts.master')

@section('title', 'Pizza detail')

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
                            <button onclick="history.back()"><i class="fa-solid fa-arrow-left"></i> back</button>
                            <div class="card-title">
                                <h3 class="text-center title-2 text-success">Pizza Detail</h3>
                            </div>
                            <hr>

                            <div class="row">
                                <div class="row d-flex">
                                    <div class="col-7 d-flex flex-column">
                                        <span class="my-1 text-secondary"><i class="shadow-sm rounded-circle bg-success p-2 text-white me-2 fa-solid fa-pizza-slice"></i>Name : <span class="text-success">{{ $pizza->name }}</span></span>
                                        <span class="my-1 text-secondary"><i class="shadow-sm rounded-circle bg-success p-2 text-white me-2 fa-solid fa-money-bill-1"></i>Price : <span class="text-success">{{ $pizza->price }}</span></span>
                                        <span class="my-1 text-secondary"><i class="shadow-sm rounded-circle bg-success p-2 text-white me-2 fa-solid fa-tag"></i>Category : <span class="text-success">{{ $pizza->category_name }}</span></span>
                                        <span class="my-1 text-secondary"><i class="shadow-sm rounded-circle bg-success p-2 text-white me-2 fa-solid fa-clock-rotate-left"></i>Waiting Time : <span class="text-success">{{ $pizza->waiting_time}} min</span></span>
                                        <span class="my-1 text-secondary"><i class="shadow-sm rounded-circle bg-success p-2 text-white me-2 fa-solid fa-eye"></i>Viewer : <span class="text-success">{{ $pizza->view_count}}</span></span>
                                        <span class="my-1 text-secondary"><i class="shadow-sm rounded-circle bg-success p-2 text-white me-2 fa-solid fa-calendar-days"></i>Release Date : <span class="text-success">{{ $pizza->created_at->format('j-F-Y')}}</span></span>

                                    </div>

                                    <div class="col-5 d-flex justify-content-center">
                                        <div class="col-12">
                                            <img src="{{ asset('storage/'.$pizza->image) }}" class="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <span class="my-1 text-secondary row"><span class="col-5"><i class="shadow-sm rounded-circle bg-success p-2 text-white me-2 fa-solid fa-table-list"></i>Description : </span><span class="text-success col-7 pt-1 ps-0">{{ $pizza->description }}</span></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection
