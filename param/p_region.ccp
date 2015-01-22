<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\param" secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="Spring" wizardThemeVersion="3.0" needGeneration="0" pasteActions="pasteActions">
	<Components>
		<Grid id="2" secured="False" sourceType="Table" returnValueType="Number" defaultPageSize="5" connection="ConnSIKP" name="p_regionGrid" pageSizeLimit="100" wizardCaption="List of P App Module Role " wizardGridType="Tabular" wizardSortingType="SimpleDir" wizardAllowInsert="True" wizardAltRecord="False" wizardAltRecordType="Style" wizardRecordSeparator="False" wizardNoRecords="data tidak ditemukan" activeCollection="TableParameters" pasteActions="pasteActions" parameterTypeListName="ParameterTypeList" dataSource="p_region" orderBy="p_region_id">
			<Components>
				<Label id="32" fieldSourceType="DBColumn" dataType="Text" html="False" name="description" fieldSource="description" wizardCaption="Description" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="p_regionGriddescription">
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
				<Label id="86" fieldSourceType="DBColumn" dataType="Text" html="False" name="region_name" fieldSource="region_name" wizardCaption="Description" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="p_regionGridregion_name">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Link id="11" visible="Yes" fieldSourceType="CodeExpression" html="True" hrefType="Page" urlType="Relative" preserveParameters="GET" name="DLink" wizardCaption="Detail" wizardSize="50" wizardMaxLength="60" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" dataType="Text" wizardDefaultValue="DLink" hrefSource="p_region.ccp" wizardThemeItem="GridA" PathID="p_regionGridDLink" removeParameters="FLAG">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="193" sourceType="DataField" name="p_region_id" source="p_region_id"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
				<Link id="7" visible="Yes" fieldSourceType="DBColumn" dataType="Text" html="False" hrefType="Page" urlType="Relative" preserveParameters="GET" name="Insert_Link" hrefSource="p_region.ccp" removeParameters="p_region_id;s_keyword" wizardThemeItem="FooterA" wizardDefaultValue="Add New" wizardUseTemplateBlock="False" PathID="p_regionGridInsert_Link">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="123" sourceType="Expression" name="FLAG" source="&quot;ADD&quot;"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
				<Hidden id="184" fieldSourceType="DBColumn" dataType="Float" name="p_region_id" fieldSource="p_region_id" required="False" caption="Id" wizardCaption="Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_regionGridp_region_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Label id="246" fieldSourceType="DBColumn" dataType="Text" html="False" name="region_code" fieldSource="region_code" wizardCaption="Description" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="p_regionGridregion_code">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="250" fieldSourceType="DBColumn" dataType="Text" html="False" name="business_area" PathID="p_regionGridbusiness_area" fieldSource="business_area">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="255" fieldSourceType="DBColumn" dataType="Text" html="False" name="postal_code" PathID="p_regionGridpostal_code" fieldSource="postal_code">
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
				<TableParameter id="191" conditionType="Parameter" useIsNull="False" field="upper(region_name)" dataType="Text" searchConditionType="Contains" parameterType="URL" logicOperator="Or" parameterSource="s_keyword" leftBrackets="1"/>
				<TableParameter id="192" conditionType="Parameter" useIsNull="False" field="upper(description)" dataType="Text" searchConditionType="Contains" parameterType="URL" logicOperator="And" parameterSource="s_keyword" rightBrackets="1"/>
				<TableParameter id="243" conditionType="Parameter" useIsNull="False" field="nvl(parent_id,0)" dataType="Float" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="parent_id"/>
			</TableParameters>
			<JoinTables>
				<JoinTable id="190" tableName="p_region" posLeft="10" posTop="10" posWidth="153" posHeight="180"/>
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
		<Record id="3" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="None" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="p_regionSearch" wizardCaption="Search P App Module Role " wizardOrientation="Vertical" wizardFormMethod="post" returnPage="p_region.ccp" PathID="p_regionSearch" pasteActions="pasteActions">
			<Components>
				<TextBox id="5" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="s_keyword" wizardCaption="Keyword" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" PathID="p_regionSearchs_keyword">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Button id="4" urlType="Relative" enableValidation="True" isDefault="False" name="Button_DoSearch" operation="Search" wizardCaption="Search" PathID="p_regionSearchButton_DoSearch">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Hidden id="245" fieldSourceType="DBColumn" dataType="Float" name="parent_id" wizardCaption="P App Role Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_regionSearchparent_id">
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
		<Record id="23" sourceType="Table" urlType="Relative" secured="False" allowInsert="True" allowUpdate="True" allowDelete="True" validateData="True" preserveParameters="GET" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" connection="ConnSIKP" name="p_regionForm" errorSummator="Error" wizardCaption="Add/Edit P App Role " wizardFormMethod="post" PathID="p_regionForm" customDeleteType="SQL" customDelete="DELETE FROM p_region 
WHERE  p_region_id = {p_region_id}" activeCollection="USQLParameters" customUpdateType="SQL" parameterTypeListName="ParameterTypeList" pasteAsReplace="pasteAsReplace" pasteActions="pasteActions" customInsert="INSERT INTO p_region(p_region_id, p_business_area_id, region_name, description, updated_date, updated_by, p_region_level_id, parent_id, region_code, postal_code,national_code) 
VALUES(generate_id('sikp','p_region','p_region_id'), {p_business_area_id}, '{region_name}', '{description}', sysdate, '{updated_by}', '{p_region_level_id}', decode({parent_id},0,null,{parent_id}), '{region_code}', '{postal_code}','{nasional_code}')" customInsertType="SQL" dataSource="p_region" customUpdate="UPDATE p_region SET 
region_code='{region_code}',
region_name='{region_name}', 
p_region_level_id={p_region_level_id},
description='{description}', 
updated_date=sysdate, 
updated_by='{updated_by}',
p_business_area_id = {p_business_area_id},
postal_code='{postal_code}',
nasional_code='{nasional_code}'
WHERE p_region_id={p_region_id}">
			<Components>
				<Button id="24" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Insert" operation="Insert" wizardCaption="Add" PathID="p_regionFormButton_Insert" removeParameters="FLAG">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="25" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Update" operation="Update" wizardCaption="Submit" PathID="p_regionFormButton_Update" removeParameters="FLAG">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="26" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Delete" operation="Delete" wizardCaption="Delete" PathID="p_regionFormButton_Delete" removeParameters="p_region_id;s_keyword;FLAG;p_regionGridPage">
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
				<Button id="124" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Cancel" operation="Cancel" wizardCaption="Cancel" PathID="p_regionFormButton_Cancel" removeParameters="p_region_id;s_keyword;FLAG;p_regionGridPage">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Hidden id="125" fieldSourceType="DBColumn" dataType="Float" name="p_region_id" fieldSource="p_region_id" required="False" caption="Id" wizardCaption="Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_regionFormp_region_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<TextBox id="31" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="region_name" fieldSource="region_name" required="True" caption="Regional" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_regionFormregion_name">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="37" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="description" fieldSource="description" required="False" caption="Description" wizardCaption="Description" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_regionFormdescription">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="126" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="updated_date" fieldSource="updated_date" required="False" caption="Updated Date" wizardCaption="Updated Date" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_regionFormupdated_date" format="dd-mmm-yyyy" defaultValue="date(&quot;d-M-Y&quot;)">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="127" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="updated_by" fieldSource="updated_by" required="False" caption="Updated By" wizardCaption="Updated By" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_regionFormupdated_by" defaultValue="CCGetUserLogin()">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Hidden id="185" fieldSourceType="DBColumn" dataType="Float" name="parent_id" fieldSource="parent_id" required="True" caption="Role" wizardCaption="P App Role Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_regionFormparent_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="204" fieldSourceType="DBColumn" dataType="Text" name="p_regionGridPage" wizardCaption="Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_regionFormp_regionGridPage">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<ListBox id="241" visible="Yes" fieldSourceType="DBColumn" sourceType="Table" dataType="Float" returnValueType="Number" name="p_region_level_id" wizardEmptyCaption="Select Value" PathID="p_regionFormp_region_level_id" connection="ConnSIKP" dataSource="p_region_level" boundColumn="p_region_level_id" textColumn="level_name" fieldSource="p_region_level_id" required="True">
					<Components/>
					<Events/>
					<TableParameters/>
					<SPParameters/>
					<SQLParameters/>
					<JoinTables>
						<JoinTable id="242" tableName="p_region_level" schemaName="sikp" posLeft="10" posTop="10" posWidth="137" posHeight="152"/>
					</JoinTables>
					<JoinLinks/>
					<Fields/>
					<Attributes/>
					<Features/>
				</ListBox>
				<TextBox id="247" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="region_code" fieldSource="region_code" required="False" caption="Kode Regional" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_regionFormregion_code">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="251" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="business_area" fieldSource="business_area" required="False" caption="Kode Wilayah" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_regionFormbusiness_area">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Hidden id="252" fieldSourceType="DBColumn" dataType="Float" name="p_business_area_id" PathID="p_regionFormp_business_area_id" fieldSource="p_business_area_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<TextBox id="256" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="postal_code" fieldSource="postal_code" required="False" caption="Kode Pos" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_regionFormpostal_code">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="260" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="nasional_code" fieldSource="nasional_code" required="False" caption="Kode Wilayah Nasional" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_regionFormnasional_code">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
</Components>
			<Events>
				<Event name="BeforeShow" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="128" eventType="Server"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
				<TableParameter id="195" conditionType="Parameter" useIsNull="False" field="p_region_id" dataType="Float" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="p_region_id"/>
			</TableParameters>
			<SPParameters/>
			<SQLParameters>
				<SQLParameter id="240" parameterType="URL" variable="p_region_id" dataType="Float" parameterSource="p_region_id"/>
			</SQLParameters>
			<JoinTables>
				<JoinTable id="259" tableName="p_region" schemaName="sikp" posLeft="10" posTop="10" posWidth="153" posHeight="180"/>
			</JoinTables>
			<JoinLinks/>
			<Fields>
			</Fields>
			<ISPParameters/>
			<ISQLParameters>
				<SQLParameter id="217" variable="region_name" dataType="Text" parameterType="Control" parameterSource="region_name"/>
				<SQLParameter id="218" variable="description" dataType="Text" parameterType="Control" parameterSource="description"/>
				<SQLParameter id="220" variable="updated_by" dataType="Text" parameterType="Expression" parameterSource="CCGetUserLogin()"/>
				<SQLParameter id="221" variable="p_region_level_id" dataType="Text" parameterType="Control" parameterSource="p_region_level_id"/>
				<SQLParameter id="222" variable="parent_id" dataType="Float" parameterType="Control" parameterSource="parent_id"/>
				<SQLParameter id="248" variable="region_code" parameterType="Control" dataType="Text" parameterSource="region_code"/>
				<SQLParameter id="253" variable="p_business_area_id" parameterType="Control" defaultValue="0" dataType="Float" parameterSource="p_business_area_id"/>
				<SQLParameter id="257" variable="postal_code" parameterType="Control" dataType="Text" parameterSource="postal_code"/>
				<SQLParameter id="261" variable="nasional_code" parameterType="Control" dataType="Text" parameterSource="nasional_code"/>
</ISQLParameters>
			<IFormElements>
				<CustomParameter id="205" field="p_region_id" dataType="Float" parameterType="Control" parameterSource="p_region_id"/>
				<CustomParameter id="206" field="region_name" dataType="Text" parameterType="Control" parameterSource="region_name"/>
				<CustomParameter id="208" field="description" dataType="Text" parameterType="Control" parameterSource="description"/>
				<CustomParameter id="211" field="updated_date" dataType="Text" parameterType="Control" parameterSource="updated_date" format="dd-mmm-yyyy"/>
				<CustomParameter id="212" field="updated_by" dataType="Text" parameterType="Control" parameterSource="updated_by"/>
				<CustomParameter id="214" field="p_region_level_id" dataType="Text" parameterType="Control" parameterSource="p_region_level_id"/>
				<CustomParameter id="215" field="parent_id" dataType="Float" parameterType="Control" parameterSource="parent_id"/>
			</IFormElements>
			<USPParameters/>
			<USQLParameters>
				<SQLParameter id="234" variable="p_region_id" dataType="Float" parameterType="Control" parameterSource="p_region_id"/>
				<SQLParameter id="235" variable="region_name" dataType="Text" parameterType="Control" parameterSource="region_name"/>
				<SQLParameter id="236" variable="description" dataType="Text" parameterType="Control" parameterSource="description"/>
				<SQLParameter id="238" variable="updated_by" dataType="Text" parameterType="Expression" parameterSource="CCGetUserLogin()"/>
				<SQLParameter id="244" variable="p_region_level_id" parameterType="Control" defaultValue="0" dataType="Float" parameterSource="p_region_level_id"/>
				<SQLParameter id="249" variable="region_code" parameterType="Control" dataType="Text" parameterSource="region_code"/>
				<SQLParameter id="254" variable="p_business_area_id" parameterType="Control" defaultValue="0" dataType="Float" parameterSource="p_business_area_id"/>
				<SQLParameter id="258" variable="postal_code" parameterType="Control" dataType="Text" parameterSource="postal_code"/>
				<SQLParameter id="262" variable="nasional_code" parameterType="Control" dataType="Text" parameterSource="nasional_code"/>
</USQLParameters>
			<UConditions>
			</UConditions>
			<UFormElements>
				<CustomParameter id="223" field="p_region_id" dataType="Float" parameterType="Control" parameterSource="p_region_id"/>
				<CustomParameter id="224" field="region_name" dataType="Text" parameterType="Control" parameterSource="region_name"/>
				<CustomParameter id="226" field="description" dataType="Text" parameterType="Control" parameterSource="description"/>
				<CustomParameter id="229" field="updated_date" dataType="Text" parameterType="Control" parameterSource="updated_date" format="dd-mmm-yyyy"/>
				<CustomParameter id="230" field="updated_by" dataType="Text" parameterType="Control" parameterSource="updated_by"/>
				<CustomParameter id="232" field="p_region_level_id" dataType="Text" parameterType="Control" parameterSource="p_region_level_id"/>
				<CustomParameter id="233" field="parent_id" dataType="Float" parameterType="Control" parameterSource="parent_id"/>
			</UFormElements>
			<DSPParameters/>
			<DSQLParameters>
				<SQLParameter id="239" variable="p_region_id" parameterType="Control" defaultValue="0" dataType="Float" parameterSource="p_region_id"/>
			</DSQLParameters>
			<DConditions>
			</DConditions>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Record>
	</Components>
	<CodeFiles>
		<CodeFile id="Events" language="PHPTemplates" name="p_region_events.php" forShow="False" comment="//" codePage="windows-1252"/>
		<CodeFile id="Code" language="PHPTemplates" name="p_region.php" forShow="True" url="p_region.php" comment="//" codePage="windows-1252"/>
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
