@if ($project->exists)
    <form action="{{route('admin.projects.update', $project->id)}}" method="POST" enctype="multipart/form-data">
    @method('PUT')
@else
    <form action="{{route('admin.projects.store', $project->id)}}" method="POST" enctype="multipart/form-data">
@endif

    @csrf
    <div class="row">
        <div class="col-6">
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" name="title" class="form-control @error('title') is-invalid @elseif(old('title', '')) is-valid @enderror" id="title" placeholder="Title" value="{{old('title', $project->title)}}">
                @error('title')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
            </div>
        </div>
        <div class="col-6">
            <div class="mb-3">
                <label for="slug" class="form-label">Slug</label>
                <input type="text" name="slug" class="form-control" id="slug" value="{{Str::slug(old('title', $project->title))}}" disabled>
            </div>
        </div>
        <div class="col-11">
            <div class="mb-3">
                <label for="image" class="form-label">Image</label>
                <!-- Input Change image -->
                <div class="input-group @if(!$project->image) d-none @endif" id="previous-image-field">
                    <button class="btn btn-outline-secondary" type="button" id="change-image-button">Change Image</button>
                    <input type="text" class="form-control" value="{{old('image', $project->image)}}" disabled>
                </div>
                <!-- Input Select image -->
                <input type="file" name="image" class="form-control @if($project->image) d-none @endif @error('image') is-invalid @elseif(old('image', '')) is-valid @enderror" id="image" placeholder="http:// or https://">

                @error('image')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
            </div>
        </div>
        <div class="col-1 p-0">
            <div class="mb-3">
                <img src="{{asset('storage/' . old('image', $project->image) ?? 'https://marcolanci.it/boolean/assets/placeholder.png')}}" alt="{{$project->title}}" id="preview" class="img-fluid">
            </div>
        </div>
        <div class="col-12">
            <div class="mb-3">
                <label for="content" class="form-label">Content</label>
                <textarea name="content" class="form-control @error('content') is-invalid @elseif(old('content', '')) is-valid @enderror" id="content" placeholder="Content" rows="3">{{old('content', $project->content)}}</textarea>
                @error('content')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
            </div>
        </div>
    </div>
    <div class="d-flex align-items-center justify-content-end gap-2">
        <button type="submit" class="btn btn-success">Save</button>
        <button type="reset" class="btn btn-secondary">Empty the field</button>
    </div>
</form>
