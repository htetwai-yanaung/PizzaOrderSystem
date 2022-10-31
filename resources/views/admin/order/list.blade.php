@extends('admin.layouts.master')

@section('title', 'Order List')

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
                                <h2 class="title-1">Order List</h2>

                            </div>
                        </div>

                    </div>


                    {{-- search box --}}
                    {{-- <div class="row">
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
                    </div> --}}
                    <div class="row px-3">
                        <h4 class="btn btn-success col-1"><i class="fas fa-database"></i> - {{ count($order) }} </h4>

                        <form action="{{ route('admin#changeStatus') }}" method="GET" class="col-6 offset-1">
                            @csrf
                            <div class="row d-flex align-items-center">
                                <div class="col-3">Order Status</div>
                                <div class="input-group col-5">
                                    <select name="orderStatus" class="form-control">
                                        <option value="">All</option>
                                        <option value="0" @if (request('orderStatus') == '0') selected @endif >Pending</option>
                                        <option value="1" @if (request('orderStatus') == '1') selected @endif >Accept</option>
                                        <option value="2" @if (request('orderStatus') == '2') selected @endif >Reject</option>
                                    </select>
                                    <button type="submit" class="btn btn-dark btn-sm px-3"> <i class="fas fa-search"></i> </button>
                                </div>
                            </div>
                        </form>
                    </div>


                        {{-- @if ( count($pizzas) != 0 ) --}}
                            <div class="table-responsive table-responsive-data2">
                                <table class="table table-data2 text-center">
                                    <thead>
                                        <tr>
                                            <th>User ID</th>
                                            <th>User Name</th>
                                            <th>Order Date</th>
                                            <th>Order Code</th>
                                            <th>Amount</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody id="dataList">
                                        @foreach ($order as $o)
                                            <tr class="tr-shadow">
                                                <input type="hidden" id="orderId" value="{{ $o->id }}">
                                                <td>{{ $o->user_id }}</td>
                                                <td>{{ $o->user_name }}</td>
                                                <td>{{ $o->created_at->format('F-j-Y')  }}</td>
                                                <td><a href="{{ route('admin#listInfo',$o->order_code)}}">{{ $o->order_code }}</a></td>
                                                <td class="amount">{{ $o->total_price }} Kyats</td>
                                                <td>
                                                    <select name="status" class="form-control statusChange">
                                                        <option value="0" class="text-warning " @if ( $o->status == 0 ) selected @endif>Pending</option>
                                                        <option value="1" class="text-success " @if ( $o->status == 1 ) selected @endif>Accept</option>
                                                        <option value="2" class="text-danger " @if ( $o->status == 2 ) selected @endif>Reject</option>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr class="spacer"></tr>
                                        @endforeach
                                    </tbody>
                                </table>


                            </div>
                        {{-- @else
                            <h3 class="text-secondary text-center mt-5">There is no pizza here.</h3>
                        @endif --}}

                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection

@section('scriptSection')
    <script>
        $(document).ready(function() {

            // change status
            $('.statusChange').change(function() {
                $parentNode = $(this).parents('tr');
                $currentStatus = $(this).val();
                $orderId = $parentNode.find('#orderId').val();

                $data = {
                    'order_id' : $orderId,
                    'status': $currentStatus
                }
                console.log($data);
                $.ajax({
                    type: 'get',
                    url: 'http://127.0.0.1:8000/order/ajax/change/status',
                    data: $data,
                    dataType: 'json',
                })
            })
        })
    </script>
@endsection
