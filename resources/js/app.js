/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

// import '@fortawesome/fontawesome-free';

window.Vue = require('vue');

/**
 * Параметри
 */
const autoHiddenBox = true //Ховати автоматично блоки
window.timeoutHiddenBox = 4000 //(мс) Через скільки ховати бокси з повідомленнями та помилками.
window.cssClassAnimateHidden = 'animate__bounceOutDown' //Клас який використовутся для приховування боксів


if (autoHiddenBox){
    console.log('Test start')
    /**
     * Додає калс анімаціїї і ховає блок з повідомленнями і помилками
     */
    const alertBox = window.document.getElementById('alertBox');
    const errorBox = window.document.getElementById('errorBox');
    if (alertBox !== null){

        setTimeout(()=>{
            console.log('active')
            window.document.getElementById('alertBox').classList.add(cssClassAnimateHidden)
        }, timeoutHiddenBox)
    }
    if (errorBox !== null){
        setTimeout(()=>{
            errorBox.classList.add(cssClassAnimateHidden)
        }, timeoutHiddenBox)
    }
}


/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */



// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('upload-component', require('./components/UploadImage.vue').default);
Vue.component('short-field-component', require('./components/shortField.vue').default);
Vue.component('image-selector-component', require('./components/ImageSelector.vue').default);
Vue.component('field-alias-component', require('./components/fieldAlias.vue').default);
Vue.component('field-tags-component', require('./components/fieldTags.vue').default);
Vue.component('del-link', require('./components/deleteLink.vue').default);
Vue.component('add-comments', require('./components/addComments.vue').default);
Vue.component('comments', require('./components/comments.vue').default);


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
