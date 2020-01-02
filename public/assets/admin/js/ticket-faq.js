


    $(function(){
             $('#faq_enable').click(function() {
                 $('#faq .faq').editable('toggleDisabled');
                  $('#faq_enable').text(function(i, text){
                     return text === "Enable edit mode" ? "Disable edit mode" : "Enable edit mode";
                });
            });

        $.fn.editable.defaults.mode = 'popup';
        $.fn.editable.defaults.params = function (params) {
            params._token = $("meta[name=csrf-token]").attr("content");
            return params;
        };

        $('.faq').editable({
            validate: function(value) {
              
        },        
        type: 'text',
        url:'update_ticket_faq', 
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