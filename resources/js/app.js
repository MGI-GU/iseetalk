/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
import axios from 'axios';
import Vuesax from 'vuesax';
import 'vuesax/dist/vuesax.css';
import Noty from 'noty';
 

require('./bootstrap');
require("sweetalert");

window.Vue = require('vue');
window.axios = axios;

Vue.use(require('vue-resource'));

Vue.component('upload', require('./components/Upload.vue').default);
Vue.component('upload-audio', require('./components/UploadAudio.vue').default);
Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('list-channel', require('./components/ChannelSubscribe.vue').default);
Vue.component('list-subscribed', require('./components/ChannelSubscribed.vue').default);
Vue.component('subscribe-action', require('./components/SubscribeBtn.vue').default);
Vue.component('audio-action', require('./components/Action.vue').default);
Vue.component('home-channel-audio', require('./components/HomeChannelAudio.vue').default);
Vue.component('channel-audio', require('./components/ChannelAudio.vue').default);
Vue.component('search-audio', require('./components/SearchAudio.vue').default);
Vue.component('comments', require('./components/Comments.vue').default);
Vue.component('audios', require('./components/Audios.vue').default);
Vue.component('recomendations', require('./components/Recomendations.vue').default);
Vue.component('InfiniteLoading', require('vue-infinite-loading'));
Vue.component('multi-select', require('./components/MultiInput.vue').default);
Vue.component('create-new-input-select', require('./components/CreateNewInputSelect.vue').default);
Vue.component('input-select', require('./components/InputSelect.vue').default);
Vue.component('crop-image', require('./components/CropperImage.vue').default);
Vue.component('crop', require('./components/sample/Crop.vue').default);
Vue.component('btn-upload', require('./components/ButtonUpload.vue').default);
Vue.component('category-audios', require('./components/AudiosCategory.vue').default);
Vue.component('subscription-audios', require('./components/AudiosSubscription.vue').default);
Vue.component('audio-list', require('./components/HomeAudioList.vue').default);

Vue.use(Vuesax);

const app = new Vue({
    el: '#app',
});
