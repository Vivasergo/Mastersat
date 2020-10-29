<div id="right">
    <div class="top">
        <?php
        $sec_name;
        switch ($tab)
            {
            case 'news': $sec_name = '"Новости"';
                break;
            case 'article': $sec_name = '"Статьи"';
                break;
            case 'works': $sec_name = '"Наши работы"';
                break;
            }
        ?>
        <h2>Добавить новую статью в раздел <? echo $sec_name; ?></h2>
        <div class="adm_block">
            <form method="post" action='/admin/do_add_new_item/<?php echo $tab?>' >
                <?php echo validation_errors() ?>
                <p>
                    Введите название новой статьи: <input style="width: 450px" class="required" type="text" name="art_name" /><br/><br/>
                    <input type="submit" value="Создать" />
                </p>
            </form>
        </div>
        <a href="/admin/">Вернуться в административную панель</a>
    </div>
</div>
</div>
