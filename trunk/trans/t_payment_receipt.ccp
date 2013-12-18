<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\trans" secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="RWNet" wizardThemeVersion="3.0" needGeneration="0" pasteActions="pasteActions" connection="ConnSIKP">
	<Components>
		<Grid id="2" secured="False" sourceType="SQL" returnValueType="Number" defaultPageSize="5" connection="ConnSIKP" name="t_cust_order_legal_docGrid" pageSizeLimit="100" wizardCaption="List of P App Role " wizardGridType="Tabular" wizardAllowInsert="True" wizardAltRecord="True" wizardAltRecordType="Style" wizardRecordSeparator="False" wizardNoRecords="-" pasteAsReplace="pasteAsReplace" pasteActions="pasteActions" activeCollection="SQLParameters" parameterTypeListName="ParameterTypeList" dataSource="select b.vat_code, b.description, count(1) as jml_wp
from t_cust_account a, p_vat_type b
where
	(not exists(
		select 1 from t_payment_receipt x
		where x.t_cust_account_id = a.t_cust_account_id
		and x.p_finance_period_id = {p_finance_period_id}
	))
	and 
	(a.p_vat_type_id &lt;&gt; 6)
group by b.vat_code, b.description">
			<Components>
				<Navigator id="22" size="10" type="Centered" pageSizes="1;5;10;25;50" name="Navigator" wizardPagingType="Custom" wizardFirst="True" wizardFirstText="First" wizardPrev="True" wizardPrevText="Prev" wizardNext="True" wizardNextText="Next" wizardLast="True" wizardLastText="Last" wizardImages="Images" wizardPageNumbers="Centered" wizardSize="10" wizardTotalPages="False" wizardHideDisabled="False" wizardOfText="of" wizardPageSize="False" wizardUsePageScroller="True">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Navigator>
				<Label id="555" fieldSourceType="DBColumn" dataType="Text" html="False" name="vat_code" fieldSource="vat_code" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="t_cust_order_legal_docGridvat_code">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="676" fieldSourceType="DBColumn" dataType="Text" html="False" name="jml_wp" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_cust_order_legal_docGridjml_wp" fieldSource="jml_wp">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="679" fieldSourceType="DBColumn" dataType="Text" html="False" name="description" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_cust_order_legal_docGriddescription" fieldSource="description">
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
				<SQLParameter id="685" variable="p_vat_type_id" parameterType="URL" defaultValue="0" dataType="Float" parameterSource="p_vat_type_id"/>
			</SQLParameters>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Grid>
		<FlashChart id="686" secured="False" dataSeriesIn="Rows" chartType="3d_columns" sourceType="SQL" defaultPageSize="25" returnValueType="Number" name="FlashChart1" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="FlashChart1" connection="ConnSIKP" activeCollection="SQLParameters" parameterTypeListName="ParameterTypeList" dataSource="select b.vat_code, count(1) as jml_wp
from t_cust_account a, p_vat_type b
where
	(not exists(
		select 1 from t_payment_receipt x
		where x.t_cust_account_id = a.t_cust_account_id
		and x.p_finance_period_id = {p_finance_period_id}
	))
	and 
	(a.p_vat_type_id &lt;&gt; {p_vat_type_id})
group by b.vat_code, b.description" schemaName="Bright" layout="11" gridCaptionField="vat_code" isCaption="true" width="700" height="300" displayTitle="True" title="Laporan Rekap Tunggakan" displayLegend="True" displayLabels="True" displayGridLines="True" directionType="degrees" autoRotate="yes" template="&lt;root&gt;
	&lt;schema name=&quot;Bright&quot;&gt;
		&lt;mask/&gt;
		&lt;colors/&gt;
	&lt;/schema&gt;
	&lt;separator decimal=&quot;,&quot; group=&quot;&quot;/&gt;
	&lt;background border=&quot;yes&quot;/&gt;
	&lt;chartarea border=&quot;yes&quot;&gt;
		&lt;grid line_style=&quot;medium&quot; visible=&quot;yes&quot;/&gt;
		&lt;vertical_axis visible=&quot;yes&quot;/&gt;
		&lt;horizontal_axis visible=&quot;yes&quot; rotation=&quot;degrees&quot; autoRotate=&quot;yes&quot;/&gt;
		&lt;chart line_thick=&quot;2&quot; enabled=&quot;yes&quot; type=&quot;3d_columns&quot; series=&quot;rows&quot;&gt;
			&lt;inscriptions visible=&quot;yes&quot;/&gt;
			&lt;animation type=&quot;none&quot;/&gt;
			&lt;markers size=&quot;8&quot; type=&quot;0&quot;/&gt;
			&lt;hints border=&quot;yes&quot; enabled=&quot;yes&quot;/&gt;
		&lt;/chart&gt;
		&lt;legend sqr_size=&quot;12&quot; sqr_borders=&quot;yes&quot; border_thick=&quot;0&quot; position=&quot;left-center&quot; layout=&quot;vertical&quot; visible=&quot;yes&quot;/&gt;
		&lt;title position=&quot;top&quot; align=&quot;center&quot; border=&quot;no&quot; alpha=&quot;100&quot; visible=&quot;yes&quot; text=&quot;Laporan Rekap Tunggakan&quot;/&gt;
	&lt;/chartarea&gt;
	&lt;objects&gt;
	&lt;/objects&gt;
	&lt;data&gt;
		&lt;columns&gt;
			&lt;column field=&quot;jml_wp&quot; name=&quot;jml_wp&quot;/&gt;&lt;/columns&gt;
		&lt;rows&gt;
			&lt;!-- BEGIN Row --&gt;&lt;row col1=&quot;{jml_wp}&quot; name=&quot;{vat_code}&quot;/&gt;&lt;!-- END Row --&gt;&lt;/rows&gt;
	&lt;/data&gt;
&lt;/root&gt;
">
			<Components/>
			<Events/>
			<Attributes/>
			<DataSeries>
				<Field id="713" fieldName="jml_wp" alias="jml_wp"/>
			</DataSeries>
			<TableParameters/>
			<JoinTables/>
			<JoinLinks/>
			<Fields/>
			<AllFields>
				<Field id="709" fieldName="vat_code"/>
				<Field id="710" fieldName="jml_wp"/>
			</AllFields>
			<SelectedFields>
				<Field id="711" fieldName="jml_wp" isExpression="True"/>
				<Field id="712" fieldName="vat_code" isExpression="True"/>
			</SelectedFields>
			<SPParameters/>
			<SQLParameters>
				<SQLParameter id="687" variable="p_finance_period_id" parameterType="URL" defaultValue="0" dataType="Float" parameterSource="p_finance_period_id"/>
				<SQLParameter id="688" variable="p_vat_type_id" parameterType="URL" defaultValue="0" dataType="Float" parameterSource="p_vat_type_id"/>
			</SQLParameters>
			<SecurityGroups/>
			<Features/>
		</FlashChart>
		<Record id="3" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="None" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="t_payment_receiptSearch" returnPage="t_payment_receipt.ccp" PathID="t_payment_receiptSearch">
			<Components>
				<TextBox id="559" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="code_period" PathID="t_payment_receiptSearchcode_period">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Button id="4" urlType="Relative" enableValidation="True" isDefault="False" name="Button_DoSearch" operation="Search" PathID="t_payment_receiptSearchButton_DoSearch">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Hidden id="684" fieldSourceType="DBColumn" dataType="Float" name="p_finance_period_id" fieldSource="1" PathID="t_payment_receiptSearchp_finance_period_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
			</Components>
			<Events/>
			<TableParameters/>
			<SPParameters/>
			<SQLParameters/>
			<JoinTables/>
			<JoinLinks/>
			<Fields/>
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
		<CodeFile id="Events" language="PHPTemplates" name="t_payment_receipt_events.php" forShow="False" comment="//" codePage="windows-1252"/>
		<CodeFile id="Code" language="PHPTemplates" name="t_payment_receipt.php" forShow="True" url="t_payment_receipt.php" comment="//" codePage="windows-1252"/>
		<CodeFile id="FlashChartXML686" language="PHPTemplates" name="t_payment_receiptFlashChart1.xml" forShow="False" comment="&lt;!--" commentEnd="--&gt;" codePage="windows-1252"/>
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
