@extends('layouts.app')
@section('content')
    <section class="container">
        <h1>Edit {{$project->title}}</h1>
        <form action="{{ route('admin.projects.update', $project->slug) }}" enctype="multipart/form-data" method="POST">
        @csrf
     <div class="mb-3">
            <label for="title">Title</label>
            <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" id="title"
                required minlength="3" maxlength="200" value="{{ old('title', $project->title) }}">
            @error('title')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
    </div>

    <div class="mb-3">
        <label for="category_id">Select Category</label>
        <select class="form-control @error('category_id') is-invalid @enderror" name="category_id" id="category_id">
            <option value="">Select a Category</option>
            @foreach ($categories as $category)
                <option value="{{$category->id}}" {{old('category_id', $project->category_id) == $category->id ? 'selected' : ''}}>{{$category->name}}</option>
            @endforeach
        </select>
        @error('category_id')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="url">Url</label>
        <input type="url" class="form-control @error('url') is-invalid @enderror" name="url" id="url" value="{{old('url', $project->url)}}">
        @error('url')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="description">Body</label>
        <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description" cols="30" rows="10">
        {{ old('description', $project->description)}}
        </textarea>
        @error('description')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <div class="form-group">
            <h6>Select Technologies</h6>
            @foreach ($technologies as $technology)
                <div class="form-check @error('technologies') is-invalid @enderror">
                    @if($errors->any())

                    @else
                    <input type="checkbox" class="form-check-input" name="technologies[]" value="{{$technology->id}}" {{ $project->technologies->contains($technology->id) ? 'checked' : ''}}>
                    @endif
                    <label class="form-check-label">

                        {{$technology->name}}
                    </label>

                </div>
            @endforeach
            @error('technologies')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="d-flex">
        <div class="me-3">
            <img id="uploadPreview" width="100" src="https://via.placeholder.com/300x200" alt="">
        </div>
        <div class="mb-3">
            <label for="image">Image</label>
            <input class="shadow" type="file" class="form-control @error('image') is-invalid @enderror" name="image" id="image" value="{{old('image', $project->image)}}">
            @error('image')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="mt-3">
        <button type="submit" class="btn btn-success">Save</button>
        <button type="reset" class="btn btn-primary">Reset</button>
    </div>


        </form>
    </section>
@endsection

