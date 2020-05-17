/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');


/* Core JS files */
// require('./theme/plugins/loaders/pace.min');
// require('./theme/core/libraries/jquery.min');
// require('./theme/core/libraries/bootstrap.min');
require('./theme/plugins/loaders/blockui.min');

/* Theme JS files */
// require('d3');
// require('./theme/plugins/visualization/d3/d3.min');
// require('./theme/plugins/visualization/d3/d3_tooltip');
// require('./theme/plugins/visualization/d3/d3.tip.v0.6.3');
// require('./theme/charts/d3/other/streamgraph');
// require('./theme/plugins/visualization/echarts/echarts.js');

require('./theme/plugins/forms/styling/switchery.min');
require('./theme/plugins/forms/styling/uniform.min');
require('./theme/plugins/forms/selects/bootstrap_multiselect');
require('./theme/plugins/extensions/cookie');
require('./theme/plugins/forms/selects/select2.min');
require('./theme/plugins/forms/wizards/steps.min');
require('./theme/plugins/forms/validation/validate.min');
require('./theme/plugins/extensions/session_timeout.min.js');
require('./theme/plugins/forms/inputs/passy.js');
require('./theme/plugins/forms/inputs/maxlength.min.js');
require('./theme/plugins/forms/inputs/formatter.min.js');
require('./theme/plugins/media/cropper.min.js');
require('./theme/plugins/pickers/color/spectrum.js');
require('./theme/plugins/pickers/daterangepicker.js');
require('./theme/plugins/tables/datatables/datatables.min.js');
require('./theme/plugins/editors/summernote/summernote.min.js');
require('./theme/plugins/forms/tags/tagsinput.min.js');
require('./theme/plugins/forms/tags/tokenfield.min.js');
require('./theme/plugins/forms/inputs/typeahead/typeahead.bundle.min.js');
require('./theme/plugins/forms/editable/editable.min.js');
require('./theme/plugins/social/sharer/sharer.js');
require('./theme/plugins/fileinput/fileinput.min.js');
require('./theme/plugins/maps/jvectormap/jvectormap.min.js');
require('./theme/plugins/maps/jvectormap/map_files/world.js');
// require('./theme/plugins/flipcountdown/jquery.flipcountdown.js');
// require('./theme/plugins/mb-comingsoon/jquery.mb-comingsoon.js');
window.pagemap = require('./theme/plugins/pagemap/pagemap.js');
//OR USE THIS http://hilios.github.io/jQuery.countdown/examples.html

require('../extra-aslamise/plugins/scrollup/jquery.scrollUp.min');

// require('./theme/plugins/velocity/velocity.min');
// require('./theme/plugins/velocity/velocity.ui.min');
// require('./theme/plugins/buttons/spin.min');
// require('./theme/plugins/buttons/ladda.min');


// require('moment');
// import moment from 'moment'
// require('daterangepicker');

// import google from 'google-maps';

// require('./theme/pages/dashboard');


window.Vue = require('vue');

// window.d3 = require('d3');
window.moment = require('moment');
window.moment.locale('ru');
window.daterangepicker = require('daterangepicker');
window.sweetalert = require('bootstrap-sweetalert');
window.sweetalert = require('bootstrap-sweetalert');
window.parsley = require('parsleyjs');
// window.google = require('google-maps');

window.locationpicker = require('jquery-locationpicker');
// window.scrollUp = require('scrollup').scrollup;
// window.WOW = require('wowjs');
window.WOW = require('wowjs').WOW;
window.mPageScroll2id = require('page-scroll-to-id').mPageScroll2id;
window.ladda = require('ladda');
window.spin = require('spin');
window.Switchery = require('switchery');
window.bootstrapSwitch = require('bootstrap-switch');
window.PNotify = require('pnotify');
window.Bloodhound = require('bloodhound-js');
window.typeahead = require('typeahead');
window.echarts = require('echarts');
window.Clipboard = require('clipboard');
window.IntroJs = require('intro.js');
window.countdown = require('jquery-countdown');
window.Dropzone = require("dropzone");



// require('./theme/plugins/forms/inputs/typeahead/typeahead.bundle.min.js');


require('orgchart');
require('webui-popover');
require('jstree');
require("jquery-ui/ui/widgets/autocomplete");
require("codemirror");
require("print-this");
require("bootstrap-editable");


// require("clipboard");
// require("sharer.js");


// require('./theme/app');
require('./theme/core/app');
require('./theme/extra');


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// Vue.component('example', require('./components/Example.vue'));
// Vue.component('Crud', require('./components/Crud.vue'));
// Vue.component('TicketCategories', require('./components/TicketCategories.vue'));

// const app = new Vue({
//     el: '#app'
// });
