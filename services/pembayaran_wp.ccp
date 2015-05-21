<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\services" secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="True" cachingEnabled="False" cachingDuration="1 minutes" needGeneration="0">
	<Components>
		<Grid id="2" secured="False" sourceType="SQL" returnValueType="Number" connection="ConnSIKP" activeCollection="SQLParameters" parameterTypeListName="ParameterTypeList" dataSource="select c.npwd,c.wp_name,a.p_finance_period_id,a.code,case when a.p_finance_period_id=192 then sum(nvl(total_vat_amount,0)) else max(nvl(total_vat_amount,0)) end as pajak,e.code as ketetapan,d.p_year_period_id, d.year_code from p_finance_period a
left join t_cust_account c on c.t_cust_account_id = {t_cust_account_id}
left join t_vat_setllement b on b.p_finance_period_id = a.p_finance_period_id and b.t_cust_account_id = c.t_cust_account_id and p_settlement_type_id in (1,4,6) and b.p_vat_type_dtl_id not in (11,27,14,15)
left join p_year_period d on d.p_year_period_id = a.p_year_period_id
left join p_settlement_type e on e.p_settlement_type_id=b.p_settlement_type_id
where a. p_year_period_id in (
	SELECT
	p_year_period_id
FROM
	p_year_period
WHERE
	start_date &gt;= (
		SELECT
			start_date - '2 years' :: INTERVAL
		FROM
			p_year_period
		WHERE
			p_year_period_id = {p_year_period_id}
	)
AND start_date &lt;= (
	SELECT
		start_date
	FROM
		p_year_period
	WHERE
		p_year_period_id = {p_year_period_id}
)
and start_date &gt; '2012-12-31'
)
group by 
c.npwd,c.wp_name,a.p_finance_period_id,a.code,e.code,d.p_year_period_id, d.year_code
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
				<Label id="757" fieldSourceType="DBColumn" dataType="Text" html="False" name="code" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="pembayaran_wpSELECT_target_amt_realisacode" fieldSource="code">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="759" fieldSourceType="DBColumn" dataType="Text" html="False" name="p_finance_period_id" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="pembayaran_wpSELECT_target_amt_realisap_finance_period_id" fieldSource="p_finance_period_id">
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
			</SQLParameters>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Grid>
	</Components>
	<CodeFiles>
		<CodeFile id="Code" language="PHPTemplates" name="pembayaran_wp.php" forShow="True" url="pembayaran_wp.php" comment="//" codePage="windows-1252"/>
		<CodeFile id="Events" language="PHPTemplates" name="pembayaran_wp_events.php" forShow="False" comment="//" codePage="windows-1252"/>
	</CodeFiles>
	<SecurityGroups/>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events/>
</Page>
