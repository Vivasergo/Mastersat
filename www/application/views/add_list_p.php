<div id="right">
    <div class="top">
        <?php
        if (isset($list_dt))
            {
            echo '<ul>';
            foreach ($list_dt as $val)
                {
                echo '<li>' . $val['data'] . '</li>';
                }
            echo '</ul>';
            }
        ?>
        <h2>Добавить новый пункт списка</h2>
        <div class="adm_block">
            <form method="post" action='/admin/do_add_new_p_l/<?php echo $tab . '/' . $rel_key . '/' . $l_id; ?>' >
                <?php echo validation_errors() ?>
                <p>
                    Введите содержание нового пункта: <textarea cols="80" rows="3" class="required" name="p_l_data" ></textarea>
                    <span class="notice">Если вы хотите выделить текст курсивом, поместите его между тегами &lt;em&gt; и &lt;/em&gt;,
                        если выделить жирным, то между тегами &lt;strong&gt; и &lt;/strong&gt;.</span>
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
