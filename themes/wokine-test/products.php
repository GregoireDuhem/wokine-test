<section class="products">
  <div class="products-container">
    <div class="products-header">
      <h2 class="products-title text-reveal">Nos dernières nouveautés</h2>
      <button class="animated-button">Tous nos produits</button>
    </div>
    <div class="products-cards-container">
      <?php
      // On récupère les posts de type "produit" publiés (ordre par date)
      $produits_query = new WP_Query([
        'post_type'      => 'produit',
        'posts_per_page' => -1,
        'orderby'        => 'date',
        'order'          => 'DESC',
        'post_status'    => 'publish',
      ]);

      if ($produits_query->have_posts()) :
        while ($produits_query->have_posts()) :
          $produits_query->the_post();

          $image       = get_field('produit_image');
          $description = get_field('produit_description');
          $label       = get_field('produit_label');
          $image_url   = is_array($image) && !empty($image['url']) ? $image['url'] : '';
          $image_alt   = is_array($image) && !empty($image['alt']) ? $image['alt'] : get_the_title();
      ?>
          <div class="products-card">
            <div class="products-image-container">
              <?php if ($image_url) : ?>
                <img class="products-image" src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($image_alt); ?>">
              <?php else : ?>
                <img class="products-image" src="<?php echo esc_url(get_stylesheet_directory_uri()); ?>/frontend/public/assets/images/solution-card.webp" alt="">
              <?php endif; ?>
              <?php if ($label) : ?>
                <p class="products-new"><?php echo esc_html($label); ?></p>
              <?php endif; ?>
            </div>
            <div class="products-card-content">
              <p class="products-card-title"><?php the_title(); ?></p>
              <?php if ($description) : ?>
                <p class="products-card-text"><?php echo esc_html($description); ?></p>
              <?php endif; ?>
            </div>
          </div>
        <?php
        endwhile;
        wp_reset_postdata();
      else :
        ?>
        <div class="products-card">
          <div class="products-image-container">
            <img class="products-image" src="<?php echo esc_url(get_stylesheet_directory_uri()); ?>/frontend/public/assets/images/solution-card.webp" alt="">
            <p class="products-new">nouveauté</p>
          </div>
          <div class="products-card-content">
            <p class="products-card-title">Vehicula dapibus</p>
            <p class="products-card-text">Tristique cras interdum volutpat faucibus viverra cursus id. Orci blandit nunc nibh arcu non sit volutpat. Vitae id ut dui tellus.</p>
          </div>
        </div>
      <?php endif; ?>
    </div>
    <div class="products-arrows">
      <button type="button" class="products-arrow products-arrow-right" aria-label="Suivant">
        <svg class="opacity" fill="currentColor" version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" stroke="currentColor" stroke-width="5">
          <g>
            <path d="M33.934,54.458l30.822,27.938c0.383,0.348,0.864,0.519,1.344,0.519c0.545,0,1.087-0.222,1.482-0.657 c0.741-0.818,0.68-2.083-0.139-2.824L37.801,52.564L64.67,22.921c0.742-0.818,0.68-2.083-0.139-2.824 c-0.817-0.742-2.082-0.679-2.824,0.139L33.768,51.059c-0.439,0.485-0.59,1.126-0.475,1.723 C33.234,53.39,33.446,54.017,33.934,54.458z"></path>
          </g>
        </svg>
      </button>
      <button type="button" class="products-arrow products-arrow-left" aria-label="Précédent">
        <svg fill="currentColor" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 100 100" enable-background="new 0 0 100 100" xml:space="preserve" stroke="#000000" stroke-width="5" transform="matrix(-1, 0, 0, 1, 0, 0)">
          <g id="SVGRepo_iconCarrier">
            <g>
              <path d="M33.934,54.458l30.822,27.938c0.383,0.348,0.864,0.519,1.344,0.519c0.545,0,1.087-0.222,1.482-0.657 c0.741-0.818,0.68-2.083-0.139-2.824L37.801,52.564L64.67,22.921c0.742-0.818,0.68-2.083-0.139-2.824 c-0.817-0.742-2.082-0.679-2.824,0.139L33.768,51.059c-0.439,0.485-0.59,1.126-0.475,1.723 C33.234,53.39,33.446,54.017,33.934,54.458z"></path>
            </g>
          </g>
        </svg>
      </button>
    </div>
  </div>
</section>