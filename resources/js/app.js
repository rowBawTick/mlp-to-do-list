// Import any JS dependencies
import './bootstrap';

// Import Tall Toasts component
import ToastComponent from '../../vendor/usernotnull/tall-toasts/resources/js/tall-toasts';

// Wait for Alpine to be available from Livewire's scripts
document.addEventListener('alpine:init', () => {
    // Register the Tall Toasts plugin with Alpine
    window.Alpine.plugin(ToastComponent);
});
