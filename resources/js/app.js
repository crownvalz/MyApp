// resources/js/app.js

import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();


// Import sidebar.js (this is your custom script)
import 'sidebar.js';  // 👈 This line includes your sidebar logic