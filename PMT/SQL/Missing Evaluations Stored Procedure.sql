USE [CIP_Patch_Dev]
GO
/****** Object:  StoredProcedure [dbo].[MissingAssessTable]    Script Date: 12/1/2017 7:11:38 AM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
ALTER PROC [dbo].[MissingAssessTable]
AS
BEGIN
SET NOCOUNT ON
SELECT DATEDIFF(day, pPublicationDate, getdate())
FROM dbo.tbl_Patch_Info
LEFT JOIN dbo.tbl_Patch_Assessment ON dbo.tbl_Patch_Info.pID=dbo.tbl_Patch_Assessment.pID
WHERE DATEDIFF(day, pPublicationDate, getdate()) >= 25 AND (dbo.tbl_Patch_Assessment.aFinalAssessDate IS NULL OR dbo.tbl_Patch_Assessment.aFinalAssessDate='' OR datalength(dbo.tbl_Patch_Assessment.aFinalAssessDate)=0)
AND (pClassification = 'Security' OR pClassification is Null Or pClassification ='');
IF @@ROWCOUNT>0
BEGIN

DECLARE @tableHTML NVARCHAR(MAX);


SET @tableHTML=
	N'<H1>Patches 25 days from Publication without Evaluation</H1>' +
	N'<h4>This is to inform you that there are missing evaluations at or greater than 25 days out from date of publication.</h4>' +
	N'<table border ="1">' +
	N'<tr><th>Source</th>' +
	N'<th>Manufacturer</th>' +
	N'<th>Patch ID</th>' +
	N'<th>Publication Date</th>' +
	N'<th>Time Lapse</th></tr>' +
	CAST (( SELECT td = dbo.tbl_Patch_Info.pSource, '',
				   td = dbo.tbl_Patch_Info.pManufacturer, '',
				   td = dbo.tbl_Patch_Info.pPatchID, '',
				   td = dbo.tbl_Patch_Info.pPublicationDate, '',
				   td = DATEDIFF(day, pPublicationDate, getdate())
			FROM dbo.tbl_Patch_Info
			LEFT JOIN dbo.tbl_Patch_Assessment ON dbo.tbl_Patch_Info.pID=dbo.tbl_Patch_Assessment.pID
			WHERE DATEDIFF(day, pPublicationDate, getdate()) >= 25 AND (dbo.tbl_Patch_Assessment.aFinalAssessDate IS NULL OR dbo.tbl_Patch_Assessment.aFinalAssessDate='' OR datalength(dbo.tbl_Patch_Assessment.aFinalAssessDate)=0)
			AND (pClassification = 'Security' OR pClassification is Null Or pClassification ='')
			FOR XML PATH('tr'), TYPE
		) AS NVARCHAR(MAX))+
		N'</table>' +
		N'<h3>Please copy the link and open in Chrome or Firefox to complete the Evaluations <a href="http://192.168.207.94/Patching3/pages/index.php">Patch Management Tool</a></h3>' +
		N'<h4>If you have any issues, please contact Brian Allen at x7506 or Security Operations for resolution</h4>'
EXEC msdb.dbo.sp_send_dbmail
			@profile_name = 'Compliance',
			@recipients = '',
			@body = @tableHTML,
			@Subject = 'Missing Evaluations 25 Days Old',
			@body_format = 'HTML';
		END
	END
