<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\param" secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="RWNet" wizardThemeVersion="3.0" needGeneration="0">
	<Components>
		<Grid id="2" secured="False" sourceType="SQL" returnValueType="Number" defaultPageSize="5" connection="ConnSIKP" dataSource="SELECT * 
FROM t_cust_acc_status tcas 
	RIGHT JOIN t_cust_account tca ON (tca.t_cust_account_id = tcas.t_cust_account_id) 
	RIGHT JOIN p_account_status pa ON (pa.p_account_status_id = tcas.p_account_status_id)
WHERE upper(tcas.description) LIKE '%{s_keyword}%'
ORDER BY t_cust_acc_status_id" name="t_cust_acc_statusGrid" orderBy="p_app_user_id" pageSizeLimit="100" wizardCaption="List of P App Role " wizardGridType="Tabular" wizardAllowInsert="True" wizardAltRecord="True" wizardAltRecordType="Style" wizardRecordSeparator="False" wizardNoRecords="-" pasteAsReplace="pasteAsReplace" pasteActions="pasteActions" activeCollection="SQLParameters" parameterTypeListName="ParameterTypeList">
			<Components>
				<Link id="7" visible="Yes" fieldSourceType="DBColumn" dataType="Text" html="False" hrefType="Page" urlType="Relative" preserveParameters="GET" name="Insert_Link" hrefSource="t_cust_acc_status.ccp" removeParameters="p_app_user_id;s_keyword" wizardThemeItem="FooterA" wizardDefaultValue="Add New" wizardUseTemplateBlock="False" PathID="t_cust_acc_statusGridInsert_Link">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="67" sourceType="Expression" name="FLAG" source="&quot;ADD&quot;"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
				<Link id="11" visible="Yes" fieldSourceType="CodeExpression" html="True" hrefType="Page" urlType="Relative" preserveParameters="GET" name="DLink" wizardCaption="Detail" wizardSize="50" wizardMaxLength="60" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" dataType="Text" wizardDefaultValue="DLink" hrefSource="t_cust_acc_status.ccp" wizardThemeItem="GridA" PathID="t_cust_acc_statusGridDLink" removeParameters="FLAG">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="12" sourceType="DataField" format="yyyy-mm-dd" name="p_app_user_id" source="p_app_user_id"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
				<Label id="17" fieldSourceType="DBColumn" dataType="Text" html="False" name="code" fieldSource="code" wizardCaption="Description" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="t_cust_acc_statusGridcode">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="19" fieldSourceType="DBColumn" dataType="Text" html="False" name="company_name" fieldSource="company_name" wizardCaption="Valid From" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="t_cust_acc_statusGridcompany_name">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="21" fieldSourceType="DBColumn" dataType="Text" html="False" name="valid_to" fieldSource="valid_to" wizardCaption="Valid To" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="t_cust_acc_statusGridvalid_to">
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
				<Label id="313" fieldSourceType="DBColumn" dataType="Text" html="False" name="valid_from" fieldSource="valid_from" wizardCaption="Valid To" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="t_cust_acc_statusGridvalid_from">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
<Hidden id="314" fieldSourceType="DBColumn" dataType="Text" name="t_cust_acc_status_id" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_cust_acc_statusGridt_cust_acc_status_id" fieldSource="t_cust_acc_status_id">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Hidden>
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
			</JoinTables>
			<JoinLinks/>
			<Fields>
			</Fields>
			<SPParameters/>
			<SQLParameters>
<SQLParameter id="283" parameterType="URL" variable="s_keyword" dataType="Text" parameterSource="s_keyword"/>
</SQLParameters>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Grid>
		<Record id="3" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="None" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="t_cust_acc_statusSearch" wizardCaption="Search P App Role " wizardOrientation="Vertical" wizardFormMethod="post" returnPage="t_cust_acc_status.ccp" PathID="t_cust_acc_statusSearch">
			<Components>
				<Button id="4" urlType="Relative" enableValidation="True" isDefault="False" name="Button_DoSearch" operation="Search" wizardCaption="Search" PathID="t_cust_acc_statusSearchButton_DoSearch">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<TextBox id="5" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="s_keyword" wizardCaption="Keyword" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" PathID="t_cust_acc_statusSearchs_keyword">
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
		<Record id="94" sourceType="Table" urlType="Relative" secured="False" allowInsert="True" allowUpdate="True" allowDelete="True" validateData="True" preserveParameters="GET" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" connection="ConnSIKP" name="t_cust_acc_statusForm" dataSource="t_cust_acc_status" errorSummator="Error" wizardCaption="Add/Edit V P App User " wizardFormMethod="post" PathID="t_cust_acc_statusForm" activeCollection="USQLParameters" pasteAsReplace="pasteAsReplace" pasteActions="pasteActions" customDelete="DELETE FROM t_cust_acc_status
 WHERE t_cust_acc_status_id = t_cust_acc_status_id;" customDeleteType="SQL" activeTableType="customDelete" parameterTypeListName="ParameterTypeList" customUpdateType="SQL" customUpdate="UPDATE t_cust_acc_status
SET 
	t_cust_account_id={t_cust_account_id},
	p_account_status_id={p_account_status_id}, 
	to_date('{valid_from}','DD-MON-YYYY'),
	case when '{valid_to}' = '' then null else to_date('{valid_to}','DD-MON-YYYY') end,
	description='{description}', 
	updated_date=sysdate, 
	updated_by='{updated_by}'
WHERE t_cust_acc_status_id={t_cust_acc_status_id};" customInsertType="SQL" customInsert="INSERT INTO t_cust_acc_status(
	t_cust_acc_status_id, 
	t_cust_account_id, 
	p_account_status_id,
	valid_from, 
	valid_to, 
	description, 
	creation_date, 
	created_by, 
	updated_date, 
	updated_by)
VALUES (
	generate_id('sikp', 't_cust_acc_status', 't_cust_acc_status_id'), 
	{t_cust_account_id},
	{p_account_status_id}, 
	to_date('{valid_from}','DD-MON-YYYY'), 
	case when '{valid_to}' = '' then null else to_date('{valid_to}','DD-MON-YYYY') end,
	'{description}', 
	sysdate, 
	'{created_by}',
	sysdate, 
	'{created_by}')">
			<Components>
				<Button id="95" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Insert" operation="Insert" wizardCaption="Add" PathID="t_cust_acc_statusFormButton_Insert" removeParameters="FLAG">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="96" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Update" operation="Update" wizardCaption="Submit" PathID="t_cust_acc_statusFormButton_Update" removeParameters="FLAG">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="97" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Delete" operation="Delete" wizardCaption="Delete" PathID="t_cust_acc_statusFormButton_Delete" removeParameters="FLAG;p_app_user_id;s_keyword;p_app_userGridPage">
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
				<Button id="99" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Cancel" operation="Cancel" wizardCaption="Cancel" PathID="t_cust_acc_statusFormButton_Cancel" removeParameters="FLAG;p_app_user_id;s_keyword;p_app_userGridPage">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<TextBox id="102" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="company_name" required="False" caption="Nama User" wizardCaption="User Name" wizardSize="16" wizardMaxLength="16" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_cust_acc_statusFormcompany_name">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="104" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="t_cust_account_id_cust_acc" fieldSource="t_cust_acc_status_id" caption="Status Kustomer" wizardCaption="Full Name" wizardSize="50" wizardMaxLength="96" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_cust_acc_statusFormt_cust_account_id_cust_acc">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<ListBox id="107" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="p_account_status_id" fieldSource="p_account_status_id" required="True" caption="Status" wizardCaption="P User Type Code" wizardSize="50" wizardMaxLength="64" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_cust_acc_statusFormp_account_status_id" sourceType="Table" connection="ConnSIKP" dataSource="p_account_status" boundColumn="p_account_status_id" textColumn="code">
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
				<TextBox id="114" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="description" fieldSource="description" required="False" caption="Description" wizardCaption="Description" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_cust_acc_statusFormdescription">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="116" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="valid_from" fieldSource="valid_from" required="True" caption="Tanggal Berlaku" wizardCaption="Expired User" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_cust_acc_statusFormvalid_from" format="dd-mmm-yyyy">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<DatePicker id="117" name="DatePicker_valid_from" control="valid_from" wizardSatellite="True" wizardControl="expired_user" wizardDatePickerType="Image" wizardPicture="../Styles/RWNet/Images/DatePicker.gif" style="../Styles/RWNet/Style.css" PathID="t_cust_acc_statusFormDatePicker_valid_from">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</DatePicker>
				<TextBox id="118" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="valid_to" fieldSource="valid_to" required="False" caption="Tanggal Akhir Berlaku" wizardCaption="Expired Pwd" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_cust_acc_statusFormvalid_to" format="dd-mmm-yyyy">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<DatePicker id="119" name="DatePicker_valid_to" control="valid_to" wizardSatellite="True" wizardControl="expired_pwd" wizardDatePickerType="Image" wizardPicture="../Styles/RWNet/Images/DatePicker.gif" style="../Styles/RWNet/Style.css" PathID="t_cust_acc_statusFormDatePicker_valid_to">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</DatePicker>
				<TextBox id="124" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="created_by" fieldSource="created_by" required="False" caption="Created By" wizardCaption="Created By" wizardSize="16" wizardMaxLength="16" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_cust_acc_statusFormcreated_by" defaultValue="CCGetUserLogin()">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="127" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="updated_by" fieldSource="updated_by" required="False" caption="Updated By" wizardCaption="Updated By" wizardSize="16" wizardMaxLength="16" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_cust_acc_statusFormupdated_by" defaultValue="CCGetUserLogin()">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="122" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="creation_date" fieldSource="creation_date" required="False" caption="Creation Date" wizardCaption="Creation Date" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_cust_acc_statusFormcreation_date" format="dd-mmm-yyyy" defaultValue="date(&quot;d-M-Y&quot;)">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="125" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="updated_date" fieldSource="updated_date" required="False" caption="Updated Date" wizardCaption="Updated Date" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_cust_acc_statusFormupdated_date" defaultValue="date(&quot;d-M-Y&quot;)" format="dd-mmm-yyyy">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Hidden id="310" fieldSourceType="DBColumn" dataType="Text" name="t_cust_account_id" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_cust_acc_statusFormt_cust_account_id" fieldSource="t_cust_account_id" required="True" caption="Kustomer">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Hidden>
<Hidden id="311" fieldSourceType="DBColumn" dataType="Text" name="t_cust_acc_status_id" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_cust_acc_statusFormt_cust_acc_status_id" fieldSource="t_cust_acc_status_id" required="True" caption="Status Kustomer">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Hidden>
<Hidden id="312" fieldSourceType="DBColumn" dataType="Text" name="p_a_p_account_status_id" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_cust_acc_statusFormp_a_p_account_status_id" fieldSource="p_a_p_account_status_id">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Hidden>
</Components>
			<Events/>
			<TableParameters>
				<TableParameter id="100" conditionType="Parameter" useIsNull="False" field="p_account_status_id" dataType="Float" logicOperator="And" searchConditionType="Equal" parameterType="URL" orderNumber="1" parameterSource="p_account_status_id"/>
			</TableParameters>
			<SPParameters/>
			<SQLParameters/>
			<JoinTables>
				<JoinTable id="285" tableName="t_cust_acc_status" posLeft="10" posTop="10" posWidth="160" posHeight="180"/>
</JoinTables>
			<JoinLinks/>
			<Fields>
				<Field id="274" fieldName="to_char(creation_date,'DD-MON-YYYY')" alias="creation_date" isExpression="True"/>
				<Field id="276" fieldName="to_char(updated_date,'DD-MON-YYYY')" alias="updated_date" isExpression="True"/>
				<Field id="286" tableName="t_cust_acc_status" fieldName="t_cust_acc_status_id"/>
<Field id="287" tableName="t_cust_acc_status" fieldName="t_cust_account_id"/>
<Field id="288" tableName="t_cust_acc_status" fieldName="p_a_p_account_status_id"/>
<Field id="289" tableName="t_cust_acc_status" fieldName="p_account_status_id"/>
<Field id="290" tableName="t_cust_acc_status" fieldName="valid_from"/>
<Field id="291" tableName="t_cust_acc_status" fieldName="valid_to"/>
<Field id="293" tableName="t_cust_acc_status" fieldName="description"/>
<Field id="294" tableName="t_cust_acc_status" fieldName="created_by"/>
<Field id="295" tableName="t_cust_acc_status" fieldName="updated_by"/>
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
				<SQLParameter id="296" variable="t_cust_account_id" parameterType="Control" defaultValue="0" dataType="Float" parameterSource="t_cust_account_id"/>
<SQLParameter id="297" variable="p_a_p_account_status_id" parameterType="Control" dataType="Text" parameterSource="p_a_p_account_status_id"/>
<SQLParameter id="298" variable="p_account_status_id" parameterType="Control" defaultValue="0" dataType="Float" parameterSource="p_account_status_id"/>
<SQLParameter id="299" variable="valid_from" parameterType="Control" dataType="Text" parameterSource="valid_from" format="dd-mmm-yyyy"/>
<SQLParameter id="300" variable="valid_to" parameterType="Control" dataType="Text" parameterSource="valid_to" format="dd-mmm-yyyy"/>
<SQLParameter id="301" variable="description" parameterType="Control" dataType="Text" parameterSource="description"/>
<SQLParameter id="302" variable="created_by" parameterType="Expression" dataType="Text" parameterSource="CCGetUserLogin()"/>
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
				<SQLParameter id="245" variable="t_cust_acc_status_id" dataType="Float" parameterType="Control" parameterSource="t_cust_acc_status_id" defaultValue="0"/>
				<SQLParameter id="250" variable="description" dataType="Text" parameterType="Control" parameterSource="description"/>
				<SQLParameter id="260" variable="updated_by" parameterType="Expression" dataType="Text" parameterSource="CCGetUserLogin()"/>
				<SQLParameter id="303" variable="t_cust_account_id" parameterType="Control" dataType="Float" parameterSource="t_cust_account_id" defaultValue="0"/>
<SQLParameter id="304" variable="p_a_p_account_status_id" parameterType="Control" dataType="Text" parameterSource="p_a_p_account_status_id"/>
<SQLParameter id="305" variable="p_account_status_id" parameterType="Control" defaultValue="0" dataType="Float" parameterSource="p_account_status_id"/>
<SQLParameter id="306" variable="valid_from" parameterType="Control" dataType="Text" parameterSource="valid_from" format="dd-mmm-yyyy"/>
<SQLParameter id="307" variable="valid_to" parameterType="Control" dataType="Text" parameterSource="valid_to" format="dd-mmm-yyyy"/>
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
				<SQLParameter id="131" variable="t_cust_acc_status_id" parameterType="Control" dataType="Float" parameterSource="t_cust_acc_status_id" defaultValue="0"/>
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
		<CodeFile id="Events" language="PHPTemplates" name="t_cust_acc_status_events.php" forShow="False" comment="//" codePage="windows-1252"/>
		<CodeFile id="Code" language="PHPTemplates" name="t_cust_acc_status.php" forShow="True" url="t_cust_acc_status.php" comment="//" codePage="windows-1252"/>
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
