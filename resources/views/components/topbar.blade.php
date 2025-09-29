<nav class="flex items-center gap-x-3 bg-white shadow-md py-2 md:py-1 top-0 left-0 z-10 sticky lg:h-[60px] px-5 md:px-5">
    <button class="cursor-pointer w-4 h-4 flex items-center justify-center lg:hidden" id="toggle-sidebar-button" onclick="toggleSidebar()">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="text-slate-800 w-5">
            >
            <path d="M3 4H21V6H3V4ZM3 11H21V13H3V11ZM3 18H21V20H3V18Z"></path>
        </svg>
    </button>

    <div class="flex justify-between items-center w-full">
        <h1 class="text-sm md:text-base font-medium">
            {{ trim($__env->yieldContent('title')) ? $__env->yieldContent('title') . '' : '' }}
        </h1>

        <div class="relative" id="user-menu">
            <!-- Trigger Button -->
            <button type="button"
                onclick="toggleDropdown()"
                class="flex items-center gap-x-2 cursor-pointer">
                <div class="flex flex-col items-start">
                    <span class="text-[10px] md:text-sm text-slate-800 font-medium">{{ auth()->user()->name }}</span>
                    <span class="text-[8px] md:text-[10px] text-blue-500">{{ auth()->user()->role }}</span>
                </div>
                
                <div class="bg-blue-100 w-8 h-8 md:w-10 md:h-10 rounded-full flex items-center justify-center">
                    <svg class="w-4 h-4 md:w-5 md:h-5 text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd" d="M12 4a4 4 0 1 0 0 8 4 4 0 0 0 0-8Zm-2 9a4 4 0 0 0-4 4v1a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2v-1a4 4 0 0 0-4-4h-4Z" clip-rule="evenodd" />
                    </svg>
                </div>
            </button>

            <!-- Dropdown -->
            <div id="user-menu-dropdown"
                class="hidden absolute right-0 mt-2 w-40 bg-white rounded shadow-md z-50">
                <form method="POST" action="{{ route('logout') }}" onsubmit="return confirmLogout()">
                    @csrf
                    <button type="submit"
                        class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50">
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </div>
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

    function toggleDropdown() {
        const dropdown = document.getElementById("user-menu-dropdown");
        dropdown.classList.toggle("hidden");
    }

    // Tutup dropdown kalau klik di luar
    document.addEventListener("click", function(e) {
        const menu = document.getElementById("user-menu");
        const dropdown = document.getElementById("user-menu-dropdown");

        if (!menu.contains(e.target)) {
            dropdown.classList.add("hidden");
        }
    });

    function confirmLogout() {
        return confirm("Apakah Anda yakin ingin logout?");
    }
</script>
@endonce