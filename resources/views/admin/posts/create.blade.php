@extends('layouts.dashboard')
@section('content')
    <form action="{{ route('admin.posts.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="title">Titolo</label>
            <input type="text" class="form-control" name="title" id="title" value="{{ old('title') }}"
                placeholder=" Scrivi un titolo...">
            @error('title')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        {{-- area contenuto --}}
        <div class="form-group">
            <label for="content">Contenuto</label>
            <textarea class="form-control" name="content" id="content" rows="3">{{ old('content') }}</textarea>
            @error('content')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        {{-- seleziona genere --}}
        <select class="form-control mb-5" name="category_id">
            <option value="">--Seleziona genere--</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" {{ $category->id == old('category_id') ? 'selected' : '' }}>
                    {{ $category->name }}</option>
            @endforeach
        </select>
        @error('category_id')
            <div class="text-danger">{{ $message }}</div>
        @enderror

        {{-- UPLOAD IMMAGINI --}}
        <div class="form-group">
            <label for="image">Carica cover</label>
            <input type="file" name="image" />
        </div>
        {{-- CHECKBOX TAGS --}}
        <p>Tags</p>
        @foreach ($tags as $tag)
            <div>
                <input type="checkbox" name="tags[]" value="{{ $tag->id }}"
                    {{ in_array($tag->id, old('tags', [])) ? 'checked' : '' }} />
                <label> {{ $tag->name }}</label>
            </div>
        @endforeach
        @error('tags')
            <div class="text-danger">{{ $message }}</div>
        @enderror

        {{-- submit button --}}
        <input class="btn btn-primary mt-3" type="submit">
    </form>
@endsection
