<aside class="sidebar">
    <!-- Bouton du flux RSS -->
    <a href="<?php bloginfo('rss2_url'); ?>">S'abonner au flux RSS</a>
    <!-- Formulaire de recherche -->
    <?php get_search_form(); ?>
    <!-- Catégories -->
    <ul class="list">
        <?php wp_list_categories(); ?>
    </ul>
    <!-- Archives -->
    <ul class="list">
        <?php wp_get_archives('type=monthly'); ?>
    </ul>
</aside>