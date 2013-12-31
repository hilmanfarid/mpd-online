<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\services" secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="True" cachingEnabled="False" cachingDuration="1 minutes" needGeneration="0">
	<Components>
		<Grid id="2" secured="False" sourceType="SQL" returnValueType="Number" defaultPageSize="10" connection="ConnSIKP" dataSource="select CASE WHEN cust_account.p_account_status_id = 1 THEN 'Aktif' ELSE 'Tidak Aktif' END as status,
count(*) from t_cust_account cust_account group by cust_account.p_account_status_id
ORDER BY status" name="select_CASE_WHEN_cust_acc" orderBy="status" pageSizeLimit="100" wizardCaption="List of Select CASE WHEN Cust Account P Account Status Id = 1 THEN ' Aktif' ELSE ' Tidak Aktif' END As Status,count(*) From T Cust Account Cust Account Group By Cust Account P Account Status Id " wizardAllowInsert="False">
<Components>
<Label id="69" fieldSourceType="DBColumn" dataType="Memo" html="False" name="status" fieldSource="status">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="70" fieldSourceType="DBColumn" dataType="Integer" html="False" name="count" fieldSource="count">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
</Components>
<Events/>
<TableParameters/>
<JoinTables>
<JoinTable id="71" tableName="select" alias="CASE WHEN cust_account.p_account_status_id = 1 THEN 'Aktif' ELSE 'Tidak Aktif' END as status" posLeft="10" posTop="10" posWidth="20" posHeight="40"/>
<JoinTable id="72" tableName="count(*)" alias="from t_cust_account cust_account group by cust_account.p_account_status_id" posLeft="51" posTop="10" posWidth="20" posHeight="40"/>
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
		<CodeFile id="Code" language="PHPTemplates" name="getListWPActive.php" forShow="True" url="getListWPActive.php" comment="//" codePage="windows-1252"/>
</CodeFiles>
	<SecurityGroups/>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events/>
</Page>
