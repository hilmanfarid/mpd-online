<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\param" secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="RWNet" wizardThemeVersion="3.0" needGeneration="0">
	<Components>
		<Grid id="2" secured="False" sourceType="Table" returnValueType="Number" defaultPageSize="5" connection="ConnSIKP" name="p_document_typeGrid" pageSizeLimit="100" wizardCaption="List of P App Role " wizardGridType="Tabular" wizardAllowInsert="True" wizardAltRecord="True" wizardAltRecordType="Style" wizardRecordSeparator="False" wizardNoRecords="-" pasteAsReplace="pasteAsReplace" pasteActions="pasteActions" activeCollection="TableParameters" parameterTypeListName="ParameterTypeList" orderBy="p_document_type_id" dataSource="p_document_type">
			<Components>
				<Link id="7" visible="Yes" fieldSourceType="DBColumn" dataType="Text" html="False" hrefType="Page" urlType="Relative" preserveParameters="GET" name="Insert_Link" hrefSource="p_document_type.ccp" removeParameters="p_document_type_id;s_keyword" wizardThemeItem="FooterA" wizardDefaultValue="Add New" wizardUseTemplateBlock="False" PathID="p_document_typeGridInsert_Link">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="67" sourceType="Expression" name="FLAG" source="&quot;ADD&quot;"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
				<Link id="11" visible="Yes" fieldSourceType="CodeExpression" html="True" hrefType="Page" urlType="Relative" preserveParameters="GET" name="DLink" wizardCaption="Detail" wizardSize="50" wizardMaxLength="60" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" dataType="Text" wizardDefaultValue="DLink" hrefSource="p_document_type.ccp" wizardThemeItem="GridA" PathID="p_document_typeGridDLink" removeParameters="FLAG">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="541" sourceType="DataField" name="p_document_type_id" source="p_document_type_id"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
				<Label id="15" fieldSourceType="DBColumn" dataType="Text" html="False" name="display_name" fieldSource="display_name" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="p_document_typeGriddisplay_name">
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
				<Hidden id="13" fieldSourceType="DBColumn" dataType="Float" html="False" name="p_document_type_id" fieldSource="p_document_type_id" wizardCaption="Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="p_document_typeGridp_document_type_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Label id="509" fieldSourceType="DBColumn" dataType="Text" html="False" name="tdoc" fieldSource="tdoc" wizardCaption="Valid From" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="p_document_typeGridtdoc">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="510" fieldSourceType="DBColumn" dataType="Text" html="False" name="tctl" fieldSource="tctl" wizardCaption="Valid From" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="p_document_typeGridtctl">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="542" fieldSourceType="DBColumn" dataType="Text" html="False" name="package_name" fieldSource="package_name" wizardCaption="Valid From" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="p_document_typeGridpackage_name">
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
				<TableParameter id="507" conditionType="Parameter" useIsNull="False" field="upper(document_name)" dataType="Text" searchConditionType="Contains" parameterType="URL" logicOperator="Or" leftBrackets="1" parameterSource="s_keyword"/>
				<TableParameter id="508" conditionType="Parameter" useIsNull="False" field="upper(description)" dataType="Text" searchConditionType="Contains" parameterType="URL" logicOperator="And" rightBrackets="1" parameterSource="s_keyword"/>
			</TableParameters>
			<JoinTables>
				<JoinTable id="540" tableName="p_document_type" posLeft="10" posTop="10" posWidth="155" posHeight="180"/>
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
		<Record id="3" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="None" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="p_document_typeSearch" wizardCaption="Search P App Role " wizardOrientation="Vertical" wizardFormMethod="post" returnPage="p_document_type.ccp" PathID="p_document_typeSearch" pasteActions="pasteActions">
			<Components>
				<Button id="4" urlType="Relative" enableValidation="True" isDefault="False" name="Button_DoSearch" operation="Search" wizardCaption="Search" PathID="p_document_typeSearchButton_DoSearch">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<TextBox id="5" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="s_keyword" wizardCaption="Keyword" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" PathID="p_document_typeSearchs_keyword">
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
		<Record id="94" sourceType="SQL" urlType="Relative" secured="False" allowInsert="True" allowUpdate="True" allowDelete="True" validateData="True" preserveParameters="GET" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" connection="ConnSIKP" name="p_document_typeForm" errorSummator="Error" wizardCaption="Add/Edit V P App User " wizardFormMethod="post" PathID="p_document_typeForm" activeCollection="USQLParameters" pasteAsReplace="pasteAsReplace" pasteActions="pasteActions" customDeleteType="SQL" parameterTypeListName="ParameterTypeList" customUpdateType="SQL" customInsertType="SQL" dataSource="SELECT p_document_type_id, doc_name, display_name, owner, tdoc, tctl, tuser, package_name, f_profile, profile_source, description,
listing_no, f_app_fraud_engine, to_char(creation_date,'DD-MON-YYYY')as creation_date, created_by,  to_char(updated_date,'DD-MON-YYYY')as updated_date, updated_by
FROM p_document_type
WHERE p_document_type_id = {p_document_type_id}   " customInsert="INSERT INTO p_document_type(p_document_type_id, updated_by, display_name, tctl, updated_date, created_by, creation_date, description, tuser, package_name, f_profile, tdoc, profile_source, f_app_fraud_engine, doc_name, listing_no, owner) 
VALUES(generate_id('sikp','p_document_type','p_document_type_id'), '{updated_by}', '{display_name}', '{tctl}', sysdate, '{created_by}', sysdate, '{description}', '{tuser}', '{package_name}', '{f_profile}', '{tdoc}', '{profile_source}', '{f_app_fraud_engine}', '{doc_name}', {listing_no}, 'SIKP')" customUpdate="UPDATE p_document_type SET 
updated_by='{updated_by}', 
display_name='{display_name}', 
tctl='{tctl}', 
updated_date=sysdate, 
description='{description}', 
tuser='{tuser}', 
package_name='{package_name}', 
f_profile='{f_profile}', 
tdoc='{tdoc}', 
profile_source='{profile_source}', 
f_app_fraud_engine='{f_app_fraud_engine}', 
doc_name='{doc_name}', 
listing_no={listing_no}
WHERE p_document_type_id={p_document_type_id}" customDelete="DELETE FROM p_document_type
WHERE  p_document_type_id = {p_document_type_id}">
			<Components>
				<Button id="95" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Insert" operation="Insert" wizardCaption="Add" PathID="p_document_typeFormButton_Insert" removeParameters="FLAG">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="96" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Update" operation="Update" wizardCaption="Submit" PathID="p_document_typeFormButton_Update" removeParameters="FLAG">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="97" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Delete" operation="Delete" wizardCaption="Delete" PathID="p_document_typeFormButton_Delete" removeParameters="FLAG;p_document_type_id;s_keyword;p_document_typeGridPage">
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
				<Button id="99" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Cancel" operation="Cancel" wizardCaption="Cancel" PathID="p_document_typeFormButton_Cancel" removeParameters="FLAG;p_document_type_id;s_keyword;p_document_typeGridPage">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Hidden id="101" fieldSourceType="DBColumn" dataType="Float" name="p_document_type_id" fieldSource="p_document_type_id" caption="Id" wizardCaption="P App User Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_document_typeFormp_document_type_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<TextBox id="127" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="updated_by" fieldSource="updated_by" required="False" caption="Updated By" wizardCaption="Updated By" wizardSize="16" wizardMaxLength="16" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_document_typeFormupdated_by" defaultValue="CCGetUserLogin()">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Hidden id="165" fieldSourceType="DBColumn" dataType="Text" name="p_document_typeGridPage" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="p_document_typeFormp_document_typeGridPage">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<TextBox id="156" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="display_name" fieldSource="display_name" required="True" caption="Nama Dokumen Tercetak" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_document_typeFormdisplay_name">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="460" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="tctl" fieldSource="tctl" required="True" caption="Nama Tabel Kontrol Inbox" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_document_typeFormtctl">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="125" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="updated_date" fieldSource="updated_date" required="False" caption="Updated Date" wizardCaption="Updated Date" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_document_typeFormupdated_date" defaultValue="date(&quot;d-M-Y&quot;)" format="dd-mmm-yyyy">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="40" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="created_by" fieldSource="created_by" required="True" caption="Created By" wizardCaption="Created By" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_document_typeFormcreated_by" defaultValue="CCGetUserLogin()">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="38" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="creation_date" fieldSource="creation_date" required="True" caption="Creation Date" wizardCaption="Creation Date" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_document_typeFormcreation_date" format="dd-mmm-yyyy" defaultValue="date(&quot;d-M-Y&quot;)">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="37" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="description" fieldSource="description" required="False" caption="Description" wizardCaption="Description" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_document_typeFormdescription">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="543" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="tuser" fieldSource="tuser" required="True" caption="Nama Tabel Kontrol User" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_document_typeFormtuser">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="544" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="package_name" fieldSource="package_name" required="True" caption="Nama Package Aturan Bisnis" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_document_typeFormpackage_name">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="545" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="f_profile" fieldSource="f_profile" required="True" caption="Fungsi Layout Profile Inbox" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_document_typeFormf_profile">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="546" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="tdoc" fieldSource="tdoc" required="True" caption="Nama Tabel Utama Dokumen" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_document_typeFormtdoc">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="547" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="profile_source" fieldSource="profile_source" required="True" caption="Form Summary Inbox" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_document_typeFormprofile_source">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="548" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="f_app_fraud_engine" fieldSource="f_app_fraud_engine" required="False" caption="Fungsi Deteksi Fraud" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_document_typeFormf_app_fraud_engine">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="633" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="doc_name" fieldSource="doc_name" required="True" caption="Nama Dokumen Workflow" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_document_typeFormdoc_name">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
<TextBox id="634" visible="Yes" fieldSourceType="DBColumn" dataType="Float" name="listing_no" fieldSource="listing_no" required="True" caption="Nomor Urut Prioritas Dokumen" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_document_typeFormlisting_no">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
</Components>
			<Events/>
			<TableParameters>
				<TableParameter id="570" conditionType="Parameter" useIsNull="False" field="p_document_type_id" dataType="Float" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="p_document_type_id"/>
			</TableParameters>
			<SPParameters/>
			<SQLParameters>
				<SQLParameter id="632" parameterType="URL" variable="p_document_type_id" dataType="Float" parameterSource="p_document_type_id"/>
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
				<SQLParameter id="652" variable="updated_by" dataType="Text" parameterType="Expression" parameterSource="CCGetUserLogin()"/>
<SQLParameter id="653" variable="display_name" dataType="Text" parameterType="Control" parameterSource="display_name"/>
<SQLParameter id="654" variable="tctl" dataType="Text" parameterType="Control" parameterSource="tctl"/>
<SQLParameter id="656" variable="created_by" dataType="Text" parameterType="Expression" parameterSource="CCGetUserLogin()"/>
<SQLParameter id="658" variable="description" dataType="Text" parameterType="Control" parameterSource="description"/>
<SQLParameter id="659" variable="tuser" dataType="Text" parameterType="Control" parameterSource="tuser"/>
<SQLParameter id="660" variable="package_name" dataType="Text" parameterType="Control" parameterSource="package_name"/>
<SQLParameter id="661" variable="f_profile" dataType="Text" parameterType="Control" parameterSource="f_profile"/>
<SQLParameter id="662" variable="tdoc" dataType="Text" parameterType="Control" parameterSource="tdoc"/>
<SQLParameter id="663" variable="profile_source" dataType="Text" parameterType="Control" parameterSource="profile_source"/>
<SQLParameter id="664" variable="f_app_fraud_engine" dataType="Text" parameterType="Control" parameterSource="f_app_fraud_engine"/>
<SQLParameter id="665" variable="doc_name" dataType="Text" parameterType="Control" parameterSource="doc_name"/>
<SQLParameter id="666" variable="listing_no" dataType="Float" parameterType="Control" parameterSource="listing_no" defaultValue="0"/>
</ISQLParameters>
			<IFormElements>
				<CustomParameter id="635" field="p_document_type_id" dataType="Float" parameterType="Control" parameterSource="p_document_type_id"/>
<CustomParameter id="636" field="updated_by" dataType="Text" parameterType="Control" parameterSource="updated_by"/>
<CustomParameter id="637" field="display_name" dataType="Text" parameterType="Control" parameterSource="display_name"/>
<CustomParameter id="638" field="tctl" dataType="Text" parameterType="Control" parameterSource="tctl"/>
<CustomParameter id="639" field="updated_date" dataType="Text" parameterType="Control" parameterSource="updated_date" format="dd-mmm-yyyy"/>
<CustomParameter id="640" field="created_by" dataType="Text" parameterType="Control" parameterSource="created_by"/>
<CustomParameter id="641" field="creation_date" dataType="Text" parameterType="Control" parameterSource="creation_date" format="dd-mmm-yyyy"/>
<CustomParameter id="642" field="description" dataType="Text" parameterType="Control" parameterSource="description"/>
<CustomParameter id="643" field="tuser" dataType="Text" parameterType="Control" parameterSource="tuser"/>
<CustomParameter id="644" field="package_name" dataType="Text" parameterType="Control" parameterSource="package_name"/>
<CustomParameter id="645" field="f_profile" dataType="Text" parameterType="Control" parameterSource="f_profile"/>
<CustomParameter id="646" field="tdoc" dataType="Text" parameterType="Control" parameterSource="tdoc"/>
<CustomParameter id="647" field="profile_source" dataType="Text" parameterType="Control" parameterSource="profile_source"/>
<CustomParameter id="648" field="f_app_fraud_engine" dataType="Text" parameterType="Control" parameterSource="f_app_fraud_engine"/>
<CustomParameter id="649" field="doc_name" dataType="Text" parameterType="Control" parameterSource="doc_name"/>
<CustomParameter id="650" field="listing_no" dataType="Float" parameterType="Control" parameterSource="listing_no"/>
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
				<SQLParameter id="683" variable="p_document_type_id" dataType="Float" parameterType="Control" parameterSource="p_document_type_id" defaultValue="0"/>
<SQLParameter id="684" variable="updated_by" dataType="Text" parameterType="Expression" parameterSource="CCGetUserLogin()"/>
<SQLParameter id="685" variable="display_name" dataType="Text" parameterType="Control" parameterSource="display_name"/>
<SQLParameter id="686" variable="tctl" dataType="Text" parameterType="Control" parameterSource="tctl"/>
<SQLParameter id="690" variable="description" dataType="Text" parameterType="Control" parameterSource="description"/>
<SQLParameter id="691" variable="tuser" dataType="Text" parameterType="Control" parameterSource="tuser"/>
<SQLParameter id="692" variable="package_name" dataType="Text" parameterType="Control" parameterSource="package_name"/>
<SQLParameter id="693" variable="f_profile" dataType="Text" parameterType="Control" parameterSource="f_profile"/>
<SQLParameter id="694" variable="tdoc" dataType="Text" parameterType="Control" parameterSource="tdoc"/>
<SQLParameter id="695" variable="profile_source" dataType="Text" parameterType="Control" parameterSource="profile_source"/>
<SQLParameter id="696" variable="f_app_fraud_engine" dataType="Text" parameterType="Control" parameterSource="f_app_fraud_engine"/>
<SQLParameter id="697" variable="doc_name" dataType="Text" parameterType="Control" parameterSource="doc_name"/>
<SQLParameter id="698" variable="listing_no" dataType="Float" parameterType="Control" parameterSource="listing_no" defaultValue="0"/>
</USQLParameters>
			<UConditions>
			</UConditions>
			<UFormElements>
				<CustomParameter id="667" field="p_document_type_id" dataType="Float" parameterType="Control" parameterSource="p_document_type_id"/>
<CustomParameter id="668" field="updated_by" dataType="Text" parameterType="Control" parameterSource="updated_by"/>
<CustomParameter id="669" field="display_name" dataType="Text" parameterType="Control" parameterSource="display_name"/>
<CustomParameter id="670" field="tctl" dataType="Text" parameterType="Control" parameterSource="tctl"/>
<CustomParameter id="671" field="updated_date" dataType="Text" parameterType="Control" parameterSource="updated_date" format="dd-mmm-yyyy"/>
<CustomParameter id="672" field="created_by" dataType="Text" parameterType="Control" parameterSource="created_by"/>
<CustomParameter id="673" field="creation_date" dataType="Text" parameterType="Control" parameterSource="creation_date" format="dd-mmm-yyyy"/>
<CustomParameter id="674" field="description" dataType="Text" parameterType="Control" parameterSource="description"/>
<CustomParameter id="675" field="tuser" dataType="Text" parameterType="Control" parameterSource="tuser"/>
<CustomParameter id="676" field="package_name" dataType="Text" parameterType="Control" parameterSource="package_name"/>
<CustomParameter id="677" field="f_profile" dataType="Text" parameterType="Control" parameterSource="f_profile"/>
<CustomParameter id="678" field="tdoc" dataType="Text" parameterType="Control" parameterSource="tdoc"/>
<CustomParameter id="679" field="profile_source" dataType="Text" parameterType="Control" parameterSource="profile_source"/>
<CustomParameter id="680" field="f_app_fraud_engine" dataType="Text" parameterType="Control" parameterSource="f_app_fraud_engine"/>
<CustomParameter id="681" field="doc_name" dataType="Text" parameterType="Control" parameterSource="doc_name"/>
<CustomParameter id="682" field="listing_no" dataType="Float" parameterType="Control" parameterSource="listing_no"/>
</UFormElements>
			<DSPParameters/>
			<DSQLParameters>
				<SQLParameter id="630" variable="p_document_type_id" parameterType="Control" defaultValue="0" dataType="Float" parameterSource="p_document_type_id"/>
			</DSQLParameters>
			<DConditions>
				<TableParameter id="537" conditionType="Parameter" useIsNull="False" field="p_file_path_id" dataType="Float" searchConditionType="Equal" parameterType="Control" logicOperator="And" parameterSource="p_file_path_id"/>
			</DConditions>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Record>
	</Components>
	<CodeFiles>
		<CodeFile id="Events" language="PHPTemplates" name="p_document_type_events.php" forShow="False" comment="//" codePage="windows-1252"/>
		<CodeFile id="Code" language="PHPTemplates" name="p_document_type.php" forShow="True" url="p_document_type.php" comment="//" codePage="windows-1252"/>
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
