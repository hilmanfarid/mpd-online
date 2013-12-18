<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\param" secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="CoffeeBreak" wizardThemeVersion="3.0" needGeneration="0">
	<Components>
		<Grid id="2" secured="False" sourceType="SQL" returnValueType="Number" defaultPageSize="5" connection="ConnSIKP" dataSource="SELECT a.p_journal_period_id, a.p_year_period_id, a.code, to_char(a.start_date,'DD-MON-YYYY') start_date,
to_char(a.end_date,'DD-MON-YYYY') end_date, a.description,
to_char(a.updated_date,'DD-MON-YYYY') updated_date,
a.updated_by,to_char(a.creation_date,'DD-MON-YYYY') creation_date, a.created_by,
b.code status_code, a.p_status_list_id
FROM p_journal_period a, p_status_list b, p_year_period c 
WHERE a.p_status_list_id = b.p_status_list_id AND 
a.p_year_period_id = c.p_year_period_id AND
a.p_year_period_id = {p_year_period_id} AND
(upper(a.code) LIKE upper('%{s_keyword}%')
OR upper(b.code) LIKE upper('%{s_keyword}%') )
ORDER BY a.p_journal_period_id DESC 
" name="p_journal_periodGrid" pageSizeLimit="100" wizardCaption="List of P App Role " wizardGridType="Tabular" wizardAllowInsert="True" wizardAltRecord="True" wizardAltRecordType="Style" wizardRecordSeparator="False" wizardNoRecords="-" pasteAsReplace="pasteAsReplace" pasteActions="pasteActions" activeCollection="SQLParameters" orderBy="p_app_role_id" parameterTypeListName="ParameterTypeList">
			<Components>
				<Link id="7" visible="Yes" fieldSourceType="DBColumn" dataType="Text" html="False" hrefType="Page" urlType="Relative" preserveParameters="GET" name="Insert_Link" hrefSource="p_journal_period.ccp" removeParameters="p_journal_period_id;s_keyword" wizardThemeItem="FooterA" wizardDefaultValue="Add New" wizardUseTemplateBlock="False" PathID="p_journal_periodGridInsert_Link">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="67" sourceType="Expression" name="FLAG" source="&quot;ADD&quot;"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
				<Link id="11" visible="Yes" fieldSourceType="CodeExpression" html="True" hrefType="Page" urlType="Relative" preserveParameters="GET" name="DLink" wizardCaption="Detail" wizardSize="50" wizardMaxLength="60" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" dataType="Text" wizardDefaultValue="DLink" hrefSource="p_journal_period.ccp" wizardThemeItem="GridA" PathID="p_journal_periodGridDLink" removeParameters="FLAG">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="106" sourceType="DataField" name="p_journal_period_id" source="p_journal_period_id"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
				<Label id="15" fieldSourceType="DBColumn" dataType="Text" html="False" name="code" fieldSource="code" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="p_journal_periodGridcode">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="17" fieldSourceType="DBColumn" dataType="Text" html="False" name="description" fieldSource="description" wizardCaption="Description" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="p_journal_periodGriddescription">
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
				<Hidden id="13" fieldSourceType="DBColumn" dataType="Float" html="False" name="p_journal_period_id" fieldSource="p_journal_period_id" wizardCaption="Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="p_journal_periodGridp_journal_period_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Label id="93" fieldSourceType="DBColumn" dataType="Text" html="False" name="status_code" fieldSource="status_code" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="p_journal_periodGridstatus_code">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="107" fieldSourceType="DBColumn" dataType="Text" html="False" name="start_date" fieldSource="start_date" wizardCaption="Description" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="p_journal_periodGridstart_date">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="108" fieldSourceType="DBColumn" dataType="Text" html="False" name="end_date" fieldSource="end_date" wizardCaption="Description" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="p_journal_periodGridend_date">
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
				<Event name="BeforeShow" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="95"/>
					</Actions>
				</Event>
				<Event name="BeforeSelect" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="97"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
				<TableParameter id="8" conditionType="Parameter" useIsNull="False" field="code" dataType="Text" searchConditionType="Contains" parameterType="URL" parameterSource="s_keyword" logicOperator="Or" orderNumber="1" leftBrackets="1"/>
				<TableParameter id="9" conditionType="Parameter" useIsNull="False" field="description" dataType="Text" searchConditionType="Contains" parameterType="URL" parameterSource="s_keyword" logicOperator="Or" orderNumber="2" rightBrackets="1"/>
			</TableParameters>
			<JoinTables>
			</JoinTables>
			<JoinLinks/>
			<Fields>
			</Fields>
			<SPParameters/>
			<SQLParameters>
				<SQLParameter id="92" variable="s_keyword" dataType="Text" parameterType="URL" parameterSource="s_keyword"/>
				<SQLParameter id="113" variable="p_year_period_id" parameterType="URL" defaultValue="0" dataType="Float" parameterSource="p_year_period_id"/>
			</SQLParameters>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Grid>
		<Record id="3" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="None" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="p_journal_periodSearch" wizardCaption="Search P App Role " wizardOrientation="Vertical" wizardFormMethod="post" returnPage="p_journal_period.ccp" PathID="p_journal_periodSearch" pasteActions="pasteActions">
			<Components>
				<Button id="4" urlType="Relative" enableValidation="True" isDefault="False" name="Button_DoSearch" operation="Search" wizardCaption="Search" PathID="p_journal_periodSearchButton_DoSearch">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<TextBox id="5" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="s_keyword" wizardCaption="Keyword" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" PathID="p_journal_periodSearchs_keyword">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Hidden id="110" fieldSourceType="DBColumn" dataType="Text" name="p_year_periodGridPage" PathID="p_journal_periodSearchp_year_periodGridPage">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="111" fieldSourceType="DBColumn" dataType="Float" name="p_year_period_id" wizardCaption="Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_journal_periodSearchp_year_period_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="112" fieldSourceType="DBColumn" dataType="Text" name="periode_s_keyword" wizardCaption="Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_journal_periodSearchperiode_s_keyword">
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
		<Record id="23" sourceType="SQL" urlType="Relative" secured="False" allowInsert="True" allowUpdate="True" allowDelete="True" validateData="True" preserveParameters="GET" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" connection="ConnSIKP" name="p_journal_periodForm" errorSummator="Error" wizardCaption="Add/Edit P App Role " wizardFormMethod="post" PathID="p_journal_periodForm" customDeleteType="SQL" customDelete="DELETE FROM p_journal_period WHERE  p_journal_period_id = {p_journal_period_id}" activeCollection="DSQLParameters" activeTableType="customDelete" customUpdateType="SQL" customUpdate="UPDATE p_journal_period 
SET code='{code}', 
p_status_list_id={p_status_list_id},
start_date=to_date('{start_date}','DD-MON-YYYY'),
end_date=to_date('{end_date}','DD-MON-YYYY'),
description='{description}', 
updated_date=sysdate, 
updated_by='{updated_by}' 
WHERE p_journal_period_id = {p_journal_period_id}" parameterTypeListName="ParameterTypeList" pasteAsReplace="pasteAsReplace" pasteActions="pasteActions" customInsert="INSERT INTO p_journal_period(p_journal_period_id, code, p_status_list_id, start_date, end_date, description, creation_date, created_by, updated_date, updated_by, p_year_period_id) 
VALUES(generate_id('sikp','p_journal_period','p_journal_period_id'), '{code}', {p_status_list_id}, to_date('{start_date}','DD-MON-YYYY'), to_date('{end_date}','DD-MON-YYYY'), '{description}', sysdate, '{created_by}', sysdate, '{updated_by}', {p_year_period_id})" customInsertType="SQL" dataSource="SELECT a.p_journal_period_id, a.p_year_period_id, a.code, to_char(a.start_date,'DD-MON-YYYY') start_date,
to_char(a.end_date,'DD-MON-YYYY') end_date, a.description,
to_char(a.updated_date,'DD-MON-YYYY') updated_date,
a.updated_by,to_char(a.creation_date,'DD-MON-YYYY') creation_date, a.created_by,
b.code status_code, a.p_status_list_id
FROM p_journal_period a, p_status_list b, p_year_period c 
WHERE a.p_status_list_id = b.p_status_list_id AND
a.p_journal_period_id = {p_journal_period_id}">
			<Components>
				<Button id="24" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Insert" operation="Insert" wizardCaption="Add" PathID="p_journal_periodFormButton_Insert" removeParameters="FLAG">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="25" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Update" operation="Update" wizardCaption="Submit" PathID="p_journal_periodFormButton_Update" removeParameters="FLAG">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="26" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Delete" operation="Delete" wizardCaption="Delete" PathID="p_journal_periodFormButton_Delete" removeParameters="FLAG;p_journal_period_id;s_keyword;p_journal_periodGridPage">
					<Components/>
					<Events>
						<Event name="OnClick" type="Client">
							<Actions>
								<Action actionName="Confirmation Message" actionCategory="General" id="27" message="Delete record?"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="28" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Cancel" operation="Cancel" wizardCaption="Cancel" PathID="p_journal_periodFormButton_Cancel" removeParameters="FLAG;p_journal_period_id;s_keyword;p_journal_periodGridPage">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Hidden id="30" fieldSourceType="DBColumn" dataType="Float" name="p_year_period_id" fieldSource="p_year_period_id" required="False" caption="Id" wizardCaption="Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_journal_periodFormp_year_period_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<TextBox id="31" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="code" fieldSource="code" required="True" caption="Bulan" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_journal_periodFormcode">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="32" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="status_code" fieldSource="status_code" required="True" caption="Status" wizardCaption="Listing No" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_journal_periodFormstatus_code">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="37" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="description" fieldSource="description" required="False" caption="Description" wizardCaption="Description" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_journal_periodFormdescription">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="38" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="creation_date" fieldSource="creation_date" required="True" caption="Creation Date" wizardCaption="Creation Date" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_journal_periodFormcreation_date" format="dd-mmm-yyyy" defaultValue="date(&quot;d-M-Y&quot;)">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="40" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="created_by" fieldSource="created_by" required="True" caption="Created By" wizardCaption="Created By" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_journal_periodFormcreated_by" defaultValue="CCGetUserLogin()">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="41" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="updated_date" fieldSource="updated_date" required="True" caption="Updated Date" wizardCaption="Updated Date" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_journal_periodFormupdated_date" format="dd-mmm-yyyy" defaultValue="date(&quot;d-M-Y&quot;)">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="43" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="updated_by" fieldSource="updated_by" required="True" caption="Updated By" wizardCaption="Updated By" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_journal_periodFormupdated_by" defaultValue="CCGetUserLogin()">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="35" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="start_date" fieldSource="start_date" required="True" caption="Start Date" wizardCaption="Valid From" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_journal_periodFormstart_date" format="dd-mmm-yyyy">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="99" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="end_date" fieldSource="end_date" required="True" caption="End Date" wizardCaption="Valid From" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_journal_periodFormend_date" format="dd-mmm-yyyy">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<DatePicker id="36" name="DatePicker_start_date" control="start_date" wizardSatellite="True" wizardControl="valid_from" wizardDatePickerType="Image" wizardPicture="../Styles/RWNet/Images/DatePicker.gif" style="Styles/sikp/Style.css" PathID="p_journal_periodFormDatePicker_start_date">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</DatePicker>
				<DatePicker id="100" name="DatePicker_valid_from1" control="end_date" wizardSatellite="True" wizardControl="valid_from" wizardDatePickerType="Image" wizardPicture="../Styles/RWNet/Images/DatePicker.gif" style="Styles/sikp/Style.css" PathID="p_journal_periodFormDatePicker_valid_from1">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</DatePicker>
				<Hidden id="94" fieldSourceType="DBColumn" dataType="Float" name="p_status_list_id" PathID="p_journal_periodFormp_status_list_id" fieldSource="p_status_list_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="105" fieldSourceType="DBColumn" dataType="Text" name="p_journal_periodGridPage" PathID="p_journal_periodFormp_journal_periodGridPage">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="109" fieldSourceType="DBColumn" dataType="Float" html="False" name="p_journal_period_id" fieldSource="p_journal_period_id" wizardCaption="Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="p_journal_periodFormp_journal_period_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
			</Components>
			<Events/>
			<TableParameters>
			</TableParameters>
			<SPParameters/>
			<SQLParameters>
				<SQLParameter id="98" variable="p_journal_period_id" parameterType="URL" defaultValue="0" dataType="Float" parameterSource="p_journal_period_id"/>
			</SQLParameters>
			<JoinTables>
			</JoinTables>
			<JoinLinks/>
			<Fields/>
			<ISPParameters/>
			<ISQLParameters>
				<SQLParameter id="82" variable="code" dataType="Text" parameterType="Control" parameterSource="code"/>
				<SQLParameter id="83" variable="p_status_list_id" dataType="Float" parameterType="Control" parameterSource="p_status_list_id" defaultValue="NULL"/>
				<SQLParameter id="85" variable="description" dataType="Text" parameterType="Control" parameterSource="description"/>
				<SQLParameter id="87" variable="created_by" dataType="Text" parameterType="Expression" parameterSource="CCGetUserLogin()"/>
				<SQLParameter id="89" variable="updated_by" dataType="Text" parameterType="Expression" parameterSource="CCGetUserLogin()"/>
				<SQLParameter id="101" variable="start_date" parameterType="Control" dataType="Text" parameterSource="start_date"/>
				<SQLParameter id="102" variable="end_date" parameterType="Control" dataType="Text" parameterSource="end_date"/>
				<SQLParameter id="127" variable="p_year_period_id" parameterType="Control" defaultValue="0" dataType="Float" parameterSource="p_year_period_id"/>
			</ISQLParameters>
			<IFormElements>
				<CustomParameter id="71" field="p_app_role_id" dataType="Float" parameterType="Control" parameterSource="p_app_role_id"/>
				<CustomParameter id="72" field="code" dataType="Text" parameterType="Control" parameterSource="code"/>
				<CustomParameter id="73" field="listing_no" dataType="Float" parameterType="Control" parameterSource="listing_no"/>
				<CustomParameter id="74" field="valid_from" dataType="Date" parameterType="Control" parameterSource="valid_from" format="dd-mmm-yyyy"/>
				<CustomParameter id="75" field="description" dataType="Text" parameterType="Control" parameterSource="description"/>
				<CustomParameter id="76" field="creation_date" dataType="Date" parameterType="Control" parameterSource="creation_date" format="dd-mmm-yyyy"/>
				<CustomParameter id="77" field="created_by" dataType="Text" parameterType="Control" parameterSource="created_by"/>
				<CustomParameter id="78" field="updated_date" dataType="Date" parameterType="Control" parameterSource="updated_date" format="dd-mmm-yyyy"/>
				<CustomParameter id="79" field="updated_by" dataType="Text" parameterType="Control" parameterSource="updated_by"/>
				<CustomParameter id="80" field="valid_to" dataType="Date" parameterType="Control" parameterSource="valid_to" format="dd-mmm-yyyy"/>
			</IFormElements>
			<USPParameters/>
			<USQLParameters>
				<SQLParameter id="58" variable="code" dataType="Text" parameterType="Control" parameterSource="code"/>
				<SQLParameter id="59" variable="p_status_list_id" dataType="Float" parameterType="Control" parameterSource="p_status_list_id" defaultValue="0"/>
				<SQLParameter id="62" variable="description" dataType="Text" parameterType="Control" parameterSource="description"/>
				<SQLParameter id="64" variable="updated_by" dataType="Text" parameterType="Expression" parameterSource="CCGetUserLogin()"/>
				<SQLParameter id="103" variable="start_date" parameterType="Control" dataType="Text" parameterSource="start_date"/>
				<SQLParameter id="104" variable="end_date" parameterType="Control" dataType="Text" parameterSource="end_date"/>
				<SQLParameter id="126" variable="p_journal_period_id" parameterType="Control" defaultValue="0" dataType="Float" parameterSource="p_journal_period_id"/>
			</USQLParameters>
			<UConditions>
			</UConditions>
			<UFormElements>
				<CustomParameter id="114" field="p_year_period_id" dataType="Float" parameterType="Control" parameterSource="p_year_period_id"/>
				<CustomParameter id="115" field="code" dataType="Text" parameterType="Control" parameterSource="code"/>
				<CustomParameter id="116" field="status_code" dataType="Text" parameterType="Control" parameterSource="status_code"/>
				<CustomParameter id="117" field="description" dataType="Text" parameterType="Control" parameterSource="description"/>
				<CustomParameter id="118" field="creation_date" dataType="Text" parameterType="Control" parameterSource="creation_date" format="dd-mmm-yyyy"/>
				<CustomParameter id="119" field="created_by" dataType="Text" parameterType="Control" parameterSource="created_by"/>
				<CustomParameter id="120" field="updated_date" dataType="Text" parameterType="Control" parameterSource="updated_date" format="dd-mmm-yyyy"/>
				<CustomParameter id="121" field="updated_by" dataType="Text" parameterType="Control" parameterSource="updated_by"/>
				<CustomParameter id="122" field="start_date" dataType="Text" parameterType="Control" parameterSource="start_date" format="dd-mmm-yyyy"/>
				<CustomParameter id="123" field="end_date" dataType="Text" parameterType="Control" parameterSource="end_date" format="dd-mmm-yyyy"/>
				<CustomParameter id="124" field="p_status_list_id" dataType="Float" parameterType="Control" parameterSource="p_status_list_id"/>
				<CustomParameter id="125" field="p_journal_period_id" dataType="Float" parameterType="Control" parameterSource="p_journal_period_id"/>
			</UFormElements>
			<DSPParameters/>
			<DSQLParameters>
<SQLParameter id="129" variable="p_journal_period_id" parameterType="Control" dataType="Float" parameterSource="p_journal_period_id" defaultValue="0"/>
</DSQLParameters>
			<DConditions>
				<TableParameter id="128" conditionType="Parameter" useIsNull="False" field="p_journal_period_id" dataType="Float" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="p_journal_period_id"/>
			</DConditions>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Record>
	</Components>
	<CodeFiles>
		<CodeFile id="Events" language="PHPTemplates" name="p_journal_period_events.php" forShow="False" comment="//" codePage="windows-1252"/>
		<CodeFile id="Code" language="PHPTemplates" name="p_journal_period.php" forShow="True" url="p_journal_period.php" comment="//" codePage="windows-1252"/>
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
