<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="CairoGRND Restaurant">
    <title>CairoGRND Restaurant</title>
    <link href="../components/assets/css/bootstrap.css" rel="stylesheet">
    <link href="../components/assets/fontawesome/css/fontawesome.css" rel="stylesheet">
    <link href="../components/assets/fontawesome/css/brands.css" rel="stylesheet">
    <link href="../components/assets/fontawesome/css/solid.css" rel="stylesheet">
    <link rel="apple-touch-icon" sizes="180x180" href="../components/assets/img/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../components/assets/img/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../components/assets/img/favicon-16x16.png">
    <link rel="manifest" href="../components/assets/img/site.webmanifest">
    <script src="../components/assets/js/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="../components/assets/js/bootstrap.bundle.js"></script>
    <style>
        body {
            font-size: .875rem;
        }

        ::selection {
            background: #3a3a3a;
            background-color: rgba(58, 58, 58, 0.4);
        }

        ::-moz-selection {
            background: #3a3a3a;
            background-color: rgba(58, 58, 58, 0.4);
        }

        .custom_mt_nav {
            margin-top: -15px;
        }

        .custom_top_nav {
            margin-top: -1px;
            margin-bottom: -1px;
        }

        .feather {
            width: 16px;
            height: 16px;
        }

        /*
        * Sidebar
        */

        .sidebar {
            position: fixed;
            top: 0;
            /* rtl:raw:
        right: 0;
        */
            bottom: 0;
            /* rtl:remove */
            left: 0;
            z-index: 100;
            /* Behind the navbar */
            padding: 48px 0 0;
            /* Height of navbar */
            box-shadow: inset -1px 0 0 rgba(0, 0, 0, .1);
        }

        @media (max-width: 767.98px) {
            .sidebar {
                top: 5rem;
            }
        }

        .sidebar-sticky {
            position: relative;
            top: 0;
            height: calc(100vh - 48px);
            padding-top: .5rem;
            overflow-x: hidden;
            overflow-y: auto;
        }

        .sidebar .nav-link {
            font-weight: 500;
            color: #333;
        }

        .sidebar .nav-link .feather {
            margin-right: 4px;
            color: #727272;
        }

        .sidebar .nav-link.active {
            color: #2470dc;
        }

        .sidebar .nav-link:hover .feather,
        .sidebar .nav-link.active .feather {
            color: inherit;
        }

        .sidebar-heading {
            font-size: .75rem;
        }

        .navbar-brand {
            padding-top: .75rem;
            padding-bottom: .75rem;
            background-color: rgba(0, 0, 0, .25);
            box-shadow: inset -1px 0 0 rgba(0, 0, 0, .25);
        }

        .navbar .navbar-toggler {
            top: .25rem;
            right: 1rem;
        }

        .navbar .form-control {
            padding: .75rem 1rem;
        }

        .form-control-dark {
            color: #fff;
            background-color: rgba(255, 255, 255, .1);
            border-color: rgba(255, 255, 255, .1);
        }

        .form-control-dark:focus {
            border-color: transparent;
            box-shadow: 0 0 0 3px rgba(255, 255, 255, .25);
        }

        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }

        .b-example-divider {
            height: 3rem;
            background-color: rgba(0, 0, 0, .1);
            border: solid rgba(0, 0, 0, .15);
            border-width: 1px 0;
            box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
        }

        .b-example-vr {
            flex-shrink: 0;
            width: 1.5rem;
            height: 100vh;
        }

        .bi {
            vertical-align: -.125em;
            fill: currentColor;
        }

        .nav-scroller {
            position: relative;
            z-index: 2;
            height: 2.75rem;
            overflow-y: hidden;
        }

        .nav-scroller .nav {
            display: flex;
            flex-wrap: nowrap;
            padding-bottom: 1rem;
            margin-top: -1px;
            overflow-x: auto;
            text-align: center;
            white-space: nowrap;
            -webkit-overflow-scrolling: touch;
        }
    </style>
</head>