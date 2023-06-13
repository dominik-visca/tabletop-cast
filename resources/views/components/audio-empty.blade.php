 @props(['i'])

 <li class="col-span-1 rounded-lg dark:bg-gray-700 bg-white shadow opacity-25">
     <div class="flex w-full items-center justify-between space-x-6 p-3">
         <div data-slot="{{ $i }}"
             class="play-button h-12 w-12 bg-gray-900 items-center justify-center flex rounded">
             <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-play"
                 viewBox="0 0 16 16">
                 <use href="#playSvgNormal"></use>
             </svg>
         </div>

         <div class="flex-1 truncate">
             <div class="flex items-center space-x-3">
                 <h3 class="truncate text-sm font-medium text-gray-800 dark:text-gray-200">
                 </h3>
             </div>
             <p class="mt-1 truncate text-sm text-gray-700 dark:text-gray-400">
                 <!-- Platzhalter -->
             </p>
         </div>
     </div>

     <input class="w-full dark:bg-gray-900 dark:border-gray-900 border-2" disabled type="range" min="1"
         max="100" value="50" class="slider">

     <div>
     </div>
 </li>
