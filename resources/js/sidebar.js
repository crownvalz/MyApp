
const sidebar = document.getElementById('sidebar');
const mainContent = document.getElementById('mainContent');
const toggleButton = document.getElementById('toggleSidebar');
const menuItems = document.querySelectorAll('.menu-item');
const menuTextElements = document.querySelectorAll('.sidebar-text');

function applySidebarState(collapsed) {
    sidebar.classList.toggle('w-20', collapsed);
    sidebar.classList.toggle('transition-all', true);
    menuTextElements.forEach(text => text.classList.toggle('hidden', collapsed));
    mainContent.classList.toggle('xl:ml-[6rem]', collapsed);
    mainContent.classList.toggle('xl:ml-[17rem]', !collapsed);
    mainContent.classList.toggle('transition-all', true);
}

const isCollapsed = localStorage.getItem('sidebarCollapsed') === 'true';
applySidebarState(isCollapsed);

toggleButton.addEventListener('click', () => {
    const collapsed = sidebar.classList.toggle('w-20');
    sidebar.classList.toggle('transition-all', true);
    menuTextElements.forEach(text => text.classList.toggle('hidden', collapsed));
    mainContent.classList.toggle('xl:ml-[6rem]', collapsed);
    mainContent.classList.toggle('xl:ml-[17rem]', !collapsed);
    mainContent.classList.toggle('transition-all', true);
    localStorage.setItem('sidebarCollapsed', collapsed);
});

menuItems.forEach(item => {
    item.addEventListener('click', () => {
        menuItems.forEach(i => i.classList.remove('bg-blue-600'));
        item.classList.add('bg-blue-600');
        localStorage.setItem('activeMenuItem', item.id);
    });
});

const activeMenuItem = localStorage.getItem('activeMenuItem');
if (activeMenuItem) {
    document.getElementById(activeMenuItem)?.classList.add('bg-blue-600');
}