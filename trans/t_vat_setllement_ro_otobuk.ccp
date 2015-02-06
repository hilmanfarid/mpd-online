<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\trans" secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="CoffeeBreak" wizardThemeVersion="3.0" needGeneration="0" pasteActions="pasteActions">
	<Components>
		<Grid id="2" secured="False" sourceType="SQL" returnValueType="Number" defaultPageSize="5" connection="ConnSIKP" name="t_vat_setllementGrid" pageSizeLimit="100" wizardCaption="List of P App Role " wizardGridType="Tabular" wizardAllowInsert="True" wizardAltRecord="True" wizardAltRecordType="Style" wizardRecordSeparator="False" wizardNoRecords="-" pasteAsReplace="pasteAsReplace" pasteActions="pasteActions" activeCollection="SQLParameters" dataSource="SELECT a.t_vat_setllement_id, a.t_customer_order_id, 
a.settlement_date, a.p_finance_period_id, 
a.t_cust_account_id, a.npwd, a.total_trans_amount,
a.total_vat_amount, b.code as finance_period_code, c.order_no, c.p_rqst_type_id, e.code as rqst_type_code
FROM t_vat_setllement a, p_finance_period b, t_customer_order c, t_cust_account d, p_rqst_type e
WHERE a.p_finance_period_id = b.p_finance_period_id AND
a.t_customer_order_id = c.t_customer_order_id AND
a.t_cust_account_id = d.t_cust_account_id AND
c.p_rqst_type_id = e.p_rqst_type_id AND
a.t_customer_order_id = {CURR_DOC_ID}" parameterTypeListName="ParameterTypeList">
			<Components>
				<Link id="11" visible="Yes" fieldSourceType="CodeExpression" html="True" hrefType="Page" urlType="Relative" preserveParameters="GET" name="DLink" wizardCaption="Detail" wizardSize="50" wizardMaxLength="60" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" dataType="Text" wizardDefaultValue="DLink" hrefSource="t_vat_setllement_ro_otobuk.ccp" wizardThemeItem="GridA" PathID="t_vat_setllementGridDLink" removeParameters="FLAG">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="194" sourceType="DataField" name="t_vat_setllement_id" source="t_vat_setllement_id"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
				<Label id="15" fieldSourceType="DBColumn" dataType="Text" html="False" name="npwd" fieldSource="npwd" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="t_vat_setllementGridnpwd">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="17" fieldSourceType="DBColumn" dataType="Text" html="False" name="finance_period_code" fieldSource="finance_period_code" wizardCaption="Description" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="t_vat_setllementGridfinance_period_code">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="19" fieldSourceType="DBColumn" dataType="Text" html="False" name="order_no" fieldSource="order_no" wizardCaption="Valid From" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="t_vat_setllementGridorder_no">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Hidden id="13" fieldSourceType="DBColumn" dataType="Float" html="False" name="t_vat_setllement_id" fieldSource="t_vat_setllement_id" wizardCaption="Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="t_vat_setllementGridt_vat_setllement_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Label id="175" fieldSourceType="DBColumn" dataType="Float" html="False" name="total_trans_amount" fieldSource="total_trans_amount" wizardCaption="Valid To" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="t_vat_setllementGridtotal_trans_amount">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<ImageLink id="195" visible="Yes" fieldSourceType="DBColumn" dataType="Text" hrefType="Page" urlType="Relative" preserveParameters="GET" name="ImageLink1" PathID="t_vat_setllementGridImageLink1" hrefSource="t_vat_setllement_dtl_ro_otobuk.ccp">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="196" sourceType="DataField" name="t_vat_setllement_id" source="t_vat_setllement_id"/>
						<LinkParameter id="197" sourceType="DataField" name="npwd" source="npwd"/>
						<LinkParameter id="198" sourceType="DataField" name="t_cust_account_id" source="t_cust_account_id"/>
						<LinkParameter id="199" sourceType="DataField" name="finance_period_code" source="finance_period_code"/>
						<LinkParameter id="200" sourceType="DataField" name="p_finance_period_id" source="p_finance_period_id"/>
						<LinkParameter id="202" sourceType="DataField" name="t_customer_order_id" source="t_customer_order_id"/>
						<LinkParameter id="219" sourceType="DataField" name="order_no" source="order_no"/>
						<LinkParameter id="220" sourceType="DataField" name="p_rqst_type_id" source="p_rqst_type_id"/>
						<LinkParameter id="221" sourceType="DataField" name="rqst_type_code" source="rqst_type_code"/>
						<LinkParameter id="250" sourceType="URL" name="TAKEN_CTL" source="TAKEN_CTL"/>
						<LinkParameter id="251" sourceType="URL" name="IS_TAKEN" source="IS_TAKEN"/>
						<LinkParameter id="252" sourceType="URL" name="CURR_DOC_ID" source="CURR_DOC_ID"/>
						<LinkParameter id="253" sourceType="URL" name="CURR_DOC_TYPE_ID" source="CURR_DOC_TYPE_ID"/>
						<LinkParameter id="254" sourceType="URL" name="CURR_PROC_ID" source="CURR_PROC_ID"/>
						<LinkParameter id="255" sourceType="URL" name="CURR_CTL_ID" source="CURR_CTL_ID"/>
						<LinkParameter id="256" sourceType="URL" name="USER_ID_DOC" source="USER_ID_DOC"/>
						<LinkParameter id="257" sourceType="URL" name="USER_ID_DONOR" source="USER_ID_DONOR"/>
						<LinkParameter id="258" sourceType="URL" name="USER_ID_LOGIN" source="USER_ID_LOGIN"/>
						<LinkParameter id="259" sourceType="URL" name="USER_ID_TAKEN" source="USER_ID_TAKEN"/>
						<LinkParameter id="260" sourceType="URL" name="IS_CREATE_DOC" source="IS_CREATE_DOC"/>
						<LinkParameter id="261" sourceType="URL" name="IS_MANUAL" source="IS_MANUAL"/>
						<LinkParameter id="262" sourceType="URL" name="CURR_PROC_STATUS" source="CURR_PROC_STATUS"/>
						<LinkParameter id="263" sourceType="URL" name="CURR_DOC_STATUS" source="CURR_DOC_STATUS"/>
						<LinkParameter id="264" sourceType="URL" name="PREV_DOC_ID" source="PREV_DOC_ID"/>
						<LinkParameter id="265" sourceType="URL" name="PREV_DOC_TYPE_ID" source="PREV_DOC_TYPE_ID"/>
						<LinkParameter id="266" sourceType="URL" name="PREV_PROC_ID" source="PREV_PROC_ID"/>
						<LinkParameter id="267" sourceType="URL" name="PREV_CTL_ID" source="PREV_CTL_ID"/>
						<LinkParameter id="268" sourceType="URL" name="SLOT_1" source="SLOT_1"/>
						<LinkParameter id="269" sourceType="URL" name="SLOT_2" source="SLOT_2"/>
						<LinkParameter id="270" sourceType="URL" name="SLOT_3" source="SLOT_3"/>
						<LinkParameter id="271" sourceType="URL" name="SLOT_4" source="SLOT_4"/>
						<LinkParameter id="272" sourceType="URL" name="SLOT_5" source="SLOT_5"/>
						<LinkParameter id="273" sourceType="URL" name="MESSAGE" source="MESSAGE"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</ImageLink>
				<Label id="21" fieldSourceType="DBColumn" dataType="Float" html="False" name="total_vat_amount" fieldSource="total_vat_amount" wizardCaption="Valid To" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="t_vat_setllementGridtotal_vat_amount">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<ImageLink id="207" visible="Yes" fieldSourceType="DBColumn" dataType="Text" hrefType="Page" urlType="Relative" preserveParameters="GET" name="ImageLink2" PathID="t_vat_setllementGridImageLink2" hrefSource="t_sptpd_legal_doc_ro_otobuk.ccp">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="208" sourceType="DataField" name="t_vat_setllement_id" source="t_vat_setllement_id"/>
						<LinkParameter id="209" sourceType="DataField" name="npwd" source="npwd"/>
						<LinkParameter id="210" sourceType="DataField" name="t_cust_account_id" source="t_cust_account_id"/>
						<LinkParameter id="211" sourceType="DataField" name="finance_period_code" source="finance_period_code"/>
						<LinkParameter id="212" sourceType="DataField" name="p_finance_period_id" source="p_finance_period_id"/>
						<LinkParameter id="214" sourceType="DataField" name="t_customer_order_id" source="t_customer_order_id"/>
						<LinkParameter id="216" sourceType="DataField" name="p_rqst_type_id" source="p_rqst_type_id"/>
						<LinkParameter id="218" sourceType="DataField" name="order_no" source="order_no"/>
						<LinkParameter id="222" sourceType="DataField" name="rqst_type_code" source="rqst_type_code"/>
						<LinkParameter id="274" sourceType="URL" name="TAKEN_CTL" source="TAKEN_CTL"/>
						<LinkParameter id="275" sourceType="URL" name="IS_TAKEN" source="IS_TAKEN"/>
						<LinkParameter id="276" sourceType="URL" name="CURR_DOC_ID" source="CURR_DOC_ID"/>
						<LinkParameter id="277" sourceType="URL" name="CURR_DOC_TYPE_ID" source="CURR_DOC_TYPE_ID"/>
						<LinkParameter id="278" sourceType="URL" name="CURR_PROC_ID" source="CURR_PROC_ID"/>
						<LinkParameter id="279" sourceType="URL" name="CURR_CTL_ID" source="CURR_CTL_ID"/>
						<LinkParameter id="280" sourceType="URL" name="USER_ID_DOC" source="USER_ID_DOC"/>
						<LinkParameter id="281" sourceType="URL" name="USER_ID_DONOR" source="USER_ID_DONOR"/>
						<LinkParameter id="282" sourceType="URL" name="USER_ID_LOGIN" source="USER_ID_LOGIN"/>
						<LinkParameter id="283" sourceType="URL" name="USER_ID_TAKEN" source="USER_ID_TAKEN"/>
						<LinkParameter id="284" sourceType="URL" name="IS_CREATE_DOC" source="IS_CREATE_DOC"/>
						<LinkParameter id="285" sourceType="URL" name="IS_MANUAL" source="IS_MANUAL"/>
						<LinkParameter id="286" sourceType="URL" name="CURR_PROC_STATUS" source="CURR_PROC_STATUS"/>
						<LinkParameter id="287" sourceType="URL" name="CURR_DOC_STATUS" source="CURR_DOC_STATUS"/>
						<LinkParameter id="288" sourceType="URL" name="PREV_DOC_ID" source="PREV_DOC_ID"/>
						<LinkParameter id="289" sourceType="URL" name="PREV_DOC_TYPE_ID" source="PREV_DOC_TYPE_ID"/>
						<LinkParameter id="290" sourceType="URL" name="PREV_PROC_ID" source="PREV_PROC_ID"/>
						<LinkParameter id="291" sourceType="URL" name="PREV_CTL_ID" source="PREV_CTL_ID"/>
						<LinkParameter id="292" sourceType="URL" name="SLOT_1" source="SLOT_1"/>
						<LinkParameter id="293" sourceType="URL" name="SLOT_2" source="SLOT_2"/>
						<LinkParameter id="294" sourceType="URL" name="SLOT_3" source="SLOT_3"/>
						<LinkParameter id="295" sourceType="URL" name="SLOT_4" source="SLOT_4"/>
						<LinkParameter id="296" sourceType="URL" name="SLOT_5" source="SLOT_5"/>
						<LinkParameter id="297" sourceType="URL" name="MESSAGE" source="MESSAGE"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</ImageLink>
				<Hidden id="223" fieldSourceType="DBColumn" dataType="Float" html="False" name="p_rqst_type_id" fieldSource="p_rqst_type_id" wizardCaption="Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="t_vat_setllementGridp_rqst_type_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Button id="299" urlType="Relative" enableValidation="True" isDefault="False" name="Button1" PathID="t_vat_setllementGridButton1">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Hidden id="332" fieldSourceType="DBColumn" dataType="Float" name="t_cust_account_id" PathID="t_vat_setllementGridt_cust_account_id" fieldSource="t_cust_account_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Label id="339" fieldSourceType="DBColumn" dataType="Text" html="True" name="cetak1" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_vat_setllementGridcetak1">
					<Components/>
					<Events>
						<Event name="BeforeShow" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="340" eventType="Server"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="341" fieldSourceType="DBColumn" dataType="Text" html="True" name="cetak_stpd" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_vat_setllementGridcetak_stpd">
					<Components/>
					<Events>
						<Event name="BeforeShow" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="342"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Label>
			</Components>
			<Events>
				<Event name="BeforeShowRow" type="Server">
					<Actions>
						<Action actionName="Set Row Style" actionCategory="General" id="10" styles="Row;AltRow" name="rowStyle" eventType="Server"/>
					</Actions>
				</Event>
				<Event name="BeforeSelect" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="124" eventType="Server"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
			</TableParameters>
			<JoinTables>
			</JoinTables>
			<JoinLinks/>
			<Fields>
			</Fields>
			<SPParameters/>
			<SQLParameters>
				<SQLParameter id="298" variable="CURR_DOC_ID" parameterType="URL" defaultValue="0" dataType="Float" parameterSource="CURR_DOC_ID"/>
			</SQLParameters>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Grid>
		<Record id="3" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="None" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="t_vat_setllementSearch" wizardCaption="Search P App Role " wizardOrientation="Vertical" wizardFormMethod="post" returnPage="t_vat_setllement_ro_otobuk.ccp" PathID="t_vat_setllementSearch" pasteActions="pasteActions">
			<Components>
				<Hidden id="226" fieldSourceType="DBColumn" dataType="Text" name="TAKEN_CTL" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_vat_setllementSearchTAKEN_CTL">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="227" fieldSourceType="DBColumn" dataType="Text" name="IS_TAKEN" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_vat_setllementSearchIS_TAKEN">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="228" fieldSourceType="DBColumn" dataType="Text" name="CURR_DOC_ID" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_vat_setllementSearchCURR_DOC_ID">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="229" fieldSourceType="DBColumn" dataType="Text" name="CURR_DOC_TYPE_ID" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_vat_setllementSearchCURR_DOC_TYPE_ID">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="230" fieldSourceType="DBColumn" dataType="Text" name="CURR_PROC_ID" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_vat_setllementSearchCURR_PROC_ID">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="231" fieldSourceType="DBColumn" dataType="Text" name="CURR_CTL_ID" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_vat_setllementSearchCURR_CTL_ID">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="232" fieldSourceType="DBColumn" dataType="Text" name="USER_ID_DOC" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_vat_setllementSearchUSER_ID_DOC">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="233" fieldSourceType="DBColumn" dataType="Text" name="USER_ID_DONOR" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_vat_setllementSearchUSER_ID_DONOR">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="234" fieldSourceType="DBColumn" dataType="Text" name="USER_ID_LOGIN" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_vat_setllementSearchUSER_ID_LOGIN">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="235" fieldSourceType="DBColumn" dataType="Text" name="USER_ID_TAKEN" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_vat_setllementSearchUSER_ID_TAKEN">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="236" fieldSourceType="DBColumn" dataType="Text" name="IS_CREATE_DOC" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_vat_setllementSearchIS_CREATE_DOC">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="237" fieldSourceType="DBColumn" dataType="Text" name="IS_MANUAL" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_vat_setllementSearchIS_MANUAL">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="238" fieldSourceType="DBColumn" dataType="Text" name="CURR_PROC_STATUS" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_vat_setllementSearchCURR_PROC_STATUS">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="239" fieldSourceType="DBColumn" dataType="Text" name="CURR_DOC_STATUS" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_vat_setllementSearchCURR_DOC_STATUS">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="240" fieldSourceType="DBColumn" dataType="Text" name="PREV_DOC_ID" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_vat_setllementSearchPREV_DOC_ID">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="241" fieldSourceType="DBColumn" dataType="Text" name="PREV_DOC_TYPE_ID" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_vat_setllementSearchPREV_DOC_TYPE_ID">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="242" fieldSourceType="DBColumn" dataType="Text" name="PREV_PROC_ID" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_vat_setllementSearchPREV_PROC_ID">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="243" fieldSourceType="DBColumn" dataType="Text" name="PREV_CTL_ID" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_vat_setllementSearchPREV_CTL_ID">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="244" fieldSourceType="DBColumn" dataType="Text" name="SLOT_1" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_vat_setllementSearchSLOT_1">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="245" fieldSourceType="DBColumn" dataType="Text" name="SLOT_2" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_vat_setllementSearchSLOT_2">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="246" fieldSourceType="DBColumn" dataType="Text" name="SLOT_3" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_vat_setllementSearchSLOT_3">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="247" fieldSourceType="DBColumn" dataType="Text" name="SLOT_4" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_vat_setllementSearchSLOT_4">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="248" fieldSourceType="DBColumn" dataType="Text" name="SLOT_5" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_vat_setllementSearchSLOT_5">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="249" fieldSourceType="DBColumn" dataType="Text" name="MESSAGE" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_vat_setllementSearchMESSAGE">
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
		<Record id="23" sourceType="SQL" urlType="Relative" secured="False" allowInsert="False" allowUpdate="True" allowDelete="False" validateData="True" preserveParameters="GET" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" connection="ConnSIKP" name="t_vat_setllementForm" errorSummator="Error" wizardCaption="Add/Edit P App Role " wizardFormMethod="post" PathID="t_vat_setllementForm" activeCollection="USQLParameters" parameterTypeListName="ParameterTypeList" pasteAsReplace="pasteAsReplace" pasteActions="pasteActions" customUpdateType="SQL" dataSource="SELECT *
FROM v_vat_setllement
WHERE t_vat_setllement_id = {t_vat_setllement_id} " customUpdate="UPDATE t_vat_setllement SET
is_anomali = '{is_anomali}',
no_kohir='{no_kohir}' 
WHERE t_vat_setllement_id = {t_vat_setllement_id} ">
			<Components>
				<Button id="24" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Update" operation="Update" wizardCaption="Add" PathID="t_vat_setllementFormButton_Update" removeParameters="FLAG">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Hidden id="30" fieldSourceType="DBColumn" dataType="Float" name="t_vat_setllement_id" fieldSource="t_vat_setllement_id" required="False" caption="Id" wizardCaption="Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_setllementFormt_vat_setllement_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<ListBox id="43" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="is_anomali" fieldSource="is_anomali" wizardCaption="Updated By" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_setllementFormis_anomali" format="0" sourceType="ListOfValues" connection="ConnSIKP" _valueOfList="N" _nameOfList="TIDAK" dataSource="N;TIDAK;Y;YA" caption="Anomali ?">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
					<TableParameters/>
					<SPParameters/>
					<SQLParameters/>
					<JoinTables/>
					<JoinLinks/>
					<Fields/>
				</ListBox>
				<Hidden id="333" fieldSourceType="DBColumn" dataType="Float" name="t_cust_account_id" PathID="t_vat_setllementFormt_cust_account_id" fieldSource="t_cust_account_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<TextBox id="334" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="no_kohir" PathID="t_vat_setllementFormno_kohir" fieldSource="no_kohir" caption="Nomor Kohir">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Button id="336" urlType="Relative" enableValidation="True" isDefault="False" name="Button1" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_vat_setllementFormButton1">
					<Components/>
					<Events>
						<Event name="OnClick" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="337" eventType="Server"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Button>
				<Hidden id="338" fieldSourceType="DBColumn" dataType="Float" name="t_customer_order_id" PathID="t_vat_setllementFormt_customer_order_id" fieldSource="t_customer_order_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<TextBox id="5" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="npwd" wizardCaption="Keyword" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" PathID="t_vat_setllementFormnpwd" caption="NPWD" fieldSource="npwd">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="343" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="order_no" fieldSource="order_no" caption="Nomor Order" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_setllementFormorder_no">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="159" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="finance_period_code" wizardCaption="Keyword" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" PathID="t_vat_setllementFormfinance_period_code" caption="Periode" fieldSource="finance_period_code">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="33" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="start_period" caption="Masa Pajak" wizardCaption="Valid From" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_setllementFormstart_period" format="dd-mmm-yyyy" fieldSource="start_period">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="35" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="end_period" wizardCaption="Valid To" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_setllementFormend_period" format="dd-mmm-yyyy" fieldSource="end_period">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="163" visible="Yes" fieldSourceType="DBColumn" dataType="Float" name="total_trans_amount" caption="Total Transaksi" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_setllementFormtotal_trans_amount" format="#,##0.00" fieldSource="total_trans_amount">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="344" visible="Yes" fieldSourceType="DBColumn" dataType="Float" name="total_vat_amount" caption="Total Pajak" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_setllementFormtotal_vat_amount" format="#,##0.00" fieldSource="total_vat_amount">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="345" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="jenis_pajak" fieldSource="jenis_pajak" caption="Jenis Pajak" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_setllementFormjenis_pajak">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="346" visible="Yes" fieldSourceType="DBColumn" dataType="Float" name="debt_vat_amt" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_setllementFormdebt_vat_amt" format="#,##0.00" fieldSource="debt_vat_amt">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="347" visible="Yes" fieldSourceType="DBColumn" dataType="Float" name="terutang" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_setllementFormterutang" format="#,##0.00" fieldSource="terutang">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="348" visible="Yes" fieldSourceType="DBColumn" dataType="Float" name="cr_adjustment" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_setllementFormcr_adjustment" format="#,##0.00" fieldSource="cr_adjustment">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="349" visible="Yes" fieldSourceType="DBColumn" dataType="Float" name="cr_payment" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_setllementFormcr_payment" format="#,##0.00" fieldSource="cr_payment">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="350" visible="Yes" fieldSourceType="DBColumn" dataType="Float" name="cr_others" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_setllementFormcr_others" format="#,##0.00" fieldSource="cr_others">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="351" visible="Yes" fieldSourceType="DBColumn" dataType="Float" name="db_interest_charge" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_setllementFormdb_interest_charge" format="#,##0.00" fieldSource="db_interest_charge">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="352" visible="Yes" fieldSourceType="DBColumn" dataType="Float" name="db_increasing_charge" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_setllementFormdb_increasing_charge" format="#,##0.00" fieldSource="db_increasing_charge">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="353" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="due_date" fieldSource="due_date" required="True" wizardCaption="Valid From" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_setllementFormdue_date" defaultValue="date(&quot;d-M-Y h:i:s&quot;)" format="dd-mmm-yyyy H:nn:ss">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="354" visible="Yes" fieldSourceType="DBColumn" dataType="Float" name="cr_stp" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_setllementFormcr_stp" format="#,##0.00" fieldSource="cr_stp">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="355" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="wp_name" fieldSource="wp_name" caption="Nama Wajib Pajak" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_setllementFormwp_name">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextArea id="356" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="wp_address_name" fieldSource="wp_address_name" caption="Alamat Wajib Pajak" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_setllementFormwp_address_name">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextArea>
				<Button id="358" urlType="Relative" enableValidation="True" isDefault="False" name="Button2" PathID="t_vat_setllementFormButton2">
<Components/>
<Events>
<Event name="OnClick" type="Client">
<Actions>
<Action actionName="Custom Code" actionCategory="General" id="360"/>
</Actions>
</Event>
</Events>
<Attributes/>
<Features/>
</Button>
<Hidden id="359" fieldSourceType="DBColumn" dataType="Text" name="payment_key" PathID="t_vat_setllementFormpayment_key" fieldSource="payment_key">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Hidden>
</Components>
			<Events>
				<Event name="BeforeShow" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="357"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
				<TableParameter id="327" conditionType="Parameter" useIsNull="False" field="t_vat_setllement_id" dataType="Float" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="t_vat_setllement_id"/>
			</TableParameters>
			<SPParameters/>
			<SQLParameters>
				<SQLParameter id="329" parameterType="URL" variable="t_vat_setllement_id" dataType="Float" parameterSource="t_vat_setllement_id" defaultValue="0"/>
			</SQLParameters>
			<JoinTables>
			</JoinTables>
			<JoinLinks/>
			<Fields>
			</Fields>
			<ISPParameters/>
			<ISQLParameters>
			</ISQLParameters>
			<IFormElements>
				<CustomParameter id="307" field="p_vat_type_id" dataType="Float" parameterType="Control" parameterSource="p_vat_type_id"/>
				<CustomParameter id="308" field="vat_code" dataType="Text" parameterType="Control" parameterSource="code"/>
				<CustomParameter id="309" field="description" dataType="Text" parameterType="Control" parameterSource="description"/>
				<CustomParameter id="310" field="creation_date" dataType="Text" parameterType="Control" parameterSource="creation_date" format="dd-mmm-yyyy"/>
				<CustomParameter id="311" field="created_by" dataType="Text" parameterType="Control" parameterSource="created_by"/>
				<CustomParameter id="312" field="updated_date" dataType="Text" parameterType="Control" parameterSource="updated_date" format="dd-mmm-yyyy"/>
				<CustomParameter id="313" field="updated_by" dataType="Text" parameterType="Control" parameterSource="updated_by"/>
			</IFormElements>
			<USPParameters/>
			<USQLParameters>
				<SQLParameter id="330" variable="is_anomali" parameterType="Control" dataType="Text" parameterSource="is_anomali"/>
				<SQLParameter id="331" variable="t_vat_setllement_id" parameterType="Control" defaultValue="0" dataType="Float" parameterSource="t_vat_setllement_id"/>
				<SQLParameter id="335" variable="no_kohir" parameterType="Control" dataType="Text" parameterSource="no_kohir"/>
			</USQLParameters>
			<UConditions>
			</UConditions>
			<UFormElements>
				<CustomParameter id="316" field="t_vat_setllement_id" dataType="Float" parameterType="Control" parameterSource="t_vat_setllement_id"/>
				<CustomParameter id="317" field="finance_period_code" dataType="Text" parameterType="Control" parameterSource="finance_period_code"/>
				<CustomParameter id="318" field="order_no" dataType="Text" parameterType="Control" parameterSource="order_no"/>
				<CustomParameter id="319" field="total_trans_amount" dataType="Float" parameterType="Control" parameterSource="total_trans_amount" format="0"/>
				<CustomParameter id="320" field="total_vat_amount" dataType="Float" parameterType="Control" parameterSource="total_vat_amount" format="0"/>
				<CustomParameter id="321" field="npwd" dataType="Text" parameterType="Control" parameterSource="npwd"/>
				<CustomParameter id="322" field="p_rqst_type_id" dataType="Float" parameterType="Control" parameterSource="p_rqst_type_id"/>
				<CustomParameter id="323" field="t_customer_order_id" dataType="Float" parameterType="Control" parameterSource="t_customer_order_id"/>
				<CustomParameter id="324" field="p_vat_type_id" dataType="Text" parameterType="Control" parameterSource="p_vat_type_id"/>
			</UFormElements>
			<DSPParameters/>
			<DSQLParameters>
			</DSQLParameters>
			<DConditions>
			</DConditions>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Record>
	</Components>
	<CodeFiles>
		<CodeFile id="Events" language="PHPTemplates" name="t_vat_setllement_ro_otobuk_events.php" forShow="False" comment="//" codePage="windows-1252"/>
		<CodeFile id="Code" language="PHPTemplates" name="t_vat_setllement_ro_otobuk.php" forShow="True" url="t_vat_setllement_ro_otobuk.php" comment="//" codePage="windows-1252"/>
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
				<Action actionName="Custom Code" actionCategory="General" id="193"/>
			</Actions>
		</Event>
	</Events>
</Page>
