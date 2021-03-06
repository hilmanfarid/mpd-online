<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\param" secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="RWNet" wizardThemeVersion="3.0" needGeneration="0" pasteActions="pasteActions">
	<Components>
		<Grid id="3" secured="False" sourceType="Table" returnValueType="Number" defaultPageSize="5" connection="ConnSIKP" name="p_app_role_menuGrid" pageSizeLimit="100" wizardCaption="List of V P Module Role " wizardGridType="Tabular" wizardAllowInsert="True" wizardAltRecord="True" wizardAltRecordType="Style" wizardRecordSeparator="False" wizardNoRecords="-" activeCollection="TableParameters" pasteActions="pasteActions" parameterTypeListName="ParameterTypeList" dataSource="v_p_app_role_menu" orderBy="p_app_role_menu_id">
			<Components>
				<Link id="12" visible="Yes" fieldSourceType="CodeExpression" html="True" hrefType="Page" urlType="Relative" preserveParameters="GET" name="DLink" wizardCaption="Detail" wizardSize="50" wizardMaxLength="60" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" dataType="Text" wizardDefaultValue="DLink" hrefSource="p_app_role_menu.ccp" wizardThemeItem="GridA" PathID="p_app_role_menuGridDLink" removeParameters="FLAG">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="170" sourceType="DataField" name="p_app_role_menu_id" source="p_app_role_menu_id"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
				<Hidden id="14" fieldSourceType="DBColumn" dataType="Float" html="False" name="p_app_role_menu_id" fieldSource="p_app_role_menu_id" wizardCaption="P Module Role Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="p_app_role_menuGridp_app_role_menu_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Label id="16" fieldSourceType="DBColumn" dataType="Text" html="False" name="role_code" fieldSource="role_code" wizardCaption="P App Role Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="p_app_role_menuGridrole_code">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="18" fieldSourceType="DBColumn" dataType="Text" html="False" name="description" fieldSource="description" wizardCaption="Description" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="p_app_role_menuGriddescription">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="20" fieldSourceType="DBColumn" dataType="Text" html="False" name="valid_from" fieldSource="valid_from" wizardCaption="Valid From" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="p_app_role_menuGridvalid_from">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="22" fieldSourceType="DBColumn" dataType="Text" html="False" name="valid_to" fieldSource="valid_to" wizardCaption="Valid To" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="p_app_role_menuGridvalid_to">
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
				<Link id="7" visible="Yes" fieldSourceType="DBColumn" dataType="Text" html="False" hrefType="Page" urlType="Relative" preserveParameters="GET" name="Insert_Link" hrefSource="p_app_role_menu.ccp" removeParameters="p_app_role_menu_id;s_keyword" wizardThemeItem="FooterA" wizardDefaultValue="Add New" wizardUseTemplateBlock="False" PathID="p_app_role_menuGridInsert_Link">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="101" sourceType="Expression" name="FLAG" source="&quot;ADD&quot;"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
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
				<TableParameter id="167" conditionType="Parameter" useIsNull="False" field="p_app_menu_id" dataType="Float" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="p_app_menu_id"/>
				<TableParameter id="163" conditionType="Parameter" useIsNull="False" field="upper(role_code)" dataType="Text" searchConditionType="Contains" parameterType="URL" logicOperator="Or" leftBrackets="1" parameterSource="s_keyword"/>
				<TableParameter id="164" conditionType="Parameter" useIsNull="False" field="upper(description)" dataType="Text" searchConditionType="Contains" parameterType="URL" logicOperator="And" parameterSource="s_keyword" rightBrackets="1"/>
			</TableParameters>
			<JoinTables>
				<JoinTable id="166" tableName="v_p_app_role_menu" posLeft="10" posTop="10" posWidth="157" posHeight="180"/>
			</JoinTables>
			<JoinLinks>
			</JoinLinks>
			<Fields>
				<Field id="154" fieldName="*"/>
			</Fields>
			<SPParameters/>
			<SQLParameters>
			</SQLParameters>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Grid>
		<Record id="24" sourceType="Table" urlType="Relative" secured="False" allowInsert="True" allowUpdate="True" allowDelete="True" validateData="True" preserveParameters="GET" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" connection="ConnSIKP" name="p_app_role_menuForm" errorSummator="Error" wizardCaption="Add/Edit V P Module Role " wizardFormMethod="post" PathID="p_app_role_menuForm" pasteAsReplace="pasteAsReplace" pasteActions="pasteActions" customDelete="DELETE FROM p_app_role_menu 
WHERE  p_app_role_menu_id = {p_app_role_menu_id}" customDeleteType="SQL" activeCollection="DSQLParameters" parameterTypeListName="ParameterTypeList" customUpdate="UPDATE p_app_role_menu SET 
p_app_role_id={p_app_role_id}, 
valid_from=to_date('{valid_from}','DD-MON-YYYY'), 
description='{description}', 
updated_by='{updated_by}', 
updated_date=sysdate, 
valid_to=case when '{valid_to}' = '' then null else to_date('{valid_to}','DD-MON-YYYY') end
WHERE p_app_role_menu_id = {p_app_role_menu_id}" customUpdateType="SQL" customInsert="INSERT INTO p_app_role_menu(p_app_role_menu_id, 
p_app_menu_id, 
valid_from, 
description, 
created_by, 
updated_by, 
creation_date, 
updated_date, 
valid_to, 
p_app_role_id) 
VALUES(generate_id('sikp','p_app_role_menu','p_app_role_menu_id'), 
{p_app_menu_id}, 
to_date('{valid_from}','DD-MON-YYYY'), 
'{description}', 
'{created_by}', 
'{updated_by}', 
sysdate, sysdate, 
case when '{valid_to}' = '' then null else to_date('{valid_to}','DD-MON-YYYY') end, 
{p_app_role_id})" customInsertType="SQL" dataSource="v_p_app_role_menu" activeTableType="customDelete">
			<Components>
				<Button id="25" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Insert" operation="Insert" wizardCaption="Add" PathID="p_app_role_menuFormButton_Insert" removeParameters="FLAG">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="26" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Update" operation="Update" wizardCaption="Submit" PathID="p_app_role_menuFormButton_Update" removeParameters="FLAG">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="27" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Delete" operation="Delete" wizardCaption="Delete" PathID="p_app_role_menuFormButton_Delete" removeParameters="p_app_role_menu_id;s_keyword;FLAG;p_app_role_menuGridPage">
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
				<Button id="29" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Cancel" operation="Cancel" wizardCaption="Cancel" PathID="p_app_role_menuFormButton_Cancel" removeParameters="p_app_role_menu_id;s_keyword;FLAG;p_app_role_menuGridPage">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Hidden id="31" fieldSourceType="DBColumn" dataType="Float" name="p_app_role_menu_id" fieldSource="p_app_role_menu_id" required="False" caption="p_app_role_menu_id" wizardCaption="P Module Role Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_app_role_menuFormp_app_role_menu_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<TextBox id="33" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="role_code" fieldSource="role_code" required="False" caption="Role" wizardCaption="P App Role Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_app_role_menuFormrole_code">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Hidden id="34" fieldSourceType="DBColumn" dataType="Float" name="p_app_menu_id" fieldSource="p_app_menu_id" required="False" caption="p_app_menu_id" wizardCaption="P Module Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_app_role_menuFormp_app_menu_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<TextBox id="35" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="valid_from" fieldSource="valid_from" required="True" caption="Valid From" wizardCaption="Valid From" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_app_role_menuFormvalid_from" format="dd-mmm-yyyy" defaultValue="date(&quot;d-M-Y&quot;)">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<DatePicker id="36" name="DatePicker_valid_from" control="valid_from" wizardSatellite="True" wizardControl="valid_from" wizardDatePickerType="Image" wizardPicture="../Styles/RWNet/Images/DatePicker.gif" style="../Styles/RWNet/Style.css" PathID="p_app_role_menuFormDatePicker_valid_from">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</DatePicker>
				<TextBox id="39" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="description" fieldSource="description" required="False" caption="Description" wizardCaption="Description" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_app_role_menuFormdescription">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="42" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="created_by" fieldSource="created_by" required="True" caption="Created By" wizardCaption="Created By" wizardSize="16" wizardMaxLength="16" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_app_role_menuFormcreated_by" defaultValue="CCGetUserLogin()">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="45" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="updated_by" fieldSource="updated_by" required="True" caption="Updated By" wizardCaption="Updated By" wizardSize="16" wizardMaxLength="16" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_app_role_menuFormupdated_by" defaultValue="CCGetUserLogin()">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="40" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="creation_date" fieldSource="creation_date" required="True" caption="Creation Date" wizardCaption="Creation Date" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_app_role_menuFormcreation_date" format="dd-mmm-yyyy" defaultValue="date(&quot;d-M-Y&quot;)">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="43" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="updated_date" fieldSource="updated_date" required="True" caption="Updated Date" wizardCaption="Updated Date" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_app_role_menuFormupdated_date" format="dd-mmm-yyyy" defaultValue="date(&quot;d-M-Y&quot;)">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="37" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="valid_to" fieldSource="valid_to" required="False" caption="Valid To" wizardCaption="Valid To" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_app_role_menuFormvalid_to" format="dd-mmm-yyyy">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<DatePicker id="38" name="DatePicker_valid_to" control="valid_to" wizardSatellite="True" wizardControl="valid_to" wizardDatePickerType="Image" wizardPicture="../Styles/RWNet/Images/DatePicker.gif" style="../Styles/RWNet/Style.css" PathID="p_app_role_menuFormDatePicker_valid_to">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</DatePicker>
				<Hidden id="32" fieldSourceType="DBColumn" dataType="Float" name="p_app_role_id" fieldSource="p_app_role_id" required="True" caption="Role" wizardCaption="P App Role Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_app_role_menuFormp_app_role_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
			</Components>
			<Events/>
			<TableParameters>
				<TableParameter id="169" conditionType="Parameter" useIsNull="False" field="p_app_role_menu_id" dataType="Float" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="p_app_role_menu_id"/>
			</TableParameters>
			<SPParameters/>
			<SQLParameters>
				<SQLParameter id="156" variable="p_app_user_id" parameterType="URL" defaultValue="0" dataType="Float" parameterSource="p_app_user_id"/>
				<SQLParameter id="157" variable="p_app_user_role_id" parameterType="URL" defaultValue="0" dataType="Float" parameterSource="p_app_user_role_id"/>
			</SQLParameters>
			<JoinTables>
				<JoinTable id="168" tableName="v_p_app_role_menu" posLeft="10" posTop="10" posWidth="157" posHeight="180"/>
			</JoinTables>
			<JoinLinks>
			</JoinLinks>
			<Fields>
				<Field id="155" fieldName="*"/>
			</Fields>
			<ISPParameters/>
			<ISQLParameters>
				<SQLParameter id="144" variable="p_app_menu_id" dataType="Float" parameterType="Control" parameterSource="p_app_menu_id" defaultValue="0"/>
				<SQLParameter id="145" variable="valid_from" dataType="Text" parameterType="Control" parameterSource="valid_from" format="dd-mmm-yyyy"/>
				<SQLParameter id="146" variable="description" dataType="Text" parameterType="Control" parameterSource="description"/>
				<SQLParameter id="147" variable="created_by" dataType="Text" parameterType="Expression" parameterSource="CCGetUserLogin()"/>
				<SQLParameter id="148" variable="updated_by" dataType="Text" parameterType="Expression" parameterSource="CCGetUserLogin()"/>
				<SQLParameter id="151" variable="valid_to" dataType="Text" parameterType="Control" parameterSource="valid_to" format="dd-mmm-yyyy"/>
				<SQLParameter id="152" variable="p_app_role_id" dataType="Float" parameterType="Control" parameterSource="p_app_role_id"/>
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
				<SQLParameter id="67" variable="p_app_role_id" dataType="Float" parameterType="Control" parameterSource="p_app_role_id"/>
				<SQLParameter id="68" variable="valid_from" dataType="Text" parameterType="Control" parameterSource="valid_from"/>
				<SQLParameter id="69" variable="description" dataType="Text" parameterType="Control" parameterSource="description"/>
				<SQLParameter id="70" variable="updated_by" dataType="Text" parameterType="Expression" parameterSource="CCGetUserLogin()"/>
				<SQLParameter id="72" variable="valid_to" dataType="Text" parameterType="Control" parameterSource="valid_to"/>
				<SQLParameter id="73" variable="p_app_role_menu_id" parameterType="Control" dataType="Float" parameterSource="p_app_role_menu_id" defaultValue="0"/>
			</USQLParameters>
			<UConditions>
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
				<SQLParameter id="172" variable="p_app_role_menu_id" parameterType="Control" dataType="Float" parameterSource="p_app_role_menu_id" defaultValue="0"/>
			</DSQLParameters>
			<DConditions>
			</DConditions>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Record>
		<Record id="100" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="None" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="p_app_role_menuSearch" wizardCaption="Search P App Role " wizardOrientation="Vertical" wizardFormMethod="post" returnPage="p_app_role_menu.ccp" PathID="p_app_role_menuSearch" pasteActions="pasteActions">
			<Components>
				<Button id="4" urlType="Relative" enableValidation="True" isDefault="False" name="Button_DoSearch" operation="Search" wizardCaption="Search" PathID="p_app_role_menuSearchButton_DoSearch">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<TextBox id="5" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="s_keyword" wizardCaption="Keyword" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" PathID="p_app_role_menuSearchs_keyword">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Hidden id="113" fieldSourceType="DBColumn" dataType="Float" html="False" name="p_app_menu_id" wizardCaption="P Module Role Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="p_app_role_menuSearchp_app_menu_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="153" fieldSourceType="DBColumn" dataType="Text" html="False" name="code" wizardCaption="P Module Role Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="p_app_role_menuSearchcode">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="165" fieldSourceType="DBColumn" dataType="Text" name="p_app_menuGridPage" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="p_app_role_menuSearchp_app_menuGridPage">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="173" fieldSourceType="DBColumn" dataType="Text" name="p_applicationGridPage" wizardCaption="Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_app_role_menuSearchp_applicationGridPage">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="174" fieldSourceType="DBColumn" dataType="Text" name="app_s_keyword" wizardCaption="Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_app_role_menuSearchapp_s_keyword">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="175" fieldSourceType="DBColumn" dataType="Float" html="False" name="p_application_id" wizardCaption="P Module Role Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="p_app_role_menuSearchp_application_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="176" fieldSourceType="DBColumn" dataType="Text" name="menu_s_keyword" wizardCaption="Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_app_role_menuSearchmenu_s_keyword">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="177" fieldSourceType="DBColumn" dataType="Text" html="False" name="parent_id" wizardCaption="P Module Role Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="p_app_role_menuSearchparent_id">
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
		<Label id="2" fieldSourceType="DBColumn" dataType="Text" html="False" name="code" PathID="code">
			<Components/>
			<Events/>
			<Attributes/>
			<Features/>
		</Label>
	</Components>
	<CodeFiles>
		<CodeFile id="Events" language="PHPTemplates" name="p_app_role_menu_events.php" forShow="False" comment="//" codePage="windows-1252"/>
		<CodeFile id="Code" language="PHPTemplates" name="p_app_role_menu.php" forShow="True" url="p_app_role_menu.php" comment="//" codePage="windows-1252"/>
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
