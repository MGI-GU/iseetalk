@extends('layouts.web.main')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
            @include('layouts.web.setting')
        </div>
        <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
            <div class="single-pro-review-area mt-t-30 mg-b-15">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="sparkline12-list">
                                <div class="sparkline12-hd">
                                    <div class="main-sparkline12-hd">
                                        <h3>NOTIFIKASI</h3>
                                        <h5>Pengaturan pemberitahuan notifikasi</h5>
                                        <p>Pilih notifikasi yang ingin di terima</p>
                                    </div>
                                </div>
                                <hr>
                                <div class="sparkline12-graph">
                                    <div class="basic-login-form-ad">
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <div class="all-form-element-inner">
                                                    {!!Form::open()->put()->route('web.setting.update', [get_user()->setting->id ?? 0])->attrs(['id' => 'form'])!!}

                                                        <div class="form-group-inner">
                                                            <div class="row">
                                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                    <label>Umum </label>
                                                                    <p>Pengaturan web notifikasi </p>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                                                                    <label class="login2">Kirimkan saya</label>
                                                                </div>
                                                                <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">
                                                                    <div class="bt-df-checkbox pull-left">
                                                                    <div class="row">
                                                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                                
                                                                                <div class="i-checks pull-left">
                                                                                    {!!Form::checkbox('web_subscription', 'Berlanganan', get_user()->setting->web_subscription ?? 0, get_user()->setting->web_subscription ?? 0)!!}
                                                                                    <span class="help-block">Notifikasi aktifitas dari channel langanan</span>
                                                                                    <!-- <span class="help-block">Notify me about activity from the channels I'm subscribed to</span> -->
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                                <div class="i-checks pull-left">
                                                                                    {!!Form::checkbox('web_recommendation', ' Rekomendasi audio', get_user()->setting->web_recommendation ?? 0, get_user()->setting->web_recommendation ?? 0)!!}
                                                                                    <span class="help-block">Notifikasi rekomendasi audio</span>
                                                                                    <!-- <span class="help-block">Notify me of videos I might like based on what I watch</span> -->
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                                <div class="i-checks pull-left">
                                                                                    {!!Form::checkbox('web_channel', 'Aktivitas di channel', get_user()->setting->web_channel ?? 0, get_user()->setting->web_channel ?? 0)!!}
                                                                                    <span class="help-block">Notifikasi aktifitas yang ada di channel saya</span>
                                                                                    <!-- <span class="help-block">Notify me about comments and other activity on my channel or videos</span> -->
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                                <div class="i-checks pull-left">
                                                                                    {!!Form::checkbox('web_all_comment', 'Aktivitas di komentar', get_user()->setting->web_all_comment ?? 0, get_user()->setting->web_all_comment ?? 0)!!}
                                                                                    <span class="help-block">Notifikasi aktivitas di semua Comment</span>
                                                                                    <!-- <span class="help-block">Notify me about activity on my comments on others’ videos</span> -->
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                                <div class="i-checks pull-left">
                                                                                    {!!Form::checkbox('web_my_comment_reply', 'Balasan komentar saya', get_user()->setting->web_my_comment_reply ?? 0, get_user()->setting->web_my_comment_reply ?? 0)!!}
                                                                                    <span class="help-block">Notifikasi balasan dari komentar saya</span>
                                                                                    <!-- <span class="help-block">Notify me about replies to my comments</span> -->
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <hr>
                                                        <div class="form-group-inner">
                                                            <div class="row">
                                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                    <label>Notifikasi ke Email </label>
                                                                    <p>Semua email akan di kirim ke {{get_user()->email}}. To unsubscribe from an email, click the "Unsubscribe" link at the bottom of it. Learn more about emails from {{get_apps()->name}}. </p>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                                                                    <label class="login2">Permission</label>
                                                                </div>
                                                                <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">
                                                                    <div class="bt-df-checkbox pull-left">
                                                                        <div class="row">
                                                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                                <div class="i-checks pull-left">
                                                                                    {!!Form::checkbox('email_permission', 'Kirim email notifikasi dari '.get_apps()->name, get_user()->setting->email_permission ?? 0, get_user()->setting->email_permission ?? 0)!!}
                                                                                    <span class="help-block">Jika notifikasi ini di non aktifkan, {{get_apps()->name}} tetap akan mengirimkan informasi mengenai update akun anda, legal update, service update dan lain-lain.</span>
                                                                                    <!-- <label> <input type="checkbox" value=""> <i></i> Send me emails about my YouTube activity and updates I requested </label>
                                                                                    <span class="help-block">If this setting is turned off, YouTube may still send you messages regarding your account, required service announcements, legal notifications, and privacy matters</span> -->
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                                                                    <label class="login2">Kirimkan saya</label>
                                                                </div>
                                                                <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">
                                                                    <div class="bt-df-checkbox pull-left">
                                                                        <div class="row">
                                                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                                <div class="i-checks pull-left">
                                                                                    {!!Form::checkbox('email_subscription', 'Berlanganan', get_user()->setting->email_subscription ?? 0, get_user()->setting->email_subscription ?? 0)!!}
                                                                                    <span class="help-block">Notifikasi aktivitas dari channel langganan</span>
                                                                                    <!-- <span class="help-block">Notify me about activity from the channels I'm subscribed to</span> -->
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                                <div class="i-checks pull-left">
                                                                                    {!!Form::checkbox('email_product', get_apps()->name.' update', get_user()->setting->email_product ?? 0, get_user()->setting->email_product ?? 0)!!}
                                                                                    <span class="help-block">Pemberitahuan dan rekomendasi</span>
                                                                                    <!-- <span class="help-block">Announcements and recommendations</span> -->
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                                <div class="i-checks pull-left">
                                                                                    {!!Form::checkbox('email_channel', get_apps()->name.' channel update', get_user()->setting->email_channel ?? 0)!!}
                                                                                    <span class="help-block">Pemberitahuan dan informasi</span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                                                                    <label class="login2">Bahasa</label>
                                                                </div>
                                                                <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">
                                                                    <div class="bt-df-checkbox pull-left">
                                                                        <div class="row">
                                                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                                <div class="">
                                                                                    
                                                                                    <div class="sparkline10-graph">
                                                                                        <div class="input-knob-dial-wrap">
                                                                                            <div class="chosen-select-single">
                                                                                                {!!Form::select('language', '', get_languages()->toArray(), get_user()->setting->language ?? 0)!!}
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        

                                                        <div class="form-group-inner">
                                                            <div class="login-btn-inner">
                                                                <div class="row">
                                                                    <div class="col-lg-3"></div>
                                                                    <div class="col-lg-9">
                                                                        <div class="login-horizental cancel-wp pull-left form-bc-ele">
                                                                            <button class="btn btn-sm btn-primary login-submit-cs" type="submit">SIMPAN</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    {!! Form::close() !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section("script")
<script>
    $('body').attr('class', 'mini-navbar');
    $('#sidebar').attr('class', 'active');
</script>
@endsection