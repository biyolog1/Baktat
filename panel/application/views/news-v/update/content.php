<div class="row">
    <div class="col-md-12">
        <h4 class="m-b-lg">
            <?php echo "<span class='text-danger'> <b><i>$item->title </i></i></b></span> Başlıklı Haberi Düzenliyorsunuz"; ?>

        </h4>
    </div><!-- END column -->
    <div class="col-md-12">
        <div class="widget">

            <div class="widget-body">

                <form action="<?php echo base_url("News/update/$item->id"); ?>" method="post"
                      enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Başlık</label>
                        <input class="form-control" placeholder="Başlık" name="title"
                               value="<?php echo $item->title; ?>">
                        <?php if (isset($form_error)) { ?>

                            <small class="pull-right input-form-error"> <?php echo form_error("title"); ?></small>
                        <?php } ?>
                    </div><!-- .form-group -->

                    <div class="form-group">
                        <label>Haber Türü</label>
                        <div>
                            <?php if (isset($form_error)) { ?>

                                <select class="form-control news_type_select" name="news_type">
                                    <option <?php echo ($news_type == "image") ? "selected" : ""; ?> value="image">
                                        Resim
                                    </option>
                                    <option <?php echo ($news_type == "video") ? "selected" : ""; ?> value="video">
                                        Video
                                    </option>
                                </select>

                            <?php } else { ?>
                                <select class="form-control news_type_select" name="news_type">
                                    <option <?php echo ($item->news_type == "image") ? "selected" : ""; ?>
                                            value="image">Resim
                                    </option>
                                    <option <?php echo ($item->news_type == "video") ? "selected" : ""; ?>
                                            value="video">Video
                                    </option>
                                </select>

                            <?php } ?>

                        </div>
                    </div><!-- .form-group -->

                    <?php if (isset($form_error)) { ?>

                        <div class="form-group image_upload_container"
                             style="display: <?php echo ($news_type == "image") ? "block" : "none"; ?>">
                            <label>Görsel Seçiniz</label>
                            <input type="file" name="img_url" class="form-control">
                        </div><!-- .form-group -->

                        <div class="form-group video_url_container"
                             style="display: <?php echo ($news_type == "video") ? "block" : "none"; ?>">
                            <label>Video Url (Sadece You Tube)</label>
                            <input class="form-control" placeholder="Video Bağlantı Adresini Buraya Yazınız."
                                   name="video_url">
                            <small class="input-form-info"> Örnek: https://www.youtube.com/watch?v=9H3P2hZke3I
                                linkindeki watch?v= kısmından sonraki alanı kopyalayıp yapıştırın. Bu örnekte
                                9H3P2hZke3I
                            </small>
                            <?php if (isset($form_error)) { ?>

                                <small class="pull-right input-form-error"> <?php echo form_error("video_url"); ?></small>
                            <?php } ?>
                        </div><!-- .form-group -->

                    <?php } else { ?>

                        <div class="row">
                            <div class="col-md-1 image_upload_container">
                                <img src="<?php echo base_url("uploads/$viewFolder/$item->img_url"); ?>" alt="" class="img-responsive">
                            </div>
                            <div class="col-md-9 form-group image_upload_container"
                                 style="display: <?php echo ($item->news_type == "image") ? "block" : "none"; ?>">
                                <label>Görsel Seçiniz</label>
                                <input type="file" name="img_url" class="form-control">
                            </div><!-- .form-group -->
                        </div>

                        <div class="form-group video_url_container"
                             style="display: <?php echo ($item->news_type == "video") ? "block" : "none"; ?>">
                            <label>Video Url (Sadece You Tube)</label>
                            <input class="form-control" placeholder="Video Bağlantı Adresini Buraya Yazınız."
                                   name="video_url" value="<?php echo $item->video_url; ?>">
                            <small class="input-form-error"> Örnek: https://www.youtube.com/watch?v=9H3P2hZke3I
                                linkindeki watch?v= kısmından sonraki alanı kopyalayıp yapıştırın. Bu örnekte
                                9H3P2hZke3I
                            </small>
                        </div><!-- .form-group -->

                    <?php } ?>


                    <div class="form-group">
                        <label>Açıklama</label>
                        <textarea name="description" class="m-0" data-plugin="summernote"
                                  data-options="{height: 250}"> <?php echo $item->description; ?></textarea>
                    </div><!-- .form-group -->

                    <button type="submit" class="btn btn-primary btn-md btn-outline"> Güncelle</button>
                    <a href="<?php echo base_url("News"); ?>" class="btn btn-md btn-danger btn-outline"> İptal </a>
                </form>
            </div><!-- .widget-body -->
        </div><!-- .widget -->
    </div><!-- END column -->
</div>