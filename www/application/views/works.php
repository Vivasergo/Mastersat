<div id="right">
    <div class="top">
        <h1>Наши работы</h1>
        <?php
            if(isset($works) and $works!='')
            {
                foreach ($works as $val)
                    {
                    echo '<ul class="items_list">';
                    echo '<li><a href="/works/item/'.$val['id'].'">'.$val['name'].'</a></li>';
                    echo '</ul>';
                }
            }
            else echo '<p>Раздел находится в стадии разработки</p>';
        ?>
    </div>
</div>
</div>