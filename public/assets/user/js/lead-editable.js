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
                if($.trim(value) == '') 
                    return 'Value is required.';
        },        
        type: 'text',
        //url:'user/lead',
          url:'/user/lead',  
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