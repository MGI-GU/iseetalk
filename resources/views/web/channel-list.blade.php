@extends('layouts.web.main')

@section('content')
    <div id="app" class="blog-details-area mg-b-15">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="review-content-section">
                        <div class="chat-discussion" style="height: auto">
                           
                            <list-subscribed :subscribe={{ 'true' }} :alert={{ 'true' }}></list-subscribed>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection