@extends('admin.test')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Creer un post </title>
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"> -->
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Créer un post </h1>

        <!-- Form to create a new post -->
        <form action="{{ route('save-post-admin') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="post_text" class="form-label"> Le texte du post</label>
                <textarea class="form-control" id="post_text" name="post_text" rows="3" required></textarea>
            </div>

            <div class="mb-3">
                <label for="post_image" class="form-label">L'image du post (optionnel)</label>
                <input class="form-control" type="file" id="post_image" name="post_image" accept="image/*" onchange="toggleMedia('image')">
            </div>
            <div class="mb-3">
                <label for="post_video" class="form-label">Vidéo du post (optionnel)</label>
                <input class="form-control" type="file" id="post_video" name="post_video" accept="video/*" onchange="toggleMedia('video')" >
            </div>

            <!-- Dropdown for 'agent' field -->
            <div class="mb-3">
                <label for="agent" class="form-label">Agent</label>
                <select class="form-select" id="agent" name="agent" required>
                    <option value="yes">OUI</option>
                    <option value="no">Non</option>
                </select>
            </div>

            <!-- Dropdown for 'superviseur' field -->
            <div class="mb-3">
                <label for="superviseur" class="form-label">Superviseur</label>
                <select class="form-select" id="superviseur" name="superviseur" required>
                    <option value="yes">OUI</option>
                    <option value="no">Non</option>
                </select>
            </div>

            <!-- Dropdown for 'partenaire' field -->
            <div class="mb-3">
                <label for="partenaire" class="form-label">Partenaire</label>
                <select class="form-select" id="partenaire" name="partenaire" required>
                    <option value="yes">OUI</option>
                    <option value="no">Non</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Créer le post</button>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    function toggleMedia(type) {
        const imageInput = document.getElementById('post_image');
        const videoInput = document.getElementById('post_video');

        if (type === 'image' && imageInput.files.length > 0) {
            videoInput.disabled = true;
        } else if (type === 'video' && videoInput.files.length > 0) {
            imageInput.disabled = true;
        } else {
            imageInput.disabled = false;
            videoInput.disabled = false;
        }
    }
</script>
</body>
</html>
@endsection