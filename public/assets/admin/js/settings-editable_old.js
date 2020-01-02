 $(function(){
             $('#enable').click(function() {
                 $('#settings .settings').editable('toggleDisabled');
            });

        $.fn.editable.defaults.mode = 'popup';
        $.fn.editable.defaults.params = function (params) {
            params._token = $("meta[name=csrf-token]").attr("content");
            params.pk = 1;
            params.pk = 1;
            return params;
        };

        $('.settings').editable({
            validate: function(value) {
                if($.trim(value) == '') 
                    return 'Value is required.';
        },        
        type: 'text',
        url:'/admin/updatesettings', 
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