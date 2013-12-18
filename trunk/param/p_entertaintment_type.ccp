<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\param" secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="CoffeeBreak" wizardThemeVersion="3.0" needGeneration="0">
	<Components>
		<Grid id="2" secured="False" sourceType="SQL" returnValueType="Number" defaultPageSize="5" connection="ConnSIKP" name="p_entertaintment_typeGrid" pageSizeLimit="100" wizardCaption="List of P App Role " wizardGridType="Tabular" wizardAllowInsert="True" wizardAltRecord="True" wizardAltRecordType="Style" wizardRecordSeparator="False" wizardNoRecords="-" pasteAsReplace="pasteAsReplace" pasteActions="pasteActions" activeCollection="TableParameters" dataSource="SELECT p_entertaintment_type_id, code, entertaintment_name, 
description, to_char(creation_date,'DD-MON-YYYY')as creation_date, created_by, 
to_char(updated_date,'DD-MON-YYYY')as updated_date, updated_by 
FROM p_entertaintment_type
WHERE upper(code) LIKE '%{s_keyword}%'
OR upper(entertaintment_name) LIKE '%{s_keyword}%' 
OR upper(description) LIKE '%{s_keyword}%' 
ORDER BY p_entertaintment_type_id" orderBy="p_hotel_grade_id">
			<Components>
				<Link id="7" visible="Yes" fieldSourceType="DBColumn" dataType="Text" html="False" hrefType="Page" urlType="Relative" preserveParameters="GET" name="Insert_Link" hrefSource="p_entertaintment_type.ccp" removeParameters="p_entertaintment_type_id;s_keyword" wizardThemeItem="FooterA" wizardDefaultValue="Add New" wizardUseTemplateBlock="False" PathID="p_entertaintment_typeGridInsert_Link">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="67" sourceType="Expression" name="FLAG" source="&quot;ADD&quot;"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
				<Link id="11" visible="Yes" fieldSourceType="CodeExpression" html="True" hrefType="Page" urlType="Relative" preserveParameters="GET" name="DLink" wizardCaption="Detail" wizardSize="50" wizardMaxLength="60" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" dataType="Text" wizardDefaultValue="DLink" hrefSource="p_entertaintment_type.ccp" wizardThemeItem="GridA" PathID="p_entertaintment_typeGridDLink" removeParameters="FLAG">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="219" sourceType="DataField" name="p_entertaintment_type_id" source="p_entertaintment_type_id"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
				<Label id="17" fieldSourceType="DBColumn" dataType="Text" html="False" name="description" fieldSource="description" wizardCaption="Description" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="p_entertaintment_typeGriddescription">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="19" fieldSourceType="DBColumn" dataType="Text" html="False" name="updated_by" fieldSource="updated_by" wizardCaption="Valid From" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="p_entertaintment_typeGridupdated_by">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="21" fieldSourceType="DBColumn" dataType="Text" html="False" name="updated_date" fieldSource="updated_date" wizardCaption="Valid To" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="p_entertaintment_typeGridupdated_date">
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
				<Label id="163" fieldSourceType="DBColumn" dataType="Text" html="False" name="entertaintment_name" fieldSource="entertaintment_name" wizardCaption="Description" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="p_entertaintment_typeGridentertaintment_name">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="15" fieldSourceType="DBColumn" dataType="Text" html="False" name="code" fieldSource="code" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="p_entertaintment_typeGridcode">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
<Hidden id="13" fieldSourceType="DBColumn" dataType="Float" html="False" name="p_entertaintment_type_id" fieldSource="p_entertaintment_type_id" wizardCaption="Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="p_entertaintment_typeGridp_entertaintment_type_id">
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
				<TableParameter id="8" conditionType="Parameter" useIsNull="False" field="upper(code)" dataType="Text" logicOperator="Or" searchConditionType="Contains" parameterType="URL" orderNumber="1" leftBrackets="0" parameterSource="s_keyword"/>
				<TableParameter id="9" conditionType="Parameter" useIsNull="False" field="upper(description)" dataType="Text" logicOperator="Or" searchConditionType="Contains" parameterType="URL" orderNumber="2" rightBrackets="0" parameterSource="s_keyword"/>
			</TableParameters>
			<JoinTables>
			</JoinTables>
			<JoinLinks/>
			<Fields>
			</Fields>
			<SPParameters/>
			<SQLParameters>
				<SQLParameter id="149" parameterType="URL" variable="s_keyword" dataType="Text" parameterSource="s_keyword"/>
			</SQLParameters>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Grid>
		<Record id="3" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="None" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="p_entertaintment_typeSearch" wizardCaption="Search P App Role " wizardOrientation="Vertical" wizardFormMethod="post" returnPage="p_entertaintment_type.ccp" PathID="p_entertaintment_typeSearch">
			<Components>
				<Button id="4" urlType="Relative" enableValidation="True" isDefault="False" name="Button_DoSearch" operation="Search" wizardCaption="Search" PathID="p_entertaintment_typeSearchButton_DoSearch">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<TextBox id="5" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="s_keyword" wizardCaption="Keyword" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" PathID="p_entertaintment_typeSearchs_keyword">
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
		<Record id="23" sourceType="SQL" urlType="Relative" secured="False" allowInsert="True" allowUpdate="True" allowDelete="True" validateData="True" preserveParameters="GET" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" connection="ConnSIKP" name="p_entertaintment_typeForm" errorSummator="Error" wizardCaption="Add/Edit P App Role " wizardFormMethod="post" PathID="p_entertaintment_typeForm" customDeleteType="SQL" activeCollection="DSQLParameters" customUpdateType="SQL" parameterTypeListName="ParameterTypeList" pasteAsReplace="pasteAsReplace" pasteActions="pasteActions" customInsert="INSERT INTO p_entertaintment_type(p_entertaintment_type_id, code, description, creation_date, created_by, updated_date, updated_by, entertaintment_name) 
VALUES(generate_id('sikp','p_entertaintment_type','p_entertaintment_type_id'), '{code}', '{description}', sysdate, '{created_by}', sysdate, '{updated_by}', '{entertaintment_name}')" customInsertType="SQL" customUpdate="UPDATE p_entertaintment_type SET 
code='{code}', 
description='{description}', 
updated_date=sysdate, 
updated_by='{updated_by}', 
entertaintment_name='{entertaintment_name}'
WHERE p_entertaintment_type_id={p_entertaintment_type_id}" customDelete="DELETE FROM p_entertaintment_type
WHERE  p_entertaintment_type_id = {p_entertaintment_type_id}" dataSource="SELECT p_entertaintment_type_id, code, entertaintment_name, 
description, to_char(creation_date,'DD-MON-YYYY')as creation_date, created_by, to_char(updated_date,'DD-MON-YYYY')as updated_date, updated_by 
FROM p_entertaintment_type
WHERE p_entertaintment_type_id = {p_entertaintment_type_id} " activeTableType="customDelete">
			<Components>
				<Button id="24" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Insert" operation="Insert" wizardCaption="Add" PathID="p_entertaintment_typeFormButton_Insert" removeParameters="FLAG">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="25" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Update" operation="Update" wizardCaption="Submit" PathID="p_entertaintment_typeFormButton_Update" removeParameters="FLAG">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="26" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Delete" operation="Delete" wizardCaption="Delete" PathID="p_entertaintment_typeFormButton_Delete" removeParameters="FLAG;p_entertaintment_type_id;p_entertaintment_typeGridPage;s_keyword">
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
				<Button id="28" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Cancel" operation="Cancel" wizardCaption="Cancel" PathID="p_entertaintment_typeFormButton_Cancel" removeParameters="FLAG;p_entertaintment_type_id;p_entertaintment_typeGridPage;s_keyword">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Hidden id="30" fieldSourceType="DBColumn" dataType="Float" name="p_entertaintment_type_id" fieldSource="p_entertaintment_type_id" required="False" caption="Id" wizardCaption="Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_entertaintment_typeFormp_entertaintment_type_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<TextBox id="31" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="code" fieldSource="code" required="True" caption="Kode" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_entertaintment_typeFormcode">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="37" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="description" fieldSource="description" required="False" caption="Description" wizardCaption="Description" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_entertaintment_typeFormdescription">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="38" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="creation_date" fieldSource="creation_date" required="False" caption="Creation Date" wizardCaption="Creation Date" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_entertaintment_typeFormcreation_date" format="dd-mmm-yyyy" defaultValue="date(&quot;d-M-Y&quot;)">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="40" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="created_by" fieldSource="created_by" required="False" caption="Created By" wizardCaption="Created By" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_entertaintment_typeFormcreated_by" defaultValue="CCGetUserLogin()">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="41" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="updated_date" fieldSource="updated_date" required="False" caption="Updated Date" wizardCaption="Updated Date" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_entertaintment_typeFormupdated_date" format="dd-mmm-yyyy" defaultValue="date(&quot;d-M-Y&quot;)">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="43" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="updated_by" fieldSource="updated_by" required="False" caption="Updated By" wizardCaption="Updated By" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_entertaintment_typeFormupdated_by" defaultValue="CCGetUserLogin()">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Hidden id="123" fieldSourceType="DBColumn" dataType="Text" name="p_entertaintment_typeGridPage" PathID="p_entertaintment_typeFormp_entertaintment_typeGridPage">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<TextBox id="184" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="entertaintment_name" fieldSource="entertaintment_name" required="True" caption="Nama Kelas" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_entertaintment_typeFormentertaintment_name">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
			</Components>
			<Events>
			</Events>
			<TableParameters>
				<TableParameter id="154" conditionType="Parameter" useIsNull="False" field="p_hotel_grade_id" dataType="Float" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="p_hotel_grade_id"/>
			</TableParameters>
			<SPParameters/>
			<SQLParameters>
				<SQLParameter id="182" parameterType="URL" variable="p_entertaintment_type_id" dataType="Float" parameterSource="p_entertaintment_type_id" defaultValue="0"/>
			</SQLParameters>
			<JoinTables>
			</JoinTables>
			<JoinLinks/>
			<Fields>
			</Fields>
			<ISPParameters/>
			<ISQLParameters>
				<SQLParameter id="194" variable="code" dataType="Text" parameterType="Control" parameterSource="code"/>
				<SQLParameter id="195" variable="description" dataType="Text" parameterType="Control" parameterSource="description"/>
				<SQLParameter id="197" variable="created_by" dataType="Text" parameterType="Expression" parameterSource="CCGetUserLogin()"/>
				<SQLParameter id="199" variable="updated_by" dataType="Text" parameterType="Expression" parameterSource="CCGetUserLogin()"/>
				<SQLParameter id="200" variable="entertaintment_name" dataType="Text" parameterType="Control" parameterSource="entertaintment_name"/>
			</ISQLParameters>
			<IFormElements>
				<CustomParameter id="185" field="p_hotel_grade_id" dataType="Float" parameterType="Control" parameterSource="p_hotel_grade_id"/>
				<CustomParameter id="186" field="code" dataType="Text" parameterType="Control" parameterSource="code"/>
				<CustomParameter id="187" field="description" dataType="Text" parameterType="Control" parameterSource="description"/>
				<CustomParameter id="188" field="creation_date" dataType="Text" parameterType="Control" parameterSource="creation_date" format="dd-mmm-yyyy"/>
				<CustomParameter id="189" field="created_by" dataType="Text" parameterType="Control" parameterSource="created_by"/>
				<CustomParameter id="190" field="updated_date" dataType="Text" parameterType="Control" parameterSource="updated_date" format="dd-mmm-yyyy"/>
				<CustomParameter id="191" field="updated_by" dataType="Text" parameterType="Control" parameterSource="updated_by"/>
				<CustomParameter id="192" field="grade_name" dataType="Text" parameterType="Control" parameterSource="grade_name"/>
			</IFormElements>
			<USPParameters/>
			<USQLParameters>
				<SQLParameter id="209" variable="p_entertaintment_type_id" dataType="Float" parameterType="Control" parameterSource="p_entertaintment_type_id" defaultValue="0"/>
				<SQLParameter id="210" variable="code" dataType="Text" parameterType="Control" parameterSource="code"/>
				<SQLParameter id="211" variable="description" dataType="Text" parameterType="Control" parameterSource="description"/>
				<SQLParameter id="215" variable="updated_by" dataType="Text" parameterType="Expression" parameterSource="CCGetUserLogin()"/>
				<SQLParameter id="216" variable="entertaintment_name" dataType="Text" parameterType="Control" parameterSource="entertaintment_name"/>
			</USQLParameters>
			<UConditions>
			</UConditions>
			<UFormElements>
				<CustomParameter id="201" field="p_hotel_grade_id" dataType="Float" parameterType="Control" parameterSource="p_hotel_grade_id"/>
				<CustomParameter id="202" field="code" dataType="Text" parameterType="Control" parameterSource="code"/>
				<CustomParameter id="203" field="description" dataType="Text" parameterType="Control" parameterSource="description"/>
				<CustomParameter id="204" field="creation_date" dataType="Text" parameterType="Control" parameterSource="creation_date" format="dd-mmm-yyyy"/>
				<CustomParameter id="205" field="created_by" dataType="Text" parameterType="Control" parameterSource="created_by"/>
				<CustomParameter id="206" field="updated_date" dataType="Text" parameterType="Control" parameterSource="updated_date" format="dd-mmm-yyyy"/>
				<CustomParameter id="207" field="updated_by" dataType="Text" parameterType="Control" parameterSource="updated_by"/>
				<CustomParameter id="208" field="grade_name" dataType="Text" parameterType="Control" parameterSource="grade_name"/>
			</UFormElements>
			<DSPParameters/>
			<DSQLParameters>
				<SQLParameter id="218" variable="p_entertaintment_type_id" parameterType="Control" dataType="Float" parameterSource="p_entertaintment_type_id" defaultValue="0"/>
			</DSQLParameters>
			<DConditions>
				<TableParameter id="217" conditionType="Parameter" useIsNull="False" field="p_hotel_grade_id" dataType="Float" searchConditionType="Equal" parameterType="Control" logicOperator="And" parameterSource="p_hotel_grade_id"/>
			</DConditions>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Record>
	</Components>
	<CodeFiles>
		<CodeFile id="Events" language="PHPTemplates" name="p_entertaintment_type_events.php" forShow="False" comment="//" codePage="windows-1252"/>
		<CodeFile id="Code" language="PHPTemplates" name="p_entertaintment_type.php" forShow="True" url="p_entertaintment_type.php" comment="//" codePage="windows-1252"/>
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
