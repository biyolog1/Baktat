<div class="row">
    <div class="col-md-12">
        <h4 class="m-b-lg">
            Yeni Hizmet Ekle
        </h4>
    </div><!-- END column -->
    <div class="col-md-12">
        <div class="widget">

            <div class="widget-body">

                <form action="<?php echo base_url("Services/save"); ?>" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Başlık</label>
                        <input class="form-control" placeholder="Başlık" name="title">
                        <?php if (isset($form_error)) { ?>

                            <small class="pull-right input-form-error"> <?php echo form_error("title"); ?></small>
                        <?php } ?>
                    </div><!-- .form-group -->
                    <div class="form-group">
                        <label>İngilizce Başlık</label>
                        <input class="form-control" placeholder="İngilizce Başlık" name="titleEn">
                        <?php if (isset($form_error)) { ?>

                            <small class="pull-right input-form-error"> <?php echo form_error("titleEn"); ?></small>
                        <?php } ?>
                    </div><!-- .form-group -->
                    <div class="form-group">
                        <label>Fransızca Başlık</label>
                        <input class="form-control" placeholder="Fransızca Başlık" name="titleFr">
                        <?php if (isset($form_error)) { ?>

                            <small class="pull-right input-form-error"> <?php echo form_error("titleFr"); ?></small>
                        <?php } ?>
                    </div><!-- .form-group -->
                    <div class="form-group">
                        <label>Almanca Başlık</label>
                        <input class="form-control" placeholder="Almanca Başlık" name="titleDe">
                        <?php if (isset($form_error)) { ?>

                            <small class="pull-right input-form-error"> <?php echo form_error("titleDe"); ?></small>
                        <?php } ?>
                    </div><!-- .form-group -->

                    <div class="form-group image_upload_container">
                        <label>Görsel Seçiniz</label>
                        <input type="file" name="img_url" class="form-control">
                    </div><!-- .form-group -->

                    <div class="form-group">
                        <label>Açıklama</label>
                        <textarea name="description" class="m-0" data-plugin="summernote"
                                  data-options="{height: 250}"></textarea>
                    </div><!-- .form-group -->
                    <div class="form-group">
                        <label>İngilizce Açıklama</label>
                        <textarea name="descriptionEn" class="m-0" data-plugin="summernote"
                                  data-options="{height: 250}"></textarea>
                    </div><!-- .form-group -->
                    <div class="form-group">
                        <label>Fransızca Açıklama</label>
                        <textarea name="descriptionFr" class="m-0" data-plugin="summernote"
                                  data-options="{height: 250}"></textarea>
                    </div><!-- .form-group -->
                    <div class="form-group">
                        <label>Almanca Açıklama</label>
                        <textarea name="descriptionDe" class="m-0" data-plugin="summernote"
                                  data-options="{height: 250}"></textarea>
                    </div><!-- .form-group -->

                    <button type="submit" class="btn btn-primary btn-md btn-outline"> Kaydet</button>
                    <a href="<?php echo base_url("Services"); ?>" class="btn btn-md btn-danger btn-outline"> İptal </a>
                </form>
            </div><!-- .widget-body -->
        </div><!-- .widget -->
    </div><!-- END column -->
</div>