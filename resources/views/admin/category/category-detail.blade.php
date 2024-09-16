@extends('layouts.admin.main')

@section('content')
<!-- Single pro tab review Start-->
<div class="single-pro-review-area mg-t-30 mg-b-15">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="product-payment-inner-st mg-t-30">
                    <a class="btn back-btn" href="{{route('admin.category.index')}}"><i class="fa fa-angle-left"></i></a>
                    <ul id="myTabedu1" class="tab-review-design">
                        <li class="active"><a href="#basic">Basic</a></li>
                        <li><a href="#teams">Team</a></li>
                    </ul>
                    <div id="myTabContent" class="tab-content custom-product-edit">
                        <div class="product-tab-list tab-pane fade active in" id="basic">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="review-content-section">
                                        <div id="dropzone1" class="pro-ad">
                                            {!!Form::open()->put()->route('admin.category.update', [$category->id])!!}
                                                <div class="row">
                                                    <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                                                        <div class="col-lg-12">
                                                            <a href="#" data-toggle="modal" data-target="#thumbnail" ><img src="{{get_attachment_source($category)['slug']}}" alt="{{ $category->name }}" class="mg-b-30"></a>
                                                        </div>
                                                        <div id="app" class="col-lg-12">
                                                            <upload placeholder-text="Click to upload Category Logo" :id={{ $category->id }} type-data="image" model-data="category" slug-url="{{$category->attachment_source ? route('admin.upload.update', [$category->attachment_source->id]):route('admin.upload.store')}}"></upload>
                                                        </div>

                                                    </div>
                                                    <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                                                        <div class="form-group">
                                                            <label class="mg-t-10">No</label>
                                                            <p>{{$category->id}}</p>
                                                        </div>
                                                        {!!Form::text('name', 'Name', $category->name)->autocomplete('off')!!}
                                                        {!!Form::textarea('description', 'Description', $category->description)->autocomplete('off')!!}

                                                    </div>
                                                    <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                                                        {!!Form::select('parent', 'Parent Category', get_select_categories($category)->toArray(), $category->parent)!!}
                                                        {!!Form::text('order', 'Position Number', $category->order)->type('number')->autocomplete('off')!!}
                                                        {!!Form::select('status', 'Status', ['active'=>'Active', 'inactive'=>'Inactive', 'review'=>'Review'], $category->status)!!}
                                                        <div class="form-group">
                                                            <label for="">Sub Category</label>
                                                            <div class="sparkline9-graph">
                                                                <div class="edu-content res-tree-ov">
                                                                    <div id="category_tree">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="payment-adress">
                                                            <button type="submit" class="btn btn-primary waves-effect waves-light">Submit</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            {!! Form::close() !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="product-tab-list tab-pane fade" id="teams">
                            <div class="row">
                            @if($category->teams)
                                @foreach($category->teams as $team)
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <hr>
                                        <div>
                                            <label for="">Team {{$team->name}}</label>
                                        </div>
                                        @foreach($team->roleuser as $role)
                                            <div>
                                                <div class="col-lg-2 col-md-3 col-sm-3 col-xs-3">
                                                    <div class="hpanel hblue contact-panel-cs responsive-mg-b-30 box">
                                                        <div class="panel-body custom-panel-jw">
                                                            <div class="social-media-in">
                                                                <a href="{{ route('admin.user.show', $role->user->format_id) }}" title="profile"><i class="fa fa-user"></i></a>
                                                                <a href="#" title="Facebook"><i class="fa fa-facebook"></i></a>
                                                                <a href="#" title="Twitter"><i class="fa fa-twitter"></i></a>
                                                            </div>
                                                            <img alt="logo" class="img-circle m-b" width="50" src="{{url($role->user->picture)}}">
                                                            <h3><a href="">{{$role->user_name}}</a></h3>
                                                            <p class="all-pro-ad">{{$role->role_name}}</p>

                                                        </div>
                                                        <!-- <div class="panel-footer contact-footer">
                                                            <div class="professor-stds-int">
                                                                <div class="professor-stds">
                                                                    <div class="contact-stat"><span>Likes: </span> <strong>956</strong></div>
                                                                </div>
                                                                <div class="professor-stds">
                                                                    <div class="contact-stat"><span>Comments: </span> <strong>350</strong></div>
                                                                </div>
                                                                <div class="professor-stds">
                                                                    <div class="contact-stat"><span>Views: </span> <strong>450</strong></div>
                                                                </div>
                                                            </div>
                                                        </div> -->
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @endforeach
                            @else
                            "No Team Selected"
                            @endif
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
    <!-- tree viewer CSS
		============================================ -->
    <link rel="stylesheet" href="{{ url('css/tree-viewer/tree-viewer.css') }}">
@endsection

@section('script')
    <script src="{{ url('js/dropzone/dropzone.js') }}"></script>
    <!-- Tree Viewer JS
		============================================ -->
    <script src="{{ url('js/tree-line/jstree.min.js') }}"></script>
    <script src="{{ url('js/tree-line/jstree.active.js') }}"></script>
    <script>
        $('#category_tree').jstree({
			'core' : {
				'data' : {
					"url" : "{{route('admin.category.edit', [$category->id])}}",
					"dataType" : "json" // needed only if you do not supply JSON headers

				},
				'check_callback' : true
			},
			'plugins' : [ "contextmenu", "dnd", "search", "state", "types", "wholerow" ],
			'types' : {
				'default' : {
					'icon' : 'fa fa-folder'
				},
				'html' : {
					'icon' : 'fa fa-file-code-o'
				},
				'svg' : {
					'icon' : 'fa fa-file-picture-o'
				},
				'css' : {
					'icon' : 'fa fa-file-text-o'
				},
				'img' : {
					'icon' : 'fa fa-file-image-o'
				},
				'js' : {
					'icon' : 'fa fa-file-code-o'
				}

			}
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
