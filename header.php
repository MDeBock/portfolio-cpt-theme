<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>

    <nav class="navbar navbar-expand-lg sticky-top" style="background-color: var(--bg-color); border-bottom: 1px solid var(--second-bg-color);">
        <div class="container justify-content-center">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation" style="border-color: var(--main-color);">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo esc_url(home_url('/')); ?>#inicio">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo esc_url(home_url('/')); ?>#sobre-mi">Sobre Mí</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo esc_url(home_url('/')); ?>#proyectos">Proyectos</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>