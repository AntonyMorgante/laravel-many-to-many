@extends('layouts.app')

@section('content')
    <div class="container">
        <table class="table table-striped table-dark">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Titolo</th>
                <th scope="col">Categoria</th>
                <th scope="col">Anteprima</th>
                <th scope="col">Slug</th>
                <th scope="col"></th>
                </tr>
            </thead>
            <tbody>

                @php
                    $i=1;
                @endphp
                @foreach($posts as $post)
                    <tr>
                        <th scope="row">{{$i}}</th>
                        <td>{{$post->title}}</td>
                        <td class="text-center">{{$post->cathegory->name}}</td>
                        <td class="text-truncate px-4" style="max-width: 450px;">{{$post['content']}}</td>
                        <td class="text-center">{{$post->slug}}</td>
                        <td>
                            <button class="btn btn-primary"><a class="text-decoration-none text-white" href="{{route('admin.posts.show',$post->id)}}">Vai</a></button>
                            <button class="btn btn-warning"><a class="text-decoration-none text-black" href="{{route('admin.posts.edit',$post->id)}}">Modifica</a></button>
                            <form action="{{route('admin.posts.destroy', $post->id)}}" method="POST" onsubmit="return confirm('Sei sicuro di voler eliminare questo post?')">
                                @csrf
                                @method("DELETE")
                                <button type="submit" class="btn btn-danger">Elimina</button>
                            </form>
                        </td>
                    </tr>
                    @php
                        $i++;
                    @endphp
                @endforeach
            </tbody>
        </table>
        <div class="text-center">
            <button class="btn btn-success"><a class="text-decoration-none text-white" href="{{route('admin.posts.create')}}">Crea un nuovo post</a></button>
        </div>
    </div>
@endsection