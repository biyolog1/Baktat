<div class="row">
    <div class="col-md-12">
        <h4 class="m-b-lg">
            Site Ayarları
            <a href="<?php echo base_url("Settings/new_form"); ?>" class="btn  btn-primary btn-sm pull-right">
                <i class="fa fa-plus"></i> Yeni Ekle </a>
        </h4>
    </div><!-- END column -->
    <div class="col-md-12">
        <div class="widget p-lg">
            <?php if (empty($items)) { ?>
                <div class="alert alert-info text-center  ">
                    <!-- <h5 class="alert-title">Kayıt Bulunamadı</h5> -->
                    <i class="fa fa-plus-square"> </i>
                    <p> Burada herhangi bir veri bulunmamaktadır. Eklemek için lütfen <a
                                href="<?php echo base_url("Settings/new_form"); ?>">tıklayınız.</a></p>
                </div>
            <?php }  ?>
        </div><!-- .widget -->
    </div><!-- END column -->
</div>