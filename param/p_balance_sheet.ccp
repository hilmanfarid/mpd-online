<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\param" secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="RWNet" wizardThemeVersion="3.0" needGeneration="0">
	<Components>
		<Grid id="2" secured="False" sourceType="SQL" returnValueType="Number" defaultPageSize="5" connection="ConnSIKP" name="p_balance_sheetGrid" pageSizeLimit="100" wizardCaption="List of P App Role " wizardGridType="Tabular" wizardAllowInsert="True" wizardAltRecord="True" wizardAltRecordType="Style" wizardRecordSeparator="False" wizardNoRecords="-" pasteAsReplace="pasteAsReplace" pasteActions="pasteActions" activeCollection="TableParameters" parameterTypeListName="ParameterTypeList" orderBy="listing_no" dataSource="SELECT a.p_balance_sheet_id, a.listing_no, a.report_label, 
a.left_righ_position, a.report_level, 
decode(a.is_detail,'Y','YA','TIDAK')as is_detail, decode(a.is_processed,'Y','YA','TIDAK')as is_processed, 
a.sum_to, decode(a.multiplicator,1,'POSITIF','NEGATIF')as multiplicator, a.description, 
to_char(a.creation_date,'DD-MON-YYYY')as creation_date, a.created_by, to_char(a.updated_date,'DD-MON-YYYY')as updated_date, 
a.updated_by, b.report_label as sum_to_code 
FROM p_balance_sheet a
LEFT OUTER JOIN p_balance_sheet b ON (b.listing_no=a.sum_to)
WHERE upper(a.report_label) LIKE '%{s_keyword}%' 
ORDER BY a.listing_no">
			<Components>
				<Link id="7" visible="Yes" fieldSourceType="DBColumn" dataType="Text" html="False" hrefType="Page" urlType="Relative" preserveParameters="GET" name="Insert_Link" hrefSource="p_balance_sheet.ccp" removeParameters="p_balance_sheet_id;s_keyword" wizardThemeItem="FooterA" wizardDefaultValue="Add New" wizardUseTemplateBlock="False" PathID="p_balance_sheetGridInsert_Link">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="67" sourceType="Expression" name="FLAG" source="&quot;ADD&quot;"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
				<Link id="11" visible="Yes" fieldSourceType="CodeExpression" html="True" hrefType="Page" urlType="Relative" preserveParameters="GET" name="DLink" wizardCaption="Detail" wizardSize="50" wizardMaxLength="60" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" dataType="Text" wizardDefaultValue="DLink" hrefSource="p_balance_sheet.ccp" wizardThemeItem="GridA" PathID="p_balance_sheetGridDLink" removeParameters="FLAG">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="621" sourceType="DataField" name="p_balance_sheet_id" source="p_balance_sheet_id"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
				<Label id="15" fieldSourceType="DBColumn" dataType="Text" html="False" name="report_label" fieldSource="report_label" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="p_balance_sheetGridreport_label">
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
				<Hidden id="13" fieldSourceType="DBColumn" dataType="Float" html="False" name="p_balance_sheet_id" fieldSource="p_balance_sheet_id" wizardCaption="Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="p_balance_sheetGridp_balance_sheet_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Label id="17" fieldSourceType="DBColumn" dataType="Text" html="False" name="report_level" fieldSource="report_level" wizardCaption="Description" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="p_balance_sheetGridreport_level">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="555" fieldSourceType="DBColumn" dataType="Float" html="False" name="listing_no" fieldSource="listing_no" wizardCaption="Description" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="p_balance_sheetGridlisting_no">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="622" fieldSourceType="DBColumn" dataType="Text" html="False" name="is_detail" fieldSource="is_detail" wizardCaption="Description" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="p_balance_sheetGridis_detail">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="623" fieldSourceType="DBColumn" dataType="Text" html="False" name="is_processed" fieldSource="is_processed" wizardCaption="Description" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="p_balance_sheetGridis_processed">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="624" fieldSourceType="DBColumn" dataType="Text" html="False" name="sum_to_code" fieldSource="sum_to_code" wizardCaption="Description" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="p_balance_sheetGridsum_to_code">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="625" fieldSourceType="DBColumn" dataType="Text" html="False" name="multiplicator" fieldSource="multiplicator" wizardCaption="Description" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="p_balance_sheetGridmultiplicator">
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
						<Action actionName="Custom Code" actionCategory="General" id="129"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
				<TableParameter id="557" conditionType="Parameter" useIsNull="False" field="upper(code)" dataType="Text" searchConditionType="Contains" parameterType="URL" logicOperator="Or" parameterSource="s_keyword"/>
				<TableParameter id="558" conditionType="Parameter" useIsNull="False" field="upper(description)" dataType="Text" searchConditionType="Contains" parameterType="URL" logicOperator="And" parameterSource="s_keyword"/>
			</TableParameters>
			<JoinTables>
			</JoinTables>
			<JoinLinks/>
			<Fields>
			</Fields>
			<SPParameters/>
			<SQLParameters>
				<SQLParameter id="606" parameterType="URL" variable="s_keyword" dataType="Text" parameterSource="s_keyword"/>
			</SQLParameters>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Grid>
		<Record id="3" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="None" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="p_balance_sheetSearch" wizardCaption="Search P App Role " wizardOrientation="Vertical" wizardFormMethod="post" returnPage="p_balance_sheet.ccp" PathID="p_balance_sheetSearch" pasteActions="pasteActions">
			<Components>
				<Button id="4" urlType="Relative" enableValidation="True" isDefault="False" name="Button_DoSearch" operation="Search" wizardCaption="Search" PathID="p_balance_sheetSearchButton_DoSearch">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<TextBox id="5" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="s_keyword" wizardCaption="Keyword" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" PathID="p_balance_sheetSearchs_keyword">
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
		<Record id="94" sourceType="SQL" urlType="Relative" secured="False" allowInsert="True" allowUpdate="True" allowDelete="True" validateData="True" preserveParameters="GET" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" connection="ConnSIKP" name="p_balance_sheetForm" errorSummator="Error" wizardCaption="Add/Edit V P App User " wizardFormMethod="post" PathID="p_balance_sheetForm" activeCollection="USQLParameters" pasteAsReplace="pasteAsReplace" pasteActions="pasteActions" customDeleteType="SQL" parameterTypeListName="ParameterTypeList" customUpdateType="SQL" customInsertType="SQL" customUpdate="UPDATE p_balance_sheet SET
listing_no='{listing_no}', 
report_label='{report_label}', 
is_detail='{is_detail}', 
is_processed='{is_processed}', 
description=initcap(trim('{description}')),
updated_by='{updated_by}', 
updated_date=sysdate,
sum_to='{sum_to}', 
multiplicator='{multiplicator}', 
report_level=decode('{report_level}',0,null, '{report_level}'),
left_righ_position='{left_righ_position}'
WHERE p_balance_sheet_id = {p_balance_sheet_id}" customDelete="DELETE FROM p_balance_sheet 
WHERE p_balance_sheet_id = {p_balance_sheet_id}" dataSource="SELECT a.p_balance_sheet_id, a.listing_no, a.report_label, a.left_righ_position, a.report_level, a.is_detail, a.is_processed, a.sum_to, a.multiplicator,
a.description, to_char(a.creation_date,'DD-MON-YYYY')as creation_date, a.created_by, to_char(a.updated_date,'DD-MON-YYYY')as updated_date, 
a.updated_by, b.report_label as sum_to_code 
FROM p_balance_sheet a
LEFT OUTER JOIN p_balance_sheet b ON (b.listing_no=a.sum_to) 
WHERE a.p_balance_sheet_id = {p_balance_sheet_id} " customInsert="INSERT INTO p_balance_sheet(p_balance_sheet_id,listing_no, report_label, is_detail, is_processed, description, creation_date, created_by, updated_by, updated_date, sum_to, multiplicator, report_level, left_righ_position) 
VALUES(generate_id('sikp','p_balance_sheet','p_balance_sheet_id'),'{listing_no}', '{report_label}', '{is_detail}', '{is_processed}', '{description}', sysdate, '{created_by}', '{updated_by}', sysdate, '{sum_to}', '{multiplicator}', decode('{report_level}',0,null,'{report_level}'), '{left_righ_position}')" activeTableType="customDelete">
			<Components>
				<Button id="95" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Insert" operation="Insert" wizardCaption="Add" PathID="p_balance_sheetFormButton_Insert" removeParameters="FLAG">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="96" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Update" operation="Update" wizardCaption="Submit" PathID="p_balance_sheetFormButton_Update" removeParameters="FLAG">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="97" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Delete" operation="Delete" wizardCaption="Delete" PathID="p_balance_sheetFormButton_Delete" removeParameters="FLAG;p_balance_sheet_id;s_keyword;p_balance_sheetGridPage">
					<Components/>
					<Events>
						<Event name="OnClick" type="Client">
							<Actions>
								<Action actionName="Confirmation Message" actionCategory="General" id="98" message="Delete record?"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="99" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Cancel" operation="Cancel" wizardCaption="Cancel" PathID="p_balance_sheetFormButton_Cancel" removeParameters="FLAG;p_balance_sheet_id;s_keyword;p_balance_sheetGridPage">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Hidden id="101" fieldSourceType="DBColumn" dataType="Float" name="p_balance_sheet_id" fieldSource="p_balance_sheet_id" caption="Id" wizardCaption="P App User Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_balance_sheetFormp_balance_sheet_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<TextBox id="114" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="description" fieldSource="description" required="False" caption="Description" wizardCaption="Description" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_balance_sheetFormdescription">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="124" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="created_by" fieldSource="created_by" required="False" caption="Created By" wizardCaption="Created By" wizardSize="16" wizardMaxLength="16" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_balance_sheetFormcreated_by" defaultValue="CCGetUserLogin()">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="127" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="updated_by" fieldSource="updated_by" required="False" caption="Updated By" wizardCaption="Updated By" wizardSize="16" wizardMaxLength="16" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_balance_sheetFormupdated_by" defaultValue="CCGetUserLogin()">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="122" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="creation_date" fieldSource="creation_date" required="False" caption="Creation Date" wizardCaption="Creation Date" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_balance_sheetFormcreation_date" format="dd-mmm-yyyy" defaultValue="date(&quot;d-M-Y&quot;)">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="125" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="updated_date" fieldSource="updated_date" required="False" caption="Updated Date" wizardCaption="Updated Date" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_balance_sheetFormupdated_date" defaultValue="date(&quot;d-M-Y&quot;)" format="dd-mmm-yyyy">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Hidden id="165" fieldSourceType="DBColumn" dataType="Text" name="p_balance_sheetGridPage" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="p_balance_sheetFormp_balance_sheetGridPage">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<TextBox id="156" visible="Yes" fieldSourceType="DBColumn" dataType="Float" name="listing_no" fieldSource="listing_no" required="True" caption="No Urut" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_balance_sheetFormlisting_no">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="460" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="report_label" fieldSource="report_label" required="False" caption="Label Data" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_balance_sheetFormreport_label">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<ListBox id="53" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="is_detail" fieldSource="is_detail" required="True" caption="Detail?" wizardCaption="IS DETAIL" wizardSize="1" wizardMaxLength="1" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_balance_sheetFormis_detail" sourceType="ListOfValues" _valueOfList="N" _nameOfList="TIDAK" dataSource="Y;YA;N;TIDAK" defaultValue="&quot;Y&quot;" connection="ConnSIKP">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
					<TableParameters/>
					<SPParameters/>
					<SQLParameters/>
					<JoinTables/>
					<JoinLinks/>
					<Fields/>
				</ListBox>
				<ListBox id="54" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="is_processed" fieldSource="is_processed" required="True" caption="Diproses?" wizardCaption="IS PROCESSED" wizardSize="1" wizardMaxLength="1" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_balance_sheetFormis_processed" sourceType="ListOfValues" _valueOfList="N" _nameOfList="TIDAK" dataSource="Y;YA;N;TIDAK" defaultValue="&quot;Y&quot;" connection="ConnSIKP">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
					<TableParameters/>
					<SPParameters/>
					<SQLParameters/>
					<JoinTables/>
					<JoinLinks/>
					<Fields/>
				</ListBox>
				<ListBox id="244" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="left_righ_position" fieldSource="left_righ_position" required="False" caption="Posisi" wizardCaption="REPORT LEVEL" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_balance_sheetFormleft_righ_position" sourceType="ListOfValues" dataSource="KIRI;KIRI;KANAN;KANAN" _valueOfList="KANAN" _nameOfList="KANAN" connection="ConnSIKP">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
					<TableParameters/>
					<SPParameters/>
					<SQLParameters/>
					<JoinTables/>
					<JoinLinks/>
					<Fields/>
				</ListBox>
				<ListBox id="56" visible="Yes" fieldSourceType="DBColumn" dataType="Single" name="multiplicator" fieldSource="multiplicator" required="False" caption="Faktor Pengali" wizardCaption="MULTIPLICATOR" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_balance_sheetFormmultiplicator" sourceType="ListOfValues" _valueOfList="-1" _nameOfList="NEGATIF" dataSource="1;POSITIF;-1;NEGATIF" connection="ConnSIKP">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
					<TableParameters/>
					<SPParameters/>
					<SQLParameters/>
					<JoinTables/>
					<JoinLinks/>
					<Fields/>
				</ListBox>
				<ListBox id="57" visible="Yes" fieldSourceType="DBColumn" dataType="Float" name="report_level" fieldSource="report_level" required="False" caption="Tingkat Laporan" wizardCaption="REPORT LEVEL" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_balance_sheetFormreport_level" sourceType="ListOfValues" _valueOfList="5" _nameOfList="5" dataSource="1;1;2;2;3;3;4;4;5;5" connection="ConnSIKP">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
					<TableParameters/>
					<SPParameters/>
					<SQLParameters/>
					<JoinTables/>
					<JoinLinks/>
					<Fields/>
				</ListBox>
				<TextBox id="198" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="sum_to_code" PathID="p_balance_sheetFormsum_to_code" fieldSource="sum_to_code" caption="Dijumlahkan ke">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Hidden id="55" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="sum_to" fieldSource="sum_to" required="False" caption="Dijumlahkan ke" wizardCaption="SUM TO" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_balance_sheetFormsum_to">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
			</Components>
			<Events/>
			<TableParameters>
				<TableParameter id="642" conditionType="Parameter" useIsNull="False" field="p_balance_sheet_id" dataType="Float" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="p_balance_sheet_id"/>
			</TableParameters>
			<SPParameters/>
			<SQLParameters>
				<SQLParameter id="643" parameterType="URL" variable="p_balance_sheet_id" dataType="Float" parameterSource="p_balance_sheet_id"/>
			</SQLParameters>
			<JoinTables>
			</JoinTables>
			<JoinLinks/>
			<Fields>
			</Fields>
			<ISPParameters>
				<SPParameter id="Key176" parameterName="i_p_app_user_id" parameterSource="0" dataType="Numeric" parameterType="Expression" dataSize="0" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key178" parameterName="i_full_name" parameterSource="full_name" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key179" parameterName="i_email_address" parameterSource="email_address" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key181" parameterName="i_p_data_status_list_id" parameterSource="p_data_status_list_id" dataType="Numeric" parameterType="Control" dataSize="0" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key182" parameterName="i_p_region_id" parameterSource="p_region_id" dataType="Numeric" parameterType="Control" dataSize="0" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key184" parameterName="i_description" parameterSource="description" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key185" parameterName="i_ip_address" parameterSource="ip_address" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key187" parameterName="i_expired_pwd" parameterSource="expired_pwd" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key188" parameterName="i_user_by" parameterSource="UserName" dataType="Char" parameterType="Session" dataSize="255" direction="Input" scale="10" precision="6"/>
			</ISPParameters>
			<ISQLParameters>
				<SQLParameter id="660" variable="description" dataType="Text" parameterType="Control" parameterSource="description"/>
				<SQLParameter id="661" variable="created_by" dataType="Text" parameterType="Expression" parameterSource="CCGetUserLogin()"/>
				<SQLParameter id="662" variable="updated_by" dataType="Text" parameterType="Expression" parameterSource="CCGetUserLogin()"/>
				<SQLParameter id="665" variable="listing_no" dataType="Float" parameterType="Control" parameterSource="listing_no"/>
				<SQLParameter id="666" variable="report_label" dataType="Text" parameterType="Control" parameterSource="report_label"/>
				<SQLParameter id="667" variable="is_detail" dataType="Text" parameterType="Control" parameterSource="is_detail"/>
				<SQLParameter id="668" variable="is_processed" dataType="Text" parameterType="Control" parameterSource="is_processed"/>
				<SQLParameter id="669" variable="left_righ_position" dataType="Text" parameterType="Control" parameterSource="left_righ_position"/>
				<SQLParameter id="670" variable="multiplicator" dataType="Single" parameterType="Control" parameterSource="multiplicator"/>
				<SQLParameter id="671" variable="report_level" dataType="Float" parameterType="Control" parameterSource="report_level" defaultValue="0"/>
				<SQLParameter id="673" variable="sum_to" dataType="Text" parameterType="Control" parameterSource="sum_to"/>
			</ISQLParameters>
			<IFormElements>
				<CustomParameter id="644" field="p_balance_sheet_id" dataType="Float" parameterType="Control" parameterSource="p_balance_sheet_id"/>
				<CustomParameter id="645" field="description" dataType="Text" parameterType="Control" parameterSource="description"/>
				<CustomParameter id="646" field="created_by" dataType="Text" parameterType="Control" parameterSource="created_by"/>
				<CustomParameter id="647" field="updated_by" dataType="Text" parameterType="Control" parameterSource="updated_by"/>
				<CustomParameter id="648" field="creation_date" dataType="Text" parameterType="Control" parameterSource="creation_date" format="dd-mmm-yyyy"/>
				<CustomParameter id="649" field="updated_date" dataType="Text" parameterType="Control" parameterSource="updated_date" format="dd-mmm-yyyy"/>
				<CustomParameter id="650" field="listing_no" dataType="Float" parameterType="Control" parameterSource="listing_no"/>
				<CustomParameter id="651" field="report_label" dataType="Text" parameterType="Control" parameterSource="report_label"/>
				<CustomParameter id="652" field="is_detail" dataType="Text" parameterType="Control" parameterSource="is_detail"/>
				<CustomParameter id="653" field="is_processed" dataType="Text" parameterType="Control" parameterSource="is_processed"/>
				<CustomParameter id="654" field="left_righ_position" dataType="Text" parameterType="Control" parameterSource="left_righ_position"/>
				<CustomParameter id="655" field="multiplicator" dataType="Single" parameterType="Control" parameterSource="multiplicator"/>
				<CustomParameter id="656" field="report_level" dataType="Float" parameterType="Control" parameterSource="REPORT_LEVEL"/>
				<CustomParameter id="657" field="sum_to_code" dataType="Text" parameterType="Control" parameterSource="sum_to_code"/>
				<CustomParameter id="658" field="sum_to" dataType="Float" parameterType="Control" parameterSource="SUM_TO"/>
			</IFormElements>
			<USPParameters>
				<SPParameter id="Key154" parameterName="i_flag" parameterSource="2" dataType="Numeric" parameterType="Expression" dataSize="0" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key155" parameterName="i_p_app_user_id" parameterSource="p_app_user_id" dataType="Numeric" parameterType="Control" dataSize="0" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key156" parameterName="i_user_name" parameterSource="user_name" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key157" parameterName="i_full_name" parameterSource="full_name" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key158" parameterName="i_email_address" parameterSource="email_address" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key159" parameterName="i_p_user_type_id" parameterSource="p_user_type_id" dataType="Numeric" parameterType="Control" dataSize="0" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key160" parameterName="i_p_data_status_list_id" parameterSource="p_data_status_list_id" dataType="Numeric" parameterType="Control" dataSize="0" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key161" parameterName="i_p_region_id" parameterSource="p_region_id" dataType="Numeric" parameterType="Control" dataSize="0" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key162" parameterName="i_p_region_structure_id" parameterSource="p_region_structure_id" dataType="Numeric" parameterType="Control" dataSize="0" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key163" parameterName="i_description" parameterSource="description" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key164" parameterName="i_ip_address" parameterSource="ip_address" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key165" parameterName="i_expired_user" parameterSource="expired_user" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key166" parameterName="i_expired_pwd" parameterSource="expired_pwd" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key167" parameterName="i_user_by" parameterSource="UserName" dataType="Char" parameterType="Session" dataSize="255" direction="Input" scale="10" precision="6"/>
			</USPParameters>
			<USQLParameters>
				<SQLParameter id="689" variable="p_balance_sheet_id" dataType="Float" parameterType="Control" parameterSource="p_balance_sheet_id"/>
				<SQLParameter id="690" variable="description" dataType="Text" parameterType="Control" parameterSource="description"/>
				<SQLParameter id="692" variable="updated_by" dataType="Text" parameterType="Expression" parameterSource="CCGetUserLogin()"/>
				<SQLParameter id="695" variable="listing_no" dataType="Float" parameterType="Control" parameterSource="listing_no"/>
				<SQLParameter id="696" variable="report_label" dataType="Text" parameterType="Control" parameterSource="report_label"/>
				<SQLParameter id="697" variable="is_detail" dataType="Text" parameterType="Control" parameterSource="is_detail"/>
				<SQLParameter id="698" variable="is_processed" dataType="Text" parameterType="Control" parameterSource="is_processed"/>
				<SQLParameter id="699" variable="left_righ_position" dataType="Text" parameterType="Control" parameterSource="left_righ_position"/>
				<SQLParameter id="700" variable="multiplicator" dataType="Single" parameterType="Control" parameterSource="multiplicator"/>
				<SQLParameter id="701" variable="report_level" dataType="Float" parameterType="Control" parameterSource="report_level" defaultValue="0"/>
				<SQLParameter id="703" variable="sum_to" dataType="Text" parameterType="Control" parameterSource="sum_to"/>
			</USQLParameters>
			<UConditions>
			</UConditions>
			<UFormElements>
				<CustomParameter id="674" field="p_balance_sheet_id" dataType="Float" parameterType="Control" parameterSource="p_balance_sheet_id"/>
				<CustomParameter id="675" field="description" dataType="Text" parameterType="Control" parameterSource="description"/>
				<CustomParameter id="676" field="created_by" dataType="Text" parameterType="Control" parameterSource="created_by"/>
				<CustomParameter id="677" field="updated_by" dataType="Text" parameterType="Control" parameterSource="updated_by"/>
				<CustomParameter id="678" field="creation_date" dataType="Text" parameterType="Control" parameterSource="creation_date" format="dd-mmm-yyyy"/>
				<CustomParameter id="679" field="updated_date" dataType="Text" parameterType="Control" parameterSource="updated_date" format="dd-mmm-yyyy"/>
				<CustomParameter id="680" field="listing_no" dataType="Float" parameterType="Control" parameterSource="listing_no"/>
				<CustomParameter id="681" field="report_label" dataType="Text" parameterType="Control" parameterSource="report_label"/>
				<CustomParameter id="682" field="is_detail" dataType="Text" parameterType="Control" parameterSource="is_detail"/>
				<CustomParameter id="683" field="is_processed" dataType="Text" parameterType="Control" parameterSource="is_processed"/>
				<CustomParameter id="684" field="left_righ_position" dataType="Text" parameterType="Control" parameterSource="left_righ_position"/>
				<CustomParameter id="685" field="multiplicator" dataType="Single" parameterType="Control" parameterSource="multiplicator"/>
				<CustomParameter id="686" field="report_level" dataType="Float" parameterType="Control" parameterSource="report_level"/>
				<CustomParameter id="687" field="sum_to_code" dataType="Text" parameterType="Control" parameterSource="sum_to_code"/>
				<CustomParameter id="688" field="sum_to" dataType="Float" parameterType="Control" parameterSource="sum_to"/>
			</UFormElements>
			<DSPParameters/>
			<DSQLParameters>
				<SQLParameter id="705" variable="p_balance_sheet_id" parameterType="Control" dataType="Float" parameterSource="p_balance_sheet_id" defaultValue="0"/>
			</DSQLParameters>
			<DConditions>
				<TableParameter id="704" conditionType="Parameter" useIsNull="False" field="p_balance_sheet_id" dataType="Float" searchConditionType="Equal" parameterType="Control" logicOperator="And" parameterSource="p_balance_sheet_id"/>
			</DConditions>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Record>
	</Components>
	<CodeFiles>
		<CodeFile id="Events" language="PHPTemplates" name="p_balance_sheet_events.php" forShow="False" comment="//" codePage="windows-1252"/>
		<CodeFile id="Code" language="PHPTemplates" name="p_balance_sheet.php" forShow="True" url="p_balance_sheet.php" comment="//" codePage="windows-1252"/>
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
