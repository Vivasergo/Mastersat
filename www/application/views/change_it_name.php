<div id="right">
    <div class="top">
        <h2>Изменить название статьи</h2>
        <div class="adm_block">
            <form method="post" action='/admin/do_change_name/<?php echo $this->uri->segment(3).'/'.$this->uri->segment(4); ?>' >
                <?php echo validation_errors() ?>
                <p>
                    Введите новое название статьи: <textarea cols="80" rows="3" class="required" name="new_it_name" ><?php echo $art_name['name']; ?></textarea><br/><br/>
                    <input type="submit" value="Изменить" />
                </p>
            </form>
        </div>
        <a href="/admin/">Вернуться в административную панель</a>
    </div>
</div>
</div>
