@extends('layouts.dashboard')
@section('content')
    <form action="{{ route('admin.posts.update', $post->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="title">Titolo</label>
            <input type="text" class="form-control" name="title" id="title" placeholder="Scrivi un titolo..."
                value="{{ old('title', $post->title) }}">
            @error('title')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        {{-- area contenuto --}}
        <div class="form-group">
            <label for="content">Contenuto</label>
            <textarea class="form-control" name="content" id="content" rows="3">{{ old('content', $post->content) }}</textarea>
            @error('content')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        {{-- seleziona genere --}}
        <select class="form-control mb-5" name="category_id">
            <option value="">--Seleziona genere--</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}"
                    {{ $category->id == old('category_id', $post->category_id) ? 'selected' : '' }}>

                    {{ $category->name }}
                </option>
            @endforeach
        </select>
        @error('category_id')
            <div class="text-danger">{{ $message }}</div>
        @enderror
        {{-- UPLOAD IMMAGINI --}}
        <div class="form-group">
            @if ($post->cover)
                <div class="cover-img my-3">
                    <img src="{{ asset('storage/' . $post->cover) }}">
                </div>
            @endif
            <label for="image">Carica cover</label>
            <input type="file" name="image" />
        </div>
        {{-- CHECKBOX TAGS --}}
        <p>Tags</p>
        @foreach ($tags as $tag)
            @if ($errors->any())
                <div>
                    <input type="checkbox" name="tags[]" value="{{ $tag->id }}"
                        {{ in_array($tag->id, old('tags', [])) ? 'checked' : '' }} />
                    <label> {{ $tag->name }}</label>
                </div>
            @else
                <div>
                    <input type="checkbox" name="tags[]" value="{{ $tag->id }}"
                        {{ $post->tags->contains($tag) ? 'checked' : '' }} />
                    <label> {{ $tag->name }}</label>
                </div>
            @endif
        @endforeach
        @error('tags')
            <div class="text-danger">{{ $message }}</div>
        @enderror
        {{-- submit button --}}
        <input class="btn btn-primary mt-5" type="submit">
    </form>
@endsection
