@extends('admin.app')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Student List</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('student.index') }}">Student</a></li>
            <li class="breadcrumb-item active">Create</li>
        </ol>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Edit Student
            </div>
            <div class="card-body">
                <form action="{{ route('student.update', $student->id) }}" method="post">
                    @csrf
                    @method('put')
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control @error('name')is-invalid @enderror" id="name"
                            name="name" aria-describedby="validationNameFeedback" value="{{ $student->name }}">
                        @error('name')
                            <div id="validationNameFeedback" class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <textarea class="form-control @error('address')is-invalid @enderror" id="address" name="address"
                            aria-describedby="validationAddressFeedback">{{ $student->address }}</textarea>
                        @error('address')
                            <div id="validationAddressFeedback" class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3 float-end">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
