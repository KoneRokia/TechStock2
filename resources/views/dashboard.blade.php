<x-app-layout>


    <!DOCTYPE html>
    <html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Tableau de Bord - TechStock</title>
        <script src="https://cdn.tailwindcss.com"></script>

        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js" defer></script>
    </head>

    <body class="bg-gray-100 ">

        <div class="flex">
            <!-- Sidebar -->
           
        @include('layouts.sidebar')

       <!-- Main Content -->
<main class="flex-1 p-10 bg-[#F3F3F3] rounded-tl-1xl">

        <!-- La premeiere grande carte -->
    <div class=" p-8 justify-around rounded-lg border border-1 border-[#989898] ">
        <div class="grid grid-cols-1 sm:grid-cols-2 mt-2 gap-x-80">

            <div class="flex flex-wrap items-center bg-[#1FB19E] p-4  w-auto  rounded-lg space-x-2 justify-between mb-7 left-32">
                <div class="flex items-center space-x-2"> 
                <img class=" h-7" src="images/users.png" alt="">
                <h3 class="text-white text-sm sm:text-base md:text-lg">Total Employés</h3>
                </div>
             <p class="ml-auto font-bold text-white text-xl sm:text-2xl ">{{ $totalEmployes ?? '' }}</p>
            </div>
        

        <div class="flex flex-wrap bg-[#272C62] p-4 w-auto rounded-lg space-x-2 justify-between mb-7">

            <div class="flex items-center space-x-2">
                 <img class="h-7" src="images/users.png" alt=""> 
                <h3 class="text-white text-sm sm:text-base md:text-lg">Total Licences</h3>
            </div>

             <p class="text-xl sm:text-2xl font-bold text-white">{{ $totalLicences ?? '' }}</p>
        </div>

        </div>

    </div> <br>

        <!-- La deuxieme grande carte -->
    <div class="rounded-lg border border-1 border-[#989898] w-full p-10">
    <div class="grid grid-cols-1 sm:grid-cols-2 mt-2 gap-x-80 gap-y-2">

             <!-- La carte1 -->
        <div class="flex flex-wrap items-center bg-white p-4 w-full rounded-lg space-x-2 justify-between mb-7">           
            <div class="flex items-center space-x-2 ">
                <img class=" h-6" src="images/Group 1.png" alt="">
                <h3 class="text-[#585858] text-sm sm:text-base md:text-lg">Total Équipements</h3>
            </div>
                <div class=" flex space-x-2">
                    <div class=" rounded-full bg-[#989898] p-1 w-1 h-1 mt-3">
                    </div>
                 <p class="text-xl sm:text-2xl text-[#1FB19E] font-semibold"> {{ $totalEquipements ?? '' }}</p>     

                </div>
                
        </div>

          <!-- La carte2 -->
        <div class="flex flex-wrap bg-white p-4 w-auto rounded-lg space-x-2 justify-between mb-7">
            <div class="flex items-center space-x-2">
                <img class="h-7" src="images/Group 1.png" alt=""> 
                <h3 class="text-[#585858] text-sm sm:text-base md:text-lg">Équipements Actifs</h3>
            </div>
                <div class=" flex space-x-2">
                    <div class=" rounded-full bg-[#989898] p-1 w-1 h-1 mt-3">
                    </div>
                    <p class="text-xl sm:text-2xl text-[#1FB19E] ">{{  $equipementsActifs ?? '' }}</p>

                </div>
        </div>

        <!-- La carte3 -->
        <div class="flex flex-wrap items-center bg-white p-4  w-auto  rounded-lg space-x-2 border-[#989898] justify-between mb-7">
            <div class="flex items-center space-x-2"> 
                <img class=" h-6" src="images/Group 1.png" alt="">
                <h3 class="text-[#585858] text-sm sm:text-base md:text-lg">Équipements en Panne</h3>
            </div> 

                <div class=" flex space-x-2">
                    <div class=" rounded-full bg-[#989898] p-1 w-1 h-1 mt-3">
                    </div>
                    <p class="text-xl sm:text-2xl text-[#1FB19E] ">{{ $equipementsEnPanne ?? '' }}</p>

                </div>

        </div>

            <!-- La carte4 -->
        <div class="flex flex-wrap bg-white p-4  w-auto  rounded-lg space-x-2  justify-between mb-7">

            <div class="flex items-center space-x-2">
                 <img class="h-7" src="images/Group 1.png" alt=""> 
                <h3 class="text-[#585858] text-sm sm:text-base md:text-lg">Équipements Hors D'usage</h3>
            </div>
                <div class=" flex space-x-2">
                    <div class=" rounded-full bg-[#989898] p-1 w-1 h-1 mt-3">
                    </div>
                    <p class="text-xl sm:text-2xl text-[#1FB19E] ">{{  $equipementsHorsService ?? '' }}</p>

                </div>

        </div>

            <!-- La carte5 -->
        <div class="flex flex-wrap items-center bg-white p-4  w-auto  rounded-lg space-x-2 border-[#989898] justify-between mb-7">
            <div class="flex items-center space-x-2"> 
                <img class=" h-6" src="images/Group 1.png" alt="">
                <h3 class="text-[#585858] text-sm sm:text-base md:text-lg ">Total Maintenances</h3>
            </div> 
                <div class=" flex space-x-2">
                    <div class=" rounded-full bg-[#989898] p-1 w-1 h-1 mt-3">
                    </div>
                     <p class="text-xl sm:text-2xl text-[#1FB19E] ">{{ $totalMaintenances ?? '' }}</p>

                </div>

        </div>

            <!-- La carte6 -->
        <div class="flex flex-wrap bg-white p-4  w-auto rounded-lg space-x-2  justify-between mb-7">

            <div class="flex items-center space-x-2">
                 <img class="h-7" src="images/Group 1.png" alt=""> 
                <h3 class="text-[#585858] text-sm sm:text-base md:text-lg">Maintenances en Cours</h3>
            </div>
                <div class=" flex space-x-2">
                    <div class=" rounded-full bg-[#989898] p-1 w-1 h-1 mt-3">
                    </div>
                    <p class="text-xl sm:text-2xl text-[#1FB19E] ">{{  $maintenancesEnCours ?? '' }}</p>

                </div>

        </div>

             <!-- La carte7 -->
        <div class="flex flex-wrap items-center bg-white p-4  w-auto  rounded-lg space-x-2 border-[#989898] justify-between mb-7">
            <div class="flex items-center space-x-2"> 
                <img class=" h-6" src="images/Group 1.png" alt="">
                <h3 class="text-[#585858] text-sm sm:text-base md:text-lg">Maintenances Terminées</h3>
            </div> 
                <div class=" flex space-x-2">
                    <div class=" rounded-full bg-[#989898] p-1 w-1 h-1 mt-3">
                    </div>
                    <p class="text-xl sm:text-2xl text-[#1FB19E] ">{{ $maintenancesTerminees ?? '' }}</p>

                </div>

        </div>
            
            <!-- La carte8 -->
        <div class="flex flex-wrap bg-white p-4  w-auto rounded-lg space-x-2 justify-between mb-7">

            <div class="flex items-center space-x-2">
                 <img class="h-7" src="images/Group 1.png" alt=""> 
                <h3 class="text-[#585858] text-sm sm:text-base md:text-lg">Maintenances En Attente</h3>
            </div>
                <div class=" flex space-x-2">
                    <div class=" rounded-full bg-[#989898] p-1 w-1 h-1 mt-3">
                    </div>
                    <p class="text-xl sm:text-2xl text-[#1FB19E] ">{{  $maintenancesEnAttente ?? '' }}</p>

                </div>

        </div>

        <!-- La carte9 -->
        <div class="flex flex-wrap items-center bg-white p-4  w-auto  rounded-lg space-x-2 border-[#989898] justify-between mb-7">
            <div class="flex items-center space-x-2"> 
                <img class=" h-6" src="images/Group 1.png" alt="">
                <h3 class="text-[#585858] text-sm sm:text-base md:text-lg">Maintenances Annulées</h3>
            </div> 
                <div class=" flex space-x-2">
                    <div class=" rounded-full bg-[#989898] p-1 w-1 h-1 mt-3">
                    </div>
                    <p class="text-xl sm:text-2xl text-[#1FB19E] ">{{ $maintenancesAnnulees ?? '' }}</p>

                </div>

        </div>

            <!-- La carte10 -->
        <div class="flex flex-wrap items-center bg-white p-4  w-auto  rounded-lg space-x-2 border-[#989898] justify-between mb-7">

            <div class="flex items-center space-x-2">
                 <img class="h-7" src="images/Group 1.png" alt=""> 
                <h3 class="text-[#585858] text-sm sm:text-base md:text-lg">Maintenances Reportées</h3>
            </div>
                <div class=" flex space-x-2">
                    <div class=" rounded-full bg-[#989898] p-1 w-1 h-1 mt-3">
                    </div>
                    <p class="text-xl sm:text-2xl text-[#1FB19E] ">{{  $maintenancesReporte ?? '' }}</p>

                </div>

        </div>
            
        </div>
    </div> <br> <br> <br>

        <div class="flex justify-center items-center">
            <img src="{{ asset('images/logoilimiGroup.png') }}" alt="Logo" class="h-6">
</div>

</main>

    </div>

    
</body>
    </html>
</x-app-layout>
