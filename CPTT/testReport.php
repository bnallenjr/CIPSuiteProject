<?php
/**
 * SSRS local render example (PDF)
 * - Expects SSRS in Native Mode with URLs:
 *     http://localhost/ReportServer    (Web Service)
 *     http://localhost/Reports         (Web Portal)
 * - Give the account below at least "Browser" role on the target folder/report.
 */

require_once __DIR__ . '/SSRSReport.php';

/* ── Configure via environment variables (recommended) ────────────────
   In Windows (PowerShell):
     [System.Environment]::SetEnvironmentVariable("SSRS_URL","http://localhost/ReportServer", "User")
     [System.Environment]::SetEnvironmentVariable("SSRS_REPORT","/CIPSuite/ECC-QAR", "User")
     [System.Environment]::SetEnvironmentVariable("SSRS_UID",".\\yourLocalUser", "User")
     [System.Environment]::SetEnvironmentVariable("SSRS_PASWD","yourPassword", "User")
*/

$SERVICE_URL = getenv('SSRS_URL')    ?: 'http://localhost/ReportServer';
$REPORT_PATH = getenv('SSRS_REPORT') ?: '/testReport';   // adjust to your folder/name
$UID         = getenv('SSRS_UID')    ?: '.\asgdb-admin';    // e.g., ".\brian" or "MYDOMAIN\brian"
$PASWD       = getenv('SSRS_PASWD')  ?: '!FinalFantasy777!';

// Build client
$credentials = new Credentials($UID, $PASWD);
$ssrs        = new SSRSReport($credentials, rtrim($SERVICE_URL, '/').'/');

try {
    // Load report and render as PDF
    $ssrs->LoadReport2($REPORT_PATH, null);

    // (Optional) set parameter values if your report expects them:
    // $ssrs->SetExecutionParameters2([ new ParameterValue('ParamName', 'ParamValue') ], 'en-us');

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
    http_response_code(500);
    header('Content-Type: text/plain');
    echo "SSRS render failed:\n".$e->getMessage();
}
