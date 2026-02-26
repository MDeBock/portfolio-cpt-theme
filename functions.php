<?php
/**
 * Funciones y definiciones del tema
 */

// 1. CARGA DE RECURSOS
function portfolio_scripts() {
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css', array(), '6.4.0');
    wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap', array(), null);
    wp_enqueue_style('bootstrap-css', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css', array(), '5.3.0');
    wp_enqueue_style('main-styles', get_stylesheet_uri(), array('bootstrap-css', 'google-fonts'), '1.0');
    wp_enqueue_script('bootstrap-js', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js', array(), '5.3.0', true);
}
add_action('wp_enqueue_scripts', 'portfolio_scripts');

// 2. SOPORTE DEL TEMA
add_theme_support('post-thumbnails');
add_theme_support('title-tag');

// 3. REGISTRO DE CUSTOM POST TYPES
function registrar_cpts_portfolio() {
    // CPT: Proyectos
    $labels_proyectos = array('name' => 'Proyectos', 'singular_name' => 'Proyecto');
    $args_proyectos = array(
        'labels' => $labels_proyectos,
        'public' => true,
        'has_archive' => true,
        'menu_icon' => 'dashicons-portfolio',
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
        'show_in_rest' => true,
    );
    register_post_type('proyectos', $args_proyectos);

    // CPT: Stack Tecnológico
    $labels_stack = array('name' => 'Stack Tecnológico', 'singular_name' => 'Tecnología', 'add_new' => 'Añadir Tecnología', 'add_new_item' => 'Añadir Nueva Tecnología');
    $args_stack = array(
        'labels' => $labels_stack,
        'public' => true,
        'has_archive' => false,
        'menu_icon' => 'dashicons-editor-code',
        'supports' => array('title', 'thumbnail', 'excerpt', 'page-attributes'), 
    );
    register_post_type('stack', $args_stack);
}
add_action('init', 'registrar_cpts_portfolio');

// 4. PERSONALIZADOR (CUSTOMIZER)
function portfolio_customize_register($wp_customize) {
    // --- SECCIÓN: INICIO (HERO) ---
    $wp_customize->add_section('hero_section', array('title' => 'Sección Inicio (Hero)', 'priority' => 30));
    $wp_customize->add_setting('hero_subtitle', array('default' => 'Hola, soy'));
    $wp_customize->add_control('hero_subtitle_control', array('label' => 'Subtítulo', 'section' => 'hero_section', 'settings' => 'hero_subtitle'));
    $wp_customize->add_setting('hero_first_name', array('default' => 'Matías'));
    $wp_customize->add_control('hero_first_name_control', array('label' => 'Nombre', 'section' => 'hero_section', 'settings' => 'hero_first_name'));
    $wp_customize->add_setting('hero_last_name', array('default' => 'Sánchez'));
    $wp_customize->add_control('hero_last_name_control', array('label' => 'Apellido', 'section' => 'hero_section', 'settings' => 'hero_last_name'));
    for ($i = 1; $i <= 5; $i++) {
        $wp_customize->add_setting("hero_specialty_$i", array('default' => ''));
        $wp_customize->add_control("hero_specialty_{$i}_control", array('label' => "Especialidad $i", 'section' => 'hero_section', 'settings' => "hero_specialty_$i"));
    }
    $wp_customize->add_setting('hero_description', array('default' => ''));
    $wp_customize->add_control('hero_description_control', array('label' => 'Descripción', 'section' => 'hero_section', 'settings' => 'hero_description', 'type' => 'textarea'));
    $social_networks = array('facebook', 'instagram', 'linkedin', 'github', 'whatsapp');
    foreach ($social_networks as $network) {
        $wp_customize->add_setting("hero_social_$network", array('default' => ''));
        $wp_customize->add_control("hero_social_{$network}_control", array('label' => ucfirst($network) . ' URL', 'section' => 'hero_section', 'settings' => "hero_social_$network", 'type' => 'url'));
    }
    $wp_customize->add_setting('hero_image');
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'hero_image_control', array('label' => 'Imagen de Perfil', 'section' => 'hero_section', 'settings' => 'hero_image')));
    $wp_customize->add_setting('hero_cv_url');
    $wp_customize->add_control('hero_cv_control', array('label' => 'URL del PDF (CV)', 'section' => 'hero_section', 'settings' => 'hero_cv_url', 'type' => 'url'));

    // --- SECCIÓN: SOBRE MÍ ---
    $wp_customize->add_section('about_section', array('title' => 'Sección Sobre Mí', 'priority' => 31));
    $wp_customize->add_setting('about_text', array('default' => 'Soy un desarrollador web...'));
    $wp_customize->add_control('about_text_control', array('label' => 'Texto Principal', 'section' => 'about_section', 'settings' => 'about_text', 'type' => 'textarea'));
    for ($i = 1; $i <= 3; $i++) {
        $wp_customize->add_setting("about_label_$i", array('default' => ''));
        $wp_customize->add_control("about_label_{$i}_control", array('label' => "Etiqueta $i (Ej: Perfil:)", 'section' => 'about_section', 'settings' => "about_label_$i"));
        $wp_customize->add_setting("about_value_$i", array('default' => ''));
        $wp_customize->add_control("about_value_{$i}_control", array('label' => "Valor $i (Ej: Backend Developer)", 'section' => 'about_section', 'settings' => "about_value_$i"));
    }
}
add_action('customize_register', 'portfolio_customize_register');


// 5. CAJAS META PERSONALIZADAS PARA PROYECTOS (¡NUEVO!)
function portfolio_agregar_metaboxes() {
    add_meta_box(
        'portfolio_datos_proyecto', // ID
        'Enlaces y Tecnologías del Proyecto', // Título
        'portfolio_renderizar_metabox', // Función que dibuja el HTML
        'proyectos', // Dónde mostrarlo (nuestro CPT)
        'normal', // Contexto
        'high' // Prioridad
    );
}
add_action('add_meta_boxes', 'portfolio_agregar_metaboxes');

// Dibuja los campos en el panel
function portfolio_renderizar_metabox($post) {
    // Medida de seguridad obligatoria de WordPress
    wp_nonce_field('guardar_datos_proyecto', 'portfolio_nonce');

    // Recuperar datos existentes si los hay
    $tech_stack = get_post_meta($post->ID, '_portfolio_tech', true);
    $url_github = get_post_meta($post->ID, '_portfolio_github', true);
    $url_demo   = get_post_meta($post->ID, '_portfolio_demo', true);
    $url_sitio  = get_post_meta($post->ID, '_portfolio_sitio', true);
    ?>
    <p>
        <label for="portfolio_tech"><strong>Tecnologías Usadas (Separadas por coma):</strong></label><br>
        <input type="text" id="portfolio_tech" name="portfolio_tech" value="<?php echo esc_attr($tech_stack); ?>" style="width:100%;" placeholder="Ej: Python, Django, SQLite, HTML5" />
    </p>
    <p>
        <label for="portfolio_github"><strong>URL del Repositorio (GitHub):</strong></label><br>
        <input type="url" id="portfolio_github" name="portfolio_github" value="<?php echo esc_url($url_github); ?>" style="width:100%;" placeholder="https://github.com/..." />
    </p>
    <p>
        <label for="portfolio_demo"><strong>URL de la Demo (Pruebas):</strong></label><br>
        <input type="url" id="portfolio_demo" name="portfolio_demo" value="<?php echo esc_url($url_demo); ?>" style="width:100%;" />
    </p>
    <p>
        <label for="portfolio_sitio"><strong>URL del Sitio en Vivo (Producción):</strong></label><br>
        <input type="url" id="portfolio_sitio" name="portfolio_sitio" value="<?php echo esc_url($url_sitio); ?>" style="width:100%;" />
    </p>
    <?php
}

// Guarda los datos en la base de datos
function portfolio_guardar_datos_proyecto($post_id) {
    if (!isset($_POST['portfolio_nonce']) || !wp_verify_nonce($_POST['portfolio_nonce'], 'guardar_datos_proyecto')) return;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!current_user_can('edit_post', $post_id)) return;

    if (isset($_POST['portfolio_tech'])) update_post_meta($post_id, '_portfolio_tech', sanitize_text_field($_POST['portfolio_tech']));
    if (isset($_POST['portfolio_github'])) update_post_meta($post_id, '_portfolio_github', esc_url_raw($_POST['portfolio_github']));
    if (isset($_POST['portfolio_demo'])) update_post_meta($post_id, '_portfolio_demo', esc_url_raw($_POST['portfolio_demo']));
    if (isset($_POST['portfolio_sitio'])) update_post_meta($post_id, '_portfolio_sitio', esc_url_raw($_POST['portfolio_sitio']));
}
add_action('save_post', 'portfolio_guardar_datos_proyecto');