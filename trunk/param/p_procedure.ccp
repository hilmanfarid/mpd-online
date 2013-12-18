<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\param" secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="RWNet" wizardThemeVersion="3.0" needGeneration="0">
	<Components>
		<Grid id="2" secured="False" sourceType="Table" returnValueType="Number" defaultPageSize="5" connection="ConnSIKP" name="p_procedureGrid" pageSizeLimit="100" wizardCaption="List of P App Role " wizardGridType="Tabular" wizardAllowInsert="True" wizardAltRecord="True" wizardAltRecordType="Style" wizardRecordSeparator="False" wizardNoRecords="-" pasteAsReplace="pasteAsReplace" pasteActions="pasteActions" activeCollection="TableParameters" parameterTypeListName="ParameterTypeList" orderBy="p_procedure_id" dataSource="p_procedure">
			<Components>
				<Link id="7" visible="Yes" fieldSourceType="DBColumn" dataType="Text" html="False" hrefType="Page" urlType="Relative" preserveParameters="GET" name="Insert_Link" hrefSource="p_procedure.ccp" removeParameters="p_procedure_id;s_keyword" wizardThemeItem="FooterA" wizardDefaultValue="Add New" wizardUseTemplateBlock="False" PathID="p_procedureGridInsert_Link">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="67" sourceType="Expression" name="FLAG" source="&quot;ADD&quot;"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
				<Link id="11" visible="Yes" fieldSourceType="CodeExpression" html="True" hrefType="Page" urlType="Relative" preserveParameters="GET" name="DLink" wizardCaption="Detail" wizardSize="50" wizardMaxLength="60" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" dataType="Text" wizardDefaultValue="DLink" hrefSource="p_procedure.ccp" wizardThemeItem="GridA" PathID="p_procedureGridDLink" removeParameters="FLAG">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="541" sourceType="DataField" name="p_procedure_id" source="p_procedure_id"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
				<Navigator id="22" size="10" type="Centered" pageSizes="1;5;10;25;50" name="Navigator" wizardPagingType="Custom" wizardFirst="True" wizardFirstText="First" wizardPrev="True" wizardPrevText="Prev" wizardNext="True" wizardNextText="Next" wizardLast="True" wizardLastText="Last" wizardImages="Images" wizardPageNumbers="Centered" wizardSize="10" wizardTotalPages="False" wizardHideDisabled="False" wizardOfText="of" wizardPageSize="False" wizardUsePageScroller="True">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Navigator>
				<Label id="332" fieldSourceType="DBColumn" dataType="Text" html="False" name="proc_name" fieldSource="proc_name" wizardCaption="Valid From" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="p_procedureGridproc_name">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="509" fieldSourceType="DBColumn" dataType="Text" html="False" name="is_active" fieldSource="is_active" wizardCaption="Valid From" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="p_procedureGridis_active">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="539" fieldSourceType="DBColumn" dataType="Text" html="False" name="display_name" fieldSource="display_name" wizardCaption="Valid From" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="p_procedureGriddisplay_name">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Hidden id="13" fieldSourceType="DBColumn" dataType="Float" html="False" name="p_procedure_id" fieldSource="p_procedure_id" wizardCaption="Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="p_procedureGridp_procedure_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<ImageLink id="199" visible="Yes" fieldSourceType="DBColumn" dataType="Text" hrefType="Page" urlType="Relative" preserveParameters="GET" name="ImageLink1" PathID="p_procedureGridImageLink1" hrefSource="p_procedure_files.ccp" removeParameters="s_keyword">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="200" sourceType="DataField" format="yyyy-mm-dd" name="p_procedure_id" source="p_procedure_id"/>
						<LinkParameter id="201" sourceType="DataField" name="proc_code" source="display_name"/>
						<LinkParameter id="679" sourceType="URL" name="p_procedureGridPage" source="p_procedureGridPage"/>
<LinkParameter id="680" sourceType="URL" name="proc_s_keyword" source="s_keyword"/>
</LinkParameters>
					<Attributes/>
					<Features/>
				</ImageLink>
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
				<TableParameter id="600" conditionType="Parameter" useIsNull="False" field="upper(proc_name)" dataType="Text" searchConditionType="Contains" parameterType="URL" logicOperator="Or" parameterSource="s_keyword"/>
				<TableParameter id="601" conditionType="Parameter" useIsNull="False" field="upper(display_name)" dataType="Text" searchConditionType="Contains" parameterType="URL" logicOperator="And" parameterSource="s_keyword"/>
			</TableParameters>
			<JoinTables>
				<JoinTable id="618" tableName="p_procedure" posLeft="10" posTop="10" posWidth="121" posHeight="180"/>
			</JoinTables>
			<JoinLinks/>
			<Fields>
				<Field id="667" tableName="p_procedure" fieldName="p_procedure_id"/>
				<Field id="668" tableName="p_procedure" fieldName="proc_name"/>
				<Field id="669" tableName="p_procedure" fieldName="display_name"/>
				<Field id="670" tableName="p_procedure" fieldName="seqno"/>
				<Field id="671" tableName="p_procedure" fieldName="f_after"/>
				<Field id="672" tableName="p_procedure" fieldName="f_before"/>
				<Field id="673" tableName="p_procedure" fieldName="description"/>
				<Field id="674" fieldName="decode(is_active,'Y','YA','TIDAK')" alias="is_active" isExpression="True"/>
				<Field id="675" tableName="p_procedure" fieldName="updated_date"/>
				<Field id="676" tableName="p_procedure" fieldName="updated_by"/>
				<Field id="677" tableName="p_procedure" fieldName="created_by"/>
				<Field id="678" tableName="p_procedure" fieldName="creation_date"/>
			</Fields>
			<SPParameters/>
			<SQLParameters>
			</SQLParameters>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Grid>
		<Record id="3" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="None" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="p_procedureSearch" wizardCaption="Search P App Role " wizardOrientation="Vertical" wizardFormMethod="post" returnPage="p_procedure.ccp" PathID="p_procedureSearch" pasteActions="pasteActions">
			<Components>
				<Button id="4" urlType="Relative" enableValidation="True" isDefault="False" name="Button_DoSearch" operation="Search" wizardCaption="Search" PathID="p_procedureSearchButton_DoSearch">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<TextBox id="5" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="s_keyword" wizardCaption="Keyword" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" PathID="p_procedureSearchs_keyword">
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
		<Record id="94" sourceType="SQL" urlType="Relative" secured="False" allowInsert="True" allowUpdate="True" allowDelete="True" validateData="True" preserveParameters="GET" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" connection="ConnSIKP" name="p_procedureForm" errorSummator="Error" wizardCaption="Add/Edit V P App User " wizardFormMethod="post" PathID="p_procedureForm" activeCollection="USQLParameters" pasteAsReplace="pasteAsReplace" pasteActions="pasteActions" customDeleteType="SQL" parameterTypeListName="ParameterTypeList" customUpdateType="SQL" customInsertType="SQL" customInsert="INSERT INTO p_procedure(p_procedure_id, updated_by, proc_name, display_name, f_before, f_after, description, is_active, updated_date, created_by, creation_date, seqno) 
VALUES(generate_id('sikp','p_procedure','p_procedure_id'), '{updated_by}', '{proc_name}', '{display_name}', '{f_before}', '{f_after}', '{description}', '{is_active}', sysdate, '{created_by}', sysdate, {seqno})" customUpdate="UPDATE p_procedure SET 
updated_by='{updated_by}', 
proc_name='{proc_name}', 
display_name='{display_name}', 
f_before='{f_before}', 
f_after='{f_after}', 
description='{description}', 
is_active='{is_active}', 
updated_date=sysdate,  
seqno={seqno}
WHERE p_procedure_id = {p_procedure_id}" customDelete="DELETE FROM p_procedure 
WHERE  p_procedure_id = {p_procedure_id}" dataSource="SELECT p_procedure_id, proc_name, display_name, seqno, f_after, f_before, description, is_active, 
to_char(updated_date,'DD-MON-YYY')as updated_date, updated_by, created_by, to_char(creation_date,'DD-MON-YYYY')as creation_date 
FROM p_procedure
WHERE p_procedure_id = {p_procedure_id} " orderBy="seqno">
			<Components>
				<Button id="95" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Insert" operation="Insert" wizardCaption="Add" PathID="p_procedureFormButton_Insert" removeParameters="FLAG">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="96" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Update" operation="Update" wizardCaption="Submit" PathID="p_procedureFormButton_Update" removeParameters="FLAG">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="97" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Delete" operation="Delete" wizardCaption="Delete" PathID="p_procedureFormButton_Delete" removeParameters="FLAG;p_procedure_id;s_keyword;p_procedureGridPage">
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
				<Button id="99" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Cancel" operation="Cancel" wizardCaption="Cancel" PathID="p_procedureFormButton_Cancel" removeParameters="FLAG;p_procedure_id;s_keyword;p_procedureGridPage">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<TextBox id="127" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="updated_by" fieldSource="updated_by" required="False" caption="Updated By" wizardCaption="Updated By" wizardSize="16" wizardMaxLength="16" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_procedureFormupdated_by" defaultValue="CCGetUserLogin()">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Hidden id="165" fieldSourceType="DBColumn" dataType="Text" name="p_procedureGridPage" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="p_procedureFormp_procedureGridPage">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<TextBox id="156" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="proc_name" fieldSource="proc_name" required="True" caption="Pekerjaan" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_procedureFormproc_name">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="460" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="display_name" fieldSource="display_name" required="True" caption="Nama Pekerjaan" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_procedureFormdisplay_name">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="546" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="f_before" fieldSource="f_before" required="False" caption="Fungsi Sebelum Submit" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_procedureFormf_before">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="547" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="f_after" fieldSource="f_after" required="False" caption="Fungsi Setelah Submit" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_procedureFormf_after">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="548" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="description" fieldSource="description" required="False" caption="Deskripsi" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_procedureFormdescription">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<ListBox id="551" visible="Yes" fieldSourceType="DBColumn" sourceType="ListOfValues" dataType="Text" returnValueType="Number" name="is_active" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" wizardEmptyCaption="Select Value" PathID="p_procedureFormis_active" connection="ConnSIKP" fieldSource="is_active" dataSource="Y;YA;N;TIDAK" required="True" _valueOfList="N" _nameOfList="TIDAK" caption="Diaktifkan ?">
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
				<Hidden id="552" fieldSourceType="DBColumn" dataType="Float" name="p_procedure_id" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="p_procedureFormp_procedure_id" fieldSource="p_procedure_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<TextBox id="125" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="updated_date" fieldSource="updated_date" required="False" caption="Updated Date" wizardCaption="Updated Date" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_procedureFormupdated_date" defaultValue="date(&quot;d-M-Y&quot;)" format="dd-mmm-yyyy">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="40" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="created_by" fieldSource="created_by" required="True" caption="Created By" wizardCaption="Created By" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_procedureFormcreated_by" defaultValue="CCGetUserLogin()">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="38" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="creation_date" fieldSource="creation_date" required="True" caption="Creation Date" wizardCaption="Creation Date" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_procedureFormcreation_date" format="dd-mmm-yyyy" defaultValue="date(&quot;d-M-Y&quot;)">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="617" visible="Yes" fieldSourceType="DBColumn" dataType="Float" name="seqno" fieldSource="seqno" required="True" caption="Nomor Urut Pekerjaan" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_procedureFormseqno">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
			</Components>
			<Events/>
			<TableParameters>
				<TableParameter id="615" conditionType="Parameter" useIsNull="False" field="p_procedure_id" dataType="Float" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="p_procedure_id"/>
			</TableParameters>
			<SPParameters/>
			<SQLParameters>
				<SQLParameter id="616" parameterType="URL" variable="p_procedure_id" dataType="Float" parameterSource="p_procedure_id"/>
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
				<SQLParameter id="631" variable="updated_by" dataType="Text" parameterType="Expression" parameterSource="CCGetUserLogin()"/>
				<SQLParameter id="632" variable="proc_name" dataType="Text" parameterType="Control" parameterSource="proc_name"/>
				<SQLParameter id="633" variable="display_name" dataType="Text" parameterType="Control" parameterSource="display_name"/>
				<SQLParameter id="634" variable="f_before" dataType="Text" parameterType="Control" parameterSource="f_before"/>
				<SQLParameter id="635" variable="f_after" dataType="Text" parameterType="Control" parameterSource="f_after"/>
				<SQLParameter id="636" variable="description" dataType="Text" parameterType="Control" parameterSource="description"/>
				<SQLParameter id="637" variable="is_active" dataType="Text" parameterType="Control" parameterSource="is_active"/>
				<SQLParameter id="640" variable="created_by" dataType="Text" parameterType="Expression" parameterSource="CCGetUserLogin()"/>
				<SQLParameter id="642" variable="seqno" dataType="Float" parameterType="Control" parameterSource="seqno" defaultValue="0"/>
			</ISQLParameters>
			<IFormElements>
				<CustomParameter id="619" field="updated_by" dataType="Text" parameterType="Control" parameterSource="updated_by"/>
				<CustomParameter id="620" field="proc_name" dataType="Text" parameterType="Control" parameterSource="proc_name"/>
				<CustomParameter id="621" field="display_name" dataType="Text" parameterType="Control" parameterSource="display_name"/>
				<CustomParameter id="622" field="f_before" dataType="Text" parameterType="Control" parameterSource="f_before"/>
				<CustomParameter id="623" field="f_after" dataType="Text" parameterType="Control" parameterSource="f_after"/>
				<CustomParameter id="624" field="description" dataType="Text" parameterType="Control" parameterSource="description"/>
				<CustomParameter id="625" field="is_active" dataType="Float" parameterType="Control" parameterSource="is_active"/>
				<CustomParameter id="626" field="p_procedure_id" dataType="Float" parameterType="Control" parameterSource="p_procedure_id"/>
				<CustomParameter id="627" field="updated_date" dataType="Text" parameterType="Control" parameterSource="updated_date" format="dd-mmm-yyyy"/>
				<CustomParameter id="628" field="created_by" dataType="Text" parameterType="Control" parameterSource="created_by"/>
				<CustomParameter id="629" field="creation_date" dataType="Text" parameterType="Control" parameterSource="creation_date" format="dd-mmm-yyyy"/>
				<CustomParameter id="630" field="seqno" dataType="Text" parameterType="Control" parameterSource="seqno"/>
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
				<SQLParameter id="655" variable="updated_by" dataType="Text" parameterType="Expression" parameterSource="CCGetUserLogin()"/>
				<SQLParameter id="656" variable="proc_name" dataType="Text" parameterType="Control" parameterSource="proc_name"/>
				<SQLParameter id="657" variable="display_name" dataType="Text" parameterType="Control" parameterSource="display_name"/>
				<SQLParameter id="658" variable="f_before" dataType="Text" parameterType="Control" parameterSource="f_before"/>
				<SQLParameter id="659" variable="f_after" dataType="Text" parameterType="Control" parameterSource="f_after"/>
				<SQLParameter id="660" variable="description" dataType="Text" parameterType="Control" parameterSource="description"/>
				<SQLParameter id="661" variable="is_active" dataType="Text" parameterType="Control" parameterSource="is_active"/>
				<SQLParameter id="662" variable="p_procedure_id" dataType="Float" parameterType="Control" parameterSource="p_procedure_id" defaultValue="0"/>
				<SQLParameter id="666" variable="seqno" dataType="Float" parameterType="Control" parameterSource="seqno" defaultValue="0"/>
			</USQLParameters>
			<UConditions>
			</UConditions>
			<UFormElements>
				<CustomParameter id="643" field="updated_by" dataType="Text" parameterType="Control" parameterSource="updated_by"/>
				<CustomParameter id="644" field="proc_name" dataType="Text" parameterType="Control" parameterSource="proc_name"/>
				<CustomParameter id="645" field="display_name" dataType="Text" parameterType="Control" parameterSource="display_name"/>
				<CustomParameter id="646" field="f_before" dataType="Text" parameterType="Control" parameterSource="f_before"/>
				<CustomParameter id="647" field="f_after" dataType="Text" parameterType="Control" parameterSource="f_after"/>
				<CustomParameter id="648" field="description" dataType="Text" parameterType="Control" parameterSource="description"/>
				<CustomParameter id="649" field="is_active" dataType="Text" parameterType="Control" parameterSource="is_active"/>
				<CustomParameter id="650" field="p_procedure_id" dataType="Float" parameterType="Control" parameterSource="p_procedure_id"/>
				<CustomParameter id="651" field="updated_date" dataType="Text" parameterType="Control" parameterSource="updated_date" format="dd-mmm-yyyy"/>
				<CustomParameter id="652" field="created_by" dataType="Text" parameterType="Control" parameterSource="created_by"/>
				<CustomParameter id="653" field="creation_date" dataType="Text" parameterType="Control" parameterSource="creation_date" format="dd-mmm-yyyy"/>
				<CustomParameter id="654" field="seqno" dataType="Float" parameterType="Control" parameterSource="seqno"/>
			</UFormElements>
			<DSPParameters/>
			<DSQLParameters>
				<SQLParameter id="598" variable="p_procedure_id" parameterType="Control" dataType="Float" parameterSource="p_procedure_id" defaultValue="0"/>
			</DSQLParameters>
			<DConditions>
				<TableParameter id="597" conditionType="Parameter" useIsNull="False" field="p_procedure_id" dataType="Float" searchConditionType="Equal" parameterType="Control" logicOperator="And" parameterSource="p_procedure_id"/>
			</DConditions>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Record>
	</Components>
	<CodeFiles>
		<CodeFile id="Events" language="PHPTemplates" name="p_procedure_events.php" forShow="False" comment="//" codePage="windows-1252"/>
		<CodeFile id="Code" language="PHPTemplates" name="p_procedure.php" forShow="True" url="p_procedure.php" comment="//" codePage="windows-1252"/>
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
