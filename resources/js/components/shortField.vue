<template>
    <div id="textField">
        <div class="form-group" v-if="!error.length">
            <label for=""></label>
            <input
                type="text"
                v-model="textField"
                @click="copyText()"
                ref="shortText"
                placeholder="Вставте для скорочення"
                class="form-control"
            >
            <!-- /.form-control -->
            <div class="alert mt-2 alert-info" v-if="alert.length">
                {{ alert }}
            </div>
            <!-- /.alert -->
        </div>
        <!-- /.form-group -->
        <div class="alert alert-danger" v-else>
            <strong> {{ error }} </strong>
        </div>
        <!-- .alert warning -->
    </div>
    <!-- /#textField -->
</template>

<script>
    export default {
        data(){
            return {
                textField: '',
                shorted: false,
                error: '',
                alert: ''
            }
        },
        watch:{
            textField: function(){
                if (this.textField.length > 5){
                    this.alert = ''
                    if (this.isUrl() && !this.shebang){
                        this.addNewShort()
                        this.alert = 'Клацніть для скорочення'
                    }else{
                        this.alert = 'Некоректний url, вставте коректний!'
                    }
                }else{
                    this.alert = ''
                }
            }
        },
        methods:{
            isUrl: function ()
            {
                const url = this.textField
                const objRE = /^(?:(?:https?|ftp|telnet):\/\/(?:[a-z0-9_-]{1,32}(?::[a-z0-9_-]{1,32})?@)?)?(?:(?:[a-z0-9-]{1,128}\.)+(?:com|net|org|mil|edu|arpa|ru|gov|biz|info|aero|inc|name|[a-z]{2})|(?!0)(?:(?!0[^.]|255)[0-9]{1,3}\.){3}(?!0|255)[0-9]{1,3})(?:\/[a-z0-9.,_@%&?+=\~\/-]*)?(?:#[^ \'\"&<>]*)?$/i;
                return objRE.test(url);
            },
            copyText: function(){
                if (this.shorrted){
                    this.copyTextExecute(this.textField)
                    this.textField = ''
                    this.shorrted = false
                }
            },

            copyTextExecute: function(text){
                let cplCont = document.createElement('textarea'); // Створимо елемент
                cplCont.textContent = text; // додамо туди текст
                document.body.append(cplCont); // Додамо елемент до body
                cplCont.select(); // Виділемо весь текст в елементі
                document.execCommand('copy'); // Запустимо команду copy
                cplCont.remove(); // Видалимо обєкт
            },

            addNewShort(){
                axios.post('/ajax/add/new', {url: this.textField})
                    .then(resp => {
                        const response = resp.data
                        this.textField = response.short
                        this.shorrted = true
                        this.$refs.shortText.select()
                    })
                    .catch(err => {
                        this.error = err
                    })
            }
        }
    }
</script>
