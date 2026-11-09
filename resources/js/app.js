import './bootstrap';
import { createIcons, icons } from 'lucide';

// Render every <i data-lucide="..."> icon (also after Livewire updates the page)
const renderIcons = () => createIcons({ icons });
document.addEventListener('DOMContentLoaded', renderIcons);
document.addEventListener('livewire:navigated', renderIcons);
document.addEventListener('livewire:init', () => {
    window.Livewire.hook('morph.updated', () => renderIcons());
});
window.renderIcons = renderIcons;

// Auto-hide flash messages after 6 seconds
document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('[data-flash]').forEach((el) => {
        setTimeout(() => el.remove(), 6000);
    });
});
