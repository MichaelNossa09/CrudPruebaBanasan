@extends('layouts.plantilla')

@section('title', 'Edit Post')

@section('content')
    <div class="container-edit-post">
        <h2>Edit Post!</h2>
        <form action="{{ route('publicaciones.update', $publicacion) }}" method="POST">
            @csrf
            @method('PUT')
            <input type="text" name="title" id="" class="input" value="{{ $publicacion->title }}" required>
            <textarea name="content" id="" cols="30" rows="10">{{ $publicacion->content }}</textarea>
            <input type="submit" value="Save Changes!">
        </form>
    </div>
@endsection
