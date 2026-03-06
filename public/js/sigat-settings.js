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

    /* ── Notifications data (demo) ── */
    const DEFAULT_NOTIFS = [
        { id: 1, icon: 'assignment', color: 'text-amber-500', title: 'Laporan Baru Masuk', desc: 'Ada 3 kegiatan menunggu persetujuan.', time: 'Baru saja', unread: true },
        { id: 2, icon: 'check_circle', color: 'text-emerald-500', title: 'Laporan Disetujui', desc: 'Kegiatan "Pelatihan K3" telah disetujui.', time: '5 menit lalu', unread: true },
        { id: 3, icon: 'info', color: 'text-blue-500', title: 'Sistem Diperbarui', desc: 'SIGAT versi terbaru berhasil diinstal.', time: '1 jam lalu', unread: false },
    ];

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
       NOTIFIKASI PANEL
    ═══════════════════════════════════════════════ */
    function buildNotifPanel() {
        /* Hapus panel lama jika ada */
        const existing = document.getElementById('sigat-notif-panel');
        if (existing) existing.remove();

        const notifPrefs = JSON.parse(localStorage.getItem('sigat-notif-prefs') || '{}');
        const systemEnabled = notifPrefs['notif-system'] !== false;
        const notifs = systemEnabled ? DEFAULT_NOTIFS : DEFAULT_NOTIFS.filter(n => !n.unread);
        const unreadCount = notifs.filter(n => n.unread).length;

        /* Update badge */
        const badge = document.getElementById('notif-badge');
        if (badge) {
            badge.style.display = unreadCount > 0 ? 'block' : 'none';
        }

        const panel = document.createElement('div');
        panel.id = 'sigat-notif-panel';
        panel.setAttribute('role', 'dialog');
        panel.setAttribute('aria-label', 'Panel Notifikasi');
        panel.style.cssText = `
            display: none;
            position: fixed;
            top: 64px;
            right: 16px;
            width: 360px;
            max-height: 480px;
            background: white;
            border-radius: 16px;
            box-shadow: 0 20px 60px -10px rgba(0,0,0,0.18);
            border: 1px solid #e9e7f3;
            z-index: 99999;
            overflow: hidden;
            flex-direction: column;
        `;

        /* Panel header */
        const headerHtml = `
            <div style="padding: 16px 20px; border-bottom: 1px solid #e9e7f3; display: flex; align-items: center; justify-content: space-between; background: white;">
                <div style="display: flex; align-items: center; gap: 8px;">
                    <span class="material-symbols-outlined" style="font-size:20px; color: var(--sigat-primary, #3211d4);">notifications_active</span>
                    <span style="font-weight: 800; font-size: 13px; text-transform: uppercase; letter-spacing: 0.05em;">Notifikasi</span>
                    ${unreadCount > 0 ? `<span style="background: var(--sigat-primary, #3211d4); color: white; font-size: 10px; font-weight: 900; padding: 1px 7px; border-radius: 99px;">${unreadCount}</span>` : ''}
                </div>
                <button onclick="SIGAT.markAllRead()" style="font-size: 11px; font-weight: 700; color: var(--sigat-primary, #3211d4); background: none; border: none; cursor: pointer;">Tandai Semua Dibaca</button>
            </div>
        `;

        /* Notif items */
        const itemsHtml = notifs.map(n => `
            <div style="padding: 14px 20px; display: flex; align-items: flex-start; gap: 12px; border-bottom: 1px solid #f5f4fb; cursor: pointer; transition: background 0.15s; ${n.unread ? 'background: #f8f7ff;' : ''}"
                 onmouseover="this.style.background='#f0f0fa'" onmouseout="this.style.background='${n.unread ? '#f8f7ff' : 'white'}'">
                <span class="material-symbols-outlined ${n.color}" style="font-size: 22px; flex-shrink: 0; margin-top: 2px; font-variation-settings: 'FILL' 1;">${n.icon}</span>
                <div style="flex: 1; min-width: 0;">
                    <p style="font-weight: 700; font-size: 13px; margin: 0 0 2px;">${n.title}</p>
                    <p style="font-size: 12px; color: #594c9a; margin: 0 0 4px;">${n.desc}</p>
                    <p style="font-size: 10px; font-weight: 700; color: #9ca3af; text-transform: uppercase; letter-spacing: 0.05em; margin: 0;">${n.time}</p>
                </div>
                ${n.unread ? '<span style="width:8px; height:8px; background: var(--sigat-primary, #3211d4); border-radius: 99px; flex-shrink:0; margin-top: 6px;"></span>' : ''}
            </div>
        `).join('');

        /* Empty state */
        const emptyHtml = `
            <div style="padding: 40px 20px; text-align: center;">
                <span class="material-symbols-outlined" style="font-size: 40px; color: #e9e7f3;">notifications_off</span>
                <p style="font-size: 13px; color: #9ca3af; margin-top: 8px;">Tidak ada notifikasi.</p>
            </div>
        `;

        panel.innerHTML = `
            ${headerHtml}
            <div style="overflow-y: auto; max-height: 380px;">
                ${notifs.length ? itemsHtml : emptyHtml}
            </div>
            <div style="padding: 10px 20px; border-top: 1px solid #e9e7f3; background: white;">
                <a href="/dashboards/activity-logs" style="display: block; text-align: center; font-size: 12px; font-weight: 800; color: var(--sigat-primary, #3211d4); text-decoration: none; text-transform: uppercase; letter-spacing: 0.05em;">Lihat Log Aktivitas →</a>
            </div>
        `;

        /* Dark mode support */
        if (document.documentElement.classList.contains('dark')) {
            panel.style.background = '#1a1630';
            panel.style.borderColor = '#2d284d';
            panel.querySelector('[style*="border-bottom"]').style.background = '#1a1630';
        }

        document.body.appendChild(panel);
        return panel;
    }

    let notifPanelVisible = false;

    function toggleNotifPanel() {
        const panel = document.getElementById('sigat-notif-panel') || buildNotifPanel();
        notifPanelVisible = !notifPanelVisible;
        panel.style.display = notifPanelVisible ? 'flex' : 'none';
        if (notifPanelVisible) panel.style.flexDirection = 'column';
    }

    function markAllRead() {
        notifPanelVisible = false;
        /* Rebuild panel dengan semua notif sebagai "dibaca" */
        const existing = document.getElementById('sigat-notif-panel');
        if (existing) existing.remove();
        const badge = document.getElementById('notif-badge');
        if (badge) badge.style.display = 'none';
        /* Simpan status ke localStorage */
        localStorage.setItem('sigat-notif-read', Date.now().toString());
    }

    /* Tutup panel jika klik di luar */
    function _setupOutsideClick() {
        document.addEventListener('click', function (e) {
            const panel = document.getElementById('sigat-notif-panel');
            const btn = document.getElementById('notif-btn');
            if (panel && notifPanelVisible) {
                if (!panel.contains(e.target) && (!btn || !btn.contains(e.target))) {
                    notifPanelVisible = false;
                    panel.style.display = 'none';
                }
            }
        }, true);
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
