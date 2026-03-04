<?php

// Config de base du thème
function wokine_theme_setup()
{
  add_theme_support('title-tag');
  add_theme_support('post-thumbnails');
}
add_action('after_setup_theme', 'wokine_theme_setup');

// Dev ou prod ?
function wokine_is_vite_dev()
{
  if (defined('WP_ENV') && WP_ENV === 'development') {
    return true;
  }
  $manifest_path = get_stylesheet_directory() . '/frontend/dist/manifest.json';
  return !file_exists($manifest_path);
}

// Enqueue des assets
function wokine_enqueue_assets()
{
  $theme_dir = get_stylesheet_directory();
  $theme_uri = get_stylesheet_directory_uri();

  $manifest_path = $theme_dir . '/frontend/dist/manifest.json';

  if (wokine_is_vite_dev()) {
    // DEV : serveur Vite
    $vite_dev_server = 'http://localhost:5173';

    // Client Vite (HMR)
    wp_enqueue_script(
      'wokine-vite-client',
      $vite_dev_server . '/@vite/client',
      [],
      null,
      true
    );

    // Entrée principale
    wp_enqueue_script(
      'wokine-main',
      $vite_dev_server . '/main.js',
      [],
      null,
      true
    );
  } else {
    // PROD : on lira le manifest plus tard
    if (!file_exists($manifest_path)) {
      return;
    }

    $manifest = json_decode(file_get_contents($manifest_path), true);
    $entry = $manifest['src/main.js'] ?? null;

    if (!$entry) {
      return;
    }

    if (!empty($entry['css'])) {
      foreach ($entry['css'] as $css_file) {
        wp_enqueue_style(
          'wokine-main',
          $theme_uri . '/frontend/dist/' . $css_file,
          [],
          null
        );
      }
    }

    if (!empty($entry['file'])) {
      wp_enqueue_script(
        'wokine-main',
        $theme_uri . '/frontend/dist/' . $entry['file'],
        [],
        null,
        true
      );
    }
  }
}
add_action('wp_enqueue_scripts', 'wokine_enqueue_assets');

// Force type="module" pour Vite
function wokine_add_module_type_to_vite_scripts($tag, $handle, $src)
{
  if ($handle === 'wokine-main' || $handle === 'wokine-vite-client') {
    $tag = '<script type="module" src="' . esc_url($src) . '" id="' . esc_attr($handle) . '-js"></script>' . "\n";
  }

  return $tag;
}
add_filter('script_loader_tag', 'wokine_add_module_type_to_vite_scripts', 10, 3);

// =============================================================================
// ÉTAPE 1 : Custom Post Type "Produits"
// =============================================================================
// Un "Custom Post Type" (CPT) = un type de contenu dans WordPress.
// Par défaut WP a "Posts" et "Pages". Ici on ajoute "Produits".
// Quand on enregistre un CPT, WordPress crée un menu dans l'admin pour gérer ces contenus.

function wokine_register_produits_post_type()
{
  // Labels = textes affichés dans l'admin (ex: "Ajouter un Produit")
  $labels = [
    'name'               => 'Produits',
    'singular_name'      => 'Produit',
    'menu_name'          => 'Produits',
    'add_new'            => 'Ajouter un produit',
    'add_new_item'       => 'Ajouter un nouveau produit',
    'edit_item'          => 'Modifier le produit',
    'new_item'           => 'Nouveau produit',
    'view_item'          => 'Voir le produit',
    'search_items'       => 'Rechercher des produits',
    'not_found'          => 'Aucun produit trouvé',
    'not_found_in_trash' => 'Aucun produit dans la corbeille',
  ];

  // Options du CPT (ce qui est affiché, comportement, etc.)
  $args = [
    'labels'              => $labels,
    'public'              => true,
    'has_archive'         => false,
    'menu_icon'           => 'dashicons-cart',
    'supports'            => ['title'],
    'show_in_rest'        => true,
    'capability_type'     => 'post',
  ];

  register_post_type('produit', $args);
}

add_action('init', 'wokine_register_produits_post_type');

// ÉTAPE 2 : Champs ACF pour "Produits" (nécessite le plugin ACF activé)
function wokine_register_produits_acf_fields()
{
  if (!function_exists('acf_add_local_field_group')) {
    return;
  }

  acf_add_local_field_group([
    'key'   => 'group_produit',
    'title' => 'Détails du produit',
    'fields' => [
      [
        'key'           => 'field_produit_image',
        'label'         => 'Image',
        'name'          => 'produit_image',
        'type'          => 'image',
        'return_format' => 'array',
        'preview_size'  => 'medium',
      ],
      [
        'key'   => 'field_produit_description',
        'label' => 'Description',
        'name'  => 'produit_description',
        'type'  => 'textarea',
        'rows'  => 4,
      ],
      [
        'key'         => 'field_produit_label',
        'label'       => 'Label',
        'name'        => 'produit_label',
        'type'        => 'text',
        'placeholder' => 'ex: nouveauté',
      ],
    ],
    'location' => [
      [
        [
          'param'    => 'post_type',
          'operator' => '==',
          'value'    => 'produit',
        ],
      ],
    ],
  ]);
}

add_action('acf/init', 'wokine_register_produits_acf_fields');
