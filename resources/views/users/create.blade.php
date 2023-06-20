<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="{{ asset('images/favicon.svg') }}" type="image/x-icon" />
    <title>Usuários | Hall Seguro</title>

    <!-- ========== All CSS files linkup ========= -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/lineicons.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/fontawesome/all.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/main.css') }}" />
</head>

<body>
    <!-- ======== sidebar-nav start =========== -->
    <aside class="sidebar-nav-wrapper">
        <div class="navbar-logo">
            <!-- <a href="index.html">
                <img src="{{ asset('images/logo/logo.svg') }}" alt="logo" />
            </a> -->
        </div>
        <nav class="sidebar-nav">
            <ul>
                <li class="nav-item">
                    <a href="{{route('dashboard')}}">
                        <span class="icon">
                            <i class="lni lni-dashboard"></i>
                        </span>
                        <span class="text">Dashboard</span>
                    </a>
                </li>
                <li class="nav-item nav-item-has-children">
                    <a href="#0" class="collapsed" data-bs-toggle="collapse" data-bs-target="#ddmenu_3" aria-controls="ddmenu_3" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="icon">
                            <i class="lni lni-enter"></i>
                        </span>
                        <span class="text">Portaria</span>
                    </a>
                    <ul id="ddmenu_3" class="dropdown-nav collapse">
                        <li>
                            <a href="{{route('lobby.index')}}">Inspeção de entrada</a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{route('customers.index')}}">
                        <span class="icon">
                            <i class="lni lni-customer"></i>
                        </span>
                        <span class="text">Clientes</span>
                    </a>
                </li>
                <span class="divider">
                    <hr></span>
                <li class="nav-item nav-item-has-children">
                    <a href="#0" class="collapsed" data-bs-toggle="collapse" data-bs-target="#menu_search" aria-controls="menu_search" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="icon">
                            <i class="lni lni-search"></i>
                        </span>
                        <span class="text">Consultas</span>
                    </a>
                    <ul id="menu_search" class="dropdown-nav collapse">
                        <li>
                            <a href="{{route('consult.index')}}">Inspeção de entrada</a>
                        </li>
                    </ul>
                </li>
                <span class="divider">
                    <hr></span>
                <li class="nav-item active">
                    <a href="{{route('users.index')}}">
                        <span class="icon">
                            <i class="lni lni-users"></i>
                        </span>
                        <span class="text">Usuários</span>
                    </a>
                </li>
                <li class="nav-item nav-item-has-children">
                    <a href="#0" class="collapsed" data-bs-toggle="collapse" data-bs-target="#config" aria-controls="config" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="icon">
                            <i class="lni lni-cog"></i>
                        </span>
                        <span class="text">Configurações</span>
                    </a>
                    <ul id="config" class="dropdown-nav collapse">
                        <li>
                            <a href="{{route('consentlgpd.index')}}">DOC Consentimento LGPD</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
    </aside>
    <div class="overlay"></div>
    <!-- ======== sidebar-nav end =========== -->

    <!-- ======== main-wrapper start =========== -->
    <main class="main-wrapper">
        <!-- ========== header start ========== -->
        <header class="header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-5 col-md-5 col-6">
                        <div class="header-left d-flex align-items-center">
                            <div class="menu-toggle-btn mr-20">
                                <button id="menu-toggle" class="main-btn primary-btn btn-hover">
                                    <i class="lni lni-chevron-left me-2"></i> Menu
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-7 col-md-7 col-6">
                        <div class="header-right">
                            <!-- profile start -->
                            <div class="profile-box ml-15">
                                <button class="dropdown-toggle bg-transparent border-0" type="button" id="profile" data-bs-toggle="dropdown" aria-expanded="false">
                                    <div class="profile-info">
                                        <div class="info">
                                            <h6>{{ Auth::user()->name }}</h6>
                                        </div>
                                    </div>
                                    <i class="lni lni-chevron-down"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profile">
                                    <li>
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <a href="{{route('logout')}}" onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                                <i class="lni lni-exit"></i>
                                                {{ __('Sair') }}
                                            </a>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                            <!-- profile end -->
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- ========== header end ========== -->

        <!-- ========== section start ========== -->
        <section class="section">
            <div class="container-fluid">
                <!-- ========== title-wrapper start ========== -->
                <div class="title-wrapper pt-30">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <div class="title d-flex align-items-center flex-wrap mb-30">
                                <h2 class="mr-40">Novo Usuário</h2>
                            </div>
                        </div>
                        <!-- end col -->
                    </div>
                    <!-- end row -->
                </div>
                <!-- ========== title-wrapper end ========== -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-style mb-30">
                            <h6 class="mb-25">Dados do usuário</h6>
                            <!-- Validation Errors -->
                            <x-auth-validation-errors class="mb-4" :errors="$errors" />

                            <form method="POST" action="{{route('users.create')}}" class="needs-validation" novalidate>
                                @csrf
                                <div class="row">
                                    <div class="col-12">
                                        <div class="input-style-1">
                                            <label>Nome completo</label>
                                            <input type="text" name="name" placeholder="Nome completo" class="form-control bg-transparent" required>
                                            <div class="invalid-feedback">
                                                Digite o nome completo.
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end col -->
                                    <div class="col-12">
                                        <div class="input-style-1">
                                            <label>Nome usuário</label>
                                            <input type="text" name="username" placeholder="Nome usuário" class="form-control bg-transparent" pattern="^[A-Za-z0-9._]+$" required>
                                            <div class="invalid-feedback">
                                                Digite o nome do usuário para acesso ao sistema sem acentuação e espaços. Exemplo: jorge.
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end col -->
                                    <div class="col-12">
                                        <x-input-password class="bg-transparent" pattern=".{8,}" />
                                    </div>
                                    <div class="col-12">
                                        <div class="select-style-1">
                                            <label>Permissão</label>
                                            <div class="select-position">
                                                <select name="group" class="form-control" required>
                                                    <option value="">Selecione permissão</option>
                                                    <option value="1">Operador</option>
                                                    <option value="2">Administrador</option>
                                                </select>
                                                <div class="invalid-feedback">
                                                    Selecione uma permissão.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" name="company_id" value="{{$company_id}}" />
                                    <!-- end col -->
                                    <div class="col-12">
                                        <button class="main-btn primary-btn btn-hover">
                                            Incluir
                                        </button>
                                    </div>
                                </div>
                                <!-- end row -->
                            </form>
                        </div>
                        <!-- end card -->
                    </div>

                </div>
                <!-- end container -->
        </section>
        <!-- ========== section end ========== -->

        <!-- ========== footer start =========== -->
        <!-- <footer class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6 order-last order-md-first">
                        <div class="copyright text-center text-md-start">
                            <p class="text-sm">
                                Designed and Developed by
                                <a href="https://plainadmin.com" rel="nofollow" target="_blank">
                                    PlainAdmin
                                </a>
                            </p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="
                  terms
                  d-flex
                  justify-content-center justify-content-md-end
                ">
                            <a href="#0" class="text-sm">Term & Conditions</a>
                            <a href="#0" class="text-sm ml-15">Privacy & Policy</a>
                        </div>
                    </div>
                </div>
            </div>
        </footer> -->
        <!-- ========== footer end =========== -->
    </main>
    <!-- ======== main-wrapper end =========== -->

    <!-- ========= All Javascript files linkup ======== -->
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/Chart.min.js') }}"></script>
    <script src="{{ asset('js/dynamic-pie-chart.js') }}"></script>
    <script src="{{ asset('js/jvectormap.min.js') }}"></script>
    <script src="{{ asset('js/world-merc.js') }}"></script>
    <script src="{{ asset('js/polyfill.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>

    @stack('password')

    <script>
        // Example starter JavaScript for disabling form submissions if there are invalid fields
        (function() {
            "use strict";

            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.querySelectorAll(".needs-validation");

            // Loop over them and prevent submission
            Array.prototype.slice.call(forms).forEach(function(form) {
                form.addEventListener(
                    "submit",
                    function(event) {
                        if (!form.checkValidity()) {
                            event.preventDefault();
                            event.stopPropagation();
                        }

                        form.classList.add("was-validated");
                    },
                    false
                );
            });
        })();
    </script>

</body>

</html>