# Weibo

## 项目简介

仿写新浪微博，具有发布动态，评论，图片以及个人信息管理的功能。

使用Laravel框架

## 使用工具

[wangEditor](http://www.kancloud.cn/wangfupeng/wangeditor2/)

[layer弹层](http://layer.layui.com/)

[Jcrop](https://github.com/tapmodo/Jcrop/)

[dropzone](http://www.dropzonejs.com/)

[font-awesome](http://fontawesome.io/icons/)

## 部署步骤

1. 配置服务器和数据库，创建网站目录
2. 将代码克隆到服务器的网站目录（git clone https://github.com/d4smart/Weibo.git 你的网站目录），如果网速较慢，可以加上"--depth=1"参数
3. 复制.env.example文件为.env文件，并配置其中的参数（数据库，邮件服务器）
4. 使用composer安装依赖（composer install） [[如何安装并设置composer？](https://pkg.phpcomposer.com/)]
5. [可选]如果需要修改样式代码并使用gulp前端自动化工具编译，需要运行yarn install，修改代码后使用gulp编译文件 [[如何安装yarn](http://yarnpkg.top/)]
6. 运行数据库迁移（php artisan migrate）
7. 生成密钥（php artisan key:generate）

## 表情资源

贴吧表情： http://static.tieba.baidu.com/tb/editor/images/client/image_emoticon（数字1到50）.png

微博表情： http://yuncode.net/code/c_524ba520e58ce30； https://api.weibo.com/2/emotions.json?source=1362404091
