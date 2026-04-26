<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Manajemen Blog (CMS)</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f0f2f5;
            color: #333;
            min-height: 100vh;
        }

        .header {
            background: #fff;
            padding: 14px 24px;
            display: flex;
            align-items: center;
            gap: 12px;
            box-shadow: 0 1px 4px rgba(0,0,0,.1);
            position: sticky;
            top: 0;
            z-index: 100;
        }
        .header-icon {
            width: 38px; height: 38px;
            background: #4f46e5;
            border-radius: 8px;
            display: flex; align-items: center; justify-content: center;
            color: #fff; font-size: 18px;
        }
        .header h1 { font-size: 18px; font-weight: 700; color: #1e1b4b; }
        .header p  { font-size: 12px; color: #6b7280; }

        .layout {
            display: flex;
            min-height: calc(100vh - 66px);
        }

        .sidebar {
            width: 220px;
            background: #fff;
            border-right: 1px solid #e5e7eb;
            padding: 20px 0;
            flex-shrink: 0;
        }
        .sidebar-label {
            font-size: 10px;
            font-weight: 700;
            color: #9ca3af;
            letter-spacing: .08em;
            padding: 0 20px 10px;
            text-transform: uppercase;
        }
        .nav-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 11px 20px;
            cursor: pointer;
            font-size: 14px;
            color: #4b5563;
            border-left: 3px solid transparent;
            transition: all .15s;
        }
        .nav-item:hover { background: #f9fafb; color: #4f46e5; }
        .nav-item.active {
            background: #eef2ff;
            color: #4f46e5;
            border-left-color: #4f46e5;
            font-weight: 600;
        }
        .nav-item span.icon { font-size: 16px; }

        .content {
            flex: 1;
            padding: 28px;
            overflow-x: auto;
        }
        .content-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        .content-title { font-size: 18px; font-weight: 700; color: #1f2937; }

        .btn {
            padding: 8px 16px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 13px;
            font-weight: 500;
            transition: all .15s;
        }
        .btn-primary   { background: #4f46e5; color: #fff; }
        .btn-primary:hover  { background: #4338ca; }
        .btn-success   { background: #10b981; color: #fff; }
        .btn-success:hover  { background: #059669; }
        .btn-warning   { background: #52f805; color: #fff; }
        .btn-warning:hover  { background: #52f805; }
        .btn-danger    { background: #ef4444; color: #fff; }
        .btn-danger:hover   { background: #dc2626; }
        .btn-secondary { background: #e5e7eb; color: #374151; }
        .btn-secondary:hover { background: #d1d5db; }
        .btn-sm { padding: 5px 12px; font-size: 12px; }

        .table-wrap {
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 1px 3px rgba(0,0,0,.08);
            overflow: hidden;
        }
        table { width: 100%; border-collapse: collapse; }
        thead { background: #f9fafb; }
        th {
            padding: 12px 16px;
            text-align: left;
            font-size: 11px;
            font-weight: 700;
            color: #6b7280;
            text-transform: uppercase;
            letter-spacing: .05em;
            border-bottom: 1px solid #e5e7eb;
        }
        td {
            padding: 12px 16px;
            font-size: 13px;
            color: #374151;
            border-bottom: 1px solid #f3f4f6;
            vertical-align: middle;
        }
        tr:last-child td { border-bottom: none; }
        tr:hover td { background: #fafafa; }

        .foto-thumb {
            width: 44px; 
            height: 44px;
            border-radius: 50%;
            object-fit: cover;
            background: #e5e7eb;
            border: 2px solid #fff;
            box-shadow: 0 0 0 2px #e5e7eb;
        }

        .foto-artikel {
            width: 44px;
            height: 44px;
            border-radius: 6px; 
            object-fit: cover;
        }
        .badge {
            display: inline-block;
            padding: 3px 10px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 600;
            background: #dbeafe;
            color: #1d4ed8;
        }
        .badge-green { background: #d1fae5; color: #065f46; }
        .badge-purple { background: #ede9fe; color: #5b21b6; }

        .password-mask { font-size: 13px; color: #9ca3af; letter-spacing: 2px; }

        .modal-overlay {
            display: none;
            position: fixed; inset: 0;
            background: rgba(0,0,0,.45);
            z-index: 500;
            align-items: center;
            justify-content: center;
        }
        .modal-overlay.show { display: flex; }
        .modal {
            background: #fff;
            border-radius: 12px;
            width: 480px;
            max-width: 95vw;
            max-height: 90vh;
            overflow-y: auto;
            box-shadow: 0 20px 60px rgba(0,0,0,.25);
            animation: slideIn .2s ease;
        }
        .modal-sm { width: 340px; }
        @keyframes slideIn {
            from { transform: translateY(-20px); opacity: 0; }
            to   { transform: translateY(0);     opacity: 1; }
        }
        .modal-header {
            padding: 20px 24px 0;
        }
        .modal-header h3 { font-size: 17px; font-weight: 700; color: #1f2937; }
        .modal-body { padding: 20px 24px; }
        .modal-footer {
            padding: 0 24px 20px;
            display: flex;
            justify-content: flex-end;
            gap: 10px;
        }

        /* Hapus modal */
        .modal-delete-body {
            text-align: center;
            padding: 28px 24px 16px;
        }
        .delete-icon {
            width: 56px; height: 56px;
            background: #fef2f2;
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-size: 24px;
            margin: 0 auto 16px;
        }
        .modal-delete-body h4 { font-size: 16px; font-weight: 700; margin-bottom: 6px; }
        .modal-delete-body p  { font-size: 13px; color: #6b7280; }

        /* ===== FORM ===== */
        .form-row { display: flex; gap: 14px; margin-bottom: 14px; }
        .form-group { flex: 1; }
        .form-group label {
            display: block;
            font-size: 13px;
            font-weight: 500;
            color: #374151;
            margin-bottom: 5px;
        }
        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 9px 12px;
            border: 1px solid #d1d5db;
            border-radius: 7px;
            font-size: 13px;
            outline: none;
            transition: border-color .15s;
            font-family: inherit;
        }
        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus { border-color: #4f46e5; box-shadow: 0 0 0 2px rgba(79,70,229,.1); }
        .form-group textarea { resize: vertical; min-height: 90px; }
        .form-hint { font-size: 11px; color: #9ca3af; margin-top: 4px; }

        #toast {
            position: fixed;
            bottom: 24px; right: 24px;
            background: #1f2937;
            color: #fff;
            padding: 12px 20px;
            border-radius: 8px;
            font-size: 13px;
            z-index: 9999;
            opacity: 0;
            transform: translateY(10px);
            transition: all .3s;
            max-width: 320px;
        }
        #toast.show { opacity: 1; transform: translateY(0); }
        #toast.success { background: #10b981; }
        #toast.error   { background: #ef4444; }

        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: #9ca3af;
        }
        .empty-state .empty-icon { font-size: 40px; margin-bottom: 12px; }
        .empty-state p { font-size: 14px; }

        .loading {
            text-align: center;
            padding: 40px;
            color: #9ca3af;
            font-size: 14px;
        }
    </style>
</head>
<body>

<!-- HEADER -->
<header class="header">
    <div class="header-icon">📝</div>
    <div>
        <h1>Sistem Manajemen Blog (CMS)</h1>
        <p>Blog Keren</p>
    </div>
</header>

<div class="layout">

    <aside class="sidebar">
        <div class="sidebar-label">Menu Utama</div>
        <div class="nav-item active" onclick="loadSection('penulis')" id="nav-penulis">
            <span class="icon">👤</span> Kelola Penulis
        </div>
        <div class="nav-item" onclick="loadSection('artikel')" id="nav-artikel">
            <span class="icon">📄</span> Kelola Artikel
        </div>
        <div class="nav-item" onclick="loadSection('kategori')" id="nav-kategori">
            <span class="icon">🗂</span> Kelola Kategori
        </div>
    </aside>

    <main class="content" id="main-content">
        <div class="loading">Memuat data...</div>
    </main>
</div>

<div class="modal-overlay" id="modalTambahPenulis">
    <div class="modal">
        <div class="modal-header"><h3>Tambah Penulis</h3></div>
        <form id="formTambahPenulis" enctype="multipart/form-data">
        <div class="modal-body">
            <div class="form-row">
                <div class="form-group">
                    <label>Nama Depan</label>
                    <input type="text" name="nama_depan" placeholder="Ahmad" required>
                </div>
                <div class="form-group">
                    <label>Nama Belakang</label>
                    <input type="text" name="nama_belakang" placeholder="Fauzi" required>
                </div>
            </div>
            <div class="form-group" style="margin-bottom:14px">
                <label>Username</label>
                <input type="text" name="user_name" placeholder="ahmad_f" required>
            </div>
            <div class="form-group" style="margin-bottom:14px">
                <label>Password</label>
                <input type="password" name="password" required>
            </div>
            <div class="form-group">
                <label>Foto Profil</label>
                <input type="file" name="foto" accept="image/*">
                <p class="form-hint">Maks. 2 MB. Format: JPG, PNG, GIF, WEBP. Kosongkan untuk foto default.</p>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" onclick="closeModal('modalTambahPenulis')">Batal</button>
            <button type="submit" class="btn btn-primary">Simpan Data</button>
        </div>
        </form>
    </div>
</div>

<div class="modal-overlay" id="modalEditPenulis">
    <div class="modal">
        <div class="modal-header"><h3>Edit Penulis</h3></div>
        <form id="formEditPenulis" enctype="multipart/form-data">
        <input type="hidden" name="id" id="editPenulisId">
        <div class="modal-body">
            <div class="form-row">
                <div class="form-group">
                    <label>Nama Depan</label>
                    <input type="text" name="nama_depan" id="editNamaDepan" required>
                </div>
                <div class="form-group">
                    <label>Nama Belakang</label>
                    <input type="text" name="nama_belakang" id="editNamaBelakang" required>
                </div>
            </div>
            <div class="form-group" style="margin-bottom:14px">
                <label>Username</label>
                <input type="text" name="user_name" id="editUserName" required>
            </div>
            <div class="form-group" style="margin-bottom:14px">
                <label>Password Baru <span style="color:#9ca3af;font-weight:400">(kosongkan jika tidak diganti)</span></label>
                <input type="password" name="password">
            </div>
            <div class="form-group">
                <label>Foto Profil <span style="color:#9ca3af;font-weight:400">(kosongkan jika tidak diganti)</span></label>
                <input type="file" name="foto" accept="image/*">
                <p class="form-hint">Maks. 2 MB. Format: JPG, PNG, GIF, WEBP.</p>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" onclick="closeModal('modalEditPenulis')">Batal</button>
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        </div>
        </form>
    </div>
</div>

<div class="modal-overlay" id="modalHapusPenulis">
    <div class="modal modal-sm">
        <div class="modal-delete-body">
            <div class="delete-icon">🗑️</div>
            <h4>Hapus data ini?</h4>
            <p>Data yang dihapus tidak dapat dikembalikan.</p>
        </div>
        <div class="modal-footer" style="justify-content:center">
            <button class="btn btn-secondary" onclick="closeModal('modalHapusPenulis')">Batal</button>
            <button class="btn btn-danger" id="btnKonfirmasiHapusPenulis">Ya, Hapus</button>
        </div>
    </div>
</div>

<div class="modal-overlay" id="modalTambahKategori">
    <div class="modal">
        <div class="modal-header"><h3>Tambah Kategori</h3></div>
        <form id="formTambahKategori">
        <div class="modal-body">
            <div class="form-group" style="margin-bottom:14px">
                <label>Nama Kategori</label>
                <input type="text" name="nama_kategori" placeholder="Nama kategori..." required>
            </div>
            <div class="form-group">
                <label>Keterangan</label>
                <textarea name="keterangan" placeholder="Deskripsi kategori..."></textarea>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" onclick="closeModal('modalTambahKategori')">Batal</button>
            <button type="submit" class="btn btn-primary">Simpan Data</button>
        </div>
        </form>
    </div>
</div>

<div class="modal-overlay" id="modalEditKategori">
    <div class="modal">
        <div class="modal-header"><h3>Edit Kategori</h3></div>
        <form id="formEditKategori">
        <input type="hidden" name="id" id="editKategoriId">
        <div class="modal-body">
            <div class="form-group" style="margin-bottom:14px">
                <label>Nama Kategori</label>
                <input type="text" name="nama_kategori" id="editNamaKategori" required>
            </div>
            <div class="form-group">
                <label>Keterangan</label>
                <textarea name="keterangan" id="editKeterangan"></textarea>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" onclick="closeModal('modalEditKategori')">Batal</button>
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        </div>
        </form>
    </div>
</div>

<div class="modal-overlay" id="modalHapusKategori">
    <div class="modal modal-sm">
        <div class="modal-delete-body">
            <div class="delete-icon">🗑️</div>
            <h4>Hapus data ini?</h4>
            <p>Data yang dihapus tidak dapat dikembalikan.</p>
        </div>
        <div class="modal-footer" style="justify-content:center">
            <button class="btn btn-secondary" onclick="closeModal('modalHapusKategori')">Batal</button>
            <button class="btn btn-danger" id="btnKonfirmasiHapusKategori">Ya, Hapus</button>
        </div>
    </div>
</div>

<div class="modal-overlay" id="modalTambahArtikel">
    <div class="modal">
        <div class="modal-header"><h3>Tambah Artikel</h3></div>
        <form id="formTambahArtikel" enctype="multipart/form-data">
        <div class="modal-body">
            <div class="form-group" style="margin-bottom:14px">
                <label>Judul</label>
                <input type="text" name="judul" placeholder="Judul artikel..." required>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label>Penulis</label>
                    <select name="id_penulis" id="selectTambahPenulis" required>
                        <option value="">Pilih Penulis</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Kategori</label>
                    <select name="id_kategori" id="selectTambahKategori" required>
                        <option value="">Pilih Kategori</option>
                    </select>
                </div>
            </div>
            <div class="form-group" style="margin-bottom:14px">
                <label>Isi Artikel</label>
                <textarea name="isi" placeholder="Tulis isi artikel di sini..." required style="min-height:110px"></textarea>
            </div>
            <div class="form-group">
                <label>Gambar</label>
                <input type="file" name="gambar" accept="image/*" required>
                <p class="form-hint">Wajib diisi. Maks. 2 MB. Format: JPG, PNG, GIF, WEBP.</p>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" onclick="closeModal('modalTambahArtikel')">Batal</button>
            <button type="submit" class="btn btn-primary">Simpan Data</button>
        </div>
        </form>
    </div>
</div>

<div class="modal-overlay" id="modalEditArtikel">
    <div class="modal">
        <div class="modal-header"><h3>Edit Artikel</h3></div>
        <form id="formEditArtikel" enctype="multipart/form-data">
        <input type="hidden" name="id" id="editArtikelId">
        <div class="modal-body">
            <div class="form-group" style="margin-bottom:14px">
                <label>Judul</label>
                <input type="text" name="judul" id="editJudul" required>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label>Penulis</label>
                    <select name="id_penulis" id="selectEditPenulis" required>
                        <option value="">Pilih Penulis</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Kategori</label>
                    <select name="id_kategori" id="selectEditKategori" required>
                        <option value="">Pilih Kategori</option>
                    </select>
                </div>
            </div>
            <div class="form-group" style="margin-bottom:14px">
                <label>Isi Artikel</label>
                <textarea name="isi" id="editIsi" required style="min-height:110px"></textarea>
            </div>
            <div class="form-group">
                <label>Gambar <span style="color:#9ca3af;font-weight:400">(kosongkan jika tidak diganti)</span></label>
                <input type="file" name="gambar" accept="image/*">
                <p class="form-hint">Maks. 2 MB. Format: JPG, PNG, GIF, WEBP.</p>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" onclick="closeModal('modalEditArtikel')">Batal</button>
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        </div>
        </form>
    </div>
</div>

<div class="modal-overlay" id="modalHapusArtikel">
    <div class="modal modal-sm">
        <div class="modal-delete-body">
            <div class="delete-icon">🗑️</div>
            <h4>Hapus data ini?</h4>
            <p>Data yang dihapus tidak dapat dikembalikan.</p>
        </div>
        <div class="modal-footer" style="justify-content:center">
            <button class="btn btn-secondary" onclick="closeModal('modalHapusArtikel')">Batal</button>
            <button class="btn btn-danger" id="btnKonfirmasiHapusArtikel">Ya, Hapus</button>
        </div>
    </div>
</div>

<div id="toast"></div>

<script>

let currentSection = 'penulis';

function showToast(msg, type = 'success') {
    const t = document.getElementById('toast');
    t.textContent = msg;
    t.className = 'show ' + type;
    setTimeout(() => { t.className = ''; }, 3000);
}

function openModal(id) {
    document.getElementById(id).classList.add('show');
}
function closeModal(id) {
    document.getElementById(id).classList.remove('show');
}

document.querySelectorAll('.modal-overlay').forEach(overlay => {
    overlay.addEventListener('click', e => {
        if (e.target === overlay) overlay.classList.remove('show');
    });
});

function esc(str) {
    if (str == null) return '';
    return String(str)
        .replace(/&/g,'&amp;')
        .replace(/</g,'&lt;')
        .replace(/>/g,'&gt;')
        .replace(/"/g,'&quot;')
        .replace(/'/g,'&#39;');
}

function loadSection(section) {
    currentSection = section;
    ['penulis','artikel','kategori'].forEach(s => {
        document.getElementById('nav-' + s).classList.remove('active');
    });
    document.getElementById('nav-' + section).classList.add('active');
    document.getElementById('main-content').innerHTML = '<div class="loading">Memuat data...</div>';

    if (section === 'penulis')  loadPenulis();
    if (section === 'artikel')  loadArtikel();
    if (section === 'kategori') loadKategori();
}

function loadPenulis() {
    fetch('ambil_penulis.php')
        .then(r => r.json())
        .then(res => {
            let html = `
            <div class="content-header">
                <div class="content-title">Data Penulis</div>
                <button class="btn btn-primary" onclick="bukaModalTambahPenulis()">+ Tambah Penulis</button>
            </div>
            <div class="table-wrap">`;

            if (!res.data || res.data.length === 0) {
                html += `<div class="empty-state"><div class="empty-icon">👤</div><p>Belum ada data penulis.</p></div>`;
            } else {
                html += `<table>
                <thead><tr>
                    <th>FOTO</th><th>NAMA</th><th>USERNAME</th><th>PASSWORD</th><th>AKSI</th>
                </tr></thead><tbody>`;
                res.data.forEach(p => {
                    const fotoSrc = 'uploads_penulis/' + esc(p.foto);
                    const namaLengkap = esc(p.nama_depan) + ' ' + esc(p.nama_belakang);
                    html += `<tr>
                        <td><img src="${fotoSrc}" class="foto-thumb" onerror="this.src='uploads_penulis/default.png'" alt="foto"></td>
                        <td>${namaLengkap}</td>
                        <td><code style="background:#f3f4f6;padding:2px 8px;border-radius:4px;font-size:12px">${esc(p.user_name)}</code></td>
                        <td><span class="password-mask">${esc(p.password).substring(0, 15)}...</span></td>
                        <td>
                            <button class="btn btn-warning btn-sm" onclick="bukaModalEditPenulis(${p.id})">Edit</button>
                            <button class="btn btn-danger btn-sm" onclick="bukaModalHapusPenulis(${p.id})" style="margin-left:4px">Hapus</button>
                        </td>
                    </tr>`;
                });
                html += `</tbody></table>`;
            }
            html += `</div>`;
            document.getElementById('main-content').innerHTML = html;
        })
        .catch(() => showToast('Gagal memuat data penulis', 'error'));
}

function bukaModalTambahPenulis() {
    document.getElementById('formTambahPenulis').reset();
    openModal('modalTambahPenulis');
}

document.getElementById('formTambahPenulis').addEventListener('submit', function(e) {
    e.preventDefault();
    const fd = new FormData(this);
    fetch('simpan_penulis.php', { method: 'POST', body: fd })
        .then(r => r.json())
        .then(res => {
            if (res.status === 'success') {
                closeModal('modalTambahPenulis');
                showToast(res.message, 'success');
                loadPenulis();
            } else {
                showToast(res.message, 'error');
            }
        });
});

function bukaModalEditPenulis(id) {
    fetch('ambil_satu_penulis.php?id=' + id)
        .then(r => r.json())
        .then(res => {
            if (res.status === 'success') {
                const d = res.data;
                document.getElementById('editPenulisId').value     = d.id;
                document.getElementById('editNamaDepan').value     = d.nama_depan;
                document.getElementById('editNamaBelakang').value  = d.nama_belakang;
                document.getElementById('editUserName').value      = d.user_name;
                document.getElementById('formEditPenulis').querySelector('input[type=password]').value = '';
                document.getElementById('formEditPenulis').querySelector('input[type=file]').value = '';
                openModal('modalEditPenulis');
            } else {
                showToast(res.message, 'error');
            }
        });
}

document.getElementById('formEditPenulis').addEventListener('submit', function(e) {
    e.preventDefault();
    const fd = new FormData(this);
    fetch('update_penulis.php', { method: 'POST', body: fd })
        .then(r => r.json())
        .then(res => {
            if (res.status === 'success') {
                closeModal('modalEditPenulis');
                showToast(res.message, 'success');
                loadPenulis();
            } else {
                showToast(res.message, 'error');
            }
        });
});

let hapusPenulisId = null;
function bukaModalHapusPenulis(id) {
    hapusPenulisId = id;
    openModal('modalHapusPenulis');
}
document.getElementById('btnKonfirmasiHapusPenulis').addEventListener('click', function() {
    if (!hapusPenulisId) return;
    const fd = new FormData();
    fd.append('id', hapusPenulisId);
    fetch('hapus_penulis.php', { method: 'POST', body: fd })
        .then(r => r.json())
        .then(res => {
            closeModal('modalHapusPenulis');
            showToast(res.message, res.status === 'success' ? 'success' : 'error');
            if (res.status === 'success') loadPenulis();
        });
});

function loadKategori() {
    fetch('ambil_kategori.php')
        .then(r => r.json())
        .then(res => {
            let html = `
            <div class="content-header">
                <div class="content-title">Data Kategori Artikel</div>
                <button class="btn btn-primary" onclick="bukaModalTambahKategori()">+ Tambah Kategori</button>
            </div>
            <div class="table-wrap">`;

            if (!res.data || res.data.length === 0) {
                html += `<div class="empty-state"><div class="empty-icon">🗂</div><p>Belum ada data kategori.</p></div>`;
            } else {
                html += `<table>
                <thead><tr>
                    <th>NAMA KATEGORI</th><th>KETERANGAN</th><th>AKSI</th>
                </tr></thead><tbody>`;
                res.data.forEach(k => {
                    html += `<tr>
                        <td><span class="badge">${esc(k.nama_kategori)}</span></td>
                        <td>${esc(k.keterangan) || '<em style="color:#9ca3af">-</em>'}</td>
                        <td>
                            <button class="btn btn-warning btn-sm" onclick="bukaModalEditKategori(${k.id})">Edit</button>
                            <button class="btn btn-danger btn-sm" onclick="bukaModalHapusKategori(${k.id})" style="margin-left:4px">Hapus</button>
                        </td>
                    </tr>`;
                });
                html += `</tbody></table>`;
            }
            html += `</div>`;
            document.getElementById('main-content').innerHTML = html;
        })
        .catch(() => showToast('Gagal memuat data kategori', 'error'));
}

function bukaModalTambahKategori() {
    document.getElementById('formTambahKategori').reset();
    openModal('modalTambahKategori');
}

document.getElementById('formTambahKategori').addEventListener('submit', function(e) {
    e.preventDefault();
    const fd = new FormData(this);
    fetch('simpan_kategori.php', { method: 'POST', body: fd })
        .then(r => r.json())
        .then(res => {
            if (res.status === 'success') {
                closeModal('modalTambahKategori');
                showToast(res.message, 'success');
                loadKategori();
            } else {
                showToast(res.message, 'error');
            }
        });
});

function bukaModalEditKategori(id) {
    fetch('ambil_satu_kategori.php?id=' + id)
        .then(r => r.json())
        .then(res => {
            if (res.status === 'success') {
                const d = res.data;
                document.getElementById('editKategoriId').value      = d.id;
                document.getElementById('editNamaKategori').value    = d.nama_kategori;
                document.getElementById('editKeterangan').value      = d.keterangan || '';
                openModal('modalEditKategori');
            } else {
                showToast(res.message, 'error');
            }
        });
}

document.getElementById('formEditKategori').addEventListener('submit', function(e) {
    e.preventDefault();
    const fd = new FormData(this);
    fetch('update_kategori.php', { method: 'POST', body: fd })
        .then(r => r.json())
        .then(res => {
            if (res.status === 'success') {
                closeModal('modalEditKategori');
                showToast(res.message, 'success');
                loadKategori();
            } else {
                showToast(res.message, 'error');
            }
        });
});

let hapusKategoriId = null;
function bukaModalHapusKategori(id) {
    hapusKategoriId = id;
    openModal('modalHapusKategori');
}
document.getElementById('btnKonfirmasiHapusKategori').addEventListener('click', function() {
    if (!hapusKategoriId) return;
    const fd = new FormData();
    fd.append('id', hapusKategoriId);
    fetch('hapus_kategori.php', { method: 'POST', body: fd })
        .then(r => r.json())
        .then(res => {
            closeModal('modalHapusKategori');
            showToast(res.message, res.status === 'success' ? 'success' : 'error');
            if (res.status === 'success') loadKategori();
        });
});

function loadArtikel() {
    fetch('ambil_artikel.php')
        .then(r => r.json())
        .then(res => {
            let html = `
            <div class="content-header">
                <div class="content-title">Data Artikel</div>
                <button class="btn btn-primary" onclick="bukaModalTambahArtikel()">+ Tambah Artikel</button>
            </div>
            <div class="table-wrap">`;

            if (!res.data || res.data.length === 0) {
                html += `<div class="empty-state"><div class="empty-icon">📄</div><p>Belum ada data artikel.</p></div>`;
            } else {
                html += `<table>
                <thead><tr>
                    <th>GAMBAR</th><th>JUDUL</th><th>KATEGORI</th><th>PENULIS</th><th>TANGGAL</th><th>AKSI</th>
                </tr></thead><tbody>`;
                res.data.forEach(a => {
                    const gambarSrc = 'uploads_artikel/' + esc(a.gambar);
                    const namaLengkap = esc(a.nama_depan) + ' ' + esc(a.nama_belakang);
                    html += `<tr>
                        <td><img src="${gambarSrc}" class="foto-thumb" onerror="this.style.background='#e5e7eb'" alt="gambar"></td>
                        <td style="max-width:200px"><strong>${esc(a.judul)}</strong></td>
                        <td><span class="badge badge-purple">${esc(a.nama_kategori)}</span></td>
                        <td>${namaLengkap}</td>
                        <td style="font-size:12px;color:#6b7280;white-space:nowrap">${esc(a.hari_tanggal)}</td>
                        <td>
                            <button class="btn btn-warning btn-sm" onclick="bukaModalEditArtikel(${a.id})">Edit</button>
                            <button class="btn btn-danger btn-sm" onclick="bukaModalHapusArtikel(${a.id})" style="margin-left:4px">Hapus</button>
                        </td>
                    </tr>`;
                });
                html += `</tbody></table>`;
            }
            html += `</div>`;
            document.getElementById('main-content').innerHTML = html;
        })
        .catch(() => showToast('Gagal memuat data artikel', 'error'));
}

function loadDropdownPenulis(selectId, selectedId = null) {
    fetch('ambil_penulis.php')
        .then(r => r.json())
        .then(res => {
            const sel = document.getElementById(selectId);
            sel.innerHTML = '<option value="">Pilih Penulis</option>';
            if (res.data) {
                res.data.forEach(p => {
                    const opt = document.createElement('option');
                    opt.value = p.id;
                    opt.textContent = p.nama_depan + ' ' + p.nama_belakang;
                    if (selectedId && p.id == selectedId) opt.selected = true;
                    sel.appendChild(opt);
                });
            }
        });
}

function loadDropdownKategori(selectId, selectedId = null) {
    fetch('ambil_kategori.php')
        .then(r => r.json())
        .then(res => {
            const sel = document.getElementById(selectId);
            sel.innerHTML = '<option value="">Pilih Kategori</option>';
            if (res.data) {
                res.data.forEach(k => {
                    const opt = document.createElement('option');
                    opt.value = k.id;
                    opt.textContent = k.nama_kategori;
                    if (selectedId && k.id == selectedId) opt.selected = true;
                    sel.appendChild(opt);
                });
            }
        });
}

function bukaModalTambahArtikel() {
    document.getElementById('formTambahArtikel').reset();
    loadDropdownPenulis('selectTambahPenulis');
    loadDropdownKategori('selectTambahKategori');
    openModal('modalTambahArtikel');
}

document.getElementById('formTambahArtikel').addEventListener('submit', function(e) {
    e.preventDefault();
    const fd = new FormData(this);
    fetch('simpan_artikel.php', { method: 'POST', body: fd })
        .then(r => r.json())
        .then(res => {
            if (res.status === 'success') {
                closeModal('modalTambahArtikel');
                showToast(res.message, 'success');
                loadArtikel();
            } else {
                showToast(res.message, 'error');
            }
        });
});

function bukaModalEditArtikel(id) {
    fetch('ambil_satu_artikel.php?id=' + id)
        .then(r => r.json())
        .then(res => {
            if (res.status === 'success') {
                const d = res.data;
                document.getElementById('editArtikelId').value = d.id;
                document.getElementById('editJudul').value     = d.judul;
                document.getElementById('editIsi').value       = d.isi;
                document.getElementById('formEditArtikel').querySelector('input[type=file]').value = '';
                loadDropdownPenulis('selectEditPenulis',  d.id_penulis);
                loadDropdownKategori('selectEditKategori', d.id_kategori);
                openModal('modalEditArtikel');
            } else {
                showToast(res.message, 'error');
            }
        });
}

document.getElementById('formEditArtikel').addEventListener('submit', function(e) {
    e.preventDefault();
    const fd = new FormData(this);
    fetch('update_artikel.php', { method: 'POST', body: fd })
        .then(r => r.json())
        .then(res => {
            if (res.status === 'success') {
                closeModal('modalEditArtikel');
                showToast(res.message, 'success');
                loadArtikel();
            } else {
                showToast(res.message, 'error');
            }
        });
});

let hapusArtikelId = null;
function bukaModalHapusArtikel(id) {
    hapusArtikelId = id;
    openModal('modalHapusArtikel');
}
document.getElementById('btnKonfirmasiHapusArtikel').addEventListener('click', function() {
    if (!hapusArtikelId) return;
    const fd = new FormData();
    fd.append('id', hapusArtikelId);
    fetch('hapus_artikel.php', { method: 'POST', body: fd })
        .then(r => r.json())
        .then(res => {
            closeModal('modalHapusArtikel');
            showToast(res.message, res.status === 'success' ? 'success' : 'error');
            if (res.status === 'success') loadArtikel();
        });
});

loadPenulis();
</script>
</body>
</html>
