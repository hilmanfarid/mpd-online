<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\param" secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="Spring" wizardThemeVersion="3.0" needGeneration="0" pasteActions="pasteActions">
	<Components>
		<Grid id="2" secured="False" sourceType="SQL" returnValueType="Number" defaultPageSize="5" connection="ConnSIKP" name="p_bsheet_exceptionGrid" pageSizeLimit="100" wizardCaption="List of P App Module Role " wizardGridType="Tabular" wizardSortingType="SimpleDir" wizardAllowInsert="True" wizardAltRecord="False" wizardAltRecordType="Style" wizardRecordSeparator="False" wizardNoRecords="data tidak ditemukan" activeCollection="SQLParameters" pasteActions="pasteActions" parameterTypeListName="ParameterTypeList" dataSource="SELECT a.p_bsheet_exception_id, a.p_bsheet_source_id, a.full_account_code, 
to_char(a.valid_from,'DD-MON-YYYY')as valid_from, to_char(a.valid_to,'DD-MON-YYYY')as valid_to, a.description, 
to_char(a.creation_date,'DD-MON-YYYY')as creation_date,
a.created_by, to_char(a.updated_date,'DD-MON-YYYY')as updated_date, a.updated_by 
FROM p_bsheet_exception a, p_bsheet_source b
WHERE a.p_bsheet_source_id = b.p_bsheet_source_id AND
a.p_bsheet_source_id = {p_bsheet_source_id} AND
upper(a.full_account_code) LIKE '%{s_keyword}%'
ORDER BY a.p_bsheet_exception_id" orderBy="p_bsheet_exception_id">
			<Components>
				<Label id="28" fieldSourceType="DBColumn" dataType="Text" html="False" name="valid_from" fieldSource="valid_from" wizardCaption="Valid From" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="p_bsheet_exceptionGridvalid_from">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="30" fieldSourceType="DBColumn" dataType="Text" html="False" name="valid_to" fieldSource="valid_to" wizardCaption="Valid To" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="p_bsheet_exceptionGridvalid_to">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="32" fieldSourceType="DBColumn" dataType="Text" html="False" name="description" fieldSource="description" wizardCaption="Description" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="p_bsheet_exceptionGriddescription">
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
				<Label id="86" fieldSourceType="DBColumn" dataType="Text" html="False" name="full_account_code" fieldSource="full_account_code" wizardCaption="Description" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="p_bsheet_exceptionGridfull_account_code">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Link id="11" visible="Yes" fieldSourceType="CodeExpression" html="True" hrefType="Page" urlType="Relative" preserveParameters="GET" name="DLink" wizardCaption="Detail" wizardSize="50" wizardMaxLength="60" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" dataType="Text" wizardDefaultValue="DLink" hrefSource="p_bsheet_exception.ccp" wizardThemeItem="GridA" PathID="p_bsheet_exceptionGridDLink" removeParameters="FLAG">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="217" sourceType="DataField" name="p_bsheet_exception_id" source="p_bsheet_exception_id"/>
</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
				<Link id="7" visible="Yes" fieldSourceType="DBColumn" dataType="Text" html="False" hrefType="Page" urlType="Relative" preserveParameters="GET" name="Insert_Link" hrefSource="p_bsheet_exception.ccp" removeParameters="p_bsheet_exception_id;s_keyword" wizardThemeItem="FooterA" wizardDefaultValue="Add New" wizardUseTemplateBlock="False" PathID="p_bsheet_exceptionGridInsert_Link">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="123" sourceType="Expression" name="FLAG" source="&quot;ADD&quot;"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
				<Hidden id="184" fieldSourceType="DBColumn" dataType="Float" name="p_bsheet_exception_id" fieldSource="p_bsheet_exception_id" required="False" caption="Id" wizardCaption="Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_bsheet_exceptionGridp_bsheet_exception_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
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
				<TableParameter id="204" conditionType="Parameter" useIsNull="False" field="p_bsheet_source_id" dataType="Float" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="p_bsheet_source_id"/>
</TableParameters>
			<JoinTables>
			</JoinTables>
			<JoinLinks/>
			<Fields/>
			<SPParameters/>
			<SQLParameters>
				<SQLParameter id="215" parameterType="URL" variable="p_bsheet_source_id" dataType="Float" parameterSource="p_bsheet_source_id"/>
<SQLParameter id="216" variable="s_keyword" parameterType="URL" dataType="Text" parameterSource="s_keyword"/>
</SQLParameters>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Grid>
		<Record id="3" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="None" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="p_bsheet_exceptionSearch" wizardCaption="Search P App Module Role " wizardOrientation="Vertical" wizardFormMethod="post" returnPage="p_bsheet_exception.ccp" PathID="p_bsheet_exceptionSearch" pasteActions="pasteActions">
			<Components>
				<TextBox id="5" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="s_keyword" wizardCaption="Keyword" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" PathID="p_bsheet_exceptionSearchs_keyword">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Button id="4" urlType="Relative" enableValidation="True" isDefault="False" name="Button_DoSearch" operation="Search" wizardCaption="Search" PathID="p_bsheet_exceptionSearchButton_DoSearch">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Hidden id="100" fieldSourceType="DBColumn" dataType="Text" name="p_balance_sheet_id" PathID="p_bsheet_exceptionSearchp_balance_sheet_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="135" fieldSourceType="DBColumn" dataType="Text" name="p_balance_sheetGridPage" wizardCaption="Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_bsheet_exceptionSearchp_balance_sheetGridPage">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="188" fieldSourceType="DBColumn" dataType="Text" name="balance_s_keyword" wizardCaption="Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_bsheet_exceptionSearchbalance_s_keyword">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="189" fieldSourceType="DBColumn" dataType="Text" name="balance_code" wizardCaption="Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_bsheet_exceptionSearchbalance_code">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="199" fieldSourceType="DBColumn" dataType="Text" name="p_bsheet_source_id" PathID="p_bsheet_exceptionSearchp_bsheet_source_id" fieldSource="p_bsheet_source_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
<Hidden id="200" fieldSourceType="DBColumn" dataType="Text" name="p_bsheet_sourceGridPage" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="p_bsheet_exceptionSearchp_bsheet_sourceGridPage">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
<Hidden id="201" fieldSourceType="DBColumn" dataType="Text" name="bsheet_code" wizardCaption="Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_bsheet_exceptionSearchbsheet_code">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
<Hidden id="202" fieldSourceType="DBColumn" dataType="Text" name="bsheet_s_keyword" wizardCaption="Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_bsheet_exceptionSearchbsheet_s_keyword">
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
		<Label id="96" fieldSourceType="DBColumn" dataType="Text" html="False" name="bsheet_code" PathID="bsheet_code">
			<Components/>
			<Events/>
			<Attributes/>
			<Features/>
		</Label>
		<Record id="23" sourceType="SQL" urlType="Relative" secured="False" allowInsert="True" allowUpdate="True" allowDelete="True" validateData="True" preserveParameters="GET" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" connection="ConnSIKP" name="p_bsheet_exceptionForm" errorSummator="Error" wizardCaption="Add/Edit P App Role " wizardFormMethod="post" PathID="p_bsheet_exceptionForm" customDeleteType="SQL" customDelete="DELETE FROM p_bsheet_exception 
WHERE p_bsheet_exception_id = {p_bsheet_exception_id}" activeCollection="DSQLParameters" activeTableType="customDelete" customUpdateType="SQL" customUpdate="UPDATE p_bsheet_exception SET 
full_account_code='{full_account_code}',
valid_from=to_date('{valid_from}','dd-mon-yyyy'), 
valid_to=case when '{valid_to}' = '' then null else to_date('{valid_to}','dd-mon-yyyy') end, 
description='{description}', 
updated_date=sysdate, 
updated_by='{updated_by}'
WHERE p_bsheet_exception_id = {p_bsheet_exception_id}" parameterTypeListName="ParameterTypeList" pasteAsReplace="pasteAsReplace" pasteActions="pasteActions" customInsert="INSERT INTO p_bsheet_exception(p_bsheet_exception_id, p_bsheet_source_id, valid_from, description, creation_date, created_by, updated_date, updated_by, valid_to, full_account_code) 
VALUES(generate_id('sikp','p_bsheet_exception','p_bsheet_exception_id'), {p_bsheet_source_id}, to_date('{valid_from}','dd-mon-yyyy'), '{description}', sysdate, '{created_by}', sysdate, '{updated_by}', 
case when '{valid_to}' = '' then null else to_date('{valid_to}','dd-mon-yyyy') end, '{full_account_code}')" customInsertType="SQL" dataSource="SELECT a.p_bsheet_exception_id, a.p_bsheet_source_id, a.full_account_code, 
to_char(a.valid_from,'DD-MON-YYYY')as valid_from, to_char(a.valid_to,'DD-MON-YYYY')as valid_to, a.description, 
to_char(a.creation_date,'DD-MON-YYYY')as creation_date,
a.created_by, to_char(a.updated_date,'DD-MON-YYYY')as updated_date, a.updated_by 
FROM p_bsheet_exception a, p_bsheet_source b
WHERE a.p_bsheet_source_id = b.p_bsheet_source_id AND
a.p_bsheet_source_id = {p_bsheet_source_id} AND
a.p_bsheet_exception_id = {p_bsheet_exception_id}">
			<Components>
				<Button id="24" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Insert" operation="Insert" wizardCaption="Add" PathID="p_bsheet_exceptionFormButton_Insert" removeParameters="FLAG">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="25" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Update" operation="Update" wizardCaption="Submit" PathID="p_bsheet_exceptionFormButton_Update" removeParameters="FLAG">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="26" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Delete" operation="Delete" wizardCaption="Delete" PathID="p_bsheet_exceptionFormButton_Delete" removeParameters="p_bsheet_exception_id;s_keyword;FLAG;p_bsheet_exceptionGridPage">
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
				<Button id="124" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Cancel" operation="Cancel" wizardCaption="Cancel" PathID="p_bsheet_exceptionFormButton_Cancel" removeParameters="p_bsheet_exception_id;s_keyword;FLAG;p_bsheet_exceptionGridPage">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Hidden id="125" fieldSourceType="DBColumn" dataType="Float" name="p_bsheet_exception_id" fieldSource="p_bsheet_exception_id" required="False" caption="Id" wizardCaption="Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_bsheet_exceptionFormp_bsheet_exception_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<TextBox id="31" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="full_account_code" fieldSource="full_account_code" required="True" caption="Akun Lunas" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_bsheet_exceptionFormfull_account_code">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="33" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="valid_from" fieldSource="valid_from" required="True" caption="Valid From" wizardCaption="Valid From" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_bsheet_exceptionFormvalid_from" defaultValue="date(&quot;d-M-Y&quot;)" format="dd-mmm-yyyy">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<DatePicker id="34" name="DatePicker_valid_from" control="valid_from" wizardSatellite="True" wizardControl="valid_from" wizardDatePickerType="Image" wizardPicture="../Styles/CoffeeBreak/Images/DatePicker.gif" style="../Styles/sikp/Style.css" PathID="p_bsheet_exceptionFormDatePicker_valid_from">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</DatePicker>
				<TextBox id="37" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="description" fieldSource="description" required="False" caption="Description" wizardCaption="Description" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_bsheet_exceptionFormdescription">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="38" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="creation_date" fieldSource="creation_date" required="False" caption="Creation Date" wizardCaption="Creation Date" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_bsheet_exceptionFormcreation_date" format="dd-mmm-yyyy" defaultValue="date(&quot;d-M-Y&quot;)">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="40" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="created_by" fieldSource="created_by" required="False" caption="Created By" wizardCaption="Created By" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_bsheet_exceptionFormcreated_by" defaultValue="CCGetUserLogin()">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="126" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="updated_date" fieldSource="updated_date" required="False" caption="Updated Date" wizardCaption="Updated Date" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_bsheet_exceptionFormupdated_date" format="dd-mmm-yyyy" defaultValue="date(&quot;d-M-Y&quot;)">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="127" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="updated_by" fieldSource="updated_by" required="False" caption="Updated By" wizardCaption="Updated By" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_bsheet_exceptionFormupdated_by" defaultValue="CCGetUserLogin()">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="35" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="valid_to" fieldSource="valid_to" required="False" caption="Valid To" wizardCaption="Valid To" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_bsheet_exceptionFormvalid_to" format="dd-mmm-yyyy">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<DatePicker id="36" name="DatePicker_valid_to" control="valid_to" wizardSatellite="True" wizardControl="valid_to" wizardDatePickerType="Image" wizardPicture="../Styles/CoffeeBreak/Images/DatePicker.gif" style="../Styles/sikp/Style.css" PathID="p_bsheet_exceptionFormDatePicker_valid_to">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</DatePicker>
				<Hidden id="180" fieldSourceType="DBColumn" dataType="Text" name="p_bsheet_source_id" PathID="p_bsheet_exceptionFormp_bsheet_source_id" fieldSource="p_bsheet_source_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="165" fieldSourceType="DBColumn" dataType="Text" name="p_bsheet_exceptionGridPage" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="p_bsheet_exceptionFormp_bsheet_exceptionGridPage">
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
				<SQLParameter id="181" variable="p_bsheet_exception_id" parameterType="URL" defaultValue="0" dataType="Integer" parameterSource="p_bsheet_exception_id"/>
				<SQLParameter id="182" variable="p_bsheet_source_id" parameterType="URL" defaultValue="0" dataType="Integer" parameterSource="p_bsheet_source_id"/>
			</SQLParameters>
			<JoinTables>
			</JoinTables>
			<JoinLinks/>
			<Fields>
				<Field id="164" fieldName="*"/>
			</Fields>
			<ISPParameters/>
			<ISQLParameters>
				<SQLParameter id="136" variable="p_bsheet_source_id" dataType="Float" parameterType="Control" parameterSource="p_bsheet_source_id" defaultValue="0"/>
				<SQLParameter id="137" variable="valid_from" dataType="Text" parameterType="Control" parameterSource="valid_from"/>
				<SQLParameter id="138" variable="description" dataType="Text" parameterType="Control" parameterSource="description"/>
				<SQLParameter id="139" variable="created_by" dataType="Text" parameterType="Expression" parameterSource="CCGetUserLogin()"/>
				<SQLParameter id="140" variable="updated_by" dataType="Text" parameterType="Expression" parameterSource="CCGetUserLogin()"/>
				<SQLParameter id="90" variable="valid_to" dataType="Text" parameterType="Control" parameterSource="valid_to"/>
				<SQLParameter id="187" variable="full_account_code" parameterType="Control" dataType="Text" parameterSource="full_account_code"/>
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
				<SQLParameter id="151" variable="p_bsheet_exception_id" dataType="Float" parameterType="Control" parameterSource="p_bsheet_exception_id" defaultValue="0"/>
				<SQLParameter id="60" variable="valid_from" dataType="Text" parameterType="Control" parameterSource="valid_from"/>
				<SQLParameter id="152" variable="valid_to" dataType="Text" parameterType="Control" parameterSource="valid_to"/>
				<SQLParameter id="62" variable="description" dataType="Text" parameterType="Control" parameterSource="description"/>
				<SQLParameter id="64" variable="updated_by" dataType="Text" parameterType="Expression" parameterSource="CCGetUserLogin()"/>
				<SQLParameter id="186" variable="full_account_code" parameterType="Control" dataType="Text" parameterSource="full_account_code"/>
			</USQLParameters>
			<UConditions>
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
				<SQLParameter id="198" variable="p_bsheet_exception_id" parameterType="Control" dataType="Float" parameterSource="p_bsheet_exception_id" defaultValue="0"/>
			</DSQLParameters>
			<DConditions>
			</DConditions>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Record>
	</Components>
	<CodeFiles>
		<CodeFile id="Events" language="PHPTemplates" name="p_bsheet_exception_events.php" forShow="False" comment="//" codePage="windows-1252"/>
		<CodeFile id="Code" language="PHPTemplates" name="p_bsheet_exception.php" forShow="True" url="p_bsheet_exception.php" comment="//" codePage="windows-1252"/>
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
