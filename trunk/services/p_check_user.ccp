<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\services" secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="True" cachingEnabled="False" cachingDuration="1 minutes" needGeneration="0">
	<Components>
		<Grid id="2" secured="False" sourceType="SQL" returnValueType="Number" defaultPageSize="10" connection="ConnSIKP" dataSource="select * from t_vat_registration where wp_user_name = '{user_name}'" name="p_check_user_grid" pageSizeLimit="100" wizardCaption="List of SELECT P Rqst Type Id,code
 FROM P Rqst Type
where P Rqst Type Id IN (1,2,3,4,5) " wizardAllowInsert="False" activeCollection="SQLParameters" parameterTypeListName="ParameterTypeList">
			<Components>
				<Label id="95" fieldSourceType="DBColumn" dataType="Text" html="False" name="app_user_name" fieldSource="app_user_name">
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
			<SQLParameters>
				<SQLParameter id="97" variable="user_name" parameterType="Form" dataType="Text" parameterSource="user_name" defaultValue="0"/>
			</SQLParameters>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Grid>
	</Components>
	<CodeFiles>
		<CodeFile id="Code" language="PHPTemplates" name="p_check_user.php" forShow="True" url="p_check_user.php" comment="//" codePage="windows-1252"/>
	</CodeFiles>
	<SecurityGroups/>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events/>
</Page>
