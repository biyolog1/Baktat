<div class="row">
    <div class="col-md-12">
        <h4 class="m-b-lg">
            Yeni Video Ekle
        </h4>
    </div><!-- END column -->
    <div class="col-md-12">
        <div class="widget">

            <div class="widget-body">

                <form action="<?php echo base_url("Galleries/gallery_video_save/$gallery_id"); ?>" method="post">


                        <div class="form-group">
                            <label >Video Url (Sadece You Tube)</label>
                            <input  class="form-control" placeholder="Video Bağlantı Adresini Buraya Yazınız." name="url">
                            <small class="input-form-info"> Örnek: https://www.youtube.com/watch?v=9H3P2hZke3I    linkindeki watch?v= kısmından sonraki alanı kopyalayıp yapıştırın. Bu örnekte 9H3P2hZke3I  </small>
                            <?php if(isset($form_error)){ ?>

                                <small class="pull-right input-form-error"> <?php echo form_error("url"); ?></small>
                            <?php }?>
                        </div><!-- .form-group -->


                    <button type="submit" class="btn btn-primary btn-md "> Kaydet </button>
                    <a href="<?php echo base_url("Galleries/gallery_video_list/$gallery_id"); ?>" class="btn btn-md btn-danger "> İptal </a>
                </form>
            </div><!-- .widget-body -->
        </div><!-- .widget -->
    </div><!-- END column -->
</div>