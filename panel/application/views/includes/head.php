<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
<meta name="description" content="Admin, Dashboard, Bootstrap" />
<?php $settings=get_settings(); ?>
<link rel="shortcut icon" sizes="196x196"
    <?php if($settings->logo !="default")  { ?>
      href="<?php echo  base_url("uploads/settings-v/$settings->logo"); ?>"
    <?php } else {?>
      href="<?php echo base_url("assets"); ?>/assets/images/logo.png"
    <?php }?> >

<title><?php echo $settings->company_name; ?></title>
<?php $this->load->view("includes/include_style"); ?>
