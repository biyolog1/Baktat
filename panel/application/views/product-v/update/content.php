<div class="row">
    <div class="col-md-12">
        <h4 class="m-b-lg">
            <?php echo "<span class='text-danger'> <b><i>$item->title </i></i></b></span> Başlıklı Ürünü Düzenliyorsunuz" ; ?>
        </h4>
    </div><!-- END column -->
    <div class="col-md-12">
        <div class="widget">

            <div class="widget-body">

                <form action="<?php echo base_url("Product/update/$item->id"); ?>" method="post">
                    <div class="form-group">
                        <label >Başlık</label>
                        <input  class="form-control" placeholder="Ürün Adı" name="title" value="<?php echo $item->title; ?>">
                        <?php if(isset($form_error)){ ?>

                            <small class="pull-right input-form-error"> <?php echo form_error("title"); ?></small>
                        <?php }?>
                    </div>
                    <div class="form-group">
                        <label >Başlık İngilizce</label>
                        <input  class="form-control" placeholder="Ürün Adı İngilizce" name="titleEn" value="<?php echo $item->titleEn; ?>">
                        <?php if(isset($form_error)){ ?>

                            <small class="pull-right input-form-error"> <?php echo form_error("titleEn"); ?></small>
                        <?php }?>
                    </div>
                    <div class="form-group">
                        <label >Başlık Fransızca</label>
                        <input  class="form-control" placeholder="Ürün Adı Fransızca" name="titleFr" value="<?php echo $item->titleFr; ?>">
                        <?php if(isset($form_error)){ ?>

                            <small class="pull-right input-form-error"> <?php echo form_error("titleFr"); ?></small>
                        <?php }?>
                    </div>
                    <div class="form-group">
                        <label >Başlık Almanca</label>
                        <input  class="form-control" placeholder="Ürün Adı Almanca" name="titleDe" value="<?php echo $item->titleDe; ?>">
                        <?php if(isset($form_error)){ ?>

                            <small class="pull-right input-form-error"> <?php echo form_error("titleDe"); ?></small>
                        <?php }?>
                    </div>
                    <div class="form-group">
                        <label >Barkod</label>
                        <input  class="form-control" placeholder="Barkod" name="barcode" value="<?php echo $item->barcode; ?>">
                        <?php if(isset($form_error)){ ?>

                            <small class="pull-right input-form-error"> <?php echo form_error("barcode"); ?></small>
                        <?php }?>
                    </div>
                    <div class="form-group">
                        <label >Ürün İçeriği</label>
                        <textarea name="content" class="m-0" data-plugin="summernote" data-options="{height: 250}">
                            <?php echo $item->content; ?>
                        </textarea>
                    </div>
                    <div class="form-group">
                        <label >Ürün İçeriği İngilizce</label>
                        <textarea name="contentEn" class="m-0" data-plugin="summernote" data-options="{height: 250}">
                            <?php echo $item->contentEn; ?>
                        </textarea>
                    </div>
                    <div class="form-group">
                        <label >Ürün İçeriği Fransızca</label>
                        <textarea name="contentFr" class="m-0" data-plugin="summernote" data-options="{height: 250}">
                            <?php echo $item->contentFr; ?>
                        </textarea>
                    </div>
                    <div class="form-group">
                        <label >Ürün İçeriği Almanca</label>
                        <textarea name="contentDe" class="m-0" data-plugin="summernote" data-options="{height: 250}">
                            <?php echo $item->contentDe; ?>
                        </textarea>
                    </div>
                    <div class="form-group">
                        <label >Açıklama</label>
                        <textarea name="description" class="m-0" data-plugin="summernote" data-options="{height: 250}">
                            <?php echo $item->description; ?>
                        </textarea>
                    </div>
                    <div class="form-group">
                        <label >Açıklama İngilizce</label>
                        <textarea name="descriptionEn" class="m-0" data-plugin="summernote" data-options="{height: 250}">
                            <?php echo $item->descriptionEn; ?>
                        </textarea>
                    </div>
                    <div class="form-group">
                        <label >Açıklama Fransızca</label>
                        <textarea name="descriptionFr" class="m-0" data-plugin="summernote" data-options="{height: 250}">
                            <?php echo $item->descriptionFr; ?>
                        </textarea>
                    </div>
                    <div class="form-group">
                        <label >Açıklama Almanca</label>
                        <textarea name="descriptionDe" class="m-0" data-plugin="summernote" data-options="{height: 250}">
                            <?php echo $item->descriptionDe; ?>
                        </textarea>
                    </div>


                    <button type="submit" class="btn btn-primary btn-md btn-outline"> Güncelle </button>
                    <a href="<?php echo base_url("Product"); ?>" class="btn btn-md btn-danger btn-outline"> İptal </a>
                </form>
            </div><!-- .widget-body -->
        </div><!-- .widget -->
    </div><!-- END column -->
</div>