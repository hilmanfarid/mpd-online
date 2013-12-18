<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\trans" secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="RWNet" wizardThemeVersion="3.0" needGeneration="0" pasteActions="pasteActions" connection="ConnSIKP">
	<Components>
		<Grid id="2" secured="False" sourceType="SQL" returnValueType="Number" defaultPageSize="31" connection="ConnSIKP" name="t_status_pembayaran_pajak_sudah_bayarGrid" pageSizeLimit="100" wizardCaption="List of P App Role " wizardGridType="Tabular" wizardAllowInsert="True" wizardAltRecord="True" wizardAltRecordType="Style" wizardRecordSeparator="False" wizardNoRecords="-" pasteAsReplace="pasteAsReplace" pasteActions="pasteActions" activeCollection="SQLParameters" parameterTypeListName="ParameterTypeList" dataSource="select * from f_status_sudah_bayar({p_finance_period_id})">
			<Components>
				<Navigator id="22" size="10" type="Centered" pageSizes="1;5;10;25;50" name="Navigator" wizardPagingType="Custom" wizardFirst="True" wizardFirstText="First" wizardPrev="True" wizardPrevText="Prev" wizardNext="True" wizardNextText="Next" wizardLast="True" wizardLastText="Last" wizardImages="Images" wizardPageNumbers="Centered" wizardSize="10" wizardTotalPages="False" wizardHideDisabled="False" wizardOfText="of" wizardPageSize="False" wizardUsePageScroller="True">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Navigator>
				<Label id="555" fieldSourceType="DBColumn" dataType="Text" html="False" name="tgl_pelaporan" fieldSource="tgl_pelaporan" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="t_status_pembayaran_pajak_sudah_bayarGridtgl_pelaporan">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="676" fieldSourceType="DBColumn" dataType="Text" html="False" name="nilai_denda" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_status_pembayaran_pajak_sudah_bayarGridnilai_denda" fieldSource="nilai_denda">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="696" fieldSourceType="DBColumn" dataType="Text" html="False" name="jml_wp_bayar" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_status_pembayaran_pajak_sudah_bayarGridjml_wp_bayar" fieldSource="jml_wp_bayar">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Hidden id="698" fieldSourceType="DBColumn" dataType="Float" name="p_finance_period_id" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_status_pembayaran_pajak_sudah_bayarGridp_finance_period_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="702" fieldSourceType="DBColumn" dataType="Text" name="status_bayar" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_status_pembayaran_pajak_sudah_bayarGridstatus_bayar">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Label id="697" fieldSourceType="DBColumn" dataType="Text" html="False" name="nilai_bayar" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_status_pembayaran_pajak_sudah_bayarGridnilai_bayar" fieldSource="nilai_bayar">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="703" fieldSourceType="DBColumn" dataType="Text" html="False" name="nilai_ketetapan" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_status_pembayaran_pajak_sudah_bayarGridnilai_ketetapan" fieldSource="nilai_ketetapan">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
			</Components>
			<Events>
				<Event name="BeforeShowRow" type="Server">
					<Actions>
						<Action actionName="Set Row Style" actionCategory="General" id="10" styles="Row;AltRow" name="rowStyle"/>
					</Actions>
				</Event>
				<Event name="BeforeSelect" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="129"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
				<TableParameter id="623" conditionType="Parameter" useIsNull="False" field="legal_doc_desc" dataType="Text" searchConditionType="Contains" parameterType="URL" logicOperator="And" parameterSource="s_keyword"/>
				<TableParameter id="675" conditionType="Parameter" useIsNull="False" field="t_customer_order_id" dataType="Float" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="t_customer_order_id"/>
			</TableParameters>
			<JoinTables>
			</JoinTables>
			<JoinLinks/>
			<Fields>
				<Field id="457" fieldName="*"/>
			</Fields>
			<SPParameters/>
			<SQLParameters>
				<SQLParameter id="677" parameterType="URL" variable="p_finance_period_id" dataType="Float" parameterSource="p_finance_period_id" defaultValue="0"/>
			</SQLParameters>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Grid>
		<FlashChart id="704" secured="False" dataSeriesIn="Columns" chartType="3d_columns" sourceType="SQL" defaultPageSize="25" returnValueType="Number" name="jml_wp_bayar" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="jml_wp_bayar" connection="ConnSIKP" dataSource="select tgl, jml_wp_bayar from f_status_sudah_bayar({p_finance_period_id})" activeCollection="SQLParameters" parameterTypeListName="ParameterTypeList" schemaName="Autumn" layout="11" gridCaptionField="-1" isCaption="true" width="400" height="300" displayTitle="True" title="Jumlah WP Bayar" displayLegend="False" displayLabels="True" displayGridLines="True" directionType="degrees" autoRotate="yes" template="&lt;root&gt;
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
		&lt;legend sqr_size=&quot;12&quot; sqr_borders=&quot;yes&quot; border_thick=&quot;0&quot; position=&quot;left-center&quot; layout=&quot;vertical&quot; visible=&quot;no&quot;/&gt;
		&lt;title position=&quot;top&quot; align=&quot;center&quot; border=&quot;no&quot; alpha=&quot;100&quot; visible=&quot;yes&quot; text=&quot;Jumlah WP Bayar&quot;/&gt;
	&lt;/chartarea&gt;
	&lt;objects&gt;
	&lt;/objects&gt;
	&lt;data&gt;
		&lt;columns&gt;
			&lt;column field=&quot;jml_wp_bayar&quot; name=&quot;jml_wp_bayar&quot;/&gt;&lt;/columns&gt;
		&lt;rows&gt;&lt;!-- BEGIN Row --&gt;&lt;row col1=&quot;{jml_wp_bayar}&quot;/&gt;&lt;!-- END Row --&gt;&lt;/rows&gt;&lt;/data&gt;
&lt;/root&gt;
">
<Components/>
<Events/>
<Attributes/>
<DataSeries/>
<TableParameters/>
<JoinTables/>
<JoinLinks/>
<Fields/>
<AllFields/>
<SelectedFields/>
<SPParameters/>
<SQLParameters>
<SQLParameter id="705" variable="p_finance_period_id" parameterType="URL" defaultValue="0" dataType="Float" parameterSource="p_finance_period_id"/>
</SQLParameters>
<SecurityGroups/>
<Features/>
</FlashChart>
<FlashChart id="713" secured="False" dataSeriesIn="Columns" chartType="3d_columns" sourceType="SQL" defaultPageSize="25" returnValueType="Number" name="nilai_ketetapan" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="nilai_ketetapan" connection="ConnSIKP" activeCollection="SQLParameters" parameterTypeListName="ParameterTypeList" dataSource="select tgl, nilai_ketetapan from f_status_sudah_bayar(2)" schemaName="{user}_Autumn 1" layout="11" gridCaptionField="tgl" isCaption="true" width="400" height="300" displayTitle="True" title="Nilai Ketetapan" displayLegend="False" displayLabels="True" displayGridLines="True" directionType="degrees" autoRotate="yes" template="&lt;root&gt;
	&lt;schema name=&quot;Autumn&quot;&gt;
		&lt;mask name=&quot;0&quot;/&gt;
		&lt;colors&gt;&lt;color value=&quot;17DCDC&quot;/&gt;&lt;color value=&quot;FF9900&quot;/&gt;&lt;color value=&quot;03D803&quot;/&gt;&lt;color value=&quot;FFEA00&quot;/&gt;&lt;color value=&quot;FF0000&quot;/&gt;&lt;color value=&quot;0000FF&quot;/&gt;&lt;color value=&quot;5C2DB3&quot;/&gt;&lt;color value=&quot;993366&quot;/&gt;&lt;color value=&quot;CB07CB&quot;/&gt;&lt;color value=&quot;2AA7CB&quot;/&gt;&lt;color value=&quot;B3EF00&quot;/&gt;&lt;color value=&quot;6CF2F7&quot;/&gt;&lt;color value=&quot;6B3CE4&quot;/&gt;&lt;color value=&quot;A2D061&quot;/&gt;&lt;color value=&quot;A76DFF&quot;/&gt;&lt;color value=&quot;FC9F62&quot;/&gt;&lt;color value=&quot;FFCC00&quot;/&gt;&lt;color value=&quot;FF99CC&quot;/&gt;&lt;color value=&quot;5454E5&quot;/&gt;&lt;color value=&quot;C50404&quot;/&gt;&lt;color value=&quot;CC99FF&quot;/&gt;&lt;color value=&quot;E15603&quot;/&gt;&lt;color value=&quot;899CFF&quot;/&gt;&lt;color value=&quot;ED70AF&quot;/&gt;&lt;color value=&quot;FDF98B&quot;/&gt;&lt;color value=&quot;BE3EE3&quot;/&gt;&lt;color value=&quot;764BE5&quot;/&gt;&lt;color value=&quot;CDDF52&quot;/&gt;&lt;color value=&quot;00F439&quot;/&gt;&lt;color value=&quot;CCCCCB&quot;/&gt;&lt;color value=&quot;3DC681&quot;/&gt;&lt;color value=&quot;4193DF&quot;/&gt;&lt;color value=&quot;D5B94A&quot;/&gt;&lt;color value=&quot;C46B30&quot;/&gt;&lt;color value=&quot;037ADE&quot;/&gt;&lt;color value=&quot;FFDD56&quot;/&gt;&lt;color value=&quot;FF6600&quot;/&gt;&lt;color value=&quot;99CC00&quot;/&gt;&lt;color value=&quot;FFFF00&quot;/&gt;&lt;color value=&quot;DB214C&quot;/&gt;&lt;/colors&gt;
	&lt;/schema&gt;
	&lt;separator decimal=&quot;,&quot; group=&quot;&quot;/&gt;
	&lt;background border=&quot;yes&quot; beginColor=&quot;FFFFFF&quot; endColor=&quot;FFFFFF&quot; color=&quot;FFFFFF&quot; gradient=&quot;no&quot;/&gt;
	&lt;chartarea border=&quot;yes&quot; alpha=&quot;100&quot; beginColor=&quot;c9c8ac&quot; endColor=&quot;f6f6d6&quot; bgcolor=&quot;c9c8ac&quot; gradient=&quot;yes&quot;&gt;
		&lt;grid line_style=&quot;medium&quot; alpha=&quot;100&quot; color=&quot;8e8d65&quot; visible=&quot;yes&quot;/&gt;
		&lt;vertical_axis visible=&quot;yes&quot;&gt;&lt;font face=&quot;Verdana&quot; size=&quot;11&quot; color=&quot;605f43&quot; bold=&quot;no&quot; italic=&quot;no&quot; uline=&quot;no&quot;/&gt;&lt;/vertical_axis&gt;
		&lt;horizontal_axis visible=&quot;yes&quot; rotation=&quot;degrees&quot; autoRotate=&quot;yes&quot;&gt;&lt;font face=&quot;Verdana&quot; size=&quot;11&quot; color=&quot;605f43&quot; bold=&quot;no&quot; italic=&quot;no&quot; uline=&quot;no&quot;/&gt;&lt;/horizontal_axis&gt;
		&lt;chart line_thick=&quot;2&quot; enabled=&quot;yes&quot; border=&quot;yes&quot; alpha=&quot;100&quot; isBorderBright=&quot;yes&quot; type=&quot;3d_columns&quot; series=&quot;columns&quot;&gt;
			&lt;inscriptions color=&quot;605f43&quot; visible=&quot;yes&quot;&gt;&lt;font face=&quot;Verdana&quot; size=&quot;11&quot; bold=&quot;no&quot; italic=&quot;no&quot; uline=&quot;no&quot;/&gt;&lt;/inscriptions&gt;
			&lt;animation type=&quot;none&quot; time=&quot;2000&quot;/&gt;
			&lt;markers size=&quot;8&quot; type=&quot;0&quot;/&gt;
			&lt;hints border=&quot;yes&quot; enabled=&quot;yes&quot; color=&quot;FFFF99&quot;&gt;&lt;font face=&quot;Verdana&quot; size=&quot;11&quot; color=&quot;605f43&quot; bold=&quot;no&quot; italic=&quot;no&quot; uline=&quot;no&quot;/&gt;&lt;/hints&gt;
		&lt;/chart&gt;
		&lt;legend sqr_size=&quot;12&quot; sqr_borders=&quot;yes&quot; border_thick=&quot;0&quot; alpha=&quot;100&quot; position=&quot;left-center&quot; layout=&quot;vertical&quot; visible=&quot;no&quot;&gt;&lt;font face=&quot;Verdana&quot; size=&quot;11&quot; color=&quot;605f43&quot; bold=&quot;no&quot; italic=&quot;no&quot; uline=&quot;no&quot;/&gt;&lt;/legend&gt;
		&lt;title position=&quot;top&quot; align=&quot;center&quot; border=&quot;no&quot; alpha=&quot;100&quot; visible=&quot;yes&quot; text=&quot;Nilai Ketetapan&quot;&gt;&lt;font face=&quot;Verdana&quot; size=&quot;11&quot; color=&quot;000000&quot; bold=&quot;no&quot; italic=&quot;no&quot; uline=&quot;no&quot;/&gt;&lt;/title&gt;
	&lt;/chartarea&gt;
	&lt;objects&gt;
	&lt;/objects&gt;
	&lt;data&gt;
		&lt;columns&gt;
			&lt;column field=&quot;nilai_ketetapan&quot; name=&quot;Nilai Ketetapan&quot;/&gt;&lt;/columns&gt;
		&lt;rows&gt;
			&lt;!-- BEGIN Row --&gt;&lt;row col1=&quot;{nilai_ketetapan}&quot; name=&quot;{tgl}&quot;/&gt;&lt;!-- END Row --&gt;&lt;/rows&gt;
	&lt;/data&gt;
&lt;/root&gt;
">
<Components/>
<Events/>
<Attributes/>
<DataSeries>
<Field id="719" fieldName="nilai_ketetapan" alias="Nilai Ketetapan"/>
</DataSeries>
<TableParameters/>
<JoinTables/>
<JoinLinks/>
<Fields/>
<AllFields>
<Field id="715" fieldName="tgl"/>
<Field id="716" fieldName="nilai_ketetapan"/>
</AllFields>
<SelectedFields>
<Field id="717" fieldName="nilai_ketetapan" isExpression="True"/>
<Field id="718" fieldName="tgl" isExpression="True"/>
</SelectedFields>
<SPParameters/>
<SQLParameters>
<SQLParameter id="714" variable="p_finance_period_id" parameterType="URL" defaultValue="0" dataType="Float" parameterSource="p_finance_period_id"/>
</SQLParameters>
<SecurityGroups/>
<Features/>
</FlashChart>
<FlashChart id="706" secured="False" dataSeriesIn="Columns" chartType="3d_columns" sourceType="SQL" defaultPageSize="25" returnValueType="Number" name="nilai_bayar" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="nilai_bayar" connection="ConnSIKP" activeCollection="SQLParameters" parameterTypeListName="ParameterTypeList" dataSource="select tgl, nilai_bayar from f_status_sudah_bayar({p_finance_period_id})" schemaName="{user}_Autumn 2" layout="11" gridCaptionField="tgl" isCaption="true" width="400" height="300" displayTitle="True" title="Nilai Bayar" displayLegend="False" displayLabels="True" displayGridLines="True" directionType="degrees" autoRotate="yes" template="&lt;root&gt;
	&lt;schema name=&quot;Autumn&quot;&gt;
		&lt;mask name=&quot;0&quot;/&gt;
		&lt;colors&gt;&lt;color value=&quot;9999FF&quot;/&gt;&lt;color value=&quot;993366&quot;/&gt;&lt;color value=&quot;FFFFCC&quot;/&gt;&lt;color value=&quot;CCFFFF&quot;/&gt;&lt;color value=&quot;660066&quot;/&gt;&lt;color value=&quot;FF8080&quot;/&gt;&lt;color value=&quot;0066CC&quot;/&gt;&lt;color value=&quot;CCCCFF&quot;/&gt;&lt;color value=&quot;000080&quot;/&gt;&lt;color value=&quot;FF00FF&quot;/&gt;&lt;color value=&quot;FFFF00&quot;/&gt;&lt;color value=&quot;00FFFF&quot;/&gt;&lt;color value=&quot;800080&quot;/&gt;&lt;color value=&quot;800000&quot;/&gt;&lt;color value=&quot;008080&quot;/&gt;&lt;color value=&quot;0000FF&quot;/&gt;&lt;color value=&quot;00CCFF&quot;/&gt;&lt;color value=&quot;CCFFFF&quot;/&gt;&lt;color value=&quot;CCFFCC&quot;/&gt;&lt;color value=&quot;FFFF99&quot;/&gt;&lt;color value=&quot;99CCFF&quot;/&gt;&lt;color value=&quot;FF99CC&quot;/&gt;&lt;color value=&quot;CC99FF&quot;/&gt;&lt;color value=&quot;FFCC99&quot;/&gt;&lt;color value=&quot;3366FF&quot;/&gt;&lt;color value=&quot;33CCCC&quot;/&gt;&lt;color value=&quot;99CC00&quot;/&gt;&lt;color value=&quot;FFCC00&quot;/&gt;&lt;color value=&quot;FF9900&quot;/&gt;&lt;color value=&quot;FF6600&quot;/&gt;&lt;color value=&quot;666699&quot;/&gt;&lt;color value=&quot;969696&quot;/&gt;&lt;color value=&quot;003265&quot;/&gt;&lt;color value=&quot;339966&quot;/&gt;&lt;color value=&quot;003300&quot;/&gt;&lt;color value=&quot;993300&quot;/&gt;&lt;color value=&quot;333399&quot;/&gt;&lt;color value=&quot;993366&quot;/&gt;&lt;color value=&quot;FF0000&quot;/&gt;&lt;color value=&quot;00FF00&quot;/&gt;&lt;/colors&gt;
	&lt;/schema&gt;
	&lt;separator decimal=&quot;,&quot; group=&quot;&quot;/&gt;
	&lt;background border=&quot;yes&quot; beginColor=&quot;FFFFFF&quot; endColor=&quot;FFFFFF&quot; color=&quot;FFFFFF&quot; gradient=&quot;no&quot;/&gt;
	&lt;chartarea border=&quot;yes&quot; alpha=&quot;100&quot; beginColor=&quot;c9c8ac&quot; endColor=&quot;f6f6d6&quot; bgcolor=&quot;c9c8ac&quot; gradient=&quot;yes&quot;&gt;
		&lt;grid line_style=&quot;medium&quot; alpha=&quot;100&quot; color=&quot;8e8d65&quot; visible=&quot;yes&quot;/&gt;
		&lt;vertical_axis visible=&quot;yes&quot;&gt;&lt;font face=&quot;Verdana&quot; size=&quot;11&quot; color=&quot;605f43&quot;/&gt;&lt;/vertical_axis&gt;
		&lt;horizontal_axis visible=&quot;yes&quot; rotation=&quot;degrees&quot; autoRotate=&quot;yes&quot;&gt;&lt;font face=&quot;Verdana&quot; size=&quot;11&quot; color=&quot;605f43&quot;/&gt;&lt;/horizontal_axis&gt;
		&lt;chart line_thick=&quot;2&quot; enabled=&quot;yes&quot; border=&quot;yes&quot; alpha=&quot;100&quot; isBorderBright=&quot;yes&quot; type=&quot;3d_columns&quot; series=&quot;columns&quot;&gt;
			&lt;inscriptions color=&quot;605f43&quot; visible=&quot;yes&quot;&gt;&lt;font face=&quot;Verdana&quot; size=&quot;11&quot;/&gt;&lt;/inscriptions&gt;
			&lt;animation type=&quot;none&quot; time=&quot;2000&quot;/&gt;
			&lt;markers size=&quot;8&quot; type=&quot;0&quot;/&gt;
			&lt;hints border=&quot;yes&quot; enabled=&quot;yes&quot; color=&quot;FFFF99&quot;&gt;&lt;font face=&quot;Verdana&quot; size=&quot;11&quot; color=&quot;605f43&quot;/&gt;&lt;/hints&gt;
		&lt;/chart&gt;
		&lt;legend sqr_size=&quot;12&quot; sqr_borders=&quot;yes&quot; border_thick=&quot;0&quot; alpha=&quot;100&quot; position=&quot;left-center&quot; layout=&quot;vertical&quot; visible=&quot;no&quot;&gt;&lt;font face=&quot;Verdana&quot; size=&quot;11&quot; color=&quot;605f43&quot;/&gt;&lt;/legend&gt;
		&lt;title position=&quot;top&quot; align=&quot;center&quot; border=&quot;no&quot; alpha=&quot;100&quot; visible=&quot;yes&quot; text=&quot;Nilai Bayar&quot;&gt;&lt;font face=&quot;Verdana&quot; size=&quot;11&quot; color=&quot;000000&quot;/&gt;&lt;/title&gt;
	&lt;/chartarea&gt;
	&lt;objects&gt;
	&lt;/objects&gt;
	&lt;data&gt;
		&lt;columns&gt;
			&lt;column field=&quot;nilai_bayar&quot; name=&quot;Nilai Bayar&quot;/&gt;&lt;/columns&gt;
		&lt;rows&gt;
			&lt;!-- BEGIN Row --&gt;&lt;row col1=&quot;{nilai_bayar}&quot; name=&quot;{tgl}&quot;/&gt;&lt;!-- END Row --&gt;&lt;/rows&gt;
	&lt;/data&gt;
&lt;/root&gt;
">
<Components/>
<Events/>
<Attributes/>
<DataSeries>
<Field id="712" fieldName="nilai_bayar" alias="Nilai Bayar"/>
</DataSeries>
<TableParameters/>
<JoinTables/>
<JoinLinks/>
<Fields/>
<AllFields>
<Field id="708" fieldName="tgl"/>
<Field id="709" fieldName="nilai_bayar"/>
</AllFields>
<SelectedFields>
<Field id="710" fieldName="nilai_bayar" isExpression="True"/>
<Field id="711" fieldName="tgl" isExpression="True"/>
</SelectedFields>
<SPParameters/>
<SQLParameters>
<SQLParameter id="707" variable="p_finance_period_id" parameterType="URL" defaultValue="0" dataType="Float" parameterSource="p_finance_period_id"/>
</SQLParameters>
<SecurityGroups/>
<Features/>
</FlashChart>
<FlashChart id="720" secured="False" dataSeriesIn="Columns" chartType="3d_columns" sourceType="SQL" defaultPageSize="25" returnValueType="Number" name="nilai_denda" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="nilai_denda" connection="ConnSIKP" activeCollection="SQLParameters" parameterTypeListName="ParameterTypeList" dataSource="select tgl, nilai_denda from f_status_sudah_bayar(2)" schemaName="{user}_Autumn 3" layout="11" gridCaptionField="tgl" isCaption="true" width="400" height="300" displayTitle="True" title="Nilai Denda" displayLegend="False" displayLabels="True" displayGridLines="True" directionType="degrees" autoRotate="yes" template="&lt;root&gt;
	&lt;schema name=&quot;Autumn&quot;&gt;
		&lt;mask name=&quot;0&quot;/&gt;
		&lt;colors&gt;&lt;color value=&quot;297CC0&quot;/&gt;&lt;color value=&quot;F8C909&quot;/&gt;&lt;color value=&quot;67AA0D&quot;/&gt;&lt;color value=&quot;F74A22&quot;/&gt;&lt;color value=&quot;2EABA7&quot;/&gt;&lt;color value=&quot;FF9000&quot;/&gt;&lt;color value=&quot;293CBC&quot;/&gt;&lt;color value=&quot;9E9EF2&quot;/&gt;&lt;color value=&quot;4FC634&quot;/&gt;&lt;color value=&quot;347821&quot;/&gt;&lt;color value=&quot;0CABED&quot;/&gt;&lt;color value=&quot;FDC782&quot;/&gt;&lt;color value=&quot;028B98&quot;/&gt;&lt;color value=&quot;5A75D7&quot;/&gt;&lt;color value=&quot;BF1800&quot;/&gt;&lt;color value=&quot;DB75F4&quot;/&gt;&lt;color value=&quot;5EE2FF&quot;/&gt;&lt;color value=&quot;F0007D&quot;/&gt;&lt;color value=&quot;97ABBF&quot;/&gt;&lt;color value=&quot;CAE89C&quot;/&gt;&lt;color value=&quot;FFF69B&quot;/&gt;&lt;color value=&quot;DD420E&quot;/&gt;&lt;color value=&quot;A6FD8C&quot;/&gt;&lt;color value=&quot;E7C339&quot;/&gt;&lt;color value=&quot;E0D4F9&quot;/&gt;&lt;color value=&quot;FDDD88&quot;/&gt;&lt;color value=&quot;D7EAFD&quot;/&gt;&lt;color value=&quot;9ED4EE&quot;/&gt;&lt;color value=&quot;5A75D7&quot;/&gt;&lt;color value=&quot;B6B209&quot;/&gt;&lt;color value=&quot;D4B8CA&quot;/&gt;&lt;color value=&quot;4E89F6&quot;/&gt;&lt;color value=&quot;F7575F&quot;/&gt;&lt;color value=&quot;95CACC&quot;/&gt;&lt;color value=&quot;CBDAFB&quot;/&gt;&lt;color value=&quot;D7DD89&quot;/&gt;&lt;color value=&quot;C1C8CF&quot;/&gt;&lt;color value=&quot;CB8A53&quot;/&gt;&lt;color value=&quot;D0DDC4&quot;/&gt;&lt;color value=&quot;EF8C2F&quot;/&gt;&lt;/colors&gt;
	&lt;/schema&gt;
	&lt;separator decimal=&quot;,&quot; group=&quot;&quot;/&gt;
	&lt;background border=&quot;yes&quot; beginColor=&quot;FFFFFF&quot; endColor=&quot;FFFFFF&quot; color=&quot;FFFFFF&quot; gradient=&quot;no&quot;/&gt;
	&lt;chartarea border=&quot;yes&quot; alpha=&quot;100&quot; beginColor=&quot;c9c8ac&quot; endColor=&quot;f6f6d6&quot; bgcolor=&quot;c9c8ac&quot; gradient=&quot;yes&quot;&gt;
		&lt;grid line_style=&quot;medium&quot; alpha=&quot;100&quot; color=&quot;8e8d65&quot; visible=&quot;yes&quot;/&gt;
		&lt;vertical_axis visible=&quot;yes&quot;&gt;&lt;font face=&quot;Verdana&quot; size=&quot;11&quot; color=&quot;605f43&quot;/&gt;&lt;/vertical_axis&gt;
		&lt;horizontal_axis visible=&quot;yes&quot; rotation=&quot;degrees&quot; autoRotate=&quot;yes&quot;&gt;&lt;font face=&quot;Verdana&quot; size=&quot;11&quot; color=&quot;605f43&quot;/&gt;&lt;/horizontal_axis&gt;
		&lt;chart line_thick=&quot;2&quot; enabled=&quot;yes&quot; border=&quot;yes&quot; alpha=&quot;100&quot; isBorderBright=&quot;yes&quot; type=&quot;3d_columns&quot; series=&quot;columns&quot;&gt;
			&lt;inscriptions color=&quot;605f43&quot; visible=&quot;yes&quot;&gt;&lt;font face=&quot;Verdana&quot; size=&quot;11&quot;/&gt;&lt;/inscriptions&gt;
			&lt;animation type=&quot;none&quot; time=&quot;2000&quot;/&gt;
			&lt;markers size=&quot;8&quot; type=&quot;0&quot;/&gt;
			&lt;hints border=&quot;yes&quot; enabled=&quot;yes&quot; color=&quot;FFFF99&quot;&gt;&lt;font face=&quot;Verdana&quot; size=&quot;11&quot; color=&quot;605f43&quot;/&gt;&lt;/hints&gt;
		&lt;/chart&gt;
		&lt;legend sqr_size=&quot;12&quot; sqr_borders=&quot;yes&quot; border_thick=&quot;0&quot; alpha=&quot;100&quot; position=&quot;left-center&quot; layout=&quot;vertical&quot; visible=&quot;no&quot;&gt;&lt;font face=&quot;Verdana&quot; size=&quot;11&quot; color=&quot;605f43&quot;/&gt;&lt;/legend&gt;
		&lt;title position=&quot;top&quot; align=&quot;center&quot; border=&quot;no&quot; alpha=&quot;100&quot; visible=&quot;yes&quot; text=&quot;Nilai Denda&quot;&gt;&lt;font face=&quot;Verdana&quot; size=&quot;11&quot; color=&quot;000000&quot;/&gt;&lt;/title&gt;
	&lt;/chartarea&gt;
	&lt;objects&gt;
	&lt;/objects&gt;
	&lt;data&gt;
		&lt;columns&gt;
			&lt;column field=&quot;nilai_denda&quot; name=&quot;Nilai Denda&quot;/&gt;&lt;/columns&gt;
		&lt;rows&gt;
			&lt;!-- BEGIN Row --&gt;&lt;row col1=&quot;{nilai_denda}&quot; name=&quot;{tgl}&quot;/&gt;&lt;!-- END Row --&gt;&lt;/rows&gt;
	&lt;/data&gt;
&lt;/root&gt;
">
<Components/>
<Events/>
<Attributes/>
<DataSeries>
<Field id="726" fieldName="nilai_denda" alias="Nilai Denda"/>
</DataSeries>
<TableParameters/>
<JoinTables/>
<JoinLinks/>
<Fields/>
<AllFields>
<Field id="722" fieldName="tgl"/>
<Field id="723" fieldName="nilai_denda"/>
</AllFields>
<SelectedFields>
<Field id="724" fieldName="nilai_denda" isExpression="True"/>
<Field id="725" fieldName="tgl" isExpression="True"/>
</SelectedFields>
<SPParameters/>
<SQLParameters>
<SQLParameter id="721" variable="p_finance_period_id" parameterType="URL" defaultValue="0" dataType="Float" parameterSource="p_finance_period_id"/>
</SQLParameters>
<SecurityGroups/>
<Features/>
</FlashChart>
</Components>
	<CodeFiles>
		<CodeFile id="Events" language="PHPTemplates" name="t_status_pembayaran_pajak_sudah_bayar_events.php" forShow="False" comment="//" codePage="windows-1252"/>
		<CodeFile id="Code" language="PHPTemplates" name="t_status_pembayaran_pajak_sudah_bayar.php" forShow="True" url="t_status_pembayaran_pajak_sudah_bayar.php" comment="//" codePage="windows-1252"/>
		<CodeFile id="FlashChartXML704" language="PHPTemplates" name="t_status_pembayaran_pajak_sudah_bayarjml_wp_bayar.xml" forShow="False" comment="&lt;!--" commentEnd="--&gt;" codePage="windows-1252"/>
<CodeFile id="FlashChartXML706" language="PHPTemplates" name="t_status_pembayaran_pajak_sudah_bayarnilai_bayar.xml" forShow="False" comment="&lt;!--" commentEnd="--&gt;" codePage="windows-1252"/>
<CodeFile id="FlashChartXML713" language="PHPTemplates" name="t_status_pembayaran_pajak_sudah_bayarnilai_ketetapan.xml" forShow="False" comment="&lt;!--" commentEnd="--&gt;" codePage="windows-1252"/>
<CodeFile id="FlashChartXML720" language="PHPTemplates" name="t_status_pembayaran_pajak_sudah_bayarnilai_denda.xml" forShow="False" comment="&lt;!--" commentEnd="--&gt;" codePage="windows-1252"/>
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
