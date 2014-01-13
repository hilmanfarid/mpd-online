<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\trans" secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="RWNet" wizardThemeVersion="3.0" needGeneration="0" pasteActions="pasteActions" connection="ConnSIKP">
	<Components>
		<Grid id="2" secured="False" sourceType="SQL" returnValueType="Number" defaultPageSize="5" connection="ConnSIKP" name="t_status_pelaporan_pajakGrid" pageSizeLimit="100" wizardCaption="List of P App Role " wizardGridType="Tabular" wizardAllowInsert="True" wizardAltRecord="True" wizardAltRecordType="Style" wizardRecordSeparator="False" wizardNoRecords="-" pasteAsReplace="pasteAsReplace" pasteActions="pasteActions" activeCollection="SQLParameters" parameterTypeListName="ParameterTypeList" dataSource="select * from f_rep_status_lapor_pajak({p_finance_period_id})">
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
				<Link id="724" visible="Yes" fieldSourceType="DBColumn" dataType="Text" html="False" hrefType="Page" urlType="Relative" preserveParameters="GET" name="status_lapor" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_status_pelaporan_pajakGridstatus_lapor" hrefSource="t_status_pelaporan_pajak.ccp" wizardUseTemplateBlock="False" fieldSource="status">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="725" sourceType="URL" format="yyyy-mm-dd" name="p_finance_period_id" source="p_finance_period_id"/>
						<LinkParameter id="728" sourceType="DataField" name="status_lapor" source="status"/>
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
				<Hidden id="727" fieldSourceType="DBColumn" dataType="Text" name="status" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_status_pelaporan_pajakGridstatus" fieldSource="status">
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
				<Hidden id="729" fieldSourceType="DBColumn" dataType="Text" name="p_finance_period_id" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_status_pelaporan_pajakSearchp_finance_period_id">
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
