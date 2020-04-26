<div class="row">
    <div class="col-md-12">
        <h4 class="m-b-lg">
           <?php echo "<b>$gallery->title</b> galerisine ait videolar"; ?>
            <a href="<?php echo base_url("Galleries/new_gallery_video_form/$gallery->id"); ?>"
               class="btn  btn-primary btn-sm pull-right">
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
                                href="<?php echo base_url("Galleries/new_gallery_video_form/$gallery->id"); ?>">tıklayınız.</a></p>
                </div>
            <?php } else { ?>
                <table id="default-datatable" data-plugin="DataTable"
                       class="table table-hover table-bordered table-striped content-container"
                       data-options="{
								responsive: true,
							    iDisplayLength: 500,
							    stateSave: true,
							     language: {
                                 url: '//cdn.datatables.net/plug-ins/1.10.19/i18n/Turkish.json'
                                                                            },
                                  }">
                    <thead>
                    <th class="order"><i class="fa fa-reorder"></i></th>
                    <th class="w30">#id</th>
                    <th>Url</th>
                    <th>Görsel</th>
                    <th>Durumu</th>
                    <th>İşlem</th>

                    </thead>
                    <tbody class="sortable" data-url="<?php echo base_url("Galleries/rankGalleryVideoSetter/") ?>">

                    <?php foreach ($items as $item) { ?>

                        <tr id="ord-<?php echo $item->id; ?>">
                            <td class="order"><i class="fa fa-reorder"></i></td>
                            <td class="w30"><?php echo $item->id; ?></td>
                            <td><?php echo $item->url; ?></td>
                            <td>
                                <iframe
                                        height="75"
                                        src="https://www.youtube.com/embed/<?php echo $item->url; ?>"
                                        frameborder="0"
                                        allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                                        allowfullscreen>

                                </iframe>
                            </td>
                            <td class="w100">
                                <input
                                        data-url="<?php echo base_url("Galleries/galleryVideoIsActiveSetter/$item->id"); ?>"
                                        class="isActive"
                                        type="checkbox"
                                        data-switchery
                                        data-color="#10c469"
                                    <?php echo ($item->isActive) ? "checked" : ""; ?>
                                />
                            </td>
                            <td class="w150">
                                <button
                                        data-url="<?php echo base_url("Galleries/galleryVideoDelete/$item->id/$item->gallery_id"); ?>"
                                        class="btn btn-sm btn-danger  remove-btn">
                                    <i class="fa fa-trash"></i> Sil
                                </button>
                                <a href="<?php echo base_url("Galleries/update_gallery_video_form/$item->id"); ?>"
                                   class="btn btn-sm btn-info "><i class="fa fa-pencil-square-o"></i> Düzenle
                                </a>

                            </td>
                        </tr>

                    <?php } ?>


                    </tbody>
                </table>
            <?php } ?>
        </div><!-- .widget -->
    </div><!-- END column -->
</div>