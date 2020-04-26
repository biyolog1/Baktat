<?php

class Userop extends CI_Controller
{
    public $viewFolder = "";

    public function __construct()
    {
        parent::__construct();
        $this->viewFolder = "users-v";
        $this->load->model("Users_model");
    }

    public function login()
    {

        if (get_active_user()) {
            redirect(base_url());
        }
        $viewData = new stdClass();
        $this->load->library("form_validation");

        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "login";

        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
    }

    public function do_login()
    {
        if (get_active_user()) {
            redirect(base_url());
        }
        $this->load->library("form_validation");

        $this->form_validation->set_rules("user_email", "E-Posta", "required|trim|valid_email");
        $this->form_validation->set_rules("user_password", "Şifre", "required|trim|min_length[6]");
        $this->form_validation->set_message(
            array(
                "required" => "<b><i>{field}</i></b> alanı boş olamaz",
                "valid_email" => "Lütfen kayıtlı bir E-posta adresi giriniz.",
                "min_length" => "<b><i>{field}</i></b> en az 6 karakterden oluşmalıdır"

            )
        );

        if ($this->form_validation->run() == FALSE) {

            $viewData = new stdClass();
            $viewData->viewFolder = $this->viewFolder;
            $viewData->subViewFolder = "login";
            $viewData->form_error = true;

            $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
        } else {
            $user = $this->Users_model->get(
                array(
                    "email" => $this->input->post("user_email"),
                    "password" => md5($this->input->post("user_password")),
                    "isActive" => 1
                )
            );
            if ($user) {
                $alert = array(
                    "title" => "Giriş Başarılı !",
                    "text" => "Hoşgeldiniz $user->full_name",
                    "type" => "success",

                );
                $this->session->set_userdata("user", $user);
                $this->session->set_flashdata("alert", $alert);
                redirect(base_url());

            } else {
                $alert = array(
                    "title" => "Giriş Başarısız !",
                    "text" => "Böyle bir hesap bulunamadı. Lütfen hesap bilgilerinizi kontrol ediniz",
                    "type" => "error",

                );
                $this->session->set_flashdata("alert", $alert);
                redirect(base_url("login"));
            }

        }

    }

    public function logout()
    {
        $this->session->unset_userdata("user");
        redirect(base_url("login"));
    }

    public function forget_password()
    {

        if (get_active_user()) {
            redirect(base_url());
        }
        $viewData = new stdClass();
        $this->load->library("form_validation");

        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "forget_password";

        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
    }

    public function reset_password()
    {
        $this->load->library("form_validation");

        $this->form_validation->set_rules("email", "E-Posta", "required|trim|valid_email");
        $this->form_validation->set_message(
            array(
                "required" => "<b><i>{field}</i></b> alanı boş olamaz",
                "valid_email" => "Lütfen kayıtlı bir <b> E-posta </b> adresi giriniz.",
            )
        );
        if ($this->form_validation->run() == FALSE) {

            $viewData = new stdClass();
            $viewData->viewFolder = $this->viewFolder;
            $viewData->subViewFolder = "forget_password";
            $viewData->form_error = true;

            $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);

        } else {

            $user = $this->Users_model->get(
                array(
                    "isActive" => 1,
                    "email" => $this->input->post("email")
                )
            );
            if ($user) {

                $this->load->helper("string");

                $temp_password =random_string();

               $send =send_email($user->email,"Şifremi Unuttum","Geçici olarak üretilen şifrenizle sisteme giriş yapabilirsiniz. <br> Geçici Şifreniz: <b>{$temp_password}</b>");
                if ($send) {
                    echo "E-posta gönderildi";
                    $this->Users_model->update(
                        array(
                            "id" =>$user->id
                        ),
                        array(
                            "password" =>md5($temp_password)
                        )
                    );
                    $alert = array(
                        "title" => "Giriş Başarılı",
                        "text" => "Şifreniz başarılı şekilde sıfırlandı. Lütfen E-postanızı kontrol ediniz",
                        "type" => "success",

                    );
                    $this->session->set_flashdata("alert", $alert);
                    redirect(base_url("login"));
                    die();

                } else {
                   // echo $this->email->print_debugger();

                    $alert = array(
                        "title" => "İşlem Başarısız !",
                        "text" => "E-posta gönderilirken bir problem oluştu.",
                        "type" => "error",

                    );
                    $this->session->set_flashdata("alert", $alert);
                    redirect(base_url("sifremi-unuttum"));
                    die();
                }


            } else {

                $alert = array(
                    "title" => "Giriş Başarısız !",
                    "text" => "Böyle bir hesap bulunamadı. Lütfen hesap bilgilerinizi kontrol ediniz",
                    "type" => "error",

                );
                $this->session->set_flashdata("alert", $alert);
                redirect(base_url("sifremi-unuttum"));

            }

        }


    }


}