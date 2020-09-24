<template>
    <div id="comments">
        <div class="py-1">
            <h2>Коментарі</h2>
        </div>
        <div class="my-2" v-if="auth">
            <h3>Додати коментар</h3>
            <add-comments
                :url-add-comment="urlAdd"
                :post-id="postId"
                @success-add="getAllComments"
            ></add-comments>
        </div>
        <div v-else class="my-2">
            <h5> Ви не авторизовані, <a href="/login" target="_blank">Авторизація</a></h5>
        </div>
        <!-- /.my-2 -->
        <div
            v-if="load"
            class="load-process d-flex justify-content-center align-items-center">
            <div v-if="!error.length" class="spinner-border" role="status">
                <span class="sr-only">Loading...</span>
            </div>
            <div v-else class="alert alert-danger">
                <h5>Errors</h5>
                <ul>
                    <li v-for="err in error">
                        <strong>{{err}}</strong>
                    </li>
                </ul>
            </div>
            <!-- /.alert -->
        </div>
        <!-- /.load-process -->
        <div v-else class="load-success ">
            <div class="comments-box container p-1">
                <div v-if="!comments.length" class="no-comment">
                    <h4>Намає коментарів</h4>
                </div>
                <!-- /.no-comment -->
                <div v-else >
                    <div v-for="comment in comments"  class="comment row">
                        <div class="col-md-2 comment-user">
                            <h5>{{comment.name}}</h5>
                            <small>{{ parsingDate( comment.created_at)}}</small>
                        </div>
                        <!-- /.comment-user -->
                        <div class="col-md-10 comment-body">
                            {{comment.comment}}
                        </div>
                        <!-- /.comment-body -->
                    </div>
                    <!-- /.comment -->
                </div>

            </div>
            <!-- /.comments-box -->
        </div>
        <!-- /.load-success -->
    </div>
    <!-- /#comments -->

</template>
<script>
    export default {
        props: ['urlGetComments', 'urlAdd', 'postId', 'auth'],
        data(){
            return {
                load: false,
                comments: [],
                error: []
            }
        },
        mounted() {
            this.getAllComments()
        },
        methods:{
            parsingDate(date_string){
                const date = new Date(date_string)
                let str_date = ''
                str_date += date.getDate() + '-'
                str_date += date.getMonth() + '-'
                str_date += date.getFullYear() + ' '
                str_date += date.getHours() + ':'
                str_date += date.getMinutes() + ':'
                str_date += date.getSeconds()
                return str_date
            },
            getAllComments(){
                this.load = true
                axios.get(this.$props.urlGetComments)
                    .then(response => {
                        const comments = response.data
                        console.log('test comments ', comments)
                        this.comments = comments.data
                        this.load = false
                        this.error = []
                    }).catch(err => {
                        this.error.push(err)
                    // console.error(err)
                })
            }
        }
    }
</script>

<style lang="scss">
    $bg: #cfcfcf;
    $color: #141414;
    $maxWidth: 400px;
    .comments-box{
        background: inherit;
        color: $color;
        border-radius: 1rem;
    }
    .no-comment{
        display: flex;
        justify-content: center;
        align-items: center;
        height: 4rem;
        h4{
            text-align: center;
        }
    }
    .comment{
        padding: 1rem;
        margin: .5rem;
        border: 1px solid #ccc;
        border-radius: 8px;
        .comment-user{
            padding: 1rem;
            border-right: 1px solid darken($bg, 20);
            color: lighten($color, 12);
        }
        .comment-body{
            padding: 1rem;
            font-size: 1.2rem;
            font-weight: bold;
        }
        .comment-footer{

        }

    }

</style>
