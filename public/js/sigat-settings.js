/**
 * SIGAT Settings — Shared Initialization Script
 * Dibaca dari localStorage dan diterapkan ke semua halaman saat load.
 * Tersedia global sebagai window.SIGAT
 */
(function () {
    'use strict';

    /* ── Palette warna aksen ── */
    const ACCENT_PALETTE = {
        '#3211d4': { name: 'Indigo', dark: '#280cb0', sidebar: '#3211d4', badge: '#4f46e5' },
        '#10b981': { name: 'Emerald', dark: '#059669', sidebar: '#10b981', badge: '#34d399' },
        '#f43f5e': { name: 'Rose', dark: '#e11d48', sidebar: '#f43f5e', badge: '#fb7185' },
        '#f59e0b': { name: 'Amber', dark: '#d97706', sidebar: '#f59e0b', badge: '#fbbf24' },
        '#6366f1': { name: 'Violet', dark: '#4f46e5', sidebar: '#6366f1', badge: '#818cf8' },
    };

    // Notifikasi dikelola oleh SIGAT_NOTIF (notif-panel.blade.php)

    /* ═══════════════════════════════════════════════
       TEMA
    ═══════════════════════════════════════════════ */
    function applyTheme(mode) {
        const html = document.documentElement;
        if (mode === 'dark') {
            html.classList.add('dark');
        } else {
            html.classList.remove('dark');
        }
        localStorage.setItem('sigat-theme', mode);
        _updateThemeButtons(mode);
    }

    function _updateThemeButtons(mode) {
        const btnLight = document.getElementById('btn-light');
        const btnDark = document.getElementById('btn-dark');
        if (!btnLight || !btnDark) return;

        btnLight.className = 'flex-1 flex items-center justify-center gap-2 rounded-lg text-sm font-bold transition-all';
        btnDark.className = 'flex-1 flex items-center justify-center gap-2 rounded-lg text-sm font-bold transition-all';

        if (mode === 'dark') {
            btnLight.classList.add('text-[#594c9a]');
            btnDark.classList.add('bg-primary', 'text-white', 'shadow');
        } else {
            btnLight.classList.add('bg-white', 'text-primary', 'shadow');
            btnDark.classList.add('text-[#594c9a]');
        }
    }

    /* ═══════════════════════════════════════════════
       WARNA AKSEN
    ═══════════════════════════════════════════════ */
    function applyAccent(color) {
        if (!color) return;
        const palette = ACCENT_PALETTE[color] || { dark: color, sidebar: color };

        /* Set CSS custom properties di :root */
        const root = document.documentElement;
        root.style.setProperty('--sigat-primary', color);
        root.style.setProperty('--sigat-primary-dark', palette.dark);

        /* Terapkan ke elemen active-nav (sidebar menu aktif) */
        document.querySelectorAll('.active-nav').forEach(el => {
            el.style.backgroundColor = color;
        });

        /* Terapkan ke elemen dengan class text-primary (Tailwind) */
        _injectAccentStyle(color, palette.dark);

        localStorage.setItem('sigat-accent', color);
        _updateAccentButtons(color);
    }

    /* Inject <style> tag dengan override warna primer */
    function _injectAccentStyle(color, darkColor) {
        let styleEl = document.getElementById('sigat-accent-style');
        if (!styleEl) {
            styleEl = document.createElement('style');
            styleEl.id = 'sigat-accent-style';
            document.head.appendChild(styleEl);
        }
        styleEl.textContent = `
            :root { --sigat-primary: ${color}; --sigat-primary-dark: ${darkColor}; }
            .active-nav { background-color: ${color} !important; }
            .text-primary { color: ${color} !important; }
            .bg-primary { background-color: ${color} !important; }
            .border-primary { border-color: ${color} !important; }
            .hover\\:bg-primary:hover { background-color: ${color} !important; }
            .hover\\:border-primary:hover { border-color: ${color} !important; }
            .shadow-primary\\/20 { box-shadow: 0 8px 16px -4px ${color}33 !important; }
            .peer-checked\\:bg-primary:checked ~ div { background-color: ${color} !important; }
            .peer:checked ~ .peer-checked\\:bg-primary { background-color: ${color} !important; }
            .focus\\:ring-primary:focus { --tw-ring-color: ${color}; }
            .fi-btn-color-primary { background-color: ${color} !important; }
        `;
    }

    function _updateAccentButtons(color) {
        document.querySelectorAll('.accent-btn').forEach(btn => {
            btn.classList.remove('active');
            const btnColor = btn.getAttribute('data-color') || btn.style.backgroundColor;
            // Normalisasi warna untuk pencocokan
            const tempEl = document.createElement('div');
            tempEl.style.backgroundColor = btnColor;
            document.body.appendChild(tempEl);
            const computed = getComputedStyle(tempEl).backgroundColor;
            document.body.removeChild(tempEl);

            const tempEl2 = document.createElement('div');
            tempEl2.style.backgroundColor = color;
            document.body.appendChild(tempEl2);
            const targetComputed = getComputedStyle(tempEl2).backgroundColor;
            document.body.removeChild(tempEl2);

            if (computed === targetComputed) {
                btn.classList.add('active');
            }
        });
    }

    /* ═══════════════════════════════════════════════
       NOTIFIKASI PANEL — Bridge ke sistem real
       Panel asli di-render oleh notif-panel.blade.php
       dan dikelola oleh window.SIGAT_NOTIF
    ═══════════════════════════════════════════════ */
    function toggleNotifPanel() {
        if (window.SIGAT_NOTIF) {
            window.SIGAT_NOTIF.toggle();
        }
    }

    function markAllRead() {
        if (window.SIGAT_NOTIF) {
            window.SIGAT_NOTIF.markAllRead();
        }
    }

    /* ═══════════════════════════════════════════════
       KONTROL TOGGLE NOTIFIKASI (settings page)
    ═══════════════════════════════════════════════ */
    function initNotifToggles() {
        const prefs = JSON.parse(localStorage.getItem('sigat-notif-prefs') || '{}');
        const toggleIds = ['notif-email', 'notif-system', 'notif-reminder'];
        toggleIds.forEach(id => {
            const el = document.getElementById(id);
            if (!el) return;
            /* Apply saved state jika ada */
            if (prefs[id] !== undefined) {
                el.checked = prefs[id];
            }
            /* Simpan saat berubah */
            el.addEventListener('change', function () {
                const current = JSON.parse(localStorage.getItem('sigat-notif-prefs') || '{}');
                current[id] = el.checked;
                localStorage.setItem('sigat-notif-prefs', JSON.stringify(current));
            });
        });
    }

    /* ═══════════════════════════════════════════════
       SAVE & RESET (settings page)
    ═══════════════════════════════════════════════ */
    function saveSettings() {
        /* Toast dipanggil dari settings page */
        if (typeof showToast === 'function') showToast('Pengaturan Berhasil Disimpan!');
    }

    function resetSettings() {
        applyTheme('light');
        applyAccent('#3211d4');
        localStorage.removeItem('sigat-notif-prefs');
        localStorage.removeItem('sigat-notif-read');
        initNotifToggles();
        /* Reset toggle UI ke default */
        const emailEl = document.getElementById('notif-email');
        const systemEl = document.getElementById('notif-system');
        const reminderEl = document.getElementById('notif-reminder');
        if (emailEl) emailEl.checked = true;
        if (systemEl) systemEl.checked = true;
        if (reminderEl) reminderEl.checked = false;
        if (typeof showToast === 'function') showToast('Pengaturan direset ke default.');
    }

    /* ═══════════════════════════════════════════════
       INIT — dipanggil saat DOMContentLoaded
    ═══════════════════════════════════════════════ */
    function init() {
        /* 1. Terapkan tema */
        const savedTheme = localStorage.getItem('sigat-theme') || 'light';
        applyTheme(savedTheme);

        /* 2. Terapkan warna aksen */
        const savedAccent = localStorage.getItem('sigat-accent');
        if (savedAccent) applyAccent(savedAccent);

        /* 3. Setup toggle notifikasi (hanya di settings page) */
        initNotifToggles();

        /* 4. Setup outside click handler untuk notif panel */
        _setupOutsideClick();

        /* 5. Rebuild notif panel jika sebelumnya sudah di-open */
        buildNotifPanel();
    }

    /* Expose ke window */
    window.SIGAT = {
        init,
        applyTheme,
        applyAccent,
        toggleNotifPanel,
        markAllRead,
        saveSettings,
        resetSettings,
    };

    /* Auto-init saat DOM siap */
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }

    /* Re-init saat navigasi Livewire (jika ada) */
    document.addEventListener('livewire:navigated', init);

})();
