<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\param" secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="RWNet" wizardThemeVersion="3.0" needGeneration="0">
	<Components>
		<Grid id="2" secured="False" sourceType="SQL" returnValueType="Number" defaultPageSize="5" connection="ConnSIKP" dataSource="select b.* from t_customer_user a
left join p_app_user b on a.p_app_user_id=b.p_app_user_id
WHERE ( upper(b.app_user_name) LIKE '%{s_keyword}%'
OR upper(b.full_name) LIKE '%{s_keyword}%'
OR upper(b.email_address) LIKE '%{s_keyword}%'
OR upper(b.description) LIKE '%{s_keyword}%' )
and  b.p_user_status_id =1 and is_employee = 'N'
ORDER BY user_name" name="p_app_userGrid" orderBy="p_app_user_id" pageSizeLimit="100" wizardCaption="List of P App Role " wizardGridType="Tabular" wizardAllowInsert="True" wizardAltRecord="True" wizardAltRecordType="Style" wizardRecordSeparator="False" wizardNoRecords="-" pasteAsReplace="pasteAsReplace" pasteActions="pasteActions" activeCollection="TableParameters">
			<Components>
				<Link id="11" visible="Yes" fieldSourceType="CodeExpression" html="True" hrefType="Page" urlType="Relative" preserveParameters="GET" name="DLink" wizardCaption="Detail" wizardSize="50" wizardMaxLength="60" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" dataType="Text" wizardDefaultValue="DLink" hrefSource="reset_pass_wp.ccp" wizardThemeItem="GridA" PathID="p_app_userGridDLink" removeParameters="FLAG">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="12" sourceType="DataField" format="yyyy-mm-dd" name="p_app_user_id" source="p_app_user_id"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
				<Label id="15" fieldSourceType="DBColumn" dataType="Text" html="False" name="app_user_name" fieldSource="app_user_name" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="p_app_userGridapp_user_name">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="17" fieldSourceType="DBColumn" dataType="Text" html="False" name="description" fieldSource="description" wizardCaption="Description" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="p_app_userGriddescription">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="19" fieldSourceType="DBColumn" dataType="Text" html="False" name="full_name" fieldSource="full_name" wizardCaption="Valid From" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="p_app_userGridfull_name">
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
				<Hidden id="13" fieldSourceType="DBColumn" dataType="Float" html="False" name="p_app_user_id" fieldSource="p_app_user_id" wizardCaption="Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="p_app_userGridp_app_user_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Link id="7" visible="Yes" fieldSourceType="DBColumn" dataType="Text" html="False" hrefType="Page" urlType="Relative" preserveParameters="GET" name="Insert_Link" hrefSource="reset_pass_wp.ccp" removeParameters="p_app_user_id;s_keyword" PathID="p_app_userGridInsert_Link">
<Components/>
<Events/>
<LinkParameters>
<LinkParameter id="67" sourceType="Expression" format="yyyy-mm-dd" name="FLAG" source="&quot;ADD&quot;"/>
</LinkParameters>
<Attributes/>
<Features/>
</Link>
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
				<TableParameter id="8" conditionType="Parameter" useIsNull="False" field="upper(app_user_name)" dataType="Text" logicOperator="Or" searchConditionType="Contains" parameterType="URL" orderNumber="1" leftBrackets="1" parameterSource="s_keyword"/>
				<TableParameter id="92" conditionType="Parameter" useIsNull="False" field="upper(full_name)" dataType="Text" searchConditionType="Contains" parameterType="URL" logicOperator="Or" parameterSource="s_keyword"/>
				<TableParameter id="93" conditionType="Parameter" useIsNull="False" field="upper(email_address)" dataType="Text" searchConditionType="Contains" parameterType="URL" logicOperator="Or" parameterSource="s_keyword"/>
				<TableParameter id="9" conditionType="Parameter" useIsNull="False" field="upper(description)" dataType="Text" logicOperator="Or" searchConditionType="Contains" parameterType="URL" orderNumber="2" rightBrackets="1" parameterSource="s_keyword"/>
			</TableParameters>
			<JoinTables>
				<JoinTable id="278" tableName="p_app_user" posLeft="10" posTop="10" posWidth="133" posHeight="180"/>
			</JoinTables>
			<JoinLinks/>
			<Fields>
			</Fields>
			<SPParameters/>
			<SQLParameters>
<SQLParameter id="287" parameterType="URL" variable="s_keyword" dataType="Text" parameterSource="s_keyword"/>
</SQLParameters>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Grid>
		<Record id="3" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="None" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="p_app_userSearch" wizardCaption="Search P App Role " wizardOrientation="Vertical" wizardFormMethod="post" returnPage="reset_pass_wp.ccp" PathID="p_app_userSearch">
			<Components>
				<Button id="4" urlType="Relative" enableValidation="True" isDefault="False" name="Button_DoSearch" operation="Search" wizardCaption="Search" PathID="p_app_userSearchButton_DoSearch">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<TextBox id="5" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="s_keyword" wizardCaption="Keyword" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" PathID="p_app_userSearchs_keyword">
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
		<Record id="94" sourceType="Table" urlType="Relative" secured="False" allowInsert="True" allowUpdate="True" allowDelete="True" validateData="True" preserveParameters="GET" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" connection="ConnSIKP" name="p_app_userForm" dataSource="p_app_user" errorSummator="Error" wizardCaption="Add/Edit V P App User " wizardFormMethod="post" PathID="p_app_userForm" activeCollection="USQLParameters" pasteAsReplace="pasteAsReplace" pasteActions="pasteActions" customDelete="DELETE FROM p_app_user WHERE  p_app_user_id = {p_app_user_id}" customDeleteType="SQL" activeTableType="customDelete" parameterTypeListName="ParameterTypeList" customUpdateType="SQL" customInsertType="SQL" customInsert="INSERT INTO p_app_user(p_app_user_id, 
app_user_name, 
user_pwd,
full_name, 
email_address, 
p_user_status_id, 
description, 
ip_address_v4, 
expired_user, 
expired_pwd, 
last_login_time, 
created_by, 
updated_by, 
creation_date, 
updated_date, 
ip_address_v6,
fail_login_trial,
is_employee) VALUES
(generate_id('sikp','p_app_user','p_app_user_id'), 
'{app_user_name}', 
md5('{app_user_name}'), 
'{full_name}', 
'{email_address}', 
'{p_user_status_id}', 
'{description}', 
'{ip_address_v4}', 
case when '{expired_user}'= '' then null else to_date('{expired_user}','DD-MON-YYYY') end, 
case when '{expired_pwd}'= '' then null else to_date('{expired_pwd}','DD-MON-YYYY') end, 
null, 
'{created_by}', 
'{updated_by}', 
sysdate, 
sysdate, 
'{ip_address_v6}',
{fail_login_trial},
'{is_employee}')">
			<Components>
				<Button id="95" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Insert" operation="Insert" wizardCaption="Add" PathID="p_app_userFormButton_Insert" removeParameters="FLAG">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="96" urlType="Relative" enableValidation="True" isDefault="False" name="Button_update" wizardCaption="Submit" PathID="p_app_userFormButton_update">
					<Components/>
					<Events>
<Event name="OnClick" type="Server">
<Actions>
<Action actionName="Custom Code" actionCategory="General" id="288"/>
</Actions>
</Event>
</Events>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="97" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Delete" operation="Delete" wizardCaption="Delete" PathID="p_app_userFormButton_Delete" removeParameters="FLAG;p_app_user_id;s_keyword;p_app_userGridPage">
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
				<Button id="99" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Cancel" operation="Cancel" wizardCaption="Cancel" PathID="p_app_userFormButton_Cancel" removeParameters="FLAG;p_app_user_id;s_keyword;p_app_userGridPage">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Hidden id="101" fieldSourceType="DBColumn" dataType="Float" name="p_app_user_id" fieldSource="p_app_user_id" required="False" caption="P App User Id" wizardCaption="P App User Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_app_userFormp_app_user_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<TextBox id="102" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="app_user_name" fieldSource="app_user_name" required="False" caption="Nama User" wizardCaption="User Name" wizardSize="16" wizardMaxLength="16" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_app_userFormapp_user_name">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="104" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="full_name" fieldSource="full_name" required="False" caption="Nama Lengkap" wizardCaption="Full Name" wizardSize="50" wizardMaxLength="96" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_app_userFormfull_name">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="105" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="email_address" fieldSource="email_address" required="False" caption="Email" wizardCaption="Email Address" wizardSize="50" wizardMaxLength="128" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_app_userFormemail_address" inputMask="^[\w\.-]{1,}\@([\da-zA-Z-]{1,}\.){1,}[\da-zA-Z-]+$">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<ListBox id="107" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="p_user_status_id" fieldSource="p_user_status_id" required="False" caption="Status" wizardCaption="P User Type Code" wizardSize="50" wizardMaxLength="64" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_app_userFormp_user_status_id" sourceType="Table" connection="ConnSIKP" dataSource="p_user_status" boundColumn="p_user_status_id" textColumn="code">
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
				<TextBox id="114" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="description" fieldSource="description" required="False" caption="Description" wizardCaption="Description" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_app_userFormdescription">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="115" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="ip_address_v4" fieldSource="ip_address_v4" required="False" caption="IP Address v4" wizardCaption="Ip Address" wizardSize="24" wizardMaxLength="24" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_app_userFormip_address_v4">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="116" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="expired_user" fieldSource="expired_user" required="False" caption="Expired User" wizardCaption="Expired User" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_app_userFormexpired_user" format="dd-mmm-yyyy">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="118" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="expired_pwd" fieldSource="expired_pwd" required="False" caption="Expired Pwd" wizardCaption="Expired Pwd" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_app_userFormexpired_pwd" format="dd-mmm-yyyy">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="120" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="last_login_time" fieldSource="last_login_time" required="False" caption="Terakhir Login" wizardCaption="Last Login Time" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_app_userFormlast_login_time" format="dd-mmm-yyyy">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="124" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="created_by" fieldSource="created_by" required="False" caption="Created By" wizardCaption="Created By" wizardSize="16" wizardMaxLength="16" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_app_userFormcreated_by" defaultValue="CCGetUserLogin()">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="127" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="updated_by" fieldSource="updated_by" required="False" caption="Updated By" wizardCaption="Updated By" wizardSize="16" wizardMaxLength="16" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_app_userFormupdated_by" defaultValue="CCGetUserLogin()">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="122" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="creation_date" fieldSource="creation_date" required="False" caption="Creation Date" wizardCaption="Creation Date" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_app_userFormcreation_date" format="dd-mmm-yyyy" defaultValue="date(&quot;d-M-Y&quot;)">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="125" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="updated_date" fieldSource="updated_date" required="False" caption="Updated Date" wizardCaption="Updated Date" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_app_userFormupdated_date" defaultValue="date(&quot;d-M-Y&quot;)" format="dd-mmm-yyyy">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="175" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="ip_address_v6" fieldSource="ip_address_v6" required="False" caption="IP Address v6" wizardCaption="Ip Address" wizardSize="24" wizardMaxLength="24" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_app_userFormip_address_v6">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Hidden id="165" fieldSourceType="DBColumn" dataType="Text" name="p_app_userGridPage" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="p_app_userFormp_app_userGridPage">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<ListBox id="284" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="is_employee" fieldSource="is_employee" required="False" caption="Employee ?" wizardCaption="P User Type Code" wizardSize="50" wizardMaxLength="64" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_app_userFormis_employee" sourceType="ListOfValues" connection="ConnSIKP" _valueOfList="N" _nameOfList="TIDAK" dataSource="Y;YA;N;TIDAK" defaultValue="&quot;Y&quot;">
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
			</Components>
			<Events/>
			<TableParameters>
				<TableParameter id="100" conditionType="Parameter" useIsNull="False" field="p_app_user_id" dataType="Float" logicOperator="And" searchConditionType="Equal" parameterType="URL" orderNumber="1" parameterSource="p_app_user_id"/>
			</TableParameters>
			<SPParameters/>
			<SQLParameters/>
			<JoinTables>
				<JoinTable id="174" tableName="p_app_user" posLeft="10" posTop="10" posWidth="133" posHeight="180"/>
			</JoinTables>
			<JoinLinks/>
			<Fields>
				<Field id="261" tableName="p_app_user" fieldName="p_app_user_id"/>
				<Field id="262" tableName="p_app_user" fieldName="app_user_name"/>
				<Field id="263" tableName="p_app_user" fieldName="user_pwd"/>
				<Field id="264" tableName="p_app_user" fieldName="full_name"/>
				<Field id="265" tableName="p_app_user" fieldName="email_address"/>
				<Field id="266" tableName="p_app_user" fieldName="p_user_status_id"/>
				<Field id="267" tableName="p_app_user" fieldName="description"/>
				<Field id="268" tableName="p_app_user" fieldName="ip_address_v4"/>
				<Field id="269" tableName="p_app_user" fieldName="ip_address_v6"/>
				<Field id="270" fieldName="to_char(expired_user,'DD-MON-YYYY')" isExpression="True" alias="expired_user"/>
				<Field id="271" fieldName="to_char(expired_pwd,'DD-MON-YYYY')" isExpression="True" alias="expired_pwd"/>
				<Field id="272" tableName="p_app_user" fieldName="last_login_time"/>
				<Field id="273" tableName="p_app_user" fieldName="fail_login_trial"/>
				<Field id="274" fieldName="to_char(creation_date,'DD-MON-YYYY')" alias="creation_date" isExpression="True"/>
				<Field id="275" tableName="p_app_user" fieldName="created_by"/>
				<Field id="276" fieldName="to_char(updated_date,'DD-MON-YYYY')" alias="updated_date" isExpression="True"/>
				<Field id="277" tableName="p_app_user" fieldName="updated_by"/>
				<Field id="283" tableName="p_app_user" fieldName="is_employee"/>
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
				<SQLParameter id="199" variable="full_name" dataType="Text" parameterType="Control" parameterSource="full_name"/>
				<SQLParameter id="200" variable="p_user_status_id" dataType="Text" parameterType="Control" parameterSource="p_user_status_id"/>
				<SQLParameter id="201" variable="description" dataType="Text" parameterType="Control" parameterSource="description"/>
				<SQLParameter id="202" variable="ip_address_v4" dataType="Text" parameterType="Control" parameterSource="ip_address_v4"/>
				<SQLParameter id="203" variable="expired_user" dataType="Text" parameterType="Control" parameterSource="expired_user" format="dd-mm-yyyy"/>
				<SQLParameter id="204" variable="expired_pwd" dataType="Text" parameterType="Control" parameterSource="expired_pwd" format="dd-mm-yyyy"/>
				<SQLParameter id="206" variable="created_by" dataType="Text" parameterType="Expression" parameterSource="CCGetUserLogin()"/>
				<SQLParameter id="207" variable="updated_by" dataType="Text" parameterType="Expression" parameterSource="CCGetUserLogin()"/>
				<SQLParameter id="210" variable="ip_address_v6" dataType="Text" parameterType="Control" parameterSource="ip_address_v6"/>
				<SQLParameter id="226" variable="p_app_user_id" dataType="Float" parameterType="Control" parameterSource="p_app_user_id"/>
				<SQLParameter id="227" variable="app_user_name" dataType="Text" parameterType="Control" parameterSource="app_user_name"/>
				<SQLParameter id="228" variable="email_address" dataType="Text" parameterType="Control" parameterSource="email_address"/>
				<SQLParameter id="229" variable="fail_login_trial" parameterType="Expression" defaultValue="0" dataType="Integer" parameterSource="0"/>
				<SQLParameter id="285" variable="is_employee" parameterType="Control" dataType="Text" parameterSource="is_employee"/>
			</ISQLParameters>
			<IFormElements>
				<CustomParameter id="211" field="p_app_user_id" dataType="Float" parameterType="Control" parameterSource="p_app_user_id"/>
				<CustomParameter id="212" field="app_user_name" dataType="Text" parameterType="Control" parameterSource="app_user_name"/>
				<CustomParameter id="213" field="full_name" dataType="Text" parameterType="Control" parameterSource="full_name"/>
				<CustomParameter id="214" field="email_address" dataType="Text" parameterType="Control" parameterSource="email_address"/>
				<CustomParameter id="215" field="p_user_status_id" dataType="Text" parameterType="Control" parameterSource="p_user_status_id"/>
				<CustomParameter id="216" field="description" dataType="Text" parameterType="Control" parameterSource="description"/>
				<CustomParameter id="217" field="ip_address_v4" dataType="Text" parameterType="Control" parameterSource="ip_address_v4"/>
				<CustomParameter id="218" field="expired_user" dataType="Text" parameterType="Control" parameterSource="expired_user" format="dd-mm-yyyy"/>
				<CustomParameter id="219" field="expired_pwd" dataType="Text" parameterType="Control" parameterSource="expired_pwd" format="dd-mm-yyyy"/>
				<CustomParameter id="220" field="last_login_time" dataType="Text" parameterType="Control" parameterSource="last_login_time" format="dd-mm-yyyy"/>
				<CustomParameter id="221" field="created_by" dataType="Text" parameterType="Control" parameterSource="created_by"/>
				<CustomParameter id="222" field="updated_by" dataType="Text" parameterType="Control" parameterSource="updated_by"/>
				<CustomParameter id="223" field="creation_date" dataType="Text" parameterType="Control" parameterSource="creation_date" format="dd-mm-yyyy"/>
				<CustomParameter id="224" field="updated_date" dataType="Text" parameterType="Control" parameterSource="updated_date" format="dd-mm-yyyy"/>
				<CustomParameter id="225" field="ip_address_v6" dataType="Text" parameterType="Control" parameterSource="ip_address_v6"/>
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
				<SQLParameter id="245" variable="p_app_user_id" dataType="Float" parameterType="Control" parameterSource="p_app_user_id"/>
				<SQLParameter id="246" variable="app_user_name" dataType="Text" parameterType="Control" parameterSource="app_user_name"/>
				<SQLParameter id="247" variable="full_name" dataType="Text" parameterType="Control" parameterSource="full_name"/>
				<SQLParameter id="248" variable="email_address" dataType="Text" parameterType="Control" parameterSource="email_address"/>
				<SQLParameter id="249" variable="p_user_status_id" dataType="Text" parameterType="Control" parameterSource="p_user_status_id"/>
				<SQLParameter id="250" variable="description" dataType="Text" parameterType="Control" parameterSource="description"/>
				<SQLParameter id="251" variable="ip_address_v4" dataType="Text" parameterType="Control" parameterSource="ip_address_v4"/>
				<SQLParameter id="252" variable="expired_user" dataType="Text" parameterType="Control" parameterSource="expired_user" format="dd-mm-yyyy"/>
				<SQLParameter id="253" variable="expired_pwd" dataType="Text" parameterType="Control" parameterSource="expired_pwd" format="dd-mm-yyyy"/>
				<SQLParameter id="259" variable="ip_address_v6" dataType="Text" parameterType="Control" parameterSource="ip_address_v6"/>
				<SQLParameter id="260" variable="updated_by" parameterType="Expression" dataType="Text" parameterSource="CCGetUserLogin()"/>
				<SQLParameter id="286" variable="is_employee" parameterType="Control" dataType="Text" parameterSource="is_employee"/>
			</USQLParameters>
			<UConditions/>
			<UFormElements>
				<CustomParameter id="230" field="p_app_user_id" dataType="Float" parameterType="Control" parameterSource="p_app_user_id"/>
				<CustomParameter id="231" field="app_user_name" dataType="Text" parameterType="Control" parameterSource="app_user_name"/>
				<CustomParameter id="232" field="full_name" dataType="Text" parameterType="Control" parameterSource="full_name"/>
				<CustomParameter id="233" field="email_address" dataType="Text" parameterType="Control" parameterSource="email_address"/>
				<CustomParameter id="234" field="p_user_status_id" dataType="Text" parameterType="Control" parameterSource="p_user_status_id"/>
				<CustomParameter id="235" field="description" dataType="Text" parameterType="Control" parameterSource="description"/>
				<CustomParameter id="236" field="ip_address_v4" dataType="Text" parameterType="Control" parameterSource="ip_address_v4"/>
				<CustomParameter id="237" field="expired_user" dataType="Text" parameterType="Control" parameterSource="expired_user" format="dd-mm-yyyy"/>
				<CustomParameter id="238" field="expired_pwd" dataType="Text" parameterType="Control" parameterSource="expired_pwd" format="dd-mm-yyyy"/>
				<CustomParameter id="239" field="last_login_time" dataType="Text" parameterType="Control" parameterSource="last_login_time" format="dd-mm-yyyy"/>
				<CustomParameter id="240" field="created_by" dataType="Text" parameterType="Control" parameterSource="created_by"/>
				<CustomParameter id="241" field="updated_by" dataType="Text" parameterType="Control" parameterSource="updated_by"/>
				<CustomParameter id="242" field="creation_date" dataType="Text" parameterType="Control" parameterSource="creation_date" format="dd-mm-yyyy"/>
				<CustomParameter id="243" field="updated_date" dataType="Text" parameterType="Control" parameterSource="updated_date" format="dd-mm-yyyy"/>
				<CustomParameter id="244" field="ip_address_v6" dataType="Text" parameterType="Control" parameterSource="ip_address_v6"/>
			</UFormElements>
			<DSPParameters/>
			<DSQLParameters>
				<SQLParameter id="131" variable="p_app_user_id" parameterType="Control" dataType="Float" parameterSource="p_app_user_id" defaultValue="0"/>
			</DSQLParameters>
			<DConditions>
				<TableParameter id="130" conditionType="Parameter" useIsNull="False" field="p_app_user_id" dataType="Float" parameterType="Control" searchConditionType="Equal" logicOperator="And" orderNumber="1" parameterSource="p_app_user_id"/>
			</DConditions>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Record>
	</Components>
	<CodeFiles>
		<CodeFile id="Events" language="PHPTemplates" name="reset_pass_wp_events.php" forShow="False" comment="//" codePage="windows-1252"/>
		<CodeFile id="Code" language="PHPTemplates" name="reset_pass_wp.php" forShow="True" url="reset_pass_wp.php" comment="//" codePage="windows-1252"/>
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
