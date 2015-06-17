<?php
/**
 * Odin functions and definitions.
 *
 * Sets up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * For more information on hooks, actions, and filters,
 * see http://codex.wordpress.org/Plugin_API
 *
 * @package Odin
 * @since 2.2.0
 */

/**
 * Sets content width.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 600;
}

/**
 * Odin Classes.
 */
require_once get_template_directory() . '/core/classes/class-bootstrap-nav.php';
require_once get_template_directory() . '/core/classes/class-shortcodes.php';
require_once get_template_directory() . '/core/classes/class-thumbnail-resizer.php';
require_once get_template_directory() . '/core/classes/class-theme-options.php';
// require_once get_template_directory() . '/core/classes/class-options-helper.php';
require_once get_template_directory() . '/core/classes/class-post-type.php';
require_once get_template_directory() . '/core/classes/class-taxonomy.php';
require_once get_template_directory() . '/core/classes/class-metabox.php';
// require_once get_template_directory() . '/core/classes/abstracts/abstract-front-end-form.php';
// require_once get_template_directory() . '/core/classes/class-contact-form.php';
// require_once get_template_directory() . '/core/classes/class-post-form.php';
// require_once get_template_directory() . '/core/classes/class-user-meta.php';

/**
 * Odin Widgets.
 */
require_once get_template_directory() . '/core/classes/widgets/class-widget-like-box.php';

if ( ! function_exists( 'odin_setup_features' ) ) {

	/**
	 * Setup theme features.
	 *
	 * @since  2.2.0
	 *
	 * @return void
	 */
	function odin_setup_features() {

		/**
		 * Add support for multiple languages.
		 */
		load_theme_textdomain( 'odin', get_template_directory() . '/languages' );

		/**
		 * Register nav menus.
		 */
		register_nav_menus(
			array(
				'main-menu' => __( 'Main Menu', 'odin' )
			)
		);

		/*
		 * Add post_thumbnails suport.
		 */
		add_theme_support( 'post-thumbnails' );

		/**
		 * Add feed link.
		 */
		add_theme_support( 'automatic-feed-links' );

		/**
		 * Support Custom Header.
		 */
		$default = array(
			'width'         => 0,
			'height'        => 0,
			'flex-height'   => false,
			'flex-width'    => false,
			'header-text'   => false,
			'default-image' => '',
			'uploads'       => true,
		);

		add_theme_support( 'custom-header', $default );

		/**
		 * Support Custom Background.
		 */
		$defaults = array(
			'default-color' => '',
			'default-image' => '',
		);

		add_theme_support( 'custom-background', $defaults );

		/**
		 * Support Custom Editor Style.
		 */
		add_editor_style( 'assets/css/editor-style.css' );

		/**
		 * Add support for infinite scroll.
		 */
		add_theme_support(
			'infinite-scroll',
			array(
				'type'           => 'scroll',
				'footer_widgets' => false,
				'container'      => 'content',
				'wrapper'        => false,
				'render'         => false,
				'posts_per_page' => get_option( 'posts_per_page' )
			)
		);

		/**
		 * Add support for Post Formats.
		 */
		// add_theme_support( 'post-formats', array(
		//     'aside',
		//     'gallery',
		//     'link',
		//     'image',
		//     'quote',
		//     'status',
		//     'video',
		//     'audio',
		//     'chat'
		// ) );

		/**
		 * Support The Excerpt on pages.
		 */
		add_post_type_support( 'page', 'excerpt' );
	}
}

add_action( 'after_setup_theme', 'odin_setup_features' );

/**
 * Register widget areas.
 *
 * @since  2.2.0
 *
 * @return void
 */
function odin_widgets_init() {
	register_sidebar(
		array(
			'name' => __( 'Main Sidebar', 'odin' ),
			'id' => 'main-sidebar',
			'description' => __( 'Site Main Sidebar', 'odin' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h3 class="widgettitle widget-title">',
			'after_title' => '</h3>',
		)
	);
}

add_action( 'widgets_init', 'odin_widgets_init' );

/**
 * Flush Rewrite Rules for new CPTs and Taxonomies.
 *
 * @since  2.2.0
 *
 * @return void
 */
function odin_flush_rewrite() {
	flush_rewrite_rules();
}

add_action( 'after_switch_theme', 'odin_flush_rewrite' );

/**
 * Load site scripts.
 *
 * @since  2.2.0
 *
 * @return void
 */
function odin_enqueue_scripts() {
	$template_url = get_template_directory_uri();

	// Loads Odin main stylesheet.
	wp_enqueue_style( 'odin-style', get_stylesheet_uri(), array(), null, 'all' );

	// jQuery.
	wp_enqueue_script( 'jquery' );

	// Twitter Bootstrap.
	wp_enqueue_script( 'bootstrap', $template_url . '/assets/js/libs/bootstrap.min.js', array(), null, true );

	// General scripts.
	// FitVids.
	wp_enqueue_script( 'fitvids', $template_url . '/assets/js/libs/jquery.fitvids.js', array(), null, true );

	// Carousel HOME
	wp_enqueue_script( 'carousel', $template_url . '/assets/js/libs/jquery.bxslider.min.js', array(), null, true );
	
	// Mascara telefone.
	wp_enqueue_script( 'mask', $template_url . '/assets/js/libs/maskedinput.js', array(), null, true );

	// jQuery Smint.
    wp_enqueue_script( 'smint', $template_url . '/assets/js/libs/jquery.smint.js', array(), null, true );

    // Main jQuery.
	wp_enqueue_script( 'odin-main', $template_url . '/assets/js/actions.js', array(), null, true );

	// Grunt main file with Bootstrap, FitVids and others libs.
	// wp_enqueue_script( 'odin-main-min', $template_url . '/assets/js/main.min.js', array(), null, true );

	// Load Thread comments WordPress script.
	if ( is_singular() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}

add_action( 'wp_enqueue_scripts', 'odin_enqueue_scripts', 1 );

/**
 * Odin custom stylesheet URI.
 *
 * @since  2.2.0
 *
 * @param  string $uri Default URI.
 * @param  string $dir Stylesheet directory URI.
 *
 * @return string      New URI.
 */
function odin_stylesheet_uri( $uri, $dir ) {
	return $dir . '/assets/css/style.css';
}

add_filter( 'stylesheet_uri', 'odin_stylesheet_uri', 10, 2 );

/**
 * Core Helpers.
 */
require_once get_template_directory() . '/core/helpers.php';

/**
 * WP Custom Admin.
 */
require_once get_template_directory() . '/inc/admin.php';

/**
 * Comments loop.
 */
require_once get_template_directory() . '/inc/comments-loop.php';

/**
 * WP optimize functions.
 */
require_once get_template_directory() . '/inc/optimize.php';

/**
 * WP Custom Admin.
 */
require_once get_template_directory() . '/inc/plugins-support.php';

/**
 * Custom template tags.
 */
require_once get_template_directory() . '/inc/template-tags.php';


// CUSTOM POST PARA OS BANNERS DA HOME
function home_destaque() {
    $home_destaque = new Odin_Post_Type(
        'Destaque', // Nome (Singular) do Post Type.
        'destaque' // Slug do Post Type.
    );
    $home_destaque->set_labels(
        array(
            'menu_name' => __( 'Destaque Home', 'odin' )
        )
    );
    $home_destaque->set_arguments(
        array(
            'supports'				=> array( 'title', 'editor', 'thumbnail', 'excerpt' ),
            'menu_icon' 			=> get_template_directory_uri() . '/assets/img/icone_destaques.png',
            'exclude_from_search' 	=> true
        )
    );
}
add_action( 'init', 'home_destaque', 1 );


// CUSTOM POST PARA OS ITENS DO CARDÁPIO
function type_cardapio() {
    $type_cardapio = new Odin_Post_Type(
        'Cardápio', // Nome (Singular) do Post Type.
        'type_cardapio' // Slug do Post Type.
    );
    $type_cardapio->set_labels(
        array(
        	'name'					=> __('Itens', 'odin'),
        	'singular_name'			=> __('Item', 'odin'),
            'menu_name' 			=> __( 'Cardápio', 'odin' ),
            'all_items' 			=> __( 'Todos os itens', 'odin' ),
            'add_new'	 			=> __( 'Adicionar novo', 'odin' ),
            'add_new_item'			=> __( 'Adicionar novo item', 'odin' ),
            'edit_item'				=> __( 'Editar item', 'odin' ),
            'new_item'				=> __( 'Novo item', 'odin' ),
            'view_item'				=> __( 'Ver item', 'odin' ),
            'search_items'			=> __( 'Buscar itens', 'odin' ),
        )
    );
    $type_cardapio->set_arguments(
        array(
            'supports'				=> array( 'title', 'editor', 'thumbnail', 'excerpt' ),
            'exclude_from_search' 	=> false,
            'public'                => true,
            'public_queryable'      => true,
            'show_ui'               => true,
            'show_in_menu'          => true,
            'query_var'             => true,
            'rewrite'               => array( 'slug' => 'type_cardapio' ),
            'menu_icon'             => get_template_directory_uri() . '/assets/img/icone_cardapio.png',
            'capability_type'       => 'post',
            'has_archive'           => true,
            'hierarchical'          => true,
            'menu_position'         => null,
        )
    );
}
add_action( 'init', 'type_cardapio', 1 );

// CUSTOM TAXONOMY CARDÁPIO
function tax_cardapio() {

    $labels = array(
        'name'                       => __( 'Cardápio' ),
        'singular_name'              => __( 'Cardápio' ),
        'menu_name'                  => __( 'Cardápios' ),
        'all_items'                  => __( 'Todas os Itens' ),
        'parent_item'                => __( 'Parente Cardápio' ),
        'parent_item_colon'          => __( 'Parente Item' ),
        'new_item_name'              => __( 'Novo Item' ),
        'add_new_item'               => __( 'Adicionar Item' ),
        'edit_item'                  => __( 'Editar Item' ),
        'update_item'                => __( 'Atualizar Item' ),
        'separate_items_with_commas' => __( 'Separate items with commas' ),
        'search_items'               => __( 'Buscar Itens' ),
        'add_or_remove_items'        => __( 'Adicionar ou Remover Itens' ),
        'choose_from_most_used'      => __( 'Choose from the most used items' ),
        'not_found'                  => __( 'Nada encontrado' ),
    );
    $args = array(
        'labels'                     => $labels,
        'hierarchical'               => true,
        'rewrite'                    => array('hierarchical' => true),
        'public'                     => true,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'show_in_nav_menus'          => false,
        'show_tagcloud'              => true,
        'query_var'                  => 'cardapio',
    );
    register_taxonomy( 'cardapio', 'type_cardapio', $args );
}
// Hook into the 'init' action
add_action( 'init', 'tax_cardapio', 1 );


// CUSTOM THEME OPTIONS
function odin_theme_settings_example() {

    $settings = new Odin_Theme_Options(
        'odin-settings', // Slug/ID of the Settings Page (Required)
        'Configurações rodapé', // Settings page name (Required)
        'manage_options' // Page capability (Optional) [default is manage_options]
    );

    $settings->set_tabs(
        array(
            array(
                'id' => 'odin_general', // Slug/ID of the Settings tab (Required)
                'title' => __( 'Informações', 'odin' ), // Settings tab title (Required)
            )/*,
            array(
                'id' => 'odin_address', // Slug/ID of the Settings tab (Required)
                'title' => __( 'Endereços', 'odin' ), // Settings tab title (Required)
            )*/
        )
    );

    $settings->set_fields(
        array(
            'odin_general_fields_section' => array( // Slug/ID of the section (Required)
                'tab'   => 'odin_general', // Tab ID/Slug (Required)
                'title' => __( 'Informações', 'odin' ), // Section title (Required)
                'fields' => array( // Section fields (Required)
                    array(
                        'id'          => 'telefone', // Required
                        'label'       => __( 'Telefone', 'odin' ), // Required
                        'type'        => 'input', // Required
                        // 'default'  => 'Default text', // Optional
                        'description' => __( 'Telefone para contato', 'odin' ), // Optional
                        'attributes'  => array( // Optional (html input elements)
                            'type' => 'tel'
                        )
                    ),
                    array(
                        'id'          => 'face_input', // Required
                        'label'       => __( 'Facebook', 'odin' ), // Required
                        'type'        => 'input', // Required
                        // 'default'  => 'Default text', // Optional
                        'description' => __( 'Url do Facebook', 'odin' ), // Optional
                        'attributes'  => array( // Optional (html input elements)
                        )
                    ),
                    array(
                        'id'          => 'twitter_input', // Required
                        'label'       => __( 'Twitter', 'odin' ), // Required
                        'type'        => 'input', // Required
                        // 'default'  => 'Default text', // Optional
                        'description' => __( 'Url do Twitter', 'odin' ), // Optional
                        'attributes'  => array( // Optional (html input elements)
                        )
                    ),
                    array(
                        'id'          => 'trip_input', // Required
                        'label'       => __( 'Trip Advisor', 'odin' ), // Required
                        'type'        => 'input', // Required
                        // 'default'  => 'Default text', // Optional
                        'description' => __( 'Url do Trip Advisor', 'odin' ), // Optional
                        'attributes'  => array( // Optional (html input elements)
                        )
                    ),
                    array(
                        'id'          => 'four_input', // Required
                        'label'       => __( 'Foursquare', 'odin' ), // Required
                        'type'        => 'input', // Required
                        // 'default'  => 'Default text', // Optional
                        'description' => __( 'Url do Foursquare', 'odin' ), // Optional
                        'attributes'  => array( // Optional (html input elements)
                        )
                    )
                )
            ) //,
            // 'odin_address_fields_section' => array( // Slug/ID of the section (Required)
            //     'tab'   => 'odin_address', // Tab ID/Slug (Required)
            //     'title' => __( 'Endereços', 'odin' ), // Section title (Required)
            //     'fields' => array( // Section fields (Required)
            //         array(
            //             'id'          => 'aguas_claras', // Required
            //             'label'       => __( 'Águas Claras', 'odin' ), // Required
            //             'type'        => 'input', // Required
            //             // 'default'  => 'Default text', // Optional
            //             'description' => __( 'Endereço Águas Claras', 'odin' ), // Optional
            //             'attributes'  => array( // Optional (html input elements)
            //             )
            //         ),
            //         array(
            //             'id'          => 'asa_norte', // Required
            //             'label'       => __( 'Asa Norte', 'odin' ), // Required
            //             'type'        => 'input', // Required
            //             // 'default'  => 'Default text', // Optional
            //             'description' => __( 'Endereço Asa Norte', 'odin' ), // Optional
            //             'attributes'  => array( // Optional (html input elements)
            //             )
            //         ),
            //         array(
            //             'id'          => 'asa_sul', // Required
            //             'label'       => __( 'Asa Sul', 'odin' ), // Required
            //             'type'        => 'input', // Required
            //             // 'default'  => 'Default text', // Optional
            //             'description' => __( 'Endereço Asa Sul', 'odin' ), // Optional
            //             'attributes'  => array( // Optional (html input elements)
            //             )
            //         )
            //     )
            // )
        )
    );
}

add_action( 'init', 'odin_theme_settings_example', 1 );


// CUSTOM FIELD PARA URL DO DELIVERY

// METABOX PERSONALIZADOS
function campos_personalizados_delivery() {
    $marca_metabox = new Odin_Metabox(
        'campos', // Slug/ID of the Metabox (Required)
        'URL do Delivery', // Metabox name (Required)
        'cardapio', // Slug of Post Type (Optional)
        'normal', // Context (options: normal, advanced, or side) (Optional)
        'high' // Priority (options: high, core, default or low) (Optional)
    );
    $marca_metabox->set_fields(
        array(
            // URL Hotsite
            array(
                'id'          => 'url_site', // Obrigatório
                'label'       => __( 'Link Delivery', 'odin' ), // Obrigatório
                'type'        => 'input', // Obrigatório
                'description' => __( 'Link Delivery', 'odin' ), // Opcional
                'attributes'  => array( // Opcional (atributos para input HTML/HTML5)
                    'type'    => 'text',
                )
            ),
        )
    );
}

add_action( 'init', 'campos_personalizados_delivery', 1 );

function campos_personalizados_destaque() {
    $marca_metabox = new Odin_Metabox(
        'campos_destaque', // Slug/ID of the Metabox (Required)
        'URL do Destaque', // Metabox name (Required)
        'destaque', // Slug of Post Type (Optional)
        'normal', // Context (options: normal, advanced, or side) (Optional)
        'high' // Priority (options: high, core, default or low) (Optional)
    );
    $marca_metabox->set_fields(
        array(
            // URL Hotsite
            array(
                'id'          => 'url_destaque', // Obrigatório
                'label'       => __( 'Link Destaque', 'odin' ), // Obrigatório
                'type'        => 'input', // Obrigatório
                'description' => __( 'Link Destaque', 'odin' ), // Opcional
                'attributes'  => array( // Opcional (atributos para input HTML/HTML5)
                    'type'    => 'text',
                )
            ),
        )
    );
}

add_action( 'init', 'campos_personalizados_destaque', 1 );