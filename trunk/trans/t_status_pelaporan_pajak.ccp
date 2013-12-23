<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\trans" secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="RWNet" wizardThemeVersion="3.0" needGeneration="0" pasteActions="pasteActions" connection="ConnSIKP">
	<Components>
		<Grid id="2" secured="False" sourceType="SQL" returnValueType="Number" defaultPageSize="5" connection="ConnSIKP" name="t_status_pelaporan_pajakGrid" pageSizeLimit="100" wizardCaption="List of P App Role " wizardGridType="Tabular" wizardAllowInsert="True" wizardAltRecord="True" wizardAltRecordType="Style" wizardRecordSeparator="False" wizardNoRecords="-" pasteAsReplace="pasteAsReplace" pasteActions="pasteActions" activeCollection="SQLParameters" parameterTypeListName="ParameterTypeList" dataSource="select STATUS_LAPOR , JML
from 
(
  select 'SUDAH LAPOR' as STATUS_LAPOR , count(*) as JML
  from t_cust_account a
  where exists (select 1 
              from t_vat_setllement x
              where x.t_cust_account_id = a.t_cust_account_id
                    and x.p_finance_period_id = {p_finance_period_id}
              )
        -- and trunc(a.registration_date) &lt; (select start_date from p_finance_period where p_finance_period_id = {p_finance_period_id}
        --                               )
  UNION ALL
  select 'BELUM LAPOR' as STATUS_LAPOR , count(*) as JML
  from t_cust_account a
  where not exists (select 1 
              from t_vat_setllement x
              where x.t_cust_account_id = a.t_cust_account_id
                    and x.p_finance_period_id = {p_finance_period_id}
              )
        -- and trunc(a.registration_date) &lt; (select start_date from p_finance_period where p_finance_period_id = {p_finance_period_id}
        --                               )
)">
			<Components>
				<Navigator id="22" size="10" type="Centered" pageSizes="1;5;10;25;50" name="Navigator" wizardPagingType="Custom" wizardFirst="True" wizardFirstText="First" wizardPrev="True" wizardPrevText="Prev" wizardNext="True" wizardNextText="Next" wizardLast="True" wizardLastText="Last" wizardImages="Images" wizardPageNumbers="Centered" wizardSize="10" wizardTotalPages="False" wizardHideDisabled="False" wizardOfText="of" wizardPageSize="False" wizardUsePageScroller="True">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Navigator>
				<Label id="676" fieldSourceType="DBColumn" dataType="Text" html="False" name="jml" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_status_pelaporan_pajakGridjml" fieldSource="jml">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Link id="724" visible="Yes" fieldSourceType="DBColumn" dataType="Text" html="False" hrefType="Page" urlType="Relative" preserveParameters="GET" name="status_lapor" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_status_pelaporan_pajakGridstatus_lapor" hrefSource="t_status_pelaporan_pajak_sudah_lapor.ccp" wizardUseTemplateBlock="False" fieldSource="status_lapor">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="725" sourceType="URL" format="yyyy-mm-dd" name="p_finance_period_id" source="p_finance_period_id"/>
						<LinkParameter id="728" sourceType="DataField" name="status_lapor" source="status_lapor"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
				<Hidden id="726" fieldSourceType="DBColumn" dataType="Float" name="p_finance_period_id" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_status_pelaporan_pajakGridp_finance_period_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="727" fieldSourceType="DBColumn" dataType="Text" name="status" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_status_pelaporan_pajakGridstatus" fieldSource="status_lapor">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
			</Components>
			<Events>
				<Event name="BeforeShowRow" type="Server">
					<Actions>
						<Action actionName="Set Row Style" actionCategory="General" id="10" styles="Row;AltRow" name="rowStyle"/>
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
		<FlashChart id="686" secured="False" dataSeriesIn="Rows" chartType="3d_pie" sourceType="SQL" defaultPageSize="25" returnValueType="Number" name="status_lapor" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="status_lapor" connection="ConnSIKP" activeCollection="SQLParameters" parameterTypeListName="ParameterTypeList" dataSource="select STATUS_LAPOR , JML
from 
(
  select 'SUDAH LAPOR' as STATUS_LAPOR , count(*) as JML
  from t_cust_account a
  where exists (select 1 
              from t_vat_setllement x
              where x.t_cust_account_id = a.t_cust_account_id
                    and x.p_finance_period_id = {p_finance_period_id}
              )
        -- and trunc(a.registration_date) &lt; (select start_date from p_finance_period where p_finance_period_id = {p_finance_period_id}
        --                               )
  UNION ALL
  select 'BELUM LAPOR' as STATUS_LAPOR , count(*) as JML
  from t_cust_account a
  where not exists (select 1 
              from t_vat_setllement x
              where x.t_cust_account_id = a.t_cust_account_id
                    and x.p_finance_period_id = {p_finance_period_id}
              )
        -- and trunc(a.registration_date) &lt; (select start_date from p_finance_period where p_finance_period_id = {p_finance_period_id}
        --                               )
)" schemaName="Bright" layout="11" gridCaptionField="status_lapor" isCaption="true" width="700" height="300" displayTitle="True" title="Status Pelaporan Pajak" displayLegend="True" displayLabels="True" displayGridLines="True" directionType="degrees" autoRotate="yes" template="&lt;root&gt;
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
		&lt;chart line_thick=&quot;2&quot; enabled=&quot;yes&quot; type=&quot;3d_pie&quot; series=&quot;rows&quot;&gt;
			&lt;inscriptions visible=&quot;yes&quot;/&gt;
			&lt;animation type=&quot;none&quot;/&gt;
			&lt;markers size=&quot;8&quot; type=&quot;0&quot;/&gt;
			&lt;hints border=&quot;yes&quot; enabled=&quot;yes&quot;/&gt;
		&lt;/chart&gt;
		&lt;legend sqr_size=&quot;12&quot; sqr_borders=&quot;yes&quot; border_thick=&quot;0&quot; position=&quot;left-center&quot; layout=&quot;vertical&quot; visible=&quot;yes&quot;/&gt;
		&lt;title position=&quot;top&quot; align=&quot;center&quot; border=&quot;no&quot; alpha=&quot;100&quot; visible=&quot;yes&quot; text=&quot;Status Pelaporan Pajak&quot;/&gt;
	&lt;/chartarea&gt;
	&lt;objects&gt;
	&lt;/objects&gt;
	&lt;data&gt;
		&lt;columns&gt;
			&lt;column field=&quot;jml&quot; name=&quot;jml&quot;/&gt;&lt;/columns&gt;
		&lt;rows&gt;&lt;!-- BEGIN Row --&gt;&lt;row col1=&quot;{jml}&quot; name=&quot;{status_lapor}&quot;/&gt;&lt;!-- END Row --&gt;&lt;/rows&gt;&lt;/data&gt;
&lt;/root&gt;
">
			<Components/>
			<Events/>
			<Attributes/>
			<DataSeries>
				<Field id="723" fieldName="jml" alias="jml"/>
			</DataSeries>
			<TableParameters/>
			<JoinTables/>
			<JoinLinks/>
			<Fields/>
			<AllFields>
				<Field id="719" fieldName="status_lapor"/>
				<Field id="720" fieldName="jml"/>
			</AllFields>
			<SelectedFields>
				<Field id="721" fieldName="jml" isExpression="True"/>
				<Field id="722" fieldName="status_lapor" isExpression="True"/>
			</SelectedFields>
			<SPParameters/>
			<SQLParameters>
				<SQLParameter id="687" variable="p_finance_period_id" parameterType="URL" defaultValue="0" dataType="Float" parameterSource="p_finance_period_id"/>
			</SQLParameters>
			<SecurityGroups/>
			<Features/>
		</FlashChart>
		<Record id="3" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="None" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="t_status_pelaporan_pajakSearch" returnPage="t_status_pelaporan_pajak.ccp" PathID="t_status_pelaporan_pajakSearch" connection="ConnSIKP">
			<Components>
				<TextBox id="559" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="code_period" PathID="t_status_pelaporan_pajakSearchcode_period">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Button id="4" urlType="Relative" enableValidation="True" isDefault="False" name="Button_DoSearch" operation="Search" PathID="t_status_pelaporan_pajakSearchButton_DoSearch">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<TextBox id="684" fieldSourceType="DBColumn" dataType="Float" name="p_finance_period_id" PathID="t_status_pelaporan_pajakSearchp_finance_period_id" visible="Yes" defaultValue="1">
<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
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
		<CodeFile id="FlashChartXML686" language="PHPTemplates" name="t_status_pelaporan_pajakstatus_lapor.xml" forShow="False" comment="&lt;!--" commentEnd="--&gt;" codePage="windows-1252"/>
		<CodeFile id="Events" language="PHPTemplates" name="t_status_pelaporan_pajak_events.php" forShow="False" comment="//" codePage="windows-1252"/>
		<CodeFile id="Code" language="PHPTemplates" name="t_status_pelaporan_pajak.php" forShow="True" url="t_status_pelaporan_pajak.php" comment="//" codePage="windows-1252"/>
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
