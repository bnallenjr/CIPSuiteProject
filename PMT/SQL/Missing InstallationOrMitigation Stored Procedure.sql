USE [CIP_Patch_Dev]
GO
/****** Object:  StoredProcedure [dbo].[MissingInstallorMitigationTable]    Script Date: 12/1/2017 7:12:26 AM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
ALTER PROC [dbo].[MissingInstallorMitigationTable]
AS
BEGIN
SET NOCOUNT ON
SELECT DATEDIFF(day, aFinalAssessDate, getdate()), dbo.tbl_Patch_Install.iActualProdDate
FROM dbo.tbl_Patch_Assessment
LEFT JOIN dbo.tbl_Patch_Install ON dbo.tbl_Patch_Assessment.pID=dbo.tbl_Patch_Install.pID
LEFT JOIN dbo.tbl_Patch_Info ON dbo.tbl_Patch_Info.pID=dbo.tbl_Patch_Install.pID
WHERE dbo.tbl_Patch_Assessment.aApplicability = 'Yes' AND DATEDIFF(day, dbo.tbl_Patch_Assessment.aFinalAssessDate, getdate()) >=25 
AND (datalength(dbo.tbl_Patch_Assessment.aFinalAssessor)>0 AND dbo.tbl_Patch_Assessment.aFinalAssessor IS NOT NULL AND dbo.tbl_Patch_Assessment.aFinalAssessor !='')
AND (dbo.tbl_Patch_Install.iMitigationPlan IS NULL OR datalength(dbo.tbl_Patch_Install.iMitigationPlan)=0) 
AND (dbo.tbl_Patch_Install.iActualProdDate = '01-01-1900' OR dbo.tbl_Patch_Install.iActualProdDate IS NULL)
AND (pClassification = 'Security' OR pClassification is Null Or pClassification ='');
IF @@ROWCOUNT>0
BEGIN

DECLARE @tableHTML NVARCHAR(MAX);


SET @tableHTML=
	N'<H1>Patches 25 days from Evaluation without Installation Date or Mitigation Plan</H1>' +
	N'<h4>This is to inform you that there are evaluated patches missing either installation dates or mitigation plans. These evaluations are at or greater than 25 days old and require attention.</h4>' +
	N'<table border ="1">' +
	N'<tr><th>Source</th>' +
	N'<th>Manufacturer</th>' +
	N'<th>PatchID</th>' +
	N'<th>Evaluation Date</th>' +
	N'<th>Installation Date</th>' +
	N'<th>Mitigation Plan?</th>' +
	N'<th>Time Lapse</th></tr>' +
	CAST (( SELECT td = dbo.tbl_Patch_Info.pSource, '',
				   td = dbo.tbl_Patch_Info.pManufacturer, '',
				   td = dbo.tbl_Patch_Info.pPatchID, '',
				   td = dbo.tbl_Patch_Assessment.aFinalAssessDate, '',
				   td = dbo.tbl_Patch_Install.iActualProdDate, '',
				   td = dbo.tbl_Patch_Install.iMitigationPlan, '',
				   td = DATEDIFF(day, aFinalAssessDate, getdate())
			FROM dbo.tbl_Patch_Info
			LEFT JOIN dbo.tbl_Patch_Assessment ON dbo.tbl_Patch_Info.pID=dbo.tbl_Patch_Assessment.pID
			LEFT JOIN dbo.tbl_Patch_Install ON dbo.tbl_Patch_Info.pID=dbo.tbl_Patch_Install.pID
			WHERE dbo.tbl_Patch_Assessment.aApplicability = 'Yes' AND DATEDIFF(day, dbo.tbl_Patch_Assessment.aFinalAssessDate, getdate()) >=25
			AND (datalength(dbo.tbl_Patch_Assessment.aFinalAssessor)>0 AND dbo.tbl_Patch_Assessment.aFinalAssessor IS NOT NULL AND dbo.tbl_Patch_Assessment.aFinalAssessor !='') 
			AND (dbo.tbl_Patch_Install.iMitigationPlan IS NULL OR datalength(dbo.tbl_Patch_Install.iMitigationPlan)=0) 
			AND (dbo.tbl_Patch_Install.iActualProdDate = '01-01-1900' OR dbo.tbl_Patch_Install.iActualProdDate IS NULL)
			AND (pClassification = 'Security' OR pClassification is Null Or pClassification ='')
			FOR XML PATH('tr'), TYPE
		) AS NVARCHAR(MAX))+
		N'</table>' +
		N'<h3>Please copy the link and open in Chrome or Firefox to provide the necessary information. <a href="http://192.168.207.94/Patching3/pages/index.php">Patch Management Tool</a></h3>' +
		N'<h4>If you have any issues, please contact Brian Allen at x7506 or Security Operations for resolution</h4>'  
EXEC msdb.dbo.sp_send_dbmail
			@profile_name = 'Compliance',
			@recipients = 'brianv.allen@gasoc.com; naresh.latchman@gasoc.com; mark.bowman@gasoc.com; leroy.hawkins@gasoc.com; margaret.wilson@gasoc.com; vijay.naik@gasoc.com; estella.wingfield@gasoc.com; sc00041c@gasoc.com; kenyo.reeves@gasoc.com; stephen.brown@gasoc.com; cristian.veres@gasoc.com; te00015c@gasoc.com',
			@body = @tableHTML,
			@Subject = 'Missing Installation Date(s) or Mitigation Plan(s)',
			@body_format = 'HTML';
		END
	END