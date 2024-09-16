@extends('layouts.admin.main')

@section('content')
    <div class="blog-details-area mg-t-30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="blog-details-inner white-box mg-t-30">
                        <div class="row">
                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                                <div class="mg-t-10">
                                    <div class="blog-image">
                                        <p><small>Project ID :</small> <br> <b>{{$project->format_id}}</b></p>
                                        <p>
                                            @if($project->team)
                                            <small>Team Name :</small> <a
                                                href="{{route('admin.team.show', [$project->team->format_id])}}"><b><br>{{$project->team->name}}</b></a><br><br>
                                            <small>Created at :</small><br> <b>{{$project->created_at->format('d M Y')}}</b>
                                            @else
                                                No Team Set for this Project.
                                            @endif
                                        </p>
                                    </div>
                                </div>
                                
                            </div>
                            <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
                                <div class="latest-blog-single blog-single-full-view">
                                    <div class="blog-details blog-sig-details">
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="border-bottom:solid 1px #ddd;">
                                                <div class="row">
                                                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                                        <ul id="myTabedu1" class="tab-review-design" >
                                                            <li class="active"><a href="#home"><small>Edit Project</small></a></li>
                                                            <!-- <li><a href="#audio"><small> Advance</small></a></li> -->
                                                        </ul>
                                                    </div>
                                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 text-right">
                                                        <a href="{{ route('admin.project.show', [$project->format_id]) }}" class="btn btn-inverse"> BACK</a>
                                                        @if(is_leader(auth()->getUser()) !== 'false' && ($project->status=='draft' || $project->status=='reject'))
                                                        <a href="{{route('admin.project.update.status', [$project->id, 'submit'])}}" class="btn btn-success">SUBMIT</a>
                                                        @endif
                                                        <a href="#" class="btn btn-success save">SAVE</a>
                                                        <!-- <a href="#" data-toggle="dropdown" class="btn dropdown-toggle"><i class="fa fa-ellipsis-v"></i></a>
                                                        <ul class="dropdown-menu pull-right">
                                                            <li><a href="#"><i class="fa fa-trash"></i> DELETE</a></li>
                                                        </ul> -->
                                                                            
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="myTabContent" class="tab-content custom-product-edit ">
                                            <div class="product-tab-list tab-pane fade active in" id="home">
                                                <div class="row">
                                                    <div class="col-lg-offset-1 col-lg-11 col-md-12 col-sm-12 col-xs-12">
                                                        <div class="pro-ad mg-t-15">

                                                            {!!Form::open()->put()->route('admin.project.update', [$project->id])->attrs(['id' => 'form'])!!}
                                                                <div class="row">
                                                                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                                                        {!!Form::text('name', 'Name', $project->name)->autocomplete('off')!!}
                                                                        {!!Form::textarea('description', 'Description', $project->description)->autocomplete('off')!!}
                                                                        
                                                                    </div>
                                                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                                        {!!Form::select('team_id', 'Select Team', get_my_team()->toArray(), $project->team_id)!!}
                                                                    </div>
                                                                </div>
                                                            {!! Form::close() !!}
                                                            
                                                        </div>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="product-tab-list tab-pane fade" id="audio">
                                                <div class="row">
                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                        <div class="pro-ad mg-t-15">
                                                            <!-- OPTIONAL FORM -->
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
<link rel="stylesheet" href="{{url('css/select2/select2.min.css')}}"> 
<link rel="stylesheet" href="{{url('css/chosen/bootstrap-chosen.css')}}">
<link rel="stylesheet" href="{{ url('css/modals.css') }}">

@endsection

@section('script')
<script>
    $('body').attr('class', 'mini-navbar');
    $('#sidebar').attr('class', 'active');
    
</script>
    <!-- chosen JS
		============================================ -->
    <script src="{{url('js/chosen/chosen.jquery.js')}}"></script>
    <script src="{{url('js/chosen/chosen-active.js')}}"></script>
    <!-- select2 JS
		============================================ -->
    <script src="{{url('js/select2/select2.full.min.js')}}"></script>
    <script src="{{url('js/select2/select2-active.js')}}"></script>
    <script>
        $(".save").click( function() {
            $('form').submit();
        });
    </script>
@endsection