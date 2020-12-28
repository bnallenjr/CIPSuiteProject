<?php
$pID = $_GET['pID'];
require_once 'SSRSReport.php';
define("UID", "OPERATIONS\\ballen");

define("PASWD", "Summer18!");

define("SERVICE_URL", "http://192.168.207.97/ReportServer/");
define("REPORT", "/Report Parts/PatchSummaryReport");
$ssrs_report = new SSRSReport(new Credentials(UID, PASWD), SERVICE_URL); 


$executionInfo = $ssrs_report->LoadReport2(REPORT, NULL);
$parameters = array();
$parameters[0] = new ParameterValue();
$parameters[0]->Name = "ReportParameter1";
$parameters[0]->Value = $pID;
$ssrs_report->SetExecutionParameters2($parameters);
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