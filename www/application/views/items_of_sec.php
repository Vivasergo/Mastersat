<div id="right">
    <div class="top">
        <h2>Выберите статью для редактирования из раздела <? echo $section; ?></h2>
        <?php
            if(isset($items_of_sec) and $items_of_sec!='')
            {$date='';
                foreach ($items_of_sec as $val)
                    {
                    if(isset($val['date']))$date=date('d.m.y',$val['date']);
                    else $date='';
                    echo '<ul class="items_list">';
                    echo '<li><a href="/admin/edit_it/'.$tab.'/'.$val['id'].'">'.$val['name'].'</a> <span class="date_span">'.$date.'</span></li>';
                    echo '</ul>';
                }
            }
            else echo '<p>Нет статей в данном разделе</p>';
        ?>
        <br/>
        <a href="/admin/add_new_item/<?php echo $tab; ?>">Добавить статью в данный раздел</a><br/>
        <a href="/admin/">Вернуться в административную панель</a>
    </div>
</div>
</div>
