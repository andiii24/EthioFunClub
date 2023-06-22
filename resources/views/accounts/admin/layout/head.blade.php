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
    <link
        href="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/css/select2.min.css"
        rel="stylesheet"
    />

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
        .counter {
            background-color: red;
            color: white;
            font-size: 8px;
            /* padding: 4px 8px; */
            border-radius: 50%;
            /* position: absolute; */
            top: -8px;
            right: -8px;
        }

        .deactivate-btn {
            display: none;
        }

        .active .activate-btn {
            display: none;
        }

        .active .deactivate-btn {
            display: inline-block;
        }

        .inactive .activate-btn {
            display: inline-block;
        }

        .inactive .deactivate-btn {
            display: none;
        }
    </style>
    <!-- Head js -->
    <script src="{{ asset('assets/js/head.js') }}"></script>


</head>
