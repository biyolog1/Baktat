<?php

class Courses extends CI_Controller
{
    public $viewFolder = "";

    public function __construct()
    {
        parent::__construct();
        $this->viewFolder = "courses-v";
        $this->load->model("Courses_model");
        if(!get_active_user()){
            redirect(base_url("login"));
        }
    }

    public function index()
    {
        $viewData = new stdClass();
        /** Tabloadn Verilerin Getirilmesi*/
        $items = $this->Courses_model->get_all(
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



        if ($_FILES["img_url"]["name"] == "") {

            $alert = array(
                "title" => "BAŞARISIZ !",
                "text" => "Lütfen Bir Resim Seçiniz.",
                "type" => "error",

            );
            $this->session->set_flashdata("alert", $alert);
            redirect(base_url("Courses/new_form"));
            die();
        }

        $this->form_validation->set_rules("title", "Başlık", "required|trim");
        $this->form_validation->set_rules("event_date", "Sertifika Alınma Tarihi", "required|trim");
        $this->form_validation->set_message(
            array(
                "required" => "<b><i>{field}</i></b> alanı boş olamaz"
            )
        );
        $validate = $this->form_validation->run();
        if ($validate) {

            //image yukleme

            $file_name = convertToSeo(pathinfo($_FILES["img_url"]["name"], PATHINFO_FILENAME)) . "." . pathinfo($_FILES["img_url"]["name"], PATHINFO_EXTENSION);

            $config["allowed_types"] = "jpg|jpeg|png";
            $config["upload_path"] = "uploads/$this->viewFolder/";
            $config["file_name"] = $file_name;


            $this->load->library("upload", $config);
            $upload = $this->upload->do_upload("img_url");
            if ($upload) {
                $uploaded_file = $this->upload->data("file_name");
                $insert = $this->Courses_model->add(
                    array(
                        "title" => $this->input->post("title"),
                        "titleEn" => $this->input->post("titleEn"),
                        "titleFr" => $this->input->post("titleFr"),
                        "titleDe" => $this->input->post("titleDe"),
                        "description" => $this->input->post("description"),
                        "descriptionEn" => $this->input->post("descriptionEn"),
                        "descriptionFr" => $this->input->post("descriptionFr"),
                        "descriptionDe" => $this->input->post("descriptionDe"),
                        "url" => convertToSeo($this->input->post("title")),
                        "img_url" => $uploaded_file,
                        "event_date" => $this->input->post("event_date"),
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

            } else {
                $alert = array(
                    "title" => "BAŞARISIZ !",
                    "text" => "BGörsel Yüklenirken Problem Oluştu.",
                    "type" => "error",

                );
                $this->session->set_flashdata("alert", $alert);
                redirect(base_url("Courses/new_form"));
                die();
            }

            //işlem sonucunu sessiona yazma
            $this->session->set_flashdata("alert", $alert);
            redirect(base_url("Courses"));
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

        $item = $this->Courses_model->get(
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


        $this->form_validation->set_rules("title", "Başlık", "required|trim");
        $this->form_validation->set_rules("event_date", "Sertifika Alınma Tarihi", "required|trim");
        $this->form_validation->set_message(
            array(
                "required" => "<b><i>{field}</i></b> alanı boş olamaz"
            )
        );
        $validate = $this->form_validation->run();
        if ($validate) {

            //image yukleme

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
                        "event_date" => $this->input->post("event_date"),
                        "url" => convertToSeo($this->input->post("title")),
                        "img_url" => $uploaded_file,
                    );

                } else {
                    $alert = array(
                        "title" => "BAŞARISIZ !",
                        "text" => "Görsel Yüklenirken Problem Oluştu.",
                        "type" => "error",

                    );
                    $this->session->set_flashdata("alert", $alert);
                    redirect(base_url("Courses/update_form/$id"));
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
                    "event_date" => $this->input->post("event_date"),
                    "url" => convertToSeo($this->input->post("title")),
                );
            }

            $update = $this->Courses_model->update(array("id" => $id),$data);

            //TODO Alert sistemi eklenecek
            if ($update) {
                $alert = array(
                    "title" => "İşlem Başarılı.",
                    "text" => "Sertifika Başarılı Şekilde Güncellendi.",
                    "type" => "success",

                );

            } else {
                $alert = array(
                    "title" => "BAŞARISIZ !",
                    "text" => "Bir Aksilik Oldu Sertifika Güncellenemedi.",
                    "type" => "error",
                );
            }

            //işlem sonucunu sessiona yazma
            $this->session->set_flashdata("alert", $alert);
            redirect(base_url("Courses"));
        } else {


            $viewData = new stdClass();
            $viewData->viewFolder = $this->viewFolder;
            $viewData->subViewFolder = "update";
            $viewData->form_error = true;

            $viewData->item = $this->Courses_model->get(
                array(
                    "id" => $id
                )
            );

            $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
        }
    }

    public function delete($id)
    {
        $delete = $this->Courses_model->delete(
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
        redirect(base_url("Courses"));
    }

    public function isActiveSetter($id)
    {
        if ($id) {
            $isActive = ($this->input->post("data") === "true") ? 1 : 0;
            $this->Courses_model->update(
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
            $this->Courses_model->update(
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