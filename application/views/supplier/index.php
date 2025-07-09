<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4"></h1>
        <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="<?php echo site_url('supplier') ?>">Kategori</a></li> 
        <li class="breadcrumb-item active"><?php echo $title ?></li>
        </ol>
            <div class="card mb-4">
                <div class="card-header">
                    <a href="<?php echo site_url('supplier/add') ?>"><i class="fas fa-plus"></i> Add New</a>
                </div>
            <?php if ($this->session->flashdata('success')): ?>
            <div class="alert alert-success" role="alert">
                <?php echo $this->session->flashdata('success'); ?>
            </div>
            <?php endif; ?>
            <div class="card-body">
                <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover" width="100%" cellspacing="0"> <thead>
                    <tr>
                        <th>No.</th>
                        <th>NIK</th>
                        <th>Name</th>
                        <th>Telepon</th>
                        <th>Email</th>
                        <th>Alamat</th>
                        <th>Perusahaan</th>
                        <th>Nama Bank</th>
                        <th>Nama Anak Bank</th>
                        <th>Nomor Akun Bank</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php
                            $no =1;
                            foreach ($supplier as $s){
                            echo "<tr>
                                <td>$no</td>
                                <td>$s->nik</td>
                                <td>$s->name</td>
                                <td>$s->telp</td>
                                <td>$s->email</td>
                                <td>$s->alamat</td>
                                <td>$s->perusahaan</td>
                                <td>$s->nama_bank</td>
                                <td>$s->nama_anak_bank</td>
                                <td>$s->no_akun_bank</td>
                                <td>
                                <div>
                                    <a href=".base_url('supplier/getedit/' . $s->id)." class='btn btn-sm btn-info'><i class='fas fa-edit'></i> Edit</a>
                                    <a href=".base_url('supplier/delete/' . $s->id)." class='btn btn-sm btn-danger'
                                    onclick='return confirm(\"Ingin mengapus data supplier ini?\");'><i class='fas fa-trash'></i> Hapus</a>
                                </div>
                                </td>
                                </tr>";
                            $no++;
                            }?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>


