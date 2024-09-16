<template>
    <div>
        <div class="profile-hdtc text-right">
            <button class="btn btn-md btn-success" href="#" v-if="isSubscribed" @click.prevent="action('unsubscribe')" type="relief" vslor="primary" color="danger"> BERLANGANANAN</button>
            <button class="btn btn-md btn-primary" v-else href="#" @click.prevent="action('subscribe')" color="success"> LANGGANAN</button>
            <i v-if="isSubscribed">
                <button class="btn btn-md btn-default" href="#" v-if="isAlerted" @click.prevent="action('alert')" type="relief" vslor="primary" color="danger"> <i class="fa fa-bell-slash-o"></i></button>
                <button class="btn btn-md btn-default" v-else href="#" @click.prevent="action('none')" color="success"> <i class="fa fa-bell-o"></i></button>
            </i>
        </div>
    </div>
</template>

<script>
export default {
    props: ['post', 'subscribe', 'alert', 'slugUrl', 'login'],

    data: function() {
        return {
            posturl: this.slugUrl,
            isSubscribed: '',
            isAlerted: '',
            isLogined: '',
            backgroundLoading:'primary',
            colorLoading:'#fff',
        }
    },
    mounted() {
        console.log('Component subscriber');
        this.isSubscribed = this.isSubscribe ? true : false;
        this.isAlerted = this.isAlert ? true : false;
        this.isLogined = this.isAlert ? true : false;
    },
    computed: {
        isSubscribe() {
            return this.subscribe;
        },
        isAlert() {
            return this.alert;
        },
        isLogin() {
            return this.login;
        },
    },
    methods: {
        action(request) {
            var url = window.location.origin;
            this.$vs.loading();

            axios.post(this.posturl,{
                name: request
            })
            .then(response => {
                if(response.data){
                    if(request == 'subscribe'){
                        this.isSubscribed = true
                    }else if(request == 'unsubscribe'){
                        this.isSubscribed = false
                    }else if(response.data.alert_type==1 || request == 'alert'){
                        this.isAlerted = false
                    }else if(response.data.alert_type==0 || request == 'none'){
                        this.isAlerted = true
                    }
                }else{
                    window.location.href = url+'/login';
                }
            })
            .catch(response => console.log(response));

            setTimeout( ()=> {
                this.$vs.loading.close()
            }, 2000);
        }
    }
}
</script>