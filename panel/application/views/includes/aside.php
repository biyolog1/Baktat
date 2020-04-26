<?php $user = get_active_user(); ?>
<?php $settings=get_settings(); ?>

<aside id="menubar" class="menubar light">
    <div class="app-user">
        <div class="media">
            <div class="media-left">
                <div class="avatar avatar-md avatar-circle">
                    <a href="javascript:void(0)"><img class="img-responsive"
                                                      src="<?php echo base_url("uploads"); ?>/users-v/<?php echo $user->img_url; ?>"
                                                      alt="avatar"/></a>
                </div><!-- .avatar -->
            </div>
            <div class="media-body">
                <div class="foldable">
                    <h5><a href="javascript:void(0)" class="username"> <?php echo $user->full_name; ?></a></h5>
                    <ul>
                        <li class="dropdown">
                            <a href="javascript:void(0)" class="dropdown-toggle usertitle" data-toggle="dropdown"
                               aria-haspopup="true" aria-expanded="false">
                                <small>İşlemler</small>
                                <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu animated flipInY">
                                <li>
                                    <a class="text-color" href="<?php echo base_url(); ?>">
                                        <span class="m-r-xs"><i class="fa fa-home"></i></span>
                                        <span>Anasayfa</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="text-color" href="<?php echo base_url("Users/update_form/$user->id"); ?>">
                                        <span class="m-r-xs"><i class="fa fa-user"></i></span>
                                        <span>Hesap Bilgilerim</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="text-color"
                                       href="<?php echo base_url("Users/update_password_form/$user->id"); ?>">
                                        <span class="m-r-xs"><i class="fa fa-key"></i></span>
                                        <span>Şifremi Değiştir</span>
                                    </a>
                                </li>


                                <li role="separator" class="divider"></li>
                                <li>
                                    <a class="text-color" href="<?php echo base_url("logout"); ?>">
                                        <span class="m-r-xs"><i class="fa fa-power-off"></i></span>
                                        <span>Sistemden Çıkış</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div><!-- .media-body -->
        </div><!-- .media -->
    </div><!-- .app-user -->

    <div class="menubar-scroll">
        <div class="menubar-scroll-inner">
            <ul class="app-menu">
                <li class="menu-separator">
                    <hr>
                </li>
                <li>
                    <a href="javascript:void(0)">
                        <i class="menu-icon zmdi zmdi-view-dashboard zmdi-hc-lg"></i>
                        <span class="menu-text">Dashboards</span>
                    </a>
                </li>

                <li>
                    <a href="<?php echo base_url("Galleries"); ?>">
                        <i class="menu-icon zmdi zmdi-apps zmdi-hc-lg"></i>
                        <span class="menu-text">Medya Dosyaları</span>
                    </a>
                </li>

                <li>
                    <a href="javascript:void(0)">
                        <i class="menu-icon zmdi zmdi-layers zmdi-hc-lg"></i>
                        <span class="menu-text">Sliders</span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo base_url("Product"); ?>">
                        <i class="menu-icon fa fa-cubes"></i>
                        <span class="menu-text">Ürünler</span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo base_url("Services"); ?>">
                        <i class="menu-icon fa fa-cutlery"></i>
                        <span class="menu-text">Hizmetler</span>
                    </a>
                </li>
                <li class="has-submenu">
                    <a href="javascript:void(0)" class="submenu-toggle">
                        <i class="menu-icon fa fa-asterisk"></i>
                        <span class="menu-text">Portfolyo İşlemleri</span>
                        <i class="menu-caret zmdi zmdi-hc-sm zmdi-chevron-right"></i>
                    </a>
                    <ul class="submenu">
                        <li><a href="<?php echo base_url("Portfolio_categories"); ?>">
                        <span class="menu-text">Portfolyo Kategorileri</span>
                    </a></li>
                        <li><a href="<?php echo base_url("Portfolios"); ?>">
                        <span class="menu-text">Portfolyo</span>
                    </a></li>
                    </ul>
                </li>
                <li>
                    <a href="<?php echo base_url("News"); ?>">
                        <i class="menu-icon fa fa-newspaper-o"></i>
                        <span class="menu-text">Haberler</span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo base_url("Brands"); ?>">
                        <i class="menu-icon fa fa-shopping-bag"></i>
                        <span class="menu-text">Markalar</span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo base_url("Courses"); ?>">
                        <i class="menu-icon fa fa-certificate"></i>
                        <span class="menu-text">Sertifikalar</span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo base_url("References"); ?>">
                        <i class="menu-icon zmdi zmdi-check zmdi-hc-lg"></i>
                        <span class="menu-text">Referanslar</span>
                    </a>
                </li>
                <li>
                    <a href="javascript:void(0)">
                        <i class="menu-icon zmdi zmdi-lamp zmdi-hc-lg"></i>
                        <span class="menu-text">PopUp Hizmeti</span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo base_url("Users"); ?>">
                        <i class="menu-icon fa fa-users"></i>
                        <span class="menu-text">Kullanıcılar</span>
                    </a>
                </li>
                <li class="menu-separator">
                    <hr>
                </li>
                <li>
                    <a href="<?php echo base_url("Settings"); ?>">
                        <i class="menu-icon zmdi zmdi-settings zmdi-hc-lg"></i>
                        <span class="menu-text">Site Ayarları</span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo base_url("Emailsettings"); ?>">
                        <i class="menu-icon zmdi zmdi-email-open zmdi-hc-lg"></i>
                        <span class="menu-text">E-posta Ayarları</span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo base_url("logout"); ?>">
                        <i class="menu-icon zmdi zmdi-power-off zmdi-hc-lg"></i>
                        <span class="menu-text">Sistemden Çıkış</span>
                    </a>
                </li>


            </ul><!-- .app-menu -->
        </div><!-- .menubar-scroll-inner -->
    </div><!-- .menubar-scroll -->
</aside>
<!--========== END app aside -->