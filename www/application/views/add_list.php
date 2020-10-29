<div id="right">
    <div class="top">
        <?
        if (isset($item_name))
            $it_name = ', статью : "' . $item_name['name'] . '"';
        else
            $it_name = '';
        switch ($rel_key)
            {
            case 'main': $name = 'на главную страницу';
                break;
            case 'works': $name = ' в раздел "Наши работы"' . $it_name;
                break;
            case 'service': $name = 'на страницу "Сервис"';
                break;
            case 'news': $name = 'в раздел "Новости"' . $it_name;
                break;
            case 'article': $name = 'в раздел "Статьи"' . $it_name;
                break;
            case 'contacts': $name = 'на страницу "Контакты"';
                break;
            case 'viasat': $name = 'на страницу "Viasat"';
                break;
            case 'xtra': $name = 'на страницу "Xtra"';
                break;
            }
        ?>
        <h2>Добавить список <? echo $name; ?></h2>
        <div class="adm_block">
            <form action="/admin/do_add_list/<?php echo $rel_key . '/' . $it_id . '/list'; ?>" method="post">
                <p>Введите пункты списка разделяя ";"
<?php echo validation_errors(); ?>
                    <textarea class="required" cols="80" rows="5" name="list_data"></textarea>
                    <span class="notice">Список будет добавлен в конец статьи, изменить последовательность блоков статьи можно в меню редактора статьи</span>
                    <span class="notice">Если вы хотите выделить текст курсивом, поместите его между тегами &lt;em&gt; и &lt;/em&gt;, если выделить жирным, то
                        между тегами &lt;strong&gt; и &lt;/strong&gt;.</span>
                    <span class="notice">Создать ссылку можно следующим кодом: &lt;a href="адрес ссылки"&gt;имя ссылки&lt;/a&gt;
                        Где адрес ссылки может быть, например: для внешних ссылок - http://www.viasat.ua, для внутренних - /service/ </span>
                    <span class="notice" style="color:red">Не забывайте ставить закрывающий тег, такой как &lt;/a&gt; или &lt;/h3&gt;</span><br/>
                    <input type="submit" value="Добавить" />
                </p>
            </form>
        </div>
        <a href="/admin/">Вернуться в административную панель</a>
    </div>
</div>
</div>
