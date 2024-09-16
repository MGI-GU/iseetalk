@extends('layouts.admin.main')

@section('content')
<div class="container-fluid mg-t-30">
    <div class="row mg-t-30">
        <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
            @include('layouts.admin.setting')
        </div>
        <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
            <div class="single-pro-review-area mt-t-30 mg-b-15">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="product-payment-inner-st">
                                <ul id="myTabedu1" class="tab-review-design">
                                    <li class="active"><a href="#description">App Language</a></li>
                                </ul>
                                <div id="myTabContent" class="tab-content custom-product-edit">
                                    <div class="product-tab-list tab-pane fade active in" id="description">
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <div class="review-content-section">
                                                    <div id="dropzone1" class="pro-ad">
                                                        <div class="row">
                                                            <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
                                                                {!!Form::open()->post()->route('admin.master.store.language')!!}
                                                                <div class="row">
                                                                    <div class="col-lg-4">
                                                                        {!!Form::text('code', 'Code')->autocomplete('off')!!}
                                                                    </div>
                                                                    <div class="col-lg-8">
                                                                        {!!Form::text('name', 'Language')->autocomplete('off')!!}
                                                                    </div>
                                                                    <div class="col-lg-12">
                                                                        <button type="submit" class="btn btn-primary waves-effect waves-light">Add</button>
                                                                    </div>
                                                                </div>
                                                                {!! Form::close() !!}
                                                            </div>
                                                            <div class="col-lg-offset-1 col-lg-5 col-md-5 col-sm-12 col-xs-12">
                                                                <div class="form-group">
                                                                    <table class="table">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>Code</th>
                                                                                <th>Name</th>
                                                                                <th>Created at</th>
                                                                                <th>Deleted at</th>
                                                                                <th>Action</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            @foreach($lang as $key => $la)
                                                                            <tr>
                                                                                <td width="50">{{$la->code}}</td>
                                                                                <td>{{$la->name}}</td>
                                                                                <td>{{$la->created_at}}</td>
                                                                                <td>{{$la->deleted_at}}</td>
                                                                                @if(!$la->deleted_at)
                                                                                <td>
                                                                                    {!!Form::open()->delete()->route('admin.language.delete', [$la->id])!!}
                                                                                        {!!Form::hidden('id')->value($la->id)!!}
                                                                                        <button type="submit" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></button>
                                                                                    {!! Form::close() !!}
                                                                                </td>
                                                                                @endif
                                                                            </tr>
                                                                            @endforeach
                                                                        </tbody>
                                                                    </table>
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
</div>
@endsection

@section('script')
<script>
    $('body').attr('class', 'mini-navbar');
    $('#sidebar').attr('class', 'active');
    
</script>
@endsection