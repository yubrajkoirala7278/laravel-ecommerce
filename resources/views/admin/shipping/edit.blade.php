@extends('admin.layouts.app')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Shipping</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="" class="btn btn-primary">Back</a>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
     <!-- Main content -->
     <section class="content">
        <!-- Default box -->
        <form action="{{ route('shipping.update',$shippingCharge->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="country_name">Country</label>
                                <select class="form-select form-control" name="country_name">
                                    <option selected disabled>Select Country</option>
                                    @if(count($countries)>0)
                                        @foreach ($countries as $country)
                                            <option value="{{$country->name}}" {{(old('country_name',$shippingCharge->country_name) == $country->name?'selected':'')}}>{{$country->name}}</option>
                                        @endforeach    
                                    @endif
                                  </select>
                                @error('country_name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="amount">Amount</label>
                                <input type="number" name="amount" id="amount" class="form-control"
                                    placeholder="Amount" value="{{ old('amount',$shippingCharge->amount) }}">
                                @error('amount')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="pb-5 pt-3">
                <button class="btn btn-primary" type="submit">Create</button>
                <a href="{{ route('shipping.index') }}" class="btn btn-outline-dark ml-3">Cancel</a>
            </div>
        </form>
        <!-- /.card -->
    </section>
    <!-- /.content -->
@endsection

@push('script')
@endpush
