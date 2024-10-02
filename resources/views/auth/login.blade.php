

<!doctype html>

<html lang="en" class="light-style layout-navbar-fixed layout-menu-fixed layout-compact" dir="ltr"
    data-theme="theme-default" data-assets-path="assets/" data-template="vertical-menu-template" data-style="light">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
  
    <title>@yield('title', 'Admin')</title>
    <meta name="description" content="" />

    @include('layouts.head')

</head>

<body>

    <div class="container-xxl col-lg-6 col-xl-5 ">
        <div class="authentication-wrapper authentication-basic container-p-y">
          <div class="authentication-inner py-6">
            <!-- Login -->
            <div class="card">
              <div class="card-body">
                <!-- Logo -->
                <div class="app-brand justify-content-center mb-6">
                  <a href="index.html" class="app-brand-link">
                    <a href="/" class="menu-link">
                        <img style="width: 200px; margin-top: 10px"  src="https://projects.multibizdev.com/tess_kyc/assets/img/tess_logo.png" alt="">
                      </a>
                  </a>
                </div>
                <!-- /Logo -->
                <h4 class="mb-1">Welcome ! 👋</h4>
                <p class="mb-6">Please sign-in to your account and start the adventure</p>
    
                <!-- Form starts here -->
                <form id="formAuthentication" class="mb-4" action="{{ route('login') }}" method="POST">
                    @csrf <!-- Add CSRF protection token -->

                    <div class="mb-6">
                        <label for="email" class="form-label">Email or Username</label>
                        <input
                            type="text"
                            class="form-control"
                            id="email"
                            name="email"
                            placeholder="Enter your email or username"
                            autofocus />
                    </div>
                    <div class="mb-6 form-password-toggle">
                        <label class="form-label" for="password">Password</label>
                        <div class="input-group input-group-merge">
                            <input
                                type="password"
                                id="password"
                                class="form-control"
                                name="password"
                                placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                aria-describedby="password" />
                            <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                        </div>
                    </div>

                    <div class="mb-6">
                        <button class="btn btn-primary d-grid w-100" type="submit">Login</button>
                    </div>
                </form>
                <!-- Form ends here -->
                @if ($errors->any())
                <div style="text-align: center; margin: 20px 0;">
                    <div class="alert alert-danger" style="display: inline-block; width: auto;">
                        @foreach ($errors->all() as $error)
                            <p style="margin: 0;">{{ $error }}</p>
                        @endforeach
                    </div>
                </div>
            @endif
            
            
                            

              </div>
            </div>
            <!-- /Register -->
          </div>
        </div>
    </div>



    @include('layouts.footer')

</body>
</html>
