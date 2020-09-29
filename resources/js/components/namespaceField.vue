<template>
    <div id="namespaceField">
        <div v-if="error.length" class="alert alert-danger">
            <h5>Errors!!</h5>
            <ul>
                <li v-for="err in error">{{err}}</li>
            </ul>
        </div>
        <!-- /.alert -->
        <div class="form-group">
            <label for="">Простір імен</label>
            <input
                type="text"
                v-model="field"
                class="form-control"
            >
            <!-- /.form-control -->
            <h6 class="my-2">Доступні імена</h6>
            <ul class="list-group">
                <li
                    class="list-group-item"
                    v-for="item in namespaces"
                    @click="selectNamespace(item.namespace)"
                >
                    {{item.namespace}}
                </li>
            </ul>
            <!-- /.list-group -->
        </div>
        <!-- /.form-group -->
        <input type="hidden" name="namespace" :value="field">
    </div>
    <!-- /#namespaceField -->
</template>

<script>
    export default {
        props: ['urlAll'],
        data(){
            return {
                field: '',
                namespaces: [],
                error: []
            }
        },
        watch:{
            field: function(){
                const patt = new RegExp('[^a-z\_\.0-9]', 'i')
                this.field = this.field.replace(patt, '')
            }
        },
        methods:{
            selectNamespace(namespace){
                this.field = namespace
            }
        },
        mounted() {
            axios.get(this.$props.urlAll)
                .then(resp => {
                    this.error = []
                    this.namespaces = resp.data.data
                })
                .catch(err => {
                    this.error.push(err.toString());
                })
        }
    }
</script>
<style scoped lang="scss">
    li{
        cursor: copy;
    }
</style>
