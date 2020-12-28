<?php
@session_start();
?>
<?php
$pstartdate=$_POST['pstartdate'];
$penddate=$_POST['penddate'];
require_once 'SSRSReport.php';
define("UID", "OPERATIONS\\ballen");

define("PASWD", "Summer18!");

define("SERVICE_URL", "http://192.168.207.97/ReportServer/");
define("REPORT", "/Report Parts/PatchPublishedReport");

$ssrs_report = new SSRSReport(new Credentials(UID, PASWD), SERVICE_URL);

$executionInfo = $ssrs_report->LoadReport2(REPORT, NULL);
$parameters = array();
$parameters[0] = new ParameterValue();
$parameters[0]->Name = "StartDate";
$parameters[0]->Value = $pstartdate; 
$parameters[1] = new ParameterValue();
$parameters[1]->Name = "EndDate";
$parameters[1]->Value = $penddate;
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