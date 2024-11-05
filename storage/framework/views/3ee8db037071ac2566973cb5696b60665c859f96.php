
<?php if (isset($component)) { $__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da = $component; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\AppLayout::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>

<?php $__env->startSection('content'); ?>


  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
   <nav class="relative flex flex-wrap items-center justify-between px-0 py-2 mx-6 transition-all ease-in shadow-none duration-250 rounded-2xl lg:flex-nowrap lg:justify-start" navbar-main navbar-scroll="false">
      <div class="flex items-center justify-between w-full px-4 py-1 mx-auto flex-wrap-inherit">
        <nav>
          <!-- breadcrumb -->
          <ol class="flex flex-wrap pt-1 mr-12 bg-transparent rounded-lg sm:mr-16">
            <li class="text-sm leading-normal">
              <a class="text-black opacity-50" href="">Pages</a>
            </li>
            <li class="text-sm pl-2 capitalize leading-normal text-black before:float-left before:pr-2 before:text-black before:content-['/']" aria-current="page">Utilisateurs</li>
          </ol>
          <h6 class="mb-0 font-bold text-black capitalize">Utilisateurs</h6>
        </nav>
        
      </div>
    </nav>
  
    <div class="w-full max-w-screen-xl mx-auto px-6">
      <div class="flex justify-center p-4 px-3 py-10">
          <div class="w-full max-w-md">
              <div class="bg-white shadow-md rounded-lg px-3 py-2 mb-4">
                  <div class="block text-gray-700 text-lg font-semibold py-2 px-2">
                    <a href="<?php echo e(route('User.create')); ?>"> 
                      <button class="flex bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        <i class="mr-3">
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-person-add" viewBox="0 0 16 16">
                            <path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7m.5-5v1h1a.5.5 0 0 1 0 1h-1v1a.5.5 0 0 1-1 0v-1h-1a.5.5 0 0 1 0-1h1v-1a.5.5 0 0 1 1 0m-2-6a3 3 0 1 1-6 0 3 3 0 0 1 6 0M8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4"/>
                            <path d="M8.256 14a4.5 4.5 0 0 1-.229-1.004H3c.001-.246.154-.986.832-1.664C4.484 10.68 5.711 10 8 10q.39 0 .74.025c.226-.341.496-.65.804-.918Q8.844 9.002 8 9c-5 0-6 3-6 4s1 1 1 1z"/>
                          </svg>  
                        </i>  
                        Ajouter un utilisateur
                      </button>
                  </a>
                  </div><br>
                  <div class="flex items-center bg-gray-200 rounded-md">
                      <div class="pl-2">
                          <svg class="fill-current text-gray-500 w-6 h-6" xmlns="http://www.w3.org/2000/svg"
                              viewBox="0 0 24 24">
                              <path class="heroicon-ui"
                                  d="M16.32 14.9l5.39 5.4a1 1 0 0 1-1.42 1.4l-5.38-5.38a8 8 0 1 1 1.41-1.41zM10 16a6 6 0 1 0 0-12 6 6 0 0 0 0 12z" />
                          </svg>
                      </div>
                      <input
                        class="w-full rounded-md bg-gray-200 text-gray-700 leading-tight focus:outline-none py-2 px-2"
                        id="search" type="text" placeholder="Search teams or members">
                  </div>
                  <div class="py-3 text-sm">
                    <?php $__currentLoopData = $User->sortByDesc('id'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $us): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <a href="<?php echo e(route('User.edit', $us->id)); ?>">
                      <div class="user-item-<?php echo e($us->id); ?> flex justify-start cursor-pointer text-gray-700 hover:text-blue-400 hover:bg-blue-100 rounded-md px-2 py-2 my-2">
                          <span class="bg-green-400 h-2 w-2 m-2 rounded-full"></span>
                          <div class="flex-grow font-medium px-2"><?php echo e($us->name); ?></div>
                          <div class="text-sm font-normal text-gray-500 tracking-wide"><?php echo e($us->type); ?></div>
                      </div>
                    </a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </div>
                  <div class="block bg-gray-200 text-sm text-right py-2 px-3 -mx-3 -mb-2 rounded-b-lg">
                   
                  </div>
              </div>
          </div>
      </div>
  </div>
  
  <script>
     function filterStudents() {
        var input, filter, ul, li, a, i, txtValue;
        input = document.getElementById('search');
        filter = input.value.toUpperCase();
        ul = document.getElementsByClassName("py-3")[0];
        li = ul.getElementsByTagName('a');
        for (i = 0; i < li.length; i++) {
            a = li[i].getElementsByTagName("div")[0];
            txtValue = a.textContent || a.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                li[i].style.display = "";
            } else {
                li[i].style.display = "none";
            }
        }
    }

    // Attacher un gestionnaire d'événements à l'événement input du champ de recherche
    document.getElementById('search').addEventListener('input', filterStudents);
  </script>
   
<?php $__env->stopSection(); ?>

   <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da)): ?>
<?php $component = $__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da; ?>
<?php unset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da); ?>
<?php endif; ?>
 <?php /**PATH C:\Users\pc\example-app\resources\views/User/index.blade.php ENDPATH**/ ?>