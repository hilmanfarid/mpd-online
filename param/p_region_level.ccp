<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\param" secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="RWNet" wizardThemeVersion="3.0" needGeneration="0" pasteActions="pasteActions">
	<Components>
		<Grid id="2" secured="False" sourceType="Table" returnValueType="Number" defaultPageSize="5" connection="ConnSIKP" name="p_region_levelGrid" orderBy="p_region_level_id" pageSizeLimit="100" wizardCaption="List of P Module " wizardGridType="Tabular" wizardAllowInsert="True" wizardAltRecord="True" wizardAltRecordType="Style" wizardRecordSeparator="False" wizardNoRecords="-" pasteAsReplace="pasteAsReplace" pasteActions="pasteActions" activeCollection="TableParameters" dataSource="p_region_level">
			<Components>
				<Link id="11" visible="Yes" fieldSourceType="CodeExpression" html="True" hrefType="Page" urlType="Relative" preserveParameters="GET" name="DLink" wizardCaption="Detail" wizardSize="50" wizardMaxLength="60" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" dataType="Text" wizardDefaultValue="DLink" hrefSource="p_region_level.ccp" wizardThemeItem="GridA" PathID="p_region_levelGridDLink" removeParameters="FLAG">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="152" sourceType="DataField" name="p_region_level_id" source="p_region_level_id"/>
</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
				<Label id="15" fieldSourceType="DBColumn" dataType="Text" html="False" name="level_name" fieldSource="level_name" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="p_region_levelGridlevel_name">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="17" fieldSourceType="DBColumn" dataType="Text" html="False" name="description" fieldSource="description" wizardCaption="Description" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="p_region_levelGriddescription">
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
				<Hidden id="13" fieldSourceType="DBColumn" dataType="Float" html="False" name="p_region_level_id" fieldSource="p_region_level_id" wizardCaption="Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="p_region_levelGridp_region_level_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Label id="78" fieldSourceType="DBColumn" dataType="Text" html="False" name="level_number" fieldSource="level_number" wizardCaption="Description" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="p_region_levelGridlevel_number">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Link id="7" visible="Yes" fieldSourceType="DBColumn" dataType="Text" html="False" hrefType="Page" urlType="Relative" preserveParameters="GET" name="Insert_Link" hrefSource="p_region_level.ccp" removeParameters="p_region_level_id;s_keyword" wizardThemeItem="FooterA" wizardDefaultValue="Add New" wizardUseTemplateBlock="False" PathID="p_region_levelGridInsert_Link">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="94" sourceType="Expression" name="FLAG" source="&quot;ADD&quot;"/>
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
				<TableParameter id="8" conditionType="Parameter" useIsNull="False" field="upper(level_name)" dataType="Text" logicOperator="Or" searchConditionType="Contains" parameterType="URL" orderNumber="1" leftBrackets="1" parameterSource="s_keyword"/>
				<TableParameter id="9" conditionType="Parameter" useIsNull="False" field="upper(description)" dataType="Text" logicOperator="Or" searchConditionType="Contains" parameterType="URL" orderNumber="2" rightBrackets="1" parameterSource="s_keyword"/>
			</TableParameters>
			<JoinTables>
				<JoinTable id="140" tableName="p_region_level" posLeft="10" posTop="10" posWidth="137" posHeight="152"/>
</JoinTables>
			<JoinLinks/>
			<Fields>
				<Field id="139" fieldName="*"/>
</Fields>
			<SPParameters/>
			<SQLParameters/>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Grid>
		<Record id="19" sourceType="SQL" urlType="Relative" secured="False" allowInsert="True" allowUpdate="True" allowDelete="True" validateData="True" preserveParameters="GET" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" connection="ConnSIKP" name="p_region_levelForm" errorSummator="Error" wizardCaption="Add/Edit P Module " wizardFormMethod="post" PathID="p_region_levelForm" pasteAsReplace="pasteAsReplace" pasteActions="pasteActions" customDelete="DELETE FROM p_region_level 
WHERE  p_region_level_id = {p_region_level_id}" customDeleteType="SQL" activeCollection="DSQLParameters" parameterTypeListName="ParameterTypeList" customUpdate="UPDATE p_region_level SET 
level_name='{level_name}', 
level_number={level_number}, 
description='{description}', 
updated_by='{updated_by}', 
updated_date=sysdate
WHERE p_region_level_id={p_region_level_id}" customUpdateType="SQL" customInsert="INSERT INTO p_region_level(p_region_level_id, level_name, level_number, description, updated_by, updated_date) 
VALUES(generate_id('sikp','p_region_level','p_region_level_id'), '{level_name}', {level_number}, '{description}', '{updated_by}', sysdate)" customInsertType="SQL" dataSource="SELECT p_region_level_id, level_name, level_number, 
description, updated_by, to_char(updated_date,'DD-MON-YYYY') AS updated_date 
FROM p_region_level
WHERE p_region_level_id = {p_region_level_id} " activeTableType="customDelete">
			<Components>
				<Hidden id="26" fieldSourceType="DBColumn" dataType="Float" name="p_region_level_id" fieldSource="p_region_level_id" required="False" caption="Id" wizardCaption="Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_region_levelFormp_region_level_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<TextBox id="27" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="level_name" fieldSource="level_name" required="True" caption="Level Regional" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_region_levelFormlevel_name">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="28" visible="Yes" fieldSourceType="DBColumn" dataType="Float" name="level_number" fieldSource="level_number" required="True" caption="No. Level" wizardCaption="Listing No" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_region_levelFormlevel_number">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="29" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="description" fieldSource="description" required="False" caption="Description" wizardCaption="Description" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_region_levelFormdescription">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="35" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="updated_by" fieldSource="updated_by" required="False" caption="Updated By" wizardCaption="Updated By" wizardSize="16" wizardMaxLength="16" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_region_levelFormupdated_by" defaultValue="CCGetUserLogin()">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="33" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="updated_date" fieldSource="updated_date" required="False" caption="Updated Date" wizardCaption="Updated Date" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_region_levelFormupdated_date" format="dd-mmm-yyyy" defaultValue="date(&quot;d-M-Y&quot;)">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Button id="79" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Cancel" operation="Cancel" wizardCaption="Cancel" PathID="p_region_levelFormButton_Cancel" removeParameters="p_region_level_id;FLAG;p_region_levelGridPage">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="80" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Delete" operation="Delete" wizardCaption="Delete" PathID="p_region_levelFormButton_Delete" removeParameters="p_region_level_id;FLAG;p_region_levelGridPage">
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
				<Button id="82" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Update" operation="Update" wizardCaption="Submit" PathID="p_region_levelFormButton_Update" removeParameters="FLAG">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="24" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Insert" operation="Insert" wizardCaption="Add" PathID="p_region_levelFormButton_Insert" removeParameters="FLAG">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Hidden id="135" fieldSourceType="DBColumn" dataType="Text" name="p_region_levelGridPage" wizardCaption="Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_region_levelFormp_region_levelGridPage">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
			</Components>
			<Events/>
			<TableParameters>
				<TableParameter id="143" conditionType="Parameter" useIsNull="False" field="p_region_level_id" dataType="Float" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="p_region_level_id"/>
</TableParameters>
			<SPParameters/>
			<SQLParameters>
<SQLParameter id="151" parameterType="URL" variable="p_region_level_id" dataType="Float" parameterSource="p_region_level_id"/>
</SQLParameters>
			<JoinTables>
				<JoinTable id="142" tableName="p_region_level" posLeft="10" posTop="10" posWidth="137" posHeight="152"/>
</JoinTables>
			<JoinLinks/>
			<Fields>
				<Field id="144" tableName="p_region_level" fieldName="p_region_level_id"/>
<Field id="145" tableName="p_region_level" fieldName="level_name"/>
<Field id="146" tableName="p_region_level" fieldName="level_number"/>
<Field id="147" tableName="p_region_level" fieldName="description"/>
<Field id="149" tableName="p_region_level" fieldName="updated_by" isExpression="False"/>
<Field id="150" tableName="p_region_level" fieldName="updated_date" alias="updated_date"/>
</Fields>
			<ISPParameters/>
			<ISQLParameters>
				<SQLParameter id="162" variable="level_name" dataType="Text" parameterType="Control" parameterSource="level_name"/>
<SQLParameter id="163" variable="level_number" dataType="Float" parameterType="Control" parameterSource="level_number"/>
<SQLParameter id="164" variable="description" dataType="Text" parameterType="Control" parameterSource="description"/>
<SQLParameter id="166" variable="updated_by" dataType="Text" parameterType="Expression" parameterSource="CCGetUserLogin()"/>
</ISQLParameters>
			<IFormElements>
				<CustomParameter id="153" field="p_region_level_id" dataType="Float" parameterType="Control" parameterSource="p_region_level_id"/>
<CustomParameter id="154" field="level_name" dataType="Text" parameterType="Control" parameterSource="level_name"/>
<CustomParameter id="155" field="level_number" dataType="Float" parameterType="Control" parameterSource="level_number"/>
<CustomParameter id="156" field="description" dataType="Text" parameterType="Control" parameterSource="description"/>
<CustomParameter id="157" field="created_by" dataType="Text" parameterType="Control" parameterSource="created_by"/>
<CustomParameter id="158" field="updated_by" dataType="Text" parameterType="Control" parameterSource="updated_by"/>
<CustomParameter id="159" field="creation_date" dataType="Text" parameterType="Control" parameterSource="creation_date" format="dd-mmm-yyyy"/>
<CustomParameter id="160" field="updated_date" dataType="Text" parameterType="Control" parameterSource="updated_date" format="dd-mmm-yyyy"/>
</IFormElements>
			<USPParameters/>
			<USQLParameters>
				<SQLParameter id="175" variable="p_region_level_id" dataType="Float" parameterType="Control" parameterSource="p_region_level_id"/>
<SQLParameter id="176" variable="level_name" dataType="Text" parameterType="Control" parameterSource="level_name"/>
<SQLParameter id="177" variable="level_number" dataType="Float" parameterType="Control" parameterSource="level_number"/>
<SQLParameter id="178" variable="description" dataType="Text" parameterType="Control" parameterSource="description"/>
<SQLParameter id="179" variable="updated_by" dataType="Text" parameterType="Expression" parameterSource="CCGetUserLogin()"/>
</USQLParameters>
			<UConditions>
			</UConditions>
			<UFormElements>
				<CustomParameter id="167" field="p_region_level_id" dataType="Float" parameterType="Control" parameterSource="p_region_level_id"/>
<CustomParameter id="168" field="level_name" dataType="Text" parameterType="Control" parameterSource="level_name"/>
<CustomParameter id="169" field="level_number" dataType="Float" parameterType="Control" parameterSource="level_number"/>
<CustomParameter id="170" field="description" dataType="Text" parameterType="Control" parameterSource="description"/>
<CustomParameter id="172" field="updated_by" dataType="Text" parameterType="Control" parameterSource="updated_by"/>
<CustomParameter id="174" field="updated_date" dataType="Text" parameterType="Control" parameterSource="updated_date" format="dd-mmm-yyyy"/>
</UFormElements>
			<DSPParameters/>
			<DSQLParameters>
				<SQLParameter id="181" variable="p_region_level_id" parameterType="Control" dataType="Float" parameterSource="p_region_level_id" defaultValue="0"/>
</DSQLParameters>
			<DConditions>
				<TableParameter id="180" conditionType="Parameter" useIsNull="False" field="p_region_level_id" dataType="Float" searchConditionType="Equal" parameterType="Control" logicOperator="And" parameterSource="p_region_level_id"/>
</DConditions>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Record>
		<Record id="3" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="None" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="p_region_levelSearch" wizardCaption="Search P App Role " wizardOrientation="Vertical" wizardFormMethod="post" returnPage="p_region_level.ccp" PathID="p_region_levelSearch">
			<Components>
				<Button id="4" urlType="Relative" enableValidation="True" isDefault="False" name="Button_DoSearch" operation="Search" wizardCaption="Search" PathID="p_region_levelSearchButton_DoSearch">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<TextBox id="5" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="s_keyword" wizardCaption="Keyword" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" PathID="p_region_levelSearchs_keyword">
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
		<CodeFile id="Events" language="PHPTemplates" name="p_region_level_events.php" forShow="False" comment="//" codePage="windows-1252"/>
		<CodeFile id="Code" language="PHPTemplates" name="p_region_level.php" forShow="True" url="p_region_level.php" comment="//" codePage="windows-1252"/>
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
