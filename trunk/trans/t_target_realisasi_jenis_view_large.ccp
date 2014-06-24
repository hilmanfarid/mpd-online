<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\trans" secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="RWNet" wizardThemeVersion="3.0" needGeneration="0" pasteActions="pasteActions" connection="ConnSIKP">
	<Components>
		<Grid id="2" secured="False" sourceType="SQL" returnValueType="Number" defaultPageSize="7" connection="ConnSIKP" name="t_target_realisasi_jenisGrid" pageSizeLimit="100" wizardCaption="List of P App Role " wizardGridType="Tabular" wizardAllowInsert="True" wizardAltRecord="True" wizardAltRecordType="Style" wizardRecordSeparator="False" wizardNoRecords="-" pasteAsReplace="pasteAsReplace" pasteActions="pasteActions" activeCollection="SQLParameters" parameterTypeListName="ParameterTypeList" dataSource="(SELECT 
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
and p_vat_group_id=1
ORDER BY p_vat_type_id
)

UNION
(SELECT
	'999',
	{p_year_period_id},
	MAX (p_vat_type_id),
	'DENDA',
	'',
	0,
	SUM (round(jml_sd_hari_ini))
FROM
	sikp.f_rep_lap_harian_bdhr_baru ({p_year_period_id})
where nomor_ayat IN('140701','140702','140703','140707')
and p_vat_group_id = 1
)" orderBy="p_vat_type_id">
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
						<Action actionName="Custom Code" actionCategory="General" id="906"/>
					</Actions>
				</Event>
				<Event name="BeforeBuildSelect" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="907"/>
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
				<SQLParameter id="677" parameterType="URL" variable="p_year_period_id" dataType="Float" parameterSource="p_year_period_id2" DBFormat="0" defaultValue="0"/>
				<SQLParameter id="875" variable="p_vat_group_id" parameterType="URL" defaultValue="0" dataType="Integer" parameterSource="p_vat_group_id"/>
			</SQLParameters>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Grid>
		<Grid id="880" secured="False" sourceType="SQL" returnValueType="Number" defaultPageSize="7" connection="ConnSIKP" name="t_target_realisasi_jenisGrid1" pageSizeLimit="100" wizardCaption="List of P App Role " wizardGridType="Tabular" wizardAllowInsert="True" wizardAltRecord="True" wizardAltRecordType="Style" wizardRecordSeparator="False" wizardNoRecords="-" pasteAsReplace="pasteAsReplace" pasteActions="pasteActions" activeCollection="SQLParameters" parameterTypeListName="ParameterTypeList" dataSource="(SELECT t_revenue_target_id, p_year_period_id, p_vat_type_id, vat_code, year_code, target_amount, realisasi_amt
FROM v_revenue_target_vs_realisasi
WHERE p_year_period_id = 
	(
	select p_year_period_id from p_year_period 
	where year_code = (select extract(year from sysdate))
	)
and p_vat_group_id=2
ORDER BY p_vat_type_id)
UNION
(SELECT
	'999',
	{p_year_period_id}
	,
	MAX (p_vat_type_id),
	'DENDA',
	'',
	0,
	SUM (round(jml_sd_hari_ini))
FROM
	sikp.f_rep_lap_harian_bdhr_baru ({p_year_period_id})
where nomor_ayat IN('140701','140702','140703','140707')
and p_vat_group_id = 2)" orderBy="p_vat_type_id">
			<Components>
				<Navigator id="881" size="10" type="Centered" pageSizes="1;5;10;25;50" name="Navigator" wizardPagingType="Custom" wizardFirst="True" wizardFirstText="First" wizardPrev="True" wizardPrevText="Prev" wizardNext="True" wizardNextText="Next" wizardLast="True" wizardLastText="Last" wizardImages="Images" wizardPageNumbers="Centered" wizardSize="10" wizardTotalPages="False" wizardHideDisabled="False" wizardOfText="of" wizardPageSize="False" wizardUsePageScroller="True">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Navigator>
				<Label id="886" fieldSourceType="DBColumn" dataType="Float" html="False" name="target_amount" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_target_realisasi_jenisGrid1target_amount" fieldSource="target_amount" format="#,##0.00">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Hidden id="887" fieldSourceType="DBColumn" dataType="Float" name="p_year_period_id" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_target_realisasi_jenisGrid1p_year_period_id" fieldSource="p_year_period_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Label id="889" fieldSourceType="DBColumn" dataType="Text" html="False" name="vat_code" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_target_realisasi_jenisGrid1vat_code" fieldSource="vat_code">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Hidden id="890" fieldSourceType="DBColumn" dataType="Float" name="p_vat_type_id" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_target_realisasi_jenisGrid1p_vat_type_id" fieldSource="p_vat_type_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Label id="893" fieldSourceType="DBColumn" dataType="Float" html="False" name="realisasi_amt" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_target_realisasi_jenisGrid1realisasi_amt" fieldSource="realisasi_amt" format="#,##0.00">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="894" fieldSourceType="CodeExpression" dataType="Float" html="False" name="percentage" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_target_realisasi_jenisGrid1percentage">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="896" fieldSourceType="DBColumn" dataType="Float" html="False" name="target_amount_sum" PathID="t_target_realisasi_jenisGrid1target_amount_sum" format="#,##0.00">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="897" fieldSourceType="CodeExpression" dataType="Float" html="False" name="realisasi_amt_sum" PathID="t_target_realisasi_jenisGrid1realisasi_amt_sum" format="#,##0.00">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="898" fieldSourceType="DBColumn" dataType="Float" html="False" name="percentage_sum" PathID="t_target_realisasi_jenisGrid1percentage_sum" format="#,##0.00">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Hidden id="908" fieldSourceType="DBColumn" dataType="Text" name="p_year_period_id2" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_target_realisasi_jenisGrid1p_year_period_id2">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
			</Components>
			<Events>
				<Event name="BeforeSelect" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="900" eventType="Server"/>
					</Actions>
				</Event>
				<Event name="BeforeShowRow" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="901" eventType="Server"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
				<TableParameter id="902" conditionType="Parameter" useIsNull="False" field="p_year_period_id" dataType="Float" searchConditionType="Equal" parameterType="URL" logicOperator="And" DBFormat="0" parameterSource="p_year_period_id"/>
			</TableParameters>
			<JoinTables>
			</JoinTables>
			<JoinLinks/>
			<Fields>
				<Field id="903" fieldName="*"/>
			</Fields>
			<SPParameters/>
			<SQLParameters>
				<SQLParameter id="904" parameterType="URL" variable="p_year_period_id" dataType="Float" parameterSource="p_year_period_id2" DBFormat="0" defaultValue="0"/>
				<SQLParameter id="905" variable="p_vat_group_id" parameterType="URL" defaultValue="0" dataType="Integer" parameterSource="p_vat_group_id"/>
			</SQLParameters>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Grid>
		<Grid id="909" secured="False" sourceType="SQL" returnValueType="Number" defaultPageSize="5" connection="ConnSIKP" name="t_target_realisasiGrid" pageSizeLimit="100" wizardCaption="List of P App Role " wizardGridType="Tabular" wizardAllowInsert="True" wizardAltRecord="True" wizardAltRecordType="Style" wizardRecordSeparator="False" wizardNoRecords="-" pasteAsReplace="pasteAsReplace" pasteActions="pasteActions" activeCollection="TableParameters" parameterTypeListName="ParameterTypeList" dataSource="select * from v_target_realisasi_updated
where target_amt &gt; 0 AND realisasi_amt &gt; 0
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
<Action actionName="Custom Code" actionCategory="General" id="915"/>
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
</Components>
	<CodeFiles>
		<CodeFile id="Events" language="PHPTemplates" name="t_target_realisasi_jenis_view_large_events.php" forShow="False" comment="//" codePage="windows-1252"/>
		<CodeFile id="Code" language="PHPTemplates" name="t_target_realisasi_jenis_view_large.php" forShow="True" url="t_target_realisasi_jenis_view_large.php" comment="//" codePage="windows-1252"/>
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
