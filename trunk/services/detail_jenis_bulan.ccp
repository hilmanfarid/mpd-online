<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\services" secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="True" cachingEnabled="False" cachingDuration="1 minutes" needGeneration="0">
	<Components>
		<Grid id="2" secured="False" sourceType="SQL" returnValueType="Number" connection="ConnSIKP" activeCollection="SQLParameters" parameterTypeListName="ParameterTypeList" dataSource="select target_amount, realisasi_amt, bulan, vat_code, detail_vat_code from v_revenue_target_vs_realisasi_month
where t_revenue_target_id = {t_revenue_target_id}
order by start_date" name="select_from_v_revenue_tar" wizardCaption="List of Select * From V Revenue Target Vs Realisasi Month
where
	t Revenue Target Id = {t Revenue Target Id}
order By
	start Date " wizardAllowInsert="False">
			<Components>
				<Label id="926" fieldSourceType="DBColumn" dataType="Float" html="False" name="target_amount" fieldSource="target_amount">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="927" fieldSourceType="DBColumn" dataType="Float" html="False" name="realisasi_amt" fieldSource="realisasi_amt">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="928" fieldSourceType="DBColumn" dataType="Text" html="False" name="bulan" fieldSource="bulan">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="930" fieldSourceType="DBColumn" dataType="Text" html="False" name="vat_code" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="jenis_bulanselect_from_v_revenue_tarvat_code" fieldSource="vat_code">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="931" fieldSourceType="DBColumn" dataType="Text" html="False" name="detail_vat_code" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="jenis_bulanselect_from_v_revenue_tardetail_vat_code" fieldSource="detail_vat_code">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
			</Components>
			<Events/>
			<TableParameters/>
			<JoinTables>
			</JoinTables>
			<JoinLinks/>
			<Fields/>
			<SPParameters/>
			<SQLParameters>
				<SQLParameter id="925" variable="t_revenue_target_id" parameterType="URL" defaultValue="0" dataType="Float" parameterSource="t_revenue_target_id"/>
			</SQLParameters>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Grid>
	</Components>
	<CodeFiles>
		<CodeFile id="Code" language="PHPTemplates" name="detail_jenis_bulan.php" forShow="True" url="detail_jenis_bulan.php" comment="//" codePage="windows-1252"/>
</CodeFiles>
	<SecurityGroups/>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events/>
</Page>
