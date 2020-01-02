$(function(){

             $('#enable').click(function() {

                 $('#settings .settings').editable('toggleDisabled');





                  $('#enable').text(function(i, text){

                     return text === "Enable edit mode" ? "Disable edit mode" : "Enable edit mode";

                });

            });



        $.fn.editable.defaults.mode = 'inline';

        $.fn.editable.defaults.params = function (params) {

            params._token = $("meta[name=csrf-token]").attr("content");

            return params;

        };



              $('.settings').editable({

                  validate: function(value) {

                    if($.trim(value) == '') 

                          return 'Value is required.';

                    

              },        

              type: 'text',

              //url:'/Projects/binary/admin/welcomeemail', 
               url:'/admin/welcomeemail', 

              placement: 'auto', 

              send:'always',

              disabled:true,

              ajaxOptions: {

              dataType: 'json'

              },



              success: function(response, newValue) {

                  $(this).html(newValue);

                  }        

           });



       

            //    $('#wysihtml5').editable({

            //     validate: function(value) {

            //       if($.trim(value) == '') 

            //               return 'Value is required.';

            //       },

            //       type: 'textarea',

            //       // pk: 1,

            //       url: '/Projects/binary/admin/welcomeemail',

            //       //title: 'Enter username'

            //       placement: 'top', 

            //       send:'always',

            //       disabled:true,

            //       ajaxOptions: {

            //       dataType: 'json'

            //   },



            //   success: function(response, newValue) {

            //       $(this).html(newValue);

            //       }        

            // });





     });

