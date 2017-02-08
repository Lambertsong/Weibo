(function($) {
    var popover_card_count = 0;
    $.fn.popovercard = function(op) {
        var nowObj = $(this);
        var space = 20;// 浮动框左边空隙
        var float_width = 324;// 浮动框宽度

        // console.log(nowObj.offset().left);
        // return;
        var defaults = {
            obj_type : 'user',
            obj_id : '21',
            url : '/getuserinfo',
            // user_url : '/user/user_info_card?uid=',
            // prod_url : '',
            // needParam : 'true',
            popover_class : 'popover_class',
            popover_wrap_class : 'popover_wrap_class'
            // onSuccess : null,
            // onError : null
        };
        if (typeof ($(this).data('obj_id')) != "undefined") {
            defaults.obj_id = $(this).data('obj_id');
        }
        if (typeof ($(this).data('url')) != "undefined") {
            defaults.url = $(this).data('url');
        }
        if (typeof ($(this).data('obj_type')) != "undefined") {
            defaults.obj_type = $(this).data('obj_type');
        }
        // if (typeof ($(this).data('needParam')) != "undefined") {
        // defaults.needParam = $(this).data('needParam');
        // }
        if (typeof ($(this).data('popover_class')) != "undefined") {
            defaults.popover_class = $(this).data('popover_class');
        }
        if (typeof ($(this).data('popover_wrap_class')) != "undefined") {
            defaults.popover_wrap_class = $(this).data('popover_wrap_class');
        }
        return this.each(function(key,value) {
            var opts = $.extend(defaults, op);
            nowObj.mouseover(function() {load_user_info(opts);});
        });

        function load_user_info(opts) {
            var data_url;// 获取数据的URL
            var my_timeout;// 隐藏浮动DIV的定时器
            var popover_wrap_div;// 最外层包裹的DIV
            // 浮动框的ID
            var popover_class = opts.popover_class + '_' + popover_card_count;
            // 浮动框和IMG外面包裹的DIV的ID
            var popover_wrap_class = opts.popover_wrap_class + '_' + popover_card_count;

            if (nowObj.next("div[class*='" + opts.popover_class + "']").size() <= 0) {
                popover_card_count = popover_card_count + 1;
                /*
                 * if (opts.type == 'user') { if (needParam == 'true') {
                 * data_url = defaults.user_url + opts.uid; } else { data_url =
                 * defaults.user_url; } } else if (opts.type = '1') { // 扩展其他url }
                 * else { if (needParam == 'true') { data_url = defaults.url +
                 * opts.uid; } else { data_url = defaults.url; } }
                 */
                data_url = opts.url + opts.obj_id;
                $.get(data_url, function(data) {
                    if (data == 'error') {
                        alert('加载失败,请联系管理员!');
                    } else {
                        if (nowObj.parent("div[class*='"+ opts.popover_wrap_class + "']").size() <= 0) {
                            // 在最外面包裹一层DIV
                            popover_wrap_div = '<div class ="' + popover_wrap_class + '"></div>';
                            nowObj.wrap(popover_wrap_div);
                        }
                        $("." + popover_wrap_class).append(data).css('float','left');
                        popover_class = $("." + popover_wrap_class + ">div:last").addClass(popover_class).attr('class');
                        resetPosition(popover_wrap_class,popover_class);
                        $("." + popover_class).show().css('float', 'right');
                        //bindEvent(popover_wrap_class, popover_class);
                    }
                });
            } else {
                popover_class = nowObj.next("div").attr('class');
                popover_wrap_class = nowObj.parent("div[class*='" + opts.popover_wrap_class + "']").attr('class');
                resetPosition(popover_wrap_class,popover_class);
            }
            //bindEvent(popover_wrap_class, popover_class);

            // 重新定位，防止浮动框部分未显示
            function resetPosition(wrap_div_class,div_class) {
                var body_width = $("body").width();
                var body_height = $("body").height();
                var div_pop_over = $("div[class='"+div_class+"']");
                var offset = nowObj.offset();
                var left = offset.left - (space + $(div_pop_over).width());
                var right = (body_width - offset.left) - (space + $(div_pop_over).width());
                var top = offset.top - space - $(div_pop_over).height()+120-30;
                var bottom = (body_height - offset.top ) - (space + $(div_pop_over).height());
                console.log('left'+left+'right'+right+'top'+top+'bottom'+bottom);
                //头像太左边
                if(left<0){
                    $(div_pop_over).removeClass("left").addClass('right');
                }
                //头像太靠右
                if(right<0){
                    $(div_pop_over).removeClass("right").addClass('left').css('margin-left', 0-($(div_pop_over).width()+70+space));
                }
                //头像太靠上,原本需要30px，这里的数据你可以根据自己需要随意调试
                if(top<0){
                    $(div_pop_over).css('top',-30-top);
                    $(div_pop_over).find("div[class='arrow arrow-t']").css('top',60+top);
                }
                //头像太靠下
                if(bottom<0){
                    //如果使用我的页面css，不可能出现这种情况 - -，忽略不计，如果需要，按照上面的，差不多改下
                    //也挺简单的
                }

                div_class  = $(div_pop_over).attr('class');
                bindEvent(wrap_div_class, div_class);
                /*if (left < 0) {
                 $("div[class='"+div_class+"']").css('margin-left', Math.abs(left));
                 $("div[class='"+div_class+"']" + '>div:first').css('margin-left', left);
                 } else {
                 // 浮动框与右边浏览器的距离等于（浏览器页面总宽度-浮动框
                 right = (body_width - offset.left)
                 - (space + $("div[class='"+div_class+"']").width() / 2) - 10;
                 if (right < 0) {
                 $("div[class='"+div_class+"']").css('margin-left', right);
                 $("div[class='"+div_class+"']" + '>div:first').css('margin-left',Math.abs(right));
                 }
                 }*/
                if(top<0){
                    // $("#"+id).css('margin-top',$("#"+id).height()+(nowObj.children("img:first")).height());
                    //$("#"+id+'>div:first').css('margin-top',nowObj.height());
                }

            }
            function bindEvent(popover_wrap_class, popover_class) {
                $("div[class='"+popover_wrap_class+"']").mouseout(function() {
                    my_timeout = setTimeout(function() {
                        $("div[class='"+popover_class+"']").hide();
                    }, 100);
                    $("div[class='"+popover_wrap_class+"']").unbind('mouseout');
                }).mouseover(function() {
                    clearTimeout(my_timeout);
                });
                $("div[class='"+popover_class+"']").show().mouseover(function() {
                    clearTimeout(my_timeout);
                }).mouseout(function() {
                    my_timeout = setTimeout(function() {
                        $("div[class='"+popover_class+"']").hide();
                    }, 200);
                });
                $("div[class='"+popover_class+"']").show();return;
            }
        }
    };
})(jQuery);
