<?php
@session_start();
?>
<?php
$TicketNum = $_POST['TicketNum'];
$Source = $_POST['Source'];
$ChecklistID = $_POST['ChecklistID'];
require_once 'SSRSReport.php';
define("UID", "OPERATIONS\\ballen");

define("PASWD", "Summer18!");

define("SERVICE_URL", "http://192.168.207.97/ReportServer/");
define("REPORT", "/Report Parts/PatchingChecklist");
$ssrs_report = new SSRSReport(new Credentials(UID, PASWD), SERVICE_URL); 


$executionInfo = $ssrs_report->LoadReport2(REPORT, NULL);
$parameters = array();
$parameters[0] = new ParameterValue();
$parameters[0]->Name = "TicketNum";
$parameters[0]->Value = $TicketNum;
$parameters[1] = new ParameterValue();
$parameters[1]->Name = "Source";
$parameters[1]->Value = $Source;
$parameters[2] = new ParameterValue();
$parameters[2]->Name = "ChecklistID";
$parameters[2]->Value = $ChecklistID;
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