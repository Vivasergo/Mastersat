<?php
class Skin extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function render($name, $data=array())
    {
        if(!isset($data['meta'])OR $data['meta']=='')
            {
            $data['meta']=  $this->req->get_meta(1, 'main');
            }
        $data['l_news']=  $this->req->get_last_news();
        $data['breadcrumbs']=  $this->breadcrumbs->get_breadcrumbs($data);
        $this->load->view('head_top', $data);
        $this->load->view('top_menu', $data);
        $this->load->view('b_cr', $data);
        $this->load->view('left_cont', $data);
        $this->load->view($name, $data);
        $this->load->view('footer', $data);

    }
}