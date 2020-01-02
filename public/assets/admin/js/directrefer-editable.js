 $(function(){
             $('#enable').click(function() {
                 $('#settings .directrefer').editable('toggleDisabled');
                  $('#enable').text(function(i, text){
                     return text === "Enable edit mode" ? "Disable edit mode" : "Enable edit mode";
                });
            });

        $.fn.editable.defaults.mode = 'popup';
        $.fn.editable.defaults.params = function (params) {
            params._token = $("meta[name=csrf-token]").attr("content");
            return params;
        };

        $('.directrefer').editable({
            validate: function(value) {
              
        },        
        type: 'text',
        url:'http://localhost/Projects/binary/admin/direct-referbonus', 
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




 $(function(){
             $('#matching-enable').click(function() {
                 $('#matching .matching').editable('toggleDisabled');
                  $('#matching-enable').text(function(i, text){
                     return text === "Enable edit mode" ? "Disable edit mode" : "Enable edit mode";
                });
            });

        $.fn.editable.defaults.mode = 'popup';
        $.fn.editable.defaults.params = function (params) {
            params._token = $("meta[name=csrf-token]").attr("content");
            return params;
        };

        $('.matching').editable({
            validate: function(value) {
              
        },        
        type: 'text',
        url:'http://localhost/Projects/binary/admin/groupsales', 
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





 $(function(){
             $('#enable-reorder').click(function() {
                 $('#reorder .reorder').editable('toggleDisabled');
                  $('#enable-reorder').text(function(i, text){
                     return text === "Enable edit mode" ? "Disable edit mode" : "Enable edit mode";
                });
            });

        $.fn.editable.defaults.mode = 'popup';
        $.fn.editable.defaults.params = function (params) {
            params._token = $("meta[name=csrf-token]").attr("content");
            return params;
        };

        $('.reorder').editable({
            validate: function(value) {
              
        },        
        type: 'text',
        url:'/admin/reorder', 
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

 

 $(function(){
             $('#enable-reorder-pv').click(function() {
                 $('#reorder-pv .reorder-pv').editable('toggleDisabled');
                  $('#enable-reorder-pv').text(function(i, text){
                     return text === "Enable edit mode" ? "Disable edit mode" : "Enable edit mode";
                });
            });

        $.fn.editable.defaults.mode = 'popup';
        $.fn.editable.defaults.params = function (params) {
            params._token = $("meta[name=csrf-token]").attr("content");
            return params;
        };

        $('.reorder-pv').editable({
            validate: function(value) {
              
        },        
        type: 'text',
        url:'/admin/reorder-pv', 
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