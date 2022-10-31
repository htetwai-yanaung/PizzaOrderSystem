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
                                <h2 class="title-1">Product List</h2>
                            </div>
                        </div>
                    </div>

                    <a href="{{ route('admin#orderList') }}" class="text-dark"><i class="fas fa-arrow-left-long"></i> Back</a>

                    <div class="w-50 mt-3">
                        <div class="card">
                            <div class="card-header">
                                <h4> <i class="fas fa-clipboard me-3"></i> Order Info</h4>
                            </div>
                            <div class="card-body">
                                <div class="row mb-2">
                                    <div class="col-6"> <i class="fas fa-user me-3"></i> Name</div>
                                    <div class="col-6">{{ strtoupper($orderList[0]->user_name) }}</div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-6"> <i class="fas fa-barcode me-3"></i> Order Code</div>
                                    <div class="col-6">{{ $orderList[0]->order_code }}</div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-6"> <i class="fas fa-clock me-3"></i> Order Date</div>
                                    <div class="col-6">{{ $orderList[0]->created_at }}</div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-6"> <i class="fas fa-money-bill-wave me-3"></i> Total Price</div>
                                    <div class="col-6">{{ $order->total_price }} Kyats</div>
                                </div>
                                <div class="row mb-0">
                                    <div class="col-6"></div>
                                    <div class="col-6"><span class="text-warning">include delivery charges</span></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive table-responsive-data2">
                        <table class="table table-data2 text-center">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Order ID</th>
                                    <th>Product Image</th>
                                    <th>Product Name</th>
                                    <th>Order Date</th>
                                    <th>Qty</th>
                                    <th>Amount</th>
                                </tr>
                            </thead>
                            <tbody id="dataList">
                                @foreach ($orderList as $ol)
                                    <tr class="tr-shadow">
                                        <td></td>
                                        <td>{{ $ol->id }}</td>
                                        <td style="height: 150px;" class="col-2"><img src="{{ asset('storage/'.$ol->product_image) }}" class="img-thumbnail h-100" ></td>
                                        <td>{{ $ol->product_name }}</td>
                                        <td>{{ $ol->created_at->format('F-j-Y') }}</td>
                                        <td>{{ $ol->qty }}</td>
                                        <td>{{ $ol->total }}</td>
                                    </tr>
                                    <tr class="spacer"></tr>
                                @endforeach
                            </tbody>
                        </table>
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
        $(document).ready(function() {

        })
    </script>
@endsection
