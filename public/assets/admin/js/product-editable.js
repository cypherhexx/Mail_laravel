 $(function(){
             $('#enable').click(function() {
                 $('#settings .settings').editable('toggleDisabled');
                  $('#enable').text(function(i, text){
                     return text === "Enable edit mode" ? "Disable edit mode" : "Enable edit mode";
                });
            });

        $.fn.editable.defaults.mode = 'popup';
        $.fn.editable.defaults.params = function (params) {
            params._token = $("meta[name=csrf-token]").attr("content");
            return params;
        };

        $('.settings').editable({
            validate: function(value) {
              
        }, 
        type: 'text',
         source: [
              {value: 0, text: 'All'},
              {value: 1, text: 'Management'},
              {value: 2, text: 'Master'},
              {value: 3, text: 'Executive'},
              {value: 4, text: 'Agent'},
           ],
        url:'/admin/products', 
        placement: 'top', 
        send:'always',
        disabled:true,
        ajaxOptions: {
        dataType: 'json'
        },
        success: function(response, newValue) {
            $(this).html(newValue);
            }        
     });
     }); 