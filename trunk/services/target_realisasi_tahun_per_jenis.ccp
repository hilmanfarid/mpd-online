<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\services" secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="True" cachingEnabled="False" cachingDuration="1 minutes" needGeneration="0">
	<Components>
		<Grid id="2" secured="False" sourceType="SQL" returnValueType="Number" defaultPageSize="10" connection="ConnSIKP" activeCollection="SQLParameters" parameterTypeListName="ParameterTypeList" dataSource="SELECT t_revenue_target_id,
p_year_period_id,
p_vat_type_id,
vat_code,
year_code,
target_amount,
realisasi_amt
FROM v_revenue_target_vs_realisasi
WHERE p_year_period_id = {p_year_period_id} 
ORDER BY p_vat_type_id" name="SELECT_t_revenue_target_i" pageSizeLimit="100" wizardCaption="List of SELECT T Revenue Target Id, P Year Period Id, P Vat Type Id, Vat Code, Year Code, Target Amount, Realisasi Amt
 FROM V Revenue Target Vs Realisasi
 WHERE P Year Period Id = {p Year Period Id} 
 ORDER BY P Vat Type Id " wizardAllowInsert="False">
			<Components>
				<Label id="769" fieldSourceType="DBColumn" dataType="Float" html="False" name="target_amount" fieldSource="target_amount">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="770" fieldSourceType="DBColumn" dataType="Float" html="False" name="realisasi_amt" fieldSource="realisasi_amt">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="768" fieldSourceType="DBColumn" dataType="Text" html="False" name="vat_code" fieldSource="vat_code">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
			</Components>
			<Events/>
			<TableParameters/>
			<JoinTables/>
			<JoinLinks/>
			<Fields/>
			<SPParameters/>
			<SQLParameters>
				<SQLParameter id="767" variable="p_year_period_id" parameterType="URL" defaultValue="0" dataType="Float" parameterSource="p_year_period_id"/>
			</SQLParameters>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Grid>
	</Components>
	<CodeFiles>
		<CodeFile id="Code" language="PHPTemplates" name="target_realisasi_tahun_per_jenis.php" forShow="True" url="target_realisasi_tahun_per_jenis.php" comment="//" codePage="windows-1252"/>
	</CodeFiles>
	<SecurityGroups/>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events/>
</Page>
