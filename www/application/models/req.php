<?php

class Req extends CI_Model
    {

    function __construct()
        {
        parent::__construct();
        }

    function adm_check($log)
        {
        $this->db->select('log, pass');
        $this->db->from('msat_admin');
        $this->db->where('log', $log);
        $res = $this->db->get();
        if ($res->num_rows() > 0)
            return $res->row_array();
        else
            return false;
        }

    function get_meta($rel_id, $rel_key)
        {
        $this->db->select('desc,keywords');
        $req_cond = array('rel_key' => $rel_key, 'rel_id' => $rel_id);
        $this->db->where($req_cond);
        $res = $this->db->get('meta');
        if ($res->num_rows() > 0)
            {
            $res = $res->row_array();
            if ($res['desc'] == '' AND $res['keywords'] == '')
                {
                return FALSE;
                }
            else
                return $res;
            }
        else
            return FALSE;
        }

    function get_last_news()
        {
        $res = $this->db->query('select name, id, date from news where date in (select max(date) from news)');
        if ($res->num_rows() > 0)
            {
            $res = $res->row_array();
            $qr = $this->db->query('SELECT SUBSTR(data, 1, 75) as data FROM text_data WHERE rel_id=' . $res['id'] . ' AND rel_key="news"');
            if ($qr->num_rows() > 0)
                {
                $qr = $qr->row_array();
                return $result = array_merge($res, $qr);
                }
            else
                return false;
            }
        else
            return false;
        }

    function get_items_of_section($section)
        {
        if ($section == 'news')
            {
            $this->db->select("name, id, date");
            $this->db->order_by('date', "DESC");
            }
        else
            {
            $this->db->select("name, id");
            $this->db->order_by('id', "ASC");
            }
        $res = $this->db->get($section);
        if ($res->num_rows() > 0)
            return $res->result_array();
        else
            return false;
        }

    function get_item_name($art_id, $tab)
        {
        if ($tab == 'news')
            {
            $this->db->select('name, date');
            }
        else
            {
            $this->db->select('name');
            }
        $this->db->where('id', $art_id);
        $res = $this->db->get($tab);
        if ($res->num_rows() > 0)
            {
            return $res->row_array();
            }
        else
            return false;
        }

    function get_item_data_text($item_id, $rel_key)
        {
        $req_cond = array('rel_key' => $rel_key, 'rel_id' => $item_id);
        $this->db->select('data, l_numb, id, table_name');
        $this->db->where($req_cond);
        $this->db->from('text_data');
        $res = $this->db->get();
        if ($res->num_rows() > 0)
            return $res->result_array();
        else
            return false;
        }

    function get_item_data_img($item_id, $rel_key)
        {
        $req_cond = array('rel_key' => $rel_key, 'rel_id' => $item_id);
        $this->db->select('link, l_numb, id, table_name, alt, title');
        $this->db->where($req_cond);
        $this->db->from('img_data');
        $res_img = $this->db->get();
        if ($res_img->num_rows() > 0)
            return $res_img->result_array();
        else
            return false;
        }

    function get_item_data_list($item_id, $rel_key)
        {
        $req_cond = array('rel_key' => $rel_key, 'rel_id' => $item_id);
        $this->db->select('id, l_numb');
        $this->db->where($req_cond);
        $this->db->from('lists');
        $res_img = $this->db->get();
        if ($res_img->num_rows() > 0)
            {
            $res_img = $res_img->result_array();
            $list_dt = array();
            $i = 0;
            foreach ($res_img as $key => $val)
                {
                $this->db->select('data, id');
                $this->db->where('list_id', $val['id']);
                $this->db->order_by('id');
                $this->db->from('list_data');
                $res = $this->db->get();
                if ($res->num_rows() > 0)
                    {
                    $res = $res->result_array();
                    $l_of_item = '';

                    foreach ($res as $k => $v)
                        {
                        $l_of_item .= '<li class="p_of_list">' . $v['data'] . '</li> ';
                        }
                    }
                else
                    continue;
                $list_dt[$i]['l_data'] = $l_of_item;
                $list_dt[$i]['l_numb'] = $val['l_numb'];
                ++$i;
                }
            return $list_dt;
            }
        else
            return false;
        }

    function get_list_of_item($item_id, $rel_key)
        {
        $req_cond = array('rel_key' => $rel_key, 'rel_id' => $item_id);
        $this->db->select('id, l_numb, table_name');
        $this->db->where($req_cond);
        $this->db->from('lists');
        $res_img = $this->db->get();
        if ($res_img->num_rows() > 0)
            {
            $res_img = $res_img->result_array();
            $list_dt = array();
            $i = 0;
            foreach ($res_img as $key => $val)
                {
                $this->db->select('data, id');
                $this->db->where('list_id', $val['id']);
                $this->db->order_by('id');
                $this->db->from('list_data');
                $res = $this->db->get();
                if ($res->num_rows() > 0)
                    {
                    $res = $res->result_array();
                    }
                else
                    continue;
                $list_dt[$i]['l_data'] = $res;
                $list_dt[$i]['l_numb'] = $val['l_numb'];
                $list_dt[$i]['l_id'] = $val['id'];
                $list_dt[$i]['table_name'] = $val['table_name'];
                ++$i;
                }
            return $list_dt;
            }
        else
            return false;
        }

    function get_p_of_list($l_id)
        {
        $this->db->select('data');
        $this->db->where('list_id', $l_id);
        $this->db->from('list_data');
        $res = $this->db->get();
        if ($res->num_rows() > 0)
            {
            return $res->result_array();
            }
        else
            return false;
        }

    function get_img_data()
        {
        $this->db->select('id, link');
        $req_cond = array('rel_key' => $this->uri->segment(3), 'rel_id' => $this->uri->segment(4));
        $this->db->where($req_cond);
        $this->db->from('img_data');
        $res = $this->db->get();
        if ($res->num_rows() > 0)
            {
            return $res->result_array();
            }
        else
            return false;
        }

    function get_l_id_item()
        {
        $this->db->select('id');
        $req_cond = array('rel_key' => $this->uri->segment(3), 'rel_id' => $this->uri->segment(4));
        $this->db->where($req_cond);
        $this->db->from('lists');
        $res = $this->db->get();
        if ($res->num_rows() > 0)
            {
            return $res->result_array();
            }
        else
            return false;
        }

    function get_last_l_numb($rel_key, $item_id)
        {
        $req_cond = array('rel_key' => $rel_key, 'rel_id' => $item_id);
        $c_mas = array();
        $this->db->select('MAX(l_numb) as l_numb, id');
        $this->db->where($req_cond);
        $this->db->from('text_data');
        $t_res = $this->db->get();
        if ($t_res->num_rows() > 0)
            {
            $t_res = $t_res->row_array();
            array_push($c_mas, $t_res['l_numb']);
            }
        $this->db->select('MAX(l_numb) as l_numb, id');
        $this->db->where($req_cond);
        $this->db->from('img_data');
        $i_res = $this->db->get();
        if ($i_res->num_rows() > 0)
            {
            $i_res = $i_res->row_array();
            array_push($c_mas, $i_res['l_numb']);
            }
        $this->db->select('MAX(l_numb) as l_numb, id');
        $this->db->where($req_cond);
        $this->db->from('lists');
        $l_res = $this->db->get();
        if ($l_res->num_rows() > 0)
            {
            $l_res = $l_res->row_array();
            array_push($c_mas, $l_res['l_numb']);
            }
        if (!empty($c_mas))
            {
            return $c_mas;
            }
        else
            return FALSE;
        }

    function get_all_l_numbs($rel_key, $item_id)
        {
        $req_cond = array('rel_key' => $rel_key, 'rel_id' => $item_id);
        $c_mas = array();
        $this->db->select('l_numb as l_numb, id, rel_key, table_name');
        $this->db->where($req_cond);
        $this->db->from('text_data');
        $t_res = $this->db->get();
        if ($t_res->num_rows() > 0)
            {
            $t_res = $t_res->result_array();
            }
        else
            $t_res = FALSE;
        $this->db->select('l_numb as l_numb, id, rel_key, table_name');
        $this->db->where($req_cond);
        $this->db->from('img_data');
        $i_res = $this->db->get();
        if ($i_res->num_rows() > 0)
            {
            $i_res = $i_res->result_array();
            }
        else
            $i_res = FALSE;
        $this->db->select('l_numb as l_numb, id, rel_key, table_name');
        $this->db->where($req_cond);
        $this->db->from('lists');
        $l_res = $this->db->get();
        if ($l_res->num_rows() > 0)
            {
            $l_res = $l_res->result_array();
            }
        else
            $l_res = FALSE;
        if ($t_res AND $i_res AND $l_res)
            {
            $temp = array_merge($t_res, $i_res);
            return array_merge($temp, $l_res);
            }
        elseif ($t_res AND $i_res)
            {
            return array_merge($t_res, $i_res);
            }
        elseif ($i_res AND $l_res)
            {
            return array_merge($i_res, $l_res);
            }
        elseif ($t_res AND $l_res)
            {
            return array_merge($t_res, $l_res);
            }
        elseif ($t_res AND !$i_res AND !$l_res)
            {
            return $t_res;
            }
        elseif (!$t_res AND $i_res AND !$l_res)
            {
            return $i_res;
            }
        elseif (!$t_res AND !$i_res AND $l_res)
            {
            return $l_res;
            }
        else
            return FALSE;
        }

    function search($post)
        {
        $art_query = $this->db->query("SELECT name, article.id, SUBSTR(data, 1, 150) as data, rel_key FROM article
            JOIN text_data on article.id=text_data.rel_id AND text_data.rel_key='article' WHERE article.name LIKE '%" . $post['search_field'] . "%' OR text_data.data
                LIKE '%" . $post['search_field'] . "%'  GROUP BY article.id");
        if ($art_query->num_rows() > 0)
            $art_data = $art_query->result_array();
        else
            $art_data = FALSE;
        $news_query = $this->db->query("SELECT name, news.id, SUBSTR(data, 1, 150) as data, rel_key FROM news
            JOIN text_data on news.id=text_data.rel_id AND text_data.rel_key='news' WHERE news.name LIKE '%" . $post['search_field'] . "%' OR text_data.data
                LIKE '%" . $post['search_field'] . "%' GROUP BY news.id");
        if ($news_query->num_rows() > 0)
            $news_data = $news_query->result_array();
        else
            $news_data = FALSE;
        $works_query = $this->db->query("SELECT name, works.id, SUBSTR(data, 1, 150) as data, rel_key FROM works
            JOIN text_data on works.id=text_data.rel_id AND text_data.rel_key='works' WHERE works.name LIKE '%" . $post['search_field'] . "%' OR text_data.data
                LIKE '%" . $post['search_field'] . "%' GROUP BY works.id");
        if ($works_query->num_rows() > 0)
            $works_data = $works_query->result_array();
        else
            $works_data = FALSE;

        if ($art_data AND $news_data AND $works_data)
            {
            $temp = array_merge($art_data, $news_data);
            return array_merge($temp, $works_data);
            }
        elseif ($art_data AND $news_data)
            {
            return array_merge($art_data, $news_data);
            }
        elseif ($art_data AND $works_data)
            {
            return array_merge($art_data, $works_data);
            }
        elseif ($news_data AND $works_data)
            {
            return array_merge($news_data, $works_data);
            }
        elseif ($art_data AND !$news_data AND !$works_data)
            {
            return $art_data;
            }
        elseif (!$art_data AND $news_data AND !$works_data)
            {
            return $news_data;
            }
        elseif (!$art_data AND !$news_data AND $works_data)
            {
            return $works_data;
            }
        else
            return FALSE;
        }

    }