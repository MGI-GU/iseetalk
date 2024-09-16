<template>
    <div class="white-box">
        <div class="row mg-t-15" v-for="comment in list" :key="comment.id">
            <div class="col-lg-1 col-md-1 col-sm-2 col-xs-2">
                <img v-bind:src="comment.user_pic" alt="" />
            </div>
            <div class="col-lg-9 col-md-10 col-sm-10 col-xs-10">
                <div class="comment-details">
                    <a href="#"><strong>{{comment.user_name}}</strong>  <span v-if="slugUrl == 'comments'" v-html="comment.status_label"></span></a>
                    <p>{{comment.comment}}</p>
                </div>
                <div class="row mg-t-15" v-for="reply in comment.comments" :key="reply.id">
                    <div class="col-lg-1 col-md-1 col-sm-2 col-xs-2">
                        <img v-bind:src="reply.user_pic" alt="" />
                    </div>
                    <div class="col-lg-9 col-md-10 col-sm-10 col-xs-10">
                        <div class="comment-details">
                            <a href="#"><strong>{{reply.user_name}}</strong></a>
                            <p>{{reply.comment}}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
                <small>{{comment.date_label}}</small><br>
                <a class="btn btn-xs btn-default reply" href="#"><b>REPLY</b></a>
            </div>
        </div>
        <infinite-loading @distance="1" @infinite="infiniteHandler" ref="commentLoading">
            <div slot="no-results"> </div>
            <div slot="no-more"></div>
        </infinite-loading>
    </div>
    
</template>

<script>
    export default {
        props: ['slugUrl'],
        mounted() {
            console.log('Component comment mounted.')
        },
        data() {
            return {
                list: [],
                page: 1,
                success: false,
                comment: {},
                errors: []
            };
          },
          methods: {
            infiniteHandler($state, $action='') {
                var currentUrl = this.slugUrl == '' ? window.location.pathname+'/comments':this.slugUrl;
                let vm = this;
                this.$http.get(currentUrl+'?page='+this.page)
                    .then(response => {
                        return response.json();
                    }).then(data => {
                        if(data.data.length != 0){
                            $.each(data.data, function(key, value) {
                                vm.list.push(value);
                                $state.loaded();
                            });
                        }else{
                            //$state.reset();
                            $state.complete();
                        }
                    });

                this.page = this.page + 1;
            },
            addComment() {
                let uri = '/comment/R2Vab7kb0pX/post';
                axios.post(uri, this.comment)
                .then(response => {
                    this.success = response.data;
                    // console.log(this.$refs.commentLoading.status);
                    if(this.$refs.commentLoading==0){
                        this.$refs.commentLoading.stateChanger.reset(); 
                    }
                }).catch(err => {
                    console.log(err);
                });
            },
            error(field) {
                return _.head(field);
            }
        },
    }
</script>
