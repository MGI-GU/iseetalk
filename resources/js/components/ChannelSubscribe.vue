<template>
    <div>
        <div v-for="(item) in channels" :key="item.name" class="col-lg-2 col-md-2 col-sm-3 col-xs-6 video-list-vertical mg-t-15">
            <div class="text-center">
                <div class="courses-title">
                    <a v-bind:href="'../channel/'+item.slug"><img style="width: 100px;height: 100px;" class="round-img" v-bind:src="item.src_cover" v-bind:alt="item.name"></a>
                </div>
                <div class="mg-t-10" style="height: 58px;">
                    <h4><a v-bind:href="'../channel/'+item.slug">{{item.name}}</a></h4>
                    <a v-bind:href="'../channel/'+item.slug">{{item.no_subscriber}} subscribers</a>
                </div>
                
                <div class="courses-alaltic mg-t-15">
                    <button @click.prevent="action('unsubscribe', item)" v-if="unsubscribe.includes(item)" class="btn btn-default">BERLANGANAN</button>
                    <button @click.prevent="action('subscribe', item)" v-else class="btn btn-danger">LANGANAN</button>
                </div>
            </div>
        </div>
        <infinite-loading @distance="1" @infinite="infiniteHandler">
            <div slot="no-results">-</div>
            <div slot="no-more"></div>
        </infinite-loading>
    </div>
    
</template>

<script>
    export default {
        props: ['subscribe', 'channelCategory', 'slugUrl'],
        mounted() {
            console.log('Component list channel mounted.');
            this.isSubscribed = this.isSubscribe ? true : false;
        },
        computed: {
            isSubscribe() {
                return this.subscribe;
            },
        },
        data() {
            return {
                channels: [],
                page: 1,
                isSubscribed: '',
                unsubscribe: [],
            };
        },
        methods: {
            infiniteHandler($state) {
                var currentUrl = window.location.pathname;
                let vm = this;
 
                this.$http.get(currentUrl+'?page='+this.page+'&category='+this.channelCategory)
                    .then(response => {
                        return response.json();
                    }).then(data => {
                        console.log(data.data.data.length);
                        if(data.data.data.length > 0){
                            $.each(data.data.data, function(key, value) {
                                vm.channels.push(value);
                                $state.loaded();
                            });
                        }else{
                            $state.complete();
                        }
                    });

                this.page = this.page + 1;
            },
            action(request, select) {
                console.log(request);
                console.log(select.slug);
                var url = window.location.origin;
                var post_url = this.slugUrl.replace(':id', select.slug);
                this.$vs.loading();

                axios.post(post_url, {
                    name: request
                })
                .then(response => {
                    console.log(select);
                    if(response.data){
                        const index = this.unsubscribe.indexOf(select)
                        if(request == 'subscribe'){
                            this.unsubscribe.push(select);
                            // this.isSubscribed = true;
                        }else if(request == 'unsubscribe'){
                            this.unsubscribe.splice(index,1);
                            // this.isSubscribed = false;
                        }
                        console.log(this.unsubscribe);

                        // if(request == 'subscribe'){
                        //     this.isSubscribed = true;
                        // }else if(request == 'unsubscribe'){
                        //     this.isSubscribed = false;
                        // }
                    }else{
                        window.location.href = url+'/login';
                    }
                })
                .catch(response => console.log(response));

                setTimeout( ()=> {
                    this.$vs.loading.close()
                }, 2000);
            }
        },
    }
</script>
