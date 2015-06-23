<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\services" secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="True" cachingEnabled="False" cachingDuration="1 minutes" needGeneration="0">
	<Components>
		<Grid id="2" secured="False" sourceType="SQL" returnValueType="Number" connection="ConnSIKP" activeCollection="SQLParameters" parameterTypeListName="ParameterTypeList" dataSource="select to_char(i,'dd') as tanggal,nvl(realisasi_harian,0) as realisasi 
from (select i::date from generate_series((select start_date from p_finance_period where p_finance_period_id={p_finance_period_id}), 
  (select end_date from p_finance_period where p_finance_period_id={p_finance_period_id}), '1 day'::interval) i) as hari
left join 
	(select 
		trunc(b.payment_date)as tanggal_bayar,
		sum(b.payment_amount) as realisasi_harian 
		from t_vat_setllement a
		left join t_payment_receipt b on a.t_vat_setllement_id=b.t_vat_setllement_id
		where a.p_vat_type_dtl_id in (select p_vat_type_dtl_id from p_vat_type_dtl where p_vat_type_id={p_vat_type_id})
		and b.t_vat_setllement_id is not null
		and b.payment_date 
			BETWEEN 
				(select start_date from p_finance_period where p_finance_period_id={p_finance_period_id})
			and 
				(select end_date from p_finance_period where p_finance_period_id={p_finance_period_id})
		GROUP BY tanggal_bayar
		ORDER BY tanggal_bayar) pembayaran
	ON pembayaran.tanggal_bayar=hari.i" name="SELECT_target_amt_realisa" wizardCaption="List of SELECT Target Amt, Realisasi Amt 
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
				<Label id="757" fieldSourceType="DBColumn" dataType="Text" html="False" name="code" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="pembayaran_per_bulanSELECT_target_amt_realisacode" fieldSource="code">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="759" fieldSourceType="DBColumn" dataType="Text" html="False" name="p_finance_period_id" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="pembayaran_per_bulanSELECT_target_amt_realisap_finance_period_id" fieldSource="p_finance_period_id">
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
				<SQLParameter id="752" variable="p_finance_period_id" parameterType="URL" defaultValue="0" dataType="Float" parameterSource="p_finance_period_id"/>
				<SQLParameter id="758" variable="p_vat_type_id" parameterType="URL" defaultValue="1" dataType="Integer" parameterSource="p_vat_type_id"/>
			</SQLParameters>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Grid>
	</Components>
	<CodeFiles>
		<CodeFile id="Events" language="PHPTemplates" name="pembayaran_per_bulan_events.php" forShow="False" comment="//" codePage="windows-1252"/>
		<CodeFile id="Code" language="PHPTemplates" name="pembayaran_per_bulan.php" forShow="True" url="pembayaran_per_bulan.php" comment="//" codePage="windows-1252"/>
	</CodeFiles>
	<SecurityGroups/>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events/>
</Page>
