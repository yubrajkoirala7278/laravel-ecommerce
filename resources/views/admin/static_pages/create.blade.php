@extends('admin.layouts.app')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Static Page</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{route('page.index')}}" class="btn btn-primary">Back</a>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
      <!-- Main content -->
      <section class="content">
        <!-- Default box -->
        <form action="{{ route('page.store') }}" method="POST">
            @csrf
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="name">Name</label>
                                <input type="text" name="name" id="name" class="form-control"
                                    placeholder="name" value="{{ old('name') }}" oninput="generateSlug(this.value)">
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="slug">Slug</label>
                                <input type="text" name="slug" id="slug" class="form-control"
                                    placeholder="slug" value="{{ old('slug') }}" readonly>
                                @error('slug')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="content">Content</label>
                                <textarea class="form-control" id="content" placeholder="Enter the content" rows="5" cols="4"
                                    name="content">{{old('content')}}</textarea>
                                @error('content')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="pb-5 pt-3">
                <button class="btn btn-primary" type="submit">Create</button>
                <a href="{{ route('page.index') }}" class="btn btn-outline-dark ml-3">Cancel</a>
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
        .catch(error => {
            console.error(error.stack);
        });
</script>
@endpush
