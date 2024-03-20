@extends('layouts.app')

@section('title', 'Create Project')

@section('content')

<header>
    <h1>New Project</h1>
</header>

<hr>

<div class="container">
    <div class="d-flex align-items-center justify-content-between p-3">
        <h1 class="mb-0">Create new project</h1>
        <a class="btn btn-secondary" href="{{route('admin.projects.index')}}">Go Back</a>
    </div>
    <div class="p-3">
        <!-- Form -->
        @include('includes.projects.form')

    </div>
</div>

@endsection

@section('scripts')
    @vite('resources/js/image_preview.js')

    @vite('resources/js/progressive_slug.js')
@endsection