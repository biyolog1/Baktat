<div role="tabpanel" class="tab-pane fade" id="tab-5">

    <div class="row">
        <div class="form-group col-md-4">
            <label><i class="fa fa-2x fa-facebook"> Facebook</i></label>
            <input class="form-control" placeholder="Facebook Adresiniz" name="facebook"
                   value="<?php echo isset($form_error) ? set_value("facebook") : $item->facebook; ?>">
        </div><!-- .form-group -->

        <div class="form-group col-md-4">
            <label><i class="fa fa-2x fa-twitter"> Twitter</i></label>
            <input class="form-control" placeholder="Twitter Adresiniz" name="twitter"
                   value="<?php echo isset($form_error) ? set_value("twitter") : $item->twitter; ?>">
        </div><!-- .form-group -->
    </div>
    <div class="row">
        <div class="form-group col-md-4">
            <label><i class="fa fa-2x fa-instagram"> İnstagram</i></label>
            <input class="form-control" placeholder="İnstagram Adresiniz" name="instagram"
                   value="<?php echo isset($form_error) ? set_value("instagram") : $item->instagram; ?>">
        </div><!-- .form-group -->
        <div class="form-group col-md-4">
            <label><i class="fa fa-2x fa-linkedin"> LinkedIn</i></label>
            <input class="form-control" placeholder="LinkedIn Adresiniz" name="linkedin"
                   value="<?php echo isset($form_error) ? set_value("linkedin") : $item->linkedin; ?>">
        </div><!-- .form-group -->
    </div>
</div><!-- .tab-pane  -->
