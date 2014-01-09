<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\services" secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="True" cachingEnabled="False" cachingDuration="1 minutes" needGeneration="0">
	<Components>
		<Grid id="2" secured="False" sourceType="SQL" returnValueType="Number" connection="ConnSIKP" activeCollection="SQLParameters" parameterTypeListName="ParameterTypeList" dataSource="SELECT * 
FROM f_status_sudah_lapor({p_finance_period_id}, {active})" name="select_from_f_status_belu" wizardCaption="List of Select * From F Status Belum Lapor({p Finance Period Id}, {active}) " wizardAllowInsert="False">
			<Components>
				<Label id="86" fieldSourceType="DBColumn" dataType="Text" html="False" name="tgl_pelaporan" fieldSource="tgl_pelaporan">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="87" fieldSourceType="DBColumn" dataType="Text" html="False" name="tgl" fieldSource="tgl">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="88" fieldSourceType="DBColumn" dataType="Float" html="False" name="jml_lapor" fieldSource="jml_lapor">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="89" fieldSourceType="DBColumn" dataType="Float" html="False" name="nilai_lapor" fieldSource="nilai_lapor">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="90" fieldSourceType="DBColumn" dataType="Float" html="False" name="nilai_denda" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="status_lapor_sudah_laporselect_from_f_status_belunilai_denda" fieldSource="nilai_denda">
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
				<SQLParameter id="84" variable="p_finance_period_id" parameterType="URL" defaultValue="0" dataType="Float" parameterSource="p_finance_period_id"/>
				<SQLParameter id="85" variable="active" parameterType="URL" defaultValue="0" dataType="Float" parameterSource="active"/>
			</SQLParameters>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Grid>
	</Components>
	<CodeFiles>
		<CodeFile id="Code" language="PHPTemplates" name="status_lapor_sudah_lapor.php" forShow="True" url="status_lapor_sudah_lapor.php" comment="//" codePage="windows-1252"/>
	</CodeFiles>
	<SecurityGroups/>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events/>
</Page>
