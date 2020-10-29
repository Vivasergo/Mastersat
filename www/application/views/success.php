<div id="right">
    <div class="top">
        <h3>
            <?php
            echo validation_errors();
            if (isset($success) && $success != '')
                echo $success;
            else
                echo 'Произошла ошибка';
            ?>
        </h3>
        <a href="/admin/edit_it/<? echo $rel_key.'/'.$it_id.'/'; ?>">Вернуться к редактированию измененной статьи</a><br/>
        <a href="/admin/">Вернуться в административную панель</a>
    </div>
</div>
</div>
