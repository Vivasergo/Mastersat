<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Contacts extends CI_Controller
    {

    function __construct()
        {
        parent::__construct();
        }

    public function index()
        {
        $data['title'] = 'Контакты';
        $data['meta'] = $this->req->get_meta(1, 'contacts');
        $item_data_text = $this->req->get_item_data_text(1, 'contacts');
        $item_data_img = $this->req->get_item_data_img(1, 'contacts');
        $item_data_list = $this->req->get_item_data_list(1, 'contacts');

        if ((!$item_data_img) AND (!$item_data_list) AND (!$item_data_text))
            {
            $this->skin->render('contacts',$data);
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
            $this->skin->render('contacts', $data);
            }
        }

    function mail_us()
        {
        $this->load->library('email');
        $this->form_validation->set_message('required', 'Поле %s не заполнено!');
        $this->form_validation->set_message('valid_email', 'Поле %s должно содержать правильный электронный адрес!');
        $this->form_validation->set_rules('organization', 'Организация', 'trim|xss_clean|strip_tags');
        $this->form_validation->set_rules('person', 'Контактное лицо', 'trim|xss_clean|strip_tags');
        $this->form_validation->set_rules('e-mail', 'E-mail', 'trim|required|xss_clean|strip_tags|valid_email');
        $this->form_validation->set_rules('phone', 'Телефон', 'trim|xss_clean|strip_tags');
        $this->form_validation->set_rules('message', 'Сообщение', 'trim|required|xss_clean|strip_tags');
        if ($this->form_validation->run() == FALSE)
            {
            $this->index();
            }
        else
            {
            $config['protocol'] = 'smtp';
            $config['smtp_host'] = 'mail.ukraine.com.ua';
            $config['smtp_port'] = '25';
            $config['smtp_user'] = 'info@mastersat.com.ua';
            $config['smtp_pass'] = '123456789v';
            $config['wordwrap'] = TRUE;

            $this->email->initialize($config);
            $post = $this->input->post();

            $mess = "Организация:" . $post['organization'] . "\nКонтактное лицо:" . $post['person'] . "\nТелефон:" . $post['phone'] . "\nE-mail:" . $post['e-mail'] . "\nСообщение:" . $post['message'];
            $this->email->from('info@mastersat.com.ua', $post['organization']);

            $this->email->reply_to($post['e-mail'], $post['organization']);
            $this->email->to('4013581@ukr.net');
            $this->email->subject('Письмо с сайта "Mastersat"');
            $this->email->message($mess);

            if (!$this->email->send())
                {
                $data['title'] = 'Ошибка';
                $data['error'] = "Произошла ошибка при отправке сообщения";
                $this->skin->render('error_msg', $data);
                }
            else
                {
                $data['title'] = 'Сообщение отправлено';
                $data['mess'] = "Ваше сообщение успешно отправлено";
                $data['info'] = 'Наши сотрудники ответят на ваше сообщение в ближайшее время.';
                $this->skin->render('mail_success', $data);
                }
            }
        }

    }

