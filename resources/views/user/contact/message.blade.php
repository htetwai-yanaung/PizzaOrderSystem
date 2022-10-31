@extends('user.layouts.master')

@section('content')
    <div class="row">
        <div class="col-4 offset-4 shadow-sm p-3">
            <h3 class="text-center">Contact Us</h3>
            <form action="{{ route('user#sendMessage') }}" method="POST">
                @csrf
                <div class="mt-3">
                    <label for="name"> <i class="fa-regular fa-user"></i> Name</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ old('name', Auth::user()->name) }}" placeholder="Enter your name">
                    @error('name')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="mt-3">
                    <label for="email"> <i class="fa-regular fa-envelope"></i> Email</label>
                    <input type="email" name="email" id="email" class="form-control" value="{{ old('email', Auth::user()->email) }}" placeholder="Enter your email">
                    @error('email')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="mt-3">
                    <label for="message"> <i class="fa-regular fa-comment"></i> Message</label>
                    <textarea name="message" id="message" cols="30" rows="4" class="form-control" placeholder="Enter your comment">{{ old('message') }}</textarea>
                    @error('message')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="mt-3 row">
                    <div class="col-3 offset-9">
                        <button type="submit" class="btn btn-success col-12"> <i class="fa-regular fa-paper-plane"></i> Send</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
