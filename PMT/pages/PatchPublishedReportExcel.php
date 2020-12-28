<?php
$pstartdate=$_POST['pstartdate'];
$penddate=$_POST['penddate'];
require_once 'SSRSReport.php';
define("UID", "OPERATIONS\\ballen");

define("PASWD", "Summer18!");

define("SERVICE_URL", "http://192.168.207.97/ReportServer/");
define("REPORT", "/Report Parts/patchpublishedreport");
$ssrs_report = new SSRSReport(new Credentials(UID, PASWD), SERVICE_URL);

$ssrs_report->LoadReport2(REPORT, NULL);
$parameters = array();
$parameters[0] = new ParameterValue();
$parameters[0]->Name = "StartDate";
$parameters[0]->Value = $pstartdate;; 
$parameters[1] = new ParameterValue();
$parameters[1]->Name = "EndDate";
$parameters[1]->Value = $penddate;
$ssrs_report->SetExecutionParameters2($parameters);
				$renderAsEXCEL = new RenderAsEXCEL(); 
$result_EXCEL = $ssrs_report->Render2($renderAsEXCEL, 
                              PageCountModeEnum::$Estimate, 
                              $Extension, 
                              $MimeType, 
                              $Encoding, 
                              $Warnings, 
                              $StreamIds);

$handle = fopen("C:\\Users\\Public\\Downloads\\" . "PatchPublicationReport.xls", 'wb'); 
fwrite($handle, $result_EXCEL); 
fclose($handle);

header("Location: DownloadExcel/PatchPublicationReport.xls")
/*
header("Content-Type: application/force-download");
header("Content-Disposition: attachment; filename=\"report.xls\"");
header("Content-length: ".(string)(strlen($result_EXCEL)));
header("Expires: ".gmdate("D, d M Y H:i:s", mktime(date("H")+2, date("i"),date("s"),date("m"), date("d"),date("Y")))." GMT");
header("Last-Modified: ".gmdate("D, d M Y H:i:s")." GMT");
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");*/
?>