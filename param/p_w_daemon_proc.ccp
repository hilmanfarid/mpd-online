<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\param" secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="Spring" wizardThemeVersion="3.0" needGeneration="0" pasteActions="pasteActions">
	<Components>
		<Grid id="2" secured="False" sourceType="Table" returnValueType="Number" defaultPageSize="5" connection="ConnSIKP" name="p_w_daemon_procGrid" pageSizeLimit="100" wizardCaption="List of P App Module Role " wizardGridType="Tabular" wizardSortingType="SimpleDir" wizardAllowInsert="True" wizardAltRecord="False" wizardAltRecordType="Style" wizardRecordSeparator="False" wizardNoRecords="data tidak ditemukan" activeCollection="TableParameters" pasteActions="pasteActions" parameterTypeListName="ParameterTypeList" dataSource="p_w_daemon_proc" orderBy="p_w_daemon_proc_id">
			<Components>
				<Label id="28" fieldSourceType="DBColumn" dataType="Text" html="False" name="valid_from" fieldSource="valid_from" wizardCaption="Valid From" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="p_w_daemon_procGridvalid_from">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="30" fieldSourceType="DBColumn" dataType="Text" html="False" name="valid_to" fieldSource="valid_to" wizardCaption="Valid To" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="p_w_daemon_procGridvalid_to">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="32" fieldSourceType="DBColumn" dataType="Text" html="False" name="description" fieldSource="description" wizardCaption="Description" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="p_w_daemon_procGriddescription">
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
				<Label id="86" fieldSourceType="DBColumn" dataType="Text" html="False" name="daemon_name" fieldSource="daemon_name" wizardCaption="Description" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="p_w_daemon_procGriddaemon_name">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Link id="11" visible="Yes" fieldSourceType="CodeExpression" html="True" hrefType="Page" urlType="Relative" preserveParameters="GET" name="DLink" wizardCaption="Detail" wizardSize="50" wizardMaxLength="60" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" dataType="Text" wizardDefaultValue="DLink" hrefSource="p_w_daemon_proc.ccp" wizardThemeItem="GridA" PathID="p_w_daemon_procGridDLink" removeParameters="FLAG">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="196" sourceType="DataField" name="p_w_daemon_proc_id" source="p_w_daemon_proc_id"/>
</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
				<Hidden id="184" fieldSourceType="DBColumn" dataType="Float" name="p_w_daemon_proc_id" fieldSource="p_w_daemon_proc_id" required="False" caption="Id" wizardCaption="Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_w_daemon_procGridp_w_daemon_proc_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Link id="7" visible="Yes" fieldSourceType="DBColumn" dataType="Text" html="False" hrefType="Page" urlType="Relative" preserveParameters="GET" name="Insert_Link" hrefSource="p_w_daemon_proc.ccp" removeParameters="p_application_role_id;s_keyword" wizardThemeItem="FooterA" wizardDefaultValue="Add New" wizardUseTemplateBlock="False" PathID="p_w_daemon_procGridInsert_Link">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="67" sourceType="Expression" name="FLAG" source="&quot;ADD&quot;"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
				<Label id="192" fieldSourceType="DBColumn" dataType="Text" html="False" name="expression_rule" fieldSource="expression_rule" wizardCaption="Description" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="p_w_daemon_procGridexpression_rule">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
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
				<TableParameter id="194" conditionType="Parameter" useIsNull="False" field="p_w_chart_proc_id" dataType="Float" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="p_w_chart_proc_id"/>
<TableParameter id="195" conditionType="Parameter" useIsNull="False" field="upper(daemon_name)" dataType="Text" searchConditionType="Contains" parameterType="URL" logicOperator="And" parameterSource="s_keyword"/>
</TableParameters>
			<JoinTables>
				<JoinTable id="193" tableName="p_w_daemon_proc" posLeft="10" posTop="10" posWidth="160" posHeight="180"/>
</JoinTables>
			<JoinLinks/>
			<Fields/>
			<SPParameters/>
			<SQLParameters>
			</SQLParameters>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Grid>
		<Record id="3" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="None" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="p_w_daemon_procSearch" wizardCaption="Search P App Module Role " wizardOrientation="Vertical" wizardFormMethod="post" returnPage="p_w_daemon_proc.ccp" PathID="p_w_daemon_procSearch" pasteActions="pasteActions">
			<Components>
				<TextBox id="5" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="s_keyword" wizardCaption="Keyword" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" PathID="p_w_daemon_procSearchs_keyword">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Button id="4" urlType="Relative" enableValidation="True" isDefault="False" name="Button_DoSearch" operation="Search" wizardCaption="Search" PathID="p_w_daemon_procSearchButton_DoSearch">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Hidden id="100" fieldSourceType="DBColumn" dataType="Float" name="p_w_chart_proc_id" PathID="p_w_daemon_procSearchp_w_chart_proc_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="135" fieldSourceType="DBColumn" dataType="Text" name="p_applicationGridPage" wizardCaption="Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_w_daemon_procSearchp_applicationGridPage">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="188" fieldSourceType="DBColumn" dataType="Text" name="app_s_keyword" wizardCaption="Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_w_daemon_procSearchapp_s_keyword">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="191" fieldSourceType="DBColumn" dataType="Text" name="app_code" PathID="p_w_daemon_procSearchapp_code">
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
		<Label id="96" fieldSourceType="DBColumn" dataType="Text" html="False" name="doc_name" PathID="doc_name">
			<Components/>
			<Events/>
			<Attributes/>
			<Features/>
		</Label>
		<Record id="23" sourceType="SQL" urlType="Relative" secured="False" allowInsert="True" allowUpdate="True" allowDelete="True" validateData="True" preserveParameters="GET" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" connection="ConnSIKP" name="p_w_daemon_procForm" errorSummator="Error" wizardCaption="Add/Edit P App Role " wizardFormMethod="post" PathID="p_w_daemon_procForm" customDeleteType="SQL" customDelete="DELETE FROM p_w_daemon_proc
WHERE  p_w_daemon_proc_id = {p_w_daemon_proc_id}" activeCollection="ISQLParameters" customUpdateType="SQL" customUpdate="UPDATE p_w_daemon_proc SET 
daemon_name='{daemon_name}', 
valid_from=to_date('{valid_from}','DD-MON-YYYY'), 
description='{description}', 
update_date=sysdate, 
update_by='{updated_by}', 
valid_to=case when '{valid_to}' = '' then null else to_date('{valid_to}','DD-MON-YYYY') end, 
expression_rule='{expression_rule}'
WHERE p_w_daemon_proc_id={p_w_daemon_proc_id} " parameterTypeListName="ParameterTypeList" pasteAsReplace="pasteAsReplace" pasteActions="pasteActions" customInsert="INSERT INTO p_w_daemon_proc(p_w_chart_proc_id, daemon_name, valid_from, description, create_date, create_by, update_date, update_by, valid_to, p_w_daemon_proc_id, expression_rule) 
VALUES({p_w_chart_proc_id}, '{daemon_name}', to_date('{valid_from}','DD-MON-YYYY'), '{description}', sysdate, '{created_by}', sysdate, '{updated_by}', case when '{valid_to}' = '' then null else to_date('{valid_to}','DD-MON-YYYY') end, generate_id('sikp','p_w_daemon_proc','p_w_daemon_proc_id'), '{expression_rule}')" customInsertType="SQL" dataSource="SELECT p_w_daemon_proc_id, p_w_chart_proc_id, daemon_name, 
expression_rule, to_char(valid_from,'DD-MON-YYYY')as valid_from, to_char(valid_to,'DD-MON-YYYY')as valid_to, description, to_char(update_date,'DD-MON-YYYY')as update_date, update_by,
create_by, to_char(create_date,'DD-MON-YYYY')as create_date
FROM p_w_daemon_proc
WHERE p_w_daemon_proc_id = {p_w_daemon_proc_id} ">
			<Components>
				<Button id="24" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Insert" operation="Insert" wizardCaption="Add" PathID="p_w_daemon_procFormButton_Insert" removeParameters="FLAG">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="25" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Update" operation="Update" wizardCaption="Submit" PathID="p_w_daemon_procFormButton_Update" removeParameters="FLAG">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="26" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Delete" operation="Delete" wizardCaption="Delete" PathID="p_w_daemon_procFormButton_Delete" removeParameters="p_w_daemon_proc_id;s_keyword;FLAG;p_w_daemon_procGridPage">
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
				<Button id="124" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Cancel" operation="Cancel" wizardCaption="Cancel" PathID="p_w_daemon_procFormButton_Cancel" removeParameters="p_w_daemon_proc_id;s_keyword;FLAG;p_w_daemon_procGridPage">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Hidden id="125" fieldSourceType="DBColumn" dataType="Float" name="p_w_chart_proc_id" fieldSource="p_w_chart_proc_id" required="False" caption="Id" wizardCaption="Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_w_daemon_procFormp_w_chart_proc_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<TextBox id="31" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="daemon_name" fieldSource="daemon_name" required="True" caption="Nama Syarat Perpindahan" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_w_daemon_procFormdaemon_name">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="33" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="valid_from" fieldSource="valid_from" required="True" caption="Valid From" wizardCaption="Valid From" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_w_daemon_procFormvalid_from" defaultValue="date(&quot;d-M-Y&quot;)" format="dd-mmm-yyyy">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<DatePicker id="34" name="DatePicker_valid_from" control="valid_from" wizardSatellite="True" wizardControl="valid_from" wizardDatePickerType="Image" wizardPicture="../Styles/CoffeeBreak/Images/DatePicker.gif" style="../Styles/sikp/Style.css" PathID="p_w_daemon_procFormDatePicker_valid_from">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</DatePicker>
				<TextBox id="37" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="description" fieldSource="description" required="False" caption="Description" wizardCaption="Description" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_w_daemon_procFormdescription">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="38" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="creation_date" fieldSource="create_date" required="False" caption="Creation Date" wizardCaption="Creation Date" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_w_daemon_procFormcreation_date" format="dd-mmm-yyyy" defaultValue="date(&quot;d-M-Y&quot;)">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="40" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="created_by" fieldSource="create_by" required="False" caption="Created By" wizardCaption="Created By" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_w_daemon_procFormcreated_by" defaultValue="CCGetUserLogin()">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="126" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="updated_date" fieldSource="update_date" required="False" caption="Updated Date" wizardCaption="Updated Date" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_w_daemon_procFormupdated_date" format="dd-mmm-yyyy" defaultValue="date(&quot;d-M-Y&quot;)">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="127" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="updated_by" fieldSource="update_by" required="False" caption="Updated By" wizardCaption="Updated By" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_w_daemon_procFormupdated_by" defaultValue="CCGetUserLogin()">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="35" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="valid_to" fieldSource="valid_to" required="False" caption="Valid To" wizardCaption="Valid To" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_w_daemon_procFormvalid_to" format="dd-mmm-yyyy">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<DatePicker id="36" name="DatePicker_valid_to" control="valid_to" wizardSatellite="True" wizardControl="valid_to" wizardDatePickerType="Image" wizardPicture="../Styles/CoffeeBreak/Images/DatePicker.gif" style="../Styles/sikp/Style.css" PathID="p_w_daemon_procFormDatePicker_valid_to">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</DatePicker>
				<Hidden id="180" fieldSourceType="DBColumn" dataType="Float" name="p_w_daemon_proc_id" PathID="p_w_daemon_procFormp_w_daemon_proc_id" fieldSource="p_w_daemon_proc_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<TextArea id="101" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="expression_rule" fieldSource="expression_rule" required="True" caption="expression_rule" wizardCaption="EXPRESSION RULE" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_w_daemon_procFormexpression_rule">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextArea>
<Hidden id="211" fieldSourceType="DBColumn" dataType="Text" name="p_w_daemon_procGridPage" PathID="p_w_daemon_procFormp_w_daemon_procGridPage">
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
				<TableParameter id="198" conditionType="Parameter" useIsNull="False" field="p_w_daemon_proc_id" dataType="Float" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="p_w_daemon_proc_id"/>
</TableParameters>
			<SPParameters/>
			<SQLParameters>
				<SQLParameter id="210" parameterType="URL" variable="p_w_daemon_proc_id" dataType="Float" parameterSource="p_w_daemon_proc_id"/>
</SQLParameters>
			<JoinTables>
				<JoinTable id="197" tableName="p_w_daemon_proc" posWidth="160" posHeight="180" posLeft="10" posTop="10"/>
</JoinTables>
			<JoinLinks/>
			<Fields>
				<Field id="199" tableName="p_w_daemon_proc" fieldName="p_w_daemon_proc_id"/>
<Field id="200" tableName="p_w_daemon_proc" fieldName="p_w_chart_proc_id"/>
<Field id="201" tableName="p_w_daemon_proc" fieldName="daemon_name"/>
<Field id="202" tableName="p_w_daemon_proc" fieldName="expression_rule"/>
<Field id="203" tableName="p_w_daemon_proc" fieldName="valid_from"/>
<Field id="204" tableName="p_w_daemon_proc" fieldName="valid_to"/>
<Field id="205" tableName="p_w_daemon_proc" fieldName="description"/>
<Field id="206" tableName="p_w_daemon_proc" fieldName="update_date"/>
<Field id="207" tableName="p_w_daemon_proc" fieldName="update_by"/>
<Field id="208" tableName="p_w_daemon_proc" fieldName="create_by"/>
<Field id="209" tableName="p_w_daemon_proc" fieldName="create_date"/>
</Fields>
			<ISPParameters/>
			<ISQLParameters>
				<SQLParameter id="224" variable="p_w_chart_proc_id" dataType="Float" parameterType="Control" parameterSource="p_w_chart_proc_id"/>
<SQLParameter id="225" variable="daemon_name" dataType="Text" parameterType="Control" parameterSource="daemon_name"/>
<SQLParameter id="226" variable="valid_from" dataType="Text" parameterType="Control" parameterSource="valid_from" format="dd-mmm-yyyy"/>
<SQLParameter id="227" variable="description" dataType="Text" parameterType="Control" parameterSource="description"/>
<SQLParameter id="229" variable="created_by" dataType="Text" parameterType="Expression" parameterSource="CCGetUserLogin()"/>
<SQLParameter id="231" variable="updated_by" dataType="Text" parameterType="Expression" parameterSource="CCGetUserLogin()"/>
<SQLParameter id="232" variable="valid_to" dataType="Text" parameterType="Control" parameterSource="valid_to"/>
<SQLParameter id="235" variable="expression_rule" dataType="Text" parameterType="Control" parameterSource="expression_rule"/>
</ISQLParameters>
			<IFormElements>
				<CustomParameter id="212" field="p_w_chart_proc_id" dataType="Float" parameterType="Control" parameterSource="p_w_chart_proc_id"/>
<CustomParameter id="213" field="daemon_name" dataType="Text" parameterType="Control" parameterSource="daemon_name"/>
<CustomParameter id="214" field="valid_from" dataType="Text" parameterType="Control" parameterSource="valid_from" format="dd-mmm-yyyy"/>
<CustomParameter id="215" field="description" dataType="Text" parameterType="Control" parameterSource="description"/>
<CustomParameter id="216" field="create_date" dataType="Text" parameterType="Control" parameterSource="creation_date" format="dd-mmm-yyyy"/>
<CustomParameter id="217" field="create_by" dataType="Text" parameterType="Control" parameterSource="created_by"/>
<CustomParameter id="218" field="update_date" dataType="Text" parameterType="Control" parameterSource="updated_date" format="dd-mmm-yyyy"/>
<CustomParameter id="219" field="update_by" dataType="Text" parameterType="Control" parameterSource="updated_by"/>
<CustomParameter id="220" field="valid_to" dataType="Text" parameterType="Control" parameterSource="valid_to" format="dd-mmm-yyyy"/>
<CustomParameter id="221" field="p_w_daemon_proc_id" dataType="Float" parameterType="Control" parameterSource="p_w_daemon_proc_id"/>
<CustomParameter id="222" field="p_app_role_id" dataType="Float" parameterType="Control" parameterSource="p_app_role_id"/>
<CustomParameter id="223" field="expression_rule" dataType="Text" parameterType="Control" parameterSource="expression_rule"/>
</IFormElements>
			<USPParameters/>
			<USQLParameters>
				<SQLParameter id="249" variable="daemon_name" dataType="Text" parameterType="Control" parameterSource="daemon_name"/>
<SQLParameter id="250" variable="valid_from" dataType="Text" parameterType="Control" parameterSource="valid_from" format="dd-mmm-yyyy"/>
<SQLParameter id="251" variable="description" dataType="Text" parameterType="Control" parameterSource="description"/>
<SQLParameter id="255" variable="updated_by" dataType="Text" parameterType="Expression" parameterSource="CCGetUserLogin()"/>
<SQLParameter id="256" variable="valid_to" dataType="Text" parameterType="Control" parameterSource="valid_to" format="dd-mmm-yyyy"/>
<SQLParameter id="257" variable="p_w_daemon_proc_id" dataType="Float" parameterType="Control" parameterSource="p_w_daemon_proc_id" defaultValue="0"/>
<SQLParameter id="259" variable="expression_rule" dataType="Text" parameterType="Control" parameterSource="expression_rule"/>
</USQLParameters>
			<UConditions>
			</UConditions>
			<UFormElements>
				<CustomParameter id="236" field="p_w_chart_proc_id" dataType="Float" parameterType="Control" parameterSource="p_w_chart_proc_id"/>
<CustomParameter id="237" field="daemon_name" dataType="Text" parameterType="Control" parameterSource="daemon_name"/>
<CustomParameter id="238" field="valid_from" dataType="Text" parameterType="Control" parameterSource="valid_from" format="dd-mmm-yyyy"/>
<CustomParameter id="239" field="description" dataType="Text" parameterType="Control" parameterSource="description"/>
<CustomParameter id="240" field="create_date" dataType="Text" parameterType="Control" parameterSource="creation_date" format="dd-mmm-yyyy"/>
<CustomParameter id="241" field="create_by" dataType="Text" parameterType="Control" parameterSource="created_by"/>
<CustomParameter id="242" field="update_date" dataType="Text" parameterType="Control" parameterSource="updated_date" format="dd-mmm-yyyy"/>
<CustomParameter id="243" field="update_by" dataType="Text" parameterType="Control" parameterSource="updated_by"/>
<CustomParameter id="244" field="valid_to" dataType="Text" parameterType="Control" parameterSource="valid_to" format="dd-mmm-yyyy"/>
<CustomParameter id="245" field="p_w_daemon_proc_id" dataType="Float" parameterType="Control" parameterSource="p_w_daemon_proc_id"/>
<CustomParameter id="246" field="p_app_role_id" dataType="Float" parameterType="Control" parameterSource="p_app_role_id"/>
<CustomParameter id="247" field="expression_rule" dataType="Text" parameterType="Control" parameterSource="expression_rule"/>
</UFormElements>
			<DSPParameters/>
			<DSQLParameters>
				<SQLParameter id="260" variable="p_w_daemon_proc_id" parameterType="Control" defaultValue="0" dataType="Float" parameterSource="p_w_daemon_proc_id"/>
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
		<CodeFile id="Events" language="PHPTemplates" name="p_w_daemon_proc_events.php" forShow="False" comment="//" codePage="windows-1252"/>
		<CodeFile id="Code" language="PHPTemplates" name="p_w_daemon_proc.php" forShow="True" url="p_w_daemon_proc.php" comment="//" codePage="windows-1252"/>
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
