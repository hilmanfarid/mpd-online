<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\services" secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="True" cachingEnabled="False" cachingDuration="1 minutes" needGeneration="0">
	<Components>
		<Grid id="2" secured="False" sourceType="SQL" returnValueType="Number" defaultPageSize="10" connection="ConnSIKP" activeCollection="SQLParameters" parameterTypeListName="ParameterTypeList" dataSource="SELECT * 
FROM f_status_belum_lapor({p_finance_period_id}, {active})" name="select_from_f_status_belu" pageSizeLimit="100" wizardCaption="List of Select * From F Status Belum Lapor({p Finance Period Id}, {active}) " wizardAllowInsert="False">
<Components>
<Label id="86" fieldSourceType="DBColumn" dataType="Float" html="False" name="x_dummy" fieldSource="x_dummy">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="87" fieldSourceType="DBColumn" dataType="Float" html="False" name="p_vat_type_id" fieldSource="p_vat_type_id">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="88" fieldSourceType="DBColumn" dataType="Text" html="False" name="vat_code" fieldSource="vat_code">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="89" fieldSourceType="DBColumn" dataType="Float" html="False" name="jml_wp" fieldSource="jml_wp">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
</Components>
<Events/>
<TableParameters/>
<JoinTables>
<JoinTable id="90" tableName="select" alias="* from f_status_belum_lapor({p_finance_period_id}" posLeft="10" posTop="10" posWidth="20" posHeight="40"/>
<JoinTable id="91" tableName="{active})" posLeft="51" posTop="10" posWidth="20" posHeight="40"/>
</JoinTables>
<JoinLinks/>
<Fields/>
<SPParameters/>
<SQLParameters>
<SQLParameter id="84" variable="p_finance_period_id" parameterType="URL" defaultValue="0" dataType="Float" parameterSource="p_finance_period_id"/>
<SQLParameter id="85" variable="active" parameterType="URL" defaultValue="0" dataType="Float" parameterSource="active"/>
</SQLParameters>
<SecurityGroups/>
<Attributes/>
<Features/>
</Grid>
</Components>
	<CodeFiles>
		<CodeFile id="Code" language="PHPTemplates" name="status_lapor_belum_lapor.php" forShow="True" url="status_lapor_belum_lapor.php" comment="//" codePage="windows-1252"/>
</CodeFiles>
	<SecurityGroups/>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events/>
</Page>
