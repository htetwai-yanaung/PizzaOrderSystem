@extends('admin.layouts.master')

@section('title', 'Pizza List')

@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <!-- DATA TABLE -->
                    <div class="table-data__tool">
                        <div class="table-data__tool-left">
                            <div class="overview-wrap">
                                <h2 class="title-1">Pizza List</h2>

                            </div>
                        </div>
                        <div class="table-data__tool-right">
                            <a href="{{ route('product#createPage') }}">
                                <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                    <i class="zmdi zmdi-plus"></i>Add Pizza
                                </button>
                            </a>
                        </div>
                    </div>
                    {{-- message alert  --}}
                    @if (session('createSuccess'))
                        <div class="col-4 offset-8">
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <span><i class="zmdi zmdi-check"></i> {{ session('createSuccess') }}</span>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        </div>
                    @endif

                    @if (session('deleteSuccess'))
                        <div class="col-6 offset-6">
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <span><i class="zmdi zmdi-delete"></i> {{ session('deleteSuccess') }}</span>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        </div>
                    @endif

                    @if (session('changeSuccess'))
                        <div class="col-6 offset-6">
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <span><i class="zmdi zmdi-check"></i> {{ session('changeSuccess') }}</span>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        </div>
                    @endif
                    {{-- message alert end --}}

                    {{-- search box --}}
                    <div class="row">
                        <div class="col-3">
                            <h4 class="text-secondary">Search key : <span class="text-danger">{{ request('key') }}</span></h4>
                        </div>
                        <div class="col-4 offset-5">
                            <form action="{{ route('product#list') }}" method="get" class="input-group">
                                @csrf
                                <input type="text" name="key" class="form-control" placeholder="Search..." value="{{ request('key') }}">
                                <button type="submit" class="btn btn-primary"><i class="zmdi zmdi-search"></i></button>
                            </form>
                        </div>
                    </div>
                    <div class="row px-3">
                        <div class="col-2 btn btn-warning">
                            <h4 class="text-light">Total - {{ $pizzas->total() }} </h4>
                        </div>
                    </div>


                        @if ( count($pizzas) != 0 )
                            <div class="table-responsive table-responsive-data2">
                                <table class="table table-data2 text-center">
                                    <thead>
                                        <tr>
                                            <th>Image</th>
                                            <th>Name</th>
                                            <th>Price</th>
                                            <th>Category</th>
                                            <th>Waiting Time</th>
                                            <th>View count</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($pizzas as $pizza)
                                            <tr class="tr-shadow">
                                                <td class="col-2"><img src="{{ asset('storage/'.$pizza->image) }}" class=" img-thumbnail" style="width: 100px;"></td>
                                                <td class="text-success">{{ $pizza->name }}</td>
                                                <td>{{  $pizza->price  }}</td>
                                                <td>{{ $pizza->category_name }}</td>
                                                <td>{{ $pizza->waiting_time }} min</td>
                                                <td><span><i class="zmdi zmdi-eye"  style="width:30px; height:30px; background-color:#e5e5e5; border-radius:50%; padding:8px; text-align:center;"></i></span> {{ $pizza->view_count }}</td>
                                                <td>
                                                    <div class="table-data-feature">
                                                        <a href="{{ route('product#editPage',$pizza->id) }}">
                                                            <button class="item" data-toggle="tooltip" data-placement="top" title="View">
                                                                <i class="zmdi zmdi-eye"></i>
                                                            </button>
                                                        </a>
                                                        <a href="{{ route('product#updatePage',$pizza->id) }}">
                                                            <button class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                                                                <i class="zmdi zmdi-edit"></i>
                                                            </button>
                                                        </a>
                                                        <a href="{{ route('product#delete',$pizza->id) }}">
                                                            <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                                                <i class="zmdi zmdi-delete"></i>
                                                            </button>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr class="spacer"></tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                <div class="mt-3">
                                    {{ $pizzas->links() }}
                                </div>
                            </div>
                        @else
                            <h3 class="text-secondary text-center mt-5">There is no pizza here.</h3>
                        @endif

                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection
