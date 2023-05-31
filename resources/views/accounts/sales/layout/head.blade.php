<head>

    <meta charset="utf-8" />
    <title>Ethio FunClub</title>
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >
    <meta
        content="A fully featured admin theme which can be used to build CRM, CMS, etc."
        name="description"
    />
    <meta
        content="Coderthemes"
        name="author"
    />
    <meta
        http-equiv="X-UA-Compatible"
        content="IE=edge"
    />
    <!-- App favicon -->
    <link
        rel="shortcut icon"
        href="{{ asset('assets/images/favicon.ico') }}"
    >

    <!-- Plugins css -->
    <link
        href="{{ asset('assets/libs/flatpickr/flatpickr.min.css') }}"
        rel="stylesheet"
        type="text/css"
    />
    <link
        href="{{ asset('assets/libs/selectize/css/selectize.bootstrap3.css') }}"
        rel="stylesheet"
        type="text/css"
    />

    <!-- Bootstrap css -->
    <link
        href="{{ asset('assets/css/bootstrap.min.css') }}"
        rel="stylesheet"
        type="text/css"
    />
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.6/dist/sweetalert2.min.css"
    >

    <!-- App css -->
    <link
        href="{{ asset('assets/css/app.min.css') }}"
        rel="stylesheet"
        type="text/css"
        id="app-style"
    />

    <!-- icons -->
    <link
        href="{{ asset('assets/css/icons.min.css') }}"
        rel="stylesheet"
        type="text/css"
    />
    <style>
        .inactive-menu {
            opacity: 0.5;
        }

        body {
            font-family: sans-serif;
            font-size: 12px;
        }

        .tree {
            transform-origin: 50%;
        }

        .tree ul {
            position: relative;
            padding: 1em 0;
            white-space: nowrap;
            margin: 0 auto;
            text-align: center;
        }

        .tree ul::after {
            content: '';
            display: table;
            clear: both;
        }

        .tree li {
            display: inline-block;
            vertical-align: top;
            text-align: center;
            list-style-type: none;
            position: relative;
            padding: 1em 0.5em 0 0.5em;
        }

        .tree li::before,
        .tree li::after {
            content: '';
            position: absolute;
            top: 0;
            right: 50%;
            border-top: 1px solid #ccc;
            width: 50%;
            height: 1em;
        }

        .tree li::after {
            right: auto;
            left: 50%;
            border-left: 1px solid #ccc;
        }

        .tree li:only-child::after,
        .tree li:only-child::before {
            display: none;
        }

        .tree li:only-child {
            padding-top: 0;
        }

        .tree li:first-child::before,
        .tree li:last-child::after {
            border: 0 none;
        }

        .tree li:last-child::before {
            border-right: 1px solid #ccc;
            border-radius: 0 5px 0 0;
        }

        .tree li:first-child::after {
            border-radius: 5px 0 0 0;
        }

        .tree ul ul::before {
            content: '';
            position: absolute;
            top: 0;
            left: 50%;
            border-left: 1px solid #ccc;
            width: 0;
            height: 1em;
        }

        .tree li a {
            border: 1px solid #ccc;
            padding: 0.5em 0.75em;
            text-decoration: none;
            display: inline-block;
            border-radius: 5px;
            color: #333;
            position: relative;
            top: 1px;
        }

        .tree li a:hover,
        .tree li a:hover+ul li a {
            background: #eef73e;
            color: #fff;
            border: 1px solid #eef73e;
        }

        .tree li a:hover+ul li::after,
        .tree li a:hover+ul li::before,
        .tree li a:hover+ul::before,
        .tree li a:hover+ul ul::before {
            border-color: #eef73e;
        }

        @media only screen and (max-width: 768px) {
            body {
                font-family: sans-serif;
                font-size: 9px;
            }
        }
    </style>
    <!-- Head js -->
    <script src="assets/js/head.js"></script>

</head>
