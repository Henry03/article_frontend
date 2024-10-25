<html lang="en" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css" integrity="sha512-q3eWabyZPc1XTCmF+8/LuE1ozpg5xxn7iO89yfSOd5/oKvyqLngoNGsx8jq92Y8eXJ/IRxQbEC+FGSYxtk2oiw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Document</title>
    <style>
        .h-10 {
            height: 2.5rem;
        }
    </style>
</head>
<body>
    <div class="navbar bg-base-100 border-b">
        <div class="navbar-start">
          <div class="dropdown">
            <div tabIndex={0} role="button" class="btn btn-ghost lg:hidden">
                <label for="my-drawer-2" class="drawer-button lg:hidden">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-5 w-5"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path
                        strokeLinecap="round"
                        strokeLinejoin="round"
                        strokeWidth="2"
                        d="M4 6h16M4 12h8m-8 6h16" />
                    </svg>
              
                </label>
            </div>
          </div>
          <a class="btn btn-ghost text-xl">Team 1</a>
        </div>
        <div class="navbar-end items-center gap-2">
            @if (session()->has('LoginSession'))
                <a class="btn btn-primary" href={{route('article.store')}}>
                    <i class="fa fa-plus"></i>
                    Create
                </a>
                <div class="flex-none">
                    <div class="dropdown dropdown-end">
                    <div tabindex="0" role="button" class="btn btn-ghost btn-circle avatar">
                        <div class="w-10 rounded-full">
                            <x-UserProfileIcon name="{{session()->get('LoginSessionName')}}" height="10"/>
                        </div>
                    </div>
                    <ul
                        tabindex="0"
                        class="menu menu-sm dropdown-content bg-base-100 rounded-box z-[1] mt-3 w-52 p-2 shadow">
                        <li>

                        <li><a href={{route('logout')}}>Logout</a></li>
                    </ul>
                    </div>
                </div>
            @else
                <a class="btn btn-primary" href={{route('login')}}>Login</a>
            @endif

        </div>
    </div>

    <div class="drawer lg:drawer-open">
        <input id="my-drawer-2" type="checkbox" class="drawer-toggle" />
        <div class="drawer-content">
            @yield('content')
        </div>
        <div class="drawer-side h-dvh lg:h-[calc(100dvh-4rem)]">
          <label for="my-drawer-2" aria-label="close sidebar" class="drawer-overlay"></label>
          <ul class="menu bg-base-100 text-base-content w-80 p-4 border-e gap-2 h-dvh lg:h-[calc(100dvh-4rem)]">
            <li class="flex flex-row items-center ">
                <a class="w-full  {{Request::is('/') ? 'btn-active' : ''}}" href={{route('home')}}>
                    <i class="fa fa-home"></i>
                    Home
                </a>
            </li>
            @if (session()->has('LoginSession'))
                <li class="flex flex-row items-center ">
                    <a class="w-full  {{Request::is('myarticle') ? 'btn-active' : ''}}" href={{route('myarticle')}}>
                        <i class="fa fa-layer-group"></i>
                        My Post
                    </a>
                </li>
            @endif
          </ul>
        </div>
    </div>
    <dialog id="loginModal" class="modal">
        <div class="modal-box">
            <div class="flex justify-between mb-5">
                <h3 class="text-lg font-bold">Login</h3>
                <form method="dialog">
                  <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
                </form>
            </div>
            <form class="flex flex-col gap-5">
                <label class="input input-bordered flex items-center gap-2">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 16 16"
                        fill="currentColor"
                        class="h-4 w-4 opacity-70">
                        <path
                            d="M2.5 3A1.5 1.5 0 0 0 1 4.5v.793c.026.009.051.02.076.032L7.674 8.51c.206.1.446.1.652 0l6.598-3.185A.755.755 0 0 1 15 5.293V4.5A1.5 1.5 0 0 0 13.5 3h-11Z" />
                        <path
                            d="M15 6.954 8.978 9.86a2.25 2.25 0 0 1-1.956 0L1 6.954V11.5A1.5 1.5 0 0 0 2.5 13h11a1.5 1.5 0 0 0 1.5-1.5V6.954Z" />
                    </svg>
                    <input name="email" type="text" class="grow" placeholder="Email" />
                </label>
                <label class="input input-bordered flex items-center gap-2">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 16 16"
                        fill="currentColor"
                        class="h-4 w-4 opacity-70">
                        <path
                            fill-rule="evenodd"
                            d="M14 6a4 4 0 0 1-4.899 3.899l-1.955 1.955a.5.5 0 0 1-.353.146H5v1.5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5v-2.293a.5.5 0 0 1 .146-.353l3.955-3.955A4 4 0 1 1 14 6Zm-4-2a.75.75 0 0 0 0 1.5.5.5 0 0 1 .5.5.75.75 0 0 0 1.5 0 2 2 0 0 0-2-2Z"
                            clip-rule="evenodd" />
                    </svg>
                    <input name="password" type="password" class="grow" placeholder="Password" />
                </label>
                <button class="btn btn-primary">Login</button>
            </form>
        </div>
        <form method="dialog" class="modal-backdrop">
            <button>close</button>
          </form>
      </dialog>
    
    <script>
        function showLoginModal() {
            document.getElementById('loginModal').showModal();
        }

        @if(session()->has('status')){
            @if(session('status')){
                Swal.fire({
                    title: "Success!",
                    text: "{{ session('message') }}",
                    icon: "success",
                    timer: 3000,
                    showConfirmButton: false,
                    toast: true,
                    position: 'top-end'
                });
            }
            @elseif(session('status') == false){
                Swal.fire({
                    title: "Error!",
                    text: "{{ session('message') }}",
                    icon: "error",
                    timer: 3000,
                    showConfirmButton: false,
                    toast: true,
                    position: 'top-end'
                });
            }
            @endif
        }
        @endif
    </script>
</body>
</html>
