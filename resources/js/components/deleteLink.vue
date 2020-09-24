<template>
    <button class="btn btn-danger" @click="deleteAction">
        <slot></slot>
    </button>
</template>

<script>
    export default {
        props: ['deleteLink', 'messageDeleteConfirm'],
        data(){
            return {

            }
        },
        methods:{
            deleteAction(){
                if (window.confirm(this.$props.messageDeleteConfirm)){
                    axios.get(this.$props.deleteLink)
                        .then(resp => {
                            if (resp.status === 200){
                                window.alert('Видалено успішно');
                                window.location.reload()
                            }
                        }).catch(err => {
                            window.alert('Помилка видалення '+err)
                    })
                }

            }
        }

    }
</script>
