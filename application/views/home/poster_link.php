<div class="row">
    <div class="alert"></div>
</div>
<div class="row">
    <div class="col-xs-3"></div>
    <div class="col-xs-6">
        <div class="page-header">
          <h1>海报链接地址配置<small></small></h1>
        </div>
        <form action="" method="post">
            <input type="hidden" name="id" value="<?php echo !empty($ret['id']) ? $ret['id'] : ''; ?>">
            <div class="form-group">
                <label for="which0" class="control-label"><input onclick="enable(this)" id="which0" value="0" name="which" <?php echo ($ret['which'] === '0') ? 'checked' : ''; ?> type="radio">链接地址</label>
                <input name="link" value="<?php echo $ret['link'] ?>" <?php echo ($ret['which'] === '0') ? '' : 'disabled="disabled"'; ?> type="text" class="form-control" placeholder="链接地址">
            </div>
            <div class="form-group">
                <label for="which1" class="control-label"><input onclick="enable(this)" id="which1" value="1" name="which" <?php echo ($ret['which'] === '1') ? 'checked' : ''; ?> type="radio">公众号</label>
                <input name="weixin" value="<?php echo $ret['weixin'] ?>" <?php echo ($ret['which'] === '1') ? '' : 'disabled="disabled"'; ?> type="text" class="form-control" placeholder="公众号">
            </div>
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" class="btn btn-info">确定</button>
                    <button type="reset" class="btn btn-default">取消</button>
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
    function enable(obj){
        var type = $(obj).attr('id');
        if (type == 'which0'){
            $('#which1').parent().next().attr('disabled','disabled');
        } else {
            $('#which0').parent().next().attr('disabled','disabled');
        }
        $(obj).parent().next().removeAttr('disabled');
        console.log($(obj).attr('id'));
    }
</script>