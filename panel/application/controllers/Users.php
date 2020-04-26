<?php

class Users extends CI_Controller
{
    public $viewFolder = "";

    public function __construct()
    {
        parent::__construct();
        $this->viewFolder = "users-v";
        $this->load->model("Users_model");
        if(!get_active_user()){
            redirect(base_url("login"));
        }
    }

    public function index()
    {
        $viewData = new stdClass();
        /** Tabloadn Verilerin Getirilmesi*/
        $items = $this->Users_model->get_all(
            array()

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
            redirect(base_url("Users/new_form"));
            die();
        }

        $this->form_validation->set_rules("user_name", "Kullanıcı Adı", "required|trim|is_unique[users.user_name]");
        $this->form_validation->set_rules("full_name", "Ad Soyad", "required|trim");
        $this->form_validation->set_rules("email", "E-Posta", "required|trim|valid_email|is_unique[users.email]");
        $this->form_validation->set_rules("password", "Şifre", "required|trim|min_length[6]");
        $this->form_validation->set_rules("re_password", "Şifre Tekrarı", "required|trim|min_length[6]|matches[password]");
        $this->form_validation->set_message(
            array(
                "required" => "<b><i>{field}</i></b> alanı boş olamaz",
                "valid_email" => "Lütfen geçerli bir Eposta adresi giriniz.",
                "is_unique" => "<b><i>{field}</i></b> alanı daha önceden kullanılmış",
                "matches" => "Şifre ve Şifre Tekrarı alanı uyuşmuyor",
                "min_length" => "Şifre alanı minumum 6 karakterli olmalıdır"

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
                $insert = $this->Users_model->add(


                    array(
                        "user_name" => $this->input->post("user_name"),
                        "full_name" => $this->input->post("full_name"),
                        "img_url" => $uploaded_file,
                        "email" => $this->input->post("email"),
                        "password" => md5($this->input->post("password")),
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
                    "text" => "Görsel Yüklenirken Problem Oluştu.",
                    "type" => "error",

                );
                $this->session->set_flashdata("alert", $alert);
                redirect(base_url("Users/new_form"));
                die();

            }

            //işlem sonucunu sessiona yazma
            $this->session->set_flashdata("alert", $alert);
            redirect(base_url("Users"));
            die();


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

        $item = $this->Users_model->get(
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

        $oldUser = $this->Users_model->get(
            array(
                "id" => $id
            )
        );

        if ($oldUser->user_name != $this->input->post("user_name")) {

            $this->form_validation->set_rules("user_name", "Kullanıcı Adı", "required|trim|is_unique[users.user_name]");

        }
        if ($oldUser->email != $this->input->post("email")) {

            $this->form_validation->set_rules("email", "E-Posta", "required|trim|valid_email|is_unique[users.email]");
        }

        $this->form_validation->set_rules("full_name", "Ad Soyad", "required|trim");
        $this->form_validation->set_message(
            array(
                "required" => "<b><i>{field}</i></b> alanı boş olamaz",
                "valid_email" => "Lütfen geçerli bir Eposta adresi giriniz.",
                "is_unique" => "<b><i>{field}</i></b> alanı daha önceden kullanılmış"
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
                        "user_name" => $this->input->post("user_name"),
                        "full_name" => $this->input->post("full_name"),
                        "img_url" => $uploaded_file,
                        "email" => $this->input->post("email")
                    );

                } else {
                    $alert = array(
                        "title" => "BAŞARISIZ !",
                        "text" => "Görsel Yüklenirken Problem Oluştu.",
                        "type" => "error",

                    );
                    $this->session->set_flashdata("alert", $alert);
                    redirect(base_url("Users/update_form/$id"));
                    die();
                }

            } else {
                $data = array(
                    "user_name" => $this->input->post("user_name"),
                    "full_name" => $this->input->post("full_name"),
                    "email" => $this->input->post("email")
                );
            }

            $update = $this->Users_model->update(array("id" => $id), $data);

            //TODO Alert sistemi eklenecek
            if ($update) {
                $alert = array(
                    "title" => "İşlem Başarılı.",
                    "text" => "Kullanıcı Başarılı Şekilde Güncellendi.",
                    "type" => "success",

                );

            } else {
                $alert = array(
                    "title" => "BAŞARISIZ !",
                    "text" => "Bir Aksilik Oldu Referans Güncellenemedi.",
                    "type" => "error",
                );
            }

            //işlem sonucunu sessiona yazma
            $this->session->set_flashdata("alert", $alert);
            redirect(base_url("Users"));
        } else {


            $viewData = new stdClass();
            $viewData->viewFolder = $this->viewFolder;
            $viewData->subViewFolder = "update";
            $viewData->form_error = true;

            $viewData->item = $this->Users_model->get(
                array(
                    "id" => $id
                )
            );

            $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
        }
    }

    public function update_password_form($id)
    {
        $viewData = new stdClass();

        $item = $this->Users_model->get(
            array(
                "id" => $id
            )
        );


        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "password";
        $viewData->item = $item;

        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
    }

    public function update_password($id)
    {
        $this->load->library("form_validation");
        $this->form_validation->set_rules("password", "Şifre", "required|trim|min_length[6]");
        $this->form_validation->set_rules("re_password", "Şifre Tekrarı", "required|trim|min_length[6]|matches[password]");
        $this->form_validation->set_message(
            array(
                "required" => "<b><i>{field}</i></b> alanı boş olamaz",
                "matches" => "Şifre ve Şifre Tekrarı alanı uyuşmuyor",
                "min_length" => "Şifre alanı minumum 6 karakterli olmalıdır"

            )
        );

        $validate = $this->form_validation->run();
        if ($validate) {

            $update = $this->Users_model->update(array("id" => $id), array(
                "password" => md5($this->input->post("password")),
            ));

            //TODO Alert sistemi eklenecek
            if ($update) {
                $alert = array(
                    "title" => "İşlem Başarılı.",
                    "text" => "Şifre Başarılı Şekilde Güncellendi.",
                    "type" => "success",

                );

            } else {
                $alert = array(
                    "title" => "BAŞARISIZ !",
                    "text" => "Bir Aksilik Oldu Şifre Güncellenemedi.",
                    "type" => "error",
                );
            }

            //işlem sonucunu sessiona yazma
            $this->session->set_flashdata("alert", $alert);
            redirect(base_url("Users"));
        } else {


            $viewData = new stdClass();
            $viewData->viewFolder = $this->viewFolder;
            $viewData->subViewFolder = "password";
            $viewData->form_error = true;

            $viewData->item = $this->Users_model->get(
                array(
                    "id" => $id
                )
            );

            $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
        }
    }

    public function delete($id)
    {
        $users=$this->Users_model->get(
            array(
                "id" => $id
            )
        );

        $delete = $this->Users_model->delete(
            array(
                "id" => $id
            )
        );






        //TODO alert sistemi eklenecek
        if ($delete) {

            unlink("uploads/{$this->viewFolder}/$users->img_url");

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
        redirect(base_url("Users"));
    }

    public function isActiveSetter($id)
    {
        if ($id) {
            $isActive = ($this->input->post("data") === "true") ? 1 : 0;
            $this->Users_model->update(
                array(
                    "id" => $id
                ),
                array(
                    "isActive" => $isActive
                )
            );

        }
    }




}