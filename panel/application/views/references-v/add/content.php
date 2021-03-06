<div class="row">
    <div class="col-md-12">
        <h4 class="m-b-lg">
            Yeni Referans Ekle
        </h4>
    </div><!-- END column -->
    <div class="col-md-12">
        <div class="widget">

            <div class="widget-body">

                <form action="<?php echo base_url("References/save"); ?>" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Başlık</label>
                        <input class="form-control" placeholder="Başlık" name="title">
                        <?php if (isset($form_error)) { ?>

                            <small class="pull-right input-form-error"> <?php echo form_error("title"); ?></small>
                        <?php } ?>
                    </div><!-- .form-group -->

                    <div class="form-group">
                        <label>Başlık İngilizce</label>
                        <input class="form-control" placeholder="Başlık İngilizce" name="titleEn">
                        <?php if (isset($form_error)) { ?>

                            <small class="pull-right input-form-error"> <?php echo form_error("titleEn"); ?></small>
                        <?php } ?>
                    </div><!-- .form-group -->
                    <div class="form-group">
                        <label>Başlık Fransızca</label>
                        <input class="form-control" placeholder="Başlık Fransızca" name="titleFr">
                        <?php if (isset($form_error)) { ?>

                            <small class="pull-right input-form-error"> <?php echo form_error("titleFr"); ?></small>
                        <?php } ?>
                    </div><!-- .form-group -->
                    <div class="form-group">
                        <label>Başlık Almanca</label>
                        <input class="form-control" placeholder="Başlık Almanca" name="titleDe">
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
                        <label>Açıklama İngilizce </label>
                        <textarea name="descriptionEn" class="m-0" data-plugin="summernote"
                                  data-options="{height: 250}"></textarea>
                    </div><!-- .form-group -->
                    <div class="form-group">
                        <label>Açıklama Fransızca</label>
                        <textarea name="descriptionFr" class="m-0" data-plugin="summernote"
                                  data-options="{height: 250}"></textarea>
                    </div><!-- .form-group -->
                    <div class="form-group">
                        <label>Açıklama Almanca</label>
                        <textarea name="descriptionDe" class="m-0" data-plugin="summernote"
                                  data-options="{height: 250}"></textarea>
                    </div><!-- .form-group -->

                    <button type="submit" class="btn btn-primary btn-md btn-outline"> Kaydet</button>
                    <a href="<?php echo base_url("References"); ?>" class="btn btn-md btn-danger btn-outline"> İptal </a>
                </form>
            </div><!-- .widget-body -->
        </div><!-- .widget -->
    </div><!-- END column -->
</div>