<template>
    <div>
        <div class="list-channel" v-for="(item) in audios" :key="item.name">
            <div class="row">
                <div class="col-lg-offset-1 col-lg-2 col-md-2 col-sm-4 col-xs-12">
                    <div class="profile-hdtc text-center">
                        <a v-bind:href="'../channel/'+item.channel.slug"> 
                            <img class="message-avatar round-img list-channel-img" width="100" v-bind:src="item.channel.src_cover" v-bind:alt="item.name">
                        </a>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-8 col-xs-12">
                    <a v-bind:href="'../channel/'+item.channel.slug">
                        <h4 class="message-author mg-t-15"> {{item.channel.name}} <i v-if=" item.channel.status === 2 " class="fa fa-check-circle"></i></h4>
                        <span class="message-content"> {{item.channel.no_subscriber}} subscribers - {{item.channel.no_audio}} audio </span>
                        <span class="message-content">{{item.channel.description}}</span>
                    </a>
                </div>
                <div class="col-lg-2 col-md-2 col-sm-8 col-xs-12">
                    <button @click.prevent="action('subscribe', item)" v-if="unsubscribe.includes(item)" class="btn btn-danger">LANGANAN</button>
                    <button @click.prevent="action('unsubscribe', item)" v-else class="btn btn-default">BERLANGANAN</button>
                    <span v-if="alerted.includes(item)">
                        <button @click.prevent="action('none', item)" class="btn btn-default"><i class="fa fa-bell-o"></i></button>
                    </span>
                    <span v-else-if="unalerted.includes(item)">
                        <button @click.prevent="action('alert', item)" class="btn btn-default"><i class="fa fa-bell-slash-o"></i></button>
                    </span>
                    <span v-else-if="item.alert_type == 1">
                        <button @click.prevent="action('none', item)" class="btn btn-default"><i class="fa fa-bell-o"></i></button>
                    </span>
                    <span v-else>
                        <button @click.prevent="action('alert', item)" class="btn btn-default"><i class="fa fa-bell-slash-o"></i></button>
                    </span>
                </div>
            </div>
        </div>
        <infinite-loading @distance="1" @infinite="infiniteHandler">
            <div slot="no-more"></div>
        </infinite-loading>
    </div>
    
</template>

<script>
    export default {
        props: ['subscribe', 'alert', 'slugUrl'],
        mounted() {
            console.log('Component subscribed mounted.');
            this.isSubscribed = this.isSubscribe ? true : false;
            this.isAlerted = this.isAlert ? true : false;
        },
        computed: {
            isSubscribe() {
                return this.subscribe;
            },
            isAlert() {
                return this.alert;
            },
        },
        data() {
            return {
                audios: [],
                page: 1,
                isSubscribed: '',
                isAlerted: '',
                unsubscribe: [],
                alerted: [],
                unalerted: [],
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
            action(request, select) {
                console.log(request);
                console.log(select.channel.slug);
                var url = window.location.origin;
                var post_url = window.location.href+'/'+select.channel.slug;
                this.$vs.loading()

                axios.post('channel/'+select.channel.slug, {
                    name: request
                })
                .then(response => {
                    if(response.data){
                        const index = this.unsubscribe.indexOf(select)
                        if(request == 'subscribe'){
                            this.unsubscribe.splice(index,1)
                            // this.isSubscribed = true;
                        }else if(request == 'unsubscribe'){
                            this.unsubscribe.push(select)
                            // this.isSubscribed = false;
                        }else if(response.data.alert_type==1 || request == 'alert'){
                            this.alerted.push(select)
                            const unalert = this.unalerted.indexOf(select);
                            if(unalert){
                                this.unalerted.splice(unalert,1)
                            }
                        }else if(response.data.alert_type==0 || request == 'none'){
                            this.unalerted.push(select);
                            const alert = this.alerted.indexOf(select);
                            if(alert){
                                this.alerted.splice(alert,1)
                            }
                        }   
                    }else{
                        window.location.href = url+'/login';
                    }
                    console.log(this.unalerted);
                    console.log(this.alerted);
                })
                .catch(response => console.log(response));

                setTimeout( ()=> {
                    this.$vs.loading.close()
                }, 2000);
            }
        },
    }
</script>
