@extends('layouts.app')
@section('content')
    <!-- Product Image Section -->
    <section>
      <!-- Search & Toggle -->
      <div class="flex flex-col md:flex-row justify-between items-center gap-4 mb-8">
        <input id="searchInput" type="text" placeholder="Search images..." class="w-full md:w-1/3 px-4 py-3 rounded-lg border border-gray-300 shadow-sm focus:ring-2 focus:ring-indigo-500 text-lg" />
        <button id="toggleBtn" class="flex items-center gap-2 px-5 py-3 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">
          See More <span id="toggleIcon">⬇️</span>
        </button>
      </div>

      <!-- Image Grid -->
      <div id="productGallery" class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-5 lg:grid-cols-8 gap-6"></div>
    </section>

    <!-- Divider -->
    <hr class="border-gray-300"/>

    <!-- Form Document Section -->
    <section>
      <!-- Search & Toggle -->
      <div class="flex flex-col md:flex-row justify-between items-center gap-4 mb-8">
        <input id="formSearchInput" type="text" placeholder="Search form documents..." class="w-full md:w-1/3 px-4 py-3 rounded-lg border border-gray-300 shadow-sm focus:ring-2 focus:ring-indigo-500 text-lg" />
        <button id="formToggleBtn" class="flex items-center gap-2 px-5 py-3 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">
          See More <span id="formToggleIcon">⬇️</span>
        </button>
      </div>

      <!-- Form Docs Grid -->
      <div id="formDocs" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6"></div>
    </section>

  <!-- Footer -->
  <footer class="text-center text-gray-500 text-sm py-6 border-t border-gray-200">
    &copy; 2025 Product Gallery by MogTech Co Ltd. All rights reserved.
  </footer>

  <!-- Script -->
  <script>
    let allImages = [], allForms = [];
    let isImageExpanded = false, isFormExpanded = false;

    const renderImages = (limit) => {
      const container = document.getElementById('productGallery');
      const images = allImages.slice(0, limit);
      container.innerHTML = images.map(src => {
        const name = src.split('/').pop().replace(/\.[^/.]+$/, '');
        return `
          <div class="bg-white rounded-xl overflow-hidden shadow hover:shadow-lg transform transition hover:scale-105">
            <img src="${src}" alt="${name}" class="w-full h-40 object-cover"/>
            <div class="p-3 text-center">
              <p class="text-sm font-medium truncate hover:text-indigo-600 transition">${name}</p>
            </div>
          </div>
        `;
      }).join('');

      const btn = document.getElementById('toggleBtn');
      btn.classList.toggle('hidden', allImages.length <= 8);
      btn.querySelector('span').textContent = isImageExpanded ? '⬆️' : '⬇️';
      btn.childNodes[0].textContent = isImageExpanded ? 'See Less ' : 'See More ';
    };

    const renderForms = (limit) => {
      const container = document.getElementById('formDocs');
      const forms = allForms.slice(0, limit);
      container.innerHTML = forms.map(doc => {
        const name = doc.split('/').pop();
        const ext = name.split('.').pop();
        const base = name.replace(/\.[^/.]+$/, '');
        let icon = '📄';
        if (ext === 'pdf') icon = '🧾';
        else if (['xls', 'xlsx'].includes(ext)) icon = '📊';
        else if (['doc', 'docx'].includes(ext)) icon = '📃';

        return `
          <div class="bg-white p-4 rounded-lg shadow hover:shadow-lg transition transform hover:scale-105 flex items-center gap-4">
            <div class="text-2xl">${icon}</div>
            <a href="${doc}" target="_blank" class="text-gray-800 font-medium truncate hover:text-indigo-600">${base}</a>
          </div>
        `;
      }).join('');

      const btn = document.getElementById('formToggleBtn');
      btn.classList.toggle('hidden', allForms.length <= 4);
      btn.querySelector('span').textContent = isFormExpanded ? '⬆️' : '⬇️';
      btn.childNodes[0].textContent = isFormExpanded ? 'See Less ' : 'See More ';
    };

    fetch('/api/products')
      .then(res => res.json())
      .then(data => {
        allImages = data;
        renderImages(8);
      });

    fetch('/api/forms')
      .then(res => res.json())
      .then(data => {
        allForms = data;
        renderForms(4);
      });

    document.getElementById('toggleBtn').addEventListener('click', () => {
      isImageExpanded = !isImageExpanded;
      renderImages(isImageExpanded ? allImages.length : 8);
    });

    document.getElementById('formToggleBtn').addEventListener('click', () => {
      isFormExpanded = !isFormExpanded;
      renderForms(isFormExpanded ? allForms.length : 4);
    });

    document.getElementById('searchInput').addEventListener('input', (e) => {
      const q = e.target.value.toLowerCase();
      const filtered = allImages.filter(src => src.toLowerCase().includes(q));
      renderImages(isImageExpanded ? filtered.length : 8);
    });

    document.getElementById('formSearchInput').addEventListener('input', (e) => {
      const q = e.target.value.toLowerCase();
      const filtered = allForms.filter(doc => doc.toLowerCase().includes(q));
      renderForms(isFormExpanded ? filtered.length : 4);
    });
  </script>
@include('layouts.modals')
@endsection
