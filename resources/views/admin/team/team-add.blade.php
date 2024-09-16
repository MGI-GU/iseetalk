@extends('layouts.admin.main')

@section('content')
<!-- Single pro tab review Start-->
<div class="single-pro-review-area mg-t-30 mg-b-15">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="product-payment-inner-st  mg-t-30">
                    <a class="btn back-btn" href="{{route('admin.team.index')}}"><i class="fa fa-angle-left"></i></a>
                    <ul id="myTabedu1" class="tab-review-design">
                        <li class="active"><a href="#description">Data team</a></li>
                    </ul>
                    <div id="myTabContent" class="tab-content custom-product-edit">
                        <div class="product-tab-list tab-pane fade active in" id="description">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                    <div class="review-content-section">
                                        <div id="" class="pro-ad">
                                            {!!Form::open()->post()->route('admin.team.store')!!}
                                                <div class="row">
                                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                        <div class="form-group">
                                                            <!-- {!!Form::select('category', 'Kategori', get_team_categories()->toArray())!!} -->
                                                            <label for="">Category</label>
                                                            <select name="category" class="selectpicker form-control" >
                                                                <option selected value="">-- Select Categories --</option>
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
                                                            </select>
                                                        </div>
                                                        {!!Form::text('name', 'Team Name')->autocomplete('off')!!}
                                                        <div id="app" class="form-group">
                                                            @if(is_leader(auth()->user())!=='false')
                                                            {!!Form::text('leader_name', 'Team Leader', auth()->user()->name)->readonly()!!}
                                                            {!!Form::hidden('leader', auth()->user()->id)->readonly()!!}
                                                            @else
                                                            <input-select data-label="Leader" data-name="leader" data-placeholder="+ Select leader" :option='{{ json_encode(get_user_teams("vue")) }}' :values='{{json_encode(get_user_teams())}}'></input-select>
                                                            @endif
                                                        </div>
                                                        {!!Form::textarea('description', 'Description')->autocomplete('off')!!}
                                                        <div class="payment-adress">
                                                            <button type="submit" class="btn btn-primary waves-effect waves-light">SAVE</button>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                                        <div class="sparkline13-graph">
                                                            <div class="datatable-dashv1-list custom-datatable-overright">
                                                                
                                                                <table id="table" data-toggle="table" data-pagination="true" data-search="true" data-show-columns="true" data-show-pagination-switch="true" data-show-refresh="true" data-key-events="true" data-show-toggle="true" data-resizable="true" data-cookie="true"
                                                                    data-cookie-id-table="saveId" data-show-export="true" data-toolbar="#toolbar">
                                                                    <thead>
                                                                        <tr>
                                                                            <th data-field="id" data-editable="false">ID</th>
                                                                            <th data-field="name" data-editable="false">Name</th>
                                                                            <th data-field="role" data-editable="false">Role</th>
                                                                            <th data-field="action" data-editable="false">Action</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        
                                                                    </tbody>
                                                                </table>
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
@endsection

@section('style')
    <link rel="stylesheet" href="{{ url('css/modals.css') }}">
    <link rel="stylesheet" href="{{ url('css/dropzone/dropzone.css') }}">
    <!-- normalize CSS
    ============================================ -->
    <link rel="stylesheet" href="{{ url('css/data-table/bootstrap-table.css')}}">
    <link rel="stylesheet" href="{{ url('css/data-table/bootstrap-editable.css')}}">

@endsection

@section('script')
    <script src="{{ url('js/dropzone/dropzone.js') }}"></script>
    <!-- data table JS
    ============================================ -->
    <script src="{{ url('js/data-table/bootstrap-table.js')}}"></script>
@endsection