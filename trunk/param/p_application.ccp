<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\param" secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="RWNet" wizardThemeVersion="3.0" needGeneration="0" pasteActions="pasteActions">
	<Components>
		<Grid id="2" secured="False" sourceType="Table" returnValueType="Number" defaultPageSize="5" connection="ConnSIKP" name="p_applicationGrid" orderBy="p_application_id" pageSizeLimit="100" wizardCaption="List of P Module " wizardGridType="Tabular" wizardAllowInsert="True" wizardAltRecord="True" wizardAltRecordType="Style" wizardRecordSeparator="False" wizardNoRecords="-" pasteAsReplace="pasteAsReplace" pasteActions="pasteActions" activeCollection="TableParameters" dataSource="p_application">
			<Components>
				<Link id="11" visible="Yes" fieldSourceType="CodeExpression" html="True" hrefType="Page" urlType="Relative" preserveParameters="GET" name="DLink" wizardCaption="Detail" wizardSize="50" wizardMaxLength="60" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" dataType="Text" wizardDefaultValue="DLink" hrefSource="p_application.ccp" wizardThemeItem="GridA" PathID="p_applicationGridDLink" removeParameters="FLAG">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="93" sourceType="DataField" name="p_application_id" source="p_application_id"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
				<Label id="15" fieldSourceType="DBColumn" dataType="Text" html="False" name="code" fieldSource="code" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="p_applicationGridcode">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="17" fieldSourceType="DBColumn" dataType="Text" html="False" name="description" fieldSource="description" wizardCaption="Description" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="p_applicationGriddescription">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Navigator id="18" size="10" type="Centered" pageSizes="1;5;10;25;50" name="Navigator" wizardPagingType="Custom" wizardFirst="True" wizardFirstText="First" wizardPrev="True" wizardPrevText="Prev" wizardNext="True" wizardNextText="Next" wizardLast="True" wizardLastText="Last" wizardImages="Images" wizardPageNumbers="Centered" wizardSize="10" wizardTotalPages="False" wizardHideDisabled="False" wizardOfText="of" wizardPageSize="False" wizardImagesScheme="Rwnet">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Navigator>
				<Hidden id="13" fieldSourceType="DBColumn" dataType="Float" html="False" name="p_application_id" fieldSource="p_application_id" wizardCaption="Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="p_applicationGridp_application_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Label id="78" fieldSourceType="DBColumn" dataType="Text" html="False" name="listing_no" fieldSource="listing_no" wizardCaption="Description" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="p_applicationGridlisting_no">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<ImageLink id="133" visible="Yes" fieldSourceType="DBColumn" dataType="Text" hrefType="Page" urlType="Relative" preserveParameters="GET" name="ImageLink1" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="p_applicationGridImageLink1" hrefSource="f_app_menu.php">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="134" sourceType="DataField" format="yyyy-mm-dd" name="p_application_id" source="p_application_id"/>
						<LinkParameter id="136" sourceType="URL" name="p_applicationGridPage" source="p_applicationGridPage"/>
						<LinkParameter id="137" sourceType="URL" name="app_s_keyword" source="s_keyword"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</ImageLink>
				<Link id="7" visible="Yes" fieldSourceType="DBColumn" dataType="Text" html="False" hrefType="Page" urlType="Relative" preserveParameters="GET" name="Insert_Link" hrefSource="p_application.ccp" removeParameters="p_application_id;s_keyword" wizardThemeItem="FooterA" wizardDefaultValue="Add New" wizardUseTemplateBlock="False" PathID="p_applicationGridInsert_Link">
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
						<Action actionName="Set Row Style" actionCategory="General" id="10" styles="Row;AltRow" name="rowStyle"/>
					</Actions>
				</Event>
				<Event name="BeforeSelect" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="68"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
				<TableParameter id="8" conditionType="Parameter" useIsNull="False" field="upper(code)" dataType="Text" logicOperator="Or" searchConditionType="Contains" parameterType="URL" orderNumber="1" leftBrackets="1" parameterSource="s_keyword"/>
				<TableParameter id="9" conditionType="Parameter" useIsNull="False" field="upper(description)" dataType="Text" logicOperator="Or" searchConditionType="Contains" parameterType="URL" orderNumber="2" rightBrackets="1" parameterSource="s_keyword"/>
			</TableParameters>
			<JoinTables>
				<JoinTable id="83" tableName="p_application" schemaName="sikp" posLeft="10" posTop="10" posWidth="127" posHeight="180"/>
			</JoinTables>
			<JoinLinks/>
			<Fields>
				<Field id="85" tableName="p_application" fieldName="p_application_id"/>
				<Field id="86" tableName="p_application" fieldName="code"/>
				<Field id="87" tableName="p_application" fieldName="listing_no"/>
				<Field id="88" tableName="p_application" fieldName="description"/>
				<Field id="89" fieldName="to_char(creation_date,'DD-MON-YYYY')" isExpression="True" alias="creation_date"/>
				<Field id="90" fieldName="created_by" isExpression="False" tableName="p_application"/>
				<Field id="91" fieldName="to_char(updated_date,'DD-MON-YYYY')" isExpression="True" alias="updated_date"/>
				<Field id="92" tableName="p_application" fieldName="updated_by"/>
			</Fields>
			<SPParameters/>
			<SQLParameters/>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Grid>
		<Record id="19" sourceType="Table" urlType="Relative" secured="False" allowInsert="True" allowUpdate="True" allowDelete="True" validateData="True" preserveParameters="GET" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" connection="ConnSIKP" name="p_applicationForm" errorSummator="Error" wizardCaption="Add/Edit P Module " wizardFormMethod="post" PathID="p_applicationForm" pasteAsReplace="pasteAsReplace" pasteActions="pasteActions" customDelete="DELETE FROM p_application 
WHERE p_application_id = {p_application_id}" customDeleteType="SQL" activeCollection="DSQLParameters" activeTableType="customDelete" parameterTypeListName="ParameterTypeList" customUpdate="UPDATE p_application SET 
code='{code}', 
listing_no={listing_no}, 
description='{description}', 
updated_by='{updated_by}',  
updated_date=sysdate
WHERE p_application_id = {p_application_id}" customUpdateType="SQL" customInsert="INSERT INTO p_application(p_application_id, code, listing_no, description, created_by, updated_by, creation_date, updated_date) 
VALUES(generate_id('sikp','p_application','p_application_id'), '{code}', {listing_no}, '{description}', '{created_by}', '{updated_by}', sysdate, sysdate)" customInsertType="SQL" dataSource="p_application">
			<Components>
				<Hidden id="26" fieldSourceType="DBColumn" dataType="Float" name="p_application_id" fieldSource="p_application_id" required="False" caption="Id" wizardCaption="Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_applicationFormp_application_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<TextBox id="27" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="code" fieldSource="code" required="True" caption="Code" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_applicationFormcode">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="28" visible="Yes" fieldSourceType="DBColumn" dataType="Float" name="listing_no" fieldSource="listing_no" required="True" caption="Listing No" wizardCaption="Listing No" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_applicationFormlisting_no">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="29" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="description" fieldSource="description" required="False" caption="Description" wizardCaption="Description" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_applicationFormdescription">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="32" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="created_by" fieldSource="created_by" required="False" caption="Created By" wizardCaption="Created By" wizardSize="16" wizardMaxLength="16" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_applicationFormcreated_by" defaultValue="CCGetUserLogin()">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="35" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="updated_by" fieldSource="updated_by" required="False" caption="Updated By" wizardCaption="Updated By" wizardSize="16" wizardMaxLength="16" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_applicationFormupdated_by" defaultValue="CCGetUserLogin()">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="30" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="creation_date" fieldSource="creation_date" required="False" caption="Creation Date" wizardCaption="Creation Date" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_applicationFormcreation_date" format="dd-mmm-yyyy" defaultValue="date(&quot;d-M-Y&quot;)">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="33" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="updated_date" fieldSource="updated_date" required="False" caption="Updated Date" wizardCaption="Updated Date" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_applicationFormupdated_date" format="dd-mmm-yyyy" defaultValue="date(&quot;d-M-Y&quot;)">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Button id="79" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Cancel" operation="Cancel" wizardCaption="Cancel" PathID="p_applicationFormButton_Cancel" removeParameters="p_application_id;FLAG;p_applicationGridPage">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="80" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Delete" operation="Delete" wizardCaption="Delete" PathID="p_applicationFormButton_Delete" removeParameters="p_application_id;FLAG;p_applicationGridPage">
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
				<Button id="82" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Update" operation="Update" wizardCaption="Submit" PathID="p_applicationFormButton_Update" removeParameters="FLAG">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="24" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Insert" operation="Insert" wizardCaption="Add" PathID="p_applicationFormButton_Insert" removeParameters="FLAG">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Hidden id="135" fieldSourceType="DBColumn" dataType="Text" name="p_applicationGridPage" wizardCaption="Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_applicationFormp_applicationGridPage">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
			</Components>
			<Events/>
			<TableParameters>
				<TableParameter id="25" conditionType="Parameter" useIsNull="False" field="p_application_id" dataType="Float" logicOperator="And" searchConditionType="Equal" parameterType="URL" orderNumber="1" parameterSource="p_application_id"/>
			</TableParameters>
			<SPParameters/>
			<SQLParameters/>
			<JoinTables>
				<JoinTable id="84" tableName="p_application" schemaName="sikp" posLeft="10" posTop="10" posWidth="127" posHeight="180"/>
			</JoinTables>
			<JoinLinks/>
			<Fields>
				<Field id="125" tableName="p_application" fieldName="p_application_id"/>
				<Field id="126" tableName="p_application" fieldName="code"/>
				<Field id="127" tableName="p_application" fieldName="listing_no"/>
				<Field id="128" tableName="p_application" fieldName="description"/>
				<Field id="129" fieldName="to_char(creation_date,'DD-MON-YYYY')" isExpression="True" alias="creation_date"/>
				<Field id="130" tableName="p_application" fieldName="created_by"/>
				<Field id="131" fieldName="to_char(updated_date,'DD-MON-YYYY')" alias="updated_date" isExpression="True"/>
				<Field id="132" tableName="p_application" fieldName="updated_by"/>
			</Fields>
			<ISPParameters/>
			<ISQLParameters>
				<SQLParameter id="104" variable="code" dataType="Text" parameterType="Control" parameterSource="code"/>
				<SQLParameter id="105" variable="listing_no" dataType="Float" parameterType="Control" parameterSource="listing_no"/>
				<SQLParameter id="106" variable="description" dataType="Text" parameterType="Control" parameterSource="description"/>
				<SQLParameter id="107" variable="created_by" dataType="Text" parameterType="Expression" parameterSource="CCGetUserLogin()"/>
				<SQLParameter id="108" variable="updated_by" dataType="Text" parameterType="Expression" parameterSource="CCGetUserLogin()"/>
			</ISQLParameters>
			<IFormElements>
				<CustomParameter id="95" field="p_application_id" dataType="Float" parameterType="Control" parameterSource="p_application_id"/>
				<CustomParameter id="96" field="code" dataType="Text" parameterType="Control" parameterSource="code"/>
				<CustomParameter id="97" field="listing_no" dataType="Float" parameterType="Control" parameterSource="listing_no"/>
				<CustomParameter id="98" field="description" dataType="Text" parameterType="Control" parameterSource="description"/>
				<CustomParameter id="99" field="created_by" dataType="Text" parameterType="Control" parameterSource="created_by"/>
				<CustomParameter id="100" field="updated_by" dataType="Text" parameterType="Control" parameterSource="updated_by"/>
				<CustomParameter id="101" field="creation_date" dataType="Text" parameterType="Control" parameterSource="creation_date" format="dd-mmm-yyyy"/>
				<CustomParameter id="102" field="updated_date" dataType="Text" parameterType="Control" parameterSource="updated_date" format="dd-mmm-yyyy"/>
			</IFormElements>
			<USPParameters/>
			<USQLParameters>
				<SQLParameter id="118" variable="p_application_id" dataType="Float" parameterType="Control" parameterSource="p_application_id" defaultValue="0"/>
				<SQLParameter id="119" variable="code" dataType="Text" parameterType="Control" parameterSource="code"/>
				<SQLParameter id="120" variable="listing_no" dataType="Float" parameterType="Control" parameterSource="listing_no"/>
				<SQLParameter id="121" variable="description" dataType="Text" parameterType="Control" parameterSource="description"/>
				<SQLParameter id="123" variable="updated_by" dataType="Text" parameterType="Expression" parameterSource="CCGetUserLogin()"/>
			</USQLParameters>
			<UConditions>
				<TableParameter id="117" conditionType="Parameter" useIsNull="False" field="p_application_id" dataType="Float" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="p_application_id"/>
			</UConditions>
			<UFormElements>
				<CustomParameter id="109" field="p_application_id" dataType="Float" parameterType="Control" parameterSource="p_application_id"/>
				<CustomParameter id="110" field="code" dataType="Text" parameterType="Control" parameterSource="code"/>
				<CustomParameter id="111" field="listing_no" dataType="Float" parameterType="Control" parameterSource="listing_no"/>
				<CustomParameter id="112" field="description" dataType="Text" parameterType="Control" parameterSource="description"/>
				<CustomParameter id="113" field="created_by" dataType="Text" parameterType="Control" parameterSource="created_by"/>
				<CustomParameter id="114" field="updated_by" dataType="Text" parameterType="Control" parameterSource="updated_by"/>
				<CustomParameter id="115" field="creation_date" dataType="Text" parameterType="Control" parameterSource="creation_date" format="dd-mmm-yyyy"/>
				<CustomParameter id="116" field="updated_date" dataType="Text" parameterType="Control" parameterSource="updated_date" format="dd-mmm-yyyy"/>
			</UFormElements>
			<DSPParameters/>
			<DSQLParameters>
				<SQLParameter id="138" variable="p_application_id" parameterType="Control" dataType="Float" parameterSource="p_application_id" defaultValue="0"/>
			</DSQLParameters>
			<DConditions>
				<TableParameter id="124" conditionType="Parameter" useIsNull="False" field="p_application_id" dataType="Float" searchConditionType="Equal" parameterType="Control" logicOperator="And" parameterSource="p_application_id"/>
			</DConditions>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Record>
		<Record id="3" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="None" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="p_applicationSearch" wizardCaption="Search P App Role " wizardOrientation="Vertical" wizardFormMethod="post" returnPage="p_application.ccp" PathID="p_applicationSearch">
			<Components>
				<Button id="4" urlType="Relative" enableValidation="True" isDefault="False" name="Button_DoSearch" operation="Search" wizardCaption="Search" PathID="p_applicationSearchButton_DoSearch">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<TextBox id="5" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="s_keyword" wizardCaption="Keyword" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" PathID="p_applicationSearchs_keyword">
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
		<CodeFile id="Events" language="PHPTemplates" name="p_application_events.php" forShow="False" comment="//" codePage="windows-1252"/>
		<CodeFile id="Code" language="PHPTemplates" name="p_application.php" forShow="True" url="p_application.php" comment="//" codePage="windows-1252"/>
	</CodeFiles>
	<SecurityGroups/>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events>
		<Event name="OnInitializeView" type="Server">
			<Actions>
				<Action actionName="Custom Code" actionCategory="General" id="36"/>
			</Actions>
		</Event>
	</Events>
</Page>
