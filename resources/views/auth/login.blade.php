@extends('admin.layouts.app')
@section('content')
<div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth px-0">
            <div class="row w-100 mx-0">
                <div class="col-lg-4 mx-auto">
                    <div class="auth-form-light text-left py-5 px-4 px-sm-5">
                        <div class="row mb-3">
                            <div class="col-12 text-center">
                                <img src="{{asset('/src/images/favicon.png')}}" alt="logo" height="100">
                            </div>
                        </div>
                        <h6 class="font-weight-light">Sign in to continue.</h6>
                        <form action="{{ route('loginAdmin') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="pt-3">
                                <div class="form-group">
                                    <input type="email" class="form-control form-control-lg" id="exampleInputEmail1"
                                        placeholder="Username" name="email"> <!-- Tambahkan name="email" -->
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control form-control-lg"
                                        id="exampleInputPassword1" placeholder="Password" name="password"> <!-- Tambahkan name="password" -->
                                </div>
                                <div class="mt-3">
                                    <button type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">
                                        SIGN IN
                                    </button>
                                </div>
                                <div class="my-2 d-flex justify-content-between align-items-center">
                                    <a href="#" class="auth-link text-black ml-auto">Forgot password?</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
