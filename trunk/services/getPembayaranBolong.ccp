<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\services" secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="True" cachingEnabled="False" cachingDuration="1 minutes" needGeneration="0">
	<Components>
		<Grid id="2" secured="False" sourceType="SQL" returnValueType="Number" defaultPageSize="10" connection="ConnSIKP" activeCollection="SQLParameters" parameterTypeListName="ParameterTypeList" dataSource="SELECT x.receipt_no,
x.p_finance_period_id,
x.description,
f_per.*
FROM p_finance_period f_per,
(select sett.p_finance_period_id,
receipt_no,sett_type.description
						from
							t_vat_setllement sett,
							p_settlement_type sett_type,
t_payment_receipt rec
							WHERE sett.t_cust_account_id = {t_cust_account_id}
							and sett.p_settlement_type_id = sett_type.p_settlement_type_id
							and sett.t_vat_setllement_id = rec.t_vat_setllement_id (+)
							and sett.p_settlement_type_id &lt;&gt; 7) as x
					where f_per.p_finance_period_id = x.p_finance_period_id(+)
					and f_per.end_date &lt; (select start_date from p_finance_period where p_finance_period_id = {p_finance_period_id})
					and f_per.start_date &gt;= '01-01-2013'
					and (receipt_no is null or receipt_no ='')
					and f_per.start_date &gt;= '{activation_date}'
					order by f_per.start_date" name="SELECT_x_receipt_no_x_p_f" pageSizeLimit="100" wizardCaption="List of SELECT X Receipt No,x P Finance Period Id,f Per *
			 FROM P Finance Period F Per,
            (select Sett P Finance Period Id,receipt No
						 From
							t Vat Setllement Sett,t Payment Receipt Rec
							 WHERE Sett T Cust Account Id = {t Cust Account Id}
							and Sett T Vat Setllement Id = Rec T Vat Setllement Id (+)
							and Sett P Settlement Type Id &lt;&gt; 7) As X
					where F Per P Finance Period Id = X P Finance Period Id(+)
					and F Per End Date &lt; (select Start Date From P Finance Period Where P Finance Period Id = {p Finance Period Id})
					and F Per Start Date &gt;= '01-01-2013'
					and (receipt No Is Null Or Receipt No ='')
					order By F Per Start Date " wizardAllowInsert="False" pasteActions="pasteActions">
			<Components>
				<Label id="178" fieldSourceType="DBColumn" dataType="Float" html="False" name="p_finance_period_id" fieldSource="p_finance_period_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="184" fieldSourceType="DBColumn" dataType="Text" html="False" name="description" fieldSource="description">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="185" fieldSourceType="DBColumn" dataType="Text" html="False" name="code" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="getPembayaranBolongSELECT_x_receipt_no_x_p_fcode" fieldSource="code">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="188" fieldSourceType="DBColumn" dataType="Text" html="False" name="activation_date" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="getPembayaranBolongSELECT_x_receipt_no_x_p_factivation_date" fieldSource="activation_date">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
</Components>
			<Events>
<Event name="BeforeSelect" type="Server">
<Actions>
<Action actionName="Custom Code" actionCategory="General" id="187"/>
</Actions>
</Event>
</Events>
			<TableParameters/>
			<JoinTables/>
			<JoinLinks/>
			<Fields/>
			<SPParameters/>
			<SQLParameters>
				<SQLParameter id="175" variable="p_finance_period_id" parameterType="URL" dataType="Text" parameterSource="p_finance_period_id" designDefaultValue="190"/>
				<SQLParameter id="176" variable="t_cust_account_id" parameterType="URL" dataType="Text" parameterSource="t_cust_account_id" designDefaultValue="100"/>
				<SQLParameter id="189" variable="activation_date" parameterType="Expression" dataType="Text" parameterSource="$this-&gt;activation_date"/>
</SQLParameters>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Grid>
	</Components>
	<CodeFiles>
		<CodeFile id="Code" language="PHPTemplates" name="getPembayaranBolong.php" forShow="True" url="getPembayaranBolong.php" comment="//" codePage="windows-1252"/>
		<CodeFile id="Events" language="PHPTemplates" name="getPembayaranBolong_events.php" forShow="False" comment="//" codePage="windows-1252"/>
</CodeFiles>
	<SecurityGroups/>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events>
<Event name="BeforeInitialize" type="Server">
<Actions>
<Action actionName="Custom Code" actionCategory="General" id="186"/>
</Actions>
</Event>
</Events>
</Page>
