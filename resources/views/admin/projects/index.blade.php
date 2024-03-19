@extends('layouts.app')

@section('title', 'Projects')

@section('content')
    <header>
        <h1>Projects</h1>
    </header>

    <hr>

    <table class="table table-dark table-striped">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Title</th>
            <th scope="col">Slug</th>
            <th scope="col">Created at</th>
            <th scope="col">Updated at</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
            @forelse ($projects as $project)
            <tr>
              <th scope="row">{{$project->id}}</th>
              <td>{{$project->title}}</td>
              <td>{{$project->slug}}</td>
              <td>{{$project->created_at}}</td>
              <td>{{$project->updated_at}}</td>
              <td>
                <div class="d-flex justify-content-end gap-2">
                    <a href="{{route('admin.projects.show', $project)}}" class="btn btn-sm btn-primary">
                        <i class="fas fa-eye"></i>
                    </a>

                    <a href="{{route('admin.projects.edit', $project->id)}}" class="btn btn-sm btn-warning">
                        <i class="fas fa-pencil"></i>
                    </a>
        
                    <form action="{{route('admin.projects.destroy', $project->id)}}" method="POST" class="delete-form">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger" type="submit">
                            <i class="fas fa-trash-can"></i>
                        </button>
                    </form>
                </div>
              </td>
            </tr>
                
            @empty
                <tr>
                    <td colspan="6">
                        <h3 class="text-center">Non ci sono post</h3>
                    </td>
                </tr>
            @endforelse
        </tbody>
      </table>

      @if ($projects->hasPages())
          {{$projects->links()}}
      @endif
@endsection

@section('scripts')
      @vite('resources/js/delete_confirmation.js')
@endsection