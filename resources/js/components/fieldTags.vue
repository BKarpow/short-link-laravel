<template>
    <div id="fieldsTags">
        <div class="load-process" v-if="load">
            <div class="spinner-grow" role="status">
                <span class="sr-only">Loading...</span>
            </div>
            <div class="alert alert-danger" v-if="error.length">
                <h4>Errors</h4>
                <ul>
                    <li v-for="err in error">
                        <strong>{{err}}</strong>
                    </li>
                </ul>
            </div>
            <!-- /.alert -->
        </div>
        <!-- /.load-process -->
        <div class="load-success" v-else>
            <div class="form-group">
                <label for="tags">Міткм запису</label>
                <input
                    type="text"
                    v-model="tags"
                    placeholder="Напишіть мітку і поставте кому"
                    class="form-control"
                >
                <ul v-if="tagsShow.length">
                    <li v-for="tag in tagsShow" :key="tag.id" @click="selectTags(tag)" >{{tag.name}}</li>
                </ul>
                <!-- /.form-control -->
                <div v-if="tagsSelect.length">
                    <h4>Обрані мітки</h4>
                    <span
                        class="tag-span"
                        v-for="tagSel in tagsSelect"
                        @click="deleteTagSelect(tagSel.id)"
                    >{{tagSel.name}} (Клацніть для видалення)
                </span>
                    <!-- /.tag-span -->
                    <input type="hidden" id="tags" name="tags" :value="tagsSelectAlias">
                </div>
            </div>
            <!-- /.form-group -->
        </div>
        <!-- /.load-success -->

    </div>
    <!-- /#fieldsTags -->
</template>

<script>
    export default{
        props: ['uriSet', 'uriGet', 'defaultValue'],
        data(){
            return {
                load: false,
                error: [],
                tags: '',
                tagsShow: [],
                tagsSelect: [],
                tagsSelectAlias: '',
                tagsAll: []
            }
        },
        watch:{
            tagsSelect(){
                const alias = []
                this.tagsSelect.forEach(item => {
                    alias.push(item.alias)
                })
                this.tagsSelectAlias = alias.join('|')
            },
            tags: function(){
                const pat = new RegExp(this.tags, 'i');
                if (this.tags.length){
                    this.tagsShow  = this.tagsAll.filter(f => pat.test(f.name));
                    this.tagsShow = this.tagsShow.filter(f =>  {
                        if (this.tagsSelect.length){
                            for (const fu of this.tagsSelect){
                                if (f.alias === fu.alias){
                                    return false
                                }
                            }
                            return true
                        }else {
                            return true
                        }

                    })
                }else{
                    this.tagsShow = []
                }
                if (this.tags.slice(-1) === ','){
                    if (this.tagsShow.length){
                        this.tagsSelect.push(this.tags)
                    }else{
                        this.setTags(this.tags)
                    }
                }
            }
        },
        methods:{
            deleteTagSelect(tagId){
                this.tagsSelect = this.tagsSelect.filter(f => {
                    if (f.id === tagId) { return false}
                    else { return true }
                })
            },
            selectTags(tag){
                console.log('Select ', tag.name)
                this.tagsShow = []
                this.tagsSelect.push(tag)
                this.tags = ''

            },
            setTags(tag){
                if (tag.length){
                    this.load = true
                    axios.post(this.$props.uriSet, {name: tag})
                        .then(response => {
                            const data = response.data
                            if (data.status){
                                this.tags = ''
                                this.load = false
                                this.error = []
                                this.getAllTags()
                            }
                        })
                        .catch(err => {
                            this.error.push(err)
                            console.error(err)
                        })
                }
            },
            getAllTags(){
                this.load = true
                axios.get(this.$props.uriGet)
                    .then(response => {
                        const data = response.data.data
                        this.load = false
                        this.error = []
                        this.tagsAll = data
                    })
                    .catch(err => {
                        this.error.push(err.toString())
                        console.error(err)
                    })
            }
        },
        mounted() {
           this.getAllTags()
        }
    }
</script>

<style scoped>
    ul{
        list-style: none;
        border: 1px solid black ;
        padding: 0;
        margin: 0;
    }
    li{
        display: block;
        padding: .5rem;
        border-top: 1px solid #ссс;
    }
    li:hover{
        background: #141414;
        color: #fdfdfd;
        transition: all 0.5s;
    }
    .tag-span{
        display: block;
        background: #141414;
        color: #f4f4f4;
        padding: 1rem;
        margin-top: 3px;
        margin-bottom: 3px;
    }
</style>
