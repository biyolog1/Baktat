<div class="row">
    <div class="col-md-12">
        <h4 class="m-b-lg">
            <?php echo "<span class='text-danger'> <b><i>$item->title </i></i></b></span> Başlıklı Galeriyi Düzenliyorsunuz"; ?>
        </h4>
    </div><!-- END column -->
    <div class="col-md-12">
        <div class="widget">

            <div class="widget-body">

                <form action="<?php echo base_url("Galleries/update/$item->id/$item->gallery_type/$item->folder_name"); ?>" method="post">
                    <div class="form-group">
                        <label>Galeri Adı</label>
                        <input class="form-control" placeholder="Galeri Adını Giriniz" name="title"
                               value="<?php echo $item->title; ?>">
                        <?php if (isset($form_error)) { ?>

                            <small class="pull-right input-form-error"> <?php echo form_error("title"); ?></small>
                        <?php } ?>
                    </div>

                    <button type="submit" class="btn btn-primary btn-md btn-outline"> Güncelle</button>
                    <a href="<?php echo base_url("Galleries"); ?>" class="btn btn-md btn-danger btn-outline"> İptal </a>
                </form>
            </div><!-- .widget-body -->
        </div><!-- .widget -->
    </div><!-- END column -->
</div>