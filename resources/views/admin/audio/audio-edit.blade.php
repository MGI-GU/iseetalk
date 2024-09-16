@extends('layouts.admin.main')

@section('content')
    <div class="blog-details-area mg-t-30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="blog-details-inner white-box mg-t-30">
                        <div class="row">
                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                                <a href="{{route('web.listen', [$audio->slug])}}"><img src="{{get_audio_cover($audio->cover_source ? $audio: ($audio->parent? $audio->parent:$audio))}}" alt=""  ></a>
                                <p class="mg-t-10">
                                    <b>Audio</b><br>
                                    <small>{{$audio->name}}</small><br />
                                    <a href="{{route('web.listen', [$audio->slug])}}"><small>{{'listen/'.$audio->slug}}</small></a>
                                </p>
                                @include('admin.audio.audio-menu')
                            </div>
                            <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
                                <div class="latest-blog-single blog-single-full-view">
                                    <div class="blog-image">
                                        <!-- <h4>{{$audio->name}}</h4> -->
                                        <!-- <audio id="audio" controls style="width: 100%;background: #f1f3f4;">
                                            <source src="{{get_audio_source($audio)}}" type="audio/mpeg" autoplay>
                                            Your browser does not support the audio element.
                                        </audio> -->
                                        @include('layouts.audioslide')
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="blog-details blog-sig-details mg-t-30">
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="border-bottom:solid 1px #ddd;">
                                                <div class="row">
                                                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                                        <ul id="myTabedu1" class="tab-review-design" >
                                                            <li class="active" ><a href="#home"><small>Standard</small></a></li>
                                                            <li ><a href="#advance"><small> Advance</small></a></li>
                                                            @if(@$audio->project->status=='step5')
                                                            <li ><a href="{{route('admin.audio.slide', [$audio->id])}}"><small> Slide Manager</small></a></li>
                                                            @endif
                                                        </ul>
                                                    </div>
                                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 text-right">
                                                        <a href="{{ route('admin.audio.show', $audio->format_id) }}" class="btn btn-inverse">Back</a>
                                                        @if(is_leader(auth()->user())!='false' || is_admin(auth()->user())=='master_admin' || is_admin(auth()->user())=='super_admin')
                                                        <a href="#" class="btn btn-success save">SAVE</a>
                                                        @endif
                                                        @if(is_leader(auth()->user())!='false')
                                                        <a href="#" data-toggle="dropdown" class="btn dropdown-toggle"><i class="fa fa-ellipsis-v"></i></a>
                                                        <ul class="dropdown-menu pull-right">
                                                            @if($audio->status=='publish' && $audio->backup)
                                                            <li><a href="{{route('admin.audio.update.status', [$audio->id, 'reset'])}}"><i class="fa fa-refresh"></i> RESET</a></li>
                                                            @endif
                                                            <li><a href="{{route('admin.audio.update.status', [$audio->id, 'revoke'])}}"><i class="fa fa-undo"></i> REVOKE</a></li>
                                                            <li><a href="#"><i class="fa fa-download"></i> DOWNLOAD</a></li>
                                                            <li><a href="#" id="delete"><i class="fa fa-trash"></i> DELETE</a></li>
                                                        </ul>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        {!!Form::open()->put()->route('admin.audio.update', [$audio->id])->id('data')!!}
                                        <div id="myTabContent" class="tab-content mg-t-15">
                                            <div class="product-tab-list tab-pane fade active in" id="home">
                                                <div class="row">
                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                        <div class="pro-ad">
                                                            <div id="app" class="row">
                                                                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                                                    @if(is_leader(auth()->user())!='false')
                                                                        {!!Form::text('name', 'Title', $audio->name)->autocomplete('off')!!}
                                                                        {!!Form::textarea('description', 'Description')->value($audio->description)->autocomplete('off')!!}
                                                                    @else
                                                                        <div class="form-group">
                                                                            <label for="">Title</label>
                                                                            <p class="panel-footer ft-pn" placeholder="">{{$audio->name}}</p>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="">Description</label>
                                                                            <p class="panel-footer ft-pn" placeholder="">{{$audio->description}}</p>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="">Tags</label>
                                                                            <p class="panel-footer ft-pn" placeholder="">{!! get_tag_link($audio->tags) !!}</p>
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                                    <div class="row">
                                                                        @if($audio->status=='draft')
                                                                        <div class="col-lg-12">
                                                                            <h5>Update Logo</h5>
                                                                            <upload :id={{ $audio->id }} placeholder-text="Click to upload Audio Cover" type-data="cover" model-data="audio" slug-url="{{$audio->cover_source ? route('admin.upload.update', [$audio->cover_source->id]):route('admin.upload.store')}}"></upload>
                                                                        </div>
                                                                        <div class="col-lg-12">
                                                                            <br>
                                                                            <h5>Update Audio File</h5>
                                                                            <upload-audio :id={{ $audio->id }} source-upload="inhouse" type-data="audio" slug-url="{{$audio->source?route('admin.upload.update', [$audio->source]):route('admin.upload.store')}}"></upload-audio>
                                                                        </div>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="product-tab-list tab-pane fade" id="advance">
                                                <div class="row">
                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                        <div class="pro-ad">
                                                            
                                                            <div class="row">
                                                                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                                                    <div class="form-group">
                                                                        <label for="">General</label>
                                                                    </div>
                                                                    <div class="form-group well">
                                                                        {!!Form::select('language', 'Language', get_languages()->toArray(),$audio->language)!!}
                                                                        {!!Form::select('visibility', 'Visibility', ['public' => 'Public', 'private'=>'Private'])!!}
                                                                        {!!Form::checkbox('allow_rating', ' Visitor can view audio ratings', 1, $audio->allow_rating==1?true:false)!!}
                                                                        {!!Form::checkbox('allow_notice', ' Notif to Subscriber',1, $audio->allow_notice==1?true:false)!!}
                                                                        {!!Form::checkbox('allow_age', 'Age restriction', 1, $audio->allow_age==1?true:false)!!}
                                                                        {!!Form::hidden('duration')->value($audio->duration)!!}
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                                                    <div class="form-group">
                                                                        <label for="">Comment</label>
                                                                    </div>
                                                                    <div class="form-group well">
                                                                        {!!Form::select('allow_comment', 'Allow Comment', ['1'=>'Izinkan semua komentar','2'=>'Tinjau semua komentar','0'=>'Tidak'], $audio->allow_comment)!!}
                                                                        {!!Form::select('sort_comment', 'Sort by', ['0'=>'Populer','1'=>'Newest'], $audio->sort_comment)!!}
                                                                    </div>
                                                                    <hr>
                                                                </div>
                                                                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                                                    @if($audio->status=='')
                                                                        <div class="form-group">
                                                                            <label for="">Status</label>
                                                                        </div>
                                                                        <div class="form-group well">
                                                                            @if(is_leader(auth()->user())!='false' && $audio->source_label == 'inHouse')
                                                                                {!!Form::select('progress_status', 'Update Progress Status', ['step1'=>'Step Copy Writer','step2'=>'Step Audio Engineer','step3'=>'Step Slide Manager', 'step4'=>'Step Graphic Designer', 'review'=>'Approved'], $audio->project->status)!!}
                                                                            @elseif(is_admin(auth()->user())!='false' && $audio->source_label == 'User')
                                                                                {!!Form::select('approval_status', 'Approval', ['suspend'=>'Suspend','publish'=>'Approve'], $audio->status)!!}
                                                                            @endif
                                                                        </div>
                                                                    @endif
                                                                    <div class="form-group">
                                                                        <label for="">Other</label>
                                                                    </div>
                                                                    <div class="form-group well">
                                                                        {!!Form::select('category_id', 'Category', get_categories()->toArray(), $audio->category_id)!!}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {!! Form::close() !!}

                                        <div id="PrimaryModalalert" class="modal default-popup-PrimaryModal fade" role="dialog">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-close-area modal-close-df">
                                                        <a class="close" data-dismiss="modal" href="#"><i class="fa fa-close"></i></a>
                                                    </div>
                                                    {!!Form::open()->put()->route('admin.slide.update', [':id'])->id('form-slide')!!}

                                                        <div class="modal-body">
                                                            @if(@$image)
                                                            <img id="view-slide" src="{{$image->source}}" alt="" style="max-height: 100px;"/>
                                                            @endif
                                                            <hr>
                                                            {!!Form::text('title', 'Title', '')->autocomplete('off')!!}
                                                            {!!Form::text('time_show', 'Start time', '')->autocomplete('off')!!}
                                                            {!!Form::text('time_end', 'End Time', '')->autocomplete('off')!!}
                                                            <div id="slider-range"></div>
                                                            <br>
                                                            <p>
                                                                <label for="amount">Time range:</label>
                                                                <input type="text" id="amount" readonly style="border:0; color:#f6931f; font-weight:bold;">
                                                            </p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <a data-dismiss="modal" href="#">Cancel</a>
                                                            <button class="btn btn-success" type="submit">Save</button>
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

@endsection

@section('style')
    <link rel="stylesheet" href="{{url('css/select2/select2.min.css')}}">
    <link rel="stylesheet" href="{{url('css/chosen/bootstrap-chosen.css')}}">
    <link rel="stylesheet" href="{{ url('css/modals.css') }}">
    <!-- <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"> -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">
    <link rel="stylesheet" href="{{url('css/summernote/summernote.css')}}">
@endsection

@section('script')
    <!-- chosen JS
		============================================ -->
    <script src="{{url('js/chosen/chosen.jquery.js')}}"></script>
    <script src="{{url('js/chosen/chosen-active.js')}}"></script>
    <!-- select2 JS
		============================================ -->
    <script src="{{url('js/select2/select2.full.min.js')}}"></script>
    <script src="{{url('js/select2/select2-active.js')}}"></script>
    <script src="{{url('js/ui/1.12.1/jquery-ui.js')}}"></script>
    <script src="{{url('js/summernote/summernote.min.js')}}"></script>
    <script>
        /*--------------------------
        TEXT EDITOR
        ---------------------------- */	
        $('#inp-description').summernote({
            toolbar: [
                // [groupName, [list of button]]
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['font', ['strikethrough', 'superscript', 'subscript']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['height', ['height']]
            ],
            height: 200,
        });
        $(window).load(function() {
            $('#loading').hide();
            $('.audio-slides').show();
        });
        $('body').attr('class', 'mini-navbar');
        $('#sidebar').attr('class', 'active');
        document.getElementById("audio").onloadedmetadata = function() {
            $('#inp-duration').val(document.getElementById("audio").duration);
        };
        function slider(start, end){
            $( function() {
                $( "#slider-range" ).slider({
                    range: true,
                    min: 0,
                    max: document.getElementById("audio").duration,
                    values: [ start, end ],
                    slide: function( event, ui ) {
                        $( "#amount" ).val( ui.values[ 0 ] + " seconds - " + ui.values[ 1 ] +" seconds" );
                        $("#inp-time_show").val(ui.values[ 0 ]);
                        $("#inp-time_end").val(ui.values[ 1 ]);
                    }
                });
                $( "#amount" ).val( $( "#slider-range" ).slider( "values", 0 ) +
                " seconds - " + $( "#slider-range" ).slider( "values", 1 ) +  " seconds" );

            } );
        }

        $('input[name=time_show]').change(function() {
            slider($(this).val(), $("#inp-time_end").val());
        });

        $('input[name=time_end]').change(function() {
            slider($("#inp-time_show").val(), $(this).val());
        });

        $(".save").click( function() {
            $('form#data').submit();
        });

        $(".edit-slide").click(function(){
            var id = $(this).attr('data-id');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{route('admin.slide.get')}}",
                type: 'post',
                dataType: "JSON",
                data: {
                    "id": id
                },
                success: function (response)
                {
                    var show_url = $('#form-slide').attr("action");
                    $('#form-slide').attr("action", show_url.replace(":id", response.id));
                    $('#view-slide').attr("src", response.source);
                    $('#inp-title').val(response.title);
                    $('#inp-time_show').val(response.time_show);
                    $('#inp-time_end').val(response.time_end);
                    slider(response.time_show, response.time_end);
                },
                error: function(xhr,response) {
                    //
                }
            });
        });
        var delete_url = '{{ route("admin.audio.delete") }}';
        var redirect_url = '{{ route("admin.audio.index") }}';
        var $delete = $('#delete');
        var data_id = '{{$audio->id}}';
    </script>
    <script src="{{ url('js/data-table/single-delete.js')}}"></script>
@endsection
