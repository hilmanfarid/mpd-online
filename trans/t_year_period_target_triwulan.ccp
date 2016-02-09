<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\trans" secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="CoffeeBreak" wizardThemeVersion="3.0" needGeneration="0">
	<Components>
		<Grid id="2" secured="False" sourceType="SQL" returnValueType="Number" defaultPageSize="5" connection="ConnSIKP" dataSource="SELECT a.p_year_period_id, a.year_code, to_char(a.start_date,'DD-MON-YYYY')as start_date, 
to_char(a.end_date,'DD-MON-YYYY')as end_date, 
a.p_status_list_id, a.description, to_char(a.creation_date,'DD-MON-YYYY')as creation_date, a.created_by, 
to_char(a.updated_date,'DD-MON-YYYY')as updated_date,
a.updated_by, b.code as p_status_list_code,
target_triwulan_1,
target_triwulan_2,
target_triwulan_3,
target_triwulan_4
FROM p_year_period a, p_status_list b
WHERE a.p_status_list_id = b.p_status_list_id
AND (upper(a.year_code) LIKE upper('%{s_keyword}%')
OR upper(b.code) LIKE upper('%{s_keyword}%') )
ORDER BY a.p_year_period_id DESC 
" name="p_year_periodGrid" pageSizeLimit="100" wizardCaption="List of P App Role " wizardGridType="Tabular" wizardAllowInsert="True" wizardAltRecord="True" wizardAltRecordType="Style" wizardRecordSeparator="False" wizardNoRecords="-" pasteAsReplace="pasteAsReplace" pasteActions="pasteActions" activeCollection="TableParameters" orderBy="p_app_role_id">
			<Components>
				<Link id="7" visible="Yes" fieldSourceType="DBColumn" dataType="Text" html="False" hrefType="Page" urlType="Relative" preserveParameters="GET" name="Insert_Link" hrefSource="t_year_period_target_triwulan.ccp" removeParameters="p_year_period_id;s_keyword" wizardThemeItem="FooterA" wizardDefaultValue="Add New" wizardUseTemplateBlock="False" PathID="p_year_periodGridInsert_Link">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="67" sourceType="Expression" name="FLAG" source="&quot;ADD&quot;"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
				<Link id="11" visible="Yes" fieldSourceType="CodeExpression" html="True" hrefType="Page" urlType="Relative" preserveParameters="GET" name="DLink" wizardCaption="Detail" wizardSize="50" wizardMaxLength="60" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" dataType="Text" wizardDefaultValue="DLink" hrefSource="t_year_period_target_triwulan.ccp" wizardThemeItem="GridA" PathID="p_year_periodGridDLink" removeParameters="FLAG">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="12" sourceType="DataField" format="yyyy-mm-dd" name="p_year_period_id" source="p_year_period_id"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
				<Label id="15" fieldSourceType="DBColumn" dataType="Text" html="False" name="year_code" fieldSource="year_code" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="p_year_periodGridyear_code">
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
				<Hidden id="13" fieldSourceType="DBColumn" dataType="Float" html="False" name="p_year_period_id" fieldSource="p_year_period_id" wizardCaption="Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="p_year_periodGridp_year_period_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Label id="17" fieldSourceType="DBColumn" dataType="Text" html="False" name="description" fieldSource="description" wizardCaption="Description" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="p_year_periodGriddescription">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
<Label id="93" fieldSourceType="DBColumn" dataType="Text" html="False" name="start_date" fieldSource="start_date" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="p_year_periodGridstart_date">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
<Label id="126" fieldSourceType="DBColumn" dataType="Text" html="False" name="end_date" fieldSource="end_date" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="p_year_periodGridend_date">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
<Label id="128" fieldSourceType="DBColumn" dataType="Float" html="False" name="target_triwulan_1" fieldSource="target_triwulan_1" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="p_year_periodGridtarget_triwulan_1" format="#,##0.00">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
<Label id="108" fieldSourceType="DBColumn" dataType="Float" html="False" name="target_triwulan_2" fieldSource="target_triwulan_2" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="p_year_periodGridtarget_triwulan_2" format="#,##0.00">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
<Label id="109" fieldSourceType="DBColumn" dataType="Float" html="False" name="target_triwulan_3" fieldSource="target_triwulan_3" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="p_year_periodGridtarget_triwulan_3" format="#,##0.00">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
<Label id="132" fieldSourceType="DBColumn" dataType="Float" html="False" name="target_triwulan_4" fieldSource="target_triwulan_4" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="p_year_periodGridtarget_triwulan_4" format="#,##0.00">
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
			</SQLParameters>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Grid>
		<Record id="3" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="None" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="p_year_periodSearch" wizardCaption="Search P App Role " wizardOrientation="Vertical" wizardFormMethod="post" returnPage="t_year_period_target_triwulan.ccp" PathID="p_year_periodSearch">
			<Components>
				<Button id="4" urlType="Relative" enableValidation="True" isDefault="False" name="Button_DoSearch" operation="Search" wizardCaption="Search" PathID="p_year_periodSearchButton_DoSearch">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<TextBox id="5" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="s_keyword" wizardCaption="Keyword" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" PathID="p_year_periodSearchs_keyword">
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
		<Record id="23" sourceType="SQL" urlType="Relative" secured="False" allowInsert="True" allowUpdate="True" allowDelete="True" validateData="True" preserveParameters="GET" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" connection="ConnSIKP" name="p_year_periodForm" errorSummator="Error" wizardCaption="Add/Edit P App Role " wizardFormMethod="post" PathID="p_year_periodForm" customDeleteType="SQL" customDelete="DELETE FROM p_year_period WHERE  p_year_period_id = {p_year_period_id}" activeCollection="USQLParameters" activeTableType="customDelete" customUpdateType="SQL" customUpdate="UPDATE p_year_period 
SET 
target_triwulan_1={target_triwulan_1},
target_triwulan_2={target_triwulan_2},
target_triwulan_3={target_triwulan_3},
target_triwulan_4={target_triwulan_4},
updated_date=sysdate, 
updated_by='{updated_by}' 
WHERE  p_year_period_id = {p_year_period_id}" parameterTypeListName="ParameterTypeList" pasteAsReplace="pasteAsReplace" pasteActions="pasteActions" customInsert="INSERT INTO p_year_period(p_year_period_id, year_code, p_status_list_id, start_date, end_date, description, creation_date, created_by, updated_date, updated_by) 
VALUES(generate_id('sikp','p_year_period','p_year_period_id'), '{year_code}', {p_status_list_id}, to_date('{start_date}','DD-MON-YYYY'), to_date('{end_date}','DD-MON-YYYY'), '{description}', sysdate, '{created_by}', sysdate, '{updated_by}')" customInsertType="SQL" dataSource="SELECT a.p_year_period_id, a.year_code, to_char(a.start_date,'DD-MON-YYYY')as start_date, 
to_char(a.end_date,'DD-MON-YYYY')as end_date, 
a.p_status_list_id, a.description, to_char(a.creation_date,'DD-MON-YYYY')as creation_date, a.created_by, 
to_char(a.updated_date,'DD-MON-YYYY')as updated_date,
a.updated_by, b.code as p_status_list_code ,
target_triwulan_1,
target_triwulan_2,
target_triwulan_3,
target_triwulan_4
FROM p_year_period a, p_status_list b
WHERE a.p_status_list_id = b.p_status_list_id AND
a.p_year_period_id = {p_year_period_id}">
			<Components>
				<Button id="25" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Update" operation="Update" wizardCaption="Submit" PathID="p_year_periodFormButton_Update" removeParameters="FLAG">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Hidden id="30" fieldSourceType="DBColumn" dataType="Float" name="p_year_period_id" fieldSource="p_year_period_id" required="False" caption="Id" wizardCaption="Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_year_periodFormp_year_period_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<TextBox id="31" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="year_code" fieldSource="year_code" required="True" caption="Tahun" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_year_periodFormyear_code">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="38" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="creation_date" fieldSource="creation_date" required="True" caption="Creation Date" wizardCaption="Creation Date" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_year_periodFormcreation_date" format="dd-mmm-yyyy" defaultValue="date(&quot;d-M-Y&quot;)">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="40" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="created_by" fieldSource="created_by" required="True" caption="Created By" wizardCaption="Created By" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_year_periodFormcreated_by" defaultValue="CCGetUserLogin()">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="41" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="updated_date" fieldSource="updated_date" required="True" caption="Updated Date" wizardCaption="Updated Date" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_year_periodFormupdated_date" format="dd-mmm-yyyy" defaultValue="date(&quot;d-M-Y&quot;)">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="43" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="updated_by" fieldSource="updated_by" required="True" caption="Updated By" wizardCaption="Updated By" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_year_periodFormupdated_by" defaultValue="CCGetUserLogin()">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Hidden id="105" fieldSourceType="DBColumn" dataType="Text" name="p_year_periodGridPage" PathID="p_year_periodFormp_year_periodGridPage">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<TextBox id="133" visible="Yes" fieldSourceType="DBColumn" dataType="Float" name="target_triwulan_1" PathID="p_year_periodFormtarget_triwulan_1" defaultValue="0" fieldSource="target_triwulan_1" format="#,##0">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
<TextBox id="134" visible="Yes" fieldSourceType="DBColumn" dataType="Float" name="target_triwulan_2" PathID="p_year_periodFormtarget_triwulan_2" defaultValue="0" fieldSource="target_triwulan_2" format="#,##0">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
<TextBox id="135" visible="Yes" fieldSourceType="DBColumn" dataType="Float" name="target_triwulan_3" PathID="p_year_periodFormtarget_triwulan_3" defaultValue="0" fieldSource="target_triwulan_3" format="#,##0">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
<TextBox id="136" visible="Yes" fieldSourceType="DBColumn" dataType="Float" name="target_triwulan_4" PathID="p_year_periodFormtarget_triwulan_4" defaultValue="0" fieldSource="target_triwulan_4" format="#,##0">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
</Components>
			<Events/>
			<TableParameters>
			</TableParameters>
			<SPParameters/>
			<SQLParameters>
				<SQLParameter id="98" variable="p_year_period_id" parameterType="URL" defaultValue="0" dataType="Float" parameterSource="p_year_period_id"/>
			</SQLParameters>
			<JoinTables>
			</JoinTables>
			<JoinLinks/>
			<Fields/>
			<ISPParameters/>
			<ISQLParameters>
				<SQLParameter id="82" variable="year_code" dataType="Text" parameterType="Control" parameterSource="year_code"/>
				<SQLParameter id="83" variable="p_status_list_id" dataType="Float" parameterType="Control" parameterSource="p_status_list_id" defaultValue="0"/>
				<SQLParameter id="85" variable="description" dataType="Text" parameterType="Control" parameterSource="description"/>
				<SQLParameter id="87" variable="created_by" dataType="Text" parameterType="Expression" parameterSource="CCGetUserLogin()"/>
				<SQLParameter id="89" variable="updated_by" dataType="Text" parameterType="Expression" parameterSource="CCGetUserLogin()"/>
				<SQLParameter id="101" variable="start_date" parameterType="Control" dataType="Text" parameterSource="start_date"/>
				<SQLParameter id="102" variable="end_date" parameterType="Control" dataType="Text" parameterSource="end_date"/>
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
				<SQLParameter id="64" variable="updated_by" dataType="Text" parameterType="Expression" parameterSource="CCGetUserLogin()"/>
				<SQLParameter id="65" variable="p_year_period_id" parameterType="Control" dataType="Float" parameterSource="p_year_period_id" defaultValue="0"/>
				<SQLParameter id="137" variable="target_triwulan_1" parameterType="Control" defaultValue="0" dataType="Float" parameterSource="target_triwulan_1"/>
<SQLParameter id="138" variable="target_triwulan_2" parameterType="Control" defaultValue="0" dataType="Float" parameterSource="target_triwulan_2"/>
<SQLParameter id="139" variable="target_triwulan_3" parameterType="Control" defaultValue="0" dataType="Float" parameterSource="target_triwulan_3"/>
<SQLParameter id="140" variable="target_triwulan_4" parameterType="Control" defaultValue="0" dataType="Float" parameterSource="target_triwulan_4"/>
</USQLParameters>
			<UConditions>
			</UConditions>
			<UFormElements>
				<CustomParameter id="110" field="p_year_period_id" dataType="Float" parameterType="Control" parameterSource="p_year_period_id"/>
				<CustomParameter id="111" field="year_code" dataType="Text" parameterType="Control" parameterSource="year_code"/>
				<CustomParameter id="112" field="p_status_list_code" dataType="Text" parameterType="Control" parameterSource="p_status_list_code"/>
				<CustomParameter id="113" field="description" dataType="Text" parameterType="Control" parameterSource="description"/>
				<CustomParameter id="114" field="creation_date" dataType="Text" parameterType="Control" parameterSource="creation_date" format="dd-mmm-yyyy"/>
				<CustomParameter id="115" field="created_by" dataType="Text" parameterType="Control" parameterSource="created_by"/>
				<CustomParameter id="116" field="updated_date" dataType="Text" parameterType="Control" parameterSource="updated_date" format="dd-mmm-yyyy"/>
				<CustomParameter id="117" field="updated_by" dataType="Text" parameterType="Control" parameterSource="updated_by"/>
				<CustomParameter id="118" field="start_date" dataType="Text" parameterType="Control" parameterSource="start_date" format="dd-mmm-yyyy"/>
				<CustomParameter id="119" field="end_date" dataType="Text" parameterType="Control" parameterSource="end_date" format="dd-mmm-yyyy"/>
				<CustomParameter id="120" field="p_status_list_id" dataType="Float" parameterType="Control" parameterSource="p_status_list_id"/>
			</UFormElements>
			<DSPParameters/>
			<DSQLParameters>
				<SQLParameter id="121" variable="p_year_period_id" parameterType="Control" dataType="Float" parameterSource="p_year_period_id" defaultValue="0"/>
			</DSQLParameters>
			<DConditions>
				<TableParameter id="46" conditionType="Parameter" useIsNull="False" field="p_year_period_id" dataType="Float" parameterType="Control" searchConditionType="Equal" logicOperator="And" orderNumber="1" parameterSource="p_year_period_id"/>
			</DConditions>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Record>
	</Components>
	<CodeFiles>
		<CodeFile id="Events" language="PHPTemplates" name="t_year_period_target_triwulan_events.php" forShow="False" comment="//" codePage="windows-1252"/>
		<CodeFile id="Code" language="PHPTemplates" name="t_year_period_target_triwulan.php" forShow="True" url="t_year_period_target_triwulan.php" comment="//" codePage="windows-1252"/>
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
		<Event name="BeforeShow" type="Server">
			<Actions>
				<Action actionName="Custom Code" actionCategory="General" id="122"/>
			</Actions>
		</Event>
	</Events>
</Page>
