<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="shortcut icon" href="images/favicon.svg" type="image/x-icon" />
  <title>Clientes | Hall Seguro</title>

  <!-- ========== All CSS files linkup ========= -->
  <link rel="stylesheet" href="css/bootstrap.min.css" />
  <link rel="stylesheet" href="css/lineicons.css" />
  <!-- <link rel="stylesheet" href="css/vanilla-dataTables.min.css" /> -->
  <link rel="stylesheet" href="css/jquery.dataTables.min.css" />
  <link rel="stylesheet" href="css/main.css" />
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
                <h2 class="mr-40">Clientes</h2>
                <a href="{{route('customers.create')}}" class="main-btn primary-btn btn-hover btn-sm">
                  <i class="lni lni-plus mr-5"></i> Novo cliente
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
                        <div class="container-button__filter mb-3">
                          <div class="form-check form-switch toggle-switch">
                            <input class="form-check-input" type="checkbox" id="check-filter">
                            <label class="form-check-label" for="check-filter">Filtro avançado</label>
                          </div>
                        </div>
                        <div id="container-content__filter" style="display: none;">
                          <div class="row w-100 mb-2">
                            <div class="col-sm-2 col-md-4 col-lg-3">
                              <div class="input-style-1">
                                <label>Data inicial</label>
                                <input type="date" name="initial_date" id="initial_date">
                              </div>
                            </div>
                            <div class="col-sm-2 col-md-4 col-lg-3">
                              <div class="input-style-1">
                                <label>Data final</label>
                                <input type="date" name="final_date" id="final_date">
                              </div>
                            </div>
                          </div>
                        </div>
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>Nome</th>
                            <th>RG</th>
                            <th>Status</th>
                            <th>Observação</th>
                            <th>Data cadastro</th>
                            <th>Data bloqueio</th>
                            <th>Ação</th>
                          </tr>
                        </thead>
                        <tbody></tbody>
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

  <div class="warning-modal">
    <div class="modal fade" id="ModalFour" tabindex="-1" style="display: none;" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content card-style">
          <div class="modal-header px-0 border-0">
            <h5 class="text-bold">
              <i class="lni lni-warning text-danger me-2"></i> Você tem certeza que deseja excluir este registro?
            </h5>
          </div>
          <div class="modal-body px-0">
            <div class="content mb-30">
              <p class="text-sm">
                A exclusão deste registro pode ser que não seja recuperado.
              </p>
            </div>
            <div class="action d-flex flex-wrap justify-content-end">
              <button type="button" data-bs-dismiss="modal" class="main-btn danger-btn-outline btn-hover m-1">Cancelar</a>
                <button type="button" data-bs-dismiss="modal" class="main-btn primary-btn btn-hover m-1" onclick="deleteData()">Confirmar exclusão</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

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
  <script src="js/bootstrap.bundle.min.js"></script>
  <script src="js/Chart.min.js"></script>
  <script src="js/dynamic-pie-chart.js"></script>
  <script src="js/jvectormap.min.js"></script>
  <script src="js/world-merc.js"></script>
  <script src="js/polyfill.js"></script>
  <!-- <script src="js/vanilla-dataTables.min.js"></script> -->
  <script src="js/jquery-3.5.1.js"></script>
  <script src="js/jquery.dataTables.min.js"></script>
  <script src="js/moment.min.js"></script>
  <script src="js/dataTables.dateTime.min.js"></script>
  <script src="js/main.js"></script>

  <script>
    // Custom Datatable

    $.fn.dataTable.ext.search.push(
      function(settings, data, dataIndex) {
        var min = $('#initial_date').val();
        var max = $('#final_date').val();

        var d = data[4].substring(0, 2);
        var m = data[4].substring(3, 5);
        var y = data[4].substring(6, 10);

        var date = moment(y + '-' + m + '-' + d).format("YYYY-MM-DD");

        if (
          (min === "" && max === "") ||
          (min === "" && date <= max) ||
          (min <= date && max === "") ||
          (min <= date && date <= max)
        ) {
          return true;
        }
        return false;
      }
    );

    $(document).ready(function() {

      table = $('#table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('customers.index') }}",
        columns: [
          {data: 'image_profile', name: 'image_profile'},
          {data: 'name', name: 'name'},
          {data: 'rg', name: 'rg'},
          {data: 'bloqued', name: 'bloqued'},
          {data: 'note', name: 'note'},
          {data: 'created_at', name: 'created_at'},
          {data: 'bloqued_at', name: 'bloqued_at'},
          {data: 'action', name: 'action', "bSearchable": false}
        ],
        language: {
          url: "json/pt_br.json"
        },
        order: [
          [5, "desc"]
        ]
      });

      // Refilter the table
      $('#initial_date, #final_date').on('change', function() {
        table.draw();
      });
    });
  </script>

  <script>
    //Advanced filter in Datatable
    let containerContent = document.getElementById('container-content__filter');

    document.getElementById('check-filter').addEventListener('click', function() {
      if (this.checked) {
        containerContent.style.display = "block";
      } else {
        containerContent.style.display = "none";
        $('#initial_date').val('');
        $('#final_date').val('');
        table.draw();
      }
    });
  </script>

  <script>
    // Custom delete data
    var form;

    function formSubmit(event) {
      event.preventDefault();
      form = event.target;
      console.log("deletando");
    }

    function deleteData() {
      form.submit();
    }
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