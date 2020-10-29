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
        <h2>Добавить изображение <? echo $name; ?></h2>
        <div class="adm_block">
            <form action="/admin/do_add_img/<?php echo $rel_key . '/' . $it_id . '/img'; ?>" method="post" enctype="multipart/form-data">
                <?php echo validation_errors(); echo $this->upload->display_errors().'</p>'; ?>
                <table>
                    <tr>
                        <td>Добавить изображение:</td>
                        <td><input type="file" name="img" /></td>
                    </tr>
                    <tr>
                        <td>Введите альтернативное описание изображения:</td>
                        <td><input class="required" style="width: 350px" type="text" name="alt" /></td>
                    </tr><tr>
                        <td>Введите описание изображения:</td>
                        <td><input class="required" style="width: 350px" type="text" name="title" /></td>
                    </tr>
                </table>
                <span class="notice">Изображение будет добавлено в конец статьи, изменить последовательность блоков статьи можно в меню редактора статьи</span>
                <span class="notice">Максимальный размер файла 4 мб.</span>
                <p>
                    <input type="submit" value="Добавить" />
                </p>
            </form>
        </div>
        <a href="/admin/">Вернуться в административную панель</a>
    </div>
</div>
</div>
