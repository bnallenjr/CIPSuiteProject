USE [CIP_Patch_Dev]
GO
/****** Object:  StoredProcedure [dbo].[recentlyAssessedPatches]    Script Date: 12/1/2017 7:12:43 AM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
ALTER PROCEDURE [dbo].[recentlyAssessedPatches]
AS
BEGIN
SET NOCOUNT ON
SELECT dbo.tbl_Patch_Info.pID, dbo.tbl_Patch_Info.pSource, dbo.tbl_Patch_Info.pManufacturer, CONVERT (varchar, dbo.tbl_Patch_Info.pPublicationDate) AS PublicationDate,
dbo.tbl_Patch_Info.pPatchID, CONVERT (varchar, dbo.tbl_Patch_Assessment.aAssessDate, 110) AS SMEReviewDate,
CONVERT (varchar, dbo.tbl_Patch_Install.iActualTestDate, 110) AS InstallationDate, dbo.tbl_Patch_Assessment.aServiceRequestNum, dbo.tbl_Patch_Install.iMitigationPlan,
dbo.tbl_Patch_Assessment.aFinalAssessor, dbo.tbl_Patch_Assessment.aFinalAssessDate, DATEDIFF(day, dbo.tbl_Patch_Info.pPublicationDate, getdate()) AS DiffDate
FROM dbo.tbl_Patch_Info
LEFT JOIN dbo.tbl_Patch_Assessment ON dbo.tbl_Patch_Info.pID=dbo.tbl_Patch_Assessment.pID
LEFT JOIN dbo.tbl_Patch_Install ON dbo.tbl_Patch_Info.pID=dbo.tbl_Patch_Install.pID
WHERE dbo.tbl_Patch_Assessment.aApplicability = 'Yes' AND CAST (dbo.tbl_Patch_Assessment.aFinalAssessDate AS DATE) >= DATEADD(hh, -48, GETDATE())
AND (pClassification = 'Security' OR pClassification is Null Or pClassification ='');
IF @@ROWCOUNT>0
BEGIN

DECLARE @tableHTML NVARCHAR(MAX);
SET @tableHTML=
	N'<H1>Patches Recently Evaluated</H1>' +
	N'<h4>This is to inform you that the following patches were evaluated by management and can be installed or mitigated.</h4>' +
	N'<table border ="1">' +
	N'<tr><th>Source</th>' +
	N'<th>Manufacturer</th>' +
	N'<th>Patch ID</th>' +
	N'<th>Publication Date</th>' +
	N'<th>Assessor</th>' +
	N'<th>Evaluation Date</th>' +
	N'<th>Installation Date</th>' +
	N'<th>Mitigation Plan Used</th></tr>' +
	CAST (( SELECT td = dbo.tbl_Patch_Info.pSource, '',
				   td = dbo.tbl_Patch_Info.pManufacturer, '',
				   td = dbo.tbl_Patch_Info.pPatchID, '',
				   td = dbo.tbl_Patch_Info.pPublicationDate, '',
				   td = dbo.tbl_Patch_Assessment.aFinalAssessor, '',
				   td = dbo.tbl_Patch_Assessment.aFinalAssessDate, '',
				   td = dbo.tbl_Patch_Install.iActualProdDate, '',
				   td = dbo.tbl_Patch_Install.iMitigationPlan, ''
			FROM dbo.tbl_Patch_Info
			LEFT JOIN dbo.tbl_Patch_Assessment ON dbo.tbl_Patch_Info.pID=dbo.tbl_Patch_Assessment.pID
			LEFT JOIN dbo.tbl_Patch_Install ON dbo.tbl_Patch_Info.pID=dbo.tbl_Patch_Install.pID
			WHERE CAST (dbo.tbl_Patch_Assessment.aFinalAssessDate AS DATE) >= DATEADD(hh, -48, GETDATE()) AND (pClassification = 'Security' OR pClassification is Null Or pClassification ='')
			FOR XML PATH('tr'), TYPE
		) AS NVARCHAR(MAX))+
		N'</table>' +
		N'<h3>Please copy the link and open in Chrome or Firefox to add installation date or mitigation plan <a href="http://192.168.207.94/Patching3/pages/index.php">Patch Management Tool</a></h3>' +
		N'<h4>If you have any issues, please contact Brian Allen at x7506 or CIP Compliance for resolution</h4>'
		EXEC msdb.dbo.sp_send_dbmail
			@profile_name = 'Compliance',
			@recipients = '',
			@body = @tableHTML,
			@Subject = 'Recently Evaluated Patches within the last 48 hours',
			@body_format = 'HTML';
	END
END
