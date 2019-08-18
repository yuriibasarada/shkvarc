<div class="container">
    <h1 class="mt-4 mb-3"><?php echo $title; ?></h1>
    <div class="row">
        <div class="col-lg-8 mb-4">
            <form action="/account/profile" method="post" enctype="multipart/form-data">
                <div class="container">
                    <div class="row">
                        <div class="col-4">
                            <div class="b_user_image">
                                <div id="btn">
                                    <?php if(empty($user['accounts_image'])):?>
                                        <label class="user_image_label" for='file' id="output"><i class="far fa-user-circle fa-9x"></i></label>
                                    <?php else: ?>
                                        <label class="user_image_label" for='file' id="output"><span>
                                            <img class="user-image" src="<?= $user['accounts_image'] ?>" alt="">
                                            <i class="fas fa-pen-fancy fa-4x" style="position: absolute"></i></span></label>
                                    <?php endif; ?>
                                </div>
                                <input type="file" style="visibility:hidden;" id="file" name="image" />
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="control-group form-group">
                                <div class="controls">
                                    <label>Логин:</label>
                                    <input type="text" class="form-control" value="<?php echo $_SESSION['account']['accounts_login']; ?>"
                                           disabled>
                                    <p class="help-block"></p>
                                </div>
                            </div>
                            <div class="control-group form-group">
                                <div class="controls">
                                    <label>Описание:</label>
                                    <input type="text" class="form-control" value="<?php echo $_SESSION['account']['accounts_description'] ?>" name="accounts_description">
                                    <p class="help-block"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="control-group form-group">
                    <div class="controls">
                        <label>E-mail:</label>
                        <input type="text" class="form-control" value="<?php echo $_SESSION['account']['accounts_email']; ?>"
                               name="accounts_email">
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

