<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\param" secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="RWNet" wizardThemeVersion="3.0" needGeneration="0">
	<Components>
		<Grid id="2" secured="False" sourceType="SQL" returnValueType="Number" defaultPageSize="5" connection="ConnSIKP" name="p_work_programGrid" pageSizeLimit="100" wizardCaption="List of P App Role " wizardGridType="Tabular" wizardAllowInsert="True" wizardAltRecord="True" wizardAltRecordType="Style" wizardRecordSeparator="False" wizardNoRecords="-" pasteAsReplace="pasteAsReplace" pasteActions="pasteActions" activeCollection="SQLParameters" parameterTypeListName="ParameterTypeList" dataSource="SELECT p_work_program_id, code, program_name, decode(is_detail,'Y','YA','TIDAK')as is_detail, to_char(start_date,'DD-MON-YYYY')as start_date, to_char(end_date,'DD-MON-YYYY')as end_date, 
parent_id, description, to_char(creation_date,'DD-MON-YYYY')as creation_date, created_by,
to_char(updated_date,'DD-MON-YYYY')as updated_date, updated_by, kode_urusan_pemerintah 
FROM p_work_program
WHERE nvl(parent_id,0) = {parent_id} AND (upper(code) LIKE '%{s_keyword}%'
OR upper(program_name) LIKE '%{s_keyword}%') 
ORDER BY p_work_program_id" orderBy="p_work_program_id">
			<Components>
				<Link id="7" visible="Yes" fieldSourceType="DBColumn" dataType="Text" html="False" hrefType="Page" urlType="Relative" preserveParameters="GET" name="Insert_Link" hrefSource="p_work_program.ccp" removeParameters="p_work_program_id;s_keyword" wizardThemeItem="FooterA" wizardDefaultValue="Add New" wizardUseTemplateBlock="False" PathID="p_work_programGridInsert_Link">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="67" sourceType="Expression" name="FLAG" source="&quot;ADD&quot;"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
				<Link id="11" visible="Yes" fieldSourceType="CodeExpression" html="True" hrefType="Page" urlType="Relative" preserveParameters="GET" name="DLink" wizardCaption="Detail" wizardSize="50" wizardMaxLength="60" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" dataType="Text" wizardDefaultValue="DLink" hrefSource="p_work_program.ccp" wizardThemeItem="GridA" PathID="p_work_programGridDLink" removeParameters="FLAG">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="475" sourceType="DataField" name="p_work_program_id" source="p_work_program_id"/>
</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
				<Label id="15" fieldSourceType="DBColumn" dataType="Text" html="False" name="code" fieldSource="code" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="p_work_programGridcode">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="19" fieldSourceType="DBColumn" dataType="Text" html="False" name="program_name" fieldSource="program_name" wizardCaption="Valid From" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="p_work_programGridprogram_name">
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
				<Hidden id="13" fieldSourceType="DBColumn" dataType="Float" html="False" name="p_work_program_id" fieldSource="p_work_program_id" wizardCaption="Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="p_work_programGridp_work_program_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Label id="318" fieldSourceType="DBColumn" dataType="Text" html="False" name="start_date" fieldSource="start_date" wizardCaption="Valid From" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="p_work_programGridstart_date">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="17" fieldSourceType="DBColumn" dataType="Text" html="False" name="description" fieldSource="description" wizardCaption="Description" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="p_work_programGriddescription">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="332" fieldSourceType="DBColumn" dataType="Text" html="False" name="end_date" fieldSource="end_date" wizardCaption="Valid From" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="p_work_programGridend_date">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="476" fieldSourceType="DBColumn" dataType="Text" html="False" name="is_detail" fieldSource="is_detail" wizardCaption="Valid From" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="p_work_programGridis_detail">
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
				<TableParameter id="459" conditionType="Parameter" useIsNull="False" field="code" dataType="Text" searchConditionType="Contains" parameterType="URL" logicOperator="Or" parameterSource="s_keyword"/>
<TableParameter id="460" conditionType="Parameter" useIsNull="False" field="program_name" dataType="Memo" searchConditionType="Contains" parameterType="URL" logicOperator="And" parameterSource="s_keyword"/>
</TableParameters>
			<JoinTables>
			</JoinTables>
			<JoinLinks/>
			<Fields>
			</Fields>
			<SPParameters/>
			<SQLParameters>
				<SQLParameter id="461" parameterType="URL" variable="s_keyword" dataType="Memo" parameterSource="s_keyword"/>
<SQLParameter id="535" variable="parent_id" parameterType="URL" defaultValue="0" dataType="Float" parameterSource="parent_id"/>
</SQLParameters>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Grid>
		<Record id="3" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="None" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="p_work_programSearch" wizardCaption="Search P App Role " wizardOrientation="Vertical" wizardFormMethod="post" returnPage="p_work_program.ccp" PathID="p_work_programSearch" pasteActions="pasteActions">
			<Components>
				<Button id="4" urlType="Relative" enableValidation="True" isDefault="False" name="Button_DoSearch" operation="Search" wizardCaption="Search" PathID="p_work_programSearchButton_DoSearch">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<TextBox id="5" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="s_keyword" wizardCaption="Keyword" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" PathID="p_work_programSearchs_keyword">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Hidden id="317" fieldSourceType="DBColumn" dataType="Text" name="parent_id" wizardCaption="Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_work_programSearchparent_id">
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
		<Record id="94" sourceType="SQL" urlType="Relative" secured="False" allowInsert="True" allowUpdate="True" allowDelete="True" validateData="True" preserveParameters="GET" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" connection="ConnSIKP" name="p_work_programForm" errorSummator="Error" wizardCaption="Add/Edit V P App User " wizardFormMethod="post" PathID="p_work_programForm" activeCollection="ISQLParameters" pasteAsReplace="pasteAsReplace" pasteActions="pasteActions" customDelete="DELETE FROM p_work_program 
WHERE p_work_program_id = {p_work_program_id}" customDeleteType="SQL" parameterTypeListName="ParameterTypeList" customUpdateType="SQL" customInsertType="SQL" dataSource="SELECT a.p_work_program_id, a.code, a.program_name, a.is_detail, 
to_char(a.start_date,'DD-MON-YYYY')as start_date, to_char(a.end_date,'DD-MON-YYYY')as end_date, 
a.parent_id, a.description, to_char(a.creation_date,'DD-MON-YYYY')as creation_date, a.created_by,
to_char(a.updated_date,'DD-MON-YYYY')as updated_date, a.updated_by, a.kode_urusan_pemerintah,
b.organization_name as urusan_pemerintah
FROM p_work_program a
LEFT OUTER JOIN p_organization b on (a.kode_urusan_pemerintah = b.organization_code)
WHERE a.p_work_program_id = {p_work_program_id}" activeTableType="customUpdate" customInsert="INSERT INTO p_work_program(p_work_program_id, description, created_by, updated_by, creation_date, updated_date, code, is_detail, start_date, parent_id, program_name, kode_urusan_pemerintah, end_date) 
VALUES(generate_id('sikp','p_work_program','p_work_program_id'), '{description}', '{created_by}', '{updated_by}', sysdate, sysdate, '{code}', '{is_detail}', to_date('{start_date}','DD-MON-YYYY'), decode({parent_id},0,null,{parent_id}), '{program_name}', '{kode_urusan_pemerintah}', case when '{end_date}' = '' then null else to_date('{end_date}','DD-MON-YYYY') end)" customUpdate="UPDATE p_work_program SET  
description='{description}', 
updated_by='{updated_by}', 
updated_date=sysdate, 
code='{code}', 
is_detail='{is_detail}', 
start_date=to_date('{start_date}','DD-MON-YYYY'),  
program_name='{program_name}', 
kode_urusan_pemerintah='{kode_urusan_pemerintah}', 
end_date=case when '{end_date}'='' then null else to_date('{end_date}','DD-MON-YYYY') end 
WHERE p_work_program_id={p_work_program_id}">
			<Components>
				<Button id="95" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Insert" operation="Insert" wizardCaption="Add" PathID="p_work_programFormButton_Insert" removeParameters="FLAG">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="96" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Update" operation="Update" wizardCaption="Submit" PathID="p_work_programFormButton_Update" removeParameters="FLAG">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="97" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Delete" operation="Delete" wizardCaption="Delete" PathID="p_work_programFormButton_Delete" removeParameters="FLAG;p_work_program_id;s_keyword;p_work_programGridPage">
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
				<Button id="99" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Cancel" operation="Cancel" wizardCaption="Cancel" PathID="p_work_programFormButton_Cancel" removeParameters="FLAG;p_work_program_id;s_keyword;p_work_programGridPage">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Hidden id="101" fieldSourceType="DBColumn" dataType="Float" name="p_work_program_id" fieldSource="p_work_program_id" caption="Id" wizardCaption="P App User Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_work_programFormp_work_program_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<TextBox id="114" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="description" fieldSource="description" required="False" caption="Description" wizardCaption="Description" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_work_programFormdescription">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="124" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="created_by" fieldSource="created_by" required="False" caption="Created By" wizardCaption="Created By" wizardSize="16" wizardMaxLength="16" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_work_programFormcreated_by" defaultValue="CCGetUserLogin()">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="127" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="updated_by" fieldSource="updated_by" required="False" caption="Updated By" wizardCaption="Updated By" wizardSize="16" wizardMaxLength="16" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_work_programFormupdated_by" defaultValue="CCGetUserLogin()">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="122" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="creation_date" fieldSource="creation_date" required="False" caption="Creation Date" wizardCaption="Creation Date" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_work_programFormcreation_date" format="dd-mmm-yyyy" defaultValue="date(&quot;d-M-Y&quot;)">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="125" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="updated_date" fieldSource="updated_date" required="False" caption="Updated Date" wizardCaption="Updated Date" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_work_programFormupdated_date" defaultValue="date(&quot;d-M-Y&quot;)" format="dd-mmm-yyyy">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Hidden id="165" fieldSourceType="DBColumn" dataType="Text" name="p_work_programGridPage" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="p_work_programFormp_work_programGridPage">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<TextBox id="156" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="code" fieldSource="code" required="True" caption="Kode" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_work_programFormcode">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<ListBox id="140" visible="Yes" fieldSourceType="DBColumn" sourceType="ListOfValues" dataType="Text" returnValueType="Number" name="is_detail" wizardEmptyCaption="Select Value" PathID="p_work_programFormis_detail" fieldSource="is_detail" connection="ConnSIKP" _valueOfList="N" _nameOfList="TIDAK" dataSource="Y;YA;N;TIDAK" defaultValue="&quot;Y&quot;" caption="Detail?" required="True">
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
				<TextBox id="35" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="start_date" fieldSource="start_date" required="True" caption="Awal" wizardCaption="Valid From" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_work_programFormstart_date" format="dd-mmm-yyyy" defaultValue="date(&quot;d-M-Y&quot;)">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<DatePicker id="36" name="DatePicker_start_date" control="start_date" wizardSatellite="True" wizardControl="valid_from" wizardDatePickerType="Image" wizardPicture="../Styles/RWNet/Images/DatePicker.gif" style="Styles/sikp/Style.css" PathID="p_work_programFormDatePicker_start_date">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</DatePicker>
				<Hidden id="337" fieldSourceType="DBColumn" dataType="Float" name="parent_id" wizardCaption="Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_work_programFormparent_id" fieldSource="parent_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<TextBox id="477" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="program_name" fieldSource="program_name" required="True" caption="Nama Program" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_work_programFormprogram_name">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
<TextBox id="284" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="urusan_pemerintah" PathID="p_work_programFormurusan_pemerintah" fieldSource="urusan_pemerintah">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
<TextBox id="285" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="kode_urusan_pemerintah" PathID="p_work_programFormkode_urusan_pemerintah" fieldSource="kode_urusan_pemerintah">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
<TextBox id="37" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="end_date" fieldSource="end_date" required="False" caption="Akhir" wizardCaption="Valid To" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_work_programFormend_date" format="dd-mmm-yyyy">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
<DatePicker id="38" name="DatePicker_end_date" control="end_date" wizardSatellite="True" wizardControl="valid_to" wizardDatePickerType="Image" wizardPicture="../Styles/RWNet/Images/DatePicker.gif" style="Styles/sikp/Style.css" PathID="p_work_programFormDatePicker_end_date">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</DatePicker>
</Components>
			<Events/>
			<TableParameters>
			</TableParameters>
			<SPParameters/>
			<SQLParameters>
				<SQLParameter id="289" variable="p_work_program_id" parameterType="URL" defaultValue="0" dataType="Float" parameterSource="p_work_program_id"/>
			</SQLParameters>
			<JoinTables>
			</JoinTables>
			<JoinLinks/>
			<Fields>
				<Field id="288" fieldName="*"/>
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
				<SQLParameter id="493" variable="description" dataType="Text" parameterType="Control" parameterSource="description"/>
<SQLParameter id="494" variable="created_by" dataType="Text" parameterType="Expression" parameterSource="CCGetUserLogin()"/>
<SQLParameter id="495" variable="updated_by" dataType="Text" parameterType="Expression" parameterSource="CCGetUserLogin()"/>
<SQLParameter id="498" variable="code" dataType="Text" parameterType="Control" parameterSource="code"/>
<SQLParameter id="499" variable="is_detail" dataType="Text" parameterType="Control" parameterSource="is_detail"/>
<SQLParameter id="500" variable="start_date" dataType="Text" parameterType="Control" parameterSource="start_date" format="dd-mmm-yyyy"/>
<SQLParameter id="501" variable="parent_id" dataType="Float" parameterType="Control" parameterSource="parent_id" defaultValue="0"/>
<SQLParameter id="502" variable="program_name" dataType="Text" parameterType="Control" parameterSource="program_name"/>
<SQLParameter id="504" variable="kode_urusan_pemerintah" dataType="Text" parameterType="Control" parameterSource="kode_urusan_pemerintah"/>
<SQLParameter id="505" variable="end_date" dataType="Text" parameterType="Control" parameterSource="end_date" format="dd-mmm-yyyy"/>
</ISQLParameters>
			<IFormElements>
				<CustomParameter id="478" field="p_work_program_id" dataType="Float" parameterType="Control" parameterSource="p_work_program_id"/>
<CustomParameter id="479" field="description" dataType="Text" parameterType="Control" parameterSource="description"/>
<CustomParameter id="480" field="created_by" dataType="Text" parameterType="Control" parameterSource="created_by"/>
<CustomParameter id="481" field="updated_by" dataType="Text" parameterType="Control" parameterSource="updated_by"/>
<CustomParameter id="482" field="creation_date" dataType="Text" parameterType="Control" parameterSource="creation_date" format="dd-mmm-yyyy"/>
<CustomParameter id="483" field="updated_date" dataType="Text" parameterType="Control" parameterSource="updated_date" format="dd-mmm-yyyy"/>
<CustomParameter id="484" field="code" dataType="Text" parameterType="Control" parameterSource="code"/>
<CustomParameter id="485" field="is_detail" dataType="Text" parameterType="Control" parameterSource="is_detail"/>
<CustomParameter id="486" field="start_date" dataType="Text" parameterType="Control" parameterSource="start_date" format="dd-mmm-yyyy"/>
<CustomParameter id="487" field="parent_id" dataType="Float" parameterType="Control" parameterSource="parent_id"/>
<CustomParameter id="488" field="program_name" dataType="Text" parameterType="Control" parameterSource="program_name"/>
<CustomParameter id="489" field="urusan_pemerintah" dataType="Text" parameterType="Control" parameterSource="urusan_pemerintah"/>
<CustomParameter id="490" field="kode_urusan_pemerintah" dataType="Text" parameterType="Control" parameterSource="kode_urusan_pemerintah"/>
<CustomParameter id="491" field="end_date" dataType="Text" parameterType="Control" parameterSource="end_date" format="dd-mmm-yyyy"/>
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
				<SQLParameter id="520" variable="p_work_program_id" dataType="Float" parameterType="Control" parameterSource="p_work_program_id"/>
<SQLParameter id="521" variable="description" dataType="Text" parameterType="Control" parameterSource="description"/>
<SQLParameter id="523" variable="updated_by" dataType="Text" parameterType="Expression" parameterSource="CCGetUserLogin()"/>
<SQLParameter id="526" variable="code" dataType="Text" parameterType="Control" parameterSource="code"/>
<SQLParameter id="527" variable="is_detail" dataType="Text" parameterType="Control" parameterSource="is_detail"/>
<SQLParameter id="528" variable="start_date" dataType="Text" parameterType="Control" parameterSource="start_date" format="dd-mmm-yyyy"/>
<SQLParameter id="530" variable="program_name" dataType="Text" parameterType="Control" parameterSource="program_name"/>
<SQLParameter id="532" variable="kode_urusan_pemerintah" dataType="Text" parameterType="Control" parameterSource="kode_urusan_pemerintah"/>
<SQLParameter id="533" variable="end_date" dataType="Text" parameterType="Control" parameterSource="end_date" format="dd-mmm-yyyy"/>
</USQLParameters>
			<UConditions>
			</UConditions>
			<UFormElements>
				<CustomParameter id="506" field="p_work_program_id" dataType="Float" parameterType="Control" parameterSource="p_work_program_id"/>
<CustomParameter id="507" field="description" dataType="Text" parameterType="Control" parameterSource="description"/>
<CustomParameter id="508" field="created_by" dataType="Text" parameterType="Control" parameterSource="created_by"/>
<CustomParameter id="509" field="updated_by" dataType="Text" parameterType="Control" parameterSource="updated_by"/>
<CustomParameter id="510" field="creation_date" dataType="Text" parameterType="Control" parameterSource="creation_date" format="dd-mmm-yyyy"/>
<CustomParameter id="511" field="updated_date" dataType="Text" parameterType="Control" parameterSource="updated_date" format="dd-mmm-yyyy"/>
<CustomParameter id="512" field="code" dataType="Text" parameterType="Control" parameterSource="code"/>
<CustomParameter id="513" field="is_detail" dataType="Text" parameterType="Control" parameterSource="is_detail"/>
<CustomParameter id="514" field="start_date" dataType="Text" parameterType="Control" parameterSource="start_date" format="dd-mmm-yyyy"/>
<CustomParameter id="515" field="parent_id" dataType="Float" parameterType="Control" parameterSource="parent_id"/>
<CustomParameter id="516" field="program_name" dataType="Text" parameterType="Control" parameterSource="program_name"/>
<CustomParameter id="517" field="urusan_pemerintah" dataType="Text" parameterType="Control" parameterSource="urusan_pemerintah"/>
<CustomParameter id="518" field="kode_urusan_pemerintah" dataType="Text" parameterType="Control" parameterSource="kode_urusan_pemerintah"/>
<CustomParameter id="519" field="end_date" dataType="Text" parameterType="Control" parameterSource="end_date" format="dd-mmm-yyyy"/>
</UFormElements>
			<DSPParameters/>
			<DSQLParameters>
				<SQLParameter id="534" variable="p_work_program_id" parameterType="Control" defaultValue="0" dataType="Float" parameterSource="p_work_program_id"/>
</DSQLParameters>
			<DConditions>
			</DConditions>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Record>
	</Components>
	<CodeFiles>
		<CodeFile id="Events" language="PHPTemplates" name="p_work_program_events.php" forShow="False" comment="//" codePage="windows-1252"/>
		<CodeFile id="Code" language="PHPTemplates" name="p_work_program.php" forShow="True" url="p_work_program.php" comment="//" codePage="windows-1252"/>
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
