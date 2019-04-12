@extends('layouts.login')

@section('container')
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-center auth">
                <div class="row w-100">
                    <div class="col-lg-4 mx-auto">
                        <div class="auth-form-light text-left p-5">
                            <div class="brand-logo">
                                <img src="{{asset('images/logo.svg')}}">
                            </div>
                            <h4>Hello! let's get started</h4>
                            <h6 class="font-weight-light">Sign in to continue.</h6>
                            <form class="pt-3">

                                <div class="form-group">
                                    <input type="email" class="form-control form-control-lg" id="exampleInputEmail1"
                                           placeholder="邮箱地址">
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control form-control-lg"
                                           id="exampleInputPassword1" placeholder="密码">
                                </div>
                                <div class="mt-3">
                                    <a class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn" id="signin">SIGN IN</a>
                                </div>
                                <div class="my-2 d-flex justify-content-between align-items-center">
                                    <div class="form-check">
                                        <label class="form-check-label text-muted">
                                            <input type="checkbox" class="form-check-input">
                                            Keep me signed in
                                        </label>
                                    </div>
                                    <a href="#" class="auth-link text-black">Forgot password?</a>
                                </div>
                                <div class="mb-2">
                                    <button type="button" class="btn btn-block btn-facebook auth-form-btn">
                                        <i class="mdi mdi-facebook mr-2"></i>Connect using facebook
                                    </button>
                                </div>
                                <div class="text-center mt-4 font-weight-light">
                                    Don't have an account? <a href="{{url('register')}}" class="text-primary">Create</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- content-wrapper ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="{{asset('vendors/js/vendor.bundle.base.js')}}"></script>
    <script src="{{asset('vendors/js/vendor.bundle.addons.js')}}"></script>
    <!-- endinject -->
    <!-- inject:js -->
    <script src="{{asset('js/off-canvas.js')}}"></script>
    <script src="{{asset('js/misc.js')}}"></script>
    <!-- endinject -->

    <script>
        $(function () {



            layui.use('layer', function() {
                var layer = layui.layer;
                $('#signin').click(function () {
                    var email=$('#exampleInputEmail1').val();
                    var password=$('#exampleInputPassword1').val();
                    $.ajax({
                        type: 'POST',
                        url: '{{url('user_login')}}',
                        data: {
                            email:email,
                            password:password
                        },
                        success: function (data) {
                            if(data.code==1){
                                //重定向
                                layer.msg(data.msg,{})
                                window.location.href='{{url('index')}}'
                            }else{
                                layer.msg(data.msg,{})
                            }
                        }
                    })
                })
            })
        })
    </script>
@endsection