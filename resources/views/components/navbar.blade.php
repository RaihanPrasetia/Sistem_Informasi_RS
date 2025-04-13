   <nav id="navbar" class="bg-white shadow-md p-4 flex justify-between items-center transition-all duration-300">
       <!-- Button untuk membuka sidebar -->
       <button id="sidebarToggle" class="text-gray-700 hover:text-green-500 focus:outline-none">
           <i class="fa-solid fa-bars text-xl"></i>
       </button>

       <!-- Nama user yang login -->
       <div class="text-gray-700 font-medium">
           {{ Auth::user()->name ?? 'Guest' }}
       </div>
   </nav>
