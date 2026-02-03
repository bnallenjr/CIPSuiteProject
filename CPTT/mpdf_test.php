<?php
declare(strict_types=1);

ini_set('display_errors', '1');
error_reporting(E_ALL);

require_once __DIR__ . '/vendor/autoload.php'; // adjust if your vendor folder is elsewhere

$mpdf = new \Mpdf\Mpdf([
    'format' => 'Letter',
    'margin_top' => 20,
    'margin_bottom' => 15,
    'margin_left' => 10,
    'margin_right' => 10,
]);

$mpdf->SetTitle('CIP Suite PDF Test');
$mpdf->SetHTMLHeader('<div style="font-size:10pt;"><b>CIP Suite</b> — PDF Test</div><hr />');
$mpdf->SetHTMLFooter('<hr /><div style="font-size:9pt;">Page {PAGENO} of {nbpg}</div>');

$mpdf->WriteHTML('<h1>mPDF is working</h1><p>If you can read this, your PDF pipeline is good.</p>');
$mpdf->Output('mpdf_test.pdf', 'I');
