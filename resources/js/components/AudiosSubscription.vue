<template>
    <div>
        <div class="col-lg-2 col-md-2 col-sm-3 col-xs-6 video-list-vertical1" v-for="(item) in audios" :key="item.name">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 cover-content">
                    <div class="courses-title text-center">
                        <a :href="'listen/'+item.slug">
                            <div class="cover-image image-audio-cover">
                                <img :src="item.src_cover" />
                            </div>
                            <span class="badge badge-time">{{item.time}}</span>
                        </a>
                    </div>
                </div>
                <div class="title-content">
                    <div class="mg-t-5">
                        <div class="col-lg-11 col-md-12 col-sm-12 col-xs-12">
                            <h3 class="height-30 lh-06">
                                <a :href="'listen/'+item.slug" v-bind:title="item.name">
                                    {{item.name}}
                                </a>
                            </h3>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-2 col-xs-2 text-left">
                            <a :href="item.source_label.channel_slug">
                                <img class="channel-img message-avatar round-img border" style="width: 36px;" :src="item.source_label.channel_cover" v-bind:alt="item.name">
                            </a>
                        </div>
                        <div class="col-lg-9 col-md-9 col-sm-10 col-xs-10 title-audio">
                            <div class="courses-alaltic">
                                <a :href="item.source_label.channel_slug" v-bind:title="item.source_label.channel">
                                    <small class="course-icon lh-normal">{{item.source_label.channel}} <i class="fa fa-check-circle"></i></small>
                                </a>
                                <hr class="br-time-view">
                                <small>{{item.play_number_string}}</small>
                                <small class="course-icon">•</small>
                                <small>{{item.updated_at}}</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <infinite-loading @distance="0" @infinite="infiniteHandler">
            <div slot="no-results"> </div>
            <div slot="no-more"> </div>
        </infinite-loading>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component audio subscription mounted.')
        },
        data() {
            return {
              audios: [],
              page: 1,
            };
        },
        methods: {
            infiniteHandler($state) {
                var currentUrl = window.location.href;
                let vm = this;
 
                this.$http.get(currentUrl+'?page='+this.page)
                    .then(response => {
                        return response.json();
                    }).then(data => {
                        if(data.data.data.length != 0){
                            $.each(data.data.data, function(key, value) {
                                vm.audios.push(value);
                                $state.loaded();
                            });
                        }else{
                            $state.complete();
                        }
                    });

                this.page = this.page + 1;
            },
        },
    }
</script>
