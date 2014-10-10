<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\services" secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="True" cachingEnabled="False" cachingDuration="1 minutes" needGeneration="0">
	<Components>
		<Grid id="2" secured="False" sourceType="Table" returnValueType="Number" defaultPageSize="10" connection="ConnSIKP" dataSource="SELECT * 
FROM p_private_question" name="SELECT_FROM_p_private_que" pageSizeLimit="100" wizardCaption="List of SELECT * 
 FROM P Private Question " wizardAllowInsert="False">
<Components>
<Label id="62" fieldSourceType="DBColumn" dataType="Float" html="False" name="p_private_question_id" fieldSource="p_private_question_id">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="63" fieldSourceType="DBColumn" dataType="Text" html="False" name="description" fieldSource="description">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="64" fieldSourceType="DBColumn" dataType="Text" html="False" name="page_output" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="private_questionSELECT_FROM_p_private_quepage_output" fieldSource="label">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="65" fieldSourceType="DBColumn" dataType="Text" html="False" name="total_page" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="private_questionSELECT_FROM_p_private_quetotal_page" fieldSource="total_page">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="66" fieldSourceType="DBColumn" dataType="Text" html="False" name="total_records" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="private_questionSELECT_FROM_p_private_quetotal_records" fieldSource="total_records">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
</Components>
<Events/>
<TableParameters/>
<JoinTables>
<JoinTable id="61" tableName="p_app_user" schemaName="sikp" posLeft="10" posTop="10" posWidth="133" posHeight="180"/>
</JoinTables>
<JoinLinks/>
<Fields/>
<SPParameters/>
<SQLParameters/>
<SecurityGroups/>
<Attributes/>
<Features/>
</Grid>
</Components>
	<CodeFiles>
		<CodeFile id="Code" language="PHPTemplates" name="private_question.php" forShow="True" url="private_question.php" comment="//" codePage="windows-1252"/>
</CodeFiles>
	<SecurityGroups/>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events/>
</Page>
