<nav class="flex items-center gap-x-1 bg-white shadow-md py-1 sticky top-0 left-0 z-10 lg:static lg:h-[60px] px-5">
    <button class="cursor-pointer w-12 h-12 flex items-center justify-center lg:hidden" id="toggle-sidebar-button" onclick="toggleSidebar()">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="text-slate-800 w-5">
            >
            <path d="M3 4H21V6H3V4ZM3 11H21V13H3V11ZM3 18H21V20H3V18Z"></path>
        </svg>
    </button>

    <h1 class="text-xl font-medium">
        {{ trim($__env->yieldContent('title')) ? $__env->yieldContent('title') . '' : '' }}
    </h1>
</nav>

@once
<script>
    /**
     * Show/hide sidebar
     */
    const toggleSidebar = () => {
        const sidebar = document.getElementById('sidebar');
        sidebar.classList.toggle('-left-[100%]');
    }

    /**
     * Close sidebar when clicking outside of it,
     * but keep it open when clicking inside the sidebar or on the toggle button
     */
    document.addEventListener('click', (e) => {
        const sidebar = document.getElementById('sidebar');
        const toggleBtn = document.getElementById('toggle-sidebar-button');

        if (sidebar && !sidebar.contains(e.target) && !toggleBtn.contains(e.target)) {
            sidebar.classList.add('-left-[100%]');
        }
    });
</script>
@endonce