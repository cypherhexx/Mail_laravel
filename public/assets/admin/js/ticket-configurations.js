 //Category

 $(function(){
             $('#category_enable').click(function() {
                 $('#category .category').editable('toggleDisabled');
                  $('#category_enable').text(function(i, text){
                     return text === "Enable edit mode" ? "Disable edit mode" : "Enable edit mode";
                });
            });

        $.fn.editable.defaults.mode = 'popup';
        $.fn.editable.defaults.params = function (params) {
            params._token = $("meta[name=csrf-token]").attr("content");
            return params;
        };

        $('.category').editable({
            validate: function(value) {
              
        },        
        type: 'text',
        url:'save_ticket_category', 
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



 
 
