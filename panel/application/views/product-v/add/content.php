<div class="row">
    <div class="col-md-12">
        <h4 class="m-b-lg">
            Yeni Ürün Ekle
        </h4>
    </div><!-- END column -->
    <div class="col-md-12">
        <div class="widget">

            <div class="widget-body">

                <form action="<?php echo base_url("Product/save"); ?>" method="post">
                    <div class="form-group">
                        <label >Başlık</label>
                        <input  class="form-control" placeholder="Ürün Adı" name="title">
                        <?php if(isset($form_error)){ ?>

                            <small class="pull-right input-form-error"> <?php echo form_error("title"); ?></small>
                        <?php }?>
                    </div>
                    <div class="form-group">
                        <label >Barkodu</label>
                        <input  class="form-control" placeholder="Barkodu" name="barcode">
                        <?php if(isset($form_error)){ ?>

                            <small class="pull-right input-form-error"> <?php echo form_error("barcode"); ?></small>
                        <?php }?>
                    </div>
                    <div class="form-group">
                        <label >Açıklama</label>
                        <textarea name="description" class="m-0" data-plugin="summernote" data-options="{height: 250}"></textarea>
                    </div>
                    <div class="form-group">
                        <label >Ürün İçeriği</label>
                        <textarea name="content" class="m-0" data-plugin="summernote" data-options="{height: 250}"></textarea>
                    </div>


                    <button type="submit" class="btn btn-primary btn-md btn-outline"> Kaydet </button>
                    <a href="<?php echo base_url("Product"); ?>" class="btn btn-md btn-danger btn-outline"> İptal </a>
                </form>
            </div><!-- .widget-body -->
        </div><!-- .widget -->
    </div><!-- END column -->
</div>