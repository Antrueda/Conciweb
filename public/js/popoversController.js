const popoverTriggerList = document.querySelectorAll('[data-bs-toggle="popover"]')
const popoverList = [...popoverTriggerList].map(popoverTriggerEl => new bootstrap.Popover(popoverTriggerEl))

$(document).ready(function() {
    $('[data-bs-toggle="popover"]').popover();
    
    // Ensure Livewire updates re-instantiate popovers
    if (typeof window.Livewire !== 'undefined') {
      window.Livewire.hook('message.processed', (message, component) => {
          $('[data-bs-toggle="popover"]').popover('dispose').popover();
      });
    }
});