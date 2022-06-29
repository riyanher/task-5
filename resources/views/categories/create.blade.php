@extends('layouts.app')

@section('content')
<div class="container mb-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card border-0 shadow rounded">
                <div class="card-body">
                    <form action="{{ route('categories.store') }}" method="POST">
                    
                        @csrf

                        <div class="form-group">
                            <label class="font-weight-bold">Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Enter name of the category">
                        
                            <!-- error message -->
                            @error('name')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mt-4">
                            <button type="submit" class="btn btn-md btn-primary">Save</button>
                            <button type="reset" class="btn btn-md btn-danger">Reset</button>
                        </div>

                    </form> 
                </div>
            </div>
        </div>
    </div>
</div>
@endsection