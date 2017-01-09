/**
 * Created by quan on 4/22/16.
 */
(function ($) {
    var re = /([^&=]+)=?([^&]*)/g;
    var decodeRE = /\+/g;
    var decode = function (str) {
        return decodeURIComponent(str.replace(decodeRE, " "));
    };
    $.parseParams = function (query) {
        var params = {}, e;
        while (e = re.exec(query)) {
            var k = decode(e[1]), v = decode(e[2]);
            if (k.substring(k.length - 2) === '[]') {
                k = k.substring(0, k.length - 2);
                (params[k] || (params[k] = [])).push(v);
            }
            else params[k] = v;
        }
        return params;
    };
})(jQuery);

var UrlUtility = {};
UrlUtility.getUrlVars = function () {
    var url = window.location.href;
    return $.parseParams(url.split('?')[1] || '');
};

UrlUtility.getCurrentWithoutParams = function () {
    var url = window.location.href;
    return url.split('?')[0] || '';
};
UrlUtility.buildUrl = function (params) {
    var url = '';
    var i = 0;
    $.each(params, function (key, value) {
        var sub = (i == 0) ? '?' : '&';
        if ($.isArray(value)) {
            $.each(value, function (k, v) {
                sub = (i == 0) ? '?' : '&';
                url += sub + key + '[]=' + v;
                i++;
            });
        } else {
            url += sub + key + '=' + value;
        }
        i++;
    });
    return url;
};

$(function () {
    $(".megamenu").megamenu();
    $("#slider1").responsiveSlides({
        auto: true,
        nav: true,
        speed: 500,
        namespace: "callbacks",
    });
    $(window).load(function () {
        $("#flexiselDemo1").flexisel({
            visibleItems: 5,
            animationSpeed: 1000,
            autoPlay: true,
            autoPlaySpeed: 3000,
            pauseOnHover: true,
            enableResponsiveBreakpoints: true,
            responsiveBreakpoints: {
                portrait: {
                    changePoint: 480,
                    visibleItems: 1
                },
                landscape: {
                    changePoint: 640,
                    visibleItems: 2
                },
                tablet: {
                    changePoint: 768,
                    visibleItems: 3
                }
            }
        });
    });

    $(".cat-tab ul").click(function () {
        $(".cat-tab .single-bottom").hide();
        $(this).parent().find(".single-bottom").slideToggle(300);
    });
    $(".cat-tab ul[for='" + fistCat + "']").parent().find(".single-bottom").slideToggle(300);
    $('.pagination').find('a').each(function () {
        if ($(this).attr('href') === undefined) {
            $(this).remove();
        }
    });

    $('input[name="sizes"]').click(function (event) {
        var cParams = UrlUtility.getUrlVars();
        var rs = [];
        var searchIDs = $('input[name="sizes"]:checked').map(function () {
            rs.push($(this).val());
        });
        if (rs.length == 0) {
            delete cParams['sizes'];
        } else {
            cParams['sizes'] = rs;
        }
        var newUrl = window.location.href.split('?')[0] + UrlUtility.buildUrl(cParams);
        window.location = newUrl.replace('html&', 'html?');

    });
    $('input[name="colors"]').click(function (event) {
        var cParams = UrlUtility.getUrlVars();
        var rs = [];
        var searchIDs = $('input[name="colors"]:checked').map(function () {
            rs.push($(this).val());
        });
        if (rs.length == 0) {
            delete cParams['colors'];
        } else {
            cParams['colors'] = rs;
        }
        var newUrl = window.location.href.split('?')[0] + UrlUtility.buildUrl(cParams);
        window.location = newUrl.replace('html&', 'html?');
    });

    $('input[name="prototype"]').click(function (event) {
        var cParams = UrlUtility.getUrlVars();
        var rs = [];
        var searchIDs = $('input[name="prototype"]:checked').map(function () {
            rs.push($(this).val());
        });
        if (rs.length == 0) {
            delete cParams['prototype'];
        } else {
            cParams['prototype'] = rs;
        }
        var newUrl = window.location.href.split('?')[0] + UrlUtility.buildUrl(cParams);
        window.location = newUrl.replace('html&', 'html?');
    });

    var cParams = UrlUtility.getUrlVars();


    try {
        $('input[name="colors"]').map(function () {
            if (cParams['colors'].indexOf($(this).val()) > -1) {
                $(this).prop('checked', true);
            } else {

            }
        });
    }
    catch (err) {

    }
    try {
        $('input[name="sizes"]').map(function () {
            if (cParams['sizes'].indexOf($(this).val()) > -1) {
                $(this).prop('checked', true);
            } else {
                $(this).prop('checked', false);
            }
        });
    }
    catch (err) {

    }
    try {
        $('input[name="prototype"]').map(function () {
            if (cParams['prototype'].indexOf($(this).val()) > -1) {
                $(this).prop('checked', true);
            } else {
                $(this).prop('checked', false);
            }
        });
    }
    catch (err) {

    }
    $('#etalage').etalage({
        thumb_image_width: 300,
        thumb_image_height: 400,
        source_image_width: 900,
        source_image_height: 1200,
        show_hint: true,
        click_callback: function (image_anchor, instance_id) {
            alert('Callback example:\nYou clicked on an image with the anchor: "' + image_anchor + '"\n(in Etalage instance: "' + instance_id + '")');
        }
    });
});
