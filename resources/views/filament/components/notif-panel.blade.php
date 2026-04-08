{{-- 
    Bell Notification Panel Partial
    Include di halaman yang punya ikon lonceng.
    Penggunaan: @include('filament.components.notif-panel')
--}}

<!-- Panel Notifikasi Lonceng -->
<div id="notif-panel"
     class="absolute right-0 top-full mt-2 z-[99998] w-80 bg-white dark:bg-[#1a1630] rounded-2xl shadow-2xl border border-[#e9e7f3] dark:border-white/10 overflow-hidden"
     style="display:none;">
    <!-- Header -->
    <div class="flex items-center justify-between px-5 py-4 border-b border-[#f0eff8] dark:border-white/10">
        <div class="flex items-center gap-2">
            <span class="material-symbols-outlined text-[18px] text-[#594c9a] dark:text-[#a397e0]">notifications</span>
            <span class="text-sm font-bold text-[#100d1b] dark:text-white">Notifikasi</span>
            <span id="notif-panel-count" class="hidden items-center justify-center min-w-[20px] h-5 px-1.5 bg-red-500 text-white text-[10px] font-bold rounded-full"></span>
        </div>
        <button id="notif-mark-all"
                class="text-xs font-bold text-primary hover:underline"
                onclick="SIGAT_NOTIF.markAllRead()">
            Tandai Semua Dibaca
        </button>
    </div>

    <!-- List Notifikasi -->
    <ul id="notif-list" class="max-h-80 overflow-y-auto divide-y divide-[#f0eff8] dark:divide-white/5">
        <li id="notif-empty" class="flex flex-col items-center py-10 text-center text-slate-400 dark:text-slate-500">
            <span class="material-symbols-outlined text-4xl mb-2">notifications_off</span>
            <span class="text-sm font-medium">Tidak ada notifikasi</span>
        </li>
    </ul>

    <!-- Footer -->
    <div class="px-5 py-3 border-t border-[#f0eff8] dark:border-white/5 text-center">
        <span class="text-[10px] text-[#594c9a] dark:text-[#a397e0] font-medium uppercase tracking-wider">SIGAT Notification Center</span>
    </div>
</div>

<style>
    #notif-panel .notif-item {
        display: flex;
        align-items: flex-start;
        gap: 12px;
        padding: 14px 20px;
        cursor: pointer;
        transition: background 0.15s;
    }
    #notif-panel .notif-item:hover { background: #f6f5fc; }
    .dark #notif-panel .notif-item:hover { background: rgba(255,255,255,0.04); }
    #notif-panel .notif-item.unread { background: rgba(50,17,212,0.04); }
    .dark #notif-panel .notif-item.unread { background: rgba(124,58,237,0.08); }
    #notif-panel .notif-icon-wrap {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    #notif-panel .notif-icon-wrap.success  { background: #dcfce7; color: #16a34a; }
    #notif-panel .notif-icon-wrap.warning  { background: #fef9c3; color: #ca8a04; }
    #notif-panel .notif-icon-wrap.danger   { background: #fee2e2; color: #dc2626; }
    .dark #notif-panel .notif-icon-wrap.success { background: rgba(22,163,74,0.2); }
    .dark #notif-panel .notif-icon-wrap.warning { background: rgba(202,138,4,0.2); }
    .dark #notif-panel .notif-icon-wrap.danger  { background: rgba(220,38,38,0.2); }
    #notif-panel .notif-title { font-size: 0.8rem; font-weight: 700; color: #100d1b; line-height: 1.3; }
    .dark #notif-panel .notif-title { color: #fff; }
    #notif-panel .notif-subtitle { font-size: 0.7rem; color: #594c9a; margin-top: 1px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
    .dark #notif-panel .notif-subtitle { color: #a397e0; }
    #notif-panel .notif-time { font-size: 0.7rem; color: #594c9a; margin-top: 2px; }
</style>

<script>
(function () {
    const CSRF = document.querySelector('meta[name="csrf-token"]')?.content || '';

    const SIGAT_NOTIF = {
        /**
         * Ambil notifikasi dari server, render ke panel.
         */
        async fetch() {
            try {
                const res   = await fetch('/dashboards/notifications', { headers: { 'X-Requested-With': 'XMLHttpRequest' } });
                const data  = await res.json();
                this.render(data.notifications, data.unread_count);
            } catch (e) {
                console.warn('[notif] fetch error', e);
            }
        },

        render(notifications, unreadCount) {
            const list     = document.getElementById('notif-list');
            const empty    = document.getElementById('notif-empty');
            const countEl  = document.getElementById('notif-panel-count');
            const badgeEl  = document.getElementById('notif-badge');

            // Update badge lonceng di header
            if (badgeEl) {
                badgeEl.style.display = unreadCount > 0 ? 'block' : 'none';
                badgeEl.title = unreadCount + ' notifikasi belum dibaca';
            }

            // Update count di panel header
            if (countEl) {
                if (unreadCount > 0) {
                    countEl.textContent = unreadCount > 99 ? '99+' : unreadCount;
                    countEl.style.display = 'flex';
                } else {
                    countEl.style.display = 'none';
                }
            }

            if (!notifications || notifications.length === 0) {
                if (empty) empty.style.display = 'flex';
                return;
            }
            if (empty) empty.style.display = 'none';

            // Hapus item lama (kecuali #notif-empty)
            Array.from(list.children).forEach(c => {
                if (c.id !== 'notif-empty') c.remove();
            });

            notifications.forEach(n => {
                const d     = n.data;
                const isNew = !n.read_at;

                const iconMap = {
                    'check_circle': 'check_circle',
                    'edit_note'   : 'edit_note',
                    'cancel'      : 'cancel',
                };

                const li = document.createElement('li');
                li.className = 'notif-item' + (isNew ? ' unread' : '');
                li.dataset.id = n.id;
                li.innerHTML = `
                    <div class="notif-icon-wrap ${d.color || 'info'}">
                        <span class="material-symbols-outlined text-[18px]"
                              style="font-variation-settings:'FILL' 1,'wght' 600,'GRAD' 0,'opsz' 24">
                            ${iconMap[d.icon] || d.icon || 'notifications'}
                        </span>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="notif-title">${d.title || d.nama_kegiatan || '-'}</p>
                        ${d.nama_kegiatan && d.title ? `<p class="notif-subtitle">${d.nama_kegiatan}</p>` : ''}
                        <p class="notif-time">${n.created_at}</p>
                        ${isNew ? '<span style="display:inline-block;margin-top:4px;width:6px;height:6px;border-radius:50%;background:#3211d4"></span>' : ''}
                    </div>
                `;
                li.addEventListener('click', () => this.markRead(n.id, d.url));
                list.appendChild(li);
            });
        },

        async markRead(id, url) {
            const res  = await fetch('/dashboards/notifications/' + id + '/read', {
                method : 'POST',
                headers: {
                    'X-CSRF-TOKEN'    : CSRF,
                    'X-Requested-With': 'XMLHttpRequest',
                },
            });
            const json = await res.json();

            // Gunakan redirect_url dari server (sudah dicek apakah kegiatan masih ada)
            const redirectTo = json.redirect_url || url;
            if (redirectTo) {
                window.location.href = redirectTo;
            } else {
                this.fetch();
            }
        },

        async markAllRead() {
            await fetch('/dashboards/notifications/read-all', {
                method : 'POST',
                headers: {
                    'X-CSRF-TOKEN'    : CSRF,
                    'X-Requested-With': 'XMLHttpRequest',
                },
            });
            this.fetch();
        },

        toggle() {
            const panel = document.getElementById('notif-panel');
            if (!panel) return;
            const visible = panel.style.display !== 'none';
            panel.style.display = visible ? 'none' : 'block';
            if (!visible) this.fetch();
        },

        init() {
            this.fetch();
            // Auto-refresh tiap 30 detik
            setInterval(() => this.fetch(), 30000);

            // Tutup panel saat klik di luar
            document.addEventListener('click', (e) => {
                const panel = document.getElementById('notif-panel');
                const btn   = document.getElementById('notif-btn');
                if (panel && btn && !panel.contains(e.target) && !btn.contains(e.target)) {
                    panel.style.display = 'none';
                }
            });
        },
    };

    window.SIGAT_NOTIF = SIGAT_NOTIF;

    // Backward compat: SIGAT.toggleNotifPanel() yang sudah dipakai di dashboard
    window.SIGAT = window.SIGAT || {};
    window.SIGAT.toggleNotifPanel = () => SIGAT_NOTIF.toggle();

    // Jalankan init setelah DOM siap
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', () => SIGAT_NOTIF.init());
    } else {
        SIGAT_NOTIF.init();
    }
})();
</script>
