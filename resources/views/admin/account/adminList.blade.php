
@extends('admin.layouts.master')

@section('title', 'Admin List')

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
                                <h2 class="title-1">Admin List</h2>

                            </div>
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
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <span><i class="zmdi zmdi-delete"></i> {{ session('deleteSuccess') }}</span>
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
                            <form action="{{ route('admin#list') }}" method="get" class="input-group">
                                @csrf
                                <input type="text" name="key" class="form-control" placeholder="Search..." value="{{ request('key') }}">
                                <button type="submit" class="btn btn-primary"><i class="zmdi zmdi-search"></i></button>
                            </form>
                        </div>
                    </div>
                    <div class="row px-3">
                        <div class="col-1 btn btn-warning">
                            <h4 class="text-light"><i class="fa-solid fa-database"></i> - ( {{ $admin->total() }} )</h4>
                        </div>
                    </div>


                        <div class="table-responsive table-responsive-data2">
                            <table class="table table-data2 text-center">
                                <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Gender</th>
                                        <th>phone</th>
                                        <th>Address</th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($admin as $a)
                                        <tr class="tr-shadow">
                                            <input type="hidden" id="userId" value="{{ $a->id }}">
                                            <td class="col-2">
                                                @if($a->image != null)
                                                    <img src="{{ asset('storage/'.$a->image) }}" class=" rounded-circle img-thumbnail" style="width: 100px;">
                                                @else
                                                    @if ($a->gender == 'male')
                                                        <img src="{{ asset('image/default-male-user.png') }}" class=" rounded-circle img-thumbnail" style="width: 100px;">
                                                    @else
                                                        <img src="{{ asset('image/default-female-user.png') }}" class=" rounded-circle img-thumbnail" style="width: 100px;">
                                                    @endif
                                                @endif
                                            </td>
                                            <td class="text-success">{{ $a->name }}</td>
                                            <td>{{ $a->email }}</td>
                                            <td>{{ $a->gender }}</td>
                                            <td>{{ $a->phone }}</td>
                                            <td>{{ $a->address }}</td>
                                            <td>
                                                <div class="table-data-feature">
                                                    @if( Auth::user()->id == $a->id)
                                                    @else
                                                        <select name="role" class="form-control me-5 selectRole">
                                                            <option value="admin">Admin</option>
                                                            <option value="user">User</option>
                                                        </select>
                                                        <a href="{{ route('admin#delete',$a->id) }}" class="me-2">
                                                            <button class="item p-3 bg-danger" data-toggle="tooltip" data-placement="top" title="Delete">
                                                                <i class="fa-solid fa-trash text-white"></i>
                                                            </button>
                                                        </a>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="spacer"></tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <div class="mt-3">
                                {{ $admin->links() }}
                                {{-- {{ $categories->appends(request()->query())->links() }} --}}
                            </div>
                        </div>


                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection

@section('scriptSection')
    <script>
        $(document).ready(function(){
            $('.selectRole').change(function() {
                $role = $(this).val();
                $parentNode = $(this).parents('tr');
                $userId = $parentNode.find('#userId').val();

                console.log($role);
                $.ajax({
                    type: 'get',
                    url: 'http://127.0.0.1:8000/admin/change/role',
                    data: {
                        'user_id': $userId,
                        'role' : $role
                    },
                    dataType: 'json',
                    success: function(response){
                        console.log(response.message);
                    }
                })
                location.reload();
            })
        })
    </script>
@endsection
