@extends('public.layouts.master')
@section('content')
    <main>
        <section class="section-5 pt-3 pb-3 mb-3 bg-white">
            <div class="container">
                <div class="light-font">
                    <ol class="breadcrumb primary-color mb-0">
                        <li class="breadcrumb-item"><a class="white-text" href="#">My Account</a></li>
                        <li class="breadcrumb-item">Settings</li>
                    </ol>
                </div>
            </div>
        </section>

        <section class=" section-11 ">
            <div class="container  mt-5">
                <div class="row">
                    <div class="col-md-3">
                        @include('public.auth.account_panel')
                    </div>
                    <div class="col-md-9">
                        <div class="card">
                            <div class="card-header">
                                <h2 class="h5 mb-0 pt-2 pb-2">Personal Information</h2>
                            </div>
                            <div class="card-body p-4">
                                <form action="{{ route('frontend.update.profile', $user->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="row">
                                        <div class="mb-3">
                                            <label for="name">Name</label>
                                            <input type="text" name="name" value="{{ old('name', $user->name) }}"
                                                id="name" placeholder="Enter Your Name" class="form-control">
                                        </div>
                                        <div class="mb-3">
                                            <label for="email">Email</label>
                                            <input type="text" name="email" value="{{ old('email', $user->email) }}"
                                                id="email" placeholder="Enter Your Email" class="form-control">
                                        </div>
                                        <div class="mb-3">
                                            <label for="phone">Phone</label>
                                            <input type="text" name="phone" id="phone"
                                                value="{{ old('phone', $user->customer_address->phone) }}"
                                                placeholder="Enter Your Phone" class="form-control">
                                        </div>

                                        <div class="mb-3">
                                            <label for="phone">Address</label>
                                            <textarea name="address" id="address" class="form-control" cols="30" rows="5"
                                                placeholder="Enter Your Address">{{ old('address', $user->customer_address->address) }}</textarea>
                                        </div>

                                        <div class="d-flex">
                                            <button class="btn btn-dark" type="submit">Update</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection

@section('script')
@endsection
