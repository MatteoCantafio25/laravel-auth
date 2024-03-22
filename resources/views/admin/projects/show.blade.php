@extends('layouts.app')

@section('title', 'Projects')

@section('content')
    <header>
        <h1 class="my-5">{{$project->title}}</h1>
    </header>

    <hr>

    <div class="clearfix">
        @if ($project->image)
            <img src="{{$project->printImage()}}" alt="{{$project->title}}" class="me-2 float-start" style="max-width: 500px"> <!-- style provvisorio-->
        @endif
        <p>{{$project->content}}</p>
        <div>
            <strong>Created at:</strong> {{$project->created_at}}
            <strong>Updated at:</strong> {{$project->updated_at}}
        </div>
    </div>

    <hr>

    <footer class="d-flex align-items-center justify-content-between">
        <a href="{{route('admin.projects.index')}}" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-2"></i> Go back
        </a>

        <div class="d-flex justify-content-between gap-2">
            <a href="{{route('admin.projects.edit', $project->id)}}" class="btn btn-warning">
                <i class="fas fa-pencil me-2"></i>Modifica
            </a>

            <form action="{{route('admin.projects.destroy', $project->id)}}" method="POST" class="delete-form">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger" type="submit">
                    <i class="fas fa-trash-can me-2"></i>Elimina
                </button>
            </form>
        </div>
    </footer>

@endsection

@section('scripts')
      @vite('resources/js/delete_confirmation.js')
@endsection