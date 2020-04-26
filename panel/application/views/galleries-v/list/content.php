<div class="row">
    <div class="col-md-12">
        <h4 class="m-b-lg">
            Galeri Listesi
            <a href="<?php echo base_url("Galleries/new_form"); ?>" class="btn  btn-primary btn-sm pull-right">
                <i class="fa fa-plus"></i> Yeni Ekle </a>
        </h4>
    </div><!-- END column -->
    <div class="col-md-12">
        <div class="widget p-lg">
            <?php if (empty($items)) { ?>
                <div class="alert alert-info text-center">
                    <!-- <h5 class="alert-title">Kayıt Bulunamadı</h5> -->
                    <i class="fa fa-plus-square"> </i>
                    <p> Burada herhangi bir veri bulunmamaktadır. Eklemek için lütfen <a
                                href="<?php echo base_url("Galleries/new_form"); ?>">tıklayınız.</a></p>
                </div>
            <?php } else { ?>
                <table id="default-datatable" data-plugin="DataTable" class="table table-hover table-bordered table-striped content-container"
                       data-options="{
								responsive: true,
							    iDisplayLength: 100,
							    stateSave: true,
							   language: {
                                 url: '//cdn.datatables.net/plug-ins/1.10.19/i18n/Turkish.json'
                                                                            }
                                  }">
                <thead>
                <th class="order"><i class="fa fa-reorder"></i></th>
                <th class="w50">#id</th>
                <th>Galeri Adı</th>
                <th>Galeri Türü</th>
                <th>Klasör Adı</th>
                <th>Url</th>
                <th>Durumu</th>
                <th>İşlem</th>

                </thead>
                <tbody class="sortable" data-url="<?php echo base_url("Galleries/rankSetter/") ?>">

                <?php foreach ($items as $item) { ?>

                    <tr  id="ord-<?php echo $item->id; ?>">
                        <td class="order"><i class="fa fa-reorder"></i></td>
                        <td class="w50"><?php echo $item->id; ?></td>
                        <td><?php echo $item->title; ?></td>
                        <td><?php echo $item->gallery_type; ?></td>
                        <td><?php echo $item->folder_name; ?></td>
                        <td><?php echo $item->url; ?></td>
                        <td class="w100">
                            <input
                                    data-url="<?php echo base_url("Galleries/isActiveSetter/$item->id"); ?>"
                                    class="isActive"
                                    type="checkbox"
                                    data-switchery
                                    data-color="#10c469"
                                <?php echo ($item->isActive) ? "checked" : ""; ?>
                            />
                        </td>
                        <td>
                            <button
                                    data-url="<?php echo base_url("Galleries/delete/$item->id"); ?>"
                                    class="btn btn-sm btn-danger  remove-btn">
                                <i class="fa fa-trash"></i> Sil
                            </button>
                            <?php

                            if($item->gallery_type=="image"){
                                $button_icon= "fa-picture-o";
                                $button_colour ="btn-success";
                                $button_name="Resimler";
                                $button_url="Galleries/upload_form/$item->id";
                            }
                            else  if($item->gallery_type=="video"){
                                $button_icon= "fa-play-circle-o";
                                $button_colour ="btn-warning";
                                $button_name="Videolar";
                                $button_url="Galleries/gallery_video_list/$item->id";

                            }
                            else  if($item->gallery_type=="file"){
                                $button_icon= "fa-folder-open-o";
                                $button_colour ="btn-dark";
                                $button_name="Dosyalar";
                                $button_url="Galleries/upload_form/$item->id";

                            }

                            ?>

                            <a href="<?php echo base_url("Galleries/update_form/$item->id"); ?>"
                               class="btn btn-sm btn-info  "><i class="fa fa-pencil-square-o"></i> Düzenle
                            </a>
                            <a href="<?php echo base_url($button_url); ?>"
                               class="btn btn-sm <?php echo $button_colour; ?>  "><i class="fa <?php echo $button_icon; ?> "></i> <?php echo $button_name; ?> </a>
                        </td>
                    </tr>

                <?php } ?>


                </tbody>
                </table>
            <?php } ?>
        </div><!-- .widget -->
    </div><!-- END column -->
</div>