/**
 * Created by d4smart on 2017/2/6.
 */
// 获取元素
var divs = document.getElementsByClassName('comment-form');
// 生成编辑器
var length = divs.length;
for(var i = 0; i < length; i++) {
    var editor = new wangEditor(divs[i]);

    editor.config.uploadImgUrl = '/images/upload';
    // 自定义菜单
    editor.config.menus = [
        'source',
        '|',
        'bold',
        'underline',
        'italic',
        'strikethrough',
        'forecolor',
        '|',
        'unorderlist',
        'orderlist',
        '|',
        'link',
        'unlink',
        'emotion',
        '|',
        'img',
        'insertcode'
    ];

    editor.create();
}
