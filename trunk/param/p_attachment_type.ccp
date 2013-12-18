<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\param" secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="RWNet" wizardThemeVersion="3.0" needGeneration="0">
	<Components>
		<Grid id="2" secured="False" sourceType="SQL" returnValueType="Number" defaultPageSize="5" connection="ConnSIKP" name="p_attachment_typeGrid" pageSizeLimit="100" wizardCaption="List of P App Role " wizardGridType="Tabular" wizardAllowInsert="True" wizardAltRecord="True" wizardAltRecordType="Style" wizardRecordSeparator="False" wizardNoRecords="-" pasteAsReplace="pasteAsReplace" pasteActions="pasteActions" activeCollection="TableParameters" parameterTypeListName="ParameterTypeList" orderBy="listing_no" dataSource="SELECT a.p_attachment_type_id, a.code, decode(a.is_mandatory,'Y','YA','TIDAK')as is_mandatory, 
a.listing_no, a.description, a.p_attachment_group_id, b.code as group_code
FROM p_attachment_type a, p_attachment_group b
WHERE a.p_attachment_group_id = b.p_attachment_group_id AND
(upper(a.code) LIKE '%{s_keyword}%'
OR upper(b.code) LIKE '%{s_keyword}%') 
ORDER BY a.listing_no">
			<Components>
				<Link id="7" visible="Yes" fieldSourceType="DBColumn" dataType="Text" html="False" hrefType="Page" urlType="Relative" preserveParameters="GET" name="Insert_Link" hrefSource="p_attachment_type.ccp" removeParameters="p_attachment_type_id;s_keyword" wizardThemeItem="FooterA" wizardDefaultValue="Add New" wizardUseTemplateBlock="False" PathID="p_attachment_typeGridInsert_Link">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="67" sourceType="Expression" name="FLAG" source="&quot;ADD&quot;"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
				<Link id="11" visible="Yes" fieldSourceType="CodeExpression" html="True" hrefType="Page" urlType="Relative" preserveParameters="GET" name="DLink" wizardCaption="Detail" wizardSize="50" wizardMaxLength="60" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" dataType="Text" wizardDefaultValue="DLink" hrefSource="p_attachment_type.ccp" wizardThemeItem="GridA" PathID="p_attachment_typeGridDLink" removeParameters="FLAG">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="684" sourceType="DataField" name="p_attachment_type_id" source="p_attachment_type_id"/>
</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
				<Label id="15" fieldSourceType="DBColumn" dataType="Text" html="False" name="code" fieldSource="code" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="p_attachment_typeGridcode">
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
				<Hidden id="13" fieldSourceType="DBColumn" dataType="Float" html="False" name="p_attachment_type_id" fieldSource="p_attachment_type_id" wizardCaption="Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="p_attachment_typeGridp_attachment_type_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Label id="17" fieldSourceType="DBColumn" dataType="Text" html="False" name="description" fieldSource="description" wizardCaption="Description" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="p_attachment_typeGriddescription">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="555" fieldSourceType="DBColumn" dataType="Float" html="False" name="listing_no" fieldSource="listing_no" wizardCaption="Description" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="p_attachment_typeGridlisting_no">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="681" fieldSourceType="DBColumn" dataType="Text" html="False" name="group_code" fieldSource="group_code" wizardCaption="Description" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="p_attachment_typeGridgroup_code">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
<Label id="682" fieldSourceType="DBColumn" dataType="Text" html="False" name="is_mandatory" fieldSource="is_mandatory" wizardCaption="Description" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="p_attachment_typeGridis_mandatory">
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
				<TableParameter id="557" conditionType="Parameter" useIsNull="False" field="upper(code)" dataType="Text" searchConditionType="Contains" parameterType="URL" logicOperator="Or" parameterSource="s_keyword"/>
				<TableParameter id="558" conditionType="Parameter" useIsNull="False" field="upper(description)" dataType="Text" searchConditionType="Contains" parameterType="URL" logicOperator="And" parameterSource="s_keyword"/>
			</TableParameters>
			<JoinTables>
			</JoinTables>
			<JoinLinks/>
			<Fields>
			</Fields>
			<SPParameters/>
			<SQLParameters>
				<SQLParameter id="674" parameterType="URL" variable="s_keyword" dataType="Text" parameterSource="s_keyword"/>
</SQLParameters>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Grid>
		<Record id="3" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="None" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="p_attachment_typeSearch" wizardCaption="Search P App Role " wizardOrientation="Vertical" wizardFormMethod="post" returnPage="p_attachment_type.ccp" PathID="p_attachment_typeSearch" pasteActions="pasteActions">
			<Components>
				<Button id="4" urlType="Relative" enableValidation="True" isDefault="False" name="Button_DoSearch" operation="Search" wizardCaption="Search" PathID="p_attachment_typeSearchButton_DoSearch">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<TextBox id="5" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="s_keyword" wizardCaption="Keyword" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" PathID="p_attachment_typeSearchs_keyword">
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
		<Record id="94" sourceType="SQL" urlType="Relative" secured="False" allowInsert="True" allowUpdate="True" allowDelete="True" validateData="True" preserveParameters="GET" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" connection="ConnSIKP" name="p_attachment_typeForm" errorSummator="Error" wizardCaption="Add/Edit V P App User " wizardFormMethod="post" PathID="p_attachment_typeForm" activeCollection="DSQLParameters" pasteAsReplace="pasteAsReplace" pasteActions="pasteActions" customDeleteType="SQL" parameterTypeListName="ParameterTypeList" customUpdateType="SQL" customInsertType="SQL" dataSource="SELECT a.p_attachment_type_id, a.code, a.is_mandatory, 
a.listing_no, a.description, a.p_attachment_group_id, b.code as group_code,
to_char(a.creation_date,'DD-MON-YYYY')as creation_date, a.created_by, to_char(a.updated_date,'DD-MON-YYYY')as updated_date, a.updated_by
FROM p_attachment_type a, p_attachment_group b
WHERE a.p_attachment_group_id = b.p_attachment_group_id AND
a.p_attachment_type_id = {p_attachment_type_id} " customInsert="INSERT INTO p_attachment_type(p_attachment_type_id, p_attachment_group_id, description, created_by, updated_by, creation_date, updated_date, listing_no, code, is_mandatory) 
VALUES(generate_id('sikp','p_attachment_type','p_attachment_type_id'), {p_attachment_group_id}, '{description}', '{created_by}', '{updated_by}', sysdate, sysdate, {listing_no}, '{code}', '{is_mandatory}')" customUpdate="UPDATE p_attachment_type SET 
description='{description}', 
updated_by='{updated_by}',  
updated_date=sysdate, 
listing_no={listing_no}, 
code='{code}',
is_mandatory='{is_mandatory}',
p_attachment_group_id={p_attachment_group_id}
WHERE p_attachment_type_id={p_attachment_type_id}" customDelete="DELETE FROM p_attachment_type
WHERE p_attachment_type_id = {p_attachment_type_id}">
			<Components>
				<Button id="95" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Insert" operation="Insert" wizardCaption="Add" PathID="p_attachment_typeFormButton_Insert" removeParameters="FLAG">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="96" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Update" operation="Update" wizardCaption="Submit" PathID="p_attachment_typeFormButton_Update" removeParameters="FLAG">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="97" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Delete" operation="Delete" wizardCaption="Delete" PathID="p_attachment_typeFormButton_Delete" removeParameters="FLAG;p_attachment_type_id;s_keyword;p_attachment_typeGridPage">
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
				<Button id="99" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Cancel" operation="Cancel" wizardCaption="Cancel" PathID="p_attachment_typeFormButton_Cancel" removeParameters="FLAG;p_attachment_type_id;s_keyword;p_attachment_typeGridPage">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Hidden id="101" fieldSourceType="DBColumn" dataType="Float" name="p_attachment_type_id" fieldSource="p_attachment_type_id" caption="Id" wizardCaption="P App User Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_attachment_typeFormp_attachment_type_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<TextBox id="114" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="description" fieldSource="description" required="False" caption="Description" wizardCaption="Description" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_attachment_typeFormdescription">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="124" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="created_by" fieldSource="created_by" required="False" caption="Created By" wizardCaption="Created By" wizardSize="16" wizardMaxLength="16" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_attachment_typeFormcreated_by" defaultValue="CCGetUserLogin()">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="127" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="updated_by" fieldSource="updated_by" required="False" caption="Updated By" wizardCaption="Updated By" wizardSize="16" wizardMaxLength="16" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_attachment_typeFormupdated_by" defaultValue="CCGetUserLogin()">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="122" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="creation_date" fieldSource="creation_date" required="False" caption="Creation Date" wizardCaption="Creation Date" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_attachment_typeFormcreation_date" format="dd-mmm-yyyy" defaultValue="date(&quot;d-M-Y&quot;)">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="125" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="updated_date" fieldSource="updated_date" required="False" caption="Updated Date" wizardCaption="Updated Date" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_attachment_typeFormupdated_date" defaultValue="date(&quot;d-M-Y&quot;)" format="dd-mmm-yyyy">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Hidden id="165" fieldSourceType="DBColumn" dataType="Text" name="p_attachment_typeGridPage" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="p_attachment_typeFormp_attachment_typeGridPage">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<TextBox id="156" visible="Yes" fieldSourceType="DBColumn" dataType="Float" name="listing_no" fieldSource="listing_no" required="True" caption="No Urut" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_attachment_typeFormlisting_no">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="460" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="code" fieldSource="code" required="True" caption="Jenis Kegiatan SPP" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_attachment_typeFormcode">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="683" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="group_code" fieldSource="group_code" required="True" caption="Kelompok" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_attachment_typeFormgroup_code">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
<Hidden id="685" fieldSourceType="DBColumn" dataType="Float" name="p_attachment_group_id" fieldSource="p_attachment_group_id" caption="Id" wizardCaption="P App User Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_attachment_typeFormp_attachment_group_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
<ListBox id="140" visible="Yes" fieldSourceType="DBColumn" sourceType="ListOfValues" dataType="Text" returnValueType="Number" name="is_mandatory" wizardEmptyCaption="Select Value" PathID="p_attachment_typeFormis_mandatory" fieldSource="is_mandatory" connection="ConnSIKP" _valueOfList="N" _nameOfList="TIDAK" dataSource="Y;YA;N;TIDAK" defaultValue="&quot;Y&quot;" caption="Perlu?" required="True">
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
</Components>
			<Events/>
			<TableParameters>
				<TableParameter id="663" conditionType="Parameter" useIsNull="False" field="p_fund_source_id" dataType="Float" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="p_fund_source_id"/>
			</TableParameters>
			<SPParameters/>
			<SQLParameters>
				<SQLParameter id="664" parameterType="URL" variable="p_attachment_type_id" dataType="Float" parameterSource="p_attachment_type_id" defaultValue="0"/>
			</SQLParameters>
			<JoinTables>
			</JoinTables>
			<JoinLinks/>
			<Fields>
			</Fields>
			<ISPParameters>
			</ISPParameters>
			<ISQLParameters>
				<SQLParameter id="626" variable="description" dataType="Text" parameterType="Control" parameterSource="description"/>
				<SQLParameter id="627" variable="created_by" dataType="Text" parameterType="Expression" parameterSource="CCGetUserLogin()"/>
				<SQLParameter id="628" variable="updated_by" dataType="Text" parameterType="Expression" parameterSource="CCGetUserLogin()"/>
				<SQLParameter id="631" variable="listing_no" dataType="Float" parameterType="Control" parameterSource="listing_no"/>
				<SQLParameter id="632" variable="code" dataType="Text" parameterType="Control" parameterSource="code"/>
				<SQLParameter id="686" variable="is_mandatory" parameterType="Control" dataType="Text" parameterSource="is_mandatory"/>
<SQLParameter id="687" variable="p_attachment_group_id" parameterType="Control" defaultValue="0" dataType="Float" parameterSource="p_attachment_group_id"/>
</ISQLParameters>
			<IFormElements>
				<CustomParameter id="617" field="p_tax_type_id" dataType="Float" parameterType="Control" parameterSource="p_tax_type_id"/>
				<CustomParameter id="618" field="description" dataType="Text" parameterType="Control" parameterSource="description"/>
				<CustomParameter id="619" field="created_by" dataType="Text" parameterType="Control" parameterSource="created_by"/>
				<CustomParameter id="620" field="updated_by" dataType="Text" parameterType="Control" parameterSource="updated_by"/>
				<CustomParameter id="621" field="creation_date" dataType="Text" parameterType="Control" parameterSource="creation_date" format="dd-mmm-yyyy"/>
				<CustomParameter id="622" field="updated_date" dataType="Text" parameterType="Control" parameterSource="updated_date" format="dd-mmm-yyyy"/>
				<CustomParameter id="623" field="listing_no" dataType="Float" parameterType="Control" parameterSource="listing_no"/>
				<CustomParameter id="624" field="code" dataType="Text" parameterType="Control" parameterSource="code"/>
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
				<SQLParameter id="641" variable="p_attachment_group_id" dataType="Float" parameterType="Control" parameterSource="p_attachment_group_id" defaultValue="0"/>
				<SQLParameter id="642" variable="description" dataType="Text" parameterType="Control" parameterSource="description"/>
				<SQLParameter id="644" variable="updated_by" dataType="Text" parameterType="Expression" parameterSource="CCGetUserLogin()"/>
				<SQLParameter id="647" variable="listing_no" dataType="Float" parameterType="Control" parameterSource="listing_no"/>
				<SQLParameter id="648" variable="code" dataType="Text" parameterType="Control" parameterSource="code"/>
				<SQLParameter id="688" variable="is_mandatory" parameterType="Control" dataType="Text" parameterSource="is_mandatory"/>
<SQLParameter id="689" variable="p_attachment_type_id" parameterType="Control" defaultValue="0" dataType="Float" parameterSource="p_attachment_type_id"/>
</USQLParameters>
			<UConditions>
			</UConditions>
			<UFormElements>
				<CustomParameter id="633" field="p_tax_type_id" dataType="Float" parameterType="Control" parameterSource="p_tax_type_id"/>
				<CustomParameter id="634" field="description" dataType="Text" parameterType="Control" parameterSource="description"/>
				<CustomParameter id="635" field="created_by" dataType="Text" parameterType="Control" parameterSource="created_by"/>
				<CustomParameter id="636" field="updated_by" dataType="Text" parameterType="Control" parameterSource="updated_by"/>
				<CustomParameter id="637" field="creation_date" dataType="Text" parameterType="Control" parameterSource="creation_date" format="dd-mmm-yyyy"/>
				<CustomParameter id="638" field="updated_date" dataType="Text" parameterType="Control" parameterSource="updated_date" format="dd-mmm-yyyy"/>
				<CustomParameter id="639" field="listing_no" dataType="Float" parameterType="Control" parameterSource="listing_no"/>
				<CustomParameter id="640" field="code" dataType="Text" parameterType="Control" parameterSource="code"/>
			</UFormElements>
			<DSPParameters/>
			<DSQLParameters>
				<SQLParameter id="668" variable="p_attachment_type_id" parameterType="Control" defaultValue="0" dataType="Float" parameterSource="p_attachment_type_id"/>
			</DSQLParameters>
			<DConditions>
				<TableParameter id="649" conditionType="Parameter" useIsNull="False" field="p_tax_type_id" dataType="Float" searchConditionType="Equal" parameterType="Control" logicOperator="And" parameterSource="p_tax_type_id"/>
			</DConditions>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Record>
	</Components>
	<CodeFiles>
		<CodeFile id="Events" language="PHPTemplates" name="p_attachment_type_events.php" forShow="False" comment="//" codePage="windows-1252"/>
		<CodeFile id="Code" language="PHPTemplates" name="p_attachment_type.php" forShow="True" url="p_attachment_type.php" comment="//" codePage="windows-1252"/>
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
