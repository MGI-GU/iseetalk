@extends('layouts.admin.main')

@section('content')
<!-- Single pro tab review Start-->
<div class="single-pro-review-area mg-t-30 mg-b-15">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="product-payment-inner-st mg-t-30">
                    <a class="btn back-btn" href="{{route('admin.member.index')}}"><i class="fa fa-angle-left"></i></a>
                    <ul id="myTabedu1" class="tab-review-design">
                        <li class="active"><a href="#description">Add Admin</a></li>
                    </ul>
                    <div id="myTabContent" class="tab-content custom-product-edit">
                        <div class="product-tab-list tab-pane fade active in" id="description">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="review-content-section">
                                        <div id="" class="pro-ad">
                                            {!!Form::open()->post()->route('admin.member.store')!!}
                                                <div class="row">
                                                    <div id="app" class="col-md-offset-3 col-lg-6 col-md-6 col-sm-12 col-xs-12 well">

                                                        <div class="form-group">
                                                            <input-select data-label="Select User" data-name="user" data-placeholder="Select user" :option='{{ json_encode(get_user_admin("vue")) }}' :values='{{json_encode(get_user_admin())}}'></input-select>
                                                        </div>
                                                        @if(is_admin(auth()->user())=='super_admin')
                                                        {!!Form::select('role_id', 'Role', get_role_team('admin')->toArray())!!}
                                                        @else
                                                        {!!Form::select('role_id', 'Role', get_role_team('general_admin')->toArray())!!}
                                                        @endif
                                                        <div class="selector_category">
                                                            <multi-select data-label="Category" data-name="category" data-placeholder="Select Categories" :option='{{ json_encode(get_active_categories("vue")) }}' :values='{{json_encode(get_active_categories())}}'></multi-select>
                                                        </div>
                                                        <!-- <label class="selector_category" for="">Category</label>
                                                        <select id="select_category" name="category" disabled="disabled" class="selectpicker form-control selector_category" >
                                                            <option selected value="" >-- Select Categories --</option>
                                                            @foreach(get_active_categories() as $cat)
                                                                <option value="{{$cat->id}}">{{$cat->name}}</option>
                                                                @if($cat->subcategory->count()>0))
                                                                <optgroup label="-">
                                                                    @foreach($cat->subcategory as $sub)
                                                                    <option value="{{$sub->id}}">{{$sub->name}}</option>
                                                                    @endforeach
                                                                </optgroup>
                                                                @endif
                                                            @endforeach
                                                        </select> -->

                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="payment-adress">
                                                            <button type="submit" class="btn btn-primary waves-effect waves-light">Save</button>
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
@endsection

@section('style')
    <link rel="stylesheet" href="{{ url('css/dropzone/dropzone.css') }}">
@endsection

@section('script')
<script src="{{ url('js/dropzone/dropzone.js') }}"></script>
<!-- icheck JS
============================================ -->
<script src="{{ url('js/icheck/icheck.min.js') }}"></script>
<script src="{{ url('js/icheck/icheck-active.js') }}"></script>
<script>
    $('#inp-role_id').on('change', function() {
        if(this.value<=2){
            $('.selector_category').hide();
            $('#select_category').prop('disabled', 'disabled');
        }else{
            $('.selector_category').show();
            $('#select_category').prop('disabled', false);
        }
    });
</script>
@endsection
