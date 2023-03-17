@extends('layouts.themes.landing.main')
@section('content')
{{-- siteHit() --}}
<section class="ftco-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 col-lg-10">

            <div class="wrap d-md-flex">
                <div class="img" style="background-image: url({{ asset('img/landing/bg-1.jpg') }});">
            </div>
            <div class="login-wrap p-4 p-md-4">
                <div class="d-flex">
                    <div class="w-100">
                        <p class="social-media d-flex justify-content-end">
                            {{-- <a rel="noreferrer" target="_BLANK" href="https://www.facebook.com/profile.php?id=100075744402391" class="social-icon d-flex align-items-center justify-content-center"><span class="fa fa-facebook"></span></a> --}}
                            {{-- <a rel="noreferrer" target="_BLANK" href="https://twitter.com/uniminofficial" class="social-icon d-flex align-items-center justify-content-center"><span class="fa fa-twitter"></span></a> --}}
                            {{-- <a rel="noreferrer" target="_BLANK" href="https://www.tiktok.com/@uniminofficial" class="social-icon d-flex align-items-center justify-content-center"><img src="{{ asset('bootstrap/landing/images/icons/tiktok3.png') }}" /></a></a> --}}
                            {{-- <a rel="noreferrer" target="_BLANK" href="https://www.youtube.com/channel/UCAXq0GXoLfWY2zB_p_O3ALQ" class="social-icon d-flex align-items-center justify-content-center"><span class="fa fa-youtube-play"></span></a> --}}
                            {{-- <a rel="noreferrer" target="_BLANK" href="http://instagram.com/uniminofficial" class="social-icon d-flex align-items-center justify-content-center"><span class="fa fa-instagram"></span></a> --}}
                            {{-- <a rel="noreferrer" target="_BLANK" href="https://www.infinitwebsolutions.com" class="social-icon d-flex align-items-center justify-content-center"><span class="fa fa-globe"></span></a> --}}
                        </p>
                    </div>
                </div>

                <div class="d-flex">
                    <div class="w-100">
                        <h3 class="mb-3 text-secondary">Welcome to MADAYAW GAS</h3>
                    </div>
                </div>
                <p><small>Please login to continue</small></p>
                <form method="POST" action="{{ action('LoginController@validateUser') }}">
                {{ csrf_field() }} 
                    <div class="row">
                        <div class="col-md-12 col-sm-12 mb-2">
                            @include('layouts.partials.alert')
                        </div>
                        <div class="col-md-12">
                            <label for="usr_name">Username</label>
                            <input class="form-control" type="text" name="username" />
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="usr_password">Password</label>
                            <input class="form-control" type="password" name="password" />
                        </div>
                        <div class="col-md-12 col-sm-12 mb-2">
                            <button class="btn btn-secondary btn-block" style="background-color:#238ab2;color:white;" type="submit"><span class="fa fa-sign-in"></span> Login</button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12 mb-2">
                            <p class="text-center"><a href="javascript:void(0)" data-toggle="modal" data-target="#usernameModal" style="color:#17a2b8;">Reset Password</a></p>
                        </div>
                    </div>
                </form>
                </div>
            </div>  
            
        </div>
    </div>
</section>


<form method="POST" action="{{action('UserController@forgotPassword')}}">
{{ csrf_field() }} 
    <div id="usernameModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <label for="usr_name">Enter Username</label>
                    <input class="form-control" type="text" name="usr_name" required/>
                    <button type="button" class="btn form-control bg-info text-white btn-info mt-2"  data-toggle="modal" data-target="#forgotModal">Confirm</button> 
                </div>
            </div>
        </div>
    </div>

    <div id="forgotModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="text-warning"><span class="fa fa-warning"></span> Warning</5>
                </div>
                <div class="modal-body">
                    <p><strong>Are you sure you want to reset your password?</strong> <br><br>Please click '<span class="fa fa-key"></span> RESET' button, and wait for an admin to validate your request.</p>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-default"><span class="fa fa-key"></span> RESET</button> 
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><span class="fa fa-times-circle"></span> BACK</button>
                </div>
            </div>
        </div>
    </div>
</form>

@endsection
