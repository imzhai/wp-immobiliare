<?php get_header();
the_post(); // équivalent à la requête qui récupère les articles
?>
</div>

<h1 class="text-center my-2"><?php the_title(); ?> </h1>
        
    <?php 
        $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'large' );
        $image_url = $large_image_url[0] ?? null;                   
        ?>
    <div class="article-image" style="background-image : url(<?=$image_url?>)" > </div>

    <div class= "text-center">
        <?php the_content(); ?>
    </div>

<div class="container">

<?php get_footer() ?>
