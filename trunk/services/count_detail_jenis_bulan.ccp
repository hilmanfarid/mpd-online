<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\services" secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="True" cachingEnabled="False" cachingDuration="1 minutes" needGeneration="0">
	<Components>
		<Grid id="2" secured="False" sourceType="SQL" returnValueType="Number" defaultPageSize="10" connection="ConnSIKP" activeCollection="SQLParameters" parameterTypeListName="ParameterTypeList" dataSource="SELECT count(c) from (select distinct p_vat_type_dtl_id as c
from v_revenue_target_vs_realisasi_month
where
t_revenue_target_id = {t_revenue_target_id}) " name="select_count_c_from_selec" pageSizeLimit="100" wizardCaption="List of Select Count(c) From (select Distinct P Vat Type Dtl Id As C
from V Revenue Target Vs Realisasi Month
where
t Revenue Target Id = {t Revenue Target Id}) " wizardAllowInsert="False">
<Components>
<Label id="893" fieldSourceType="DBColumn" dataType="Integer" html="False" name="count" fieldSource="count">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
</Components>
<Events/>
<TableParameters/>
<JoinTables>
<JoinTable id="894" tableName="select" alias="count(c) from (select distinct p_vat_type_dtl_id as c
from v_revenue_target_vs_realisasi_month
where
t_revenue_target_id = {t_revenue_target_id})" posLeft="10" posTop="10" posWidth="20" posHeight="40"/>
</JoinTables>
<JoinLinks/>
<Fields/>
<SPParameters/>
<SQLParameters>
<SQLParameter id="892" variable="t_revenue_target_id" parameterType="URL" defaultValue="0" dataType="Float" parameterSource="t_revenue_target_id"/>
</SQLParameters>
<SecurityGroups/>
<Attributes/>
<Features/>
</Grid>
</Components>
	<CodeFiles>
		<CodeFile id="Code" language="PHPTemplates" name="count_detail_jenis_bulan.php" forShow="True" url="count_detail_jenis_bulan.php" comment="//" codePage="windows-1252"/>
</CodeFiles>
	<SecurityGroups/>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events/>
</Page>
