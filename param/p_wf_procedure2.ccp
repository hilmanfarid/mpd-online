<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\param" secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="RWNet" wizardThemeVersion="3.0" needGeneration="0" pasteActions="pasteActions">
	<Components>
		<Grid id="2" secured="False" sourceType="Table" returnValueType="Number" defaultPageSize="5" connection="ConnSIKP" name="p_workflowGrid" pageSizeLimit="100" wizardCaption="List of P App Role " wizardGridType="Tabular" wizardAllowInsert="True" wizardAltRecord="True" wizardAltRecordType="Style" wizardRecordSeparator="False" wizardNoRecords="-" pasteAsReplace="pasteAsReplace" pasteActions="pasteActions" activeCollection="TableParameters" parameterTypeListName="ParameterTypeList" dataSource="v_p_workflow" orderBy="p_workflow_id">
			<Components>
				<Link id="11" visible="Yes" fieldSourceType="CodeExpression" html="True" hrefType="Page" urlType="Relative" preserveParameters="GET" name="DLink" wizardCaption="Detail" wizardSize="50" wizardMaxLength="60" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" dataType="Text" wizardDefaultValue="DLink" hrefSource="p_wf_procedure2.ccp" wizardThemeItem="GridA" PathID="p_workflowGridDLink" removeParameters="FLAG">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="642" sourceType="DataField" name="p_workflow_id" source="p_workflow_id"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
				<Label id="15" fieldSourceType="DBColumn" dataType="Text" html="False" name="code" fieldSource="code" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="p_workflowGridcode">
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
				<Hidden id="13" fieldSourceType="DBColumn" dataType="Float" html="False" name="p_workflow_id" fieldSource="p_workflow_id" wizardCaption="Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="p_workflowGridp_workflow_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Label id="332" fieldSourceType="DBColumn" dataType="Text" html="False" name="description" fieldSource="description" wizardCaption="Valid From" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="p_workflowGriddescription">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="509" fieldSourceType="DBColumn" dataType="Text" html="False" name="workflow_type_code" fieldSource="workflow_type_code" wizardCaption="Valid From" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="p_workflowGridworkflow_type_code">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="510" fieldSourceType="DBColumn" dataType="Text" html="False" name="document_name" fieldSource="document_name" wizardCaption="Valid From" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="p_workflowGriddocument_name">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="542" fieldSourceType="DBColumn" dataType="Text" html="False" name="cproc" fieldSource="cproc" wizardCaption="Valid From" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="p_workflowGridcproc">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="631" fieldSourceType="DBColumn" dataType="Text" html="False" name="is_active_code" fieldSource="is_active_code" wizardCaption="Valid From" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="p_workflowGridis_active_code">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<ImageLink id="133" visible="Yes" fieldSourceType="DBColumn" dataType="Text" hrefType="Page" urlType="Relative" preserveParameters="GET" name="ImageLink1" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="p_workflowGridImageLink1" hrefSource="p_workflow_list.ccp">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="749" sourceType="DataField" name="p_workflow_id" source="p_workflow_id"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</ImageLink>
				<Button id="756" urlType="Relative" enableValidation="True" isDefault="False" name="Button1" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="p_workflowGridButton1">
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
				<TableParameter id="633" conditionType="Parameter" useIsNull="False" field="upper(code)" dataType="Text" searchConditionType="Contains" parameterType="URL" logicOperator="Or" parameterSource="s_keyword" leftBrackets="1"/>
				<TableParameter id="634" conditionType="Parameter" useIsNull="False" field="upper(workflow_type_code)" dataType="Text" searchConditionType="Contains" parameterType="URL" logicOperator="Or" parameterSource="s_keyword"/>
				<TableParameter id="635" conditionType="Parameter" useIsNull="False" field="upper(cproc)" dataType="Text" searchConditionType="Contains" parameterType="URL" logicOperator="Or" parameterSource="s_keyword"/>
				<TableParameter id="636" conditionType="Parameter" useIsNull="False" field="upper(document_name)" dataType="Text" searchConditionType="Contains" parameterType="URL" logicOperator="And" rightBrackets="1" parameterSource="s_keyword"/>
			</TableParameters>
			<JoinTables>
				<JoinTable id="632" tableName="v_p_workflow" posLeft="10" posTop="10" posWidth="155" posHeight="180"/>
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
		<Record id="3" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="None" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="p_workflowSearch" wizardCaption="Search P App Role " wizardOrientation="Vertical" wizardFormMethod="post" returnPage="p_wf_procedure2.ccp" PathID="p_workflowSearch" pasteActions="pasteActions">
			<Components>
				<Button id="4" urlType="Relative" enableValidation="True" isDefault="False" name="Button_DoSearch" operation="Search" wizardCaption="Search" PathID="p_workflowSearchButton_DoSearch">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<TextBox id="5" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="s_keyword" wizardCaption="Keyword" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" PathID="p_workflowSearchs_keyword">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
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
		<Record id="94" sourceType="Table" urlType="Relative" secured="False" allowInsert="True" allowUpdate="True" allowDelete="True" validateData="True" preserveParameters="GET" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="p_workflowForm" connection="ConnSIKP" customInsertType="SQL" customInsert="INSERT INTO p_workflow(p_workflow_id, updated_by, code, updated_date, created_by, creation_date, description, is_active, workflow_type, p_document_type_id, p_procedure_id) 
VALUES(generate_id('sikp','p_workflow','p_workflow_id'), '{updated_by}', '{code}', sysdate, '{created_by}', sysdate, '{description}', '{is_active}', {workflow_type}, {p_document_type_id}, {p_procedure_id})" customUpdateType="SQL" customUpdate="UPDATE p_workflow SET  
updated_by='{updated_by}', 
code='{code}', 
updated_date=sysdate, 
description='{description}', 
is_active='{is_active}', 
workflow_type={workflow_type}, 
p_document_type_id={p_document_type_id}, 
p_procedure_id={p_procedure_id}
WHERE p_workflow_id={p_workflow_id}" customDeleteType="SQL" customDelete="DELETE FROM p_workflow 
WHERE  p_workflow_id = {p_workflow_id}" PathID="p_workflowForm" pasteActions="pasteActions" dataSource="v_p_wf_procedure" activeCollection="TableParameters">
			<Components>
				<Button id="95" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Insert" operation="Insert" removeParameters="FLAG" PathID="p_workflowFormButton_Insert">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="96" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Update" operation="Update" removeParameters="FLAG" PathID="p_workflowFormButton_Update">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="97" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Delete" operation="Delete" removeParameters="FLAG;p_workflow_id;s_keyword;p_workflowGridPage" PathID="p_workflowFormButton_Delete">
					<Components/>
					<Events>
						<Event name="OnClick" type="Client">
							<Actions>
								<Action actionName="Confirmation Message" actionCategory="General" id="643" message="Delete record?"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="99" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Cancel" operation="Cancel" removeParameters="FLAG;p_workflow_id;s_keyword;p_workflowGridPage" PathID="p_workflowFormButton_Cancel">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Hidden id="101" fieldSourceType="DBColumn" dataType="Float" name="p_workflow_id" caption="p_workflow_id" fieldSource="p_workflow_id" PathID="p_workflowFormp_workflow_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<TextBox id="127" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="updated_by" caption="Updated By" fieldSource="updated_by" defaultValue="CCGetUserLogin()" required="False" PathID="p_workflowFormupdated_by">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Hidden id="165" fieldSourceType="DBColumn" dataType="Text" name="p_workflowGridPage" PathID="p_workflowFormp_workflowGridPage">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<TextBox id="460" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="next_proc_code" caption="Prosedur Sesudah" fieldSource="next_proc_code" required="True" PathID="p_workflowFormnext_proc_code">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="125" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="updated_date" caption="Updated Date" fieldSource="updated_date" format="dd-mmm-yyyy" defaultValue="date(&quot;d-M-Y&quot;)" required="False" PathID="p_workflowFormupdated_date">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="40" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="created_by" caption="Created By" fieldSource="created_by" defaultValue="CCGetUserLogin()" required="True" PathID="p_workflowFormcreated_by">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="38" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="creation_date" caption="Creation Date" fieldSource="creation_date" format="dd-mmm-yyyy" defaultValue="date(&quot;d-M-Y&quot;)" required="True" PathID="p_workflowFormcreation_date">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="546" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="prev_proc_code" caption="Prosedur Sebelum" fieldSource="prev_proc_code" required="False" PathID="p_workflowFormprev_proc_code">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Hidden id="640" fieldSourceType="DBColumn" dataType="Float" name="prev_procedure_id" caption="prev_procedure_id" fieldSource="prev_procedure_id" PathID="p_workflowFormprev_procedure_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="641" fieldSourceType="DBColumn" dataType="Float" name="next_procedure_id" caption="next_procedure_id" fieldSource="next_procedure_id" PathID="p_workflowFormnext_procedure_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<TextBox id="33" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="valid_from" fieldSource="valid_from" required="True" caption="Valid From" wizardCaption="Valid From" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_workflowFormvalid_from" defaultValue="date(&quot;d-M-Y&quot;)" format="dd-mmm-yyyy">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<DatePicker id="34" name="DatePicker_valid_from" control="valid_from" wizardSatellite="True" wizardControl="valid_from" wizardDatePickerType="Image" wizardPicture="../Styles/CoffeeBreak/Images/DatePicker.gif" style="../Styles/sikp/Style.css" PathID="p_workflowFormDatePicker_valid_from">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</DatePicker>
				<TextBox id="35" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="valid_to" fieldSource="valid_to" required="False" caption="Valid To" wizardCaption="Valid To" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_workflowFormvalid_to" format="dd-mmm-yyyy">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<DatePicker id="36" name="DatePicker_valid_to" control="valid_to" wizardSatellite="True" wizardControl="valid_to" wizardDatePickerType="Image" wizardPicture="../Styles/CoffeeBreak/Images/DatePicker.gif" style="../Styles/sikp/Style.css" PathID="p_workflowFormDatePicker_valid_to">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</DatePicker>
				<Hidden id="745" fieldSourceType="DBColumn" dataType="Float" name="p_wf_procedure_id" caption="p_wf_procedure_id" fieldSource="p_wf_procedure_id" PathID="p_workflowFormp_wf_procedure_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
			</Components>
			<Events/>
			<TableParameters>
				<TableParameter id="743" conditionType="Parameter" useIsNull="False" field="p_workflow_id" dataType="Float" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="p_workflow_id"/>
				<TableParameter id="744" conditionType="Parameter" useIsNull="False" field="prev_procedure_id" dataType="Float" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="prev_procedure_id"/>
			</TableParameters>
			<SPParameters/>
			<SQLParameters/>
			<JoinTables>
				<JoinTable id="742" tableName="v_p_wf_procedure" posLeft="10" posTop="10" posWidth="160" posHeight="180"/>
			</JoinTables>
			<JoinLinks/>
			<Fields/>
			<ISPParameters>
				<SPParameter id="Key176" parameterName="i_p_app_user_id" dataType="Numeric" dataSize="0" direction="Input" parameterType="Expression" parameterSource="0" scale="10" precision="6"/>
				<SPParameter id="Key178" parameterName="i_full_name" dataType="Char" dataSize="255" direction="Input" parameterType="Control" parameterSource="full_name" scale="10" precision="6"/>
				<SPParameter id="Key179" parameterName="i_email_address" dataType="Char" dataSize="255" direction="Input" parameterType="Control" parameterSource="email_address" scale="10" precision="6"/>
				<SPParameter id="Key181" parameterName="i_p_data_status_list_id" dataType="Numeric" dataSize="0" direction="Input" parameterType="Control" parameterSource="p_data_status_list_id" scale="10" precision="6"/>
				<SPParameter id="Key182" parameterName="i_p_region_id" dataType="Numeric" dataSize="0" direction="Input" parameterType="Control" parameterSource="p_region_id" scale="10" precision="6"/>
				<SPParameter id="Key184" parameterName="i_description" dataType="Char" dataSize="255" direction="Input" parameterType="Control" parameterSource="description" scale="10" precision="6"/>
				<SPParameter id="Key185" parameterName="i_ip_address" dataType="Char" dataSize="255" direction="Input" parameterType="Control" parameterSource="ip_address" scale="10" precision="6"/>
				<SPParameter id="Key187" parameterName="i_expired_pwd" dataType="Char" dataSize="255" direction="Input" parameterType="Control" parameterSource="expired_pwd" scale="10" precision="6"/>
				<SPParameter id="Key188" parameterName="i_user_by" dataType="Char" dataSize="255" direction="Input" parameterType="Session" parameterSource="UserName" scale="10" precision="6"/>
			</ISPParameters>
			<ISQLParameters>
				<SQLParameter id="644" variable="updated_by" dataType="Text" parameterType="Expression" parameterSource="CCGetUserLogin()"/>
				<SQLParameter id="645" variable="code" dataType="Text" parameterType="Control" parameterSource="code"/>
				<SQLParameter id="646" variable="created_by" dataType="Text" parameterType="Expression" parameterSource="CCGetUserLogin()"/>
				<SQLParameter id="647" variable="description" dataType="Text" parameterType="Control" parameterSource="description"/>
				<SQLParameter id="648" variable="is_active" dataType="Text" parameterType="Control" parameterSource="is_active"/>
				<SQLParameter id="649" variable="workflow_type" dataType="Float" parameterType="Control" parameterSource="workflow_type" defaultValue="0"/>
				<SQLParameter id="650" variable="p_document_type_id" dataType="Float" parameterType="Control" parameterSource="p_document_type_id"/>
				<SQLParameter id="651" variable="p_procedure_id" dataType="Float" parameterType="Control" parameterSource="p_procedure_id"/>
			</ISQLParameters>
			<IFormElements>
				<CustomParameter id="652" field="p_workflow_id" dataType="Float" parameterType="Control" parameterSource="p_workflow_id"/>
				<CustomParameter id="653" field="updated_by" dataType="Text" parameterType="Control" parameterSource="updated_by"/>
				<CustomParameter id="654" field="code" dataType="Text" parameterType="Control" parameterSource="code"/>
				<CustomParameter id="655" field="cproc" dataType="Text" parameterType="Control" parameterSource="cproc"/>
				<CustomParameter id="656" field="updated_date" dataType="Text" parameterType="Control" parameterSource="updated_date" format="dd-mmm-yyyy"/>
				<CustomParameter id="657" field="created_by" dataType="Text" parameterType="Control" parameterSource="created_by"/>
				<CustomParameter id="658" field="creation_date" dataType="Text" parameterType="Control" parameterSource="creation_date" format="dd-mmm-yyyy"/>
				<CustomParameter id="659" field="description" dataType="Text" parameterType="Control" parameterSource="description"/>
				<CustomParameter id="660" field="document_name" dataType="Text" parameterType="Control" parameterSource="document_name"/>
				<CustomParameter id="661" field="is_active" dataType="Text" parameterType="Control" parameterSource="is_active"/>
				<CustomParameter id="662" field="workflow_type" dataType="Text" parameterType="Control" parameterSource="workflow_type"/>
				<CustomParameter id="663" field="p_document_type_id" dataType="Float" parameterType="Control" parameterSource="p_document_type_id"/>
				<CustomParameter id="664" field="p_procedure_id" dataType="Float" parameterType="Control" parameterSource="p_procedure_id"/>
			</IFormElements>
			<USPParameters>
				<SPParameter id="Key154" parameterName="i_flag" dataType="Numeric" dataSize="0" direction="Input" parameterType="Expression" parameterSource="2" scale="10" precision="6"/>
				<SPParameter id="Key155" parameterName="i_p_app_user_id" dataType="Numeric" dataSize="0" direction="Input" parameterType="Control" parameterSource="p_app_user_id" scale="10" precision="6"/>
				<SPParameter id="Key156" parameterName="i_user_name" dataType="Char" dataSize="255" direction="Input" parameterType="Control" parameterSource="user_name" scale="10" precision="6"/>
				<SPParameter id="Key157" parameterName="i_full_name" dataType="Char" dataSize="255" direction="Input" parameterType="Control" parameterSource="full_name" scale="10" precision="6"/>
				<SPParameter id="Key158" parameterName="i_email_address" dataType="Char" dataSize="255" direction="Input" parameterType="Control" parameterSource="email_address" scale="10" precision="6"/>
				<SPParameter id="Key159" parameterName="i_p_user_type_id" dataType="Numeric" dataSize="0" direction="Input" parameterType="Control" parameterSource="p_user_type_id" scale="10" precision="6"/>
				<SPParameter id="Key160" parameterName="i_p_data_status_list_id" dataType="Numeric" dataSize="0" direction="Input" parameterType="Control" parameterSource="p_data_status_list_id" scale="10" precision="6"/>
				<SPParameter id="Key161" parameterName="i_p_region_id" dataType="Numeric" dataSize="0" direction="Input" parameterType="Control" parameterSource="p_region_id" scale="10" precision="6"/>
				<SPParameter id="Key162" parameterName="i_p_region_structure_id" dataType="Numeric" dataSize="0" direction="Input" parameterType="Control" parameterSource="p_region_structure_id" scale="10" precision="6"/>
				<SPParameter id="Key163" parameterName="i_description" dataType="Char" dataSize="255" direction="Input" parameterType="Control" parameterSource="description" scale="10" precision="6"/>
				<SPParameter id="Key164" parameterName="i_ip_address" dataType="Char" dataSize="255" direction="Input" parameterType="Control" parameterSource="ip_address" scale="10" precision="6"/>
				<SPParameter id="Key165" parameterName="i_expired_user" dataType="Char" dataSize="255" direction="Input" parameterType="Control" parameterSource="expired_user" scale="10" precision="6"/>
				<SPParameter id="Key166" parameterName="i_expired_pwd" dataType="Char" dataSize="255" direction="Input" parameterType="Control" parameterSource="expired_pwd" scale="10" precision="6"/>
				<SPParameter id="Key167" parameterName="i_user_by" dataType="Char" dataSize="255" direction="Input" parameterType="Session" parameterSource="UserName" scale="10" precision="6"/>
			</USPParameters>
			<USQLParameters>
				<SQLParameter id="665" variable="p_workflow_id" dataType="Float" parameterType="Control" parameterSource="p_workflow_id"/>
				<SQLParameter id="666" variable="updated_by" dataType="Text" parameterType="Expression" parameterSource="CCGetUserLogin()"/>
				<SQLParameter id="667" variable="code" dataType="Text" parameterType="Control" parameterSource="code"/>
				<SQLParameter id="668" variable="description" dataType="Text" parameterType="Control" parameterSource="description"/>
				<SQLParameter id="669" variable="is_active" dataType="Text" parameterType="Control" parameterSource="is_active"/>
				<SQLParameter id="670" variable="workflow_type" dataType="Float" parameterType="Control" parameterSource="workflow_type"/>
				<SQLParameter id="671" variable="p_document_type_id" dataType="Float" parameterType="Control" parameterSource="p_document_type_id"/>
				<SQLParameter id="672" variable="p_procedure_id" dataType="Float" parameterType="Control" parameterSource="p_procedure_id"/>
			</USQLParameters>
			<UConditions/>
			<UFormElements>
				<CustomParameter id="673" field="p_workflow_id" dataType="Float" parameterType="Control" parameterSource="p_workflow_id"/>
				<CustomParameter id="674" field="updated_by" dataType="Text" parameterType="Control" parameterSource="updated_by"/>
				<CustomParameter id="675" field="code" dataType="Text" parameterType="Control" parameterSource="code"/>
				<CustomParameter id="676" field="cproc" dataType="Text" parameterType="Control" parameterSource="cproc"/>
				<CustomParameter id="677" field="updated_date" dataType="Text" parameterType="Control" parameterSource="updated_date" format="dd-mmm-yyyy"/>
				<CustomParameter id="678" field="created_by" dataType="Text" parameterType="Control" parameterSource="created_by"/>
				<CustomParameter id="679" field="creation_date" dataType="Text" parameterType="Control" parameterSource="creation_date" format="dd-mmm-yyyy"/>
				<CustomParameter id="680" field="description" dataType="Text" parameterType="Control" parameterSource="description"/>
				<CustomParameter id="681" field="document_name" dataType="Text" parameterType="Control" parameterSource="document_name"/>
				<CustomParameter id="682" field="is_active" dataType="Text" parameterType="Control" parameterSource="is_active"/>
				<CustomParameter id="683" field="workflow_type" dataType="Float" parameterType="Control" parameterSource="workflow_type"/>
				<CustomParameter id="684" field="p_document_type_id" dataType="Float" parameterType="Control" parameterSource="p_document_type_id"/>
				<CustomParameter id="685" field="p_procedure_id" dataType="Float" parameterType="Control" parameterSource="p_procedure_id"/>
			</UFormElements>
			<DSPParameters/>
			<DSQLParameters>
				<SQLParameter id="686" variable="p_workflow_id" dataType="Float" parameterType="Control" parameterSource="p_workflow_id" defaultValue="0"/>
			</DSQLParameters>
			<DConditions>
				<TableParameter id="687" conditionType="Parameter" useIsNull="False" field="p_workflow_id" dataType="Float" searchConditionType="Equal" parameterType="Control" parameterSource="p_workflow_id" logicOperator="And"/>
			</DConditions>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Record>
		<Grid id="688" secured="False" sourceType="Table" returnValueType="Number" defaultPageSize="5" connection="ConnSIKP" name="p_wf_procmasterGrid" pageSizeLimit="100" wizardCaption="List of P App Role " wizardGridType="Tabular" wizardAllowInsert="True" wizardAltRecord="True" wizardAltRecordType="Style" wizardRecordSeparator="False" wizardNoRecords="-" pasteAsReplace="pasteAsReplace" pasteActions="pasteActions" activeCollection="TableParameters" parameterTypeListName="ParameterTypeList" orderBy="p_workflow_id" dataSource="v_p_wf_procmaster">
			<Components>
				<Link id="691" visible="Yes" fieldSourceType="CodeExpression" html="True" hrefType="Page" urlType="Relative" preserveParameters="GET" name="DLink2" wizardCaption="Detail" wizardSize="50" wizardMaxLength="60" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" dataType="Text" wizardDefaultValue="DLink" hrefSource="p_wf_procedure2.ccp" wizardThemeItem="GridA" PathID="p_wf_procmasterGridDLink2" removeParameters="FLAG">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="746" sourceType="DataField" name="prev_procedure_id" source="prev_procedure_id"/>
						<LinkParameter id="755" sourceType="DataField" name="p_workflow_id" source="p_workflow_id"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
				<Label id="693" fieldSourceType="DBColumn" dataType="Text" html="False" name="prev_proc_code" fieldSource="prev_proc_code" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="p_wf_procmasterGridprev_proc_code">
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
				<Hidden id="695" fieldSourceType="DBColumn" dataType="Float" html="False" name="prev_procedure_id" fieldSource="prev_procedure_id" wizardCaption="Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="p_wf_procmasterGridprev_procedure_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="739" fieldSourceType="DBColumn" dataType="Float" html="False" name="p_workflow_id" fieldSource="p_workflow_id" wizardCaption="Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="p_wf_procmasterGridp_workflow_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Label id="741" fieldSourceType="DBColumn" dataType="Text" html="False" name="description" fieldSource="description" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="p_wf_procmasterGriddescription">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Link id="689" visible="Yes" fieldSourceType="DBColumn" dataType="Text" html="False" hrefType="Page" urlType="Relative" preserveParameters="GET" name="Insert_Link2" hrefSource="p_wf_proc_list1.ccp" wizardThemeItem="FooterA" wizardDefaultValue="Add New" wizardUseTemplateBlock="False" PathID="p_wf_procmasterGridInsert_Link2">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="690" sourceType="Expression" name="FLAG" source="&quot;ADD&quot;"/>
						<LinkParameter id="754" sourceType="DataField" name="p_workflow_id" source="p_workflow_id"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
			</Components>
			<Events>
				<Event name="BeforeShowRow" type="Server">
					<Actions>
						<Action actionName="Set Row Style" actionCategory="General" id="701" styles="Row;AltRow" name="rowStyle" eventType="Server"/>
					</Actions>
				</Event>
				<Event name="BeforeSelect" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="702" eventType="Server"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
				<TableParameter id="734" conditionType="Parameter" useIsNull="False" field="p_workflow_id" dataType="Float" searchConditionType="Equal" parameterType="Expression" logicOperator="And" parameterSource="$selected_id"/>
			</TableParameters>
			<JoinTables>
				<JoinTable id="740" tableName="v_p_wf_procmaster" posLeft="10" posTop="10" posWidth="122" posHeight="120"/>
			</JoinTables>
			<JoinLinks/>
			<Fields>
				<Field id="708" fieldName="*"/>
			</Fields>
			<SPParameters/>
			<SQLParameters>
			</SQLParameters>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Grid>
		<Grid id="709" secured="False" sourceType="Table" returnValueType="Number" defaultPageSize="5" connection="ConnSIKP" name="p_wf_procmasterGrid2" pageSizeLimit="100" wizardCaption="List of P App Role " wizardGridType="Tabular" wizardAllowInsert="True" wizardAltRecord="True" wizardAltRecordType="Style" wizardRecordSeparator="False" wizardNoRecords="-" pasteAsReplace="pasteAsReplace" pasteActions="pasteActions" activeCollection="TableParameters" parameterTypeListName="ParameterTypeList" orderBy="p_workflow_id" dataSource="v_p_wf_procedure">
			<Components>
				<Link id="712" visible="Yes" fieldSourceType="CodeExpression" html="True" hrefType="Page" urlType="Relative" preserveParameters="GET" name="DLink3" wizardCaption="Detail" wizardSize="50" wizardMaxLength="60" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" dataType="Text" wizardDefaultValue="DLink" hrefSource="p_wf_procedure2.ccp" wizardThemeItem="GridA" PathID="p_wf_procmasterGrid2DLink3" removeParameters="FLAG">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="738" sourceType="DataField" name="p_wf_procedure_id" source="p_wf_procedure_id"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
				<Label id="714" fieldSourceType="DBColumn" dataType="Text" html="False" name="code" fieldSource="code" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="p_wf_procmasterGrid2code">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Navigator id="715" size="10" type="Centered" pageSizes="1;5;10;25;50" name="Navigator" wizardPagingType="Custom" wizardFirst="True" wizardFirstText="First" wizardPrev="True" wizardPrevText="Prev" wizardNext="True" wizardNextText="Next" wizardLast="True" wizardLastText="Last" wizardImages="Images" wizardPageNumbers="Centered" wizardSize="10" wizardTotalPages="False" wizardHideDisabled="False" wizardOfText="of" wizardPageSize="False" wizardUsePageScroller="True">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Navigator>
				<Hidden id="716" fieldSourceType="DBColumn" dataType="Float" html="False" name="p_wf_procedure_id" fieldSource="p_wf_procedure_id" wizardCaption="Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="p_wf_procmasterGrid2p_wf_procedure_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Label id="717" fieldSourceType="DBColumn" dataType="Text" html="False" name="valid_to" fieldSource="valid_to" wizardCaption="Valid From" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="p_wf_procmasterGrid2valid_to">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="718" fieldSourceType="DBColumn" dataType="Text" html="False" name="next_proc_code" fieldSource="next_proc_code" wizardCaption="Valid From" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="p_wf_procmasterGrid2next_proc_code">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="719" fieldSourceType="DBColumn" dataType="Text" html="False" name="initiate_child_workflow" fieldSource="initiate_child_workflow" wizardCaption="Valid From" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="p_wf_procmasterGrid2initiate_child_workflow">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="720" fieldSourceType="DBColumn" dataType="Text" html="False" name="valid_from" fieldSource="valid_from" wizardCaption="Valid From" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="p_wf_procmasterGrid2valid_from">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Link id="710" visible="Yes" fieldSourceType="DBColumn" dataType="Text" html="False" hrefType="Page" urlType="Relative" preserveParameters="GET" name="Insert_Link3" hrefSource="p_wf_procedure2.ccp" removeParameters="p_workflow_id;s_keyword" wizardThemeItem="FooterA" wizardDefaultValue="Add New" wizardUseTemplateBlock="False" PathID="p_wf_procmasterGrid2Insert_Link3">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="711" sourceType="Expression" name="FLAG" source="&quot;ADD&quot;"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
				<ImageLink id="752" visible="Yes" fieldSourceType="DBColumn" dataType="Text" hrefType="Page" urlType="Relative" preserveParameters="GET" name="ImageLink1" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="p_wf_procmasterGrid2ImageLink1" hrefSource="p_workflow_list.ccp">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="753" sourceType="DataField" name="p_workflow_id" source="p_workflow_id"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</ImageLink>
			</Components>
			<Events>
				<Event name="BeforeShowRow" type="Server">
					<Actions>
						<Action actionName="Set Row Style" actionCategory="General" id="722" styles="Row;AltRow" name="rowStyle"/>
					</Actions>
				</Event>
				<Event name="BeforeSelect" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="723"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
				<TableParameter id="736" conditionType="Parameter" useIsNull="False" field="p_workflow_id" dataType="Float" searchConditionType="Equal" parameterType="Expression" logicOperator="And" parameterSource="$selected_id"/>
				<TableParameter id="737" conditionType="Parameter" useIsNull="False" field="prev_procedure_id" dataType="Float" searchConditionType="Equal" parameterType="Expression" logicOperator="And" parameterSource="$selected_id"/>
			</TableParameters>
			<JoinTables>
				<JoinTable id="735" tableName="v_p_wf_procedure" posLeft="10" posTop="10" posWidth="160" posHeight="180"/>
			</JoinTables>
			<JoinLinks/>
			<Fields>
				<Field id="729" fieldName="*"/>
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
		<CodeFile id="Events" language="PHPTemplates" name="p_wf_procedure2_events.php" forShow="False" comment="//" codePage="windows-1252"/>
		<CodeFile id="Code" language="PHPTemplates" name="p_wf_procedure2.php" forShow="True" url="p_wf_procedure2.php" comment="//" codePage="windows-1252"/>
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
