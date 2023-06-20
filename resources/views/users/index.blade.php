<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="shortcut icon" href="images/favicon.svg" type="image/x-icon" />
  <title>Usuários | Hall Seguro</title>

  <!-- ========== All CSS files linkup ========= -->
  <link rel="stylesheet" href="css/bootstrap.min.css" />
  <link rel="stylesheet" href="css/lineicons.css" />
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
                <h2 class="mr-40">Usuários</h2>
                <a href="{{route('users.create')}}" class="main-btn primary-btn btn-hover btn-sm">
                  <i class="lni lni-plus mr-5"></i> Novo usuário
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
                            <th>Status</th>
                            <th>Nome</th>
                            <th>Usuário</th>
                            <th>Grupo</th>
                            <th>Ação</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($users as $user)
                          <tr>
                            <td>
                              @if($user->bloqued == 0)
                              <span class="status-btn active-btn mb-2">Ativo</span>
                              @else
                              <span class="status-btn close-btn mb-2">Inativo</span>
                              @endif
                            </td>
                            <td>
                              <p>{{ $user->name }}</p>
                            </td>
                            <td>
                              <p>{{ $user->username }}</p>
                            </td>
                            <td>
                              @if($user->group == 2)
                              <p>Administrador</p>
                              @else
                              <p>Operador</p>
                              @endif
                            </td>
                            <td>
                              <div class="action">
                                <a href="{{route('users.edit', ['id' => $user->id])}}" class="text-dark mr-20">
                                  <i class="lni lni-pencil-alt"></i>
                                </a>
                                <form method="POST" action="{{route('users.destroy', ['id' => $user->id])}}" onsubmit="formSubmit(event)">
                                  @csrf
                                  @method('DELETE')
                                  <button type="submit" class="text-danger" data-bs-toggle="modal" data-bs-target="#ModalFour">
                                    <i class="lni lni-trash-can"></i>
                                  </button>
                                </form>
                              </div>
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

  <!-- ========= All Javascript files linkup ======== -->
  <script src="js/bootstrap.bundle.min.js"></script>
  <script src="js/Chart.min.js"></script>
  <script src="js/dynamic-pie-chart.js"></script>
  <script src="js/jvectormap.min.js"></script>
  <script src="js/world-merc.js"></script>
  <script src="js/polyfill.js"></script>
  <script src="js/jquery-3.5.1.js"></script>
  <script src="js/jquery.dataTables.min.js"></script>
  <script src="js/main.js"></script>

  <script>
    $(document).ready(function() {
      $('#table').DataTable({
        "language": {
          "url": "json/pt_br.json"
        }
      });
    });
  </script>

  <script>
    var form;

    function formSubmit(event){
      event.preventDefault();
      form = event.target;
      console.log("deletando");
    }

    function deleteData(){
      form.submit();
    }
    
  </script>

</body>

</html>