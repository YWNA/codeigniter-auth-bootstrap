<div class="row">
    <div class="alert"></div>
</div>
<div class="row">
    <div class="col-xs-2"></div>
    <div class="col-xs-8">
        <form action="" method="post" class="form-horizontal">
            <p class="bg-info text-center"><h2>商家注册<small>微播系统</small></h2></p>
            <hr>
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">用户名</label>
                <div class="col-sm-10">
                    <input type="string" required class="form-control" name="username" placeholder="用户名">
                </div>
            </div>
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">公司名称</label>
                <div class="col-sm-10">
                    <input type="string" required class="form-control" name="name" placeholder="公司名称">
                </div>
            </div>
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">公司类别</label>
                <div class="col-sm-10">
                    <input type="string" required class="form-control" name="type" placeholder="公司类别">
                </div>
            </div>
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">公司名称缩写</label>
                <div class="col-sm-10">
                    <input type="string" required class="form-control" maxlength="4" name="abbreviation" placeholder="公司名称缩写，只能填写四个字">
                </div>
            </div>
            <div class="form-group">
                <label for="inputPassword3" required class="col-sm-2 control-label">密码</label>
                <div class="col-sm-10">
                    <input type="password" class="form-control" minlength="6" name="password1" placeholder="请输入密码">
                </div>
            </div>
            <div class="form-group">
                <label for="inputPassword3" class="col-sm-2 control-label">确认密码</label>
                <div class="col-sm-10">
                    <input type="password" required class="form-control" minlength="6" name="password2" placeholder="请再次输入密码">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-5 col-sm-3">
                    <button type="submit" class="btn btn-info btn-block">注册</button>
                </div>
            </div>
        </form>
    </div>
</div>