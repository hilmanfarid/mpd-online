<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\param" secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="RWNet" wizardThemeVersion="3.0" needGeneration="0">
	<Components>
		<Record id="94" sourceType="Table" urlType="Relative" secured="False" allowInsert="True" allowUpdate="True" allowDelete="True" validateData="True" preserveParameters="GET" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" connection="ConnSIKP" name="p_workflowForm" errorSummator="Error" wizardCaption="Add/Edit V P App User " wizardFormMethod="post" PathID="p_workflowForm" activeCollection="DConditions" pasteAsReplace="pasteAsReplace" pasteActions="pasteActions" customDeleteType="SQL" parameterTypeListName="ParameterTypeList" customUpdateType="SQL" customInsertType="SQL" dataSource="v_p_workflow" customInsert="INSERT INTO p_workflow(p_workflow_id, updated_by, code, updated_date, created_by, creation_date, description, is_active, workflow_type, p_document_type_id, p_procedure_id) 
VALUES(generate_id('sikp','p_workflow','p_workflow_id'), '{updated_by}', '{code}', sysdate, '{created_by}', sysdate, '{description}', '{is_active}', {workflow_type}, {p_document_type_id}, {p_procedure_id})" customUpdate="UPDATE p_workflow SET  
updated_by='{updated_by}', 
code='{code}', 
updated_date=sysdate, 
description='{description}', 
is_active='{is_active}', 
workflow_type={workflow_type}, 
p_document_type_id={p_document_type_id}, 
p_procedure_id={p_procedure_id}
WHERE p_workflow_id={p_workflow_id}" customDelete="DELETE FROM p_workflow 
WHERE  p_workflow_id = {p_workflow_id}" activeTableType="customDelete">
			<Components>
				<Button id="95" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Insert" operation="Insert" wizardCaption="Add" PathID="p_workflowFormButton_Insert" removeParameters="FLAG" returnPage="p_wf_procedure.ccp">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="96" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Update" operation="Update" wizardCaption="Submit" PathID="p_workflowFormButton_Update" removeParameters="FLAG" returnPage="p_wf_procedure.ccp">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="97" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Delete" operation="Delete" wizardCaption="Delete" PathID="p_workflowFormButton_Delete" removeParameters="FLAG;p_workflow_id;s_keyword;p_workflowGridPage" returnPage="p_wf_procedure.ccp">
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
				<Button id="99" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Cancel" operation="Cancel" wizardCaption="Cancel" PathID="p_workflowFormButton_Cancel" removeParameters="FLAG;p_workflow_id;s_keyword;p_workflowGridPage" returnPage="p_wf_procedure.ccp">
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
				<TextBox id="156" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="code" fieldSource="code" required="True" caption="Kode" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_workflowFormcode">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="460" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="cproc" fieldSource="cproc" required="True" caption="Prosedur" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_workflowFormcproc">
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
				<TextBox id="546" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="document_name" fieldSource="document_name" required="False" caption="Tipe Dokumen" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_workflowFormdocument_name">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<ListBox id="549" visible="Yes" fieldSourceType="DBColumn" sourceType="ListOfValues" dataType="Text" returnValueType="Number" name="is_active" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" wizardEmptyCaption="Select Value" PathID="p_workflowFormis_active" connection="ConnSIKP" dataSource="Y;AKTIF;N;TIDAK AKTIF" fieldSource="is_active" _valueOfList="N" _nameOfList="TIDAK AKTIF" required="True" caption="Status">
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
				<ListBox id="639" visible="Yes" fieldSourceType="DBColumn" sourceType="ListOfValues" dataType="Float" returnValueType="Number" name="workflow_type" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" wizardEmptyCaption="Select Value" PathID="p_workflowFormworkflow_type" connection="ConnSIKP" dataSource="1;PROCUREMENT &amp; INVENTORY;2;NETWORK" fieldSource="workflow_type" _valueOfList="2" _nameOfList="NETWORK" required="True" caption="Kategori">
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
				<Hidden id="641" fieldSourceType="DBColumn" dataType="Float" name="p_procedure_id" fieldSource="p_procedure_id" caption="p_procedure_id" wizardCaption="P App User Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_workflowFormp_procedure_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
			</Components>
			<Events/>
			<TableParameters>
				<TableParameter id="638" conditionType="Parameter" useIsNull="False" field="p_workflow_id" dataType="Float" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="p_workflow_id"/>
			</TableParameters>
			<SPParameters/>
			<SQLParameters>
			</SQLParameters>
			<JoinTables>
				<JoinTable id="637" tableName="v_p_workflow" posLeft="10" posTop="10" posWidth="155" posHeight="180"/>
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
				<SQLParameter id="657" variable="updated_by" dataType="Text" parameterType="Expression" parameterSource="CCGetUserLogin()"/>
				<SQLParameter id="658" variable="code" dataType="Text" parameterType="Control" parameterSource="code"/>
				<SQLParameter id="661" variable="created_by" dataType="Text" parameterType="Expression" parameterSource="CCGetUserLogin()"/>
				<SQLParameter id="663" variable="description" dataType="Text" parameterType="Control" parameterSource="description"/>
				<SQLParameter id="665" variable="is_active" dataType="Text" parameterType="Control" parameterSource="is_active"/>
				<SQLParameter id="666" variable="workflow_type" dataType="Float" parameterType="Control" parameterSource="workflow_type" defaultValue="0"/>
				<SQLParameter id="667" variable="p_document_type_id" dataType="Float" parameterType="Control" parameterSource="p_document_type_id"/>
				<SQLParameter id="668" variable="p_procedure_id" dataType="Float" parameterType="Control" parameterSource="p_procedure_id"/>
			</ISQLParameters>
			<IFormElements>
				<CustomParameter id="643" field="p_workflow_id" dataType="Float" parameterType="Control" parameterSource="p_workflow_id"/>
				<CustomParameter id="644" field="updated_by" dataType="Text" parameterType="Control" parameterSource="updated_by"/>
				<CustomParameter id="645" field="code" dataType="Text" parameterType="Control" parameterSource="code"/>
				<CustomParameter id="646" field="cproc" dataType="Text" parameterType="Control" parameterSource="cproc"/>
				<CustomParameter id="647" field="updated_date" dataType="Text" parameterType="Control" parameterSource="updated_date" format="dd-mmm-yyyy"/>
				<CustomParameter id="648" field="created_by" dataType="Text" parameterType="Control" parameterSource="created_by"/>
				<CustomParameter id="649" field="creation_date" dataType="Text" parameterType="Control" parameterSource="creation_date" format="dd-mmm-yyyy"/>
				<CustomParameter id="650" field="description" dataType="Text" parameterType="Control" parameterSource="description"/>
				<CustomParameter id="651" field="document_name" dataType="Text" parameterType="Control" parameterSource="document_name"/>
				<CustomParameter id="652" field="is_active" dataType="Text" parameterType="Control" parameterSource="is_active"/>
				<CustomParameter id="653" field="workflow_type" dataType="Text" parameterType="Control" parameterSource="workflow_type"/>
				<CustomParameter id="654" field="p_document_type_id" dataType="Float" parameterType="Control" parameterSource="p_document_type_id"/>
				<CustomParameter id="655" field="p_procedure_id" dataType="Float" parameterType="Control" parameterSource="p_procedure_id"/>
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
				<SQLParameter id="682" variable="p_workflow_id" dataType="Float" parameterType="Control" parameterSource="p_workflow_id"/>
				<SQLParameter id="683" variable="updated_by" dataType="Text" parameterType="Expression" parameterSource="CCGetUserLogin()"/>
				<SQLParameter id="684" variable="code" dataType="Text" parameterType="Control" parameterSource="code"/>
				<SQLParameter id="689" variable="description" dataType="Text" parameterType="Control" parameterSource="description"/>
				<SQLParameter id="691" variable="is_active" dataType="Text" parameterType="Control" parameterSource="is_active"/>
				<SQLParameter id="692" variable="workflow_type" dataType="Float" parameterType="Control" parameterSource="workflow_type"/>
				<SQLParameter id="693" variable="p_document_type_id" dataType="Float" parameterType="Control" parameterSource="p_document_type_id"/>
				<SQLParameter id="694" variable="p_procedure_id" dataType="Float" parameterType="Control" parameterSource="p_procedure_id"/>
			</USQLParameters>
			<UConditions>
			</UConditions>
			<UFormElements>
				<CustomParameter id="669" field="p_workflow_id" dataType="Float" parameterType="Control" parameterSource="p_workflow_id"/>
				<CustomParameter id="670" field="updated_by" dataType="Text" parameterType="Control" parameterSource="updated_by"/>
				<CustomParameter id="671" field="code" dataType="Text" parameterType="Control" parameterSource="code"/>
				<CustomParameter id="672" field="cproc" dataType="Text" parameterType="Control" parameterSource="cproc"/>
				<CustomParameter id="673" field="updated_date" dataType="Text" parameterType="Control" parameterSource="updated_date" format="dd-mmm-yyyy"/>
				<CustomParameter id="674" field="created_by" dataType="Text" parameterType="Control" parameterSource="created_by"/>
				<CustomParameter id="675" field="creation_date" dataType="Text" parameterType="Control" parameterSource="creation_date" format="dd-mmm-yyyy"/>
				<CustomParameter id="676" field="description" dataType="Text" parameterType="Control" parameterSource="description"/>
				<CustomParameter id="677" field="document_name" dataType="Text" parameterType="Control" parameterSource="document_name"/>
				<CustomParameter id="678" field="is_active" dataType="Text" parameterType="Control" parameterSource="is_active"/>
				<CustomParameter id="679" field="workflow_type" dataType="Float" parameterType="Control" parameterSource="workflow_type"/>
				<CustomParameter id="680" field="p_document_type_id" dataType="Float" parameterType="Control" parameterSource="p_document_type_id"/>
				<CustomParameter id="681" field="p_procedure_id" dataType="Float" parameterType="Control" parameterSource="p_procedure_id"/>
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
		<CodeFile id="Events" language="PHPTemplates" name="p_workflow_list_events.php" forShow="False" comment="//" codePage="windows-1252"/>
		<CodeFile id="Code" language="PHPTemplates" name="p_workflow_list.php" forShow="True" url="p_workflow_list.php" comment="//" codePage="windows-1252"/>
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
