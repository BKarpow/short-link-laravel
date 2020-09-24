<template>
    <div id="form-add-comment">
        <div v-if="error.length" class="alert alert-danger m-2">
            <ul>
                <li v-for="err in error">
                    <strong>{{error}}</strong>
                </li>
            </ul>
        </div>
        <!-- /.error -->
        <div v-if="success" class="alert alert-success">
            <strong>Ваш коментар додано!</strong>
        </div>
        <!-- /.alert -->
        <div class="form-group">
            <textarea
                ref="comment"
                v-model="comment"
                placeholder="Ваш клментар"
            ></textarea>
            <!-- /#.form-control -->
        </div>
        <!-- /.form-group -->
        <div class="form-group">
            <button type="button" @click="addComment" class="btn btn-dark">Додати Коментар</button>
            <!-- /.btn -->
        </div>
        <!-- /.form-group -->
    </div>
    <!-- /#form-add-comment -->
</template>

<script>
    export default {
        props: ['urlAddComment','postId', 'userName'],
        data(){
            return {
                error: [],
                name: this.$props.userName,
                comment: '',
                success: false
            }
        },
        methods:{
            addSuccess(){
                this.$emmit('success', true);
            },
            addComment(){
                axios.post(this.$props.urlAddComment, {
                    post_id: this.$props.postId,
                    comment: this.comment
                }).then(response => {
                    if (response.data.status){
                        this.comment = ''
                        this.$emit('success-add', true );
                    }else{
                        this.error.push('Error add comment')
                    }
                }).catch(err => {
                    this.error.push(err)
                })
            }
        },
        watch:{

            comment(){
                const rows = Math.floor( this.comment.length / 50);
                this.$refs.comment.rows =  rows
            }
        }
    }
</script>

<style scoped lang="scss">
    textarea{
        border-top: none;
        border-left: none;
        border-right: none;
        border-bottom: 2px solid blueviolet;
        height: auto;
        width: 100%;
        padding: 1rem;
        font-size: 1rem;
    }
</style>
