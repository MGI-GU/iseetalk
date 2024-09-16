<template>
    <div class="mg-t-15">
        <div class="chat-message" v-for="(item) in audios" :key="item.name">
            <div class="row">
                <div class="col-lg-offset-1 col-lg-2 col-md-4 col-sm-4 col-xs-12">
                    <a :href="item.slug"> 
                        <div class="cover-image image-audio-cover" v-bind:style="{ 'background-image': 'url(' + item.src_cover + ')' }"><img v-bind:src="item.src_cover" /></div>
                        <span class="badge badge-time">{{item.time}}</span>
                    </a>
                </div>
                <div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
                    <h5 class="message-author"><a :href="item.slug" :title="item.name"> {{item.name}}</a></h5>
                    <small class="trend-desc"> 
                        <a :href="item.source_label.channel_slug ? item.source_label.channel_slug:''" :title="item.source_label.channel">
                            <span>{{item.source_label.channel}}</span>
                        </a>
                        <span> • </span>
                        {{item.play_number_string}} - {{item.created_at}} 
                    </small>
                    <small class="content hidden-sm hidden-xs trend-desc mg-t-10">{{item.description}}</small>
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
            console.log('Component audio category mounted.')
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
 
                this.$http.get(currentUrl+'&page='+this.page)
                    .then(response => {
                        return response.json();
                    }).then(data => {
                        if(data.data.length != 0){
                            $.each(data.data, function(key, value) {
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
