<?php

if ('POST' === $_SERVER['REQUEST_METHOD']){
    // var_dump($_POST);

    $housing_id = isset($_POST['housing_id']) ? trim(htmlentities($_POST['housing_id'])) : null;
    $reference = isset($_POST['reference']) ? trim(htmlentities($_POST['reference'])) : null;
    $lastname = isset($_POST['lastname']) ? trim(htmlentities($_POST['lastname'])) : null;
    $firstname = isset($_POST['firstname']) ? trim(htmlentities($_POST['firstname'])) : null;
    $message = isset($_POST['message']) ? trim(htmlentities($_POST['message'])) : null;


    $errors = [];
    
   if(strlen($reference) <= 0)
   {
    $errors['reference'] = "La référence ne doit pas être vide.";
   } 

   if(strlen($lastname) == 0)
   {
    $errors['lastname'] = "Le nom ne doit pas être vide.";
   } 

   if(strlen($firstname) == 0)
   {
    $errors['firstname']= "Le prenom ne doit pas être vide.";
   } 

   if(strlen($message) < 10)
   {
    $errors['message'] = "Le message doit contenir au moins 10 caractères.";
   } 

   if(empty($errors)){
      $success = 'Votre demande a été envoyée';
         // requête SQL pour insérer la demande de contact
        global $wpdb; // $wpdb->prefix = wp_
        $wpdb->show_errors();
        $wpdb->insert($wpdb->prefix.'contact', [
            'reference'=> $reference,
            'housing_id' => $housing_id,
            'lastname'=>$lastname,
            'firstname'=>$firstname,
            'message'=> $message
        ]);
   }
}

get_header() ?>
              
    <h1 class="text-center my-4">Bienvenue sur <?php bloginfo('name'); ?></h1>
    <p><?php bloginfo('description'); ?></p>

    <?php //  var_dump($errors ?? null); var_dump($success ?? null);
    // On affiche toutes les erreurs du formulaire
        if (!empty($errors)){ ?>
            <div class="alert alert-danger">
                <?php foreach ($errors as $field => $error){
                    echo $field . ':' . $error . '<br />';
                } ?>
            </div>
      <?php } ?>

    <?php if(isset($success)){
        echo '<div class="alert alert-success">' .$success . '</div>';
    }?>
    
    <div class="row">
      
    <?php 
        
        if(have_posts()){ // si on a des articles
            while (have_posts()){  the_post();// On parcourt les carticles ?>
                <div class="col-4 text-center " id="linkArticle">

                    <a href="<?php the_permalink(); ?>" class="link"> <h2><?php the_title(); ?> </h2> </a>
                    
                    <?php 
                        $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'large' );
                        $image_url = $large_image_url[0] ?? null;
                        echo '<img class="img-fluid" src="'.$image_url.'">';
                    ?>  
                    <?php if (!is_home()){ ?>
                    <div class= "card my-3">
                        <p>Surface : <?php echo get_post_meta($post->ID, 'surface', true); ?> m² </p> 
                        <p>Prix : <?php echo get_post_meta($post->ID, 'prix', true); ?> &euro; </p> 
                        <p class = "terms"><?php echo the_terms($post->ID, 'size', 'Type de logement : '); ?>  </p> 
                        <p class = "terms"><?php echo the_terms($post->ID, 'city', 'Ville : '); ?>  </p>                    
                    </div>


                    <?php }?>

                    <button data-id="<?php the_ID(); ?>" data-title ="<?php the_title(); ?>" type="button" class="btn btn-primary" data-toggle="modal" data-target="#housing-modal">
                        Nous contacter
                    </button>  

                    <a href="<?php the_permalink(); ?>" class="linkgrey">        <p><?= the_excerpt(); ?> </p></a>
                    <div class="card-footer"><?= get_the_date() ?> </div> 
                     
                </div>        
            </div>            
           <?php
        }}
        
    ?>
    </div>

                      <!-- Modal -->
    <div class="modal fade" id="housing-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Contact</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span >&times;</span>
                    </button>
                </div>
                <form action="" method="post">
                   
                    <div class="modal-body">

                        <input type="hidden" name="housing_id" id="housing_id">
                        <div class="form-group">
                            <label for="reference">Référence</label>
                            <input type="text" name="reference" id="reference" class ="form-control">
                        </div>

                        <div class="form-group">
                            <label for="lastname">Nom</label>
                            <input type="text" name="lastname" id="lastname" class ="form-control">
                        </div>

                        <div class="form-group">
                            <label for="firstname">Prénom</label>
                            <input type="text" name="firstname" id="firstname" class ="form-control">
                        </div>

                        <div class="form-group">
                            <label for="message">Message</label>
                            <input type="text" name="message" id="message" class ="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                        <button class="btn btn-primary">Envoyer</button>
                    </div>
                </form>
            </div>
        </div>
    </div> 

<?php get_footer() ?>