<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    @vite('resources/css/app.css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.css" rel="stylesheet" />
    <title>Document</title>
</head>

<body>
    @include('layouts.admin.navbar')
    @include('layouts.admin.sidebar')
    
    <div class="p-4 sm:ml-64 bg-gray-50 lg:ml-64 dark:bg-gray-900">
        <div class="">
            @yield('main')
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.js"></script>

    <script>
        const sidebar = document.getElementById('sidebar');

        if (sidebar) {
            const toggleSidebarMobile = (sidebar, sidebarBackdrop, toggleSidebarMobileHamburger, toggleSidebarMobileClose) => {
                sidebar.classList.toggle('hidden');
                sidebarBackdrop.classList.toggle('hidden');
                toggleSidebarMobileHamburger.classList.toggle('hidden');
                toggleSidebarMobileClose.classList.toggle('hidden');
            }
            
            const toggleSidebarMobileEl = document.getElementById('toggleSidebarMobile');
            const sidebarBackdrop = document.getElementById('sidebarBackdrop');
            const toggleSidebarMobileHamburger = document.getElementById('toggleSidebarMobileHamburger');
            const toggleSidebarMobileClose = document.getElementById('toggleSidebarMobileClose');
            const toggleSidebarMobileSearch = document.getElementById('toggleSidebarMobileSearch');
            
            toggleSidebarMobileSearch.addEventListener('click', () => {
                toggleSidebarMobile(sidebar, sidebarBackdrop, toggleSidebarMobileHamburger, toggleSidebarMobileClose);
            });
            
            toggleSidebarMobileEl.addEventListener('click', () => {
                toggleSidebarMobile(sidebar, sidebarBackdrop, toggleSidebarMobileHamburger, toggleSidebarMobileClose);
            });
            
            sidebarBackdrop.addEventListener('click', () => {
                toggleSidebarMobile(sidebar, sidebarBackdrop, toggleSidebarMobileHamburger, toggleSidebarMobileClose);
            });
        }
    </script>
</body>

</html>
