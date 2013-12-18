<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\trans" secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="Spring" wizardThemeVersion="3.0" needGeneration="0" pasteActions="pasteActions">
	<Components>
		<Grid id="2" secured="False" sourceType="Table" returnValueType="Number" defaultPageSize="5" connection="ConnSIKP" name="t_vat_setllement_dtlGrid" pageSizeLimit="100" wizardCaption="List of P App Module Role " wizardGridType="Tabular" wizardSortingType="SimpleDir" wizardAllowInsert="True" wizardAltRecord="False" wizardAltRecordType="Style" wizardRecordSeparator="False" wizardNoRecords="data tidak ditemukan" activeCollection="TableParameters" pasteActions="pasteActions" parameterTypeListName="ParameterTypeList" dataSource="v_vat_setllement_dtl" orderBy="t_vat_setllement_dtl_id">
			<Components>
				<Label id="28" fieldSourceType="DBColumn" dataType="Text" html="False" name="service_charge" fieldSource="service_charge" wizardCaption="Valid From" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="t_vat_setllement_dtlGridservice_charge">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="30" fieldSourceType="DBColumn" dataType="Text" html="False" name="vat_charge" fieldSource="vat_charge" wizardCaption="Valid To" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="t_vat_setllement_dtlGridvat_charge">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="32" fieldSourceType="DBColumn" dataType="Text" html="False" name="company_name" fieldSource="company_name" wizardCaption="Description" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="t_vat_setllement_dtlGridcompany_name">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Navigator id="41" size="10" type="Centered" pageSizes="1;5;10;25;50" name="Navigator" wizardPagingType="Custom" wizardFirst="True" wizardFirstText="First" wizardPrev="True" wizardPrevText="Prev" wizardNext="True" wizardNextText="Next" wizardLast="True" wizardLastText="Last" wizardPageNumbers="Centered" wizardSize="10" wizardTotalPages="False" wizardHideDisabled="False" wizardOfText="of" wizardPageSize="False" wizardImages="Images" wizardUsePageScroller="True">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Navigator>
				<Label id="86" fieldSourceType="DBColumn" dataType="Text" html="False" name="service_desc" fieldSource="service_desc" wizardCaption="Description" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="t_vat_setllement_dtlGridservice_desc">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Link id="11" visible="Yes" fieldSourceType="CodeExpression" html="True" hrefType="Page" urlType="Relative" preserveParameters="GET" name="DLink" wizardCaption="Detail" wizardSize="50" wizardMaxLength="60" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" dataType="Text" wizardDefaultValue="DLink" hrefSource="t_vat_setllement_dtl.ccp" wizardThemeItem="GridA" PathID="t_vat_setllement_dtlGridDLink" removeParameters="FLAG">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="194" sourceType="DataField" name="t_vat_setllement_dtl_id" source="t_vat_setllement_dtl_id"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
				<Hidden id="184" fieldSourceType="DBColumn" dataType="Float" name="t_vat_setllement_dtl_id" fieldSource="t_vat_setllement_dtl_id" required="False" caption="Id" wizardCaption="Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_setllement_dtlGridt_vat_setllement_dtl_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Label id="195" fieldSourceType="DBColumn" dataType="Text" html="False" name="trans_date" fieldSource="trans_date" wizardCaption="Description" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="t_vat_setllement_dtlGridtrans_date">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
			</Components>
			<Events>
				<Event name="BeforeShowRow" type="Server">
					<Actions>
						<Action actionName="Set Row Style" actionCategory="General" id="87" styles="Row;AltRow" name="rowStyle"/>
					</Actions>
				</Event>
				<Event name="BeforeShow" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="88"/>
					</Actions>
				</Event>
				<Event name="BeforeSelect" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="183"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
				<TableParameter id="191" conditionType="Parameter" useIsNull="False" field="upper(npwd)" dataType="Text" searchConditionType="Contains" parameterType="URL" logicOperator="Or" parameterSource="s_keyword" leftBrackets="1"/>
				<TableParameter id="192" conditionType="Parameter" useIsNull="False" field="upper(service_desc)" dataType="Text" searchConditionType="Contains" parameterType="URL" logicOperator="And" parameterSource="s_keyword" rightBrackets="1"/>
				<TableParameter id="193" conditionType="Parameter" useIsNull="False" field="t_vat_setllement_id" dataType="Float" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="t_vat_setllement_id"/>
			</TableParameters>
			<JoinTables>
				<JoinTable id="190" tableName="v_vat_setllement_dtl" posLeft="10" posTop="10" posWidth="160" posHeight="180"/>
			</JoinTables>
			<JoinLinks/>
			<Fields/>
			<SPParameters/>
			<SQLParameters>
			</SQLParameters>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Grid>
		<Record id="3" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="None" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="t_vat_setllement_dtlSearch" wizardCaption="Search P App Module Role " wizardOrientation="Vertical" wizardFormMethod="post" returnPage="t_vat_setllement_dtl.ccp" PathID="t_vat_setllement_dtlSearch" pasteActions="pasteActions">
			<Components>
				<TextBox id="5" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="s_keyword" wizardCaption="Keyword" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" PathID="t_vat_setllement_dtlSearchs_keyword">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Button id="4" urlType="Relative" enableValidation="True" isDefault="False" name="Button_DoSearch" operation="Search" wizardCaption="Search" PathID="t_vat_setllement_dtlSearchButton_DoSearch">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Hidden id="170" fieldSourceType="DBColumn" dataType="Float" name="t_cust_account_id" PathID="t_vat_setllement_dtlSearcht_cust_account_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="167" fieldSourceType="DBColumn" dataType="Float" name="p_finance_period_id" PathID="t_vat_setllement_dtlSearchp_finance_period_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="169" fieldSourceType="DBColumn" dataType="Float" name="t_customer_order_id" PathID="t_vat_setllement_dtlSearcht_customer_order_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="196" fieldSourceType="DBColumn" dataType="Text" name="npwd" PathID="t_vat_setllement_dtlSearchnpwd">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="197" fieldSourceType="DBColumn" dataType="Text" name="finance_period_code" PathID="t_vat_setllement_dtlSearchfinance_period_code">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="198" fieldSourceType="DBColumn" dataType="Text" name="order_no" PathID="t_vat_setllement_dtlSearchorder_no">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="13" fieldSourceType="DBColumn" dataType="Float" html="False" name="t_vat_setllement_id" wizardCaption="Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="t_vat_setllement_dtlSearcht_vat_setllement_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="199" fieldSourceType="DBColumn" dataType="Text" name="rqst_type_code" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_vat_setllement_dtlSearchrqst_type_code">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Hidden>
<Hidden id="200" fieldSourceType="DBColumn" dataType="Float" name="p_rqst_type_id" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_vat_setllement_dtlSearchp_rqst_type_id">
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
		<CodeFile id="Events" language="PHPTemplates" name="t_vat_setllement_dtl_events.php" forShow="False" comment="//" codePage="windows-1252"/>
		<CodeFile id="Code" language="PHPTemplates" name="t_vat_setllement_dtl.php" forShow="True" url="t_vat_setllement_dtl.php" comment="//" codePage="windows-1252"/>
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
