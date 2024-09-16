<template>
    <div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12" v-for="audio in list_audio" :key="audio.id">
            <div class="courses-inner res-mg-t-30 dk-res-t-pro-30">
                <a v-bind:href="'../../listen/'+audio.slug">
                    <div class="courses-title text-center">
                        <div class="cover-image image-audio-cover">
                            <img v-bind:src="audio.src_cover" /> 
                        </div>
                    </div>
                    <h5 class="mg-t-10">{{audio.name}}</h5>
                    <div class="courses-alaltic">
                        <small>{{audio.play_number_string}}</small>
                        <small class="course-icon">-</small>
                        <small>{{audio.date_label}}</small>
                    </div>
                </a>
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
                errors: []
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
                        if(data.data.data.length != 0){
                            $.each(data.data.data, function(key, value) {
                                vm.list_audio.push(value);
                                $state.loaded();
                            });
                        }else{
                            $state.complete();
                        }
                    });

                this.page = this.page + 1;
            }
        },
    }
</script>
