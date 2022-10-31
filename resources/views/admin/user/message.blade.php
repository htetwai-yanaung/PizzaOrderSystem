@extends('admin.layouts.master')

@section('title', 'Message')

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
                                <h2 class="title-1">User Message</h2>
                            </div>
                        </div>
                    </div>


                    <div class="row px-3">
                        <h4 class="btn btn-success col-1"><i class="fas fa-database"></i> - {{ $message->total() }} </h4>
                    </div>
                    <div class="table-responsive table-responsive-data2">
                        <table class="table table-data2 text-center">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Message</th>
                                    <th>Date</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody id="dataList">
                                @foreach ($message as $m)
                                    <tr>
                                        <td>{{ $m->name }}</td>
                                        <td>{{ $m->email }}</td>
                                        <td class="col-5">{{ $m->message }}</td>
                                        <td>{{ $m->created_at->format('F-j-Y') }}</td>
                                        <td><a href="{{ route('admin#deleteMessage',$m->id) }}"><i class="fas fa-trash text-danger"></i></a></td>
                                    </tr>
                                    <tr class="spacer"></tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="mt-5">
                            {{ $message->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection
