@extends('layouts.auth')

@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Profile</h1>

    <!-- Profile Information Card -->
    <div class="card mb-4">
        <div class="card-header">
            <h6 class="m-0 font-weight-bold text-primary">User Information</h6>
        </div>
        <div class="card-body">

            <!-- User Photo -->
            <div class="text-center mb-4">
                <img class="img-fluid rounded-circle"
                    src="{{ $user->photo === 'undraw_profile.svg' ? Vite::asset('resources/assets/img/undraw_profile.svg') : asset('storage/' . $user->photo) }}"
                    alt="User Photo" style="max-width: 150px;">
                <br>
                <a href="#" data-toggle="modal" data-target="#editPhotoModal">Edit Photo</a>
            </div>

            <!-- Edit Photo Modal -->
            <div class="modal fade" id="editPhotoModal" tabindex="-1" role="dialog" aria-labelledby="editPhotoModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editPhotoModalLabel">Edit Photo</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <!-- Form to upload a new photo -->
                            <form method="POST" action="{{ route('profile.update-photo') }}" enctype="multipart/form-data">
                                @csrf
                                @method('PATCH')
                                <div class="form-group">
                                    <label for="photo">Choose a new photo:</label>
                                    <input type="file" class="form-control-file" id="photo" accept="image/*"
                                        name="photo">
                                </div>
                                <button type="submit" class="btn btn-primary">Save Changes</button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>

            <!-- User Details -->
            <div class="row">
                <div class="col-md-6">
                    <p><strong>Nama:</strong> {{ $user->name }}</p>
                    <p><strong>Username:</strong> {{ $user->username }} </p>
                </div>
                <div class="col-md-6">
                    <p><strong>Jabatan:</strong> {{ $user->role->name }}</p>
                    <p><strong>Kontak:</strong> {{ $user->contact }}</p>
                </div>
            </div>
        @endsection
