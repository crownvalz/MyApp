<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Fonts and Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Bangers&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.5.1/css/all.min.css">
        <link href="https://fonts.googleapis.com/css2?family=Dancing+Script&display=swap" rel="stylesheet">
    <!-- download excel CDN -->
    
    
    
    <script src="https://cdn.jsdelivr.net/npm/xlsx@0.18.5/dist/xlsx.full.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Vite JS -->
</head>
<body class="bg-gray-50 flex">

    @include('layouts.sidebar')

    <main id="mainContent" class="ml-0 xl:ml-[17rem] flex-1 p-4 space-y-8 transition-all duration-300">
    <!-- Header Section -->
    @include('layouts.topnav')

    <!-- contents -->
    @yield('content')
    </main>

<!-- ///////////////////SORTED JS////////////////// -->
<script>
    fetch('/api/check-session') // create this endpoint
        .then(res => {
            if (res.status === 401) {
                window.location.href = '/login';
            }
        });
</script>
<script>
// Get references to important DOM elements
const sidebar = document.getElementById('sidebar');
const mainContent = document.getElementById('mainContent');
const toggleButton = document.getElementById('toggleSidebar');
const menuItems = document.querySelectorAll('.menu-item');
const menuTextElements = document.querySelectorAll('.sidebar-text');

// Apply sidebar collapsed or expanded state
function applySidebarState(collapsed) {
    sidebar.classList.toggle('w-20', collapsed);
    sidebar.classList.toggle('transition-all', true);
    menuTextElements.forEach(text => text.classList.toggle('hidden', collapsed));
    mainContent.classList.toggle('xl:ml-[6rem]', collapsed);
    mainContent.classList.toggle('xl:ml-[17rem]', !collapsed);
    mainContent.classList.toggle('transition-all', true);
}

// Set initial sidebar state on page load
const isCollapsed = localStorage.getItem('sidebarCollapsed') === 'true';
applySidebarState(isCollapsed);

// Toggle sidebar state when the button is clicked
toggleButton.addEventListener('click', () => {
    const collapsed = sidebar.classList.toggle('w-20');
    sidebar.classList.toggle('transition-all', true);
    menuTextElements.forEach(text => text.classList.toggle('hidden', collapsed));
    mainContent.classList.toggle('xl:ml-[6rem]', collapsed);
    mainContent.classList.toggle('xl:ml-[17rem]', !collapsed);
    mainContent.classList.toggle('transition-all', true);
    localStorage.setItem('sidebarCollapsed', collapsed);
});

// Highlight active menu item on click and save selection
menuItems.forEach(item => {
    item.addEventListener('click', () => {
        menuItems.forEach(i => i.classList.remove('bg-indigo-700'));
        item.classList.add('bg-indigo-700');
        localStorage.setItem('activeMenuItem', item.id);
    });
});

// Restore previously active menu item on page load
const activeMenuItem = localStorage.getItem('activeMenuItem');
if (activeMenuItem) {
    document.getElementById(activeMenuItem)?.classList.add('bg-indigo-700');
}
</script>

<!-- Check if there's an alert message -->
<script>
    window.addEventListener('DOMContentLoaded', (event) => {
        const alertMessage = document.getElementById('alertMessage');
        
        if (alertMessage) {
            // Set a timeout to fade out the alert message after 5 seconds
            setTimeout(() => {
                alertMessage.classList.add('opacity-0');
                alertMessage.style.transition = 'opacity 1s';
                
                // After the fade-out effect, completely hide the alert and remove it from the layout
                setTimeout(() => {
                    alertMessage.style.display = 'none';  // Hide the alert element entirely
                }, 1000);  // Match this timeout with the fade-out duration
            }, 5000);
        }
    });
</script>
  
<!-- Universal Modal JavaScript -->
  <script>
  // Open Modal
  document.querySelectorAll('.open-modal').forEach(btn => {
    btn.onclick = () => {
      const modalId = btn.getAttribute('data-modal-id');
      document.getElementById(modalId)?.classList.remove('hidden');
    };
  });

  // Close Modal (by X or Cancel)
  document.querySelectorAll('.modal').forEach(modal => {
    modal.onclick = e => {
      if (e.target.classList.contains('modal') || e.target.classList.contains('close-modal')) {
        modal.classList.add('hidden');
      }
    };
  });

  // Optional: Persist form values using localStorage
  const form = document.getElementById('productForm');
  const inputs = form.querySelectorAll('input, select');

  inputs.forEach(input => {
    const key = 'form_' + input.name;
    input.value = localStorage.getItem(key) || '';

    input.addEventListener('input', () => {
      localStorage.setItem(key, input.value);
    });
  });

  form.addEventListener('submit', () => {
    inputs.forEach(input => localStorage.removeItem('form_' + input.name));
  });
</script>

<!-- Universal Modal JavaScript -->
<script>
document.addEventListener('DOMContentLoaded', () => {
    const modal = document.getElementById('editModal');
    const cancelBtn = document.getElementById('cancelBtn');
    const dynamicFields = document.getElementById('dynamicFields');

    document.querySelectorAll('.open-edit-modal').forEach(button => {
        button.addEventListener('click', (e) => {
            const data = JSON.parse(button.dataset.report);
            dynamicFields.innerHTML = ''; // clear previous inputs

            // Always include hidden ID if it exists
            if ('id' in data) {
                dynamicFields.innerHTML += `<input type="hidden" name="id" value="${data.id}">`;
            }

            // Dynamically get table headers (field keys) for the row being clicked
            const currentRow = e.target.closest('tr');
            const tds = Array.from(currentRow.querySelectorAll('td'));
            const lastIndex = tds.length - 1; // Skip action column

            let keys = Object.keys(data).filter((key, index) => index <= lastIndex && key !== 'id');

            keys.forEach(key => {
                const value = data[key];
                const inputType = typeof value === 'number' ? 'number' : 'text';
                const label = key.replace(/_/g, ' ').replace(/\b\w/g, c => c.toUpperCase());

                dynamicFields.innerHTML += `
                    <div class="mt-4">
                        <label class="block text-sm text-gray-700">${label}</label>
                        <input type="${inputType}" name="${key}" value="${value}"
                            class="w-full p-3 mt-2 border border-gray-300 rounded-md shadow-sm
                            focus:outline-none focus:ring-2 focus:ring-indigo-600 focus:border-indigo-600 transition duration-200">
                    </div>
                `;
            });

            modal.classList.remove('hidden');
        });
    });

    cancelBtn.addEventListener('click', () => {
        modal.classList.add('hidden');
    });
});
</script>
<!-- Calculate Leave Days -->
<script>
    function calculateTotalDays() {
        const startDate = document.getElementById("start_date").value;
        const endDate = document.getElementById("end_date").value;
        const leaveDaysDisplay = document.getElementById("total-days");

        if (startDate && endDate) {
            const start = new Date(startDate);
            const end = new Date(endDate);
            const diffTime = end - start;
            const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24)) + 1; // Including the last day

            leaveDaysDisplay.textContent = diffDays > 0 ? diffDays : 0;
        } else {
            leaveDaysDisplay.textContent = 0;
        }
    }

    document.getElementById("start_date").addEventListener("change", calculateTotalDays);
    document.getElementById("end_date").addEventListener("change", calculateTotalDays);
</script>





<!-- Table Pagenation, search and Export table to Excel -->
<!-- JS -->
<script>
document.addEventListener("DOMContentLoaded", () => {
    const input = document.getElementById("searchInput"),
          table = document.getElementById("AiTable"),
          rows = Array.from(table.getElementsByTagName("tr")),
          rowsPerPage = 8;
    let currentPage = 1;
    let visibleRows = [];
    let allRows = rows.slice(1); // skip header
    let sortDirection = Array.from(table.querySelectorAll("thead th")).map(() => 'asc');

    const filterTable = () => {
        const filter = input.value.toLowerCase();
        visibleRows = allRows.filter(row =>
            Array.from(row.getElementsByTagName("td")).some(td =>
                td.textContent.toLowerCase().includes(filter)
            )
        );
        currentPage = 1;
        paginateRows();
    };

    const paginateRows = () => {
        const totalPages = Math.ceil(visibleRows.length / rowsPerPage);
        allRows.forEach(row => row.style.display = 'none');
        visibleRows.forEach((row, i) => {
            row.style.display = (i >= (currentPage - 1) * rowsPerPage && i < currentPage * rowsPerPage) ? "" : "none";
        });
        updatePagination(totalPages);
    };

    const updatePagination = (totalPages) => {
        document.getElementById("prevBtn").disabled = currentPage === 1;
        document.getElementById("nextBtn").disabled = currentPage === totalPages;
        document.getElementById("pageDisplay").textContent = `Page ${currentPage}`;
    };

    const showPage = (direction) => {
        const totalPages = Math.ceil(visibleRows.length / rowsPerPage);
        if (direction === 'next' && currentPage < totalPages) currentPage++;
        if (direction === 'prev' && currentPage > 1) currentPage--;
        paginateRows();
    };

    const sortTable = (columnIndex) => {
        const isAsc = sortDirection[columnIndex] === 'asc';
        visibleRows.sort((a, b) => {
            const aText = a.getElementsByTagName("td")[columnIndex].textContent.trim();
            const bText = b.getElementsByTagName("td")[columnIndex].textContent.trim();
            return isAsc ? aText.localeCompare(bText) : bText.localeCompare(aText);
        });
        sortDirection[columnIndex] = isAsc ? 'desc' : 'asc';
        visibleRows.forEach(row => table.tBodies[0].appendChild(row));
        paginateRows();
    };

    window.exportToExcel = () => {
        const headers = Array.from(table.querySelectorAll("thead th")).map(th => th.textContent.trim());
        const rowsData = visibleRows.map(row =>
            Array.from(row.querySelectorAll("td")).map(td => td.textContent.trim())
        );
        const tableData = [["Stock Report"], headers, ...rowsData];
        const worksheet = XLSX.utils.aoa_to_sheet(tableData);
        worksheet['!merges'] = [{ s: { r: 0, c: 0 }, e: { r: 0, c: headers.length - 1 } }];
        worksheet['!cols'] = headers.map(() => ({ wch: 20 }));
        const workbook = XLSX.utils.book_new();
        XLSX.utils.book_append_sheet(workbook, worksheet, "Stock Report");
        XLSX.writeFile(workbook, "Stock_Report.xlsx");
    };

    document.getElementById("prevBtn").addEventListener("click", () => showPage("prev"));
    document.getElementById("nextBtn").addEventListener("click", () => showPage("next"));
    table.querySelectorAll("thead th").forEach((th, i) => {
        th.addEventListener("click", () => sortTable(i));
    });

    input.addEventListener("input", filterTable);
    filterTable();
});
</script>






<!-- ///////////////////UNSORTED JS////////////////// -->
<script>
    // Function to open the modal and populate the form
    function openEditModal(id, leaveType, startDate, endDate, status) {
        // Populate modal fields with the selected row's data
        document.getElementById('leave_id').value = id;
        document.getElementById('leave_type').value = leaveType;
        document.getElementById('start_date').value = startDate;
        document.getElementById('end_date').value = endDate;
        document.getElementById('status').value = status;

        // Dynamically set the form action URL
        const formActionUrl = `/leave/${id}`;
        document.getElementById('editLeaveForm').action = formActionUrl;

        // Make the modal visible
        document.getElementById('editLeaveModal').classList.remove('hidden');
    }

    // Function to close the modal
    function closeEditModal() {
        document.getElementById('editLeaveModal').classList.add('hidden');
    }
</script>
</body>
</html>