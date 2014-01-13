<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\services" secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="True" cachingEnabled="False" cachingDuration="1 minutes" needGeneration="0">
	<Components>
		<Grid id="2" secured="False" sourceType="SQL" returnValueType="Number" connection="ConnSIKP" activeCollection="SQLParameters" parameterTypeListName="ParameterTypeList" dataSource="SELECT target_amount,
realisasi_amt,
vat_code
FROM v_revenue_target_vs_realisasi
WHERE t_revenue_target_id = {t_revenue_target_id}
ORDER BY p_vat_type_id" name="SELECT_target_amount_real" wizardCaption="List of SELECT Target Amount, Realisasi Amt, Vat Code
 FROM V Revenue Target Vs Realisasi
 WHERE T Revenue Target Id = {t Revenue Target Id}
 ORDER BY P Vat Type Id " wizardAllowInsert="False">
<Components>
<Label id="760" fieldSourceType="DBColumn" dataType="Float" html="False" name="target_amount" fieldSource="target_amount">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="761" fieldSourceType="DBColumn" dataType="Float" html="False" name="realisasi_amt" fieldSource="realisasi_amt">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="762" fieldSourceType="DBColumn" dataType="Memo" html="False" name="vat_code" fieldSource="vat_code">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
</Components>
<Events/>
<TableParameters/>
<JoinTables>
<JoinTable id="763" tableName="SELECT" alias="target_amount" posLeft="10" posTop="10" posWidth="20" posHeight="40"/>
<JoinTable id="764" tableName="realisasi_amt" posLeft="51" posTop="10" posWidth="20" posHeight="40"/>
<JoinTable id="765" tableName="vat_code
FROM" alias="v_revenue_target_vs_realisasi
WHERE t_revenue_target_id = {t_revenue_target_id}
ORDER BY p_vat_type_id" posLeft="92" posTop="10" posWidth="20" posHeight="40"/>
</JoinTables>
<JoinLinks/>
<Fields/>
<SPParameters/>
<SQLParameters>
<SQLParameter id="759" variable="t_revenue_target_id" parameterType="URL" defaultValue="0" dataType="Float" parameterSource="t_revenue_target_id"/>
</SQLParameters>
<SecurityGroups/>
<Attributes/>
<Features/>
</Grid>
</Components>
	<CodeFiles>
		<CodeFile id="Code" language="PHPTemplates" name="target_realisasi_tahun_jenis.php" forShow="True" url="target_realisasi_tahun_jenis.php" comment="//" codePage="windows-1252"/>
</CodeFiles>
	<SecurityGroups/>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events/>
</Page>
