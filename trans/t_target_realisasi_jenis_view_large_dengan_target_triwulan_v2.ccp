<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\trans" secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="RWNet" wizardThemeVersion="3.0" needGeneration="0" pasteActions="pasteActions" connection="ConnSIKP">
	<Components>
		<Grid id="2" secured="False" sourceType="SQL" returnValueType="Number" defaultPageSize="100" connection="ConnSIKP" name="t_target_realisasi_jenisGrid" pageSizeLimit="100" wizardCaption="List of P App Role " wizardGridType="Tabular" wizardAllowInsert="True" wizardAltRecord="True" wizardAltRecordType="Style" wizardRecordSeparator="False" wizardNoRecords="-" pasteAsReplace="pasteAsReplace" pasteActions="pasteActions" activeCollection="SQLParameters" parameterTypeListName="ParameterTypeList" dataSource="(SELECT 
	t_revenue_target_id, 
	p_year_period_id, 
	p_vat_type_id, 
	vat_code, 
	year_code, 
	target_amount, 
	realisasi_amt
FROM v_revenue_target_vs_realisasi
WHERE p_year_period_id = 
	(
	select p_year_period_id from p_year_period 
	where year_code = (select extract(year from sysdate))
	)
ORDER BY p_vat_type_id
)

UNION
(SELECT
	'999',
	{p_year_period_id},
	999,
	'DENDA',
	'',
	0,
	SUM (round(jml_sd_hari_ini))
FROM
	sikp.f_rep_lap_harian_bdhr_baru ({p_year_period_id})
where nomor_ayat IN('140701','140702','140703','140707')
)

ORDER BY p_vat_type_id" orderBy="p_vat_type_id">
			<Components>
				<Navigator id="22" size="10" type="Centered" pageSizes="1;5;10;25;50" name="Navigator" wizardPagingType="Custom" wizardFirst="True" wizardFirstText="First" wizardPrev="True" wizardPrevText="Prev" wizardNext="True" wizardNextText="Next" wizardLast="True" wizardLastText="Last" wizardImages="Images" wizardPageNumbers="Centered" wizardSize="10" wizardTotalPages="False" wizardHideDisabled="False" wizardOfText="of" wizardPageSize="False" wizardUsePageScroller="True">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Navigator>
				<Label id="679" fieldSourceType="DBColumn" dataType="Float" html="False" name="target_amount" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_target_realisasi_jenisGridtarget_amount" fieldSource="target_amount" format="#,##0.00">
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
				<Hidden id="874" fieldSourceType="DBColumn" dataType="Float" name="p_vat_type_id2" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_target_realisasi_jenisGridp_vat_type_id2">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Label id="876" fieldSourceType="DBColumn" dataType="Float" html="False" name="target_amount_sum" PathID="t_target_realisasi_jenisGridtarget_amount_sum" format="#,##0.00">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="877" fieldSourceType="CodeExpression" dataType="Float" html="False" name="realisasi_amt_sum" PathID="t_target_realisasi_jenisGridrealisasi_amt_sum" format="#,##0.00">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="878" fieldSourceType="DBColumn" dataType="Float" html="False" name="percentage_sum" PathID="t_target_realisasi_jenisGridpercentage_sum" format="#,##0.00">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Hidden id="879" fieldSourceType="DBColumn" dataType="Float" name="p_vat_group_id" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_target_realisasi_jenisGridp_vat_group_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Link id="690" visible="Yes" fieldSourceType="CodeExpression" dataType="Text" html="True" hrefType="Page" urlType="Relative" preserveParameters="GET" name="DLink" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_target_realisasi_jenisGridDLink" hrefSource="t_target_realisasi_jenis.ccp" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="763" sourceType="DataField" name="t_revenue_target_id" source="t_revenue_target_id"/>
						<LinkParameter id="872" sourceType="DataField" name="p_year_period_id" source="p_year_period_id"/>
						<LinkParameter id="873" sourceType="DataField" name="p_vat_type_id" source="p_vat_type_id"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
				<Label id="676" fieldSourceType="DBColumn" dataType="Float" html="False" name="realisasi_amt" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_target_realisasi_jenisGridrealisasi_amt" fieldSource="realisasi_amt" format="#,##0.00">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="871" fieldSourceType="CodeExpression" dataType="Float" html="False" name="percentage" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_target_realisasi_jenisGridpercentage">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="918" fieldSourceType="DBColumn" dataType="Float" html="False" name="selisih" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_target_realisasi_jenisGridselisih">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="919" fieldSourceType="CodeExpression" dataType="Float" html="False" name="percentage_selisih" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_target_realisasi_jenisGridpercentage_selisih">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="920" fieldSourceType="CodeExpression" dataType="Float" html="False" name="selisih_sum" PathID="t_target_realisasi_jenisGridselisih_sum">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="921" fieldSourceType="DBColumn" dataType="Float" html="False" name="percentage_selisih_sum" PathID="t_target_realisasi_jenisGridpercentage_selisih_sum" format="#,##0.00">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
			</Components>
			<Events>
				<Event name="BeforeSelect" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="693" eventType="Server"/>
					</Actions>
				</Event>
				<Event name="BeforeShowRow" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="694" eventType="Server"/>
					</Actions>
				</Event>
				<Event name="BeforeExecuteSelect" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="906" eventType="Server"/>
					</Actions>
				</Event>
				<Event name="BeforeBuildSelect" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="907" eventType="Server"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
				<TableParameter id="718" conditionType="Parameter" useIsNull="False" field="p_year_period_id" dataType="Float" searchConditionType="Equal" parameterType="URL" logicOperator="And" DBFormat="0" parameterSource="p_year_period_id"/>
			</TableParameters>
			<JoinTables>
			</JoinTables>
			<JoinLinks/>
			<Fields>
				<Field id="870" fieldName="*"/>
			</Fields>
			<SPParameters/>
			<SQLParameters>
				<SQLParameter id="677" parameterType="Session" variable="p_year_period_id" dataType="Float" parameterSource="p_year_period_id2" DBFormat="0" defaultValue="0"/>
				<SQLParameter id="875" variable="p_vat_group_id" parameterType="URL" defaultValue="0" dataType="Integer" parameterSource="p_vat_group_id"/>
			</SQLParameters>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Grid>
		<Grid id="909" secured="False" sourceType="SQL" returnValueType="Number" defaultPageSize="5" connection="ConnSIKP" name="t_target_realisasiGrid" pageSizeLimit="100" wizardCaption="List of P App Role " wizardGridType="Tabular" wizardAllowInsert="True" wizardAltRecord="True" wizardAltRecordType="Style" wizardRecordSeparator="False" wizardNoRecords="-" pasteAsReplace="pasteAsReplace" pasteActions="pasteActions" activeCollection="TableParameters" parameterTypeListName="ParameterTypeList" dataSource="select * from v_target_realisasi_updated
where (target_amt &gt; 0) AND (realisasi_amt &gt; 0) 
and rownum &lt; 4
">
			<Components>
				<Navigator id="910" size="10" type="Centered" pageSizes="1;5;10;25;50" name="Navigator" wizardPagingType="Custom" wizardFirst="True" wizardFirstText="First" wizardPrev="True" wizardPrevText="Prev" wizardNext="True" wizardNextText="Next" wizardLast="True" wizardLastText="Last" wizardImages="Images" wizardPageNumbers="Centered" wizardSize="10" wizardTotalPages="False" wizardHideDisabled="False" wizardOfText="of" wizardPageSize="False" wizardUsePageScroller="True">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Navigator>
				<Label id="555" fieldSourceType="DBColumn" dataType="Text" html="False" name="year_code" fieldSource="year_code" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="t_target_realisasiGridyear_code">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="911" fieldSourceType="DBColumn" dataType="Float" html="False" name="target_amt" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_target_realisasiGridtarget_amt" fieldSource="target_amt" format="#,##0.00">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Link id="912" visible="Yes" fieldSourceType="CodeExpression" dataType="Text" html="True" hrefType="Page" urlType="Relative" preserveParameters="GET" name="DLink" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_target_realisasiGridDLink" hrefSource="t_target_realisasi.ccp" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="691" sourceType="DataField" format="yyyy-mm-dd" name="p_year_period_id" source="p_year_period_id"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
				<Hidden id="716" fieldSourceType="DBColumn" dataType="Text" name="p_year_period_id" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_target_realisasiGridp_year_period_id" fieldSource="p_year_period_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="748" fieldSourceType="DBColumn" dataType="Text" name="p_year_period_id2" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_target_realisasiGridp_year_period_id2">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Label id="913" fieldSourceType="DBColumn" dataType="Float" html="False" name="realisasi_amt" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_target_realisasiGridrealisasi_amt" fieldSource="realisasi_amt" format="#,##0.00">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="750" fieldSourceType="CodeExpression" dataType="Float" html="False" name="percentage" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_target_realisasiGridpercentage">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="916" fieldSourceType="DBColumn" dataType="Float" html="False" name="selisih" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_target_realisasiGridselisih">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="917" fieldSourceType="CodeExpression" dataType="Float" html="False" name="percentage_selisih" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_target_realisasiGridpercentage_selisih">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
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
				<Event name="BeforeShow" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="915" eventType="Server"/>
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
			</SQLParameters>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Grid>
		<Grid id="928" secured="False" sourceType="SQL" returnValueType="Number" defaultPageSize="5" connection="ConnSIKP" name="t_target_realisasi_triwulanGrid1" pageSizeLimit="100" wizardCaption="List of P App Role " wizardGridType="Tabular" wizardAllowInsert="True" wizardAltRecord="True" wizardAltRecordType="Style" wizardRecordSeparator="False" wizardNoRecords="-" pasteAsReplace="pasteAsReplace" pasteActions="pasteActions" activeCollection="TableParameters" parameterTypeListName="ParameterTypeList" dataSource="select *, f_get_realisasi(to_date('01-01-'||year_code),to_date('31-03-'||year_code)) as realisasi_triwulan_1,
f_get_realisasi(to_date('01-04-'||year_code),to_date('30-06-'||year_code)) as realisasi_triwulan_2,
f_get_realisasi(to_date('01-07-'||year_code),to_date('30-09-'||year_code)) as realisasi_triwulan_3,
f_get_realisasi(to_date('01-10-'||year_code),to_date('31-12-'||year_code)) as realisasi_triwulan_4
from p_year_period  
where sysdate between start_date and end_date">
			<Components>
				<Navigator id="929" size="10" type="Centered" pageSizes="1;5;10;25;50" name="Navigator" wizardPagingType="Custom" wizardFirst="True" wizardFirstText="First" wizardPrev="True" wizardPrevText="Prev" wizardNext="True" wizardNextText="Next" wizardLast="True" wizardLastText="Last" wizardImages="Images" wizardPageNumbers="Centered" wizardSize="10" wizardTotalPages="False" wizardHideDisabled="False" wizardOfText="of" wizardPageSize="False" wizardUsePageScroller="True">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Navigator>
				<Label id="944" fieldSourceType="DBColumn" dataType="Float" html="False" name="target_triwulan_1" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_target_realisasi_triwulanGrid1target_triwulan_1" fieldSource="target_triwulan_1" format="#,##0.00">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="945" fieldSourceType="DBColumn" dataType="Float" html="False" name="target_triwulan_2" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_target_realisasi_triwulanGrid1target_triwulan_2" fieldSource="target_triwulan_2" format="#,##0.00">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="946" fieldSourceType="DBColumn" dataType="Float" html="False" name="target_triwulan_3" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_target_realisasi_triwulanGrid1target_triwulan_3" fieldSource="target_triwulan_3" format="#,##0.00">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="947" fieldSourceType="DBColumn" dataType="Float" html="False" name="target_triwulan_4" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_target_realisasi_triwulanGrid1target_triwulan_4" fieldSource="target_triwulan_4" format="#,##0.00">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="948" fieldSourceType="DBColumn" dataType="Float" html="False" name="realisasi_triwulan_1" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_target_realisasi_triwulanGrid1realisasi_triwulan_1" fieldSource="realisasi_triwulan_1" format="#,##0.00">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="949" fieldSourceType="DBColumn" dataType="Float" html="False" name="realisasi_triwulan_2" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_target_realisasi_triwulanGrid1realisasi_triwulan_2" fieldSource="realisasi_triwulan_2" format="#,##0.00">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="950" fieldSourceType="DBColumn" dataType="Float" html="False" name="realisasi_triwulan_3" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_target_realisasi_triwulanGrid1realisasi_triwulan_3" fieldSource="realisasi_triwulan_3" format="#,##0.00">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="951" fieldSourceType="DBColumn" dataType="Float" html="False" name="realisasi_triwulan_4" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_target_realisasi_triwulanGrid1realisasi_triwulan_4" fieldSource="realisasi_triwulan_4" format="#,##0.00">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="952" fieldSourceType="CodeExpression" dataType="Float" html="False" name="percentage_triwulan_1" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_target_realisasi_triwulanGrid1percentage_triwulan_1">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="953" fieldSourceType="CodeExpression" dataType="Float" html="False" name="percentage_triwulan_2" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_target_realisasi_triwulanGrid1percentage_triwulan_2">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="954" fieldSourceType="CodeExpression" dataType="Float" html="False" name="percentage_triwulan_3" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_target_realisasi_triwulanGrid1percentage_triwulan_3">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="955" fieldSourceType="CodeExpression" dataType="Float" html="False" name="percentage_triwulan_4" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_target_realisasi_triwulanGrid1percentage_triwulan_4">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="956" fieldSourceType="CodeExpression" dataType="Float" html="False" name="selisih_triwulan_1" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_target_realisasi_triwulanGrid1selisih_triwulan_1">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="957" fieldSourceType="CodeExpression" dataType="Float" html="False" name="selisih_triwulan_2" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_target_realisasi_triwulanGrid1selisih_triwulan_2">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="958" fieldSourceType="CodeExpression" dataType="Float" html="False" name="selisih_triwulan_3" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_target_realisasi_triwulanGrid1selisih_triwulan_3">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="959" fieldSourceType="CodeExpression" dataType="Float" html="False" name="selisih_triwulan_4" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_target_realisasi_triwulanGrid1selisih_triwulan_4">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="960" fieldSourceType="CodeExpression" dataType="Float" html="False" name="percentage_selisih_triwulan_1" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_target_realisasi_triwulanGrid1percentage_selisih_triwulan_1">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="961" fieldSourceType="CodeExpression" dataType="Float" html="False" name="percentage_selisih_triwulan_2" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_target_realisasi_triwulanGrid1percentage_selisih_triwulan_2">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="962" fieldSourceType="CodeExpression" dataType="Float" html="False" name="percentage_selisih_triwulan_3" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_target_realisasi_triwulanGrid1percentage_selisih_triwulan_3">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="963" fieldSourceType="CodeExpression" dataType="Float" html="False" name="percentage_selisih_triwulan_4" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_target_realisasi_triwulanGrid1percentage_selisih_triwulan_4">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
			</Components>
			<Events>
				<Event name="BeforeShowRow" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="940"/>
					</Actions>
				</Event>
				<Event name="BeforeSelect" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="941" eventType="Server"/>
					</Actions>
				</Event>
				<Event name="BeforeShow" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="942" eventType="Server"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
			</TableParameters>
			<JoinTables>
			</JoinTables>
			<JoinLinks/>
			<Fields>
				<Field id="943" fieldName="*"/>
			</Fields>
			<SPParameters/>
			<SQLParameters>
			</SQLParameters>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Grid>
		<Grid id="964" secured="False" sourceType="SQL" returnValueType="Number" defaultPageSize="100" connection="ConnSIKP" name="t_target_realisasi_jenisGrid1" pageSizeLimit="100" wizardCaption="List of P App Role " wizardGridType="Tabular" wizardAllowInsert="True" wizardAltRecord="True" wizardAltRecordType="Style" wizardRecordSeparator="False" wizardNoRecords="-" pasteAsReplace="pasteAsReplace" pasteActions="pasteActions" activeCollection="SQLParameters" parameterTypeListName="ParameterTypeList" dataSource="select to_char(to_char(sysdate,'q'),'FMRN') AS triwulan" orderBy="p_vat_type_id">
			<Components>
				<Navigator id="965" size="10" type="Centered" pageSizes="1;5;10;25;50" name="Navigator" wizardPagingType="Custom" wizardFirst="True" wizardFirstText="First" wizardPrev="True" wizardPrevText="Prev" wizardNext="True" wizardNextText="Next" wizardLast="True" wizardLastText="Last" wizardImages="Images" wizardPageNumbers="Centered" wizardSize="10" wizardTotalPages="False" wizardHideDisabled="False" wizardOfText="of" wizardPageSize="False" wizardUsePageScroller="True">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Navigator>
				<Label id="966" fieldSourceType="DBColumn" dataType="Float" html="False" name="target_amount_hotel" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_target_realisasi_jenisGrid1target_amount_hotel" format="#,##0.00">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Hidden id="970" fieldSourceType="DBColumn" dataType="Text" name="t_revenue_target_id" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_target_realisasi_jenisGrid1t_revenue_target_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="971" fieldSourceType="DBColumn" dataType="Text" name="p_year_period_id2" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_target_realisasi_jenisGrid1p_year_period_id2">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="972" fieldSourceType="DBColumn" dataType="Float" name="p_vat_type_id2" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_target_realisasi_jenisGrid1p_vat_type_id2">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Label id="973" fieldSourceType="DBColumn" dataType="Float" html="False" name="target_amount_sum" PathID="t_target_realisasi_jenisGrid1target_amount_sum" format="#,##0.00">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="974" fieldSourceType="CodeExpression" dataType="Float" html="False" name="realisasi_amt_sum" PathID="t_target_realisasi_jenisGrid1realisasi_amt_sum" format="#,##0.00">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="975" fieldSourceType="DBColumn" dataType="Float" html="False" name="percentage_sum" PathID="t_target_realisasi_jenisGrid1percentage_sum" format="#,##0.00">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Hidden id="976" fieldSourceType="DBColumn" dataType="Float" name="p_vat_group_id" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_target_realisasi_jenisGrid1p_vat_group_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Link id="977" visible="Yes" fieldSourceType="CodeExpression" dataType="Text" html="True" hrefType="Page" urlType="Relative" preserveParameters="GET" name="DLink" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_target_realisasi_jenisGrid1DLink" hrefSource="t_target_realisasi_jenis.ccp" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="978" sourceType="DataField" name="t_revenue_target_id" source="t_revenue_target_id"/>
						<LinkParameter id="979" sourceType="DataField" name="p_year_period_id" source="p_year_period_id"/>
						<LinkParameter id="980" sourceType="DataField" name="p_vat_type_id" source="p_vat_type_id"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
				<Label id="981" fieldSourceType="DBColumn" dataType="Float" html="False" name="realisasi_amt_hotel" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_target_realisasi_jenisGrid1realisasi_amt_hotel" format="#,##0.00">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="982" fieldSourceType="DBColumn" dataType="Float" html="False" name="percentage_hotel" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_target_realisasi_jenisGrid1percentage_hotel" format="#,##0.00">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="983" fieldSourceType="DBColumn" dataType="Float" html="False" name="selisih_hotel" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_target_realisasi_jenisGrid1selisih_hotel" format="#,##0.00">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="984" fieldSourceType="DBColumn" dataType="Float" html="False" name="percentage_selisih_hotel" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_target_realisasi_jenisGrid1percentage_selisih_hotel" format="#,##0.00">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="985" fieldSourceType="CodeExpression" dataType="Float" html="False" name="selisih_sum" PathID="t_target_realisasi_jenisGrid1selisih_sum" format="#,##0.00">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="986" fieldSourceType="DBColumn" dataType="Float" html="False" name="percentage_selisih_sum" PathID="t_target_realisasi_jenisGrid1percentage_selisih_sum" format="#,##0.00">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="995" fieldSourceType="DBColumn" dataType="Text" html="False" name="triwulan" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_target_realisasi_jenisGrid1triwulan" fieldSource="triwulan">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="996" fieldSourceType="DBColumn" dataType="Text" html="False" name="triwulan1" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_target_realisasi_jenisGrid1triwulan1" fieldSource="triwulan">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="997" fieldSourceType="DBColumn" dataType="Float" html="False" name="target_amount_resto" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_target_realisasi_jenisGrid1target_amount_resto" format="#,##0.00">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
<Label id="998" fieldSourceType="DBColumn" dataType="Float" html="False" name="target_amount_hiburan" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_target_realisasi_jenisGrid1target_amount_hiburan" format="#,##0.00">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
<Label id="999" fieldSourceType="DBColumn" dataType="Float" html="False" name="target_amount_parkir" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_target_realisasi_jenisGrid1target_amount_parkir" format="#,##0.00">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
<Label id="1000" fieldSourceType="DBColumn" dataType="Float" html="False" name="target_amount_ppj" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_target_realisasi_jenisGrid1target_amount_ppj" format="#,##0.00">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
<Label id="1001" fieldSourceType="DBColumn" dataType="Float" html="False" name="target_amount_bphtb" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_target_realisasi_jenisGrid1target_amount_bphtb" format="#,##0.00">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
<Label id="1002" fieldSourceType="DBColumn" dataType="Float" html="False" name="target_amount_pbb" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_target_realisasi_jenisGrid1target_amount_pbb" format="#,##0.00">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
<Label id="1003" fieldSourceType="DBColumn" dataType="Float" html="False" name="target_amount_reklame" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_target_realisasi_jenisGrid1target_amount_reklame" format="#,##0.00">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
<Label id="1004" fieldSourceType="DBColumn" dataType="Float" html="False" name="target_amount_pat" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_target_realisasi_jenisGrid1target_amount_pat" format="#,##0.00">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
<Label id="1005" fieldSourceType="DBColumn" dataType="Float" html="False" name="target_amount_denda" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_target_realisasi_jenisGrid1target_amount_denda" format="#,##0.00">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
<Label id="1006" fieldSourceType="DBColumn" dataType="Float" html="False" name="realisasi_amt_resto" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_target_realisasi_jenisGrid1realisasi_amt_resto" format="#,##0.00">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
<Label id="1007" fieldSourceType="DBColumn" dataType="Float" html="False" name="realisasi_amt_hiburan" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_target_realisasi_jenisGrid1realisasi_amt_hiburan" format="#,##0.00">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
<Label id="1008" fieldSourceType="DBColumn" dataType="Float" html="False" name="realisasi_amt_parkir" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_target_realisasi_jenisGrid1realisasi_amt_parkir" format="#,##0.00">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
<Label id="1009" fieldSourceType="DBColumn" dataType="Float" html="False" name="realisasi_amt_ppj" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_target_realisasi_jenisGrid1realisasi_amt_ppj" format="#,##0.00">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
<Label id="1010" fieldSourceType="DBColumn" dataType="Float" html="False" name="realisasi_amt_bphtb" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_target_realisasi_jenisGrid1realisasi_amt_bphtb" format="#,##0.00">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
<Label id="1011" fieldSourceType="DBColumn" dataType="Float" html="False" name="realisasi_amt_pbb" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_target_realisasi_jenisGrid1realisasi_amt_pbb" format="#,##0.00">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
<Label id="1012" fieldSourceType="DBColumn" dataType="Float" html="False" name="realisasi_amt_reklame" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_target_realisasi_jenisGrid1realisasi_amt_reklame" format="#,##0.00">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
<Label id="1013" fieldSourceType="DBColumn" dataType="Float" html="False" name="realisasi_amt_pat" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_target_realisasi_jenisGrid1realisasi_amt_pat" format="#,##0.00">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
<Label id="1014" fieldSourceType="DBColumn" dataType="Float" html="False" name="realisasi_amt_denda" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_target_realisasi_jenisGrid1realisasi_amt_denda" format="#,##0.00">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
<Label id="1015" fieldSourceType="DBColumn" dataType="Float" html="False" name="percentage_resto" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_target_realisasi_jenisGrid1percentage_resto" format="#,##0.00">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
<Label id="1016" fieldSourceType="DBColumn" dataType="Float" html="False" name="percentage_hiburan" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_target_realisasi_jenisGrid1percentage_hiburan" format="#,##0.00">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
<Label id="1017" fieldSourceType="DBColumn" dataType="Float" html="False" name="percentage_parkir" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_target_realisasi_jenisGrid1percentage_parkir" format="#,##0.00">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
<Label id="1018" fieldSourceType="DBColumn" dataType="Float" html="False" name="percentage_ppj" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_target_realisasi_jenisGrid1percentage_ppj" format="#,##0.00">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
<Label id="1020" fieldSourceType="DBColumn" dataType="Float" html="False" name="percentage_pbb" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_target_realisasi_jenisGrid1percentage_pbb" format="#,##0.00">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
<Label id="1021" fieldSourceType="DBColumn" dataType="Float" html="False" name="percentage_reklame" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_target_realisasi_jenisGrid1percentage_reklame" format="#,##0.00">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
<Label id="1022" fieldSourceType="DBColumn" dataType="Float" html="False" name="percentage_pat" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_target_realisasi_jenisGrid1percentage_pat" format="#,##0.00">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
<Label id="1023" fieldSourceType="DBColumn" dataType="Float" html="False" name="percentage_denda" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_target_realisasi_jenisGrid1percentage_denda" format="#,##0.00">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
<Label id="1024" fieldSourceType="DBColumn" dataType="Float" html="False" name="selisih_resto" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_target_realisasi_jenisGrid1selisih_resto" format="#,##0.00">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
<Label id="1025" fieldSourceType="DBColumn" dataType="Float" html="False" name="selisih_hiburan" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_target_realisasi_jenisGrid1selisih_hiburan" format="#,##0.00">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
<Label id="1026" fieldSourceType="DBColumn" dataType="Float" html="False" name="selisih_parkir" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_target_realisasi_jenisGrid1selisih_parkir" format="#,##0.00">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
<Label id="1027" fieldSourceType="DBColumn" dataType="Float" html="False" name="selisih_ppj" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_target_realisasi_jenisGrid1selisih_ppj" format="#,##0.00">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
<Label id="1028" fieldSourceType="DBColumn" dataType="Float" html="False" name="selisih_bphtb" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_target_realisasi_jenisGrid1selisih_bphtb" format="#,##0.00">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
<Label id="1029" fieldSourceType="DBColumn" dataType="Float" html="False" name="selisih_pbb" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_target_realisasi_jenisGrid1selisih_pbb" format="#,##0.00">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
<Label id="1030" fieldSourceType="DBColumn" dataType="Float" html="False" name="selisih_reklame" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_target_realisasi_jenisGrid1selisih_reklame" format="#,##0.00">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
<Label id="1031" fieldSourceType="DBColumn" dataType="Float" html="False" name="selisih_pat" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_target_realisasi_jenisGrid1selisih_pat" format="#,##0.00">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
<Label id="1032" fieldSourceType="DBColumn" dataType="Float" html="False" name="selisih_denda" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_target_realisasi_jenisGrid1selisih_denda" format="#,##0.00">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
<Label id="1033" fieldSourceType="DBColumn" dataType="Float" html="False" name="percentage_selisih_resto" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_target_realisasi_jenisGrid1percentage_selisih_resto" format="#,##0.00">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
<Label id="1034" fieldSourceType="DBColumn" dataType="Float" html="False" name="percentage_selisih_hiburan" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_target_realisasi_jenisGrid1percentage_selisih_hiburan" format="#,##0.00">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
<Label id="1035" fieldSourceType="DBColumn" dataType="Float" html="False" name="percentage_selisih_parkir" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_target_realisasi_jenisGrid1percentage_selisih_parkir" format="#,##0.00">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
<Label id="1036" fieldSourceType="DBColumn" dataType="Float" html="False" name="percentage_selisih_ppj" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_target_realisasi_jenisGrid1percentage_selisih_ppj" format="#,##0.00">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
<Label id="1037" fieldSourceType="DBColumn" dataType="Float" html="False" name="percentage_selisih_bphtb" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_target_realisasi_jenisGrid1percentage_selisih_bphtb" format="#,##0.00">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
<Label id="1038" fieldSourceType="DBColumn" dataType="Float" html="False" name="percentage_selisih_pbb" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_target_realisasi_jenisGrid1percentage_selisih_pbb" format="#,##0.00">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
<Label id="1039" fieldSourceType="DBColumn" dataType="Float" html="False" name="percentage_selisih_reklame" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_target_realisasi_jenisGrid1percentage_selisih_reklame" format="#,##0.00">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
<Label id="1040" fieldSourceType="DBColumn" dataType="Float" html="False" name="percentage_selisih_pat" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_target_realisasi_jenisGrid1percentage_selisih_pat" format="#,##0.00">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
<Label id="1041" fieldSourceType="DBColumn" dataType="Float" html="False" name="percentage_selisih_denda" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_target_realisasi_jenisGrid1percentage_selisih_denda" format="#,##0.00">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
<Label id="1019" fieldSourceType="DBColumn" dataType="Float" html="False" name="percentage_bphtb" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_target_realisasi_jenisGrid1percentage_bphtb" format="#,##0.00">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
</Components>
			<Events>
				<Event name="BeforeSelect" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="987" eventType="Server"/>
					</Actions>
				</Event>
				<Event name="BeforeShowRow" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="988" eventType="Server"/>
					</Actions>
				</Event>
				<Event name="BeforeExecuteSelect" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="989"/>
					</Actions>
				</Event>
				<Event name="BeforeBuildSelect" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="990"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
				<TableParameter id="991" conditionType="Parameter" useIsNull="False" field="p_year_period_id" dataType="Float" searchConditionType="Equal" parameterType="URL" logicOperator="And" DBFormat="0" parameterSource="p_year_period_id"/>
			</TableParameters>
			<JoinTables>
			</JoinTables>
			<JoinLinks/>
			<Fields>
				<Field id="992" fieldName="*"/>
			</Fields>
			<SPParameters/>
			<SQLParameters>
				<SQLParameter id="993" parameterType="Session" variable="p_year_period_id" dataType="Float" parameterSource="p_year_period_id2" DBFormat="0" defaultValue="0"/>
				<SQLParameter id="994" variable="p_vat_group_id" parameterType="URL" defaultValue="0" dataType="Integer" parameterSource="p_vat_group_id"/>
			</SQLParameters>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Grid>
	</Components>
	<CodeFiles>
		<CodeFile id="Events" language="PHPTemplates" name="t_target_realisasi_jenis_view_large_dengan_target_triwulan_v2_events.php" forShow="False" comment="//" codePage="windows-1252"/>
		<CodeFile id="Code" language="PHPTemplates" name="t_target_realisasi_jenis_view_large_dengan_target_triwulan_v2.php" forShow="True" url="t_target_realisasi_jenis_view_large_dengan_target_triwulan_v2.php" comment="//" codePage="windows-1252"/>
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
		<Event name="BeforeShow" type="Server">
			<Actions>
				<Action actionName="Custom Code" actionCategory="General" id="914"/>
			</Actions>
		</Event>
	</Events>
</Page>
