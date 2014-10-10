<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\services" secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="True" cachingEnabled="False" cachingDuration="1 minutes" needGeneration="0">
	<Components>
		<Grid id="2" secured="False" sourceType="SQL" returnValueType="Number" connection="ConnSIKP" dataSource="SELECT p_job_position_id,code
FROM p_job_position" name="SELECT_p_rqst_type_id_cod" pageSizeLimit="100" wizardCaption="List of SELECT P Rqst Type Id,code
 FROM P Rqst Type
where P Rqst Type Id IN (1,2,3,4,5) " wizardAllowInsert="False">
			<Components>
				<Label id="95" fieldSourceType="DBColumn" dataType="Float" html="False" name="p_job_position_id" fieldSource="p_job_position_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="96" fieldSourceType="DBColumn" dataType="Text" html="False" name="code" fieldSource="code">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
			</Components>
			<Events/>
			<TableParameters/>
			<JoinTables>
			</JoinTables>
			<JoinLinks/>
			<Fields>
				<Field id="94" fieldName="*"/>
			</Fields>
			<SPParameters/>
			<SQLParameters/>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Grid>
	</Components>
	<CodeFiles>
		<CodeFile id="Code" language="PHPTemplates" name="p_job_position.php" forShow="True" url="p_job_position.php" comment="//" codePage="windows-1252"/>
	</CodeFiles>
	<SecurityGroups/>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events/>
</Page>
