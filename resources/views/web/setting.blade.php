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
                            <div class="product-payment-inner-st">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="border-bottom:solid 1px #ddd;">
                                        <div class="row">
                                            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                                <ul id="myTabedu1" class="tab-review-design">
                                                    <li class="active"><a href="#akun">Informasi Akun</a></li>
                                                    <li><a href="#personal"> Personal </a></li>
                                                    <li class="hidden-lg hidden-md">
                                                        <a href="{{route('web.setting.show', ['notification'])}}">
                                                            Notifikasi
                                                        </a>
                                                    </li>
                                                    <li class="hidden-lg hidden-md">
                                                        <a href="{{route('web.setting.show', ['sharing'])}}">
                                                            Koneksivitas
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 text-right">
                                                <a href="#" class="btn btn-primary save">SIMPAN</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="myTabContent" class="tab-content custom-product-edit">
                                        <div class="product-tab-list tab-pane fade active in" id="akun">
                                            <div class="">
                                                <div class="col-lg-offset-1 col-lg-11 col-md-12 col-sm-12 col-xs-12 mg-t-10">
                                                    <div class="review-content-section">
                                                        <div id="dropzone1" class="pro-ad">
                                                            {!!Form::open()->post()->route('web.setting.store')->attrs(['id' => 'form-profile'])!!}
                                                                <div class="row ">
                                                                    <div class="col-lg-7 col-md-6 col-sm-12 col-xs-12">
                                                                        <div class="text-left card">
                                                                            @if(!get_user()->name || !get_user()->phone)
                                                                                <div class="alert alert-warning">
                                                                                    <span>Silahkan isi input di bawah dengan lengkap</span>
                                                                                </div>
                                                                            @endif
                                                                            {!!Form::text('name', 'Nama', get_user()->name)!!}
                                                                            {!!Form::text('email', 'Email', get_user()->email)!!}
                                                                            {!!Form::text('phone', 'No. Handphone', get_user()->phone)!!}
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-offset-1 col-lg-4 col-md-6 col-sm-12 col-xs-12">
                                                                        <div class="box">
                                                                            <div class="text-left">
                                                                                {!!Form::text('password', 'Password baru')->placeholder('Password baru')->type('password')!!}
                                                                                {!!Form::text('password_confirmation', 'Konfirmasi password baru')->placeholder('Konfirmasi Password')->type('password')!!}
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
                                        <div class="product-tab-list tab-pane fade" id="personal">
                                            <div class="">
                                                <div class="col-lg-offset-1 col-lg-11 col-md-12 col-sm-12 col-xs-12">
                                                    <div class="review-content-section">
                                                        <div class="row">
                                                            <div id="app" class="col-lg-3 col-md-4 col-sm-12 col-xs-12">
                                                                <div class="pull-left">
                                                                    @if(get_user()->attachment_source)
                                                                    <div class="text-center">
                                                                        <img class="round-img" src="{{get_user()->attachment_source->slug}}" />
                                                                    </div>
                                                                    <div class="clearfix"></div><br>
                                                                    @endif
                                                                    <!-- <label for="">Avatar</label> -->
                                                                    <upload :id={{ get_user()->id }} placeholder-text="Update Profile Picture" type-data="image" model-data="user" slug-url="{{get_user()->attachment_source ? route('upload.update', [get_user()->attachment_source->id]):route('upload.store')}}"></upload>           
                                                                    
                                                                </div>

                                                            </div>
                                                            <div class="col-lg-offset-1 col-lg-8 col-md-8 col-sm-12 col-xs-12">
                                                                {!!Form::open()->post()->route('web.setting.store', ['#personal'])->attrs(['id' => 'form'])!!}
                                                                    <div class="row">
                                                                    
                                                                        <div class="col-lg-12 col-md-8 col-sm-12 col-xs-12">
                                                                            {!!Form::text('personal_status', 'Personal Status', get_user()->personal_status)->attrs(['class' => 'input-lg'])!!}
                                                                            <!-- {!!Form::text('nick_name', 'Nick Name', get_user()->nick_name)!!} -->
                                                                            {!!Form::select('sex', 'Jenis Kelamin', ['male'=>'Laki-laki','women'=>'Perempuan','privacy'=>'None'], get_user()->sex)!!}
                                                                            <div class="form-group">
                                                                                <div class="input-daterange input-group" id="datepicker">
                                                                                    {!! Form::text('birthday', 'Tanggal Lahir', get_user()->birthday)->autocomplete('off')->attrs(['class' => 'form-control']) !!}
                                                                                </div>
                                                                            </div>
                                                                            {!!Form::text('location', 'Kota', get_user()->location)!!}
                                                                            
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-lg-12">
                                                                            <div class="payment-adress">
                                                                                <!-- <button type="submit" class="btn btn-primary waves-effect waves-light">SIMPAN</button> -->
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
        </div>
    </div>
</div>
@endsection

@section('style')
    <link rel="stylesheet" href="{{ url('css/dropzone/dropzone.css') }}">
    <link rel="stylesheet" href="{{ url('css/datapicker/datepicker3.css') }}">
    <link rel="stylesheet" href="{{ url('css/select2/select2.min.css') }}">
	<link rel="stylesheet" href="{{ url('css/chosen/bootstrap-chosen.css') }}">
@endsection

@section('script')
    <script src="{{ url('js/datapicker/bootstrap-datepicker.js') }}"></script>
	<script src="{{ url('js/datepicker/datepicker-active.js') }}"></script>
    <script>
        $('body').attr('class', 'mini-navbar');
        $('#sidebar').attr('class', 'active');
        $(".save").click( function() {
            $('.active form').submit();
        });

        $(document).ready(function () {
            hash = window.location.hash;
            elements = $('a[href="' + hash + '"]');
            if (elements.length === 0) {
                $("ul.tabs li:first").addClass("active").show(); //Activate first tab
                $(".tab_content:first").show(); //Show first tab content
            } else {
                elements.click();
            }
        });
    </script>
@endsection