<div class="row">
    <div class="col-md-12">
        <h4 class="m-b-lg">
            Yeni Portfolyo Ekle
        </h4>
    </div><!-- END column -->
    <div class="col-md-12">
        <div class="widget">

            <div class="widget-body">

                <form action="<?php echo base_url("Portfolios/save"); ?>" method="post">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label >Başlık</label>
                            <input  class="form-control" placeholder="Başlık" name="title">
                            <?php if(isset($form_error)){ ?>

                                <small class="pull-right input-form-error"> <?php echo form_error("title"); ?></small>
                            <?php }?>
                        </div>
                            <div class="form-group col-md-6">
                                <label >Kategori</label>
                                <select name="category_id"  class="form-control">
                                  <?php foreach ($categories as $category){ ?>
                                      <option  value="<?php echo $category->id;  ?>"> <?php echo $category->title;  ?></option>
                                    <?php } ?>
                                </select>
                                <?php if(isset($form_error)){ ?>

                                    <small class="pull-right input-form-error"> <?php echo form_error("client"); ?></small>
                                <?php }?>
                            </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <label for="datetimepicker1">Bitirme Tarihi</label>
                            <input type="hidden" name="finishedAt" id="datetimepicker1" data-plugin="datetimepicker"
                                   data-options="{  inline: true, viewMode: 'days', format :'YYYY-MM-DD HH:mm:ss', locale: 'tr' }"/>
                        </div><!-- END column -->
                        <div class="col-md-8">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label >Müşteri- Bayi (Client)</label>
                                        <input  class="form-control" placeholder="Müşteri- Bayi" name="client">
                                        <?php if(isset($form_error)){ ?>

                                            <small class="pull-right input-form-error"> <?php echo form_error("client"); ?></small>
                                        <?php }?>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label >Bölge</label>
                                        <input  class="form-control" placeholder="Bölge" name="place">
                                        <?php if(isset($form_error)){ ?>

                                            <small class="pull-right input-form-error"> <?php echo form_error("place"); ?></small>
                                        <?php }?>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label >Yapılan İş Referans Bağlantısı (URL)</label>
                                        <input  class="form-control" placeholder="Dış sayfaya bağlantı vermek için urlyi buraya giriniz." name="portfolio_url">
                                        <?php if(isset($form_error)){ ?>

                                            <small class="pull-right input-form-error"> <?php echo form_error("portfolio_url"); ?></small>
                                        <?php }?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label >Açıklama</label>
                        <textarea name="description" class="m-0" data-plugin="summernote" data-options="{height: 150}"></textarea>
                    </div>


                    <button type="submit" class="btn btn-primary btn-md"> Kaydet </button>
                    <a href="<?php echo base_url("Portfolios"); ?>" class="btn btn-md btn-danger"> İptal </a>
                </form>
            </div><!-- .widget-body -->
        </div><!-- .widget -->
    </div><!-- END column -->
</div>