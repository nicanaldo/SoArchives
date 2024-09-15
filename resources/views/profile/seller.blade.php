 {{-- Cover Photo --}}
            <div class="container-fluid custom-shadow-profile">
                <div class="container cover">
                    <div class="header__wrapper d-flex justify-content-center position-relative">
                        <img id="coverImage"
                            src="{{ asset($user->cover_photo ? 'storage/cover_photos/' . $user->id . '/' . basename($user->cover_photo) : 'images/finalcover.png') }}"
                            alt="Cover Photo" class="cover-photo" />
                        <div class="upload-overlay d-flex flex-column align-items-center">
                            <input type="file" id="coverUpload" accept="image/*" style="display: none;" />
                            <button type="button" class="btn btn-light mt-2" id="uploadButton"><i
                                    class="fas fa-upload"></i> Change Cover
                                Photo</button>
                            <button type="button" class="btn btn-primary mt-2" id="saveButton"
                                style="display: none;">Save</button>
                            <button type="button" class="btn btn-danger mt-2" id="deleteButton"><i
                                    class="fas fa-trash"></i> Delete</button>
                        </div>
                    </div>
                </div>




                {{-- Profile Picture --}}
                <div class="container d-flex justify-content-center align-items-center">
                    <div class="img__container position-relative thick-border-container">
                        <img id="profileImage"
                            src="{{ asset($user->profile_photo ? 'storage/profile_photos/' . $user->id . '/' . basename($user->profile_photo) : 'images/defuser.png') }}"
                            alt="Profile Picture" class="thick-border profile-picture" />

                        <!-- Hover Overlay for Uploading a New Profile Picture -->
                        <div
                            class="profile-upload-overlay d-flex flex-column align-items-center justify-content-center">
                            <input type="file" id="profileUpload" accept="image/*" style="display: none;" />
                            <button type="button" class="btn btn-light" id="profileUploadButton"><i
                                    class="fas fa-upload"></i> Change</button>
                            <button type="button" class="btn btn-success mt-2" id="profileSaveButton"
                                style="display: none;">Save</button>
                            <button type="button" class="btn btn-danger mt-2" id="profileDeleteButton"> <i
                                    class="fas fa-trash"></i> Delete</button>
                        </div>
                    </div>
                </div>

                <script>
                    // Cover Photo Upload and Actions
                    let originalCoverImageSrc = document.getElementById('coverImage').src;

                    document.getElementById('uploadButton').addEventListener('click', function() {
                        document.getElementById('coverUpload').click();
                    });

                    document.getElementById('coverUpload').addEventListener('change', function(event) {
                        const file = event.target.files[0];
                        if (file) {
                            const reader = new FileReader();
                            reader.onload = function(e) {
                                document.getElementById('coverImage').src = e.target.result;
                                document.getElementById('saveButton').style.display = 'block'; // Show save button
                            };
                            reader.readAsDataURL(file);
                        }
                    });

                    document.getElementById('saveButton').addEventListener('click', function() {
                        Swal.fire({
                            title: 'Are you sure?',
                            text: 'Do you want to save this cover photo?',
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Yes, save it!'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                const fileInput = document.getElementById('coverUpload');
                                const formData = new FormData();
                                formData.append('cover_photo', fileInput.files[0]);

                                fetch('{{ route('seller.cover-photo') }}', {
                                        method: 'POST',
                                        body: formData,
                                        headers: {
                                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                        },
                                    })
                                    .then(response => response.json())
                                    .then(data => {
                                        if (data.success) {
                                            originalCoverImageSrc = data.image_path;
                                            document.getElementById('saveButton').style.display =
                                            'none'; // Hide save button
                                            Swal.fire('Success!', 'Cover photo saved successfully!', 'success');
                                        } else {
                                            Swal.fire('Error!', 'Failed to save cover photo.', 'error');
                                        }
                                    })
                                    .catch(error => console.error('Error:', error));
                            } else {
                                // Revert to original image if user cancels saving
                                document.getElementById('coverImage').src = originalCoverImageSrc;
                                document.getElementById('saveButton').style.display = 'none'; // Hide save button
                            }
                        });
                    });

                    document.getElementById('deleteButton').addEventListener('click', function() {
                        Swal.fire({
                            title: 'Are you sure?',
                            text: "You won't be able to revert this!",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Yes, delete it!'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                fetch('{{ route('seller.cover-photo.delete') }}', {
                                        method: 'POST',
                                        headers: {
                                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                            'Content-Type': 'application/json',
                                        },
                                    })
                                    .then(response => response.json())
                                    .then(data => {
                                        if (data.success) {
                                            Swal.fire('Deleted!', 'Your cover photo has been deleted.', 'success')
                                                .then(() => {
                                                    window.location
                                                .reload(); // Reload the page to show default picture
                                                });
                                        } else {
                                            Swal.fire('Error!', 'Failed to delete cover photo.', 'error');
                                        }
                                    })
                                    .catch(error => console.error('Error:', error));
                            }
                        });
                    });

                    // Profile Photo Upload and Actions (similar to above)
                    let originalProfileImageSrc = document.getElementById('profileImage').src;

                    document.getElementById('profileUploadButton').addEventListener('click', function() {
                        document.getElementById('profileUpload').click();
                    });

                    document.getElementById('profileUpload').addEventListener('change', function(event) {
                        const file = event.target.files[0];
                        if (file) {
                            const reader = new FileReader();
                            reader.onload = function(e) {
                                document.getElementById('profileImage').src = e.target.result;
                                document.getElementById('profileSaveButton').style.display = 'block'; // Show save button
                            };
                            reader.readAsDataURL(file);
                        }
                    });

                    document.getElementById('profileSaveButton').addEventListener('click', function() {
                        Swal.fire({
                            title: 'Are you sure?',
                            text: 'Do you want to save this profile picture?',
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Yes, save it!'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                const fileInput = document.getElementById('profileUpload');
                                const formData = new FormData();
                                formData.append('profile_photo', fileInput.files[0]);

                                fetch('{{ route('seller.profile-photo') }}', {
                                        method: 'POST',
                                        body: formData,
                                        headers: {
                                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                        },
                                    })
                                    .then(response => response.json())
                                    .then(data => {
                                        if (data.success) {
                                            originalProfileImageSrc = data.image_path;
                                            document.getElementById('profileSaveButton').style.display =
                                            'none'; // Hide save button
                                            Swal.fire('Success!', 'Profile picture saved successfully!', 'success');
                                        } else {
                                            Swal.fire('Error!', 'Failed to save profile picture.', 'error');
                                        }
                                    })
                                    .catch(error => console.error('Error:', error));
                            } else {
                                // Revert to original image if user cancels saving
                                document.getElementById('profileImage').src = originalProfileImageSrc;
                                document.getElementById('profileSaveButton').style.display = 'none'; // Hide save button
                            }
                        });
                    });

                    document.getElementById('profileDeleteButton').addEventListener('click', function() {
                        Swal.fire({
                            title: 'Are you sure?',
                            text: "You won't be able to revert this!",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Yes, delete it!'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                fetch('{{ route('seller.profile-photo.delete') }}', {
                                        method: 'POST',
                                        headers: {
                                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                            'Content-Type': 'application/json',
                                        },
                                    })
                                    .then(response => response.json())
                                    .then(data => {
                                        if (data.success) {
                                            Swal.fire('Deleted!', 'Your profile picture has been deleted.',
                                                    'success')
                                                .then(() => {
                                                    window.location
                                                .reload(); // Reload the page to show default picture
                                                });
                                        } else {
                                            Swal.fire('Error!', 'Failed to delete profile picture.', 'error');
                                        }
                                    })
                                    .catch(error => console.error('Error:', error));
                            }
                        });
                    });
                </script>

                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

