import Vue from 'vue'

require('./bootstrap');
window.Vue = require('vue');

const app = new Vue({

    el: '#app',

    methods: {

      printInvoice(){ 

        window.print()

      }
    }
});