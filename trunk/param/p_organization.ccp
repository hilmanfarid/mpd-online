<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\param" secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="RWNet" wizardThemeVersion="3.0" needGeneration="0">
	<Components>
		<Grid id="2" secured="False" sourceType="SQL" returnValueType="Number" defaultPageSize="5" connection="ConnSIKP" name="p_organizationGrid" pageSizeLimit="100" wizardCaption="List of P App Role " wizardGridType="Tabular" wizardAllowInsert="True" wizardAltRecord="True" wizardAltRecordType="Style" wizardRecordSeparator="False" wizardNoRecords="-" pasteAsReplace="pasteAsReplace" pasteActions="pasteActions" activeCollection="SQLParameters" parameterTypeListName="ParameterTypeList" dataSource="SELECT a.p_organization_id, a.organization_code, a.organization_name, a.company_id, b.level_code, c.company_name, a.p_organization_level_id, 
a.listing_no, a.parent_id, a.description, to_char(a.creation_date,'DD-MON-YYYY')as creation_date, a.created_by, to_char(a.updated_date,'DD-MON-YYYY')as updated_date, a.updated_by, a.p_district_id, d.district_name
FROM sikp.p_organization a, sikp.p_organization_level b, sikp.company c, sikp.p_district d
WHERE a.company_id = c.company_id AND
a.p_organization_level_id = b.p_organization_level_id AND
a.p_district_id = d.p_district_id AND
nvl(a.parent_id,0) = {parent_id} AND
(upper(a.organization_code) like '%{s_keyword}%' OR
upper(a.organization_name) like '%{s_keyword}%')
ORDER BY a.p_organization_id">
			<Components>
				<Link id="7" visible="Yes" fieldSourceType="DBColumn" dataType="Text" html="False" hrefType="Page" urlType="Relative" preserveParameters="GET" name="Insert_Link" hrefSource="p_organization.ccp" removeParameters="p_organization_id;s_keyword" wizardThemeItem="FooterA" wizardDefaultValue="Add New" wizardUseTemplateBlock="False" PathID="p_organizationGridInsert_Link">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="67" sourceType="Expression" name="FLAG" source="&quot;ADD&quot;"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
				<Link id="11" visible="Yes" fieldSourceType="CodeExpression" html="True" hrefType="Page" urlType="Relative" preserveParameters="GET" name="DLink" wizardCaption="Detail" wizardSize="50" wizardMaxLength="60" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" dataType="Text" wizardDefaultValue="DLink" hrefSource="p_organization.ccp" wizardThemeItem="GridA" PathID="p_organizationGridDLink" removeParameters="FLAG">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="291" sourceType="DataField" name="p_organization_id" source="p_organization_id"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
				<Label id="15" fieldSourceType="DBColumn" dataType="Text" html="False" name="organization_code" fieldSource="organization_code" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="p_organizationGridorganization_code">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="17" fieldSourceType="DBColumn" dataType="Text" html="False" name="description" fieldSource="description" wizardCaption="Description" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="p_organizationGriddescription">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="19" fieldSourceType="DBColumn" dataType="Text" html="False" name="organization_name" fieldSource="organization_name" wizardCaption="Valid From" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="p_organizationGridorganization_name">
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
				<Hidden id="13" fieldSourceType="DBColumn" dataType="Float" html="False" name="p_organization_id" fieldSource="p_organization_id" wizardCaption="Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="p_organizationGridp_organization_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Label id="318" fieldSourceType="DBColumn" dataType="Text" html="False" name="district_name" fieldSource="district_name" wizardCaption="Valid From" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="p_organizationGriddistrict_name">
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
				<SQLParameter id="290" variable="s_keyword" parameterType="URL" dataType="Text" parameterSource="s_keyword"/>
				<SQLParameter id="316" variable="parent_id" parameterType="URL" defaultValue="0" dataType="Float" parameterSource="parent_id"/>
</SQLParameters>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Grid>
		<Record id="3" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="None" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="p_organizationSearch" wizardCaption="Search P App Role " wizardOrientation="Vertical" wizardFormMethod="post" returnPage="p_organization.ccp" PathID="p_organizationSearch" pasteActions="pasteActions">
			<Components>
				<Button id="4" urlType="Relative" enableValidation="True" isDefault="False" name="Button_DoSearch" operation="Search" wizardCaption="Search" PathID="p_organizationSearchButton_DoSearch">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<TextBox id="5" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="s_keyword" wizardCaption="Keyword" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" PathID="p_organizationSearchs_keyword">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Hidden id="317" fieldSourceType="DBColumn" dataType="Text" name="parent_id" wizardCaption="Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_organizationSearchparent_id">
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
		<Record id="94" sourceType="SQL" urlType="Relative" secured="False" allowInsert="True" allowUpdate="True" allowDelete="True" validateData="True" preserveParameters="GET" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" connection="ConnSIKP" name="p_organizationForm" errorSummator="Error" wizardCaption="Add/Edit V P App User " wizardFormMethod="post" PathID="p_organizationForm" activeCollection="DSQLParameters" pasteAsReplace="pasteAsReplace" pasteActions="pasteActions" customDelete="DELETE FROM p_organization
WHERE p_organization_id = {p_organization_id}" customDeleteType="SQL" activeTableType="customDelete" parameterTypeListName="ParameterTypeList" customUpdateType="SQL" customUpdate="UPDATE p_organization
   SET organization_code='{organization_code}', 
       organization_name='{organization_name}', 
       company_id=decode({company_id},0,null,{company_id}), 
       p_organization_level_id={p_organization_level_id}, 
       listing_no=decode({listing_no},0,null,{listing_no}),   
       description='{description}', 
       updated_date=sysdate, 
       updated_by='{updated_by}', 
       p_district_id=decode({p_district_id},0,null,{p_district_id})
 WHERE p_organization_id={p_organization_id}   " customInsertType="SQL" customInsert="INSERT INTO p_organization(
p_organization_id, 
organization_code, 
organization_name, 
company_id, 
p_organization_level_id, 
listing_no, 
parent_id, 
description, 
creation_date, 
created_by, 
updated_date, 
updated_by, 
p_district_id)
VALUES (generate_id('sikp','p_organization','p_organization_id'), 
'{organization_code}', 
'{organization_name}', 
decode({company_id},0,null,{company_id}),
{p_organization_level_id}, 
decode({listing_no},0,null,{listing_no}), 
decode({parent_id},0,null,{parent_id}), 
'{description}', 
sysdate, 
'{created_by}', 
sysdate, 
'{updated_by}', 
decode({p_district_id},0,null,{p_district_id}))" dataSource="SELECT a.p_organization_id, a.organization_code, a.organization_name, a.company_id, b.level_code, c.company_name, a.p_organization_level_id, 
a.listing_no, a.parent_id, a.description, to_char(a.creation_date,'DD-MON-YYYY')as creation_date, a.created_by, to_char(a.updated_date,'DD-MON-YYYY')as updated_date, a.updated_by, a.p_district_id, d.district_name
FROM p_organization a, p_organization_level b, company c, p_district d
WHERE a.company_id = c.company_id AND
a.p_organization_level_id = b.p_organization_level_id AND
a.p_district_id = d.p_district_id AND
a.p_organization_id = {p_organization_id}">
			<Components>
				<Button id="95" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Insert" operation="Insert" wizardCaption="Add" PathID="p_organizationFormButton_Insert" removeParameters="FLAG">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="96" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Update" operation="Update" wizardCaption="Submit" PathID="p_organizationFormButton_Update" removeParameters="FLAG">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="97" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Delete" operation="Delete" wizardCaption="Delete" PathID="p_organizationFormButton_Delete" removeParameters="FLAG;p_organization_id;s_keyword;p_organizationGridPage">
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
				<Button id="99" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Cancel" operation="Cancel" wizardCaption="Cancel" PathID="p_organizationFormButton_Cancel" removeParameters="FLAG;p_organization_id;s_keyword;p_organizationGridPage">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Hidden id="101" fieldSourceType="DBColumn" dataType="Float" name="p_organization_id" fieldSource="p_organization_id" required="False" caption="Id" wizardCaption="P App User Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_organizationFormp_organization_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<TextBox id="114" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="description" fieldSource="description" required="False" caption="Description" wizardCaption="Description" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_organizationFormdescription">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="124" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="created_by" fieldSource="created_by" required="False" caption="Created By" wizardCaption="Created By" wizardSize="16" wizardMaxLength="16" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_organizationFormcreated_by" defaultValue="CCGetUserLogin()">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="127" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="updated_by" fieldSource="updated_by" required="False" caption="Updated By" wizardCaption="Updated By" wizardSize="16" wizardMaxLength="16" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_organizationFormupdated_by" defaultValue="CCGetUserLogin()">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="122" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="creation_date" fieldSource="creation_date" required="False" caption="Creation Date" wizardCaption="Creation Date" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_organizationFormcreation_date" format="dd-mmm-yyyy" defaultValue="date(&quot;d-M-Y&quot;)">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="125" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="updated_date" fieldSource="updated_date" required="False" caption="Updated Date" wizardCaption="Updated Date" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_organizationFormupdated_date" defaultValue="date(&quot;d-M-Y&quot;)" format="dd-mmm-yyyy">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Hidden id="165" fieldSourceType="DBColumn" dataType="Text" name="p_organizationGridPage" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="p_organizationFormp_organizationGridPage">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<ListBox id="283" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="p_organization_level_id" PathID="p_organizationFormp_organization_level_id" fieldSource="p_organization_level_id" sourceType="Table" connection="ConnSIKP" boundColumn="p_organization_level_id" textColumn="level_code" dataSource="p_organization_level" required="True" caption="Level Organisasi">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
					<TableParameters/>
					<SPParameters/>
					<SQLParameters/>
					<JoinTables>
						<JoinTable id="284" tableName="p_organization_level" posLeft="10" posTop="10" posWidth="160" posHeight="180"/>
					</JoinTables>
					<JoinLinks/>
					<Fields/>
				</ListBox>
				<TextBox id="156" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="organization_code" fieldSource="organization_code" required="True" caption="Kode Organisasi" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_organizationFormorganization_code">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="157" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="organization_name" fieldSource="organization_name" required="True" caption="Nama Organisasi" wizardCaption="ORGANIZATION NAME" wizardSize="50" wizardMaxLength="128" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_organizationFormorganization_name">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="164" visible="Yes" fieldSourceType="DBColumn" dataType="Float" name="parent_id" fieldSource="parent_id" required="False" caption="Parent ID" wizardCaption="PARENT ID" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_organizationFormparent_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="285" visible="Yes" fieldSourceType="DBColumn" dataType="Float" name="listing_no" fieldSource="listing_no" required="False" caption="No Urut" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_organizationFormlisting_no">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="286" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="district_name" PathID="p_organizationFormdistrict_name" fieldSource="district_name" required="True" caption="Kota">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Hidden id="287" fieldSourceType="DBColumn" dataType="Float" name="p_district_id" PathID="p_organizationFormp_district_id" fieldSource="p_district_id" required="True" caption="Kota">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<ListBox id="292" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="company_id" PathID="p_organizationFormcompany_id" fieldSource="company_id" sourceType="Table" connection="ConnSIKP" boundColumn="company_id" textColumn="company_name" dataSource="company" required="True" caption="Perusahaan">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
					<TableParameters/>
					<SPParameters/>
					<SQLParameters/>
					<JoinTables>
						<JoinTable id="293" tableName="p_organization_level" posLeft="10" posTop="10" posWidth="160" posHeight="180"/>
					</JoinTables>
					<JoinLinks/>
					<Fields/>
				</ListBox>
			</Components>
			<Events/>
			<TableParameters>
			</TableParameters>
			<SPParameters/>
			<SQLParameters>
				<SQLParameter id="289" variable="p_organization_id" parameterType="URL" defaultValue="0" dataType="Float" parameterSource="p_organization_id"/>
			</SQLParameters>
			<JoinTables>
			</JoinTables>
			<JoinLinks/>
			<Fields>
				<Field id="288" fieldName="*"/>
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
				<SQLParameter id="294" variable="p_organization_id" parameterType="Control" defaultValue="0" dataType="Float" parameterSource="p_organization_id"/>
				<SQLParameter id="295" variable="organization_code" parameterType="Control" dataType="Text" parameterSource="organization_code"/>
				<SQLParameter id="296" variable="organization_name" parameterType="Control" dataType="Text" parameterSource="organization_name"/>
				<SQLParameter id="297" variable="company_id" parameterType="Control" defaultValue="0" dataType="Float" parameterSource="company_id"/>
				<SQLParameter id="298" variable="p_organization_level_id" parameterType="Control" defaultValue="0" dataType="Float" parameterSource="p_organization_level_id"/>
				<SQLParameter id="299" variable="listing_no" parameterType="Control" defaultValue="0" dataType="Float" parameterSource="listing_no"/>
				<SQLParameter id="300" variable="parent_id" parameterType="Control" defaultValue="0" dataType="Float" parameterSource="parent_id"/>
				<SQLParameter id="301" variable="description" parameterType="Control" dataType="Text" parameterSource="description"/>
				<SQLParameter id="302" variable="created_by" parameterType="Expression" dataType="Text" parameterSource="CCGetUserLogin()"/>
				<SQLParameter id="303" variable="updated_by" parameterType="Expression" dataType="Text" parameterSource="CCGetUserLogin()"/>
				<SQLParameter id="304" variable="p_district_id" parameterType="Control" defaultValue="0" dataType="Float" parameterSource="p_district_id"/>
			</ISQLParameters>
			<IFormElements>
				<CustomParameter id="211" field="p_app_user_id" dataType="Float" parameterType="Control" parameterSource="p_app_user_id"/>
				<CustomParameter id="212" field="app_user_name" dataType="Text" parameterType="Control" parameterSource="app_user_name"/>
				<CustomParameter id="213" field="full_name" dataType="Text" parameterType="Control" parameterSource="full_name"/>
				<CustomParameter id="214" field="email_address" dataType="Text" parameterType="Control" parameterSource="email_address"/>
				<CustomParameter id="215" field="p_user_status_id" dataType="Text" parameterType="Control" parameterSource="p_user_status_id"/>
				<CustomParameter id="216" field="description" dataType="Text" parameterType="Control" parameterSource="description"/>
				<CustomParameter id="217" field="ip_address_v4" dataType="Text" parameterType="Control" parameterSource="ip_address_v4"/>
				<CustomParameter id="218" field="expired_user" dataType="Text" parameterType="Control" parameterSource="expired_user" format="dd-mm-yyyy"/>
				<CustomParameter id="219" field="expired_pwd" dataType="Text" parameterType="Control" parameterSource="expired_pwd" format="dd-mm-yyyy"/>
				<CustomParameter id="220" field="last_login_time" dataType="Text" parameterType="Control" parameterSource="last_login_time" format="dd-mm-yyyy"/>
				<CustomParameter id="221" field="created_by" dataType="Text" parameterType="Control" parameterSource="created_by"/>
				<CustomParameter id="222" field="updated_by" dataType="Text" parameterType="Control" parameterSource="updated_by"/>
				<CustomParameter id="223" field="creation_date" dataType="Text" parameterType="Control" parameterSource="creation_date" format="dd-mm-yyyy"/>
				<CustomParameter id="224" field="updated_date" dataType="Text" parameterType="Control" parameterSource="updated_date" format="dd-mm-yyyy"/>
				<CustomParameter id="225" field="ip_address_v6" dataType="Text" parameterType="Control" parameterSource="ip_address_v6"/>
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
				<SQLParameter id="305" variable="organization_code" parameterType="Control" dataType="Text" parameterSource="organization_code"/>
				<SQLParameter id="306" variable="organization_name" parameterType="Control" dataType="Text" parameterSource="organization_name"/>
				<SQLParameter id="307" variable="company_id" parameterType="Control" defaultValue="0" dataType="Float" parameterSource="company_id"/>
				<SQLParameter id="308" variable="p_organization_level_id" parameterType="Control" defaultValue="0" dataType="Float" parameterSource="p_organization_level_id"/>
				<SQLParameter id="309" variable="listing_no" parameterType="Control" defaultValue="0" dataType="Float" parameterSource="listing_no"/>
				<SQLParameter id="311" variable="description" parameterType="Control" dataType="Text" parameterSource="description"/>
				<SQLParameter id="312" variable="updated_by" parameterType="Expression" dataType="Text" parameterSource="CCGetUserLogin()"/>
				<SQLParameter id="313" variable="p_district_id" parameterType="Control" defaultValue="0" dataType="Float" parameterSource="p_district_id"/>
				<SQLParameter id="314" variable="p_organization_id" parameterType="Control" dataType="Text" parameterSource="p_organization_id"/>
			</USQLParameters>
			<UConditions/>
			<UFormElements>
				<CustomParameter id="230" field="p_app_user_id" dataType="Float" parameterType="Control" parameterSource="p_app_user_id"/>
				<CustomParameter id="231" field="app_user_name" dataType="Text" parameterType="Control" parameterSource="app_user_name"/>
				<CustomParameter id="232" field="full_name" dataType="Text" parameterType="Control" parameterSource="full_name"/>
				<CustomParameter id="233" field="email_address" dataType="Text" parameterType="Control" parameterSource="email_address"/>
				<CustomParameter id="234" field="p_user_status_id" dataType="Text" parameterType="Control" parameterSource="p_user_status_id"/>
				<CustomParameter id="235" field="description" dataType="Text" parameterType="Control" parameterSource="description"/>
				<CustomParameter id="236" field="ip_address_v4" dataType="Text" parameterType="Control" parameterSource="ip_address_v4"/>
				<CustomParameter id="237" field="expired_user" dataType="Text" parameterType="Control" parameterSource="expired_user" format="dd-mm-yyyy"/>
				<CustomParameter id="238" field="expired_pwd" dataType="Text" parameterType="Control" parameterSource="expired_pwd" format="dd-mm-yyyy"/>
				<CustomParameter id="239" field="last_login_time" dataType="Text" parameterType="Control" parameterSource="last_login_time" format="dd-mm-yyyy"/>
				<CustomParameter id="240" field="created_by" dataType="Text" parameterType="Control" parameterSource="created_by"/>
				<CustomParameter id="241" field="updated_by" dataType="Text" parameterType="Control" parameterSource="updated_by"/>
				<CustomParameter id="242" field="creation_date" dataType="Text" parameterType="Control" parameterSource="creation_date" format="dd-mm-yyyy"/>
				<CustomParameter id="243" field="updated_date" dataType="Text" parameterType="Control" parameterSource="updated_date" format="dd-mm-yyyy"/>
				<CustomParameter id="244" field="ip_address_v6" dataType="Text" parameterType="Control" parameterSource="ip_address_v6"/>
			</UFormElements>
			<DSPParameters/>
			<DSQLParameters>
				<SQLParameter id="315" variable="p_organization_id" parameterType="Control" defaultValue="0" dataType="Float" parameterSource="p_organization_id"/>
			</DSQLParameters>
			<DConditions>
			</DConditions>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Record>
	</Components>
	<CodeFiles>
		<CodeFile id="Events" language="PHPTemplates" name="p_organization_events.php" forShow="False" comment="//" codePage="windows-1252"/>
		<CodeFile id="Code" language="PHPTemplates" name="p_organization.php" forShow="True" url="p_organization.php" comment="//" codePage="windows-1252"/>
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
