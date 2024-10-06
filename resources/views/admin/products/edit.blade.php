@extends('admin.layouts.app')

@section('header-links')
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('admin/css/adminlte.min.css') }}">
@endsection
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Product</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="products.html" class="btn btn-primary">Back</a>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <form action="{{ route('products.update',$product->slug) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-8">
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="title">Title</label>
                                            <input type="text" name="title" id="title" class="form-control"
                                                placeholder="Title" value="{{ old('title',$product->title) }}"  oninput="generateSlug(this.value)">
                                            @error('title')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="slug">Slug</label>
                                            <input type="text" name="slug" id="slug" class="form-control"
                                                placeholder="slug" value="{{ old('slug',$product->slug) }}" readonly>
                                            @error('slug')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="description">Description</label>
                                            <textarea class="form-control" id="content" placeholder="Enter the Description" rows="5" cols="4"
                                                name="description">{{old('description',$product->description)}}</textarea>
                                            @error('description')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="shipping_returns">Shipping and Returns</label>
                                            <textarea class="form-control" id="shipping_content"  rows="5" cols="4"
                                                name="shipping_returns">{{old('shipping_returns',$product->shipping_returns)}}</textarea>
                                            @error('shipping_returns')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-3">
                            <div class="card-body">
                                <h2 class="h4 mb-3">Featured Image</h2>
                                <input class="form-control" type="file" name="image" id="" accept="image/*">
                                @error('image')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="card mb-3">
                            <div class="card-body">
                                <h2 class="h4 mb-3">Images</h2>
                                <input class="form-control" type="file" name="images[]"  multiple id="" accept="image/*">
                                @error('images')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="card mb-3">
                            <div class="card-body">
                                <h2 class="h4 mb-3">Pricing</h2>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="price">Price</label>
                                            <input type="text" name="price" id="price" class="form-control"
                                                placeholder="Price" value="{{ old('price',$product->price) }}">
                                            @error('price')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="compare_price">Compare at Price</label>
                                            <input type="text" name="compare_price" id="compare_price"
                                                class="form-control" placeholder="Compare Price"
                                                value="{{ old('compare_price',$product->compare_price) }}">
                                            @error('compare_price')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-3">
                            <div class="card-body">
                                <h2 class="h4 mb-3">Inventory</h2>
                                <div class="row">


                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <div class="custom-control custom-checkbox">
                                                <!-- Hidden input to ensure a value is sent when the checkbox is unchecked -->
                                                <input type="hidden" name="track_qty" value="0">
                                        
                                                <!-- Checkbox input -->
                                                <input
                                                    class="custom-control-input"
                                                    type="checkbox"
                                                    id="track_qty"
                                                    name="track_qty"
                                                    value="1"
                                                    {{ old('track_qty', $product->track_qty) == '1' ? 'checked' : '' }}
                                                >
                                                <label class="custom-control-label" for="track_qty">Track Quantity</label>
                                        
                                                <!-- Error message display -->
                                                @error('track_qty')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        
                                        
                                        <div class="mb-3">
                                            <input type="number" min="0" name="qty" id="qty"
                                                class="form-control" placeholder="Qty" value="{{ old('qty',$product->qty) }}">
                                            @error('qty')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card mb-3">
                            <div class="card-body">
                                <h2 class="h4 mb-3">Product status</h2>
                                <div class="mb-3">
                                    <label for="status">Status</label>
                                    <select name="status" id="status" class="form-control">
                                        <option value="1" {{ old('status', $product->status) == '1' ? 'selected' : '' }}>Active</option>
                                        <option value="0" {{ old('status', $product->status) == '0' ? 'selected' : '' }}>Block</option>
                                    </select>
                                    @error('status')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <h2 class="h4  mb-3">Product category</h2>
                                <div class="mb-3">
                                    <label for="category">Category</label>
                                    <select name="category" id="category" class="form-control">
                                        <option value="" selected disabled>Select Category</option> <!-- Default placeholder -->
                                        @if (isset($requiredData['categories']) && count($requiredData['categories']) > 0)
                                            @foreach ($requiredData['categories'] as $category)
                                                <option value="{{ $category->id }}" 
                                                    {{ old('category', $product->category_id) == $category->id ? 'selected' : '' }}>
                                                    {{ $category->name }}
                                                </option>
                                            @endforeach
                                        @endif
                                    </select>
                                    @error('category')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                
                                <div class="mb-3">
                                    <label for="sub_category">Sub Category</label>
                                    <select name="sub_category" id="sub_category" class="form-control">
                                        <option value="" selected disabled>Select SubCategory</option>
                                        @if (isset($requiredData['subcategories']) && count($requiredData['subcategories']) > 0)
                                            @foreach ($requiredData['subcategories'] as $subcategory)
                                                <option value="{{ $subcategory->id }}" 
                                                    {{ old('sub_category', $product->sub_category_id) == $subcategory->id ? 'selected' : '' }}>
                                                    {{ $subcategory->name }}
                                                </option>
                                            @endforeach
                                        @endif
                                    </select>
                                    @error('sub_category')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                
                            </div>
                        </div>
                        <div class="card mb-3">
                            <div class="card-body">
                                <h2 class="h4 mb-3">Product brand</h2>
                                <div class="mb-3">
                                    <label for="brand">Brand</label>
                                    <select name="brand" id="brand" class="form-control">
                                        <option value="" selected disabled>Select Brand</option> <!-- Default placeholder -->
                                        @if (isset($requiredData['brands']) && count($requiredData['brands']) > 0)
                                            @foreach ($requiredData['brands'] as $brand)
                                                <option value="{{ $brand->id }}" 
                                                    {{ old('brand', $product->brand_id) == $brand->id ? 'selected' : '' }}>
                                                    {{ $brand->name }}
                                                </option>
                                            @endforeach
                                        @endif
                                    </select>
                                    @error('brand')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                
                            </div>
                        </div>
                        <div class="card mb-3">
                            <div class="card-body">
                                <h2 class="h4 mb-3">Featured Product</h2>
                                <div class="mb-3">
                                    <select name="featured" id="featured" class="form-control">
                                        <option value="" disabled>Select Option</option>
                                        <option value="Yes" {{ old('featured', $product->is_featured) == 'Yes' ? 'selected' : '' }}>Yes</option>
                                        <option value="No" {{ old('featured', $product->is_featured) == 'No' ? 'selected' : '' }}>No</option>
                                    </select>
                                    @error('featured')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>

                <div class="pb-5 pt-3">
                    <button class="btn btn-primary" type="submit">Create</button>
                    <a href="{{route('products.index')}}" class="btn btn-outline-dark ml-3">Cancel</a>
                </div>
            </div>
        </form>
        <!-- /.card -->
    </section>
    <!-- /.content -->
@endsection

@push('script')
    {{-- ck editor --}}
    <script>
        ClassicEditor
            .create(document.querySelector('#content'), {
                removePlugins: ['Image', 'ImageCaption', 'ImageStyle', 'ImageToolbar', 'ImageUpload',
                    'Indent', 'ImageUpload', 'MediaEmbed'
                ],
            })
            // .then(editor => {
            //     console.log('Available plugins:', ClassicEditor.builtinPlugins.map(plugin => plugin
            //         .pluginName));
            // })
            .catch(error => {
                console.error(error.stack);
            });
    </script>
     <script>
        ClassicEditor
            .create(document.querySelector('#shipping_content'), {
                removePlugins: ['Image', 'ImageCaption', 'ImageStyle', 'ImageToolbar', 'ImageUpload',
                    'Indent', 'ImageUpload', 'MediaEmbed'
                ],
            })
            .catch(error => {
                console.error(error.stack);
            });
    </script>
@endpush
