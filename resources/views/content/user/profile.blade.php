@extends('layouts/contentLayoutMaster')

@section('title', 'Akun Saya')

@section('content')

<section id="page-account-settings">
    <div class="row">
        <!-- left menu section -->
        <div class="col-md-3 mb-2 mb-md-0">
            <ul class="nav nav-pills flex-column nav-left">
                <!-- general -->
                <li class="nav-item">
                    <a class="nav-link active" id="account-pill-general" data-toggle="pill" href="#account-vertical-general" aria-expanded="true">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user font-medium-3 mr-1">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                        </svg>
                        <span class="font-weight-bold">Info Umum</span>
                    </a>
                </li>
                <!-- change password -->
                <li class="nav-item">
                    <a class="nav-link" id="account-pill-password" data-toggle="pill" href="#account-vertical-password" aria-expanded="false">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-lock font-medium-3 mr-1">
                            <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                            <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                        </svg>
                        <span class="font-weight-bold">Ganti Password</span>
                    </a>
                </li>
            </ul>
        </div>
        <!--/ left menu section -->

        <!-- right content section -->
        <div class="col-md-9">
            <div class="card">
                <div class="card-body">
                    <div class="tab-content">
                        <!-- general tab -->
                        <div role="tabpanel" class="tab-pane active" id="account-vertical-general" aria-labelledby="account-pill-general" aria-expanded="true">
                            <!-- form -->

                            @if ($message = Session::get('success'))
                            <div class="alert alert-success alert-block p-2">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                <strong>{{ $message }}</strong>
                            </div>
                            @endif

                            @if ($message = Session::get('error'))
                            <div class="alert alert-danger alert-block p-2">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                <strong>{{ $message }}</strong>
                            </div>
                            @endif

                            <form class="validate-form mt-2" novalidate="novalidate" method="POST" action="{{ route('profile-update') }}">
                                @csrf
                                <div class="row">
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label for="account-name">Name</label>
                                            <input type="text" class="form-control form-control @error('name') is-invalid @enderror" id="account-name" name="name" placeholder="Nama" value="{{$user->name}}">
                                            @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label for="account-e-mail">E-mail</label>
                                            <input type="email" class="form-control form-control @error('email') is-invalid @enderror" id="account-e-mail" name="email" placeholder="Email" value="{{$user->email}}">
                                            @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label for="account-phone">Nomor Telepon</label>
                                            <input type="text" class="form-control form-control @error('phone') is-invalid @enderror" id="account-phone" name="phone" placeholder="08123456789" value="{{$user->phone}}">
                                            @error('phone')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <!-- <div class="col-12 mt-75">
                                        <div class="alert alert-warning mb-50" role="alert">
                                            <h4 class="alert-heading">Your email is not confirmed. Please check your inbox.</h4>
                                            <div class="alert-body">
                                                <a href="javascript: void(0);" class="alert-link">Resend confirmation</a>
                                            </div>
                                        </div>
                                    </div> -->
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary mt-2 mr-1 waves-effect waves-float waves-light">Simpan Perubahan</button>
                                        <button type="reset" class="btn btn-outline-secondary mt-2 waves-effect">Batal</button>
                                    </div>
                                </div>
                            </form>
                            <!--/ form -->
                        </div>
                        <!--/ general tab -->

                        <!-- change password -->
                        <div class="tab-pane fade" id="account-vertical-password" role="tabpanel" aria-labelledby="account-pill-password" aria-expanded="false">
                            <!-- form -->
                            @if ($message = Session::get('success'))
                            <div class="alert alert-success alert-block p-2">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                <strong>{{ $message }}</strong>
                            </div>
                            @endif

                            @if ($message = Session::get('error'))
                            <div class="alert alert-danger alert-block p-2">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                <strong>{{ $message }}</strong>
                            </div>
                            @endif

                            <form class="validate-form" novalidate="novalidate" method="POST" action="{{ route('profile-password') }}">
                                @csrf
                                <div class="row">
                                    <div class="col-12 col-sm-6">

                                        <div class="form-group">
                                            <label for="password" class="form-label">Password Lama</label>

                                            <div class="input-group input-group-merge form-password-toggle @error('password') is-invalid @enderror">
                                                <input type="password" class="form-control form-control-merge @error('password') is-invalid @enderror" id="password" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="register-password" tabindex="4" />
                                                <div class="input-group-append">
                                                    <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
                                                </div>
                                            </div>
                                            @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label for="register-password" class="form-label">Password Baru</label>

                                            <div class="input-group input-group-merge form-password-toggle @error('new_password') is-invalid @enderror">
                                                <input type="password" class="form-control form-control-merge @error('new_password') is-invalid @enderror" id="register-password" name="new_password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="register-password" tabindex="4" />
                                                <div class="input-group-append">
                                                    <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
                                                </div>
                                            </div>
                                            @error('new_password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">

                                        <div class="form-group">
                                            <label for="register-password-confirm" class="form-label">Konfirmasi Password Baru</label>

                                            <div class="input-group input-group-merge form-password-toggle">
                                                <input type="password" class="form-control form-control-merge" id="register-password-confirm" name="new_password_confirmation" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="register-password" tabindex="4" />
                                                <div class="input-group-append">
                                                    <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary mr-1 mt-1 waves-effect waves-float waves-light">Simpan Perubahan</button>
                                        <button type="reset" class="btn btn-outline-secondary mt-1 waves-effect">Batal</button>
                                    </div>
                                </div>
                            </form>
                            <!--/ form -->
                        </div>
                        <!--/ change password -->
                    </div>
                </div>
            </div>
        </div>
        <!--/ right content section -->
    </div>
</section>

@endsection
@section('page-script')
<script src="/vendors/js/forms/cleave/cleave.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        var hash = location.hash.replace(/^#/, ''); // ^ means starting, meaning only match the first hash
        console.log(hash);
        if (hash) {
            $('#account-pill-password').tab('show')
        }
    });
</script>
@endsection