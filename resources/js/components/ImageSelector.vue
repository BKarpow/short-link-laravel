<template>
    <div id="imageSelector">
        <h4>Обрати зображення</h4>
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
            Додати медіа
        </button>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Оберіть зображення</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row my-1" v-if="showLoadForm">
                            <upload-component
                                route-upload="/media/upload/image"
                                route-delete="/admin/image/delete"
                                name-field-file="test"
                                @file-load="fileLoad"
                            ></upload-component>
                        </div>
                        <!-- /.row my-1 -->
                        <div class="d-flex flex-md-wrap">
                            <div class="card col-md-5 mx-1"  v-for="img in imageList">
                                <img :src="img.path" class="card-img-top" :alt="img.title">
                                <div class="card-body">
                                    <h5 class="card-title">{{img.title}}</h5>
                                    <p class="card-text">{{img.description}}</p>
                                    <a href="#" @click="selectImg(img.path)" class="btn btn-primary">Обрати</a>
                                </div>
                            </div>
                        </div>
                        <!-- /.d-flex -->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
        <h5 class="py-1" v-if="selectImgPath.length">
            <img :src="selectImgPath" alt="" class="img-fluid">
            Обрано
        </h5>
        <!-- /.py-1 -->
        <input type="hidden" name="main_img" :value="selectImgPath" v-if="selectImgPath.length">
    </div>
    <!-- /#imageSelector -->
</template>
<script>
    export default {
        data(){
            return {
                imageList: [],
                selectImgPath: '',
                showLoadForm: true
            }
        },
        mounted() {
            this.getAll()
            console.log($)
        },
        methods:{
            getAll(){
                axios.get('/media/all')
                    .then(resp => {
                        this.imageList = resp.data.data
                        console.log(resp.data.data)
                    })
            },
            fileLoad(flag){
                if (flag){
                    this.getAll()
                    this.showLoadForm = false
                }
            },
            selectImg(imgPath){
                this.selectImgPath = imgPath
                $('#exampleModal').modal('hide')
            }
        }
    }
</script>
