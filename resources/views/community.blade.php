<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Community Forum</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
</head>
<body>

<header>
    @include('header_and_footer.header')
</header>

<div class="mt-1">
    <div class="row">
        <div class="col-md-12 text-center">
            <h3 class="card-title1 mt-2 mb-3">Welcome to Community Forum</h3>
            <img src="{{asset('images/community1.jpg')}}" class="img-fluid" alt="Community Image">
        </div>
    </div>

    {{-- <div class="container-fluid" style="padding: 0;">
        <div class="event-banner">
            <img src="images/communityBanner.png" alt="">
            <div class="banner-content">
                <h1 class="banner-text">Welcome to Community Forum!</h1>
            </div>
        </div>
    </div>  --}}

    <div class="container mt-5 mb-5">
        <!-- Posting -->
        <input type="text" class="form-control" id="postInput" placeholder="Click here to post something..." data-bs-toggle="modal" data-bs-target="#postModal" readonly>

        <!-- Modal -->
        <div class="modal fade" id="postModal" tabindex="-1" aria-labelledby="postModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-body">
                        <div style="text-align: center;">
                            <h1 for="header" class="form-name fs-5">Create Post</h1>
                        </div>
                        <form method="POST" action="{{ route('community.storePost') }}">
                            @csrf
                            <div class="form-group">
                                <textarea class="form-control" name="content" rows="15" placeholder="Post something here..."></textarea>
                            </div>
                            <div style="margin-top: 9px; text-align: right;">
                                <button style="margin-left:9px;" type="submit" class="btn btn-primary">Post</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Display Posts -->
        <div class="mt-4">
            @foreach ($posts->reverse() as $post)
                @if ($post->visible)
                    <div class="card mb-3">
                        <div class="card-body">
                            <!-- Profile Image and Name -->
                            <div class="d-flex align-items-center mb-3">
                                <img src="{{ asset('images/default.png') }}" alt="Profile Image" class="rounded-circle me-2" style="width: 40px; height: 40px;">
                                {{-- <h5 class="card-title">{{ $user->FName }} {{ $user->LName }}</h5> --}}
                                <h5 class="card-title">{{ $post->user->fname }} {{ $post->user->lname }}</h5>

                            </div>
                            <p>{{ $post->content }}</p>
                            <div>
                                <!-- Edit and Delete Post Buttons -->
                                <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#editPostModal{{ $post->id }}"><i class="fas fa-edit"></i> Edit Post</button>
                                <form action="{{ route('community.deletePost', $post) }}" method="POST" style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i> Delete Post</button>
                                </form>
                            </div>
                            <!-- Timestamp -->
                            <div class="text-muted mb-1 mt-1">Posted {{ $post->created_at->diffForHumans() }}</div>
                            
                            <!-- Likes -->
                            <div class="d-flex">
                                <form action="{{ route('community.like', $post->id) }}" method="POST">
                                    @csrf
                                    @if ($post->user_has_liked)
                                        <button class="custom-button btn btn-sm btn-outline-danger" type="submit">
                                            <i class="fas fa-heart"></i> {{ $post->likes_count }}
                                        </button>
                                    @else
                                        <button class="custom-button btn btn-sm btn-outline-danger" type="submit">
                                            <i class="fas fa-heart"></i> {{ $post->likes_count }}
                                        </button>
                                    @endif
                                </form>
                            </div>

                            <!-- Comment form -->
                            <details>
                                <summary class="btn btn-sm btn-outline-secondary"><i class="fas fa-comment"></i> Comment</summary>
                                <div class="comment-form">
                                    <form action="{{ route('community.comment', $post) }}" method="POST">
                                    @csrf
                                    <div class="form-group mt-2 mb-2">
                                        <textarea class="form-control" name="content" rows="3" required></textarea>
                                    </div>
                                        <div class="text-end mb-2">
                                            <button type="submit" class="btn btn-primary">Comment</button>
                                        </div>
                                    </form>
                                </div>
                                
                            
                            <!-- Display comments -->
                            <div style="margin-left: 18px;">
                                @foreach ($post->comments as $comment)
                                <div class="comment-container mb-3">
                                    <!-- Profile Image and Name -->
                                    <div class="d-flex align-items-center mb-1">
                                        <img src="{{ asset('images/default.png') }}" alt="Profile Image" class="rounded-circle me-2" style="width: 40px; height: 40px;">
                                        <h5 class="card-title">{{ Auth::user()->fname }} {{ Auth::user()->lname }}</h5>
                                    </div>
                                    <p>{{ $comment->content }}</p>
                                    <div class="mb-1">
                                        <!-- Edit and Delete Comment Buttons -->
                                        <button class="btn btn-sm btn-outline-secondary edit-comment-btn" data-bs-toggle="modal" data-bs-target="#editCommentModal{{ $comment->id }}">
                                            <i class="fas fa-edit"></i> Edit Comment</button>
                                        <form action="{{ route('community.deleteComment', $comment) }}" method="POST" style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i> Delete Comment</button>
                                        </form>
                                    </div>
                                    
                                    <!-- Timestamp -->
                                    <div class="text-muted">Posted {{ $comment->created_at->diffForHumans() }}</div>
                                </div>

                            <!-- Edit Comment Modal -->
                            <div class="modal fade" id="editCommentModal{{ $comment->id }}" tabindex="-1" aria-labelledby="editCommentModalLabel{{ $comment->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editCommentModalLabel{{ $comment->id }}">Edit Comment</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('community.updateComment', $comment) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="form-group">
                                                    <textarea class="form-control mb-3" id="commentContent{{ $comment->id }}" name="content" rows="15" required>{{ $comment->content }}</textarea>
                                                </div>
                                                <button type="submit" class="btn btn-primary">Save Changes</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                                @endforeach
                            </div>
                            </details>
                    </div>

                            <!-- Edit Post Modal -->
                            <div class="modal fade" id="editPostModal{{ $post->id }}" tabindex="-1" aria-labelledby="editPostModalLabel{{ $post->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editPostModalLabel{{ $post->id }}">Edit Post</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="POST" action="{{ route('community.updatePost', $post) }}">
                                            @csrf
                                            @method('PUT')
                                            <div class="mb-3">
                                                <textarea class="form-control" id="postContent{{ $post->id }}" name="content" rows="15">{{ $post->content }}</textarea>
                                            </div>
                                                <button type="submit" class="btn btn-primary">Save Changes</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
</div>

{{-- <footer>
    @include('header_and_footer.footer')
</footer> --}}


<!-- Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<!-- Font Awesome -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/js/all.min.js"></script>
</body>
</html>



<style>
    #postInput {
        height: 50px;
        border: 1px solid;
    }
    #text-center {
        font-family: Helvetica;
        color: #05A6ED;
        font-size: 35px;
        font-weight: bolder;
        height: 500px;
    }
    .form-group textarea {
        border: 1px solid;
    }
    .card{
        border: 1px solid;
    }
    .card-title1 {
        font-family: 'Helvetica', sans-serif;
        color: #05A6ED;
        text-align: center;
        font-weight: bolder;
        text-decoration: none;
    }
    .custom-button {
    margin-right: 10px;
    }
</style>
