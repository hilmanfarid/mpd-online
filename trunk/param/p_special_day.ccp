<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\param" secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="CoffeeBreak" wizardThemeVersion="3.0" needGeneration="0" pasteActions="pasteActions">
	<Components>
		<Grid id="2" secured="False" returnValueType="Number" defaultPageSize="5" connection="ConnSIKP" name="p_special_dayGrid" orderBy="special_date" pageSizeLimit="100" wizardCaption="List of P App Role " wizardGridType="Tabular" wizardAllowInsert="True" wizardAltRecord="True" wizardAltRecordType="Style" wizardRecordSeparator="False" wizardNoRecords="-" pasteAsReplace="pasteAsReplace" pasteActions="pasteActions" activeCollection="TableParameters" parameterTypeListName="ParameterTypeList" resultSetType="parameter" sourceType="SQL" dataSource="SELECT * 
FROM p_special_day
WHERE description LIKE '%{s_keyword}%'
ORDER BY special_date">
			<Components>
				<Link id="11" visible="Yes" fieldSourceType="CodeExpression" html="True" hrefType="Page" urlType="Relative" preserveParameters="GET" name="DLink" wizardCaption="Detail" wizardSize="50" wizardMaxLength="60" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" dataType="Text" wizardDefaultValue="DLink" hrefSource="p_special_day.ccp" wizardThemeItem="GridA" PathID="p_special_dayGridDLink" removeParameters="FLAG">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="136" sourceType="DataField" name="p_special_day_id" source="p_special_day_id"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
				<Label id="15" fieldSourceType="DBColumn" dataType="Text" html="False" name="special_date" fieldSource="special_date" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="p_special_dayGridspecial_date">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="17" fieldSourceType="DBColumn" dataType="Text" html="False" name="update_date" fieldSource="updated_date" wizardCaption="Description" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="p_special_dayGridupdate_date">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="19" fieldSourceType="DBColumn" dataType="Text" html="False" name="jml_index" fieldSource="jml_index" wizardCaption="Valid From" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="p_special_dayGridjml_index">
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
				<Link id="7" visible="Yes" fieldSourceType="DBColumn" dataType="Text" html="False" hrefType="Page" urlType="Relative" preserveParameters="GET" name="Insert_Link" hrefSource="p_special_day.ccp" removeParameters="p_app_menu_id;s_keyword" wizardThemeItem="FooterA" wizardDefaultValue="Add New" wizardUseTemplateBlock="False" PathID="p_special_dayGridInsert_Link">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="94" sourceType="Expression" name="FLAG" source="&quot;ADD&quot;"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
				<Hidden id="245" fieldSourceType="DBColumn" dataType="Text" name="p_special_day_id" PathID="p_special_dayGridp_special_day_id" fieldSource="p_special_day_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Label id="246" fieldSourceType="DBColumn" dataType="Text" html="False" name="description" fieldSource="description" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="p_special_dayGriddescription">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
			</Components>
			<Events>
				<Event name="BeforeShowRow" type="Server">
					<Actions>
						<Action actionName="Set Row Style" actionCategory="General" id="10" styles="Row;AltRow" name="rowStyle" eventType="Server"/>
					</Actions>
				</Event>
				<Event name="BeforeSelect" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="134" eventType="Server"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
				<TableParameter id="9" conditionType="Parameter" useIsNull="False" field="description" dataType="Text" logicOperator="And" searchConditionType="Contains" parameterType="URL" orderNumber="2" rightBrackets="1" parameterSource="s_keyword"/>
				<TableParameter id="8" conditionType="Parameter" useIsNull="False" field="code" parameterSource="s_keyword" dataType="Text" logicOperator="Or" searchConditionType="Contains" parameterType="URL" orderNumber="1" leftBrackets="1"/>
			</TableParameters>
			<JoinTables>
				<JoinTable id="244" tableName="p_special_day" schemaName="sikp" posLeft="10" posTop="10" posWidth="144" posHeight="168"/>
			</JoinTables>
			<JoinLinks/>
			<Fields>
			</Fields>
			<SPParameters>
			</SPParameters>
			<SQLParameters>
				<SQLParameter id="225" parameterType="URL" variable="s_keyword" dataType="Text" parameterSource="s_keyword"/>
			</SQLParameters>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Grid>
		<Record id="3" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="None" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="p_special_daySearch" wizardCaption="Search P App Role " wizardOrientation="Vertical" wizardFormMethod="post" returnPage="p_special_day.ccp" PathID="p_special_daySearch" pasteActions="pasteActions">
			<Components>
				<Button id="4" urlType="Relative" enableValidation="True" isDefault="False" name="Button_DoSearch" operation="Search" wizardCaption="Search" PathID="p_special_daySearchButton_DoSearch">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<TextBox id="5" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="s_keyword" wizardCaption="Keyword" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" PathID="p_special_daySearchs_keyword">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Hidden id="111" fieldSourceType="DBColumn" dataType="Float" html="False" name="p_day_category_id" fieldSource="p_day_category_id" wizardCaption="Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="p_special_daySearchp_day_category_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="214" fieldSourceType="DBColumn" dataType="Text" name="p_special_dayGridPage" wizardCaption="Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_special_daySearchp_special_dayGridPage">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="215" fieldSourceType="DBColumn" dataType="Text" name="p_day_category_s_keyword" wizardCaption="Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_special_daySearchp_day_category_s_keyword">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="249" fieldSourceType="DBColumn" dataType="Text" name="app_code" PathID="p_special_daySearchapp_code">
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
		<Record id="23" sourceType="Table" urlType="Relative" secured="False" allowInsert="True" allowUpdate="True" allowDelete="True" validateData="True" preserveParameters="GET" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" connection="ConnSIKP" name="p_special_dayForm" dataSource="p_special_day" errorSummator="Error" wizardCaption="Add/Edit P App Role " wizardFormMethod="post" PathID="p_special_dayForm" customDeleteType="SQL" customDelete="DELETE FROM p_special_day WHERE p_special_day_id = {p_special_day_id}" activeCollection="USQLParameters" customUpdateType="SQL" customUpdate="UPDATE p_special_day
   SET special_date='{special_date}', 
       p_day_category_id={p_day_category_id}, 
       updated_date=sysdate, 
       updated_by='{updated_by}', 
       description='{description}', 
       jml_index={jml_index}
 WHERE p_special_day_id={p_special_day_id};" parameterTypeListName="ParameterTypeList" pasteAsReplace="pasteAsReplace" pasteActions="pasteActions" customInsert="INSERT INTO p_special_day(
            p_special_day_id,
            special_date, 
            p_day_category_id, 
            updated_date, 
            updated_by, 
            description, 
            jml_index)
    VALUES (generate_id('sikp','p_special_day', 'p_special_day_id'), 
            to_date('{special_date}', 'DD-MON-YYYY'), 
            {p_day_category_id}, 
            sysdate, 
            '{updated_by}', 
            '{description}', 
            {jml_index});" customInsertType="SQL" resultSetType="parameter" activeTableType="customDelete">
			<Components>
				<TextBox id="37" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="description" fieldSource="description" required="False" caption="Description" wizardCaption="Description" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_special_dayFormdescription">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="41" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="updated_date" fieldSource="updated_date" required="False" caption="Updated Date" wizardCaption="Updated Date" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_special_dayFormupdated_date" format="dd-mmm-yyyy" defaultValue="date(&quot;d-M-Y&quot;)">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="43" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="updated_by" fieldSource="updated_by" required="False" caption="Updated By" wizardCaption="Updated By" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_special_dayFormupdated_by" defaultValue="CCGetUserLogin()">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="31" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="special_date" caption="Tanggal" fieldSource="special_date" required="True" PathID="p_special_dayFormspecial_date" defaultValue="date(&quot;d-M-Y&quot;)" format="dd-mmm-yyyy">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<DatePicker id="240" name="DatePicker_special_date1" PathID="p_special_dayFormDatePicker_special_date1" control="special_date" wizardDatePickerType="Image" wizardPicture="../Styles/CoffeeBreak/Images/DatePicker.gif" style="../Styles/sikp/Style.css">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</DatePicker>
				<Button id="112" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Cancel" operation="Cancel" wizardCaption="Cancel" PathID="p_special_dayFormButton_Cancel" removeParameters="p_special_day_id;s_keyword;FLAG;p_special_dayGridPage">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="113" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Delete" operation="Delete" wizardCaption="Delete" PathID="p_special_dayFormButton_Delete" removeParameters="p_special_day_id;s_keyword;FLAG;p_special_dayGridPage">
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
				<Button id="82" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Update" operation="Update" wizardCaption="Submit" PathID="p_special_dayFormButton_Update" removeParameters="FLAG">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="24" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Insert" operation="Insert" removeParameters="FLAG" PathID="p_special_dayFormButton_Insert">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<TextBox id="242" visible="Yes" fieldSourceType="DBColumn" dataType="Float" name="jml_index" fieldSource="jml_index" required="False" caption="Jumlah Index" wizardCaption="Description" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_special_dayFormjml_index">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Hidden id="243" fieldSourceType="DBColumn" dataType="Text" name="p_day_category_id" PathID="p_special_dayFormp_day_category_id" fieldSource="p_day_category_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="241" fieldSourceType="DBColumn" dataType="Text" name="p_special_day_id" PathID="p_special_dayFormp_special_day_id" fieldSource="p_special_day_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
			</Components>
			<Events>
				<Event name="BeforeShow" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="104"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
				<TableParameter id="161" conditionType="Parameter" useIsNull="False" field="p_special_day_id" dataType="Float" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="p_special_day_id"/>
			</TableParameters>
			<SPParameters>
			</SPParameters>
			<SQLParameters>
			</SQLParameters>
			<JoinTables>
				<JoinTable id="226" tableName="p_special_day" posLeft="10" posTop="10" posWidth="144" posHeight="152"/>
			</JoinTables>
			<JoinLinks/>
			<Fields>
				<Field id="211" fieldName="to_char(updated_date,'DD-MON-YYYY')" alias="updated_date" isExpression="True"/>
				<Field id="227" fieldName="to_char(special_date,'DD-MON-YYYY')" alias="special_date" isExpression="True"/>
				<Field id="228" tableName="p_special_day" fieldName="p_day_category_id"/>
				<Field id="229" tableName="p_special_day" fieldName="description"/>
				<Field id="230" tableName="p_special_day" fieldName="jml_index"/>
				<Field id="231" tableName="p_special_day" fieldName="updated_by" isExpression="False"/>
				<Field id="247" tableName="p_special_day" fieldName="p_special_day_id"/>
			</Fields>
			<ISPParameters/>
			<ISQLParameters>
				<SQLParameter id="150" variable="description" dataType="Text" parameterType="Control" parameterSource="description"/>
				<SQLParameter id="154" variable="updated_by" dataType="Text" parameterType="Expression" parameterSource="CCGetUserLogin()"/>
				<SQLParameter id="158" variable="special_date" dataType="Text" parameterType="Control" parameterSource="special_date"/>
				<SQLParameter id="232" variable="p_day_category_id" parameterType="Control" dataType="Text" parameterSource="p_day_category_id"/>
				<SQLParameter id="233" variable="jml_index" parameterType="Control" dataType="Text" parameterSource="jml_index"/>
			</ISQLParameters>
			<IFormElements>
				<CustomParameter id="137" field="code" dataType="Text" parameterType="Control" parameterSource="code"/>
				<CustomParameter id="138" field="file_name" dataType="Text" parameterType="Control" parameterSource="file_name"/>
				<CustomParameter id="139" field="description" dataType="Text" parameterType="Control" parameterSource="description"/>
				<CustomParameter id="140" field="creation_date" dataType="Text" parameterType="Control" parameterSource="creation_date" format="dd-mmm-yyyy"/>
				<CustomParameter id="141" field="created_by" dataType="Text" parameterType="Control" parameterSource="created_by"/>
				<CustomParameter id="142" field="updated_date" dataType="Text" parameterType="Control" parameterSource="updated_date" format="dd-mmm-yyyy"/>
				<CustomParameter id="143" field="updated_by" dataType="Text" parameterType="Control" parameterSource="updated_by"/>
				<CustomParameter id="144" field="parent_id" dataType="Float" parameterType="Control" parameterSource="parent_id"/>
				<CustomParameter id="145" field="listing_no" dataType="Float" parameterType="Control" parameterSource="listing_no"/>
				<CustomParameter id="146" field="is_active" dataType="Text" parameterType="Control" parameterSource="IS_ACTIVE"/>
				<CustomParameter id="147" field="p_app_menu_id" dataType="Float" parameterType="Control" parameterSource="p_app_menu_id"/>
			</IFormElements>
			<USPParameters/>
			<USQLParameters>
				<SQLParameter id="234" variable="p_special_day_id" parameterType="Control" dataType="Text" parameterSource="p_special_day_id"/>
				<SQLParameter id="235" variable="special_date" parameterType="Control" dataType="Text" parameterSource="special_date"/>
				<SQLParameter id="236" variable="p_day_category_id" parameterType="Control" defaultValue="0" dataType="Float" parameterSource="p_day_category_id"/>
				<SQLParameter id="237" variable="update_by" parameterType="Expression" dataType="Text" parameterSource="CCGetUserLogin()"/>
				<SQLParameter id="238" variable="description" parameterType="Control" dataType="Text" parameterSource="description"/>
				<SQLParameter id="239" variable="jml_index" parameterType="Control" dataType="Text" parameterSource="jml_index"/>
			</USQLParameters>
			<UConditions>
				<TableParameter id="184" conditionType="Parameter" useIsNull="False" field="p_app_menu_id" dataType="Float" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="p_app_menu_id"/>
				<TableParameter id="185" conditionType="Parameter" useIsNull="False" field="p_application_id" dataType="Float" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="p_application_id"/>
			</UConditions>
			<UFormElements>
				<CustomParameter id="172" field="code" dataType="Text" parameterType="Control" parameterSource="code"/>
				<CustomParameter id="173" field="file_name" dataType="Text" parameterType="Control" parameterSource="file_name"/>
				<CustomParameter id="174" field="description" dataType="Text" parameterType="Control" parameterSource="description"/>
				<CustomParameter id="175" field="creation_date" dataType="Text" parameterType="Control" parameterSource="creation_date" format="dd-mmm-yyyy"/>
				<CustomParameter id="176" field="created_by" dataType="Text" parameterType="Control" parameterSource="created_by"/>
				<CustomParameter id="177" field="updated_date" dataType="Text" parameterType="Control" parameterSource="updated_date" format="dd-mmm-yyyy"/>
				<CustomParameter id="178" field="updated_by" dataType="Text" parameterType="Control" parameterSource="updated_by"/>
				<CustomParameter id="179" field="parent_id" dataType="Float" parameterType="Control" parameterSource="parent_id"/>
				<CustomParameter id="180" field="listing_no" dataType="Float" parameterType="Control" parameterSource="listing_no"/>
				<CustomParameter id="181" field="is_active" dataType="Text" parameterType="Control" parameterSource="is_active"/>
				<CustomParameter id="182" field="p_app_menu_id" dataType="Float" parameterType="Control" parameterSource="p_app_menu_id"/>
				<CustomParameter id="183" field="p_application_id" dataType="Float" parameterType="Control" parameterSource="p_application_id"/>
			</UFormElements>
			<DSPParameters/>
			<DSQLParameters>
				<SQLParameter id="222" variable="p_special_day_id" parameterType="Control" dataType="Float" parameterSource="p_special_day_id" defaultValue="0"/>
			</DSQLParameters>
			<DConditions>
				<TableParameter id="198" conditionType="Parameter" useIsNull="False" field="p_app_menu_id" dataType="Float" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="p_app_menu_id"/>
			</DConditions>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Record>
		<Label id="250" fieldSourceType="DBColumn" dataType="Text" html="False" name="app_code" PathID="app_code">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
</Components>
	<CodeFiles>
		<CodeFile id="Events" language="PHPTemplates" name="p_special_day_events.php" forShow="False" comment="//" codePage="windows-1252"/>
		<CodeFile id="Code" language="PHPTemplates" name="p_special_day.php" forShow="True" url="p_special_day.php" comment="//" codePage="windows-1252"/>
	</CodeFiles>
	<SecurityGroups/>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events>
		<Event name="OnInitializeView" type="Server">
			<Actions>
				<Action actionName="Custom Code" actionCategory="General" id="66"/>
				<Action actionName="Custom Code" actionCategory="General" id="105"/>
			</Actions>
		</Event>
	</Events>
</Page>
