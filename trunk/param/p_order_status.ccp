<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\param" secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="CoffeeBreak" wizardThemeVersion="3.0" needGeneration="0">
	<Components>
		<Grid id="2" secured="False" sourceType="Table" returnValueType="Number" defaultPageSize="5" connection="ConnSIKP" name="p_order_statusGrid" pageSizeLimit="100" wizardCaption="List of P App Role " wizardGridType="Tabular" wizardAllowInsert="True" wizardAltRecord="True" wizardAltRecordType="Style" wizardRecordSeparator="False" wizardNoRecords="-" pasteAsReplace="pasteAsReplace" pasteActions="pasteActions" activeCollection="TableParameters" dataSource="p_order_status">
			<Components>
				<Link id="7" visible="Yes" fieldSourceType="DBColumn" dataType="Text" html="False" hrefType="Page" urlType="Relative" preserveParameters="GET" name="Insert_Link" hrefSource="p_order_status.ccp" removeParameters="p_order_status_id;s_keyword" wizardThemeItem="FooterA" wizardDefaultValue="Add New" wizardUseTemplateBlock="False" PathID="p_order_statusGridInsert_Link">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="67" sourceType="Expression" name="FLAG" source="&quot;ADD&quot;"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
				<Link id="11" visible="Yes" fieldSourceType="CodeExpression" html="True" hrefType="Page" urlType="Relative" preserveParameters="GET" name="DLink" wizardCaption="Detail" wizardSize="50" wizardMaxLength="60" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" dataType="Text" wizardDefaultValue="DLink" hrefSource="p_order_status.ccp" wizardThemeItem="GridA" PathID="p_order_statusGridDLink" removeParameters="FLAG">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="12" sourceType="DataField" format="yyyy-mm-dd" name="p_order_status_id" source="p_order_status_id"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
				<Label id="15" fieldSourceType="DBColumn" dataType="Text" html="False" name="code" fieldSource="code" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="p_order_statusGridcode">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="17" fieldSourceType="DBColumn" dataType="Text" html="False" name="description" fieldSource="description" wizardCaption="Description" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="p_order_statusGriddescription">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="19" fieldSourceType="DBColumn" dataType="Text" html="False" name="updated_by" fieldSource="updated_by" wizardCaption="Valid From" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="p_order_statusGridupdated_by">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="21" fieldSourceType="DBColumn" dataType="Text" html="False" name="updated_date" fieldSource="updated_date" wizardCaption="Valid To" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="p_order_statusGridupdated_date">
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
				<Hidden id="13" fieldSourceType="DBColumn" dataType="Float" html="False" name="p_order_status_id" fieldSource="p_order_status_id" wizardCaption="Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="p_order_statusGridp_order_status_id">
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
						<Action actionName="Custom Code" actionCategory="General" id="124"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
				<TableParameter id="8" conditionType="Parameter" useIsNull="False" field="upper(code)" dataType="Text" logicOperator="Or" searchConditionType="Contains" parameterType="URL" orderNumber="1" leftBrackets="1" parameterSource="s_keyword"/>
				<TableParameter id="9" conditionType="Parameter" useIsNull="False" field="upper(description)" dataType="Text" logicOperator="Or" searchConditionType="Contains" parameterType="URL" orderNumber="2" rightBrackets="1" parameterSource="s_keyword"/>
			</TableParameters>
			<JoinTables>
				<JoinTable id="109" tableName="p_order_status" schemaName="sikp" posLeft="10" posTop="10" posWidth="138" posHeight="168"/>
			</JoinTables>
			<JoinLinks/>
			<Fields>
				<Field id="18" fieldName="updated_by" isExpression="False" tableName="p_order_status"/>
				<Field id="20" fieldName="to_char(updated_date,'DD-MON-YYYY')" alias="updated_date" isExpression="True"/>
				<Field id="110" tableName="p_order_status" fieldName="p_order_status_id"/>
				<Field id="111" tableName="p_order_status" fieldName="code"/>
				<Field id="112" tableName="p_order_status" fieldName="description"/>
			</Fields>
			<SPParameters/>
			<SQLParameters/>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Grid>
		<Record id="3" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="None" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="p_order_statusSearch" wizardCaption="Search P App Role " wizardOrientation="Vertical" wizardFormMethod="post" returnPage="p_order_status.ccp" PathID="p_order_statusSearch">
			<Components>
				<Button id="4" urlType="Relative" enableValidation="True" isDefault="False" name="Button_DoSearch" operation="Search" wizardCaption="Search" PathID="p_order_statusSearchButton_DoSearch">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<TextBox id="5" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="s_keyword" wizardCaption="Keyword" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" PathID="p_order_statusSearchs_keyword">
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
		<Record id="23" sourceType="Table" urlType="Relative" secured="False" allowInsert="True" allowUpdate="True" allowDelete="True" validateData="True" preserveParameters="GET" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" connection="ConnSIKP" name="p_order_statusForm" errorSummator="Error" wizardCaption="Add/Edit P App Role " wizardFormMethod="post" PathID="p_order_statusForm" customDeleteType="SQL" activeCollection="ISQLParameters" customUpdateType="SQL" parameterTypeListName="ParameterTypeList" pasteAsReplace="pasteAsReplace" pasteActions="pasteActions" customInsert="INSERT INTO p_order_status(p_order_status_id, code, description, creation_date, created_by, updated_date, updated_by) 
VALUES(generate_id('sikp','p_order_status','p_order_status_id'), '{code}', '{description}', sysdate, '{created_by}', sysdate, '{updated_by}')" customInsertType="SQL" dataSource="p_order_status" customUpdate="UPDATE p_order_status SET 
code='{code}', 
description='{description}', 
updated_date=sysdate, 
updated_by='{updated_by}'
WHERE p_order_status_id = {p_order_status_id}" customDelete="DELETE FROM p_order_status 
WHERE p_order_status_id = {p_order_status_id}">
			<Components>
				<Button id="24" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Insert" operation="Insert" wizardCaption="Add" PathID="p_order_statusFormButton_Insert" removeParameters="FLAG">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="25" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Update" operation="Update" wizardCaption="Submit" PathID="p_order_statusFormButton_Update" removeParameters="FLAG">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="26" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Delete" operation="Delete" wizardCaption="Delete" PathID="p_order_statusFormButton_Delete" removeParameters="FLAG;p_order_status_id;p_order_statusGridPage;s_keyword">
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
				<Button id="28" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Cancel" operation="Cancel" wizardCaption="Cancel" PathID="p_order_statusFormButton_Cancel" removeParameters="FLAG;p_order_status_id;p_order_statusGridPage;s_keyword">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Hidden id="30" fieldSourceType="DBColumn" dataType="Float" name="p_order_status_id" fieldSource="p_order_status_id" required="False" caption="Id" wizardCaption="Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_order_statusFormp_order_status_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<TextBox id="31" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="code" fieldSource="code" required="True" caption="Role" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_order_statusFormcode">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="37" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="description" fieldSource="description" required="False" caption="Description" wizardCaption="Description" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_order_statusFormdescription">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="38" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="creation_date" fieldSource="creation_date" required="False" caption="Creation Date" wizardCaption="Creation Date" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_order_statusFormcreation_date" format="dd-mmm-yyyy" defaultValue="date(&quot;d-M-Y&quot;)">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="40" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="created_by" fieldSource="created_by" required="False" caption="Created By" wizardCaption="Created By" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_order_statusFormcreated_by" defaultValue="CCGetUserLogin()">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="41" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="updated_date" fieldSource="updated_date" required="False" caption="Updated Date" wizardCaption="Updated Date" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_order_statusFormupdated_date" format="dd-mmm-yyyy" defaultValue="date(&quot;d-M-Y&quot;)">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="43" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="updated_by" fieldSource="updated_by" required="False" caption="Updated By" wizardCaption="Updated By" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_order_statusFormupdated_by" defaultValue="CCGetUserLogin()">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Hidden id="120" fieldSourceType="DBColumn" dataType="Text" name="p_order_statusGridForm" PathID="p_order_statusFormp_order_statusGridForm">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
			</Components>
			<Events>
			</Events>
			<TableParameters>
				<TableParameter id="119" conditionType="Parameter" useIsNull="False" field="p_order_status_id" dataType="Float" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="p_order_status_id"/>
			</TableParameters>
			<SPParameters/>
			<SQLParameters/>
			<JoinTables>
				<JoinTable id="113" tableName="p_order_status" schemaName="sikp" posLeft="10" posTop="10" posWidth="138" posHeight="168"/>
			</JoinTables>
			<JoinLinks/>
			<Fields>
				<Field id="104" fieldName="to_char(creation_date,'DD-MON-YYYY')" isExpression="True" alias="creation_date"/>
				<Field id="106" fieldName="to_char(updated_date,'DD-MON-YYYY')" alias="updated_date" isExpression="True"/>
				<Field id="114" tableName="p_order_status" fieldName="p_order_status_id"/>
				<Field id="115" tableName="p_order_status" fieldName="code"/>
				<Field id="116" tableName="p_order_status" fieldName="description"/>
				<Field id="117" tableName="p_order_status" fieldName="created_by"/>
				<Field id="118" tableName="p_order_status" fieldName="updated_by"/>
			</Fields>
			<ISPParameters/>
			<ISQLParameters>
				<SQLParameter id="82" variable="code" dataType="Text" parameterType="Control" parameterSource="code"/>
				<SQLParameter id="85" variable="description" dataType="Text" parameterType="Control" parameterSource="description"/>
				<SQLParameter id="87" variable="created_by" dataType="Text" parameterType="Expression" parameterSource="CCGetUserLogin()"/>
				<SQLParameter id="89" variable="updated_by" dataType="Text" parameterType="Expression" parameterSource="CCGetUserLogin()"/>
				<SQLParameter id="123" variable="p_order_status_id" parameterType="Control" defaultValue="0" dataType="Float" parameterSource="p_order_status_id"/>
			</ISQLParameters>
			<IFormElements>
				<CustomParameter id="125" field="p_order_status_id" dataType="Float" parameterType="Control" parameterSource="p_order_status_id"/>
<CustomParameter id="126" field="code" dataType="Text" parameterType="Control" parameterSource="code"/>
<CustomParameter id="127" field="description" dataType="Text" parameterType="Control" parameterSource="description"/>
<CustomParameter id="128" field="to_char(creation_date,'DD-MON-YYYY')" dataType="Text" parameterType="Control" parameterSource="creation_date" format="dd-mmm-yyyy"/>
<CustomParameter id="129" field="created_by" dataType="Text" parameterType="Control" parameterSource="created_by"/>
<CustomParameter id="130" field="to_char(updated_date,'DD-MON-YYYY')" dataType="Text" parameterType="Control" parameterSource="updated_date" format="dd-mmm-yyyy"/>
<CustomParameter id="131" field="updated_by" dataType="Text" parameterType="Control" parameterSource="updated_by"/>
</IFormElements>
			<USPParameters/>
			<USQLParameters>
				<SQLParameter id="58" variable="code" dataType="Text" parameterType="Control" parameterSource="code"/>
				<SQLParameter id="62" variable="description" dataType="Text" parameterType="Control" parameterSource="description"/>
				<SQLParameter id="64" variable="updated_by" dataType="Text" parameterType="Control" parameterSource="updated_by"/>
				<SQLParameter id="65" variable="p_order_status_id" parameterType="Control" dataType="Float" parameterSource="p_order_status_id" defaultValue="0"/>
			</USQLParameters>
			<UConditions>
			</UConditions>
			<UFormElements>
				<CustomParameter id="132" field="p_order_status_id" dataType="Float" parameterType="Control" parameterSource="p_order_status_id"/>
<CustomParameter id="133" field="code" dataType="Text" parameterType="Control" parameterSource="code"/>
<CustomParameter id="134" field="description" dataType="Text" parameterType="Control" parameterSource="description"/>
<CustomParameter id="135" field="to_char(creation_date,'DD-MON-YYYY')" dataType="Text" parameterType="Control" parameterSource="creation_date" format="dd-mmm-yyyy"/>
<CustomParameter id="136" field="created_by" dataType="Text" parameterType="Control" parameterSource="created_by"/>
<CustomParameter id="137" field="to_char(updated_date,'DD-MON-YYYY')" dataType="Text" parameterType="Control" parameterSource="updated_date" format="dd-mmm-yyyy"/>
<CustomParameter id="138" field="updated_by" dataType="Text" parameterType="Control" parameterSource="updated_by"/>
</UFormElements>
			<DSPParameters/>
			<DSQLParameters>
				<SQLParameter id="108" variable="p_order_status_id" parameterType="Control" dataType="Float" parameterSource="p_order_status_id" defaultValue="0"/>
			</DSQLParameters>
			<DConditions>
			</DConditions>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Record>
	</Components>
	<CodeFiles>
		<CodeFile id="Events" language="PHPTemplates" name="p_order_status_events.php" forShow="False" comment="//" codePage="windows-1252"/>
		<CodeFile id="Code" language="PHPTemplates" name="p_order_status.php" forShow="True" url="p_order_status.php" comment="//" codePage="windows-1252"/>
	</CodeFiles>
	<SecurityGroups/>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events>
		<Event name="OnInitializeView" type="Server">
<Actions>
<Action actionName="Custom Code" actionCategory="General" id="139"/>
</Actions>
</Event>
</Events>
</Page>
