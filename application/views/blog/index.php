<link href="/public/styles/posts.css" rel="stylesheet">
<div class="wrapper">
    <h2><?php echo $title; ?></h2>
    <h1>Parallax Flipping Cards</h1>
    <?php if (empty($list)): ?>
        <p>История пуста</p>
    <?php else: ?>
    <div class="posts">
        <?php foreach ($list as $val): ?>
            <div class="post" ontouchstart="this.classList.toggle('hover');">
                <div class="container">
                    <div class="front" style="background-image: url(<?php echo $val['posts_image']; ?>)">
                        <div class="inner">
                            <p><?= $val['posts_title']; ?></p>
                            <span><?= $val['posts_long_title']; ?></span>
                        </div>
                    </div>
                    <div class="back">
                        <div class="inner">
                            <p><?= $val['posts_description']; ?></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="detail" id="detail-1">
                <div class="close"></div>
                <div class="header">
                    <div class="post_text">
                        <h5 class="text_post_title"><?= $val['posts_title']; ?></h5>
                        <h6 class="text_post_main"><?= $val['posts_text']; ?></h6>
                    </div>
                </div>
                <div class="image">
                    <img src="<?= $val['posts_image']; ?>"/>
                </div>
                <div class="infos">
                    <div class="action">
                        <div class="btn active">
                            <span class="far fa-thumbs-up fa-lg <?php if() ?>"><?= $val['likes'] ?></span>
                        </div>
                        <div class="btn passive">
                            <span class="far fa-thumbs-down fa-lg"></span>
                        </div>
                        <div class="btn comment">
                            <span class="far fa-comments fa-lg"></span>
                        </div>
                        <h6 class="auth"><b>Автор: </b> <?= $val['accounts_FIO']; ?></h6>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
        <?php echo $pagination; ?>
        <?php endif; ?>
    </div>


</div>
