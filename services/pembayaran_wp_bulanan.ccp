<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\services" secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="True" cachingEnabled="False" cachingDuration="1 minutes" needGeneration="0">
	<Components>
		<Grid id="2" secured="False" sourceType="SQL" returnValueType="Number" connection="ConnSIKP" activeCollection="SQLParameters" parameterTypeListName="ParameterTypeList" dataSource="select c.npwd,c.wp_name,a.p_finance_period_id,a.code,sum(nvl(total_vat_amount,0)) as pajak
from p_finance_period a
left join t_cust_account c on c.t_cust_account_id = {t_cust_account_id}
left join t_vat_setllement b on b.p_finance_period_id = a.p_finance_period_id and b.t_cust_account_id = c.t_cust_account_id and p_settlement_type_id in (1,4,6) and b.p_vat_type_dtl_id not in (27,15)
where a. p_finance_period_id in (
SELECT
	p_finance_period_id
FROM
	p_finance_period
WHERE
	start_date = (select start_date
								from p_finance_period 
								where p_finance_period_id = {p_finance_period_id})
or 
	start_date = (select start_date - '1 years' :: INTERVAL
								from p_finance_period 
								where p_finance_period_id = {p_finance_period_id})
OR
	start_date = (select start_date - '2 years' :: INTERVAL 
								from p_finance_period 
								where p_finance_period_id = {p_finance_period_id})
)
and 
( case 
		when t_vat_setllement_id is null then TRUE 
		when {p_vat_type_dtl_id} = 10 then b.p_vat_type_dtl_id in (10,9)
		else c.p_vat_type_dtl_id = {p_vat_type_dtl_id} end
)

group by 
c.npwd,c.wp_name,a.p_finance_period_id,a.code
ORDER BY a.start_date
; " name="SELECT_target_amt_realisa" wizardCaption="List of SELECT Target Amt, Realisasi Amt 
 FROM V Target Vs Real Anual
 WHERE P Year Period Id = {p Year Period Id} " wizardAllowInsert="False" pasteActions="pasteActions">
			<Components>
				<Label id="753" fieldSourceType="DBColumn" dataType="Float" html="False" name="wp_name" fieldSource="wp_name">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="754" fieldSourceType="DBColumn" dataType="Float" html="False" name="npwd" fieldSource="npwd">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="757" fieldSourceType="DBColumn" dataType="Text" html="False" name="code" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="pembayaran_wp_bulananSELECT_target_amt_realisacode" fieldSource="code">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="759" fieldSourceType="DBColumn" dataType="Text" html="False" name="p_finance_period_id" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="pembayaran_wp_bulananSELECT_target_amt_realisap_finance_period_id" fieldSource="p_finance_period_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
			</Components>
			<Events>
				<Event name="AfterExecuteSelect" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="760"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters/>
			<JoinTables>
			</JoinTables>
			<JoinLinks/>
			<Fields/>
			<SPParameters/>
			<SQLParameters>
				<SQLParameter id="752" variable="p_year_period_id" parameterType="URL" defaultValue="0" dataType="Float" parameterSource="p_year_period_id"/>
				<SQLParameter id="758" variable="t_cust_account_id" parameterType="URL" defaultValue="1" dataType="Integer" parameterSource="t_cust_account_id"/>
				<SQLParameter id="761" variable="p_finance_period_id" parameterType="URL" defaultValue="0" dataType="Float" parameterSource="p_finance_period_id"/>
				<SQLParameter id="762" variable="p_vat_type_dtl_id" parameterType="URL" defaultValue="0" dataType="Float" parameterSource="p_vat_type_dtl_id"/>
			</SQLParameters>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Grid>
	</Components>
	<CodeFiles>
		<CodeFile id="Events" language="PHPTemplates" name="pembayaran_wp_bulanan_events.php" forShow="False" comment="//" codePage="windows-1252"/>
		<CodeFile id="Code" language="PHPTemplates" name="pembayaran_wp_bulanan.php" forShow="True" url="pembayaran_wp_bulanan.php" comment="//" codePage="windows-1252"/>
	</CodeFiles>
	<SecurityGroups/>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events/>
</Page>
