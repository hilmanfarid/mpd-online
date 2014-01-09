<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\services" secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="True" cachingEnabled="False" cachingDuration="1 minutes" needGeneration="0">
	<Components>
		<Grid id="2" secured="False" sourceType="SQL" returnValueType="Number" defaultPageSize="10" connection="ConnSIKP" activeCollection="SQLParameters" parameterTypeListName="ParameterTypeList" dataSource="select * from f_rep_status_lapor_pajak({p_finance_period_id})" name="select_from_f_rep_status" pageSizeLimit="100" wizardCaption="List of Select * From F Rep Status Lapor Pajak({p Finance Period Id}) " wizardAllowInsert="False">
<Components>
<Label id="738" fieldSourceType="DBColumn" dataType="Text" html="False" name="status" fieldSource="status">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="739" fieldSourceType="DBColumn" dataType="Float" html="False" name="jml" fieldSource="jml">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="740" fieldSourceType="DBColumn" dataType="Float" html="False" name="amount" fieldSource="amount">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
</Components>
<Events/>
<TableParameters/>
<JoinTables>
<JoinTable id="741" tableName="select" alias="* from f_rep_status_lapor_pajak({p_finance_period_id})" posLeft="10" posTop="10" posWidth="20" posHeight="40"/>
</JoinTables>
<JoinLinks/>
<Fields/>
<SPParameters/>
<SQLParameters>
<SQLParameter id="737" variable="p_finance_period_id" parameterType="URL" defaultValue="0" dataType="Float" parameterSource="p_finance_period_id"/>
</SQLParameters>
<SecurityGroups/>
<Attributes/>
<Features/>
</Grid>
</Components>
	<CodeFiles>
		<CodeFile id="Code" language="PHPTemplates" name="status_lapor.php" forShow="True" url="status_lapor.php" comment="//" codePage="windows-1252"/>
</CodeFiles>
	<SecurityGroups/>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events/>
</Page>
