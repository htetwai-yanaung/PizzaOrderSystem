@extends('admin.layouts.master')

@section('title', 'User List')

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
                                <h2 class="title-1">User List</h2>
                            </div>
                        </div>
                    </div>
                    <div class="row px-3">
                        <h4 class="btn btn-success col-1"><i class="fas fa-database"></i> - {{ $users->total() }} </h4>
                    </div>
                    <div class="table-responsive table-responsive-data2">
                        <table class="table table-data2 text-center">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Gender</th>
                                    <th>Phone</th>
                                    <th>Address</th>
                                    <th>Role</th>
                                </tr>
                            </thead>
                            <tbody id="dataList">
                                @foreach ($users as $u)
                                    <tr>
                                        <input type="hidden" id="userId" value="{{ $u->id }}">
                                        <td>
                                            @if($u->image != null)
                                                <img src="{{ asset('storage/'.$u->image) }}" class=" rounded-circle img-thumbnail" style="width: 100px;">
                                            @else
                                                @if ($u->gender == 'male')
                                                    <img src="{{ asset('image/default-male-user.png') }}" class=" rounded-circle img-thumbnail" style="width: 100px;">
                                                @else
                                                    <img src="{{ asset('image/default-female-user.png') }}" class=" rounded-circle img-thumbnail" style="width: 100px;">
                                                @endif
                                            @endif
                                        </td>
                                        <td>{{ $u->name }}</td>
                                        <td>{{ $u->email }}</td>
                                        <td>{{ $u->gender }}</td>
                                        <td>{{ $u->phone }}</td>
                                        <td>{{ $u->address }}</td>
                                        <td>
                                            <select name="role" id="role" class="form-control changeStatus">
                                                <option value="admin" @if ($u->role == 'admin') selected @endif >Admin</option>
                                                <option value="user" @if ($u->role == 'user') selected @endif >User</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr class="spacer"></tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="mt-5">
                            {{ $users->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection

@section('scriptSection')
    <script>
        $(document).ready(function() {
            $('.changeStatus').change(function() {
                $parentNode = $(this).parents('tr');
                $role = $(this).val();
                $userId = $parentNode.find('#userId').val();

                $.ajax({
                    type: 'get',
                    url: 'http://127.0.0.1:8000/user/change/role',
                    data: {
                        'user_id' : $userId,
                        'role': $role,
                    },
                    dataType: 'json',
                })
                location.reload();
            })
        })
    </script>
@endsection
