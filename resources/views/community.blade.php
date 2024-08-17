<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Community Forum</title>

    {{-- Tab Logo --}}
    <link rel="shortcut icon" href="{{ asset('images/tab-logo.ico') }}" type="image/x-icon">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    {{-- CSS file under Public Folder --}}
    <link rel="stylesheet" href="{{ asset('css/community.css') }}" />
</head>

<body>

    {{-- Navbar --}}
    <header>
        @include('header_and_footer.header')
    </header>


    <div class="banner" style="background-image: url('images/forr.png'); height:400px"></div>

    <div class="mt-1">
        <div class="row">
        </div>
        <div class="container col-lg-6 mb-4" style="margin-top: -5rem; ">
            <h2 class="title card-title1 mt-5 mb-2">Welcome to Community Forum</h2>
        </div>
        <div class="container col-lg-6 mb-5">

            {{-- Posting --}}
            <div class="actions d-flex justify-content-between mb-2">
                <button id="postButton" class="btn btn-primary w-20" data-bs-toggle="modal" data-bs-target="#postModal">
                    + New Post
                </button>
                <button class="btn btn-outline-secondary ms-2" id="filterButton">
                    <i class="fas fa-filter"></i> Filter Topics
                </button>
            </div>

            {{-- New Post Modal --}}
            <div class="modal fade" id="postModal" tabindex="-1" aria-labelledby="postModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="postModalLabel">Create Post</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="postForm" method="POST" action="{{ route('community.storePost') }}">
                                @csrf

                                {{-- Title Input Field --}}
                                {{-- <div class="mb-3">
                                        <label for="title" class="form-label">Title</label>
                                        <input type="text" class="form-control" id="title" name="title" placeholder="Enter the post title" required>
                                    </div> --}}


                                {{-- Rich Text Editor: hindi pa nagrereflect sa post --}}
                                <div class="mb-3">
                                    <label for="content" class="form-label"></label>
                                    <div id="quillEditor" style="height: 300px;"></div>
                                    <input type="hidden" name="content" id="hiddenContent">
                                </div>


                                <div class="text-end">
                                    <button type="submit" class="btn btn-primary">Post</button>
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Include Quill -->
            <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
            <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
            <script>
                // Initialize Quill editor
                var quill = new Quill('#quillEditor', {
                    theme: 'snow',
                    modules: {
                        toolbar: [
                            [{
                                'header': [1, 2, false]
                            }],
                            ['bold', 'italic', 'underline'],
                            [{
                                'list': 'ordered'
                            }, {
                                'list': 'bullet'
                            }],
                            ['clean'] // remove formatting button
                        ]
                    }
                });

                // Set hidden input with editor content on form submit
                document.getElementById('postForm').addEventListener('submit', function(event) {
                    var content = quill.root.innerHTML;
                    document.getElementById('hiddenContent').value = content;

                    // Debug: Log the content to ensure it's being set
                    console.log('Content to be sent:', content);

                    // Optionally: Prevent default behavior to test if content is properly set
                    // event.preventDefault();
                });
            </script>

            <!-- Display Posts -->
            <div class="mt-4">
                @foreach ($posts->reverse() as $post)
                    @if ($post->visible)
                        <!-- Card with clickable functionality -->
                        <div class="card border-0 mb-3 position-relative" style="cursor: pointer;">
                            <div class="card-body">
                                <!-- Profile Image and Name -->
                                <div class="d-flex align-items-center mb-3">
                                    <img src="{{ asset('images/def.png') }}" alt="Profile Image"
                                        class="rounded-circle me-2" style="width: 40px; height: 40px;">
                                    <div class="d-flex flex-column">
                                        <h6 class="card-title mb-0">{{ $post->user->fname }} {{ $post->user->lname }}
                                        </h6>
                                        <span class="text-muted small">{{ $post->created_at->diffForHumans() }}</span>
                                    </div>
                                </div>

                                <!-- Post Title -->
                                {{-- <h4 class="card-title"
                                    style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                    {!! $post->title !!}
                                </h4> --}}

                                <!-- Post Display-->
                                <p>{!! $post->content !!}</p>

                                <!-- Like and Comment Buttons Row -->
                                <div class="d-flex align-items-center">
                                    <!-- Like Button -->
                                    <form action="{{ route('community.like', $post->id) }}" method="POST"
                                        style="display: inline-block;">
                                        @csrf
                                        @php
                                            $isLiked = $post->likes->contains('user_id', auth()->id());
                                        @endphp
                                        <button
                                            class="btn btn-sm me-2 border-0 {{ $isLiked ? 'btn-outline-success' : 'btn-outline-secondary' }}"
                                            type="submit">
                                            <i class="fas fa-thumbs-up"></i> {{ $post->likes_count }}
                                        </button>
                                    </form>




                                    {{-- Comment Button --}}
                                    <button class="btn btn-sm btn-outline-secondary border-0" data-bs-toggle="collapse"
                                        data-bs-target="#commentsSection{{ $post->id }}">
                                        <i class="fas fa-comment"></i>
                                        <span class="comment-count">{{ $post->comments->count() }}</span>
                                    </button>
                                </div>

                                <!-- Comment Section (collapsible) -->
                                <div class="collapse mt-4" id="commentsSection{{ $post->id }}">



                                    {{-- Comment Form --}}
                                    <div class="comment-form">
                                        <form action="{{ route('community.comment', $post) }}" method="POST">
                                            @csrf
                                            <div class="form-group mt-2 mb-2">
                                                <textarea class="form-control" name="content" rows="2" placeholder="Write your comment here..." required></textarea>
                                            </div>
                                            <div class="text-end mb-2">
                                                <button type="submit" class="btn btn-primary">Comment</button>
                                            </div>
                                        </form>
                                    </div>


                                    <!-- Display Comments -->
                                    <div style="margin-left: 18px;">
                                        @forelse ($post->comments as $comment)
                                            <div class="comment-container mb-3 position-relative">
                                                <div class="d-flex align-items-center mb-1">
                                                    <!-- Reply Icon -->
                                                    <div class="me-2">
                                                        <button
                                                            class="btn btn-outline-secondary btn-sm border-0 disabled"
                                                            style="border-radius: 50%; padding: 0; width: 30px; height: 30px;">
                                                            <i class="fas fa-reply flip-icon"></i>
                                                        </button>
                                                    </div>

                                                    <!-- Profile Image -->
                                                    <img src="{{ asset('images/def.png') }}" alt="Profile Image"
                                                        class="rounded-circle me-2"
                                                        style="width: 40px; height: 40px;">

                                                    <!-- User Info -->
                                                    <div class="d-flex flex-column">
                                                        <h6 class="mb-0">{{ Auth::user()->fname }}
                                                            {{ Auth::user()->lname }}</h6>
                                                        <span
                                                            class="text-muted small">{{ $comment->created_at->diffForHumans() }}</span>
                                                    </div>

                                                    <!-- Edit and Delete Comment Buttons -->
                                                    <div class="ms-auto">
                                                        <button class="btn btn-sm btn-outline-primary border-0"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#editCommentModal{{ $comment->id }}">
                                                            <i class="fas fa-edit"></i>
                                                        </button>
                                                        <form
                                                            action="{{ route('community.deleteComment', $comment) }}"
                                                            method="POST" style="display: inline-block;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="btn btn-sm btn-outline-danger border-0">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>

                                                <p class="mt-3 ms-5 mb-5">{{ $comment->content }}</p>
                                            </div>

                                            <!-- Edit Comment Modal -->
                                            <div class="modal fade" id="editCommentModal{{ $comment->id }}"
                                                tabindex="-1"
                                                aria-labelledby="editCommentModalLabel{{ $comment->id }}"
                                                aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title"
                                                                id="editCommentModalLabel{{ $comment->id }}">Edit
                                                            </h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form
                                                                action="{{ route('community.updateComment', $comment) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('PUT')
                                                                <div class="form-group">
                                                                    <textarea class="form-control mb-3" id="commentContent{{ $comment->id }}" name="content" rows="15" required>{{ $comment->content }}</textarea>
                                                                </div>
                                                                <button type="submit" class="btn btn-primary">Save
                                                                    Changes</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @empty
                                            <!-- No Comments Message -->
                                            <p class="text-muted">No comments yet</p>
                                        @endforelse
                                    </div>

                                </div>

                                <!-- Edit Post Modal -->
                                <div class="modal fade" id="editPostModal{{ $post->id }}" tabindex="-1"
                                    aria-labelledby="editPostModalLabel{{ $post->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editPostModalLabel{{ $post->id }}">
                                                    Edit Post</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form method="POST"
                                                    action="{{ route('community.updatePost', $post) }}">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="mb-3">
                                                        <textarea class="form-control" id="postContent{{ $post->id }}" name="content" rows="15">{{ $post->content }}</textarea>
                                                    </div>
                                                    <button type="submit" class="btn btn-primary">Save
                                                        Changes</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>



                                {{-- Wala pang topics, ui lang to --}}


                                <!-- Topic Tags and Edit/Delete Post Buttons -->
                                <div
                                    class="d-flex justify-content-end align-items-start position-absolute top-0 end-0 p-3">
                                    <div>
                                        @if ($post->tags && $post->tags->count() > 0)
                                            @foreach ($post->tags as $tag)
                                                <span class="badge bg-secondary">{{ $tag->name }}</span>
                                            @endforeach
                                        @else
                                            <span class="badge bg-light text-dark p-2 fw-normal">Topic Tag</span>
                                        @endif
                                    </div>
                                    <div class="ms-2">
                                        <button class="btn btn-sm btn-outline-primary border-0" data-bs-toggle="modal"
                                            data-bs-target="#editPostModal{{ $post->id }}">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <form action="{{ route('community.deletePost', $post) }}" method="POST"
                                            style="display: inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger border-0">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>

        </div>

        <footer>
            @include('header_and_footer.footer')
        </footer>

        <!-- Bootstrap Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Font Awesome -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/js/all.min.js"></script>

</body>

</html>
