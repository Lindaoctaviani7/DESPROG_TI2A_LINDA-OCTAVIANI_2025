<?php
$dataFile = 'data_peminjaman.json';

// Jika file belum ada, membuat baru
if (!file_exists($dataFile)) {
    file_put_contents($dataFile, json_encode([]));
}

function loadData($file) {
    return json_decode(file_get_contents($file), true); //buat load sama save
}

function saveData($file, $data) {
    file_put_contents($file, json_encode($data, JSON_PRETTY_PRINT));
}

// menghapus semua data
if (isset($_GET['action']) && $_GET['action'] === 'clear') {
    file_put_contents($dataFile, json_encode([]));
    echo "<script>alert('Semua data peminjaman telah dihapus!');window.location.href='process.php?action=view';</script>";
    exit;
}

json_encode([]) = mengubah array kosong ([]) menjadi teks JSON kosong ("[]").

file_put_contents() = menulis (menimpa) isi file dengan data baru.

if (isset($_GET['action']) && $_GET['action'] === 'view') { //nampilin data peminjaman
    $data = loadData($dataFile);
    ?>
    <!DOCTYPE html>
    <html lang="id">
    <head>
        <meta charset="UTF-8">
        <title>Data Peminjaman Buku</title>
        <link rel="stylesheet" href="style.css">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="script.js"></script>
    </head>
    <body>
        <div class="container">
            <h1>📋 Data Peminjaman Buku</h1>
            <div class="data-table-container">
                <?php if (count($data) > 0): ?>
                    <table class="data-table" id="dataTable"> 
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Judul Buku</th>
                                <th>Lama</th>
                                <th>Tanggal Pinjam</th>
                                <th>Tanggal Kembali</th>
                                <th>Komentar</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($data as $row): ?>
                                <tr>
                                    <td class="loan-id"><?= htmlspecialchars($row['id']) ?></td>
                                    <td><?= htmlspecialchars($row['nama']) ?></td>
                                    <td><?= htmlspecialchars($row['email']) ?></td>
                                    <td><?= htmlspecialchars($row['judul_buku']) ?></td>
                                    <td><?= htmlspecialchars($row['lama_peminjaman']) ?> hari</td>
                                    <td><?= htmlspecialchars($row['tanggal_pinjam']) ?></td>
                                    <td><?= htmlspecialchars($row['tanggal_kembali']) ?></td>
                                    <td class="comment-preview" onclick="showFullComment('<?= htmlspecialchars($row['komentar']) ?>')">
                                        <?= htmlspecialchars($row['komentar']) ?>
                                    </td>
                                    <td><span class="status-badge"><?= htmlspecialchars($row['status']) ?></span></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <div class="empty-state">
                        <div class="empty-icon">📭</div>
                        <p>Belum ada data peminjaman.</p>
                    </div>
                <?php endif; ?>
            </div>

            <div class="action-buttons">
                <a href="index.html" class="clear-btn"><- Kembali ke Form</a>
                <button onclick="exportData()" class="export-btn">📤 Export CSV</button>
                <a href="process.php?action=clear" class="clear-btn">Hapus Semua Data</a>
            </div>
        </div>
    </body>
    </html>
    <?php
    exit;
}

// nyimpen data baru
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = trim($_POST['nama']);
    $email = trim($_POST['email']);
    $judul_buku = trim($_POST['judul_buku']);
    $lama_peminjaman = intval($_POST['lama_peminjaman']);
    $komentar = trim($_POST['komentar']);

    $tanggal_pinjam = date('Y-m-d');
    $tanggal_kembali = date('Y-m-d', strtotime("+$lama_peminjaman days"));

    $data = loadData($dataFile);

    $newData = [
        'id' => uniqid('PJ-'), //buat id otomatis
        'nama' => $nama,
        'email' => $email,
        'judul_buku' => $judul_buku,
        'lama_peminjaman' => $lama_peminjaman,
        'tanggal_pinjam' => $tanggal_pinjam,
        'tanggal_kembali' => $tanggal_kembali,
        'komentar' => $komentar,
        'status' => 'Dipinjam'
    ];

    $data[] = $newData;
    saveData($dataFile, $data);
    ?>
    <!DOCTYPE html>
    <html lang="id">
    <head>
        <meta charset="UTF-8">
        <title>Peminjaman Berhasil</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <div class="result-container">
            <div class="success-card">
                <div class="result-icon success-icon">✅</div> <!--nampilin konfirmasi berhasil-->
                <h2>Peminjaman Berhasil!</h2>
                <p>Data peminjaman Anda telah disimpan dengan sukses.</p>

                <div class="loan-details">
                    <div class="detail-row">
                        <span class="detail-label">ID Peminjaman</span>
                        <span class="detail-value"><?= $newData['id'] ?></span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Nama</span>
                        <span class="detail-value"><?= htmlspecialchars($nama) ?></span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Judul Buku</span>
                        <span class="detail-value"><?= htmlspecialchars($judul_buku) ?></span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Durasi</span>
                        <span class="detail-value"><?= $lama_peminjaman ?> hari</span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Tanggal Kembali</span>
                        <span class="detail-value"><?= $tanggal_kembali ?></span>
                    </div>
                </div>

                <div class="action-buttons">
                    <a href="index.html" class="btn btn-secondary">🔄 Pinjam Lagi</a>
                    <a href="process.php?action=view" class="btn btn-primary">Lihat Semua Data</a>
                </div>
            </div>
        </div>
    </body>
    </html>
    <?php
}
?>
