<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="{{asset('images/favicon.svg')}}" type="image/x-icon" />
    <title>Consultas | Hall Seguro</title>

    <!-- ========== All CSS files linkup ========= -->
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}" />
    <link rel="stylesheet" href="{{asset('css/lineicons.css')}}" />
    <link rel="stylesheet" href="{{asset('css/main.css')}}" />
    <link rel="stylesheet" href="{{asset('css/jquery.dataTables.min.css')}}" />
</head>

<body>
    <!-- ======== sidebar-nav start =========== -->
    <aside class="sidebar-nav-wrapper">
        <div class="navbar-logo">
            <!-- <a href="index.html">
                <img src="{{asset('images/logo/logo.svg')}}" alt="logo" />
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
                    <a href="#0" data-bs-toggle="collapse" data-bs-target="#menu_search" aria-controls="menu_search" aria-expanded="true" aria-label="Toggle navigation">
                        <span class="icon">
                            <i class="lni lni-search"></i>
                        </span>
                        <span class="text">Consultas</span>
                    </a>
                    <ul id="menu_search" class="collapsed dropdown-nav collapse show">
                        <li>
                            <a href="{{route('consult.index')}}" class="active">Inspeção de entrada</a>
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
                                <h2 class="mr-40">Consulta</h2>
                            </div>
                        </div>
                        <!-- end col -->
                    </div>
                    <!-- end row -->
                </div>
                <!-- ========== title-wrapper end ========== -->
                <div class="card-style mb-30">
                    <div class="row">
                        <div class="col-lg-12">

                            <h6 class="mb-25">Inspeção de Entrada</h6>
                            <!-- Validation Errors -->
                            <x-validation-errors class="mb-4" />

                            <form method="GET" action="/consult/inspection" class="needs-validation" novalidate>
                                @csrf
                                <div class="row w-100 mb-2">
                                    <div class="col-lg-3">
                                        <div class="input-style-1">
                                            <label>Data inicial</label>
                                            <input type="date" name="initial_date" id="initial_date">
                                            <div class="invalid-feedback">
                                                Escolha uma data.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="input-style-1">
                                            <label>Hora inicial</label>
                                            <input type="time" name="inicitial_time" id="initial_time">
                                            <div class="invalid-feedback">
                                                Escolha uma data.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="input-style-1">
                                            <label>Data final</label>
                                            <input type="date" name="final_date" id="final_date">
                                            <div class="invalid-feedback">
                                                Escolha uma data.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="input-style-1">
                                            <label>Hora final</label>
                                            <input type="time" name="final_time" id="final_time" max='23:59'>
                                            <div class="invalid-feedback">
                                                Escolha uma data.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2 d-flex align-items-center">
                                        <button class="main-btn primary-btn btn-hover"
                                        id="btn-consultar">
                                            Consultar
                                        </button>
                                    </div>
                                </div>
                                <!-- end row -->
                            </form>
                            <!-- end card -->
                        </div>
                        <div class="col-lg-12">
                            <div class="tables-wrapper">
                                <div class="table-responsive">
                                    <div class="dataTable-wrapper dataTable-loading no-footer sortable searchable fixed-columns">
                                        <div class="dataTable-container">
                                            <table class="table" id="table">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Nome</th>
                                                        <th>RG</th>
                                                        <th>Data de entrada</th>
                                                    </tr>
                                                </thead>
                                                <tbody></tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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

    <div class="warning-modal">
    <div class="modal fade" id="modalProfile" tabindex="-1" style="display: none;" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content card-style">
          <div class="modal-header px-0 border-0">
            <h5></h5>
            <button class="border-0 bg-transparent h1" data-bs-dismiss="modal">
              <i class="lni lni-cross-circle"></i>
            </button>
          </div>
          <div class="modal-body px-0">
            <div class="content mb-30">
              <img width="100%"src="#" id="modal-img__profile">
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

    <!-- ========= All Javascript files linkup ======== -->
    <script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('js/polyfill.js')}}"></script>
    <script src="{{asset('js/jquery-3.5.1.js')}}"></script>
    <script src="{{asset('js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('js/moment.min.js')}}"></script>
    <script src="{{asset('js/dataTables.dateTime.min.js')}}"></script>
    <script src="{{asset('js/main.js')}}"></script>
    <script src="{{asset('js/imask.js')}}"></script>

    <script>
        $(document).ready(function() {

            table = $('#table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '/consult/inspection/result?initialDate=&finalDate=',
                columns: [{
                        data: 'image_profile',
                        name: 'image_profile'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'rg',
                        name: 'rg'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at'
                    }
                ],
                language: {
                    url: "{{asset('json/pt_br.json')}}"
                },
                order: [
                    [3, "desc"]
                ]
            });

        });

        $('#btn-consultar').on('click', function(event){
            event.preventDefault();

            let initialDate = $('#initial_date').val();
            let initialTime = $('#initial_time').val();
            let finalDate = $('#final_date').val();
            let finalTime = $('#final_time').val();

            if(initialDate === "") {
                alert("Digite a data inicial");
                return;
            }

            if(initialTime === "") {
                alert("Digite a hora inicial");
                return;
            }

            if(finalDate === "") {
                alert("Digite a data final");
                return;
            }

            if(finalTime === "") {
                alert("Digite a hora final");
                return;
            }

            let momentInitial = moment(initialDate, "YYYY-MM-DD");
            let momentFinalDate = moment(finalDate, "YYYY-MM-DD");

            if(momentInitial.isAfter(momentFinalDate)){
                alert("Data final não pode ser menor que a data inicial");
            }

            table.ajax.url('/consult/inspection/result?initialDate='+momentInitial.format('YYYY-MM-DD')+"&initialTime="+initialTime+"&finalDate="+momentFinalDate.format('YYYY-MM-DD')+"&finalTime="+finalTime).load();
        });
        
    </script>

    <script>
        function showProfileImage(e) {
        let imgRow = e.querySelector('img');
        urlImg = imgRow.src.replace('profile-50.jpg', 'profile.jpg');
        let imgModal = document.getElementById('modal-img__profile');
        imgModal.src = urlImg;
        }
    </script>

</body>

</html>