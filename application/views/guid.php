<div class="row">
    <div class="alert"></div>
</div>
<div class="row">
    <div class="col-xs-4"></div>
    <div class="col-xs-4">
        <img src="<?php echo $poster['img'];?>" width="150" alt="海报图片">
    </div>
</div>
<hr>
<?php foreach ($spread as $key=> $value){ ?>
<div class="row">
    <div class="col-xs-4"></div>
    <div class="col-xs-4">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="media">
                    <div class="media-left">
                        <a href="#">
                            <img class="media-object" src="<?php echo $value['img'] ?>" width="100" alt="...">
                        </a>
                    </div>
                    <div class="media-body">
                        <p>
                            <?php echo $value['title'] ?>
                        </p>
                    </div>
                </div>
                <p class="text-right"><mark>广告</mark></p>
            </div>
        </div>
    </div>
</div>
<?php } ?>
<hr>
