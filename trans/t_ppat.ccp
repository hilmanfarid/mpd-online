<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\trans" secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="CoffeeBreak" wizardThemeVersion="3.0" needGeneration="0">
	<Components>
		<Grid id="2" secured="False" sourceType="SQL" returnValueType="Number" defaultPageSize="5" connection="ConnSIKP" name="t_ppatGrid" pageSizeLimit="100" wizardCaption="List of P App Role " wizardGridType="Tabular" wizardAllowInsert="True" wizardAltRecord="True" wizardAltRecordType="Style" wizardRecordSeparator="False" wizardNoRecords="-" pasteAsReplace="pasteAsReplace" pasteActions="pasteActions" activeCollection="TableParameters" dataSource="SELECT t_ppat_id, ppat_name, identification_no, address_name,updated_by, 
to_char(updated_date,'DD-MON-YYYY') AS updated_date, email_address
FROM t_ppat
WHERE upper(identification_no) LIKE '%{s_keyword}%'
OR upper(ppat_name) LIKE '%{s_keyword}%' 
ORDER BY t_ppat_id" orderBy="p_vat_type_id">
			<Components>
				<Link id="11" visible="Yes" fieldSourceType="CodeExpression" html="True" hrefType="Page" urlType="Relative" preserveParameters="GET" name="DLink" wizardCaption="Detail" wizardSize="50" wizardMaxLength="60" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" dataType="Text" wizardDefaultValue="DLink" hrefSource="t_ppat.ccp" wizardThemeItem="GridA" PathID="t_ppatGridDLink" removeParameters="FLAG">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="219" sourceType="DataField" name="t_ppat_id" source="t_ppat_id"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
				<Label id="244" fieldSourceType="DBColumn" dataType="Text" html="False" name="ppat_name" fieldSource="ppat_name" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="t_ppatGridppat_name">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Hidden id="13" fieldSourceType="DBColumn" dataType="Float" html="False" name="t_ppat_id" fieldSource="t_ppat_id" wizardCaption="Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="t_ppatGridt_ppat_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Label id="17" fieldSourceType="DBColumn" dataType="Text" html="False" name="identification_no" fieldSource="identification_no" wizardCaption="Description" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="t_ppatGrididentification_no">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="19" fieldSourceType="DBColumn" dataType="Text" html="False" name="updated_by" fieldSource="updated_by" wizardCaption="Valid From" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="t_ppatGridupdated_by">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Link id="7" visible="Yes" fieldSourceType="DBColumn" dataType="Text" html="False" hrefType="Page" urlType="Relative" preserveParameters="GET" name="Insert_Link" hrefSource="t_ppat.ccp" removeParameters="t_ppat_id;s_keyword" wizardThemeItem="FooterA" wizardDefaultValue="Add New" wizardUseTemplateBlock="False" PathID="t_ppatGridInsert_Link">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="67" sourceType="Expression" name="FLAG" source="&quot;ADD&quot;"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
				<Navigator id="22" size="10" type="Centered" pageSizes="1;5;10;25;50" name="Navigator" wizardPagingType="Custom" wizardFirst="True" wizardFirstText="First" wizardPrev="True" wizardPrevText="Prev" wizardNext="True" wizardNextText="Next" wizardLast="True" wizardLastText="Last" wizardImages="Images" wizardPageNumbers="Centered" wizardSize="10" wizardTotalPages="False" wizardHideDisabled="False" wizardOfText="of" wizardPageSize="False" wizardUsePageScroller="True">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Navigator>
				<Label id="247" fieldSourceType="DBColumn" dataType="Text" html="False" name="address_name" fieldSource="address_name" wizardCaption="Description" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="t_ppatGridaddress_name">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="21" fieldSourceType="DBColumn" dataType="Text" html="False" name="updated_date" fieldSource="updated_date" wizardCaption="Valid To" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="t_ppatGridupdated_date">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<ImageLink id="364" visible="Yes" fieldSourceType="DBColumn" dataType="Text" hrefType="Page" urlType="Relative" preserveParameters="GET" name="ImageLink1" PathID="t_ppatGridImageLink1" hrefSource="t_ppat_user.ccp" removeParameters="s_keyword">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="365" sourceType="DataField" name="t_ppat_id" source="t_ppat_id"/>
						<LinkParameter id="366" sourceType="DataField" name="ppat_name" source="ppat_name"/>
						<LinkParameter id="367" sourceType="DataField" name="email_address" source="email_address"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</ImageLink>
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
				<TableParameter id="8" conditionType="Parameter" useIsNull="False" field="upper(code)" dataType="Text" logicOperator="Or" searchConditionType="Contains" parameterType="URL" orderNumber="1" leftBrackets="0" parameterSource="s_keyword"/>
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
		<Record id="3" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="None" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="t_ppatSearch" wizardCaption="Search P App Role " wizardOrientation="Vertical" wizardFormMethod="post" returnPage="t_ppat.ccp" PathID="t_ppatSearch">
			<Components>
				<Button id="4" urlType="Relative" enableValidation="True" isDefault="False" name="Button_DoSearch" operation="Search" wizardCaption="Search" PathID="t_ppatSearchButton_DoSearch">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<TextBox id="5" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="s_keyword" PathID="t_ppatSearchs_keyword">
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
		<Record id="23" sourceType="SQL" urlType="Relative" secured="False" allowInsert="True" allowUpdate="True" allowDelete="True" validateData="True" preserveParameters="GET" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" connection="ConnSIKP" name="t_ppatForm" errorSummator="Error" wizardCaption="Add/Edit P App Role " wizardFormMethod="post" PathID="t_ppatForm" customDeleteType="SQL" activeCollection="ISQLParameters" customUpdateType="SQL" parameterTypeListName="ParameterTypeList" pasteAsReplace="pasteAsReplace" pasteActions="pasteActions" customInsert="INSERT INTO t_ppat(creation_date, created_by, 
updated_date, updated_by, t_ppat_id, 
phone_no, ppat_name, address_name, address_no, 
address_rt, address_rw, p_region_id, 
p_region_id_kec, p_region_id_kel, identification_no, 
personal_identification_id, mobile_no, 
fax_no, zip_code, email_address) 
VALUES('{creation_date}', '{created_by}', 
'{updated_date}', '{updated_by}', 
generate_id('sikp','t_ppat','t_ppat_id'), 
'{phone_no}', '{ppat_name}', '{address_name}', 
'{address_no}', '{address_rt}', '{address_rw}', 
{p_region_id}, {p_region_id_kec}, 
{p_region_id_kel}, '{identification_no}', 
'{personal_identification_id}', '{mobile_no}', 
'{fax_no}', '{zip_code}', '{email_address}')" customInsertType="SQL" customUpdate="UPDATE t_ppat SET  
phone_no='{phone_no}', 
creation_date='{creation_date}', 
created_by='{created_by}', 
updated_date='{updated_date}', 
updated_by='{updated_by}', 
ppat_name='{ppat_name}', 
address_name='{address_name}', 
address_no='{address_no}', 
address_rt='{address_rt}', 
address_rw='{address_rw}', 
p_region_id={p_region_id}, 
p_region_id_kec={p_region_id_kec}, 
p_region_id_kel={p_region_id_kel}, 
identification_no='{identification_no}', 
personal_identification_id='{personal_identification_id}', 
mobile_no='{mobile_no}', 
fax_no='{fax_no}', 
zip_code='{zip_code}', 
email_address='{email_address}' 
WHERE  t_ppat_id = {t_ppat_id}" customDelete="DELETE FROM t_ppat WHERE  t_ppat_id = {t_ppat_id}" dataSource="SELECT a.*,
b.region_name as kota,
c.region_name as kecamatan,
d.region_name as kelurahan,
to_char(a.creation_date,'DD-MON-YYYY')as creation_date, 
to_char(a.updated_date,'DD-MON-YYYY')as updated_date
FROM t_ppat a
left join p_region as b
	on a.p_region_id = b.p_region_id
left join p_region as c
	on a.p_region_id_kec = c.p_region_id
left join p_region as d
	on a.p_region_id_kel = d.p_region_id
WHERE t_ppat_id = {t_ppat_id} " activeTableType="customDelete">
			<Components>
				<Button id="24" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Insert" operation="Insert" wizardCaption="Add" PathID="t_ppatFormButton_Insert" removeParameters="FLAG">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="25" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Update" operation="Update" wizardCaption="Submit" PathID="t_ppatFormButton_Update" removeParameters="FLAG">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="26" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Delete" operation="Delete" wizardCaption="Delete" PathID="t_ppatFormButton_Delete" removeParameters="FLAG;p_simple_parameter_type_id;p_simple_parameter_typeGridPage;s_keyword">
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
				<Button id="28" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Cancel" operation="Cancel" wizardCaption="Cancel" PathID="t_ppatFormButton_Cancel" removeParameters="FLAG;p_simple_parameter_type_id;p_simple_parameter_typeGridPage;s_keyword">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Hidden id="30" fieldSourceType="DBColumn" dataType="Float" name="t_ppat_id" fieldSource="p_simple_parameter_type_id" required="False" caption="Id" wizardCaption="Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_ppatFormt_ppat_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<TextBox id="37" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="phone_no" fieldSource="phone_no" required="False" caption="Description" wizardCaption="Description" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_ppatFormphone_no">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="38" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="creation_date" fieldSource="creation_date" required="False" caption="Creation Date" wizardCaption="Creation Date" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_ppatFormcreation_date" format="dd-mmm-yyyy" defaultValue="date(&quot;d-M-Y&quot;)">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="40" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="created_by" fieldSource="created_by" required="False" caption="Created By" wizardCaption="Created By" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_ppatFormcreated_by" defaultValue="CCGetUserLogin()">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="41" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="updated_date" fieldSource="updated_date" required="False" caption="Updated Date" wizardCaption="Updated Date" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_ppatFormupdated_date" format="dd-mmm-yyyy" defaultValue="date(&quot;d-M-Y&quot;)">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="43" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="updated_by" fieldSource="updated_by" required="False" caption="Updated By" wizardCaption="Updated By" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_ppatFormupdated_by" defaultValue="CCGetUserLogin()">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="243" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="ppat_name" fieldSource="ppat_name" required="True" caption="Kode" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_ppatFormppat_name">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="248" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="address_name" fieldSource="address_name" required="True" caption="Kode" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_ppatFormaddress_name">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="249" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="address_no" fieldSource="address_no" required="True" caption="Kode" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_ppatFormaddress_no">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="250" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="address_rt" fieldSource="address_rt" required="False" caption="Description" wizardCaption="Description" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_ppatFormaddress_rt">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="251" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="address_rw" fieldSource="address_rw" required="False" caption="Description" wizardCaption="Description" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_ppatFormaddress_rw">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="252" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="kota" fieldSource="kota" required="True" caption="Kota/Kabupaten - WP" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_ppatFormkota" defaultValue="'KOTA BANDUNG'">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Hidden id="254" fieldSourceType="DBColumn" dataType="Float" name="p_region_id" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_ppatFormp_region_id" fieldSource="p_region_id" caption="Kota/Kabupaten - WP" defaultValue="749" required="True">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<TextBox id="258" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="kecamatan" caption="Kecamatan - WP" fieldSource="kecamatan" required="True" PathID="t_ppatFormkecamatan">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Hidden id="260" fieldSourceType="DBColumn" dataType="Float" name="p_region_id_kec" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_ppatFormp_region_id_kec" fieldSource="p_region_id_kec" caption="Kecamatan - WP" required="True">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<TextBox id="261" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="kelurahan" fieldSource="kelurahan" required="True" caption="Kelurahan - WP" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_ppatFormkelurahan">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Hidden id="263" fieldSourceType="DBColumn" dataType="Float" name="p_region_id_kel" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_ppatFormp_region_id_kel" fieldSource="p_region_id_kel" caption="Kelurahan - WP" required="True">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<TextBox id="264" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="identification_no" fieldSource="identification_no" required="True" caption="Kode" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_ppatFormidentification_no">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<ListBox id="268" visible="Yes" fieldSourceType="DBColumn" sourceType="SQL" dataType="Text" returnValueType="Number" name="personal_identification_id" wizardEmptyCaption="Select Value" PathID="t_ppatFormpersonal_identification_id" fieldSource="personal_identification_id" connection="ConnSIKP" dataSource="select p_simple_parameter_list_id,code from p_simple_parameter_list where p_simple_parameter_type_id = 1">
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
				<TextBox id="269" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="mobile_no" fieldSource="mobile_no" required="False" caption="Description" wizardCaption="Description" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_ppatFormmobile_no">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="270" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="fax_no" fieldSource="fax_no" required="False" caption="Description" wizardCaption="Description" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_ppatFormfax_no">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="271" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="zip_code" required="False" caption="Description" wizardCaption="Description" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_ppatFormzip_code" fieldSource="zip_code">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="272" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="email_address" fieldSource="email_address" required="False" caption="Description" wizardCaption="Description" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_ppatFormemail_address">
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
				<SQLParameter id="182" parameterType="URL" variable="t_ppat_id" dataType="Float" parameterSource="t_ppat_id" defaultValue="0"/>
			</SQLParameters>
			<JoinTables>
			</JoinTables>
			<JoinLinks/>
			<Fields>
			</Fields>
			<ISPParameters/>
			<ISQLParameters>
				<SQLParameter id="197" variable="created_by" dataType="Text" parameterType="Control" parameterSource="created_by"/>
				<SQLParameter id="199" variable="updated_by" dataType="Text" parameterType="Control" parameterSource="updated_by"/>
				<SQLParameter id="293" variable="creation_date" dataType="Text" parameterType="Control" parameterSource="creation_date" format="dd-mmm-yyyy"/>
				<SQLParameter id="294" variable="updated_date" dataType="Text" parameterType="Control" parameterSource="updated_date" format="dd-mmm-yyyy"/>
				<SQLParameter id="295" variable="t_ppat_id" dataType="Float" parameterType="Control" parameterSource="t_ppat_id"/>
				<SQLParameter id="296" variable="phone_no" dataType="Text" parameterType="Control" parameterSource="phone_no"/>
				<SQLParameter id="297" variable="ppat_name" dataType="Text" parameterType="Control" parameterSource="ppat_name"/>
				<SQLParameter id="298" variable="address_name" dataType="Text" parameterType="Control" parameterSource="address_name"/>
				<SQLParameter id="299" variable="address_no" dataType="Text" parameterType="Control" parameterSource="address_no"/>
				<SQLParameter id="300" variable="address_rt" dataType="Text" parameterType="Control" parameterSource="address_rt"/>
				<SQLParameter id="301" variable="address_rw" dataType="Text" parameterType="Control" parameterSource="address_rw"/>
				<SQLParameter id="303" variable="p_region_id" dataType="Float" parameterType="Control" parameterSource="p_region_id"/>
				<SQLParameter id="305" variable="p_region_id_kec" dataType="Float" parameterType="Control" parameterSource="p_region_id_kec"/>
				<SQLParameter id="307" variable="p_region_id_kel" dataType="Float" parameterType="Control" parameterSource="p_region_id_kel"/>
				<SQLParameter id="308" variable="identification_no" dataType="Text" parameterType="Control" parameterSource="identification_no"/>
				<SQLParameter id="309" variable="personal_identification_id" dataType="Text" parameterType="Control" parameterSource="personal_identification_id"/>
				<SQLParameter id="310" variable="mobile_no" dataType="Text" parameterType="Control" parameterSource="mobile_no"/>
				<SQLParameter id="311" variable="fax_no" dataType="Text" parameterType="Control" parameterSource="fax_no"/>
				<SQLParameter id="312" variable="zip_code" dataType="Text" parameterType="Control" parameterSource="zip_code"/>
				<SQLParameter id="313" variable="email_address" dataType="Text" parameterType="Control" parameterSource="email_address"/>
			</ISQLParameters>
			<IFormElements>
				<CustomParameter id="231" field="creation_date" dataType="Text" parameterType="Control" parameterSource="creation_date" format="dd-mmm-yyyy" omitIfEmpty="True"/>
				<CustomParameter id="232" field="created_by" dataType="Text" parameterType="Control" parameterSource="created_by" omitIfEmpty="True"/>
				<CustomParameter id="233" field="updated_date" dataType="Text" parameterType="Control" parameterSource="updated_date" format="dd-mmm-yyyy" omitIfEmpty="True"/>
				<CustomParameter id="234" field="updated_by" dataType="Text" parameterType="Control" parameterSource="updated_by" omitIfEmpty="True"/>
				<CustomParameter id="273" field="t_ppat_id" dataType="Float" parameterType="Control" parameterSource="t_ppat_id" omitIfEmpty="True"/>
				<CustomParameter id="274" field="phone_no" dataType="Text" parameterType="Control" parameterSource="phone_no" omitIfEmpty="True"/>
				<CustomParameter id="275" field="ppat_name" dataType="Text" parameterType="Control" parameterSource="ppat_name" omitIfEmpty="True"/>
				<CustomParameter id="276" field="address_name" dataType="Text" parameterType="Control" parameterSource="address_name" omitIfEmpty="True"/>
				<CustomParameter id="277" field="address_no" dataType="Text" parameterType="Control" parameterSource="address_no" omitIfEmpty="True"/>
				<CustomParameter id="278" field="address_rt" dataType="Text" parameterType="Control" parameterSource="address_rt" omitIfEmpty="True"/>
				<CustomParameter id="279" field="address_rw" dataType="Text" parameterType="Control" parameterSource="address_rw" omitIfEmpty="True"/>
				<CustomParameter id="280" field="kota" dataType="Text" parameterType="Control" parameterSource="kota" omitIfEmpty="True"/>
				<CustomParameter id="281" field="p_region_id" dataType="Float" parameterType="Control" parameterSource="p_region_id" omitIfEmpty="True"/>
				<CustomParameter id="282" field="kecamatan" dataType="Text" parameterType="Control" parameterSource="kecamatan" omitIfEmpty="True"/>
				<CustomParameter id="283" field="p_region_id_kec" dataType="Float" parameterType="Control" parameterSource="p_region_id_kec" omitIfEmpty="True"/>
				<CustomParameter id="284" field="kelurahan" dataType="Text" parameterType="Control" parameterSource="kelurahan" omitIfEmpty="True"/>
				<CustomParameter id="285" field="wp_p_region_id_kel" dataType="Float" parameterType="Control" parameterSource="p_region_id_kel" omitIfEmpty="True"/>
				<CustomParameter id="286" field="identification_no" dataType="Text" parameterType="Control" parameterSource="identification_no" omitIfEmpty="True"/>
				<CustomParameter id="287" field="personal_identification_id" dataType="Text" parameterType="Control" parameterSource="personal_identification_id" omitIfEmpty="True"/>
				<CustomParameter id="288" field="mobile_no" dataType="Text" parameterType="Control" parameterSource="mobile_no" omitIfEmpty="True"/>
				<CustomParameter id="289" field="fax_no" dataType="Text" parameterType="Control" parameterSource="fax_no" omitIfEmpty="True"/>
				<CustomParameter id="290" field="zip_code" dataType="Text" parameterType="Control" parameterSource="zip_code" omitIfEmpty="True"/>
				<CustomParameter id="291" field="email_address" dataType="Text" parameterType="Control" parameterSource="email_address" omitIfEmpty="True"/>
			</IFormElements>
			<USPParameters/>
			<USQLParameters>
				<SQLParameter id="215" variable="updated_by" dataType="Text" parameterType="Control" parameterSource="updated_by"/>
				<SQLParameter id="338" variable="t_ppat_id" dataType="Float" parameterType="URL" parameterSource="t_ppat_id" defaultValue="0"/>
				<SQLParameter id="339" variable="phone_no" dataType="Text" parameterType="Control" parameterSource="phone_no"/>
				<SQLParameter id="340" variable="creation_date" dataType="Text" parameterType="Control" parameterSource="creation_date" format="dd-mmm-yyyy"/>
				<SQLParameter id="341" variable="created_by" dataType="Text" parameterType="Control" parameterSource="created_by"/>
				<SQLParameter id="342" variable="updated_date" dataType="Text" parameterType="Control" parameterSource="updated_date" format="dd-mmm-yyyy"/>
				<SQLParameter id="343" variable="ppat_name" dataType="Text" parameterType="Control" parameterSource="ppat_name"/>
				<SQLParameter id="344" variable="address_name" dataType="Text" parameterType="Control" parameterSource="address_name"/>
				<SQLParameter id="345" variable="address_no" dataType="Text" parameterType="Control" parameterSource="address_no"/>
				<SQLParameter id="346" variable="address_rt" dataType="Text" parameterType="Control" parameterSource="address_rt"/>
				<SQLParameter id="347" variable="address_rw" dataType="Text" parameterType="Control" parameterSource="address_rw"/>
				<SQLParameter id="349" variable="p_region_id" dataType="Float" parameterType="Control" parameterSource="p_region_id"/>
				<SQLParameter id="351" variable="p_region_id_kec" dataType="Float" parameterType="Control" parameterSource="p_region_id_kec"/>
				<SQLParameter id="353" variable="p_region_id_kel" dataType="Float" parameterType="Control" parameterSource="p_region_id_kel"/>
				<SQLParameter id="354" variable="identification_no" dataType="Text" parameterType="Control" parameterSource="identification_no"/>
				<SQLParameter id="355" variable="personal_identification_id" dataType="Text" parameterType="Control" parameterSource="personal_identification_id"/>
				<SQLParameter id="356" variable="mobile_no" dataType="Text" parameterType="Control" parameterSource="mobile_no"/>
				<SQLParameter id="357" variable="fax_no" dataType="Text" parameterType="Control" parameterSource="fax_no"/>
				<SQLParameter id="358" variable="zip_code" dataType="Text" parameterType="Control" parameterSource="zip_code"/>
				<SQLParameter id="359" variable="email_address" dataType="Text" parameterType="Control" parameterSource="email_address"/>
			</USQLParameters>
			<UConditions>
				<TableParameter id="337" conditionType="Parameter" useIsNull="False" field="t_ppat_id" dataType="Float" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="t_ppat_id"/>
			</UConditions>
			<UFormElements>
				<CustomParameter id="314" field="t_ppat_id" dataType="Float" parameterType="Control" parameterSource="t_ppat_id" omitIfEmpty="True"/>
				<CustomParameter id="315" field="phone_no" dataType="Text" parameterType="Control" parameterSource="phone_no" omitIfEmpty="True"/>
				<CustomParameter id="316" field="creation_date" dataType="Text" parameterType="Control" parameterSource="creation_date" format="dd-mmm-yyyy" omitIfEmpty="True"/>
				<CustomParameter id="317" field="created_by" dataType="Text" parameterType="Control" parameterSource="created_by" omitIfEmpty="True"/>
				<CustomParameter id="318" field="updated_date" dataType="Text" parameterType="Control" parameterSource="updated_date" format="dd-mmm-yyyy" omitIfEmpty="True"/>
				<CustomParameter id="319" field="updated_by" dataType="Text" parameterType="Control" parameterSource="updated_by" omitIfEmpty="True"/>
				<CustomParameter id="320" field="ppat_name" dataType="Text" parameterType="Control" parameterSource="ppat_name" omitIfEmpty="True"/>
				<CustomParameter id="321" field="address_name" dataType="Text" parameterType="Control" parameterSource="address_name" omitIfEmpty="True"/>
				<CustomParameter id="322" field="address_no" dataType="Text" parameterType="Control" parameterSource="address_no" omitIfEmpty="True"/>
				<CustomParameter id="323" field="address_rt" dataType="Text" parameterType="Control" parameterSource="address_rt" omitIfEmpty="True"/>
				<CustomParameter id="324" field="address_rw" dataType="Text" parameterType="Control" parameterSource="address_rw" omitIfEmpty="True"/>
				<CustomParameter id="326" field="p_region_id" dataType="Float" parameterType="Control" parameterSource="p_region_id" omitIfEmpty="True"/>
				<CustomParameter id="328" field="p_region_id_kec" dataType="Float" parameterType="Control" parameterSource="p_region_id_kec" omitIfEmpty="True"/>
				<CustomParameter id="330" field="wp_p_region_id_kel" dataType="Float" parameterType="Control" parameterSource="p_region_id_kel" omitIfEmpty="True"/>
				<CustomParameter id="331" field="identification_no" dataType="Text" parameterType="Control" parameterSource="identification_no" omitIfEmpty="True"/>
				<CustomParameter id="332" field="personal_identification_id" dataType="Text" parameterType="Control" parameterSource="personal_identification_id" omitIfEmpty="True"/>
				<CustomParameter id="333" field="mobile_no" dataType="Text" parameterType="Control" parameterSource="mobile_no" omitIfEmpty="True"/>
				<CustomParameter id="334" field="fax_no" dataType="Text" parameterType="Control" parameterSource="fax_no" omitIfEmpty="True"/>
				<CustomParameter id="335" field="zip_code" dataType="Text" parameterType="Control" parameterSource="zip_code" omitIfEmpty="True"/>
				<CustomParameter id="336" field="email_address" dataType="Text" parameterType="Control" parameterSource="email_address" omitIfEmpty="True"/>
			</UFormElements>
			<DSPParameters/>
			<DSQLParameters>
				<SQLParameter id="361" variable="t_ppat_id" parameterType="URL" dataType="Float" parameterSource="t_ppat_id" defaultValue="0"/>
			</DSQLParameters>
			<DConditions>
				<TableParameter id="360" conditionType="Parameter" useIsNull="False" field="t_ppat_id" dataType="Float" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="t_ppat_id"/>
			</DConditions>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Record>
	</Components>
	<CodeFiles>
		<CodeFile id="Events" language="PHPTemplates" name="t_ppat_events.php" forShow="False" comment="//" codePage="windows-1252"/>
		<CodeFile id="Code" language="PHPTemplates" name="t_ppat.php" forShow="True" url="t_ppat.php" comment="//" codePage="windows-1252"/>
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
