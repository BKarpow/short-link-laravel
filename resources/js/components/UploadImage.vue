<template>
    <div class="container">
        <div class="form-group" v-if="!isLoaded">
            <label>Зображення
                <input
                    type="file"
                    class="form-control"
                    id="image"
                    ref="image"
                    v-on:change="handleFileUpload()"/>
            </label>
            <br>
            <div class="progress" v-if="showProgress && !errorMessage.length">
                <div
                    class="progress-bar"
                    role="progressbar"
                    :style="{width:  uploadPercentage+'%'}"
                    :aria-valuenow="uploadPercentage"
                    aria-valuemin="0"
                    aria-valuemax="100">
                    {{ uploadPercentage + '%' }}
                </div>
            </div>
            <div class="alert alert-danger my-1" v-if="errorMessage.length">
                <strong> {{ errorMessage }} </strong>
            </div>
            <!-- /.alert my-1 -->
        </div>
        <div class="form-group" v-else>
            <h5>Фото категорії</h5>
            <div class="col-lg-3">
                <img :src="filePathRoot + filePath" class="img-fluid" alt="">
            </div>
            <div class="my-2">
                <button
                    type="button"
                    @click="deleteFile"
                    class="btn btn-danger"
                >&times; Видалити</button>
            </div>

            <input type="hidden" :name="nameFieldFile" :value="filePathRoot + filePath">
        </div>
        <!-- /.form-group -->
    </div>
</template>

<script>
    export default {
        props: ['routeUpload', 'routeDelete', 'nameFieldFile', 'defaultSrc'],
        data(){
            return {
                isLoaded: false,
                showProgress: false,
                filePathRoot: '/storage/app/',
                filePath: '',
                file: '',
                errorMessage: '',
                uploadPercentage: 0,
            }
        },
        mounted() {
            if (this.$props.defaultSrc.length){
                this.isLoaded = true
                this.filePath = this.$props.defaultSrc.replace(this.filePathRoot, '')
                console.log('Test 21', this.filePath)
            }
        },
        methods:{
            handleFileUpload(){
                this.file = this.$refs.image.files[0];
                this.submitFile()

            },
            submitFile(){
                this.showProgress = true
                this.errorMessage = ''
                let formData = new FormData();
                formData.append('file', this.file);
                axios.post( this.$props.routeUpload,
                    formData,
                    {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        },
                        onUploadProgress: function(progressEvent) {
                            this.uploadPercentage = parseInt(Math.round(( progressEvent.loaded / progressEvent.total) * 100))
                        }.bind(this)
                    }
                ).then(r => {
                    const response = r.data
                    if (r.status === 200){
                        this.filePath += response.path
                        this.isLoaded = true
                    }else{
                        this.errorMessage = response.message
                        this.isLoaded = false
                        this.uploadPercentage = 0
                        this.file = ''
                        this.showProgress = false
                        this.filePath = ''
                    }


                }).catch((response) => {
                        this.errorMessage = response.message
                        this.isLoaded = false
                        this.uploadPercentage = 0
                        this.file = ''
                        this.showProgress = false
                        this.filePath = ''
                    });
            },
            deleteFile: function(){
                axios.post(this.$props.routeDelete, {path: this.filePath})
                        .then(response => {
                            if (response.data.delete){
                                this.isLoaded = false
                                this.uploadPercentage = 0
                                this.file = ''
                                this.showProgress = false
                                this.filePath = ''
                                this.errorMessage = ''
                            }

                        })
                        .catch(err => {
                            console.log('Delete Error', err)
                        })
            },

        }
    }
</script>
