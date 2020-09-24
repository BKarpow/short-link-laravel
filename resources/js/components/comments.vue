<template>
    <div id="comments">
        <div class="py-1">
            <h2>Коментарі</h2>
        </div>
        <div class="my-2">
            <h3>Додати коментар</h3>
            <add-comments
                :url-add-comment="urlAdd"
                :post-id="postId"
                @success-add="getAllComments"
            ></add-comments>
        </div>
        <div
            v-if="load"
            class="load-process justify-content-center align-items-center">
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
        <div v-else class="load-success">
            <div class="comments-box p-1">
                <div v-if="!comments.length" class="no-comment">
                    <h4>Намає коментарів</h4>
                </div>
                <!-- /.no-comment -->
                <div v-else >
                    <div v-for="comment in comments"  class="comment">
                        <div class="comment-user">
                            <h5>{{comment.name}}</h5>
                            <small>Прокоментовано {{comment.created_at}}</small>
                        </div>
                        <!-- /.comment-user -->
                        <div class="comment-body">
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
        props: ['urlGetComments', 'urlAdd', 'postId'],
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
        background: $bg;
        color: $color;
        border-radius: 1rem;
    }
    .no-comment{
        display: flex;
        justify-content: center;
        align-items: center;
        h4{
            text-align: center;
        }
    }
    .comment{
        @media (max-width: $maxWidth) {
            display: block;
        }
        padding: 1rem;
        margin: .5rem;
        display: flex;
        border: 1px solid #ccc;
        .comment-user{
            padding: 1rem;
            border-right: 1px solid darken($bg, 20);
            width: percentage(2/12);
            color: lighten($color, 12);
            @media (max-width: $maxWidth) {
                width: 100%;
                height: .5rem;
            }
        }
        .comment-body{
            padding: 1rem;
            width: percentage(10/12);
            border-bottom: 1px solid darken($bg, 20);
            font-size: 1.2rem;
            font-weight: bold;
            @media (max-width: $maxWidth) {
                width: 100%;
                height: 3rem;
            }
        }
        .comment-footer{
            width: percentage(2/12);

        }

    }

</style>
