<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\trans" secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="RWNet" wizardThemeVersion="3.0" needGeneration="0" pasteActions="pasteActions">
	<Components>
		<Grid id="2" secured="False" sourceType="Table" returnValueType="Number" defaultPageSize="5" connection="ConnSIKP" name="t_cust_order_legal_docGrid" pageSizeLimit="100" wizardCaption="List of P App Role " wizardGridType="Tabular" wizardAllowInsert="True" wizardAltRecord="True" wizardAltRecordType="Style" wizardRecordSeparator="False" wizardNoRecords="-" pasteAsReplace="pasteAsReplace" pasteActions="pasteActions" activeCollection="TableParameters" parameterTypeListName="ParameterTypeList" dataSource="t_cust_order_legal_doc">
			<Components>
				<Link id="7" visible="Yes" fieldSourceType="DBColumn" dataType="Text" html="False" hrefType="Page" urlType="Relative" preserveParameters="GET" name="Insert_Link" hrefSource="t_cust_order_legal_doc_ro_kasi.ccp" removeParameters="t_cust_order_legal_doc_id;s_keyword" wizardThemeItem="FooterA" wizardDefaultValue="Add New" wizardUseTemplateBlock="False" PathID="t_cust_order_legal_docGridInsert_Link">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="67" sourceType="Expression" name="FLAG" source="&quot;ADD&quot;"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
				<Link id="11" visible="Yes" fieldSourceType="CodeExpression" html="True" hrefType="Page" urlType="Relative" preserveParameters="GET" name="DLink" wizardCaption="Detail" wizardSize="50" wizardMaxLength="60" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" dataType="Text" wizardDefaultValue="DLink" hrefSource="t_cust_order_legal_doc_ro_kasi.ccp" wizardThemeItem="GridA" PathID="t_cust_order_legal_docGridDLink" removeParameters="FLAG">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="624" sourceType="DataField" name="t_cust_order_legal_doc_id" source="t_cust_order_legal_doc_id"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
				<Link id="15" fieldSourceType="DBColumn" dataType="Text" html="False" name="origin_file_name" fieldSource="origin_file_name" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="t_cust_order_legal_docGridorigin_file_name" visible="Yes" hrefType="Database" urlType="Relative" preserveParameters="GET" hrefSource="file_name">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
					<LinkParameters>
					</LinkParameters>
				</Link>
				<Navigator id="22" size="10" type="Centered" pageSizes="1;5;10;25;50" name="Navigator" wizardPagingType="Custom" wizardFirst="True" wizardFirstText="First" wizardPrev="True" wizardPrevText="Prev" wizardNext="True" wizardNextText="Next" wizardLast="True" wizardLastText="Last" wizardImages="Images" wizardPageNumbers="Centered" wizardSize="10" wizardTotalPages="False" wizardHideDisabled="False" wizardOfText="of" wizardPageSize="False" wizardUsePageScroller="True">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Navigator>
				<Hidden id="13" fieldSourceType="DBColumn" dataType="Float" html="False" name="t_cust_order_legal_doc_id" fieldSource="t_cust_order_legal_doc_id" wizardCaption="Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="t_cust_order_legal_docGridt_cust_order_legal_doc_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Label id="17" fieldSourceType="DBColumn" dataType="Text" html="False" name="description" fieldSource="description" wizardCaption="Description" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="t_cust_order_legal_docGriddescription">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="555" fieldSourceType="DBColumn" dataType="Text" html="False" name="legal_doc_desc" fieldSource="legal_doc_desc" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="t_cust_order_legal_docGridlegal_doc_desc">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
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
				<JoinTable id="622" tableName="t_cust_order_legal_doc" posLeft="10" posTop="10" posWidth="160" posHeight="180"/>
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
		<Record id="3" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="None" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="t_cust_order_legal_docSearch" wizardCaption="Search P App Role " wizardOrientation="Vertical" wizardFormMethod="post" returnPage="t_cust_order_legal_doc_ro_kasi.ccp" PathID="t_cust_order_legal_docSearch" pasteActions="pasteActions">
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
				<Hidden id="676" fieldSourceType="DBColumn" dataType="Float" name="t_customer_order_id" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_cust_order_legal_docSearcht_customer_order_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="677" fieldSourceType="DBColumn" dataType="Float" html="False" name="t_vat_registration_id" wizardCaption="Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="t_cust_order_legal_docSearcht_vat_registration_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="678" fieldSourceType="DBColumn" dataType="Text" html="False" name="rqst_type_code" wizardCaption="Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="t_cust_order_legal_docSearchrqst_type_code">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="679" fieldSourceType="DBColumn" dataType="Float" name="p_rqst_type_id" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_cust_order_legal_docSearchp_rqst_type_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="695" fieldSourceType="DBColumn" dataType="Text" name="TAKEN_CTL" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_cust_order_legal_docSearchTAKEN_CTL">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="696" fieldSourceType="DBColumn" dataType="Text" name="IS_TAKEN" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_cust_order_legal_docSearchIS_TAKEN">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="697" fieldSourceType="DBColumn" dataType="Text" name="CURR_DOC_ID" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_cust_order_legal_docSearchCURR_DOC_ID">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="698" fieldSourceType="DBColumn" dataType="Text" name="CURR_DOC_TYPE_ID" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_cust_order_legal_docSearchCURR_DOC_TYPE_ID">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="699" fieldSourceType="DBColumn" dataType="Text" name="CURR_PROC_ID" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_cust_order_legal_docSearchCURR_PROC_ID">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="700" fieldSourceType="DBColumn" dataType="Text" name="CURR_CTL_ID" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_cust_order_legal_docSearchCURR_CTL_ID">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="701" fieldSourceType="DBColumn" dataType="Text" name="USER_ID_DOC" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_cust_order_legal_docSearchUSER_ID_DOC">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="702" fieldSourceType="DBColumn" dataType="Text" name="USER_ID_DONOR" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_cust_order_legal_docSearchUSER_ID_DONOR">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="703" fieldSourceType="DBColumn" dataType="Text" name="USER_ID_LOGIN" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_cust_order_legal_docSearchUSER_ID_LOGIN">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="704" fieldSourceType="DBColumn" dataType="Text" name="USER_ID_TAKEN" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_cust_order_legal_docSearchUSER_ID_TAKEN">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="705" fieldSourceType="DBColumn" dataType="Text" name="IS_CREATE_DOC" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_cust_order_legal_docSearchIS_CREATE_DOC">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="706" fieldSourceType="DBColumn" dataType="Text" name="IS_MANUAL" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_cust_order_legal_docSearchIS_MANUAL">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="707" fieldSourceType="DBColumn" dataType="Text" name="CURR_PROC_STATUS" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_cust_order_legal_docSearchCURR_PROC_STATUS">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="708" fieldSourceType="DBColumn" dataType="Text" name="CURR_DOC_STATUS" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_cust_order_legal_docSearchCURR_DOC_STATUS">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="709" fieldSourceType="DBColumn" dataType="Text" name="PREV_DOC_ID" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_cust_order_legal_docSearchPREV_DOC_ID">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="710" fieldSourceType="DBColumn" dataType="Text" name="PREV_DOC_TYPE_ID" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_cust_order_legal_docSearchPREV_DOC_TYPE_ID">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="711" fieldSourceType="DBColumn" dataType="Text" name="PREV_PROC_ID" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_cust_order_legal_docSearchPREV_PROC_ID">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="712" fieldSourceType="DBColumn" dataType="Text" name="PREV_CTL_ID" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_cust_order_legal_docSearchPREV_CTL_ID">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="713" fieldSourceType="DBColumn" dataType="Text" name="SLOT_1" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_cust_order_legal_docSearchSLOT_1">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="714" fieldSourceType="DBColumn" dataType="Text" name="SLOT_2" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_cust_order_legal_docSearchSLOT_2">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="715" fieldSourceType="DBColumn" dataType="Text" name="SLOT_3" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_cust_order_legal_docSearchSLOT_3">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="716" fieldSourceType="DBColumn" dataType="Text" name="SLOT_4" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_cust_order_legal_docSearchSLOT_4">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="717" fieldSourceType="DBColumn" dataType="Text" name="SLOT_5" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_cust_order_legal_docSearchSLOT_5">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="718" fieldSourceType="DBColumn" dataType="Text" name="MESSAGE" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_cust_order_legal_docSearchMESSAGE">
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
		<Record id="94" sourceType="SQL" urlType="Relative" secured="False" allowInsert="True" allowUpdate="True" allowDelete="True" validateData="True" preserveParameters="GET" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" connection="ConnSIKP" name="t_cust_order_legal_docForm" errorSummator="Error" wizardCaption="Add/Edit V P App User " wizardFormMethod="post" PathID="t_cust_order_legal_docForm" activeCollection="USQLParameters" pasteAsReplace="pasteAsReplace" pasteActions="pasteActions" customDeleteType="SQL" parameterTypeListName="ParameterTypeList" customUpdateType="SQL" customInsertType="SQL" customInsert="INSERT INTO t_cust_order_legal_doc(t_cust_order_legal_doc_id, description, created_by, updated_by, creation_date, updated_date, p_legal_doc_type_id, t_customer_order_id, origin_file_name, file_folder, file_name, legal_doc_desc) 
VALUES(generate_id('sikp','t_cust_order_legal_doc','t_cust_order_legal_doc_id'), '{description}', '{created_by}', '{updated_by}', sysdate, sysdate, {p_legal_doc_type_id}, {t_customer_order_id}, substr('{file_name}',17),'{file_folder}','{file_name}','{legal_doc_desc}')" customUpdate="UPDATE t_cust_order_legal_doc SET 
description='{description}', 
updated_by='{updated_by}', 
updated_date=sysdate, 
legal_doc_desc='{legal_doc_desc}', 
p_legal_doc_type_id={p_legal_doc_type_id}, 
t_customer_order_id={t_customer_order_id}, 
origin_file_name=substr('{file_name}',17), 
file_folder='{file_folder}', 
file_name='{file_name}'
WHERE t_cust_order_legal_doc_id={t_cust_order_legal_doc_id}" customDelete="DELETE FROM t_cust_order_legal_doc
WHERE t_cust_order_legal_doc_id = {t_cust_order_legal_doc_id}" dataSource="SELECT t_cust_order_legal_doc_id, t_customer_order_id, p_legal_doc_type_id, 
legal_doc_desc, origin_file_name, 
file_folder, description,
file_name, to_char(creation_date, 'DD-MON-YYYY')as creation_date, 
created_by, to_char(updated_date,'DD-MON-YYYY')as updated_date, updated_by 
FROM t_cust_order_legal_doc
WHERE t_cust_order_legal_doc_id = {t_cust_order_legal_doc_id} ">
			<Components>
				<Button id="95" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Insert" operation="Insert" wizardCaption="Add" PathID="t_cust_order_legal_docFormButton_Insert" removeParameters="FLAG">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="96" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Update" operation="Update" wizardCaption="Submit" PathID="t_cust_order_legal_docFormButton_Update" removeParameters="FLAG">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="97" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Delete" operation="Delete" wizardCaption="Delete" PathID="t_cust_order_legal_docFormButton_Delete" removeParameters="FLAG;s_keyword;t_cust_order_legal_doc_id;t_cust_order_legal_docGridPage">
					<Components/>
					<Events>
						<Event name="OnClick" type="Client">
							<Actions>
								<Action actionName="Confirmation Message" actionCategory="General" id="98" message="Delete record?"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="99" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Cancel" operation="Cancel" wizardCaption="Cancel" PathID="t_cust_order_legal_docFormButton_Cancel" removeParameters="FLAG;s_keyword;t_cust_order_legal_doc_id;t_cust_order_legal_docGridPage">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Hidden id="101" fieldSourceType="DBColumn" dataType="Float" name="t_cust_order_legal_doc_id" fieldSource="t_cust_order_legal_doc_id" caption="Id" wizardCaption="P App User Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_cust_order_legal_docFormt_cust_order_legal_doc_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<TextBox id="114" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="description" fieldSource="description" required="False" caption="Description" wizardCaption="Description" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_cust_order_legal_docFormdescription">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="124" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="created_by" fieldSource="created_by" required="False" caption="Created By" wizardCaption="Created By" wizardSize="16" wizardMaxLength="16" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_cust_order_legal_docFormcreated_by" defaultValue="CCGetUserLogin()">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="127" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="updated_by" fieldSource="updated_by" required="False" caption="Updated By" wizardCaption="Updated By" wizardSize="16" wizardMaxLength="16" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_cust_order_legal_docFormupdated_by" defaultValue="CCGetUserLogin()">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="122" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="creation_date" fieldSource="creation_date" required="False" caption="Creation Date" wizardCaption="Creation Date" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_cust_order_legal_docFormcreation_date" format="dd-mmm-yyyy" defaultValue="date(&quot;d-M-Y&quot;)">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="125" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="updated_date" fieldSource="updated_date" required="False" caption="Updated Date" wizardCaption="Updated Date" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_cust_order_legal_docFormupdated_date" defaultValue="date(&quot;d-M-Y&quot;)" format="dd-mmm-yyyy">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Hidden id="165" fieldSourceType="DBColumn" dataType="Text" name="t_cust_order_legal_docGridPage" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_cust_order_legal_docFormt_cust_order_legal_docGridPage">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<TextBox id="564" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="legal_doc_desc" fieldSource="legal_doc_desc" required="True" caption="Jenis Dokumen" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_cust_order_legal_docFormlegal_doc_desc">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Hidden id="566" fieldSourceType="DBColumn" dataType="Float" name="p_legal_doc_type_id" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_cust_order_legal_docFormp_legal_doc_type_id" fieldSource="p_legal_doc_type_id" caption="p_legal_doc_type_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="619" fieldSourceType="DBColumn" dataType="Float" name="t_customer_order_id" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_cust_order_legal_docFormt_customer_order_id" fieldSource="t_customer_order_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="647" fieldSourceType="DBColumn" dataType="Text" name="file_folder" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_cust_order_legal_docFormfile_folder" fieldSource="file_folder">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="648" fieldSourceType="DBColumn" dataType="Text" name="origin_file_name" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_cust_order_legal_docFormorigin_file_name" fieldSource="origin_file_name">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<FileUpload id="693" fieldSourceType="DBColumn" allowedFileMasks="*" fileSizeLimit="2000000" dataType="Text" tempFileFolder="../files_tmp" name="file_name" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_cust_order_legal_docFormfile_name" processedFileFolder="../files" fieldSource="file_name">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</FileUpload>
				<Button id="719" urlType="Relative" enableValidation="True" isDefault="False" name="Button1" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_cust_order_legal_docFormButton1">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
			</Components>
			<Events/>
			<TableParameters>
				<TableParameter id="626" conditionType="Parameter" useIsNull="False" field="t_cust_order_legal_doc_id" dataType="Float" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="t_cust_order_legal_doc_id"/>
			</TableParameters>
			<SPParameters/>
			<SQLParameters>
				<SQLParameter id="692" parameterType="URL" variable="t_cust_order_legal_doc_id" dataType="Float" parameterSource="t_cust_order_legal_doc_id"/>
			</SQLParameters>
			<JoinTables>
				<JoinTable id="625" tableName="t_cust_order_legal_doc" posLeft="10" posTop="10" posWidth="160" posHeight="180"/>
			</JoinTables>
			<JoinLinks/>
			<Fields>
				<Field id="680" tableName="t_cust_order_legal_doc" fieldName="t_cust_order_legal_doc_id"/>
				<Field id="681" tableName="t_cust_order_legal_doc" fieldName="t_customer_order_id"/>
				<Field id="682" tableName="t_cust_order_legal_doc" fieldName="p_legal_doc_type_id"/>
				<Field id="683" tableName="t_cust_order_legal_doc" fieldName="legal_doc_desc"/>
				<Field id="684" tableName="t_cust_order_legal_doc" fieldName="origin_file_name"/>
				<Field id="685" tableName="t_cust_order_legal_doc" fieldName="file_folder"/>
				<Field id="686" tableName="t_cust_order_legal_doc" fieldName="description"/>
				<Field id="687" tableName="t_cust_order_legal_doc" fieldName="file_name"/>
				<Field id="688" tableName="t_cust_order_legal_doc" fieldName="creation_date"/>
				<Field id="689" tableName="t_cust_order_legal_doc" fieldName="created_by"/>
				<Field id="690" tableName="t_cust_order_legal_doc" fieldName="updated_date"/>
				<Field id="691" tableName="t_cust_order_legal_doc" fieldName="updated_by"/>
			</Fields>
			<ISPParameters>
				<SPParameter id="Key176" parameterName="i_p_app_user_id" parameterSource="0" dataType="Numeric" parameterType="Expression" dataSize="0" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key178" parameterName="i_full_name" parameterSource="full_name" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key179" parameterName="i_email_address" parameterSource="email_address" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key181" parameterName="i_p_data_status_list_id" parameterSource="p_data_status_list_id" dataType="Numeric" parameterType="Control" dataSize="0" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key182" parameterName="i_p_region_id" parameterSource="p_region_id" dataType="Numeric" parameterType="Control" dataSize="0" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key184" parameterName="i_description" parameterSource="description" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key185" parameterName="i_ip_address" parameterSource="ip_address" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key187" parameterName="i_expired_pwd" parameterSource="expired_pwd" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key188" parameterName="i_user_by" parameterSource="UserName" dataType="Char" parameterType="Session" dataSize="255" direction="Input" scale="10" precision="6"/>
			</ISPParameters>
			<ISQLParameters>
				<SQLParameter id="638" variable="description" dataType="Text" parameterType="Control" parameterSource="description"/>
				<SQLParameter id="639" variable="created_by" dataType="Text" parameterType="Expression" parameterSource="CCGetUserLogin()"/>
				<SQLParameter id="640" variable="updated_by" dataType="Text" parameterType="Expression" parameterSource="CCGetUserLogin()"/>
				<SQLParameter id="643" variable="legal_doc_desc" dataType="Text" parameterType="Control" parameterSource="legal_doc_desc"/>
				<SQLParameter id="644" variable="p_legal_doc_type_id" dataType="Float" parameterType="Control" parameterSource="p_legal_doc_type_id"/>
				<SQLParameter id="645" variable="t_customer_order_id" dataType="Float" parameterType="Control" parameterSource="t_customer_order_id"/>
				<SQLParameter id="646" variable="file_name" dataType="Text" parameterType="Control" parameterSource="file_name"/>
				<SQLParameter id="649" variable="file_folder" parameterType="Expression" dataType="Text" parameterSource="files"/>
			</ISQLParameters>
			<IFormElements>
				<CustomParameter id="627" field="t_cust_order_legal_doc_id" dataType="Float" parameterType="Control" parameterSource="t_cust_order_legal_doc_id"/>
				<CustomParameter id="628" field="description" dataType="Text" parameterType="Control" parameterSource="description"/>
				<CustomParameter id="629" field="created_by" dataType="Text" parameterType="Control" parameterSource="created_by"/>
				<CustomParameter id="630" field="updated_by" dataType="Text" parameterType="Control" parameterSource="updated_by"/>
				<CustomParameter id="631" field="creation_date" dataType="Text" parameterType="Control" parameterSource="creation_date" format="dd-mmm-yyyy"/>
				<CustomParameter id="632" field="updated_date" dataType="Text" parameterType="Control" parameterSource="updated_date" format="dd-mmm-yyyy"/>
				<CustomParameter id="633" field="legal_doc_desc" dataType="Text" parameterType="Control" parameterSource="legal_doc_desc"/>
				<CustomParameter id="634" field="p_legal_doc_type_id" dataType="Float" parameterType="Control" parameterSource="p_legal_doc_type_id"/>
				<CustomParameter id="635" field="t_customer_order_id" dataType="Float" parameterType="Control" parameterSource="t_customer_order_id"/>
				<CustomParameter id="636" field="origin_file_name" dataType="Text" parameterType="Control" parameterSource="origin_file_name"/>
			</IFormElements>
			<USPParameters>
				<SPParameter id="Key154" parameterName="i_flag" parameterSource="2" dataType="Numeric" parameterType="Expression" dataSize="0" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key155" parameterName="i_p_app_user_id" parameterSource="p_app_user_id" dataType="Numeric" parameterType="Control" dataSize="0" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key156" parameterName="i_user_name" parameterSource="user_name" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key157" parameterName="i_full_name" parameterSource="full_name" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key158" parameterName="i_email_address" parameterSource="email_address" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key159" parameterName="i_p_user_type_id" parameterSource="p_user_type_id" dataType="Numeric" parameterType="Control" dataSize="0" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key160" parameterName="i_p_data_status_list_id" parameterSource="p_data_status_list_id" dataType="Numeric" parameterType="Control" dataSize="0" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key161" parameterName="i_p_region_id" parameterSource="p_region_id" dataType="Numeric" parameterType="Control" dataSize="0" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key162" parameterName="i_p_region_structure_id" parameterSource="p_region_structure_id" dataType="Numeric" parameterType="Control" dataSize="0" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key163" parameterName="i_description" parameterSource="description" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key164" parameterName="i_ip_address" parameterSource="ip_address" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key165" parameterName="i_expired_user" parameterSource="expired_user" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key166" parameterName="i_expired_pwd" parameterSource="expired_pwd" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key167" parameterName="i_user_by" parameterSource="UserName" dataType="Char" parameterType="Session" dataSize="255" direction="Input" scale="10" precision="6"/>
			</USPParameters>
			<USQLParameters>
				<SQLParameter id="663" variable="t_cust_order_legal_doc_id" dataType="Float" parameterType="Control" parameterSource="t_cust_order_legal_doc_id"/>
				<SQLParameter id="664" variable="description" dataType="Text" parameterType="Control" parameterSource="description"/>
				<SQLParameter id="666" variable="updated_by" dataType="Text" parameterType="Expression" parameterSource="CCGetUserLogin()"/>
				<SQLParameter id="669" variable="legal_doc_desc" dataType="Text" parameterType="Control" parameterSource="legal_doc_desc"/>
				<SQLParameter id="670" variable="p_legal_doc_type_id" dataType="Float" parameterType="Control" parameterSource="p_legal_doc_type_id"/>
				<SQLParameter id="671" variable="t_customer_order_id" dataType="Float" parameterType="Control" parameterSource="t_customer_order_id"/>
				<SQLParameter id="672" variable="file_name" dataType="Text" parameterType="Control" parameterSource="file_name"/>
				<SQLParameter id="673" variable="file_folder" dataType="Text" parameterType="Expression" parameterSource="files"/>
			</USQLParameters>
			<UConditions>
			</UConditions>
			<UFormElements>
				<CustomParameter id="651" field="t_cust_order_legal_doc_id" dataType="Float" parameterType="Control" parameterSource="t_cust_order_legal_doc_id"/>
				<CustomParameter id="652" field="description" dataType="Text" parameterType="Control" parameterSource="description"/>
				<CustomParameter id="653" field="created_by" dataType="Text" parameterType="Control" parameterSource="created_by"/>
				<CustomParameter id="654" field="updated_by" dataType="Text" parameterType="Control" parameterSource="updated_by"/>
				<CustomParameter id="655" field="creation_date" dataType="Text" parameterType="Control" parameterSource="creation_date" format="dd-mmm-yyyy"/>
				<CustomParameter id="656" field="updated_date" dataType="Text" parameterType="Control" parameterSource="updated_date" format="dd-mmm-yyyy"/>
				<CustomParameter id="657" field="legal_doc_desc" dataType="Text" parameterType="Control" parameterSource="legal_doc_desc"/>
				<CustomParameter id="658" field="p_legal_doc_type_id" dataType="Float" parameterType="Control" parameterSource="p_legal_doc_type_id"/>
				<CustomParameter id="659" field="t_customer_order_id" dataType="Float" parameterType="Control" parameterSource="t_customer_order_id"/>
				<CustomParameter id="660" field="origin_file_name" dataType="Text" parameterType="Control" parameterSource="origin_file_name"/>
				<CustomParameter id="661" field="file_folder" dataType="Text" parameterType="Control" parameterSource="file_folder"/>
				<CustomParameter id="662" field="file_name" dataType="Text" parameterType="Control" parameterSource="file_name"/>
			</UFormElements>
			<DSPParameters/>
			<DSQLParameters>
				<SQLParameter id="674" variable="t_cust_order_legal_doc_id" parameterType="Control" defaultValue="0" dataType="Float" parameterSource="t_cust_order_legal_doc_id"/>
			</DSQLParameters>
			<DConditions>
			</DConditions>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Record>
	</Components>
	<CodeFiles>
		<CodeFile id="Events" language="PHPTemplates" name="t_cust_order_legal_doc_ro_kasi_events.php" forShow="False" comment="//" codePage="windows-1252"/>
<CodeFile id="Code" language="PHPTemplates" name="t_cust_order_legal_doc_ro_kasi.php" forShow="True" url="t_cust_order_legal_doc_ro_kasi.php" comment="//" codePage="windows-1252"/>
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
