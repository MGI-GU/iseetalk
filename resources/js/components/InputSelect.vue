<template>
    <div class="form-group">
        <label class="typo__label">{{label}}</label>
        <multiselect v-model="value" :tag-placeholder="placeholder" :placeholder="placeholder" label="name" track-by="id" :options="options" :taggable="true" @tag="addTag"></multiselect>
        <input type="hidden" :name="dataName" :value="value.id">
    </div>
</template>

<script>
    import Multiselect from 'vue-multiselect'

    export default {
        props: ['dataLabel', 'dataName', 'dataPlaceholder', 'option', 'values'],
        mounted() {
            console.log('Component select selected.');
            this.options = this.dataOption ? this.option : [];
            this.value = this.dataValue ? this.values : [];
        },
        computed: {
            dataOption() {
                return this.option;
            },
            dataValue() {
                return this.values;
            }
        },
        components: {
            Multiselect
        },
        data () {
            return {
                selected: [],
                value: [],
                options: [],
                // options: [{ name: 'Vue.js', id: '1' },{ name: 'Javascript', id: '2' },{ name: 'Open Source', id: '3' }],
                label: this.dataLabel,
                name: this.dataName,
                placeholder: this.dataPlaceholder
            }
        },
        methods: {
            addTag (newTag) {
                console.log('update');
                const tag = {
                    name: newTag,
                    id: newTag.substring(0, 2) + Math.floor((Math.random() * 10000000))
                }
                this.options.push(tag)
            }
        }
    }
</script>
<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>