<div class="row">
    <div class="alert"></div>
</div>
<div class="row">
    <div class="col-xs-2"></div>
    <div class="col-xs-8">
        <div class="page-header">
          <h1>添加推广<small></small></h1>
        </div>
        <form action="" method="post" class="form-horizontal">
            <div class="form-group">
                <label for="" class="col-sm-2 control-label">图片</label>
                <?php if (!empty($ret['id'])){ ?>
                    <div class="col-sm-2">
                        <input type="hidden" name="id" value="<?php echo $ret['id']; ?>">
                        <input id="spread_img_input" type="hidden" name="img" value="<?php echo $ret['img']; ?>" required>
                        <img id="spread_img" src="<?php echo $ret['img']; ?>" width="100" height="auto">
                    </div>
                <?php } ?>
                <div class="col-sm-5">
                    <!--dom结构部分-->
                    <!-- <input type="fi'le" required> -->
                    <div id="uploader-demo">
                        <!--用来存放item-->
                        <div id="fileList" class="uploader-list"></div>
                        <?php if (!empty($ret['id'])){ ?>
                            <div id="filePicker">编辑图片</div>
                        <?php } else { ?>
                            <div id="filePicker">选择图片</div>
                        <?php } ?>
                    </div>
                </div>

            </div>
            <div class="form-group">
                <label for="" class="col-sm-2 control-label">标题</label>
                <div class="col-sm-10">
                    <input type="text" onfocus="a()" name="title" required value="<?php echo isset($ret['title']) ? $ret['title'] : ''; ?>" class="form-control" placeholder="标题">
                </div>
            </div>
            <div class="form-group">
                <label for="" class="col-sm-2 control-label">链接地址</label>
                <div class="col-sm-10">
                    <input type="text" onfocus="a()" name="link" required value="<?php echo isset($ret['link']) ? $ret['link'] : ''; ?>" class="form-control" placeholder="链接地址">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-info">确定</button>
                    <!-- <button type="reset" class="btn btn-default">取消</button> -->
                    <a href="/home" class="btn btn-primary">返回</a>
                </div>
            </div>
        </form>
    </div>
</div>
<style type="text/css">
.footer{
    position: fixed;
    bottom:0;
}
</style>
<script>
    BASE_URL = '/public/plugins/webuploader/dist'
    // 图片上传demo
    jQuery(function() {
        var $ = jQuery,
            $list = $('#fileList'),
            // 优化retina, 在retina下这个值是2
            ratio = window.devicePixelRatio || 1,

            // 缩略图大小
            thumbnailWidth = 100 * ratio,
            thumbnailHeight = 100 * ratio,

            // Web Uploader实例
            uploader;


        // 初始化Web Uploader
        uploader = WebUploader.create({

            // 自动上传。
            auto: true,

            // swf文件路径
            swf: BASE_URL + '/Uploader.swf',

            // 文件接收服务端。
            server: '/home/fileupload',

            // 选择文件的按钮。可选。
            // 内部根据当前运行是创建，可能是input元素，也可能是flash.
            pick: '#filePicker',

            // 只允许选择文件，可选。
            accept: {
                title: 'Images',
                extensions: 'gif,jpg,jpeg,bmp,png',
                mimeTypes: 'image/*'
            }
        });

        // 当有文件添加进来的时候
        uploader.on( 'fileQueued', function( file ) {
            var $li = $(
                    '<div id="' + file.id + '" class="file-item thumbnail">' +
                    '<img>' +
                    '<div class="info">' + file.name + '</div>' +
                    '</div>'
                ),
                $img = $li.find('img');

            $list.append( $li );

            // 创建缩略图
            uploader.makeThumb( file, function( error, src ) {
                if ( error ) {
                    $img.replaceWith('<span>不能预览</span>');
                    return;
                }

                $img.attr( 'src', src );
            }, thumbnailWidth, thumbnailHeight );
        });

        // 文件上传过程中创建进度条实时显示。
        uploader.on( 'uploadProgress', function( file, percentage ) {
            var $li = $( '#'+file.id ),
                $percent = $li.find('.progress span');

            // 避免重复创建
            if ( !$percent.length ) {
                $percent = $('<p class="progress"><span></span></p>')
                    .appendTo( $li )
                    .find('span');
            }

            $percent.css( 'width', percentage * 100 + '%' );
        });

        // 文件上传成功，给item添加成功class, 用样式标记上传成功。
        uploader.on( 'uploadSuccess', function( file ) {
            $( '#'+file.id ).addClass('upload-state-done');
        });

        // 文件上传失败，现实上传出错。
        uploader.on( 'uploadError', function( file ) {
            var $li = $( '#'+file.id ),
                $error = $li.find('div.error');

            // 避免重复创建
            if ( !$error.length ) {
                $error = $('<div class="error"></div>').appendTo( $li );
            }

            $error.text('上传失败');
        });

        // 完成上传完了，成功或者失败，先删除进度条。
        uploader.on( 'uploadComplete', function( file ) {
            $( '#'+file.id ).find('.progress').remove();
        });
        uploader.on( 'uploadAccept', function( object, ret ) {
            if (ret.ret){
                var input = '<input name="img" type="hidden" value="'+ret.url+'">';
                $('form').append(input);
                $('#filePicker').hide();
                $('#spread_img').hide();
                $('#spread_img_input').hide();
            }
        });

    });
function a () {
    $('input[type="file"]').attr('required', 'required')
}
</script>