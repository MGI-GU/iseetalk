@extends('layouts.admin.main')

@section('content')
<div class="blog-details-area mg-b-15 mg-t-30">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="blog-details-inner white-box mg-t-30">
                    <div class="product-tab-list tab-pane fade active in" id="5">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="review-content-section">
                                    <div class="pro-ad">
                                        <div class="row">
                                            <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                                                <a href="#" data-toggle="modal" data-target="#thumbnail"><img
                                                        class="border" src="{{url($comment->audio->src_cover)}}"
                                                        alt=""></a>
                                            </div>
                                            <div class="col-lg-10 col-md-9 col-sm-9 col-xs-12">
                                                @include('layouts.audioslide', ['audio'=>$comment->audio])
                                                <div class="form-group">
                                                    <!-- <audio controls style="width: 100%;background: #f1f3f4;">
                                                            <source src="{{get_audio_source($comment->audio)}}" type="audio/mpeg" autoplay>
                                                            Your browser does not support the audio element.
                                                        </audio> -->
                                                </div>
                                                <div class="clearfix"></div>
                                                <hr>
                                                <div class="form-group">
                                                    <label for="">Title</label>
                                                    <p class="panel-footer ft-pn" placeholder="">
                                                        {{$comment->audio->name}}</p>
                                                </div>
                                                <div class="form-group">
                                                    <label for="">Deskripsi</label>
                                                    <p class="panel-footer ft-pn" placeholder="">
                                                        {!!$comment->audio->description!!}</p>
                                                </div>
                                                <div class="form-group">
                                                    <label for="">Tag</label>
                                                    <p class="panel-footer ft-pn" placeholder="">{!!
                                                        get_tag_link($comment->audio->tags) !!}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="comment-head">
                                <h3>Comment</h3>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="col-lg-1 col-md-1 col-sm-12 col-xs-12">
                                <img src="{{$comment->user->picture}}" alt="" />
                            </div>
                            <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
                                <div class="comment-details">
                                    <a href="#"><strong>{{$comment->user->name}}</strong>
                                        <small>{{$comment->date_label}}</small></a>
                                    <p>{{$comment->comment}}</p>
                                </div>
                            </div>
                        </div>
                        @foreach($comment->comments as $reply)
                        <div class="row mg-t-15">
                            <div class="col-lg-offset-1 col-lg-1 col-md-1 col-sm-12 col-xs-12">
                                <img src="{{$reply->user->picture}}" alt="" />
                            </div>
                            <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
                                <div class="comment-details">
                                    <a href="#"><strong>{{$reply->user->name}}</strong>
                                        <small>{{$reply->date_label}}</small></a>
                                    <p>{{$reply->comment}}</p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="row">
                        <div class="coment-area">
                            {!!Form::open()->post()->route('admin.comment.store',
                            [$comment->audio->id])->id('comment')!!}
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <textarea name="comment" cols="30" rows="10"
                                            placeholder="Tulis komentar"></textarea>
                                    </div>
                                    {!!Form::hidden('comment_id')->value($comment->id)!!}
                                    <div class="payment-adress comment-stn pull-right">
                                        <a href="{{url('admin/comment')}}" class="btn btn-inverse"> BACK</a>
                                        <button type="submit" class="btn btn-primary waves-effect waves-light">Reply
                                            Comment</button>
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
@endsection

@section('style')
<link rel="stylesheet" href="{{ url('css/jplayer/style.css') }}">
@endsection

@section('script')
<script>
    $(window).load(function() {
        $('#loading').hide();
        $('.audio-slides').show();
    });
</script>
@endsection