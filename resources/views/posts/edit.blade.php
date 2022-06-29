@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card border-0 shadow rounded">
                <div class="card-body">
                    <h3>Edit Post</h3>
                    <hr>
                    <form action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
                    
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="font-weight-bold">Image</label>
                            @if ($post->image != null)
                            <div class="mb-2">
                                <img src="{{ Storage::url('public/posts/').$post->image }}" class="img-responsive" width="200" height="200" alt="">
                            </div>    
                            @endif
                            <input type="file" class="form-control" name="image">
                        </div>

                        <div class="mb-3">
                            <label class="font-weight-bold">Title</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title', $post->title) }}" placeholder="Enter Post title">
                        
                            <!-- error message -->
                            @error('title')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="font-weight-bold form-label">Category</label>
                            <select class="form-select" name="category_id">
                                @foreach ($categories as $category)
                                @if (old('category_id', $post->category_id) == $category->id)
                                    <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                                @endif
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="mb-3">
                            <label class="font-weight-bold">Content</label>
                            <input id="content" type="hidden" name="content" value="{{ old('content', $post->content) }}" class="@error('title') is-invalid @enderror">
                            <trix-editor input="content"></trix-editor>
                            <!-- error message untuk content -->
                            @error('content')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-md btn-primary">Save</button>
                        <button type="reset" class="btn btn-md btn-danger">Reset</button>

                    </form> 
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener('trix-file-accept', function(e) {
        e.preventDefault();
    })
</script>
@endsection