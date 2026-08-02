/**
 * FT UNSUR — Admin Panel JavaScript
 *
 * Bootstrap 5, SweetAlert2
 */

import './bootstrap';

// Bootstrap JS
import * as bootstrap from 'bootstrap';

// SweetAlert2
import Swal from 'sweetalert2';

// Make libraries available globally
window.bootstrap = bootstrap;
window.Swal = Swal;

// =========================================================================
// DOM Ready
// =========================================================================
document.addEventListener('DOMContentLoaded', () => {
    initSidebarToggle();
    initSidebarMobile();
    initDeleteConfirmation();
    initTooltips();
});

// =========================================================================
// Sidebar Toggle (Desktop)
// =========================================================================
function initSidebarToggle() {
    const toggleBtn = document.querySelector('.sidebar-toggle');
    const sidebar = document.querySelector('.admin-sidebar');
    const content = document.querySelector('.admin-content');

    if (!toggleBtn || !sidebar || !content) return;

    toggleBtn.addEventListener('click', () => {
        sidebar.classList.toggle('collapsed');
        content.classList.toggle('sidebar-collapsed');

        // Save state to localStorage
        const isCollapsed = sidebar.classList.contains('collapsed');
        localStorage.setItem('sidebar-collapsed', isCollapsed);
    });

    // Restore state from localStorage
    if (localStorage.getItem('sidebar-collapsed') === 'true') {
        sidebar.classList.add('collapsed');
        content.classList.add('sidebar-collapsed');
    }
}

// =========================================================================
// Sidebar Mobile
// =========================================================================
function initSidebarMobile() {
    const sidebar = document.querySelector('.admin-sidebar');
    const overlay = document.querySelector('.sidebar-overlay');
    const toggleBtn = document.querySelector('.sidebar-toggle');

    if (!sidebar || !overlay || !toggleBtn) return;

    // Only for mobile
    const isMobile = () => window.innerWidth < 992;

    toggleBtn.addEventListener('click', () => {
        if (isMobile()) {
            sidebar.classList.toggle('show');
            overlay.classList.toggle('show');
            document.body.style.overflow = sidebar.classList.contains('show') ? 'hidden' : '';
        }
    });

    overlay.addEventListener('click', () => {
        sidebar.classList.remove('show');
        overlay.classList.remove('show');
        document.body.style.overflow = '';
    });

    // Close sidebar on window resize to desktop
    window.addEventListener('resize', () => {
        if (!isMobile()) {
            sidebar.classList.remove('show');
            overlay.classList.remove('show');
            document.body.style.overflow = '';
        }
    });
}

// =========================================================================
// Delete Confirmation (SweetAlert2)
// =========================================================================
function initDeleteConfirmation() {
    document.addEventListener('click', (e) => {
        const deleteBtn = e.target.closest('.btn-delete');
        if (!deleteBtn) return;

        e.preventDefault();
        const form = deleteBtn.closest('form') || document.querySelector(deleteBtn.dataset.formTarget);

        Swal.fire({
            title: 'Yakin ingin menghapus?',
            text: 'Data yang sudah dihapus tidak dapat dikembalikan!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#EF4444',
            cancelButtonColor: '#6B7280',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal',
            customClass: {
                popup: 'swal-popup-custom',
            },
        }).then((result) => {
            if (result.isConfirmed && form) {
                form.submit();
            }
        });
    });
}

// =========================================================================
// Bootstrap Tooltips
// =========================================================================
function initTooltips() {
    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
    tooltipTriggerList.forEach((el) => {
        new bootstrap.Tooltip(el);
    });
}
