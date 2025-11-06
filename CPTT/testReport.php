<?php
// --- DEV-ONLY: show errors so 500s become readable on-screen ---
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL & ~E_DEPRECATED);

// Quick sanity: SSRS web service reachable?
// In a browser on this machine, confirm http://localhost/ReportServer loads.

// Load client library
require_once __DIR__ . "\SSRSReport\bin\SSRSReport.php";

// --- REQUIRED: SOAP extension for PHP ---
if (!class_exists('SoapClient')) {
    header('Content-Type: text/plain', true, 500);
    exit("PHP SOAP extension is not enabled. Enable 'extension=soap' in php.ini and restart IIS/PHP.");
}

// --- Config (adjust these) ---
$SERVICE_URL = getenv('SSRS_URL')    ?: 'http://localhost/ReportServer';  // Web Service URL (NOT /Reports)
$REPORT_PATH = getenv('SSRS_REPORT') ?: '/CIPSuite/HelloWorld';                     // Must match SSRS path exactly
// Use either ".\\username" for local account or "MACHINENAME\\username" or "DOMAIN\\username"
$localMachine = gethostname();
$UID  = getenv('SSRS_UID')   ?: $localMachine . '\\asgdb-admin';           // e.g., "MYPC\asgdb-admin" or ".\asgdb-admin"
$PASW = getenv('SSRS_PASWD') ?: '!FinalFantasy777!';

// Small utility to print and exit
function fail($msg, $http=500) {
    http_response_code($http);
    header('Content-Type: text/plain');
    exit($msg);
}

// Validate config basics
if (stripos($SERVICE_URL, '/Reports') !== false) {
    fail("SERVICE_URL must be the Web Service endpoint (e.g., http://localhost/ReportServer), not /Reports.");
}
if ($REPORT_PATH[0] !== '/') {
    fail("REPORT_PATH must start with a leading slash. Example: /CIPSuite/HelloWorld");
}

// Build client + render
try {
    // Build client inside try so constructor errors are caught here
    $credentials = new Credentials($UID, $PASW);
    $ssrs        = new SSRSReport($credentials, rtrim($SERVICE_URL, '/').'/');

    // Sanity ping (optional): Load the catalog to verify auth/URL; comment out if not supported by your SSRSReport.php version
    // $catalogItems = $ssrs->ListChildren("/", true);

    // Load report (confirm this path exists in the SSRS Web Portal)
    $ssrs->LoadReport2($REPORT_PATH, null);

    // If your report has required parameters, set them here:
    // $ssrs->SetExecutionParameters2([ new ParameterValue('ParamName', 'Value') ], 'en-us');

    $renderAsPDF = new RenderAsPDF();
    $result = $ssrs->Render2(
        $renderAsPDF,
        PageCountModeEnum::$Estimate,
        $Extension,
        $MimeType,
        $Encoding,
        $Warnings,
        $StreamIds
    );

    header('Content-Type: application/pdf');
    header('Content-Disposition: inline; filename="report.pdf"');
    echo $result;

} catch (Exception $e) {
    // Bubble up detailed errors so we can fix them
    http_response_code(500);
    header('Content-Type: text/plain');
    echo "SSRS render failed:\n" . $e->getMessage();
}
