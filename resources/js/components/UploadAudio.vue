<template>
    <div>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <vue-dropzone ref="myVueDropzone" id="dropzone" v-on:vdropzone-sending="sendingEvent" :options="dropzoneOptions" v-on:vdropzone-success="successEvent" v-on:vdropzone-error="failedEvent"></vue-dropzone>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
 
<script>
 
import vue2Dropzone from 'vue2-dropzone'
import 'vue2-dropzone/dist/vue2Dropzone.min.css'

export default {
    props: ['id', 'typeData', 'typeModel', 'slugUrl', 'sourceUpload', 'isReplace', 'channelId'],
    mounted() {
        console.log('Upload Audio mounted.');
        this.sources = this.dataValue ? this.sourceUpload : 'user';
    },
    computed: {
        dataValue() {
            return this.sourceUpload;
        }
    },
    components: {
        vueDropzone: vue2Dropzone
    },
    data: function () {
        return {
            sources: '', 
            replace: false, 
            dropzoneOptions: {
                url: this.slugUrl,
                headers: {
                    "X-CSRF-TOKEN": document.head.querySelector("[name=csrf-token]").content
                },
                thumbnailWidth: 200,
                addRemoveLinks: true,
                dictDefaultMessage: "<i class='fa fa-cloud-upload'></i> Click to Upload Audio file"
            }
        }
    },
    methods: {
        sendingEvent(file, xhr, formData) {
            formData.append('model', this.typeModel);
            formData.append('id', this.id);
            formData.append('type', this.typeData);
        },
        successEvent(file, response){
            var slug = response.slug;
            if(this.channelId){
                slug = slug + '?ch=' + this.channelId;
            }
            if(this.sources=='user'){
                if(response.slug){
                    window.location.href = '/upload/'+slug;
                }
            }else if(this.sources=='inhouse'){
                if(response.slug){
                    location.reload();
                }
            }
        },
        failedEvent(file, message, xhr){
            let response = xhr.response;
            let parse = JSON.parse(response, (key, value)=>{
                return value;
            });
            $('.dz-error-message span').text(parse.message+' '+ parse.errors.file);
        },
    }
    
}
</script>