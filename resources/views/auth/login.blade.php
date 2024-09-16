<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Login - {{get_apps()->name}}</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- favicon
		============================================ -->
    <link rel="shortcut icon" type="image/x-icon" href="{{url('img/favicon.ico')}}">
    <link rel="stylesheet" href="{{ url('css/all.css')}}">
    <link rel="stylesheet" href="{{ url('css/app.css')}}">
    <link rel="stylesheet" href="{{ url('css/buttons.css')}}">
    <!-- forms CSS
		============================================ -->
    <link rel="stylesheet" href="css/form/all-type-forms.css">
</head>

<body>
    <!--[if lt IE 8]>
		<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
	<![endif]-->
    <div class="text-center m-b-md custom-login pd-10">
        <a href="/"><img style="padding: 5px 0;" src="{{url('img/logo/logosn.png')}}" alt="{{get_apps()->name}}"></a>
    </div>
    <div>
        <div class="col-lg-offset-2 col-lg-8">
            <div class="row text-center pd-10" style="padding: 30px 20px 0px 20px;">
                <div class="col-12">
                    <strong class="large">Silahkan login terlebih dahulu</strong>
                    <!-- <p class="subtitle">You need to sign in to use all of our features.</p> -->
                </div>
            </div>
            <div class="row-fluid">
                <div class="col-lg-6 " style="padding: 0;margin: 0px;">
                    <div class="box">
                        <div class="text-center m-b-md custom-login">
                            <h2>Login</h2>
                        </div>
                        <div class="content-error">
                            <div class="hpanel">
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <a class="btn btn-lg btn-default btn-block col-lg-6" href="https://iseetalk.com/auth/google">
                                                <div class="" style="background-image: url(&quot;data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADAAAAAwCAMAAABg3Am1AAAAjVBMVEVHcEwwnU/VPjYvnk/VPjUvnVDWSDRQcKehaUFQcKhOc6Iunk7VPTXVPjVQcKdQcKjZWDMvnU7VPTXvtikwnVDWPTXvtSnurSpQcKfVPjYunk7ttChQcajstSgwn0zttCjvtShQcKlQcKgvnk/VPjbvtSnjfi7bsy07n009inXYTTSDqD6bqzqnrTdTokc44COHAAAAInRSTlMAPc/b5r4jPxC/oJBVkIjlQGOjtyC/0/cggIB7X2BQoJ/Psru6sQAAAUhJREFUSMftlduWgiAUhjGBoRTT0uw4B8Gp5vT+jzeGOggCC5vb/iuX6/vYe6MoAI/cFRLTGeScw4LGHnha8EHgCk/BRZwK5YZAa2Ok4OZYDDKz8DNiFqbyu0HXNMY4jVfQxWOJp3IRaOUB/NvGIYGpjT+9d/zO831Y1+WHWN+Tx3WTpgjEnsKpbg0KvDsSKWWB7ZMeRdi0wkbeWVRa3hShbIW1Q1gqQsvXB4dQ/U/oWnr1FjyGVmd4aYWzfHOSeZ9lK8wV4SD4r8ve8Iw6IVFP2235T8ZYPuKPXUtH/VGffxqeIVuBaqt9X74vTERvKqlMIzRBrEtETLzeEQBBL7AwkzeReVNFIiaV6DnIgywKm+urcQK1KTXX8Z72WxuaDWbhG8NSgy2sB29v5DPHUc3HRVDgPt0BmoSLKlmEbvOHYZSRxx/8rvwCaQpYY51gRIUAAAAASUVORK5CYII=&quot;);border-radius: 50%;width: 24px;min-height: 24px;background-repeat: no-repeat;background-size: cover;background-position: center;position: absolute;"></div>
                                                <small class="hidden-xs"> Lanjut dengan Google</small>
                                                <small class="visible-xs"> Google</small>
                                            </a>
                                        </div>
                                        <div class="col-lg-12">
                                            <a class="btn btn-lg btn-default btn-block col-lg-6" href="https://iseetalk.com/auth/facebook">
                                                <div class="" style="background-image: url(&quot;data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACwAAAAsBAMAAADsqkcyAAAALVBMVEVHcEwYdfEYdvIXd/IYd+8Xd+8Xd/IXd/IQcO8Yd/IXd/EXd/IYdvMXdvIYd/JU6UsnAAAADnRSTlMAgKDGQCFa7xDfkK9/bxPrucEAAAFTSURBVCjPbdM/S8NAFADwh9Ua/Idx6lSKOEuhg+IQMjtIKWRxKNncOokIQhCcXKSfIIsgTqGrS/ETCH4Da/+EtHKfwbvkvcu75t5ydz+Ou5d3eQBFOJcfUdp5ewQjNs9EHqvQUE9gZMy3tMr9Xc03gsUd6Z4w4hP5y+Q/62baPtDrh+NOLIdFnkZMeqJSlWOqktkgvQVk0eZnhJpnckJn/ILmKY4q5iULvzx6qPD7KJ+3YJt4JPkU5/dwRdwCqNN8Bk2aHrLvXYLHWN+zsnMGkY1TEDYWyPMgkI/uBMG1wT/0UrvIsck1vHJs8oEoapWY3MfPGZhc1GIBL/k4cV1f1sR1x1jkmi3vNuzbOAQnqnImL2lWWf0oz1UeQvnGjH2VarLOE1YGxqOimzyTp9hXTyafUyESzkvdO/W45JS1Wq/kd96YvbjgtLHWxq+Sdy58XP4DJ30Z99MJep4AAAAASUVORK5CYII=&quot;);border-radius: 50%;width: 24px;min-height: 24px;background-repeat: no-repeat;background-size: cover;background-position: center;position: absolute;"></div>
                                                <small class="hidden-xs"> Lanjut dengan Facebook</small>
                                                <small class="visible-xs"> Facebook</small>
                                            </a>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="clearfix text-center ">or</div>
                                    <form action="{{route('login')}}" method="post" id="loginForm">
                                        @csrf
                                        {!!Form::text('email', '')->placeholder('Email')!!}
                                        {!!Form::text('password', '')->type('password')->placeholder('Password')!!}
                                        <br>
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <button class="btn btn-lg btn-success btn-block loginbtn">Masuk</button>
                                            </div>
                                            <br>
                                            <hr>
                                            @if (Route::has('password.request'))
                                            <div class="text-center">
                                                <a class="btn-link" href="{{ route('password.request') }}">
                                                    <small class="text-muted">{{ __('Lupa Password?') }}</small>
                                                </a>
                                            </div>
                                            @endif
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 " style="padding: 0px;margin: 0;">
                    <div class="box">
                        <div class="text-center m-b-md custom-login">
                            <h2>Sign In</h2>
                        </div>
                        <p class="col-lg-offset-2 col-lg-8 pd-10" style="font-size: 12.5px;">Mulai buat channel dan upload konten kamu dengan gratis sekarang</p>
                        <svg xmlns="http://www.w3.org/2000/svg" id="b80fd712-d768-4ad0-b56e-a8f7496d51d1" data-name="Layer 1" width="212.26546" height="264" viewBox="0 0 792.26546 727.77798" class="injected-svg modal__media modal__lg_media" data-src="https://pankord.s3.ap-southeast-1.amazonaws.com/assets/login_il.svg" xmlns:xlink="http://www.w3.org/1999/xlink"><path d="M566.75655,259.05824h-3.99878V149.51291A63.40187,63.40187,0,0,0,499.356,86.111H267.26925a63.40184,63.40184,0,0,0-63.402,63.4017V750.48713A63.40182,63.40182,0,0,0,267.26906,813.889H499.35567a63.40185,63.40185,0,0,0,63.402-63.40167V337.0345h3.99884Z" transform="translate(-203.86727 -86.11101)" fill="#e6e6e6"></path><path d="M501.914,102.606H471.619a22.49485,22.49485,0,0,1-20.82715,30.99053H317.83242a22.49486,22.49486,0,0,1-20.82715-30.99061H268.70968a47.34781,47.34781,0,0,0-47.34784,47.34774V750.04628a47.34781,47.34781,0,0,0,47.34778,47.34784H501.914a47.34781,47.34781,0,0,0,47.34784-47.34778h0V149.95371A47.34777,47.34777,0,0,0,501.914,102.606Z" transform="translate(-203.86727 -86.11101)" fill="#fff"></path><path d="M250.31185,385.03936a1,1,0,0,1-1-1v-35a1,1,0,0,1,2,0v35A1,1,0,0,1,250.31185,385.03936Z" transform="translate(-203.86727 -86.11101)" fill="#ccc"></path><path d="M257.31185,390.53936a1,1,0,0,1-1-1v-46a1,1,0,0,1,2,0v46A1,1,0,0,1,257.31185,390.53936Z" transform="translate(-203.86727 -86.11101)" fill="#ccc"></path><path d="M264.31185,394.03936a1,1,0,0,1-1-1v-53a1,1,0,0,1,2,0v53A1,1,0,0,1,264.31185,394.03936Z" transform="translate(-203.86727 -86.11101)" fill="#ccc"></path><path d="M271.31185,403.03936a1,1,0,0,1-1-1v-71a1,1,0,0,1,2,0v71A1,1,0,0,1,271.31185,403.03936Z" transform="translate(-203.86727 -86.11101)" fill="#ccc"></path><path d="M278.31185,416.53936a1,1,0,0,1-1-1v-98a1,1,0,0,1,2,0v98A1,1,0,0,1,278.31185,416.53936Z" transform="translate(-203.86727 -86.11101)" fill="#ccc"></path><path d="M285.31185,403.03936a1,1,0,0,1-1-1v-71a1,1,0,0,1,2,0v71A1,1,0,0,1,285.31185,403.03936Z" transform="translate(-203.86727 -86.11101)" fill="#ccc"></path><path d="M292.31185,409.53936a1,1,0,0,1-1-1v-84a1,1,0,0,1,2,0v84A1,1,0,0,1,292.31185,409.53936Z" transform="translate(-203.86727 -86.11101)" fill="#ccc"></path><path d="M299.31185,392.53936a1,1,0,0,1-1-1v-50a1,1,0,0,1,2,0v50A1,1,0,0,1,299.31185,392.53936Z" transform="translate(-203.86727 -86.11101)" fill="#ccc"></path><path d="M306.31185,396.53936a1,1,0,0,1-1-1v-58a1,1,0,0,1,2,0v58A1,1,0,0,1,306.31185,396.53936Z" transform="translate(-203.86727 -86.11101)" fill="#ccc"></path><path d="M313.31185,385.03936a1,1,0,0,1-1-1v-35a1,1,0,0,1,2,0v35A1,1,0,0,1,313.31185,385.03936Z" transform="translate(-203.86727 -86.11101)" fill="#ccc"></path><path d="M319.31185,385.03936a1,1,0,0,1-1-1v-35a1,1,0,0,1,2,0v35A1,1,0,0,1,319.31185,385.03936Z" transform="translate(-203.86727 -86.11101)" fill="#ccc"></path><path d="M326.31185,390.53936a1,1,0,0,1-1-1v-46a1,1,0,0,1,2,0v46A1,1,0,0,1,326.31185,390.53936Z" transform="translate(-203.86727 -86.11101)" fill="#ccc"></path><path d="M333.31185,394.03936a1,1,0,0,1-1-1v-53a1,1,0,0,1,2,0v53A1,1,0,0,1,333.31185,394.03936Z" transform="translate(-203.86727 -86.11101)" fill="#ccc"></path><path d="M340.31185,403.03936a1,1,0,0,1-1-1v-71a1,1,0,0,1,2,0v71A1,1,0,0,1,340.31185,403.03936Z" transform="translate(-203.86727 -86.11101)" fill="#ccc"></path><path d="M347.31185,432.53936a1,1,0,0,1-1-1v-130a1,1,0,0,1,2,0v130A1,1,0,0,1,347.31185,432.53936Z" transform="translate(-203.86727 -86.11101)" fill="#ccc"></path><path d="M354.31185,403.03936a1,1,0,0,1-1-1v-71a1,1,0,0,1,2,0v71A1,1,0,0,1,354.31185,403.03936Z" transform="translate(-203.86727 -86.11101)" fill="#ccc"></path><path d="M361.31185,409.53936a1,1,0,0,1-1-1v-84a1,1,0,0,1,2,0v84A1,1,0,0,1,361.31185,409.53936Z" transform="translate(-203.86727 -86.11101)" fill="#ccc"></path><path d="M368.31185,392.53936a1,1,0,0,1-1-1v-50a1,1,0,0,1,2,0v50A1,1,0,0,1,368.31185,392.53936Z" transform="translate(-203.86727 -86.11101)" fill="#ccc"></path><path d="M375.31185,396.53936a1,1,0,0,1-1-1v-58a1,1,0,0,1,2,0v58A1,1,0,0,1,375.31185,396.53936Z" transform="translate(-203.86727 -86.11101)" fill="#ccc"></path><path d="M382.31185,385.03936a1,1,0,0,1-1-1v-35a1,1,0,0,1,2,0v35A1,1,0,0,1,382.31185,385.03936Z" transform="translate(-203.86727 -86.11101)" fill="#ccc"></path><path d="M388.31185,385.03936a1,1,0,0,1-1-1v-35a1,1,0,0,1,2,0v35A1,1,0,0,1,388.31185,385.03936Z" transform="translate(-203.86727 -86.11101)" fill="#ccc"></path><path d="M395.31185,390.53936a1,1,0,0,1-1-1v-46a1,1,0,0,1,2,0v46A1,1,0,0,1,395.31185,390.53936Z" transform="translate(-203.86727 -86.11101)" fill="#ccc"></path><path d="M402.31185,394.03936a1,1,0,0,1-1-1v-53a1,1,0,0,1,2,0v53A1,1,0,0,1,402.31185,394.03936Z" transform="translate(-203.86727 -86.11101)" fill="#ccc"></path><path d="M409.31185,403.03936a1,1,0,0,1-1-1v-71a1,1,0,0,1,2,0v71A1,1,0,0,1,409.31185,403.03936Z" transform="translate(-203.86727 -86.11101)" fill="#ccc"></path><path d="M416.31185,416.53936a1,1,0,0,1-1-1v-98a1,1,0,0,1,2,0v98A1,1,0,0,1,416.31185,416.53936Z" transform="translate(-203.86727 -86.11101)" fill="#ccc"></path><path d="M421.31185,460.78936a1,1,0,0,1-1-1v-186.5a1,1,0,0,1,2,0v186.5A1,1,0,0,1,421.31185,460.78936Z" transform="translate(-203.86727 -86.11101)" fill="#f9a826"></path><path d="M423.31185,403.03936a1,1,0,0,1-1-1v-71a1,1,0,0,1,2,0v71A1,1,0,0,1,423.31185,403.03936Z" transform="translate(-203.86727 -86.11101)" fill="#ccc"></path><path d="M430.31185,409.53936a1,1,0,0,1-1-1v-84a1,1,0,0,1,2,0v84A1,1,0,0,1,430.31185,409.53936Z" transform="translate(-203.86727 -86.11101)" fill="#ccc"></path><path d="M437.31185,392.53936a1,1,0,0,1-1-1v-50a1,1,0,0,1,2,0v50A1,1,0,0,1,437.31185,392.53936Z" transform="translate(-203.86727 -86.11101)" fill="#ccc"></path><path d="M444.31185,396.53936a1,1,0,0,1-1-1v-58a1,1,0,0,1,2,0v58A1,1,0,0,1,444.31185,396.53936Z" transform="translate(-203.86727 -86.11101)" fill="#ccc"></path><path d="M451.31185,385.03936a1,1,0,0,1-1-1v-35a1,1,0,0,1,2,0v35A1,1,0,0,1,451.31185,385.03936Z" transform="translate(-203.86727 -86.11101)" fill="#ccc"></path><path d="M457.31185,385.03936a1,1,0,0,1-1-1v-35a1,1,0,0,1,2,0v35A1,1,0,0,1,457.31185,385.03936Z" transform="translate(-203.86727 -86.11101)" fill="#ccc"></path><path d="M464.31185,390.53936a1,1,0,0,1-1-1v-46a1,1,0,0,1,2,0v46A1,1,0,0,1,464.31185,390.53936Z" transform="translate(-203.86727 -86.11101)" fill="#ccc"></path><path d="M471.31185,394.03936a1,1,0,0,1-1-1v-53a1,1,0,0,1,2,0v53A1,1,0,0,1,471.31185,394.03936Z" transform="translate(-203.86727 -86.11101)" fill="#ccc"></path><path d="M478.31185,403.03936a1,1,0,0,1-1-1v-71a1,1,0,0,1,2,0v71A1,1,0,0,1,478.31185,403.03936Z" transform="translate(-203.86727 -86.11101)" fill="#ccc"></path><path d="M485.31185,432.53936a1,1,0,0,1-1-1v-130a1,1,0,0,1,2,0v130A1,1,0,0,1,485.31185,432.53936Z" transform="translate(-203.86727 -86.11101)" fill="#ccc"></path><path d="M492.31185,403.03936a1,1,0,0,1-1-1v-71a1,1,0,0,1,2,0v71A1,1,0,0,1,492.31185,403.03936Z" transform="translate(-203.86727 -86.11101)" fill="#ccc"></path><path d="M499.31185,409.53936a1,1,0,0,1-1-1v-84a1,1,0,0,1,2,0v84A1,1,0,0,1,499.31185,409.53936Z" transform="translate(-203.86727 -86.11101)" fill="#ccc"></path><path d="M506.31185,392.53936a1,1,0,0,1-1-1v-50a1,1,0,0,1,2,0v50A1,1,0,0,1,506.31185,392.53936Z" transform="translate(-203.86727 -86.11101)" fill="#ccc"></path><path d="M513.31185,396.53936a1,1,0,0,1-1-1v-58a1,1,0,0,1,2,0v58A1,1,0,0,1,513.31185,396.53936Z" transform="translate(-203.86727 -86.11101)" fill="#ccc"></path><path d="M520.31185,385.03936a1,1,0,0,1-1-1v-35a1,1,0,0,1,2,0v35A1,1,0,0,1,520.31185,385.03936Z" transform="translate(-203.86727 -86.11101)" fill="#ccc"></path><path d="M278.31184,626.5616v35.7l28-17.85Z" transform="translate(-203.86727 -86.11101)" fill="#3f3d56"></path><ellipse cx="383.31188" cy="644.40154" rx="19.96034" ry="20.03154" transform="translate(-547.17264 373.33456) rotate(-44.97337)" fill="#f9a826"></ellipse><path d="M470.60184,660.40157h-6.85a3.43,3.43,0,0,1-3.43-3.42v-25.14a3.44,3.44,0,0,1,3.43-3.43h6.85a3.43,3.43,0,0,1,3.43,3.43v25.15A3.42,3.42,0,0,1,470.60184,660.40157Zm21.71-3.41v-25.15a3.43,3.43,0,0,0-3.42-3.43h-6.86a3.44,3.44,0,0,0-3.43,3.43v25.15a3.43,3.43,0,0,0,3.43,3.42h6.86A3.42,3.42,0,0,0,492.31187,656.99159Z" transform="translate(-203.86727 -86.11101)" fill="#3f3d56"></path><path d="M472.95886,487.55288h-175.294a1.19069,1.19069,0,0,1,0-2.38137h175.294a1.19068,1.19068,0,0,1,0,2.38137Z" transform="translate(-203.86727 -86.11101)" fill="#ccc"></path><path d="M472.95886,247.55288h-175.294a1.19069,1.19069,0,0,1,0-2.38137h175.294a1.19069,1.19069,0,0,1,0,2.38137Z" transform="translate(-203.86727 -86.11101)" fill="#ccc"></path><path d="M756.4977,403.58282a2.8188,2.8188,0,0,1-.36621-.02393l-34.19336-4.48925a2.82648,2.82648,0,0,1-1.79639-4.61426L743.976,366.05206a2.82147,2.82147,0,0,1,4.86719.957l10.3479,32.89453a2.8271,2.8271,0,0,1-2.69336,3.6792Z" transform="translate(-203.86727 -86.11101)" fill="#f2f2f2"></path><path d="M692.45619,557.52813a2.82634,2.82634,0,0,1-2.82495-2.78711l-.44116-37.07519a2.82184,2.82184,0,0,1,4.31445-2.44776l29.29053,18.19971a2.82707,2.82707,0,0,1,.063,4.7666l-28.85669,18.88526a2.82,2.82,0,0,1-1.50439.45849Z" transform="translate(-203.86727 -86.11101)" fill="#f2f2f2"></path><path d="M964.45619,614.52813a2.82634,2.82634,0,0,1-2.82495-2.78711l-.44116-37.07519a2.82184,2.82184,0,0,1,4.31445-2.44776l29.29053,18.19971a2.82707,2.82707,0,0,1,.063,4.7666l-28.85669,18.88526a2.82,2.82,0,0,1-1.50439.45849Z" transform="translate(-203.86727 -86.11101)" fill="#f2f2f2"></path><path d="M822.05675,489.76018c-8.10949-3.7255-13.44023-14.37685-13.13662-24.88137s5.83147-20.32877,13.45571-25.33817a26.6494,26.6494,0,0,1,25.21942-1.90564c8.18252,3.483,19.16872,4.43181,24.087,13.089,3.77959,6.65281,2.41808,21.49465-.25791,28.89228-2.31293,6.394-7.96837,9.99663-13.48333,12.0127a45.34009,45.34009,0,0,1-37.51095-3.0216" transform="translate(-203.86727 -86.11101)" fill="#2f2e41"></path><polygon points="707.894 697.404 696.404 701.68 674.442 659.397 691.399 653.086 707.894 697.404" fill="#ffb8b8"></polygon><path d="M893.16389,785.56807h23.64387a0,0,0,0,1,0,0v14.88687a0,0,0,0,1,0,0H878.277a0,0,0,0,1,0,0v0A14.88685,14.88685,0,0,1,893.16389,785.56807Z" transform="translate(-424.10622 276.76743) rotate(-20.41457)" fill="#2f2e41"></path><polygon points="597.676 709.212 585.416 709.212 579.584 661.924 597.678 661.924 597.676 709.212" fill="#ffb8b8"></polygon><path d="M576.65931,705.70864h23.64387a0,0,0,0,1,0,0v14.88687a0,0,0,0,1,0,0H561.77246a0,0,0,0,1,0,0v0A14.88686,14.88686,0,0,1,576.65931,705.70864Z" fill="#2f2e41"></path><path d="M764.26671,624.86876a10.74268,10.74268,0,0,0,9.16586-13.687L813.76063,541.609l-14.10511-5.6406-40.31356,68.022a10.80091,10.80091,0,0,0,4.92475,20.87831Z" transform="translate(-203.86727 -86.11101)" fill="#ffb8b8"></path><path d="M804.70229,566.34161l-21.43335-13.31738,20.21094-36.82862a13.824,13.824,0,1,1,23.8396,13.981Z" transform="translate(-203.86727 -86.11101)" fill="#2f2e41"></path><path d="M886.5392,763.23614a4.48111,4.48111,0,0,1-4.0061-2.477l-53.32105-109.7544a3.5,3.5,0,0,0-6.54809.86768l-18.99634,104.606a4.522,4.522,0,0,1-4.40772,3.59326H787.15859a4.47841,4.47841,0,0,1-4.48267-4.08984c-7.43506-81.585-3.41186-140.95459,11.95825-176.459a4.525,4.525,0,0,1,5.29907-2.54932L861.3727,593.4793a4.50463,4.50463,0,0,1,3.19653,3.24805l38.5083,157.07031a4.50425,4.50425,0,0,1-3.00976,5.38575l-12.16138,3.84033A4.52677,4.52677,0,0,1,886.5392,763.23614Z" transform="translate(-203.86727 -86.11101)" fill="#2f2e41"></path><circle cx="634.94727" cy="389.04742" r="24.56103" fill="#ffb8b8"></circle><path d="M862.01139,511.07182s-22-12-39,1c0,0-21.5,21.5-14.5,42.5l-17.5,49.5c13.84717,26.256,54.38476,22.00519,74,0l-1.5-47.5Z" transform="translate(-203.86727 -86.11101)" fill="#f9a826"></path><path d="M875.9374,643.29717a23.21681,23.21681,0,0,1-11.04078-2.45458c-5.40136-2.89795-8.72558-8.34815-9.87988-16.19825-1.92822-13.1123-.33984-31.13672,1.342-50.21924,2.1875-24.81787,4.44922-50.48046-1.60669-64.603a4.49111,4.49111,0,0,1,4.90552-6.18067l17.22559,2.96973a4.52537,4.52537,0,0,1,3.65039,3.56543l23.87915,121.30615a4.48772,4.48772,0,0,1-2.48926,4.937C896.72255,638.868,885.92665,643.29717,875.9374,643.29717Z" transform="translate(-203.86727 -86.11101)" fill="#2f2e41"></path><path d="M785.73964,641.68438a4.52465,4.52465,0,0,1-1.79565-.37256c-2.834-1.22509-6.75171-3.0039-11.644-5.28711-13.51342-6.30615,22.12549-93.42773,29.407-110.82812a4.45276,4.45276,0,0,1,1.12133-1.58887l19.50879-17.75586a4.49873,4.49873,0,0,1,7.07642,4.833c-3.4231,11.47314-9.48706,30.70654-15.90723,51.06885-10.13159,32.13525-20.6084,65.36474-23.40893,76.53271a4.49241,4.49241,0,0,1-4.35767,3.398Z" transform="translate(-203.86727 -86.11101)" fill="#2f2e41"></path><path d="M922.85969,620.61246a10.74274,10.74274,0,0,0-5.4016-15.56182L886.2277,530.94681l-13.00012,7.85924,30.00148,73.158a10.80091,10.80091,0,0,0,19.63063,8.64844Z" transform="translate(-203.86727 -86.11101)" fill="#ffb8b8"></path><path d="M876.96767,562.16094l-17.217-38.31982a13.82422,13.82422,0,1,1,25.522-10.604l15.23706,39.84082Z" transform="translate(-203.86727 -86.11101)" fill="#2f2e41"></path><path d="M856.27693,444.58752a4.06328,4.06328,0,0,0,4.31681-2.40945,5.85068,5.85068,0,0,0-.41557-5.13768,10.73569,10.73569,0,0,0-3.7759-3.70338,12.406,12.406,0,0,0-5.98158-2.05789,7.46122,7.46122,0,0,0-5.79386,2.19927,5.37673,5.37673,0,0,0-.97171,5.92757c.89811,1.73189,2.78252,2.70308,4.61861,3.36249a27.09442,27.09442,0,0,0,11.37778,1.49441" transform="translate(-203.86727 -86.11101)" fill="#2f2e41"></path><path d="M865.01139,471.07182c-3.827,1.11454-3.61863-.94778-5.7169-4.33684s-4.82607-7.3773-8.80645-7.165c-3.262.17394-5.53377,3.13712-7.85885,5.4316-4.14412,4.08956-10.15988,6.67913-15.8467,5.43076s-10.37564-7.11523-9.12618-12.80181a11.94249,11.94249,0,0,1,5.88027-7.46677,24.02835,24.02835,0,0,1,9.32469-2.726,49.64692,49.64692,0,0,1,21.41981,2.24043c4.75583,1.59573,9.53714,4.17684,11.90414,8.59969s4.43914,10.823-.17383,12.794Z" transform="translate(-203.86727 -86.11101)" fill="#2f2e41"></path><path d="M852.899,431.91847c-3.2427-4.11085-2.02127-10.58761,1.75819-14.21113s9.39951-4.75287,14.615-4.292a29.6206,29.6206,0,0,1,24.02454,17.27486c3.29591,7.53929,3.2687,16.16291,6.24936,23.83231a32.13673,32.13673,0,0,0,43.41,17.54257c5.18809-2.39208,10.12829-7.07632,9.83209-12.78163,3.28017,12.64629-2.62756,27.11236-13.82269,33.84715-6.55732,3.94476-14.32314,5.284-21.91988,6.20555-4.95073.60059-10.03889,1.04741-14.87-.18987-6.75916-1.731-12.4182-6.71982-15.84495-12.79766s-4.77477-13.16056-4.827-20.13767c-.04071-5.4353.67085-10.87348.29483-16.29592s-2.00606-11.03112-5.93667-14.78538-10.5637-4.98991-14.87754-1.6831c-1.73367,1.329-3.00428,3.26972-4.95633,4.25017s-5.036.21793-5.16664-1.96259Z" transform="translate(-203.86727 -86.11101)" fill="#2f2e41"></path><path d="M984.16386,808.14343h-307.294a1.19069,1.19069,0,0,1,0-2.38137h307.294a1.19069,1.19069,0,0,1,0,2.38137Z" transform="translate(-203.86727 -86.11101)" fill="#3f3d56"></path>
                        </svg>
                        <div class="content-error">
                            <div class="hpanel">
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <a href="/daftar" class="btn btn-warning btn-block ">Daftar</a>
                                            <br>
                                            <br>
                                            <br>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- <div class="content-error">
                <div class="hpanel">
                    <div class="panel-body">
                        <form action="{{route('login')}}" method="post" id="loginForm">
                            @csrf
                            {!!Form::text('email', '')->placeholder('Email')!!}
                            {!!Form::text('password', '')->type('password')->placeholder('Password')!!}
                            @if (Route::has('password.request'))
                            <a class="btn-link" href="{{ route('password.request') }}">
                                <small>{{ __('Lupa Password?') }}</small>
                            </a>
                            @endif
                            <div class="login-checkbox">
                      <label><input type="checkbox" class=""> Remember me </label>
                      <p class="help-block small">(if this is a private computer)</p>
                  </div> 
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                    <a href="/daftar" class="btn btn-default btn-block ">Daftar Gratis</a>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                    <button class="btn btn-success btn-block loginbtn">Masuk</button>
                                </div>
                            </div>
                            <hr>

                        </form>
                        <div class="clearfix">OR</div>
                        <div class="row">
                            <div class="col-lg-6 col-xs-12">
                                <a class="btn btn-default btn-block " href="{{ url('/auth/google') }}"><i
                                        class="fa fa-google"></i> Login with Google</a>
                            </div>
                            <div class="col-lg-6 col-xs-12">
                                <a class="btn btn-default btn-block " href="{{ url('/auth/facebook') }}"><i
                                        class="fa fa-facebook"></i> Login with Facebook</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->
        </div>
    </div>
    <script src="{{ url('js/all.js') }}"></script>
    <!-- icheck JS
		============================================ -->
    <script src="js/icheck/icheck.min.js"></script>
    <script src="js/icheck/icheck-active.js"></script>
</body>

</html>