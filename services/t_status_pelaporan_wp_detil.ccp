<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\services" secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="True" cachingEnabled="False" cachingDuration="1 minutes" needGeneration="0">
	<Components>
		<Grid id="2" secured="False" sourceType="SQL" returnValueType="Number" defaultPageSize="10" connection="ConnSIKP" dataSource="SELECT
	CASE
WHEN cust_account.p_account_status_id = 1 THEN
	'1'
ELSE
	'2'
END AS status,
 vat_type.vat_code,
 COUNT (*) AS jumlah
FROM
	t_cust_account cust_account
LEFT JOIN p_vat_type vat_type ON vat_type.p_vat_type_id = cust_account.p_vat_type_id
WHERE
	CASE
WHEN cust_account.p_account_status_id = 1 THEN
	'1'
ELSE
	'2'
END = {status_id}
GROUP BY
	vat_type.vat_code,
	CASE
WHEN cust_account.p_account_status_id = 1 THEN
	'1'
ELSE
	'2'
END" activeCollection="SQLParameters" parameterTypeListName="ParameterTypeList" name="t_status_pelaporan_wp_detil" pageSizeLimit="100" wizardCaption="List of SELECT
	 CASE
 WHEN Cust Account P Account Status Id = 1 THEN
	'1'
 ELSE
	'2'
 END AS Status,
 Vat Type Vat Code,
 COUNT (*) AS Jumlah
 FROM
	t Cust Account Cust Account
 LEFT JOIN P Vat Type Vat Type ON Vat Type P Vat Type Id = Cust Account P Vat Type Id
 WHERE
	 CASE
 WHEN Cust Account P Account Status Id = 1 THEN
	'1'
 ELSE
	'2'
 END = {status Id}
 GROUP BY
	vat Type Vat Code,
	 CASE
 WHEN Cust Account P Account Status Id = 1 THEN
	'1'
 ELSE
	'2'
 END " wizardAllowInsert="False">
<Components>
<Label id="84" fieldSourceType="DBColumn" dataType="Memo" html="False" name="status" fieldSource="status">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="85" fieldSourceType="DBColumn" dataType="Memo" html="False" name="vat_code" fieldSource="vat_code">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="86" fieldSourceType="DBColumn" dataType="Integer" html="False" name="jumlah" fieldSource="jumlah">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
</Components>
<Events/>
<TableParameters/>
<JoinTables/>
<JoinLinks/>
<Fields/>
<SPParameters/>
<SQLParameters>
<SQLParameter id="83" variable="status_id" parameterType="URL" dataType="Text" parameterSource="status_id" defaultValue="1" designDefaultValue="1"/>
</SQLParameters>
<SecurityGroups/>
<Attributes/>
<Features/>
</Grid>
</Components>
	<CodeFiles>
		<CodeFile id="Code" language="PHPTemplates" name="t_status_pelaporan_wp_detil.php" forShow="True" url="t_status_pelaporan_wp_detil.php" comment="//" codePage="windows-1252"/>
</CodeFiles>
	<SecurityGroups/>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events/>
</Page>
