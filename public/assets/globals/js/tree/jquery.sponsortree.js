(function($) {
    $.fn.tree_structure = function(options) {
        var defaults = {
            'add_option': false,
            'edit_option': false,
            'delete_option': false,
            'confirm_before_delete': true,
            'animate_option': [true, 5],
            'fullwidth_option': true,
            'align_option': 'center',
            'draggable_option': false
        };
        return this.each(function() {
            if (options)
                $.extend(defaults, options);
            var animate_option = defaults['animate_option'];
            var fullwidth_option = defaults['fullwidth_option'];
            var align_option = defaults['align_option'];          
            var vertical_line_text = '<span class="vertical"></span>';
            var horizontal_line_text = '<span class="horizontal"></span>'; 
            var class_name = $(this).attr('class');
            var event_name = 'pageload';
            var getcode=document.URL.split("/");          
            if (fullwidth_option) {
                var i = 0;
                var prev_width;
                var get_element;
                $('.' + class_name + ' li li').each(function() {
                    var this_width = $(this).width();
                    if (i == 0 || this_width > prev_width) {
                        prev_width = $(this).width();
                        get_element = $(this);
                    }
                    i++;
                });
                var total_childs=i;
                var loop = get_element.closest('ul').children('li').eq(0).nextAll().length;
                // alert(loop);
                max= 185;
                var fullwidth = parseInt(0);
                for ($i = 0; $i <= total_childs; $i++) {
                    fullwidth += parseInt(130);
                }
                1000 < fullwidth ? '' : fullwidth=1000;
                $('.' + class_name + '').closest('div').width(fullwidth);
                 
                 // alert(fullwidth);
                if(fullwidth != 1000){
                    var marginleft=parseInt(fullwidth)/10;
                    // var marginleft = parseInt(marginleft) +  parseInt(marginleft)/15  ;
                    marginleft = -Math.abs(marginleft)
                    // $('ul.tree').css('margin-left',marginleft);
                    fullwidth = parseInt(fullwidth) - 2 * parseInt(Math.abs(marginleft))
                }
                // alert(fullwidth);
                 $('.overflownopos').width(fullwidth); 
                    
            }
            $('.' + class_name + ' li.thide').each(function() {
                $(this).children('ul').hide();
            });
            function prepend_data(target) {
                target.prepend(vertical_line_text + horizontal_line_text).children('div').prepend("");
                if (target.children('ul').length != 0)
                    target.hasClass('thide') ? target.children('div').prepend('<b class="thide tshow"></b>') : target.children('div').prepend('<b class="thide"></b>');             
            }
            function draw_line(target) {
                var child_width = target.children('div').outerWidth(         ) / 2;
                var child_left = target.children('div').offset().left;
                if (target.parents('li').offset() != null)
                    var parent_child_height = target.parents('li').offset().top;
                vertical_height = (target.offset().top - parent_child_height) - target.parents('li').children('div').outerHeight(true) / 2;
                target.children('span.vertical').css({'height': vertical_height, 'margin-top': -vertical_height, 'margin-left': child_width});
                if (target.parents('li').offset() == null) {
                    var width = 0;
                } else {
                    var parents_width = target.parents('li').children('div').offset().left + (target.parents('li').children('div').width() / 2);
                    var current_width = child_left + (target.children('div').width() / 2);
                    var width = parents_width - current_width;
                }
                var horizontal_left_margin = width < 0 ? -Math.abs(width) + child_width : child_width;
                target.children('span.horizontal').css({'width': Math.abs(width), 'margin-top': -vertical_height, 'margin-left': horizontal_left_margin});
            }
            if (animate_option[0] == true /*&& getvalue > 0*/) {
                function animate_call_structure() {
                    $timeout = setInterval(function() {
                        animate_li();
                    }, animate_option[1]);
                }
                var length = $('.' + class_name + ' li').length;
                var i = 0;
                function animate_li() {
                    prepend_data($('.' + class_name + ' li').eq(i));
                    draw_line($('.' + class_name + ' li').eq(i));
                    i++;
                    if (i == length) {
                        i = 0;
                        clearInterval($timeout);
                    }
                }
            }
            function call_structure() {
                /*if(getvalue > 0) {*/
                    $('.' + class_name + ' li').each(function() {
                        if (event_name == 'pageload')
                            prepend_data($(this));
                        draw_line($(this));
                    });
                //}
            }
            animate_option[0] ? animate_call_structure() : call_structure();
            event_name = 'others';
            $(window).resize(function() {
                call_structure();
            });
            $(document).on("click", '.' + class_name + ' b.thide', function() {
                $(this).toggleClass('tshow');
                $(this).closest('li').toggleClass('thide').children('ul').toggle();
                call_structure();
            });
            $(document).on("hover", '.' + class_name + ' li > div', function(event) {              
                    $('.' + class_name + ' li > div.current').removeClass('current');
                    $('.' + class_name + ' li > div.children').removeClass('children');
                    $('.' + class_name + ' li > div.parent').removeClass('parent');
                    $(this).addClass('current');
                    $(this).closest('li').children('ul').children('li').children('div').addClass('children');
                    $(this).closest('li').closest('ul').closest('li').children('div').addClass('parent');
               
            });
            $(document).on("click", '.' + class_name + ' span.highlight', function() {
                $('.' + class_name + ' li.highlight').removeClass('highlight');
                $('.' + class_name + ' li > div.parent').removeClass('parent');
                $('.' + class_name + ' li > div.children').removeClass('children');
                $(this).closest('li').addClass('highlight');
                $('.highlight li > div').addClass('children');
                var _this = $(this).closest('li').closest('ul').closest('li');
                find_parent(_this);
            });
            $(document).on("click", '.' + class_name + ' span.highlight', function() {
                if (fullwidth_option)
                    $('.' + class_name + '').parent('div').parent('div').scrollLeft(0);
                $('.' + class_name + ' li > div').not(".parent, .current, .children").closest('li').addClass('tnone');
                $('.' + class_name + ' li div b.thide.tshow').closest('div').closest('li').children('ul').addClass('tshow');
                $('.' + class_name + ' li div b.thide').addClass('tnone');               
                call_structure();
                
            });
            function find_parent(_this) {
                if (_this.length > 0) {
                    _this.children('div').addClass('parent');
                    _this = _this.closest('li').closest('ul').closest('li');
                    return find_parent(_this);
                }
            } 
        });
    };
})(jQuery);