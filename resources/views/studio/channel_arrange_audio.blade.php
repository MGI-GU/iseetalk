@extends('layouts.studio.main')

@section('content')
    <div class="blog-details-area mg-t-15">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="blog-image cover-image image-channel-cover" style="background:url({{get_cover($data)}})"></div>
                    <div class="blog-details-inner white-box">
                        <div class="row">
                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                                <a href="{{route('web.channel.show', [$data->slug])}}"><img src="{{get_attachment_source($data)->slug}}" alt=""  ></a>
                                <p class="mg-t-10"><br><small>URL : <a href="{{route('web.channel.show', [$data->slug])}}">/channel/{{$data->slug}}</a></small></p>
                            </div>
                            <div id="app"  class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
                                <div class="latest-blog-single blog-single-full-view">
                                    <div class="blog-image">
                                        <h4>{{$data->name}}</h4>
                                    </div>
                                    <div class="blog-details blog-sig-details mg-t-30">
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="border-bottom:solid 1px #ddd;">
                                                <div class="row">
                                                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                                        <ul id="myTabedu1" class="tab-review-design" >
                                                            <li class="active"><a href="#audio"><small>List Audioslide</small></a></li>
                                                            <li ><a href="{{route('studio.channel.edit', [$data->slug])}}"><small>About Channel</small></a></li>
                                                        </ul>
                                                    </div>
                                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 text-right">
                                                        <a href="{{ URL::previous() }}" class="btn btn-inverse">BATAL</a>
                                                        <a href="#" class="btn btn-success save">SAVE</a>
                                                        <a href="#" data-toggle="dropdown" class="btn dropdown-toggle"><i class="fa fa-ellipsis-v"></i></a>
                                                        <ul class="dropdown-menu pull-right">
                                                            <li><a href="#" data-toggle="modal" data-target="#delete"><i class="fa fa-trash"></i> DELETE</a></li>
                                                        </ul>
                                                        <div id="delete" class="modal modal-edu-general FullColor-popup-DangerModal fade" role="dialog">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header header-color-modal bg-color-4"></div>
                                                                    <div class="modal-body">
                                                                            
                                                                        <h4 class="pull-left">Are you sure to delete this channel ?</h4>
                                                                        <br>
                                                                        <p class="pull-left">Delete action also will delete all audio in this channel</p>
                                                                        {!!Form::open()->post()->route('studio.channel.delete', [$data->slug])->id('data')!!}
                                                                            <div class="row">
                                                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-left">
                                                                                    <div class="pull-right">
                                                                                        <a class="btn btn-default" data-dismiss="modal" href="#">Cancel</a>
                                                                                        <button type="submit" class="btn btn-primary waves-effect waves-light">DELETE</button>
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
                                    <div id="myTabContent" class="tab-content custom-product-edit">
                                        <div class="product-tab-list tab-pane fade active in" id="home">
                                            <div class="row">
                                                <div class="col-lg-offset-1 col-lg-11 col-md-12 col-sm-12 col-xs-12">
                                                    
                                                    <div class="pro-ad mg-t-15">
                                                        @if($data->audios->count() > 0)
                                                        <ul id="sortable">
                                                            @foreach($data->audios as $audio)
                                                                <li class="ui-state-default well" id="{{$audio->id}}"><span class="fa fa-arrows fa-sm"></span>{{$audio->name}} <a class="btn btn-sm btn-link" href="{{ route('studio.audio.show', $audio->slug) }}"><i class="fa fa-link"></i></a></li>
                                                            @endforeach
                                                        </ul>
                                                        @else
                                                        <div class="text-center">
                                                            <a class="btn btn-default" href="{{route('upload', ['ch' => $data->slug])}}">Add new Audio</a>
                                                        </div>
                                                        @endif
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
<link rel="stylesheet" href="{{url('css/select2/select2.min.css')}}"> 
<link rel="stylesheet" href="{{url('css/chosen/bootstrap-chosen.css')}}">
<!-- normalize CSS
============================================ -->
<link rel="stylesheet" href="{{ url('css/data-table/bootstrap-table.css')}}">
<link rel="stylesheet" href="{{ url('css/data-table/bootstrap-editable.css')}}">
<style>
    #sortable { list-style-type: none; margin: 0; padding: 0; width: 60%; }
    #sortable li { cursor: move;margin: 0 3px 3px 3px; padding: 0.4em; padding-left: 1.5em; font-size: 1.4em; list-style: decimal; }
    #sortable li span { margin-left: -1.3em;font-size: small;margin-right: 10px; }
</style>
@endsection

@section('script')
<script>
    $('body').attr('class', 'mini-navbar');
    $('#sidebar').attr('class', 'active');
</script>
    <script src="{{ url('js/ui/1.12.1/jquery-ui.js')}}"></script>
    <!-- chosen JS
		============================================ -->
    <script src="{{url('js/chosen/chosen.jquery.js')}}"></script>
    <script src="{{url('js/chosen/chosen-active.js')}}"></script>
    <!-- select2 JS
		============================================ -->
    <script src="{{url('js/select2/select2.full.min.js')}}"></script>
    <script src="{{url('js/select2/select2-active.js')}}"></script>
    <script>

        $( "#sortable" ).disableSelection();
        $('#sortable').sortable();
        $('.save').on('click', function () {
            var data = $("#sortable").sortable("toArray");
            var a = $("#sortable").sortable("serialize", {
                attribute: "id"
            });
            console.log(data);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                data: {
                    "id": data
                },
                dataType: "JSON",
                type: 'post',
                url: '{{ route("studio.audio.order") }}',
                success: function (response)
                {
                    swal({text: response.result,title: "Message"});
                },
                error: function(xhr,response) {
                    swal({text: response.result,title: "Message"});
                }
			})
        });
    </script>
@endsection