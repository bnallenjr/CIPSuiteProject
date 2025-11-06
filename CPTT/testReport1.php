<?php
require_once 'SSRSReport.php';
define("UID", "asgdb-admin");

define("PASWD", "!FinalFantasy777!");

define("SERVICE_URL", "http://localhost/ReportServer/");
define("REPORT", "/Report Parts/testReport1");
$ssrs_report = new SSRSReport(new Credentials(UID, PASWD), SERVICE_URL); 

$ssrs_report->LoadReport2(REPORT, NULL);
				$renderAsPDF = new RenderAsPDF();
				$result_PDF = $ssrs_report->Render2($renderAsPDF,
											PageCountModeEnum::$Estimate,
											$Extension,
											$MimeType,
											$Encoding,
											$Warnings,
											$StreamIds);

				header('Content-type: application/pdf');
				echo $result_PDF;
?>