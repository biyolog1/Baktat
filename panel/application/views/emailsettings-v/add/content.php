<div class="row">
    <div class="col-md-12">
        <h4 class="m-b-lg">
            Yeni Email Ekle
        </h4>
    </div><!-- END column -->
    <div class="col-md-12">
        <div class="widget">

            <div class="widget-body">
                <div class="row">
                    <div class="col-md-2">

                    </div>

                    <div class="col-md-8">
                        <form action="<?php echo base_url("Emailsettings/save"); ?>" method="post">
                            <div class="form-group">
                                <label>Email Başlık (Gönderen İsmi)</label>
                                <input class="form-control" placeholder="Email Başlık (Gönderen İsmi)" name="user_name"
                                       value="<?php echo isset($form_error) ? set_value("user_name") : ""; ?>">
                                <?php if (isset($form_error)) { ?>

                                    <small class="pull-right input-form-error"> <?php echo form_error("user_name"); ?></small>
                                <?php } ?>
                            </div><!-- .form-group -->

                            <div class="form-group">
                                <label>Protokol</label>
                                <input class="form-control" placeholder="Protokol giriniz (smtp, pop vs..)"
                                       name="protocol"
                                       value="<?php echo isset($form_error) ? set_value("protocol") : ""; ?>">
                                <?php if (isset($form_error)) { ?>

                                    <small class="pull-right input-form-error"> <?php echo form_error("protocol"); ?></small>
                                <?php } ?>
                            </div><!-- .form-group -->

                            <div class="form-group">
                                <label>Sunucu Bilgisi (host)</label>
                                <input class="form-control" placeholder="Email sunucu bilgilerini giriniz" name="host"
                                       value="<?php echo isset($form_error) ? set_value("host") : ""; ?>">
                                <?php if (isset($form_error)) { ?>

                                    <small class="pull-right input-form-error"> <?php echo form_error("host"); ?></small>
                                <?php } ?>
                            </div><!-- .form-group -->
                            <div class="form-group">
                                <label>Kimden Gönderilecek (from)</label>
                                <input class="form-control" type="email" placeholder="Email Kimden Gidecek" name="from"
                                       value="<?php echo isset($form_error) ? set_value("from") : ""; ?>">
                                <?php if (isset($form_error)) { ?>

                                    <small class="pull-right input-form-error"> <?php echo form_error("from"); ?></small>
                                <?php } ?>
                            </div><!-- .form-group -->

                            <div class="form-group">
                                <label>Kime Gönderilecek (to)</label>
                                <input class="form-control" type="email" placeholder="Email Kime Gidecek" name="to"
                                       value="<?php echo isset($form_error) ? set_value("to") : ""; ?>">
                                <?php if (isset($form_error)) { ?>

                                    <small class="pull-right input-form-error"> <?php echo form_error("to"); ?></small>
                                <?php } ?>
                            </div><!-- .form-group -->

                            <div class="form-group">
                                <label>Port Numarası</label>
                                <input class="form-control" placeholder="Portu Giriniz" name="port"
                                       value="<?php echo isset($form_error) ? set_value("port") : ""; ?>">
                                <?php if (isset($form_error)) { ?>

                                    <small class="pull-right input-form-error"> <?php echo form_error("port"); ?></small>
                                <?php } ?>
                            </div><!-- .form-group -->
                            <div class="form-group">
                                <label>Email Adresi (username)</label>
                                <input class="form-control" type="email" placeholder="Email Giriniz" name="user"
                                       value="<?php echo isset($form_error) ? set_value("user") : ""; ?>">
                                <?php if (isset($form_error)) { ?>

                                    <small class="pull-right input-form-error"> <?php echo form_error("user"); ?></small>
                                <?php } ?>
                            </div><!-- .form-group -->


                            <div class="form-group">
                                <label>Email Şifresi (user password)</label>
                                <input class="form-control" type="password" placeholder="Şifrenizi Giriniz"
                                       name="password">
                                <?php if (isset($form_error)) { ?>

                                    <small class="pull-right input-form-error"> <?php echo form_error("password"); ?></small>
                                <?php } ?>
                            </div><!-- .form-group -->
                            <button type="submit" class="btn btn-primary btn-md btn-outline"> Kaydet</button>
                            <a href="<?php echo base_url("Emailsettings"); ?>"
                               class="btn btn-md btn-danger btn-outline"> İptal </a>
                        </form>
                    </div>


                    <div class="col-md-2">

                    </div>
                </div>
            </div><!-- .widget-body -->

        </div><!-- .widget -->
    </div><!-- END column -->
</div>