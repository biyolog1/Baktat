<?php if (empty($items)) { ?>
    <div class="alert alert-danger text-center">
        <!-- <h5 class="alert-title">Kayıt Bulunamadı</h5> -->
        <p>Burada herhangi bir medya dosyası bulunmuyor. </p>
    </div>
<?php } else { ?>
    <table class="table table-bordered table-striped table-hover pictures_list">
        <thead>
        <th class="order"><i class="fa fa-reorder"></i></th>
        <th class="w50">#id</th>
        <th>Görsel</th>
        <th>Medya Klasör Yolu</th>
        <th>Durumu</th>
        <th>İşlem</th>
        </thead>
        <tbody class="sortable" data-url="<?php echo base_url("Galleries/fileRankSetter/$gallery_type"); ?>">
        <?php foreach ($items as $item) { ?>
            <tr id="ord-<?php echo $item->id; ?>">
                <td class="order"><i class="fa fa-reorder"></i></td>
                <td class="w50 text-center"><?php echo $item->id; ?></td>
                <td class="w150 ortala">
                    <?php if ($gallery_type == "image") { ?>

                        <img width=100"
                             src="<?php echo base_url("$item->url"); ?>"
                             alt="<?php echo $item->url; ?>" class="img-responsive">

                    <?php } else if ($gallery_type == "file") { ?>

                        <?php if (strstr($item->url, ".") == ".doc") { ?>
                            <img width=75" src="<?php echo base_url("assets"); ?>/images/doc.png"
                                 class="img-responsive">

                        <?php } else if (strstr($item->url, ".") == ".docx") { ?>
                            <img width=75" src="<?php echo base_url("assets"); ?>/images/docx.png"
                                 class="img-responsive">

                        <?php } else if (strstr($item->url, ".") == ".pdf") { ?>
                            <img width=75" src="<?php echo base_url("assets"); ?>/images/pdf.png"
                                 class="img-responsive">

                        <?php } else if (strstr($item->url, ".") == ".xls") { ?>
                            <img width=75" src="<?php echo base_url("assets"); ?>/images/xls.png"
                                 class="img-responsive">

                        <?php } else if (strstr($item->url, ".") == ".xlsx") { ?>
                            <img width=75" src="<?php echo base_url("assets"); ?>/images/xlsx.jpg"
                                 class="img-responsive">

                        <?php } else if (strstr($item->url, ".") == ".rar") { ?>
                            <img width=75" src="<?php echo base_url("assets"); ?>/images/rar.png"
                                 class="img-responsive">

                        <?php } else if (strstr($item->url, ".") == ".zip") { ?>
                            <img width=75" src="<?php echo base_url("assets"); ?>/images/zip.png"
                                 class="img-responsive">
                        <?php } ?>
                    <?php } ?>
                </td>
                <td><?php echo $item->url; ?></td>
                <td class="w100 text-center">
                    <input
                            data-url="<?php echo base_url("Galleries/fileIsActiveSetter/$item->id/$gallery_type"); ?>"
                            class="isActive"
                            type="checkbox"
                            data-switchery
                            data-color="#10c469"
                        <?php echo ($item->isActive) ? "checked" : ""; ?>
                    />
                </td>

                <td class="w100 text-center">
                    <button
                            data-url="<?php echo base_url("Galleries/fileDelete/$item->id/$item->gallery_id/$gallery_type"); ?>"
                            class="btn btn-sm btn-danger btn-outline btn-block remove-btn">
                        <i class="fa fa-trash"></i> Sil
                    </button>
                </td>
            </tr>
        <?php } ?>

        </tbody>
    </table>
<?php } ?>