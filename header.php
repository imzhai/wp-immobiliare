<!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="utf-8">
        <title>Mon thème WordPress</title>
        <!-- Permet de charger les styles CSS de WP-->
        <?php wp_head(); ?>
    </head>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <a class="navbar-brand" href="#"><?php bloginfo('name') ?> </a>
                <title><?php wp_title('|'); ?></title>
             
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                
                   
                            <?php
                            wp_nav_menu( [
                                'theme_location'    => 'main-menu',
                                'depth'             => 2,
                                'container'         => 'div',
                                'container_class'   => 'collapse navbar-collapse',
                                'container_id'      => 'navbarNav',
                                'menu_class'        => 'nav navbar-nav ml-auto',
                                'fallback_cb'       => 'WP_Bootstrap_Navwalker::fallback',
                                'walker'            => new WP_Bootstrap_Navwalker(),
                                ] );
                            ?>
                    </div>
                </nav>
        <div class="container">