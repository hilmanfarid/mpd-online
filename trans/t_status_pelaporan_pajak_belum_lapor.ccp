<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\trans" secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="RWNet" wizardThemeVersion="3.0" needGeneration="0" pasteActions="pasteActions" connection="ConnSIKP">
	<Components>
		<Grid id="2" secured="False" sourceType="SQL" returnValueType="Number" defaultPageSize="31" connection="ConnSIKP" name="t_status_pelaporan_pajak_belum_laporGrid" pageSizeLimit="100" wizardCaption="List of P App Role " wizardGridType="Tabular" wizardAllowInsert="True" wizardAltRecord="True" wizardAltRecordType="Style" wizardRecordSeparator="False" wizardNoRecords="-" pasteAsReplace="pasteAsReplace" pasteActions="pasteActions" activeCollection="SQLParameters" parameterTypeListName="ParameterTypeList" dataSource="select * from f_status_belum_lapor({p_finance_period_id}, {active})">
			<Components>
				<Navigator id="22" size="10" type="Centered" pageSizes="1;5;10;25;50" name="Navigator" wizardPagingType="Custom" wizardFirst="True" wizardFirstText="First" wizardPrev="True" wizardPrevText="Prev" wizardNext="True" wizardNextText="Next" wizardLast="True" wizardLastText="Last" wizardImages="Images" wizardPageNumbers="Centered" wizardSize="10" wizardTotalPages="False" wizardHideDisabled="False" wizardOfText="of" wizardPageSize="False" wizardUsePageScroller="True">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Navigator>
				<Label id="555" fieldSourceType="DBColumn" dataType="Text" html="False" name="vat_code" fieldSource="vat_code" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="t_status_pelaporan_pajak_belum_laporGridvat_code">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="696" fieldSourceType="DBColumn" dataType="Text" html="False" name="jml_wp" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_status_pelaporan_pajak_belum_laporGridjml_wp" fieldSource="jml_wp">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Hidden id="698" fieldSourceType="DBColumn" dataType="Float" name="p_finance_period_id" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_status_pelaporan_pajak_belum_laporGridp_finance_period_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="702" fieldSourceType="DBColumn" dataType="Text" name="active" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_status_pelaporan_pajak_belum_laporGridactive">
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
				<SQLParameter id="716" variable="active" parameterType="URL" defaultValue="0" dataType="Float" parameterSource="active"/>
</SQLParameters>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Grid>
	</Components>
	<CodeFiles>
		<CodeFile id="FlashChartXML678" language="PHPTemplates" name="t_status_pelaporan_pajak_belum_laporbelum_lapor.xml" forShow="False" comment="&lt;!--" commentEnd="--&gt;" codePage="windows-1252"/>
		<CodeFile id="Events" language="PHPTemplates" name="t_status_pelaporan_pajak_belum_lapor_events.php" forShow="False" comment="//" codePage="windows-1252"/>
		<CodeFile id="Code" language="PHPTemplates" name="t_status_pelaporan_pajak_belum_lapor.php" forShow="True" url="t_status_pelaporan_pajak_belum_lapor.php" comment="//" codePage="windows-1252"/>
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
