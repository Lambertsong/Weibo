/**
 * Created by d4smart on 2017/2/6.
 */

// 获取元素
var divs = document.getElementsByClassName('comment-operation');
// 生成编辑器
var length = divs.length;
for(var i = 0; i < length; i++) {
    divs[i].addEventListener('mouseover', function () {
        var forms = this.getElementsByTagName('form');
        var length = forms.length;
        for(var i = 0; i < length; i++) {
            forms[i].style.display = 'inline';
        }
    });
    divs[i].addEventListener('mouseout', function () {
        var forms = this.getElementsByTagName('form');
        var length = forms.length;
        for(var i = 0; i < length; i++) {
            forms[i].style.display = 'none';
        }
    });
}

if(document.getElementById('img')) {
    $('#img').Jcrop({
        onSelect: updateCoords
    });
}

function updateCoords(c) {
    $('#x').val(c.x);
    $('#y').val(c.y);
    $('#w').val(c.w);
    $('#h').val(c.h);
}

function checkCoords() {
    if (parseInt($('#w').val())) return true;
    alert('Please select a crop region then press submit.');
    return false;
}

if(document.getElementById('dropzone')) {
    Dropzone.options.dropzone = {
        paramName: "image",
        maxFilesize: 2,
        acceptedFiles: ".jpg,.png,.gif",
        dictDefaultMessage: '<h3>拖动文件至此即可上传，支持jpg，png，gif格式</h3>',
        autoProcessQueue: false,
        init: function() {
            var submitButton = document.querySelector("#SubmitAll");
            myDropzone = this; // closure

            submitButton.addEventListener("click", function() {
                myDropzone.processQueue(); // Tell Dropzone to process all queued files.
            });

            this.on("success", function(file, result) {
                file.previewTemplate.appendChild(document.createTextNode(result.message));
            });
            this.on("error", function(file, result) {
                file.previewTemplate.appendChild(document.createTextNode(JSON.parse(result).message));
            });
        }
    };
}


function showUserInfo(element, id) {
    var url = '/getuserinfo';
    var data = {'id': id, '_token': $('meta[name="csrf-token"]').attr('content')};

    $.ajax({
        url: url,
        type: 'POST',
        data: data,
        success: function (data, status) {
            if(status == 'success') {
                $("#popover-userinfo").remove();
                var info = document.createElement('span');
                info.id = 'popover-userinfo';
                info.innerHTML = data;
                element.parentNode.appendChild(info);
                $(".popover").show();
            }
        },
        error: function (xhr, status) {
            dialog.error(xhr.responseText);
        }
    });
}

function hideUserInfo() {
    $("#popover-userinfo").remove();
}
