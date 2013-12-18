<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\param" secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="CoffeeBreak" wizardThemeVersion="3.0" needGeneration="0">
	<Components>
		<Grid id="2" secured="False" sourceType="SQL" returnValueType="Number" defaultPageSize="5" connection="ConnSIKP" name="p_vat_penaltyGrid" pageSizeLimit="100" wizardCaption="List of P App Role " wizardGridType="Tabular" wizardAllowInsert="True" wizardAltRecord="True" wizardAltRecordType="Style" wizardRecordSeparator="False" wizardNoRecords="-" pasteAsReplace="pasteAsReplace" pasteActions="pasteActions" activeCollection="TableParameters" dataSource="SELECT to_char(a.updated_date,'DD-MON-YYYY') AS updated_date, b.vat_code, a.p_vat_penalty_id, 
a.month_qty,
a.penalty_pct,
a.penalty_amt,
a.description,
a.updated_by
FROM p_vat_penalty a INNER JOIN p_vat_type b ON
a.p_vat_type_id = b.p_vat_type_id
WHERE upper(b.vat_code) LIKE '%{s_keyword}%'
OR upper(a.description) LIKE '%{s_keyword}%' 
ORDER BY p_vat_penalty_id" orderBy="p_vat_penalty.p_vat_type_id">
			<Components>
				<Link id="7" visible="Yes" fieldSourceType="DBColumn" dataType="Text" html="False" hrefType="Page" urlType="Relative" preserveParameters="GET" name="Insert_Link" hrefSource="p_vat_penalty.ccp" removeParameters="p_vat_penalty_id;s_keyword" wizardThemeItem="FooterA" wizardDefaultValue="Add New" wizardUseTemplateBlock="False" PathID="p_vat_penaltyGridInsert_Link">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="67" sourceType="Expression" name="FLAG" source="&quot;ADD&quot;"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
				<Link id="11" visible="Yes" fieldSourceType="CodeExpression" html="True" hrefType="Page" urlType="Relative" preserveParameters="GET" name="DLink" wizardCaption="Detail" wizardSize="50" wizardMaxLength="60" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" dataType="Text" wizardDefaultValue="DLink" hrefSource="p_vat_penalty.ccp" wizardThemeItem="GridA" PathID="p_vat_penaltyGridDLink" removeParameters="FLAG">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="219" sourceType="DataField" name="p_vat_penalty_id" source="p_vat_penalty_id"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
				<Label id="17" fieldSourceType="DBColumn" dataType="Text" html="False" name="description" fieldSource="description" wizardCaption="Description" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="p_vat_penaltyGriddescription">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="19" fieldSourceType="DBColumn" dataType="Text" html="False" name="updated_by" fieldSource="updated_by" wizardCaption="Valid From" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="p_vat_penaltyGridupdated_by">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="21" fieldSourceType="DBColumn" dataType="Text" html="False" name="updated_date" fieldSource="updated_date" wizardCaption="Valid To" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="p_vat_penaltyGridupdated_date">
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
				<Label id="15" fieldSourceType="DBColumn" dataType="Text" html="False" name="vat_code" fieldSource="vat_code" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="p_vat_penaltyGridvat_code">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Hidden id="13" fieldSourceType="DBColumn" dataType="Float" html="False" name="p_vat_penalty_id" fieldSource="p_vat_penalty_id" wizardCaption="Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="p_vat_penaltyGridp_vat_penalty_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Label id="261" fieldSourceType="DBColumn" dataType="Text" html="False" name="month_qty" PathID="p_vat_penaltyGridmonth_qty" fieldSource="month_qty">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="262" fieldSourceType="DBColumn" dataType="Text" html="False" name="penalty_amt" PathID="p_vat_penaltyGridpenalty_amt" fieldSource="penalty_amt">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="266" fieldSourceType="DBColumn" dataType="Text" html="False" name="penalty_pct" PathID="p_vat_penaltyGridpenalty_pct" fieldSource="penalty_pct">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
</Components>
			<Events>
				<Event name="BeforeSelect" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="226"/>
					</Actions>
				</Event>
				<Event name="BeforeShowRow" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="227"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
				<TableParameter id="8" conditionType="Parameter" useIsNull="False" field="upper(vat_code)" dataType="Text" logicOperator="Or" searchConditionType="Contains" parameterType="URL" orderNumber="1" leftBrackets="0" parameterSource="s_keyword"/>
				<TableParameter id="9" conditionType="Parameter" useIsNull="False" field="upper(description)" dataType="Text" logicOperator="Or" searchConditionType="Contains" parameterType="URL" orderNumber="2" rightBrackets="0" parameterSource="s_keyword"/>
			</TableParameters>
			<JoinTables>
			</JoinTables>
			<JoinLinks/>
			<Fields>
				<Field id="225" fieldName="to_char(updated_date,'DD-MON-YYYY')" isExpression="True" alias="updated_date"/>
			</Fields>
			<SPParameters/>
			<SQLParameters>
				<SQLParameter id="149" parameterType="URL" variable="s_keyword" dataType="Text" parameterSource="s_keyword"/>
			</SQLParameters>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Grid>
		<Record id="3" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="None" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="p_vat_penaltySearch" wizardCaption="Search P App Role " wizardOrientation="Vertical" wizardFormMethod="post" returnPage="p_vat_penalty.ccp" PathID="p_vat_penaltySearch">
			<Components>
				<Button id="4" urlType="Relative" enableValidation="True" isDefault="False" name="Button_DoSearch" operation="Search" wizardCaption="Search" PathID="p_vat_penaltySearchButton_DoSearch">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<TextBox id="5" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="s_keyword" PathID="p_vat_penaltySearchs_keyword">
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
		<Record id="23" sourceType="SQL" urlType="Relative" secured="False" allowInsert="True" allowUpdate="True" allowDelete="True" validateData="True" preserveParameters="GET" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" connection="ConnSIKP" name="p_vat_penaltyForm" errorSummator="Error" wizardCaption="Add/Edit P App Role " wizardFormMethod="post" PathID="p_vat_penaltyForm" customDeleteType="SQL" activeCollection="USQLParameters" customUpdateType="SQL" parameterTypeListName="ParameterTypeList" pasteAsReplace="pasteAsReplace" pasteActions="pasteActions" customInsert="INSERT INTO p_vat_penalty(p_vat_penalty_id, p_vat_type_id, month_qty, is_percentage, penalty_pct, penalty_amt, description, creation_date, created_by, updated_date, updated_by) 
VALUES(generate_id('sikp','p_vat_penalty','p_vat_penalty_id'), {p_vat_type_id}, {month_qty}, '{is_percentage}', {penalty_pct}, {penalty_amt}, '{description}', sysdate, '{created_by}', sysdate, '{updated_by}')" customInsertType="SQL" customUpdate="UPDATE p_vat_penalty SET 
p_vat_type_id = {p_vat_type_id},
month_qty = {month_qty},
is_percentage = '{is_percentage}',
penalty_pct = {penalty_pct},
penalty_amt = {penalty_amt},
description = '{description}',
updated_date = sysdate,
updated_by = '{updated_by}'
WHERE p_vat_penalty_id = {p_vat_penalty_id}" customDelete="DELETE FROM p_vat_penalty where p_vat_penalty_id = {p_vat_penalty_id}" dataSource="SELECT to_char(a.updated_date,'DD-MON-YYYY') AS updated_date, to_char(a.creation_date,'DD-MON-YYYY') AS creation_date, b.vat_code, a.p_vat_penalty_id, 
a.is_percentage,
a.month_qty,
a.penalty_pct,
a.penalty_amt,
a.description,
a.updated_by,
a.created_by,
b.p_vat_type_id
FROM p_vat_penalty a INNER JOIN p_vat_type b ON
a.p_vat_type_id = b.p_vat_type_id
WHERE p_vat_penalty_id = {p_vat_penalty_id}">
			<Components>
				<Button id="24" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Insert" operation="Insert" wizardCaption="Add" PathID="p_vat_penaltyFormButton_Insert" removeParameters="FLAG">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="25" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Update" operation="Update" wizardCaption="Submit" PathID="p_vat_penaltyFormButton_Update" removeParameters="FLAG">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="26" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Delete" operation="Delete" wizardCaption="Delete" PathID="p_vat_penaltyFormButton_Delete" removeParameters="FLAG;p_vat_type_id;p_vat_typeGridPage;s_keyword">
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
				<Button id="28" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Cancel" operation="Cancel" wizardCaption="Cancel" PathID="p_vat_penaltyFormButton_Cancel" removeParameters="FLAG;p_vat_type_id;p_vat_typeGridPage;s_keyword">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<TextBox id="31" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="vat_code" fieldSource="vat_code" required="True" caption="Kode" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_vat_penaltyFormvat_code">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="37" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="description" fieldSource="description" required="False" caption="Description" wizardCaption="Description" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_vat_penaltyFormdescription">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="38" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="creation_date" fieldSource="creation_date" required="False" caption="Creation Date" wizardCaption="Creation Date" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_vat_penaltyFormcreation_date" format="dd-mmm-yyyy" defaultValue="date(&quot;d-M-Y&quot;)">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="40" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="created_by" fieldSource="created_by" required="False" caption="Created By" wizardCaption="Created By" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_vat_penaltyFormcreated_by" defaultValue="CCGetUserLogin()">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="41" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="updated_date" fieldSource="updated_date" required="False" caption="Updated Date" wizardCaption="Updated Date" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_vat_penaltyFormupdated_date" format="dd-mmm-yyyy" defaultValue="date(&quot;d-M-Y&quot;)">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="43" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="updated_by" fieldSource="updated_by" required="False" caption="Updated By" wizardCaption="Updated By" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_vat_penaltyFormupdated_by" defaultValue="CCGetUserLogin()">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Hidden id="123" fieldSourceType="DBColumn" dataType="Text" name="p_vat_penaltyGridPage" PathID="p_vat_penaltyFormp_vat_penaltyGridPage">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<TextBox id="268" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="month_qty" fieldSource="month_qty" required="True" caption="Kode" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_vat_penaltyFormmonth_qty">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
<TextBox id="269" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="penalty_pct" fieldSource="penalty_pct" required="False" caption="Description" wizardCaption="Description" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_vat_penaltyFormpenalty_pct">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
<TextBox id="270" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="penalty_amt" fieldSource="penalty_amt" required="False" caption="Description" wizardCaption="Description" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_vat_penaltyFormpenalty_amt">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
<Hidden id="271" fieldSourceType="DBColumn" dataType="Float" name="p_vat_penalty_id" PathID="p_vat_penaltyFormp_vat_penalty_id" fieldSource="p_vat_penalty_id">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Hidden>
<Hidden id="30" fieldSourceType="DBColumn" dataType="Float" name="p_vat_type_id" fieldSource="p_vat_type_id" required="False" caption="Id" wizardCaption="Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_vat_penaltyFormp_vat_type_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
<ListBox id="276" visible="Yes" fieldSourceType="DBColumn" sourceType="ListOfValues" dataType="Text" returnValueType="Number" name="is_percentage" wizardEmptyCaption="Select Value" PathID="p_vat_penaltyFormis_percentage" fieldSource="is_percentage" connection="ConnSIKP" _valueOfList="N" _nameOfList="TIDAK" dataSource="Y;YA;N;TIDAK">
<Components/>
<Events/>
<TableParameters/>
<SPParameters/>
<SQLParameters/>
<JoinTables/>
<JoinLinks/>
<Fields/>
<Attributes/>
<Features/>
</ListBox>
</Components>
			<Events>
			</Events>
			<TableParameters>
				<TableParameter id="154" conditionType="Parameter" useIsNull="False" field="p_hotel_grade_id" dataType="Float" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="p_hotel_grade_id"/>
			</TableParameters>
			<SPParameters/>
			<SQLParameters>
				<SQLParameter id="182" parameterType="URL" variable="p_vat_penalty_id" dataType="Float" parameterSource="p_vat_penalty_id" defaultValue="0"/>
			</SQLParameters>
			<JoinTables>
			</JoinTables>
			<JoinLinks/>
			<Fields>
			</Fields>
			<ISPParameters/>
			<ISQLParameters>
				<SQLParameter id="194" variable="month_qty" dataType="Float" parameterType="Control" parameterSource="month_qty" defaultValue="0"/>
				<SQLParameter id="195" variable="description" dataType="Text" parameterType="Control" parameterSource="description"/>
				<SQLParameter id="197" variable="created_by" dataType="Text" parameterType="Expression" parameterSource="CCGetUserLogin()"/>
				<SQLParameter id="199" variable="updated_by" dataType="Text" parameterType="Expression" parameterSource="CCGetUserLogin()"/>
				<SQLParameter id="235" variable="p_vat_type_id" parameterType="Control" dataType="Float" parameterSource="p_vat_type_id" defaultValue="0"/>
				<SQLParameter id="263" variable="is_percentage" parameterType="Control" dataType="Text" parameterSource="is_percentage"/>
<SQLParameter id="264" variable="penalty_pct" parameterType="Control" defaultValue="0" dataType="Float" parameterSource="penalty_pct"/>
<SQLParameter id="265" variable="penalty_amt" parameterType="Control" defaultValue="0" dataType="Float" parameterSource="penalty_amt"/>
</ISQLParameters>
			<IFormElements>
				<CustomParameter id="228" field="p_vat_type_id" dataType="Float" parameterType="Control" parameterSource="p_vat_type_id"/>
				<CustomParameter id="229" field="vat_code" dataType="Text" parameterType="Control" parameterSource="code"/>
				<CustomParameter id="230" field="description" dataType="Text" parameterType="Control" parameterSource="description"/>
				<CustomParameter id="231" field="creation_date" dataType="Text" parameterType="Control" parameterSource="creation_date" format="dd-mmm-yyyy"/>
				<CustomParameter id="232" field="created_by" dataType="Text" parameterType="Control" parameterSource="created_by"/>
				<CustomParameter id="233" field="updated_date" dataType="Text" parameterType="Control" parameterSource="updated_date" format="dd-mmm-yyyy"/>
				<CustomParameter id="234" field="updated_by" dataType="Text" parameterType="Control" parameterSource="updated_by"/>
			</IFormElements>
			<USPParameters/>
			<USQLParameters>
				<SQLParameter id="209" variable="p_vat_type_id" dataType="Float" parameterType="Control" parameterSource="p_vat_type_id" defaultValue="0"/>
				<SQLParameter id="210" variable="p_vat_penalty_id" dataType="Float" parameterType="Control" parameterSource="p_vat_penalty_id" defaultValue="0"/>
				<SQLParameter id="211" variable="description" dataType="Text" parameterType="Control" parameterSource="description"/>
				<SQLParameter id="215" variable="updated_by" dataType="Text" parameterType="Expression" parameterSource="CCGetUserLogin()"/>
				<SQLParameter id="272" variable="month_qty" parameterType="Control" defaultValue="0" dataType="Float" parameterSource="month_qty"/>
<SQLParameter id="273" variable="is_percentage" parameterType="Control" dataType="Text" parameterSource="is_percentage"/>
<SQLParameter id="274" variable="penalty_pct" parameterType="Control" defaultValue="0" dataType="Float" parameterSource="penalty_pct"/>
<SQLParameter id="275" variable="penalty_amt" parameterType="Control" defaultValue="0" dataType="Float" parameterSource="penalty_amt"/>
</USQLParameters>
			<UConditions>
			</UConditions>
			<UFormElements>
				<CustomParameter id="236" field="p_vat_type_id" dataType="Float" parameterType="Control" parameterSource="p_vat_type_id"/>
				<CustomParameter id="237" field="vat_code" dataType="Text" parameterType="Control" parameterSource="vat_code"/>
				<CustomParameter id="238" field="description" dataType="Text" parameterType="Control" parameterSource="description"/>
				<CustomParameter id="239" field="creation_date" dataType="Text" parameterType="Control" parameterSource="creation_date" format="dd-mmm-yyyy"/>
				<CustomParameter id="240" field="created_by" dataType="Text" parameterType="Control" parameterSource="created_by"/>
				<CustomParameter id="241" field="updated_date" dataType="Text" parameterType="Control" parameterSource="updated_date" format="dd-mmm-yyyy"/>
				<CustomParameter id="242" field="updated_by" dataType="Text" parameterType="Control" parameterSource="updated_by"/>
			</UFormElements>
			<DSPParameters/>
			<DSQLParameters>
				<SQLParameter id="218" variable="p_vat_penalty_id" parameterType="Control" dataType="Float" parameterSource="p_vat_penalty_id" defaultValue="0"/>
			</DSQLParameters>
			<DConditions>
			</DConditions>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Record>
	</Components>
	<CodeFiles>
		<CodeFile id="Events" language="PHPTemplates" name="p_vat_penalty_events.php" forShow="False" comment="//" codePage="windows-1252"/>
		<CodeFile id="Code" language="PHPTemplates" name="p_vat_penalty.php" forShow="True" url="p_vat_penalty.php" comment="//" codePage="windows-1252"/>
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
