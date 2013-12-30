<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\trans" secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="CoffeeBreak" wizardThemeVersion="3.0" needGeneration="0" pasteActions="pasteActions">
	<Components>
		<Grid id="2" secured="False" sourceType="SQL" returnValueType="Number" defaultPageSize="5" connection="ConnSIKP" name="t_vat_setllementGrid" pageSizeLimit="100" wizardCaption="List of P App Role " wizardGridType="Tabular" wizardAllowInsert="True" wizardAltRecord="True" wizardAltRecordType="Style" wizardRecordSeparator="False" wizardNoRecords="-" pasteAsReplace="pasteAsReplace" pasteActions="pasteActions" activeCollection="SQLParameters" dataSource="SELECT f.nomor_ayat, a.no_kohir,d.wp_name, a.t_vat_setllement_id, a.t_customer_order_id, 
a.settlement_date, a.p_finance_period_id, 
a.t_cust_account_id, a.npwd, a.total_trans_amount, a.total_penalty_amount,
a.total_vat_amount, b.code as finance_period_code, c.order_no, c.p_rqst_type_id, e.code as rqst_type_code, d.p_vat_type_id
FROM t_vat_setllement a, p_finance_period b, t_customer_order c, t_cust_account d, p_rqst_type e, v_p_vat_type_dtl_rep f
WHERE a.p_finance_period_id = b.p_finance_period_id AND
a.t_customer_order_id = c.t_customer_order_id AND
a.t_cust_account_id = d.t_cust_account_id AND
c.p_rqst_type_id = e.p_rqst_type_id AND
a.p_vat_type_dtl_id = f.p_vat_type_dtl_id AND
a.t_customer_order_id = {CURR_DOC_ID}" parameterTypeListName="ParameterTypeList">
			<Components>
				<Link id="11" visible="Yes" fieldSourceType="CodeExpression" html="True" hrefType="Page" urlType="Relative" preserveParameters="GET" name="DLink" wizardCaption="Detail" wizardSize="50" wizardMaxLength="60" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" dataType="Text" wizardDefaultValue="DLink" hrefSource="t_vat_setllement_ro_2.ccp" wizardThemeItem="GridA" PathID="t_vat_setllementGridDLink" removeParameters="FLAG">
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
				<Label id="175" fieldSourceType="DBColumn" dataType="Float" html="False" name="total_trans_amount" fieldSource="total_trans_amount" wizardCaption="Valid To" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="t_vat_setllementGridtotal_trans_amount" format="#,##">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<ImageLink id="195" visible="Yes" fieldSourceType="DBColumn" dataType="Text" hrefType="Page" urlType="Relative" preserveParameters="GET" name="ImageLink1" PathID="t_vat_setllementGridImageLink1" hrefSource="t_vat_setllement_dtl_ro.ccp">
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
				<ImageLink id="207" visible="Yes" fieldSourceType="DBColumn" dataType="Text" hrefType="Page" urlType="Relative" preserveParameters="GET" name="ImageLink2" PathID="t_vat_setllementGridImageLink2" hrefSource="t_sptpd_legal_doc_ro.ccp">
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
				<Label id="21" fieldSourceType="DBColumn" dataType="Float" html="False" name="total_vat_amount" fieldSource="total_vat_amount" wizardCaption="Valid To" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="t_vat_setllementGridtotal_vat_amount" format="#,##">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="300" fieldSourceType="DBColumn" dataType="Text" html="True" name="cetak_sptpd" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_vat_setllementGridcetak_sptpd">
					<Components/>
					<Events>
						<Event name="BeforeShow" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="301" eventType="Server"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Label>
				<Hidden id="304" fieldSourceType="DBColumn" dataType="Float" name="p_vat_type_id" PathID="t_vat_setllementGridp_vat_type_id" fieldSource="p_vat_type_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Label id="224" fieldSourceType="DBColumn" dataType="Text" html="True" name="cetak" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_vat_setllementGridcetak">
					<Components/>
					<Events>
						<Event name="BeforeShow" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="225" eventType="Server"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="305" fieldSourceType="DBColumn" dataType="Text" html="False" name="no_kohir" fieldSource="no_kohir" wizardCaption="Valid To" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="t_vat_setllementGridno_kohir" format="#,##">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="306" fieldSourceType="DBColumn" dataType="Text" html="False" name="wp_name" PathID="t_vat_setllementGridwp_name" fieldSource="wp_name">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Hidden id="309" fieldSourceType="DBColumn" dataType="Integer" name="t_customer_order_id" PathID="t_vat_setllementGridt_customer_order_id" fieldSource="t_customer_order_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Label id="310" fieldSourceType="DBColumn" dataType="Float" html="False" name="total_penalty_amount" fieldSource="total_penalty_amount" wizardCaption="Valid To" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="t_vat_setllementGridtotal_penalty_amount" format="#,##">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Button id="307" urlType="Relative" enableValidation="True" isDefault="False" name="cetak_payment" PathID="t_vat_setllementGridcetak_payment">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Hidden id="312" fieldSourceType="CodeExpression" dataType="Text" name="user" PathID="t_vat_setllementGriduser" fieldSource="CCGetUserLogin()">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Button id="311" urlType="Relative" enableValidation="True" isDefault="False" name="cetak_register1" PathID="t_vat_setllementGridcetak_register1">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="308" urlType="Relative" enableValidation="True" isDefault="False" name="cetak_register" PathID="t_vat_setllementGridcetak_register">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Label id="313" fieldSourceType="DBColumn" dataType="Text" html="False" name="nomor_ayat" PathID="t_vat_setllementGridnomor_ayat" fieldSource="nomor_ayat">
					<Components/>
					<Events/>
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
				<SQLParameter id="298" variable="CURR_DOC_ID" parameterType="URL" defaultValue="0" dataType="Float" parameterSource="CURR_DOC_ID" designDefaultValue="504"/>
			</SQLParameters>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Grid>
		<Record id="3" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="None" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="t_vat_setllementSearch" wizardCaption="Search P App Role " wizardOrientation="Vertical" wizardFormMethod="post" returnPage="t_vat_setllement_ro_2.ccp" PathID="t_vat_setllementSearch" pasteActions="pasteActions">
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
	</Components>
	<CodeFiles>
		<CodeFile id="Events" language="PHPTemplates" name="t_vat_setllement_ro_2_events.php" forShow="False" comment="//" codePage="windows-1252"/>
		<CodeFile id="Code" language="PHPTemplates" name="t_vat_setllement_ro_2.php" forShow="True" url="t_vat_setllement_ro_2.php" comment="//" codePage="windows-1252"/>
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
