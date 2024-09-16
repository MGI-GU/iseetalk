<template>
    <div class="row">
        <div class="profile-hdtc mg-t-10 pull-left col-lg-10 col-xs-12">
            <a class="btn btn-default btn-sm col-lg-2 col-xs-3" href="#" v-if="isFavorited" @click.prevent="action('dislike')">
                <i  class="fa fa-heart"></i><br class="hidden-lg hidden-md"> DISUKAI
            </a>
            <a class="btn btn-default btn-sm col-lg-2 col-xs-3" href="#" v-else @click.prevent="action('like')">
                <i  class="fa fa-heart-o"></i><br class="hidden-lg hidden-md"> SUKA
            </a>
            <a class="btn btn-default btn-sm col-lg-2 col-xs-3" href="#" v-if="isSaved" @click.prevent="action('unsave')">
                <i  class="fa  fa-bookmark"></i><br class="hidden-lg hidden-md"> DISIMPAN
            </a>
            <a class="btn btn-default btn-sm col-lg-2 col-xs-3" href="#" v-else @click.prevent="action('save')">
                <i  class="fa fa-bookmark-o"></i><br class="hidden-lg hidden-md"> SIMPAN
            </a>
            <a class="btn btn-default btn-sm col-lg-2 col-xs-3" v-if="isDownloaded" href="#">
                <i  class="fa fa-download"></i> Download
            </a>
            <a class="btn btn-default btn-sm col-lg-2 col-xs-3" data-toggle="modal" data-target="#add"><i class="fa fa-share-square-o"></i> <br class="hidden-lg hidden-md">BAGIKAN</a>
            <a class="btn btn-default btn-sm col-lg-1 col-xs-3" href="#"><i class="fa fa-flag"></i> <br class="hidden-lg hidden-md"><span class="hidden-lg hidden-md">LAPOR</span></a>
        </div>
        <div v-if="this.stat === 1" class="profile-hdtc mg-t-10 pull-right hidden-xs">
            <a class="btn-sm" href="#"><i class="fa fa-heart-o"></i> {{this.like}}</a>
            <!-- <a class="btn-sm" href="#"><i class="fa fa-bookmark-o"></i> 0</a> -->
            <a class="btn-sm" data-toggle="modal" data-target="#add"><i class="fa fa-share-square-o"></i> {{this.share}}</a>
        </div>
        
    </div>
</template>

<script>
export default {
    props: ['post', 'favorited', 'saved', 'downloaded', 'like', 'share', 'stat'],

    data: function() {
        return {
            posturl:window.location.pathname,
            isFavorited: '',
            isSaved: '',
            isDownloaded: '',
        }
    },
    mounted() {
        console.log('Component action button mounted.');
        this.isFavorited = this.isFavorite ? true : false;
        this.isSaved = this.isSave ? true : false;
        this.isDownloaded = this.isDownloaded ? true : false;
    },
    computed: {
        isFavorite() {
            return this.favorited;
        },
        isSave() {
            return this.saved;
        },
        // isDownloaded() {
        //     return this.downloaded;
        // },
    },
    methods: {
        action(post) {
            this.$vs.loading();
            axios.post(this.posturl,{
                name: post
            })
            .then(response => {
                // console.log(response);
                if(response.data){
                    if(response.data.liked){
                        this.isFavorited = true
                    }else{
                        this.isFavorited = false
                    }
                    if(response.data.listen_later){
                        this.isSaved = true
                    }else{
                        this.isSaved = false
                    }
                }else{
                    var url = window.location.origin;
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