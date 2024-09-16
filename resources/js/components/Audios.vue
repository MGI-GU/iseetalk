<template>
    <div class="mg-t-15">
        <div class="row mg-0 mg-t-10" v-for="(item, index) in audios" :key="item.name">
            <div class="col-lg-4 col-md-6 col-sm-4 col-xs-4">
                <div class="">
                    <a v-if="index == 0" id="next-audio" :href="item.slug">
                        <div class="cover-image image-audio-cover" v-bind:style="{ 'background-image': 'url(' + item.src_cover + ')' }"></div>
                    </a>
                    <a v-else :href="item.slug">                        
                        <div class="cover-image image-audio-cover" v-bind:style="{ 'background-image': 'url(' + item.src_cover + ')' }"></div>
                    </a>
                </div>
            </div>
            <div class="col-lg-8 col-md-6 col-sm-8 col-xs-8 mg-0-0">
                <h5><a :href="item.slug">{{item.name}}</a></h5>
                <div class="courses-alaltic">
                    <a :href="item.source_label.channel_slug"><small class="course-icon">{{item.source_label.channel}} <i class="fa fa-check-circle"></i></small></a>
                </div>
                <div class="courses-alaltic">
                    <small>{{item.play_number_string}}</small>
                    <small>-</small>
                    <small>{{item.date_label}}</small>
                </div>
            </div>
            <div class="col-lg-12"><hr v-if=" index === 0 "></div>
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
            console.log('Component audio mounted.')
        },
        data() {
            return {
              audios: [],
              page: 1,
            };
        },
        methods: {
            infiniteHandler($state) {
                var currentUrl = window.location.pathname;
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
