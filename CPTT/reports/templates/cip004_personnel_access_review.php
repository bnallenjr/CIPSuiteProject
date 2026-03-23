<?php
declare(strict_types=1);

ini_set('display_errors', '1');
error_reporting(E_ALL);

require_once __DIR__ . '/../../vendor/autoload.php';

use Mpdf\Mpdf;

session_start();

$rows = [
    [
        'Tracking_Num' => '1001',
        'FirstName' => 'John',
        'LastName' => 'Doe',
        'Status' => 'Active',
        'Department' => 'Operations',
        'Title' => 'Engineer',
        'Manager' => 'Jane Smith',
        'Last_Individual_Review' => '2026-01-15',
        'Last_Individual_Review_ApprovedBy' => 'Manager A',
        'TerminationDate' => ''
    ],
    [
        'Tracking_Num' => '1002',
        'FirstName' => 'Mary',
        'LastName' => 'Jones',
        'Status' => 'Inactive',
        'Department' => 'Compliance',
        'Title' => 'Analyst',
        'Manager' => 'Robert White',
        'Last_Individual_Review' => '2025-12-01',
        'Last_Individual_Review_ApprovedBy' => 'Manager B',
        'TerminationDate' => '2026-01-10'
    ]
];

$summary = [
    'total_personnel' => count($rows),
    'active_access' => count(array_filter($rows, function ($r) {
        return ($r['Status'] ?? '') === 'Active';
    })),
    'terminated_in_period' => count(array_filter($rows, function ($r) {
        return !empty($r['TerminationDate']);
    })),
    'exceptions' => 0
];

$meta = [
    'generated_at' => date('Y-m-d H:i:s'),
    'generated_by' => $_SESSION['username'] ?? 'system',
    'org_name' => 'Allen Solutions Group / CIP Suite',
    'system_name' => $_GET['system'] ?? 'N/A',
    'period' => ($_GET['start'] ?? '2026-01-01') . ' to ' . ($_GET['end'] ?? date('Y-m-d')),
    'report_id' => 'CIP004-' . date('Ymd-His')
];

$css = file_get_contents(__DIR__ . '/css/pdf.css');

ob_start();
include __DIR__ . '/templates/cip004_personnel_access_review.php';
$html = ob_get_clean();

$mpdf = new Mpdf([
    'mode' => 'utf-8',
    'format' => 'Letter',
    'margin_top' => 22,
    'margin_bottom' => 16,
    'margin_left' => 10,
    'margin_right' => 10,
]);

$mpdf->SetTitle('CIP-004 Personnel Access Review');
$mpdf->SetAuthor('CIP Suite');

$mpdf->SetHTMLHeader('
<div style="font-size:9pt; color:#444;">
    <b>CIP Suite</b> — CIP-004 Personnel Access Review
    <span style="float:right;">' . htmlspecialchars($meta['period'], ENT_QUOTES, 'UTF-8') . '</span>
</div>
<hr style="border:0;border-top:1px solid #ddd;margin-top:6px;" />
');

$mpdf->SetHTMLFooter('
<hr style="border:0;border-top:1px solid #ddd;margin-bottom:6px;" />
<div style="font-size:9pt; color:#444;">
    Report ID: <span style="font-family:monospace;">' . htmlspecialchars($meta['report_id'], ENT_QUOTES, 'UTF-8') . '</span>
    <span style="float:right;">Page {PAGENO} of {nbpg}</span>
</div>
');

$mpdf->WriteHTML($css, \Mpdf\HTMLParserMode::HEADER_CSS);
$mpdf->WriteHTML($html, \Mpdf\HTMLParserMode::HTML_BODY);

$filename = 'CIP-004_Personnel_Access_Review_' . date('Ymd_His') . '.pdf';
$mpdf->Output($filename, 'I');