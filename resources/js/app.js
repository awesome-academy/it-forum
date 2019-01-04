
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

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

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

import VueResource from 'vue-resource';

Vue.use(VueResource);

const app = new Vue({

    el: '#list',

    data: {
        allItems: [],
        username: '',
        name: '',
        classDefault: 'grid--cell s-btn s-btn__muted s-btn__outlined py8 ws-nowrap',
        isPopular: 1,
        pagination: {
            total: 0,
            per_page: 2,
            from: 1, 
            to: 0,
            current_page: 1
        },
        offset: 4,
    },

    computed: {
        isActived: function () {
            return this.pagination.current_page;
        },
        pagesNumber: function () {
            if (!this.pagination.to) {
                return [];
            }
            var from = 1;
            if (from < 1) {
                from = 1;
            }
            var to = from + (this.offset * 2);
            if (to >= this.pagination.last_page) {
                to = this.pagination.last_page;
            }
            var pagesArray = [];
            while (from <= to) {
                pagesArray.push(from);
                from++;
            }
            
            return pagesArray;
        }
    },

    mounted: function() {
        this.getvuelist(this.pagination.current_page);
    },

    methods: {
        // load lan dau
        getvuelist: function(page) {

            var formData = new FormData(document.getElementById('formFilter'));
            var url = document.getElementById('formFilter').getAttribute('data-route');
            formData.append('page', page);
            formData.append('isPopular', this.isPopular);

            this.$http.post(url, formData)
            .then((response) => response.json())
            .then((responseJson) => {
                this.allItems = responseJson.data.data;
                this.pagination = responseJson.pagination;
            });
        },
        // change page
        changePage: function (page) {

            if (page <= this.pagination.last_page) {
                this.pagination.current_page = page;
                this.getvuelist(page);
            }
        },
    },
    
    watch: {
        username: function() {
            this.getvuelist(1);
        },
        name: function() {
            this.getvuelist(1);
        },
        isPopular: function() {
            this.getvuelist(1);
        },
    }
});
