<!DOCTYPE html>
<html lang="en">

<head>
    <!-- CSS Links -->
    <link href="{{ asset('css/maindash.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.bootstrap5.min.css">


    <!-- Meta -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Title -->
    <title>Profile Management</title>

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/settings.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('responsive.css') }}"> --}}
</head>

<body>


    @include('header_and_footer.header')


    <!-- Main Container -->
    <div class="container my-5">
        <div class="row">
            <div class="col-md-3">
                <div class="list-group">
                    <h6 class="ps-3"><strong><i class="fas fa-engine"></i>PROFILE SETTINGS</strong></h6>
                    <button class="list-group-item list-group-item-action active" id="update-profile-btn">Change
                        Profile Name</button>
                    <button class="list-group-item list-group-item-action" id="change-password-btn">Change
                        Password</button>
                    <button class="list-group-item list-group-item-action" id="manage-subs-btn">Subscription</button>
                </div>
            </div>

            <!-- Profile Sections -->
            <div class="col-md-9 shadow p-5">

                <!-- Update Profile Section -->
                <section id="update-profile">
                    <h2 class="mb-5 fw-bold">Change Profile Name</h2>
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('updateProf') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="fname" class="form-label">First Name</label>
                            <input type="text" class="form-control" id="fname"
                                value="{{ old('fname', Auth::user()->fname) }}" name="fname">
                        </div>
                        <div class="mb-3">
                            <label for="lname" class="form-label">Last Name</label>
                            <input type="text" class="form-control" id="lname"
                                value="{{ old('lname', Auth::user()->lname) }}" name="lname">
                        </div>
                        <button type="submit" class="btn button-primary btn-sm mt-2">Save Changes</button>
                    </form>
                </section>

                <!-- Change Password Section -->
                <section id="change-password" style="display: none;">
                    <h2 class="mb-5 fw-bold">Change Password</h2>
                    <form method="POST" action="{{ route('updateAcc') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="old_password" class="form-label">Old Password</label>
                            <input type="password" name="old_password"
                                class="form-control @error('old_password') is-invalid @enderror" id="old_password"
                                autocomplete="off">
                            @error('old_password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="new_password" class="form-label">New Password</label>
                            <input type="password" name="new_password"
                                class="form-control @error('new_password') is-invalid @enderror" id="new_password"
                                autocomplete="off">
                            @error('new_password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="new_password_confirmation" class="form-label">Confirm New Password</label>
                            <input type="password" name="new_password_confirmation" class="form-control"
                                id="new_password_confirmation" autocomplete="off">
                        </div>

                        <button type="submit" class="btn button-primary btn-sm mt-2">Save Changes</button>
                    </form>
                </section>

                <!-- Manage Photo Section (Placeholder) -->
                <section id="manage-subs" style="display: none;">
                    <h2 class="mb-5 fw-bold">Subscription</h2>
                    <!-- Placeholder content for managing profile photo -->
                    <p>Content to manage profile photo goes here.</p>
                </section>

                <!-- Section Toggle Script -->
                <script>
                    document.addEventListener("DOMContentLoaded", function() {
                        const updateProfileBtn = document.getElementById('update-profile-btn');
                        const changePasswordBtn = document.getElementById('change-password-btn');
                        const managePhotoBtn = document.getElementById('manage-subs-btn');

                        const updateProfileSection = document.getElementById('update-profile');
                        const changePasswordSection = document.getElementById('change-password');
                        const managePhotoSection = document.getElementById('manage-subs');

                        function hideAllSections() {
                            updateProfileSection.style.display = 'none';
                            changePasswordSection.style.display = 'none';
                            managePhotoSection.style.display = 'none';
                        }

                        updateProfileBtn.addEventListener('click', function() {
                            hideAllSections();
                            updateProfileSection.style.display = 'block';
                            setActiveButton(this);
                        });

                        changePasswordBtn.addEventListener('click', function() {
                            hideAllSections();
                            changePasswordSection.style.display = 'block';
                            setActiveButton(this);
                        });

                        managePhotoBtn.addEventListener('click', function() {
                            hideAllSections();
                            managePhotoSection.style.display = 'block';
                            setActiveButton(this);
                        });

                        function setActiveButton(button) {
                            document.querySelectorAll('.list-group-item').forEach(btn => btn.classList.remove('active'));
                            button.classList.add('active');
                        }

                        // Initialize with Update Profile section
                        hideAllSections();
                        updateProfileSection.style.display = 'block';
                    });
                </script>

                <!-- Bootstrap JS -->
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
                    integrity="sha512-a6ctI6w1kg3J4dSjknHj3aWLEbjitAXAjLDRUxo2wyYmDFRcz2RJuQr5M3Kt8O/TtUSp8n2rAyaXYy1sjoKmrQ=="
                    crossorigin="anonymous"></script>
            </div>
        </div>
    </div>
</body>

</html>
