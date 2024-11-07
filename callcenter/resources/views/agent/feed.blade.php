@extends('agent.test')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Social Media Feed</title>
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"> -->
     <style>
        .wording {
  max-width: 100% !important;
  word-wrap: break-word !important;
  text-overflow: hidden;
  white-space: normal !important;
}

.comment-content {
  max-width: 400px;
  overflow-wrap: break-word;
}
     </style>

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
            @if($post->post_video)
            <div class="mt-3">
                <video controls style="width: 100%; max-height: 300px;">
                    <source src="{{ asset('storage/'.$post->post_video) }}" type="video/mp4">
                     Your browser does not support the video tag.
                </video>
            </div>
            @endif
        </div>
                            <!-- comment and likes-->
                             <!-- Like Button -->
        <!-- Like Button (with AJAX form class) -->
        <form action="{{ route('post.like', $post->id) }}" method="POST" class="like-post">
            @csrf
            <input type="hidden" name="post_id" value="{{ $post->id }}">
            <!-- <button type="submit" class="btn btn-outline-primary">
                {{ $post->likes->count() }} Likes
            </button> -->
            <button type="submit" onclick="toggleLikeButton(this)" class="btn  {{ auth()->user()->hasLiked($post) ? 'btn-primary' : '' }}">
        <i class="fas fa-thumbs-up"></i> 
        {{ $post->likes->count() }} Like(s)
    </button>
        </form>

<div class="comments-section">
    @foreach($post->comments as $comment)
        <div class="mb-2 d-flex justify-content-between">
            <!-- Comment section layout -->
            <div class="d-flex align-items-center">
                <!-- Profile Image -->
                <img src="{{ asset('storage/' . ($comment->user->image_de_profil ?? 'default-profile-image.jpg')) }}" 
                     alt="Profile Image" 
                     class="rounded-circle" 
                     style="width: 40px; height: 40px; margin-right: 10px;">

                <!-- Comment Content -->
                <div class="comment-content" >
                    <strong>{{ $comment->user->name }}</strong>
                    <p class="wording">{{ $comment->content }}</p>
                </div>
            </div>

            <!-- Formatted Date -->
            <small class="text-muted">{{ $comment->created_at->locale('fr')->isoFormat('D MMMM YYYY, H:mm') }}</small>
        </div>
    @endforeach
</div>






        <!-- Comment Form (with AJAX form class) -->
        <form action="{{ route('post.comment', $post->id) }}" method="POST" class="comment-form">
            @csrf
            <input type="hidden" name="post_id" value="{{ $post->id }}">
            <div class="form-group mt-2">
                <textarea name="content" class="form-control" rows="2" placeholder="Add a comment..." required></textarea>
            </div>
            <button type="submit" class="btn btn-primary mt-2">Comment</button>
        </form>
    

                            <!-- end comment and likes-->









    @endforeach
</div>

    </div>


    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <script>
    $(document).ready(function() {
        // Handle Like button click
        $('form.like-post').on('submit', function(e) {
            e.preventDefault(); // Prevent form submission

            var $form = $(this);
            var postId = $form.find('input[name="post_id"]').val(); // Get the post ID


            $.ajax({
                url: `/post/${postId}/like`, // Directly construct the URL with postId
                type: 'POST',
                data: {
                    _token: "{{ csrf_token() }}", // CSRF token
                    post_id: postId // Send post ID
                },
                success: function(response) {
                    if (response.status == 'liked') {
                        $form.find('button').text(parseInt($form.find('button').text()) + 1 + " Likes");
                    } else {
                        $form.find('button').text(parseInt($form.find('button').text()) - 1 + " Likes");
                    }
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        });

        // Handle Comment form submission
        $('form.comment-form').on('submit', function(e) {
            e.preventDefault(); // Prevent form submission

            var $form = $(this);
            var postId = $form.find('input[name="post_id"]').val(); // Get post ID
            //console.log("post id =",postId);
            var content = $form.find('textarea[name="content"]').val(); // Get comment content

            $.ajax({
                url: `/post/${postId}/comment`, // Directly construct the URL with postId
                type: 'POST',
                data: {
                    _token: "{{ csrf_token() }}", // CSRF token
                    content: content // Send comment content
                },
                success: function(response) {
                    
                    var date = new Date(response.comment.created_at);
                    var formattedDate = date.toLocaleString('fr-FR', {
                        day: 'numeric',
                        month: 'long',
                        year: 'numeric',
                        hour: '2-digit',
                        minute: '2-digit'
                    });
                    var userProfileImage = response.image_de_profil ? '/storage/' + response.image_de_profil: '/path/to/default-profile-image.jpg'; // Use a default image if none exists
    



                    var newComment = '<div class="mb-2 d-flex justify-content-between">' +
                     '<div class="d-flex align-items-center">' +
                     '<img src="' + userProfileImage + '" alt="Profile Image" class="rounded-circle" style="width: 40px; height: 40px; margin-right: 10px;">' +
                     '<div>' +
                     '<strong>' + response.name + '</strong>' +
                     '<p>' + response.comment.content + '</p>' +
                     '</div>' +
                     '</div>' +
                     '<span class="text-muted">' + formattedDate + '</span>' +
                     '</div>';
                   
                   
                   
                    $form.closest('.card').find('.comments-section').first().append(newComment);

                    
                    $form.find('textarea').val('');
                    

                    var currentCommentCount = parseInt($form.closest('.card').find('.comments-count').first().text());
                    console.log(currentCommentCount);
                    $form.closest('.card').find('.comments-count').first().text(currentCommentCount + 1);


                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        });
    });
</script>
<script>
function toggleLikeButton(button) {
    button.classList.toggle('btn-primary'); // Toggle the 'btn-primary' class
    // You can also add or remove other classes as needed
}
</script>



</body>
</html>
@endsection