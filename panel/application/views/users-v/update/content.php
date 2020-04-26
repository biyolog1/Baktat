<div class="row">
    <div class="col-md-12">
        <h4 class="m-b-lg">
            <?php echo "<span class='text-danger'> <b><i>$item->full_name </i></i></b></span> isimlli kullanıcıyı Düzenliyorsunuz"; ?>

        </h4>
    </div><!-- END column -->
    <div class="col-md-12">
        <div class="widget">

            <div class="widget-body">

                <form action="<?php echo base_url("Users/update/$item->id"); ?>" method="post"
                      enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Kullanıcı Adı</label>
                        <input class="form-control" placeholder="Kullanıcı Adınızı Giriniz" name="user_name" value="<?php echo isset($form_error) ? set_value("user_name") : $item->user_name ; ?>">
                        <?php if (isset($form_error)) { ?>

                            <small class="pull-right input-form-error"> <?php echo form_error("user_name"); ?></small>
                        <?php } ?>
                    </div><!-- .form-group -->

                    <div class="form-group">
                        <label>Ad Soyad</label>
                        <input class="form-control" placeholder="İsim Ve Soyisminizi giriniz" name="full_name"  value="<?php echo isset($form_error) ? set_value("full_name") : $item->full_name ; ?>">
                        <?php if (isset($form_error)) { ?>

                            <small class="pull-right input-form-error"> <?php echo form_error("full_name"); ?></small>
                        <?php } ?>
                    </div><!-- .form-group -->

                    <div class="row">
                        <div class="col-md-1 image_upload_container">
                            <img src="<?php echo base_url("uploads/$viewFolder/$item->img_url"); ?>" alt="" class="img-responsive">
                        </div>
                        <div class="col-md-9 form-group image_upload_container">
                            <label>Görsel Seçiniz</label>
                            <input type="file" name="img_url" class="form-control">
                        </div><!-- .form-group -->
                    </div>

                    <div class="form-group">
                        <label>E-Posta</label>
                        <input class="form-control" type="email" placeholder="E-Posta adresinizi Giriniz" name="email" value="<?php echo isset($form_error) ? set_value("email") : $item->email ; ?>">
                        <?php if (isset($form_error)) { ?>

                            <small class="pull-right input-form-error"> <?php echo form_error("email"); ?></small>
                        <?php } ?>
                    </div><!-- .form-group -->

                    <button type="submit" class="btn btn-primary btn-md btn-outline"> Güncelle</button>
                    <a href="<?php echo base_url("Users"); ?>" class="btn btn-md btn-danger btn-outline"> İptal </a>
                </form>
            </div><!-- .widget-body -->
        </div><!-- .widget -->
    </div><!-- END column -->
</div>