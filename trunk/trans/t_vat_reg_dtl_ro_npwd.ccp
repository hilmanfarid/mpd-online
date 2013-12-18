<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\trans" secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="RWNet" wizardThemeVersion="3.0" needGeneration="0" pasteActions="pasteActions">
	<Components>
		<Grid id="2" secured="False" sourceType="Table" returnValueType="Number" defaultPageSize="5" connection="ConnSIKP" name="t_vat_reg_dtlGrid" pageSizeLimit="100" wizardCaption="List of P App Role " wizardGridType="Tabular" wizardAllowInsert="True" wizardAltRecord="True" wizardAltRecordType="Style" wizardRecordSeparator="False" wizardNoRecords="-" pasteAsReplace="pasteAsReplace" pasteActions="pasteActions" activeCollection="TableParameters" parameterTypeListName="ParameterTypeList" dataSource="v_license_letter">
			<Components>
				<Label id="15" fieldSourceType="DBColumn" dataType="Text" html="False" name="license_type_code" fieldSource="license_type_code" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="t_vat_reg_dtlGridlicense_type_code">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Navigator id="22" size="10" type="Centered" pageSizes="1;5;10;25;50" name="Navigator" wizardPagingType="Custom" wizardFirst="True" wizardFirstText="First" wizardPrev="True" wizardPrevText="Prev" wizardNext="True" wizardNextText="Next" wizardLast="True" wizardLastText="Last" wizardImages="Images" wizardPageNumbers="Centered" wizardSize="10" wizardTotalPages="False" wizardHideDisabled="False" wizardOfText="of" wizardPageSize="False" wizardUsePageScroller="True">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Navigator>
				<Hidden id="13" fieldSourceType="DBColumn" dataType="Float" html="False" name="t_license_letter_id" fieldSource="t_license_letter_id" wizardCaption="Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="t_vat_reg_dtlGridt_license_letter_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Label id="509" fieldSourceType="DBColumn" dataType="Text" html="False" name="license_no" fieldSource="license_no" wizardCaption="Valid From" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="t_vat_reg_dtlGridlicense_no">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="510" fieldSourceType="DBColumn" dataType="Text" html="False" name="valid_from" fieldSource="valid_from" wizardCaption="Valid From" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="t_vat_reg_dtlGridvalid_from">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="542" fieldSourceType="DBColumn" dataType="Text" html="False" name="valid_to" fieldSource="valid_to" wizardCaption="Valid From" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="t_vat_reg_dtlGridvalid_to">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Link id="52" visible="Dynamic" fieldSourceType="DBColumn" dataType="Text" html="True" hrefType="Page" urlType="Relative" preserveParameters="GET" name="DLink" PathID="t_vat_reg_dtlGridDLink" hrefSource="t_vat_reg_dtl_ro_npwd.ccp" wizardUseTemplateBlock="True" removeParameters="FLAG" fieldSource="t_license_letter_id">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="771" sourceType="DataField" name="t_license_letter_id" source="t_license_letter_id"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
				<Link id="54" visible="Dynamic" fieldSourceType="DBColumn" dataType="Text" html="True" hrefType="Page" urlType="Relative" preserveParameters="GET" name="ADLink" PathID="t_vat_reg_dtlGridADLink" hrefSource="t_vat_reg_dtl_ro_npwd.ccp" wizardUseTemplateBlock="True" removeParameters="FLAG" fieldSource="t_license_letter_id">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="772" sourceType="DataField" name="t_license_letter_id" source="t_license_letter_id"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
				<Label id="332" fieldSourceType="DBColumn" dataType="Text" html="False" name="description" fieldSource="description" wizardCaption="Valid From" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="t_vat_reg_dtlGriddescription">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Hidden id="781" fieldSourceType="DBColumn" dataType="Float" html="False" name="t_vat_registration_id" fieldSource="t_vat_registration_id" wizardCaption="Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="t_vat_reg_dtlGridt_vat_registration_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
			</Components>
			<Events>
				<Event name="BeforeShowRow" type="Server">
					<Actions>
						<Action actionName="Set Row Style" actionCategory="General" id="10" styles="Row;AltRow" name="rowStyle" eventType="Server"/>
						<Action actionName="Custom Code" actionCategory="General" id="763"/>
					</Actions>
				</Event>
				<Event name="BeforeSelect" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="129" eventType="Server"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
				<TableParameter id="786" conditionType="Parameter" useIsNull="False" field="t_vat_registration_id" dataType="Float" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="t_vat_registration_id"/>
			</TableParameters>
			<JoinTables>
				<JoinTable id="785" tableName="v_license_letter" posLeft="10" posTop="10" posWidth="154" posHeight="180"/>
			</JoinTables>
			<JoinLinks/>
			<Fields>
				<Field id="457" fieldName="*"/>
			</Fields>
			<SPParameters/>
			<SQLParameters>
			</SQLParameters>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Grid>
		<Record id="3" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="None" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="t_vat_reg_dtlSearch" wizardCaption="Search P App Role " wizardOrientation="Vertical" wizardFormMethod="post" returnPage="t_vat_reg_dtl_ro_npwd.ccp" PathID="t_vat_reg_dtlSearch" pasteActions="pasteActions">
			<Components>
				<Button id="4" urlType="Relative" enableValidation="True" isDefault="False" name="Button_DoSearch" operation="Search" wizardCaption="Search" PathID="t_vat_reg_dtlSearchButton_DoSearch">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<TextBox id="5" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="s_keyword" wizardCaption="Keyword" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" PathID="t_vat_reg_dtlSearchs_keyword">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Hidden id="782" fieldSourceType="DBColumn" dataType="Float" html="False" name="t_vat_registration_id" wizardCaption="Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="t_vat_reg_dtlSearcht_vat_registration_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="787" fieldSourceType="DBColumn" dataType="Text" html="False" name="rqst_type_code" wizardCaption="Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="t_vat_reg_dtlSearchrqst_type_code">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="883" fieldSourceType="DBColumn" dataType="Float" name="p_rqst_type_id" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_vat_reg_dtlSearchp_rqst_type_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="101" fieldSourceType="DBColumn" dataType="Float" name="t_customer_order_id" wizardCaption="P App User Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_reg_dtlSearcht_customer_order_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="936" fieldSourceType="DBColumn" dataType="Text" name="TAKEN_CTL" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_vat_reg_dtlSearchTAKEN_CTL">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="937" fieldSourceType="DBColumn" dataType="Text" name="IS_TAKEN" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_vat_reg_dtlSearchIS_TAKEN">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="938" fieldSourceType="DBColumn" dataType="Text" name="CURR_DOC_ID" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_vat_reg_dtlSearchCURR_DOC_ID">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="939" fieldSourceType="DBColumn" dataType="Text" name="CURR_DOC_TYPE_ID" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_vat_reg_dtlSearchCURR_DOC_TYPE_ID">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="940" fieldSourceType="DBColumn" dataType="Text" name="CURR_PROC_ID" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_vat_reg_dtlSearchCURR_PROC_ID">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="941" fieldSourceType="DBColumn" dataType="Text" name="CURR_CTL_ID" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_vat_reg_dtlSearchCURR_CTL_ID">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="942" fieldSourceType="DBColumn" dataType="Text" name="USER_ID_DOC" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_vat_reg_dtlSearchUSER_ID_DOC">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="943" fieldSourceType="DBColumn" dataType="Text" name="USER_ID_DONOR" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_vat_reg_dtlSearchUSER_ID_DONOR">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="944" fieldSourceType="DBColumn" dataType="Text" name="USER_ID_LOGIN" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_vat_reg_dtlSearchUSER_ID_LOGIN">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="945" fieldSourceType="DBColumn" dataType="Text" name="USER_ID_TAKEN" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_vat_reg_dtlSearchUSER_ID_TAKEN">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="887" fieldSourceType="DBColumn" dataType="Text" name="IS_CREATE_DOC" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_vat_reg_dtlSearchIS_CREATE_DOC">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="888" fieldSourceType="DBColumn" dataType="Text" name="IS_MANUAL" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_vat_reg_dtlSearchIS_MANUAL">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="889" fieldSourceType="DBColumn" dataType="Text" name="CURR_PROC_STATUS" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_vat_reg_dtlSearchCURR_PROC_STATUS">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="890" fieldSourceType="DBColumn" dataType="Text" name="CURR_DOC_STATUS" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_vat_reg_dtlSearchCURR_DOC_STATUS">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="891" fieldSourceType="DBColumn" dataType="Text" name="PREV_DOC_ID" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_vat_reg_dtlSearchPREV_DOC_ID">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="892" fieldSourceType="DBColumn" dataType="Text" name="PREV_DOC_TYPE_ID" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_vat_reg_dtlSearchPREV_DOC_TYPE_ID">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="893" fieldSourceType="DBColumn" dataType="Text" name="PREV_PROC_ID" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_vat_reg_dtlSearchPREV_PROC_ID">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="894" fieldSourceType="DBColumn" dataType="Text" name="PREV_CTL_ID" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_vat_reg_dtlSearchPREV_CTL_ID">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="946" fieldSourceType="DBColumn" dataType="Text" name="SLOT_1" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_vat_reg_dtlSearchSLOT_1">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="947" fieldSourceType="DBColumn" dataType="Text" name="SLOT_2" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_vat_reg_dtlSearchSLOT_2">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="948" fieldSourceType="DBColumn" dataType="Text" name="SLOT_3" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_vat_reg_dtlSearchSLOT_3">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="949" fieldSourceType="DBColumn" dataType="Text" name="SLOT_4" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_vat_reg_dtlSearchSLOT_4">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="950" fieldSourceType="DBColumn" dataType="Text" name="SLOT_5" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_vat_reg_dtlSearchSLOT_5">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="951" fieldSourceType="DBColumn" dataType="Text" name="MESSAGE" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_vat_reg_dtlSearchMESSAGE">
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
		<Grid id="688" secured="False" sourceType="Table" returnValueType="Number" defaultPageSize="5" connection="ConnSIKP" name="t_vat_reg_dtl_restaurantGrid" pageSizeLimit="100" wizardCaption="List of P App Role " wizardGridType="Tabular" wizardAllowInsert="True" wizardAltRecord="True" wizardAltRecordType="Style" wizardRecordSeparator="False" wizardNoRecords="-" pasteAsReplace="pasteAsReplace" pasteActions="pasteActions" activeCollection="TableParameters" parameterTypeListName="ParameterTypeList" dataSource="v_vat_reg_dtl_restaurant">
			<Components>
				<Label id="693" fieldSourceType="DBColumn" dataType="Text" html="False" name="service_type_desc" fieldSource="service_type_desc" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="t_vat_reg_dtl_restaurantGridservice_type_desc">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Navigator id="694" size="10" type="Centered" pageSizes="1;5;10;25;50" name="Navigator" wizardPagingType="Custom" wizardFirst="True" wizardFirstText="First" wizardPrev="True" wizardPrevText="Prev" wizardNext="True" wizardNextText="Next" wizardLast="True" wizardLastText="Last" wizardImages="Images" wizardPageNumbers="Centered" wizardSize="10" wizardTotalPages="False" wizardHideDisabled="False" wizardOfText="of" wizardPageSize="False" wizardUsePageScroller="True">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Navigator>
				<Hidden id="695" fieldSourceType="DBColumn" dataType="Float" html="False" name="t_vat_reg_dtl_restaurant_id" fieldSource="t_vat_reg_dtl_restaurant_id" wizardCaption="Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="t_vat_reg_dtl_restaurantGridt_vat_reg_dtl_restaurant_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Link id="755" visible="Dynamic" fieldSourceType="DBColumn" dataType="Text" html="True" hrefType="Page" urlType="Relative" preserveParameters="GET" name="DLink" PathID="t_vat_reg_dtl_restaurantGridDLink" hrefSource="t_vat_reg_dtl_ro_npwd.ccp" wizardUseTemplateBlock="True" removeParameters="FLAG" fieldSource="t_vat_reg_dtl_restaurant_id">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="812" sourceType="DataField" name="t_vat_reg_dtl_restaurant_id" source="t_vat_reg_dtl_restaurant_id"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
				<Link id="757" visible="Dynamic" fieldSourceType="DBColumn" dataType="Text" html="True" hrefType="Page" urlType="Relative" preserveParameters="GET" name="ADLink" PathID="t_vat_reg_dtl_restaurantGridADLink" hrefSource="t_vat_reg_dtl_ro_npwd.ccp" wizardUseTemplateBlock="True" removeParameters="FLAG" fieldSource="t_vat_reg_dtl_restaurant_id">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="813" sourceType="DataField" name="t_vat_reg_dtl_restaurant_id" source="t_vat_reg_dtl_restaurant_id"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
				<Label id="775" fieldSourceType="DBColumn" dataType="Text" html="False" name="seat_qty" fieldSource="seat_qty" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="t_vat_reg_dtl_restaurantGridseat_qty">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="776" fieldSourceType="DBColumn" dataType="Text" html="False" name="table_qty" fieldSource="table_qty" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="t_vat_reg_dtl_restaurantGridtable_qty">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="777" fieldSourceType="DBColumn" dataType="Text" html="False" name="max_service_qty" fieldSource="max_service_qty" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="t_vat_reg_dtl_restaurantGridmax_service_qty">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="778" fieldSourceType="DBColumn" dataType="Float" html="False" name="avg_subscription" fieldSource="avg_subscription" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="t_vat_reg_dtl_restaurantGridavg_subscription" format="0">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Hidden id="780" fieldSourceType="DBColumn" dataType="Float" html="False" name="t_vat_registration_id" fieldSource="t_vat_registration_id" wizardCaption="Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="t_vat_reg_dtl_restaurantGridt_vat_registration_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
			</Components>
			<Events>
				<Event name="BeforeShowRow" type="Server">
					<Actions>
						<Action actionName="Set Row Style" actionCategory="General" id="701" styles="Row;AltRow" name="rowStyle" eventType="Server"/>
						<Action actionName="Custom Code" actionCategory="General" id="764" eventType="Server"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
				<TableParameter id="811" conditionType="Parameter" useIsNull="False" field="t_vat_registration_id" dataType="Float" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="t_vat_registration_id"/>
			</TableParameters>
			<JoinTables>
				<JoinTable id="810" tableName="v_vat_reg_dtl_restaurant" posLeft="10" posTop="10" posWidth="160" posHeight="180"/>
			</JoinTables>
			<JoinLinks/>
			<Fields>
			</Fields>
			<SPParameters/>
			<SQLParameters>
			</SQLParameters>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Grid>
		<Grid id="790" secured="False" sourceType="Table" returnValueType="Number" defaultPageSize="5" connection="ConnSIKP" name="t_vat_reg_dtl_hotelGrid1" pageSizeLimit="100" wizardCaption="List of P App Role " wizardGridType="Tabular" wizardAllowInsert="True" wizardAltRecord="True" wizardAltRecordType="Style" wizardRecordSeparator="False" wizardNoRecords="-" pasteAsReplace="pasteAsReplace" pasteActions="pasteActions" activeCollection="TableParameters" parameterTypeListName="ParameterTypeList" dataSource="v_vat_reg_dtl_hotel">
			<Components>
				<Navigator id="792" size="10" type="Centered" pageSizes="1;5;10;25;50" name="Navigator" wizardPagingType="Custom" wizardFirst="True" wizardFirstText="First" wizardPrev="True" wizardPrevText="Prev" wizardNext="True" wizardNextText="Next" wizardLast="True" wizardLastText="Last" wizardImages="Images" wizardPageNumbers="Centered" wizardSize="10" wizardTotalPages="False" wizardHideDisabled="False" wizardOfText="of" wizardPageSize="False" wizardUsePageScroller="True">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Navigator>
				<Link id="794" visible="Dynamic" fieldSourceType="DBColumn" dataType="Text" html="True" hrefType="Page" urlType="Relative" preserveParameters="GET" name="DLink" PathID="t_vat_reg_dtl_hotelGrid1DLink" hrefSource="t_vat_reg_dtl_ro_npwd.ccp" wizardUseTemplateBlock="True" removeParameters="FLAG" fieldSource="t_vat_reg_dtl_hotel_id">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="795" sourceType="DataField" name="t_vat_reg_dtl_hotel_id" source="t_vat_reg_dtl_hotel_id"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
				<Link id="796" visible="Dynamic" fieldSourceType="DBColumn" dataType="Text" html="True" hrefType="Page" urlType="Relative" preserveParameters="GET" name="ADLink" PathID="t_vat_reg_dtl_hotelGrid1ADLink" hrefSource="t_vat_reg_dtl_ro_npwd.ccp" wizardUseTemplateBlock="True" removeParameters="FLAG" fieldSource="t_vat_reg_dtl_hotel_id">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="797" sourceType="DataField" name="t_vat_reg_dtl_hotel_id" source="t_vat_reg_dtl_hotel_id"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
				<Label id="798" fieldSourceType="DBColumn" dataType="Text" html="False" name="room_type_code" fieldSource="room_type_code" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="t_vat_reg_dtl_hotelGrid1room_type_code">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="799" fieldSourceType="DBColumn" dataType="Float" html="False" name="room_qty" fieldSource="room_qty" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="t_vat_reg_dtl_hotelGrid1room_qty">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Hidden id="803" fieldSourceType="DBColumn" dataType="Float" html="False" name="t_vat_registration_id" fieldSource="t_vat_registration_id" wizardCaption="Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="t_vat_reg_dtl_hotelGrid1t_vat_registration_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Label id="802" fieldSourceType="DBColumn" dataType="Float" html="False" name="service_qty" fieldSource="service_qty" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="t_vat_reg_dtl_hotelGrid1service_qty">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="801" fieldSourceType="DBColumn" dataType="Float" html="False" name="service_charge_wd" fieldSource="service_charge_wd" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="t_vat_reg_dtl_hotelGrid1service_charge_wd" format="0">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="914" fieldSourceType="DBColumn" dataType="Float" html="False" name="service_charge_we" fieldSource="service_charge_we" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="t_vat_reg_dtl_hotelGrid1service_charge_we" format="0">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Hidden id="793" fieldSourceType="DBColumn" dataType="Float" html="False" name="t_vat_reg_dtl_hotel_id" fieldSource="t_vat_reg_dtl_hotel_id" wizardCaption="Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="t_vat_reg_dtl_hotelGrid1t_vat_reg_dtl_hotel_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
			</Components>
			<Events>
				<Event name="BeforeShowRow" type="Server">
					<Actions>
						<Action actionName="Set Row Style" actionCategory="General" id="806" styles="Row;AltRow" name="rowStyle" eventType="Server"/>
						<Action actionName="Custom Code" actionCategory="General" id="807" eventType="Server"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
				<TableParameter id="808" conditionType="Parameter" useIsNull="False" field="t_vat_registration_id" dataType="Float" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="t_vat_registration_id"/>
			</TableParameters>
			<JoinTables>
				<JoinTable id="809" tableName="v_vat_reg_dtl_hotel" posLeft="10" posTop="10" posWidth="160" posHeight="180"/>
			</JoinTables>
			<JoinLinks/>
			<Fields>
			</Fields>
			<SPParameters/>
			<SQLParameters>
			</SQLParameters>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Grid>
		<Grid id="814" secured="False" sourceType="Table" returnValueType="Number" defaultPageSize="5" connection="ConnSIKP" name="v_vat_reg_dtl_entertaintmentGrid" pageSizeLimit="100" wizardCaption="List of P App Role " wizardGridType="Tabular" wizardAllowInsert="True" wizardAltRecord="True" wizardAltRecordType="Style" wizardRecordSeparator="False" wizardNoRecords="-" pasteAsReplace="pasteAsReplace" pasteActions="pasteActions" activeCollection="TableParameters" parameterTypeListName="ParameterTypeList" dataSource="v_vat_reg_dtl_entertaintment">
			<Components>
				<Label id="815" fieldSourceType="DBColumn" dataType="Text" html="False" name="entertainment_desc" fieldSource="entertainment_desc" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="v_vat_reg_dtl_entertaintmentGridentertainment_desc">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Navigator id="816" size="10" type="Centered" pageSizes="1;5;10;25;50" name="Navigator" wizardPagingType="Custom" wizardFirst="True" wizardFirstText="First" wizardPrev="True" wizardPrevText="Prev" wizardNext="True" wizardNextText="Next" wizardLast="True" wizardLastText="Last" wizardImages="Images" wizardPageNumbers="Centered" wizardSize="10" wizardTotalPages="False" wizardHideDisabled="False" wizardOfText="of" wizardPageSize="False" wizardUsePageScroller="True">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Navigator>
				<Hidden id="817" fieldSourceType="DBColumn" dataType="Float" html="False" name="t_vat_reg_dtl_entertaintment_id" fieldSource="t_vat_reg_dtl_entertaintment_id" wizardCaption="Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="v_vat_reg_dtl_entertaintmentGridt_vat_reg_dtl_entertaintment_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Link id="818" visible="Dynamic" fieldSourceType="DBColumn" dataType="Text" html="True" hrefType="Page" urlType="Relative" preserveParameters="GET" name="DLink" PathID="v_vat_reg_dtl_entertaintmentGridDLink" hrefSource="t_vat_reg_dtl_ro_npwd.ccp" wizardUseTemplateBlock="True" removeParameters="FLAG" fieldSource="t_vat_reg_dtl_entertaintment_id">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="834" sourceType="DataField" name="t_vat_reg_dtl_entertaintment_id" source="t_vat_reg_dtl_entertaintment_id"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
				<Link id="820" visible="Dynamic" fieldSourceType="DBColumn" dataType="Text" html="True" hrefType="Page" urlType="Relative" preserveParameters="GET" name="ADLink" PathID="v_vat_reg_dtl_entertaintmentGridADLink" hrefSource="t_vat_reg_dtl_ro_npwd.ccp" wizardUseTemplateBlock="True" removeParameters="FLAG" fieldSource="t_vat_reg_dtl_entertaintment_id">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="835" sourceType="DataField" name="t_vat_reg_dtl_entertaintment_id" source="t_vat_reg_dtl_entertaintment_id"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
				<Label id="822" fieldSourceType="DBColumn" dataType="Float" html="False" name="service_charge_wd" fieldSource="service_charge_wd" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="v_vat_reg_dtl_entertaintmentGridservice_charge_wd" format="0">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="824" fieldSourceType="DBColumn" dataType="Text" html="False" name="clerk_qty" fieldSource="clerk_qty" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="v_vat_reg_dtl_entertaintmentGridclerk_qty">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="825" fieldSourceType="DBColumn" dataType="Text" html="False" name="booking_hour" fieldSource="booking_hour" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="v_vat_reg_dtl_entertaintmentGridbooking_hour">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="826" fieldSourceType="DBColumn" dataType="Text" html="False" name="f_and_b" fieldSource="f_and_b" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="v_vat_reg_dtl_entertaintmentGridf_and_b">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Hidden id="827" fieldSourceType="DBColumn" dataType="Float" html="False" name="t_vat_registration_id" fieldSource="t_vat_registration_id" wizardCaption="Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="v_vat_reg_dtl_entertaintmentGridt_vat_registration_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Label id="836" fieldSourceType="DBColumn" dataType="Text" html="False" name="seat_qty" fieldSource="seat_qty" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="v_vat_reg_dtl_entertaintmentGridseat_qty">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="837" fieldSourceType="DBColumn" dataType="Text" html="False" name="portion_person" fieldSource="portion_person" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="v_vat_reg_dtl_entertaintmentGridportion_person">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="823" fieldSourceType="DBColumn" dataType="Text" html="False" name="room_qty" fieldSource="room_qty" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="v_vat_reg_dtl_entertaintmentGridroom_qty">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="935" fieldSourceType="DBColumn" dataType="Float" html="False" name="service_charge_we" fieldSource="service_charge_we" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="v_vat_reg_dtl_entertaintmentGridservice_charge_we" format="0">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
			</Components>
			<Events>
				<Event name="BeforeShowRow" type="Server">
					<Actions>
						<Action actionName="Set Row Style" actionCategory="General" id="830" styles="Row;AltRow" name="rowStyle" eventType="Server"/>
						<Action actionName="Custom Code" actionCategory="General" id="831" eventType="Server"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
				<TableParameter id="833" conditionType="Parameter" useIsNull="False" field="t_vat_registration_id" dataType="Float" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="t_vat_registration_id"/>
			</TableParameters>
			<JoinTables>
				<JoinTable id="832" tableName="v_vat_reg_dtl_entertaintment" posLeft="10" posTop="10" posWidth="160" posHeight="180"/>
			</JoinTables>
			<JoinLinks/>
			<Fields>
			</Fields>
			<SPParameters/>
			<SQLParameters>
			</SQLParameters>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Grid>
		<Grid id="838" secured="False" sourceType="Table" returnValueType="Number" defaultPageSize="5" connection="ConnSIKP" name="t_vat_reg_dtl_parkingGrid" pageSizeLimit="100" wizardCaption="List of P App Role " wizardGridType="Tabular" wizardAllowInsert="True" wizardAltRecord="True" wizardAltRecordType="Style" wizardRecordSeparator="False" wizardNoRecords="-" pasteAsReplace="pasteAsReplace" pasteActions="pasteActions" activeCollection="TableParameters" parameterTypeListName="ParameterTypeList" dataSource="v_vat_reg_dtl_parking">
			<Components>
				<Label id="839" fieldSourceType="DBColumn" dataType="Text" html="False" name="classification_desc" fieldSource="classification_desc" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="t_vat_reg_dtl_parkingGridclassification_desc">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Navigator id="840" size="10" type="Centered" pageSizes="1;5;10;25;50" name="Navigator" wizardPagingType="Custom" wizardFirst="True" wizardFirstText="First" wizardPrev="True" wizardPrevText="Prev" wizardNext="True" wizardNextText="Next" wizardLast="True" wizardLastText="Last" wizardImages="Images" wizardPageNumbers="Centered" wizardSize="10" wizardTotalPages="False" wizardHideDisabled="False" wizardOfText="of" wizardPageSize="False" wizardUsePageScroller="True">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Navigator>
				<Hidden id="841" fieldSourceType="DBColumn" dataType="Float" html="False" name="t_vat_reg_dtl_parking_id" fieldSource="t_vat_reg_dtl_parking_id" wizardCaption="Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="t_vat_reg_dtl_parkingGridt_vat_reg_dtl_parking_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Link id="842" visible="Dynamic" fieldSourceType="DBColumn" dataType="Text" html="True" hrefType="Page" urlType="Relative" preserveParameters="GET" name="DLink" PathID="t_vat_reg_dtl_parkingGridDLink" hrefSource="t_vat_reg_dtl_ro_npwd.ccp" wizardUseTemplateBlock="True" removeParameters="FLAG" fieldSource="t_vat_reg_dtl_parking_id">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="860" sourceType="DataField" name="t_vat_reg_dtl_parking_id" source="t_vat_reg_dtl_parking_id"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
				<Link id="844" visible="Dynamic" fieldSourceType="DBColumn" dataType="Text" html="True" hrefType="Page" urlType="Relative" preserveParameters="GET" name="ADLink" PathID="t_vat_reg_dtl_parkingGridADLink" hrefSource="t_vat_reg_dtl_ro_npwd.ccp" wizardUseTemplateBlock="True" removeParameters="FLAG" fieldSource="t_vat_reg_dtl_entertaintment_id">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="861" sourceType="DataField" name="t_vat_reg_dtl_parking_id" source="t_vat_reg_dtl_parking_id"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
				<Label id="846" fieldSourceType="DBColumn" dataType="Float" html="False" name="parking_size" fieldSource="parking_size" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="t_vat_reg_dtl_parkingGridparking_size" format="0">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="847" fieldSourceType="DBColumn" dataType="Text" html="False" name="max_load_qty" fieldSource="max_load_qty" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="t_vat_reg_dtl_parkingGridmax_load_qty">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Hidden id="851" fieldSourceType="DBColumn" dataType="Float" html="False" name="t_vat_registration_id" fieldSource="t_vat_registration_id" wizardCaption="Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="t_vat_reg_dtl_parkingGridt_vat_registration_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Label id="895" fieldSourceType="DBColumn" dataType="Text" html="False" name="avg_subscription_qty" fieldSource="avg_subscription_qty" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="t_vat_reg_dtl_parkingGridavg_subscription_qty">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
			</Components>
			<Events>
				<Event name="BeforeShowRow" type="Server">
					<Actions>
						<Action actionName="Set Row Style" actionCategory="General" id="856" styles="Row;AltRow" name="rowStyle" eventType="Server"/>
						<Action actionName="Custom Code" actionCategory="General" id="857" eventType="Server"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
				<TableParameter id="859" conditionType="Parameter" useIsNull="False" field="t_vat_registration_id" dataType="Float" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="t_vat_registration_id"/>
			</TableParameters>
			<JoinTables>
				<JoinTable id="858" tableName="v_vat_reg_dtl_parking" posLeft="10" posTop="10" posWidth="160" posHeight="180"/>
			</JoinTables>
			<JoinLinks/>
			<Fields>
			</Fields>
			<SPParameters/>
			<SQLParameters>
			</SQLParameters>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Grid>
		<Grid id="862" secured="False" sourceType="Table" returnValueType="Number" defaultPageSize="5" connection="ConnSIKP" name="t_vat_reg_dtl_ppjGrid" pageSizeLimit="100" wizardCaption="List of P App Role " wizardGridType="Tabular" wizardAllowInsert="True" wizardAltRecord="True" wizardAltRecordType="Style" wizardRecordSeparator="False" wizardNoRecords="-" pasteAsReplace="pasteAsReplace" pasteActions="pasteActions" activeCollection="TableParameters" parameterTypeListName="ParameterTypeList" dataSource="v_vat_reg_dtl_ppj">
			<Components>
				<Label id="863" fieldSourceType="DBColumn" dataType="Text" html="False" name="pwr_classification_desc" fieldSource="pwr_classification_desc" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="t_vat_reg_dtl_ppjGridpwr_classification_desc">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Navigator id="864" size="10" type="Centered" pageSizes="1;5;10;25;50" name="Navigator" wizardPagingType="Custom" wizardFirst="True" wizardFirstText="First" wizardPrev="True" wizardPrevText="Prev" wizardNext="True" wizardNextText="Next" wizardLast="True" wizardLastText="Last" wizardImages="Images" wizardPageNumbers="Centered" wizardSize="10" wizardTotalPages="False" wizardHideDisabled="False" wizardOfText="of" wizardPageSize="False" wizardUsePageScroller="True">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Navigator>
				<Hidden id="865" fieldSourceType="DBColumn" dataType="Float" html="False" name="t_vat_reg_dtl_ppj_id" fieldSource="t_vat_reg_dtl_ppj_id" wizardCaption="Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="t_vat_reg_dtl_ppjGridt_vat_reg_dtl_ppj_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Link id="866" visible="Dynamic" fieldSourceType="DBColumn" dataType="Text" html="True" hrefType="Page" urlType="Relative" preserveParameters="GET" name="DLink" PathID="t_vat_reg_dtl_ppjGridDLink" hrefSource="t_vat_reg_dtl_ro_npwd.ccp" wizardUseTemplateBlock="True" removeParameters="FLAG" fieldSource="t_vat_reg_dtl_ppj_id">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="879" sourceType="DataField" name="t_vat_reg_dtl_ppj_id" source="t_vat_reg_dtl_ppj_id"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
				<Link id="868" visible="Dynamic" fieldSourceType="DBColumn" dataType="Text" html="True" hrefType="Page" urlType="Relative" preserveParameters="GET" name="ADLink" PathID="t_vat_reg_dtl_ppjGridADLink" hrefSource="t_vat_reg_dtl_ro_npwd.ccp" wizardUseTemplateBlock="True" removeParameters="FLAG" fieldSource="t_vat_reg_dtl_ppj_id">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="880" sourceType="DataField" name="t_vat_reg_dtl_ppj_id" source="t_vat_reg_dtl_ppj_id"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
				<Label id="870" fieldSourceType="DBColumn" dataType="Float" html="False" name="power_capacity" fieldSource="power_capacity" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="t_vat_reg_dtl_ppjGridpower_capacity" format="0">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="871" fieldSourceType="DBColumn" dataType="Text" html="False" name="service_charge" fieldSource="service_charge" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="t_vat_reg_dtl_ppjGridservice_charge">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Hidden id="872" fieldSourceType="DBColumn" dataType="Float" html="False" name="t_vat_registration_id" fieldSource="t_vat_registration_id" wizardCaption="Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="t_vat_reg_dtl_ppjGridt_vat_registration_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Label id="881" fieldSourceType="DBColumn" dataType="Text" html="False" name="power_factor" fieldSource="power_factor" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="t_vat_reg_dtl_ppjGridpower_factor">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="882" fieldSourceType="DBColumn" dataType="Text" html="False" name="description" fieldSource="description" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="t_vat_reg_dtl_ppjGriddescription">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
			</Components>
			<Events>
				<Event name="BeforeShowRow" type="Server">
					<Actions>
						<Action actionName="Set Row Style" actionCategory="General" id="875" styles="Row;AltRow" name="rowStyle" eventType="Server"/>
						<Action actionName="Custom Code" actionCategory="General" id="876" eventType="Server"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
				<TableParameter id="878" conditionType="Parameter" useIsNull="False" field="t_vat_registration_id" dataType="Float" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="t_vat_registration_id"/>
			</TableParameters>
			<JoinTables>
				<JoinTable id="877" tableName="v_vat_reg_dtl_ppj" posLeft="10" posTop="10" posWidth="160" posHeight="180"/>
			</JoinTables>
			<JoinLinks/>
			<Fields>
			</Fields>
			<SPParameters/>
			<SQLParameters>
			</SQLParameters>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Grid>
		<Grid id="896" secured="False" sourceType="Table" returnValueType="Number" defaultPageSize="5" connection="ConnSIKP" name="t_vat_reg_dtl_ppj_nplGrid" pageSizeLimit="100" wizardCaption="List of P App Role " wizardGridType="Tabular" wizardAllowInsert="True" wizardAltRecord="True" wizardAltRecordType="Style" wizardRecordSeparator="False" wizardNoRecords="-" pasteAsReplace="pasteAsReplace" pasteActions="pasteActions" activeCollection="TableParameters" parameterTypeListName="ParameterTypeList" dataSource="v_vat_reg_dtl_ppj_non_pln">
			<Components>
				<Label id="897" fieldSourceType="DBColumn" dataType="Text" html="False" name="owner_qty" fieldSource="owner_qty" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="t_vat_reg_dtl_ppj_nplGridowner_qty">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Navigator id="898" size="10" type="Centered" pageSizes="1;5;10;25;50" name="Navigator" wizardPagingType="Custom" wizardFirst="True" wizardFirstText="First" wizardPrev="True" wizardPrevText="Prev" wizardNext="True" wizardNextText="Next" wizardLast="True" wizardLastText="Last" wizardImages="Images" wizardPageNumbers="Centered" wizardSize="10" wizardTotalPages="False" wizardHideDisabled="False" wizardOfText="of" wizardPageSize="False" wizardUsePageScroller="True">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Navigator>
				<Hidden id="899" fieldSourceType="DBColumn" dataType="Float" html="False" name="t_vat_reg_dtl_ppj_npl_id" fieldSource="t_vat_reg_dtl_ppj_npl_id" wizardCaption="Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="t_vat_reg_dtl_ppj_nplGridt_vat_reg_dtl_ppj_npl_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Link id="900" visible="Dynamic" fieldSourceType="DBColumn" dataType="Text" html="True" hrefType="Page" urlType="Relative" preserveParameters="GET" name="DLink" PathID="t_vat_reg_dtl_ppj_nplGridDLink" hrefSource="t_vat_reg_dtl_ro_npwd.ccp" wizardUseTemplateBlock="True" removeParameters="FLAG" fieldSource="t_vat_reg_dtl_ppj_npl_id">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="901" sourceType="DataField" name="t_vat_reg_dtl_ppj_npl_id" source="t_vat_reg_dtl_ppj_npl_id"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
				<Link id="902" visible="Dynamic" fieldSourceType="DBColumn" dataType="Text" html="True" hrefType="Page" urlType="Relative" preserveParameters="GET" name="ADLink" PathID="t_vat_reg_dtl_ppj_nplGridADLink" hrefSource="t_vat_reg_dtl_ro_npwd.ccp" wizardUseTemplateBlock="True" removeParameters="FLAG" fieldSource="t_vat_reg_dtl_ppj_id">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="903" sourceType="DataField" name="t_vat_reg_dtl_ppj_npl_id" source="t_vat_reg_dtl_ppj_npl_id"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
				<Label id="904" fieldSourceType="DBColumn" dataType="Float" html="False" name="power_capacity" fieldSource="power_capacity" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="t_vat_reg_dtl_ppj_nplGridpower_capacity" format="0">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Hidden id="905" fieldSourceType="DBColumn" dataType="Float" html="False" name="t_vat_registration_id" fieldSource="t_vat_registration_id" wizardCaption="Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="t_vat_reg_dtl_ppj_nplGridt_vat_registration_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Label id="907" fieldSourceType="DBColumn" dataType="Text" html="False" name="description" fieldSource="description" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="t_vat_reg_dtl_ppj_nplGriddescription">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
			</Components>
			<Events>
				<Event name="BeforeShowRow" type="Server">
					<Actions>
						<Action actionName="Set Row Style" actionCategory="General" id="910" styles="Row;AltRow" name="rowStyle" eventType="Server"/>
						<Action actionName="Custom Code" actionCategory="General" id="911" eventType="Server"/>

					</Actions>
				</Event>
			</Events>
			<TableParameters>
				<TableParameter id="912" conditionType="Parameter" useIsNull="False" field="t_vat_registration_id" dataType="Float" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="t_vat_registration_id"/>
			</TableParameters>
			<JoinTables>
				<JoinTable id="913" tableName="v_vat_reg_dtl_ppj_non_pln" posLeft="10" posTop="10" posWidth="160" posHeight="180"/>
			</JoinTables>
			<JoinLinks/>
			<Fields>
			</Fields>
			<SPParameters/>
			<SQLParameters>
			</SQLParameters>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Grid>
		<Grid id="915" secured="False" sourceType="Table" returnValueType="Number" defaultPageSize="5" connection="ConnSIKP" name="t_vat_reg_dtl_hotel_srvcGrid" pageSizeLimit="100" wizardCaption="List of P App Role " wizardGridType="Tabular" wizardAllowInsert="True" wizardAltRecord="True" wizardAltRecordType="Style" wizardRecordSeparator="False" wizardNoRecords="-" pasteAsReplace="pasteAsReplace" pasteActions="pasteActions" activeCollection="TableParameters" parameterTypeListName="ParameterTypeList" dataSource="t_vat_reg_dtl_hotel_srvc">
			<Components>
				<Label id="916" fieldSourceType="DBColumn" dataType="Text" html="False" name="services" fieldSource="services" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="t_vat_reg_dtl_hotel_srvcGridservices">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Navigator id="917" size="10" type="Centered" pageSizes="1;5;10;25;50" name="Navigator" wizardPagingType="Custom" wizardFirst="True" wizardFirstText="First" wizardPrev="True" wizardPrevText="Prev" wizardNext="True" wizardNextText="Next" wizardLast="True" wizardLastText="Last" wizardImages="Images" wizardPageNumbers="Centered" wizardSize="10" wizardTotalPages="False" wizardHideDisabled="False" wizardOfText="of" wizardPageSize="False" wizardUsePageScroller="True">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Navigator>
				<Hidden id="918" fieldSourceType="DBColumn" dataType="Float" html="False" name="t_vat_reg_dtl_hotel_srvc_id" fieldSource="t_vat_reg_dtl_hotel_srvc_id" wizardCaption="Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="t_vat_reg_dtl_hotel_srvcGridt_vat_reg_dtl_hotel_srvc_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Link id="919" visible="Dynamic" fieldSourceType="DBColumn" dataType="Text" html="True" hrefType="Page" urlType="Relative" preserveParameters="GET" name="DLink" PathID="t_vat_reg_dtl_hotel_srvcGridDLink" hrefSource="t_vat_reg_dtl_ro_npwd.ccp" wizardUseTemplateBlock="True" removeParameters="FLAG" fieldSource="t_vat_reg_dtl_hotel_srvc_id">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="933" sourceType="DataField" name="t_vat_reg_dtl_hotel_srvc_id" source="t_vat_reg_dtl_hotel_srvc_id"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
				<Link id="921" visible="Dynamic" fieldSourceType="DBColumn" dataType="Text" html="True" hrefType="Page" urlType="Relative" preserveParameters="GET" name="ADLink" PathID="t_vat_reg_dtl_hotel_srvcGridADLink" hrefSource="t_vat_reg_dtl_ro_npwd.ccp" wizardUseTemplateBlock="True" removeParameters="FLAG" fieldSource="t_vat_reg_dtl_hotel_srvc_id">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="934" sourceType="DataField" name="t_vat_reg_dtl_hotel_srvc_id" source="t_vat_reg_dtl_hotel_srvc_id"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
				<Label id="926" fieldSourceType="DBColumn" dataType="Text" html="False" name="description" fieldSource="description" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="t_vat_reg_dtl_hotel_srvcGriddescription">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Hidden id="924" fieldSourceType="DBColumn" dataType="Float" html="False" name="t_vat_registration_id" fieldSource="t_vat_registration_id" wizardCaption="Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="t_vat_reg_dtl_hotel_srvcGridt_vat_registration_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
			</Components>
			<Events>
				<Event name="BeforeShowRow" type="Server">
					<Actions>
						<Action actionName="Set Row Style" actionCategory="General" id="929" styles="Row;AltRow" name="rowStyle" eventType="Server"/>
						<Action actionName="Custom Code" actionCategory="General" id="930"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
				<TableParameter id="932" conditionType="Parameter" useIsNull="False" field="t_vat_registration_id" dataType="Float" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="t_vat_registration_id"/>
			</TableParameters>
			<JoinTables>
				<JoinTable id="931" tableName="t_vat_reg_dtl_hotel_srvc" posLeft="10" posTop="10" posWidth="160" posHeight="180"/>
			</JoinTables>
			<JoinLinks/>
			<Fields>
			</Fields>
			<SPParameters/>
			<SQLParameters>
			</SQLParameters>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Grid>
		<Grid id="952" secured="False" sourceType="Table" returnValueType="Number" defaultPageSize="5" connection="ConnSIKP" name="t_vat_reg_employeeGrid" pageSizeLimit="100" wizardCaption="List of P App Role " wizardGridType="Tabular" wizardAllowInsert="True" wizardAltRecord="True" wizardAltRecordType="Style" wizardRecordSeparator="False" wizardNoRecords="-" pasteAsReplace="pasteAsReplace" pasteActions="pasteActions" activeCollection="TableParameters" parameterTypeListName="ParameterTypeList" dataSource="v_vat_reg_employee">
			<Components>
				<Label id="953" fieldSourceType="DBColumn" dataType="Text" html="False" name="jabatan" fieldSource="jabatan" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="t_vat_reg_employeeGridjabatan">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Navigator id="954" size="10" type="Centered" pageSizes="1;5;10;25;50" name="Navigator" wizardPagingType="Custom" wizardFirst="True" wizardFirstText="First" wizardPrev="True" wizardPrevText="Prev" wizardNext="True" wizardNextText="Next" wizardLast="True" wizardLastText="Last" wizardImages="Images" wizardPageNumbers="Centered" wizardSize="10" wizardTotalPages="False" wizardHideDisabled="False" wizardOfText="of" wizardPageSize="False" wizardUsePageScroller="True">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Navigator>
				<Hidden id="955" fieldSourceType="DBColumn" dataType="Float" html="False" name="t_vat_reg_employee_id" fieldSource="t_vat_reg_employee_id" wizardCaption="Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="t_vat_reg_employeeGridt_vat_reg_employee_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Label id="956" fieldSourceType="DBColumn" dataType="Float" html="False" name="employee_qty" fieldSource="employee_qty" wizardCaption="Valid From" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="t_vat_reg_employeeGridemployee_qty">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="957" fieldSourceType="DBColumn" dataType="Float" html="False" name="employee_salery" fieldSource="employee_salery" wizardCaption="Valid From" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="t_vat_reg_employeeGridemployee_salery" format="0">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Link id="958" visible="Dynamic" fieldSourceType="DBColumn" dataType="Text" html="True" hrefType="Page" urlType="Relative" preserveParameters="GET" name="DLink" PathID="t_vat_reg_employeeGridDLink" hrefSource="t_vat_reg_dtl_ro_npwd.ccp" wizardUseTemplateBlock="True" removeParameters="FLAG" fieldSource="t_vat_reg_employee_id">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="959" sourceType="DataField" name="t_vat_reg_employee_id" source="t_vat_reg_employee_id"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
				<Link id="960" visible="Dynamic" fieldSourceType="DBColumn" dataType="Text" html="True" hrefType="Page" urlType="Relative" preserveParameters="GET" name="ADLink" PathID="t_vat_reg_employeeGridADLink" hrefSource="t_vat_reg_dtl_ro_npwd.ccp" wizardUseTemplateBlock="True" removeParameters="FLAG" fieldSource="t_vat_reg_employee_id">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="961" sourceType="DataField" name="t_vat_reg_employee_id" source="t_vat_reg_employee_id"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
				<Label id="962" fieldSourceType="DBColumn" dataType="Text" html="False" name="description" fieldSource="description" wizardCaption="Valid From" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="t_vat_reg_employeeGriddescription">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Hidden id="963" fieldSourceType="DBColumn" dataType="Float" html="False" name="t_vat_registration_id" fieldSource="t_vat_registration_id" wizardCaption="Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="t_vat_reg_employeeGridt_vat_registration_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
			</Components>
			<Events>
				<Event name="BeforeShowRow" type="Server">
					<Actions>
						<Action actionName="Set Row Style" actionCategory="General" id="964" styles="Row;AltRow" name="rowStyle" eventType="Server"/>
						<Action actionName="Custom Code" actionCategory="General" id="965"/>
					</Actions>
				</Event>
				<Event name="BeforeSelect" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="966"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
				<TableParameter id="967" conditionType="Parameter" useIsNull="False" field="t_vat_registration_id" dataType="Float" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="t_vat_registration_id"/>
			</TableParameters>
			<JoinTables>
				<JoinTable id="968" tableName="v_vat_reg_employee" posLeft="10" posTop="10" posWidth="160" posHeight="180"/>
			</JoinTables>
			<JoinLinks/>
			<Fields>
				<Field id="969" fieldName="*"/>
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
		<CodeFile id="Events" language="PHPTemplates" name="t_vat_reg_dtl_ro_npwd_events.php" forShow="False" comment="//" codePage="windows-1252"/>
		<CodeFile id="Code" language="PHPTemplates" name="t_vat_reg_dtl_ro_npwd.php" forShow="True" url="t_vat_reg_dtl_ro_npwd.php" comment="//" codePage="windows-1252"/>
	</CodeFiles>
	<SecurityGroups/>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events>
		<Event name="BeforeShow" type="Server">
			<Actions>
				<Action actionName="Custom Code" actionCategory="General" id="884"/>
			</Actions>
		</Event>
	</Events>
</Page>
