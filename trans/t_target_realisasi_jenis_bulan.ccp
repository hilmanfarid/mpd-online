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
		<FlashChart id="891" secured="False" dataSeriesIn="Columns" chartType="3d_columns" sourceType="SQL" defaultPageSize="25" returnValueType="Number" name="t_target_realisasi_jenis_bulanFlashjenis_bulan" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_target_realisasi_jenis_bulanFlashjenis_bulan" connection="ConnSIKP" activeCollection="SQLParameters" parameterTypeListName="ParameterTypeList" dataSource="select * from v_revenue_target_vs_realisasi_month
where
	t_revenue_target_id = {t_revenue_target_id}
order by
	start_date" schemaName="Autumn" layout="11" gridCaptionField="bulan" isCaption="true" width="700" height="400" displayTitle="True" title="Target vs Realisasi Per Jenis Pajak Bulanan" displayLegend="True" displayLabels="True" displayGridLines="True" directionType="vertical" autoRotate="no" template="&lt;root&gt;
	&lt;schema name=&quot;Autumn&quot;&gt;
		&lt;mask/&gt;
		&lt;colors/&gt;
	&lt;/schema&gt;
	&lt;separator decimal=&quot;,&quot; group=&quot;&quot;/&gt;
	&lt;background border=&quot;yes&quot;/&gt;
	&lt;chartarea border=&quot;yes&quot;&gt;
		&lt;grid line_style=&quot;medium&quot; visible=&quot;yes&quot;/&gt;
		&lt;vertical_axis visible=&quot;yes&quot;/&gt;
		&lt;horizontal_axis visible=&quot;yes&quot; rotation=&quot;vertical&quot; autoRotate=&quot;no&quot;/&gt;
		&lt;chart line_thick=&quot;2&quot; enabled=&quot;yes&quot; type=&quot;3d_columns&quot; series=&quot;columns&quot;&gt;
			&lt;inscriptions visible=&quot;yes&quot;/&gt;
			&lt;animation type=&quot;none&quot;/&gt;
			&lt;markers size=&quot;8&quot; type=&quot;0&quot;/&gt;
			&lt;hints border=&quot;yes&quot; enabled=&quot;yes&quot;/&gt;
		&lt;/chart&gt;
		&lt;legend sqr_size=&quot;12&quot; sqr_borders=&quot;yes&quot; border_thick=&quot;0&quot; position=&quot;left-center&quot; layout=&quot;vertical&quot; visible=&quot;yes&quot;/&gt;
		&lt;title position=&quot;top&quot; align=&quot;center&quot; border=&quot;no&quot; alpha=&quot;100&quot; visible=&quot;yes&quot; text=&quot;Target vs Realisasi Per Jenis Pajak Bulanan&quot;/&gt;
	&lt;/chartarea&gt;
	&lt;objects&gt;
	&lt;/objects&gt;
	&lt;data&gt;
		&lt;columns&gt;
			&lt;column field=&quot;target_amount&quot; name=&quot;Target&quot;/&gt;&lt;column field=&quot;realisasi_amt&quot; name=&quot;Realisasi&quot;/&gt;&lt;/columns&gt;
		&lt;rows&gt;
			&lt;!-- BEGIN Row --&gt;&lt;row col1=&quot;{target_amount}&quot; col2=&quot;{realisasi_amt}&quot; name=&quot;{bulan}&quot;/&gt;&lt;!-- END Row --&gt;&lt;/rows&gt;
	&lt;/data&gt;
&lt;/root&gt;
">
			<Components/>
			<Events/>
			<Attributes/>
			<DataSeries>
				<Field id="912" fieldName="target_amount" alias="Target"/>
				<Field id="913" fieldName="realisasi_amt" alias="Realisasi"/>
			</DataSeries>
			<TableParameters/>
			<JoinTables/>
			<JoinLinks/>
			<Fields/>
			<AllFields>
				<Field id="893" fieldName="t_revenue_target_id"/>
				<Field id="894" fieldName="p_year_period_id"/>
				<Field id="895" fieldName="p_vat_type_id"/>
				<Field id="896" fieldName="target_code"/>
				<Field id="897" fieldName="target_amt"/>
				<Field id="898" fieldName="description"/>
				<Field id="899" fieldName="creation_date"/>
				<Field id="900" fieldName="created_by"/>
				<Field id="901" fieldName="updated_date"/>
				<Field id="902" fieldName="updated_by"/>
				<Field id="903" fieldName="vat_code"/>
				<Field id="904" fieldName="year_code"/>
				<Field id="905" fieldName="bulan"/>
				<Field id="906" fieldName="start_date"/>
				<Field id="907" fieldName="target_amount"/>
				<Field id="909" fieldName="realisasi_amt"/>
			</AllFields>
			<SelectedFields>
				<Field id="908" fieldName="target_amount" isExpression="True"/>
				<Field id="910" fieldName="realisasi_amt" isExpression="True"/>
				<Field id="911" fieldName="bulan" isExpression="True"/>
			</SelectedFields>
			<SPParameters/>
			<SQLParameters>
				<SQLParameter id="892" variable="t_revenue_target_id" parameterType="URL" defaultValue="0" dataType="Float" parameterSource="t_revenue_target_id"/>
			</SQLParameters>
			<SecurityGroups/>
			<Features/>
		</FlashChart>
		<FlashChart id="914" secured="False" dataSeriesIn="Columns" chartType="3d_columns" sourceType="SQL" defaultPageSize="25" returnValueType="Number" name="t_target_realisasi_jenis_bulanFlashbulan" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_target_realisasi_jenis_bulanFlashbulan" connection="ConnSIKP" activeCollection="SQLParameters" parameterTypeListName="ParameterTypeList" dataSource="SELECT bulan, sum(target_amount) AS Target, sum(realisasi_amt) AS Realisasi
FROM v_revenue_target_vs_realisasi_month
WHERE p_year_period_id = 
	(select p_year_period_id from t_revenue_target
	where t_revenue_target_id = {t_revenue_target_id}
	)
GROUP BY bulan, start_date 
ORDER BY start_date" schemaName="{user}_Autumn 3" layout="11" gridCaptionField="bulan" isCaption="true" width="700" height="400" displayTitle="True" title="Target vs Realisasi Bulanan" displayLegend="True" displayLabels="True" displayGridLines="True" directionType="vertical" autoRotate="no" template="&lt;root&gt;
	&lt;schema name=&quot;Autumn&quot;&gt;
		&lt;mask name=&quot;0&quot;/&gt;
		&lt;colors&gt;&lt;color value=&quot;297CC0&quot;/&gt;&lt;color value=&quot;F8C909&quot;/&gt;&lt;color value=&quot;67AA0D&quot;/&gt;&lt;color value=&quot;F74A22&quot;/&gt;&lt;color value=&quot;2EABA7&quot;/&gt;&lt;color value=&quot;FF9000&quot;/&gt;&lt;color value=&quot;293CBC&quot;/&gt;&lt;color value=&quot;9E9EF2&quot;/&gt;&lt;color value=&quot;4FC634&quot;/&gt;&lt;color value=&quot;347821&quot;/&gt;&lt;color value=&quot;0CABED&quot;/&gt;&lt;color value=&quot;FDC782&quot;/&gt;&lt;color value=&quot;028B98&quot;/&gt;&lt;color value=&quot;5A75D7&quot;/&gt;&lt;color value=&quot;BF1800&quot;/&gt;&lt;color value=&quot;DB75F4&quot;/&gt;&lt;color value=&quot;5EE2FF&quot;/&gt;&lt;color value=&quot;F0007D&quot;/&gt;&lt;color value=&quot;97ABBF&quot;/&gt;&lt;color value=&quot;CAE89C&quot;/&gt;&lt;color value=&quot;FFF69B&quot;/&gt;&lt;color value=&quot;DD420E&quot;/&gt;&lt;color value=&quot;A6FD8C&quot;/&gt;&lt;color value=&quot;E7C339&quot;/&gt;&lt;color value=&quot;E0D4F9&quot;/&gt;&lt;color value=&quot;FDDD88&quot;/&gt;&lt;color value=&quot;D7EAFD&quot;/&gt;&lt;color value=&quot;9ED4EE&quot;/&gt;&lt;color value=&quot;5A75D7&quot;/&gt;&lt;color value=&quot;B6B209&quot;/&gt;&lt;color value=&quot;D4B8CA&quot;/&gt;&lt;color value=&quot;4E89F6&quot;/&gt;&lt;color value=&quot;F7575F&quot;/&gt;&lt;color value=&quot;95CACC&quot;/&gt;&lt;color value=&quot;CBDAFB&quot;/&gt;&lt;color value=&quot;D7DD89&quot;/&gt;&lt;color value=&quot;C1C8CF&quot;/&gt;&lt;color value=&quot;CB8A53&quot;/&gt;&lt;color value=&quot;D0DDC4&quot;/&gt;&lt;color value=&quot;EF8C2F&quot;/&gt;&lt;/colors&gt;
	&lt;/schema&gt;
	&lt;separator decimal=&quot;,&quot; group=&quot;&quot;/&gt;
	&lt;background border=&quot;yes&quot; beginColor=&quot;FFFFFF&quot; endColor=&quot;FFFFFF&quot; color=&quot;FFFFFF&quot; gradient=&quot;no&quot;/&gt;
	&lt;chartarea border=&quot;yes&quot; alpha=&quot;100&quot; beginColor=&quot;c9c8ac&quot; endColor=&quot;f6f6d6&quot; bgcolor=&quot;c9c8ac&quot; gradient=&quot;yes&quot;&gt;
		&lt;grid line_style=&quot;medium&quot; alpha=&quot;100&quot; color=&quot;8e8d65&quot; visible=&quot;yes&quot;/&gt;
		&lt;vertical_axis visible=&quot;yes&quot;&gt;&lt;font face=&quot;Verdana&quot; size=&quot;11&quot; color=&quot;605f43&quot; bold=&quot;no&quot; italic=&quot;no&quot; uline=&quot;no&quot;/&gt;&lt;/vertical_axis&gt;
		&lt;horizontal_axis visible=&quot;yes&quot; rotation=&quot;vertical&quot; autoRotate=&quot;no&quot;&gt;&lt;font face=&quot;Verdana&quot; size=&quot;11&quot; color=&quot;605f43&quot; bold=&quot;no&quot; italic=&quot;no&quot; uline=&quot;no&quot;/&gt;&lt;/horizontal_axis&gt;
		&lt;chart line_thick=&quot;2&quot; enabled=&quot;yes&quot; border=&quot;yes&quot; alpha=&quot;100&quot; isBorderBright=&quot;yes&quot; type=&quot;3d_columns&quot; series=&quot;columns&quot;&gt;
			&lt;inscriptions color=&quot;605f43&quot; visible=&quot;yes&quot;&gt;&lt;font face=&quot;Verdana&quot; size=&quot;11&quot; bold=&quot;no&quot; italic=&quot;no&quot; uline=&quot;no&quot;/&gt;&lt;/inscriptions&gt;
			&lt;animation type=&quot;none&quot; time=&quot;2000&quot;/&gt;
			&lt;markers size=&quot;8&quot; type=&quot;0&quot;/&gt;
			&lt;hints border=&quot;yes&quot; enabled=&quot;yes&quot; color=&quot;FFFF99&quot;&gt;&lt;font face=&quot;Verdana&quot; size=&quot;11&quot; color=&quot;605f43&quot; bold=&quot;no&quot; italic=&quot;no&quot; uline=&quot;no&quot;/&gt;&lt;/hints&gt;
		&lt;/chart&gt;
		&lt;legend sqr_size=&quot;12&quot; sqr_borders=&quot;yes&quot; border_thick=&quot;0&quot; alpha=&quot;100&quot; position=&quot;left-center&quot; layout=&quot;vertical&quot; visible=&quot;yes&quot;&gt;&lt;font face=&quot;Verdana&quot; size=&quot;11&quot; color=&quot;605f43&quot; bold=&quot;no&quot; italic=&quot;no&quot; uline=&quot;no&quot;/&gt;&lt;/legend&gt;
		&lt;title position=&quot;top&quot; align=&quot;center&quot; border=&quot;no&quot; alpha=&quot;100&quot; visible=&quot;yes&quot; text=&quot;Target vs Realisasi Bulanan&quot;&gt;&lt;font face=&quot;Verdana&quot; size=&quot;11&quot; color=&quot;000000&quot; bold=&quot;no&quot; italic=&quot;no&quot; uline=&quot;no&quot;/&gt;&lt;/title&gt;
	&lt;/chartarea&gt;
	&lt;objects&gt;
	&lt;/objects&gt;
	&lt;data&gt;
		&lt;columns&gt;
			&lt;column field=&quot;target&quot; name=&quot;Target&quot;/&gt;&lt;column field=&quot;realisasi&quot; name=&quot;Realisasi&quot;/&gt;&lt;/columns&gt;
		&lt;rows&gt;
			&lt;!-- BEGIN Row --&gt;&lt;row col1=&quot;{target}&quot; col2=&quot;{realisasi}&quot; name=&quot;{bulan}&quot;/&gt;&lt;!-- END Row --&gt;&lt;/rows&gt;
	&lt;/data&gt;
&lt;/root&gt;
">
			<Components/>
			<Events/>
			<Attributes/>
			<DataSeries>
				<Field id="922" fieldName="target" alias="Target"/>
				<Field id="923" fieldName="realisasi" alias="Realisasi"/>
			</DataSeries>
			<TableParameters/>
			<JoinTables/>
			<JoinLinks/>
			<Fields/>
			<AllFields>
				<Field id="916" fieldName="bulan"/>
				<Field id="917" fieldName="target"/>
				<Field id="919" fieldName="realisasi"/>
			</AllFields>
			<SelectedFields>
				<Field id="918" fieldName="target" isExpression="True"/>
				<Field id="920" fieldName="realisasi" isExpression="True"/>
				<Field id="921" fieldName="bulan" isExpression="True"/>
			</SelectedFields>
			<SPParameters/>
			<SQLParameters>
				<SQLParameter id="915" variable="t_revenue_target_id" parameterType="URL" defaultValue="0" dataType="Float" parameterSource="t_revenue_target_id"/>
			</SQLParameters>
			<SecurityGroups/>
			<Features/>
		</FlashChart>
	</Components>
	<CodeFiles>
		<CodeFile id="Events" language="PHPTemplates" name="t_target_realisasi_jenis_bulan_events.php" forShow="False" comment="//" codePage="windows-1252"/>
		<CodeFile id="Code" language="PHPTemplates" name="t_target_realisasi_jenis_bulan.php" forShow="True" url="t_target_realisasi_jenis_bulan.php" comment="//" codePage="windows-1252"/>
		<CodeFile id="FlashChartXML891" language="PHPTemplates" name="t_target_realisasi_jenis_bulant_target_realisasi_jenis_bulanFlashjenis_bulan.xml" forShow="False" comment="&lt;!--" commentEnd="--&gt;" codePage="windows-1252"/>
		<CodeFile id="FlashChartXML914" language="PHPTemplates" name="t_target_realisasi_jenis_bulant_target_realisasi_jenis_bulanFlashbulan.xml" forShow="False" comment="&lt;!--" commentEnd="--&gt;" codePage="windows-1252"/>
	</CodeFiles>
	<SecurityGroups/>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events>
	</Events>
</Page>
