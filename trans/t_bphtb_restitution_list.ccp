<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\trans" secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="RWNet" wizardThemeVersion="3.0" needGeneration="0" pasteActions="pasteActions">
	<Components>
		<Grid id="2" secured="False" sourceType="SQL" returnValueType="Number" defaultPageSize="5" connection="ConnSIKP" name="t_bphtb_registration_list" pageSizeLimit="100" wizardCaption="List of P App Role " wizardGridType="Tabular" wizardAllowInsert="True" wizardAltRecord="True" wizardAltRecordType="Style" wizardRecordSeparator="False" wizardNoRecords="-" pasteAsReplace="pasteAsReplace" pasteActions="pasteActions" activeCollection="TableParameters" parameterTypeListName="ParameterTypeList" dataSource="select cust_order.*,regis.* from t_bphtb_registration regis
LEFT JOIN t_customer_order cust_order on regis.t_customer_order_id = cust_order.t_customer_order_id
where
(cust_order.order_no ILIKE '%{s_keyword}%' OR
regis.wp_name ILIKE '%{s_keyword}%') 
AND cust_order.p_order_status_id = 3
order by regis.t_bphtb_registration_id DESC">
			<Components>
				<Navigator id="22" size="10" type="Centered" pageSizes="1;5;10;25;50" name="Navigator" wizardPagingType="Custom" wizardFirst="True" wizardFirstText="First" wizardPrev="True" wizardPrevText="Prev" wizardNext="True" wizardNextText="Next" wizardLast="True" wizardLastText="Last" wizardImages="Images" wizardPageNumbers="Centered" wizardSize="10" wizardTotalPages="False" wizardHideDisabled="False" wizardOfText="of" wizardPageSize="False" wizardUsePageScroller="True">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Navigator>
				<Label id="555" fieldSourceType="DBColumn" dataType="Text" html="False" name="wp_name" fieldSource="wp_name" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="t_bphtb_registration_listwp_name">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Link id="15" visible="Yes" fieldSourceType="DBColumn" dataType="Text" html="False" hrefType="Database" urlType="Relative" preserveParameters="GET" name="origin_file_name" fieldSource="order_no" hrefSource="file_name" PathID="t_bphtb_registration_listorigin_file_name">
					<Components/>
					<Events/>
					<LinkParameters/>
					<Attributes/>
					<Features/>
				</Link>
				<Link id="11" visible="Yes" fieldSourceType="CodeExpression" dataType="Text" html="True" hrefType="Page" urlType="Relative" preserveParameters="GET" name="DLink" hrefSource="t_bphtb_restitution_list.ccp" removeParameters="FLAG" PathID="t_bphtb_registration_listDLink" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="624" sourceType="DataField" format="yyyy-mm-dd" name="t_bphtb_registration_id" source="t_bphtb_registration_id"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
				<Label id="701" fieldSourceType="DBColumn" dataType="Text" html="False" name="t_bphtb_registration_id" PathID="t_bphtb_registration_listt_bphtb_registration_id" fieldSource="t_bphtb_registration_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Hidden id="704" fieldSourceType="DBColumn" dataType="Text" html="False" name="t_customer_order_id" fieldSource="t_customer_order_id" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="t_bphtb_registration_listt_customer_order_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Label id="705" fieldSourceType="DBColumn" dataType="Text" html="False" name="njop_pbb" fieldSource="njop_pbb" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="t_bphtb_registration_listnjop_pbb">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Button id="708" urlType="Relative" enableValidation="True" isDefault="False" name="Button1" PathID="t_bphtb_registration_listButton1">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
			</Components>
			<Events>
				<Event name="BeforeShowRow" type="Server">
					<Actions>
						<Action actionName="Set Row Style" actionCategory="General" id="10" styles="Row;AltRow" name="rowStyle" eventType="Server"/>
					</Actions>
				</Event>
				<Event name="BeforeSelect" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="129" eventType="Server"/>
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
				<SQLParameter id="698" parameterType="URL" variable="s_keyword" dataType="Text" parameterSource="s_keyword" designDefaultValue="a"/>
			</SQLParameters>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Grid>
		<Record id="3" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="None" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="t_cust_order_legal_docSearch" wizardCaption="Search P App Role " wizardOrientation="Vertical" wizardFormMethod="post" returnPage="t_bphtb_restitution_list.ccp" PathID="t_cust_order_legal_docSearch" pasteActions="pasteActions">
			<Components>
				<TextBox id="559" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="s_keyword" wizardCaption="Keyword" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" PathID="t_cust_order_legal_docSearchs_keyword">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Button id="4" urlType="Relative" enableValidation="True" isDefault="False" name="Button_DoSearch" operation="Search" wizardCaption="Search" PathID="t_cust_order_legal_docSearchButton_DoSearch">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Hidden id="677" fieldSourceType="DBColumn" dataType="Text" html="False" name="npwd" wizardCaption="Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="t_cust_order_legal_docSearchnpwd">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="706" fieldSourceType="DBColumn" dataType="Text" name="t_bphtb_registration_id" PathID="t_cust_order_legal_docSearcht_bphtb_registration_id" fieldSource="t_bphtb_registration_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="727" fieldSourceType="DBColumn" dataType="Text" name="t_bphtb_restitusi_id" PathID="t_cust_order_legal_docSearcht_bphtb_restitusi_id" fieldSource="t_bphtb_restitusi_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
			</Components>
			<Events>
				<Event name="BeforeShow" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="707"/>
					</Actions>
				</Event>
			</Events>
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
		<Grid id="709" secured="False" sourceType="SQL" returnValueType="Number" defaultPageSize="5" connection="ConnSIKP" name="t_bphtb_restitusi" pageSizeLimit="100" wizardCaption="List of P App Role " wizardGridType="Tabular" wizardAllowInsert="True" wizardAltRecord="True" wizardAltRecordType="Style" wizardRecordSeparator="False" wizardNoRecords="-" pasteAsReplace="pasteAsReplace" pasteActions="pasteActions" activeCollection="SQLParameters" parameterTypeListName="ParameterTypeList" dataSource="select t_bphtb_restitusi.*,t_product_order_control.doc_id from t_bphtb_restitusi 
left join t_product_order_control on t_product_order_control.doc_id = t_bphtb_restitusi.t_customer_order_id
where t_bphtb_registration_id = {t_bphtb_registration_id}">
			<Components>
				<Navigator id="710" size="10" type="Centered" pageSizes="1;5;10;25;50" name="Navigator" wizardPagingType="Custom" wizardFirst="True" wizardFirstText="First" wizardPrev="True" wizardPrevText="Prev" wizardNext="True" wizardNextText="Next" wizardLast="True" wizardLastText="Last" wizardImages="Images" wizardPageNumbers="Centered" wizardSize="10" wizardTotalPages="False" wizardHideDisabled="False" wizardOfText="of" wizardPageSize="False" wizardUsePageScroller="True">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Navigator>
				<Label id="711" fieldSourceType="DBColumn" dataType="Text" html="False" name="alasan" fieldSource="alasan" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="t_bphtb_restitusialasan">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="715" fieldSourceType="DBColumn" dataType="Text" html="False" name="restitusi_amt" PathID="t_bphtb_restitusirestitusi_amt" fieldSource="restitusi_amt">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Hidden id="716" fieldSourceType="DBColumn" dataType="Text" html="False" name="t_bphtb_registration_id" fieldSource="t_bphtb_registration_id" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="t_bphtb_restitusit_bphtb_registration_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="729" fieldSourceType="DBColumn" dataType="Text" name="t_bphtb_restitusi_id" PathID="t_bphtb_restitusit_bphtb_restitusi_id" fieldSource="t_bphtb_restitusi_id" visible="Yes" html="False" hrefType="Page" urlType="Relative" preserveParameters="GET">
<Components/>
					<Events/>
					<Attributes/>
					<Features/>
					<LinkParameters/>
</Hidden>
<Hidden id="730" fieldSourceType="DBColumn" dataType="Text" name="t_customer_order_id" PathID="t_bphtb_restitusit_customer_order_id" fieldSource="t_customer_order_id">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Hidden>
<Button id="731" urlType="Relative" enableValidation="True" isDefault="False" name="btn_edit" PathID="t_bphtb_restitusibtn_edit">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Button>
<Button id="732" urlType="Relative" enableValidation="True" isDefault="False" name="btn_submit" PathID="t_bphtb_restitusibtn_submit">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Button>
<Hidden id="733" fieldSourceType="DBColumn" dataType="Text" name="doc_id" PathID="t_bphtb_restitusidoc_id" fieldSource="doc_id">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Hidden>
<Label id="734" fieldSourceType="DBColumn" dataType="Text" html="False" name="submit_label" PathID="t_bphtb_restitusisubmit_label" defaultValue="SUBMITTED">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
</Components>
			<Events>
				<Event name="BeforeShowRow" type="Server">
					<Actions>
						<Action actionName="Set Row Style" actionCategory="General" id="719" styles="Row;AltRow" name="rowStyle" eventType="Server"/>
					</Actions>
				</Event>
				<Event name="BeforeSelect" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="720" eventType="Server"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
				<TableParameter id="721" conditionType="Parameter" useIsNull="False" field="legal_doc_desc" dataType="Text" searchConditionType="Contains" parameterType="URL" logicOperator="And" parameterSource="s_keyword"/>
				<TableParameter id="722" conditionType="Parameter" useIsNull="False" field="t_customer_order_id" dataType="Float" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="t_customer_order_id"/>
			</TableParameters>
			<JoinTables>
			</JoinTables>
			<JoinLinks/>
			<Fields>
				<Field id="723" fieldName="*"/>
			</Fields>
			<SPParameters/>
			<SQLParameters>
				<SQLParameter id="724" parameterType="URL" variable="t_bphtb_registration_id" dataType="Float" parameterSource="t_bphtb_registration_id" defaultValue="0"/>
			</SQLParameters>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Grid>
	</Components>
	<CodeFiles>
		<CodeFile id="Events" language="PHPTemplates" name="t_bphtb_restitution_list_events.php" forShow="False" comment="//" codePage="windows-1252"/>
		<CodeFile id="Code" language="PHPTemplates" name="t_bphtb_restitution_list.php" forShow="True" url="t_bphtb_restitution_list.php" comment="//" codePage="windows-1252"/>
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
				<Action actionName="Custom Code" actionCategory="General" id="703"/>
			</Actions>
		</Event>
	</Events>
</Page>
