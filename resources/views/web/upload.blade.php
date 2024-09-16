@extends('layouts.web.main')

@section('content')
    <div id="app" class="blog-details-area mg-b-15">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-offset-1 col-md-offset-1 col-lg-11 col-md-10 col-sm-10 col-xs-10 white-box">
                    <div class="mg-t-30">
                        <div id="myTabContent" class="tab-content custom-product-edit">
                            <div class="product-tab-list tab-pane fade active in" id="home">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div id="dropzone1" class="pro-ad">
                                            <div id="app">
                                                <upload-audio channel-id="{{request()->get('ch')}}" :source="user" :options="dropzoneOptions" :id={{auth()->getUser()->id}} type-data="audio" type-model="user" slug-url="{{route('upload.store')}}"></upload-audio>
                                            </div>
                                        </div>
                                        <div class="box white-box" id="helper">
                                            <p class="text-left">HELP AND SUGGESTIONS</p>
                                            <p class="text-left"><small>By submitting your audio to {{get_apps()->name}}, you acknowledge that you agree to {{get_apps()->name}}'s Terms of Service and Community Guidelines. Please be sure not to violate others' copyright or privacy rights. <a href="#">Learn more</a></small></p>
                                            <p>
                                                <span><a href="#">Upload instructions</a></span>
                                                <span><a href="#">Troubleshooting</a></span>
                                                <span><a href="#">Mobile uploads</a></span>
                                            </p>
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
    <link rel="stylesheet" href="{{url('css/select2/select2.min.css')}}"> 
    <link rel="stylesheet" href="{{url('css/chosen/bootstrap-chosen.css')}}">
    <style>
        .pro-ad .dropzone .dz-preview{
            top: 0;
            height: 0;
        }
    </style>
@endsection

@section('script')
<script src="{{ url('js/dropzone/dropzone.js') }}"></script>

<script>
    $('button').click(function() {
        // Find the target tab li (or anchor) that links to the content you want to show.
        $('a[href="#passive_order_categories"]').tab('show');
        //$('ul.nav-tabs li:eq(1)').tab('show');
    });
    $('body').attr('class', 'mini-navbar');
    $('#sidebar').attr('class', 'active');
    
    Dropzone.autoDiscover = false;
	 
    $(document).ready(function () {
        var show_url = '{{ route("upload.finish", [":id", "ch"=>request()->get("ch")]) }}';
        total_photos_counter = 0;
        var dr = $("#demo1-upload").dropzone({
            maxFilesize: 1,
            dictRemoveFile: 'Remove',
            dictFileTooBig: 'Image is larger than 4MB',
            timeout: 10000,
            addRemoveLinks: true,
            // previewTemplate: document.querySelector('#preview').innerHTML,
            renameFile: function (file) {
                name = new Date().getTime() + Math.floor((Math.random() * 100) + 1) + '_' + file.name;
                return name;
            },
            init: function () {
                this.on("removedfile", function (file) {
                    $.post({
                        url: "{{route('upload.store')}}",
                        data: {id: file.customName, _token: $('[name="_token"]').val()},
                        dataType: 'json',
                        success: function (data) {
                            alert('uploading');
                        },
                        error: function (file, response) {
                            alert('error uploading');
                        }
                    });
                });
            },
            success: function (file, response) {
                alert(response.message);
                window.location.replace(show_url.replace(":id", response.slug));
                window.location.href = show_url.replace(":id", response.slug);
            },
            error: function (file, response) {
                this.removeFile(file);
            }
        });

        $(".deleteImage").click(function(){
            var id = $(this).attr('data-id');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{route('upload.cancel')}}",
                type: 'delete', // replaced from put
                dataType: "JSON",
                data: {
                    "id": id,
                    "model":"product"
                },
                success: function (response)
                {
                    Lobibox.notify('success', {
                        size: 'mini',
                        msg: response.message
                    });
                    location.reload(true);;
                },
                error: function(xhr,response) {
                    Lobibox.notify('error', {
                        size: 'mini',
                        msg: response.message
                    });
                }
            });
        });
    });
    
    $(document).ready(function () {
        $('#demo1-upload').submit(function(){
            var myDropzone = $("#demo1-upload").dropzone();
            myDropzone.processQueue();
            return false;
        });

        $('#name').keyup(function(){
            str = convertToSlug(this.value);
            $('#slug').val(str);
        });
    });
</script>

@endsection