<?php

class News extends CI_Controller
{
    public $viewFolder = "";

    public function __construct()
    {
        parent::__construct();
        $this->viewFolder = "news-v";
        $this->load->model("News_model");
        if(!get_active_user()){
            redirect(base_url("login"));
        }
    }

    public function index()
    {
        $viewData = new stdClass();
        /** Tabloadn Verilerin Getirilmesi*/
        $items = $this->News_model->get_all(
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

        $news_type = $this->input->post("news_type");
        if ($news_type == "image") {

            if ($_FILES["img_url"]["name"] == "") {

                $alert = array(
                    "title" => "BAŞARISIZ !",
                    "text" => "Lütfen Bir Resim Seçiniz.",
                    "type" => "error",

                );
                $this->session->set_flashdata("alert", $alert);
                redirect(base_url("News/new_form"));
                die();
            }


        } else if ($news_type == "video") {
            $this->form_validation->set_rules("video_url", "Video Url", "required|trim");

        }


        $this->form_validation->set_rules("title", "Başlık", "required|trim");
        $this->form_validation->set_rules("titleEn", "İngilizce Başlık", "required|trim");
        $this->form_validation->set_rules("titleFr", "Fransızca Başlık", "required|trim");
        $this->form_validation->set_rules("titleDe", "Almanca Başlık", "required|trim");
        $this->form_validation->set_message(
            array(
                "required" => "<b><i>{field}</i></b> alanı boş olamaz"
            )
        );
        $validate = $this->form_validation->run();
        if ($validate) {

            //image yukleme
            if ($news_type == "image") {

                $file_name = convertToSeo(pathinfo($_FILES["img_url"]["name"], PATHINFO_FILENAME)) . "." . pathinfo($_FILES["img_url"]["name"], PATHINFO_EXTENSION);

                $config["allowed_types"] = "jpg|jpeg|png";
                $config["upload_path"] = "uploads/$this->viewFolder/";
                $config["file_name"] = $file_name;


                $this->load->library("upload", $config);
                $upload = $this->upload->do_upload("img_url");
                if ($upload) {
                    $uploaded_file = $this->upload->data("file_name");
                    $data = array(
                        "title" => $this->input->post("title"),
                        "titleEn" => $this->input->post("titleEn"),
                        "titleFr" => $this->input->post("titleFr"),
                        "titleDe" => $this->input->post("titleDe"),
                        "description" => $this->input->post("description"),
                        "descriptionEn" => $this->input->post("descriptionEn"),
                        "descriptionFr" => $this->input->post("descriptionFr"),
                        "descriptionDe" => $this->input->post("descriptionDe"),
                        "url" => convertToSeo($this->input->post("title")),
                        "news_type" => $news_type,
                        "img_url" => $uploaded_file,
                        "video_url" => "#",
                        "rank" => 0,
                        "isActive" => 1,
                        "createdAt" => date("Y-m-d H:i:s")
                    );

                } else {
                    $alert = array(
                        "title" => "BAŞARISIZ !",
                        "text" => "Görsel Yüklenirken Problem Oluştu.",
                        "type" => "error",

                    );
                    $this->session->set_flashdata("alert", $alert);
                    redirect(base_url("News/new_form"));
                    die();

                }

                // image yukleme sonu
            } else if ($news_type == "video") {
                $data = array(
                    "title" => $this->input->post("title"),
                    "titleEn" => $this->input->post("titleEn"),
                    "titleFr" => $this->input->post("titleFr"),
                    "titleDe" => $this->input->post("titleDe"),
                    "description" => $this->input->post("description"),
                    "descriptionEn" => $this->input->post("descriptionEn"),
                    "descriptionFr" => $this->input->post("descriptionFr"),
                    "descriptionDe" => $this->input->post("descriptionDe"),
                    "url" => convertToSeo($this->input->post("title")),
                    "news_type" => $news_type,
                    "img_url" => "#",
                    "video_url" => $this->input->post("video_url"),
                    "rank" => 0,
                    "isActive" => 1,
                    "createdAt" => date("Y-m-d H:i:s")
                );

            }

            $insert = $this->News_model->add($data);

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
            redirect(base_url("News"));
        } else {
            $viewData = new stdClass();
            $viewData->viewFolder = $this->viewFolder;
            $viewData->subViewFolder = "add";
            $viewData->form_error = true;
            $viewData->news_type = $news_type;

            $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
        }
    }

    public function update_form($id)
    {
        $viewData = new stdClass();

        $item = $this->News_model->get(
            array(
                "id" => $id
            )
        );


        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "update";
        $viewData->item = $item;

        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
    }

    public function update($id)
    {
        $this->load->library("form_validation");

        $news_type = $this->input->post("news_type");
        if ($news_type == "video") {
            $this->form_validation->set_rules("video_url", "Video Url", "required|trim");

        }


        $this->form_validation->set_rules("title", "Başlık", "required|trim");
        $this->form_validation->set_message(
            array(
                "required" => "<b><i>{field}</i></b> alanı boş olamaz"
            )
        );
        $validate = $this->form_validation->run();
        if ($validate) {

            //image yukleme
            if ($news_type == "image") {

                if ($_FILES["img_url"]["name"] !== "") {


                    $file_name = convertToSeo(pathinfo($_FILES["img_url"]["name"], PATHINFO_FILENAME)) . "." . pathinfo($_FILES["img_url"]["name"], PATHINFO_EXTENSION);

                    $config["allowed_types"] = "jpg|jpeg|png";
                    $config["upload_path"] = "uploads/$this->viewFolder/";
                    $config["file_name"] = $file_name;


                    $this->load->library("upload", $config);
                    $upload = $this->upload->do_upload("img_url");
                    if ($upload) {
                        $uploaded_file = $this->upload->data("file_name");
                        $data = array(
                            "title" => $this->input->post("title"),
                            "titleEn" => $this->input->post("titleEn"),
                            "titleFr" => $this->input->post("titleFr"),
                            "titleDe" => $this->input->post("titleDe"),
                            "description" => $this->input->post("description"),
                            "descriptionEn" => $this->input->post("descriptionEn"),
                            "descriptionFr" => $this->input->post("descriptionFr"),
                            "descriptionDe" => $this->input->post("descriptionDe"),
                            "url" => convertToSeo($this->input->post("title")),
                            "news_type" => $news_type,
                            "img_url" => $uploaded_file,
                            "video_url" => "#",
                        );

                    } else {
                        $alert = array(
                            "title" => "BAŞARISIZ !",
                            "text" => "Görsel Yüklenirken Problem Oluştu.",
                            "type" => "error",

                        );
                        $this->session->set_flashdata("alert", $alert);
                        redirect(base_url("News/update_form/$id"));
                        die();

                    }

                } else {
                    $data = array(
                        "title" => $this->input->post("title"),
                        "titleEn" => $this->input->post("titleEn"),
                        "titleFr" => $this->input->post("titleFr"),
                        "titleDe" => $this->input->post("titleDe"),
                        "description" => $this->input->post("description"),
                        "descriptionEn" => $this->input->post("descriptionEn"),
                        "descriptionFr" => $this->input->post("descriptionFr"),
                        "descriptionDe" => $this->input->post("descriptionDe"),
                        "url" => convertToSeo($this->input->post("title")),
                    );

                }

            } else if ($news_type == "video") {
                $data = array(
                    "title" => $this->input->post("title"),
                    "titleEn" => $this->input->post("titleEn"),
                    "titleFr" => $this->input->post("titleFr"),
                    "titleDe" => $this->input->post("titleDe"),
                    "description" => $this->input->post("description"),
                    "descriptionEn" => $this->input->post("descriptionEn"),
                    "descriptionFr" => $this->input->post("descriptionFr"),
                    "descriptionDe" => $this->input->post("descriptionDe"),
                    "url" => convertToSeo($this->input->post("title")),
                    "news_type" => $news_type,
                    "img_url" => "#",
                    "video_url" => $this->input->post("video_url"),
                );

            }

            $update = $this->News_model->update(array(
                "id" => $id),
                $data
            );

            //TODO Alert sistemi eklenecek
            if ($update) {
                $alert = array(
                    "title" => "İşlem Başarılı.",
                    "text" => "Haber Başarılı Şekilde Güncellendi.",
                    "type" => "success",

                );

            } else {
                $alert = array(
                    "title" => "BAŞARISIZ !",
                    "text" => "Bir Aksilik Oldu Haber Güncellenemedi.",
                    "type" => "error",

                );
            }

            //işlem sonucunu sessiona yazma
            $this->session->set_flashdata("alert", $alert);
            redirect(base_url("News"));
        } else {


            $viewData = new stdClass();
            $viewData->viewFolder = $this->viewFolder;
            $viewData->subViewFolder = "update";
            $viewData->form_error = true;
            $viewData->news_type = $news_type;

            $viewData->item = $this->News_model->get(
                array(
                    "id" => $id
                )
            );

            $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
        }
    }

    public function delete($id)
    {
        $delete = $this->News_model->delete(
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
        redirect(base_url("News"));
    }

    public function isActiveSetter($id)
    {
        if ($id) {
            $isActive = ($this->input->post("data") === "true") ? 1 : 0;
            $this->News_model->update(
                array(
                    "id" => $id
                ),
                array(
                    "isActive" => $isActive
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
            $this->News_model->update(
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
}