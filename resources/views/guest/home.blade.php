@extends('layouts.app')

@section('title', 'Home')

@section('content')

<header>
    <h1>Boolfolio</h1>
    <h3>Discover my projects</h3>

    <!-- Paginazione -->
    @if ($projects->hasPages())
          {{$projects->links()}}
    @endif

</header>

    <hr>

    @forelse ($projects as $project)
        <div class="card my-5">
            <div class="card-header">
                {{$project->title}}
            </div>
            <div class="card-body">
                <div class="row">
                    @if($project->image)
                        <div class="col-3">
                            <img src="{{$project->printImage()}}" alt="{{$project->title}}" style="max-width: 300px"> <!-- style provvisorio -->
                        </div>
                    @endif
                    <div class="col">
                        <h5 class="card-title mb-3">{{$project->title}}</h5>
                        <h6 class="card-subtitle mb-2 text-body-secondary">{{$project->created_at}}</h6>
                        <p class="card-text">{{$project->content}}</p>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <h3 class="text-center">There are no projects yet</h3>
    @endforelse

@endsection