@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    Benvenuto {{ Auth::user()->name}}!
                    <hr>
                    <div>
                        <button type="button" class="btn btn-primary"><a class="text-white text-decoration-none" href="{{route('admin.posts.index')}}">Visualizza i tuoi post</a></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
