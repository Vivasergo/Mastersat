<div class="top_h_menu">
    <ul>
        <?php
        if (($this->session->userdata(md5('adm_check_ok')) == md5('accepted_111')))
            {
            $seg_2 = $this->uri->segment('2');
            $seg_3 = $this->uri->segment('3');
            if ($seg_2 == 'edit_works' OR $seg_3 == 'works')
                {
                echo ' <li class="li_1"><a href="/admin/edit_it/main/">Главная</a></li>
                       <li class="li_2 active">Наши работы</li>
                       <li class="li_3"><a href="/admin/edit_it/service/">Сервис</a></li>
                       <li class="li_4"><a href="/admin/edit_news/">Новости</a></li>
                       <li class="li_5"><a href="/admin/edit_article/">Статьи</a></li>
                       <li class="li_6"><a href="/admin/edit_it/contacts/">Контакты</a></li>';
                }
            elseif ($seg_3 == 'main')
                {
                echo ' <li class="li_1 active">Главная</li>
                       <li class="li_2"><a href="/admin/edit_works/">Наши работы</a></li>
                       <li class="li_3"><a href="/admin/edit_it/service/">Сервис</a></li>
                       <li class="li_4"><a href="/admin/edit_news/">Новости</a></li>
                       <li class="li_5"><a href="/admin/edit_article/">Статьи</a></li>
                       <li class="li_6"><a href="/admin/edit_it/contacts/">Контакты</a></li>';
                }
            elseif ($seg_3 == 'service')
                {
                echo ' <li class="li_1"><a href="/admin/edit_it/main/">Главная</a></li>
                       <li class="li_2"><a href="/admin/edit_works/">Наши работы</a></li>
                       <li class="li_3 active">Сервис</li>
                       <li class="li_4"><a href="/admin/edit_news/">Новости</a></li>
                       <li class="li_5"><a href="/admin/edit_article/">Статьи</a></li>
                       <li class="li_6"><a href="/admin/edit_it/contacts/">Контакты</a></li>';
                }
            elseif ($seg_2 == 'edit_news' OR $seg_3 == 'news')
                {
                echo ' <li class="li_1"><a href="/admin/edit_it/main/">Главная</a></li>
                       <li class="li_2"><a href="/admin/edit_works/">Наши работы</a></li>
                       <li class="li_3"><a href="/admin/edit_it/service/">Сервис</a></li>
                       <li class="li_4 active">Новости</li>
                       <li class="li_5"><a href="/admin/edit_article/">Статьи</a></li>
                       <li class="li_6"><a href="/admin/edit_it/contacts/">Контакты</a></li>';
                }
            elseif ($seg_2 == 'edit_article' OR $seg_3 == 'article')
                {
                echo ' <li class="li_1"><a href="/admin/edit_it/main/">Главная</a></li>
                       <li class="li_2"><a href="/admin/edit_works/">Наши работы</a></li>
                       <li class="li_3"><a href="/admin/edit_it/service/">Сервис</a></li>
                       <li class="li_4"><a href="/admin/edit_news/">Новости</a></li>
                       <li class="li_5 active">Статьи</li>
                       <li class="li_6"><a href="/admin/edit_it/contacts/">Контакты</a></li>';
                }
            elseif ($seg_3 == 'contacts')
                {
                echo ' <li class="li_1"><a href="/admin/edit_it/main/">Главная</a></li>
                       <li class="li_2"><a href="/admin/edit_works/">Наши работы</a></li>
                       <li class="li_3"><a href="/admin/edit_it/service/">Сервис</a></li>
                       <li class="li_4"><a href="/admin/edit_news/">Новости</a></li>
                       <li class="li_5"><a href="/admin/edit_article/">Статьи</a></li>
                       <li class="li_6 active">Контакты</li>';
                }
            else
                {
                echo ' <li class="li_1"><a href="/admin/edit_it/main/">Главная</a></li>
                       <li class="li_2"><a href="/admin/edit_works/">Наши работы</a></li>
                       <li class="li_3"><a href="/admin/edit_it/service/">Сервис</a></li>
                       <li class="li_4"><a href="/admin/edit_news/">Новости</a></li>
                       <li class="li_5"><a href="/admin/edit_article/">Статьи</a></li>
                       <li class="li_6"><a href="/admin/edit_it/contacts/">Контакты</a></li>';
                }
            }
        else
            {
            if (isset($main) and $main != '')
                {
                echo '<li class="li_1 active">Главная</li>
                  <li class="li_2"><a href="/works/">Наши работы</a></li>
                  <li class="li_3"><a href="/service/">Сервис</a></li>
                  <li class="li_4"><a href="/news/">Новости</a></li>
                  <li class="li_5"><a href="/article/">Статьи</a></li>
                  <li class="li_6"><a href="/contacts/">Контакты</a></li>';
                }
            else
                {
                switch ($this->uri->segment(1))
                    {
                    case 'works':echo ' <li class="li_1"><a href="/">Главная</a></li>
                                            <li class="li_2 active">Наши работы</li>
                                            <li class="li_3"><a href="/service/">Сервис</a></li>
                                            <li class="li_4"><a href="/news/">Новости</a></li>
                                            <li class="li_5"><a href="/article/">Статьи</a></li>
                                            <li class="li_6"><a href="/contacts/">Контакты</a></li>';
                        break;
                    case 'service':echo ' <li class="li_1"><a href="/">Главная</a></li>
                                            <li class="li_2"><a href="/works/">Наши работы</a></li>
                                            <li class="li_3 active">Сервис</li>
                                            <li class="li_4"><a href="/news/">Новости</a></li>
                                            <li class="li_5"><a href="/article/">Статьи</a></li>
                                            <li class="li_6"><a href="/contacts/">Контакты</a></li>';
                        break;
                    case 'news':echo ' <li class="li_1"><a href="/">Главная</a></li>
                                            <li class="li_2"><a href="/works/">Наши работы</a></li>
                                            <li class="li_3"><a href="/service/">Сервис</a></li>
                                            <li class="li_4 active">Новости</li>
                                            <li class="li_5"><a href="/article/">Статьи</a></li>
                                            <li class="li_6"><a href="/contacts/">Контакты</a></li>';
                        break;
                    case 'article':echo ' <li class="li_1"><a href="/">Главная</a></li>
                                            <li class="li_2"><a href="/works/">Наши работы</a></li>
                                            <li class="li_3"><a href="/service/">Сервис</a></li>
                                            <li class="li_4"><a href="/news/">Новости</a></li>
                                            <li class="li_5 active">Статьи</li>
                                            <li class="li_6"><a href="/contacts/">Контакты</a></li>';
                        break;
                    case 'contacts':echo ' <li class="li_1"><a href="/">Главная</a></li>
                                            <li class="li_2"><a href="/works/">Наши работы</a></li>
                                            <li class="li_3"><a href="/service/">Сервис</a></li>
                                            <li class="li_4"><a href="/news/">Новости</a></li>
                                            <li class="li_5"><a href="/article/">Статьи</a></li>
                                            <li class="li_6 active">Контакты</li>';
                        break;
                    default :echo ' <li class="li_1"><a href="/">Главная</a></li>
                                            <li class="li_2"><a href="/works/">Наши работы</a></li>
                                            <li class="li_3"><a href="/service/">Сервис</a></li>
                                            <li class="li_4"><a href="/news/">Новости</a></li>
                                            <li class="li_5"><a href="/article/">Статьи</a></li>
                                            <li class="li_6"><a href="/contacts/">Контакты</a></li>';
                        break;
                    }
                }
            }
        ?>
    </ul>
</div>