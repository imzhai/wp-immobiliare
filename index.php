<?php get_header() ?>
      

        
            <h1 class="text-center my-4">Bienvenue sur <?php bloginfo('name'); ?></h1>
            <p><?php bloginfo('description'); ?></p>
      




            <div class="row">
    <?php 
        
        if(have_posts()){ // si on a des articles
            while (have_posts()){  the_post();// On parcourt les carticles ?>
                <div class="col-3 text-center " id="linkArticle">

                <a href="<?php the_permalink(); ?>" class="link"> <h2><?php the_title(); ?> </h2> </a>
                <?php 
                    $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'large' );
                    $image_url = $large_image_url[0] ?? null;
                    echo '<img class="img-fluid" src="'.$image_url.'">';
                 ?>  
                <a href="<?php the_permalink(); ?>" class="linkgrey">        <p><?= the_excerpt(); ?> </p></a>
                         <div class="card-footer"><?= get_the_date() ?> </div> 
                     

                 
                </div>  
                         
           <?php }
        }
        
    ?>
        </div>

<?php get_footer() ?>