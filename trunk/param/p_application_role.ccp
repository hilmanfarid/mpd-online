<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\param" secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="Spring" wizardThemeVersion="3.0" needGeneration="0" pasteActions="pasteActions">
	<Components>
		<Grid id="2" secured="False" sourceType="SQL" returnValueType="Number" defaultPageSize="5" connection="ConnSIKP" name="p_application_roleGrid" pageSizeLimit="100" wizardCaption="List of P App Module Role " wizardGridType="Tabular" wizardSortingType="SimpleDir" wizardAllowInsert="True" wizardAltRecord="False" wizardAltRecordType="Style" wizardRecordSeparator="False" wizardNoRecords="data tidak ditemukan" activeCollection="SQLParameters" pasteActions="pasteActions" parameterTypeListName="ParameterTypeList" dataSource="SELECT b.code as role_code, a.p_application_role_id, a.p_app_role_id, 
a.p_application_id, to_char(a.valid_from,'DD-MON-YYYY') as valid_from, 
to_char(a.valid_to,'DD-MON-YYYY') as valid_to, a.description, 
to_char(a.creation_date,'DD-MON-YYYY') as creation_date, a.created_by, 
to_char(a.updated_date,'DD-MON-YYYY') as updated_date,
a.updated_by 
FROM p_application_role a, p_app_role b
WHERE a.p_app_role_id = b.p_app_role_id AND
a.p_application_id = {p_application_id} AND
upper(b.code) like '%{s_keyword}%'
ORDER BY a.p_application_role_id ASC">
			<Components>
				<Label id="28" fieldSourceType="DBColumn" dataType="Text" html="False" name="valid_from" fieldSource="valid_from" wizardCaption="Valid From" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="p_application_roleGridvalid_from">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="30" fieldSourceType="DBColumn" dataType="Text" html="False" name="valid_to" fieldSource="valid_to" wizardCaption="Valid To" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="p_application_roleGridvalid_to">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="32" fieldSourceType="DBColumn" dataType="Text" html="False" name="description" fieldSource="description" wizardCaption="Description" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="p_application_roleGriddescription">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Navigator id="41" size="10" type="Centered" pageSizes="1;5;10;25;50" name="Navigator" wizardPagingType="Custom" wizardFirst="True" wizardFirstText="First" wizardPrev="True" wizardPrevText="Prev" wizardNext="True" wizardNextText="Next" wizardLast="True" wizardLastText="Last" wizardPageNumbers="Centered" wizardSize="10" wizardTotalPages="False" wizardHideDisabled="False" wizardOfText="of" wizardPageSize="False" wizardImages="Images" wizardUsePageScroller="True">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Navigator>
				<Label id="86" fieldSourceType="DBColumn" dataType="Text" html="False" name="role_code" fieldSource="role_code" wizardCaption="Description" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="p_application_roleGridrole_code">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Link id="11" visible="Yes" fieldSourceType="CodeExpression" html="True" hrefType="Page" urlType="Relative" preserveParameters="GET" name="DLink" wizardCaption="Detail" wizardSize="50" wizardMaxLength="60" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" dataType="Text" wizardDefaultValue="DLink" hrefSource="p_application_role.ccp" wizardThemeItem="GridA" PathID="p_application_roleGridDLink" removeParameters="FLAG">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="179" sourceType="DataField" name="p_application_role_id" source="p_application_role_id"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
				<Hidden id="184" fieldSourceType="DBColumn" dataType="Float" name="p_application_role_id" fieldSource="p_application_role_id" required="False" caption="Id" wizardCaption="Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_application_roleGridp_application_role_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Link id="7" visible="Yes" fieldSourceType="DBColumn" dataType="Text" html="False" hrefType="Page" urlType="Relative" preserveParameters="GET" name="Insert_Link" hrefSource="p_application_role.ccp" removeParameters="p_application_role_id;s_keyword" wizardThemeItem="FooterA" wizardDefaultValue="Add New" wizardUseTemplateBlock="False" PathID="p_application_roleGridInsert_Link">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="67" sourceType="Expression" name="FLAG" source="&quot;ADD&quot;"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
</Components>
			<Events>
				<Event name="BeforeShowRow" type="Server">
					<Actions>
						<Action actionName="Set Row Style" actionCategory="General" id="87" styles="Row;AltRow" name="rowStyle"/>
					</Actions>
				</Event>
				<Event name="BeforeShow" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="88"/>
					</Actions>
				</Event>
				<Event name="BeforeSelect" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="183"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
			</TableParameters>
			<JoinTables>
			</JoinTables>
			<JoinLinks/>
			<Fields/>
			<SPParameters/>
			<SQLParameters>
				<SQLParameter id="177" variable="p_application_id" parameterType="URL" defaultValue="0" dataType="Float" parameterSource="p_application_id"/>
				<SQLParameter id="178" variable="s_keyword" parameterType="URL" dataType="Text" parameterSource="s_keyword"/>
			</SQLParameters>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Grid>
		<Record id="3" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="None" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="p_application_roleSearch" wizardCaption="Search P App Module Role " wizardOrientation="Vertical" wizardFormMethod="post" returnPage="p_application_role.ccp" PathID="p_application_roleSearch" pasteActions="pasteActions">
			<Components>
				<TextBox id="5" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="s_keyword" wizardCaption="Keyword" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" PathID="p_application_roleSearchs_keyword">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Button id="4" urlType="Relative" enableValidation="True" isDefault="False" name="Button_DoSearch" operation="Search" wizardCaption="Search" PathID="p_application_roleSearchButton_DoSearch">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Hidden id="100" fieldSourceType="DBColumn" dataType="Text" name="p_application_id" PathID="p_application_roleSearchp_application_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="135" fieldSourceType="DBColumn" dataType="Text" name="p_applicationGridPage" wizardCaption="Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_application_roleSearchp_applicationGridPage">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="188" fieldSourceType="DBColumn" dataType="Text" name="app_s_keyword" wizardCaption="Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_application_roleSearchapp_s_keyword">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="191" fieldSourceType="DBColumn" dataType="Text" name="app_code" PathID="p_application_roleSearchapp_code">
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
		<Label id="96" fieldSourceType="DBColumn" dataType="Text" html="False" name="app_code" PathID="app_code">
			<Components/>
			<Events/>
			<Attributes/>
			<Features/>
		</Label>
		<Record id="23" sourceType="SQL" urlType="Relative" secured="False" allowInsert="True" allowUpdate="True" allowDelete="True" validateData="True" preserveParameters="GET" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" connection="ConnSIKP" name="p_application_roleForm" errorSummator="Error" wizardCaption="Add/Edit P App Role " wizardFormMethod="post" PathID="p_application_roleForm" customDeleteType="SQL" customDelete="DELETE FROM p_application_role 
WHERE  p_application_role_id = {p_application_role_id}" activeCollection="USQLParameters" activeTableType="customDelete" customUpdateType="SQL" customUpdate="UPDATE p_application_role SET 
p_app_role_id={p_app_role_id}, 
valid_from=to_date('{valid_from}','dd-mon-yyyy'), 
valid_to=case when '{valid_to}' = '' then null else to_date('{valid_to}','dd-mon-yyyy') end, 
description='{description}', 
updated_date=sysdate, 
updated_by='{updated_by}'
WHERE p_application_role_id = {p_application_role_id}
AND p_application_id = {p_application_id}" parameterTypeListName="ParameterTypeList" pasteAsReplace="pasteAsReplace" pasteActions="pasteActions" customInsert="INSERT INTO p_application_role(p_application_role_id, p_app_role_id, valid_from, description, creation_date, created_by, updated_date, updated_by, valid_to, p_application_id) 
VALUES(generate_id('sikp','p_application_role','p_application_role_id'), {p_app_role_id}, to_date('{valid_from}','dd-mon-yyyy'), '{description}', sysdate, '{created_by}', sysdate, '{updated_by}', 
case when '{valid_to}' = '' then null else to_date('{valid_to}','dd-mon-yyyy') end, {p_application_id})" customInsertType="SQL" dataSource="SELECT b.code as role_code, a.p_application_role_id, a.p_app_role_id, 
a.p_application_id, to_char(a.valid_from,'DD-MON-YYYY') as valid_from, 
to_char(a.valid_to,'DD-MON-YYYY') as valid_to, a.description, 
to_char(a.creation_date,'DD-MON-YYYY') as creation_date, a.created_by, 
to_char(a.updated_date,'DD-MON-YYYY') as updated_date,
a.updated_by 
FROM p_application_role a, p_app_role b
WHERE a.p_application_role_id = {p_application_role_id} AND
a.p_application_id = {p_application_id}">
			<Components>
				<Button id="24" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Insert" operation="Insert" wizardCaption="Add" PathID="p_application_roleFormButton_Insert" removeParameters="FLAG">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="25" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Update" operation="Update" wizardCaption="Submit" PathID="p_application_roleFormButton_Update" removeParameters="FLAG">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="26" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Delete" operation="Delete" wizardCaption="Delete" PathID="p_application_roleFormButton_Delete" removeParameters="p_application_role_id;s_keyword;FLAG;p_application_roleGridPage">
					<Components/>
					<Events>
						<Event name="OnClick" type="Client">
							<Actions>
								<Action actionName="Confirmation Message" actionCategory="General" id="27" message="Delete record?" eventType="Client"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="124" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Cancel" operation="Cancel" wizardCaption="Cancel" PathID="p_application_roleFormButton_Cancel" removeParameters="p_application_role_id;s_keyword;FLAG;p_application_roleGridPage">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Hidden id="125" fieldSourceType="DBColumn" dataType="Float" name="p_application_role_id" fieldSource="p_application_role_id" required="False" caption="Id" wizardCaption="Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_application_roleFormp_application_role_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<TextBox id="31" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="role_code" fieldSource="role_code" required="True" caption="Role" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_application_roleFormrole_code">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="33" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="valid_from" fieldSource="valid_from" required="True" caption="Valid From" wizardCaption="Valid From" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_application_roleFormvalid_from" defaultValue="date(&quot;d-M-Y&quot;)" format="dd-mmm-yyyy">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<DatePicker id="34" name="DatePicker_valid_from" control="valid_from" wizardSatellite="True" wizardControl="valid_from" wizardDatePickerType="Image" wizardPicture="../Styles/CoffeeBreak/Images/DatePicker.gif" style="../Styles/sikp/Style.css" PathID="p_application_roleFormDatePicker_valid_from">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</DatePicker>
				<TextBox id="37" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="description" fieldSource="description" required="False" caption="Description" wizardCaption="Description" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_application_roleFormdescription">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="38" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="creation_date" fieldSource="creation_date" required="False" caption="Creation Date" wizardCaption="Creation Date" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_application_roleFormcreation_date" format="dd-mmm-yyyy" defaultValue="date(&quot;d-M-Y&quot;)">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="40" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="created_by" fieldSource="created_by" required="False" caption="Created By" wizardCaption="Created By" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_application_roleFormcreated_by" defaultValue="CCGetUserLogin()">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="126" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="updated_date" fieldSource="updated_date" required="False" caption="Updated Date" wizardCaption="Updated Date" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_application_roleFormupdated_date" format="dd-mmm-yyyy" defaultValue="date(&quot;d-M-Y&quot;)">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="127" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="updated_by" fieldSource="updated_by" required="False" caption="Updated By" wizardCaption="Updated By" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_application_roleFormupdated_by" defaultValue="CCGetUserLogin()">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="35" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="valid_to" fieldSource="valid_to" required="False" caption="Valid To" wizardCaption="Valid To" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_application_roleFormvalid_to" format="dd-mmm-yyyy">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<DatePicker id="36" name="DatePicker_valid_to" control="valid_to" wizardSatellite="True" wizardControl="valid_to" wizardDatePickerType="Image" wizardPicture="../Styles/CoffeeBreak/Images/DatePicker.gif" style="../Styles/sikp/Style.css" PathID="p_application_roleFormDatePicker_valid_to">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</DatePicker>
				<Hidden id="180" fieldSourceType="DBColumn" dataType="Text" name="p_application_id" PathID="p_application_roleFormp_application_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="185" fieldSourceType="DBColumn" dataType="Float" name="p_app_role_id" fieldSource="p_app_role_id" required="True" caption="Role" wizardCaption="P App Role Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_application_roleFormp_app_role_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
			</Components>
			<Events>
				<Event name="BeforeShow" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="128" eventType="Server"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
			</TableParameters>
			<SPParameters/>
			<SQLParameters>
				<SQLParameter id="181" variable="p_application_role_id" parameterType="URL" defaultValue="0" dataType="Integer" parameterSource="p_application_role_id"/>
				<SQLParameter id="182" variable="p_application_id" parameterType="URL" defaultValue="0" dataType="Integer" parameterSource="p_application_id"/>
			</SQLParameters>
			<JoinTables>
			</JoinTables>
			<JoinLinks/>
			<Fields>
				<Field id="164" fieldName="*"/>
			</Fields>
			<ISPParameters/>
			<ISQLParameters>
				<SQLParameter id="136" variable="p_app_role_id" dataType="Text" parameterType="Control" parameterSource="p_app_role_id"/>
				<SQLParameter id="137" variable="valid_from" dataType="Text" parameterType="Control" parameterSource="valid_from"/>
				<SQLParameter id="138" variable="description" dataType="Text" parameterType="Control" parameterSource="description"/>
				<SQLParameter id="139" variable="created_by" dataType="Text" parameterType="Expression" parameterSource="CCGetUserLogin()"/>
				<SQLParameter id="140" variable="updated_by" dataType="Text" parameterType="Expression" parameterSource="CCGetUserLogin()"/>
				<SQLParameter id="90" variable="valid_to" dataType="Text" parameterType="Control" parameterSource="valid_to"/>
				<SQLParameter id="187" variable="p_application_id" parameterType="Control" defaultValue="0" dataType="Integer" parameterSource="p_application_id"/>
			</ISQLParameters>
			<IFormElements>
				<CustomParameter id="141" field="p_app_role_id" dataType="Float" parameterType="Control" parameterSource="p_app_role_id"/>
				<CustomParameter id="142" field="code" dataType="Text" parameterType="Control" parameterSource="code"/>
				<CustomParameter id="143" field="listing_no" dataType="Float" parameterType="Control" parameterSource="listing_no"/>
				<CustomParameter id="144" field="valid_from" dataType="Date" parameterType="Control" parameterSource="valid_from" format="dd-mmm-yyyy"/>
				<CustomParameter id="145" field="description" dataType="Text" parameterType="Control" parameterSource="description"/>
				<CustomParameter id="146" field="creation_date" dataType="Date" parameterType="Control" parameterSource="creation_date" format="dd-mmm-yyyy"/>
				<CustomParameter id="147" field="created_by" dataType="Text" parameterType="Control" parameterSource="created_by"/>
				<CustomParameter id="148" field="updated_date" dataType="Date" parameterType="Control" parameterSource="updated_date" format="dd-mmm-yyyy"/>
				<CustomParameter id="149" field="updated_by" dataType="Text" parameterType="Control" parameterSource="updated_by"/>
				<CustomParameter id="150" field="valid_to" dataType="Date" parameterType="Control" parameterSource="valid_to" format="dd-mmm-yyyy"/>
			</IFormElements>
			<USPParameters/>
			<USQLParameters>
				<SQLParameter id="151" variable="p_app_role_id" dataType="Text" parameterType="Control" parameterSource="p_app_role_id"/>
				<SQLParameter id="60" variable="valid_from" dataType="Text" parameterType="Control" parameterSource="valid_from"/>
				<SQLParameter id="152" variable="valid_to" dataType="Text" parameterType="Control" parameterSource="valid_to"/>
				<SQLParameter id="62" variable="description" dataType="Text" parameterType="Control" parameterSource="description"/>
				<SQLParameter id="64" variable="updated_by" dataType="Text" parameterType="Expression" parameterSource="CCGetUserLogin()"/>
				<SQLParameter id="153" variable="p_application_role_id" parameterType="Control" dataType="Float" parameterSource="p_application_role_id" defaultValue="0"/>
				<SQLParameter id="186" variable="p_application_id" parameterType="Control" dataType="Float" parameterSource="p_application_id" defaultValue="0"/>
			</USQLParameters>
			<UConditions>
				<TableParameter id="154" conditionType="Parameter" useIsNull="False" field="p_app_role_id" dataType="Float" parameterType="Control" searchConditionType="Equal" logicOperator="And" orderNumber="1" parameterSource="p_app_role_id"/>
			</UConditions>
			<UFormElements>
				<CustomParameter id="49" field="code" dataType="Text" parameterType="Control" parameterSource="code" omitIfEmpty="True"/>
				<CustomParameter id="155" field="listing_no" dataType="Float" parameterType="Control" parameterSource="listing_no" omitIfEmpty="True"/>
				<CustomParameter id="156" field="valid_from" dataType="Date" parameterType="Control" parameterSource="valid_from" format="dd-mmm-yyyy" omitIfEmpty="True"/>
				<CustomParameter id="157" field="valid_to" dataType="Date" parameterType="Control" parameterSource="valid_to" format="dd-mmm-yyyy" omitIfEmpty="True"/>
				<CustomParameter id="158" field="description" dataType="Text" parameterType="Control" parameterSource="description" omitIfEmpty="True"/>
				<CustomParameter id="159" field="updated_date" dataType="Date" parameterType="Control" parameterSource="updated_date" format="dd-mmm-yyyy" omitIfEmpty="True"/>
				<CustomParameter id="57" field="updated_by" dataType="Text" parameterType="Control" parameterSource="updated_by" omitIfEmpty="True"/>
				<CustomParameter id="160" field="p_app_role_id" dataType="Float" parameterType="Control" parameterSource="p_app_role_id" omitIfEmpty="True"/>
				<CustomParameter id="161" field="creation_date" dataType="Date" parameterType="Control" parameterSource="creation_date" format="dd-mmm-yyyy" omitIfEmpty="True"/>
				<CustomParameter id="162" field="created_by" dataType="Text" parameterType="Control" parameterSource="created_by" omitIfEmpty="True"/>
			</UFormElements>
			<DSPParameters/>
			<DSQLParameters>
				<SQLParameter id="189" variable="p_application_role_id" parameterType="Control" dataType="Float" parameterSource="p_application_role_id" defaultValue="0"/>
			</DSQLParameters>
			<DConditions>
				<TableParameter id="163" conditionType="Parameter" useIsNull="False" field="p_application_role_id" dataType="Float" parameterType="Control" searchConditionType="Equal" logicOperator="And" orderNumber="1" parameterSource="p_application_role_id"/>
			</DConditions>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Record>
	</Components>
	<CodeFiles>
		<CodeFile id="Code" language="PHPTemplates" name="p_application_role.php" forShow="True" url="p_application_role.php" comment="//" codePage="windows-1252"/>
		<CodeFile id="Events" language="PHPTemplates" name="p_application_role_events.php" forShow="False" comment="//" codePage="windows-1252"/>
	</CodeFiles>
	<SecurityGroups/>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events>
		<Event name="OnInitializeView" type="Server">
			<Actions>
				<Action actionName="Custom Code" actionCategory="General" id="89"/>
			</Actions>
		</Event>
	</Events>
</Page>
