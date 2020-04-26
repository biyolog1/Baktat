<?php

class Emailsettings extends CI_Controller
{
    public $viewFolder = "";

    public function __construct()
    {
        parent::__construct();
        $this->viewFolder = "emailsettings-v";
        $this->load->model("Emailsettings_model");
        if (!get_active_user()) {
            redirect(base_url("login"));
        }
    }

    public function index()
    {
        $viewData = new stdClass();
        /** Tabloadn Verilerin Getirilmesi*/
        $items = $this->Emailsettings_model->get_all(
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

        $this->form_validation->set_rules("protocol", "Protokol Numarası", "required|trim");
        $this->form_validation->set_rules("host", "Email Sunucusu", "required|trim");
        $this->form_validation->set_rules("port", "Port Numarası", "required|trim");
        $this->form_validation->set_rules("user_name", "Kullanıcı Adı", "required|trim");
        $this->form_validation->set_rules("user", "E-Posta Adresi", "required|trim|valid_email");
        $this->form_validation->set_rules("from", "Kimden Gönderilecek", "required|trim|valid_email");
        $this->form_validation->set_rules("to", "Kime Gidecek", "required|trim|valid_email");
        $this->form_validation->set_rules("password", "Şifre", "required|trim");
        $this->form_validation->set_message(
            array(
                "required" => "<b><i>{field}</i></b> alanı boş olamaz",
                "valid_email" => "<b><i>{field}</i></b> alanı için lütfen geçerli bir Eposta adresi giriniz.",
            )
        );
        $validate = $this->form_validation->run();
        if ($validate) {

            $insert = $this->Emailsettings_model->add(
                array(
                    "protocol" => $this->input->post("protocol"),
                    "host" => $this->input->post("host"),
                    "port" => $this->input->post("port"),
                    "user_name" => $this->input->post("user_name"),
                    "user" => $this->input->post("user"),
                    "from" => $this->input->post("from"),
                    "to" => $this->input->post("to"),
                    "password" => $this->input->post("password"),
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
                    "text" => "Bir Aksilik Oldu. Kayıt Eklenemedi.",
                    "type" => "error",

                );
            }


            //işlem sonucunu sessiona yazma
            $this->session->set_flashdata("alert", $alert);
            redirect(base_url("Emailsettings"));
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

        $item = $this->Emailsettings_model->get(
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
        $this->form_validation->set_rules("protocol", "Protokol Numarası", "required|trim");
        $this->form_validation->set_rules("host", "Email Sunucusu", "required|trim");
        $this->form_validation->set_rules("port", "Port Numarası", "required|trim");
        $this->form_validation->set_rules("user_name", "Kullanıcı Adı", "required|trim");
        $this->form_validation->set_rules("user", "E-Posta Adresi", "required|trim|valid_email");
        $this->form_validation->set_rules("from", "Kimden Gönderilecek", "required|trim|valid_email");
        $this->form_validation->set_rules("to", "Kime Gidecek", "required|trim|valid_email");
        $this->form_validation->set_rules("password", "Şifre", "required|trim");
        $this->form_validation->set_message(
            array(
                "required" => "<b><i>{field}</i></b> alanı boş olamaz",
                "valid_email" => "Lütfen geçerli bir Eposta adresi giriniz.",
            )
        );

        $validate = $this->form_validation->run();
        if ($validate) {

            $update = $this->Emailsettings_model->update(

                array("id" => $id),
                array(
                    "protocol" => $this->input->post("protocol"),
                    "host" => $this->input->post("host"),
                    "port" => $this->input->post("port"),
                    "user_name" => $this->input->post("user_name"),
                    "user" => $this->input->post("user"),
                    "from" => $this->input->post("from"),
                    "to" => $this->input->post("to"),
                    "password" => $this->input->post("password"),
                )
            );

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
                    "text" => "Bir Aksilik Oldu Email ayarları Güncellenemedi.",
                    "type" => "error",
                );
            }
            //işlem sonucunu sessiona yazma
            $this->session->set_flashdata("alert", $alert);
            redirect(base_url("Emailsettings"));
        } else {
            $viewData = new stdClass();
            $viewData->viewFolder = $this->viewFolder;
            $viewData->subViewFolder = "update";
            $viewData->form_error = true;

            $viewData->item = $this->Emailsettings_model->get(
                array(
                    "id" => $id
                )
            );

            $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
        }
    }


    public function delete($id)
    {
        $users = $this->Emailsettings_model->get(
            array(
                "id" => $id
            )
        );

        $delete = $this->Emailsettings_model->delete(
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
        redirect(base_url("Emailsettings"));
    }

    public function isActiveSetter($id)
    {
        if ($id) {
            $isActive = ($this->input->post("data") === "true") ? 1 : 0;
            $this->Emailsettings_model->update(
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