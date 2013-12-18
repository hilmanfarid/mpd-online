<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\param" secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="RWNet" wizardThemeVersion="3.0" needGeneration="0" pasteActions="pasteActions">
	<Components>
		<Grid id="2" secured="False" sourceType="SQL" returnValueType="Number" defaultPageSize="5" connection="ConnSIKP" name="p_budget_accountGrid" pageSizeLimit="100" wizardCaption="List of P App Role " wizardGridType="Tabular" wizardAllowInsert="True" wizardAltRecord="True" wizardAltRecordType="Style" wizardRecordSeparator="False" wizardNoRecords="-" pasteAsReplace="pasteAsReplace" pasteActions="pasteActions" activeCollection="SQLParameters" parameterTypeListName="ParameterTypeList" orderBy="p_budget_account_id" dataSource="SELECT a.p_budget_type_id, a.coa_code || ' ' ||c.coa_name coa_code, 
a.description, a.p_budget_account_id,
to_char(a.creation_date, 'DD-MON-YYYY') creation_date, a.created_by,
to_char(a.updated_date, 'DD-MON-YYYY') updated_date, a.updated_by
FROM p_budget_account a, p_budget_type b, coa c 
WHERE a.p_budget_type_id = b.p_budget_type_id AND
a.coa_code = c.coa_code AND
a.p_budget_type_id = {p_budget_type_id} AND
(upper(a.coa_code) LIKE '%{s_keyword}%' OR
upper(c.coa_name) LIKE '%{s_keyword}%')
ORDER BY a.p_budget_account_id ASC">
			<Components>
				<Link id="7" visible="Yes" fieldSourceType="DBColumn" dataType="Text" html="False" hrefType="Page" urlType="Relative" preserveParameters="GET" name="Insert_Link" hrefSource="p_budget_account.ccp" removeParameters="p_budget_account_id;s_keyword" wizardThemeItem="FooterA" wizardDefaultValue="Add New" wizardUseTemplateBlock="False" PathID="p_budget_accountGridInsert_Link">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="67" sourceType="Expression" name="FLAG" source="&quot;ADD&quot;"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
				<Link id="11" visible="Yes" fieldSourceType="CodeExpression" html="True" hrefType="Page" urlType="Relative" preserveParameters="GET" name="DLink" wizardCaption="Detail" wizardSize="50" wizardMaxLength="60" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" dataType="Text" wizardDefaultValue="DLink" hrefSource="p_budget_account.ccp" wizardThemeItem="GridA" PathID="p_budget_accountGridDLink" removeParameters="FLAG">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="614" sourceType="DataField" name="p_budget_account_id" source="p_budget_account_id"/>
</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
				<Label id="15" fieldSourceType="DBColumn" dataType="Text" html="False" name="coa_code" fieldSource="coa_code" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="p_budget_accountGridcoa_code">
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
				<Hidden id="13" fieldSourceType="DBColumn" dataType="Float" html="False" name="p_budget_account_id" fieldSource="p_budget_account_id" wizardCaption="Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="p_budget_accountGridp_budget_account_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Label id="17" fieldSourceType="DBColumn" dataType="Text" html="False" name="description" fieldSource="description" wizardCaption="Description" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="p_budget_accountGriddescription">
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
				<SQLParameter id="612" parameterType="URL" variable="s_keyword" dataType="Text" parameterSource="s_keyword"/>
<SQLParameter id="613" variable="p_budget_type_id" parameterType="URL" defaultValue="0" dataType="Float" parameterSource="p_budget_type_id"/>
</SQLParameters>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Grid>
		<Record id="3" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="None" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="p_budget_accountSearch" wizardCaption="Search P App Role " wizardOrientation="Vertical" wizardFormMethod="post" returnPage="p_budget_account.ccp" PathID="p_budget_accountSearch" pasteActions="pasteActions">
			<Components>
				<Button id="4" urlType="Relative" enableValidation="True" isDefault="False" name="Button_DoSearch" operation="Search" wizardCaption="Search" PathID="p_budget_accountSearchButton_DoSearch">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<TextBox id="5" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="s_keyword" wizardCaption="Keyword" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" PathID="p_budget_accountSearchs_keyword">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Hidden id="618" fieldSourceType="DBColumn" dataType="Text" name="p_budget_typeGridPage" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="p_budget_accountSearchp_budget_typeGridPage">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
<Hidden id="619" fieldSourceType="DBColumn" dataType="Float" name="p_budget_type_id" fieldSource="p_budget_type_id" caption="Id" wizardCaption="P App User Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_budget_accountSearchp_budget_type_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
<Hidden id="620" fieldSourceType="DBColumn" dataType="Text" name="budget_s_keyword" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="p_budget_accountSearchbudget_s_keyword">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Hidden>
<Hidden id="621" fieldSourceType="DBColumn" dataType="Text" name="budget_code" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="p_budget_accountSearchbudget_code">
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
		<Record id="94" sourceType="SQL" urlType="Relative" secured="False" allowInsert="True" allowUpdate="True" allowDelete="True" validateData="True" preserveParameters="GET" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" connection="ConnSIKP" name="p_budget_accountForm" errorSummator="Error" wizardCaption="Add/Edit V P App User " wizardFormMethod="post" PathID="p_budget_accountForm" activeCollection="DSQLParameters" pasteAsReplace="pasteAsReplace" pasteActions="pasteActions" customDeleteType="SQL" parameterTypeListName="ParameterTypeList" customUpdateType="SQL" customInsertType="SQL" dataSource="SELECT a.p_budget_type_id, a.coa_code, c.coa_name, 
a.description, a.p_budget_account_id,
to_char(a.creation_date, 'DD-MON-YYYY') creation_date, a.created_by,
to_char(a.updated_date, 'DD-MON-YYYY') updated_date, a.updated_by
FROM p_budget_account a, p_budget_type b, coa c 
WHERE a.p_budget_type_id = b.p_budget_type_id AND
a.coa_code = c.coa_code AND
a.p_budget_account_id = {p_budget_account_id}" customInsert="INSERT INTO p_budget_account(p_budget_account_id, description, created_by, updated_by, creation_date, updated_date, coa_code, p_budget_type_id) 
VALUES(generate_id('sikp','p_budget_account','p_budget_account_id'), '{description}', '{created_by}', '{updated_by}', sysdate, sysdate, '{coa_code}', {p_budget_type_id})" customUpdate="UPDATE p_budget_account SET 
description='{description}', 
updated_by='{updated_by}', 
updated_date=sysdate,
coa_code='{coa_code}'
WHERE p_budget_account_id={p_budget_account_id} " customDelete="DELETE FROM p_budget_account 
WHERE p_budget_account_id = {p_budget_account_id}" activeTableType="customDelete">
			<Components>
				<Button id="95" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Insert" operation="Insert" wizardCaption="Add" PathID="p_budget_accountFormButton_Insert" removeParameters="FLAG">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="96" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Update" operation="Update" wizardCaption="Submit" PathID="p_budget_accountFormButton_Update" removeParameters="FLAG">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="97" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Delete" operation="Delete" wizardCaption="Delete" PathID="p_budget_accountFormButton_Delete" removeParameters="FLAG;p_budget_account_id;s_keyword;p_budget_accountGridPage">
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
				<Button id="99" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Cancel" operation="Cancel" wizardCaption="Cancel" PathID="p_budget_accountFormButton_Cancel" removeParameters="FLAG;p_budget_account_id;s_keyword;p_budget_accountGridPage">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Hidden id="101" fieldSourceType="DBColumn" dataType="Float" name="p_budget_account_id" fieldSource="p_budget_account_id" caption="Id" wizardCaption="P App User Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_budget_accountFormp_budget_account_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<TextBox id="114" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="description" fieldSource="description" required="False" caption="Description" wizardCaption="Description" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_budget_accountFormdescription">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="124" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="created_by" fieldSource="created_by" required="False" caption="Created By" wizardCaption="Created By" wizardSize="16" wizardMaxLength="16" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_budget_accountFormcreated_by" defaultValue="CCGetUserLogin()">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="127" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="updated_by" fieldSource="updated_by" required="False" caption="Updated By" wizardCaption="Updated By" wizardSize="16" wizardMaxLength="16" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_budget_accountFormupdated_by" defaultValue="CCGetUserLogin()">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="122" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="creation_date" fieldSource="creation_date" required="False" caption="Creation Date" wizardCaption="Creation Date" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_budget_accountFormcreation_date" format="dd-mmm-yyyy" defaultValue="date(&quot;d-M-Y&quot;)">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="125" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="updated_date" fieldSource="updated_date" required="False" caption="Updated Date" wizardCaption="Updated Date" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_budget_accountFormupdated_date" defaultValue="date(&quot;d-M-Y&quot;)" format="dd-mmm-yyyy">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Hidden id="165" fieldSourceType="DBColumn" dataType="Text" name="p_budget_accountGridPage" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="p_budget_accountFormp_budget_accountGridPage">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<TextBox id="460" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="coa_code" fieldSource="coa_code" required="True" caption="Kode Anggaran" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_budget_accountFormcoa_code">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="615" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="coa_name" fieldSource="coa_name" required="True" caption="Kode Anggaran" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_budget_accountFormcoa_name">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
<Hidden id="616" fieldSourceType="DBColumn" dataType="Float" name="p_budget_type_id" fieldSource="p_budget_type_id" caption="Idd" wizardCaption="P App User Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_budget_accountFormp_budget_type_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
</Components>
			<Events/>
			<TableParameters>
				<TableParameter id="561" conditionType="Parameter" useIsNull="False" field="p_budget_type_id" dataType="Float" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="p_budget_type_id"/>
			</TableParameters>
			<SPParameters/>
			<SQLParameters>
				<SQLParameter id="570" parameterType="URL" variable="p_budget_account_id" dataType="Float" parameterSource="p_budget_account_id" defaultValue="0"/>
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
				<SQLParameter id="632" variable="description" dataType="Text" parameterType="Control" parameterSource="description"/>
<SQLParameter id="633" variable="created_by" dataType="Text" parameterType="Expression" parameterSource="CCGetUserLogin()"/>
<SQLParameter id="634" variable="updated_by" dataType="Text" parameterType="Expression" parameterSource="CCGetUserLogin()"/>
<SQLParameter id="637" variable="coa_code" dataType="Text" parameterType="Control" parameterSource="coa_code"/>
<SQLParameter id="639" variable="p_budget_type_id" dataType="Float" parameterType="Control" parameterSource="p_budget_type_id"/>
</ISQLParameters>
			<IFormElements>
				<CustomParameter id="622" field="p_budget_account_id" dataType="Float" parameterType="Control" parameterSource="p_budget_account_id"/>
<CustomParameter id="623" field="description" dataType="Text" parameterType="Control" parameterSource="description"/>
<CustomParameter id="624" field="created_by" dataType="Text" parameterType="Control" parameterSource="created_by"/>
<CustomParameter id="625" field="updated_by" dataType="Text" parameterType="Control" parameterSource="updated_by"/>
<CustomParameter id="626" field="creation_date" dataType="Text" parameterType="Control" parameterSource="creation_date" format="dd-mmm-yyyy"/>
<CustomParameter id="627" field="updated_date" dataType="Text" parameterType="Control" parameterSource="updated_date" format="dd-mmm-yyyy"/>
<CustomParameter id="628" field="coa_code" dataType="Text" parameterType="Control" parameterSource="coa_code"/>
<CustomParameter id="629" field="coa_name" dataType="Text" parameterType="Control" parameterSource="coa_name"/>
<CustomParameter id="630" field="p_budget_type_id" dataType="Float" parameterType="Control" parameterSource="p_budget_type_id"/>
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
				<SQLParameter id="649" variable="p_budget_account_id" dataType="Float" parameterType="Control" parameterSource="p_budget_account_id"/>
<SQLParameter id="650" variable="description" dataType="Text" parameterType="Control" parameterSource="description"/>
<SQLParameter id="652" variable="updated_by" dataType="Text" parameterType="Expression" parameterSource="CCGetUserLogin()"/>
<SQLParameter id="655" variable="coa_code" dataType="Text" parameterType="Control" parameterSource="coa_code"/>
</USQLParameters>
			<UConditions>
			</UConditions>
			<UFormElements>
				<CustomParameter id="640" field="p_budget_account_id" dataType="Float" parameterType="Control" parameterSource="p_budget_account_id"/>
<CustomParameter id="641" field="description" dataType="Text" parameterType="Control" parameterSource="description"/>
<CustomParameter id="642" field="created_by" dataType="Text" parameterType="Control" parameterSource="created_by"/>
<CustomParameter id="643" field="updated_by" dataType="Text" parameterType="Control" parameterSource="updated_by"/>
<CustomParameter id="644" field="creation_date" dataType="Text" parameterType="Control" parameterSource="creation_date" format="dd-mmm-yyyy"/>
<CustomParameter id="645" field="updated_date" dataType="Text" parameterType="Control" parameterSource="updated_date" format="dd-mmm-yyyy"/>
<CustomParameter id="646" field="coa_code" dataType="Text" parameterType="Control" parameterSource="coa_code"/>
<CustomParameter id="647" field="coa_name" dataType="Text" parameterType="Control" parameterSource="coa_name"/>
<CustomParameter id="648" field="p_budget_type_id" dataType="Float" parameterType="Control" parameterSource="p_budget_type_id"/>
</UFormElements>
			<DSPParameters/>
			<DSQLParameters>
				<SQLParameter id="657" variable="p_budget_account_id" parameterType="Control" dataType="Float" parameterSource="p_budget_account_id" defaultValue="0"/>
</DSQLParameters>
			<DConditions>
				<TableParameter id="656" conditionType="Parameter" useIsNull="False" field="p_budget_account_id" dataType="Float" searchConditionType="Equal" parameterType="Control" logicOperator="And" parameterSource="p_budget_account_id"/>
</DConditions>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Record>
		<Label id="617" fieldSourceType="DBColumn" dataType="Text" html="False" name="budget_code" PathID="budget_code">
			<Components/>
			<Events/>
			<Attributes/>
			<Features/>
		</Label>
</Components>
	<CodeFiles>
		<CodeFile id="Events" language="PHPTemplates" name="p_budget_account_events.php" forShow="False" comment="//" codePage="windows-1252"/>
		<CodeFile id="Code" language="PHPTemplates" name="p_budget_account.php" forShow="True" url="p_budget_account.php" comment="//" codePage="windows-1252"/>
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
