<div id="right">
    <div class="top">
        <h1>Статьи</h1>
        <?php
            if(isset($arts) and $arts!='')
            {
                foreach ($arts as $key)
                    {
                    echo '<ul class="items_list">';
                    echo '<li><a href="/article/item/'.$key['id'].'">'.$key['name'].'</a></li>';
                    echo '</ul>';
                }
            }
             else echo '<p>Раздел находится в стадии разработки</p>';
        ?>
    </div>
</div>
</div>