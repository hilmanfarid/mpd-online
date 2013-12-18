<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\param" secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="RWNet" wizardThemeVersion="3.0" needGeneration="0" pasteActions="pasteActions">
	<Components>
		<Grid id="3" secured="False" sourceType="Table" returnValueType="Number" defaultPageSize="5" connection="ConnSIKP" name="p_global_paramGrid" pageSizeLimit="100" wizardCaption="List of V P Module Role " wizardGridType="Tabular" wizardAllowInsert="True" wizardAltRecord="True" wizardAltRecordType="Style" wizardRecordSeparator="False" wizardNoRecords="-" activeCollection="TableParameters" pasteActions="pasteActions" parameterTypeListName="ParameterTypeList" dataSource="p_global_param" orderBy="p_global_param_id desc">
			<Components>
				<Link id="12" visible="Yes" fieldSourceType="CodeExpression" html="True" hrefType="Page" urlType="Relative" preserveParameters="GET" name="DLink" wizardCaption="Detail" wizardSize="50" wizardMaxLength="60" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" dataType="Text" wizardDefaultValue="DLink" hrefSource="p_global_param.ccp" wizardThemeItem="GridA" PathID="p_global_paramGridDLink" removeParameters="FLAG">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="201" sourceType="DataField" name="p_global_param_id" source="p_global_param_id"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
				<Hidden id="14" fieldSourceType="DBColumn" dataType="Float" html="False" name="p_global_param_id" fieldSource="p_global_param_id" wizardCaption="P Module Role Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="p_global_paramGridp_global_param_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Label id="16" fieldSourceType="DBColumn" dataType="Text" html="False" name="code" fieldSource="code" wizardCaption="P App Role Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="p_global_paramGridcode">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="18" fieldSourceType="DBColumn" dataType="Text" html="False" name="value" fieldSource="value" wizardCaption="Description" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="p_global_paramGridvalue">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="20" fieldSourceType="DBColumn" dataType="Text" html="False" name="description" fieldSource="description" wizardCaption="Valid From" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="p_global_paramGriddescription">
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
				<Link id="7" visible="Yes" fieldSourceType="DBColumn" dataType="Text" html="False" hrefType="Page" urlType="Relative" preserveParameters="GET" name="Insert_Link" hrefSource="p_global_param.ccp" removeParameters="p_global_param_id;s_keyword" wizardThemeItem="FooterA" wizardDefaultValue="Add New" wizardUseTemplateBlock="False" PathID="p_global_paramGridInsert_Link">
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
				<TableParameter id="171" conditionType="Parameter" useIsNull="False" field="upper(code)" dataType="Text" searchConditionType="Contains" parameterType="URL" logicOperator="Or" parameterSource="s_keyword"/>
			</TableParameters>
			<JoinTables>
				<JoinTable id="170" tableName="p_global_param" posLeft="10" posTop="10" posWidth="145" posHeight="180"/>
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
		<Record id="24" sourceType="SQL" urlType="Relative" secured="False" allowInsert="True" allowUpdate="True" allowDelete="True" validateData="True" preserveParameters="GET" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" connection="ConnSIKP" name="p_global_paramForm" errorSummator="Error" wizardCaption="Add/Edit V P Module Role " wizardFormMethod="post" PathID="p_global_paramForm" pasteAsReplace="pasteAsReplace" pasteActions="pasteActions" customDelete="DELETE FROM p_global_param
WHERE p_global_param_id = {p_global_param_id}" customDeleteType="SQL" activeCollection="DSQLParameters" parameterTypeListName="ParameterTypeList" customUpdate="update p_global_param 
set code=upper('{code}'), 
value='{value}', 
type_1='{type_1}', 
is_range='{is_range}', 
value_2='{value_2}', 
description='{description}', 
updated_date=sysdate,
updated_by='{updated_by}'
where p_global_param_id = {p_global_param_id}" customUpdateType="SQL" customInsert="insert into p_global_param(p_global_param_id, code, value, type_1, is_range, value_2, description, creation_date, created_by, updated_date, updated_by) 
values
( generate_id ('sikp', 'p_global_param', 'p_global_param_id'), '{code}', '{value}', '{type_1}', '{is_range}', '{value_2}', '{description}', sysdate, '{created_by}', sysdate, '{updated_by}')" customInsertType="SQL" dataSource="SELECT p_global_param_id, code, value, type_1, is_range, value_2, description, 
to_char(creation_date, 'DD-MON-YYYY') as creation_date, created_by, to_char(updated_date,'DD-MON-YYYY') as updated_date, updated_by
FROM sikp.p_global_param
WHERE p_global_param_id = {p_global_param_id} ">
			<Components>
				<Button id="25" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Insert" operation="Insert" wizardCaption="Add" PathID="p_global_paramFormButton_Insert" removeParameters="FLAG">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="26" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Update" operation="Update" wizardCaption="Submit" PathID="p_global_paramFormButton_Update" removeParameters="FLAG">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="27" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Delete" operation="Delete" wizardCaption="Delete" PathID="p_global_paramFormButton_Delete" removeParameters="FLAG;p_global_param_id;s_keyword;p_global_paramGridPage">
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
				<Button id="29" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Cancel" operation="Cancel" wizardCaption="Cancel" PathID="p_global_paramFormButton_Cancel" removeParameters="FLAG;p_global_param_id;s_keyword;p_global_paramGridPage">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Hidden id="31" fieldSourceType="DBColumn" dataType="Float" name="p_global_param_id" fieldSource="p_global_param_id" required="False" caption="p_global_param_id" wizardCaption="P Module Role Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_global_paramFormp_global_param_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<TextBox id="172" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="code" fieldSource="code" required="True" caption="Parameter Global" wizardCaption="CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_global_paramFormcode">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="173" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="value" fieldSource="value" required="True" caption="Nilai 1" wizardCaption="VALUE" wizardSize="50" wizardMaxLength="128" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_global_paramFormvalue">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<ListBox id="174" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="is_range" fieldSource="is_range" required="False" caption="Range" wizardCaption="IS RANGE" wizardSize="1" wizardMaxLength="1" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_global_paramFormis_range" sourceType="ListOfValues" connection="ConnSIKP" _valueOfList="N" _nameOfList="NO" dataSource="Y;YES;N;NO">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
					<TableParameters/>
					<SPParameters/>
					<SQLParameters/>
					<JoinTables/>
					<JoinLinks/>
					<Fields/>
				</ListBox>
				<ListBox id="176" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="type_1" fieldSource="type_1" required="False" caption="TYPE 1" wizardCaption="TYPE 1" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_global_paramFormtype_1" sourceType="ListOfValues" dataSource="V;VARCHAR;N;NUMBER;D;DATE" connection="ConnSIKP">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
					<TableParameters/>
					<SPParameters/>
					<SQLParameters/>
					<JoinTables/>
					<JoinLinks/>
					<Fields/>
				</ListBox>
				<TextBox id="177" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="description" fieldSource="description" required="False" caption="Description" wizardCaption="Description" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_global_paramFormdescription">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="40" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="created_by" fieldSource="created_by" required="False" caption="Created By" wizardCaption="Created By" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_global_paramFormcreated_by" defaultValue="CCGetUserLogin()">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="43" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="updated_by" fieldSource="updated_by" required="False" caption="Updated By" wizardCaption="Updated By" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_global_paramFormupdated_by" defaultValue="CCGetUserLogin()">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="178" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="creation_date" fieldSource="creation_date" required="False" caption="Creation Date" wizardCaption="Creation Date" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_global_paramFormcreation_date" format="dd-mmm-yyyy" defaultValue="date(&quot;d-M-Y&quot;)">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="41" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="updated_date" fieldSource="updated_date" required="False" caption="Updated Date" wizardCaption="Updated Date" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_global_paramFormupdated_date" format="dd-mmm-yyyy" defaultValue="date(&quot;d-M-Y&quot;)">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="175" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="value_2" fieldSource="value_2" required="False" caption="VALUE 2" wizardCaption="VALUE 2" wizardSize="50" wizardMaxLength="128" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_global_paramFormvalue_2">
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
				<SQLParameter id="162" variable="p_global_param_id" parameterType="URL" defaultValue="0" dataType="Float" parameterSource="p_global_param_id"/>
			</SQLParameters>
			<JoinTables>
			</JoinTables>
			<JoinLinks>
			</JoinLinks>
			<Fields>
				<Field id="155" fieldName="*"/>
			</Fields>
			<ISPParameters/>
			<ISQLParameters>
				<SQLParameter id="144" variable="code" dataType="Text" parameterType="Control" parameterSource="code"/>
				<SQLParameter id="145" variable="value" dataType="Text" parameterType="Control" parameterSource="value"/>
				<SQLParameter id="146" variable="type_1" dataType="Text" parameterType="Control" parameterSource="type_1"/>
				<SQLParameter id="147" variable="is_range" dataType="Text" parameterType="Control" parameterSource="is_range"/>
				<SQLParameter id="148" variable="value_2" dataType="Text" parameterType="Control" parameterSource="value_2"/>
				<SQLParameter id="179" variable="description" parameterType="Control" dataType="Text" parameterSource="description"/>
				<SQLParameter id="180" variable="created_by" parameterType="Expression" dataType="Text" parameterSource="CCGetUserLogin()"/>
				<SQLParameter id="181" variable="updated_by" parameterType="Expression" dataType="Text" parameterSource="CCGetUserLogin()"/>
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
				<SQLParameter id="67" variable="code" dataType="Text" parameterType="Control" parameterSource="code"/>
				<SQLParameter id="68" variable="value" dataType="Text" parameterType="Control" parameterSource="value"/>
				<SQLParameter id="69" variable="type_1" dataType="Text" parameterType="Control" parameterSource="type_1"/>
				<SQLParameter id="70" variable="is_range" dataType="Text" parameterType="Control" parameterSource="is_range"/>
				<SQLParameter id="73" variable="value_2" parameterType="Control" dataType="Text" parameterSource="value_2"/>
				<SQLParameter id="166" variable="description" parameterType="Control" dataType="Text" parameterSource="description"/>
				<SQLParameter id="198" variable="updated_by" parameterType="Expression" dataType="Text" parameterSource="CCGetUserLogin()"/>
				<SQLParameter id="199" variable="p_global_param_id" parameterType="Control" defaultValue="0" dataType="Float" parameterSource="p_global_param_id"/>
			</USQLParameters>
			<UConditions>
			</UConditions>
			<UFormElements>
				<CustomParameter id="182" field="p_global_param_id" dataType="Float" parameterType="Control" parameterSource="p_global_param_id"/>
				<CustomParameter id="183" field="valid_from" dataType="Text" parameterType="Control" parameterSource="valid_from" format="dd-mmm-yyyy"/>
				<CustomParameter id="184" field="valid_to" dataType="Text" parameterType="Control" parameterSource="valid_to" format="dd-mmm-yyyy"/>
				<CustomParameter id="185" field="user_name_entry" dataType="Text" parameterType="Control" parameterSource="user_name_entry"/>
				<CustomParameter id="186" field="is_private" dataType="Text" parameterType="Control" parameterSource="is_private"/>
				<CustomParameter id="187" field="postcast" dataType="Text" parameterType="Control" parameterSource="postcast"/>
				<CustomParameter id="188" field="code" dataType="Text" parameterType="Control" parameterSource="code"/>
				<CustomParameter id="189" field="value" dataType="Text" parameterType="Control" parameterSource="value"/>
				<CustomParameter id="190" field="is_range" dataType="Text" parameterType="Control" parameterSource="is_range"/>
				<CustomParameter id="191" field="value_2" dataType="Text" parameterType="Control" parameterSource="value_2"/>
				<CustomParameter id="192" field="type_1" dataType="Text" parameterType="Control" parameterSource="type_1"/>
				<CustomParameter id="193" field="description" dataType="Text" parameterType="Control" parameterSource="description"/>
				<CustomParameter id="194" field="created_by" dataType="Text" parameterType="Control" parameterSource="created_by"/>
				<CustomParameter id="195" field="updated_by" dataType="Text" parameterType="Control" parameterSource="updated_by"/>
				<CustomParameter id="196" field="creation_date" dataType="Text" parameterType="Control" parameterSource="creation_date" format="dd-mmm-yyyy"/>
				<CustomParameter id="197" field="updated_date" dataType="Text" parameterType="Control" parameterSource="updated_date" format="dd-mmm-yyyy"/>
			</UFormElements>
			<DSPParameters/>
			<DSQLParameters>
				<SQLParameter id="200" variable="p_global_param_id" parameterType="Control" dataType="Float" parameterSource="p_global_param_id" defaultValue="0"/>
			</DSQLParameters>
			<DConditions>
				<TableParameter id="52" conditionType="Parameter" useIsNull="False" field="p_app_user_role_id" dataType="Float" parameterType="Control" searchConditionType="Equal" logicOperator="And" orderNumber="1" parameterSource="p_app_user_role_id"/>
			</DConditions>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Record>
		<Record id="100" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="None" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="p_global_paramSearch" wizardCaption="Search P App Role " wizardOrientation="Vertical" wizardFormMethod="post" returnPage="p_global_param.ccp" PathID="p_global_paramSearch" pasteActions="pasteActions">
			<Components>
				<Button id="4" urlType="Relative" enableValidation="True" isDefault="False" name="Button_DoSearch" operation="Search" wizardCaption="Search" PathID="p_global_paramSearchButton_DoSearch">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<TextBox id="5" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="s_keyword" wizardCaption="Keyword" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" PathID="p_global_paramSearchs_keyword">
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
	</Components>
	<CodeFiles>
		<CodeFile id="Events" language="PHPTemplates" name="p_global_param_events.php" forShow="False" comment="//" codePage="windows-1252"/>
		<CodeFile id="Code" language="PHPTemplates" name="p_global_param.php" forShow="True" url="p_global_param.php" comment="//" codePage="windows-1252"/>
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
