<hr style="border:1 dashed #EEEEEE" color="#EEEEEE">
<div style="width:100%;">
    <p style="text-align:left;font-size:15px;">精选阅读</p>
</div>
<ul class="article-feed-ul">
    <?php foreach ($spread as $key=> $value){ ?>
    <li>
        <a href="/welcome/redirect?url=<?php echo urlencode(base64_encode($value['link'])) . '&id=' . $value['id']; ?>" target="_blank" onclick="">
            <div class="article-md-img-box">
                <img src="<?php echo $value['img'] ?>">
            </div>
            <div class="article-info-box">
                <div class="article-md-title">
                    <?php echo $value['title'] ?>
                </div>
            </div>
            <div class="mod-hot">广告</div>
        </a>
    </li>
    <?php } ?>
</ul>
<hr>
