<?php

?>
<div id="sidebar_popular_posts" class="col-lg-12 popular-posts-container" >

    <?php if (is_active_sidebar('popular-posts')) : ?>

        <?php dynamic_sidebar( 'popular-posts' ); ?>

    <?php endif; ?>

</div>