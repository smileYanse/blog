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
                            <h4>New here?</h4>
                            <h6 class="font-weight-light">Signing up is easy. It only takes a few steps</h6>
                            <form class="pt-3">
                                <div  class="form-group">
                                    <input type="text" name="user_name" class="form-control form-control-lg"
                                           id="exampleInputUsername1" placeholder="Username">
                                </div>
                                <div class="form-group">
                                    <input type="email" name="email" class="form-control form-control-lg"
                                           id="exampleInputEmail1" placeholder="Email">
                                </div>

                                <div class="form-group">
                                    <input type="password" name="password" class="form-control form-control-lg"
                                           id="exampleInputPassword1" placeholder="Password">
                                </div>
                                <div class="mb-4">
                                    <div class="form-check">
                                        <label class="form-check-label text-muted">
                                            <input type="checkbox" class="form-check-input" name="agree">
                                            I agree to all Terms & Conditions
                                        </label>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <a id="dis"
                                       class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn disabled">SIGN UP</a>
                                </div>
                                <div class="text-center mt-4 font-weight-light">
                                    Already have an account? <a href="{{url('login')}}" class="text-primary">Login</a>
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
            $('input[name=agree]').change(function () {
                var agree = $('input[name=agree]').is(':checked');
                if (agree == false) {
                    $('#dis').addClass('disabled');
                } else {
                    $('#dis').removeClass('disabled');
                }
            })
            layui.use('layer', function(){
                var layer = layui.layer;

                $('#dis').click(function (){
                    $.ajax({
                        type:'POST',
                        url:'{{url('user_reg')}}',
                        data:{
                            user_name:$('input[name=user_name]').val(),
                            email:$('input[name=email]').val(),
                            password:$('input[name=password]').val()
                        },
                        success:function (data) {
                            if(data.code==1){
                                //重定向
                                layer.msg(data.msg,{})
                                window.location.href='{{url('login')}}'
                            }else{
                                layer.msg(data.msg,{})
                            }
                        },
                        error:function (data) {
                            alert(data.msg)
                        }
                    })
                })
            });

        })
    </script>
@endsection