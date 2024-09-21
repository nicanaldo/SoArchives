<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>
        @if (isset($user))
            @if ($user->usertypeID == 2)
                Seller |
            @elseif ($user->usertypeID == 3)
                Buyer |
            @endif
        @endif
        {{ $user->fname }} {{ $user->lname }}
    </title>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"
        integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>



    <!-- Rest of your template content -->
</head>

<body>


    <div class="container-fluid custom-shadow">

        @include('header_and_footer.header')


        <div class="container-fluid custom-shadow-profile">
            <div class="container cover">
                <div class="header__wrapper d-flex justify-content-center">
                    <img src="{{ asset($user->cover_photo ? 'storage/cover_photos/' . $user->id . '/' . basename($user->cover_photo) : 'images/finalcover.png') }}"
                        alt="..." />
                </div>
            </div>


            {{-- Profile Picture --}}
            <div class="container d-flex justify-content-center align-items-center">
                <div class="img__container">
                    <img src="{{ asset($user->profile_photo ? 'storage/profile_photos/' . $user->id . '/' . basename($user->profile_photo) : 'images/defuser.png') }}"
                        alt="Profile Picture" class="border-white thick-border-buyer" />
                    <span></span>
                </div>
            </div>


            {{-- Tags --}}
            <div class="name text-center">
                <h2 class="card-title text-center d-inline-block mb-3" style="color:#343434;">
                    {{ $user->fname }} {{ $user->lname }}
                
                </h2>
                <div class="pb-5">
                    {{-- <button type="button" class="btn btn-primary btn-rounded border-0 me-1" style="background: linear-gradient(45deg, #6a11cb, #2575fc);" data-mdb-ripple-init><i class="fas fa-hand-sparkles"></i> Commend</button> --}}

                    <form id="commend-form" method="POST" action="{{ route('buyer-commend.store') }}">
                        @csrf
                        <input type="hidden" name="userID" value="{{ auth()->id() }}">
                        <input type="hidden" name="commend_userID" value="{{ $commend_userID }}">
                        <button type="submit" class="btn btn-primary btn-rounded border-0 me-1" style="background: linear-gradient(45deg, #6a11cb, #2575fc);" data-mdb-ripple-init><i class="fas fa-hand-sparkles"></i> Commend</button>
                    </form>
                    <br>
                    
                            <a href="{{ route('chatify') }}" class="btn btn-outline-dark btn-rounded me-1" data-mdb-ripple-init>
                                <i class="fas fa-message"></i> Message
                            </a>
                            

                    {{-- <button type="button" class="btn btn-warning btn-rounded text-white me-2" data-mdb-ripple-init><i
                        class="fas fa-star"></i> </button> --}}
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-danger btn-rounded me-1" data-bs-toggle="modal"
                        data-bs-target="#reportModal">
                        <i class="fas fa-exclamation-circle"></i>
                    </button>

                    <!-- Report Modal -->
                    <div class="modal fade" id="reportModal" tabindex="-1" aria-labelledby="reportModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="reportModalLabel">Report User</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>


                                <div class="modal-body">
                                    <form id="reportForm" novalidate>
                                        <div class="mb-3">
                                            <h6 class="text-start">Reason for reporting</h6>
                                            <select class="form-select" id="reportReason" required>
                                                <option value="" disabled selected>Select a reason</option>
                                                <option value="spam">Spam or Fake Content</option>
                                                <option value="harassment">Harassment or Abusive Behavior</option>
                                                <option value="hate-speech">Hate Speech or Discrimination</option>
                                                <option value="misinformation">Misinformation or Fake News</option>
                                                <option value="violence">Violence or Threats</option>
                                            </select>
                                            <div class="invalid-feedback text-start">
                                                Please select a reason for reporting
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <h6 class="text-start">Additional details (optional)</h6>
                                            <textarea class="form-control" id="reportDetails" rows="2"></textarea>
                                        </div>

                                        <div class="col-12">
                                            <div class="alert alert-secondary alert-dismissible fade show"
                                                role="alert">
                                                <h5 class="alert-heading text-start">
                                                    &#x1F6A8; Report Reminder
                                                </h5>
                                                <p class="text-start">
                                                    Please provide a valid reason when reporting a user. Ensure you are
                                                    not
                                                    making false claims or reporting out of spite. Use the report
                                                    function
                                                    responsibly to help us maintain a respectful community.
                                                </p>
                                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                    aria-label="Close"></button>
                                            </div>
                                        </div>


                                        <div class="d-flex justify-content-end">
                                            <button type="button" class="btn btn-secondary me-2"
                                                id="discardButton">Discard</button>
                                            <button type="submit" class="btn btn-danger">Submit Report</button>
                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>

                    <!-- Bootstrap JS -->
                    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
                        integrity="sha384-oBqDVmMz4fnFO9yp0TO/kx1EBc0g2L0z9e6D36kkA1OwhwB25NO3d2MCm8fLEd2F" crossorigin="anonymous">
                    </script>
                    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
                        integrity="sha384-pprnP5s9N9tB9P8t1gV4Rtb/x5V2x5OoF2QW+Lnw+Ob+RfU1lFqU1Kqln5KH+cU2" crossorigin="anonymous">
                    </script>
                    <!-- MDB JS -->
                    <script src="https://cdn.jsdelivr.net/npm/mdbootstrap@5.0.0/dist/js/mdb.min.js"></script>

                </div>

            </div>

        </div>

        <div class="container mt-5 mb-5 " style="padding: 2rem;">

            <div class="row">
                <!-- Left Side Container -->
                <div class="col-md-4 mb-3">
                    <div class="custom-shadow p-4 d-flex flex-wrap justify-content-center">
                        <div class="text-muted small text-center align-self-center m-2">
                            <h2> {{ $commendCount }} </h2>
                            <span class=" d-sm-inline-block">
                                <h5>Commendations</h5>
                            </span>
                        </div>
                        <div class="text-muted small text-center align-self-center m-2">
                            <h2> {{ $feedbackCount}} </h2>
                            <span class=" d-sm-inline-block">
                                <h5>Feedbacks</h5>
                            </span>
                        </div>
                    </div>
                </div>


                <div class="col-md-8 mb-3">
                 


                

                    <div class="container custom-shadow">
                        <div class="feedbacks">
                            <h2 style="color: #145DA0;" class="p-3 pt-4">Feedbacks</h2>
                        </div>
                        <div id="feedbackCarousel" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                @if($feedbacks->isEmpty())
                                    <div class="carousel-item active">
                                        <div class="container custom-shadow p-3">
                                            <div class="row">
                                                <div class="col-12">
                                                    <p class="mb-1">No feedbacks available yet.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    @foreach ($feedbacks as $key => $feedback)
                                        <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                            <div class="container custom-shadow p-3">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <!-- Star Rating -->
                                                        <div class="mb-2">
                                                            @for($i = 1; $i <= 5; $i++)
                                                                <i class="fa fa-star{{ $i <= $feedback->rating ? '' : '-o' }}" style="color: #ffc107; font-size: 20px; cursor: pointer;"></i>
                                                            @endfor
                                                        </div>
                                                        <!-- Feedback Content -->
                                                        <p class="mb-1">{{ $feedback->feedback }}</p>
                                                        <!-- User and Timestamp -->
                                                        <p class="text-muted mb-0">- {{ $feedback->user->name ?? 'Anonymous' }}</p>
                                                        <p class="text-muted small">Posted on: {{ $feedback->created_at->format('F d, Y') }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
    
                            <!-- Carousel Controls -->
                            <button class="carousel-control-prev" type="button" data-bs-target="#feedbackCarousel" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#feedbackCarousel" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                    </div>

                    <!-- Feedback Form -->
                    <div class="container custom-shadow mt-5 p-4">
                        <h3 style="color: #145DA0;">Write Your Feedback</h3>
                        <form action="{{ route('buyer.ratings') }}" method="post">
                            @csrf
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            {{-- <input type="hidden" name="userID" value="{{ auth()->id() }}"> <!-- Add this line --> --}}
                            <input type="hidden" name="feedback_userID" value="{{ $feedbacks_userID }}">

                            <div class="mb-3">
                                <label class="form-label">Rating</label>
                                <div class="d-flex">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <i class="fa fa-star rating-star" data-rating="{{ $i }}"
                                            style="color: #ccc; font-size: 24px;"></i>
                                    @endfor
                                    <input type="hidden" name="rating" id="rating" value="0">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="feedbackText" class="form-label">Your Feedback</label>
                                <textarea id="feedbackText" name="feedback" class="form-control" rows="4" required></textarea>
                                <div class="col-12 mt-3">
                                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                        <h5 class="alert-heading text-start">
                                            &#x1F4DD; Feedback Reminder
                                        </h5>
                                        <p class="text-start">
                                            Please ensure your feedback is constructive and respectful. Honest and
                                            thoughtful feedback helps us improve our products and services. Avoid using
                                            inappropriate language or personal attacks. Thank you for contributing to
                                            our community!
                                        </p>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-warning text-white"
                                style="padding: 10px 20px; font-size: 16px;">
                                <i class="fa fa-paper-plane" style="margin-right: 8px;"></i> Submit Feedback
                            </button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
    </div>

    <script>
        // Star
        $('.rating-star').on('click', function() {
                    var rating = $(this).data('rating');
                    $('#rating').val(rating);
                    $('.rating-star').each(function() {
                        if ($(this).data('rating') <= rating) {
                            $(this).css('color', '#ffc107');
                        } else {
                            $(this).css('color', '#ccc');
                        }
                    });
                });
    </script>

    <footer>
        @include('header_and_footer.footer')
    </footer>

    <!-- multiple upload of image -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>
