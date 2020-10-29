<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tv extends CI_Controller
    {

    function __construct()
        {
        parent::__construct();
        }

    public function index()
        {
        redirect('/');
        }

    function xtra()
        {
        $data['title'] = 'Xtra TV';
        $data['meta'] = $this->req->get_meta(1, 'xtra');
        $item_data_text = $this->req->get_item_data_text(1, 'xtra');
        $item_data_img = $this->req->get_item_data_img(1, 'xtra');
        $item_data_list = $this->req->get_item_data_list(1, 'xtra');

        if ((!$item_data_img) AND (!$item_data_list) AND (!$item_data_text))
            {
           $this->skin->render('no_art',$data);
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
            foreach ($item_data as $key => $val)
                {

                if (isset($val['data']))
                    {
                    $i_data = '<div class="item_bl">' . $val['data'] . '</div>';
                    }
                elseif (isset($val['link']))
                    {
                    $i_data = '<div class="img_bl"><img src="' . $val['link'] . '" alt="' . $val['alt'] . '" title="' . $val['title'] . '" /></div>';
                    }
                elseif (isset($val['l_data']))
                    {
                    $i_data = '<div class="list_bl"><ul>' . $val['l_data'] . '</ul></div>';
                    }
                $data['item_data'][$val['l_numb']] = $i_data;
                }
            ksort($data['item_data'], SORT_NUMERIC);
            $this->skin->render('xtra', $data);
            }
        }

    function viasat()
        {
        $data['title'] = 'viasat';
        $data['meta'] = $this->req->get_meta(1, 'viasat');
        $item_data_text = $this->req->get_item_data_text(1, 'viasat');
        $item_data_img = $this->req->get_item_data_img(1, 'viasat');
        $item_data_list = $this->req->get_item_data_list(1, 'viasat');

        if ((!$item_data_img) AND (!$item_data_list) AND (!$item_data_text))
            {
            $this->skin->render('no_art',$data);
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
            foreach ($item_data as $key => $val)
                {

                if (isset($val['data']))
                    {
                    $i_data = '<div class="item_bl">' . $val['data'] . '</div>';
                    }
                elseif (isset($val['link']))
                    {
                    $i_data = '<div class="img_bl"><img src="' . $val['link'] . '" alt="' . $val['alt'] . '" title="' . $val['title'] . '" /></div>';
                    }
                elseif (isset($val['l_data']))
                    {
                    $i_data = '<div class="list_bl"><ul>' . $val['l_data'] . '</ul></div>';
                    }
                $data['item_data'][$val['l_numb']] = $i_data;
                }
            ksort($data['item_data'], SORT_NUMERIC);
            $this->skin->render('viasat', $data);
            }
        }

    }

