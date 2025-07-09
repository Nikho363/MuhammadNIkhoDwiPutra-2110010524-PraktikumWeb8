<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4"></h1>
        <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="<?php echo site_url('satuan') ?>">Kategori</a></li> 
        <li class="breadcrumb-item active"><?php echo $title ?></li>
        </ol>
            <div class="card mb-4">
                <div class="card-header">
                    <a href="<?php echo site_url('satuan/add') ?>"><i class="fas fa-plus"></i> Add New</a>
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
                        <th>Name</th>
                        <th>Deskripsi</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php
                            $no =1;
                            foreach ($satuan as $s){
                            echo "<tr>
                                <td>$no</td>
                                <td>$s->name</td>
                                <td>$s->deskripsi</td>
                                <td>
                                <div>
                                    <a href=".base_url('satuan/getedit/' . $s->id)." class='btn btn-sm btn-info'><i class='fas fa-edit'></i> Edit</a>
                                    <a href=".base_url('satuan/delete/' . $s->id)." class='btn btn-sm btn-danger'
                                    onclick='return confirm(\"Ingin mengapus data satuan ini?\");'><i class='fas fa-trash'></i> Hapus</a>
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


