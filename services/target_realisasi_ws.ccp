<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\services" secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="True" cachingEnabled="False" cachingDuration="1 minutes" needGeneration="0">
	<Components>
		<Grid id="2" secured="False" sourceType="SQL" returnValueType="Number" defaultPageSize="10" connection="ConnSIKP" dataSource="SELECT * 
FROM v_revenue_target_vs_realisasi 
WHERE year_code = '{year_code}'" activeCollection="SQLParameters" parameterTypeListName="ParameterTypeList" name="SELECT_FROM_v_revenue_tar" pageSizeLimit="100" wizardCaption="List of SELECT * 
 FROM V Revenue Target Vs Realisasi 
 WHERE Year Code = '{year Code}' " wizardAllowInsert="False">
<Components>
<Label id="1017" fieldSourceType="DBColumn" dataType="Float" html="False" name="t_revenue_target_id" fieldSource="t_revenue_target_id">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="1018" fieldSourceType="DBColumn" dataType="Float" html="False" name="p_vat_group_id" fieldSource="p_vat_group_id">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="1019" fieldSourceType="DBColumn" dataType="Float" html="False" name="target_amount" fieldSource="target_amount">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="1020" fieldSourceType="DBColumn" dataType="Float" html="False" name="realisasi_amt" fieldSource="realisasi_amt">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="1021" fieldSourceType="DBColumn" dataType="Text" html="False" name="vat_code" fieldSource="vat_code">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="1022" fieldSourceType="DBColumn" dataType="Text" html="False" name="year_code" fieldSource="year_code">
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
<SQLParameter id="1016" variable="year_code" parameterType="URL" dataType="Text" parameterSource="year_code"/>
</SQLParameters>
<SecurityGroups/>
<Attributes/>
<Features/>
</Grid>
</Components>
	<CodeFiles>
		<CodeFile id="Code" language="PHPTemplates" name="target_realisasi_ws.php" forShow="True" url="target_realisasi_ws.php" comment="//" codePage="windows-1252"/>
</CodeFiles>
	<SecurityGroups/>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events/>
</Page>
