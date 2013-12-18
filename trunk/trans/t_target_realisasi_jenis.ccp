<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\trans" secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="RWNet" wizardThemeVersion="3.0" needGeneration="0" pasteActions="pasteActions" connection="ConnSIKP">
	<Components>
		<Grid id="2" secured="False" sourceType="SQL" returnValueType="Number" defaultPageSize="5" connection="ConnSIKP" name="t_target_realisasi_jenisGrid" pageSizeLimit="100" wizardCaption="List of P App Role " wizardGridType="Tabular" wizardAllowInsert="True" wizardAltRecord="True" wizardAltRecordType="Style" wizardRecordSeparator="False" wizardNoRecords="-" pasteAsReplace="pasteAsReplace" pasteActions="pasteActions" activeCollection="TableParameters" parameterTypeListName="ParameterTypeList" dataSource="SELECT t_revenue_target_id, p_year_period_id, p_vat_type_id, vat_code, year_code, target_amount, realisasi_amt
FROM v_revenue_target_vs_realisasi
WHERE p_year_period_id = {p_year_period_id} 
ORDER BY p_vat_type_id" orderBy="p_vat_type_id">
			<Components>
				<Navigator id="22" size="10" type="Centered" pageSizes="1;5;10;25;50" name="Navigator" wizardPagingType="Custom" wizardFirst="True" wizardFirstText="First" wizardPrev="True" wizardPrevText="Prev" wizardNext="True" wizardNextText="Next" wizardLast="True" wizardLastText="Last" wizardImages="Images" wizardPageNumbers="Centered" wizardSize="10" wizardTotalPages="False" wizardHideDisabled="False" wizardOfText="of" wizardPageSize="False" wizardUsePageScroller="True">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Navigator>
				<Label id="676" fieldSourceType="DBColumn" dataType="Text" html="False" name="realisasi_amt" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_target_realisasi_jenisGridrealisasi_amt" fieldSource="realisasi_amt">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Link id="690" visible="Yes" fieldSourceType="CodeExpression" dataType="Text" html="True" hrefType="Page" urlType="Relative" preserveParameters="GET" name="DLink" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_target_realisasi_jenisGridDLink" hrefSource="t_target_realisasi_jenis.ccp" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="763" sourceType="DataField" name="t_revenue_target_id" source="t_revenue_target_id"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
				<Label id="679" fieldSourceType="DBColumn" dataType="Text" html="False" name="target_amount" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_target_realisasi_jenisGridtarget_amount" fieldSource="target_amount">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Hidden id="692" fieldSourceType="DBColumn" dataType="Float" name="p_year_period_id" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_target_realisasi_jenisGridp_year_period_id" fieldSource="p_year_period_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Label id="719" fieldSourceType="DBColumn" dataType="Text" html="False" name="year_code" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_target_realisasi_jenisGridyear_code" fieldSource="year_code">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="720" fieldSourceType="DBColumn" dataType="Text" html="False" name="vat_code" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_target_realisasi_jenisGridvat_code" fieldSource="vat_code">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Hidden id="762" fieldSourceType="DBColumn" dataType="Float" name="p_vat_type_id" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_target_realisasi_jenisGridp_vat_type_id" fieldSource="p_vat_type_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="868" fieldSourceType="DBColumn" dataType="Text" name="t_revenue_target_id" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_target_realisasi_jenisGridt_revenue_target_id">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Hidden>
<Hidden id="869" fieldSourceType="DBColumn" dataType="Text" name="p_year_period_id2" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_target_realisasi_jenisGridp_year_period_id2">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Hidden>
</Components>
			<Events>
				<Event name="BeforeSelect" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="693"/>
					</Actions>
				</Event>
				<Event name="BeforeShowRow" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="694"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
				<TableParameter id="718" conditionType="Parameter" useIsNull="False" field="p_year_period_id" dataType="Float" searchConditionType="Equal" parameterType="URL" logicOperator="And" DBFormat="0" parameterSource="p_year_period_id"/>
			</TableParameters>
			<JoinTables>
				<JoinTable id="717" tableName="v_revenue_target_vs_realisasi" schemaName="sikp" posLeft="10" posTop="10" posWidth="150" posHeight="180"/>
			</JoinTables>
			<JoinLinks/>
			<Fields>
				<Field id="870" fieldName="*"/>
</Fields>
			<SPParameters/>
			<SQLParameters>
				<SQLParameter id="677" parameterType="URL" variable="p_year_period_id" dataType="Float" parameterSource="p_year_period_id" DBFormat="0"/>
			</SQLParameters>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Grid>
		<FlashChart id="696" secured="False" dataSeriesIn="Columns" chartType="3d_pie" sourceType="SQL" defaultPageSize="25" returnValueType="Number" name="per_pajak" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="per_pajak" connection="ConnSIKP" activeCollection="SQLParameters" schemaName="Autumn" layout="5" gridCaptionField="-1" width="400" height="300" displayTitle="True" title="Target vs Realisasi Per Jenis Pajak" displayLegend="True" displayLabels="True" displayGridLines="True" directionType="vertical" autoRotate="no" template="&lt;root&gt;
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
		&lt;chart line_thick=&quot;2&quot; enabled=&quot;yes&quot; type=&quot;3d_pie&quot; series=&quot;columns&quot;&gt;
			&lt;inscriptions visible=&quot;yes&quot;/&gt;
			&lt;animation type=&quot;none&quot;/&gt;
			&lt;markers size=&quot;8&quot; type=&quot;0&quot;/&gt;
			&lt;hints border=&quot;yes&quot; enabled=&quot;yes&quot;/&gt;
		&lt;/chart&gt;
		&lt;legend sqr_size=&quot;12&quot; sqr_borders=&quot;yes&quot; border_thick=&quot;0&quot; position=&quot;right-center&quot; layout=&quot;vertical&quot; visible=&quot;yes&quot;/&gt;
		&lt;title position=&quot;top&quot; align=&quot;center&quot; border=&quot;no&quot; alpha=&quot;100&quot; visible=&quot;yes&quot; text=&quot;Target vs Realisasi Per Jenis Pajak&quot;/&gt;
	&lt;/chartarea&gt;
	&lt;objects&gt;
	&lt;/objects&gt;
	&lt;data&gt;
		&lt;columns&gt;
			&lt;column field=&quot;target_amount&quot; name=&quot;Target&quot;/&gt;&lt;column field=&quot;realisasi_amt&quot; name=&quot;Realisasi&quot;/&gt;&lt;/columns&gt;
		&lt;rows&gt;&lt;!-- BEGIN Row --&gt;&lt;row col1=&quot;{target_amount}&quot; col2=&quot;{realisasi_amt}&quot;/&gt;&lt;!-- END Row --&gt;&lt;/rows&gt;&lt;/data&gt;
&lt;/root&gt;
" dataSource="SELECT target_amount, realisasi_amt
FROM v_revenue_target_vs_realisasi
WHERE t_revenue_target_id = {t_revenue_target_id}
ORDER BY p_vat_type_id" orderBy="p_vat_type_id" parameterTypeListName="ParameterTypeList">
			<Components/>
			<Events/>
			<Attributes/>
			<DataSeries>
				<Field id="877" fieldName="target_amount" alias="Target"/>
<Field id="878" fieldName="realisasi_amt" alias="Realisasi"/>
</DataSeries>
			<TableParameters>
				<TableParameter id="722" conditionType="Parameter" useIsNull="False" field="p_year_period_id" dataType="Float" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="p_year_period_id"/>
				<TableParameter id="761" conditionType="Parameter" useIsNull="False" field="p_vat_type_id" dataType="Float" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="p_vat_type_id"/>
			</TableParameters>
			<JoinTables>
				<JoinTable id="721" tableName="v_revenue_target_vs_realisasi" schemaName="sikp" posLeft="10" posTop="10" posWidth="150" posHeight="180"/>
			</JoinTables>
			<JoinLinks/>
			<Fields>
			</Fields>
			<AllFields>
				<Field id="873" fieldName="target_amount"/>
<Field id="875" fieldName="realisasi_amt"/>
</AllFields>
			<SelectedFields>
				<Field id="874" fieldName="target_amount" isExpression="True"/>
<Field id="876" fieldName="realisasi_amt" isExpression="True"/>
</SelectedFields>
			<SPParameters/>
			<SQLParameters>
<SQLParameter id="872" parameterType="URL" variable="t_revenue_target_id" dataType="Float" parameterSource="t_revenue_target_id" defaultValue="0"/>
</SQLParameters>
			<SecurityGroups/>
			<Features/>
		</FlashChart>
		<FlashChart id="764" secured="False" dataSeriesIn="Columns" chartType="3d_columns" sourceType="Table" defaultPageSize="25" returnValueType="Number" name="per_tahun" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="per_tahun" connection="ConnSIKP" dataSource="v_revenue_target_vs_realisasi" activeCollection="TableParameters" schemaName="Autumn" layout="6" gridCaptionField="vat_code" isCaption="true" width="400" height="300" displayTitle="True" title="Target vs Realisasi Tahunan" displayLegend="True" displayLabels="True" displayGridLines="True" directionType="degrees" autoRotate="yes" template="&lt;root&gt;
	&lt;schema name=&quot;Autumn&quot;&gt;
		&lt;mask/&gt;
		&lt;colors/&gt;
	&lt;/schema&gt;
	&lt;separator decimal=&quot;,&quot; group=&quot;&quot;/&gt;
	&lt;background border=&quot;yes&quot;/&gt;
	&lt;chartarea border=&quot;yes&quot;&gt;
		&lt;grid line_style=&quot;medium&quot; visible=&quot;yes&quot;/&gt;
		&lt;vertical_axis visible=&quot;yes&quot;/&gt;
		&lt;horizontal_axis visible=&quot;yes&quot; rotation=&quot;degrees&quot; autoRotate=&quot;yes&quot;/&gt;
		&lt;chart line_thick=&quot;2&quot; enabled=&quot;yes&quot; type=&quot;3d_columns&quot; series=&quot;columns&quot;&gt;
			&lt;inscriptions visible=&quot;yes&quot;/&gt;
			&lt;animation type=&quot;none&quot;/&gt;
			&lt;markers size=&quot;8&quot; type=&quot;0&quot;/&gt;
			&lt;hints border=&quot;yes&quot; enabled=&quot;yes&quot;/&gt;
		&lt;/chart&gt;
		&lt;legend sqr_size=&quot;12&quot; sqr_borders=&quot;yes&quot; border_thick=&quot;0&quot; position=&quot;right-bottom&quot; layout=&quot;vertical&quot; visible=&quot;yes&quot;/&gt;
		&lt;title position=&quot;top&quot; align=&quot;center&quot; border=&quot;no&quot; alpha=&quot;100&quot; visible=&quot;yes&quot; text=&quot;Target vs Realisasi Tahunan&quot;/&gt;
	&lt;/chartarea&gt;
	&lt;objects&gt;
	&lt;/objects&gt;
	&lt;data&gt;
		&lt;columns&gt;
			&lt;column field=&quot;target_amount&quot; name=&quot;target_amount&quot;/&gt;&lt;column field=&quot;realisasi_amt&quot; name=&quot;realisasi_amt&quot;/&gt;&lt;/columns&gt;
		&lt;rows&gt;&lt;!-- BEGIN Row --&gt;&lt;row col1=&quot;{target_amount}&quot; col2=&quot;{realisasi_amt}&quot; name=&quot;{vat_code}&quot;/&gt;&lt;!-- END Row --&gt;&lt;/rows&gt;&lt;/data&gt;
&lt;/root&gt;
" orderBy="p_vat_type_id">
			<Components/>
			<Events/>
			<Attributes/>
			<DataSeries>
				<Field id="803" fieldName="target_amount" alias="Target"/>
				<Field id="804" fieldName="realisasi_amt" alias="Realisasi"/>
			</DataSeries>
			<TableParameters>
				<TableParameter id="766" conditionType="Parameter" useIsNull="False" field="p_year_period_id" dataType="Float" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="p_year_period_id"/>
			</TableParameters>
			<JoinTables>
				<JoinTable id="765" tableName="v_revenue_target_vs_realisasi" schemaName="sikp" posLeft="10" posTop="10" posWidth="150" posHeight="180"/>
			</JoinTables>
			<JoinLinks/>
			<Fields/>
			<AllFields>
				<Field id="786" fieldName="t_revenue_target_id"/>
				<Field id="787" fieldName="p_year_period_id"/>
				<Field id="788" fieldName="p_vat_type_id"/>
				<Field id="789" fieldName="target_code"/>
				<Field id="790" fieldName="target_amt"/>
				<Field id="791" fieldName="description"/>
				<Field id="792" fieldName="creation_date"/>
				<Field id="793" fieldName="created_by"/>
				<Field id="794" fieldName="updated_date"/>
				<Field id="795" fieldName="updated_by"/>
				<Field id="796" fieldName="vat_code"/>
				<Field id="797" fieldName="year_code"/>
				<Field id="798" fieldName="target_amount"/>
				<Field id="800" fieldName="realisasi_amt"/>
			</AllFields>
			<SelectedFields>
				<Field id="799" tableName="v_revenue_target_vs_realisasi" fieldName="target_amount" isExpression="False"/>
				<Field id="801" tableName="v_revenue_target_vs_realisasi" fieldName="realisasi_amt" isExpression="False"/>
				<Field id="802" tableName="v_revenue_target_vs_realisasi" fieldName="vat_code" isExpression="False"/>
			</SelectedFields>
			<SPParameters/>
			<SQLParameters/>
			<SecurityGroups/>
			<Features/>
		</FlashChart>
	</Components>
	<CodeFiles>
		<CodeFile id="FlashChartXML696" language="PHPTemplates" name="t_target_realisasi_jenisper_pajak.xml" forShow="False" comment="&lt;!--" commentEnd="--&gt;" codePage="windows-1252"/>
		<CodeFile id="Events" language="PHPTemplates" name="t_target_realisasi_jenis_events.php" forShow="False" comment="//" codePage="windows-1252"/>
		<CodeFile id="Code" language="PHPTemplates" name="t_target_realisasi_jenis.php" forShow="True" url="t_target_realisasi_jenis.php" comment="//" codePage="windows-1252"/>
		<CodeFile id="FlashChartXML764" language="PHPTemplates" name="t_target_realisasi_jenisper_tahun.xml" forShow="False" comment="&lt;!--" commentEnd="--&gt;" codePage="windows-1252"/>
	</CodeFiles>
	<SecurityGroups/>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events>
		<Event name="OnInitializeView" type="Server">
			<Actions>
				<Action actionName="Custom Code" actionCategory="General" id="66"/>
			</Actions>
		</Event>
	</Events>
</Page>
