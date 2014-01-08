<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\services" secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="True" cachingEnabled="False" cachingDuration="1 minutes" needGeneration="0">
	<Components>
		<Grid id="2" secured="False" sourceType="Table" returnValueType="Number" defaultPageSize="10" connection="ConnSIKP" dataSource="chatting" name="chatting" pageSizeLimit="100" wizardCaption="List of Chatting " wizardAllowInsert="False">
<Components>
<Label id="321" fieldSourceType="DBColumn" dataType="Text" html="False" name="user_id" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="session_checkchattinguser_id" fieldSource="user_id">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
</Components>
<Events/>
<TableParameters/>
<JoinTables>
<JoinTable id="315" tableName="chatting" schemaName="sikp" posLeft="10" posTop="10" posWidth="95" posHeight="136"/>
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
		<CodeFile id="Code" language="PHPTemplates" name="session_check.php" forShow="True" url="session_check.php" comment="//" codePage="windows-1252"/>
</CodeFiles>
	<SecurityGroups/>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events/>
</Page>
