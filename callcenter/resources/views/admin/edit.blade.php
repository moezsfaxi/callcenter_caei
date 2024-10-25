@extends('admin.test')

@section('content')
<div class="container mt-5">
    <h1 class="text-center">modifier le Post</h1>

    <!-- Display validation errors -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('update-post', $post->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT') 
        
        <div class="mb-3">
            <label for="post_text" class="form-label">Post Text</label>
            <textarea id="post_text" name="post_text" class="form-control" rows="5">{{ old('post_text', $post->post_text) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="post_image" class="form-label">Post Image (Optional)</label>
            <input type="file" id="post_image" name="post_image" class="form-control">
            @if($post->post_image)
                <img src="{{ asset('storage/'.$post->post_image) }}" alt="Current Post Image" class="img-fluid mt-3" style="height: 10vh; width: auto;">
            @endif
        </div>

        <div class="mb-3">
            <label for="agent" class="form-label">Agent Statut</label>
            <select id="agent" name="agent" class="form-select">
                <option value="yes" {{ $post->agent == 'yes' ? 'selected' : '' }}>OUI</option>
                <option value="no" {{ $post->agent == 'no' ? 'selected' : '' }}>NON</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="superviseur" class="form-label">Superviseur Statut</label>
            <select id="superviseur" name="superviseur" class="form-select">
                <option value="yes" {{ $post->superviseur == 'yes' ? 'selected' : '' }}>OUI</option>
                <option value="no" {{ $post->superviseur == 'no' ? 'selected' : '' }}>NON</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="partenaire" class="form-label">Partenaire Statut</label>
            <select id="partenaire" name="partenaire" class="form-select">
                <option value="yes" {{ $post->partenaire == 'yes' ? 'selected' : '' }}>OUI</option>
                <option value="no" {{ $post->partenaire == 'no' ? 'selected' : '' }}>NON</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Mettre à jour</button>
      
    </form>
</div>
@endsection