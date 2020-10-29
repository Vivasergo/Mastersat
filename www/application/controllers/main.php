<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Main extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->form_validation->set_error_delimiters('<p class="error_msg">', '</p>');
    }

    public function index($adm_dt = '') {
        if (isset($adm_dt['adm_tab'])) {
            $data['adm_tab'] = $adm_dt['adm_tab'];
        }
        if (isset($adm_dt['err_msg'])) {
            $data['err_msg'] = $adm_dt['err_msg'];
        }
        $data['title'] = 'Главная. Mastersat';
        $data['main'] = 'main';
        $data['meta'] = $this->req->get_meta(1, 'main');
        $item_data_text = $this->req->get_item_data_text(1, 'main');
        $item_data_img = $this->req->get_item_data_img(1, 'main');
        $item_data_list = $this->req->get_item_data_list(1, 'main');

        if ((!$item_data_img) AND (!$item_data_list) AND (!$item_data_text)) {
            $this->skin->render('no_art', $data);
        } else {

            function arr_merge($text, $img, $list) {
                $data_mas = array($text, $img, $list);

                function check($var) {
                    return ($var & TRUE);
                }

                $data_mas = array_filter($data_mas, 'check');
                $mas_len = count($data_mas);
                switch ($mas_len) {
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
            foreach ($item_data as $key => $val) {

                if (isset($val['data'])) {
                    $i_data = '<div class="item_bl">' . $val['data'] . '</div>';
                } elseif (isset($val['link'])) {
                    $i_data = '<div class="img_bl"><img src="' . $val['link'] . '" alt="' . $val['alt'] . '" title="' . $val['title'] . '" /></div>';
                } elseif (isset($val['l_data'])) {
                    $i_data = '<div class="list_bl"><ul>' . $val['l_data'] . '</ul></div>';
                }
                $data['item_data'][$val['l_numb']] = $i_data;
            }
            ksort($data['item_data'], SORT_NUMERIC);
            $this->skin->render('right_cont', $data);
        }
    }

    function enter() {
        $this->form_validation->set_message('required', 'Поле не заполнено!');
        $this->form_validation->set_message('min_length', 'Логин должен быть не менее 5 символов!');
        $this->form_validation->set_rules('pass', 'Пароль', 'trim|required|xss_clean|strip_tags|md5');
        $this->form_validation->set_rules('log', 'Логин', 'trim|required|xss_clean|strip_tags|min_length[5]');
        if ($this->form_validation->run() == FALSE) {
            $adm_dt['adm_tab'] = 'style="display:block"';
            $this->index($adm_dt);
        } else {
            $post = $this->input->post();
            $log = $post['log'];
            $pass = $post['pass'];
            if ($adm_data = $this->req->adm_check($log)) {
                if (($adm_data['log'] == $log) && ($adm_data['pass']) == $pass) {
                    $ses_mass = array(md5('adm_check_ok') => md5('accepted_111'));
                    $this->session->set_userdata($ses_mass);
                    $data['title'] = 'Административная панель';
                    $this->skin->render('admin_main', $data);
                } else {
                    $adm_dt['adm_tab'] = 'style="display:block"';
                    $adm_dt['err_msg'] = "Произошла ошибка. Логин или пароль введены не верно";
                    $this->index($adm_dt);
                }
            } else {
                $adm_dt['adm_tab'] = 'style="display:block"';
                $adm_dt['err_msg'] = "Произошла ошибка. Логин или пароль введены не верно";
                $this->index($adm_dt);
            }
        }
    }

    function search() {
        if ($this->input->post('search_field') == '') {
            redirect('/');
        }
        $this->form_validation->set_message('required', 'Поле %s не заполнено!');
        $this->form_validation->set_rules('search_field', 'search', 'required|trim|xss_clean|strip_tags');
        if ($this->form_validation->run() == FALSE) {
            redirect('/');
        } else {
            $post = $this->input->post();
            $data['title'] = 'Результат поиска';
            $data['search'] = $this->req->search($post);
            $this->skin->render('search_res', $data);
        }
    }

    function map() {
        $data['title'] = 'Карта сайта';
        $data['all_prod'] = $this->req->get_all_prod();
        $cats = array();
        foreach ($data['all_prod'] as $val) {
            array_push($cats, $val['cat_id']);
        }
        $data['prods'] = $this->req->get_prods_by_cat($cats);
        $data['cats'] = $this->req->get_cats_with_prods($cats);
        $this->skin->render('map', $data);
    }

}
