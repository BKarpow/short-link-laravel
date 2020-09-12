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
            <div class="progress" v-if="showProgress">
                <div
                    class="progress-bar"
                    role="progressbar"
                    :style="{width:  uploadPercentage+'%'}"
                    :aria-valuenow="uploadPercentage"
                    aria-valuemin="0"
                    aria-valuemax="100"></div>
            </div>
        </div>
        <div class="form-group" v-else>
            <h5>Фото категорії</h5>
            <div class="col-lg-3">
                <img :src="filePath" class="img-fluid" alt="">
            </div>
            <div class="my-2">
                <button
                    type="button"
                    @click="deleteFile"
                    class="btn btn-danger"
                >&times; Видалити</button>
            </div>

            <input type="hidden" name="icon_path" :value="filePath">
        </div>
        <!-- /.form-group -->
    </div>
</template>

<script>
    export default {
        data(){
            return {
                isLoaded: false,
                showProgress: false,
                filePath: '/storage/app/',
                file: '',
                uploadPercentage: 0,
            }
        },
        methods:{
            handleFileUpload(){
                this.file = this.$refs.image.files[0];
                this.submitFile()
            },
            submitFile(){
                this.showProgress = true
                let formData = new FormData();
                formData.append('file', this.file);
                axios.post( '/admin/upload/image',
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
                    console.log('Response', r.data);
                    this.filePath += r.data.path
                    this.isLoaded = true

                }).catch(() => {
                        console.log('FAILURE!!');
                    });
            },
            deleteFile: function(){
                axios.post('/admin/delete/image', {path: this.filePath})
                        .then(response => {
                            if (response.data.delete){
                                this.isLoaded = false
                                this.uploadPercentage = 0
                                this.file = ''
                                this.showProgress = false
                                this.filePath = '/storage/app/'
                            }

                        })
                        .catch(err => {
                            console.log('Delete Error', err)
                        })
            },

        }
    }
</script>
