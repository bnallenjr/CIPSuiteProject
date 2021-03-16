<?php
require_once 'SSRSReport.php';
define("UID", "OPERATIONS\\ballen");

define("PASWD", "!Finalfantasy777!");

define("SERVICE_URL", "http://192.168.207.97/ReportServer/");
define("REPORT", "/Report Parts/ECC-QAR");
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