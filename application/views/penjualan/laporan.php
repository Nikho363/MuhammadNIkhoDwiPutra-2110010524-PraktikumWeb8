<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4"><?php echo $title ?></h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="<?php echo site_url('user') ?>">Dashboard</a></li>
            <li class="breadcrumb-item active"><?php echo $title ?></li>
        </ol>
 
        <!-- Laporan 1 -->
        <div class="card mb-4">
            <div class="card-header">
                Laporan: Internal - Semua Data (Controller)
            </div>
            <div class="card-body">
                <form method="post" action="<?php echo base_url('report/penjualanlap') ?>" target="_blank">
                    <p>Report diproses dari controller dan mencetak semua data kustomer.</p>
                    <button type="submit" class="btn btn-warning">Cetak Laporan</button>
                </form>
            </div>
        </div>

        <!-- Laporan 2 -->
        <div class="card mb-4">
            <div class="card-header">
                Laporan: Internal - Header Saja (Controller)
            </div>
            <div class="card-body">
                <form method="post" action="<?php echo base_url('report/headerlap') ?>" target="_blank">
                    <p>Report hanya mencetak bagian header dari controller.</p>
                    <button type="submit" class="btn btn-warning">Cetak Laporan</button>
                </form>
            </div>
        </div>

        <!-- Laporan 3 -->
        <div class="card mb-4">
            <div class="card-header">
                Laporan: Eksternal - View
            </div>
            <div class="card-body">
                <form method="post" action="<?php echo base_url('report/kustomerfull') ?>" target="_blank">
                    <p>Report dipisahkan dalam file view eksternal.</p>
                    <button type="submit" class="btn btn-warning">Cetak Laporan</button>
                </form>
            </div>
        </div>

        <!-- Laporan 4 -->
        <div class="card mb-4">
            <div class="card-header">
                Laporan: Custom Eksternal - View Berdasarkan Fungsi
            </div>
            <div class="card-body">
                <form method="post" action="<?php echo base_url('report/kustomerkustom') ?>" target="_blank">
                    <p>Report dikelola berdasarkan fungsi tertentu dalam file view terpisah.</p>
                    <button type="submit" class="btn btn-warning">Cetak Laporan</button>
                </form>
            </div>
        </div>

    </div>
</main>