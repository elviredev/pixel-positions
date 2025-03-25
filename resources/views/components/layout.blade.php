<!doctype html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <title>Pixel Positions</title>
   <link rel="preconnect" href="https://fonts.googleapis.com">
   <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
   <link
      href="https://fonts.googleapis.com/css2?family=Hanken+Grotesk:wght@400;500;600&display=swap"
      rel="stylesheet">
   @vite(['resources/css/app.css', 'resources/js/app.js'])
   <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11" defer></script>
</head>
<body class="bg-black text-white font-primary pb-10">
   <div class="px-10">
      <nav class="flex justify-between items-center py-4 border-b border-white/10">
         <div>
            <a href="/">
               <img src="{{ Vite::asset('resources/images/logo.svg') }}" alt="logo">
            </a>
         </div>

         <!-- Menu Navigation -->
         <div class="hidden lg:flex lg:space-x-6 lg:flex-1 lg:justify-center">
            <a href="/">Jobs</a>
            <a href="#">Careers</a>
            <a href="#">Salaries</a>
            <a href="#">Companies</a>
         </div>

         <div class="hidden lg:flex lg:space-x-6">
            @auth
               <a href="/jobs/create">Post a Job</a>

               <form method="POST" action="/logout">
                  @csrf
                  @method('DELETE')

                  <button class="cursor-pointer">Log Out</button>
               </form>
            @endauth

            @guest
               <a href="/register">Sign Up</a>
               <a href="/login">Log In</a>
            @endguest
         </div>

         <!-- Bouton Menu Mobile -->
         <button id="menu-toggle" class="lg:hidden cursor-pointer">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                 xmlns="http://www.w3.org/2000/svg">
               <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                     d="M4 6h16M4 12h16m-7 6h7"></path>
            </svg>
         </button>

      </nav>

      <!-- Menu Mobile -->
      <div id="mobile-menu" class="hidden flex-col items-center space-y-4 absolute top-16 left-0 w-full bg-black p-6 lg:hidden">
         <a href="/">Jobs</a>
         <a href="#">Careers</a>
         <a href="#">Salaries</a>
         <a href="#">Companies</a>

         @auth
            <a href="/jobs/create">Post a Job</a>
            <form method="POST" action="/logout">
               @csrf
               @method('DELETE')
               <button class="cursor-pointer">Log Out</button>
            </form>
         @endauth

         @guest
            <a href="/register">Sign Up</a>
            <a href="/login">Log In</a>
         @endguest
      </div>

      <main class="mt-10 max-w-[986px] mx-auto">
         {{ $slot }}
      </main>
   </div>

   <!-- Script pour gérer l'affichage du menu -->
   <script>
      document.getElementById('menu-toggle').addEventListener('click', function () {
         const menu = document.getElementById('mobile-menu');
         menu.classList.toggle('hidden');
         menu.classList.toggle('flex'); // Ajoute/enlève flex pour garder l'affichage en colonne
      });
   </script>
</body>
</html>
