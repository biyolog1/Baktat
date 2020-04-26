<div class="row">

    <div class="col-md-12">
        <div class="widget">

            <div class="widget-body">
                <form data-url="<?php echo base_url("Galleries/refresh_file_list/$item->id/$item->gallery_type"); ?>" action="<?php echo base_url("Galleries/file_upload/$item->id/$item->gallery_type/$item->folder_name"); ?>" id="dropzone" class="dropzone"
                      data-plugin="dropzone"
                      data-options="{ url: '<?php echo base_url("Galleries/file_upload/$item->id/$item->gallery_type/$item->folder_name"); ?>'}">
                    <div class="dz-message">
                        <h3 class="m-h-lg">Dosya Yükle.</h3>
                        <p class="m-b-lg text-muted">(Dosyalarınız sürükleyip bu alana bırakabilirsiniz. Yada bu alana
                            tıklayarak yükleyebilirsiniz.)</p>
                    </div>
                </form>

            </div><!-- .widget-body -->
        </div><!-- .widget -->
    </div><!-- END column -->
</div>

<div class="row">
    <div class="col-md-12">
        <h4 class="m-b-lg">
            <b> <?php echo $item->title; ?> </b> kaydına ait Medya Dosyaları
        </h4>
    </div><!-- END column -->
    <div class="col-md-12">
        <div class="widget">

            <div class="widget-body image_list_container">
               <?php $this->load->view("{$viewFolder}/{$subViewFolder}/render_elements/file_list_v"); ?>
            </div><!-- .widget-body -->
        </div><!-- .widget -->
    </div><!-- END column -->
</div>