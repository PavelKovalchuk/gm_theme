<?php

?>
<div id="sidebar_categories" class="col-lg-12 category-container js-sidebar-categories" role="complementary">

    <div class="row no-gutters">
        <div class="col-lg-12">
            <h4 class="sidebar-block-title categories-list-title" data-toggle="collapse" data-target="#collapseCategories" aria-expanded="false" aria-controls="collapseCategories" >рубрики блога:</h4>
        </div>
    </div>


    <?php
    $filename_category_sidebar = get_template_directory() . '/cache/category_sidebar_template.php';

    if (file_exists($filename_category_sidebar)) {

        require $filename_category_sidebar;

    }else{
        get_categories_menu('no-gutters collapse show', 'collapseCategories', 'sidebar_cat_item col-md-12', 'justify-content-between', true);
    }

    ?>

</div>




