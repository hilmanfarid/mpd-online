<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\param" secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="RWNet" wizardThemeVersion="3.0" needGeneration="0">
	<Components>
		<Grid id="2" secured="False" sourceType="SQL" returnValueType="Number" defaultPageSize="5" connection="ConnSIKP" dataSource="SELECT * 
FROM p_account_status
WHERE upper(code) LIKE '%{s_keyword}%'
OR upper(description) LIKE '%{s_keyword}%'
ORDER BY p_account_status_id" name="p_account_statusGrid" orderBy="p_app_user_id" pageSizeLimit="100" wizardCaption="List of P App Role " wizardGridType="Tabular" wizardAllowInsert="True" wizardAltRecord="True" wizardAltRecordType="Style" wizardRecordSeparator="False" wizardNoRecords="-" pasteAsReplace="pasteAsReplace" pasteActions="pasteActions" activeCollection="TableParameters">
			<Components>
				<Link id="7" visible="Yes" fieldSourceType="DBColumn" dataType="Text" html="False" hrefType="Page" urlType="Relative" preserveParameters="GET" name="Insert_Link" hrefSource="p_account_status.ccp" removeParameters="p_app_user_id;s_keyword" wizardThemeItem="FooterA" wizardDefaultValue="Add New" wizardUseTemplateBlock="False" PathID="p_account_statusGridInsert_Link">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="67" sourceType="Expression" name="FLAG" source="&quot;ADD&quot;"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
				<Link id="11" visible="Yes" fieldSourceType="CodeExpression" html="True" hrefType="Page" urlType="Relative" preserveParameters="GET" name="DLink" wizardCaption="Detail" wizardSize="50" wizardMaxLength="60" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" dataType="Text" wizardDefaultValue="DLink" hrefSource="p_account_status.ccp" wizardThemeItem="GridA" PathID="p_account_statusGridDLink" removeParameters="FLAG">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="12" sourceType="DataField" format="yyyy-mm-dd" name="p_app_user_id" source="p_app_user_id"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
				<Label id="15" fieldSourceType="DBColumn" dataType="Text" html="False" name="description" fieldSource="description" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="p_account_statusGriddescription">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="19" fieldSourceType="DBColumn" dataType="Text" html="False" name="created_by" fieldSource="created_by" wizardCaption="Valid From" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="p_account_statusGridcreated_by">
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
				<Label id="279" fieldSourceType="DBColumn" dataType="Text" html="False" name="code" fieldSource="code" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="p_account_statusGridcode">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
<Label id="280" fieldSourceType="DBColumn" dataType="Text" html="False" name="update_date" fieldSource="updated_date" wizardCaption="Valid From" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="p_account_statusGridupdate_date">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
<Hidden id="281" fieldSourceType="DBColumn" dataType="Text" name="p_account_status_id" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="p_account_statusGridp_account_status_id" fieldSource="p_account_status_id">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Hidden>
<ImageLink id="199" visible="Yes" fieldSourceType="DBColumn" dataType="Text" hrefType="Page" urlType="Relative" preserveParameters="GET" name="ImageLink1" PathID="p_account_statusGridImageLink1" hrefSource="p_app_role_menu.ccp" removeParameters="s_keyword">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="200" sourceType="DataField" format="yyyy-mm-dd" name="p_app_menu_id" source="p_app_menu_id"/>
<LinkParameter id="293" sourceType="DataField" format="yyyy-mm-dd" name="code" source="code"/>
<LinkParameter id="294" sourceType="URL" format="yyyy-mm-dd" name="p_app_menuGridPage" source="p_app_menuGridPage"/>
<LinkParameter id="295" sourceType="URL" format="yyyy-mm-dd" name="p_application_id" source="p_application_id"/>
<LinkParameter id="296" sourceType="URL" format="yyyy-mm-dd" name="app_s_keyword" source="app_s_keyword"/>
<LinkParameter id="297" sourceType="URL" format="yyyy-mm-dd" name="menu_s_keyword" source="s_keyword"/>
<LinkParameter id="298" sourceType="URL" format="yyyy-mm-dd" name="parent_id" source="parent_id"/>
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
						<Action actionName="Custom Code" actionCategory="General" id="129"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
				<TableParameter id="8" conditionType="Parameter" useIsNull="False" field="upper(app_user_name)" dataType="Text" logicOperator="Or" searchConditionType="Contains" parameterType="URL" orderNumber="1" leftBrackets="2" parameterSource="s_keyword" rightBrackets="1"/>
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
<SQLParameter id="289" parameterType="URL" variable="s_keyword" dataType="Text" parameterSource="s_keyword"/>
</SQLParameters>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Grid>
		<Record id="3" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="None" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="p_account_statusSearch" wizardCaption="Search P App Role " wizardOrientation="Vertical" wizardFormMethod="post" returnPage="p_account_status.ccp" PathID="p_account_statusSearch">
			<Components>
				<Button id="4" urlType="Relative" enableValidation="True" isDefault="False" name="Button_DoSearch" operation="Search" wizardCaption="Search" PathID="p_account_statusSearchButton_DoSearch">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<TextBox id="5" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="s_keyword" wizardCaption="Keyword" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" PathID="p_account_statusSearchs_keyword">
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
		<Record id="94" sourceType="Table" urlType="Relative" secured="False" allowInsert="True" allowUpdate="True" allowDelete="True" validateData="True" preserveParameters="GET" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" connection="ConnSIKP" name="p_account_statusForm" dataSource="p_account_status" errorSummator="Error" wizardCaption="Add/Edit V P App User " wizardFormMethod="post" PathID="p_account_statusForm" activeCollection="ISQLParameters" pasteAsReplace="pasteAsReplace" pasteActions="pasteActions" customDelete="DELETE FROM p_account_status
 WHERE p_account_status_id = {p_account_status_id};" customDeleteType="SQL" activeTableType="customDelete" parameterTypeListName="ParameterTypeList" customUpdateType="SQL" customUpdate="UPDATE p_account_status
   SET code='{code}', description='{description}',
       updated_date=sysdate, updated_by='{updated_by}'
 WHERE p_account_status_id={p_account_status_id};" customInsertType="SQL" customInsert="INSERT INTO p_account_status(
		p_account_status_id, 
		code, 
		description, 
		creation_date, 
		created_by, 
		updated_date, 
		updated_by)
    VALUES (
		generate_id('sikp','p_account_status','p_account_status_id'), 
		'{code}', 
		'{description}', 
		sysdate, 
		'{created_by}', 
		sysdate, 
		'{created_by}'
	)">
			<Components>
				<Button id="95" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Insert" operation="Insert" wizardCaption="Add" PathID="p_account_statusFormButton_Insert" removeParameters="FLAG">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="96" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Update" operation="Update" wizardCaption="Submit" PathID="p_account_statusFormButton_Update" removeParameters="FLAG">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="97" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Delete" operation="Delete" wizardCaption="Delete" PathID="p_account_statusFormButton_Delete" removeParameters="FLAG;p_account_status_id;s_keyword;p_account_statusGridPage">
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
				<Button id="99" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Cancel" operation="Cancel" wizardCaption="Cancel" PathID="p_account_statusFormButton_Cancel" removeParameters="FLAG;p_account_status_id;s_keyword;p_account_statusGridPageFLAG;p_app_user_id;s_keyword;p_app_userGridPage">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<TextBox id="102" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="code" fieldSource="code" required="True" caption="code" wizardCaption="User Name" wizardSize="16" wizardMaxLength="16" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_account_statusFormcode">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="114" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="description" fieldSource="description" required="False" caption="Description" wizardCaption="Description" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_account_statusFormdescription">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="124" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="created_by" fieldSource="created_by" required="False" caption="Created By" wizardCaption="Created By" wizardSize="16" wizardMaxLength="16" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_account_statusFormcreated_by" defaultValue="CCGetUserLogin()">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="127" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="updated_by" fieldSource="updated_by" required="False" caption="Updated By" wizardCaption="Updated By" wizardSize="16" wizardMaxLength="16" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_account_statusFormupdated_by" defaultValue="CCGetUserLogin()">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="122" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="creation_date" fieldSource="creation_date" required="False" caption="Creation Date" wizardCaption="Creation Date" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_account_statusFormcreation_date" format="dd-mmm-yyyy" defaultValue="date(&quot;d-M-Y&quot;)">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="125" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="updated_date" fieldSource="updated_date" required="False" caption="Updated Date" wizardCaption="Updated Date" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_account_statusFormupdated_date" defaultValue="date(&quot;d-M-Y&quot;)" format="dd-mmm-yyyy">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Hidden id="292" fieldSourceType="DBColumn" dataType="Text" name="p_account_status_id" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="p_account_statusFormp_account_status_id" fieldSource="p_account_status_id">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Hidden>
<Hidden id="165" fieldSourceType="DBColumn" dataType="Text" name="p_account_statusGridPage" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="p_account_statusFormp_account_statusGridPage">
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
				<JoinTable id="282" tableName="p_account_status" posLeft="10" posTop="10" posWidth="154" posHeight="168"/>
</JoinTables>
			<JoinLinks/>
			<Fields>
				<Field id="274" fieldName="to_char(creation_date,'DD-MON-YYYY')" alias="creation_date" isExpression="True"/>
				<Field id="276" fieldName="to_char(updated_date,'DD-MON-YYYY')" alias="updated_date" isExpression="True"/>
				<Field id="283" tableName="p_account_status" fieldName="code"/>
<Field id="284" tableName="p_account_status" fieldName="p_account_status_id"/>
<Field id="285" tableName="p_account_status" fieldName="description"/>
<Field id="286" tableName="p_account_status" fieldName="updated_by"/>
<Field id="287" tableName="p_account_status" fieldName="created_by"/>
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
				<SQLParameter id="201" variable="description" dataType="Text" parameterType="Control" parameterSource="description"/>
				<SQLParameter id="206" variable="created_by" dataType="Text" parameterType="Expression" parameterSource="CCGetUserLogin()"/>
				<SQLParameter id="290" variable="code" parameterType="Control" dataType="Text" parameterSource="code"/>
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
				<SQLParameter id="245" variable="p_account_status_id" dataType="Float" parameterType="Control" parameterSource="p_account_status_id" defaultValue="0"/>
				<SQLParameter id="247" variable="code" dataType="Text" parameterType="Control" parameterSource="code"/>
				<SQLParameter id="250" variable="description" dataType="Text" parameterType="Control" parameterSource="description"/>
				<SQLParameter id="260" variable="updated_by" parameterType="Expression" dataType="Text" parameterSource="CCGetUserLogin()"/>
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
				<SQLParameter id="131" variable="p_account_status_id" parameterType="Control" dataType="Float" parameterSource="p_account_status_id" defaultValue="0"/>
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
		<CodeFile id="Events" language="PHPTemplates" name="p_account_status_events.php" forShow="False" comment="//" codePage="windows-1252"/>
		<CodeFile id="Code" language="PHPTemplates" name="p_account_status.php" forShow="True" url="p_account_status.php" comment="//" codePage="windows-1252"/>
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
