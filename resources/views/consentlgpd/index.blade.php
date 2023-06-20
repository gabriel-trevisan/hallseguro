<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="{{asset('images/favicon.svg')}}" type="image/x-icon" />
    <title>LGPD | Hall Seguro</title>

    <!-- ========== All CSS files linkup ========= -->
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}" />
    <link rel="stylesheet" href="{{asset('css/lineicons.css')}}" />
    <link rel="stylesheet" href="{{asset('css/jquery.dataTables.min.css')}}" />
    <link rel="stylesheet" href="{{asset('css/main.css')}}" />
</head>

<body>
    <!-- ======== sidebar-nav start =========== -->
    <aside class="sidebar-nav-wrapper">
        <div class="navbar-logo">
            <!-- <a href="index.html">
        <img src="images/logo/logo.svg" alt="logo" />
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
                <li class="nav-item">
                    <a href="{{route('users.index')}}">
                        <span class="icon">
                            <i class="lni lni-users"></i>
                        </span>
                        <span class="text">Usuários</span>
                    </a>
                </li>
                <li class="nav-item nav-item-has-children">
                    <a href="#0" data-bs-toggle="collapse" data-bs-target="#config" aria-controls="config" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="icon">
                            <i class="lni lni-cog"></i>
                        </span>
                        <span class="text">Configurações</span>
                    </a>
                    <ul id="config" class="collapsed show dropdown-nav">
                        <li>
                            <a href="{{route('consentlgpd.index')}}" class="active">DOC Consentimento LGPD</a>
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
                        <div class="col-md-12">
                            <div class="title d-flex align-items-center flex-wrap mb-30">
                                <h2 class="mr-40">Modelo consentimentos</h2>
                                <a href="{{route('consentlgpd.create')}}" class="main-btn primary-btn btn-hover btn-sm">
                                    <i class="lni lni-plus mr-5"></i> Novo consentimento
                                </a>
                            </div>
                        </div>
                        <!-- end col -->
                    </div>
                    <!-- end row -->
                </div>

                <x-validation-errors />

                <!-- ========== title-wrapper end ========== -->
                <div class="tables-wrapper">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card-style mb-30">
                                <div class="table-responsive">
                                    <div class="dataTable-wrapper dataTable-loading no-footer sortable searchable fixed-columns">
                                        <div class="dataTable-container">
                                            <table class="table" id="table">
                                                <thead>
                                                    <tr>
                                                        <th>Versão</th>
                                                        <th>Título</th>
                                                        <th>Status</th>
                                                        <th>Data cadastro</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($documents as $document)
                                                    <tr>
                                                        <td>
                                                            <p>{{ $document->version }}</p>
                                                        </td>
                                                        <td>
                                                            <p>{{ $document->title }}</p>
                                                        </td>
                                                        <td>
                                                            @if($document->status == 1)
                                                                <span class="status-btn active-btn mb-2">Vigente</span>
                                                            @else
                                                                <span class="status-btn close-btn mb-2">Antigo</span>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <p>{{ date('d/m/Y', strtotime($document->created_at)) }}</p>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end card -->
                        </div>
                        <!-- end col -->
                    </div>
                    <!-- end row -->
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
    <script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('js/Chart.min.js')}}"></script>
    <script src="{{asset('js/dynamic-pie-chart.js')}}"></script>
    <script src="{{asset('js/jvectormap.min.js')}}"></script>
    <script src="{{asset('js/world-merc.js')}}"></script>
    <script src="{{asset('js/polyfill.js')}}"></script>
    <script src="{{asset('js/jquery-3.5.1.js')}}"></script>
    <script src="{{asset('js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('js/main.js')}}"></script>

    <script>
        $(document).ready(function() {
            $('#table').DataTable({
                "language": {
                    "url": "{{asset('json/pt_br.json')}}"
                },
                "order": [
                    [0, "desc"]
                ]
            });
        });
    </script>

</body>

</html>