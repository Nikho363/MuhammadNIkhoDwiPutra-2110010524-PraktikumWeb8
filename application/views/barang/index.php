<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4"></h1>

        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item">
                <a href="<?php echo site_url('barang') ?>">Barang</a>
            </li>
            <li class="breadcrumb-item active"><?php echo $title; ?></li>
        </ol>

        <div class="card mb-4">
            <div class="card-header">
                <a href="<?php echo site_url('barang/add') ?>">
                    <i class="fas fa-plus"></i> Add New
                </a>
            </div>

            <?php if ($this->session->flashdata('success')): ?>
                <div class="alert alert-success" role="alert">
                    <?php echo $this->session->flashdata('success'); ?>
                </div>
            <?php endif; ?>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="tabelkelas" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Barkode</th>
                                <th>Name</th>
                                <th>Satuan</th>
                                <th>Kategori</th>
                                <th>Stok</th>
                                <th>Harga Beli</th>
                                <th>Harga Jual</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($barang as $b) {
                                echo "<tr>
                  <td>{$no}</td>
                  <td>{$b->barkode}</td>
                  <td>{$b->name}</td>
                  <td>{$b->satuan}</td>
                  <td>{$b->kategori}</td>
                  <td>{$b->stok}</td>
                  <td>Rp " . number_format($b->harga_beli, 0, ',', '.') . "</td>
                  <td>Rp " . number_format($b->harga_jual, 0, ',', '.') . "</td>
                  <td>
                    <div>
                      <a href='" . base_url('barang/getedit/' . $b->id) . "' class='btn btn-sm btn-info'>
                        <i class='fas fa-edit'></i> Edit
                      </a>
                      <a href='" . base_url('barang/delete/' . $b->id) . "' class='btn btn-sm btn-danger' onclick='return confirm(\"Ingin Menghapus Data Barang Ini?\");'>
                        <i class='fas fa-trash'></i> Hapus
                      </a>
                    </div>
                  </td>
                </tr>";
                                $no++;
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>