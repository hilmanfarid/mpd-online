<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\param" secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="CoffeeBreak" wizardThemeVersion="3.0" needGeneration="0">
	<Components>
		<Grid id="2" secured="False" sourceType="SQL" returnValueType="Number" defaultPageSize="5" connection="ConnSIKP" dataSource="SELECT p_settlement_due_date_id, a.p_vat_type_id AS a_p_vat_type_id, due_in_day, debt_letter1_in_day, debt_letter2_in_day, debt_letter3_in_day,
a.description AS a_description, a.updated_by AS a_updated_by, vat_code, to_char(valid_from, 'DD-MON-YYYY') AS valid_from,
to_char(valid_to, 'DD-MON-YYYY') AS valid_to, to_char(a.updated_date, 'DD-MON-YYYY') AS a_updated_date 
FROM p_settlement_due_date a INNER JOIN p_vat_type b ON
a.p_vat_type_id = b.p_vat_type_id
WHERE ( vat_code LIKE '%{s_keyword}%'
OR a.description LIKE '%{s_keyword}%' ) 
ORDER BY p_settlement_due_date_id" name="p_settlement_due_dateGrid" pageSizeLimit="100" wizardCaption="List of P App Role " wizardGridType="Tabular" wizardAllowInsert="True" wizardAltRecord="True" wizardAltRecordType="Style" wizardRecordSeparator="False" wizardNoRecords="-" pasteAsReplace="pasteAsReplace" pasteActions="pasteActions" activeCollection="TableParameters" orderBy="p_settlement_due_date_id">
			<Components>
				<Link id="7" visible="Yes" fieldSourceType="DBColumn" dataType="Text" html="False" hrefType="Page" urlType="Relative" preserveParameters="GET" name="Insert_Link" hrefSource="p_settlement_due_date.ccp" removeParameters="p_settlement_due_date_id;s_keyword" wizardThemeItem="FooterA" wizardDefaultValue="Add New" wizardUseTemplateBlock="False" PathID="p_settlement_due_dateGridInsert_Link">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="67" sourceType="Expression" name="FLAG" source="&quot;ADD&quot;"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
				<Link id="11" visible="Yes" fieldSourceType="CodeExpression" html="True" hrefType="Page" urlType="Relative" preserveParameters="GET" name="DLink" wizardCaption="Detail" wizardSize="50" wizardMaxLength="60" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" dataType="Text" wizardDefaultValue="DLink" hrefSource="p_settlement_due_date.ccp" wizardThemeItem="GridA" PathID="p_settlement_due_dateGridDLink" removeParameters="FLAG">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="12" sourceType="DataField" format="yyyy-mm-dd" name="p_settlement_due_date_id" source="p_settlement_due_date_id"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
				<Label id="15" fieldSourceType="DBColumn" dataType="Text" html="False" name="due_in_day" fieldSource="due_in_day" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="p_settlement_due_dateGriddue_in_day">
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
				<Hidden id="13" fieldSourceType="DBColumn" dataType="Float" html="False" name="p_settlement_due_date_id" fieldSource="p_settlement_due_date_id" wizardCaption="Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="p_settlement_due_dateGridp_settlement_due_date_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Label id="93" fieldSourceType="DBColumn" dataType="Text" html="False" name="debt_letter1_in_day" fieldSource="debt_letter1_in_day" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="p_settlement_due_dateGriddebt_letter1_in_day">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="155" fieldSourceType="DBColumn" dataType="Text" html="False" name="vat_code" fieldSource="vat_code" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="p_settlement_due_dateGridvat_code">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Hidden id="156" fieldSourceType="DBColumn" dataType="Float" html="False" name="p_vat_type_id" fieldSource="a.p_vat_type_id" wizardCaption="Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="p_settlement_due_dateGridp_vat_type_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Label id="157" fieldSourceType="DBColumn" dataType="Text" html="False" name="debt_letter2_in_day" fieldSource="debt_letter2_in_day" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="p_settlement_due_dateGriddebt_letter2_in_day">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="158" fieldSourceType="DBColumn" dataType="Text" html="False" name="debt_letter3_in_day" fieldSource="debt_letter3_in_day" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="p_settlement_due_dateGriddebt_letter3_in_day">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="17" fieldSourceType="DBColumn" dataType="Text" html="False" name="a_description" fieldSource="a_description" wizardCaption="Description" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="p_settlement_due_dateGrida_description">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="159" fieldSourceType="DBColumn" dataType="Text" html="False" name="valid_from" fieldSource="valid_from" wizardCaption="Description" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="p_settlement_due_dateGridvalid_from">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="160" fieldSourceType="DBColumn" dataType="Text" html="False" name="valid_to" fieldSource="valid_to" wizardCaption="Description" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="p_settlement_due_dateGridvalid_to">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="161" fieldSourceType="DBColumn" dataType="Text" html="False" name="a_updated_by" fieldSource="a_updated_by" wizardCaption="Description" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="p_settlement_due_dateGrida_updated_by">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="162" fieldSourceType="DBColumn" dataType="Text" html="False" name="a_updated_date" fieldSource="a_updated_date" wizardCaption="Description" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="p_settlement_due_dateGrida_updated_date">
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
				<Field id="152" fieldName="to_char(valid_from, 'DD-MON-YYYY')" isExpression="True" alias="valid_from"/>
				<Field id="153" fieldName="to_char(valid_to, 'DD-MON-YYYY')" isExpression="True" alias="valid_to"/>
				<Field id="154" fieldName="to_char(a.updated_date, 'DD-MON-YYYY')" isExpression="True" alias="a_updated_date"/>
			</Fields>
			<SPParameters/>
			<SQLParameters>
				<SQLParameter id="92" variable="s_keyword" dataType="Text" parameterType="URL" parameterSource="s_keyword"/>
			</SQLParameters>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Grid>
		<Record id="3" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="None" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="p_settlement_due_dateSearch" wizardCaption="Search P App Role " wizardOrientation="Vertical" wizardFormMethod="post" returnPage="p_settlement_due_date.ccp" PathID="p_settlement_due_dateSearch">
			<Components>
				<Button id="4" urlType="Relative" enableValidation="True" isDefault="False" name="Button_DoSearch" operation="Search" wizardCaption="Search" PathID="p_settlement_due_dateSearchButton_DoSearch">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<TextBox id="5" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="s_keyword" wizardCaption="Keyword" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" PathID="p_settlement_due_dateSearchs_keyword">
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
		<Record id="23" sourceType="SQL" urlType="Relative" secured="False" allowInsert="True" allowUpdate="True" allowDelete="True" validateData="True" preserveParameters="GET" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" connection="ConnSIKP" name="p_settlement_due_dateForm" errorSummator="Error" wizardCaption="Add/Edit P App Role " wizardFormMethod="post" PathID="p_settlement_due_dateForm" customDeleteType="SQL" customDelete="DELETE FROM p_settlement_due_date WHERE  p_settlement_due_date_id = {p_settlement_due_date_id}" activeCollection="USQLParameters" activeTableType="customDelete" customUpdateType="SQL" customUpdate="UPDATE p_settlement_due_date SET
p_vat_type_id = {p_vat_type_id}, 
due_in_day = {due_in_day},
debt_letter1_in_day = {debt_letter1_in_day},
debt_letter2_in_day = {debt_letter2_in_day},
debt_letter3_in_day = {debt_letter3_in_day},
valid_from = to_date('{valid_from}','DD-MON-YYYY'), 
valid_to = to_date('{valid_to}','DD-MON-YYYY'), 
description = '{description}', 
updated_date = sysdate, 
updated_by = '{updated_by}'
WHERE p_settlement_due_date_id = {p_settlement_due_date_id}" parameterTypeListName="ParameterTypeList" pasteAsReplace="pasteAsReplace" pasteActions="pasteActions" customInsert="INSERT INTO p_settlement_due_date(
p_settlement_due_date_id, 
p_vat_type_id, 
due_in_day,
debt_letter1_in_day,
debt_letter2_in_day,
debt_letter3_in_day,
valid_from,
valid_to,
description, 
creation_date, 
created_by, 
updated_date, 
updated_by) 
VALUES(
generate_id('sikp','p_settlement_due_date','p_settlement_due_date_id'), 
{p_vat_type_id}, 
{due_in_day},
{debt_letter1_in_day},
{debt_letter2_in_day},
{debt_letter3_in_day},
to_date('{valid_from}','DD-MON-YYYY'), 
to_date('{valid_to}','DD-MON-YYYY'), 
'{description}', 
sysdate, 
'{created_by}', 
sysdate, 
'{updated_by}')" customInsertType="SQL" dataSource="SELECT p_settlement_due_date_id, 
a.p_vat_type_id, 
due_in_day, 
debt_letter1_in_day, 
debt_letter2_in_day, 
debt_letter3_in_day,
a.description, 
a.updated_by, 
a.created_by, 
vat_code, 
to_char(valid_from, 'DD-MON-YYYY') AS valid_from,
to_char(valid_to, 'DD-MON-YYYY') AS valid_to, 
to_char(a.updated_date, 'DD-MON-YYYY') AS updated_date, 
to_char(a.creation_date, 'DD-MON-YYYY') AS creation_date

FROM p_settlement_due_date a INNER JOIN p_vat_type b ON
a.p_vat_type_id = b.p_vat_type_id
WHERE p_settlement_due_date_id = {p_settlement_due_date_id}
ORDER BY p_settlement_due_date_id">
			<Components>
				<Button id="24" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Insert" operation="Insert" wizardCaption="Add" PathID="p_settlement_due_dateFormButton_Insert" removeParameters="FLAG">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="25" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Update" operation="Update" wizardCaption="Submit" PathID="p_settlement_due_dateFormButton_Update" removeParameters="FLAG">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="26" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Delete" operation="Delete" wizardCaption="Delete" PathID="p_settlement_due_dateFormButton_Delete" removeParameters="FLAG;p_settlement_due_date_id;s_keyword;p_settlement_due_dateGridPage">
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
				<Button id="28" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Cancel" operation="Cancel" wizardCaption="Cancel" PathID="p_settlement_due_dateFormButton_Cancel" removeParameters="FLAG;p_settlement_due_date_id;s_keyword;p_settlement_due_dateGridPage">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Hidden id="30" fieldSourceType="DBColumn" dataType="Float" name="p_settlement_due_date_id" fieldSource="p_settlement_due_date_id" required="False" caption="Id" wizardCaption="Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_settlement_due_dateFormp_settlement_due_date_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<TextBox id="32" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="vat_code" fieldSource="vat_code" required="True" caption="Jenis Pajak" wizardCaption="Listing No" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_settlement_due_dateFormvat_code">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="37" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="description" fieldSource="description" required="False" caption="Description" wizardCaption="Description" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_settlement_due_dateFormdescription">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="38" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="creation_date" fieldSource="creation_date" required="True" caption="Creation Date" wizardCaption="Creation Date" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_settlement_due_dateFormcreation_date" format="dd-mmm-yyyy" defaultValue="date(&quot;d-M-Y&quot;)">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="40" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="created_by" fieldSource="created_by" required="True" caption="Created By" wizardCaption="Created By" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_settlement_due_dateFormcreated_by" defaultValue="CCGetUserLogin()">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="41" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="updated_date" fieldSource="updated_date" required="True" caption="Updated Date" wizardCaption="Updated Date" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_settlement_due_dateFormupdated_date" format="dd-mmm-yyyy" defaultValue="date(&quot;d-M-Y&quot;)">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="43" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="updated_by" fieldSource="updated_by" required="True" caption="Updated By" wizardCaption="Updated By" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_settlement_due_dateFormupdated_by" defaultValue="CCGetUserLogin()">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="35" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="valid_from" fieldSource="valid_from" required="True" caption="Valid Sejak" wizardCaption="Valid From" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_settlement_due_dateFormvalid_from" format="dd-mmm-yyyy">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="99" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="valid_to" fieldSource="valid_to" required="False" caption="Valid Hingga" wizardCaption="Valid From" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_settlement_due_dateFormvalid_to" format="dd-mmm-yyyy">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<DatePicker id="36" name="DatePicker_valid_from" control="valid_from" wizardSatellite="True" wizardControl="valid_from" wizardDatePickerType="Image" wizardPicture="../Styles/RWNet/Images/DatePicker.gif" style="Styles/sikp/Style.css" PathID="p_settlement_due_dateFormDatePicker_valid_from">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</DatePicker>
				<DatePicker id="100" name="DatePicker_valid_to" control="valid_to" wizardSatellite="True" wizardControl="valid_from" wizardDatePickerType="Image" wizardPicture="../Styles/RWNet/Images/DatePicker.gif" style="Styles/sikp/Style.css" PathID="p_settlement_due_dateFormDatePicker_valid_to">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</DatePicker>
				<Hidden id="94" fieldSourceType="DBColumn" dataType="Float" name="p_vat_type_id" PathID="p_settlement_due_dateFormp_vat_type_id" fieldSource="p_vat_type_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="105" fieldSourceType="DBColumn" dataType="Text" name="p_settlement_due_dateGridPage" PathID="p_settlement_due_dateFormp_settlement_due_dateGridPage">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<TextBox id="163" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="due_in_day" fieldSource="due_in_day" required="True" caption="Jatuh Tempo (Hari)" wizardCaption="Listing No" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_settlement_due_dateFormdue_in_day">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="164" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="debt_letter1_in_day" fieldSource="debt_letter1_in_day" required="False" caption="Description" wizardCaption="Description" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_settlement_due_dateFormdebt_letter1_in_day">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="165" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="debt_letter2_in_day" fieldSource="debt_letter2_in_day" required="False" caption="Description" wizardCaption="Description" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_settlement_due_dateFormdebt_letter2_in_day">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="166" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="debt_letter3_in_day" fieldSource="debt_letter3_in_day" required="False" caption="Description" wizardCaption="Description" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_settlement_due_dateFormdebt_letter3_in_day">
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
				<SQLParameter id="98" variable="p_settlement_due_date_id" parameterType="URL" defaultValue="0" dataType="Float" parameterSource="p_settlement_due_date_id"/>
			</SQLParameters>
			<JoinTables>
			</JoinTables>
			<JoinLinks/>
			<Fields/>
			<ISPParameters/>
			<ISQLParameters>
				<SQLParameter id="85" variable="description" dataType="Text" parameterType="Control" parameterSource="description"/>
				<SQLParameter id="87" variable="created_by" dataType="Text" parameterType="Expression" parameterSource="CCGetUserLogin()"/>
				<SQLParameter id="89" variable="updated_by" dataType="Text" parameterType="Expression" parameterSource="CCGetUserLogin()"/>
				<SQLParameter id="167" variable="p_vat_type_id" parameterType="Control" defaultValue="0" dataType="Float" parameterSource="p_vat_type_id"/>
				<SQLParameter id="168" variable="due_in_day" parameterType="Control" dataType="Text" parameterSource="due_in_day"/>
				<SQLParameter id="169" variable="debt_letter1_in_day" parameterType="Control" defaultValue="0" dataType="Float" parameterSource="debt_letter1_in_day"/>
				<SQLParameter id="170" variable="debt_letter2_in_day" parameterType="Control" defaultValue="0" dataType="Float" parameterSource="debt_letter2_in_day"/>
				<SQLParameter id="171" variable="debt_letter3_in_day" parameterType="Control" defaultValue="0" dataType="Float" parameterSource="debt_letter3_in_day"/>
				<SQLParameter id="172" variable="valid_from" parameterType="Control" dataType="Text" parameterSource="valid_from"/>
				<SQLParameter id="173" variable="valid_to" parameterType="Control" dataType="Text" parameterSource="valid_to"/>
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
				<SQLParameter id="174" variable="p_vat_type_id" parameterType="Control" defaultValue="0" dataType="Float" parameterSource="p_vat_type_id"/>
				<SQLParameter id="175" variable="due_in_day" parameterType="Control" defaultValue="0" dataType="Float" parameterSource="due_in_day"/>
				<SQLParameter id="176" variable="debt_letter1_in_day" parameterType="Control" defaultValue="0" dataType="Float" parameterSource="debt_letter1_in_day"/>
				<SQLParameter id="177" variable="debt_letter2_in_day" parameterType="Control" defaultValue="0" dataType="Float" parameterSource="debt_letter2_in_day"/>
				<SQLParameter id="178" variable="debt_letter3_in_day" parameterType="Control" defaultValue="0" dataType="Float" parameterSource="debt_letter3_in_day"/>
				<SQLParameter id="179" variable="valid_from" parameterType="Control" dataType="Text" parameterSource="valid_from"/>
				<SQLParameter id="180" variable="valid_to" parameterType="Control" dataType="Text" parameterSource="valid_to"/>
				<SQLParameter id="181" variable="description" parameterType="Control" dataType="Text" parameterSource="description"/>
				<SQLParameter id="182" variable="updated_by" parameterType="Control" dataType="Text" parameterSource="updated_by"/>
				<SQLParameter id="183" variable="p_settlement_due_date_id" parameterType="Control" defaultValue="0" dataType="Float" parameterSource="p_settlement_due_date_id"/>
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
				<SQLParameter id="121" variable="p_settlement_due_date_id" parameterType="Control" dataType="Float" parameterSource="p_settlement_due_date_id" defaultValue="0"/>
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
		<CodeFile id="Events" language="PHPTemplates" name="p_settlement_due_date_events.php" forShow="False" comment="//" codePage="windows-1252"/>
		<CodeFile id="Code" language="PHPTemplates" name="p_settlement_due_date.php" forShow="True" url="p_settlement_due_date.php" comment="//" codePage="windows-1252"/>
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
