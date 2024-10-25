@extends('superviseur.test')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Social Media Feed</title>
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"> -->
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Fil d'actualité</h1>
        <div class="d-flex flex-column align-items-center">
        @foreach($posts as $post)
    <div class="card mb-4" style="width: 100%; max-width: 600px;" >
        <div class="card-header">
            <h5 class="card-title">Admin</h5>
            <span class="text-muted">{{ $post->created_at->locale('fr')->isoFormat('D MMMM YYYY, H:mm') }}</span>
        </div>
        <div class="card-body">
            <!-- Post Text -->
            <p class="card-text">{{ $post->post_text }}</p>

            <!-- Conditionally display the Post Image if it exists -->
            @if($post->post_image)
            <div class="mt-3">
                <img src="{{ asset('storage/'.$post->post_image) }}" alt="Post Image" class="img-fluid rounded" style="height: 35vh; width: 90%;">
            </div>
            @endif
        </div>

        <!-- <div class="card-footer">
          
            <div class="d-flex justify-content-between">
                <div>
                    <span class="badge bg-primary">Agent: {{ ucfirst($post->agent) }}</span>
                    <span class="badge bg-secondary">Superviseur: {{ ucfirst($post->superviseur) }}</span>
                    <span class="badge bg-success">Partenaire: {{ ucfirst($post->partenaire) }}</span>
                </div>
                <button class="btn btn-outline-secondary btn-sm">Like</button>
                <button class="btn btn-outline-secondary btn-sm">Comment</button>
            </div>
        </div>
    </div> -->
    @endforeach
</div>

    </div>


    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
@endsection