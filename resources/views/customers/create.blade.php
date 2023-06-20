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
                                <h2 class="mr-40">Novo cliente</h2>
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
                            <form method="POST" action="{{route('customers.create')}}" class="needs-validation" novalidate>
                                @csrf
                                <div class="profile-info">
                                    <div class="d-flex align-items-center mb-30">
                                        <div class="profile-image">
                                            <img src="" alt="" id="download-photo">
                                            <input type="hidden" name="image_profile" />
                                            <div class="update-image form-control webcam-start" id="camera">
                                                <label for=""><i class="lni lni-camera"></i></label>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" name="company_id" value="{{$company_id}}" />
                                    <div class="input-style-1">
                                        <label>Nome completo</label>
                                        <input type="text" name="name" placeholder="Nome completo" class="form-control bg-transparent" id="name" value="{{ old('name') }}" required>
                                        <div class="invalid-feedback">
                                            Digite o nome completo.
                                        </div>
                                    </div>
                                    <h6 class="mb-15 text-sm">Documento de Identificação</h6>
                                    <div class="form-check radio-style mb-20">
                                        <input 
                                            class="form-check-input" 
                                            type="radio"
                                            id="radio-rg" 
                                            name="identification"
                                            value="1"
                                            required
                                            onclick="showIdentificationInputs(this)"
                                        >
                                        <label class="form-check-label" for="radio-rg">
                                            RG
                                        </label>
                                    </div>
                                    <div class="form-check radio-style mb-20">
                                    <input 
                                        class="form-check-input" 
                                        type="radio"
                                        id="radio-voter" 
                                        name="identification"
                                        value="2"
                                        required
                                        onclick="showIdentificationInputs(this)"
                                    >
                                        <label class="form-check-label" for="radio-voter">
                                            Título de eleitor
                                        </label>
                                    </div>
                                    <div class="form-check radio-style mb-20">
                                    <input 
                                        class="form-check-input" 
                                        type="radio"
                                        id="radio-workCard" 
                                        name="identification"
                                        value="3"
                                        required
                                        onclick="showIdentificationInputs(this)"
                                    >
                                        <label class="form-check-label" for="radio-workCard">
                                            Carteira de Trabalho
                                        </label>
                                    </div>
                                    <div class="form-check radio-style mb-20">
                                    <input 
                                        class="form-check-input" 
                                        type="radio"
                                        id="radio-passport" 
                                        name="identification"
                                        value="4"
                                        required
                                        onclick="showIdentificationInputs(this)"
                                    >
                                        <label class="form-check-label" for="radio-passport">
                                            Passaporte
                                        </label>
                                    </div>
                                    <div class="input-style-1" id="container-input__rg" style="display: none;">
                                        <label>RG</label>
                                        <input 
                                            type="text" 
                                            name="rg" 
                                            placeholder="RG" 
                                            class="form-control bg-transparent" 
                                            id="rg" 
                                            value="{{ old('rg') }}" 
                                            required
                                        >
                                        <div class="invalid-feedback">
                                            Digite o RG.
                                        </div>
                                    </div>
                                    <div class="input-style-1" id="container-input__voter" style="display: none;">
                                        <label>Título de eleitor</label>
                                        <input 
                                            type="text" 
                                            name="voter" 
                                            placeholder="Título de eleitor" 
                                            class="form-control bg-transparent" 
                                            id="voter" 
                                            value="{{ old('voter') }}" 
                                            required
                                        >
                                        <div class="invalid-feedback">
                                            Digite o título de eleitor. Exemplo: 000012345678
                                        </div>
                                    </div>
                                    <div class="input-style-1" id="container-input__work-card" style="display: none;">
                                        <label>Carteira de trabalho</label>
                                        <input 
                                            type="text" 
                                            name="work_card" 
                                            placeholder="Carteira de trabalho" 
                                            class="form-control bg-transparent" 
                                            id="work-card" 
                                            value="{{ old('work_card') }}" 
                                            required
                                        >
                                        <div class="invalid-feedback">
                                            Digite a carteira de trabalho. Exemplo: 00000000123SP
                                        </div>
                                    </div>
                                    <div class="input-style-1" id="container-input__passport" style="display: none;">
                                        <label>Passaporte</label>
                                        <input 
                                            type="text" 
                                            name="passport" 
                                            placeholder="Passaporte" 
                                            class="form-control bg-transparent" 
                                            id="passport" 
                                            value="{{ old('passport') }}" 
                                            required
                                        >
                                        <div class="invalid-feedback">
                                            Digite o passaporte. Exemplo: BR123456
                                        </div>
                                    </div>
                                    <h6 class="mb-15 text-sm">Consentimento LGPD</h6>
                                    <div class="form-check radio-style mb-20">
                                        <input 
                                            class="form-check-input" 
                                            type="radio" 
                                            value="1" 
                                            id="radio-sms" 
                                            name="type_consent" 
                                            required
                                            onclick="showInputs(this)"
                                        >
                                        <label class="form-check-label" for="radio-sms">
                                            Enviar por SMS
                                        </label>
                                    </div>
                                    <div class="form-check radio-style mb-20">
                                    <input 
                                        class="form-check-input" 
                                        type="radio"
                                        value="2"
                                        id="radio-email" 
                                        name="type_consent" 
                                        required
                                        onclick="showInputs(this)"
                                    >
                                        <label class="form-check-label" for="radio-email">
                                            Enviar por E-mail
                                        </label>
                                    </div>
                                    <div class="input-style-1" id="container-input__cellphone" style="display: none;">
                                        <label>Celular</label>
                                        <input 
                                            type="text" 
                                            name="cellphone" 
                                            placeholder="Número do celular com DDD" 
                                            class="form-control bg-transparent" 
                                            id="cellphone" 
                                            value="{{ old('cellphone') }}"
                                            pattern="\(\d{2}\) \d{5}-\d{4}"
                                            required
                                        >
                                        <div class="invalid-feedback">
                                            Digite o número do celular com DDD.
                                        </div>
                                    </div>
                                    <div class="input-style-1" id="container-input__email" style="display: none;">
                                        <label>E-mail</label>
                                        <input 
                                            type="email" 
                                            name="email" 
                                            placeholder="E-mail" 
                                            class="form-control bg-transparent" 
                                            id="email" 
                                            value="{{ old('email') }}"
                                            pattern='^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$'
                                            required
                                        >
                                        <div class="invalid-feedback">
                                            Digite o e-mail do cliente. Exemplo: jorge.augusto@gmail.com
                                        </div>
                                    </div>
                                    <div class="input-style-1">
                                        <label>Observação</label>
                                        <textarea name="note" rows="4" class="form-control bg-transparent" placeholder="Escreva alguma observação se necessário." value="{{ old('note') }}"></textarea>
                                    </div>
                                    <div class="col-12">
                                    <button class="main-btn primary-btn btn-hover" id="btn-include">
                                            Incluir
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
            var btnInclude = document.getElementById('btn-include');

            // Loop over them and prevent submission
            Array.prototype.slice.call(forms).forEach(function(form) {
                form.addEventListener(
                    "submit",
                    function(event) {

                        //Disable button
                        btnInclude.classList.remove("primary-btn");
                        btnInclude.classList.add("deactive-btn");
                        btnInclude.disabled = true;

                        if (!form.checkValidity()) {
                            event.preventDefault();
                            event.stopPropagation();
                            
                            //Enable button
                            btnInclude.classList.remove("deactive-btn");
                            btnInclude.classList.add("primary-btn");
                            btnInclude.disabled = false;
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
        function showInputs(e){
            let containerInputCellphone = document.getElementById('container-input__cellphone');
            let containerInputEmail = document.getElementById('container-input__email');
            let inputEmail = document.getElementById('email');
            let inputCellphone = document.getElementById('cellphone');

            if(e.value == 1){ //SMS
                containerInputEmail.style.display = "none";
                containerInputCellphone.style.display = "block";
                inputEmail.disabled = true;
                inputCellphone.disabled = false;
            } else {
                containerInputCellphone.style.display = "none";
                containerInputEmail.style.display = "block";
                inputCellphone.disabled = true;
                inputEmail.disabled = false;
            }
        }

        function showIdentificationInputs(e){
            let containerInputRG = document.getElementById('container-input__rg');
            let containerInputVoter = document.getElementById('container-input__voter');
            let containerInputWorkCard = document.getElementById('container-input__work-card');
            let containerInputPassport = document.getElementById('container-input__passport');
            let inputVoter = document.getElementById('voter');
            let inputRG = document.getElementById('rg');
            let inputWorkCard = document.getElementById('work-card');
            let inputPassport = document.getElementById('passport');

            containerInputVoter.style.display = "none";
            containerInputWorkCard.style.display = "none";
            containerInputPassport.style.display = "none";
            containerInputRG.style.display = "none";

            inputVoter.disabled = true;
            inputRG.disabled = true;
            inputWorkCard.disabled = true;
            inputPassport.disabled = true;

            if(e.value == 1){ //RG
                containerInputRG.style.display = "block";
                inputRG.disabled = false;
            } else if(e.value == 2) { //Titulo de eleitor
                containerInputVoter.style.display = "block";
                inputVoter.disabled = false;
            } else if(e.value == 3) { //Carteira de trabalho
                containerInputWorkCard.style.display = "block";
                inputWorkCard.disabled = false;
            } else { //Passaporte
                containerInputPassport.style.display = "block";
                inputPassport.disabled = false;
            }
        }
    </script>

</body>

</html>