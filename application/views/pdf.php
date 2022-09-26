<?php
	$nama_dokumen = 'PDF' . date("YmdHis");	
	require_once __DIR__ . '/vendor/autoload.php';

	$mpdf = new \Mpdf\Mpdf();
	ob_start();
	
	$header	= "";
	$judul_pdf = "Riona Cetak PDF";
	//$mpdf->useGraphs = true;
	$footer = '<table cellpadding=0 cellspacing=0 style="border:none;font-size:10px;" width="100%">
           <tr><td style="margin-right:-5px;border:none;" align="left">
           <i>Dicetak: ' . date("d/m/Y H:i") . ' melalui '.base_url().'</i></td>
           <td style="margin-right:-5px;border:none;" align="right">
           Halaman: {PAGENO} / {nb}</td></tr></table>';
	$menu	= $this->uri->segment(3);
	
	if($menu == "antrian"){
		include "cetak/antrian.php";
		$posisi = "A4-P";
	}
	
	else{
		echo "Tidak ada data untuk dicetak??";
		$posisi = "A4-P";
	}

	$html = ob_get_contents();
	ob_end_clean();
	//$mpdf = new mPDF('utf-8', $posisi, 9, 'arial');
	//$mpdf = new \Mpdf\Mpdf('utf-8', $posisi, 9, 'arial');
	
	$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => $posisi]);
	$mpdf->SetTitle($judul_pdf);
	//~ $mpdf->SetProtection(array(), '111', '111');
	$mpdf->setHTMLHeader($header);
	//~ $mpdf->WriteHTML("");
	//~ $mpdf->SetHTMLHeader("");
	$mpdf->setHTMLFooter($footer);
	$mpdf->WriteHTML($html);
	//$mpdf->debug = true;
	$mpdf->SetProtection(array('copy','print'), '', 'rokaniauniversity');
	//~ $mpdf->SetProtection(array());
	$mpdf->Output($nama_dokumen . ".pdf", 'I');
	exit;

?>
