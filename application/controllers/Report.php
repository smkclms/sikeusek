<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('Expenditure_model');
        $this->load->model('User_model');
    }

    public function index() {
        $data['users'] = $this->User_model->get_all_users();
        $this->load->view('report_view', $data);
    }

    public function generate() {
    $year = $this->input->post('year');
    $month = $this->input->post('month');
    $data['monthly_expenditure'] = [];

    foreach ($this->User_model->get_all_users() as $user) {
        if (!in_array(strtolower($user->role), ['bendahara', 'superadmin'])) {
            $data['monthly_expenditure'][$user->nama_lengkap] =
                $this->Expenditure_model->get_monthly_expenditure($year, $month, $user->id);
        }
    }

    $data['year'] = $year;
    $data['month'] = $month;
    $this->load->view('monthly_report', $data);
}
public function pdf() {
    $this->load->library('tcpdf');

    $year = $this->input->post('year');
    $month = $this->input->post('month');

    $data['monthly_expenditure'] = [];
    foreach ($this->User_model->get_all_users() as $user) {
        if (!in_array(strtolower($user->role), ['bendahara', 'superadmin'])) {
            $data['monthly_expenditure'][$user->nama_lengkap] =
                $this->Expenditure_model->get_monthly_expenditure($year, $month, $user->id);
        }
    }

    // Mulai TCPDF
    $pdf = new TCPDF();
    $pdf->AddPage();
    $html = '<h2>Laporan Pengeluaran Bulan ' . date('F', mktime(0, 0, 0, $month, 1)) . ' ' . $year . '</h2>';
    $html .= '<table border="1" cellpadding="4"><tr><th>Nama</th><th>Pengeluaran</th></tr>';
    foreach ($data['monthly_expenditure'] as $nama => $total) {
        $html .= "<tr><td>$nama</td><td>Rp " . number_format($total, 0, ',', '.') . "</td></tr>";
    }
    $html .= '</table>';

    $pdf->writeHTML($html, true, false, true, false, '');
    $pdf->Output('laporan_pengeluaran.pdf', 'I');
}
public function excel() {
    $this->load->library('PHPExcel'); // atau library_excel Anda

    $year = $this->input->post('year');
    $month = $this->input->post('month');

    $excel = new PHPExcel();
    $excel->setActiveSheetIndex(0)->setCellValue('A1', 'Nama Pengguna')
                                   ->setCellValue('B1', 'Total Pengeluaran');

    $row = 2;
    foreach ($this->User_model->get_all_users() as $user) {
        if (!in_array(strtolower($user->role), ['bendahara', 'superadmin'])) {
            $total = $this->Expenditure_model->get_monthly_expenditure($year, $month, $user->id);
            $excel->setActiveSheetIndex(0)->setCellValue("A$row", $user->nama_lengkap)
                                           ->setCellValue("B$row", $total);
            $row++;
        }
    }

    // Output ke browser
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="laporan_pengeluaran.xls"');
    header('Cache-Control: max-age=0');

    $writer = PHPExcel_IOFactory::createWriter($excel, 'Excel5');
    $writer->save('php://output');
}

}
?>
