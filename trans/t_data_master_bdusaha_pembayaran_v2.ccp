<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\trans" secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="CoffeeBreak" wizardThemeVersion="3.0" needGeneration="0" pasteActions="pasteActions">
	<Components>
		<Grid id="2" secured="False" sourceType="SQL" returnValueType="Number" defaultPageSize="15" connection="ConnSIKP" name="t_ppatGrid" pageSizeLimit="100" wizardCaption="List of P App Role " wizardGridType="Tabular" wizardAllowInsert="True" wizardAltRecord="True" wizardAltRecordType="Style" wizardRecordSeparator="False" wizardNoRecords="-" pasteAsReplace="pasteAsReplace" pasteActions="pasteActions" activeCollection="SQLParameters" dataSource="select left(no_spt,length(no_spt)-3) as no_spt_2,
left(no_kohir,length(no_kohir)-3) as no_kohir_2,
left(no_bukti_set,length(no_bukti_set)-3) as no_bukti_set_2,
* from tuuset98 where npwpd_set = '{npwpd_bu}'
ORDER BY thn_bln desc" orderBy="p_vat_type_id" parameterTypeListName="ParameterTypeList">
			<Components>
				<Navigator id="22" size="10" type="Centered" pageSizes="1;5;10;25;50" name="Navigator" wizardPagingType="Custom" wizardFirst="True" wizardFirstText="First" wizardPrev="True" wizardPrevText="Prev" wizardNext="True" wizardNextText="Next" wizardLast="True" wizardLastText="Last" wizardImages="Images" wizardPageNumbers="Centered" wizardSize="10" wizardTotalPages="False" wizardHideDisabled="False" wizardOfText="of" wizardPageSize="False" wizardUsePageScroller="True">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Navigator>
				<Label id="67" fieldSourceType="DBColumn" dataType="Text" html="False" name="no_spt" fieldSource="no_spt_2" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="t_ppatGridno_spt">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
<Label id="68" fieldSourceType="DBColumn" dataType="Text" html="False" name="nama_bu" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="t_ppatGridnama_bu">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
<Label id="69" fieldSourceType="DBColumn" dataType="Text" html="False" name="npwpd_set" fieldSource="npwpd_set" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="t_ppatGridnpwpd_set">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
<Label id="70" fieldSourceType="DBColumn" dataType="Text" html="False" name="thn_bln" fieldSource="thn_bln" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="t_ppatGridthn_bln">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
<Label id="71" fieldSourceType="DBColumn" dataType="Text" html="False" name="tgl_tetap" fieldSource="tgl_tetap" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="t_ppatGridtgl_tetap">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
<Label id="72" fieldSourceType="DBColumn" dataType="Float" html="False" name="jml_tetap" fieldSource="jml_tetap" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="t_ppatGridjml_tetap" format="#,##0.00">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
<Label id="73" fieldSourceType="DBColumn" dataType="Text" html="False" name="tanggal_set" fieldSource="tanggal_set" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="t_ppatGridtanggal_set">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
<Label id="74" fieldSourceType="DBColumn" dataType="Text" html="False" name="no_kohir" fieldSource="no_kohir_2" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="t_ppatGridno_kohir">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
<Label id="75" fieldSourceType="DBColumn" dataType="Text" html="False" name="no_bukti_set" fieldSource="no_bukti_set_2" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="t_ppatGridno_bukti_set">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
<Label id="76" fieldSourceType="DBColumn" dataType="Float" html="False" name="jml_setor" fieldSource="jml_setor" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="t_ppatGridjml_setor" format="#,##0.00">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
</Components>
			<Events>
				<Event name="BeforeSelect" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="226" eventType="Server"/>
					</Actions>
				</Event>
				<Event name="BeforeShowRow" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="227" eventType="Server"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
				<TableParameter id="8" conditionType="Parameter" useIsNull="False" field="upper(code)" dataType="Text" logicOperator="Or" searchConditionType="Contains" parameterType="URL" orderNumber="1" leftBrackets="0" parameterSource="s_keyword"/>
				<TableParameter id="9" conditionType="Parameter" useIsNull="False" field="upper(description)" dataType="Text" logicOperator="Or" searchConditionType="Contains" parameterType="URL" orderNumber="2" rightBrackets="0" parameterSource="s_keyword"/>
			</TableParameters>
			<JoinTables>
			</JoinTables>
			<JoinLinks/>
			<Fields>
				<Field id="225" fieldName="to_char(updated_date,'DD-MON-YYYY')" isExpression="True" alias="updated_date"/>
			</Fields>
			<SPParameters/>
			<SQLParameters>
				<SQLParameter id="149" parameterType="URL" variable="s_keyword" dataType="Text" parameterSource="s_keyword"/>
				<SQLParameter id="228" variable="npwpd_bu" parameterType="URL" dataType="Text" parameterSource="npwpd_bu"/>
</SQLParameters>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Grid>
		<Hidden id="137" visible="Yes" fieldSourceType="CodeExpression" dataType="Text" name="nama_bu" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="nama_bu" html="False">
			<Components/>
			<Events/>
			<Attributes/>
			<Features/>
		</Hidden>
<Hidden id="229" visible="Yes" fieldSourceType="CodeExpression" dataType="Text" name="npwpd_bu" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="npwpd_bu" html="False">
			<Components/>
			<Events/>
			<Attributes/>
			<Features/>
		</Hidden>
<Hidden id="231" visible="Yes" fieldSourceType="CodeExpression" dataType="Text" name="s_keyword" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="s_keyword" html="False">
			<Components/>
			<Events/>
			<Attributes/>
			<Features/>
		</Hidden>
</Components>
	<CodeFiles>
		<CodeFile id="Events" language="PHPTemplates" name="t_data_master_bdusaha_pembayaran_v2_events.php" forShow="False" comment="//" codePage="windows-1252"/>
		<CodeFile id="Code" language="PHPTemplates" name="t_data_master_bdusaha_pembayaran_v2.php" forShow="True" url="t_data_master_bdusaha_pembayaran_v2.php" comment="//" codePage="windows-1252"/>
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
