@extends('admin.layouts.master')

@section('title', 'Category List')

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
                                <h2 class="title-1">Category List</h2>

                            </div>
                        </div>
                        <div class="table-data__tool-right">
                            <a href="{{ route('category#createPage') }}">
                                <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                    <i class="zmdi zmdi-plus"></i>Add Category
                                </button>
                            </a>
                            <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                CSV download
                            </button>
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
                        <div class="col-4 offset-8">
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <span><i class="zmdi zmdi-delete"></i> {{ session('deleteSuccess') }}</span>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        </div>
                    @endif

                    @if (session('changeSuccess'))
                        <div class="col-4 offset-8">
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
                            <form action="{{ route('category#list') }}" method="get" class="input-group">
                                @csrf
                                <input type="text" name="key" class="form-control" placeholder="Search..." value="{{ request('key') }}">
                                <button type="submit" class="btn btn-primary"><i class="zmdi zmdi-search"></i></button>
                            </form>
                        </div>
                    </div>
                    <div class="row px-3">
                        <div class="col-2 btn btn-warning">
                            <h4 class="text-light">Total - ( {{ $categories->total() }} )</h4>
                        </div>
                    </div>

                    @if (count($categories) != 0)
                        <div class="table-responsive table-responsive-data2">
                            <table class="table table-data2 text-center">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Category Name</th>
                                        <th>Created Date</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($categories as $category)
                                        <tr class="tr-shadow">
                                            <td>{{ $category->id }}</td>
                                            <td class="col-6 text-success">{{ $category->name }}</td>
                                            <td>{{ $category->created_at->format('j-F-Y')}}</td>
                                            <td>
                                                <div class="table-data-feature">
                                                    <a href="{{ route('category#edit',$category->id) }}">
                                                        <button class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                                                            <i class="zmdi zmdi-edit"></i>
                                                        </button>
                                                    </a>
                                                    <a href="{{ route('category#delete',$category->id) }}">
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
                                {{-- {{ $categories->links() }} --}}
                                {{ $categories->appends(request()->query())->links() }}
                            </div>
                        </div>
                    @else
                        <h3 class="text-secondary text-center mt-5">There is no Category here.</h3>
                    @endif
                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection
