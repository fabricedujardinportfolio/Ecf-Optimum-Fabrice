<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" /><?php wp_head(); ?>
  <style>
    /* Une partie du css à était charger dans le header car il y avait des probléme de css qui ne fonctionner pas . (A corriger)*/
    #respond {
      float: inherit;
    }

    .rt-tpg-container .layout1 .rt-holder .rt-img-holder img {
      max-width: auto;
      max-height: 300px;
      width: 100%;
    }

    #rt-tpg-container-998701299>div>.rt-img-holder {
      max-height: 244px;
    }

    .modifLien {
      padding: 5px;
      background-color: #fa5742 !important;
      color: white !important;
    }

    #text-3>h2 {
      text-align: center;
    }

    #text-2>h2 {
      text-align: center;
    }

    .placement {
      width: fit-content;
    }

    #menu-fabrice-menue {
      margin: auto;
      width: fit-content;
    }

    .menu-fabrice-menue {
      list-style-type: none;
      margin: 0;
      padding: 0;
      overflow: hidden;
      background-color: #333;
    }

    ul {
      margin: 0;
    }

    li {
      float: left;
      list-style: none;
    }

    .rt-tpg-container .layout1 .rt-holder .rt-detail .read-more {
      display: block;
      text-align: left;
    }

    li a {
      display: block;
      text-align: center;
      padding: 14px 16px;
      text-decoration: none;
    }

    #menu-fabrice-menue li a:hover:not(.active) {
      background-color: #ECB139;
    }

    @media (max-width: 768px) {
      #menu-fabrice-menue {
        margin-left: 13%;
        margin-right: 10%;
      }
    }

    @media (max-width: 618px) {
      li {
        float: inherit;
      }
    }

    @media (max-width: 548px) {

      .bg-dark {
        min-height: 150px;
      }
    }

    @media (max-width: 384px) {

      #searchform>div {
        text-align: center;
      }
    }

    @media (max-width: 308px) {

      .bg-dark {
        min-height: 226px;
      }
    }
  </style>
</head>

<body <?php body_class(); ?>>
  <header class="header" style="background-image: url(<?php echo get_template_directory_uri(); ?>/img/fp-overlay.jpg;">
    <!-- Debut -->
    <nav class="navbar navbar-dark bg-muted m-auto minHeightfixe border-bottom border-warning">
      <div class=" col-12 d-none d-md-block d-lg-block" id="navbarsExample08">
        <ul class="navbar-nav">
          <li class="nav-item active">
            <a href="<?php echo home_url('/'); ?>">
              <img src="<?php echo get_template_directory_uri(); ?>/img/muscu.png" width="75" height="75" alt="Logo" class="d-none d-md-block d-lg-block m-auto">
            </a>
          </li>
        </ul>
      </div>
      <div class="col-12  m-auto test d-flex">
        <div class="col-3">
        </div>
        <div class="col-6 ">
          <div class="container d-flex">
            <div class="col-1"></div>
            <div class="col-12">
              <?php wp_nav_menu(); ?>
            </div>
            <div class="col-1"></div>
          </div>
          <div class="col-12 text-center">
            <h1 style="font-family: Pineforest; text-transform: uppercase; color:white;" >
              Optimum
            </h1>
            <img src="<?php echo get_template_directory_uri(); ?>/img/header.PNG" alt="" width="150" height="150" class="m-auto">
          </div>
        </div>
      </div>
      <div class="col-3">
      </div>
      </div>
      <div class="col-12 d-block d-md-flex">
        <div class="col-md-4 col-12"></div>
        <div class="col-md-4 col-12 m-auto placement pt-3">
          <?php get_search_form(); ?>
        </div>
        <div class="col-md-2 col-12"></div>
      </div>
    </nav>
    <!-- Fin -->
  </header><?php wp_body_open(); ?>