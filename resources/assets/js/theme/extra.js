moment.locale("en");
$('body').tooltip({
    selector: '[data-popup="tooltip"]'
});
if ($(".btn-copy").length) {
    $('.btn-copy').tooltip({
        trigger: 'click',
        placement: 'bottom'
    });
    var clipboard = new Clipboard('.btn-copy');
    clipboard.on('success', function(e) {
        new PNotify({
            text: 'Copied to clipboard',
            delay: 1000,
            // styling: 'brighttheme',
            // icon: 'fa fa-file-image-o'
            nonblock: {
                nonblock: true
            }
        });
    });
    clipboard.on('error', function(e) {
        new PNotify({
            text: 'Not Copied to clipboard',
            delay: 1000,
            // styling: 'brighttheme',
            // icon: 'fa fa-file-image-o',
            nonblock: {
                nonblock: true
            }
        });
    });
}
/*
 * Detect if mobile
 * jQuery.browser.mobile 
 */
(function(a) {
    (jQuery.browser = jQuery.browser || {}).mobile = /(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i.test(a) || /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(a.substr(0, 4))
})(navigator.userAgent || navigator.vendor || window.opera);
//jQuery.browser.mobile 
// if(jQuery.browser.mobile == true){
//     alert('mobile');
// }else{
//     alert('non mobile');
// }
/*
Regiter page
 */
$(document).ready(function() {
    if ($(".steps-validation").length) {
        $("#resulttable").hide();



        $("div.bhoechie-tab-menu>div.list-group>a").click(function(e) {
            e.preventDefault();
            $(this).siblings('a.active').removeClass("active");
            $(this).addClass("active");
          
            var index = $(this).index();
            $("div.bhoechie-tab>div.bhoechie-tab-content").removeClass("active");
            $("div.bhoechie-tab>div.bhoechie-tab-content").eq(index).addClass("active");
        });
    }
});
//
// Wizard with validation
//
// Show form
// 
if ($(".steps-validation").length) {
    var form = $(".steps-validation").show();
    form.parsley();
    // Initialize wizard
    $(".steps-validation").steps({
        headerTag: "h6",
        bodyTag: "fieldset",
        transitionEffect: "fade",
        titleTemplate: '<span class="number">#index#</span> #title#',
        autoFocus: true,
        onStepChanging: function(event, currentIndex, newIndex) {
            // Allways allow previous action even if the current form is not valid!
            if (currentIndex > newIndex) {
                return true;
            }
            // Forbid next action on "Warning" step if the user is to young
            // if (newIndex === 3 && Number($("#age-2").val()) < 18) {
            //     return false;
            // }
            // Needed in some cases if the user went back (clean up)
            if (currentIndex < newIndex) {
                // To remove error styles
                form.find(".body:eq(" + newIndex + ") label.error").remove();
                form.find(".body:eq(" + newIndex + ") .error").removeClass("error");
            }
            var validateForm = form.parsley().whenValidate({
                group: 'block-' + currentIndex
            });
            validateForm.then(function() {}, function() {});
            if (validateForm.state() === "resolved") {
                return true;
            }
        },
        onStepChanged: function(event, currentIndex, priorIndex) {
            // Used to skip the "Warning" step if the user is old enough.
            // if (currentIndex === 2 && Number($("#age-2").val()) >= 18) {
            //     form.steps("next");
            // }
            // Used to skip the "Warning" step if the user is old enough and wants to the previous step.
            // if (currentIndex === 2 && priorIndex === 3) {
            //     form.steps("previous");
            // }
        },
        onFinishing: function(event, currentIndex) {
            // form.validate().settings.ignore = ":disabled";
            // return form.valid();
        },
        onFinished: function(event, currentIndex) {
            alert("Submitted!");
        }
    });
    Parsley.addValidator('sponsor', {
        validateString: function(value, country) {
            var ajaxStatus = $.ajax({
                url: CLOUDMLMSOFTWARE.siteUrl + '/ajax/validatesponsor/?sponsor=' + value,
                type: "GET",
                async: false,
                success: function(e) {
                    if (e.valid === true) {
                        return true;
                    } else {
                        return false;
                    }
                },
                error: function() {
                    return false;
                }
            });
            ajaxStatusFlag = $.parseJSON(ajaxStatus.responseText);
            return ajaxStatusFlag.valid;
        },
        messages: {
            en: 'No such sponsor exists!'
        }
    });
    Parsley.addValidator('stateAndZip', {
        validateString: function(_ignoreValue, country, instance) {
            $("#ziplocation span").html('');
            var country = $('[name="country"]').val();
            var state = $('[name="state"]').val();
            var zip = $('[name="zip"]').val();
            // console.log(state);
            // console.log(zip);
            fetch('https://maps.googleapis.com/maps/api/geocode/json?address=' + zip + '&region=' + country, {
                method: 'get'
            }).then(function(response) {
                return response.json();
            }).then(function(response) {
                if (response.status === "OK") {
                    $("#ziplocation span").html('');
                    $("#ziplocation span").html(response.results[0].formatted_address + '<br/>');
                    return true;
                }
            }).catch(function(err) {
                $("#ziplocation span").html('');
                console.log("Error: ", err);
                return true;
            });
            // var xhr = $.get('https://maps.googleapis.com/maps/api/geocode/json?address='+zip);
            // When Zippopotam.us returns the info of the given zip, check it:
            // return xhr.then(function(json) {
            // console.log(json);
            // var actualState = json.places[0]['state abbreviation'];
            // if (actualState !== state) {
            // We could return `false`, but for an even better result
            // we can fail the promise with a custom error message:
            // return $.Deferred().reject("The zip code " + zip + " is in " + actualState + ", not in " + state);
            // Note: in jQuery 3.0+, you can `throw('my custom error')` for the same result
            // }
            // })
        },
        // The following error message will still show if the xhr itself fails
        // (404 because zip does not exist, network error, etc.)
        messages: {
            en: 'There is no such zip for the country "%s"'
        }
    });
}
// Bind change function to the select
jQuery(document).ready(function() {
    if (jQuery("#country").length) {
        jQuery("#country").change(onCountryChange);
    }
});

function onCountryChange() {
    var countryId = jQuery(this).val();
    $.ajax({
        url: CLOUDMLMSOFTWARE.siteUrl+"/country-state/get-states/" + countryId,
        dataType: "json",
        type: "GET",
        success: onStatesRecieveSuccess,
        error: onStatesRecieveError
    });
}

function onStatesRecieveSuccess(data) {
    // Target select that we add the states to
    var jTargetSelect = jQuery("#state");
    // Clear old states
    jTargetSelect.children().remove();
    var i = 0;
    for (var propertyName in data.states) {
        jTargetSelect.append('<option value="' + propertyName + '">' + data.states[propertyName] + '</option>');
    }
}

function onStatesRecieveError(data) {
    alert("Could not get states. Select the country again.");
}
if ($("#package").length) {
    $('#package').change(function() {
        var product = document.getElementById("package");
        var amount = product.options[product.selectedIndex].getAttribute('amount');
        var pv = product.options[product.selectedIndex].getAttribute('pv');
        var rs = product.options[product.selectedIndex].getAttribute('rs');
        $('#joiningfee').html(amount);
        $('#paypal_joining').html(amount);
        $('#voucher_joining').html(amount);
        $('.ewallet_joining').html(amount);
    });
}
$(document).ready(function() {
    if ($("#conf").length) {
        $("#conf").hide();
        $("#resulttable").hide();
    }
    var voucherbalance = 0;
    var voucher = [];
    if ($("table#resulttable").length) {
        $("table#resulttable").hide();
    }
    $('body').on('click', '#verify', function(e) {
        if ($("#err").length) {
            $("#err").hide();
        }
        e.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        if (jQuery.inArray($('#key').val(), voucher) == -1) {
            $.ajax({
                url: CLOUDMLMSOFTWARE.siteUrl + '/admin/register/data',
                type: "post",
                async: false,
                dataType: "json",
                data: {
                    key: $('#key').val()
                },
                success: function(data, textStatus, jqXHR) {
                    if (data[0] == undefined) {
                        $("#err").show();
                        document.getElementById("err").innerHTML = "<strong> Error!</strong> Invalid voucher code";
                    }
                    voucher.push(data[0].voucher_code);
                    if (data[0].total_amount >= joiningfe) {
                        $("#err").show();
                        document.getElementById("err").innerHTML = "<strong> Error!</strong> Reached maximum joining fee ";
                        $("#conf").show();
                    }
                    if (voucherbalance < joiningfe) {
                        voucherbalance += parseInt(data[0].total_amount);
                        $("table#resulttable").show();
                        drawTable(data);
                        payable_vouchers.push(data[0]);
                    } else {
                        $("#err").show();
                        document.getElementById("err").innerHTML = "<strong> Error!</strong> Reached maximum joining fee ";
                        $("#conf").show();
                        voucherbalance -= parseInt(data[0].total_amount);
                    }
                }
            });
        } else {
            if ($("#err").length) {
                $("#err").show();
            }
            document.getElementById("err").innerHTML = "<strong> Error!</strong> Voucher code is already used ";
        }
    });
});

function drawTable(data) {
    for (var i = 0; i < data.length; i++) {
        drawRow(data[i]);
    }
}

function drawRow(rowData) {
    var row = $("<tr />");
    if ($("#resulttable").length) {
        $("#resulttable").append(row);
    }
    row.append($("<td><input type='hidden' name='payable_vouchers[]' value='" + rowData.voucher_code + "'>" + rowData.voucher_code + "</td>"));
    row.append($("<td>" + rowData.total_amount + "</td>"));
    row.append($("<td>" + rowData.balance_amount + "</td>"));
}
$(document).ready(function() {
    // var options = {
    // script:"{{url('admin/suggestlist')}}?json=true&limit=10&",
    // varname:"input",
    // json:true,
    // shownoresults:false,
    // maxresults:10,
    // callback: function (obj) { document.getElementById('testid').value = obj.id; }
    // };
    // var as_json = new bsn.AutoSuggest('sponsor', options);
    // $( "#email" ).blur(function() {
    // var email = $(this).val();
    // $.get( "{{url('email_validate')}}/"+email, { email: email }, function(response) {
    // if (response == 'available') {
    // $('.next').removeClass('next hidden').addClass('next');
    // $('#errsemail').html('');
    // } else {
    // $('#errsemail').html( '<div class="alert alert-danger fade in" id="errs"><a id="errrs" href="#" class="close" data-dismiss="alert" required>&times;</a><strong>Error!</strong> {{trans("register.email_used") }}.</div>');
    // $('.next').removeClass('next').addClass('next hidden');
    // }
    // });
    // });
});
$(document).ready(function() {
    // window.Parsley.addAsyncValidator(
    //     'validate_sponsor', function (xhr) {
    //     // var registration = $('#registration').parsley();
    //     var response = $.parseJSON(xhr.responseText);
    //     // window.ParsleyUI.removeError(registration,'errorUsername');
    //     // if(xhr.status == '200')
    //     //        return 200;
    //     //    if(xhr.status == '404')
    //     //        response = $.parseJSON(xhr.responseText);
    //     //        window.ParsleyUI.addError(registration,'errorUsername',response.error);
    //     // return response.valid;
    //     // console.log(response.valid);
    //     if (response.valid === true) {
    //         return true;
    //     } else {
    //         // window.ParsleyUI.addError(registration,'sponsor_name','aaa');
    //         return false;
    //     }
    // }, '{{url('ajax/validatesponsor')}}');
    // $( "#username" ).blur(function() {
    // var sponsor = $(this).val();
    // $.get( "{{url('sponsor_validate')}}/"+sponsor, { sponsor: sponsor }, function(response) {
    // if (response) {
    // $('#errsuser').html( '<div class="alert alert-danger fade in" id="errs"><a id="errrs" href="#" class="close" data-dismiss="alert" required>&times;</a><strong>Error!</strong> {{trans("register.username_not_availabale") }}.</div>');
    // $('.next').removeClass('next').addClass('next hidden');
    // } else {
    // $('.next').removeClass('next hidden').addClass('next');
    // $('#errsuser').html('');
    // }
    // });
    // });
    // $( "#passport" ).blur(function() {
    // var sponsor = $(this).val();
    // $.get( "{{url('passport_validate')}}/"+sponsor, { sponsor: sponsor }, function(response) {
    // if (response) {
    // $('#errspassport').html( '<div class="alert alert-danger fade in" id="errs"><a id="errrs" href="#" class="close" data-dismiss="alert" required>&times;</a><strong>Error!</strong> National identification number not available. </div>');
    // $('.next').removeClass('next').addClass('next hidden');
    // } else {
    // $('.next').removeClass('next hidden').addClass('next');
    // $('#errspassport').html('');
    // }
    // });
    // });
    // });
    // $(document).ready(function() {
    // $("div.bhoechie-tab-menu>div.list-group>a").click(function(e) {
    // e.preventDefault();
    // $(this).siblings('a.active').removeClass("active");
    // $(this).addClass("active");
    // var index = $(this).index();
    // $("div.bhoechie-tab>div.bhoechie-tab-content").removeClass("active");
    // $("div.bhoechie-tab>div.bhoechie-tab-content").eq(index).addClass("active");
    // $('#payment').val($(this).attr('payment'));
    // });
});
$(document).ready(function() {
    if ($('#toggle-images').length) {
        $('#toggle-images').bootstrapSwitch();
        if (typeof $.cookie("tree_images") != 'undefined') {
            if ($.cookie("tree_images") === 'true') {
                $('#treediv').removeClass('no-images');
                $('#sponsortreediv').removeClass('no-images');
                $('#toggle-images').bootstrapSwitch('state', true);
                $('#treediv').addClass('no-grid');
                $('#sponsortreediv').addClass('no-grid');
                $('#toggle-grid').bootstrapSwitch('state', false);
            } else {
                $('#treediv').addClass('no-images');
                $('#sponsortreediv').addClass('no-images');
                $('#toggle-images').bootstrapSwitch('state', false);
                $('#treediv').addClass('no-grid');
                $('#sponsortreediv').addClass('no-grid');
                $('#toggle-grid').bootstrapSwitch('state', false);
            }
        } else {
            $.cookie("tree_images", "true");
            $('#treediv').removeClass('no-images');
            $('#sponsortreediv').removeClass('no-images');
            $('#toggle-images').bootstrapSwitch();
            $('#treediv').addClass('no-grid');
            $('#sponsortreediv').addClass('no-grid');
            $('#toggle-grid').bootstrapSwitch('state', false);
        }
    }
});
$('#toggle-images').on('switchChange.bootstrapSwitch', function() {
    var state = $('#toggle-images').bootstrapSwitch('state');
    if (typeof state != 'undefined') {
        if (state == true) {
            $.cookie("tree_images", "true");
            $('#treediv').removeClass('no-images'); // activate     
            $('#sponsortreediv').removeClass('no-images'); // activate  
            $('#treediv').addClass('no-grid');
            $('#sponsortreediv').addClass('no-grid');
            $('#toggle-grid').bootstrapSwitch('state', false);   
        } else {
            $.cookie("tree_images", "false");
            $('#treediv').addClass('no-images'); // deactivate
            $('#sponsortreediv').addClass('no-images'); // deactivate
            $('#treediv').addClass('no-grid');
            $('#sponsortreediv').addClass('no-grid');
            $('#toggle-grid').bootstrapSwitch('state', false);
        }
    } else {
        $.cookie("tree_images", "true");
        $('#treediv').removeClass('no-images'); // activate  
        $('#sponsortreediv').removeClass('no-images'); // activate  
        $('#treediv').addClass('no-grid');
        $('#sponsortreediv').addClass('no-grid');
        $('#toggle-grid').bootstrapSwitch('state', false);
    }
});
$(document).ready(function() {
    if ($('#toggle-grid').length) {
        $('#toggle-grid').bootstrapSwitch();
        // alert(typeof $.cookie("tree_grid"));
        if (typeof $.cookie("tree_grid") != 'undefined') {
            if ($.cookie("tree_grid") === 'true') {
                $('#treediv').removeClass('no-grid');
                $('#sponsortreediv').removeClass('no-grid');
                $('#toggle-grid').bootstrapSwitch('state', true);
            } else {
                $('#treediv').addClass('no-grid');
                $('#sponsortreediv').addClass('no-grid');
                $('#toggle-grid').bootstrapSwitch('state', false);
            }
        }
         else {
            $.cookie("tree_grid", "true");
            $('#treediv').removeClass('no-grid');
            $('#sponsortreediv').removeClass('no-grid');
            $('#toggle-grid').bootstrapSwitch();

            
        }
    }
});
$('#toggle-grid').on('switchChange.bootstrapSwitch', function() {
    var state = $('#toggle-grid').bootstrapSwitch('state');
    if (typeof state != 'undefined') {
        if (state == true) {
            $.cookie("tree_grid", "true");
            $('#treediv').removeClass('no-grid'); // activate     
            $('#sponsortreediv').removeClass('no-grid'); // activate     
        } else {
            $.cookie("tree_grid", "false");
            $('#treediv').addClass('no-grid'); // deactivate
            $('#sponsortreediv').addClass('no-grid'); // deactivate
        }
    } else {
        $.cookie("tree_grid", "true");
        $('#treediv').removeClass('no-grid'); // activate  
        $('#sponsortreediv').removeClass('no-grid'); // activate  
    }
}); 
// $.cookie("online", "true"); 
//------------------------------------//
//Wow Animation//
//------------------------------------// 
if ($('.wow').length) {
    wow = new WOW({
        boxClass: 'wow', // animated element css class (default is wow)
        animateClass: 'animated', // animation css class (default is animated)
        offset: 0, // distance to the element when triggering the animation (default is 0)
        mobile: false // trigger animations on mobile devices (true is default)
    });
    wow.init();
}
$(function() {
    $.scrollUp({
        scrollName: 'scrollUp', // Element ID
        scrollDistance: 300, // Distance from top/bottom before showing element (px)
        scrollFrom: 'top', // 'top' or 'bottom'
        scrollSpeed: 100, // Speed back to top (ms)
        easingType: 'linear', // Scroll to top easing (see http://easings.net/)
        animation: 'fade', // Fade, slide, none
        animationSpeed: 200, // Animation speed (ms)
        scrollTrigger: false, // Set a custom triggering element. Can be an HTML string or jQuery object
        scrollTarget: false, // Set a custom target element for scrolling to. Can be element or number
        scrollText: '⬆', // Text for element, can contain HTML
        scrollTitle: 'scroll to top', // Set a custom <a> title if required.
        scrollImg: false, // Set true to use image
        activeOverlay: false, // Set CSS color to display scrollUp active point, e.g '#00FFFF'
        zIndex: 2147483647 // Z-Index for the overlay
       
    });
});
if ($("#scrollUp").length) {
    $("#scrollUp").mPageScroll2id();
}
// if ($("a[href*='#']").length) {
//     $("a[href*='#']").mPageScroll2id();
// }
// Initialize plugins
// ------------------------------
// Select2 selects
// if ($('.select').length) {
//     $('.select').select2({
//         minimumResultsForSearch: Infinity
//     });
// }
if ($('.select2').length) {
    $('.select2').select2({
        minimumResultsForSearch: Infinity
    });
}
// Simple select without search
if ($('.select-simple').length) {
    $('.select-simple').select2({
        minimumResultsForSearch: Infinity
    });
}
// Format icon
function colorFormat(color) {
    var originalOption = color.element;
    if (!color.id) {
        return color.text;
    }
    var $color = "<span class='priorityround' style='background-color:" + $(color.element).data('color') + "'>&nbsp;</span>&nbsp;" + color.text;
    return $color;
}
if ($('.select-priority').length) {
    $(".select-priority").select2({
        templateResult: colorFormat,
        minimumResultsForSearch: Infinity,
        templateSelection: colorFormat,
        escapeMarkup: function(m) {
            return m;
        }
    }).on('change', function() {
        $(this).closest('select').selectedIndex = 1;
    }).trigger('change');
}
// Styled checkboxes and radios
if ($('.styled').length) {
    $('.styled').uniform({
        radioClass: 'choice'
    });
}
// Styled file input
if ($('.file-styled').length) {
    $('.file-styled').uniform({
        fileButtonClass: 'action btn bg-blue'
    });
}
// window.paypalCheckoutReady = function () {
// paypal.checkout.setup('supersandy_api1.gmail.com', {
// container: 'myContainer',
// environment: 'sandbox'
// });
// };
/*
Registration page end
 */
// If you using SweetAlert2 (Swal) and JQuery you can replace all alert and confirm that way.
// https://limonte.github.io/sweetalert2/
// TIP: if you aren't using JQuery, use native JavaScript to create extend method. As bellow:
/*
function extend(a, b){
    for(var key in b)
        if(b.hasOwnProperty(key))
            a[key] = b[key];
    return a;
}
*/
// keep default js alert to use in specific cases
window.legacyAlert = window.alert;
// types alert and confirm: "success", "error", "warning", "info", "question". Default: "warning"
// overwrite default js alert
window.alert = function(msg, title, type, params) {
    var title = (title == null) ? 'Alert' : title;
    var type = (type == null) ? 'warning' : type;
    swal($.extend({
        title: title,
        text: msg,
        type: type
    }, params || {}));
};
// keep default js alert to use in specific cases
window.legacyConfirm = window.confirm;
window.confirm = function(msg, title, type, func_if_yes, func_if_cancel, params) {
    var title = (title == null) ? 'Confirm' : title;
    var type = (type == null) ? 'warning' : type;
    swal($.extend({
        title: title,
        text: msg,
        type: type,
        showCancelButton: true,
        cancelButtonText: "Cancel",
        confirmButtonText: "Ok",
        allowEscapeKey: false,
        allowOutsideClick: false
    }, params || {})).then(function(isConfirm) {
        if (isConfirm && func_if_yes instanceof Function) {
            func_if_yes();
        }
    }, function(dismiss) {
        // dismiss can be 'cancel', 'overlay', 'close', 'timer'
        if (dismiss === 'cancel' && func_if_cancel instanceof Function) {
            func_if_cancel()
        }
    })
}; 
$(document).ready(function() {
    if ($('body .show-pop').length) {
        $('body .show-pop').webuiPopover();
    }
    if ($('.btn-ladda-spinner').length) {
        ladda.bind('.btn-ladda-spinner', {
            dataSpinnerSize: 16,
            timeout: 2000,
        });
    }
    if ($('.switch').length) {
        $(".switch").bootstrapSwitch();
    }
});
'use strict';
(function($) {
    $(function() {

        var levellimit=5; //default

        // This will fire each time the window is resized:
        if($(window).width() >= 1024) {
            // if larger or equal
            var levellimit=5;  
        } else {
            // if smaller
           var levellimit=2;
        }
   
        $(window).resize(function() {
            // This will fire each time the window is resized:
            if($(window).width() >= 1024) {
                // if larger or equal
                var levellimit=5;  
            } else {
                // if smaller
               var levellimit=2;
            }
            }).resize(); // This will simulate a resize to trigger the initial run.
       
        
        let searchParams = new URLSearchParams(window.location.search)
        if (searchParams.has('st')) {
            let param = searchParams.get('st')
            if (param) {
                var user = param;
            } else {
                var user = 1;
            }
        } else {
            var user = 1;
        }
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "POST",
            data: {
                'data': user,
                'levellimit': levellimit,
                '_token': $('meta[name="csrf-token"]').attr('content')
            },
        });
        var ajaxURLs = {
            // 'children': function(nodeData) {
            //     return 'getChildrenGenealogy/' + nodeData.id;
            // },
            // 'parent': 'tree-up?parent=true',
            // 'siblings': function(nodeData) {
            //     return 'getTree' + nodeData.id;
            // },
            // 'families': function(nodeData) {
            //     return 'getTree' + nodeData.id;
            // }
        };
        options = {
            'data': "getTree/"+levellimit,
            'ajaxURL': ajaxURLs,
            'nodeTitle': 'name',
            'parentNodeSymbol': 'fa fa-user',
            'nodeContent': 'content',
            // 'direction': 'l2r',
            'depth': 500,
            'pan': true,
            'zoom': true,
            'zoominLimit': 2,
            'createNode': function($node, data) {
                var secondMenuIcon = $('<i>', {
                    'class': 'fa fa-info-circle second-menu-icon show-pop',
                    'data-title': data.name,
                    'data-content': data.info,
                    click: function() {
                        $('.show-pop').webuiPopover({
                            backdrop: true
                        });
                    }
                });
                var secondMenu = '<div class="second-menu"><div class"title">' + data.name + '</div>' + data.info + '</div>';
                $node.append(secondMenuIcon).append(secondMenu);
            }
        }
        optionssponsortree = {
            'data': 'getsponsortreeurl',
            'ajaxURL': ajaxURLs,
            'nodeTitle': 'name',
            'parentNodeSymbol': 'fa fa-user',
            'nodeContent': 'content',
            'depth': 500,
            'pan': true,
            'zoom': true,
            'zoominLimit': 2,
            'createNode': function($node, data) {
                var secondMenuIcon = $('<i>', {
                    'class': 'fa fa-info-circle second-menu-icon show-pop',
                    'data-title': data.name,
                    'data-content': data.info,
                    click: function() {
                        $('.show-pop').webuiPopover({
                            // backdrop: true
                        });
                    }
                });
                var secondMenu = '<div class="second-menu"><div class"title">' + data.name + '</div>' + data.info + '</div>';
                $node.append(secondMenuIcon).append(secondMenu);
            }
        }
        if ($('#treediv').length) {
            var oc = $('#treediv').orgchart(options);     
            
        }
          if ($('#sponsortreediv').length) {
            var oc = $('#sponsortreediv').orgchart(optionssponsortree);     
            
        }

        if ($('#btn-restart-genealogy-node').length) {
            $('#btn-restart-genealogy-node').on('click', function() {
                // $('.orgchart').css('transform','');
                options.data = 'getTree/'+levellimit;
                oc.init(options);
                new PNotify({
                    text: 'Resetting tree',
                    delay: 1000,
                    // styling: 'brighttheme',
                    // icon: 'fa fa-file-image-o',
                    nonblock: {
                        nonblock: true
                    }
                });
            });
        }
 

       // Load sponsor tree init ******************************
        sponsortreeoptions = {
            'data': 'getsponsortree',
            'ajaxURL': ajaxURLs,
            'nodeTitle': 'name',
            'parentNodeSymbol': 'fa fa-user',
            'nodeContent': 'content',
            'depth': 500,
            'pan': true,
            'zoom': true,
            'zoominLimit': 2,
            'createNode': function($node, data) {
                var secondMenuIcon = $('<i>', {
                    'class': 'fa fa-info-circle second-menu-icon show-pop',
                    'data-title': data.name,
                    'data-content': data.info,
                    click: function() {
                        $('.show-pop').webuiPopover({
                            // backdrop: true
                        });
                    }
                });
                var secondMenu = '<div class="second-menu"><div class"title">' + data.name + '</div>' + data.info + '</div>';
                $node.append(secondMenuIcon).append(secondMenu);
            }
        }

         if ($('#sponsortreediv').length) {
            var oc = $('#sponsortreediv').orgchart(sponsortreeoptions);     

        }

        if ($('#btn-restart-node').length) {
            $('#btn-restart-node').on('click', function() {
                // $('.orgchart').css('transform','');
                options.data = 'getsponsortree';
                oc.init(options);
                new PNotify({
                    text: 'Resetting tree',
                    delay: 1000,
                    // styling: 'brighttheme',
                    // icon: 'fa fa-file-image-o',
                    nonblock: {
                        nonblock: true
                    }
                });
            });
        }

        $('#treediv').on('click', '.orgchart .node .title', function() {
            options.data = 'getChildrenGenealogy/' + $(this).parent('.node').find('.content img').data('accessid')+'/'+levellimit;
            options.createNode = function($node, data) {
                var secondMenuIcon = $('<i>', {
                    'class': 'fa fa-info-circle second-menu-icon show-pop',
                    'data-title': data.name,
                    'data-content': data.info,
                    click: function() {
                        $('.show-pop').webuiPopover({
                            // backdrop: true
                        });
                    }
                });
                var secondMenu = '<div class="second-menu"><div class"title">' + data.name + '</div>' + data.info + '</div>';
                $node.append(secondMenuIcon).append(secondMenu);
                if (data.usertype == 'root') {
                    if (data.id !== data.currentuserid) {
                        $node.prepend('<i id="tree-user-up" data-accessid="' + data.accessid + '" class="icon-arrow-up32" style="cursor:pointer;font-size:40px;color:#847f7f"></i>');
                    }
                }
            }
            oc.init(options);
        });
        $('#treediv').on('click', '#tree-user-up', function() {
            options.data = 'getParentGenealogy/' + $(this).data('accessid')+'/'+levellimit;
            options.createNode = function($node, data) {
                var secondMenuIcon = $('<i>', {
                    'class': 'fa fa-info-circle second-menu-icon show-pop',
                    'data-title': data.name,
                    'data-content': data.info,
                    click: function() {
                        $('.show-pop').webuiPopover({
                            // backdrop: true
                        });
                    }
                });
                var secondMenu = '<div class="second-menu"><div class"title">' + data.name + '</div>' + data.info + '</div>';
                $node.append(secondMenuIcon).append(secondMenu);
                if (data.usertype == 'root') {
                    if (data.id !== data.currentuserid) {
                        $node.prepend('<i id="tree-user-up" data-accessid="' + data.accessid + '" class="icon-arrow-up32" style="cursor:pointer;font-size:40px;color:#000"></i>');
                    }
                }
            }
            oc.init(options);
        });
        // $('#treediv').on('click', '.vacant img', function() {
        //     var accessid = $(this).data('accessid');
        //     var redirectPath = CLOUDMLMSOFTWARE.siteUrl + '/admin/register/' + accessid;
        //     console.log(redirectPath);
        //     window.location = redirectPath
        // });
        // $('#treediv').on('click', '.node.vacant .title', function(e) {
        //     e.preventDefault();
        //     var accessid = $(this).parent('.node').find('.content img').data('accessid');
        //     var redirectPath = CLOUDMLMSOFTWARE.siteUrl + '/admin/register/' + accessid;
        //     window.location = redirectPath
        // });
        
      //        $('#treediv').on('click', '.vacant img', function() {
      //     var accessid = $(this).data('accessid');
      //     console.log(accessid);
      //     if(CLOUDMLMSOFTWARE.admin == 1)
      //         var redirectPath = CLOUDMLMSOFTWARE.siteUrl + '/admin/register/' + accessid;
      //     else
      //         var redirectPath = CLOUDMLMSOFTWARE.siteUrl + '/user/register/' + accessid;
      //     console.log(redirectPath);
      //     window.location = redirectPath
      // });
      // $('#treediv').on('click', '.node.vacant .title', function(e) {
      //     e.preventDefault();
      //     var accessid = $(this).parent('.node').find('.content img').data('accessid');
      //     if(CLOUDMLMSOFTWARE.admin == 1)
      //         var redirectPath = CLOUDMLMSOFTWARE.siteUrl + '/admin/register/' + accessid;
      //     else
      //         var redirectPath = CLOUDMLMSOFTWARE.siteUrl + '/user/register/' + accessid;
      //     window.location = redirectPath
      // });



        // ---------------------------sponsor tree iterate starts-------

         $('#sponsortreediv').on('click', '.orgchart .node .title', function() {
            options.data = 'sponsor-child/' + $(this).parent('.node').find('.content img').data('accessid');
            options.createNode = function($node, data) {
                var secondMenuIcon = $('<i>', {
                    'class': 'fa fa-info-circle second-menu-icon show-pop',
                    'data-title': data.name,
                    'data-content': data.info,
                    click: function() {
                        $('.show-pop').webuiPopover({
                            // backdrop: true
                        });
                    }
                }); 
                var secondMenu = '<div class="second-menu"><div class"title">' + data.name + '</div>' + data.info + '</div>';
                $node.append(secondMenuIcon).append(secondMenu);
                if (data.usertype == 'root') {
                    if (data.id !== data.currentuserid) {
                        $node.prepend('<i id="tree-user-up" data-accessid="' + data.accessid + '" class="icon-arrow-up32" style="cursor:pointer;font-size:40px;color:#847f7f"></i>');
                    }
                }
            }
            oc.init(options); 
        });
        $('#sponsortreediv').on('click', '#tree-user-up', function() {
            options.data = 'sponsor-up/' + $(this).data('accessid');
            options.createNode = function($node, data) {
                var secondMenuIcon = $('<i>', {
                    'class': 'fa fa-info-circle second-menu-icon show-pop',
                    'data-title': data.name,
                    'data-content': data.info,
                    click: function() {
                        $('.show-pop').webuiPopover({
                            // backdrop: true
                        });
                    }
                });
                var secondMenu = '<div class="second-menu"><div class"title">' + data.name + '</div>' + data.info + '</div>';
                $node.append(secondMenuIcon).append(secondMenu);
                if (data.usertype == 'root') {
                    if (data.id !== data.currentuserid) {
                        $node.prepend('<i id="tree-user-up" data-accessid="' + data.accessid + '" class="icon-arrow-up32" style="cursor:pointer;font-size:40px;color:#000"></i>');
                    }
                }
            }
            oc.init(options);
        });
        $('#sponsortreediv').on('click', '.vacant img', function() {
            var accessid = $(this).data('accessid');
            var redirectPath = CLOUDMLMSOFTWARE.siteUrl + '/admin/register/' + accessid;
            console.log(redirectPath);
            window.location = redirectPath
        });
        $('#sponsortreediv').on('click', '.node.vacant .title', function(e) {
            e.preventDefault();
            var accessid = $(this).parent('.node').find('.content img').data('accessid');
            var redirectPath = CLOUDMLMSOFTWARE.siteUrl + '/admin/register/' + accessid;
            window.location = redirectPath
        });

         $('#searchsponsortreeholder').on('click', '#btn-filter-node', function() {
            if (!($('#key_user_hidden').val()).length) {
                window.alert('Please type keyword to find user!');
                return;
            }
            options.data = 'getsponsorchildrenByUserName/' + $('#key_user_hidden').val();
            options.createNode = function($node, data) {
                var secondMenuIcon = $('<i>', {
                    'class': 'fa fa-info-circle second-menu-icon show-pop',
                    'data-title': data.name,
                    'data-content': data.info,
                    click: function() {
                        $('.show-pop').webuiPopover({
                            // backdrop: true
                        });
                    }
                });
                var secondMenu = '<div class="second-menu"><div class"title">' + data.name + '</div>' + data.info + '</div>';
                $node.append(secondMenuIcon).append(secondMenu);
                if (data.usertype == 'root') {
                    if (data.id !== data.currentuserid) {
                        $node.prepend('<i id="tree-user-up" data-accessid="' + data.accessid + '" class="icon-arrow-up32" style="cursor:pointer;font-size:40px;color:#847f7f"></i>');
                    }
                }
            }
            oc.init(options);
        });
        // ---------------------------sponsor tree iterate end-------
        

        $('#searchtreeholder').on('click', '#btn-filter-node', function() {
            if (!($('#key_user_hidden').val()).length) {
                window.alert('Please type keyword to find user!');
                return;
            }
            options.data = 'getChildrenGenealogyByUserName/' + $('#key_user_hidden').val()+'/'+levellimit;
            options.createNode = function($node, data) {
                var secondMenuIcon = $('<i>', {
                    'class': 'fa fa-info-circle second-menu-icon show-pop',
                    'data-title': data.name,
                    'data-content': data.info,
                    click: function() {
                        $('.show-pop').webuiPopover({
                             backdrop: true
                        });
                    }
                });
                var secondMenu = '<div class="second-menu"><div class"title">' + data.name + '</div>' + data.info + '</div>';
                $node.append(secondMenuIcon).append(secondMenu);
                if (data.usertype == 'root') {
                    if (data.id !== data.currentuserid) {
                        $node.prepend('<i id="tree-user-up" data-accessid="' + data.accessid + '" class="icon-arrow-up32" style="cursor:pointer;font-size:40px;color:#847f7f"></i>');
                    }
                }
            }
            oc.init(options);
        });
        $('.orgchart').addClass('noncollapsable');
    });
    //http://suggestqueries.google.com/complete/search?client=chrome&q=%QUERY
    if ($('#key-word').length) {
        $(function() {
            $("#key-word").autocomplete({
                source: CLOUDMLMSOFTWARE.siteUrl + "/admin/search/autocomplete",
                minLength: 2,
                select: function(event, ui) {
                    $('#key-word').val(ui.item.value);
                    $('#key_user_hidden').val(ui.item.username);
                }
            });
        });
    }
      if ($('#key-word-user').length) {
        $(function() {
            $("#key-word-user").autocomplete({
                source: CLOUDMLMSOFTWARE.siteUrl + "/user/search/autocomplete",
                minLength: 2,
                select: function(event, ui) {
                    $('#key-word-user').val(ui.item.value);
                    $('#key_user_hidden').val(ui.item.username);
                }
            });
        });
    }

       if ($('#key-word-user-binary').length) {
        $(function() {
            $("#key-word-user-binary").autocomplete({
                source: CLOUDMLMSOFTWARE.siteUrl + "/user/search/binary/autocomplete",
                minLength: 2,
                select: function(event, ui) {
                    $('#key-word-user-binary').val(ui.item.value);
                    $('#key_user_hidden').val(ui.item.username);
                }
            });
        });
    }









    if ($('.autocompleteusers').length) {
        $(function() {
            $(".autocompleteusers").autocomplete({
                source: CLOUDMLMSOFTWARE.siteUrl + "/admin/search/autocomplete",
                minLength: 2,
                select: function(event, ui) {
                    $('.autocompleteusers').val(ui.item.value);
                    $('.key_user_hidden').val(ui.item.username);
                }
            });
        });
    }
    if ($('#btn-cancel').length) {
        $('#btn-cancel').on('click', function() {
            $('#key-word').val('');
            $('#key_user_hidden').val('');
        });
    }
    // function filterNodes(keyWord) {
    //     if ($('.orgchart').length) {
    //         if (!keyWord.length) {
    //             window.alert('Please type key word firstly.');
    //             return;
    //         } else {
    //             var $chart = $('.orgchart');
    //             // disalbe the expand/collapse feture
    //             // $chart.addClass('noncollapsable');
    //             // distinguish the matched nodes and the unmatched nodes according to the given key word
    //             $chart.removeClass('noncollapsable').find('.node').removeClass('matched retained').end().find('.hidden').removeClass('hidden').end().find('.slide-up, .slide-left, .slide-right').removeClass('slide-up slide-right slide-left');
    //             $chart.find('.node').filter(function(index, node) {
    //                 return $(node).text().toLowerCase().indexOf(keyWord) > -1;
    //             }).addClass('matched').closest('table').parents('table').find('tr:first').find('.node').addClass('retained');
    //             // hide the unmatched nodes
    //             $chart.find('.matched,.retained').each(function(index, node) {
    //                 $(node).removeClass('slide-up').closest('.nodes').removeClass('hidden').siblings('.lines').removeClass('hidden');
    //                 var $unmatched = $(node).closest('table').parent().siblings().find('.node:first:not(.matched,.retained)').closest('table').parent().addClass('hidden');
    //                 $unmatched.parent().prev().children().slice(1, $unmatched.length * 2 + 1).addClass('hidden');
    //             });
    //             // hide the redundant descendant nodes of the matched nodes
    //             $chart.find('.matched').each(function(index, node) {
    //                 if (!$(node).closest('tr').siblings(':last').find('.matched').length) {
    //                     $(node).closest('tr').siblings().addClass('hidden');
    //                 }
    //             });
    //         }
    //     }
    // }
    // function clearFilterResult() {
    //     if ($('.orgchart').length) {
    //         $('.orgchart').removeClass('noncollapsable').find('.node').removeClass('matched retained').end().find('.hidden').removeClass('hidden').end().find('.slide-up, .slide-left, .slide-right').removeClass('slide-up slide-right slide-left');
    //     }
    // }
    // if ($('#btn-filter-node').length) {
    //     $('#btn-filter-node').on('click', function() {
    //         filterNodes($('#key-word').val());
    //     });
    // }
    // if ($('#btn-cancel').length) {
    //     $('#btn-cancel').on('click', function() {
    //         clearFilterResult();
    //     });
    // }
    // if ($('#key-word').length) {
    //     $('#key-word').on('keyup', function(event) {
    //         if (event.which === 13) {
    //             filterNodes(this.value);
    //         } else if (event.which === 8 && this.value.length === 0) {
    //             clearFilterResult();
    //         }
    //     });
    // }
})(jQuery);
$(document).ready(function() {
    var interval = setInterval(function() {
        var momentNow = moment();
        momentNow.locale('en')
        if ($('#year-part').length) {
            $('#year-part').html(momentNow.format('YYYY').toUpperCase());
        }
        if ($('#month-part').length) {
            $('#month-part').html(momentNow.format('MMMM').toUpperCase());
        }
        if ($('#date-part').length) {
            $('#date-part').html(momentNow.format('DD').toUpperCase());
        }
        if ($('#day-part').length) {
            $('#day-part').html(momentNow.format('dddd').substring(0, 3).toUpperCase());
        }
        if ($('#time-part').length) {
            $('#time-part').html(momentNow.format('hh:mm:ss').toUpperCase());
        }
        if ($('#ampm-part').length) {
            $('#ampm-part').html(momentNow.format('A').toUpperCase());
        }
        // $('#time-part').html(momentNow.format('A hh:mm:ss'));
    }, 100);
    if ($('#stop-interval').length) {
        $('#stop-interval').on('click', function() {
            clearInterval(interval);
        });
    }
});
$(document).ready(function() {
    if ($('#toggleOnlineStatus').length) {
        // console.log('found');
        $('#toggleOnlineStatus').on('switchChange.bootstrapSwitch', function() {
            var state = $('#toggleOnlineStatus').bootstrapSwitch('state');
            console.log(state);
            if (state == false) {
                $.ajax({
                    type: "POST",
                    url: '/chat/setPresence',
                    data: {
                        'status': false
                    }
                });
                new PNotify({
                    text: 'Presence set to "offline"',
                    // styling: 'brighttheme',
                    // icon: 'fa fa-file-image-o',
                    type: 'danger',
                    delay: 1000,
                    animate_speed: 'fast',
                    nonblock: {
                        nonblock: true
                    }
                });
            } else {
                $.ajax({
                    type: "POST",
                    url: '/chat/setPresence',
                    data: {
                        'status': true
                    }
                });
                new PNotify({
                    text: 'Presence set to "online"',
                    // styling: 'brighttheme',
                    // icon: 'fa fa-file-image-o',
                    type: 'success',
                    delay: 1000,
                    animate_speed: 'fast',
                    nonblock: {
                        nonblock: true
                    }
                });
            }
        });
    }
    if ($('#toggleOnlineStatus').length) {
        if ($('#toggleOnlineStatus').is(":checked")) {
            $("#toggleOnlineStatus").bootstrapSwitch('state', true)
        } else {
            $("#toggleOnlineStatus").bootstrapSwitch('state', false)
                // console.log('got unchecked');
        }
    }
});

// $(document).ready(function(){
// if ($('select').length) {
//     $('select').select2({
//         containerCssClass: 'select-md'
//     });
// }
// });
$(document).ready(function() {
    if (CLOUDMLMSOFTWARE.idleTimeout === true) {
        $.sessionTimeout({
            heading: 'h5',
            title: 'Session expiration',
            message: 'Your session is about to expire. Do you want to stay connected and extend your session?',
            keepAlive: false,
            // keepAliveInterval: 5000,
            redirUrl: CLOUDMLMSOFTWARE.LockUrl,
            logoutUrl: CLOUDMLMSOFTWARE.LockUrl,
            warnAfter: CLOUDMLMSOFTWARE.idleTimeoutTime, //5 minutes default
            redirAfter: CLOUDMLMSOFTWARE.idleTimeoutTime + 60000, //+1 minute
            keepBtnClass: 'btn btn-success',
            keepBtnText: 'Extend session',
            logoutBtnClass: 'btn btn-default',
            logoutBtnText: 'Log me out',
            ignoreUserActivity: false,
        });
    }
});
handleJstreeAjax = function() {
        $("#jstree-ajax").jstree({
            core: {
                themes: {
                    responsive: !1
                },
                check_callback: !0,
                data: {
                    url: function(e) {
                        // alert(e.id);
                        return "#" === e.id ? "treedata" : e.original.file
                    },
                    data: function(e) {
                        if ("#" === e.id) return {
                            id: $('meta[name="root-id"]').attr('content')
                        }
                        else return {
                            id: e.id
                        }
                    },
                    dataType: "json",
                    type: "GET"
                }
            },
            types: {
                "default": {
                    icon: "fa fa-user text-warning fa-lg"
                },
                file: {
                    icon: "fa fa-file text-warning fa-lg"
                }
            },
            plugins: ["dnd", "state", "types"]
        })
    },
    TreeView = function() {
        "use strict";
        return {
            init: function() {
                handleJstreeAjax()
            }
        }
    }();
if ($('#jstree-ajax').length) {
    handleJstreeAjax();
}
$(document).ready(function() {
    if ($('.passy').length) {
        // $( '.passy input' ).passy( 'generate', 16 );
        // Passy - password generator
        // ------------------------------
        // Input labels
        var $inputLabelAbsolute = $('.label-indicator-absolute input');
        //Output lables
        var $outputLabelAbsolute = $('.password-indicator-label-abs');
        // Min input length
        $.passy.requirements.length.min = 4;
        // Strength meter
        var feedback = [{
            color: '#D55757',
            text: 'Weak',
            textColor: '#fff'
        }, {
            color: '#EB7F5E',
            text: 'Normal',
            textColor: '#fff'
        }, {
            color: '#3BA4CE',
            text: 'Good',
            textColor: '#fff'
        }, {
            color: '#40B381',
            text: 'Strong',
            textColor: '#fff'
        }];
        //
        // Setup strength meter
        //
        // Absolute positioned label
        $inputLabelAbsolute.passy(function(strength) {
            $outputLabelAbsolute.text(feedback[strength].text);
            $outputLabelAbsolute.css('background-color', feedback[strength].color).css('color', feedback[strength].textColor);
        });
        //
        // Initialize
        //
        // Absolute label
        $('.generate-pass').click(function() {
            $inputLabelAbsolute.passy('generate', 13);
        });
    }
});
//online users

 if ($('#onlineusers-table').length) {
       $(document).ready(function() {
           oTable = $('#onlineusers-table').DataTable({
               "processing": true,
               "serverSide": true,
               "ordering": false,
               "ajax": CLOUDMLMSOFTWARE.siteUrl + "/admin/onlineusers/data",
               "fnDrawCallback": function(oSettings) {}
           });
       });
   }

//LOGO UPDATION
$("#logo").change(function() {
    $("#logoform").submit();
});
$(document).ready(function() {
    $("#logoform").submit(function(evt) {
        evt.preventDefault();
        var formData = new FormData($(this)[0]);
        $.ajax({
            url: CLOUDMLMSOFTWARE.siteUrl + '/imageupload',
            data: new FormData($("#logoform")[0]), 
            dataType: 'json',
            async: true,
            type: 'post',
            processData: false,
            contentType: false,
            beforeSend: function() {
                // $('#profilephotopreview').after('<div class="ajxloaderinner"><img class="ajxloader" src={{url("assets/globals/images/ajxloader.gif")}}></div>');
            },
            success: function(response) {
                console.log(response);
                $('#logopreview').css('background-image', 'url(' + CLOUDMLMSOFTWARE.siteUrl + '/img/cache/logo/' + response.filename + ')');
                setTimeout(function() {}, 2000);
            },
        });
        return false;
    });
});
//LOGO icon UPDATION
$("#logoicon").change(function() {
    $("#logoiconform").submit();
});
$(document).ready(function() {
    $("#logoiconform").submit(function(evt) {
        evt.preventDefault();
        var formData = new FormData($(this)[0]);
        $.ajax({
            url: CLOUDMLMSOFTWARE.siteUrl + '/imageupload',
            data: new FormData($("#logoiconform")[0]), 
            dataType: 'json',
            async: true,
            type: 'post',
            processData: false,
            contentType: false,
            beforeSend: function() {
                // $('#profilephotopreview').after('<div class="ajxloaderinner"><img class="ajxloader" src={{url("assets/globals/images/ajxloader.gif")}}></div>');
            },
            success: function(response) {
                console.log(response);
                $('#logoiconpreview').css('background-image', 'url(' + CLOUDMLMSOFTWARE.siteUrl + '/img/cache/logo/' + response.filename + ')');
                setTimeout(function() {}, 2000);
            },
        });
        return false;
    });
});
//PROFILE PIC UPDATION
$("#profile").change(function() {
    $("#profilepicform").submit();
});
$(document).ready(function() {
    $("#profilepicform").submit(function(evt) {
        evt.preventDefault();
        var formData = new FormData($(this)[0]);
        $.ajax({
            url: CLOUDMLMSOFTWARE.siteUrl + '/imageupload',
            data: new FormData($("#profilepicform")[0]),
            dataType: 'json',
            async: true,
            type: 'post',
            processData: false,
            contentType: false,
            beforeSend: function() {
                // $('#profilephotopreview').after('<div class="ajxloaderinner"><img class="ajxloader" src={{url("assets/globals/images/ajxloader.gif")}}></div>');
            },
            success: function(response) {
                console.log(response);
                $('#profilephotopreview').css('background-image', 'url(' + CLOUDMLMSOFTWARE.siteUrl + '/img/cache/profile/' + response.filename + ')');
                setTimeout(function() {}, 2000);
            },
        });
        return false;
    });
});
//PROFILE COVER UPDATION
$("#cover").change(function() {
    $("#coverpicform").submit();
});
$(document).ready(function() {
    $("#coverpicform").submit(function(evt) {
        evt.preventDefault();
        var formData = new FormData($(this)[0]);
        $.ajax({
            url: CLOUDMLMSOFTWARE.siteUrl + '/imageupload',
            data: new FormData($("#coverpicform")[0]),
            dataType: 'json',
            async: true,
            type: 'post',
            processData: false,
            contentType: false,
            beforeSend: function() {
                // $('#profilephotopreview').after('<div class="ajxloaderinner"><img class="ajxloader" src={{url("assets/globals/images/ajxloader.gif")}}></div>');
            },
            success: function(response) {
                $('.profile-cover-img').css('background-image', 'url(' + CLOUDMLMSOFTWARE.siteUrl + '/img/cache/original/' + response.filename + ')');
                setTimeout(function() {}, 2000);
            },
        });
        return false;
    });
});
if ($("#note-color").length) {
    $("#note-color :input").change(function() {
        var color = $(this).attr('value');
        $(this).parent().parent().parent().parent().parent().parent().attr('class', '');
        $(this).parent().parent().parent().parent().parent().parent().addClass(color + ' panel panel-flat');
    });
};
if ($(".colorpicker-basic").length) {
    $(".colorpicker-basic").spectrum({
        preferredFormat: "hex",
        showInput: true,
        showPalette: true,
        palette: [
            ["red", "rgba(0, 255, 0, .5)", "rgb(0, 0, 255)"]
        ],
        move: function(color) {
            console.log(color.toHexString()); // #ff0000
        }
    });
}
$('.submit-note').click(function() {
    $('.notesform').submit();
});
$(".notesform").submit(function(e) {
    e.preventDefault();
    var formData = new FormData($(this)[0]);
    $('.notesform').parsley().validate();
    if ($('.notesform').parsley().isValid()) {
        var block = $(this).parent().parent().parent().parent();
        $.ajax({
            url: CLOUDMLMSOFTWARE.siteUrl + '/admin/post-note',
            data: new FormData($('.notesform')[0]),
            dataType: 'json',
            async: true,
            type: 'post',
            processData: false,
            contentType: false,
            beforeSend: function() {
                $(block).block({
                    message: '<i class="icon-spinner2 spinner"></i>',
                    overlayCSS: {
                        backgroundColor: '#fff',
                        opacity: 0.8,
                        cursor: 'wait',
                        'box-shadow': '0 0 0 1px #ddd'
                    },
                    css: {
                        border: 0,
                        padding: 0,
                        backgroundColor: 'none'
                    }
                });
            },
            success: function(response) {
                $(block).unblock();
                $('.notesform').find("input[type=text], textarea").val("");
                new PNotify({
                    text: 'Note Added',
                    // styling: 'brighttheme',
                    // icon: 'fa fa-file-image-o',
                    type: 'success',
                    delay: 1000,
                    animate_speed: 'fast',
                    nonblock: {
                        nonblock: true
                    }
                });
                if ($('.notes').length) {
                    $newNote = '<div class="each-note col-sm-3"><div class="panel ' + response.color + '"><div class="panel-body"><div class="media"><div class="media-left"><i class=" icon-file-text3 text-warning-400 no-edge-top mt-5"></i></div><div class="media-body"><h6 class="media-heading text-semibold">' + response.title + ' - <i class="text-xs">' + response.date + '</i></h6>' + response.description + '</div></div></div></div></div>';
                    $('.notes>.row:first-child').append($newNote);
                }
            }
        });
    } else {
        console.log('not valid');
    }
});
$(document).ready(function() {
    if ($(".btn-delete-note").length) {
        $('.notes').on('click', '.btn-delete-note', function(e) {
            var id = $(this).data('id');
            var this_context = $(this);
            // confirm('Are you sure you want to delete the note?','confirmation','yes','no');
            swal({
                title: "Are you sure?",
                text: "You will not be able to recover this note!",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: "btn-danger",
                confirmButtonText: "Yes, delete it!",
                closeOnConfirm: false
            }, function() {
                //console.log(id);
                $.ajax({
                    url: CLOUDMLMSOFTWARE.siteUrl + '/admin/remove-note',
                    data: {
                        'note_id': id
                    },
                    dataType: 'json',
                    async: true,
                    type: 'post',
                    beforeSend: function() {
                        this_context.closest('.each-note')
                    },
                    success: function(response) {
                        this_context.closest('.each-note').remove();
                        swal('Deleted!');
                        setTimeout(function() {}, 2000);
                    },
                    error: function(response) {
                        swal('Something went wrong!');
                    }
                });
            });
        });
    }
});
$(function() {
    // Table setup
    // ------------------------------
    // Setting datatable defaults
    $.extend($.fn.dataTable.defaults, {
        autoWidth: false,
        // columnDefs: [{ 
        //     orderable: false,
        //     // width: '100px',
        //     targets: [ 5 ]
        // }],
        dom: '<"datatable-header"fl><"datatable-scroll"t><"datatable-footer"ip>',
        language: {
            search: '<span>Filter:</span> _INPUT_',
            searchPlaceholder: 'Type to filter...',
            lengthMenu: '<span>Show:</span> _MENU_',
            // paginate: {
            //     'first': 'First',
            //     'last': 'Last',
            //     'next': '&rarr;',
            //     'previous': '&larr;'
            // }
        },
        drawCallback: function() {
            $(this).find('tbody tr').slice(-3).find('.dropdown, .btn-group').addClass('dropup');
        },
        preDrawCallback: function() {
            $(this).find('tbody tr').slice(-3).find('.dropdown, .btn-group').removeClass('dropup');
        }
    });
    if ($('#users-table').length) {
        $(document).ready(function() {
            oTable = $('#users-table').DataTable({
                "processing": true,
                "serverSide": true,
                "ordering": false,
                "ajax": CLOUDMLMSOFTWARE.siteUrl + "/admin/users/data",
                "fnDrawCallback": function(oSettings) {}
            });
        });
    }
    if ($('#ewallet-table').length) {
        $(document).ready(function() {
            oTable = $('#ewallet-table').DataTable({
                "processing": true,
                "serverSide": true,
                "ordering": false,
                "ajax": CLOUDMLMSOFTWARE.siteUrl + "/admin/ewallet/",
                "fnDrawCallback": function(oSettings) {}
            });
        });
    }

          if ($('#pending-users').length) {
        $(document).ready(function() {
            oTable = $('#pending-users').DataTable({
                "processing": true,
                "serverSide": true,
                "ordering": false,
                "ajax": CLOUDMLMSOFTWARE.siteUrl + "/admin/pendingtransactions/data/",
                "fnDrawCallback": function(oSettings) {}
            });
        });
    }
      if ($('#ewallet-user-table').length) {
        $(document).ready(function() {
            oTable = $('#ewallet-user-table').DataTable({
                "processing": true,
                "serverSide": true,
                "ordering": false,
                "ajax": CLOUDMLMSOFTWARE.siteUrl + "/user/wallet/data/",
                "fnDrawCallback": function(oSettings) {}
            });
        });
    }
    if ($('#rs-wallet-table').length) {
        $(document).ready(function() {
            oTable = $('#rs-wallet-table').DataTable({
                "processing": true,
                "serverSide": true,
                "ordering": false,
                "ajax": CLOUDMLMSOFTWARE.siteUrl + "/admin/rs-data/",
                "fnDrawCallback": function(oSettings) {}
            });
        });
    }

    if ($('#ticket-departments-table').length) {
        $(document).ready(function() {
            oTable = $('#ticket-departments-table').DataTable({
                "processing": true,
                "serverSide": true,
                "ordering": false,
                "ajax": CLOUDMLMSOFTWARE.siteUrl + "/admin/helpdesk/tickets/departments/data/",
                "fnDrawCallback": function(oSettings) {}
            });
        });

        function reloadDataTable() {
            oTable.ajax.reload();
        }
    }
    if ($('#ticket-categories-table').length) {
        $(document).ready(function() {
            oTable = $('#ticket-categories-table').DataTable({
                "processing": true,
                "serverSide": true,
                "ordering": false,
                "ajax": CLOUDMLMSOFTWARE.siteUrl + "/admin/helpdesk/tickets/categories/data/",
                "fnDrawCallback": function(oSettings) {}
            });
        });

        function reloadDataTable() {
            oTable.ajax.reload();
        }
    }

     if ($('#ticket-status-table').length) {
        $(document).ready(function() {
            oTable = $('#ticket-status-table').DataTable({
                "processing": true,
                "serverSide": true,
                "ordering": false,
                "ajax": CLOUDMLMSOFTWARE.siteUrl + "/admin/helpdesk/tickets/ticket-status/data/",
                "fnDrawCallback": function(oSettings) {}
            });
        });

        function reloadDataTable() {
            oTable.ajax.reload();
        }
    }

    if ($('#ticket-priority-table').length) {
        $(document).ready(function() {
            oTable = $('#ticket-priority-table').DataTable({
                "processing": true,
                "serverSide": true,
                "ordering": false,
                "ajax": CLOUDMLMSOFTWARE.siteUrl + "/admin/helpdesk/tickets/priorities/data/",
                "fnDrawCallback": function(oSettings) {}
            });
        });

        function reloadDataTable() {
            oTable.ajax.reload();
        }
    }
    if ($('#ticket-canned-response-table').length) {
        $(document).ready(function() {
            oTable = $('#ticket-canned-response-table').DataTable({
                "processing": true,
                "serverSide": true,
                "ordering": false,
                "ajax": CLOUDMLMSOFTWARE.siteUrl + "/admin/helpdesk/tickets/canned-responses/data/",
                "fnDrawCallback": function(oSettings) {}
            });
        });

        function reloadDataTable() {
            oTable.ajax.reload();
        }
    }
    if ($('#kb-category-table').length) {
        $(document).ready(function() {
            oTable = $('#kb-category-table').DataTable({
                "processing": true,
                "serverSide": true,
                "ordering": false,
                "ajax": CLOUDMLMSOFTWARE.siteUrl + "/admin/helpdesk/kb/categories/data/",
                "fnDrawCallback": function(oSettings) {}
            });
        });

        function reloadDataTable() {
            oTable.ajax.reload();
        }
    }
    if ($('#kb-article-table').length) {
        $(document).ready(function() {
            oTable = $('#kb-article-table').DataTable({
                "processing": true,
                "serverSide": true,
                "ordering": false,
                "ajax": CLOUDMLMSOFTWARE.siteUrl + "/admin/helpdesk/kb/articles/data/",
                "fnDrawCallback": function(oSettings) {}
            });
        });

        function reloadDataTable() {
            oTable.ajax.reload();
        }
    }
    if ($('#ticket-types-table').length) {
        $(document).ready(function() {
            oTable = $('#ticket-types-table').DataTable({
                "processing": true,
                "serverSide": true,
                "ordering": false,
                "ajax": CLOUDMLMSOFTWARE.siteUrl + "/admin/helpdesk/tickets/ticket-types/data/",
                "fnDrawCallback": function(oSettings) {}
            });
        });

        function reloadDataTable() {
            oTable.ajax.reload();
        }
    }
    if ($('#ticket-table').length) {
        var priority = $('#ticket-table').attr('data-priority');
        var department = $('#ticket-table').attr('data-department');
        var category = $('#ticket-table').attr('data-category');
        var status = $('#ticket-table').attr('data-status');
        var overdue = $('#ticket-table').attr('data-overdue');
        var deleted = $('#ticket-table').attr('data-deleted');
        $(document).ready(function() {
            oTable = $('#ticket-table').DataTable({
                "processing": true,
                "serverSide": true,
                "ordering": true,
                "ajax": CLOUDMLMSOFTWARE.siteUrl + "/admin/helpdesk/tickets/data/?priority=" + priority + "&department=" + department + "&category=" + category + "&status=" + status + "&overdue=" + overdue + "&deleted=" + deleted,
                "fnDrawCallback": function(oSettings) {}
            });
        });

        function reloadDataTable() {
            oTable.ajax.reload();
        }
    }
});
//Category
$(function() {
    if ($('#categories .category').length) {
        $.fn.editable.defaults.mode = 'popup';
        $.fn.editable.defaults.params = function(params) {
            params._token = $("meta[name=csrf-token]").attr("content");
            return params;
        };
        $('.category').editable({
            validate: function(value) {},
            type: 'text',
            url: CLOUDMLMSOFTWARE.siteUrl + '/admin/save_ticket_categories',
            placement: 'top',
            send: 'always',
            disabled: false,
            ajaxOptions: {
                dataType: 'json'
            },
            success: function(response, newValue) {
                $(this).html(newValue);
            }
        });
    }
});
// $(function(){
//     if ($('#faq_enable').length) {
//          $('#faq .faq').editable('toggleDisabled');
//          $('#faq_enable').click(function() {
//              $('#faq .faq').editable('toggleDisabled');
//               $('#faq_enable').text(function(i, text){
//                  return text === "Enable edit mode" ? "Disable edit mode" : "Enable edit mode";
//             });
//         });
//     $.fn.editable.defaults.mode = 'popup';
//     $.fn.editable.defaults.params = function (params) {
//         params._token = $("meta[name=csrf-token]").attr("content");
//         return params;
//     };
//     $('.faq').editable({
//         validate: function(value) {
//     },        
//     type: 'text',
//     url:CLOUDMLMSOFTWARE.siteUrl+'/admin/update_ticket_faq', 
//     placement: 'top', 
//     send:'always',
//     disabled:true,
//     ajaxOptions: {
//     dataType: 'json'
//     },
//     success: function(response, newValue) {
//         $(this).html(newValue);
//         }        
//  });
// }
//  });
$(document).ready(function() {
    $('.content').on('click', '.btn-delete-category', function(e) {
        var id = $(this).data('id');
        var this_context = $(this);
        swal({
            title: "Are you sure?",
            text: "All related tickets will be unlinked from this category",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Yes, delete it!",
            closeOnConfirm: false
        }, function() {
            window.location.href = CLOUDMLMSOFTWARE.siteUrl + '/admin/helpdesk/tickets/categories/destroy/' + id;
        });
    });
    if ($(".btn-delete-tag").length) {
        $('#ticket-tags').on('click', '.btn-delete-tag', function(e) {
            var id = $(this).data('id');
            var this_context = $(this);
            swal({
                title: "Are you sure?",
                text: "All related tickets will be unlinked from this category",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: "btn-danger",
                confirmButtonText: "Yes, delete it!",
                closeOnConfirm: false
            }, function() {
                window.location.href = CLOUDMLMSOFTWARE.siteUrl + '/admin/delete_ticket_tags/' + id;
            });
        });
    }
    if ($(".btn-delete-status").length) {
        $('#ticket-statuses').on('click', '.btn-delete-status', function(e) {
            var id = $(this).data('id');
            var this_context = $(this);
            swal({
                title: "Are you sure?",
                text: "All related tickets will be unlinked from this status",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: "btn-danger",
                confirmButtonText: "Yes, delete it!",
                closeOnConfirm: false
            }, function() {
                window.location.href = CLOUDMLMSOFTWARE.siteUrl + '/admin/delete_ticket_status/' + id;
            });
        });
    }
    if ($(".btn-delete-priority").length) {
        $('#ticket-priorities').on('click', '.btn-delete-priority', function(e) {
            var id = $(this).data('id');
            var this_context = $(this);
            swal({
                title: "Are you sure?",
                text: "All related tickets will be unlinked from this priority",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: "btn-danger",
                confirmButtonText: "Yes, delete it!",
                closeOnConfirm: false
            }, function() {
                window.location.href = CLOUDMLMSOFTWARE.siteUrl + '/admin/delete_ticket_priority/' + id;
            });
        });
    }
    $('.content').on('click', '.btn-delete-kb-category', function(e) {
        var id = $(this).data('id');
        var this_context = $(this);
        swal({
            title: "Are you sure?",
            text: "All related articles will be unlinked from this category",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Yes, delete it!",
            closeOnConfirm: false
        }, function() {
            window.location.href = CLOUDMLMSOFTWARE.siteUrl + '/admin/helpdesk/kb/category/delete/' + id;
        });
    });
    $('.content').on('click', '.btn-delete-kb-article', function(e) {
        var id = $(this).data('id');
        var this_context = $(this);
        swal({
            title: "Are you sure?",
            text: "This article will be deleted!",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Yes, delete it!",
            closeOnConfirm: false
        }, function() {
            window.location.href = CLOUDMLMSOFTWARE.siteUrl + '/admin/helpdesk/kb/article/delete/' + id;
        });
    });
    $('.content').on('click', '.btn-delete-canned-response', function(e) {
        var id = $(this).data('id');
        var this_context = $(this);
        swal({
            title: "Are you sure?",
            text: "This canned reponse will be deleted!",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Yes, delete it!",
            closeOnConfirm: false
        }, function() {
            window.location.href = CLOUDMLMSOFTWARE.siteUrl + '/admin/helpdesk/tickets/canned-responses/delete/' + id;
        });
    });
    $('.content').on('click', '.btn-delete-priority', function(e) {
        var id = $(this).data('id');
        var this_context = $(this);
        swal({
            title: "Are you sure?",
            text: "This priority will be deleted!",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Yes, delete it!",
            closeOnConfirm: false
        }, function() {
            window.location.href = CLOUDMLMSOFTWARE.siteUrl + '/admin/helpdesk/tickets/priorities/delete/' + id;
        });
    });
    $('.content').on('click', '.btn-delete-ticket-type', function(e) {
        var id = $(this).data('id');
        var this_context = $(this);
        swal({
            title: "Are you sure?",
            text: "This ticket type will be deleted!",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Yes, delete it!",
            closeOnConfirm: false
        }, function() {
            window.location.href = CLOUDMLMSOFTWARE.siteUrl + '/admin/helpdesk/tickets/ticket-types/delete/' + id;
        });
    });
    $('.content').on('click', '.btn-delete-ticket', function(e) {
        var id = $(this).data('id');
        var this_context = $(this);
        swal({
            title: "Are you sure?",
            text: "This ticket will be deleted!",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Yes, delete it!",
            closeOnConfirm: false
        }, function() {
            window.location.href = CLOUDMLMSOFTWARE.siteUrl + '/admin/helpdesk/ticket/delete/' + id;
        });
    });
      $('.content').on('click', '.btn-delete-ticket-user', function(e) {
        var id = $(this).data('id');
        var this_context = $(this);
        swal({
            title: "Are you sure?",
            text: "This ticket will be deleted!",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Yes, delete it!",
            closeOnConfirm: false
        }, function() {
            window.location.href = CLOUDMLMSOFTWARE.siteUrl + '/user/helpdesk/ticket/delete/' + id;
        });
    });

});

$(function() {
    if ($('#ticket-priorities .priority').length) {
        $.fn.editable.defaults.mode = 'popup';
        $.fn.editable.defaults.params = function(params) {
            params._token = $("meta[name=csrf-token]").attr("content");
            return params;
        };
        $('.priority').editable({
            validate: function(value) {},
            type: 'text',
            url: CLOUDMLMSOFTWARE.siteUrl + '/admin/save_ticket_priority',
            placement: 'top',
            send: 'always',
            disabled: false,
            ajaxOptions: {
                dataType: 'json'
            },
            success: function(response, newValue) {
                $(this).html(newValue);
            }
        });
    }
});
$(function() {
    if ($('#ticket-statuses .status').length) {
        $.fn.editable.defaults.mode = 'popup';
        $.fn.editable.defaults.params = function(params) {
            params._token = $("meta[name=csrf-token]").attr("content");
            return params;
        };
        $('.status').editable({
            validate: function(value) {},
            type: 'text',
            url: CLOUDMLMSOFTWARE.siteUrl + '/admin/save_ticket_status',
            placement: 'top',
            send: 'always',
            disabled: false,
            ajaxOptions: {
                dataType: 'json'
            },
            success: function(response, newValue) {
                $(this).html(newValue);
            }
        });
    }
});
$(function() {
    if ($('#ticket-tags .tag').length) {
        $.fn.editable.defaults.mode = 'popup';
        $.fn.editable.defaults.params = function(params) {
            params._token = $("meta[name=csrf-token]").attr("content");
            return params;
        };
        $('.tag').editable({
            validate: function(value) {},
            type: 'text',
            url: 'http://preset.cloudmlmsoftware.com/admin/save_ticket_tags',
            placement: 'top',
            send: 'always',
            disabled: false,
            ajaxOptions: {
                dataType: 'json'
            },
            success: function(response, newValue) {
                $(this).html(newValue);
            }
        });
    }
});
$(function() {
    if ($('#ticket-departments-table').length) {
        $.fn.editable.defaults.mode = 'popup';
        $.fn.editable.defaults.params = function(params) {
            params._token = $("meta[name=csrf-token]").attr("content");
            return params;
        };
        // $('#ticket-departments-table').on('click', '.btn-enable-table-edit', function(e) {
        //   e.stopPropagation();
        //   console.log( $(this).parent('tr').find('.table-element-editable'));
        //   $(this).parents('tr').find('.table-element-editable').editable('toggle');
        // alert('aaaaa');
        // $('.table-element-editable').editable({
        //             validate: function(value) {
        //         },        
        //         type: 'text',               
        //         placement: 'top', 
        //         send:'always',
        //         disabled:false,
        //         ajaxOptions: {
        //         dataType: 'json'
        //         },
        //         success: function(response, newValue) {
        //             $(this).html(newValue);
        //             }        
        //      });
        //          $('.department').editable({
        //             validate: function(value) {
        //         },        
        //         type: 'text',        
        //         placement: 'top', 
        //         send:'always',
        //         disabled:false,
        //         ajaxOptions: {
        //             dataType: 'json',
        //         },
        //         success: function(response, newValue) {
        //             $(this).html(newValue);
        //             }        
        //      });
        // });
    }
});
//  $(function(){
// if ($('#kb-category-table').length) {
//         $.fn.editable.defaults.mode = 'popup';
//         $.fn.editable.defaults.params = function (params) {
//             params._token = $("meta[name=csrf-token]").attr("content");
//             return params;
//         };
//   $('#kb-category-table').on('click', '.btn-enable-table-edit', function(e) {
//     e.stopPropagation();
//     console.log( $(this).closest('tr').find('.table-element-editable'));
//     $(this).closest('tr').find('.table-element-editable').editable({
//             validate: function(value) {
//         },        
//         type: 'text',        
//         placement: 'right', 
//         send:'always',
//         disabled:false,
//         ajaxOptions: {
//             dataType: 'json',
//         },
//         success: function(response, newValue) {
//             $(this).html(newValue);
//             }        
//      });
// });
//     }
//      });
if ($("#ticket-departments-table").length) {
    $('#ticket-departments-table').on('click', '.btn-delete-department', function(e) {
        var id = $(this).data('id');
        var this_context = $(this);
        swal({
            title: "Are you sure?",
            text: "All related tickets will be unlinked from this department",
            type: "warning",
            animation: false,
            customClass: 'animated bounceOutLeft',
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Yes, delete it!",
            closeOnConfirm: false
        }, function() {
            window.location.href = CLOUDMLMSOFTWARE.siteUrl + '/admin/helpdesk/tickets/departments/destroy/' + id;
        });
    });
}
if ($(".changestatuswrapper").length) {
    $('.changestatuswrapper').on('click', '.changestatusdropdownitem', function(e) {
        var status = $(this).data('status');
        var id = $(this).data('ticketid');
        var statusid = $(this).data('statusid');
        var this_context = $(this).closest('.statusdropbtn');
        buttonClasses = [];
        buttonClasses = {
            'Open': 'btn-danger',
            'Resolved': 'btn-success',
            'Closed': 'btn-grey',
            'Archived': 'btn-grey',
            'Deleted': 'btn-grey',
            'Unverified Status': 'btn-danger',
            'Request approval': 'btn-danger'
        };
        swal({
            title: "",
            text: "Change status?",
            type: "warning",
            animation: false,
            customClass: 'animated bounceOutLeft',
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Yes, change status to " + status,
            closeOnConfirm: true
        }, function() {
            $.get(CLOUDMLMSOFTWARE.siteUrl + '/admin/helpdesk/tickets/ticket/change-status/', {
                ticketid: id,
                statusid: statusid
            }, function(response) {
                this_context.parent().find('.statusname').text(status);
                this_context.parent().find('.statusname').removeClass('');
                this_context.parent().find('.statusname').attr('class', 'statusname btn-xs btn ' + buttonClasses[status]);
                this_context.parent().find('.statusdrop').removeClass('');
                this_context.parent().find('.statusdrop').attr('class', 'statusdrop btn-xs btn dropdown-toggle ' + buttonClasses[status]);
                // console.log(buttonClasses[status]);
            });
        });
    });
}
// if ($("#changestatus").length) {
//   $('#changestatus').on('click', '.changestatusdropdownitem', function(e) {
//       var status = $(this).data('status');
//       var id = $(this).data('ticketid');
//       var statusid = $(this).data('statusid');
//        swal({
//         title: "",
//         text: "Change status?",
//         type: "warning",
//         animation: false,
//         customClass: 'animated bounceOutLeft',
//         showCancelButton: true,
//         confirmButtonClass: "btn-danger",
//         confirmButtonText: "Yes, change status to "+status,
//         closeOnConfirm: true
//       }, function() {
//         $.get(
//         CLOUDMLMSOFTWARE.siteUrl+'/admin/helpdesk/tickets/ticket/change-status/',
//         { ticketid: id, statusid:statusid },
//         function(response) {
//                     location.reload();
//         });
//       });
//   });
// }
if ($("#ticket-table").length) {
    $('#ticket-table').on('click', '.changeprioritydropdownitem', function(e) {
        var priority = $(this).data('priority');
        var id = $(this).data('ticketid');
        var priorityid = $(this).data('priorityid');
        var prioritycolor = $(this).data('prioritycolor');
        var this_context = $(this).closest('.prioritydropbtn');
        swal({
            title: "",
            text: "Change priority?",
            type: "warning",
            animation: false,
            customClass: 'animated bounceOutLeft',
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Yes, change status to " + priority,
            closeOnConfirm: true
        }, function() {
            $.get(CLOUDMLMSOFTWARE.siteUrl + '/admin/helpdesk/tickets/ticket/change-priority/', {
                ticketid: id,
                priorityid: priorityid
            }, function(response) {
                this_context.parent().find('.priorityname').text(priority);
                this_context.parent().find('.priorityname').attr('style', 'color:white;background-color:' + prioritycolor + '');
                this_context.parent().find('.prioritydrop').attr('style', 'color:white;background-color:' + prioritycolor + '');
            });
        });
    });
}
if ($('.summernote').length) {
    $('.summernote').summernote({
        callbacks: {
            onImageUpload: function(image) {
                that = $(this);
                uploadImage(image[0], that);
            }
        }
    });
}

function uploadImage(image, that) {
    var data = new FormData();
    data.append("file", image);
    $.ajax({
        url: CLOUDMLMSOFTWARE.siteUrl + '/imageupload',
        data: data,
        dataType: 'json',
        async: true,
        type: 'post',
        processData: false,
        contentType: false,
        beforeSend: function() {
            // $('#profilephotopreview').after('<div class="ajxloaderinner"><img class="ajxloader" src={{url("assets/globals/images/ajxloader.gif")}}></div>');
        },
        success: function(response) {
            var image = $('<img>').attr('src', CLOUDMLMSOFTWARE.siteUrl + '/img/cache/original/' + response.filename);
            var ImageUrl = CLOUDMLMSOFTWARE.siteUrl + '/img/cache/original/' + response.filename;
            // console.log(image);
            $(that).summernote('insertImage', ImageUrl)
            setTimeout(function() {}, 2000);
        },
    });
    return false;
    var data = new FormData();
    data.append("image", image);
    $.ajax({
        url: 'Your url to deal with your image',
        cache: false,
        contentType: false,
        processData: false,
        data: data,
        type: "post",
        success: function(url) {
            var image = $('<img>').attr('src', 'http://' + url);
            $('#summernote').summernote("insertNode", image[0]);
        },
        error: function(data) {
            // console.log(data);
        }
    });
}
if ($(".colorpicker-priority").length) {
    $(".colorpicker-priority").spectrum({
        preferredFormat: "hex",
        showInput: true,
        showPalette: true,
        palette: [
            ["red", "rgba(0, 255, 0, .5)", "rgb(0, 0, 255)"]
        ]
    });
}
if ($('#cannedchooser').length) {
    $('#cannedchooser').on("select2:selecting", function(e) {
        var id = $(e.currentTarget).find("option:selected").val();
        $.ajax({
            url: CLOUDMLMSOFTWARE.siteUrl + '/admin/helpdesk/tickets/canned-responses/get-canned-response',
            data: {
                id: id
            },
            dataType: 'json',
            type: 'post',
            processData: true,
            beforeSend: function() {},
            success: function(response) {
                $('#ticket_title').val(response.subject);
                $('#ticket_body').summernote('code', response.message);
            },
            error: function(response) {
                // console.log(response);
            }
        });
    });
}
if ($('#resetFilter').length) {
    $('#resetFilter').on("click", function() {
        $('.filter, #assigned-to-filter, #departments-filter, #sla-filter, #priority-filter, #source-filter').val(null).trigger("change");
        clearlist += 1;
        clearfilterlist();
    });
}
if ($('#selector').length) {}
/*Dashboard */
// if ($('#pie_gender_legend').length) {
//     $.getJSON(CLOUDMLMSOFTWARE.siteUrl+'/admin/gender.json', function(data) {
//         animatedPieWithLegend("#pie_gender_legend", 120 ,data);
//     });
// }        
//  function animatedPieWithLegend(element, size,data) {
//         // Add data set
//         // var data = pie_gender_legend_data;
//         // Main variables
//         var d3Container = d3.select(element),
//             distance = 2, // reserve 2px space for mouseover arc moving
//             radius = (size/2) - distance,
//             sum = d3.sum(data, function(d) { return d.value; });
//         // Create chart
//         // ------------------------------
//         // Add svg element
//         var container = d3Container.append("svg");
//         // Add SVG group
//         var svg = container
//             .attr("width", size)
//             .attr("height", size)
//             .append("g")
//                 .attr("transform", "translate(" + (size / 2) + "," + (size / 2) + ")");  
//         // Construct chart layout
//         // ------------------------------
//         // Pie
//         var pie = d3.layout.pie()
//             .sort(null)
//             .startAngle(Math.PI)
//             .endAngle(3 * Math.PI)
//             .value(function (d) { 
//                 return d.value;
//             }); 
//         // Arc
//         var arc = d3.svg.arc()
//             .outerRadius(radius);
//         //
//         // Append chart elements
//         //
//         // Group chart elements
//         var arcGroup = svg.selectAll(".d3-arc")
//             .data(pie(data))
//             .enter()
//             .append("g") 
//                 .attr("class", "d3-arc")
//                 .style({
//                     'stroke': '#fff',
//                     'stroke-width': 2,
//                     'cursor': 'pointer'
//                 });
//         // Append path
//         var arcPath = arcGroup
//             .append("path")
//             .style("fill", function (d) {
//                 return d.data.color;
//             });
//         // Add interactions
//         arcPath
//             .on('mouseover', function (d, i) {
//                 // Transition on mouseover
//                 d3.select(this)
//                 .transition()
//                     .duration(500)
//                     .ease('elastic')
//                     .attr('transform', function (d) {
//                         d.midAngle = ((d.endAngle - d.startAngle) / 2) + d.startAngle;
//                         var x = Math.sin(d.midAngle) * distance;
//                         var y = -Math.cos(d.midAngle) * distance;
//                         return 'translate(' + x + ',' + y + ')';
//                     });
//                 // Animate legend
//                 $(element + ' [data-slice]').css({
//                     'opacity': 0.3,
//                     'transition': 'all ease-in-out 0.15s'
//                 });
//                 $(element + ' [data-slice=' + i + ']').css({'opacity': 1});
//             })
//             .on('mouseout', function (d, i) {
//                 // Mouseout transition
//                 d3.select(this)
//                 .transition()
//                     .duration(500)
//                     .ease('bounce')
//                     .attr('transform', 'translate(0,0)');
//                 // Revert legend animation
//                 $(element + ' [data-slice]').css('opacity', 1);
//             });
//         // Animate chart on load
//         arcPath
//             .transition()
//                 .delay(function(d, i) { return i * 500; })
//                 .duration(500)
//                 .attrTween("d", function(d) {
//                     var interpolate = d3.interpolate(d.startAngle,d.endAngle);
//                     return function(t) {
//                         d.endAngle = interpolate(t);
//                         return arc(d);  
//                     }; 
//                 });
//         //
//         // Append counter
//         //
//         // Append element
//         d3Container
//             .append('h2')
//             .attr('class', 'mt-15 mb-5 text-semibold');
//         // Animate counter
//         d3Container.select('h2')
//             .transition()
//             .duration(1500)
//             .tween("text", function(d) {
//                 var i = d3.interpolate(this.textContent, sum);
//                 return function(t) {
//                     this.textContent = d3.format(",d")(Math.round(i(t)));
//                 };
//             });
//         //
//         // Append legend
//         //
//         // Add element
//         var legend = d3.select(element)
//             .append('ul')
//             .attr('class', 'chart-widget-legend')
//             .selectAll('li').data(pie(data))
//             .enter().append('li')
//             .attr('data-slice', function(d, i) {
//                 return i;
//             })
//             .attr('style', function(d, i) {
//                 return 'border-bottom: 2px solid ' + d.data.color;
//             })
//             .text(function(d, i) {
//                 return d.data.gender + ': ';
//             });
//         // Add value
//         legend.append('span')
//             .text(function(d, i) {
//                 return d.data.value;
//             });
//     }
if ($('#users_join').length) {
    $.getJSON(CLOUDMLMSOFTWARE.siteUrl + '/admin/usersjoining.json', function(data) {
        users_join(data);
    });
}

function users_join(data) {
    var dom = document.getElementById("users_join");
    var usersJoinChart = echarts.init(dom);
    var app = {};
    option = null;
    var dates = [],
        values = [];
    for (var property in data) {
        if (!data.hasOwnProperty(property)) {
            continue;
        }
        dates.push(data[property].date);
        values.push(data[property].value);
    }
    option = {
        tooltip: {
            trigger: 'axis',
            axisPointer: {
                type: 'line',
                lineStyle: {
                    color: 'rgba(214, 242, 255, 0.61)',
                    type: 'solid',
                    width: 1,
                    shadowColor: '#cccccc',
                    shadowBlur: 5,
                    shadowOffsetX: 3,
                    shadowOffsetY: 3,
                },
            },
            formatter: function(params) {
                return params[0].name + ': ' + params[0].value;
            }
        },
        legend: {
            data: ['Line', 'Bar', 'Dotted', 'Bubble'],
            animation: true,
            textStyle: {
                color: '#ccc'
            },
            selectedMode: 'single',
            top: 10,
            itemGap: 5,
            backgroundColor: 'rgb(243,243,243)',
            borderRadius: 5
        },
        xAxis: {
            type: 'category',
            boundaryGap: false,
            axisTick: {
                show: false
            },
            axisLine: {
                show: false
            },
            axisLabel: {
                textStyle: {
                    color: '#333',
                    fontStyle: 'normal',
                    fontSize: '9'
                }
            },
            data: dates
        },
        yAxis: {
            type: 'value',
            boundaryGap: false,
            axisTick: {
                show: true,
                inside: true,
                lineStyle: {
                    color: '#ddd'
                }
            },
            axisLine: {
                show: false
            },
            axisLabel: {
                textStyle: {
                    color: '#333',
                    fontStyle: 'normal',
                    fontSize: '9'
                }
            },
            splitLine: {
                lineStyle: {
                    color: '#f1f1f1',
                    type: 'solid',
                    width: 1,
                    shadowColor: 'rgba(0,0,0,0)',
                    shadowBlur: 5,
                    shadowOffsetX: 3,
                    shadowOffsetY: 3,
                },
            },
        },
        dataZoom: [{
            type: 'inside',
            start: 0,
            end: 60
        }, {
            height: 10,
            backgroundColor: '#ffffff',
            dataBackgroundColor: '#ddd',
            handleColor: '#dddddd',
            fillerColor: '#f5f5f5',
            handleSize: 20,
            start: 0,
            end: 10,
        }],
        series: [{
            name: 'Line',
            type: 'line',
            smooth: true,
            // symbol: 'circle',
            // effect :{
            //     color :'#000'
            // },
            sampling: 'average',
            color: ['#58b358'],
            itemStyle: {
                normal: {
                    color: 'rgba(4, 177, 255, 0.9411764705882353)'
                }
            },
            lineStyle: {
                normal: {
                    color: '#3e84f7',
                    width: 3,
                    type: 'solid'
                },
                xAxisIndex: 1,
                yAxisIndex: 1,
            },
            areaStyle: {
                normal: {
                    color: new echarts.graphic.LinearGradient(0, 0, 0, 1, [{
                        offset: 0,
                        color: 'rgba(59, 132, 251, 0.22)'
                    }, {
                        offset: 1,
                        color: 'rgba(59, 132, 251, 0.5803921568627451)'
                    }])
                }
            },
            cursor: 'move',
            step: false,
            data: values
        }, {
            name: 'Bar',
            type: 'bar',
            barWidth: 10,
            itemStyle: {
                normal: {
                    barBorderRadius: 5,
                    color: new echarts.graphic.LinearGradient(0, 0, 0, 1, [{
                        offset: 0,
                        color: '#14c8d4'
                    }, {
                        offset: 1,
                        color: '#43eec6'
                    }])
                }
            },
            barWidth: 2,
            data: values
        }, {
            name: 'Dotted',
            type: 'pictorialBar',
            symbol: 'rect',
            itemStyle: {
                normal: {
                    color: 'rgba(102, 187, 106, 0.72)',
                    opacity: 0.8
                }
            },
            symbolRepeat: true,
            symbolSize: [2, 1],
            symbolMargin: 1,
            z: -10,
            data: values
        }, {
            name: 'Bubble',
            type: 'scatter',
            symbolSize: function(values) {
                return Math.sqrt(values * 50);
            },
            label: {
                emphasis: {
                    show: true,
                    formatter: function(param) {
                        return param.data[3];
                    },
                    position: 'top'
                }
            },
            itemStyle: {
                normal: {
                    shadowBlur: 10,
                    shadowColor: 'rgba(120, 36, 50, 0.5)',
                    shadowOffsetY: 5,
                    // color: new echarts.graphic.LinearGradient(0, 0, 0, 1, [{
                    //     offset: 0,
                    //     color: 'rgba(59, 132, 251, 0.7)'
                    // }, {
                    //     offset: 1,
                    //     color: 'rgba(59, 132, 251, 0.9)'
                    // }])
                    color: new echarts.graphic.RadialGradient(0.4, 0.3, 1, [{
                        offset: 0,
                        color: 'rgb(59, 132, 251)'
                    }, {
                        offset: 1,
                        color: 'rgb(59, 132, 251)'
                    }])
                }
            },
            data: values
        }],
    };
    if (!app.inNode) {
        window.addEventListener('resize', updatePosition);
    }
    $(window).resize(function() {
        usersJoinChart.resize();
    });
    usersJoinChart.on('dataZoom', updatePosition);

    function updatePosition() {
        usersJoinChart.resize();
    }
    if (option && typeof option === "object") {
        usersJoinChart.setOption(option, true);
    }
}
if ($('#users_join_user').length) {
    console.log("hi");
    $.getJSON(CLOUDMLMSOFTWARE.siteUrl + '/user/usersjoining.json', function(data) {
        console.log(data);
        users_join_user(data);
    });
}

function users_join_user(data) {
    var dom = document.getElementById("users_join_user");
    console.log(dom);
    var usersJoinChart = echarts.init(dom);
    var app = {};
    option = null;
    var dates = [],
        values = [];
    for (var property in data) {
        if (!data.hasOwnProperty(property)) {
            continue;
        }
        dates.push(data[property].date);
        values.push(data[property].value);
    }
    option = {
        tooltip: {
            trigger: 'axis',
            axisPointer: {
                type: 'line',
                lineStyle: {
                    color: 'rgba(214, 242, 255, 0.61)',
                    type: 'solid',
                    width: 1,
                    shadowColor: '#cccccc',
                    shadowBlur: 5,
                    shadowOffsetX: 3,
                    shadowOffsetY: 3,
                },
            },
            formatter: function(params) {
                return params[0].name + ': ' + params[0].value;
            }
        },
        legend: {
            data: ['Line', 'Bar', 'Dotted', 'Bubble'],
            animation: true,
            textStyle: {
                color: '#ccc'
            },
            selectedMode: 'single',
            top: 10,
            itemGap: 5,
            backgroundColor: 'rgb(243,243,243)',
            borderRadius: 5
        },
        xAxis: {
            type: 'category',
            boundaryGap: false,
            axisTick: {
                show: false
            },
            axisLine: {
                show: false
            },
            axisLabel: {
                textStyle: {
                    color: '#333',
                    fontStyle: 'normal',
                    fontSize: '9'
                }
            },
            data: dates
        },
        yAxis: {
            type: 'value',
            boundaryGap: false,
            axisTick: {
                show: true,
                inside: true,
                lineStyle: {
                    color: '#ddd'
                }
            },
            axisLine: {
                show: false
            },
            axisLabel: {
                textStyle: {
                    color: '#333',
                    fontStyle: 'normal',
                    fontSize: '9'
                }
            },
            splitLine: {
                lineStyle: {
                    color: '#f1f1f1',
                    type: 'solid',
                    width: 1,
                    shadowColor: 'rgba(0,0,0,0)',
                    shadowBlur: 5,
                    shadowOffsetX: 3,
                    shadowOffsetY: 3,
                },
            },
        },
        dataZoom: [{
            type: 'inside',
            start: 0,
            end: 60
        }, {
            height: 10,
            backgroundColor: '#ffffff',
            dataBackgroundColor: '#ddd',
            handleColor: '#dddddd',
            fillerColor: '#f5f5f5',
            handleSize: 20,
            start: 0,
            end: 10,
        }],
        series: [{
            name: 'Line',
            type: 'line',
            smooth: true,
            // symbol: 'circle',
            // effect :{
            //     color :'#000'
            // },
            sampling: 'average',
            color: ['#58b358'],
            itemStyle: {
                normal: {
                    color: 'rgba(4, 177, 255, 0.9411764705882353)'
                }
            },
            lineStyle: {
                normal: {
                    color: '#3e84f7',
                    width: 3,
                    type: 'solid'
                },
                xAxisIndex: 1,
                yAxisIndex: 1,
            },
            areaStyle: {
                normal: {
                    color: new echarts.graphic.LinearGradient(0, 0, 0, 1, [{
                        offset: 0,
                        color: 'rgba(59, 132, 251, 0.22)'
                    }, {
                        offset: 1,
                        color: 'rgba(59, 132, 251, 0.5803921568627451)'
                    }])
                }
            },
            cursor: 'move',
            step: false,
            data: values
        }, {
            name: 'Bar',
            type: 'bar',
            barWidth: 10,
            itemStyle: {
                normal: {
                    barBorderRadius: 5,
                    color: new echarts.graphic.LinearGradient(0, 0, 0, 1, [{
                        offset: 0,
                        color: '#14c8d4'
                    }, {
                        offset: 1,
                        color: '#43eec6'
                    }])
                }
            },
            barWidth: 2,
            data: values
        }, {
            name: 'Dotted',
            type: 'pictorialBar',
            symbol: 'rect',
            itemStyle: {
                normal: {
                    color: 'rgba(102, 187, 106, 0.72)',
                    opacity: 0.8
                }
            },
            symbolRepeat: true,
            symbolSize: [2, 1],
            symbolMargin: 1,
            z: -10,
            data: values
        }, {
            name: 'Bubble',
            type: 'scatter',
            symbolSize: function(values) {
                return Math.sqrt(values * 50);
            },
            label: {
                emphasis: {
                    show: true,
                    formatter: function(param) {
                        return param.data[3];
                    },
                    position: 'top'
                }
            },
            itemStyle: {
                normal: {
                    shadowBlur: 10,
                    shadowColor: 'rgba(120, 36, 50, 0.5)',
                    shadowOffsetY: 5,
                    // color: new echarts.graphic.LinearGradient(0, 0, 0, 1, [{
                    //     offset: 0,
                    //     color: 'rgba(59, 132, 251, 0.7)'
                    // }, {
                    //     offset: 1,
                    //     color: 'rgba(59, 132, 251, 0.9)'
                    // }])
                    color: new echarts.graphic.RadialGradient(0.4, 0.3, 1, [{
                        offset: 0,
                        color: 'rgb(59, 132, 251)'
                    }, {
                        offset: 1,
                        color: 'rgb(59, 132, 251)'
                    }])
                }
            },
            data: values
        }],
    };
    if (!app.inNode) {
        window.addEventListener('resize', updatePosition);
    }
    $(window).resize(function() {
        usersJoinChart.resize();
    });
    usersJoinChart.on('dataZoom', updatePosition);

    function updatePosition() {
        usersJoinChart.resize();
    }
    if (option && typeof option === "object") {
        usersJoinChart.setOption(option, true);
    }
}

// end

if ($('#pie_gender_legend').length) {
    pie_gender(pie_gender_legend_data);
}

function pie_gender(data) {
    var dom = document.getElementById("pie_gender_legend");
    var genderPieChart = echarts.init(dom);
    var app = {};
    option = null;;
    option = {
        // title: {
        //     text: 'Gender statistics',
        //     left: 'center',
        //     top: 20,
        //     textStyle: {
        //         color: '#000'
        //     }
        // },

        color: ["rgba(92, 107, 192, 0.71)", "rgba(239, 83, 80, 0.76)" ],
        tooltip: {
            trigger: 'item',
            formatter: "{b} : {c} ({d}%)"
        },
        visualMap: {
            show: false,
            min: 80,
            max: 600,
            inRange: {
                colorLightness: [0, 1]
            }
        },
        legend: {
            x: 'center',
            y: 'bottom',
            data: data.sort(function(a, b) {
                return a.value - b.value;
            })
        },
        series: [{
            selectedMode: 'single',
            name: 'Gender statistics',
            type: 'pie',
            radius: '55%',
            center: ['50%', '50%'],
            data: data.sort(function(a, b) {
                return a.value - b.value;
            }),
            roseType: 'radius',
            smooth: true,
            itemStyle: {
                normal: {
                    borderColor: '#fff',
                    borderWidth: '3',
                    shadowColor: 'rgba(0,0,0,0.2)',
                    shadowBlur: 15,
                    shadowOffsetY: 5
                }
            },
            animationType: 'scale',
            animationEasing: 'elasticOut',
            animationDelay: function(idx) {
                return Math.random() * 200;
            }
        }]
    };
    if (option && typeof option === "object") {
        genderPieChart.setOption(option, true);
    }
    if (!app.inNode) {
        window.addEventListener('resize', updatePosition);
    }
    $(window).resize(function() {
        genderPieChart.resize();
    });
    genderPieChart.on('dataZoom', updatePosition);

    function updatePosition() {
        genderPieChart.resize();
    }
}






if ($('#monthly-join').length) {
    $.getJSON(CLOUDMLMSOFTWARE.siteUrl + '/admin/monthly-join.json', function(data) {
        monthly_join(data);
    });
}

function monthly_join(data) {
    var dom = document.getElementById("monthly-join");
    var monthlyJoinChart = echarts.init(dom);
    var app = {};
    option = null;
    var dates = [],
        values = [];
    for (var property in data) {
        if (!data.hasOwnProperty(property)) {
            continue;
        }
        dates.push(data[property].date);
        values.push(data[property].value);
    }
    option = {
        tooltip: {
            trigger: 'axis',
            formatter: "{b} : {c}"
        },
        xAxis: {
            type: 'category',
            show: false,
            data: dates
        },
        yAxis: {
            type: 'value',
            show: false,
            data: values
        },
        color: ['#58b358'],
        series: [{
            name: 'Monthly Join',
            type: 'line',
            symbol: 'none',
            smooth: true,
            lineStyle: {
                normal: {
                    width: 2,
                }
            },
            data: values
        }]
    };;
    if (option && typeof option === "object") {
        monthlyJoinChart.setOption(option, true);
    }
}
if ($('#monthly-join-user').length) {
    $.getJSON(CLOUDMLMSOFTWARE.siteUrl + '/user/monthly-join.json', function(data) {
        monthly_join_user(data);
    });
}

function monthly_join_user(data) {
    var dom = document.getElementById("monthly-join");
    var monthlyJoinChart = echarts.init(dom);
    var app = {};
    option = null;
    var dates = [],
        values = [];
    for (var property in data) {
        if (!data.hasOwnProperty(property)) {
            continue;
        }
        dates.push(data[property].date);
        values.push(data[property].value);
    }
    option = {
        tooltip: {
            trigger: 'axis',
            formatter: "{b} : {c}"
        },
        xAxis: {
            type: 'category',
            show: false,
            data: dates
        },
        yAxis: {
            type: 'value',
            show: false,
            data: values
        },
        color: ['#58b358'],
        series: [{
            name: 'Monthly Join',
            type: 'line',
            symbol: 'none',
            smooth: true,
            lineStyle: {
                normal: {
                    width: 2,
                }
            },
            data: values
        }]
    };;
    if (option && typeof option === "object") {
        monthlyJoinChart.setOption(option, true);
    }
}




// if ($('#weekly-join').length) {
//     $.getJSON(CLOUDMLMSOFTWARE.siteUrl+'/admin/yearly-join.json', function(data) {
//         var dom = document.getElementById("weekly-join");
//         sparkline(dom, data, "line", 30, 50, "basis", 750, 2000, "#26A69A");
//     });
// }     
// if ($('#monthly-join').length) {
//     $.getJSON(CLOUDMLMSOFTWARE.siteUrl+'/admin/monthly-join.json', function(data) {
//         sparkline("#monthly-join",data, "line", 30, 50, "basis", 750, 2000, "#FF7043");
//     });
// }     
// if ($('#yearly-join').length) {
//     $.getJSON(CLOUDMLMSOFTWARE.siteUrl+'/admin/yearly-join.json', function(data) {
//         sparkline("#yearly-join", data,"line", 30, 50, "basis", 750, 2000, "#5C6BC0");
//     });
// }     
// function sparkline(dom,data){
//     var myChart = echarts.init(dom);
//     var app = {};
//     option = null;
//      var dates = [],
//             values = [];
//         for (var property in data) {
//            if ( ! data.hasOwnProperty(property)) {
//               continue;
//            }
//            dates.push(data[property].date);
//            values.push(data[property].value);
//         }
//     option = {
//         tooltip: {
//             trigger: 'axis',
//             formatter: "{b} : {c}"
//         },
//         xAxis: {
//             type: 'category',
//             show:false,
//             data: dates
//         },
//         yAxis: {
//              type: 'value',
//             show:false,
//             data: values
//         },
//         color:['#58b358'],
//         series: [
//             {
//                 name: 'Monthly Join',
//                 type: 'line',
//                 symbol :'none',
//                 smooth: true,
//                 lineStyle: {
//                     normal: {
//                         width: 2,                   
//                     }
//                 },
//                 data:values
//             }
//         ]
//     };;
//     if (option && typeof option === "object") {
//         myChart.setOption(option, true);
//     }
// }
Array.prototype.unique = function() {
    return this.reduce(function(previous, current, index, array) {
        previous[current.toString() + typeof(current)] = current;
        return array.length - 1 == index ? Object.keys(previous).reduce(function(prev, cur) {
            prev.push(previous[cur]);
            return prev;
        }, []) : previous;
    }, {});
};
if ($('#package_purchase_graph').length) {
    $.getJSON(CLOUDMLMSOFTWARE.siteUrl + '/admin/package-sales.json', function(data) {
        // var groupBy = function(xs, key) {
        //   return xs.reduce(function(rv, x) {
        //     (rv[x[key]] = rv[x[key]] || []).push(x);
        //     return rv;
        //   }, {});
        // };
        // var groubedByTeam=groupBy(data, 'package')
        // console.log(groubedByTeam);
        var dom = document.getElementById("package_purchase_graph");
        package_purchase_graph(data, dom);
    });
}

function package_purchase_graph(data, dom) {
    var PackageSalesChart = echarts.init(dom);
    var app = {};
    option = null;
    var graphDataDates = [];
    var graphDataValues = [];
    // data.forEach(function(entry) {
    //   entry.purchase_history_r.forEach(function(entryin){
    //    graphDataDates.push(entryin.date);        
    //   })
    // });    
    // console.log(graphDataDates);
    // var date_array = [];
    // var value_array = [];
    var data_array = [];
    // data_array['package'] = [];
    // data_array['dates'] = [];
    // data_array['values'] = [];
    // console.log(data);
    for (var i = 0; i < data.length; i++) {
        //check if the index exists in the outer array (row)
        if (!(i in data_array)) {
            //if it doesn't exist, we need another array to fill
            data_array[i] = [];
            data_array[i]['dates'] = [];
            data_array[i]['values'] = [];
        }
        row = data_array[i];
        // console.log(data[i].purchase_history_r);
        for (var j = 0; j < data[i].purchase_history_r.length; j++) {
            //check if the index exists in the inner array (column)
            if (!(i in row)) {
                //if it doesn't exist, we need to fill it with `0`
                row[j] = 0;
            }
            data_array[i]['package'] = data[i].package;
            data_array[i]['dates'].push(data[i].purchase_history_r[j].date);
            data_array[i]['values'].push(data[i].purchase_history_r[j].value);
            // graphDataDates[i].push(data[i].purchase_history_r[j].date); 
            // console.log(sub_array);
            // data[i].purchase_history_r.forEach(function(entry) {
            // console.log(entry);
            // graphDataDates.push(entry[x].date);
            // entry.purchase_history_r.forEach(function(entryin){
            //  graphDataDates.push(entryin.date);        
            // })
            // }); 
            // data[i].purchase_history_r.forEach(function(entryin){
            // console.log(entryin.date);
            // console.log(i+'xx  '+entryin.date);
            // var graphDataDates[i] = [];
            // graphDataDates.push(entryin.date);        
            // })
        }
        // graphDataDates.push(data_array.concat());
        // graphDataValues.push(data_array);
        // entry.purchase_history_r.forEach(function(entryin){
        //  graphDataDates.push(entryin.date);        
        // })
    };
    // console.log(data_array);
    // console.log(graphDataValues);
    var series = [];
    echarts.util.each(data_array, function(datain) {
        // console.log(datain.package);
        series.push({
            name: datain.package,
            type: 'line',
            smooth:true,
            smoothness : 0.2,
            data: datain.values,
        });
    });
    var dates = [];
    echarts.util.each(data_array, function(datain) {
        // console.log(datain.dates);
        dates.push(datain.dates);
    });
    graphDataDates = [].concat.apply([], dates).unique();
    // console.log(graphDataDates);
    // console.log(series);
    // for (var i = 0; i < data.length; i++) {
    //    linearray : {
    //        name:'Elite',
    //        type:'line',
    //        smooth:true,
    //        sampling: 'average',
    //        color:['#58b358'],
    //        itemStyle: {
    //            normal: {
    //                color: 'rgba(4, 177, 255, 0.9411764705882353)'
    //            }
    //        }, 
    //        lineStyle: {
    //        normal: {
    //            color: 'rgb(76, 175, 80)',
    //            width: 2,
    //        },
    //        xAxisIndex: 1,
    //        yAxisIndex: 1,
    //    },
    //        data: graphDataValues
    //    }
    // }
    // var graphDataSets = [];
    //  data.forEach(function(entry) {
    //    entry.purchase_history_r.forEach(function(entryin){
    //     graphDataSets.push(entryin.date);        
    //    })
    // });
    // vip.forEach(function(entry) {
    //   vip_dates.push(entry.date);
    //    vip_values.push(entry.value);
    // });
    // // console.log(elite_values);
    // for (var property in premium) {
    //    if ( ! data.hasOwnProperty(property)) {
    //       continue;
    //    }
    //    premium_dates.push(data[property].date);
    //    premium_values.push(data[property].value);
    // }
    // for (var property in vip) {
    //    if ( ! data.hasOwnProperty(property)) {
    //       continue;
    //    }
    //    vip_dates.push(data[property].date);
    //    vip_values.push(data[property].value);
    // }
    // console.log(elite_dates);
    option = {
        tooltip: {
            trigger: 'axis',
            axisPointer: {
                type: 'line',
                lineStyle: {
                    color: 'rgba(214, 242, 255, 0.61)',
                    type: 'dotted',
                    width: 1,
                    shadowColor: '#cccccc',
                    shadowBlur: 5,
                    shadowOffsetX: 3,
                    shadowOffsetY: 3,
                },
            },
        },
        xAxis: {
            type: 'category',
            position: 'top',
            offset: 0,
            boundaryGap: false,
            axisLabel: {
                textStyle: {
                    color: '#ddd',
                    fontStyle: 'normal',
                    fontSize: '9'
                }
            },
            data: graphDataDates
        },
        yAxis: {
            type: 'value',


            // boundaryGap: [0, '100%'],
            //         axisTick: {show: true},
            //         axisLine: {show: false},
            //         axisLabel: {show: true},
            //         splitLine: {
            //             lineStyle: {
            //             color: '#f1f1f1',
            //             type: 'solid',
            //             width: 1,
            //             shadowColor: 'rgba(0,0,0,0)',
            //             shadowBlur: 5,
            //             shadowOffsetX: 3,
            //             shadowOffsetY: 3,
            //             },  
            // },
        },
        color: ["rgb(76, 175, 80)", "rgb(92, 107, 192)", "rgb(255, 87, 34)", ],
        dataZoom: [{
            type: 'inside',
            start: 0,
            end: 40
        }, {
            height: 10,
            backgroundColor: '#ffffff',
            dataBackgroundColor: '#ddd',
            handleColor: '#dddddd',
            fillerColor: '#f5f5f5',
            handleSize: 20,
            start: 0,
            end: 10,
        }],
        series: series
    };
    if (!app.inNode) {
        window.addEventListener('resize', updatePosition);
    }
    $(window).resize(function() {
        PackageSalesChart.resize();
    });
    PackageSalesChart.on('dataZoom', updatePosition);

    function updatePosition() {
        PackageSalesChart.resize();
    }
    if (option && typeof option === "object") {
        PackageSalesChart.setOption(option, true);
    }
}
if ($('#graph_tickets_legend').length) {
    $.getJSON(CLOUDMLMSOFTWARE.siteUrl + '/admin/tickets-status.json/0/0', function(data) {
        var dom = document.getElementById("graph_tickets_legend");
        graph_tickets_legend(data, dom);
    });
}

function graph_tickets_legend(data, dom) {
    var TicketsChart = echarts.init(dom);
    var app = {};
    option = null;
    var dates = [],
        open = [],
        closed = [],
        reopened = [];
    for (var property in data) {
        if (!data.hasOwnProperty(property)) {
            continue;
        }
        dates.push(data[property].date);
        open.push(data[property].open);
        closed.push(data[property].closed);
        reopened.push(data[property].reopened);
    }
    option = {
        //     title: {
        //     text: 'Ticket Status Overview',
        //     subtext: 'Showing open,closed and reopened tickets',
        //     x: 'left'
        // },
        grid: {
            top: 110,
            left: 15,
            right: 15,
            bottom: 30
        },
        tooltip: {
            trigger: 'axis',
            axisPointer: {
                type: 'line',
                lineStyle: {
                    color: 'rgba(214, 242, 255, 0.61)',
                    type: 'solid',
                    width: 1,
                    shadowColor: '#cccccc',
                    shadowBlur: 5,
                    shadowOffsetX: 3,
                    shadowOffsetY: 3,
                },
            },
            // formatter: function (params) {
            //     console.log(params);            
            //     return params[0].seriesName + ': ' + params[0].value;
            // }
        },
        legend: {
            // right:10,
            // top:0,
            itemGap: 16,
            itemWidth: 18,
            itemHeight: 10,
            data: ['Open', 'Closed', 'Reopened'],
            animation: true,
            textStyle: {
                color: '#ccc'
            },
            // selectedMode: 'single',
            backgroundColor: 'rgb(243,243,243)',
            borderRadius: 5
        },
        xAxis: {
            type: 'category',
            boundaryGap: false,
            axisTick: {
                show: false
            },
            axisLine: {
                show: false
            },
            axisLabel: {
                textStyle: {
                    color: '#333',
                    fontStyle: 'normal',
                    fontSize: '9'
                }
            },
            data: dates
        },
        yAxis: {
            type: 'value',
            boundaryGap: false,
            axisTick: {
                show: true,
                inside: true,
                lineStyle: {
                    color: '#ddd'
                }
            },
            axisLine: {
                show: false
            },
            axisLabel: {
                textStyle: {
                    color: '#333',
                    fontStyle: 'normal',
                    fontSize: '9'
                }
            },
            splitLine: {
                lineStyle: {
                    color: '#f1f1f1',
                    type: 'solid',
                    width: 1,
                    shadowColor: 'rgba(0,0,0,0)',
                    shadowBlur: 5,
                    shadowOffsetX: 3,
                    shadowOffsetY: 3,
                },
            },
        },
        series: [{
            name: 'Open',
            type: 'bar',
            itemStyle: {
                normal: {
                    color: "#F44336",
                }
            },
            data: open
        }, {
            name: 'Closed',
            type: 'bar',
            itemStyle: {
                normal: {
                    color: "#4CAF50",
                }
            },
            data: closed
        }, {
            name: 'Reopened',
            type: 'bar',
            itemStyle: {
                normal: {
                    color: "#f39c11",
                }
            },
            data: reopened
        }],
    };
    if (!app.inNode) {
        window.addEventListener('resize', updatePosition);
    }
    $(window).resize(function() {
        TicketsChart.resize();
    });
    TicketsChart.on('dataZoom', updatePosition);

    function updatePosition() {
        TicketsChart.resize();
    }
    if (option && typeof option === "object") {
        TicketsChart.setOption(option, true);
    }
    // Daterange picker
    // ------------------------------
    $('.daterange-ranges-tickets').daterangepicker({
        startDate: moment().subtract(29, 'days'),
        endDate: moment(),
        minDate: '01/01/2012',
        maxDate: '12/31/2016',
        dateLimit: {
            days: 360
        },
        ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        opens: 'left',
        applyClass: 'btn-small bg-slate-600 btn-block',
        cancelClass: 'btn-small btn-default btn-block',
        format: 'MM/DD/YYYY'
    }, function(start, end) {
        var DisplayStart = start.format('MMMM D');
        var DisplayEnd = end.format('MMMM D');
        var ServerStart = start.format('MMMM D');
        var ServerEnd = end.format('MMMM D');
        $('.daterange-ranges-tickets span').html(DisplayStart + ' - ' + DisplayEnd);
        var dom = document.getElementById("graph_tickets_legend");
        let existInstance = echarts.getInstanceByDom(dom);
        if (existInstance) {
            if (true) {
                echarts.dispose(TicketsChart);
            }
        }
        $.getJSON(CLOUDMLMSOFTWARE.siteUrl + '/admin/tickets-status.json/' + ServerStart + '/' + ServerEnd, function(data) {
            var dom = document.getElementById("graph_tickets_legend");
            graph_tickets_legend(data, dom);
        });
    });
}
$('.daterange-ranges-tickets span').html(moment().subtract(29, 'days').format('MMMM D') + ' - ' + moment().format('MMMM D'));
$(document).ready(function() {
    $(".selectall").focus(function() {
        $(this).select();
    });
});
if ($('#enable_settings').length) {
    $(function() {
        $('#enable_settings').click(function() {
            $('#settings .settings').editable('toggleDisabled');
            $('#enable_settings').text(function(i, text) {
                return text === "Enable edit mode" ? "Disable edit mode" : "Enable edit mode";
            });
        });
        $.fn.editable.defaults.mode = 'popup';
        $.fn.editable.defaults.params = function(params) {
            params._token = $("meta[name=csrf-token]").attr("content");
            return params;
        };
        $('.settings').editable({
            validate: function(value) {},
            type: 'text',
            url: CLOUDMLMSOFTWARE.siteUrl + '/admin/updatesettings',
            placement: 'top',
            send: 'always',
            disabled: true,
            ajaxOptions: {
                dataType: 'json'
            },
            success: function(response, newValue) {
                $(this).html(newValue);
            }
        });
    });
}
if ($('#enable_settings1').length) {
    $(function() {
        $('#enable_settings1').click(function() {
            $('#settings1 .settings1').editable('toggleDisabled');
            $('#enable_settings1').text(function(i, text) {
                return text === "Enable edit mode" ? "Disable edit mode" : "Enable edit mode";
            });
        });
        $.fn.editable.defaults.mode = 'popup';
        $.fn.editable.defaults.params = function(params) {
            params._token = $("meta[name=csrf-token]").attr("content");
            return params;
        };
        $('.settings1').editable({
            validate: function(value) {},
            type: 'text',
            url: CLOUDMLMSOFTWARE.siteUrl + '/admin/updatesettings1',
            placement: 'top',
            send: 'always',
            disabled: true,
            ajaxOptions: {
                dataType: 'json'
            },
            success: function(response, newValue) {
                $(this).html(newValue);
            }
        });
    });
}
if ($('#enable-package-edit').length) {
    $(function() {
        $('#enable-package-edit').click(function() {
            $('#settings .settings').editable('toggleDisabled');
            $('#enable-package-edit').text(function(i, text) {
                return text === "Enable edit mode" ? "Disable edit mode" : "Enable edit mode";
            });
        });
        $.fn.editable.defaults.mode = 'popup';
        $.fn.editable.defaults.params = function(params) {
            params._token = $("meta[name=csrf-token]").attr("content");
            return params;
        };
        $('.settings').editable({
            validate: function(value) {},
            type: 'text',
            url: CLOUDMLMSOFTWARE.siteUrl + '/admin/plansettings',
            placement: 'top',
            send: 'always',
            disabled: true,
            ajaxOptions: {
                dataType: 'json'
            },
            success: function(response, newValue) {
                $(this).html(newValue);
            }
        });
    });
}
if ($('#leadership').length) {
    $(function() {
        $('#leadership').click(function() {
            $('#leadership-form .leadership').editable('toggleDisabled');
            $('#leadership').text(function(i, text) {
                return text === "Enable edit mode" ? "Disable edit mode" : "Enable edit mode";
            });
        });
        $.fn.editable.defaults.mode = 'popup';
        $.fn.editable.defaults.params = function(params) {
            params._token = $("meta[name=csrf-token]").attr("content");
            return params;
        };
        $('.leadership').editable({
            validate: function(value) {
                if ($.trim(value) == '') return 'Value is required.';
                if (!$.isNumeric(value)) return 'Value should be numeric.';
            },
            type: 'text',
            url: CLOUDMLMSOFTWARE.siteUrl + '/admin/updateleadership',
            placement: 'top',
            send: 'always',
            disabled: true,
            ajaxOptions: {
                dataType: 'json'
            },
            success: function(response, newValue) {
                $(this).html(newValue);
            }
        });
    });
}
if ($('#settings .directrefer').length) {
    $(function() {
        $('#enable').click(function() {
            $('#settings .directrefer').editable('toggleDisabled');
            $('#enable').text(function(i, text) {
                return text === "Enable edit mode" ? "Disable edit mode" : "Enable edit mode";
            });
        });
        $.fn.editable.defaults.mode = 'popup';
        $.fn.editable.defaults.params = function(params) {
            params._token = $("meta[name=csrf-token]").attr("content");
            return params;
        };
        $('.directrefer').editable({
            validate: function(value) {},
            type: 'text',
            url: CLOUDMLMSOFTWARE.siteUrl + '/admin/direct-referbonus',
            placement: 'top',
            send: 'always',
            disabled: true,
            ajaxOptions: {
                dataType: 'json'
            },
            success: function(response, newValue) {
                $(this).html(newValue);
            }
        });
    });
}
if ($('#matching-enable').length) {
    $(function() {
        $('#matching-enable').click(function() {
            $('#matching .matching').editable('toggleDisabled');
            $('#matching-enable').text(function(i, text) {
                return text === "Enable edit mode" ? "Disable edit mode" : "Enable edit mode";
            });
        });
        $.fn.editable.defaults.mode = 'popup';
        $.fn.editable.defaults.params = function(params) {
            params._token = $("meta[name=csrf-token]").attr("content");
            return params;
        };
        $('.matching').editable({
            validate: function(value) {},
            type: 'text',
            url: CLOUDMLMSOFTWARE.siteUrl + '/admin/groupsales',
            placement: 'top',
            send: 'always',
            disabled: true,
            ajaxOptions: {
                dataType: 'json'
            },
            success: function(response, newValue) {
                $(this).html(newValue);
            }
        });
    });
}
if ($('#reorder .reorder').length) {
    $(function() {
        $('#enable-reorder').click(function() {
            $('#reorder .reorder').editable('toggleDisabled');
            $('#enable-reorder').text(function(i, text) {
                return text === "Enable edit mode" ? "Disable edit mode" : "Enable edit mode";
            });
        });
        $.fn.editable.defaults.mode = 'popup';
        $.fn.editable.defaults.params = function(params) {
            params._token = $("meta[name=csrf-token]").attr("content");
            return params;
        };
        $('.reorder').editable({
            validate: function(value) {},
            type: 'text',
            url: CLOUDMLMSOFTWARE.siteUrl + '/admin/reorder',
            placement: 'top',
            send: 'always',
            disabled: true,
            ajaxOptions: {
                dataType: 'json'
            },
            success: function(response, newValue) {
                $(this).html(newValue);
            }
        });
    });
}
if ($('#reorder-pv .reorder-pv').length) {
    $(function() {
        $('#enable-reorder-pv').click(function() {
            $('#reorder-pv .reorder-pv').editable('toggleDisabled');
            $('#enable-reorder-pv').text(function(i, text) {
                return text === "Enable edit mode" ? "Disable edit mode" : "Enable edit mode";
            });
        });
        $.fn.editable.defaults.mode = 'popup';
        $.fn.editable.defaults.params = function(params) {
            params._token = $("meta[name=csrf-token]").attr("content");
            return params;
        };
        $('.reorder-pv').editable({
            validate: function(value) {},
            type: 'text',
            url: CLOUDMLMSOFTWARE.siteUrl + '/admin/reorder-pv',
            placement: 'top',
            send: 'always',
            disabled: true,
            ajaxOptions: {
                dataType: 'json'
            },
            success: function(response, newValue) {
                $(this).html(newValue);
            }
        });
    });
}
if ($('#settings .currency').length) {
    $(function() {
        $('#enable').click(function() {
            $('#settings .currency').editable('toggleDisabled');
            $('#enable').text(function(i, text) {
                return text === "Enable edit mode" ? "Disable edit mode" : "Enable edit mode";
            });
        });
        $.fn.editable.defaults.mode = 'popup';
        $.fn.editable.defaults.params = function(params) {
            params._token = $("meta[name=csrf-token]").attr("content");
            return params;
        };
        $('.currency').editable({
            validate: function(value) {},
            type: 'text',
            url: CLOUDMLMSOFTWARE.siteUrl + '/admin/currency',
            placement: 'top',
            send: 'always',
            disabled: true,
            ajaxOptions: {
                dataType: 'json'
            },
            success: function(response, newValue) {
                $(this).html(newValue);
            }
        });
    });
}

if ($('#enable-ranksettings-edit').length) {

 $(function(){
             $('#enable-ranksettings-edit').click(function() {
                 $('#settings .settings').editable('toggleDisabled');
                 $('#enable-ranksettings-edit').text(function(i, text){
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
        url:CLOUDMLMSOFTWARE.siteUrl + '/admin/updateranksettings', 
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
}

if ($('#enable-email-settings-edit').length) {
$(function(){
             $('#enable-email-settings-edit').click(function() {
                 $('#settings .settings').editable('toggleDisabled');
                  $('#enable-email-settings-edit').text(function(i, text){
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
        url:CLOUDMLMSOFTWARE.siteUrl + '/admin/emailsettings',
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
}

if ($('#enable-payout-settings-edit').length) {
$(function(){
             $('#enable-payout-settings-edit').click(function() {
                 $('#settings_pay .settings_pay').editable('toggleDisabled');
                  $('#enable-payout-settings-edit').text(function(i, text){
                     return text === "Enable edit mode" ? "Disable edit mode" : "Enable edit mode";
                });
            });

        $.fn.editable.defaults.mode = 'popup';
        $.fn.editable.defaults.params = function (params) {
            params._token = $("meta[name=csrf-token]").attr("content");
            return params;
        };

        $('.settings_pay').editable({
            validate: function(value) {
              
        },        
        type: 'text',
        url:CLOUDMLMSOFTWARE.siteUrl + '/admin/payoutnotification',
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
}



/* campaign js */
$('#campaign-date-time').datepicker({
    format: "mm/dd/yyyy",
    autoclose: true
});
$('.datetimepicker').datepicker({
   format: "mm/dd/yyyy",
   autoclose: true
});

$('#campaign-email').summernote({
    height: 300,    
    minHeight: 300,    
});  





  
var FileUpload = function() { 
    var _componentFileUpload = function() {
        if (!$().fileinput) {
            console.warn('Warning - fileinput.min.js is not loaded.');
            return;
        }
        // Modal template
        var modalTemplate = '<div class="modal-dialog modal-lg" role="document">\n' +
            '  <div class="modal-content">\n' +
            '    <div class="modal-header align-items-center">\n' +
            '      <h6 class="modal-title">{heading} <small><span class="kv-zoom-title"></span></small></h6>\n' +
            '      <div class="kv-zoom-actions btn-group">{toggleheader}{fullscreen}{borderless}{close}</div>\n' +
            '    </div>\n' +
            '    <div class="modal-body">\n' +
            '      <div class="floating-buttons btn-group"></div>\n' +
            '      <div class="kv-zoom-body file-zoom-content"></div>\n' + '{prev} {next}\n' +
            '    </div>\n' +
            '  </div>\n' +
            '</div>\n';

        // Buttons inside zoom modal
        var previewZoomButtonClasses = {
            toggleheader: 'btn btn-light btn-icon btn-header-toggle btn-sm',
            fullscreen: 'btn btn-light btn-icon btn-sm',
            borderless: 'btn btn-light btn-icon btn-sm',
            close: 'btn btn-light btn-icon btn-sm'
        };

        // Icons inside zoom modal classes
        var previewZoomButtonIcons = {
            prev: '<i class="icon-arrow-left32"></i>',
            next: '<i class="icon-arrow-right32"></i>',
            toggleheader: '<i class="icon-menu-open"></i>',
            fullscreen: '<i class="icon-screen-full"></i>',
            borderless: '<i class="icon-alignment-unalign"></i>',
            close: '<i class="icon-cross2 font-size-base"></i>'
        };

        // File actions
        var fileActionSettings = {
            zoomClass: '',
            zoomIcon: '<i class="icon-zoomin3"></i>',
            dragClass: 'p-2',
            dragIcon: '<i class="icon-three-bars"></i>',
            removeClass: '',
            removeErrorClass: 'text-danger',
            removeIcon: '<i class="icon-bin"></i>',
            indicatorNew: '<i class="icon-file-plus text-success"></i>',
            indicatorSuccess: '<i class="icon-checkmark3 file-icon-large text-success"></i>',
            indicatorError: '<i class="icon-cross2 text-danger"></i>',
            indicatorLoading: '<i class="icon-spinner2 spinner text-muted"></i>'
        };  

        //
        // Basic example
        //

        $('.file-input').fileinput({
            browseLabel: 'Browse',
            browseIcon: '<i class="icon-file-plus mr-2"></i>',
            uploadIcon: '<i class="icon-file-upload2 mr-2"></i>',
            removeIcon: '<i class="icon-cross2 font-size-base mr-2"></i>',
            layoutTemplates: {
                icon: '<i class="icon-file-check"></i>',
                modal: modalTemplate
            },
            initialCaption: "No file selected",
            previewZoomButtonClasses: previewZoomButtonClasses,
            previewZoomButtonIcons: previewZoomButtonIcons,
            fileActionSettings: fileActionSettings
        });

 

       
           
    }; 

    return {
        init: function() {
            _componentFileUpload();
        }
    }
}();

// Initialize module
// ------------------------------

document.addEventListener('DOMContentLoaded', function() {
    FileUpload.init();
});

 
if ($(".steps-planpurchase").length) {
$(".steps-planpurchase").parsley();

   $(".steps-planpurchase").steps({

        headerTag: "h6",
        bodyTag: "fieldset",
        transitionEffect: "fade",
        titleTemplate: '<span class="number">#index#</span> #title#',
        autoFocus: true,
        onStepChanging: function(event, currentIndex, newIndex) {    
            if (currentIndex > newIndex) {
                return true;
            } 
            if (currentIndex < newIndex) {
                // To remove error styles
                $(".steps-planpurchase").find(".body:eq(" + newIndex + ") label.error").remove();
                $(".steps-planpurchase").find(".body:eq(" + newIndex + ") .error").removeClass("error");
            }
             var validateForm = $(".steps-planpurchase").parsley().whenValidate({
                group: 'block-' + currentIndex
            });
            validateForm.then(function() {}, function() {});
            if (validateForm.state() === "resolved") {
                return true;
            } 

           
        },
        onStepChanged: function(event, currentIndex, priorIndex) {
            
        },
        onFinishing: function(event, currentIndex) {
            $(".steps-planpurchase").submit();
        },
        onFinished: function(event, currentIndex) {
            $(".steps-planpurchase").submit();
        }
    });
}


   if ( $( ".steps-planpurchase" ).length ) {

        $('.steps-plan-payment').click(function(e){
            

            $('input[name="steps_plan_payment"]').val($(this).attr('data-payment'));
            if( $(this).attr('data-payment') == 'paypal' || $(this).attr('data-payment') == 'cheque'  || $(this).attr('data-payment') == 'bitcoin'){
                $(".steps-planpurchase a[href='#finish']").show();
            }else{
                $(".steps-planpurchase a[href='#finish']").hide();
            }
        })

        $('input[name="plan"]').css("display","none");

        $('.ribbon-container').css("display","none");

        $( "input" ).on( "click", function() {

            $('.ribbon-container').css("display","none");
            $('.'+ $('input[name="plan"]:checked').attr('badge-class')).css("display","block");
            $('.table-vouher-payment').find("td span.remaining").html($('input[name="plan"]:checked').attr('plan-amount'));
        });
    } 

    
    if ( $( ".table-vouher-payment" ).length ) {

        voucherObj = [];
             
        
        
       $(document).on('click', '.validatevoucher', function(e){  

        totalamount = $('input[name="plan"]:checked').attr('plan-amount'); 
        balanceamount = totalamount ;

            $(this).html('Validating please wait <i class="icon-spinner2 spinner"></i>').prop('disabled', true);           
            validVoucher = true; 
            $.each(voucherObj, function(i,obj) {

                balanceamount = balanceamount  - obj.balance_amount ;

                if (obj.voucher_code ===  $('.validatevoucher').closest('tr').find("td input:text").val()) { 
                     alert('Voucher already used, please use a new voucher');
                     $('.validatevoucher').html('Validate').prop('disabled', false);                    
                     validVoucher = false;
                     return false;
                }
            });

            if(validVoucher){

                     $.ajax({
                        url: CLOUDMLMSOFTWARE.siteUrl+"/voucher_validate/" + $(this).closest('tr').find("td input:text").val(),
                        dataType: "json",
                        type: "GET",
                        data:"{balance:"+balanceamount+"}",
                        success: onVoucherRecieveSuccess,
                        error: onVoucherRecieveError 
                    });

            }
            function onVoucherRecieveSuccess(data) {
                 if(!data['error']){     
                    item = {}
                    item ["voucher_code"] =data['voucher_code'];
                    item ["balance_amount"] =data['balance_amount'];
                    voucherObj.push(item);   

                    balanceamount = parseInt(balanceamount) - parseInt(data['balance_amount']);

                    if(balanceamount <= 0){
                        balanceamount = 0;
                    }
 

                                               
                     $('.validatevoucher').closest('tr').find("td span.amount").html(data['balance_amount']);
                    $('.validatevoucher').closest('tr').find("td span.balance").html(data['balance_amount']);
                    // $('.validatevoucher').closest('tr').find("td span.remaining").html(balanceamount);
                     $('.validatevoucher').closest('tr').find("td.td-validate-voucher").html(''); 
                     var markup = "<tr>"+
                                '<td>1</td>'+
                                "<td><input type='text' name='voucher[]' class='form-control'></td>"+
                                "<td><span class='amount'></span></td><td><span class='balance'></span></td>"+
                                "<td><span class='remaining'>"+balanceamount+"</span></td> "+
                                "<td class='td-validate-voucher'><button class='btn btn-info validatevoucher'  onclick='return false;' >Validate</button></td>"+
                                "</tr>"; 
                    if(balanceamount > 0){
                            $(".table-vouher-payment tbody").append(markup);
                            // $('.validatevoucher').closest('tr').find("td.td-validate-voucher").html('');                             
                        }else{
                             $(".steps-planpurchase a[href='#finish']").show();
                        }

                }else{
                    alert(data['error']);
                     $('.validatevoucher').html('Validate').prop('disabled', false);
                }
            }
            function onVoucherRecieveError(data) {
                alert(data['error']);
            }

           
        });

        


    }


    //reg

if ( $( ".steps-validation" ).length ) {

        $('.bhoechie-tab-content').click(function(e){

            $('input[name="col-lg-9 col-md-9 col-sm-9 col-xs-9"]').val($(this).attr('payment'));
            if($(this).attr('payment') == 'cheque' || $(this).attr('payment') == 'paypal'){
                $(".steps-validation a[href='#finish']").show();
            }else{
                $(".steps-validation a[href='#finish']").hide();
                 $("#resulttable").hide();

            }
        })

        $( "input" ).on( "click", function() {  
            var product = document.getElementById("package");
            var totalamount =  product.options[product.selectedIndex].getAttribute('amount');
            $('.table-vouher-regpayment').find("td span.remaining").html( product.options[product.selectedIndex].getAttribute('amount'));
        });


    } 

 //registration

      if ( $( ".table-vouher-regpayment" ).length ) {

        voucherObj = [];   

       $(document).on('click', '.validatevoucher', function(e){ 

        $('#package').attr("disabled", true); 
 
        var product = document.getElementById("package");
        var totalamount =  product.options[product.selectedIndex].getAttribute('amount');

      

        
        balanceamount = totalamount ;

            $(this).html('Validating please wait <i class="icon-spinner2 spinner"></i>').prop('disabled', true);           
            validVoucher = true; 

            $.each(voucherObj, function(i,obj) {

                balanceamount = balanceamount  - obj.balance_amount;

                if (obj.voucher_code ===  $('.validatevoucher').closest('tr').find("td input:text").val()) { 
                     alert('Voucher already used, please use a new voucher');
                     $('.validatevoucher').html('Validate').prop('disabled', false);                    
                     validVoucher = false;
                     return false;
                }
            });

            if(validVoucher){

                     $.ajax({
                        url: CLOUDMLMSOFTWARE.siteUrl+"/voucher_validate/" + $(this).closest('tr').find("td input:text").val(),
                        dataType: "json",
                        type: "GET",
                        data:"{balance:"+balanceamount+"}",
                        success: onVoucherRecieveSuccessReg,
                        error: onVoucherRecieveError 
                    });

            }
            function onVoucherRecieveSuccessReg(data) {

             // console.log(data);
                 if(!data['error']){     
                    item = {}
                    item ["voucher_code"] =data['voucher_code'];
                    item ["balance_amount"] =data['balance_amount'];
                    voucherObj.push(item);   

                    balanceamount = parseInt(balanceamount) - parseInt(data['balance_amount']);

                    if(balanceamount <= 0){
                        balanceamount = 0;
                    }
 

                                                
                    $('.validatevoucher').closest('tr').find("td span.amount").html(data['balance_amount']);
                    $('.validatevoucher').closest('tr').find("td span.balance").html(data['balance_amount']);
                    // $('.validatevoucher').closest('tr').find("td span.remaining").html(balanceamount);
                     $('.validatevoucher').closest('tr').find("td.td-validate-voucher").html(''); 
                     var markup = "<tr>"+
                                '<td>1</td>'+
                                "<td><input type='text' name='voucher[]' class='form-control'></td>"+
                                "<td><span class='amount'></span></td><td><span class='balance'></span></td>"+
                                "<td><span class='remaining'>"+balanceamount+"</span></td> "+
                                "<td class='td-validate-voucher'><button class='btn btn-info validatevoucher'  onclick='return false;' >Validate</button></td>"+
                                "</tr>"; 
                    if(balanceamount > 0){
                            $(".table-vouher-regpayment tbody").append(markup);
                            // $('.validatevoucher').closest('tr').find("td.td-validate-voucher").html('');                             
                        }else{
                          
                             $("#resulttable").show();

                        }

                }else{
                    alert(data['error']);
                     $('.validatevoucher').html('Validate').prop('disabled', false);
                }
            }
            function onVoucherRecieveError(data) {
                alert(data['error']);
            }

           
        });

        


    }



    // use kb article

     if ($('#kb-article-table-user').length) {
        $(document).ready(function() {
            oTable = $('#kb-article-table-user').DataTable({
                "processing": true,
                "serverSide": true,
                "ordering": false,
                "ajax": CLOUDMLMSOFTWARE.siteUrl + "/user/helpdesk/kb/articles/data/",
                "fnDrawCallback": function(oSettings) {}
            });
        });

        function reloadDataTable() {
            oTable.ajax.reload();
        }
    } 
    // use tickets 

    if ($('#user-ticket-table').length) {
        var priority = $('#user-ticket-table').attr('data-priority');
        var department = $('#user-ticket-table').attr('data-department');
        var category = $('#user-ticket-table').attr('data-category');
        var status = $('#user-ticket-table').attr('data-status');
        var overdue = $('#user-ticket-table').attr('data-overdue');
        var deleted = $('#user-ticket-table').attr('data-deleted');
        $(document).ready(function() {
            oTable = $('#user-ticket-table').DataTable({
                "processing": true,
                "serverSide": true,
                "ordering": true,
                "ajax": CLOUDMLMSOFTWARE.siteUrl + "/user/helpdesk/tickets/data/?priority=" + priority + "&department=" + department + "&category=" + category + "&status=" + status + "&overdue=" + overdue + "&deleted=" + deleted,
                "fnDrawCallback": function(oSettings) {}
            });
        });

        function reloadDataTable() {
            oTable.ajax.reload();
        }
    }

    if ($('.campaign-list').length) {

          $('.campaign-list').on('click', '.changecampaignstatus', function(e) {
        var id = $(this).data('id');
        var status = $(this).data('status');       
        var this_context = $(this).closest('.statusdropbtn');
        buttonClasses = [];
        buttonClasses = {
            'complete': 'bg-danger-400',
            'pending': 'bg-success-400',
        };
        swal({
            title: "",
            text: "Change status?",
            type: "warning",
            animation: false,
            customClass: 'animated bounceOutLeft',
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Yes, change status to " + status,
            closeOnConfirm: true
        }, function() {
            $.get(CLOUDMLMSOFTWARE.siteUrl + '/admin/campaign/lists/change-status/', {
                id: id,
                status: status
            }, function(response) {
                this_context.parent().find('.statusname').text(status);
                this_context.parent().find('.statusname').removeClass('');
                this_context.parent().find('.statusname').attr('class', 'label  statusname dropdown-toggle ' + buttonClasses[status]);
                this_context.parent().find('.statusdrop').removeClass('');
                this_context.parent().find('.statusdrop').attr('class', 'statusdrop btn-xs btn dropdown-toggle ' + buttonClasses[status]);
                // console.log(buttonClasses[status]);
            });
        });
    });


    }


 if ($('#contact-groups-table').length) {
     $(document).ready(function() {
            oTable = $('#contact-groups-table').DataTable({
                "processing": true,
                "serverSide": true,
                "ordering": false,
                "ajax": CLOUDMLMSOFTWARE.siteUrl + "/admin/campaign/contacts/contactsgroup/",
                "fnDrawCallback": function(oSettings) {}
            });
        });
        function reloadDataTable() {
            oTable.ajax.reload();
        } 

    $('.content').on('click', '.btn-delete-contactgroup', function(e) {
        var id = $(this).data('id');       
        swal({
            title: "Are you sure?",
            text: "All related contacts  will be deleted from this group",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Yes, delete it!",
            closeOnConfirm: false
        }, function() {
            window.location.href = CLOUDMLMSOFTWARE.siteUrl + '/admin/campaign/contacts/destroygruop/' + id;
        });
    }); 
 }



 if ($('#contact-list-table').length) {
     $(document).ready(function() {
        var id = $("[name='id']").val();
            oTable = $('#contact-list-table').DataTable({
                "processing": true,
                "serverSide": true,
                "ordering": false,
                "ajax": CLOUDMLMSOFTWARE.siteUrl + "/admin/campaign/contacts/contactslist/"+id,
                "fnDrawCallback": function(oSettings) {}
            });
        });
        function reloadDataTable() {
            oTable.ajax.reload();
        } 

    $('.content').on('click', '.btn-delete-contactgroup', function(e) {
        var id = $(this).data('id');       
        swal({
            title: "Are you sure?",
            text: "All related contacts  will be deleted from this group",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Yes, delete it!",
            closeOnConfirm: false
        }, function() {
            window.location.href = CLOUDMLMSOFTWARE.siteUrl + '/admin/campaign/contacts/destroygruop/' + id;
        });
    }); 
 }


 if ($('.map-choropleth').length) {

   $.get( CLOUDMLMSOFTWARE.siteUrl+"/ajax/globalview", function( data ) {
      
        $('.map-choropleth').vectorMap({
            map: 'world_mill_en',
            backgroundColor: '#fff',
             regionStyle:{
                initial: {
                fill: '#4c4f5d',               
                stroke: 'none',             
              }
            },

            series: {
                regions: [{
                    values: data,
                    scale: ['#C8EEFF', '#0071A4'],
                    normalizeFunction: 'polynomial'
                }],
            },
            onRegionLabelShow: function(e, el, code){
                if(typeof data[code] === 'undefined') {
                    el.html(el.html());
                }else {
                    el.html(el.html()+'<br>'+'User  - '+data[code]);
                }

            }
        });

     }); 
}

if ($('#treemap').length) {

 pagemap(document.querySelector('#treemap'), {
    viewport: document.querySelector('#treediv'),
    styles: {
        'header,footer,section,article': 'rgba(0,0,0,0.08)',
        'h1,a': 'rgba(0,0,0,0.10)',
        'h2,h3,h4': 'rgba(0,0,0,0.08)',
        'img': 'rgba(0,0,0,0.08'
       
    },
    back: 'rgba(0,0,0,0.08',
    view: 'rgba(0,0,0,0.07)',
    drag: 'rgba(0,0,0,0.10)',
    interval: 0
});

}


