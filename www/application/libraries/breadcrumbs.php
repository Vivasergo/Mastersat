<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Breadcrumbs
    {

    public function get_breadcrumbs($data)
        {
        $CI = & get_instance();

        if (isset($data['main']) && $data['main'] == 'main')
            {
            $data['breadcrumbs']['s1'] = "<ul><li>Главная</li></ul>";
            }
        elseif ($CI->session->userdata(md5('adm_check_ok')))
            {
            $data['breadcrumbs']['s1'] = "<ul><li>Административная панель</li></ul>";
            }
        elseif (isset($data['error']))
            {
            $data['breadcrumbs']['s1'] = "<ul><li>Ошибка</li></ul>";
            }
        elseif ($CI->uri->segment(1) == 'tv')
            {
            $data['breadcrumbs']['s1'] = "<ul><li><a href=\"/\">Главная</a></li>";
                {
                if ($CI->uri->segment(2) == 'viasat')
                    {
                    $data['breadcrumbs']['s2'] = "<li><span></span>Viasat</li></ul>";
                    }
                if ($CI->uri->segment(2) == 'xtra')
                    {
                    $data['breadcrumbs']['s2'] = "<li><span></span>Xtra</li></ul>";
                    }
                }
            }
        elseif ($CI->uri->segment(1) == 'works')
            {
            $data['breadcrumbs']['s1'] = "<ul><li><a href=\"/\">Главная</a></li>";
                {
                if ($CI->uri->segment(2) == '')
                    {
                    $data['breadcrumbs']['s2'] = "<li><span></span>Наши работы</li></ul>";
                    }
                if ($CI->uri->segment(2) == 'item')
                    {
                    $data['breadcrumbs']['s2'] = "<li><span></span><a href=\"/works/\">Наши работы</a></li>
                            <li><span></span>" . $data['item']['name'] . "</li></ul>";
                    }
                }
            }
        elseif ($CI->uri->segment(1) == 'news')
            {
            $data['breadcrumbs']['s1'] = "<ul><li><a href=\"/\">Главная</a></li>";
                {
                if ($CI->uri->segment(2) == '')
                    {
                    $data['breadcrumbs']['s2'] = "<li><span></span>Новости</li></ul>";
                    }
                if ($CI->uri->segment(2) == 'item')
                    {
                    $data['breadcrumbs']['s2'] = "<li><span></span><a href=\"/news/\">Новости</a></li>
                            <li><span></span>" . $data['item']['name'] . "</li></ul>";
                    }
                }
            }
        elseif ($CI->uri->segment(1) == 'article')
            {
            $data['breadcrumbs']['s1'] = "<ul><li><a href=\"/\">Главная</a></li>";
                {
                if ($CI->uri->segment(2) == '')
                    {
                    $data['breadcrumbs']['s2'] = "<li><span></span>Статьи</li></ul>";
                    }
                if ($CI->uri->segment(2) == 'item')
                    {
                    $data['breadcrumbs']['s2'] = "<li><span></span><a href=\"/article/\">Статьи</a></li>
                            <li><span></span>" . $data['item']['name'] . "</li></ul>";
                    }
                }
            }
        else
            {
            $data['breadcrumbs']['s1'] = "<ul><li><a href=\"/\">Главная</a></li>";
            switch ($CI->uri->segment(1))
                {
                case 'service':$data['breadcrumbs']['s2'] = "<li><span></span>Сервис</li></ul>";
                    break;
                case 'contacts':$data['breadcrumbs']['s2'] = "<li><span></span>Контакты</li></ul>";
                    break;
                case 'search':$data['breadcrumbs']['s2'] = "<li><span></span>Результаты поиска</li></ul>";
                    break;
                case 'map':$data['breadcrumbs']['s2'] = "<li><span></span>Карта сайта</li></ul>";
                    break;
                case 'mail_us':$data['breadcrumbs']['s2'] = "<li><span></span>Отправить сообщение</li></ul>";
                    break;
                case 'docs':$data['breadcrumbs']['s2'] = "<li><span></span>Разрешительные документы</li></ul>";
                    break;
                }
            }
        return $data['breadcrumbs'];
        }

    }