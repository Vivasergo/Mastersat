<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>
            <?php
            if (isset($title) and $title != '')
                {
                echo $title;
                }
            else
                echo 'Mastersat'
                ?></title>
        <link rel="stylesheet" type="text/css" href="/css/main_css.css" />
        <script src="/js/jquery.js" type="text/javascript"></script>
        <script src="/js/js.js" type="text/javascript"></script>
        <script src="/js/maskedinput.js" type="text/javascript"></script>
        <!--     <script src="js/lightbox.js"></script>
             <link href="css/lightbox.css" rel="stylesheet" />
        -->
        <meta name="keywords" content="<?php echo $meta['keywords']; ?>" />
        <meta name="description" content="<?php echo $meta['desc']; ?>" />
        <link type="image/x-icon" href="/img/x_icon.png" rel="icon" />

    </head>
    <body>
        <div id="main_cont">
            <div id="header">
                <div <?php if (isset($adm_tab)) echo $adm_tab; ?> id="bg_adm">
                    <div onclick="display_off();" class="bg_table_adm"></div>
                    <div class="table_adm">
                        <h5>Вход для администратора</h5>
                        <?php
                        if (isset($err_msg))
                            echo '<p class="error_msg">' . $err_msg . '</p>';
                        ?>
                        <?php echo form_error('log', '<p class="error_msg">', '</p>') ?>
                        <?php echo form_error('pass', '<p class="error_msg">', '</p>') ?>
                        <form action="/main/enter/" method="post">
                            <p>
                                Логин:<br/> <input class="required" type="text" name="log" /><br/>
                                Пароль:<br/> <input class="required" type="password" name="pass" /><br/>
                                <input type="submit" value="Вход" />
                            </p>
                        </form>
                    </div>
                </div>
                <div class="gray_bg">
                    <div class="warn">
                        <h3>Подтвердите удаление</h3>
                        <a class="confirm" href="">Удалить</a>
                        <a class="cancel" href="javascript:void=0">Отменить</a>
                    </div>
                </div>
                <div class="top_h">
                    <div class="logo">
                        <a href="/"><img src="/img/logo1.png" alt="" /></a>
                    </div>
                    <div class="call">
                        Контактный телефон:
                        <p>+38 097 450 3675</p>
                    </div>
                    <div class="e_mail">
                        Написать нам:
                        <p><a href="mailto:info@mastersat.com.ua">info@mastersat.com.ua</a></p>
                    </div>
                    <div class="share">
                        <script type="text/javascript" src="//yandex.st/share/share.js" charset="utf-8"></script>
                        <div class="yashare-auto-init" data-yashareL10n="ru" data-yashareType="none" data-yashareQuickServices="vkontakte,facebook,odnoklassniki"></div>
                    </div>
                    <div class="search">
                        <form action="/main/search/" method="post" name="search">
                            <p>
                                <input class="required" id="search" type="text" value="поиск по сайту" name="search_field" />
                                <input type="submit" value="" />
                            </p>
                        </form>
                    </div>
                </div>