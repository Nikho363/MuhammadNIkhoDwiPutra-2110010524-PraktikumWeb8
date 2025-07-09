<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Report extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('pdf');
    }

    public function kustomerlap()
    {
        $pdf = new FPDF('P', 'mm', 'A4');
        $pdf->AddPage();

        // Panggil header
        require_once APPPATH . 'views/report_header_only.php';
        $pdf->SetY(45);

        // Judul laporan
        $pdf->SetFont('Times', 'B', 14);
        $pdf->Cell(0, 8, 'Laporan Data Kustomer', 0, 1, 'C');
        $pdf->Ln(5);

        // Header tabel
        $pdf->SetFont('Times', 'B', 10);
        $pdf->SetFillColor(230, 230, 230);
        $pdf->SetTextColor(0);
        $pdf->SetDrawColor(100, 100, 100);
        $pdf->SetLineWidth(0.2);

        $pdf->Cell(10, 9, 'NO', 1, 0, 'C', true);
        $pdf->Cell(35, 9, 'NIK', 1, 0, 'C', true);
        $pdf->Cell(50, 9, 'NAMA KUSTOMER', 1, 0, 'C', true);
        $pdf->Cell(35, 9, 'TELP', 1, 0, 'C', true);
        $pdf->Cell(60, 9, 'ALAMAT', 1, 1, 'C', true);

        // Data isi tabel
        $pdf->SetFont('Times', '', 9);
        $data = $this->db->get('kustomer')->result_array();
        $i = 1;

        foreach ($data as $index => $d) {
            $isEven = $index % 2 === 0;
            $pdf->SetFillColor($isEven ? 255 : 245, 255, 245);
            $fill = true;

            $pdf->Cell(10, 8, $i++, 1, 0, 'C', $fill);
            $pdf->Cell(35, 8, substr($d['nik'], 0, 20), 1, 0, 'L', $fill);
            $pdf->Cell(50, 8, substr($d['name'], 0, 25), 1, 0, 'L', $fill);
            $pdf->Cell(35, 8, $d['telp'], 1, 0, 'C', $fill);
            $pdf->Cell(60, 8, substr($d['alamat'], 0, 40), 1, 1, 'L', $fill);
        }

        // Footer (opsional)
        $pdf->Ln(5);
        $pdf->SetFont('Times', 'I', 9);
        $pdf->Cell(0, 10, 'Dicetak pada: ' . date('d-m-Y'), 0, 0, 'R');

        $pdf->Output('Laporan_Data_Kustomer.pdf', 'I');
    }

    public function penjualanlap()
    {
        $tgl_awal = $this->input->get('tgl_awal');
        $tgl_akhir = $this->input->get('tgl_akhir');

        $pdf = new FPDF('P', 'mm', 'A4');
        $pdf->AddPage();

        require_once APPPATH . 'views/report_header_only.php';
        $pdf->SetY(45);

        // Judul
        $pdf->SetFont('Times', 'B', 14);
        $pdf->Cell(0, 8, 'Laporan Data Penjualan', 0, 1, 'C');
        $pdf->Ln(5);

        // Header tabel
        $pdf->SetFont('Times', 'B', 10);
        $pdf->SetFillColor(230, 230, 230);
        $pdf->SetTextColor(0);
        $pdf->SetDrawColor(100, 100, 100);
        $pdf->SetLineWidth(0.2);

        $pdf->Cell(10, 9, 'NO', 1, 0, 'C', true);
        $pdf->Cell(20, 9, 'INVOICE', 1, 0, 'C', true);
        $pdf->Cell(20, 9, 'TOTAL', 1, 0, 'C', true);
        $pdf->Cell(25, 9, 'BAYAR', 1, 0, 'C', true);
        $pdf->Cell(25, 9, 'KEMBALI', 1, 0, 'C', true);
        $pdf->Cell(25, 9, 'TANGGAL', 1, 0, 'C', true);
        $pdf->Cell(35, 9, 'KUSTOMER', 1, 0, 'C', true);
        $pdf->Cell(30, 9, 'USER', 1, 1, 'C', true);

        // Ambil data
        $this->db->select('penjualan.*, kustomer.name AS nama_kustomer, user.full_name AS nama_user');
        $this->db->from('penjualan');
        $this->db->join('kustomer', 'kustomer.id = penjualan.kustomer_id', 'left');
        $this->db->join('user', 'user.id = penjualan.user_id', 'left');

        if ($tgl_awal && $tgl_akhir) {
            $this->db->where('penjualan.tanggal >=', $tgl_awal);
            $this->db->where('penjualan.tanggal <=', $tgl_akhir);
        }

        $data = $this->db->get()->result_array();
        $i = 1;

        $pdf->SetFont('Times', '', 9);

        foreach ($data as $index => $d) {
            // Zebra striping
            $isEven = $index % 2 === 0;
            $pdf->SetFillColor($isEven ? 255 : 245, 255, 245);
            $fill = $isEven;

            $pdf->Cell(10, 8, $i++, 1, 0, 'C', $fill);
            $pdf->Cell(20, 8, $d['invoice'], 1, 0, 'C', $fill);
            $pdf->Cell(20, 8, number_format($d['total']), 1, 0, 'C', $fill);
            $pdf->Cell(25, 8, number_format($d['bayar']), 1, 0, 'C', $fill);
            $pdf->Cell(25, 8, number_format($d['kembali']), 1, 0, 'C', $fill);
            $pdf->Cell(25, 8, date('d-m-Y', strtotime($d['tanggal'])), 1, 0, 'C', $fill);
            $pdf->Cell(35, 8, substr($d['nama_kustomer'], 0, 25), 1, 0, 'C', $fill);
            $pdf->Cell(30, 8, substr($d['nama_user'], 0, 25), 1, 1, 'C', $fill);
        }

        // Footer
        $pdf->Ln(5);
        $pdf->SetFont('Times', 'I', 9);
        $pdf->Cell(0, 10, 'Dicetak pada: ' . date('d-m-Y'), 0, 0, 'R');
        $pdf->Output('Laporan_Data_Penjualan.pdf', 'I');
    }

    public function pembelianlap()
    {
        $tgl_awal = $this->input->get('tgl_awal');
        $tgl_akhir = $this->input->get('tgl_akhir');

        $pdf = new FPDF('P', 'mm', 'A4');
        $pdf->AddPage();

        // Header
        require_once APPPATH . 'views/report_header_only.php';
        $pdf->SetY(45);
        $pdf->SetFont('Times', 'B', 14);
        $pdf->Cell(0, 8, 'Laporan Data Pembelian', 0, 1, 'C');
        $pdf->Ln(5);

        // Header tabel
        $pdf->SetFont('Times', 'B', 10);
        $pdf->SetFillColor(230, 230, 230);
        $pdf->SetTextColor(0);
        $pdf->SetDrawColor(100, 100, 100);
        $pdf->SetLineWidth(0.2);

        $pdf->Cell(10, 9, 'NO', 1, 0, 'C', true);
        $pdf->Cell(20, 9, 'INVOICE', 1, 0, 'C', true);
        $pdf->Cell(20, 9, 'TOTAL', 1, 0, 'C', true);
        $pdf->Cell(25, 9, 'BAYAR', 1, 0, 'C', true);
        $pdf->Cell(30, 9, 'DESKRIPSI', 1, 0, 'C', true);
        $pdf->Cell(25, 9, 'TANGGAL', 1, 0, 'C', true);
        $pdf->Cell(30, 9, 'SUPPLIER', 1, 0, 'C', true);
        $pdf->Cell(30, 9, 'USER', 1, 1, 'C', true);

        // Ambil data pembelian
        $this->db->select('pembelian.*, supplier.name AS nama_supplier, user.full_name AS nama_user');
        $this->db->from('pembelian');
        $this->db->join('supplier', 'supplier.id = pembelian.supplier_id', 'left');
        $this->db->join('user', 'user.id = pembelian.user_id', 'left');

        if ($tgl_awal && $tgl_akhir) {
            $this->db->where('pembelian.tanggal >=', $tgl_awal);
            $this->db->where('pembelian.tanggal <=', $tgl_akhir);
        }

        $data = $this->db->get()->result_array();
        $pdf->SetFont('Times', '', 9);
        $i = 1;

        foreach ($data as $index => $d) {
            $isEven = $index % 2 === 0;
            $pdf->SetFillColor($isEven ? 255 : 245, 255, 245);
            $fill = $isEven;

            $pdf->Cell(10, 8, $i++, 1, 0, 'C', $fill);
            $pdf->Cell(20, 8, $d['invoice'], 1, 0, 'C', $fill);
            $pdf->Cell(20, 8, number_format($d['total']), 1, 0, 'C', $fill);
            $pdf->Cell(25, 8, number_format($d['bayar']), 1, 0, 'C', $fill);
            $pdf->Cell(30, 8, substr($d['deskripsi'], 0, 25), 1, 0, 'C', $fill);
            $pdf->Cell(25, 8, date('d-m-Y', strtotime($d['tanggal'])), 1, 0, 'C', $fill);
            $pdf->Cell(30, 8, substr($d['nama_supplier'], 0, 20), 1, 0, 'C', $fill);
            $pdf->Cell(30, 8, substr($d['nama_user'], 0, 20), 1, 1, 'C', $fill);
        }

        $pdf->Ln(5);
        $pdf->SetFont('Times', 'I', 9);
        $pdf->Cell(0, 10, 'Dicetak pada: ' . date('d-m-Y H:i'), 0, 0, 'R');
        $pdf->Output('Laporan_Data_Pembelian.pdf', 'I');
    }

    public function baranglap()
    {
        $tgl_awal = $this->input->get('tgl_awal');
        $tgl_akhir = $this->input->get('tgl_akhir');

        $pdf = new FPDF('P', 'mm', 'A4');
        $pdf->AddPage();

        // Header
        require_once APPPATH . 'views/report_header_only.php';
        $pdf->SetY(45);
        $pdf->SetFont('Times', 'B', 14);
        $pdf->Cell(0, 8, 'Laporan Data Barang', 0, 1, 'C');
        $pdf->Ln(5);

        // Header tabel
        $pdf->SetFont('Times', 'B', 10);
        $pdf->SetFillColor(230, 230, 230);
        $pdf->SetTextColor(0);
        $pdf->SetDrawColor(100, 100, 100);
        $pdf->SetLineWidth(0.2);

        // Lebar kolom disesuaikan agar total tetap 190mm (untuk A4 Portrait)
        $pdf->Cell(8, 9, 'NO', 1, 0, 'C', true);
        $pdf->Cell(18, 9, 'BARKODE', 1, 0, 'C', true);
        $pdf->Cell(28, 9, 'NAMA BARANG', 1, 0, 'C', true);
        $pdf->Cell(18, 9, 'JUAL', 1, 0, 'C', true);
        $pdf->Cell(18, 9, 'BELI', 1, 0, 'C', true);
        $pdf->Cell(10, 9, 'STK', 1, 0, 'C', true);
        $pdf->Cell(20, 9, 'KATEGORI', 1, 0, 'C', true);
        $pdf->Cell(20, 9, 'SATUAN', 1, 0, 'C', true);
        $pdf->Cell(25, 9, 'SUPPLIER', 1, 0, 'C', true);
        $pdf->Cell(25, 9, 'USER', 1, 1, 'C', true);

        // Ambil data
        $this->db->select('barang.*, kategori.name AS nama_kategori, satuan.name AS nama_satuan, 
                       supplier.name AS nama_supplier, user.full_name AS nama_user');
        $this->db->from('barang');
        $this->db->join('kategori', 'kategori.id = barang.kategori_id', 'left');
        $this->db->join('satuan', 'satuan.id = barang.satuan_id', 'left');
        $this->db->join('supplier', 'supplier.id = barang.supplier_id', 'left');
        $this->db->join('user', 'user.id = barang.user_id', 'left');

        if ($tgl_awal && $tgl_akhir) {
            $this->db->where('barang.created_at >=', $tgl_awal);
            $this->db->where('barang.created_at <=', $tgl_akhir);
        }

        $data = $this->db->get()->result_array();
        $pdf->SetFont('Times', '', 9);
        $i = 1;

        foreach ($data as $index => $d) {
            $isEven = $index % 2 === 0;
            $pdf->SetFillColor($isEven ? 255 : 245, 255, 245);
            $fill = $isEven;

            $pdf->Cell(8, 8, $i++, 1, 0, 'C', $fill);
            $pdf->Cell(18, 8, $d['barkode'], 1, 0, 'C', $fill);
            $pdf->Cell(28, 8, substr($d['name'], 0, 20), 1, 0, 'C', $fill);
            $pdf->Cell(18, 8, number_format($d['harga_jual']), 1, 0, 'C', $fill);
            $pdf->Cell(18, 8, number_format($d['harga_beli']), 1, 0, 'C', $fill);
            $pdf->Cell(10, 8, $d['stok'], 1, 0, 'C', $fill);
            $pdf->Cell(20, 8, substr($d['nama_kategori'], 0, 15), 1, 0, 'C', $fill);
            $pdf->Cell(20, 8, substr($d['nama_satuan'], 0, 15), 1, 0, 'C', $fill);
            $pdf->Cell(25, 8, substr($d['nama_supplier'], 0, 20), 1, 0, 'C', $fill);
            $pdf->Cell(25, 8, substr($d['nama_user'], 0, 20), 1, 1, 'C', $fill);
        }

        $pdf->Ln(5);
        $pdf->SetFont('Times', 'I', 9);
        $pdf->Cell(0, 10, 'Dicetak pada: ' . date('d-m-Y H:i'), 0, 0, 'R');
        $pdf->Output('Laporan_Data_barang.pdf', 'I');
    }
}