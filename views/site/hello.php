<h1>Список статей</h1>
<ol>
    <?php
        foreach ($post as $obj) {
            echo '<li>' . $obj->name . '</li>';
        }
    ?>
</ol>
