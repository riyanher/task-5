@extends('layouts.app')

@section('content')
<div class="container">
<div class="row">
    <div class="col-md-12">
        <div class="card border-0 shadow rounded">
            <div class="card-body">
                <a href="{{ route('categories.create') }}" class="btn btn-md btn-success mb-3"><i class="bi bi-file-earmark-plus"></i> Add Category</a>
                <table class="table table-striped">
                    <thead>
                      <tr>
                        <th scope="col">Name</th>
                        <th scope="col">User ID</th>
                        <th scope="col" class="text-center">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @forelse ($categories as $category)
                        <tr>
                            <td>{{ $category->name }}</td>
                            <td>{{ $category->user_id }}</td>
                            <td class="text-center">
                                <form onsubmit="return confirm('Are you sure ?');" action="{{ route('categories.destroy', $category->id) }}" method="POST">
                                    <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-sm btn-primary"><i class="bi bi-pencil-square"></i> Edit</a>
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i> Delete</button>
                                </form>
                            </td>
                        </tr>
                      @empty
                          <div class="col-md-6 alert alert-danger">
                              Category is empty. Click "Add Category" button above to add category.
                          </div>
                      @endforelse
                    </tbody>
                  </table>  
                  {{-- {{ $categories->links() }} --}}
            </div>
        </div>
    </div>
</div>
</div>
@endsection