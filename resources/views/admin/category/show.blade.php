@extends('admin.layouts.app')
@section('content')
    <section class="content-header">
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Show Product</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{ route('products.index') }}" class="btn btn-primary">Back</a>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="card px-2 px-md-4 py-2 py-md-4">
                <div class="table-responsive">
                    <table class="table table-hover text-nowrap table-bordered" id="category-table">
                            <tr>
                                <th width="60">Name</th>
                                <td>{{$product->title}}</td>
                            </tr>
                            <tr>
                                <th width="60">Slug</th>
                                <td>{{$product->slug}}</td>
                            </tr>
                            <tr>
                                <th width="60">Price</th>
                                <td>{{$product->price}}</td>
                            </tr>
                            <tr>
                                <th width="60">Compare Price</th>
                                <td>{{$product->compare_price}}</td>
                            </tr>
                            <tr>
                                <th width="60">Category</th>
                                <td>{{$product->category->name}}</td>
                            </tr>
                            <tr>
                                <th width="60">Sub Category</th>
                                <td>{{$product->subCategory->name?$product->subCategory->name:''}}</td>
                            </tr>
                            <tr>
                                <th width="60">Brand</th>
                                <td>{{$product->brand->name}}</td>
                            </tr>
                            <tr>
                                <th width="60">Featured</th>
                                <td>{{$product->is_featured===1?'Yes':'No'}}</td>
                            </tr>
                            <tr>
                                <th width="60">Track Quantity</th>
                                <td>{{$product->track_qty===1?'Yes':'No'}}</td>
                            </tr>
                            <tr>
                                <th width="60">Track Quantity</th>
                                <td>{{$product->track_qty===1?'Yes':'No'}}</td>
                            </tr>
                            <tr>
                                <th width="60">Quantity</th>
                                <td>{{$product->qty}}</td>
                            </tr>
                            <tr>
                                <th width="60">Status</th>
                                <td>
                                    {!! $product->status == 1 
                                        ? '<i class="far fa-circle-check text-success"></i>' 
                                        : '<i class="far fa-circle-xmark text-danger"></i>' !!}
                                </td>
                            </tr>
                            <tr>
                                <th width="60">Featured Image</th>
                                <td><img src="{{asset('storage/images/products/'.$product->image)}}" alt="{{$product->image}}" style="height: 200px"></td>
                            </tr>
                            <tr>
                                <th width="60">Images</th>
                                <td>
                                    @if(count($product->images)>0)
                                        @foreach ($product->images as $img)
                                        <img src="{{asset('storage/images/product/'.$img->filename)}}" alt="{{$img->filename}}" style="max-height: 200px" loading="lazy" >
                                        @endforeach
                                    @endif
                                </td>
                            </tr>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection