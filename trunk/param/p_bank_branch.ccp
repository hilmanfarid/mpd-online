<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\param" secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="RWNet" wizardThemeVersion="3.0" needGeneration="0" pasteActions="pasteActions">
	<Components>
		<Grid id="3" secured="False" sourceType="SQL" returnValueType="Number" defaultPageSize="5" connection="ConnSIKP" name="p_app_user_roleGrid" pageSizeLimit="100" wizardCaption="List of V P Module Role " wizardGridType="Tabular" wizardAllowInsert="True" wizardAltRecord="True" wizardAltRecordType="Style" wizardRecordSeparator="False" wizardNoRecords="-" activeCollection="SQLParameters" pasteActions="pasteActions" parameterTypeListName="ParameterTypeList" dataSource="SELECT * 
FROM p_bank_branch
WHERE p_bank_id = {p_bank_id}
AND ( upper(code) LIKE '%{s_keyword}%'
OR upper(branch_name) LIKE '%{s_keyword}%'
OR upper(description) LIKE '%{s_keyword}%' ) ">
			<Components>
				<Link id="12" visible="Yes" fieldSourceType="CodeExpression" html="True" hrefType="Page" urlType="Relative" preserveParameters="GET" name="DLink" wizardCaption="Detail" wizardSize="50" wizardMaxLength="60" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" dataType="Text" wizardDefaultValue="DLink" hrefSource="p_bank_branch.ccp" wizardThemeItem="GridA" PathID="p_app_user_roleGridDLink" removeParameters="FLAG">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="13" sourceType="DataField" format="yyyy-mm-dd" name="p_bank_branch_id" source="p_bank_branch_id"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
				<Hidden id="14" fieldSourceType="DBColumn" dataType="Float" html="False" name="p_bank_branch_id" fieldSource="p_bank_branch_id" wizardCaption="P Module Role Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="p_app_user_roleGridp_bank_branch_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Label id="16" fieldSourceType="DBColumn" dataType="Text" html="False" name="branch_name" fieldSource="branch_name" wizardCaption="P App Role Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="p_app_user_roleGridbranch_name">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="18" fieldSourceType="DBColumn" dataType="Text" html="False" name="description" fieldSource="description" wizardCaption="Description" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="p_app_user_roleGriddescription">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="20" fieldSourceType="DBColumn" dataType="Text" html="False" name="code" fieldSource="code" wizardCaption="Valid From" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="p_app_user_roleGridcode">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="22" fieldSourceType="DBColumn" dataType="Text" html="False" name="parent_code" fieldSource="parent_code" wizardCaption="Valid To" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="p_app_user_roleGridparent_code">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Navigator id="23" size="10" type="Centered" pageSizes="1;5;10;25;50" name="Navigator" wizardPagingType="Custom" wizardFirst="True" wizardFirstText="First" wizardPrev="True" wizardPrevText="Prev" wizardNext="True" wizardNextText="Next" wizardLast="True" wizardLastText="Last" wizardImages="Images" wizardPageNumbers="Centered" wizardSize="10" wizardTotalPages="False" wizardHideDisabled="False" wizardOfText="of" wizardPageSize="False" wizardImagesScheme="Rwnet">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Navigator>
				<Link id="7" visible="Yes" fieldSourceType="DBColumn" dataType="Text" html="False" hrefType="Page" urlType="Relative" preserveParameters="GET" name="Insert_Link" hrefSource="p_bank_branch.ccp" removeParameters="p_app_user_role_id" wizardThemeItem="FooterA" wizardDefaultValue="Add New" wizardUseTemplateBlock="False" PathID="p_app_user_roleGridInsert_Link">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="101" sourceType="Expression" name="FLAG" source="&quot;ADD&quot;"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
				<Label id="167" fieldSourceType="DBColumn" dataType="Text" html="False" name="maximum_user" fieldSource="maximum_user" wizardCaption="Valid From" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="p_app_user_roleGridmaximum_user">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
</Components>
			<Events>
				<Event name="BeforeShowRow" type="Server">
					<Actions>
						<Action actionName="Set Row Style" actionCategory="General" id="11" styles="Row;AltRow" name="rowStyle"/>
					</Actions>
				</Event>
				<Event name="BeforeSelect" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="95"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
				<TableParameter id="162" conditionType="Parameter" useIsNull="False" field="p_app_user_id" dataType="Float" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="p_app_user_id"/>
				<TableParameter id="163" conditionType="Parameter" useIsNull="False" field="upper(code)" dataType="Text" searchConditionType="Contains" parameterType="URL" logicOperator="Or" parameterSource="s_keyword" leftBrackets="1"/>
				<TableParameter id="164" conditionType="Parameter" useIsNull="False" field="upper(description)" dataType="Text" searchConditionType="Contains" parameterType="URL" logicOperator="And" parameterSource="s_keyword" rightBrackets="1"/>
			</TableParameters>
			<JoinTables>
			</JoinTables>
			<JoinLinks>
			</JoinLinks>
			<Fields>
				<Field id="154" fieldName="*"/>
			</Fields>
			<SPParameters/>
			<SQLParameters>
				<SQLParameter id="168" parameterType="URL" variable="p_bank_id" dataType="Float" parameterSource="p_bank_id" defaultValue="0"/>
<SQLParameter id="169" parameterType="URL" variable="s_keyword" dataType="Text" parameterSource="s_keyword"/>
</SQLParameters>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Grid>
		<Record id="24" sourceType="SQL" urlType="Relative" secured="False" allowInsert="True" allowUpdate="True" allowDelete="True" validateData="True" preserveParameters="GET" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" connection="ConnSIKP" name="p_app_user_roleForm" errorSummator="Error" wizardCaption="Add/Edit V P Module Role " wizardFormMethod="post" PathID="p_app_user_roleForm" pasteAsReplace="pasteAsReplace" pasteActions="pasteActions" customDelete="DELETE FROM p_bank_branch WHERE p_bank_branch_id = {p_bank_branch_id}" customDeleteType="SQL" activeCollection="USQLParameters" parameterTypeListName="ParameterTypeList" customUpdate="UPDATE p_bank_branch SET 
branch_name = '{branch_name}',
code='{code}', 
parent_code='{parent_code}',
update_by='{updated_by}', 
update_date=sysdate, 
description='{description}', 
maximum_user={maximum_user}
WHERE  p_bank_branch_id = {p_bank_branch_id}" customUpdateType="SQL" customInsert="INSERT INTO p_bank_branch(p_bank_branch_id, 
branch_name,
p_bank_id, 
code, 
parent_code,  
update_by, 
update_date, 
description,
maximum_user) 
VALUES(generate_id('sikp','p_bank_branch','p_bank_branch_id'), 
'{branch_name}',
{p_bank_id}, 
'{code}', 
'{parent_code}',
'{update_by}',  
sysdate,
'{description}', 
{maximum_user})" customInsertType="SQL" dataSource="SELECT * 
FROM p_bank_branch
WHERE p_bank_branch_id = {p_bank_branch_id} ">
			<Components>
				<Button id="25" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Insert" operation="Insert" wizardCaption="Add" PathID="p_app_user_roleFormButton_Insert" removeParameters="FLAG">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="26" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Update" operation="Update" wizardCaption="Submit" PathID="p_app_user_roleFormButton_Update" removeParameters="FLAG">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="27" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Delete" operation="Delete" wizardCaption="Delete" PathID="p_app_user_roleFormButton_Delete" removeParameters="FLAG;p_app_user_role_id;s_keyword;p_app_user_roleGridPage">
					<Components/>
					<Events>
						<Event name="OnClick" type="Client">
							<Actions>
								<Action actionName="Confirmation Message" actionCategory="General" id="28" message="Delete record?"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="29" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Cancel" operation="Cancel" wizardCaption="Cancel" PathID="p_app_user_roleFormButton_Cancel" removeParameters="FLAG;p_app_user_role_id;s_keyword;p_app_user_roleGridPage">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Hidden id="31" fieldSourceType="DBColumn" dataType="Float" name="p_bank_branch_id" fieldSource="p_bank_branch_id" required="False" caption="p_bank_branch_id" wizardCaption="P Module Role Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_app_user_roleFormp_bank_branch_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<TextBox id="33" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="code" fieldSource="code" required="False" caption="Kode" wizardCaption="P App Role Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_app_user_roleFormcode">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Hidden id="34" fieldSourceType="DBColumn" dataType="Float" name="p_bank_id" fieldSource="p_bank_id" required="False" caption="p_app_user_id" wizardCaption="P Module Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_app_user_roleFormp_bank_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<TextBox id="39" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="description" fieldSource="description" required="False" caption="Description" wizardCaption="Description" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_app_user_roleFormdescription">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="45" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="update_by" fieldSource="update_by" required="True" caption="Update By" wizardCaption="Updated By" wizardSize="16" wizardMaxLength="16" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_app_user_roleFormupdate_by" defaultValue="CCGetUserLogin()">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="43" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="update_date" fieldSource="update_date" required="True" caption="Update Date" wizardCaption="Updated Date" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_app_user_roleFormupdate_date" format="dd-mmm-yyyy" defaultValue="date(&quot;d-M-Y&quot;)">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="170" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="branch_name" fieldSource="branch_name" required="False" caption="Nama Cabang" wizardCaption="P App Role Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_app_user_roleFormbranch_name">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
<TextBox id="171" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="maximum_user" fieldSource="maximum_user" required="False" caption="Jumlah Maksimal Pengguna" wizardCaption="Description" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_app_user_roleFormmaximum_user">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
<TextBox id="172" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="parent_code" fieldSource="parent_code" required="False" caption="Kode Bank" wizardCaption="P App Role Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_app_user_roleFormparent_code">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
</Components>
			<Events/>
			<TableParameters>
				<TableParameter id="160" conditionType="Parameter" useIsNull="False" field="p_app_user_role_id" dataType="Float" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="p_app_user_role_id"/>
			</TableParameters>
			<SPParameters/>
			<SQLParameters>
				<SQLParameter id="156" variable="p_bank_branch_id" parameterType="URL" defaultValue="0" dataType="Float" parameterSource="p_bank_branch_id"/>
			</SQLParameters>
			<JoinTables>
				<JoinTable id="159" tableName="v_p_app_user_role" posLeft="10" posTop="10" posWidth="150" posHeight="180"/>
			</JoinTables>
			<JoinLinks>
			</JoinLinks>
			<Fields>
				<Field id="155" fieldName="*"/>
			</Fields>
			<ISPParameters/>
			<ISQLParameters>
				<SQLParameter id="173" variable="p_bank_id" parameterType="Control" defaultValue="0" dataType="Integer" parameterSource="p_bank_id"/>
<SQLParameter id="174" variable="code" parameterType="Control" dataType="Text" parameterSource="code"/>
<SQLParameter id="175" variable="parent_code" parameterType="Control" dataType="Text" parameterSource="parent_code"/>
<SQLParameter id="176" variable="update_by" parameterType="Expression" dataType="Text" parameterSource="CCGetUserLogin()"/>
<SQLParameter id="177" variable="description" parameterType="Control" dataType="Text" parameterSource="description"/>
<SQLParameter id="178" variable="maximum_user" parameterType="Control" dataType="Integer" parameterSource="maximum_user" defaultValue="0"/>
<SQLParameter id="185" variable="branch_name" parameterType="Control" dataType="Text" parameterSource="branch_name"/>
</ISQLParameters>
			<IFormElements>
				<CustomParameter id="131" field="p_app_user_role_id" dataType="Float" parameterType="Control" parameterSource="p_app_user_role_id"/>
				<CustomParameter id="132" field="code" dataType="Text" parameterType="Control" parameterSource="role_code"/>
				<CustomParameter id="133" field="p_app_user_id" dataType="Float" parameterType="Control" parameterSource="p_app_user_id"/>
				<CustomParameter id="134" field="to_char(p_app_user_role.valid_from,'DD-MON-YYYY')" dataType="Text" parameterType="Control" parameterSource="valid_from" format="dd-mmm-yyyy"/>
				<CustomParameter id="135" field="p_app_user_role.description" dataType="Text" parameterType="Control" parameterSource="description"/>
				<CustomParameter id="136" field="p_app_user_role.created_by" dataType="Text" parameterType="Control" parameterSource="created_by"/>
				<CustomParameter id="137" field="p_app_user_role.updated_by" dataType="Text" parameterType="Control" parameterSource="updated_by"/>
				<CustomParameter id="138" field="to_char(p_app_user_role.creation_date,'DD-MON-YYYY')" dataType="Text" parameterType="Control" parameterSource="creation_date" format="dd-mmm-yyyy"/>
				<CustomParameter id="139" field="to_char(p_app_user_role.updated_date,'DD-MON-YYYY')" dataType="Text" parameterType="Control" parameterSource="updated_date" format="dd-mmm-yyyy"/>
				<CustomParameter id="140" field="to_char(p_app_user_role.valid_to,'DD-MON-YYYY')" dataType="Text" parameterType="Control" parameterSource="valid_to" format="dd-mmm-yyyy"/>
				<CustomParameter id="141" field="p_app_user_role.p_app_role_id" dataType="Float" parameterType="Control" parameterSource="p_app_role_id"/>
			</IFormElements>
			<USPParameters/>
			<USQLParameters>
				<SQLParameter id="179" variable="code" parameterType="Control" dataType="Text" parameterSource="code"/>
<SQLParameter id="180" variable="parent_code" parameterType="Control" dataType="Text" parameterSource="parent_code"/>
<SQLParameter id="181" variable="update_by" parameterType="Expression" dataType="Text" parameterSource="CCGetUserLogin()"/>
<SQLParameter id="182" variable="description" parameterType="Control" dataType="Text" parameterSource="description"/>
<SQLParameter id="183" variable="maximum_user" parameterType="Control" dataType="Integer" parameterSource="maximum_user" defaultValue="0"/>
<SQLParameter id="184" variable="p_bank_branch_id" parameterType="Control" defaultValue="0" dataType="Integer" parameterSource="p_bank_branch_id"/>
<SQLParameter id="186" variable="branch_name" parameterType="Control" dataType="Text" parameterSource="branch_name"/>
</USQLParameters>
			<UConditions>
				<TableParameter id="54" conditionType="Parameter" useIsNull="False" field="p_app_user_role_id" dataType="Float" parameterType="Control" searchConditionType="Equal" logicOperator="And" orderNumber="1" parameterSource="p_app_user_role_id"/>
			</UConditions>
			<UFormElements>
				<CustomParameter id="56" field="p_app_role_id" dataType="Float" parameterType="Control" parameterSource="p_app_role_id" omitIfEmpty="True"/>
				<CustomParameter id="59" field="valid_from" dataType="Date" parameterType="Control" parameterSource="valid_from" format="dd-mmm-yyyy" omitIfEmpty="True"/>
				<CustomParameter id="60" field="description" dataType="Text" parameterType="Control" parameterSource="description" omitIfEmpty="True"/>
				<CustomParameter id="62" field="updated_by" dataType="Text" parameterType="Session" parameterSource="UserName" omitIfEmpty="True"/>
				<CustomParameter id="64" field="updated_date" dataType="Date" parameterType="Expression" parameterSource="sysdate" format="dd-mmm-yyyy" omitIfEmpty="True"/>
				<CustomParameter id="65" field="valid_to" dataType="Date" parameterType="Control" parameterSource="valid_to" omitIfEmpty="True"/>
				<CustomParameter id="66" field="valid_to" dataType="Date" parameterType="Control" omitIfEmpty="True" parameterSource="valid_to"/>
			</UFormElements>
			<DSPParameters/>
			<DSQLParameters>
				<SQLParameter id="53" variable="p_bank_branch_id" parameterType="Control" dataType="Float" parameterSource="p_bank_branch_id" defaultValue="0"/>
			</DSQLParameters>
			<DConditions>
				<TableParameter id="52" conditionType="Parameter" useIsNull="False" field="p_app_user_role_id" dataType="Float" parameterType="Control" searchConditionType="Equal" logicOperator="And" orderNumber="1" parameterSource="p_app_user_role_id"/>
			</DConditions>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Record>
		<Record id="100" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="None" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="p_app_user_roleSearch" wizardCaption="Search P App Role " wizardOrientation="Vertical" wizardFormMethod="post" returnPage="p_bank_branch.ccp" PathID="p_app_user_roleSearch" pasteActions="pasteActions">
			<Components>
				<Button id="4" urlType="Relative" enableValidation="True" isDefault="False" name="Button_DoSearch" operation="Search" wizardCaption="Search" PathID="p_app_user_roleSearchButton_DoSearch">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<TextBox id="5" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="s_keyword" wizardCaption="Keyword" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" PathID="p_app_user_roleSearchs_keyword">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Hidden id="113" fieldSourceType="DBColumn" dataType="Float" html="False" name="p_bank_id" wizardCaption="P Module Role Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="p_app_user_roleSearchp_bank_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="165" fieldSourceType="DBColumn" dataType="Text" name="p_app_userGridPage" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="p_app_user_roleSearchp_app_userGridPage">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="166" fieldSourceType="DBColumn" dataType="Text" name="user_s_keyword" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="p_app_user_roleSearchuser_s_keyword">
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
		<Label id="2" fieldSourceType="DBColumn" dataType="Text" html="False" name="app_user_name" PathID="app_user_name">
			<Components/>
			<Events/>
			<Attributes/>
			<Features/>
		</Label>
	</Components>
	<CodeFiles>
		<CodeFile id="Events" language="PHPTemplates" name="p_bank_branch_events.php" forShow="False" comment="//" codePage="windows-1252"/>
		<CodeFile id="Code" language="PHPTemplates" name="p_bank_branch.php" forShow="True" url="p_bank_branch.php" comment="//" codePage="windows-1252"/>
	</CodeFiles>
	<SecurityGroups/>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events>
		<Event name="OnInitializeView" type="Server">
			<Actions>
				<Action actionName="Custom Code" actionCategory="General" id="51"/>
			</Actions>
		</Event>
	</Events>
</Page>
