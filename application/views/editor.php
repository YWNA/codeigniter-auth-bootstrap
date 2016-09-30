<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>public/simditor//site/assets/styles/simditor.css" />
<!--引入wangEditor.css-->
<link rel="stylesheet" type="text/css" href="../dist/css/wangEditor.min.css">
<div class="alert"></div>
<div class="container">
    <div class="row">
        <div class="page-header">
            <h1>Example page header <small>Subtext for header</small></h1>
        </div>
        <textarea id="editor_id" name="content" style="width:700px;height:300px;">&lt;strong&gt;HTML内容&lt;/strong&gt;</textarea>
    </div>
    <div class="row">
        <div class="page-header">
            <h1>Example page header <small>Subtext for header</small></h1>
        </div>
        <textarea id="editor" placeholder="Balabala" autofocus></textarea>
    </div>
    <div class="row">
        <div class="page-header">
            <h1>Example page header <small>Subtext for header</small></h1>
        </div>
        <!--baidu-->
        <!-- 加载编辑器的容器 -->
        <script id="container" name="content" type="text/plain"></script>
    </div>
    <div class="row">
        <div class="page-header">
            <h1>Example page header <small>Subtext for header</small></h1>
        </div>
        <!--baidu-->
        <!-- 加载编辑器的容器 -->
        <script id="container" name="content" type="text/plain"></script>
    </div>
    <textarea id="textarea1"><p>请输入内容...</p></textarea>
    <!--这里引用jquery和wangEditor.js-->
    <script type="text/javascript">
        var editor = new wangEditor('textarea1');
        editor.create();
    </script>

</div>
<!--KindEditor-->
<script charset="utf-8" src="<?php echo base_url() ?>public/kindeditor/kindeditor-all-min.js"></script>
<script charset="utf-8" src="<?php echo base_url() ?>public/kindeditor/lang/zh-CN.js"></script>
<script>
    KindEditor.ready(function(K) {
        window.editor = K.create('#editor_id');
    });
</script>
<!--simditor-->
<script type="text/javascript" src="<?php echo base_url() ?>public/simditor/site/assets/scripts/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>public/simditor/site/assets/scripts/module.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>public/simditor/site/assets/scripts/hotkeys.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>public/simditor/site/assets/scripts/uploader.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>public/simditor/site/assets/scripts/simditor.js"></script>
<script>
    var editor = new Simditor({
        textarea: $('#editor')
        //optional options
    });
</script>
<!--baidu-->
<!-- 加载编辑器的容器 -->
<script id="container" name="content" type="text/plain"></script>
<!-- 配置文件 -->
<script type="text/javascript" src="<?php echo base_url() ?>public/ueditor/ueditor.config.js"></script>
<!-- 编辑器源码文件 -->
<script type="text/javascript" src="<?php echo base_url() ?>public/ueditor/ueditor.all.js"></script>
<!-- 实例化编辑器 -->
<script type="text/javascript">
    var ue = UE.getEditor('container');
</script>
<!--wangEditor-->
<!--引入jquery和wangEditor.js-->   <!--注意：javascript必须放在body最后，否则可能会出现问题-->
<script type="text/javascript" src="../dist/js/lib/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="../dist/js/wangEditor.min.js"></script>