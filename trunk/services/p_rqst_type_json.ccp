<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\services" secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="True" cachingEnabled="False" cachingDuration="1 minutes" needGeneration="0">
	<Components>
		<Grid id="2" secured="False" sourceType="SQL" returnValueType="Number" connection="ConnSIKP" dataSource="SELECT p_rqst_type_id,code
FROM p_rqst_type
where p_rqst_type_id IN (1,2,3,4,5) " name="SELECT_p_rqst_type_id_cod" pageSizeLimit="100" wizardCaption="List of SELECT P Rqst Type Id,code
 FROM P Rqst Type
where P Rqst Type Id IN (1,2,3,4,5) " wizardAllowInsert="False">
			<Components>
				<Label id="95" fieldSourceType="DBColumn" dataType="Float" html="False" name="p_rqst_type_id" fieldSource="p_rqst_type_id">
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
				<JoinTable id="97" tableName="SELECT" alias="p_rqst_type_id" posWidth="20" posHeight="40" posLeft="10" posTop="10"/>
<JoinTable id="98" tableName="codeFROM" alias="p_rqst_typewhere p_rqst_type_id IN (1" posWidth="20" posHeight="40" posLeft="51" posTop="10"/>
<JoinTable id="99" tableName="2" posWidth="20" posHeight="40" posLeft="92" posTop="10"/>
<JoinTable id="100" tableName="3" posWidth="20" posHeight="40" posLeft="133" posTop="10"/>
<JoinTable id="101" tableName="4" posWidth="20" posHeight="40" posLeft="174" posTop="10"/>
<JoinTable id="102" tableName="5)" posWidth="20" posHeight="40" posLeft="215" posTop="10"/>
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
		<CodeFile id="Code" language="PHPTemplates" name="p_rqst_type_json.php" forShow="True" url="p_rqst_type_json.php" comment="//" codePage="windows-1252"/>
	</CodeFiles>
	<SecurityGroups/>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events/>
</Page>
