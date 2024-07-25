@extends('admin.layouts.app')
@section('content')
    <section class="content-header">
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Show Brand</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{ route('brands.index') }}" class="btn btn-primary">Back</a>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="card px-2 px-md-4 py-2 py-md-4">
                <div class="table-responsive">
                    <table class="table table-hover text-nowrap table-bordered" id="brand-table">
                            <tr>
                                <th width="60">Name</th>
                                <td>{{$brand->name}}</td>
                            </tr>
                            <tr>
                                <th width="60">Slug</th>
                                <td>{{$brand->slug}}</td>
                            </tr>
                            <tr>
                                <th width="60">Status</th>
                                <td>
                                    {!! $brand->status == 1 
                                        ? '<i class="far fa-circle-check text-success"></i>' 
                                        : '<i class="far fa-circle-xmark text-danger"></i>' !!}
                                </td>
                            </tr>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection