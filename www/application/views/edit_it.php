<div id="right">
    <div class="top">
        <? if(isset($item_name)) $it_name='статьи : "'.$item_name['name'].'"';
        else $it_name='';
        switch ($rel_key)
            {
            case 'main': $name='главной страницы';
                break;
            case 'works': $name=$it_name.', раздела "Наши работы"';
                break;
            case 'service': $name='страницы "Сервис"';
                break;
            case 'news': $name=$it_name.', раздела "Новости"';
                break;
            case 'article': $name=$it_name.'раздела "Статьи"';
                break;
            case 'contacts': $name='страницы "Контакты"';
                break;
            case 'viasat': $name='страницы "Viasat"';
                break;
            case 'xtra': $name='страницы "Xtra"';
                break;
            }
?>
        <h2>Редактор <? echo $name;?></h2>
        <?php echo validation_errors(); ?>
        <?php
        if(isset($n_date)) echo $n_date;
        if (isset($item_data) and $item_data != '') {
            echo '<p><span class="notice">Блоки расположены по возрастанию их индивидуальных номеров</span>
                <span class="notice">Если вы хотите выделить текст курсивом, поместите его между тегами &lt;em&gt; и &lt;/em&gt;, если выделить жирным, то
                между тегами &lt;strong&gt; и &lt;/strong&gt;.</span>
                <span class="notice">Создать заголовок можно поместив текст между тегами &lt;h3&gt; и &lt;/h3&gt; или &lt;h4&gt; и &lt;/h4&gt;</span>
                <span class="notice">Создать ссылку можно следующим кодом: &lt;a href="адрес ссылки"&gt;имя ссылки&lt;/a&gt;
                Где адрес ссылки может быть, например: для внешних ссылок - http://www.viasat.ua, для внутренних - /service/ </span>
                <span class="notice">Чтобы вставить баннер или видео, нужно вставить код баннера или видео в текстовый блок</span>
                <span class="notice" style="color:red">Важно! Заголовки можно создавать только в текстовом блоке.
                В одном текстовом блоке может быть либо видео, либо заголовок, либо текст. Ссылки можно создавать как в теле текстового блока, так и в списках.</span>
                <span class="notice" style="color:red">Не забывайте ставить закрывающий тег, такой как &lt;/a&gt; или &lt;/h3&gt;</span></p>';
            foreach ($item_data as $key=>$val) {
                echo $val;
            }
            echo $meta;
        }
        else
            echo '<p>Содержание отсутствует.</p>';
        ?>
        <a href="/admin/add_block/<? echo $rel_key.'/'.$it_id.'/text'; ?>">Добавить текстовый блок</a><br/>
        <a href="/admin/add_block/<? echo $rel_key.'/'.$it_id.'/list'; ?>">Добавить список</a><br/>
        <a href="/admin/add_block/<? echo $rel_key.'/'.$it_id.'/img'; ?>">Добавить изображение</a><br/>
        <?php if($it_name!='')
            {
            echo '<a href="/admin/change_name/'.$rel_key.'/'.$it_id.'">Изменить название статьи</a><br/>
        <a class="del" href="/admin/del_item/'.$rel_key.'/'.$it_id.'">Удалить статью полностью</a><br/>';
            }
?>
        <a href="/admin/">Вернуться в административную панель</a>
    </div>
</div>
</div>