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

        <!-- La premeiere drande carte -->
    <div class="flex p-8 justify-around rounded-lg border border-1 border-[#989898] ">

         <div class="flex items-center bg-[#1FB19E] p-4 w-[400px] rounded-lg space-x-2 justify-between">
            <div class="flex items-center space-x-2"> 
                <img class=" h-7" src="images/users.png" alt="">
                <h3 class="text-white">Total Employés</h3>
            </div>
             <p class="ml-auto text-3xl font-bold text-white">{{ $totalEmployes ?? '' }}</p>
        </div>
        

        <div class="flex bg-[#272C62] p-4 w-[400px] rounded-lg space-x-2 justify-between">

            <div class="flex items-center space-x-2">
                 <img class="h-7" src="images/users.png" alt=""> 
                <h3 class="text-white">Total Licences</h3>
            </div>

             <p class="text-3xl font-bold text-white">{{ $totalLicences ?? '' }}</p>
        </div>

    </div> <br>

    <!-- La deuxieme grande carte -->
<div class="rounded-lg border border-1 border-[#989898] p-10">

            <!-- La div1 -->
    <div class="flex justify-evenly  ">
                <!-- La carte1 -->
        <div class="flex items-center bg-white p-4 w-[400px] rounded-lg space-x-2 border-[#989898] justify-between">
            <div class="flex items-center space-x-2 ">
                <img class=" h-6" src="images/Group 1.png" alt="">
                <h3 class="text-[#585858] ">Total Équipements</h3>
            </div>
                 <p class="ml-auto text-2xl text-[#585858] left-80">. {{ $totalEquipements ?? '' }}</p>
        </div>

          <!-- La carte2 -->
        <div class="flex bg-white p-4 w-[400px] rounded-lg space-x-2 justify-between">
            <div class="flex items-center space-x-2">
                <img class="h-7" src="images/Group 1.png" alt=""> 
                <h3 class="text-[#585858] ">Équipements Actifs</h3>
            </div>
                <p class="text-2xl  text-[#585858] ">.{{  $equipementsActifs ?? '' }}</p>

        </div>

    </div> <br>

                    <!-- La div2 -->
      <div class="flex justify-evenly">
        <div class="flex items-center bg-white p-4 w-[400px] rounded-lg space-x-2 border-[#989898] justify-between">
            <div class="flex items-center space-x-2"> 
                <img class=" h-6" src="images/Group 1.png" alt="">
                <h3 class="text-[#585858] ">Équipements en Panne</h3>
            </div> 

             <p class="ml-auto text-2xl text-[#585858] ">.{{ $equipementsEnPanne ?? '' }}</p>
        </div>


        <div class="flex bg-white p-4 w-[400px] rounded-lg space-x-2  justify-between">

            <div class="flex items-center space-x-2">
                 <img class="h-7" src="images/Group 1.png" alt=""> 
                <h3 class="text-[#585858] ">Équipements Hors D'usage</h3>
            </div>

             <p class="text-2xl text-[#585858] ">.{{  $equipementsHorsService ?? '' }}</p>
        </div>

      </div> <br>


                    <!-- La div3 -->
      <div class="flex justify-evenly">
        <div class="flex items-center bg-white p-4 w-[400px] rounded-lg space-x-2 border-[#989898] justify-between">
            <div class="flex items-center space-x-2"> 
                <img class=" h-6" src="images/Group 1.png" alt="">
                <h3 class="text-[#585858] ">Total Maintenances</h3>
            </div> 

             <p class="ml-auto text-2xl text-[#585858] ">.{{ $totalMaintenances ?? '' }}</p>
        </div>


        <div class="flex bg-white p-4 w-[400px] rounded-lg space-x-2  justify-between">

            <div class="flex items-center space-x-2">
                 <img class="h-7" src="images/Group 1.png" alt=""> 
                <h3 class="text-[#585858] ">Maintenances en Cours</h3>
            </div>

             <p class="text-2xl text-[#585858] ">.{{  $maintenancesEnCours ?? '' }}</p>
        </div>

      </div> <br>


                    <!-- La div4 -->
      <div class="flex justify-evenly">
        <div class="flex items-center bg-white p-4 w-[400px] rounded-lg space-x-2 border-[#989898] justify-between">
            <div class="flex items-center space-x-2"> 
                <img class=" h-6" src="images/Group 1.png" alt="">
                <h3 class="text-[#585858] ">Maintenances Terminées</h3>
            </div> 

             <p class="ml-auto text-2xl text-[#585858] ">.{{ $maintenancesTerminees ?? '' }}</p>
        </div>


        <div class="flex bg-white p-4 w-[400px] rounded-lg space-x-2 justify-between ">

            <div class="flex items-center space-x-2">
                 <img class="h-7" src="images/Group 1.png" alt=""> 
                <h3 class="text-[#585858] ">Maintenances En Attente</h3>
            </div>

             <p class="text-2xl text-[#585858] ">.{{  $maintenancesEnAttente ?? '' }}</p>
        </div>

      </div> <br>


                    <!-- La div5 -->
      <div class="flex justify-evenly">
        <div class="flex items-center bg-white p-4 w-[400px] rounded-lg space-x-2 border-[#989898] justify-between">
            <div class="flex items-center space-x-2"> 
                <img class=" h-6" src="images/Group 1.png" alt="">
                <h3 class="text-[#585858] ">Maintenances Annulées</h3>
            </div> 

             <p class="ml-auto text-2xl text-[#585858] ">.{{ $maintenancesAnnulees ?? '' }}</p>
        </div>


        <div class="flex bg-white p-4 w-[400px] rounded-lg space-x-2 justify-between">

            <div class="flex items-center space-x-2">
                 <img class="h-7" src="images/Group 1.png" alt=""> 
                <h3 class="text-[#585858] ">Maintenances Reportées</h3>
            </div>

             <p class="text-2xl text-[#585858] ">.{{  $maintenancesReporte ?? '' }}</p>
        </div>

      </div> 

</div> <br> <br>
        <div class="flex justify-center items-center">
            <img src="{{ asset('images/logoilimiGroup.png') }}" alt="Logo" class="h-6">
        </div>

</main>

    </div>

    
</body>
    </html>
</x-app-layout>
