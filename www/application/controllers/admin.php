<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('ed_data');
        $this->form_validation->set_error_delimiters('<p class="error_msg">', '</p>');
        $data['title'] = 'Администратор';
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'jpg|gif|png|jpeg';
        $config['max_size'] = '4000';
        $config['encrypt_name'] = TRUE;
        $this->load->library('upload', $config);
        if (!($this->session->userdata(md5('adm_check_ok')) == md5('accepted_111')))
        {
            redirect('/');
        }
    }

    function index()
    {
        $data['title'] = 'Административная панель';
        $this->skin->render('admin_main', $data);
    }

    function edit_it()
    {
        $rel_key = $this->uri->segment('3');
        $data['rel_key'] = $this->uri->segment('3');
        switch ($rel_key)
        {
            case 'main':
            case 'service':
            case 'contacts':
            case 'viasat':
            case 'xtra':
                $rel_id = 1;
                $data['it_id'] = 1;
                break;
            case 'works':
            case 'news':
            case 'article':
                $rel_id = $this->uri->segment('4');
                $data['it_id'] = $this->uri->segment('4');
                $data['item_name'] = $this->req->get_item_name($rel_id, $rel_key);
                break;
        }
        $data['title'] = 'Административная панель';
        $meta_dt = $this->req->get_meta($rel_id, $rel_key);
        $item_data_text = $this->req->get_item_data_text($rel_id, $rel_key);
        $item_data_img = $this->req->get_item_data_img($rel_id, $rel_key);
        $item_data_list = $this->req->get_list_of_item($rel_id, $rel_key);

        if ((!$item_data_img) AND (!$item_data_list) AND (!$item_data_text))
        {
            $this->skin->render('edit_it', $data);
        }
        else
        {

            function arr_merge($text, $img, $list)
            {
                $data_mas = array($text, $img, $list);

                function check($var)
                {
                    return ($var & TRUE);
                }

                $data_mas = array_filter($data_mas, 'check');
                $mas_len = count($data_mas);
                switch ($mas_len)
                {
                    case '1': $a = array('0');
                        $c = array_combine($a, $data_mas);
                        return($c['0']);
                        break;
                    case '2': $a = array('0', '1');
                        $c = array_combine($a, $data_mas);
                        return(array_merge($c[1], $c[0]));
                        break;
                    case '3':
                        $h_mas = array_merge($data_mas[0], $data_mas[1]);
                        return(array_merge($h_mas, $data_mas[2]));
                        break;
                }
            }

            $item_data = arr_merge($item_data_text, $item_data_img, $item_data_list);
            $data['item_data'] = array();
            $quant_mas = count($item_data);
            if (isset($data['item_name']['date']))
            {
                $data['n_date'] = '<div class="adm_block">
                        <form method="post" action="/admin/change_item_date/' . $rel_key . '/' . $rel_id . '"><p>
                            Время публикации новости: ' . date('H:i:s d.m.Y ', $data['item_name']['date']) . '<br/>
                            Чтобы изменить время публикации, введите новое, в таком же формате<br/>
                        <input id="date_in" type class="required" name="date_in" value="" />
                        <input type="submit" value="Изменить дату новости" /></p></form></div>';
            }
            foreach ($item_data as $key => $val)
            {
                if (isset($val['data']))
                {
                    $i_data = '<div class="adm_block"><form method="post" action="/admin/change_block_pos/' . $rel_key . '/' . $rel_id . '/' . $val['id'] . '/' . $val['table_name'] . '"><p>
                        Количество блоков - ' . $quant_mas . '.<br/>Для изменения последовательности блоков, введите номер блока, с которым необходимо поменять местами текущий блок.<br/>
                        Индивидуальный номер блока - <input class="required" size="4" type="text" name="l_numb" value ="' . $val['l_numb'] . '" />
                            <input type="hidden" name="cur_l_numb" value ="' . $val['l_numb'] . '" />
                        <input type="submit" value="Изменить расположение блока" /></p></form>
                        <form method="post" action="/admin/change_text_block/' . $rel_key . '/' . $rel_id . '/' . $val['id'] . '"><p>
                        <textarea class="required" cols="80" rows="5" name="text_data">' . $val['data'] . '</textarea>
                        <input type="submit" value="Изменить содержание блока" /></p></form><a class="del" href="/admin/del_block/' . $rel_key . '/' . $rel_id . '/' . $val['id'] . '">Удалить блок</a></div>';
                }
                elseif (isset($val['link']))
                {
                    $i_data = '<div class="adm_block"><form method="post" action="/admin/change_block_pos/' . $rel_key . '/' . $rel_id . '/' . $val['id'] . '/' . $val['table_name'] . '"><p>
                        Количество блоков - ' . $quant_mas . '.<br/>Для изменения последовательности блоков, введите номер блока, с которым необходимо поменять местами текущий блок.<br/>
                        Индивидуальный номер блока - <input class="required" size="4" type="text" name="l_numb" value ="' . $val['l_numb'] . '" />
                        <input type="hidden" name="cur_l_numb" value ="' . $val['l_numb'] . '" />
                        <input type="submit" value="Изменить расположение блока" /></p></form>
                        <div class="img_bl"><img src="' . $val['link'] . '" alt="" /></div>
                        <form action="/admin/change_desc_img/' . $rel_key . '/' . $rel_id . '/' . $val['id'] . '" method="post"><p>Изменить альтернативное описание изображения:
                        <textarea class="required" cols="80" rows="5" name="alt">' . $val['alt'] . '</textarea><br/>
                        Изменить описание изображения: <textarea class="required" cols="80" rows="5" name="title">' . $val['title'] . '</textarea>
                        <input type="submit" value="Изменить данные изображения" /></p></form>
                        <a class="del" href="/admin/del_img/' . $rel_key . '/' . $rel_id . '/' . $val['id'] . '">Удалить блок</a></div>';
                }
                elseif (isset($val['l_data']))
                {
                    $i_data = '<div class="adm_block"><form method="post" action="/admin/change_block_pos/' . $rel_key . '/' . $rel_id . '/' . $val['l_id'] . '/' . $val['table_name'] . '"><p>
                        Количество блоков - ' . $quant_mas . '.<br/>Для изменения последовательности блоков, введите номер блока, с которым необходимо поменять местами текущий блок.<br/>
                        Индивидуальный номер блока - <input class="required" size="4" type="text" name="l_numb" value ="' . $val['l_numb'] . '" />
                            <input type="hidden" name="cur_l_numb" value ="' . $val['l_numb'] . '" />
                        <input type="submit" value="Изменить расположение блока" /></p></form>';

                    foreach ($val['l_data'] as $l_d_key => $l_d_val)
                    {
                        $i_data .='<form method="post" action="/admin/change_lists_data/' . $rel_key . '/' . $rel_id . '/' . $l_d_val['id'] . '"><p>
                            <textarea class="required" cols="80" rows="3" name="p_l_data">' . $l_d_val['data'] . '</textarea>
                            <input class="required" type="submit" value="Изменить пункт списка" /></p></form>
                            <a class="del" href="/admin/del_list_point/' . $rel_key . '/' . $rel_id . '/' . $l_d_val['id'] . '">Удалить пункт</a><br/><br/>';
                    }
                    $i_data .= '<a href="/admin/add_list_p/' . $rel_key . '/' . $rel_id . '/' . $val['l_id'] . '">Добавить пункт списка</a><br/>
                        <a class="del" href="/admin/del_list/' . $rel_key . '/' . $rel_id . '/' . $val['l_id'] . '">Удалить Список</a></div>';
                }
                $data['item_data'][$val['l_numb']] = $i_data;
            }
            ksort($data['item_data'], SORT_NUMERIC);
            if ($meta_dt)
            {
                $data['meta'] = '<div class="adm_block_meta"><h4>Мета-данные статьи</h4>
                    <form action="/admin/change_meta/' . $rel_key . '/' . $rel_id . '" method="post">
                    <p>Мета-тег описания страницы: <textarea cols="80" rows="5" name="desc">' . $meta_dt['desc'] . '</textarea>
                    Мета-тег ключевых слов страницы для поисковых роботов: <textarea cols="80" rows="5" name="keywords">' . $meta_dt['keywords'] . '</textarea>
                    <input type="submit" value="Изменить мета-теги" /></p></form></div>';
            }
            else
            {
                $data['meta'] = '<div class="adm_block_meta"><h4>Мета-данные статьи</h4>
                    <form action="/admin/add_meta/' . $rel_key . '/' . $rel_id . '" method="post">
                    <p>Мета-тег описания страницы: <textarea cols="80" rows="5" name="desc"></textarea>
                    Мета-тег ключевых слов страницы для поисковых роботов: <textarea cols="80" rows="5" name="keywords"></textarea>
                    <input type="submit" value="Изменить мета-теги" /></p></form></div>';
            }
            $this->skin->render('edit_it', $data);
        }
    }

    function change_name()
    {
        $data['title'] = 'Административная панель';
        $rel_key = $this->uri->segment('3');
        $rel_id = $this->uri->segment('4');
        $data['art_name'] = $this->req->get_item_name($rel_id, $rel_key);
        $this->skin->render('change_it_name', $data);
    }

    function do_change_name()
    {
        $data['title'] = 'Административная панель';
        $this->form_validation->set_message('required', 'Поле %s не заполнено!');
        $this->form_validation->set_rules('new_it_name', 'поле пункта списка', 'required|trim|xss_clean|strip_tags');
        if ($this->form_validation->run() == FALSE)
        {
            $this->change_name();
        }
        else
        {
            $post = $this->input->post();
            if (!$this->ed_data->change_name($post))
            {
                $data['error'] = 'Произошла ошибка при изменении данных';
                $this->skin->render('error', $data);
            }
            else
            {
                $data['success'] = 'Название статьи успешно изменено';
                $data['rel_key'] = $this->uri->segment('3');
                $data['it_id'] = $this->uri->segment('4');
                $this->skin->render('success', $data);
            }
        }
    }

    function change_lists_data()
    {
        $data['title'] = 'Административная панель';
        $rel_key = $this->uri->segment('3');
        $rel_id = $this->uri->segment('4');
        $p_l_id = $this->uri->segment('5');
        $this->form_validation->set_message('required', 'Поле %s не заполнено!');
        $this->form_validation->set_rules('p_l_data', 'поле пункта списка', 'required|trim|xss_clean|callback_my_strip_tags_l');
        if ($this->form_validation->run() == FALSE)
        {
            $this->edit_it();
        }
        else
        {
            $post = $this->input->post();
            $post['p_l_data'] = $this->check_tegs_l($post['p_l_data']);

            if (!$this->ed_data->change_p_l_date($p_l_id, $post))
            {
                $data['error'] = 'Произошла ошибка при изменении данных';
                $this->skin->render('error', $data);
            }
            else
            {
                $data['success'] = 'Данные успешно изменены';
                $data['rel_key'] = $this->uri->segment('3');
                $data['it_id'] = $this->uri->segment('4');
                $this->skin->render('success', $data);
            }
        }
    }

    function change_item_date()
    {
        $data['title'] = 'Административная панель';
        $rel_key = $this->uri->segment('3');
        $rel_id = $this->uri->segment('4');
        $this->form_validation->set_message('required', 'Поле %s не заполнено!');
        $this->form_validation->set_rules('date_in', 'дата', 'required|trim|xss_clean|strip_tags');
        if ($this->form_validation->run() == FALSE)
        {
            $this->edit_it();
        }
        else
        {
            $post = $this->input->post();
            $date = strtotime($post['date_in']);
            if (!$this->ed_data->change_date($rel_id, $date))
            {
                $data['error'] = 'Произошла ошибка при изменении данных';
                $this->skin->render('error', $data);
            }
            else
            {
                $data['success'] = 'Данные успешно изменены';
                $data['rel_key'] = $this->uri->segment('3');
                $data['it_id'] = $this->uri->segment('4');
                $this->skin->render('success', $data);
            }
        }
    }

    function change_text_block()
    {
        $data['title'] = 'Административная панель';
        $rel_key = $this->uri->segment('3');
        $rel_id = $this->uri->segment('4');
        $block_id = $this->uri->segment('5');
        $this->form_validation->set_message('required', 'Поле %s не заполнено!');
        $this->form_validation->set_rules('text_data', 'текстовый блок', 'required|trim|callback_my_strip_tags');
        if ($this->form_validation->run() == FALSE)
        {
            $this->edit_it();
        }
        else
        {
            $post = $this->input->post();
            $post['text_data'] = $this->text_bl_in_check($post['text_data']);
            $post['text_data'] = $this->check_tegs_l($post['text_data']);
            if (!$this->ed_data->change_text_bl($block_id, $post))
            {
                $data['error'] = 'Произошла ошибка при изменении данных';
                $this->skin->render('error', $data);
            }
            else
            {
                $data['success'] = 'Данные успешно изменены';
                $data['rel_key'] = $this->uri->segment('3');
                $data['it_id'] = $this->uri->segment('4');
                $this->skin->render('success', $data);
            }
        }
    }

    function change_meta()
    {
        $data['title'] = 'Административная панель';
        $rel_key = $this->uri->segment('3');
        $rel_id = $this->uri->segment('4');
        $this->form_validation->set_rules('desc', 'desc', 'trim|xss_clean|strip_tags');
        $this->form_validation->set_rules('keywords', 'desc', 'trim|xss_clean|strip_tags');
        if ($this->form_validation->run() == FALSE)
        {
            $this->edit_it();
        }
        else
        {
            $post = $this->input->post();
            if (!$this->ed_data->change_meta_dt($rel_key, $rel_id, $post))
            {
                $data['error'] = 'Произошла ошибка при изменении данных';
                $this->skin->render('error', $data);
            }
            else
            {
                $data['success'] = 'Данные успешно изменены';
                $data['rel_key'] = $this->uri->segment('3');
                $data['it_id'] = $this->uri->segment('4');
                $this->skin->render('success', $data);
            }
        }
    }

    function change_block_pos()
    {
        $data['title'] = 'Административная панель';
        $rel_key = $this->uri->segment('3');
        $rel_id = $this->uri->segment('4');
        $block_id = $this->uri->segment('5');
        $tab_name = $this->uri->segment('6');
        $this->form_validation->set_message('required', 'Поле %s не заполнено!');
        $this->form_validation->set_message('numeric', 'Поле %s должно содержать только цифры!');
        $this->form_validation->set_message('max_length', 'Поле %s должно содержать не более 6 цифры!');
        $this->form_validation->set_rules('l_numb', 'индивидуальный номер блока', 'required|trim|xss_clean|numeric|max_length[6]');
        $this->form_validation->set_rules('cur_l_numb', 'текущий номер блока', 'required|trim|xss_clean|numeric|max_length[6]');
        if ($this->form_validation->run() == FALSE)
        {
            $this->edit_it();
        }
        else
        {
            $post = $this->input->post();
            $all_l_numbs = $this->req->get_all_l_numbs($rel_key, $rel_id);
            foreach ($all_l_numbs as $key)
            {
                if ($key['l_numb'] == $post['l_numb'])
                {
                    if (!$this->ed_data->change_blocks_pos_old($key['id'], $key['table_name'], $post['cur_l_numb']) OR !$this->ed_data->change_blocks_pos_new($block_id, $tab_name, $key['l_numb']))
                    {
                        $data['error'] = 'Произошла ошибка при изменении данных';
                        $this->skin->render('error', $data);
                    }
                    /*       else
                      {
                      $data['success'] = 'Данные успешно изменены';
                      $data['rel_key'] = $this->uri->segment('3');
                      $data['it_id'] = $this->uri->segment('4');
                      $this->skin->render('success', $data);
                      }
                     */
                }
            }
            if (!$this->ed_data->change_blocks_pos_cur($block_id, $tab_name, $post['l_numb']))
            {
                $data['error'] = 'Произошла ошибка. Указанного блока не существует';
                $this->skin->render('error', $data);
            }
            else
            {
                $data['success'] = 'Данные успешно изменены. Блоку присвоен новый индивидуальный номер';
                $data['rel_key'] = $this->uri->segment('3');
                $data['it_id'] = $this->uri->segment('4');
                $this->skin->render('success', $data);
            }
        }
    }

    function change_desc_img()
    {
        $data['title'] = 'Административная панель';
        $rel_key = $this->uri->segment('3');
        $rel_id = $this->uri->segment('4');
        $img_id = $this->uri->segment('5');
        $this->form_validation->set_message('required', 'Поле %s не заполнено!');
        $this->form_validation->set_rules('alt', 'альтернативное описание изображения', 'required|trim|xss_clean|strip_tags|max_length[255]');
        $this->form_validation->set_rules('title', 'описание изображения', 'required|trim|xss_clean|strip_tags|max_length[255]');
        if ($this->form_validation->run() == FALSE)
        {
            $this->edit_it();
        }
        else
        {
            $post = $this->input->post();
            if (!$this->ed_data->change_img_dt($img_id, $post))
            {
                $data['error'] = 'Произошла ошибка при изменении данных изображения';
                $this->skin->render('error', $data);
            }
            else
            {
                $data['success'] = 'Данные успешно изменены';
                $data['rel_key'] = $this->uri->segment('3');
                $data['it_id'] = $this->uri->segment('4');
                $this->skin->render('success', $data);
            }
        }
    }

    function add_list_p()
    {
        $data['title'] = 'Административная панель';
        $data['tab'] = $this->uri->segment('3');
        $data['rel_key'] = $this->uri->segment('4');
        $data['l_id'] = $this->uri->segment('5');
        $data['list_dt'] = $this->req->get_p_of_list($data['l_id']);
        $this->skin->render('add_list_p', $data);
    }

    function add_new_item()
    {
        $data['title'] = 'Административная панель';
        $data['tab'] = $this->uri->segment('3');
        $this->skin->render('new_it_form', $data);
    }

    function add_meta()
    {
        $data['title'] = 'Административная панель';
        $rel_key = $this->uri->segment('3');
        $rel_id = $this->uri->segment('4');
        $this->form_validation->set_rules('desc', 'desc', 'trim|xss_clean|strip_tags');
        $this->form_validation->set_rules('keywords', 'desc', 'trim|xss_clean|strip_tags');
        if ($this->form_validation->run() == FALSE)
        {
            $this->edit_it();
        }
        else
        {
            $post = $this->input->post();
            if (!$this->ed_data->add_meta_dt($rel_key, $rel_id, $post))
            {
                $data['error'] = 'Произошла ошибка при изменении данных';
                $this->skin->render('error', $data);
            }
            else
            {
                $data['success'] = 'Данные успешно добавлены';
                $data['rel_key'] = $this->uri->segment('3');
                $data['it_id'] = $this->uri->segment('4');
                $this->skin->render('success', $data);
            }
        }
    }

    function add_block()
    {
        $rel_key = $this->uri->segment('3');
        $data['rel_key'] = $this->uri->segment('3');
        $block_type = $this->uri->segment('5');
        switch ($rel_key)
        {
            case 'main':
            case 'service':
            case 'contacts':
            case 'viasat':
            case 'xtra':
                $rel_id = 1;
                $data['it_id'] = 1;
                break;
            case 'works':
            case 'news':
            case 'article':
                $rel_id = $this->uri->segment('4');
                $data['it_id'] = $this->uri->segment('4');
                $data['item_name'] = $this->req->get_item_name($rel_id, $rel_key);
                break;
        }
        $data['title'] = 'Административная панель';
        switch ($block_type)
        {
            case 'text':$this->skin->render('add_text_bl', $data);
                break;
            case 'list':$this->skin->render('add_list', $data);
                break;
            case 'img':$this->skin->render('add_img', $data);
                break;
        }
    }

    function do_add_new_p_l()
    {
        $data['title'] = 'Административная панель';
        $this->form_validation->set_message('required', 'Поле %s не заполнено!');
        $this->form_validation->set_rules('p_l_data', 'содержание пункта', 'required|trim|xss_clean|callback_my_strip_tags_l');
        if ($this->form_validation->run() == FALSE)
        {
            $this->add_list_p();
        }
        else
        {
            $post = $this->input->post();
            $post['p_l_data'] = $this->check_tegs_l($post['p_l_data']);
            if (!$this->ed_data->add_new_p_l($post))
            {
                $data['error'] = 'Произошла ошибка при добавлении данных';
                $this->skin->render('error', $data);
            }
            else
            {
                $data['success'] = 'Данные успешно добавлены';
                $data['rel_key'] = $this->uri->segment('3');
                $data['it_id'] = $this->uri->segment('4');
                $this->skin->render('success', $data);
            }
        }
    }

    function do_add_new_item()
    {
        $data['title'] = 'Административная панель';
        $rel_key = $this->uri->segment('3');
        $this->form_validation->set_message('required', 'Поле %s не заполнено!');
        $this->form_validation->set_rules('art_name', 'название статьи', 'required|trim|xss_clean|strip_tags');
        if ($this->form_validation->run() == FALSE)
        {
            $data['tab'] = $this->uri->segment('3');
            $this->skin->render('new_it_form', $data);
        }
        else
        {
            $post = $this->input->post();
            if ($rel_key == 'news')
            {
                $post['date'] = mktime();
            }
            $new_it_id = $this->ed_data->add_new_item($rel_key, $post);
            if (!$new_it_id)
            {
                $data['error'] = 'Произошла ошибка при добавлении данных';
                $this->skin->render('error', $data);
            }
            else
            {
                redirect("/admin/edit_it/{$rel_key}/{$new_it_id}");
            }
        }
    }

    function do_add_text_bl()
    {
        $data['title'] = 'Административная панель';
        $rel_key = $this->uri->segment('3');
        $rel_id = $this->uri->segment('4');
        $this->form_validation->set_message('required', 'Поле %s не заполнено!');
        $this->form_validation->set_rules('text_data', 'текстовый блок', 'required|trim|callback_my_strip_tags');
        if ($this->form_validation->run() == FALSE)
        {
            $this->add_block();
        }
        else
        {
            $post = $this->input->post();
            $post['text_data'] = $this->text_bl_in_check($post['text_data']);
            $post['text_data'] = $this->check_tegs_l($post['text_data']);
            $c_mas = $this->req->get_last_l_numb($rel_key, $rel_id);
            arsort($c_mas);
            $max_l_numb = array_shift($c_mas);
            $last_l_numb = $max_l_numb + 1;
            if (!$this->ed_data->add_text_bl($rel_key, $rel_id, $last_l_numb, $post))
            {
                $data['error'] = 'Произошла ошибка при добавлении данных';
                $this->skin->render('error', $data);
            }
            else
            {
                $data['success'] = 'Данные успешно добавлены';
                $data['rel_key'] = $this->uri->segment('3');
                $data['it_id'] = $this->uri->segment('4');
                $this->skin->render('success', $data);
            }
        }
    }

    function do_add_list()
    {
        $data['title'] = 'Административная панель';
        $rel_key = $this->uri->segment('3');
        $rel_id = $this->uri->segment('4');
        $this->form_validation->set_message('required', 'Поле %s не заполнено!');
        $this->form_validation->set_rules('list_data', 'список пунктов', 'required|trim|xss_clean|callback_my_strip_tags_l');
        if ($this->form_validation->run() == FALSE)
        {
            $this->add_block();
        }
        else
        {
            $post = $this->input->post();
            $post['list_data'] = $this->check_tegs_l($post['list_data']);
            $list_dt = explode(';', $post['list_data']);
            $list_dt_cl = array();
            foreach ($list_dt as $value)
            {
                $value = trim($value);
                if (!empty($value))
                {
                    array_push($list_dt_cl, $value);
                }
                else
                    continue;
            }
            $c_mas = $this->req->get_last_l_numb($rel_key, $rel_id);
            arsort($c_mas);
            $max_l_numb = array_shift($c_mas);
            $last_l_numb = $max_l_numb + 1;
            if (!$this->ed_data->add_list($rel_key, $rel_id, $last_l_numb, $list_dt_cl))
            {
                $data['error'] = 'Произошла ошибка при добавлении данных';
                $this->skin->render('error', $data);
            }
            else
            {
                $data['success'] = 'Данные успешно добавлены';
                $data['rel_key'] = $this->uri->segment('3');
                $data['it_id'] = $this->uri->segment('4');
                $this->skin->render('success', $data);
            }
        }
    }

    function do_add_img()
    {
        $data['title'] = 'Административная панель';
        $rel_key = $this->uri->segment('3');
        $rel_id = $this->uri->segment('4');
        $this->form_validation->set_message('required', 'Поле %s не заполнено!');
        $this->form_validation->set_rules('alt', 'альтернативное описание изображения', 'required|trim|xss_clean|strip_tags');
        $this->form_validation->set_rules('title', 'описание изображения', 'required|trim|xss_clean|strip_tags');
        if ($this->form_validation->run() == FALSE)
        {
            $this->add_block();
        }
        else
        {
            if ($_FILES['img']['name'] != '')
            {
                $config['upload_path'] = './uploads/';
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['max_size'] = '4000';
                $config['encrypt_name'] = TRUE;
                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('img'))
                {
                    $this->add_block();
                    return FALSE;
                }
                else
                {
                    $post = $this->input->post();
                    $c_mas = $this->req->get_last_l_numb($rel_key, $rel_id);
                    arsort($c_mas);
                    $max_l_numb = array_shift($c_mas);
                    $last_l_numb = $max_l_numb + 1;
                    $file = $this->upload->data();
                    $post['file_link'] = '/uploads/' . $file['file_name'];
                    $img_width = $file['image_width'];
                    $img_height = $file['image_height'];
                    $rel_scale = $img_width / $img_height;
                    $new_height = 650 / $rel_scale;
                    if (!$this->ed_data->add_new_img($rel_key, $rel_id, $last_l_numb, $post))
                    {
                        $data['error'] = 'Произошла ошибка при добавлении изображения';
                        $this->skin->render('error', $data);
                    }
                    else
                    {
                        if (($img_width >= '650'))
                        {
                            $this->load->library('image_lib');
                            $config['image_library'] = 'GD2';
                            $config['source_image'] = '.' . $post['file_link'];
                            $config['maintain_ratio'] = TRUE;
                            $config['width'] = '650';
                            $config['height'] = $new_height;
                            $config['master_dim'] = 'width';

                            $this->image_lib->initialize($config);

                            if (!$this->image_lib->resize())
                            {
                                $data['title'] = "Ошибка";
                                $data['error'] = "Произошла ошибка при добавлении изображения" . $this->image_lib->display_errors();
                                $this->skin->render('error', $data);
                            }
                        }
                        $data['success'] = 'Изображение успешно добавлено';
                        $data['rel_key'] = $this->uri->segment('3');
                        $data['it_id'] = $this->uri->segment('4');
                        $this->skin->render('success', $data);
                    }
                }
            }
            else
            {
                $data['title'] = "Ошибка";
                $data['error'] = "Не выбран файл изображения";
                $this->skin->render('error', $data);
            }
        }
    }

    function edit_works()
    {
        $data['title'] = 'Административная панель';
        $data['section'] = '"Наши работы"';
        $data['tab'] = 'works';
        $data['items_of_sec'] = $this->req->get_items_of_section($data['tab']);
        $this->skin->render('items_of_sec', $data);
    }

    function edit_news()
    {
        $data['title'] = 'Административная панель';
        $data['section'] = '"Новости"';
        $data['tab'] = 'news';
        $data['items_of_sec'] = $this->req->get_items_of_section($data['tab']);
        $this->skin->render('items_of_sec', $data);
    }

    function edit_article()
    {
        $data['title'] = 'Административная панель';
        $data['section'] = '"Статьи"';
        $data['tab'] = 'article';
        $data['items_of_sec'] = $this->req->get_items_of_section($data['tab']);
        $this->skin->render('items_of_sec', $data);
    }

    function del_img()
    {
        $data['title'] = 'Административная панель';
        $img_id = $this->uri->segment(5);
        $res = $this->ed_data->get_img($img_id);
        if (!unlink('.' . $res['link']))
        {
            $data['title'] = "Ошибка";
            $data['error'] = "Возникла ошибка при удалении изображения";
            $this->skin->render('error', $data);
        }
        else
        {
            if (!$this->ed_data->del_img($img_id))
            {
                $data['title'] = "Ошибка";
                $data['error'] = "Возникла ошибка при удалении изображения";
                $this->skin->render('error', $data);
            }
            else
            {
                $data['success'] = 'Изображение успешно удалено';
                $data['rel_key'] = $this->uri->segment('3');
                $data['it_id'] = $this->uri->segment('4');
                $this->skin->render('success', $data);
            }
        }
    }

    function del_block()
    {
        $data['title'] = 'Административная панель';
        $bl_id = $this->uri->segment(5);
        if (!$this->ed_data->del_block($bl_id))
        {
            $data['title'] = "Ошибка";
            $data['error'] = "Возникла ошибка при удалении блока";
            $this->skin->render('error', $data);
        }
        else
        {
            $data['success'] = 'Блок успешно удален';
            $data['rel_key'] = $this->uri->segment('3');
            $data['it_id'] = $this->uri->segment('4');
            $this->skin->render('success', $data);
        }
    }

    function del_list_point()
    {
        $data['title'] = 'Административная панель';
        $p_l_id = $this->uri->segment(5);
        if (!$this->ed_data->del_p_l($p_l_id))
        {
            $data['title'] = "Ошибка";
            $data['error'] = "Возникла ошибка при удалении пункта списка";
            $this->skin->render('error', $data);
        }
        else
        {
            $data['success'] = 'Пункт списка успешно удален';
            $data['rel_key'] = $this->uri->segment('3');
            $data['it_id'] = $this->uri->segment('4');
            $this->skin->render('success', $data);
        }
    }

    function del_list()
    {
        $data['title'] = 'Административная панель';
        $l_id = $this->uri->segment(5);
        if (!$this->ed_data->del_list($l_id))
        {
            $data['title'] = "Ошибка";
            $data['error'] = "Возникла ошибка при удалении списка";
            $this->skin->render('error', $data);
        }
        else
        {
            $data['success'] = 'Список успешно удален';
            $data['rel_key'] = $this->uri->segment('3');
            $data['it_id'] = $this->uri->segment('4');
            $this->skin->render('success', $data);
        }
    }

    function del_item()
    {
        $data['title'] = 'Административная панель';
        if (!$this->ed_data->del_t_b_of_item())
        {
            $data['title'] = "Ошибка";
            $data['error'] = "Возникла ошибка при удалении статьи";
            $this->skin->render('error', $data);
            return FALSE;
        }
        else
        {
            if ($l_id_item = $this->req->get_l_id_item())
            {
                foreach ($l_id_item as $key => $val)
                {
                    if (!$this->ed_data->del_list($val['id']))
                    {
                        $data['title'] = "Ошибка";
                        $data['error'] = "Возникла ошибка при удалении статьи";
                        $this->skin->render('error', $data);
                        return FALSE;
                    }
                }
            }
            if ($img_dt = $this->req->get_img_data())
            {
                foreach ($img_dt as $img_val)
                {
                    if (!unlink('.' . $img_val['link']))
                    {
                        $data['title'] = "Ошибка";
                        $data['error'] = "Возникла ошибка при удалении статьи";
                        $this->skin->render('error', $data);
                        return FALSE;
                    }
                    else
                    {
                        if (!$this->ed_data->del_img($img_val['id']))
                        {
                            $data['title'] = "Ошибка";
                            $data['error'] = "Возникла ошибка при удалении статьи";
                            $this->skin->render('error', $data);
                            return FALSE;
                        }
                    }
                }
            }
            if (!$this->ed_data->del_meta())
            {
                $data['title'] = "Ошибка";
                $data['error'] = "Возникла ошибка при удалении статьи";
                $this->skin->render('error', $data);
                return FALSE;
            }
            if (!$this->ed_data->del_item_name())
            {
                $data['title'] = "Ошибка";
                $data['error'] = "Возникла ошибка при удалении статьи";
                $this->skin->render('error', $data);
                return FALSE;
            }
            $data['success'] = 'Статья успешно удалена';
            $data['rel_key'] = $this->uri->segment('3');
            $data['it_id'] = $this->uri->segment('4');
            $this->skin->render('del_item_success', $data);
        }
    }

    function go_exit()
    {
        $this->session->sess_destroy();
        redirect('/main/');
    }

    function my_strip_tags($str)
    {
        return strip_tags($str, '<iframe><h3><h4><strong><em><a>');
    }

    function my_strip_tags_l($str)
    {
        return strip_tags($str, '<strong><em><a>');
    }

    function text_bl_in_check($text_data)
    {
        $pattern = '/(<iframe)/';
        $pat_h = '/<h3|<h4/';
        $text_data = preg_replace('/(<div(?:.*?)+>)|(<[\/]*d*i*v*>)|(<p(?:.*?)+>)|(<[\/]*p*>)|(<p>*)/i', '', $text_data);
        if (preg_match($pattern, $text_data))
        {
            $text_data = '<div class="video_bl">' . $text_data . '</div>';
        }
        elseif (!preg_match($pat_h, $text_data))
        {
            $text_data = '<p class="p_bl">' . $text_data . '</p>';
        }
        return $text_data;
    }

    function check_tegs_l($dt)
    {
        $tegs_arr = array(
            'strong' => array('/(<strong>)|(<\/strong>)/i', '<strong>', '</strong>'),
            'em' => array('/(<em>)|(<\/em>)/i', '<em>', '</em>'),
            'h3' => array('/(<h3>)|(<\/h3>)/i', '<h3>', '</h3>'),
            'h4' => array('/(<h4>)|(<\/h4>)/i', '<h4>', '</h4>'));
        foreach ($tegs_arr as $teg_val)
        {
            $reg = preg_match_all($teg_val[0], $dt, $out);
            $arr_1 = array();
            $arr_2 = array();
            foreach ($out[1] as $val_1)
            {
                if (!empty($val_1))
                    array_push($arr_1, $val_1);
            }
            foreach ($out[2] as $val_2)
            {
                if (!empty($val_2))
                    array_push($arr_2, $val_2);
            }
            if (count($arr_1) != count($arr_2))
            {
                $dt = preg_replace($teg_val[0], '', $dt);
                return $dt;
            }
            else
            {
                $arr_l = count($out[0]);
                for ($i = 0; $i < $arr_l; $i++)
                {
                    if ($out[0][$i] == $arr_1[0] && $out[0][$i + 1] != $teg_val[2])
                    {
                        echo $teg_val[2];
                        $dt = preg_replace($teg_val[0], '', $dt);
                        return $dt;
                    }
                }
            }
        }
        preg_match_all('/(<a(?:.*?)+>)/i', $dt, $tot_a);
        if (!preg_match_all('/(<a href=(?:.*?)+>)(?:.*?)(<\/a>)/i', $dt, $o))
        {
            return $dt = preg_replace('/(<a(?:.*?)+>)|(<[\/]*a*>)/i', '', $dt);
        }
        elseif (count($tot_a[0]) != count($o[0]))
        {
            return $dt = preg_replace('/(<a(?:.*?)+>)|(<[\/]*a*>)/i', '', $dt);
        }
        else
            return $dt;
    }

}
