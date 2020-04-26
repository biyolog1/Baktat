<?php

class Galleries extends CI_Controller
{
    public $viewFolder = "";

    public function __construct()
    {
        parent::__construct();
        $this->viewFolder = "galleries-v";
        $this->load->model("Galleries_model");
        $this->load->model("Images_model");
        $this->load->model("Files_model");
        $this->load->model("Videos_model");
        if(!get_active_user()){
            redirect(base_url("login"));
        }
    }

    public function index()
    {
        $viewData = new stdClass();
        /** Tabloadn Verilerin Getirilmesi*/
        $items = $this->Galleries_model->get_all(
            array(), "rank ASC"

        );
        /** View'e gönderilecek değişkenlerin set edilmesi */
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "list";

        $viewData->items = $items;
        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
    }

    public function new_form()
    {


        $viewData = new stdClass();
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "add";

        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
    }

    public function save()
    {
        $this->load->library("form_validation");
        $this->form_validation->set_rules("title", "Galeri Adı", "required|trim");
        $this->form_validation->set_message(
            array(
                "required" => "<b><i>{field}</i></b> alanı boş olamaz"
            )
        );
        $validate = $this->form_validation->run();
        if ($validate) {
            $gallery_type = $this->input->post("gallery_type");
            $path = "uploads/$this->viewFolder/";
            $folder_name = "";
            if ($gallery_type == "image") {
                $folder_name = convertToSeo($this->input->post("title"));
                $path = "$path/images/$folder_name";
            } else if ($gallery_type == "file") {
                $folder_name = convertToSeo($this->input->post("title"));
                $path = "$path/files/$folder_name";
            }

            if ($gallery_type != "video") {

                if (!mkdir($path, 0755)) {
                    $alert = array(
                        "title" => "BAŞARISIZ !",
                        "text" => "Galeri Klasörü Oluştururken Problem Oluştu. (Yetki Hatası) yada Belirtilen Klasör Sistemde Var Yenisi Oluşturulamıyor.",
                        "type" => "error",
                    );
                    //işlem sonucunu sessiona yazma
                    $this->session->set_flashdata("alert", $alert);
                    redirect(base_url("Galleries"));
                    die();
                }
            }


            $insert = $this->Galleries_model->add(
                array(
                    "title" => $this->input->post("title"),
                    "gallery_type" => $this->input->post("gallery_type"),
                    "url" => convertToSeo($this->input->post("title")),
                    "folder_name" => $folder_name,
                    "rank" => 0,
                    "isActive" => 1,
                    "createdAt" => date("Y-m-d H:i:s")
                )
            );

            //TODO Alert sistemi eklenecek
            if ($insert) {
                $alert = array(
                    "title" => "İşlem Başarılı.",
                    "text" => "Kayıt Başarılı Şekilde Eklendi.",
                    "type" => "success",

                );

            } else {
                $alert = array(
                    "title" => "BAŞARISIZ !",
                    "text" => "Bir Aksilik Oldu Kayıt Eklenemedi.",
                    "type" => "error",

                );
            }

            //işlem sonucunu sessiona yazma
            $this->session->set_flashdata("alert", $alert);
            redirect(base_url("Galleries"));
        } else {
            $viewData = new stdClass();
            $viewData->viewFolder = $this->viewFolder;
            $viewData->subViewFolder = "add";
            $viewData->form_error = true;

            $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
        }
    }

    public function update_form($id)
    {
        $viewData = new stdClass();

        $item = $this->Galleries_model->get(
            array(
                "id" => $id
            )
        );


        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "update";
        $viewData->item = $item;

        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
    }

    public function update($id, $gallery_type, $oldFolderName = "")
    {
        $this->load->library("form_validation");
        $this->form_validation->set_rules("title", "Galeri Adı", "required|trim");
        $this->form_validation->set_message(
            array(
                "required" => "<b><i>{field}</i></b> alanı boş olamaz"
            )
        );
        $validate = $this->form_validation->run();
        if ($validate) {

            $path = "uploads/$this->viewFolder/";
            $folder_name = "";
            if ($gallery_type == "image") {
                $folder_name = convertToSeo($this->input->post("title"));
                $path = "$path/images";
            } else if ($gallery_type == "file") {
                $folder_name = convertToSeo($this->input->post("title"));
                $path = "$path/files";
            }

            if ($gallery_type != "video") {

                if (!rename("$path/$oldFolderName", "$path/$folder_name")) {
                    $alert = array(
                        "title" => "BAŞARISIZ !",
                        "text" => "Galeri Klasörü Oluştururken Problem Oluştu. (Yetki Hatası) yada Belirtilen Klasör Sistemde Var Yenisi Oluşturulamıyor.",
                        "type" => "error",
                    );
                    //işlem sonucunu sessiona yazma
                    $this->session->set_flashdata("alert", $alert);
                    redirect(base_url("Galleries"));
                    die();
                }
            }

            $update = $this->Galleries_model->update(
                array(
                    "id" => $id
                ),
                array(
                    "title" => $this->input->post("title"),
                    "folder_name" => $folder_name,
                    "url" => convertToSeo($this->input->post("title"))
                )
            );

            //TODO Alert sistemi eklenecek
            if ($update) {

                $alert = array(
                    "title" => "İşlem Başarılı.",
                    "text" => "Kayıt Başarılı Şekilde Güncellendi.",
                    "type" => "success",

                );

            } else {
                $alert = array(
                    "title" => "BAŞARISIZ !",
                    "text" => "Bir Aksilik Oldu Kayıt Güncellenemedi.",
                    "type" => "error",

                );
            }
            $this->session->set_flashdata("alert", $alert);
            redirect(base_url("Galleries"));
        } else {
            $viewData = new stdClass();
            $item = $this->Galleries_model->get(
                array(
                    "id" => $id
                )
            );

            $viewData->viewFolder = $this->viewFolder;
            $viewData->subViewFolder = "update";
            $viewData->form_error = true;
            $viewData->item = $item;


            $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
        }
    }

    public function delete($id)
    {

        $gallery = $this->Galleries_model->get(
            array(
                "id" => $id
            )
        );
        if ($gallery) {
            if ($gallery->gallery_type != "video") {
                if ($gallery->gallery_type == "image") {
                    $path = "uploads/$this->viewFolder/images/$gallery->folder_name";
                } else if ($gallery->gallery_type == "file") {
                    $path = "uploads/$this->viewFolder/files/$gallery->folder_name";
                }

                $delete_folder = rmdir("$path");
                if (!$delete_folder) {
                    $alert = array(
                        "title" => "BAŞARISIZ !",
                        "text" => "Bir Aksilik Oldu Kayıt Silinemedi.",
                        "type" => "error",

                    );
                    $this->session->set_flashdata("alert", $alert);
                    redirect(base_url("Galleries"));
                    die();
                }
            }

            $delete = $this->Galleries_model->delete(
                array(
                    "id" => $id
                )
            );

            //TODO alert sistemi eklenecek
            if ($delete) {

                $alert = array(
                    "title" => "İşlem Başarılı.",
                    "text" => "Kayıt Başarılı Şekilde Silindi.",
                    "type" => "success",

                );

            } else {
                $alert = array(
                    "title" => "BAŞARISIZ !",
                    "text" => "Bir Aksilik Oldu Kayıt Silinemedi.",
                    "type" => "error",

                );
            }
            $this->session->set_flashdata("alert", $alert);
            redirect(base_url("Galleries"));
        }

    }

    public function fileDelete($id, $parent_id, $gallery_type)
    {
        $modelName = ($gallery_type == "image") ? "Images_model" : "Files_model";

        $fileName = $this->$modelName->get(
            array(
                "id" => $id
            )
        );

        $delete = $this->$modelName->delete(
            array(
                "id" => $id
            )
        );


        //TODO alert sistemi eklenecek
        if ($delete) {
            unlink($fileName->url);
            redirect(base_url("Galleries/upload_form/$parent_id"));
        } else {

            redirect(base_url("Galleries/upload_form/$parent_id"));
        }
    }

    public function isActiveSetter($id)
    {
        if ($id) {
            $isActive = ($this->input->post("data") === "true") ? 1 : 0;
            $this->Galleries_model->update(
                array(
                    "id" => $id
                ),
                array(
                    "isActive" => $isActive
                )
            );

        }
    }

    public function fileIsActiveSetter($id, $gallery_type)
    {
        if ($id && $gallery_type) {
            $modelName = ($gallery_type == "image") ? "Images_model" : "Files_model";

            $isActive = ($this->input->post("data") === "true") ? 1 : 0;
            $this->$modelName->update(
                array(
                    "id" => $id
                ),
                array(
                    "isActive" => $isActive
                )
            );

        }
    }

    public function fileRankSetter($gallery_type)
    {

        $data = $this->input->post("data");
        parse_str($data, $order);
        $items = $order["ord"];
        $modelName = ($gallery_type == "image") ? "Images_model" : "Files_model";
        foreach ($items as $rank => $id) {
            $this->$modelName->update(
                array(
                    "id" => $id,
                    "rank !=" => $rank
                ),
                array(
                    "rank" => $rank
                )
            );
        }
    }

    public function rankSetter()
    {

        $data = $this->input->post("data");
        parse_str($data, $order);
        $items = $order["ord"];
        foreach ($items as $rank => $id) {
            $this->Galleries_model->update(
                array(
                    "id" => $id,
                    "rank !=" => $rank
                ),
                array(
                    "rank" => $rank
                )
            );
        }
    }

    public function upload_form($id)
    {
        $viewData = new stdClass();
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "image";
        $item = $this->Galleries_model->get(
            array(
                "id" => $id

            )
        );

        $viewData->item = $item;
        if ($item->gallery_type == "image") {
            $viewData->items = $this->Images_model->get_all(
                array(
                    "gallery_id" => $id
                ), "rank ASC"
            );

        } else if ($item->gallery_type == "file") {
            $viewData->items = $this->Files_model->get_all(
                array(
                    "gallery_id" => $id
                ), "rank ASC"
            );


        } else {
            $viewData->items = $this->Videos_model->get_all(
                array(
                    "gallery_id" => $id
                ), "rank ASC"
            );
        }
        $viewData->gallery_type = $item->gallery_type;


        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);

    }

    public function file_upload($gallery_id, $gallery_type, $folderName)
    {

        $file_name = convertToSeo(pathinfo($_FILES["file"]["name"], PATHINFO_FILENAME)) . "." . pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION);

        $config["allowed_types"] = ($gallery_type == "image") ? "jpg|jpeg|png" : "pdf|doc|docx|xls|xlsx|rar|zip";
        $config["upload_path"] = ($gallery_type == "image") ? "uploads/$this->viewFolder/images/$folderName/" : "uploads/$this->viewFolder/files/$folderName/";
        $config["file_name"] = $file_name;


        $this->load->library("upload", $config);
        $upload = $this->upload->do_upload("file");
        if ($upload) {

            $uploaded_file = $this->upload->data("file_name");

            $modelName = ($gallery_type == "image") ? "Images_model" : "Files_model";
            $this->$modelName->add(
                array(
                    "url" => "{$config["upload_path"]}$uploaded_file",
                    "rank" => 0,
                    "isActive" => 1,
                    "createdAt" => date("Y-m-d H:i:s"),
                    "gallery_id" => $gallery_id
                )
            );
        } else {
            echo "İşlem Başarısız.";

        }

    }

    public function refresh_file_list($gallery_id, $gallery_type)
    {
        $viewData = new stdClass();
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "image";
        $modelName = ($gallery_type == "image") ? "Images_model" : "Files_model";

        $viewData->items = $this->$modelName->get_all(
            array(
                "gallery_id" => $gallery_id
            )
        );
        $viewData->gallery_type = $gallery_type;

        $render_html = $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/render_elements/file_list_v", $viewData, true);
        echo $render_html;
    }

    /************************* Video Galeri için Kullanılan Metotlar ***************************/
    public function gallery_video_list($id)
    {
        $viewData = new stdClass();
        $gallery = $this->Galleries_model->get(
            array(
                "id" => $id
            )
        );
        /** Tabloadn Verilerin Getirilmesi*/
        $items = $this->Videos_model->get_all(
            array(
                "gallery_id" => $id
            ), "rank ASC"

        );
        /** View'e gönderilecek değişkenlerin set edilmesi */
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "video/list";
        $viewData->items = $items;
        $viewData->gallery = $gallery;

        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
    }

    public function new_gallery_video_form($id)
    {

        $viewData = new stdClass();
        $viewData->gallery_id = $id;

        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "video/add";

        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
    }

    public function gallery_video_save($id)
    {
        $this->load->library("form_validation");
        $this->form_validation->set_rules("url", "Video Url", "required|trim");
        $this->form_validation->set_message(
            array(
                "required" => "<b><i>{field}</i></b> alanı boş olamaz"
            )
        );
        $validate = $this->form_validation->run();
        if ($validate) {

            $insert = $this->Videos_model->add(
                array(
                    "url" => $this->input->post("url"),
                    "gallery_id" => $id,
                    "rank" => 0,
                    "isActive" => 1,
                    "createdAt" => date("Y-m-d H:i:s")
                )
            );

            //TODO Alert sistemi eklenecek
            if ($insert) {
                $alert = array(
                    "title" => "İşlem Başarılı.",
                    "text" => "Kayıt Başarılı Şekilde Eklendi.",
                    "type" => "success",

                );

            } else {
                $alert = array(
                    "title" => "BAŞARISIZ !",
                    "text" => "Bir Aksilik Oldu Kayıt Eklenemedi.",
                    "type" => "error",

                );
            }

            //işlem sonucunu sessiona yazma
            $this->session->set_flashdata("alert", $alert);
            redirect(base_url("Galleries/gallery_video_list/$id"));
        } else {
            $viewData = new stdClass();
            $viewData->viewFolder = $this->viewFolder;
            $viewData->subViewFolder = "video/add";
            $viewData->form_error = true;
            $viewData->gallery_id = $id;
            $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
        }
    }

    public function update_gallery_video_form($id)
    {
        $viewData = new stdClass();

        $item = $this->Videos_model->get(
            array(
                "id" => $id
            )
        );


        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "video/update";
        $viewData->item = $item;

        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
    }

    public function gallery_video_update($id, $gallery_id)
    {
        $this->load->library("form_validation");
        $this->form_validation->set_rules("url", "Video Url", "required|trim");
        $this->form_validation->set_message(
            array(
                "required" => "<b><i>{field}</i></b> alanı boş olamaz"
            )
        );
        $validate = $this->form_validation->run();
        if ($validate) {

            $update = $this->Videos_model->update(
                array(
                    "id" => $id
                ),
                array(
                    "url" => $this->input->post("url"),
                )
            );

            //TODO Alert sistemi eklenecek
            if ($update) {

                $alert = array(
                    "title" => "İşlem Başarılı.",
                    "text" => "Kayıt Başarılı Şekilde Güncellendi.",
                    "type" => "success",

                );

            } else {
                $alert = array(
                    "title" => "BAŞARISIZ !",
                    "text" => "Bir Aksilik Oldu Kayıt Güncellenemedi.",
                    "type" => "error",

                );
            }
            $this->session->set_flashdata("alert", $alert);
            redirect(base_url("Galleries/gallery_video_list/$gallery_id"));
        } else {
            $viewData = new stdClass();
            $item = $this->Videos_model->get(
                array(
                    "id" => $id
                )
            );

            $viewData->viewFolder = $this->viewFolder;
            $viewData->subViewFolder = "video/update";
            $viewData->form_error = true;
            $viewData->item = $item;


            $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
        }
    }

    public function rankGalleryVideoSetter()
    {

        $data = $this->input->post("data");
        parse_str($data, $order);
        $items = $order["ord"];
        foreach ($items as $rank => $id) {
            $this->Videos_model->update(
                array(
                    "id" => $id,
                    "rank !=" => $rank
                ),
                array(
                    "rank" => $rank
                )
            );
        }
    }

    public function galleryVideoIsActiveSetter($id)
    {
        if ($id) {
            $isActive = ($this->input->post("data") === "true") ? 1 : 0;
            $this->Videos_model->update(
                array(
                    "id" => $id
                ),
                array(
                    "isActive" => $isActive
                )
            );

        }
    }

    public function galleryVideoDelete($id, $gallery_id)
    {


        $delete = $this->Videos_model->delete(
            array(
                "id" => $id
            )
        );

        //TODO alert sistemi eklenecek
        if ($delete) {

            $alert = array(
                "title" => "İşlem Başarılı.",
                "text" => "Kayıt Başarılı Şekilde Silindi.",
                "type" => "success",

            );

        } else {
            $alert = array(
                "title" => "BAŞARISIZ !",
                "text" => "Bir Aksilik Oldu Kayıt Silinemedi.",
                "type" => "error",

            );
        }
        $this->session->set_flashdata("alert", $alert);
        redirect(base_url("Galleries/gallery_video_list/$gallery_id"));
    }


}