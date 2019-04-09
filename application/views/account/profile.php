<div class="container">
    <h1 class="mt-4 mb-3"><?php echo $title; ?></h1>
    <div class="row">
        <div class="col-lg-8 mb-4">
            <form action="/account/profile" method="post" enctype="multipart/form-data">
                <div class="b_user_image">
                    <div id="btn">
                    <?php if(empty($user['image'])):?>
                    <label class="user_image_label" for='file' id="output"><i class="far fa-user-circle fa-9x"></i><i class="far fa-edit fa-4x"></i></label>
                        <?php else: ?>
                    <label class="user_image_label" for='file' id="output"><i class="fas fa-pen-fancy fa-4x"></i><img class="user-image" src="<?= $user['image'] ?>" alt=""></label>
                        <?php endif; ?>
                    </div>
                    <input type="file" style="visibility:hidden;" id="file" name="image" />
                </div>
                <div class="control-group form-group">
                    <div class="controls">
                        <label>Логин:</label>
                        <input type="text" class="form-control" value="<?php echo $_SESSION['account']['login']; ?>"
                               disabled>
                        <p class="help-block"></p>
                    </div>
                </div>
                <div class="control-group form-group">
                    <div class="controls">
                        <label>E-mail:</label>
                        <input type="text" class="form-control" value="<?php echo $_SESSION['account']['email']; ?>"
                               name="email">
                    </div>
                </div>
                <div class="control-group form-group">
                    <div class="controls">
                        <label>Новый пароль для входа:</label>
                        <input type="password" class="form-control" name="password">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Сохранить</button>
            </form>
        </div>
    </div>
</div>

