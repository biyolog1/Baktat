<div class="row">
    <div class="col-md-12">
        <h4 class="m-b-lg">
            <?php echo "<span class='text-danger'> <b> $item->full_name  </b> </span>"; ?> isimli kullanıcının Şifresini Değiştiriyorsunuz

        </h4>
    </div><!-- END column -->
    <div class="col-md-12">
        <div class="widget">

            <div class="widget-body">

                <form action="<?php echo base_url("Users/update_password/$item->id"); ?>" method="post">

                    <div class="form-group">
                        <label>Şifre</label>
                        <input class="form-control" type="password" placeholder="Şifrenizi Giriniz" name="password">
                        <?php if (isset($form_error)) { ?>

                            <small class="pull-right input-form-error"> <?php echo form_error("password"); ?></small>
                        <?php } ?>
                    </div><!-- .form-group -->
                    <div class="form-group">
                        <label>Şifre Tekrarı</label>
                        <input class="form-control" type="password" placeholder="Şifrenizi Tekrar Giriniz"
                               name="re_password">
                        <?php if (isset($form_error)) { ?>

                            <small class="pull-right input-form-error"> <?php echo form_error("re_password"); ?></small>
                        <?php } ?>
                    </div><!-- .form-group -->

                    <button type="submit" class="btn btn-primary btn-md "> Güncelle</button>
                    <a href="<?php echo base_url("Users"); ?>" class="btn btn-md btn-danger "> İptal </a>
                </form>
            </div><!-- .widget-body -->
        </div><!-- .widget -->
    </div><!-- END column -->
</div>