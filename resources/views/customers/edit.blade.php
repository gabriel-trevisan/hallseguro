<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="{{ asset('images/favicon.svg') }}" type="image/x-icon" />
    <title>Clientes | Hall Seguro</title>

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
                <li class="nav-item active">
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
                                <h2 class="mr-40">Editar cliente</h2>
                            </div>
                        </div>
                        <!-- end col -->
                    </div>
                    <!-- end row -->
                </div>
                <!-- ========== title-wrapper end ========== -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-style settings-card-1 mb-30">
                            <div class="
                                title
                                mb-30
                                d-flex
                                justify-content-between
                                align-items-center
                            ">
                                <h6>Dados do cliente</h6>
                            </div>
                            <x-validation-errors />
                            <form method="post" action="{{route('customers.update', ['id' => $customer->id])}}" class="needs-validation" novalidate>
                                @csrf
                                @method('PUT')
                                <div class="profile-info">
                                    <div class="d-flex align-items-center mb-30">
                                        <div class="profile-image">
                                            <img src="{{route('customers.profile.image', ['companyID' => $company_id, 'customerID' => $customer->id, 'image' => 'profile.jpg'] )}}" alt="" id="download-photo">
                                            <input type="hidden" name="image_profile" />
                                            <div class="update-image form-control webcam-start" id="camera">
                                                <label for=""><i class="lni lni-camera"></i></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-check form-switch toggle-switch mb-30">
                                        <input class="form-check-input" type="checkbox" name="status" id="bloqued" {{ $customer->bloqued == 0 ? 'checked' : ''}}>
                                        <label class="form-check-label mb-2" for="bloqued">Ativo</label>
                                        <div class="form-check-description" style="display: none;">
                                            <div class="warning-alert">
                                                <div class="alert">
                                                    <h5 class="text-bold mb-15">Atenção!</h5>
                                                    <p class="text-sm text-gray">
                                                        Você esta prestes a bloquear este cliente.
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" name="company_id" value="{{$company_id}}" />
                                    @if(!empty($customer->bloqued_at))
                                    <div class="input-style-1">
                                        <label>Data bloqueio</label>
                                        <input type="date" name="bloqued_at" class="form-control" value="{{ $customer->bloqued_at }}" disabled>
                                    </div>
                                    @endif
                                    <div class="input-style-1">
                                        <label>Nome completo</label>
                                        <input type="text" name="name" placeholder="Nome completo" class="form-control bg-transparent" id="name" value="{{ $customer->name }}" required>
                                        <div class="invalid-feedback">
                                            Digite o nome completo.
                                        </div>
                                    </div>
                                    <div class="input-style-1">
                                        <label>RG</label>
                                        <input 
                                            type="text" 
                                            name="rg" 
                                            placeholder="RG" 
                                            class="form-control bg-transparent" 
                                            id="rg" 
                                            value="{{ $customer->rg }}"
                                        >
                                        <div class="invalid-feedback">
                                            Digite o RG.
                                        </div>
                                    </div>
                                    <div class="input-style-1">
                                        <label>Título de eleitor</label>
                                        <input 
                                            type="text" 
                                            name="voter" 
                                            placeholder="Título de eleitor" 
                                            class="form-control bg-transparent" 
                                            id="voter"
                                            value="{{ $customer->voter }}" 
                                        >
                                        <div class="invalid-feedback">
                                            Digite o título de eleitor.
                                        </div>
                                    </div>
                                    <div class="input-style-1">
                                        <label>Carteira de trabalho</label>
                                        <input 
                                            type="text" 
                                            name="work_card" 
                                            placeholder="Carteira de trabalho" 
                                            class="form-control bg-transparent" 
                                            id="work-card"
                                            value="{{ $customer->work_card }}" 
                                        >
                                        <div class="invalid-feedback">
                                            Digite a carteira de trabalho.
                                        </div>
                                    </div>
                                    <div class="input-style-1">
                                        <label>Passaporte</label>
                                        <input 
                                            type="text" 
                                            name="passport" 
                                            placeholder="Passaporte" 
                                            class="form-control bg-transparent" 
                                            id="passport"
                                            value="{{ $customer->passport }}" 
                                        >
                                        <div class="invalid-feedback">
                                            Digite o passaporte.
                                        </div>
                                    </div>
                                    <div class="input-style-1" id="container-input__cellphone">
                                        <label>Celular</label>
                                        <input 
                                            type="text" 
                                            name="cellphone" 
                                            placeholder="Número do celular com DDD" 
                                            class="form-control bg-transparent" 
                                            id="cellphone" 
                                            value="{{ $customer->cellphone }}"
                                            pattern="\(\d{2}\) \d{5}-\d{4}"
                                        >
                                        <div class="invalid-feedback">
                                            Digite o número do celular com DDD.
                                        </div>
                                    </div>
                                    <div class="input-style-1" id="container-input__email">
                                        <label>E-mail</label>
                                        <input 
                                            type="email" 
                                            name="email" 
                                            placeholder="E-mail" 
                                            class="form-control bg-transparent" 
                                            id="email" 
                                            value="{{ $customer->email }}"
                                            pattern='^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$'
                                        >
                                        <div class="invalid-feedback">
                                            Digite o e-mail do cliente. Exemplo: jorge.augusto@gmail.com
                                        </div>
                                    </div>
                                    <div class="input-style-1">
                                        <label>Observação</label>
                                        <textarea name="note" rows="4" class="form-control bg-transparent" placeholder="Escreva alguma observação se necessário.">{{ $customer->note }}</textarea>
                                    </div>
                                    <div class="col-12">
                                        <button class="main-btn warning-btn btn-hover">
                                            Alterar
                                        </button>
                                    </div>
                                </div>
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
    <div class="modal-video">
        <div class="modal-video__container">
            <a href="#" id="take-photo" title="Tirar foto">
                <label for="">
                    <i class="lni lni-camera"></i>
                </label>
            </a>
        </div>
        <video id="webcam" autoplay playsinline></video>
        <canvas id="canvas" class="d-none"></canvas>
    </div>

    <!-- ========= All Javascript files linkup ======== -->
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/dynamic-pie-chart.js') }}"></script>
    <script src="{{ asset('js/jvectormap.min.js') }}"></script>
    <script src="{{ asset('js/world-merc.js') }}"></script>
    <script src="{{ asset('js/polyfill.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    <script src="{{ asset('js/imask.js') }}"></script>

    <script type="text/javascript" src="{{ asset('js/webcam-easy.min.js') }}"></script>

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

    <script>
        const webcamElement = document.getElementById('webcam');
        const canvasElement = document.getElementById('canvas');
        const snapSoundElement = document.getElementById('snapSound');
        const webcam = new Webcam(webcamElement, 'environment', canvasElement, snapSoundElement);

        const camera = document.getElementById('camera').addEventListener('click', startCamera);
        const takePhotoElement = document.getElementById('take-photo').addEventListener('click', takePhoto);
        const modalVideo = document.getElementsByClassName('modal-video')[0];

        function startCamera() {
            webcam.start().then(result => {
                modalVideo.style.display = "block"
                console.log("webcam started");
            }).catch(err => {
                console.log(err);
            });
        }

        function takePhoto() {
            let picture = webcam.snap(); //Tirar Foto
            document.querySelector('#download-photo').src = picture; //Guardar na img src
            document.getElementsByName("image_profile")[0].setAttribute("value", picture); //Por a imagem no profile
            modalVideo.style.display = "none";
        }
    </script>

<script>
        var regExpMask = IMask(document.getElementById('rg'), {
            mask: /^[\w]{1,12}$/,
            prepare: function (str) {
                return str.toUpperCase();
            }
        });
        var regExpMask2 = IMask(document.getElementById('name'), {
            mask: /^[A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ ]+$/
        });
        var regExpMask3 = IMask(document.getElementById('cellphone'), {
            mask: '(00) 00000-0000'
        });
        var regExpMask4 = IMask(document.getElementById('voter'), {
            mask: /^[\w]{1,12}$/,
            prepare: function (str) {
                return str.toUpperCase();
            }
        });
        var regExpMask5 = IMask(document.getElementById('work-card'), {
            mask: /^[\w]{1,13}$/,
            prepare: function (str) {
                return str.toUpperCase();
            }
        });
        var regExpMask6 = IMask(document.getElementById('passport'), {
            mask: /^[\w]{1,8}$/,
            prepare: function (str) {
                return str.toUpperCase();
            }
        });
    </script>

    <script>
        bloqued = document.getElementById('bloqued').addEventListener('click', showAlert);
        formCheckDescription = document.getElementsByClassName('form-check-description')[0];

        function showAlert() {
            if (this.checked) { // Cliente está ativo, não mostrar alerta
                formCheckDescription.style.display = 'none';
            } else { //Inativando cliente, mostrar alerta
                formCheckDescription.style.display = 'block';
            }
        }
    </script>

</body>

</html>