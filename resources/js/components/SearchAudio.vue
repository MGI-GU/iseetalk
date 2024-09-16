<template>
    <div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mg-5" v-for="audio in list_audio" :key="audio.id">
            <div class="row">
                <div class="col-lg-2 col-md-2 col-sm-5 col-xs-5">
                    <div class="courses-title">
                        <a v-if="checkURL()" v-bind:href="'../../studio/audio/'+audio.slug">
                            <div class="cover-image image-audio-cover" v-bind:style="{ 'background-image': 'url(' + audio.src_cover + ')' }"></div>
                        </a>
                        <a v-else v-bind:href="'../../listen/'+audio.slug">
                            <div class="cover-image image-audio-cover" v-bind:style="{ 'background-image': 'url(' + audio.src_cover + ')' }"></div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-10 col-md-10 col-sm-7 col-xs-7">
                    <big class="mg-t-10"><a v-bind:href="'../../listen/'+audio.slug">{{audio.name}}</a></big>
                    <div class="courses-alaltic mg-b-5">
                        <small>{{audio.play_number_string}}</small>
                        <small class="course-icon">-</small>
                        <small>{{audio.date_label}}</small>
                    </div>
                    <div class="courses-alaltic mg-b-5">
                        <a v-bind:href="audio.source_label.channel_slug"><small>{{audio.source_label.channel}}</small></a>
                    </div>
                    <div class="courses-alaltic hidden-xs">
                        <small v-html="audio.description"></small>
                    </div>
                </div>

            </div>
        </div>
        <infinite-loading @distance="1" @infinite="infiniteHandler" ref="audioLoading">
            <div slot="no-results">-</div>
            <div slot="no-more"></div>
        </infinite-loading>
    </div>
    
</template>

<script>
    export default {
        mounted() {
            console.log('Component audio list mounted.')
        },
        data() {
            return {
                list_audio: [],
                page: 1,
                success: false,
                audio: {},
                errors: [],
                currrent_url: window.location.pathname
            };
          },
          methods: {
            infiniteHandler($state, $action='') {
                var currentUrl = window.location.pathname;
                let vm = this;
                this.$http.get(currentUrl+'?page='+this.page)
                    .then(response => {
                        return response.json();
                    }).then(data => {
                        if(data.data.length != 0){
                            $.each(data.data, function(key, value) {
                                vm.list_audio.push(value);
                                $state.loaded();
                            });
                        }else{
                            $state.complete();
                        }
                    });

                this.page = this.page + 1;
            },
            checkURL(){
                console.log(this.currrent_url.includes("studio"));
                if(this.currrent_url.includes("studio")){
                    return true;
                }
                return false;
            },
            limitWord(data){
                if(data.length > 100) {
                    return data.slice(0,4);
                }
                return data;
            }
        },
    }
</script>
