<template>
    <div id="fieldAlias">
        <input
            type="text"
            v-model="textField"
            class="form-control"
        >
        <!-- /.form-control -->
        <div v-if="error.length" class="alert alert-danger">
            <stgong >{{error}}</stgong>
        </div>
        <input v-else type="hidden" name="alias" :value="textField">
        <div v-if="unique" class="alert alert-success">
            <strong>Url {{alias}} унікальне!</strong>
        </div>

    </div>
    <!-- /#fieldAlias -->
</template>

<script>
    export  default {
        data(){
            return {
                textField: '',
                error: '',
                alias: '',
                unique: false
            }
        },
        methods:{
            testUnique(){
                axios.post('/admin/page/ajax/is/unique', {alias: this.textField})
                .then(response => {
                    const unique = response.data.unique
                    this.alias = response.data.alias
                    if (unique){
                        this.error = ''
                        this.unique = true
                        this.$emit('success', true)
                    }else{
                        this.unique = false
                        this.error = 'Поле url ' + this.alias + ' не є унікальним!'
                    }
                })
                .catch(err => {
                    this.error = err
                })
            }
        },
        watch:{
            textField: function(){
                if (this.textField.length < 249){
                    this.testUnique()
                }else if (this.textField.length){
                    this.error = ''
                    this.alias = ''
                    this.unique = false
                }
            }
        }
    }
</script>
