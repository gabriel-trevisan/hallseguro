<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="shortcut icon" href="images/favicon.svg" type="image/x-icon" />
  <title>Login | Hall Seguro</title>

  <!-- ========== All CSS files linkup ========= -->
  <link rel="stylesheet" href="css/bootstrap.min.css" />
  <link rel="stylesheet" href="css/fontawesome/all.min.css" />
  <link rel="stylesheet" href="css/main.css" />
</head>

<body>
  <!-- ======== main-wrapper start =========== -->
  <main>
    <!-- ========== signin-section start ========== -->
    <section class="signin-section">
      <div class="row g-0 auth-row">
        <div class="col-lg-6 auth-left">
          <div class="auth-cover-wrapper bg-primary-100">
            <div class="auth-cover">
              <div class="title text-center">
                <h1 class="text-primary mb-10">Bem-vindo</h1>
                <p class="text-medium">
                  Faça login em sua conta existente para continuar
                </p>
              </div>
              <div class="cover-image">
                <img src="images/auth/signin-image.svg" alt="" />
              </div>
            </div>
          </div>
        </div>
        <!-- end col -->
        <div class="col-lg-6">
          <div class="signin-wrapper">
            <div class="form-wrapper">
              <h6 class="mb-15">Login</h6>
              <p class="text-sm mb-25">
                Digite seu usuário e senha abaixo.
              </p>
              <!-- Validation Errors -->
              <x-auth-validation-errors class="mb-4" :errors="$errors" />
              <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="row">
                  <div class="col-12">
                    <div class="input-style-1">
                      <label>Usuário</label>
                      <input type="text" placeholder="Usuário" name="username" value="{{ old('username') }}" required />
                    </div>
                  </div>
                  <!-- end col -->
                  <div class="col-12">
                    <x-input-password/>
                  </div>

                  <input type="hidden" name="company_id" value="{{ $company_id }}"/>

                  <!-- end col -->
                  <div class="col-xxl-6 col-lg-12 col-md-6">
                    <div class="form-check checkbox-style mb-30">
                      <input class="form-check-input" type="checkbox" value="" id="checkbox-remember" name="remember"/>
                      <label class="form-check-label" for="checkbox-remember">
                        Lembre-me</label>
                    </div>
                  </div>
                  <!-- end col -->
                  <div class="col-12">
                    <div class="
                            button-group
                            d-flex
                            justify-content-center
                            flex-wrap
                          ">
                      <button class="
                              main-btn
                              primary-btn
                              btn-hover
                              w-100
                              text-center
                            ">
                        Entrar
                      </button>
                    </div>
                  </div>
                </div>
                <!-- end row -->
              </form>
            </div>
          </div>
        </div>
        <!-- end col -->
      </div>
      <!-- end row -->
    </section>
    <!-- ========== signin-section end ========== -->

    <!-- ========== footer start =========== -->
    <!-- <footer class="footer">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-6 order-last order-md-first">
              <div class="copyright text-center text-md-start">
                <p class="text-sm">
                  Designed and Developed by
                  <a
                    href="https://plainadmin.com"
                    rel="nofollow"
                    target="_blank"
                  >
                    PlainAdmin
                  </a>
                </p>
              </div>
            </div>
          </div>
        </div>
      </footer> -->
    <!-- ========== footer end =========== -->
  </main>
  <!-- ======== main-wrapper end =========== -->
  @stack('password')
</body>

</html>