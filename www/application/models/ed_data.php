<?php

class Ed_data extends CI_Model
    {

    function __construct()
        {
        parent::__construct();
        }

    function add_text_bl($rel_key, $rel_id, $last_l_numb, $post)
        {
        $ins_data = array('data' => $post['text_data'], 'l_numb' => $last_l_numb, 'rel_key' => $rel_key, 'rel_id' => $rel_id, 'table_name' => 'text_data');
        if (!$this->db->insert('text_data', $ins_data))
            return FALSE;
        else
            {
            return TRUE;
            }
        }

    function add_list($rel_key, $rel_id, $last_l_numb, $list_dt)
        {
        $ins_data = array('rel_key' => $rel_key, 'l_numb' => $last_l_numb, 'rel_id' => $rel_id, 'table_name' => 'lists');
        if (!$this->db->insert('lists', $ins_data))
            return FALSE;
        else
            {
            $new_list_id = mysql_insert_id();
            foreach ($list_dt as $key => $val)
                {
                $ins_data = array('data' => $val, 'list_id' => $new_list_id);
                if (!$this->db->insert('list_data', $ins_data))
                    return FALSE;
                }
            return TRUE;
            }
        }

    function add_new_img($rel_key, $rel_id, $last_l_numb, $post)
        {
        $insert = array('link' => $post['file_link'], 'title' => $post['title'],
            'alt' => $post['alt'], 'l_numb' => $last_l_numb, 'rel_id' => $rel_id, 'rel_key' => $rel_key, 'table_name' => 'img_data');
        if (!$this->db->insert('img_data', $insert))
            return FALSE;
        else
            {
            return TRUE;
            }
        }

    function add_meta_dt($rel_key, $rel_id, $post)
        {
        $insert = array('rel_key' => $rel_key, 'rel_id' => $rel_id, 'desc' => $post['desc'], 'keywords' => $post['keywords']);
        if (!$this->db->insert('meta', $insert))
            return FALSE;
        else
            {
            return TRUE;
            }
        }

    function add_new_item($rel_key, $post)
        {
        if (isset($post['date']))
            {
            $insert = array('name' => $post['art_name'], 'date' => $post['date']);
            }
        else
            {
            $insert = array('name' => $post['art_name']);
            }
        if (!$this->db->insert($rel_key, $insert))
            return FALSE;
        else
            {
            return mysql_insert_id();
            }
        }

    function add_new_p_l($post)
        {
        $insert = array('data' => $post['p_l_data'], 'list_id' => $this->uri->segment(5));
        if (!$this->db->insert('list_data', $insert))
            return FALSE;
        else
            {
            return TRUE;
            }
        }

    function change_p_l_date($p_l_id, $post)
        {
        $update = array('data' => $post['p_l_data']);
        $this->db->where('id', $p_l_id);
        if (!$this->db->update('list_data', $update))
            return FALSE;
        else
            {
            return TRUE;
            }
        }

    function change_date($rel_id, $date)
        {
        $update = array('date' => $date);
        $this->db->where('id', $rel_id);
        if (!$this->db->update('news', $update))
            return FALSE;
        else
            {
            return TRUE;
            }
        }

    function change_meta_dt($rel_key, $rel_id, $post)
        {
        $update = array('desc' => $post['desc'], 'keywords' => $post['keywords']);
        $req_cond = array('rel_key' => $rel_key, 'rel_id' => $rel_id);
        $this->db->where($req_cond);
        if (!$this->db->update('meta', $update))
            return FALSE;
        else
            {
            return TRUE;
            }
        }

    function change_img_dt($img_id, $post)
        {
        $update = array('alt' => $post['alt'], 'title' => $post['title']);
        $this->db->where('id', $img_id);
        if (!$this->db->update('img_data', $update))
            return FALSE;
        else
            {
            return TRUE;
            }
        }

    function change_blocks_pos_old($old_id, $old_tab, $new_l_numb)
        {
        $update_old = array('l_numb' => $new_l_numb);
        $this->db->where('id', $old_id);
        if (!$this->db->update($old_tab, $update_old))
            return FALSE;
        else
            {
            return TRUE;
            }
        }

    function change_blocks_pos_new($new_id, $new_tab, $old_l_numb)
        {
        $update_new = array('l_numb' => $old_l_numb);
        $this->db->where('id', $new_id);
        if (!$this->db->update($new_tab, $update_new))
            return FALSE;
        else
            {
            return TRUE;
            }
        }

    function change_blocks_pos_cur($block_id, $tab_name, $new_l_numb)
        {
        $update_new = array('l_numb' => $new_l_numb);
        $this->db->where('id', $block_id);
        if (!$this->db->update($tab_name, $update_new))
            return FALSE;
        else
            {
            return TRUE;
            }
        }

    function change_text_bl($block_id, $post)
        {
        $update = array('data' => $post['text_data']);
        $this->db->where('id', $block_id);
        if (!$this->db->update('text_data', $update))
            return FALSE;
        else
            {
            return TRUE;
            }
        }

    function get_img($img_id)
        {
        $this->db->select('link');
        $this->db->where('id', $img_id);
        $this->db->from('img_data');
        $res = $this->db->get();
        if ($res->num_rows() > 0)
            return $res->row_array();
        else
            return false;
        }

    function del_img($img_id)
        {
        if (!$this->db->delete('img_data', array('id' => $img_id)))
            {
            return FALSE;
            }
        else
            {
            return TRUE;
            }
        }

    function del_meta()
        {
        $req_cond = array('rel_key' => $this->uri->segment(3), 'rel_id' => $this->uri->segment(4));
        $this->db->where($req_cond);
        if (!$this->db->delete('meta'))
            {
            return FALSE;
            }
        else
            {
            return TRUE;
            }
        }

    function del_item_name()
        {
        $req_cond = array('id' => $this->uri->segment(4));
        $this->db->where($req_cond);
        if (!$this->db->delete($this->uri->segment(3)))
            {
            return FALSE;
            }
        else
            {
            return TRUE;
            }
        }

    function del_block($bl_id)
        {
        if (!$this->db->delete('text_data', array('id' => $bl_id)))
            {
            return FALSE;
            }
        else
            {
            return TRUE;
            }
        }

    function del_p_l($p_l_id)
        {
        $this->db->select('list_id');
        $this->db->where('id', $p_l_id);
        $this->db->from('list_data');
        $res = $this->db->get();
        if ($res->num_rows > 0)
            {
            $list_id = $res->row_array();
            }
        else
            {
            return FALSE;
            }
        if (!$this->db->delete('list_data', array('id' => $p_l_id)))
            {
            return FALSE;
            }
        else
            {
            $this->db->select('data');
            $this->db->where('list_id', $list_id['list_id']);
            $this->db->from('list_data');
            $res = $this->db->get();
            if ($res->num_rows() == 0)
                {
                if (!$this->db->delete('lists', array('id' => $list_id['list_id'])))
                    {
                    return FALSE;
                    }
                else
                    {
                    return TRUE;
                    }
                }
            else
                return TRUE;
            }
        }

    function del_list($l_id)
        {
        if (!$this->db->delete('list_data', array('list_id' => $l_id)))
            {
            return FALSE;
            }
        else
            {
            if (!$this->db->delete('lists', array('id' => $l_id)))
                {
                return FALSE;
                }
            else
                {
                return TRUE;
                }
            }
        }

    function del_t_b_of_item()
        {
        $req_cond = array('rel_key' => $this->uri->segment(3), 'rel_id' => $this->uri->segment(4));
        $this->db->where($req_cond);
        if (!$this->db->delete('text_data'))
            {
            return FALSE;
            }
        else
            {
            return TRUE;
            }
        }

    function change_name($post)
        {
        $update_data = array('name' => $post['new_it_name']);
        $this->db->where('id', $this->uri->segment(4));
        if (!$this->db->update($this->uri->segment(3), $update_data))
            return FALSE;
        else
            {
            return TRUE;
            }
        }

    }