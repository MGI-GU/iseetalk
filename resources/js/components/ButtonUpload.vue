<template>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="btn btn-lg btn-default btn-block">
                <vue-dropzone ref="myVueDropzone" id="dropzone" v-on:vdropzone-sending="sendingEvent" :options="dropzoneOptions" class="button" v-on:vdropzone-success="successEvent" v-on:vdropzone-error="failedEvent"></vue-dropzone>
            </div>
        </div>
    </div>
</template>
 
<script>
 
import vue2Dropzone from 'vue2-dropzone'
import 'vue2-dropzone/dist/vue2Dropzone.min.css'

export default {
    props: ['id', 'typeData', 'modelData', 'slugUrl', 'placeholderText', 'isReplace'],
    components: {
        vueDropzone: vue2Dropzone
    },
    beforeMount () {
        console.log('Upload Attachement mounted.');
        this.placeholder = this.setPlaceholder ? 'Upload here' : this.placeholderText;
        this.replace = this.isReplace ? true : false;
        console.log(this.placeholder);
    },
    methods: {
        sendingEvent(file, xhr, formData) {
            formData.append('model', this.modelData);
            formData.append('id', this.id);
            formData.append('type', this.typeData);
            formData.append('replace', this.replace);
        },
        successEvent(file, response){
            if(response.slug){
                location.reload();
            }
        },
        setPlaceholder() {
            return this.placeholderText;
        },
        failedEvent(file, message, xhr){
            let response = xhr.response;
            let parse = JSON.parse(response, (key, value)=>{
                return value;
            });
            $('.dz-error-message span').text(parse.message+' '+ parse.errors.file);
        }
    },
    data: function () {
        return {
            placeholder: '',
            replace: false, 
            dropzoneOptions: {
                url: this.slugUrl,
                headers: {
                    "X-CSRF-TOKEN": document.head.querySelector("[name=csrf-token]").content
                },
                dictDefaultMessage: "<i class='fa fa-cloud-upload'></i> "+this.placeholderText,
                addRemoveLinks: true,
            }
        }
    },
    
}
</script>