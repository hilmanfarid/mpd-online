<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\param" secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="RWNet" wizardThemeVersion="3.0" needGeneration="0">
	<Components>
		<Grid id="2" secured="False" sourceType="Table" returnValueType="Number" defaultPageSize="5" connection="ConnSIKP" name="p_proc_transition_ruleGrid" pageSizeLimit="100" wizardCaption="List of P App Role " wizardGridType="Tabular" wizardAllowInsert="True" wizardAltRecord="True" wizardAltRecordType="Style" wizardRecordSeparator="False" wizardNoRecords="-" pasteAsReplace="pasteAsReplace" pasteActions="pasteActions" activeCollection="TableParameters" parameterTypeListName="ParameterTypeList" orderBy="p_proc_transition_rule_id" dataSource="p_proc_transition_rule">
			<Components>
				<Link id="7" visible="Yes" fieldSourceType="DBColumn" dataType="Text" html="False" hrefType="Page" urlType="Relative" preserveParameters="GET" name="Insert_Link" hrefSource="p_proc_transition_rule.ccp" removeParameters="p_proc_transition_rule_id;s_keyword" wizardThemeItem="FooterA" wizardDefaultValue="Add New" wizardUseTemplateBlock="False" PathID="p_proc_transition_ruleGridInsert_Link">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="67" sourceType="Expression" name="FLAG" source="&quot;ADD&quot;"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
				<Link id="11" visible="Yes" fieldSourceType="CodeExpression" html="True" hrefType="Page" urlType="Relative" preserveParameters="GET" name="DLink" wizardCaption="Detail" wizardSize="50" wizardMaxLength="60" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" dataType="Text" wizardDefaultValue="DLink" hrefSource="p_proc_transition_rule.ccp" wizardThemeItem="GridA" PathID="p_proc_transition_ruleGridDLink" removeParameters="FLAG">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="722" sourceType="DataField" name="p_proc_transition_rule_id" source="p_proc_transition_rule_id"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
				<Label id="15" fieldSourceType="DBColumn" dataType="Text" html="False" name="code" fieldSource="code" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="p_proc_transition_ruleGridcode">
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
				<Hidden id="13" fieldSourceType="DBColumn" dataType="Float" html="False" name="p_proc_transition_rule_id" fieldSource="p_proc_transition_rule_id" wizardCaption="Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="p_proc_transition_ruleGridp_proc_transition_rule_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Label id="332" fieldSourceType="DBColumn" dataType="Text" html="False" name="description" fieldSource="description" wizardCaption="Valid From" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="p_proc_transition_ruleGriddescription">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="509" fieldSourceType="DBColumn" dataType="Text" html="False" name="table_name" fieldSource="table_name" wizardCaption="Valid From" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="p_proc_transition_ruleGridtable_name">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="510" fieldSourceType="DBColumn" dataType="Text" html="False" name="column_name" fieldSource="column_name" wizardCaption="Valid From" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="p_proc_transition_ruleGridcolumn_name">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="542" fieldSourceType="DBColumn" dataType="Text" html="False" name="is_active" fieldSource="is_active" wizardCaption="Valid From" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="p_proc_transition_ruleGridis_active">
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
				<JoinTable id="697" tableName="p_proc_transition_rule" posLeft="10" posTop="10" posWidth="160" posHeight="180"/>
			</JoinTables>
			<JoinLinks/>
			<Fields>
				<Field id="457" fieldName="*"/>
			</Fields>
			<SPParameters/>
			<SQLParameters>
			</SQLParameters>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Grid>
		<Record id="3" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="None" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="p_proc_transition_ruleSearch" wizardCaption="Search P App Role " wizardOrientation="Vertical" wizardFormMethod="post" returnPage="p_proc_transition_rule.ccp" PathID="p_proc_transition_ruleSearch" pasteActions="pasteActions">
			<Components>
				<Button id="4" urlType="Relative" enableValidation="True" isDefault="False" name="Button_DoSearch" operation="Search" wizardCaption="Search" PathID="p_proc_transition_ruleSearchButton_DoSearch">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<TextBox id="5" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="s_keyword" wizardCaption="Keyword" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" PathID="p_proc_transition_ruleSearchs_keyword">
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
		<Record id="94" sourceType="SQL" urlType="Relative" secured="False" allowInsert="True" allowUpdate="True" allowDelete="True" validateData="True" preserveParameters="GET" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" connection="ConnSIKP" name="p_proc_transition_ruleForm" errorSummator="Error" wizardCaption="Add/Edit V P App User " wizardFormMethod="post" PathID="p_proc_transition_ruleForm" activeCollection="DSQLParameters" pasteAsReplace="pasteAsReplace" pasteActions="pasteActions" customDeleteType="SQL" parameterTypeListName="ParameterTypeList" customUpdateType="SQL" customInsertType="SQL" customInsert="INSERT INTO p_proc_transition_rule(p_proc_transition_rule_id, updated_by, code, column_name, updated_date, created_by, creation_date, description, table_name, is_active, is_range, is_statement, condition_statement, data_type, first_value, second_value) 
VALUES(generate_id('sikp','p_proc_transition_rule','p_proc_transition_rule_id'), '{updated_by}', '{code}', '{column_name}', sysdate, '{created_by}', sysdate, '{description}', '{table_name}', '{is_active}', '{is_range}', '{is_statement}', '{condition_statement}', '{data_type}', '{first_value}', '{second_value}')" customUpdate="UPDATE p_proc_transition_rule SET 
updated_by='{updated_by}', 
code='{code}', 
column_name='{column_name}', 
updated_date=sysdate, 
description='{description}', 
table_name='{table_name}', 
is_active='{is_active}', 
is_range='{is_range}', 
is_statement='{is_statement}', 
condition_statement='{condition_statement}', 
data_type='{data_type}', 
first_value='{first_value}', 
second_value='{second_value}'
WHERE p_proc_transition_rule_id={p_proc_transition_rule_id}" customDelete="DELETE FROM p_proc_transition_rule 
WHERE  p_proc_transition_rule_id = {p_proc_transition_rule_id}" activeTableType="customDelete" dataSource="SELECT p_proc_transition_rule_id, code, description, 
table_name, column_name, is_range, first_value, 
second_value, data_type, is_statement, condition_statement, 
is_active, to_char(creation_date,'DD-MON-YYYY')as creation_date, created_by, 
to_char(updated_date,'DD-MON-YYYY')as updated_date, updated_by 
FROM p_proc_transition_rule 
WHERE p_proc_transition_rule_id = {p_proc_transition_rule_id}">
			<Components>
				<Button id="95" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Insert" operation="Insert" wizardCaption="Add" PathID="p_proc_transition_ruleFormButton_Insert" removeParameters="FLAG">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="96" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Update" operation="Update" wizardCaption="Submit" PathID="p_proc_transition_ruleFormButton_Update" removeParameters="FLAG">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="97" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Delete" operation="Delete" wizardCaption="Delete" PathID="p_proc_transition_ruleFormButton_Delete" removeParameters="FLAG;p_proc_transition_rule_id;s_keyword;p_proc_transition_ruleGridPage">
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
				<Button id="99" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Cancel" operation="Cancel" wizardCaption="Cancel" PathID="p_proc_transition_ruleFormButton_Cancel" removeParameters="FLAG;p_proc_transition_rule_id;s_keyword;p_proc_transition_ruleGridPage">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Hidden id="101" fieldSourceType="DBColumn" dataType="Float" name="p_proc_transition_rule_id" fieldSource="p_proc_transition_rule_id" caption="Id" wizardCaption="P App User Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_proc_transition_ruleFormp_proc_transition_rule_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<TextBox id="127" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="updated_by" fieldSource="updated_by" required="False" caption="Updated By" wizardCaption="Updated By" wizardSize="16" wizardMaxLength="16" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_proc_transition_ruleFormupdated_by" defaultValue="CCGetUserLogin()">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Hidden id="165" fieldSourceType="DBColumn" dataType="Text" name="p_proc_transition_ruleGridPage" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="p_proc_transition_ruleFormp_proc_transition_ruleGridPage">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<TextBox id="156" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="code" fieldSource="code" required="True" caption="Kode" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_proc_transition_ruleFormcode">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="460" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="column_name" fieldSource="column_name" required="False" caption="Nama Kolom" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_proc_transition_ruleFormcolumn_name">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="125" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="updated_date" fieldSource="updated_date" required="False" caption="Updated Date" wizardCaption="Updated Date" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_proc_transition_ruleFormupdated_date" defaultValue="date(&quot;d-M-Y&quot;)" format="dd-mmm-yyyy">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="40" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="created_by" fieldSource="created_by" required="True" caption="Created By" wizardCaption="Created By" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_proc_transition_ruleFormcreated_by" defaultValue="CCGetUserLogin()">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="38" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="creation_date" fieldSource="creation_date" required="True" caption="Creation Date" wizardCaption="Creation Date" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_proc_transition_ruleFormcreation_date" format="dd-mmm-yyyy" defaultValue="date(&quot;d-M-Y&quot;)">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="37" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="description" fieldSource="description" required="False" caption="Description" wizardCaption="Description" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_proc_transition_ruleFormdescription">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="546" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="table_name" fieldSource="table_name" required="False" caption="Nama Tabel" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_proc_transition_ruleFormtable_name">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<ListBox id="549" visible="Yes" fieldSourceType="DBColumn" sourceType="ListOfValues" dataType="Text" returnValueType="Number" name="is_active" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" wizardEmptyCaption="Select Value" PathID="p_proc_transition_ruleFormis_active" connection="ConnSIKP" dataSource="Y;AKTIF;N;TIDAK AKTIF" fieldSource="is_active" _valueOfList="N" _nameOfList="TIDAK AKTIF" required="True" caption="Status?">
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
				<ListBox id="698" visible="Yes" fieldSourceType="DBColumn" sourceType="ListOfValues" dataType="Text" returnValueType="Number" name="is_range" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" wizardEmptyCaption="Select Value" PathID="p_proc_transition_ruleFormis_range" connection="ConnSIKP" dataSource="Y;YA;N;TIDAK" fieldSource="is_range" _valueOfList="N" _nameOfList="TIDAK" required="False" caption="Range?">
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
				<ListBox id="699" visible="Yes" fieldSourceType="DBColumn" sourceType="ListOfValues" dataType="Text" returnValueType="Number" name="is_statement" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" wizardEmptyCaption="Select Value" PathID="p_proc_transition_ruleFormis_statement" connection="ConnSIKP" dataSource="Y;STATEMEN;N;NON STATEMEN" fieldSource="is_statement" _valueOfList="N" _nameOfList="NON STATEMEN" required="True" caption="Statemen?">
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
				<TextArea id="700" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="condition_statement" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="p_proc_transition_ruleFormcondition_statement" fieldSource="condition_statement" caption="Statemen Kondisi" required="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextArea>
				<ListBox id="701" visible="Yes" fieldSourceType="DBColumn" sourceType="ListOfValues" dataType="Text" returnValueType="Number" name="data_type" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" wizardEmptyCaption="Select Value" PathID="p_proc_transition_ruleFormdata_type" connection="ConnSIKP" dataSource="Y;YA;N;TIDAK" fieldSource="data_type" _valueOfList="N" _nameOfList="TIDAK" required="False" caption="Tipe Data?">
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
				<TextBox id="702" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="first_value" fieldSource="first_value" required="False" caption="Nilai Pertama" wizardCaption="Description" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_proc_transition_ruleFormfirst_value">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="703" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="second_value" fieldSource="second_value" required="False" caption="Nilai Kedua" wizardCaption="Description" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_proc_transition_ruleFormsecond_value">
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
				<SQLParameter id="721" variable="p_proc_transition_rule_id" parameterType="URL" defaultValue="0" dataType="Float" parameterSource="p_proc_transition_rule_id"/>
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
				<SQLParameter id="740" variable="updated_by" dataType="Text" parameterType="Expression" parameterSource="CCGetUserLogin()"/>
				<SQLParameter id="741" variable="code" dataType="Text" parameterType="Control" parameterSource="code"/>
				<SQLParameter id="742" variable="column_name" dataType="Text" parameterType="Control" parameterSource="column_name"/>
				<SQLParameter id="744" variable="created_by" dataType="Text" parameterType="Expression" parameterSource="CCGetUserLogin()"/>
				<SQLParameter id="746" variable="description" dataType="Text" parameterType="Control" parameterSource="description"/>
				<SQLParameter id="747" variable="table_name" dataType="Text" parameterType="Control" parameterSource="table_name"/>
				<SQLParameter id="748" variable="is_active" dataType="Text" parameterType="Control" parameterSource="is_active"/>
				<SQLParameter id="749" variable="is_range" dataType="Text" parameterType="Control" parameterSource="is_range"/>
				<SQLParameter id="750" variable="is_statement" dataType="Text" parameterType="Control" parameterSource="is_statement"/>
				<SQLParameter id="751" variable="condition_statement" dataType="Text" parameterType="Control" parameterSource="condition_statement"/>
				<SQLParameter id="752" variable="data_type" dataType="Text" parameterType="Control" parameterSource="data_type"/>
				<SQLParameter id="753" variable="first_value" dataType="Text" parameterType="Control" parameterSource="first_value"/>
				<SQLParameter id="754" variable="second_value" dataType="Text" parameterType="Control" parameterSource="second_value"/>
			</ISQLParameters>
			<IFormElements>
				<CustomParameter id="723" field="p_proc_transition_rule_id" dataType="Float" parameterType="Control" parameterSource="p_proc_transition_rule_id"/>
				<CustomParameter id="724" field="updated_by" dataType="Text" parameterType="Control" parameterSource="updated_by"/>
				<CustomParameter id="725" field="code" dataType="Text" parameterType="Control" parameterSource="code"/>
				<CustomParameter id="726" field="column_name" dataType="Text" parameterType="Control" parameterSource="column_name"/>
				<CustomParameter id="727" field="updated_date" dataType="Text" parameterType="Control" parameterSource="updated_date" format="dd-mmm-yyyy"/>
				<CustomParameter id="728" field="created_by" dataType="Text" parameterType="Control" parameterSource="created_by"/>
				<CustomParameter id="729" field="creation_date" dataType="Text" parameterType="Control" parameterSource="creation_date" format="dd-mmm-yyyy"/>
				<CustomParameter id="730" field="description" dataType="Text" parameterType="Control" parameterSource="description"/>
				<CustomParameter id="731" field="table_name" dataType="Text" parameterType="Control" parameterSource="table_name"/>
				<CustomParameter id="732" field="is_active" dataType="Text" parameterType="Control" parameterSource="is_active"/>
				<CustomParameter id="733" field="is_range" dataType="Text" parameterType="Control" parameterSource="is_range"/>
				<CustomParameter id="734" field="is_statement" dataType="Text" parameterType="Control" parameterSource="is_statement"/>
				<CustomParameter id="735" field="condition_statement" dataType="Text" parameterType="Control" parameterSource="condition_statement"/>
				<CustomParameter id="736" field="data_type" dataType="Text" parameterType="Control" parameterSource="data_type"/>
				<CustomParameter id="737" field="first_value" dataType="Text" parameterType="Control" parameterSource="first_value"/>
				<CustomParameter id="738" field="second_value" dataType="Text" parameterType="Control" parameterSource="second_value"/>
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
				<SQLParameter id="771" variable="p_proc_transition_rule_id" dataType="Float" parameterType="Control" parameterSource="p_proc_transition_rule_id"/>
				<SQLParameter id="772" variable="updated_by" dataType="Text" parameterType="Expression" parameterSource="CCGetUserLogin()"/>
				<SQLParameter id="773" variable="code" dataType="Text" parameterType="Control" parameterSource="code"/>
				<SQLParameter id="774" variable="column_name" dataType="Text" parameterType="Control" parameterSource="column_name"/>
				<SQLParameter id="778" variable="description" dataType="Text" parameterType="Control" parameterSource="description"/>
				<SQLParameter id="779" variable="table_name" dataType="Text" parameterType="Control" parameterSource="table_name"/>
				<SQLParameter id="780" variable="is_active" dataType="Text" parameterType="Control" parameterSource="is_active"/>
				<SQLParameter id="781" variable="is_range" dataType="Text" parameterType="Control" parameterSource="is_range"/>
				<SQLParameter id="782" variable="is_statement" dataType="Text" parameterType="Control" parameterSource="is_statement"/>
				<SQLParameter id="783" variable="condition_statement" dataType="Text" parameterType="Control" parameterSource="condition_statement"/>
				<SQLParameter id="784" variable="data_type" dataType="Text" parameterType="Control" parameterSource="data_type"/>
				<SQLParameter id="785" variable="first_value" dataType="Text" parameterType="Control" parameterSource="first_value"/>
				<SQLParameter id="786" variable="second_value" dataType="Text" parameterType="Control" parameterSource="second_value"/>
			</USQLParameters>
			<UConditions>
			</UConditions>
			<UFormElements>
				<CustomParameter id="755" field="p_proc_transition_rule_id" dataType="Float" parameterType="Control" parameterSource="p_proc_transition_rule_id"/>
				<CustomParameter id="756" field="updated_by" dataType="Text" parameterType="Control" parameterSource="updated_by"/>
				<CustomParameter id="757" field="code" dataType="Text" parameterType="Control" parameterSource="code"/>
				<CustomParameter id="758" field="column_name" dataType="Text" parameterType="Control" parameterSource="column_name"/>
				<CustomParameter id="759" field="updated_date" dataType="Text" parameterType="Control" parameterSource="updated_date" format="dd-mmm-yyyy"/>
				<CustomParameter id="760" field="created_by" dataType="Text" parameterType="Control" parameterSource="created_by"/>
				<CustomParameter id="761" field="creation_date" dataType="Text" parameterType="Control" parameterSource="creation_date" format="dd-mmm-yyyy"/>
				<CustomParameter id="762" field="description" dataType="Text" parameterType="Control" parameterSource="description"/>
				<CustomParameter id="763" field="table_name" dataType="Text" parameterType="Control" parameterSource="table_name"/>
				<CustomParameter id="764" field="is_active" dataType="Text" parameterType="Control" parameterSource="is_active"/>
				<CustomParameter id="765" field="is_range" dataType="Text" parameterType="Control" parameterSource="is_range"/>
				<CustomParameter id="766" field="is_statement" dataType="Text" parameterType="Control" parameterSource="is_statement"/>
				<CustomParameter id="767" field="condition_statement" dataType="Text" parameterType="Control" parameterSource="condition_statement"/>
				<CustomParameter id="768" field="data_type" dataType="Text" parameterType="Control" parameterSource="data_type"/>
				<CustomParameter id="769" field="first_value" dataType="Text" parameterType="Control" parameterSource="first_value"/>
				<CustomParameter id="770" field="second_value" dataType="Text" parameterType="Control" parameterSource="second_value"/>
			</UFormElements>
			<DSPParameters/>
			<DSQLParameters>
				<SQLParameter id="788" variable="p_proc_transition_rule_id" parameterType="Control" dataType="Float" parameterSource="p_proc_transition_rule_id" defaultValue="0"/>
			</DSQLParameters>
			<DConditions>
				<TableParameter id="787" conditionType="Parameter" useIsNull="False" field="p_proc_transition_rule_id" dataType="Float" searchConditionType="Equal" parameterType="Control" logicOperator="And" parameterSource="p_proc_transition_rule_id"/>
			</DConditions>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Record>
	</Components>
	<CodeFiles>
		<CodeFile id="Events" language="PHPTemplates" name="p_proc_transition_rule_events.php" forShow="False" comment="//" codePage="windows-1252"/>
		<CodeFile id="Code" language="PHPTemplates" name="p_proc_transition_rule.php" forShow="True" url="p_proc_transition_rule.php" comment="//" codePage="windows-1252"/>
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
