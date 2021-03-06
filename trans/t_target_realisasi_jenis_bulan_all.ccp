<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\trans" secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="RWNet" wizardThemeVersion="3.0" needGeneration="0" pasteActions="pasteActions" connection="ConnSIKP">
	<Components>
		<Grid id="2" secured="False" sourceType="SQL" returnValueType="Number" defaultPageSize="12" connection="ConnSIKP" name="t_target_realisasiGrid" pageSizeLimit="100" wizardCaption="List of P App Role " wizardGridType="Tabular" wizardAllowInsert="True" wizardAltRecord="True" wizardAltRecordType="Style" wizardRecordSeparator="False" wizardNoRecords="-" pasteAsReplace="pasteAsReplace" pasteActions="pasteActions" activeCollection="SQLParameters" parameterTypeListName="ParameterTypeList" dataSource="SELECT
	MAX(p_finance_period_id) as p_finance_period_id, 
	MAX(p_year_period_id) as p_year_period_id,
	to_char(MAX(start_date),'dd-mm-yyyy') as start_date,
	to_char(MAX(end_date),'dd-mm-yyyy') as end_date,
	MAX(p_vat_type_id) as p_vat_type_id,
	MAX(bulan) as bulan,
	SUM (target_amount) as target_amount,
	SUM (realisasi_amt) as realisasi_amt,
	MAX (penalty_amt) as penalty_amt,
	SUM (debt_amt) as debt_amt
FROM
	f_target_vs_real_monthly_new({p_year_period_id},null)
GROUP BY p_finance_period_id

ORDER BY MAX(start_date) ASC">
			<Components>
				<Navigator id="22" size="10" type="Centered" pageSizes="1;5;10;25;50" name="Navigator" wizardPagingType="Custom" wizardFirst="True" wizardFirstText="First" wizardPrev="True" wizardPrevText="Prev" wizardNext="True" wizardNextText="Next" wizardLast="True" wizardLastText="Last" wizardImages="Images" wizardPageNumbers="Centered" wizardSize="10" wizardTotalPages="False" wizardHideDisabled="False" wizardOfText="of" wizardPageSize="False" wizardUsePageScroller="True">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Navigator>
				<Label id="555" fieldSourceType="DBColumn" dataType="Text" html="False" name="bulan" fieldSource="bulan" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="t_target_realisasiGridbulan">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="679" fieldSourceType="DBColumn" dataType="Float" html="False" name="target_amount" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_target_realisasiGridtarget_amount" fieldSource="target_amount" format="#,##0.00">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Hidden id="716" fieldSourceType="DBColumn" dataType="Text" name="p_finance_period_id" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_target_realisasiGridp_finance_period_id" fieldSource="p_finance_period_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Label id="750" fieldSourceType="CodeExpression" dataType="Float" html="False" name="percentage" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_target_realisasiGridpercentage">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="892" fieldSourceType="DBColumn" dataType="Float" html="False" name="penalty_amt" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_target_realisasiGridpenalty_amt" fieldSource="penalty_amt" format="#,##0.00">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="893" fieldSourceType="DBColumn" dataType="Float" html="False" name="debt_amt" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_target_realisasiGriddebt_amt" fieldSource="debt_amt" format="#,##0.00">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="676" fieldSourceType="DBColumn" dataType="Float" html="False" name="realisasi_amt" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_target_realisasiGridrealisasi_amt" fieldSource="realisasi_amt" format="#,##0.00">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="894" fieldSourceType="DBColumn" dataType="Float" html="False" name="total_amt" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_target_realisasiGridtotal_amt" fieldSource="target_amount" format="#,##0.00">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Hidden id="895" fieldSourceType="DBColumn" dataType="Text" name="p_vat_type_id" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_target_realisasiGridp_vat_type_id" fieldSource="p_vat_type_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="896" fieldSourceType="DBColumn" dataType="Text" name="start_date" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_target_realisasiGridstart_date" fieldSource="start_date">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="897" fieldSourceType="DBColumn" dataType="Text" name="end_date" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_target_realisasiGridend_date" fieldSource="end_date">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Link id="690" visible="Yes" fieldSourceType="CodeExpression" dataType="Text" html="True" hrefType="Page" urlType="Relative" preserveParameters="GET" name="DLink" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_target_realisasiGridDLink" hrefSource="t_target_realisasi_jenis_bulan_all.ccp" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="691" sourceType="DataField" format="yyyy-mm-dd" name="p_finance_period_id" source="p_finance_period_id"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
			</Components>
			<Events>
				<Event name="BeforeShowRow" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="725" eventType="Server"/>
					</Actions>
				</Event>
				<Event name="BeforeSelect" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="735" eventType="Server"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
			</TableParameters>
			<JoinTables>
			</JoinTables>
			<JoinLinks/>
			<Fields>
				<Field id="695" fieldName="*"/>
			</Fields>
			<SPParameters/>
			<SQLParameters>
				<SQLParameter id="677" parameterType="URL" variable="p_year_period_id" dataType="Float" parameterSource="p_year_period_id" defaultValue="0"/>
				<SQLParameter id="898" variable="p_vat_type_id" parameterType="URL" dataType="Text" parameterSource="p_vat_type_id"/>
			</SQLParameters>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Grid>
		<Record id="726" sourceType="SQL" urlType="Relative" secured="False" allowInsert="False" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="GET" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="t_target_realisasi_jenis_bulanForm" connection="ConnSIKP" dataSource="SELECT * 
FROM v_revenue_target_vs_realisasi_month
WHERE t_revenue_target_id = {t_revenue_target_id}" PathID="t_target_realisasi_jenis_bulanForm" pasteActions="pasteActions">
<Components>
<Hidden id="731" fieldSourceType="DBColumn" dataType="Text" name="p_year_period_id" fieldSource="p_year_period_id" PathID="t_target_realisasi_jenis_bulanFormp_year_period_id">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Hidden>
<Hidden id="886" fieldSourceType="DBColumn" dataType="Text" name="t_revenue_target_id" fieldSource="t_revenue_target_id" PathID="t_target_realisasi_jenis_bulanFormt_revenue_target_id">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Hidden>
<Hidden id="900" fieldSourceType="DBColumn" dataType="Text" name="p_finance_period_id" PathID="t_target_realisasi_jenis_bulanFormp_finance_period_id">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Hidden>
<Hidden id="903" fieldSourceType="DBColumn" dataType="Text" html="False" name="bulan" fieldSource="bulan" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="t_target_realisasi_jenis_bulanFormbulan" visible="Yes">
<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
</Components>
<Events>
<Event name="BeforeSelect" type="Server">
<Actions>
<Action actionName="Custom Code" actionCategory="General" id="902"/>
</Actions>
</Event>
</Events>
<TableParameters>
<TableParameter id="884" conditionType="Parameter" useIsNull="False" field="p_year_period_id" dataType="Float" searchConditionType="Equal" parameterType="URL" parameterSource="p_year_period_id" DBFormat="0" logicOperator="And"/>
<TableParameter id="885" conditionType="Parameter" useIsNull="False" field="p_vat_type_id" dataType="Float" searchConditionType="Equal" parameterType="URL" parameterSource="p_vat_type_id" DBFormat="0" logicOperator="And"/>
</TableParameters>
<SPParameters/>
<SQLParameters>
<SQLParameter id="889" variable="t_revenue_target_id" dataType="Float" parameterType="URL" parameterSource="t_revenue_target_id" DBFormat="0" defaultValue="0"/>
</SQLParameters>
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
		<CodeFile id="Events" language="PHPTemplates" name="t_target_realisasi_jenis_bulan_all_events.php" forShow="False" comment="//" codePage="windows-1252"/>
		<CodeFile id="Code" language="PHPTemplates" name="t_target_realisasi_jenis_bulan_all.php" forShow="True" url="t_target_realisasi_jenis_bulan_all.php" comment="//" codePage="windows-1252"/>
	</CodeFiles>
	<SecurityGroups/>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events>
		<Event name="OnInitializeView" type="Server">
			<Actions>
				<Action actionName="Custom Code" actionCategory="General" id="899"/>
			</Actions>
		</Event>
	</Events>
</Page>
