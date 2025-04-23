@extends('layouts.app')
@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.5.1/css/all.min.css">
<div class="max-w-full mx-auto bg-white p-4 rounded-lg shadow-lg overflow-x-auto font-3 text-[17px]">
    <!-- Header Section -->
    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4 mb-4">
        <h2 class="text-xl font-bold text-gray-800">Excell Filter tool</h2>

        <!-- Responsive container for filter and buttons -->
        <div class="flex flex-col sm:flex-row w-full sm:w-auto sm:items-center gap-2">
            <!-- Flex wrapper: left filter, right buttons on small screens -->
            <div class="flex w-full justify-between sm:justify-start sm:gap-2 items-center flex-wrap">
                <!-- Button group aligned right on small screens -->
                <div class="flex gap-2 sm:ml-2">
                    <!-- Export to Excel -->
                    <button  id="exportExcelButton" 
                        class="bg-red-600 hover:bg-gray-800 text-white px-4 py-2 rounded-md text-sm font-medium flex items-center justify-center gap-2 whitespace-nowrap">
                        <i class="fa fa-file-excel bg-green-800"></i>
                        <span class="hidden sm:inline">Export to Excel</span>
                    </button>
                    <div class="flex items-center gap-2">
                    <!-- Styled Upload Button -->
                    <label for="excelFileInput" 
                        class="inline-flex items-center gap-2 bg-gray-600 hover:bg-gray-800 text-white px-4 py-2 rounded-md text-sm font-medium cursor-pointer">
                        <i class="fa fa-upload"></i>
                        <span>Upload Excel</span>
                    </label>

                    <!-- Hidden File Input -->
                    <input type="file" id="excelFileInput" accept=".xlsx, .xls" class="hidden">
                </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Alert Message -->
<!-- Alert Message -->
@if (session('success') || session('error'))
    <div 
        id="alertMessage"
        class="mt-4 mb-4 p-3 rounded 
               {{ session('success') ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}"
    >
        {{ session('success') ?? session('error') }}
    </div>
@endif

<!-- Column Selector Header -->
<div class="flex items-center justify-between mb-4">
    <h2 class="text-lg font-semibold text-gray-800">Select Columns</h2>
    <button 
        id="toggleSelector" 
        class="text-gray-600 hover:text-blue-500 transition"
        aria-label="Toggle Column Selector"
    >
        <i id="toggleIcon" class="fas fa-chevron-down"></i>
    </button>
</div>

<!-- Column Selector Container -->
<div id="columnSelectorContainer" class="hidden space-y-4 mb-6">
    <div id="checkboxColumnList" class="grid grid-cols-2 sm:grid-cols-3 gap-3"></div>
    <!-- Flex container for buttons -->
    <div class="flex space-x-4">
        <button 
            id="populateButton" 
            class="bg-gray-600 hover:bg-gray-800 text-white px-4 py-2 rounded-md text-sm font-medium flex items-center justify-center gap-2 whitespace-nowrap"
        >
            <i class="fa fa-check"></i> Populate
        </button>
        <button 
            id="resetButton" 
            class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600"
        >
            Reset
        </button>
    </div>
</div>

<div class="overflow-x-auto bg-white rounded-lg shadow-sm border border-gray-200 max-h-[400px] sm:max-h-[500px] md:max-h-[600px] lg:max-h-[700px] xl:max-h-[800px] 2xl:max-h-[700px] 3xl:max-h-[1000px]">    <!-- Table -->
    <table id="AiTable" class="min-w-full border border-gray-200 divide-y divide-gray-100 rounded-lg overflow-hidden shadow-sm">
        <thead class="bg-blue-200 text-gray-800 text-sm uppercase tracking-wide">
            <tr>
                <!-- Dynamic Filter Headers -->
                <th class="p-3 text-left sticky top-0 bg-blue-200">  
                    <select class="filter-select w-full p-3 rounded-lg border focus:ring-2 focus:ring-blue-400">
                        <option value="">All</option>
                    </select>
                </th>
                <th class="p-3 text-left sticky top-0 bg-blue-200">  
                    <select class="filter-select w-full p-3 rounded-lg border focus:ring-2 focus:ring-blue-400">
                        <option value="">All</option>
                    </select>
                </th>
                <th class="p-3 text-left sticky top-0 bg-blue-200">  
                    <select class="filter-select w-full p-3 rounded-lg border focus:ring-2 focus:ring-blue-400">
                        <option value="">All</option>
                    </select>
                </th>
                <th class="p-3 text-left sticky top-0 bg-blue-200">  
                    <select class="filter-select w-full p-3 rounded-lg border focus:ring-2 focus:ring-blue-400">
                        <option value="">All</option>
                    </select>
                </th>
                <th class="p-3 text-left sticky top-0 bg-blue-200">  
                    <select class="filter-select w-full p-3 rounded-lg border focus:ring-2 focus:ring-blue-400">
                        <option value="">All</option>
                    </select>
                </th>
                <th class="p-3 text-left sticky top-0 bg-blue-200">  
                    <select class="filter-select w-full p-3 rounded-lg border focus:ring-2 focus:ring-blue-400">
                        <option value="">All</option>
                    </select>
                </th>
            </tr>
        </thead>
        <tbody class="text-sm text-gray-700 divide-y divide-gray-100">
            <!-- Table is initially empty. Content will be populated after data is loaded -->
        </tbody>
    </table>
</div>
</div>

<script>
let excelData = []; // Store uploaded Excel data
let filteredData = []; // Store filtered data based on user selection
let selectedFilters = {}; // Store selected filters for each column

document.getElementById('excelFileInput').addEventListener('change', handleFile, false);

function handleFile(event) {
    const file = event.target.files[0];
    const reader = new FileReader();

    reader.onload = function(e) {
        const data = new Uint8Array(e.target.result);
        const workbook = XLSX.read(data, { type: 'array' });
        const firstSheet = workbook.Sheets[workbook.SheetNames[0]];
        const rows = XLSX.utils.sheet_to_json(firstSheet, { header: 1 });

        if (rows.length > 0) {
            excelData = rows;
            filteredData = rows.slice(1); // All data excluding the header
            setupColumnSelector(rows);
        }
    };

    reader.readAsArrayBuffer(file);
}

// Set up checkbox column selector (always visible now)
function setupColumnSelector(data) {
    const columnListContainer = document.getElementById('checkboxColumnList');
    const selectorContainer = document.getElementById('columnSelectorContainer');

    columnListContainer.innerHTML = ''; // Clear old checkboxes

    selectorContainer.classList.remove('hidden'); // Always show

    data[0].forEach((col, index) => {
        const checkboxWrapper = document.createElement('label');
        checkboxWrapper.className = 'flex items-center gap-2 text-sm text-gray-700';

        const checkbox = document.createElement('input');
        checkbox.type = 'checkbox';
        checkbox.value = index;
        checkbox.checked = index < 8; // Default checked first 8
        checkbox.className = 'form-checkbox rounded text-blue-500 focus:ring-blue-300';

        checkboxWrapper.appendChild(checkbox);
        checkboxWrapper.appendChild(document.createTextNode(col));
        columnListContainer.appendChild(checkboxWrapper);
    });
}

// When Populate button is clicked
document.getElementById('populateButton').addEventListener('click', () => {
    const selectedIndexes = Array.from(document.querySelectorAll('#checkboxColumnList input:checked'))
        .map(cb => parseInt(cb.value));
    renderSelectedColumns(selectedIndexes);

    // Optionally collapse column selector after populating
    const container = document.getElementById('columnSelectorContainer');
    const icon = document.getElementById('toggleIcon');

    if (!container.classList.contains('hidden')) {
        container.classList.add('hidden');
        icon.classList.remove('fa-chevron-up');
        icon.classList.add('fa-chevron-down');
    }
});

// Renders table using only selected columns
function renderSelectedColumns(indexes) {
    const table = document.getElementById('AiTable');
    const thead = table.querySelector('thead');
    const tbody = table.querySelector('tbody');

    thead.innerHTML = '';
    tbody.innerHTML = '';

    const headerRow = document.createElement('tr');
    const filterRow = document.createElement('tr');

    indexes.forEach(index => {
        const col = excelData[0][index] ?? `Column ${index + 1}`;

        const thHeader = document.createElement('th');
        thHeader.className = 'p-3 text-left bg-gray-100 font-bold';
        thHeader.textContent = col;
        headerRow.appendChild(thHeader);

        const thFilter = document.createElement('th');
        thFilter.className = 'p-3 text-left';
        const select = document.createElement('select');
        select.className = 'filter-select w-full p-2 rounded border focus:ring-2 focus:ring-blue-400';
        select.innerHTML = `<option value="">All</option>`;
        thFilter.appendChild(select);
        filterRow.appendChild(thFilter);
    });

    thead.appendChild(headerRow);
    thead.appendChild(filterRow);

    // Body
    filteredData.forEach(rowData => {
        const row = document.createElement('tr');
        row.className = 'hover:bg-blue-50 hover:shadow transition-all duration-200 ease-in-out';
        indexes.forEach(index => {
            const td = document.createElement('td');
            td.className = 'p-3';
            td.textContent = rowData[index] ?? '';
            row.appendChild(td);
        });
        tbody.appendChild(row);
    });

    regenerateFilters();
}

// Dynamic filter logic
function regenerateFilters() {
    const table = document.getElementById("AiTable");
    const rows = table.querySelectorAll("tbody tr");
    const headers = table.querySelectorAll("thead tr:nth-child(2) .filter-select");

    headers.forEach((select, columnIndex) => {
        select.innerHTML = '<option value="">All</option>';
        let uniqueValues = new Set();
        rows.forEach(row => {
            const cell = row.cells[columnIndex];
            if (cell) {
                const cellValue = cell.textContent.trim();
                if (cellValue) uniqueValues.add(cellValue);
            }
        });

        uniqueValues.forEach(value => {
            const option = document.createElement("option");
            option.value = value;
            option.textContent = value;
            select.appendChild(option);
        });

        select.addEventListener("change", (e) => {
            selectedFilters[columnIndex] = e.target.value;
            filterData();
        });
    });
}

// Filter data based on selected filters
function filterData() {
    filteredData = excelData.slice(1).filter(row => {
        return Object.keys(selectedFilters).every((colIndex) => {
            const selectedValue = selectedFilters[colIndex];
            if (selectedValue) {
                const cellValue = row[colIndex];

                if (!isNaN(cellValue)) {
                    const numericValue = parseFloat(cellValue);
                    if (selectedValue != numericValue) {
                        return false;
                    }
                } else {
                    if (cellValue !== selectedValue) {
                        return false;
                    }
                }
            }
            return true;
        });
    });

    const selectedIndexes = Array.from(document.querySelectorAll('#checkboxColumnList input:checked'))
        .map(cb => parseInt(cb.value));
    renderSelectedColumns(selectedIndexes);
}
</script>



<script>
    // Reset functionality
document.getElementById('resetButton').addEventListener('click', () => {
    // Refresh the page
    location.reload();
});

// Toggle the visibility of the column selector container when the button is clicked
document.getElementById('toggleSelector').addEventListener('click', () => {
    const columnSelectorContainer = document.getElementById('columnSelectorContainer');
    const toggleIcon = document.getElementById('toggleIcon');
    
    // Toggle the "hidden" class to show/hide the container
    columnSelectorContainer.classList.toggle('hidden');
    
    // Toggle the icon to indicate the open/close state
    if (columnSelectorContainer.classList.contains('hidden')) {
        toggleIcon.classList.remove('fa-chevron-up');
        toggleIcon.classList.add('fa-chevron-down');
    } else {
        toggleIcon.classList.remove('fa-chevron-down');
        toggleIcon.classList.add('fa-chevron-up');
    }
});

// Populate button - When clicked, hide the column selector container and change the icon
document.getElementById('populateButton').addEventListener('click', () => {
    const columnSelectorContainer = document.getElementById('columnSelectorContainer');
    const toggleIcon = document.getElementById('toggleIcon');
    
    // Hide the column selector container
    columnSelectorContainer.classList.add('hidden');
    
    // Change the icon to indicate the collapsed state
    toggleIcon.classList.remove('fa-chevron-up');
    toggleIcon.classList.add('fa-chevron-down');
});


    // Export to Excel functionality
    document.getElementById('exportExcelButton').addEventListener('click', () => {
        const table = document.getElementById('AiTable');
        
        // Generate the workbook from the table
        const wb = XLSX.utils.table_to_book(table, { sheet: "Sheet1" });

        // Export the generated Excel file
        XLSX.writeFile(wb, 'table-data.xlsx');
    });
</script>

<script>
document.getElementById('saveToDatabaseButton').addEventListener('click', () => {
    const table = document.getElementById('AiTable');
    const headers = Array.from(table.querySelectorAll('thead tr:first-child th')).map(th => th.textContent.trim());
    const rows = Array.from(table.querySelectorAll('tbody tr')).map(tr => {
        return Array.from(tr.children).map(td => td.textContent.trim());
    });

    fetch('/save-excel-table', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({
            headers: headers,
            rows: rows
        })
    })
    .then(response => response.json())
    .then(data => {
        alert(data.message || "Data saved to database!");
    })
    .catch(error => {
        console.error("Error:", error);
        alert("Something went wrong while saving.");
    });
});
</script>
@endsection