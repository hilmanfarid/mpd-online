<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\services" secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="True" cachingEnabled="False" cachingDuration="1 minutes" needGeneration="0">
	<Components>
		<Grid id="2" secured="False" sourceType="SQL" returnValueType="Number" defaultPageSize="10" connection="ConnSIKP" activeCollection="SQLParameters" parameterTypeListName="ParameterTypeList" dataSource="SELECT * 
FROM v_target_vs_real_anual
WHERE p_year_period_id = {p_year_period_id}" name="SELECT_target_amt_realisa" pageSizeLimit="100" wizardCaption="List of SELECT Target Amt, Realisasi Amt 
 FROM V Target Vs Real Anual
 WHERE P Year Period Id = {p Year Period Id} " wizardAllowInsert="False">
<Components>
<Label id="753" fieldSourceType="DBColumn" dataType="Float" html="False" name="target_amt" fieldSource="target_amt">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="754" fieldSourceType="DBColumn" dataType="Float" html="False" name="realisasi_amt" fieldSource="realisasi_amt">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="757" fieldSourceType="DBColumn" dataType="Text" html="False" name="year_code" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="target_realisasi_tahunSELECT_target_amt_realisayear_code" fieldSource="year_code">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
</Components>
<Events/>
<TableParameters/>
<JoinTables>
<JoinTable id="756" tableName="realisasi_amt" alias="FROM v_target_vs_real_anualWHERE p_year_period_id = {p_year_period_id}" posWidth="20" posHeight="40" posLeft="51" posTop="10"/>
<JoinTable id="755" tableName="SELECT" alias="target_amt" posWidth="20" posHeight="40" posLeft="10" posTop="10"/>
</JoinTables>
<JoinLinks/>
<Fields/>
<SPParameters/>
<SQLParameters>
<SQLParameter id="752" variable="p_year_period_id" parameterType="URL" defaultValue="0" dataType="Float" parameterSource="p_year_period_id"/>
</SQLParameters>
<SecurityGroups/>
<Attributes/>
<Features/>
</Grid>
</Components>
	<CodeFiles>
		<CodeFile id="Code" language="PHPTemplates" name="target_realisasi_tahun.php" forShow="True" url="target_realisasi_tahun.php" comment="//" codePage="windows-1252"/>
</CodeFiles>
	<SecurityGroups/>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events/>
</Page>
