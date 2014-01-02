<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\trans" secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="RWNet" wizardThemeVersion="3.0" needGeneration="0" pasteActions="pasteActions" connection="ConnSIKP">
	<Components>
		<Record id="726" sourceType="SQL" urlType="Relative" secured="False" allowInsert="False" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="GET" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="t_target_realisasi_jenis_bulanForm" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" actionPage="t_target_realisasi" errorSummator="Error" wizardFormMethod="post" PathID="t_target_realisasi_jenis_bulanForm" connection="ConnSIKP" activeCollection="SQLParameters" dataSource="SELECT * 
FROM v_revenue_target_vs_realisasi_month
WHERE t_revenue_target_id = {t_revenue_target_id}" parameterTypeListName="ParameterTypeList">
			<Components>
				<Hidden id="731" fieldSourceType="DBColumn" dataType="Text" name="p_year_period_id" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_target_realisasi_jenis_bulanFormp_year_period_id" fieldSource="p_year_period_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="886" fieldSourceType="DBColumn" dataType="Text" name="t_revenue_target_id" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_target_realisasi_jenis_bulanFormt_revenue_target_id" fieldSource="t_revenue_target_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
			</Components>
			<Events>
				<Event name="BeforeSelect" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="890"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
				<TableParameter id="884" conditionType="Parameter" useIsNull="False" field="p_year_period_id" dataType="Float" searchConditionType="Equal" parameterType="URL" logicOperator="And" DBFormat="0" parameterSource="p_year_period_id"/>
				<TableParameter id="885" conditionType="Parameter" useIsNull="False" field="p_vat_type_id" dataType="Float" searchConditionType="Equal" parameterType="URL" logicOperator="And" DBFormat="0" parameterSource="p_vat_type_id"/>
			</TableParameters>
			<SPParameters/>
			<SQLParameters>
				<SQLParameter id="889" parameterType="URL" variable="t_revenue_target_id" dataType="Float" DBFormat="0" parameterSource="t_revenue_target_id" defaultValue="0"/>
			</SQLParameters>
			<JoinTables>
			</JoinTables>
			<JoinLinks/>
			<Fields>
			</Fields>
			<ISPParameters/>
			<ISQLParameters/>
			<IFormElements/>
			<USPParameters/>
			<USQLParameters/>
			<UConditions/>
			<UFormElements/>
			<DSPParameters/>
			<DSQLParameters/>
			<DConditions/>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Record>
	</Components>
	<CodeFiles>
		<CodeFile id="Events" language="PHPTemplates" name="t_target_realisasi_jenis_bulan_events.php" forShow="False" comment="//" codePage="windows-1252"/>
<CodeFile id="Code" language="PHPTemplates" name="t_target_realisasi_jenis_bulan.php" forShow="True" url="t_target_realisasi_jenis_bulan.php" comment="//" codePage="windows-1252"/>
</CodeFiles>
	<SecurityGroups/>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events>
	</Events>
</Page>
