<div role="tabpanel" class="tab-pane fade" id="tab-3">
    <div class="row">
        <div class="form-group col-md-12">
            <label>Misyon</label>
            <textarea name="mission" class="m-0" data-plugin="summernote"
                      data-options="{height: 350}"><?php echo isset($form_error) ? set_value("mission") : $item->mission; ?></textarea>
        </div><!-- .form-group -->
    </div>
</div><!-- .tab-pane  -->
