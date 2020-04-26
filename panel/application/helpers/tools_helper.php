<?php
function convertToSeo($text)
{

    $turkce = array("ç", "Ç", "ğ", "Ğ", "ü", "Ü", "ö", "Ö", "ı", "İ", "ş", "Ş", ".", ",", "!", "'", "\"", " ", "?", "*", "_", "|", "<", ">", "=", "(", ")", "[", "]", "{", "}", "+", "/", "$", "#", "@", "%", "&", "é");
    $convert = array("c", "c", "g", "g", "u", "u", "o", "o", "i", "i", "s", "s", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-");

    return strtolower(str_replace($turkce, $convert, $text));

}

function get_readable_date($date)
{
    setlocale(LC_ALL, 'tr_TR.utf-8');
    setlocale(LC_CTYPE, 'C');
    return strftime('%e %B %Y', strtotime($date));
}

function get_active_user()
{
    $t = &get_instance();
    $user = $t->session->userdata("user");
    if ($user)
        return $user;
    else
        return false;
}

function send_email($toEmail = "", $subject = "", $message = "")
{

    $t =& get_instance();
    $t->load->model("Emailsettings_model");

    $email_settings = $t->Emailsettings_model->get(
        array(
            "isActive" => 1
        )
    );

    $config = array(
        "protocol" => $email_settings->protocol,
        "smtp_host" => $email_settings->host,
        "smtp_port" => $email_settings->port,
        "smtp_user" => $email_settings->user,
        "smtp_pass" => $email_settings->password,
        "starttls" => true,
        "charset" => "utf-8",
        "mailtype" => "html",
        "wordwrap" => true,
        "newline" => "\r\n",
    );

    $t->load->library("email", $config);
    $t->email->from($email_settings->from, $email_settings->user_name);
    $t->email->to($toEmail);
    $t->email->subject($subject);
    $t->email->message($message);

    return $t->email->send();
}

function get_settings()
{
    $t =& get_instance();
    $t->load->model("Settings_model");
    if ($t->session->userdata("settings")) {
        $settings = $t->session->userdata("settings");
    } else {

        $settings = $t->Settings_model->get();
        if (!$settings) {
            $settings = new stdClass();
            $settings->company_name = "CNTP";
            $settings->logo = "default";
        }
        $t->session->set_userdata("settings", $settings);
    }

    return $settings;
}
function get_category_title($category_id = 0){
    $t =& get_instance();
    $t->load->model("Portfolio_categories_model");
    $category = $t->Portfolio_categories_model->get(
        array(
            "id" => $category_id
        )
    );
    if($category) return $category->title;
    else
        return "<b style='color: red'>Tanımlı Değil</b>";
}


