<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\param" secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="CoffeeBreak" wizardThemeVersion="3.0" needGeneration="0" pasteActions="pasteActions">
	<Components>
		<Grid id="2" secured="False" sourceType="Table" returnValueType="Number" defaultPageSize="5" connection="ConnSIKP" name="p_app_menuGrid" orderBy="p_app_menu_id" pageSizeLimit="100" wizardCaption="List of P App Role " wizardGridType="Tabular" wizardAllowInsert="True" wizardAltRecord="True" wizardAltRecordType="Style" wizardRecordSeparator="False" wizardNoRecords="-" pasteAsReplace="pasteAsReplace" pasteActions="pasteActions" activeCollection="TableParameters" parameterTypeListName="ParameterTypeList" resultSetType="parameter" dataSource="p_app_menu">
			<Components>
				<Link id="11" visible="Yes" fieldSourceType="CodeExpression" html="True" hrefType="Page" urlType="Relative" preserveParameters="GET" name="DLink" wizardCaption="Detail" wizardSize="50" wizardMaxLength="60" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" dataType="Text" wizardDefaultValue="DLink" hrefSource="p_app_menu.ccp" wizardThemeItem="GridA" PathID="p_app_menuGridDLink" removeParameters="FLAG">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="136" sourceType="DataField" name="p_app_menu_id" source="p_app_menu_id"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
				<Label id="15" fieldSourceType="DBColumn" dataType="Text" html="False" name="code" fieldSource="code" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="p_app_menuGridcode">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="17" fieldSourceType="DBColumn" dataType="Text" html="False" name="file_name" fieldSource="file_name" wizardCaption="Description" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="p_app_menuGridfile_name">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="19" fieldSourceType="DBColumn" dataType="Text" html="False" name="is_active" fieldSource="is_active" wizardCaption="Valid From" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="p_app_menuGridis_active">
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
				<Hidden id="115" fieldSourceType="DBColumn" dataType="Float" html="False" name="p_app_menu_id" fieldSource="p_app_menu_id" wizardCaption="Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="p_app_menuGridp_app_menu_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Link id="7" visible="Yes" fieldSourceType="DBColumn" dataType="Text" html="False" hrefType="Page" urlType="Relative" preserveParameters="GET" name="Insert_Link" hrefSource="p_app_menu.ccp" removeParameters="p_app_menu_id;s_keyword" wizardThemeItem="FooterA" wizardDefaultValue="Add New" wizardUseTemplateBlock="False" PathID="p_app_menuGridInsert_Link">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="94" sourceType="Expression" name="FLAG" source="&quot;ADD&quot;"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
				<ImageLink id="199" visible="Yes" fieldSourceType="DBColumn" dataType="Text" hrefType="Page" urlType="Relative" preserveParameters="GET" name="ImageLink1" PathID="p_app_menuGridImageLink1" hrefSource="p_app_role_menu.ccp" removeParameters="s_keyword">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="200" sourceType="DataField" format="yyyy-mm-dd" name="p_app_menu_id" source="p_app_menu_id"/>
						<LinkParameter id="201" sourceType="DataField" name="code" source="code"/>
						<LinkParameter id="216" sourceType="URL" name="p_app_menuGridPage" source="p_app_menuGridPage"/>
						<LinkParameter id="217" sourceType="URL" name="p_application_id" source="p_application_id"/>
						<LinkParameter id="218" sourceType="URL" name="app_s_keyword" source="app_s_keyword"/>
						<LinkParameter id="219" sourceType="URL" name="menu_s_keyword" source="s_keyword"/>
						<LinkParameter id="220" sourceType="URL" name="parent_id" source="parent_id"/>
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
						<Action actionName="Custom Code" actionCategory="General" id="134"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
				<TableParameter id="8" conditionType="Parameter" useIsNull="False" field="code" parameterSource="s_keyword" dataType="Text" logicOperator="Or" searchConditionType="Contains" parameterType="URL" orderNumber="1" leftBrackets="1"/>
				<TableParameter id="9" conditionType="Parameter" useIsNull="False" field="description" dataType="Text" logicOperator="And" searchConditionType="Contains" parameterType="URL" orderNumber="2" rightBrackets="1" parameterSource="s_keyword"/>
				<TableParameter id="170" conditionType="Parameter" useIsNull="False" field="p_application_id" dataType="Float" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="p_application_id"/>
				<TableParameter id="171" conditionType="Parameter" useIsNull="False" field="nvl(parent_id,0)" dataType="Float" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="parent_id"/>
			</TableParameters>
			<JoinTables>
				<JoinTable id="162" tableName="p_app_menu" posLeft="10" posTop="10" posWidth="127" posHeight="180"/>
			</JoinTables>
			<JoinLinks/>
			<Fields>
				<Field id="163" tableName="p_app_menu" fieldName="p_app_menu_id"/>
				<Field id="164" tableName="p_app_menu" fieldName="p_application_id"/>
				<Field id="165" tableName="p_app_menu" fieldName="code"/>
				<Field id="167" tableName="p_app_menu" fieldName="file_name"/>
				<Field id="169" fieldName="decode(is_active,'Y','YA','TIDAK')" isExpression="True" alias="is_active"/>
			</Fields>
			<SPParameters>
			</SPParameters>
			<SQLParameters>
			</SQLParameters>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Grid>
		<Record id="3" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="None" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="p_app_menuSearch" wizardCaption="Search P App Role " wizardOrientation="Vertical" wizardFormMethod="post" returnPage="p_app_menu.ccp" PathID="p_app_menuSearch" pasteActions="pasteActions">
			<Components>
				<Button id="4" urlType="Relative" enableValidation="True" isDefault="False" name="Button_DoSearch" operation="Search" wizardCaption="Search" PathID="p_app_menuSearchButton_DoSearch">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<TextBox id="5" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="s_keyword" wizardCaption="Keyword" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" PathID="p_app_menuSearchs_keyword">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Hidden id="111" fieldSourceType="DBColumn" dataType="Float" html="False" name="p_application_id" fieldSource="p_application_id" wizardCaption="Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="p_app_menuSearchp_application_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="214" fieldSourceType="DBColumn" dataType="Text" name="p_applicationGridPage" wizardCaption="Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_app_menuSearchp_applicationGridPage">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="215" fieldSourceType="DBColumn" dataType="Text" name="app_s_keyword" wizardCaption="Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_app_menuSearchapp_s_keyword">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="221" fieldSourceType="DBColumn" dataType="Text" name="parent_id" wizardCaption="Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_app_menuSearchparent_id">
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
		<Record id="23" sourceType="Table" urlType="Relative" secured="False" allowInsert="True" allowUpdate="True" allowDelete="True" validateData="True" preserveParameters="GET" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" connection="ConnSIKP" name="p_app_menuForm" dataSource="p_app_menu" errorSummator="Error" wizardCaption="Add/Edit P App Role " wizardFormMethod="post" PathID="p_app_menuForm" customDeleteType="SQL" customDelete="DELETE FROM p_app_menu WHERE  p_app_menu_id = {p_app_menu_id}" activeCollection="USQLParameters" customUpdateType="SQL" customUpdate="UPDATE p_app_menu SET 
code='{code}', 
listing_no={listing_no}, 
file_name='{file_name}', 
description='{description}', 
updated_date=sysdate, 
updated_by='{updated_by}', 
is_active='{is_active}' 
WHERE p_app_menu_id = {p_app_menu_id}
AND p_application_id = {p_application_id}" parameterTypeListName="ParameterTypeList" pasteAsReplace="pasteAsReplace" pasteActions="pasteActions" customInsert="INSERT INTO p_app_menu(p_app_menu_id, code, file_name, description, creation_date, created_by, updated_date, updated_by, parent_id, listing_no, is_active, p_application_id) 
VALUES(generate_id('sikp','p_app_menu','p_app_menu_id'), '{code}', '{file_name}', '{description}', sysdate, '{created_by}', sysdate, '{updated_by}', decode({parent_id},0,null,{parent_id}), {listing_no}, '{is_active}',{p_application_id})" customInsertType="SQL" resultSetType="parameter" activeTableType="customDelete">
			<Components>
				<TextBox id="31" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="code" fieldSource="code" required="True" caption="Code" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_app_menuFormcode">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="33" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="file_name" fieldSource="file_name" required="False" caption="Nama File" wizardCaption="Valid From" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_app_menuFormfile_name">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="37" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="description" fieldSource="description" required="False" caption="Description" wizardCaption="Description" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_app_menuFormdescription">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="38" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="creation_date" fieldSource="creation_date" required="False" caption="Creation Date" wizardCaption="Creation Date" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_app_menuFormcreation_date" format="dd-mmm-yyyy" defaultValue="date(&quot;d-M-Y&quot;)">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="40" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="created_by" fieldSource="created_by" required="False" caption="Created By" wizardCaption="Created By" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_app_menuFormcreated_by" defaultValue="CCGetUserLogin()">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="41" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="updated_date" fieldSource="updated_date" required="False" caption="Updated Date" wizardCaption="Updated Date" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_app_menuFormupdated_date" format="dd-mmm-yyyy" defaultValue="date(&quot;d-M-Y&quot;)">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="43" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="updated_by" fieldSource="updated_by" required="False" caption="Updated By" wizardCaption="Updated By" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_app_menuFormupdated_by" defaultValue="CCGetUserLogin()">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Button id="112" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Cancel" operation="Cancel" wizardCaption="Cancel" PathID="p_app_menuFormButton_Cancel" removeParameters="p_app_menu_id;s_keyword;FLAG;p_app_menuGridPage">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="113" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Delete" operation="Delete" wizardCaption="Delete" PathID="p_app_menuFormButton_Delete" removeParameters="p_app_menu_id;s_keyword;FLAG;p_app_menuGridPage">
					<Components/>
					<Events>
						<Event name="OnClick" type="Client">
							<Actions>
								<Action actionName="Confirmation Message" actionCategory="General" id="81" message="Delete record?" eventType="Client"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="82" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Update" operation="Update" wizardCaption="Submit" PathID="p_app_menuFormButton_Update" removeParameters="FLAG">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="24" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Insert" operation="Insert" wizardCaption="Add" PathID="p_app_menuFormButton_Insert" removeParameters="FLAG">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<TextBox id="131" visible="Yes" fieldSourceType="DBColumn" dataType="Float" name="parent_id" fieldSource="parent_id" required="False" caption="Parent Id" wizardCaption="PARENT ID" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_app_menuFormparent_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="132" visible="Yes" fieldSourceType="DBColumn" dataType="Float" name="listing_no" fieldSource="listing_no" required="True" caption="No Urut" wizardCaption="LISTING NO" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_app_menuFormlisting_no">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<ListBox id="133" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="is_active" fieldSource="is_active" required="True" caption="Aktif?" wizardCaption="IS ACTIVE" wizardSize="1" wizardMaxLength="1" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_app_menuFormis_active" sourceType="ListOfValues" connection="ConnSIKP" _valueOfList="N" _nameOfList="TIDAK" dataSource="Y;YA;N;TIDAK">
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
				<Hidden id="135" fieldSourceType="DBColumn" dataType="Float" name="p_app_menu_id" PathID="p_app_menuFormp_app_menu_id" fieldSource="p_app_menu_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="159" fieldSourceType="DBColumn" dataType="Float" name="p_application_id" PathID="p_app_menuFormp_application_id" fieldSource="p_application_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
			</Components>
			<Events>
				<Event name="BeforeShow" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="104"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
				<TableParameter id="161" conditionType="Parameter" useIsNull="False" field="p_app_menu_id" dataType="Float" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="p_app_menu_id"/>
			</TableParameters>
			<SPParameters>
			</SPParameters>
			<SQLParameters>
			</SQLParameters>
			<JoinTables>
				<JoinTable id="160" tableName="p_app_menu" posLeft="10" posTop="10" posWidth="127" posHeight="180"/>
			</JoinTables>
			<JoinLinks/>
			<Fields>
				<Field id="202" tableName="p_app_menu" fieldName="p_app_menu_id"/>
				<Field id="203" tableName="p_app_menu" fieldName="p_application_id"/>
				<Field id="204" tableName="p_app_menu" fieldName="code"/>
				<Field id="205" tableName="p_app_menu" fieldName="parent_id"/>
				<Field id="206" tableName="p_app_menu" fieldName="file_name"/>
				<Field id="207" tableName="p_app_menu" fieldName="listing_no"/>
				<Field id="208" tableName="p_app_menu" fieldName="is_active"/>
				<Field id="209" tableName="p_app_menu" fieldName="description"/>
				<Field id="210" tableName="p_app_menu" fieldName="updated_by"/>
				<Field id="211" fieldName="to_char(updated_date,'DD-MON-YYYY')" alias="updated_date" isExpression="True"/>
				<Field id="212" tableName="p_app_menu" fieldName="created_by"/>
				<Field id="213" fieldName="to_char(creation_date,'DD-MON-YYYY')" alias="creation_date" isExpression="True"/>
			</Fields>
			<ISPParameters/>
			<ISQLParameters>
				<SQLParameter id="148" variable="code" dataType="Text" parameterType="Control" parameterSource="code"/>
				<SQLParameter id="149" variable="file_name" dataType="Text" parameterType="Control" parameterSource="file_name"/>
				<SQLParameter id="150" variable="description" dataType="Text" parameterType="Control" parameterSource="description"/>
				<SQLParameter id="152" variable="created_by" dataType="Text" parameterType="Expression" parameterSource="CCGetUserLogin()"/>
				<SQLParameter id="154" variable="updated_by" dataType="Text" parameterType="Expression" parameterSource="CCGetUserLogin()"/>
				<SQLParameter id="155" variable="parent_id" dataType="Float" parameterType="Control" parameterSource="parent_id"/>
				<SQLParameter id="156" variable="listing_no" dataType="Float" parameterType="Control" parameterSource="listing_no"/>
				<SQLParameter id="157" variable="is_active" dataType="Text" parameterType="Control" parameterSource="is_active"/>
				<SQLParameter id="158" variable="p_application_id" dataType="Float" parameterType="Control" parameterSource="p_application_id" defaultValue="0"/>
			</ISQLParameters>
			<IFormElements>
				<CustomParameter id="137" field="code" dataType="Text" parameterType="Control" parameterSource="code"/>
				<CustomParameter id="138" field="file_name" dataType="Text" parameterType="Control" parameterSource="file_name"/>
				<CustomParameter id="139" field="description" dataType="Text" parameterType="Control" parameterSource="description"/>
				<CustomParameter id="140" field="creation_date" dataType="Text" parameterType="Control" parameterSource="creation_date" format="dd-mmm-yyyy"/>
				<CustomParameter id="141" field="created_by" dataType="Text" parameterType="Control" parameterSource="created_by"/>
				<CustomParameter id="142" field="updated_date" dataType="Text" parameterType="Control" parameterSource="updated_date" format="dd-mmm-yyyy"/>
				<CustomParameter id="143" field="updated_by" dataType="Text" parameterType="Control" parameterSource="updated_by"/>
				<CustomParameter id="144" field="parent_id" dataType="Float" parameterType="Control" parameterSource="parent_id"/>
				<CustomParameter id="145" field="listing_no" dataType="Float" parameterType="Control" parameterSource="listing_no"/>
				<CustomParameter id="146" field="is_active" dataType="Text" parameterType="Control" parameterSource="IS_ACTIVE"/>
				<CustomParameter id="147" field="p_app_menu_id" dataType="Float" parameterType="Control" parameterSource="p_app_menu_id"/>
			</IFormElements>
			<USPParameters/>
			<USQLParameters>
				<SQLParameter id="186" variable="code" dataType="Text" parameterType="Control" parameterSource="code"/>
				<SQLParameter id="187" variable="file_name" dataType="Text" parameterType="Control" parameterSource="file_name"/>
				<SQLParameter id="188" variable="description" dataType="Text" parameterType="Control" parameterSource="description"/>
				<SQLParameter id="192" variable="updated_by" dataType="Text" parameterType="Expression" parameterSource="CCGetUserLogin()"/>
				<SQLParameter id="194" variable="listing_no" dataType="Float" parameterType="Control" parameterSource="listing_no"/>
				<SQLParameter id="195" variable="is_active" dataType="Text" parameterType="Control" parameterSource="is_active"/>
				<SQLParameter id="196" variable="p_app_menu_id" dataType="Float" parameterType="Control" parameterSource="p_app_menu_id" defaultValue="0"/>
				<SQLParameter id="197" variable="p_application_id" dataType="Float" parameterType="Control" parameterSource="p_application_id" defaultValue="0"/>
			</USQLParameters>
			<UConditions>
				<TableParameter id="184" conditionType="Parameter" useIsNull="False" field="p_app_menu_id" dataType="Float" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="p_app_menu_id"/>
				<TableParameter id="185" conditionType="Parameter" useIsNull="False" field="p_application_id" dataType="Float" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="p_application_id"/>
			</UConditions>
			<UFormElements>
				<CustomParameter id="172" field="code" dataType="Text" parameterType="Control" parameterSource="code"/>
				<CustomParameter id="173" field="file_name" dataType="Text" parameterType="Control" parameterSource="file_name"/>
				<CustomParameter id="174" field="description" dataType="Text" parameterType="Control" parameterSource="description"/>
				<CustomParameter id="175" field="creation_date" dataType="Text" parameterType="Control" parameterSource="creation_date" format="dd-mmm-yyyy"/>
				<CustomParameter id="176" field="created_by" dataType="Text" parameterType="Control" parameterSource="created_by"/>
				<CustomParameter id="177" field="updated_date" dataType="Text" parameterType="Control" parameterSource="updated_date" format="dd-mmm-yyyy"/>
				<CustomParameter id="178" field="updated_by" dataType="Text" parameterType="Control" parameterSource="updated_by"/>
				<CustomParameter id="179" field="parent_id" dataType="Float" parameterType="Control" parameterSource="parent_id"/>
				<CustomParameter id="180" field="listing_no" dataType="Float" parameterType="Control" parameterSource="listing_no"/>
				<CustomParameter id="181" field="is_active" dataType="Text" parameterType="Control" parameterSource="is_active"/>
				<CustomParameter id="182" field="p_app_menu_id" dataType="Float" parameterType="Control" parameterSource="p_app_menu_id"/>
				<CustomParameter id="183" field="p_application_id" dataType="Float" parameterType="Control" parameterSource="p_application_id"/>
			</UFormElements>
			<DSPParameters/>
			<DSQLParameters>
				<SQLParameter id="222" variable="p_app_menu_id" parameterType="Control" dataType="Float" parameterSource="p_app_menu_id" defaultValue="0"/>
			</DSQLParameters>
			<DConditions>
				<TableParameter id="198" conditionType="Parameter" useIsNull="False" field="p_app_menu_id" dataType="Float" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="p_app_menu_id"/>
			</DConditions>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Record>
	</Components>
	<CodeFiles>
		<CodeFile id="Events" language="PHPTemplates" name="p_app_menu_events.php" forShow="False" comment="//" codePage="windows-1252"/>
		<CodeFile id="Code" language="PHPTemplates" name="p_app_menu.php" forShow="True" url="p_app_menu.php" comment="//" codePage="windows-1252"/>
	</CodeFiles>
	<SecurityGroups/>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events>
		<Event name="OnInitializeView" type="Server">
			<Actions>
				<Action actionName="Custom Code" actionCategory="General" id="66"/>
				<Action actionName="Custom Code" actionCategory="General" id="105"/>
			</Actions>
		</Event>
	</Events>
</Page>
