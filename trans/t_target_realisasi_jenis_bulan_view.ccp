<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\trans" secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="Spring" wizardThemeVersion="3.0" needGeneration="0" pasteActions="pasteActions">
	<Components>
		<Grid id="2" secured="False" sourceType="SQL" returnValueType="Number" defaultPageSize="12" connection="ConnSIKP" name="t_target_realisasiGrid" pageSizeLimit="100" wizardCaption="List of P App Role " wizardGridType="Tabular" wizardAllowInsert="True" wizardAltRecord="True" wizardAltRecordType="Style" wizardRecordSeparator="False" wizardNoRecords="-" pasteAsReplace="pasteAsReplace" pasteActions="pasteActions" activeCollection="SQLParameters" parameterTypeListName="ParameterTypeList" dataSource="SELECT
	MAX(p_finance_period_id) as p_finance_period_id,
	MAX(p_year_period_id) as p_year_period_id,
	to_char(MAX(start_date),'dd-mm-yyyy') as start_date,
	to_char(MAX(end_date),'dd-mm-yyyy') as end_date,
	MAX(p_vat_type_id) as p_vat_type_id,
	MAX(bulan) as bulan,
	ROUND(SUM (target_amount)) as target_amount,
	ROUND(SUM (realisasi_amt)) as realisasi_amt,
	MAX (penalty_amt) as penalty_amt,
	ROUND(SUM (debt_amt)) as debt_amt,
	MAX (denda_pokok) as denda_pokok,
	MAX (denda_piutang) as denda_piutang
FROM
	f_target_vs_real_monthly_new3_mark_ii(
	{p_year_period_id},{p_vat_type_id}
	)
GROUP BY p_finance_period_id

ORDER BY MAX(start_date) ASC">
			<Components>
				<Navigator id="22" size="10" type="Centered" pageSizes="1;5;10;25;50" name="Navigator" wizardPagingType="Custom" wizardFirst="True" wizardFirstText="First" wizardPrev="True" wizardPrevText="Prev" wizardNext="True" wizardNextText="Next" wizardLast="True" wizardLastText="Last" wizardImages="Images" wizardPageNumbers="Centered" wizardSize="10" wizardTotalPages="False" wizardHideDisabled="False" wizardOfText="of" wizardPageSize="False" wizardUsePageScroller="True">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Navigator>
				<Label id="90" fieldSourceType="DBColumn" dataType="Text" html="False" name="bulan" fieldSource="bulan" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="t_target_realisasiGridbulan">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="91" fieldSourceType="DBColumn" dataType="Float" html="False" name="target_amount" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_target_realisasiGridtarget_amount" fieldSource="target_amount" format="#,##0.00">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Hidden id="92" fieldSourceType="DBColumn" dataType="Text" name="p_finance_period_id" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_target_realisasiGridp_finance_period_id" fieldSource="p_finance_period_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Label id="93" fieldSourceType="CodeExpression" dataType="Float" html="False" name="percentage" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_target_realisasiGridpercentage">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="94" fieldSourceType="DBColumn" dataType="Float" html="False" name="debt_amt" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_target_realisasiGriddebt_amt" fieldSource="debt_amt" format="#,##0.00">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="95" fieldSourceType="DBColumn" dataType="Float" html="False" name="realisasi_amt" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_target_realisasiGridrealisasi_amt" fieldSource="realisasi_amt" format="#,##0.00">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="96" fieldSourceType="DBColumn" dataType="Float" html="False" name="total_amt" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_target_realisasiGridtotal_amt" fieldSource="target_amount" format="#,##0.00">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Hidden id="97" fieldSourceType="DBColumn" dataType="Text" name="p_vat_type_id" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_target_realisasiGridp_vat_type_id" fieldSource="p_vat_type_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="98" fieldSourceType="DBColumn" dataType="Text" name="start_date" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_target_realisasiGridstart_date" fieldSource="start_date">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="99" fieldSourceType="DBColumn" dataType="Text" name="end_date" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_target_realisasiGridend_date" fieldSource="end_date">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Link id="100" visible="Yes" fieldSourceType="CodeExpression" dataType="Text" html="True" hrefType="Page" urlType="Relative" preserveParameters="GET" name="DLink" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_target_realisasiGridDLink" hrefSource="t_target_realisasi_jenis_bulan.ccp" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="101" sourceType="DataField" format="yyyy-mm-dd" name="p_finance_period_id" source="p_finance_period_id"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
				<Label id="102" fieldSourceType="CodeExpression" dataType="Float" html="False" name="target_amount_sum" PathID="t_target_realisasiGridtarget_amount_sum" format="#,##0.00">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="103" fieldSourceType="CodeExpression" dataType="Float" html="False" name="realisasi_amt_sum" PathID="t_target_realisasiGridrealisasi_amt_sum" format="#,##0.00">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="104" fieldSourceType="CodeExpression" dataType="Float" html="False" name="penalty_amt_sum" PathID="t_target_realisasiGridpenalty_amt_sum" format="#,##0.00">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="105" fieldSourceType="DBColumn" dataType="Float" html="False" name="denda_pokok" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_target_realisasiGriddenda_pokok" fieldSource="denda_pokok" format="#,##0.00">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="106" fieldSourceType="DBColumn" dataType="Float" html="False" name="denda_piutang" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_target_realisasiGriddenda_piutang" fieldSource="denda_piutang" format="#,##0.00">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="107" fieldSourceType="DBColumn" dataType="Float" html="False" name="penalty_amt" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_target_realisasiGridpenalty_amt" fieldSource="penalty_amt" format="#,##0.00">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="108" fieldSourceType="DBColumn" dataType="Float" html="False" name="denda_pokok2" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_target_realisasiGriddenda_pokok2" fieldSource="denda_pokok" format="#,##0.00">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="109" fieldSourceType="DBColumn" dataType="Float" html="False" name="denda_piutang1" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_target_realisasiGriddenda_piutang1" fieldSource="denda_piutang" format="#,##0.00">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="110" fieldSourceType="CodeExpression" dataType="Float" html="False" name="penalty_amt_sum1" PathID="t_target_realisasiGridpenalty_amt_sum1" format="#,##0.00">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="111" fieldSourceType="CodeExpression" dataType="Float" html="False" name="debt_amt_sum" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_target_realisasiGriddebt_amt_sum" format="#,##0.00">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="112" fieldSourceType="CodeExpression" dataType="Float" html="False" name="total_amt_sum" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_target_realisasiGridtotal_amt_sum" format="#,##0.00">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="113" fieldSourceType="CodeExpression" dataType="Float" html="False" name="percentage_sum" PathID="t_target_realisasiGridpercentage_sum" format="#,##0.00">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
			</Components>
			<Events>
				<Event name="BeforeShowRow" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="114"/>
					</Actions>
				</Event>
				<Event name="BeforeSelect" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="115" eventType="Server"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
			</TableParameters>
			<JoinTables>
			</JoinTables>
			<JoinLinks/>
			<Fields>
				<Field id="116" fieldName="*"/>
			</Fields>
			<SPParameters/>
			<SQLParameters>
				<SQLParameter id="117" parameterType="URL" variable="p_year_period_id" dataType="Float" parameterSource="p_year_period_id" defaultValue="0"/>
				<SQLParameter id="118" variable="p_vat_type_id" parameterType="URL" dataType="Text" parameterSource="p_vat_type_id"/>
			</SQLParameters>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Grid>
		<Grid id="119" secured="False" sourceType="SQL" returnValueType="Number" defaultPageSize="12" connection="ConnSIKP" name="t_target_realisasiGrid1" pageSizeLimit="100" wizardCaption="List of P App Role " wizardGridType="Tabular" wizardAllowInsert="True" wizardAltRecord="True" wizardAltRecordType="Style" wizardRecordSeparator="False" wizardNoRecords="-" pasteAsReplace="pasteAsReplace" pasteActions="pasteActions" activeCollection="SQLParameters" parameterTypeListName="ParameterTypeList" dataSource="(SELECT
	MAX(target.p_finance_period_id) as p_finance_period_id,
	MAX(target.p_year_period_id) as p_year_period_id,
	to_char(MAX(target.start_date),'dd-mm-yyyy') as start_date,
	to_char(MAX(target.end_date),'dd-mm-yyyy') as end_date,
	MAX(target.p_vat_type_id) as p_vat_type_id,
	MAX(target.bulan) as bulan,
	ROUND(SUM (target.target_amount)) as target_amount,
	ROUND(SUM (target.realisasi_amt)) as realisasi_amt,
	ROUND(SUM (target.penalty_amt)) as penalty_amt,
	ROUND(SUM (target.debt_amt)) as debt_amt,
	MAX(dtl.vat_code) as ayat
FROM
	f_target_vs_real_monthly_new3_mark_ii({p_year_period_id},{p_vat_type_id}) target,
	p_vat_type_dtl dtl
WHERE
	dtl.p_vat_type_dtl_id = target.p_vat_type_dtl_id
	AND (target.p_finance_period_id = {p_finance_period_id} or {p_finance_period_id} is null)
GROUP BY target.p_vat_type_dtl_id

ORDER BY MAX(dtl.vat_code) ASC)
UNION
(select 999,
	{p_year_period_id},
	'',
	'',
	0,
	'',
	0,
	f_get_total_denda_ayat_mod_1({p_year_period_id},{p_finance_period_id},{p_vat_type_id}) as jumlah,
	0,
	0,
	'DENDA')">
			<Components>
				<Navigator id="120" size="10" type="Centered" pageSizes="1;5;10;25;50" name="Navigator" wizardPagingType="Custom" wizardFirst="True" wizardFirstText="First" wizardPrev="True" wizardPrevText="Prev" wizardNext="True" wizardNextText="Next" wizardLast="True" wizardLastText="Last" wizardImages="Images" wizardPageNumbers="Centered" wizardSize="10" wizardTotalPages="False" wizardHideDisabled="False" wizardOfText="of" wizardPageSize="False" wizardUsePageScroller="True">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Navigator>
				<Label id="121" fieldSourceType="DBColumn" dataType="Text" html="False" name="ayat" fieldSource="ayat" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="t_target_realisasiGrid1ayat">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="122" fieldSourceType="DBColumn" dataType="Float" html="False" name="target_amount" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_target_realisasiGrid1target_amount" fieldSource="target_amount" format="#,##0.00">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Hidden id="123" fieldSourceType="DBColumn" dataType="Text" name="p_finance_period_id" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_target_realisasiGrid1p_finance_period_id" fieldSource="p_finance_period_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Label id="124" fieldSourceType="CodeExpression" dataType="Float" html="False" name="percentage" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_target_realisasiGrid1percentage">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="125" fieldSourceType="DBColumn" dataType="Float" html="False" name="debt_amt" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_target_realisasiGrid1debt_amt" fieldSource="debt_amt" format="#,##0.00">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="126" fieldSourceType="DBColumn" dataType="Float" html="False" name="realisasi_amt" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_target_realisasiGrid1realisasi_amt" fieldSource="realisasi_amt" format="#,##0.00">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="127" fieldSourceType="DBColumn" dataType="Float" html="False" name="total_amt" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_target_realisasiGrid1total_amt" fieldSource="target_amount" format="#,##0.00">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Hidden id="128" fieldSourceType="DBColumn" dataType="Text" name="p_vat_type_id" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_target_realisasiGrid1p_vat_type_id" fieldSource="p_vat_type_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="129" fieldSourceType="DBColumn" dataType="Text" name="start_date" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_target_realisasiGrid1start_date" fieldSource="start_date">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="130" fieldSourceType="DBColumn" dataType="Text" name="end_date" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_target_realisasiGrid1end_date" fieldSource="end_date">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
			</Components>
			<Events>
				<Event name="BeforeShowRow" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="131"/>
					</Actions>
				</Event>
				<Event name="BeforeSelect" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="132" eventType="Server"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
			</TableParameters>
			<JoinTables>
			</JoinTables>
			<JoinLinks/>
			<Fields>
				<Field id="133" fieldName="*"/>
			</Fields>
			<SPParameters/>
			<SQLParameters>
				<SQLParameter id="134" parameterType="URL" variable="p_year_period_id" dataType="Float" parameterSource="p_year_period_id" defaultValue="0"/>
				<SQLParameter id="135" variable="p_vat_type_id" parameterType="URL" dataType="Text" parameterSource="p_vat_type_id" defaultValue="null"/>
				<SQLParameter id="136" variable="p_finance_period_id" parameterType="URL" defaultValue="'null'" dataType="Text" parameterSource="p_finance_period_id" designDefaultValue="null"/>
			</SQLParameters>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Grid>
		<Label id="21" fieldSourceType="DBColumn" dataType="Text" html="True" name="ayat" PathID="ayat">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
</Components>
	<CodeFiles>
		<CodeFile id="Events" language="PHPTemplates" name="t_target_realisasi_jenis_bulan_view_events.php" forShow="False" comment="//" codePage="windows-1252"/>
		<CodeFile id="Code" language="PHPTemplates" name="t_target_realisasi_jenis_bulan_view.php" forShow="True" url="t_target_realisasi_jenis_bulan_view.php" comment="//" codePage="windows-1252"/>
	</CodeFiles>
	<SecurityGroups/>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events>
		<Event name="OnInitializeView" type="Server">
			<Actions>
				<Action actionName="Custom Code" actionCategory="General" id="89"/>
			</Actions>
		</Event>
	</Events>
</Page>
