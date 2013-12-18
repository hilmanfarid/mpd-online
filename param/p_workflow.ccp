<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\param" secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="RWNet" wizardThemeVersion="3.0" needGeneration="0">
	<Components>
		<Grid id="2" secured="False" sourceType="SQL" returnValueType="Number" defaultPageSize="5" connection="ConnSIKP" name="p_workflowGrid" pageSizeLimit="100" wizardCaption="List of P App Role " wizardGridType="Tabular" wizardAllowInsert="True" wizardAltRecord="True" wizardAltRecordType="Style" wizardRecordSeparator="False" wizardNoRecords="-" pasteAsReplace="pasteAsReplace" pasteActions="pasteActions" activeCollection="SQLParameters" parameterTypeListName="ParameterTypeList" dataSource="SELECT p_workflow_id, a.doc_name, a.display_name, a.p_document_type_id, p_procedure_id_start,
decode(a.is_active,'Y','YA','TIDAK')as is_active, a.description, to_char(a.updated_date,'DD-MON-YYYY') AS updated_date, 
a.updated_by, a.created_by,
to_char(a.creation_date,'DD-MON-YYYY') AS creation_date, b.doc_name AS document_type_code , c.display_name AS procedure_code
FROM p_workflow a INNER JOIN p_document_type b ON a.p_document_type_id = b.p_document_type_id 
INNER JOIN p_procedure c ON a.p_procedure_id_start = c.p_procedure_id 
WHERE upper(a.doc_name) like upper('%{s_keyword}%')
OR upper(a.display_name) like upper('%{s_keyword}%') 
OR upper(b.doc_name) like upper('%{s_keyword}%') 
ORDER BY a.p_workflow_id">
			<Components>
				<Link id="7" visible="Yes" fieldSourceType="DBColumn" dataType="Text" html="False" hrefType="Page" urlType="Relative" preserveParameters="GET" name="Insert_Link" hrefSource="p_workflow.ccp" removeParameters="p_workflow_id;s_keyword" wizardThemeItem="FooterA" wizardDefaultValue="Add New" wizardUseTemplateBlock="False" PathID="p_workflowGridInsert_Link">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="67" sourceType="Expression" name="FLAG" source="&quot;ADD&quot;"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
				<Link id="11" visible="Yes" fieldSourceType="CodeExpression" html="True" hrefType="Page" urlType="Relative" preserveParameters="GET" name="DLink" wizardCaption="Detail" wizardSize="50" wizardMaxLength="60" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" dataType="Text" wizardDefaultValue="DLink" hrefSource="p_workflow.ccp" wizardThemeItem="GridA" PathID="p_workflowGridDLink" removeParameters="FLAG">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="642" sourceType="DataField" name="p_workflow_id" source="p_workflow_id"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
				<Label id="15" fieldSourceType="DBColumn" dataType="Text" html="False" name="doc_name" fieldSource="doc_name" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="p_workflowGriddoc_name">
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
				<Label id="509" fieldSourceType="DBColumn" dataType="Text" html="False" name="display_name" fieldSource="display_name" wizardCaption="Valid From" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="p_workflowGriddisplay_name">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="510" fieldSourceType="DBColumn" dataType="Text" html="False" name="document_type_code" fieldSource="document_type_code" wizardCaption="Valid From" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="p_workflowGriddocument_type_code">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="542" fieldSourceType="DBColumn" dataType="Text" html="False" name="is_active" fieldSource="is_active" wizardCaption="Valid From" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="p_workflowGridis_active">
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
			</TableParameters>
			<JoinTables>
			</JoinTables>
			<JoinLinks/>
			<Fields>
			</Fields>
			<SPParameters/>
			<SQLParameters>
				<SQLParameter id="697" variable="s_keyword" parameterType="URL" dataType="Text" parameterSource="s_keyword"/>
</SQLParameters>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Grid>
		<Record id="3" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="None" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="p_workflowSearch" wizardCaption="Search P App Role " wizardOrientation="Vertical" wizardFormMethod="post" returnPage="p_workflow.ccp" PathID="p_workflowSearch" pasteActions="pasteActions">
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
		<Record id="94" sourceType="SQL" urlType="Relative" secured="False" allowInsert="True" allowUpdate="True" allowDelete="True" validateData="True" preserveParameters="GET" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" connection="ConnSIKP" name="p_workflowForm" errorSummator="Error" wizardCaption="Add/Edit V P App User " wizardFormMethod="post" PathID="p_workflowForm" activeCollection="USQLParameters" pasteAsReplace="pasteAsReplace" pasteActions="pasteActions" customDeleteType="SQL" parameterTypeListName="ParameterTypeList" customUpdateType="SQL" customInsertType="SQL" customInsert="INSERT INTO p_workflow(p_workflow_id, updated_by, doc_name, updated_date, created_by, creation_date, description, is_active, p_document_type_id, p_procedure_id_start, display_name) 
VALUES(generate_id('sikp','p_workflow','p_workflow_id'), '{updated_by}', '{doc_name}', sysdate, '{created_by}', sysdate, '{description}', '{is_active}', {p_document_type_id}, {p_procedure_id_start}, '{display_name}')" customUpdate="UPDATE p_workflow SET 
updated_by='{updated_by}', 
doc_name='{doc_name}', 
updated_date=sysdate, 
description='{description}', 
is_active='{is_active}', 
p_document_type_id={p_document_type_id}, 
p_procedure_id_start={p_procedure_id_start}, 
display_name='{display_name}'
WHERE p_workflow_id={p_workflow_id}" customDelete="DELETE FROM p_workflow 
WHERE  p_workflow_id = {p_workflow_id}" activeTableType="customDelete" dataSource="SELECT p_workflow_id, a.doc_name, a.display_name, a.p_document_type_id, p_procedure_id_start,
decode(a.is_active,'Y','YA','TIDAK'), a.description, to_char(a.updated_date,'DD-MON-YYYY') AS updated_date, 
a.updated_by, a.created_by,
to_char(a.creation_date,'DD-MON-YYYY') AS creation_date, b.doc_name AS document_type_code , c.display_name AS procedure_code
FROM p_workflow a INNER JOIN p_document_type b ON a.p_document_type_id = b.p_document_type_id 
INNER JOIN p_procedure c ON a.p_procedure_id_start = c.p_procedure_id 
WHERE a.p_workflow_id = {p_workflow_id}">
			<Components>
				<Button id="95" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Insert" operation="Insert" wizardCaption="Add" PathID="p_workflowFormButton_Insert" removeParameters="FLAG">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="96" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Update" operation="Update" wizardCaption="Submit" PathID="p_workflowFormButton_Update" removeParameters="FLAG">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="97" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Delete" operation="Delete" wizardCaption="Delete" PathID="p_workflowFormButton_Delete" removeParameters="FLAG;p_workflow_id;s_keyword;p_workflowGridPage">
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
				<Button id="99" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Cancel" operation="Cancel" wizardCaption="Cancel" PathID="p_workflowFormButton_Cancel" removeParameters="FLAG;p_workflow_id;s_keyword;p_workflowGridPage">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Hidden id="101" fieldSourceType="DBColumn" dataType="Float" name="p_workflow_id" fieldSource="p_workflow_id" caption="Id" wizardCaption="P App User Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_workflowFormp_workflow_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<TextBox id="127" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="updated_by" fieldSource="updated_by" required="False" caption="Updated By" wizardCaption="Updated By" wizardSize="16" wizardMaxLength="16" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_workflowFormupdated_by" defaultValue="CCGetUserLogin()">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Hidden id="165" fieldSourceType="DBColumn" dataType="Text" name="p_workflowGridPage" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="p_workflowFormp_workflowGridPage">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<TextBox id="156" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="doc_name" fieldSource="doc_name" required="True" caption="Nama Workflow" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_workflowFormdoc_name">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="460" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="procedure_code" fieldSource="procedure_code" required="True" caption="Pekerjaan Awal" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_workflowFormprocedure_code">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="125" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="updated_date" fieldSource="updated_date" required="False" caption="Updated Date" wizardCaption="Updated Date" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_workflowFormupdated_date" defaultValue="date(&quot;d-M-Y&quot;)" format="dd-mmm-yyyy">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="40" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="created_by" fieldSource="created_by" required="True" caption="Created By" wizardCaption="Created By" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_workflowFormcreated_by" defaultValue="CCGetUserLogin()">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="38" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="creation_date" fieldSource="creation_date" required="True" caption="Creation Date" wizardCaption="Creation Date" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_workflowFormcreation_date" format="dd-mmm-yyyy" defaultValue="date(&quot;d-M-Y&quot;)">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="37" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="description" fieldSource="description" required="False" caption="Description" wizardCaption="Description" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_workflowFormdescription">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="546" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="document_type_code" fieldSource="document_type_code" required="True" caption="Jenis Dokumen Workflow" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_workflowFormdocument_type_code">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<ListBox id="549" visible="Yes" fieldSourceType="DBColumn" sourceType="ListOfValues" dataType="Text" returnValueType="Number" name="is_active" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" wizardEmptyCaption="Select Value" PathID="p_workflowFormis_active" connection="ConnSIKP" dataSource="Y;AKTIF;N;TIDAK AKTIF" fieldSource="is_active" _valueOfList="N" _nameOfList="TIDAK AKTIF" required="True" caption="Diaktifkan">
					<Components/>
					<Events/>
					<TableParameters/>
					<SPParameters/>
					<SQLParameters/>
					<JoinTables/>
					<JoinLinks/>
					<Fields/>
					<Attributes/>
					<Features/>
				</ListBox>
				<Hidden id="640" fieldSourceType="DBColumn" dataType="Float" name="p_document_type_id" fieldSource="p_document_type_id" caption="p_document_type_id" wizardCaption="P App User Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_workflowFormp_document_type_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="641" fieldSourceType="DBColumn" dataType="Float" name="p_procedure_id_start" fieldSource="p_procedure_id_start" caption="p_procedure_id_start" wizardCaption="P App User Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_workflowFormp_procedure_id_start">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<TextBox id="699" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="display_name" fieldSource="display_name" required="True" caption="Nama Workflow Tercetak" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_workflowFormdisplay_name">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
</Components>
			<Events/>
			<TableParameters>
			</TableParameters>
			<SPParameters/>
			<SQLParameters>
				<SQLParameter id="698" variable="p_workflow_id" parameterType="URL" defaultValue="0" dataType="Float" parameterSource="p_workflow_id"/>
</SQLParameters>
			<JoinTables>
			</JoinTables>
			<JoinLinks/>
			<Fields>
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
				<SQLParameter id="715" variable="updated_by" dataType="Text" parameterType="Expression" parameterSource="CCGetUserLogin()"/>
<SQLParameter id="716" variable="doc_name" dataType="Text" parameterType="Control" parameterSource="doc_name"/>
<SQLParameter id="718" variable="created_by" dataType="Text" parameterType="Expression" parameterSource="CCGetUserLogin()"/>
<SQLParameter id="720" variable="description" dataType="Text" parameterType="Control" parameterSource="description"/>
<SQLParameter id="721" variable="is_active" dataType="Text" parameterType="Control" parameterSource="is_active"/>
<SQLParameter id="722" variable="p_document_type_id" dataType="Float" parameterType="Control" parameterSource="p_document_type_id" defaultValue="0"/>
<SQLParameter id="723" variable="p_procedure_id_start" dataType="Float" parameterType="Control" parameterSource="p_procedure_id_start" defaultValue="0"/>
<SQLParameter id="724" variable="display_name" dataType="Text" parameterType="Control" parameterSource="display_name"/>
</ISQLParameters>
			<IFormElements>
				<CustomParameter id="700" field="p_workflow_id" dataType="Float" parameterType="Control" parameterSource="p_workflow_id"/>
<CustomParameter id="701" field="updated_by" dataType="Text" parameterType="Control" parameterSource="updated_by"/>
<CustomParameter id="702" field="doc_name" dataType="Text" parameterType="Control" parameterSource="doc_name"/>
<CustomParameter id="704" field="updated_date" dataType="Text" parameterType="Control" parameterSource="updated_date" format="dd-mmm-yyyy"/>
<CustomParameter id="705" field="created_by" dataType="Text" parameterType="Control" parameterSource="created_by"/>
<CustomParameter id="706" field="creation_date" dataType="Text" parameterType="Control" parameterSource="creation_date" format="dd-mmm-yyyy"/>
<CustomParameter id="707" field="description" dataType="Text" parameterType="Control" parameterSource="description"/>
<CustomParameter id="709" field="is_active" dataType="Text" parameterType="Control" parameterSource="is_active"/>
<CustomParameter id="711" field="p_document_type_id" dataType="Float" parameterType="Control" parameterSource="p_document_type_id"/>
<CustomParameter id="712" field="p_procedure_id_start" dataType="Float" parameterType="Control" parameterSource="p_procedure_id_start"/>
<CustomParameter id="713" field="display_name" dataType="Text" parameterType="Control" parameterSource="display_name"/>
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
				<SQLParameter id="739" variable="p_workflow_id" dataType="Float" parameterType="Control" parameterSource="p_workflow_id" defaultValue="0"/>
<SQLParameter id="740" variable="updated_by" dataType="Text" parameterType="Expression" parameterSource="CCGetUserLogin()"/>
<SQLParameter id="741" variable="doc_name" dataType="Text" parameterType="Control" parameterSource="doc_name"/>
<SQLParameter id="745" variable="description" dataType="Text" parameterType="Control" parameterSource="description"/>
<SQLParameter id="746" variable="is_active" dataType="Text" parameterType="Control" parameterSource="is_active"/>
<SQLParameter id="747" variable="p_document_type_id" dataType="Float" parameterType="Control" parameterSource="p_document_type_id" defaultValue="0"/>
<SQLParameter id="748" variable="p_procedure_id_start" dataType="Float" parameterType="Control" parameterSource="p_procedure_id_start" defaultValue="0"/>
<SQLParameter id="749" variable="display_name" dataType="Text" parameterType="Control" parameterSource="display_name"/>
</USQLParameters>
			<UConditions>
			</UConditions>
			<UFormElements>
				<CustomParameter id="725" field="p_workflow_id" dataType="Float" parameterType="Control" parameterSource="p_workflow_id"/>
<CustomParameter id="726" field="updated_by" dataType="Text" parameterType="Control" parameterSource="updated_by"/>
<CustomParameter id="727" field="doc_name" dataType="Text" parameterType="Control" parameterSource="doc_name"/>
<CustomParameter id="729" field="updated_date" dataType="Text" parameterType="Control" parameterSource="updated_date" format="dd-mmm-yyyy"/>
<CustomParameter id="730" field="created_by" dataType="Text" parameterType="Control" parameterSource="created_by"/>
<CustomParameter id="731" field="creation_date" dataType="Text" parameterType="Control" parameterSource="creation_date" format="dd-mmm-yyyy"/>
<CustomParameter id="732" field="description" dataType="Text" parameterType="Control" parameterSource="description"/>
<CustomParameter id="734" field="is_active" dataType="Text" parameterType="Control" parameterSource="is_active"/>
<CustomParameter id="736" field="p_document_type_id" dataType="Float" parameterType="Control" parameterSource="p_document_type_id"/>
<CustomParameter id="737" field="p_procedure_id_start" dataType="Float" parameterType="Control" parameterSource="p_procedure_id_start"/>
<CustomParameter id="738" field="display_name" dataType="Text" parameterType="Control" parameterSource="display_name"/>
</UFormElements>
			<DSPParameters/>
			<DSQLParameters>
				<SQLParameter id="696" variable="p_workflow_id" parameterType="Control" dataType="Float" parameterSource="p_workflow_id" defaultValue="0"/>
			</DSQLParameters>
			<DConditions>
				<TableParameter id="695" conditionType="Parameter" useIsNull="False" field="p_workflow_id" dataType="Float" searchConditionType="Equal" parameterType="Control" logicOperator="And" parameterSource="p_workflow_id"/>
			</DConditions>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Record>
	</Components>
	<CodeFiles>
		<CodeFile id="Events" language="PHPTemplates" name="p_workflow_events.php" forShow="False" comment="//" codePage="windows-1252"/>
		<CodeFile id="Code" language="PHPTemplates" name="p_workflow.php" forShow="True" url="p_workflow.php" comment="//" codePage="windows-1252"/>
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
