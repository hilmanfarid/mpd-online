<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\services" secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="True" cachingEnabled="False" cachingDuration="1 minutes" needGeneration="0">
	<Components>
		<Grid id="2" secured="False" sourceType="SQL" returnValueType="Number" defaultPageSize="10" connection="ConnSIKP" dataSource="SELECT
	MAX(p_finance_period_id) as p_finance_period_id, 
	MAX(p_year_period_id) as p_year_period_id,
	to_char(MAX(start_date),'dd-mm-yyyy') as start_date,
	to_char(MAX(end_date),'dd-mm-yyyy') as end_date,
	MAX(p_vat_type_id) as p_vat_type_id,
	MAX(bulan) as bulan,
	SUM (target_amount) as target_amount,
	SUM (realisasi_amt) as realisasi_amt,
	MAX (penalty_amt) as penalty_amt,
	SUM (debt_amt) as debt_amt
FROM
	f_target_vs_real_monthly_new({p_year_period_id},null)
GROUP BY p_finance_period_id

ORDER BY MAX(start_date) ASC" activeCollection="SQLParameters" parameterTypeListName="ParameterTypeList" name="SELECT_MAX_p_finance_peri" pageSizeLimit="100" wizardCaption="List of SELECT
	 MAX(p Finance Period Id) As P Finance Period Id, 
	 MAX(p Year Period Id) As P Year Period Id,
	to Char( MAX(start Date),'dd-mm-yyyy') As Start Date,
	to Char( MAX(end Date),'dd-mm-yyyy') As End Date,
	 MAX(p Vat Type Id) As P Vat Type Id,
	 MAX(bulan) As Bulan,
	 SUM (target Amount) As Target Amount,
	 SUM (realisasi Amt) As Realisasi Amt,
	 MAX (penalty Amt) As Penalty Amt,
	 SUM (debt Amt) As Debt Amt
 FROM
	f Target Vs Real Monthly New({p Year Period Id},null)
 GROUP BY P Finance Period Id

 ORDER BY MAX(start Date) ASC " wizardAllowInsert="False">
<Components>
<Label id="882" fieldSourceType="DBColumn" dataType="Memo" html="False" name="bulan" fieldSource="bulan">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="883" fieldSourceType="DBColumn" dataType="Float" html="False" name="target_amount" fieldSource="target_amount">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="884" fieldSourceType="DBColumn" dataType="Float" html="False" name="realisasi_amt" fieldSource="realisasi_amt">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="885" fieldSourceType="DBColumn" dataType="Float" html="False" name="penalty_amt" fieldSource="penalty_amt">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="886" fieldSourceType="DBColumn" dataType="Float" html="False" name="debt_amt" fieldSource="debt_amt">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
</Components>
<Events/>
<TableParameters/>
<JoinTables>
<JoinTable id="887" tableName="SELECT
	MAX(p_finance_period_id)" alias="p_finance_period_id" posLeft="10" posTop="10" posWidth="20" posHeight="40"/>
<JoinTable id="888" tableName="MAX(p_year_period_id)" alias="p_year_period_id" posLeft="51" posTop="10" posWidth="20" posHeight="40"/>
<JoinTable id="889" tableName="to_char(MAX(start_date)" posLeft="92" posTop="10" posWidth="20" posHeight="40"/>
<JoinTable id="890" tableName="'dd-mm-yyyy')" alias="start_date" posLeft="133" posTop="10" posWidth="20" posHeight="40"/>
<JoinTable id="891" tableName="to_char(MAX(end_date)" posLeft="174" posTop="10" posWidth="20" posHeight="40"/>
<JoinTable id="892" tableName="'dd-mm-yyyy')" alias="end_date" posLeft="215" posTop="10" posWidth="20" posHeight="40"/>
<JoinTable id="893" tableName="MAX(p_vat_type_id)" alias="p_vat_type_id" posLeft="256" posTop="10" posWidth="20" posHeight="40"/>
<JoinTable id="894" tableName="MAX(bulan)" alias="bulan" posLeft="297" posTop="10" posWidth="20" posHeight="40"/>
<JoinTable id="895" tableName="SUM" alias="(target_amount) as target_amount" posLeft="338" posTop="10" posWidth="20" posHeight="40"/>
<JoinTable id="896" tableName="SUM" alias="(realisasi_amt) as realisasi_amt" posLeft="21" posTop="60" posWidth="20" posHeight="40"/>
<JoinTable id="897" tableName="MAX" alias="(penalty_amt) as penalty_amt" posLeft="62" posTop="60" posWidth="20" posHeight="40"/>
<JoinTable id="898" tableName="SUM" alias="(debt_amt) as debt_amt
FROM
	f_target_vs_real_monthly_new({p_year_period_id}" posLeft="103" posTop="60" posWidth="20" posHeight="40"/>
<JoinTable id="899" tableName="null)
GROUP" alias="BY p_finance_period_id

ORDER BY MAX(start_date) ASC" posLeft="144" posTop="60" posWidth="20" posHeight="40"/>
</JoinTables>
<JoinLinks/>
<Fields/>
<SPParameters/>
<SQLParameters>
<SQLParameter id="876" variable="p_year_period_id" parameterType="URL" dataType="Text" parameterSource="p_year_period_id" designDefaultValue="16"/>
</SQLParameters>
<SecurityGroups/>
<Attributes/>
<Features/>
</Grid>
</Components>
	<CodeFiles>
		<CodeFile id="Code" language="PHPTemplates" name="t_target_realisasi_bulan_all.php" forShow="True" url="t_target_realisasi_bulan_all.php" comment="//" codePage="windows-1252"/>
</CodeFiles>
	<SecurityGroups/>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events/>
</Page>
