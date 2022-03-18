@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="post py-4">
            <h2 class="text-center">{{$post['title']}}</h2>
            <p>{{$post['content']}}</p>
        </div>
        <button class="btn btn-primary"><a class="text-decoration-none text-white" href="{{route('admin.posts.index')}}">Torna a tutti i post</a></button>
        <button class="btn btn-warning"><a class="text-decoration-none text-black" href="{{route('admin.posts.edit',$post->id)}}">Modifica</a></button>
        <form action="{{route('admin.posts.destroy', $post->id)}}" method="POST" class="d-inline-block" onsubmit="return confirm('Sei sicuro di voler eliminare questo post?')">
            @csrf
            @method("DELETE")
            <button type="submit" class="btn btn-danger">Elimina</button>
        </form>
    </div>
@endsection