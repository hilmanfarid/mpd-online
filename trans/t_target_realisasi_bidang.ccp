<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\trans" secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="RWNet" wizardThemeVersion="3.0" needGeneration="0" pasteActions="pasteActions" connection="ConnSIKP">
	<Components>
		<Grid id="2" secured="False" sourceType="SQL" returnValueType="Number" defaultPageSize="7" connection="ConnSIKP" name="t_target_realisasi_jenisGrid" pageSizeLimit="100" wizardCaption="List of P App Role " wizardGridType="Tabular" wizardAllowInsert="True" wizardAltRecord="True" wizardAltRecordType="Style" wizardRecordSeparator="False" wizardNoRecords="-" pasteAsReplace="pasteAsReplace" pasteActions="pasteActions" activeCollection="TableParameters" parameterTypeListName="ParameterTypeList" dataSource="(SELECT max(t_revenue_target_id) as t_revenue_target_id, max(p_year_period_id) as p_year_period_id, p_vat_group_id, group_code, max(year_code) as year_code, sum(target_amount) as target_amount, sum(realisasi_amt) as realisasi_amt
FROM v_revenue_target_vs_realisasi
WHERE p_year_period_id = {p_year_period_id}
group by p_vat_group_id,group_code
ORDER BY group_code)" orderBy="p_vat_type_id">
			<Components>
				<Navigator id="22" size="10" type="Centered" pageSizes="1;5;10;25;50" name="Navigator" wizardPagingType="Custom" wizardFirst="True" wizardFirstText="First" wizardPrev="True" wizardPrevText="Prev" wizardNext="True" wizardNextText="Next" wizardLast="True" wizardLastText="Last" wizardImages="Images" wizardPageNumbers="Centered" wizardSize="10" wizardTotalPages="False" wizardHideDisabled="False" wizardOfText="of" wizardPageSize="False" wizardUsePageScroller="True">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Navigator>
				<Link id="690" visible="Yes" fieldSourceType="CodeExpression" dataType="Text" html="True" hrefType="Page" urlType="Relative" preserveParameters="GET" name="DLink" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_target_realisasi_jenisGridDLink" hrefSource="t_target_realisasi_bidang.ccp" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="872" sourceType="DataField" name="p_year_period_id" source="p_year_period_id"/>
						<LinkParameter id="873" sourceType="DataField" name="p_vat_group_id" source="p_vat_group_id"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
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
				<Label id="719" fieldSourceType="DBColumn" dataType="Text" html="False" name="year_code" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_target_realisasi_jenisGridyear_code" fieldSource="year_code">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="720" fieldSourceType="DBColumn" dataType="Text" html="False" name="vat_code" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_target_realisasi_jenisGridvat_code" fieldSource="group_code">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Hidden id="762" fieldSourceType="DBColumn" dataType="Float" name="p_vat_group_id" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_target_realisasi_jenisGridp_vat_group_id" fieldSource="p_vat_group_id">
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
				<Hidden id="874" fieldSourceType="DBColumn" dataType="Float" name="p_vat_group_id2" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_target_realisasi_jenisGridp_vat_group_id2">
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
	</Components>
	<CodeFiles>
		<CodeFile id="Events" language="PHPTemplates" name="t_target_realisasi_bidang_events.php" forShow="False" comment="//" codePage="windows-1252"/>
		<CodeFile id="Code" language="PHPTemplates" name="t_target_realisasi_bidang.php" forShow="True" url="t_target_realisasi_bidang.php" comment="//" codePage="windows-1252"/>
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
