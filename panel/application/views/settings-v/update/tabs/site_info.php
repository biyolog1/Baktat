<div role="tabpanel" class="tab-pane in active fade" id="tab-1">
    <div class="row">
        <div class="form-group col-md-4">
            <label>Firma Adı <i class="fa fa-star text-danger"></i></label>
            <input class="form-control" placeholder="Firma Adını Giriniz" name="company_name"
                   value="<?php echo isset($form_error) ? set_value("company_name") : $item->company_name; ?>"
                   required>
            <?php if (isset($form_error)) { ?>
                <small class="pull-right input-form-error"> <?php echo form_error("company_name"); ?></small>
            <?php } ?>
        </div><!-- .form-group -->

        <div class="form-group col-md-3">
            <label>Firma Logosu Yükleyin <i class="fa fa-star text-danger"></i></label>
            <input type="file" name="logo" class="form-control" >
        </div><!-- .form-group -->
        <div class="col-md-2">
            <label>Mevcut Logonuz</label>
            <img src="<?php echo base_url("uploads/$viewFolder/$item->logo"); ?>" alt="<?php echo $item->company_name; ?>" class="img-responsive" width="100">
        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-4">
            <label> Email Adresi <i class="fa fa-star text-danger"></i></label>
            <input class="form-control" placeholder="Email Adresiniz" name="email"
                   value="<?php echo isset($form_error) ? set_value("email") : $item->email; ?>" required>
            <?php if (isset($form_error)) { ?>
                <small class="pull-right input-form-error"> <?php echo form_error("email"); ?></small>
            <?php } ?>
        </div><!-- .form-group -->
    </div>
    <div class="row">
        <div class="form-group col-md-4">
            <label>Telefon 1 <i class="fa fa-star text-danger"></i></label>
            <input class="form-control" placeholder="Telefon Numaranız" name="phone_1"
                   value="<?php echo isset($form_error) ? set_value("phone_1") : $item->phone_1; ?>"
                   required>
            <?php if (isset($form_error)) { ?>
                <small class="pull-right input-form-error"> <?php echo form_error("phone_1"); ?></small>
            <?php } ?>
        </div><!-- .form-group -->
        <div class="form-group col-md-4">
            <label>Telefon 2</label>
            <input class="form-control" placeholder="Diğer Telefon Numaranız (Opsiyonel)"
                   name="phone_2" value="<?php echo isset($form_error) ? set_value("phone_2") : $item->phone_2; ?>">
        </div><!-- .form-group -->
    </div>
    <div class="row">
        <div class="form-group col-md-4">
            <label>Faks 1</label>
            <input class="form-control" placeholder="Faks Numaranız" name="fax_1" value="<?php echo isset($form_error) ? set_value("fax_1") : $item->fax_1; ?>">
        </div><!-- .form-group -->
        <div class="form-group col-md-4">
            <label>Faks 2</label>
            <input class="form-control" placeholder="Diğer Faks Numaranız (Opsiyonel)"
                   name="fax_2" value="<?php echo isset($form_error) ? set_value("fax_2") : $item->fax_2; ?>">
        </div><!-- .form-group -->
    </div>
    <div class="row">
        <div class="form-group col-md-4">
            <label>Vergi Dairesi <i class="fa fa-star text-danger"></i></label>
            <input class="form-control" placeholder="Vergi Daireniz" name="vergi_dairesi"
                   value="<?php echo isset($form_error) ? set_value("vergi_dairesi") : $item->vergi_dairesi; ?>"
                   required>
            <?php if (isset($form_error)) { ?>
                <small class="pull-right input-form-error"> <?php echo form_error("vergi_dairesi"); ?></small>
            <?php } ?>
        </div><!-- .form-group -->
        <div class="form-group col-md-4">
            <label>Vergi Numarası <i class="fa fa-star text-danger"></i></label>
            <input class="form-control" placeholder="Vergi Numaranız"
                   name="vergi_no"
                   value="<?php echo isset($form_error) ? set_value("vergi_no") : $item->vergi_no; ?>"
                   required>
            <?php if (isset($form_error)) { ?>
                <small class="pull-right input-form-error"> <?php echo form_error("vergi_no"); ?></small>
            <?php } ?>
        </div><!-- .form-group -->
    </div>
    <div class="row">
        <div class="form-group col-md-8">
            <label>Adres Bilgisi</label>
            <textarea name="address" class="m-0" data-plugin="summernote"
                      data-options="{height: 150}"><?php echo isset($form_error) ? set_value("address") : $item->address; ?></textarea>
        </div><!-- .form-group -->
    </div>
</div><!-- .tab-pane  -->
