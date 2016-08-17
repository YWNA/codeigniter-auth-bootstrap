<div class="row">
    <div class="alert"></div>
</div>
<div class="row">
    <div class="col-xs-3">
        <img src="/public/images/icon_small.png" alt="logo">
    </div>
    <div class="col-xs-6"></div>
    <div class="col-xs-3">
        <p class="text-right">
            <h4>公司编号：<small><?php echo $_SESSION['guid']; ?></small>&nbsp;&nbsp;<a href="/welcome/logout" class="btn btn-warning">退出</a></h4>
        </p>
    </div>
</div>
<hr>
<div class="container">
    <div class="row">
        <div class="jumbotron">
            <h1><?php echo $_SESSION['name']; ?></h1>
            <p>公司缩写：<?php echo $_SESSION['abbreviation']; ?></p>
        </div>
    </div>
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-body text-center h2">当天传播总人数：0</div>
        </div>
    </div>
    <div class="row" style="border: 1px solid #000000;border-radius: 5px;">
        <h2>置顶海报</h2>
        <hr>
        <a name="poster"></a>
        <?php $uguid = $_SESSION['guid']; $tmp = array($uguid. 'QEW', $uguid. 'ASD', $uguid. 'ZXC', $uguid. 'RTY'); if($poster) { foreach ($poster as $key => $value){ ?>
        <div class="col-xs-6">
            <div class="panel panel-default" style="padding:15px">
                <!-- <div class="panel-body text-center">当天传播总人数：0</div> -->
                <div class="media">
                    <div class="media-left">
                        <img with="100" height="100" class="media-object" src="<?php echo $value['img']; ?>" alt="...">
                    </div>
                    <div class="media-body">
                        <!-- <h4 class="media-heading">Media heading</h4> -->
                        <dl class="dl-horizontal">
                            <dt>编号</dt>
                            <dd><?php echo $value['guid']; ?></dd>
                            <dt>累计传播人数</dt>
                            <dd><?php echo $value['propagation']; ?></dd>
                            <dt>阅读量</dt>
                            <dd><?php echo $value['read_nums']; ?></dd>
                            <dt>在线时间</dt>
                            <dd><?php echo $value['create_time']; ?></dd>
                            <dt>创建时间</dt>
                            <dd><?php echo $value['create_time']; ?></dd>
                        </dl>
                        <div class="pull-right">
                            <div class="btn-group" role="group" aria-label="...">
                                <?php if($value['status'] === '0'){ ?>
                                    <a href="/home/status/<?php echo $value['id'] . '/1'; ?>" type="button" onclick="return cons('发布后该海报将不能被编辑。')" class="btn btn-success">发布</a>
                                <?php } ?>
                                <?php if($value['status'] === '0'){ ?>
                                    <a href="/home/poster/0/<?php echo $value['id']; ?>" type="button" class="btn btn-info">编辑</a>
                                <?php } ?>
                                <?php if($value['status'] === '2'){ ?>
                                    <a href="/home/status/<?php echo $value['id'] . '/3'; ?>" type="button" class="btn btn-success">暂停</a>
                                <?php } ?>
                                <?php if($value['status'] === '1' || $value['status'] === '3'){ ?>
                                    <a href="/home/status/<?php echo $value['id'] . '/2'; ?>" type="button" class="btn btn-success">开启</a>
                                <?php } ?>
                                <a href="/home/delete/<?php echo $value['id']; ?>" type="button" onclick="return cons('请确认是否要删除该海报？')" class="btn btn-danger">删除</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php if (in_array($value['guid'], $tmp)) { unset($tmp[array_search($value['guid'], $tmp)]);} } if($key < 3) {  ?>
            <div class="col-xs-6">
                <a href="/home/poster/<?php echo current($tmp); ?>/0" style="height: 186px;line-height: 186px" class="btn btn-info btn-lg btn-block">
                    <span class="h1">添加海报</span>
                </a>
            </div>
        <?php  } } else { ?>
            <div class="col-xs-6">
                <a href="/home/poster/<?php echo current($tmp); ?>/0" style="height: 186px;line-height: 186px" class="btn btn-info btn-lg btn-block">
                    <span class="h1">添加海报</span>
                </a>
            </div>
        <?php } ?>


    </div>
    <hr>
    <p class="text-right"><a class="btn btn-success" href="/home/poster_link">海报链接跳转地址配置</a></p>
    <hr>
    <!-- 推广信息 -->
    <div class="row" style="border: 1px solid #000000;border-radius: 5px;">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>编号</th>
                    <th>图片</th>
                    <th>标题</th>
                    <th>累计传播人数</th>
                    <th>阅读量</th>
                    <th>链接地址</th>
                    <th>在线时间</th>
                    <th>创建时间</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                    <?php if($spread) foreach ($spread as $key => $value){ ?>
                        <tr>
                        <th scope="row"><?php echo $value['guid']; ?></th>
                            <td>
                                <img width="60" src="<?php echo $value['img']; ?>" class="img-thumbnail">
                            </td>
                            <td class="col-xs-3"><?php echo $value['title']; ?></td>
                            <td><?php echo $value['propagation']; ?></td>
                            <td><?php echo $value['read_nums']; ?></td>
                            <td><?php echo $value['link']; ?></td>
                            <td><?php echo $value['online_time']; ?></td>
                            <td><?php echo $value['create_time']; ?></td>
                            <td>
                                <a name="spread"></a>
                                <div class="btn-group btn-group-sm" role="group" aria-label="...">
                                    <?php if($value['status'] === '0'){ ?>
                                        <a href="/home/spread_status/<?php echo $value['id'] . '/1/#spread'; ?>" type="button" onclick="return cons('发布后该推广信息将不能被编辑。 ')" class="btn btn-success">发布</a>
                                    <?php } ?>
                                    <a href="/home/spread_show/<?php echo $value['id']; ?>" target="_blank" type="button" class="btn btn-primary">预览</a>
                                    <?php if($value['status'] === '0'){ ?>
                                        <a href="/home/spread/<?php echo $value['id']; ?>" type="button" class="btn btn-info">编辑</a>
                                    <?php } ?>
                                    <?php if($value['status'] === '2'){ ?>
                                        <a href="/home/spread_status/<?php echo $value['id'] . '/3/#spread'; ?>" type="button" class="btn btn-success">暂停</a>
                                    <?php } ?>
                                    <?php if($value['status'] === '1' || $value['status'] === '3'){ ?>
                                        <a href="/home/spread_status/<?php echo $value['id'] . '/2/#spread'; ?>" type="button" class="btn btn-success">开启</a>
                                    <?php } ?>
                                    <a href="/home/spread_delete/<?php echo $value['id']; ?>" type="button" onclick="return cons('请确认是否要删除该推广信息？')" class="btn btn-danger">删除</a>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
            </tbody>
        </table>
        <hr>
        <p class="text-right" style="margin-right: 15px"><a class="btn btn-success" href="/home/spread">添加推广</a></p>
    </div>
</div>
<div class="row">
    <div class="alert">
        <!-- <p class="text-center">saebo.cc</p> -->
    </div>
</div>
<script>
    function cons(info){
        if(!confirm(info)) return false;
    }
</script>