<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\param" secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="RWNet" wizardThemeVersion="3.0" needGeneration="0">
	<Components>
		<Grid id="2" secured="False" sourceType="SQL" returnValueType="Number" defaultPageSize="5" connection="ConnSIKP" name="t_customerGrid" pageSizeLimit="100" wizardCaption="List of P App Role " wizardGridType="Tabular" wizardAllowInsert="True" wizardAltRecord="True" wizardAltRecordType="Style" wizardRecordSeparator="False" wizardNoRecords="-" pasteAsReplace="pasteAsReplace" pasteActions="pasteActions" activeCollection="SQLParameters" parameterTypeListName="ParameterTypeList" dataSource="select *
from t_customer a 
where (upper(a.company_owner) like upper('%{s_keyword}%') 
       or upper(a.address_name_owner) like upper('%{s_keyword}%')
       )
       and exists (select 1 from t_cust_account x
                   where x.t_customer_id = a.t_customer_id 
                        and upper(x.npwd) like upper('%{s_npwd}%')
                        and upper(x.wp_name) like upper('%{s_wp_name}%')
                        and upper(x.company_name) like upper('%{s_company_name}%')
                        and upper(x.company_brand) like upper('%{s_company_brand}%')
                  )">
			<Components>
				<Link id="11" visible="Yes" fieldSourceType="CodeExpression" html="True" hrefType="Page" urlType="Relative" preserveParameters="GET" name="DLink" wizardCaption="Detail" wizardSize="50" wizardMaxLength="60" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" dataType="Text" wizardDefaultValue="DLink" hrefSource="t_customer.ccp" wizardThemeItem="GridA" PathID="t_customerGridDLink" removeParameters="FLAG">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="458" sourceType="DataField" name="t_customer_id" source="t_customer_id"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
				<Label id="15" fieldSourceType="DBColumn" dataType="Text" html="False" name="company_owner" fieldSource="company_owner" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="t_customerGridcompany_owner">
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
				<Label id="318" fieldSourceType="DBColumn" dataType="Text" html="False" name="email_address" fieldSource="email_address" wizardCaption="Valid From" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="t_customerGridemail_address">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Hidden id="459" fieldSourceType="DBColumn" dataType="Text" name="t_customer_id" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_customerGridt_customer_id" fieldSource="t_customer_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<ImageLink id="106" visible="Yes" fieldSourceType="DBColumn" dataType="Text" hrefType="Page" urlType="Relative" preserveParameters="GET" name="ImageLink1" PathID="t_customerGridImageLink1" hrefSource="t_cust_account.ccp" removeParameters="s_keyword">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="476" sourceType="DataField" name="t_customer_id" source="t_customer_id"/>
						<LinkParameter id="477" sourceType="DataField" name="customer_name" source="company_owner"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</ImageLink>
				<Label id="482" fieldSourceType="DBColumn" dataType="Text" html="False" name="mobile_no_owner" fieldSource="mobile_no_owner" wizardCaption="Valid From" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="t_customerGridmobile_no_owner">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="487" fieldSourceType="DBColumn" dataType="Text" html="False" name="address_name_owner" fieldSource="address_name_owner" wizardCaption="Valid From" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="t_customerGridaddress_name_owner">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="488" fieldSourceType="DBColumn" dataType="Text" html="False" name="address_no_owner" fieldSource="address_no_owner" wizardCaption="Valid From" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="t_customerGridaddress_no_owner">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="489" fieldSourceType="DBColumn" dataType="Text" html="False" name="address_rt_owner" fieldSource="address_rt_owner" wizardCaption="Valid From" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="t_customerGridaddress_rt_owner">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="490" fieldSourceType="DBColumn" dataType="Text" html="False" name="address_rw_owner" fieldSource="address_rw_owner" wizardCaption="Valid From" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="t_customerGridaddress_rw_owner">
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
			</TableParameters>
			<JoinTables>
			</JoinTables>
			<JoinLinks/>
			<Fields>
				<Field id="457" fieldName="*"/>
			</Fields>
			<SPParameters/>
			<SQLParameters>
				<SQLParameter id="335" variable="s_keyword" parameterType="URL" dataType="Text" parameterSource="s_keyword"/>
				<SQLParameter id="483" variable="s_npwd" parameterType="URL" dataType="Text" parameterSource="s_npwd"/>
				<SQLParameter id="484" variable="s_wp_name" parameterType="URL" dataType="Text" parameterSource="s_wp_name"/>
				<SQLParameter id="485" variable="s_company_name" parameterType="URL" dataType="Text" parameterSource="s_company_name"/>
				<SQLParameter id="486" variable="s_company_brand" parameterType="URL" dataType="Text" parameterSource="s_company_brand"/>
			</SQLParameters>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Grid>
		<Record id="3" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="None" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="t_customerSearch" wizardCaption="Search P App Role " wizardOrientation="Vertical" wizardFormMethod="post" returnPage="t_customer.ccp" PathID="t_customerSearch" pasteActions="pasteActions">
			<Components>
				<TextBox id="478" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="s_npwd" wizardCaption="Keyword" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" PathID="t_customerSearchs_npwd">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="479" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="s_wp_name" wizardCaption="Keyword" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" PathID="t_customerSearchs_wp_name">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="480" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="s_company_name" wizardCaption="Keyword" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" PathID="t_customerSearchs_company_name">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="5" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="s_keyword" wizardCaption="Keyword" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" PathID="t_customerSearchs_keyword">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="481" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="s_company_brand" wizardCaption="Keyword" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" PathID="t_customerSearchs_company_brand">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Button id="4" urlType="Relative" enableValidation="True" isDefault="False" name="Button_DoSearch" operation="Search" wizardCaption="Search" PathID="t_customerSearchButton_DoSearch">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
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
		<Record id="94" sourceType="SQL" urlType="Relative" secured="False" allowInsert="False" allowUpdate="True" allowDelete="False" validateData="True" preserveParameters="GET" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" connection="ConnSIKP" name="t_customer_updateForm" errorSummator="Error" wizardCaption="Add/Edit V P App User " wizardFormMethod="post" PathID="t_customer_updateForm" activeCollection="USQLParameters" pasteAsReplace="pasteAsReplace" pasteActions="pasteActions" parameterTypeListName="ParameterTypeList" dataSource="SELECT a.t_customer_id, a.company_owner, a.p_job_position_id, 
a.address_name_owner, a.address_no_owner, a.address_rt_owner, a.address_rw_owner,
a.p_region_id_kel_owner, a.p_region_id_kec_owner, a.p_region_id_owner, a.phone_no_owner, a.mobile_no_owner,
a.fax_no_owner, a.zip_code_owner, a.email_address, a.creation_date, a.created_by, a.updated_date, a.updated_by,
b.code AS nama_jabatan,
c.region_name AS nama_kota,
d.region_name AS nama_kecamatan,
e.region_name AS nama_kelurahan,
(a.address_name_owner || '. NO ' || a.address_no_owner || '. ' || c.region_name || '. ' || d.region_name || '. ' || e.region_name || '. ' || 'RT ' || a.address_rt_owner || '/ RW ' || a.address_rw_owner ) AS alamat_lengkap

FROM t_customer a
LEFT JOIN  p_job_position b ON a.p_job_position_id = b.p_job_position_id
LEFT JOIN p_region c ON a.p_region_id_owner = c.p_region_id
LEFT JOIN p_region d ON a.p_region_id_kec_owner = d.p_region_id
LEFT JOIN p_region e ON a.p_region_id_kel_owner = e.p_region_id


WHERE a.t_customer_id = {t_customer_id}" activeTableType="customUpdate" customUpdateType="SQL" customUpdate="UPDATE t_customer
SET 
company_owner = '{company_owner}',
p_job_position_id = '{p_job_position_id}', 
address_name_owner = '{address_name_owner}',
address_no_owner = '{address_no_owner}',
address_rt_owner = '{address_rt_owner}',
address_rw_owner = '{address_rw_owner}',
p_region_id_kel_owner = {p_region_id_kel_owner},
p_region_id_kec_owner = {p_region_id_kec_owner},
p_region_id_owner = {p_region_id_owner},
phone_no_owner = '{phone_no_owner}',
mobile_no_owner = '{mobile_no_owner}',
fax_no_owner = '{fax_no_owner}',
zip_code_owner = '{zip_code_owner}',
email_address = '{email_address}',
updated_date = sysdate, 
updated_by = '{updated_by}'
WHERE t_customer_id = {t_customer_id}">
			<Components>
				<Hidden id="474" fieldSourceType="DBColumn" dataType="Text" name="t_customer_id" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_customer_updateFormt_customer_id" fieldSource="t_customer_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<TextBox id="37" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="nama_jabatan" fieldSource="nama_jabatan" required="True" caption="Jabatan" wizardCaption="Description" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_customer_updateFormnama_jabatan">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="491" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="nama_kota" fieldSource="nama_kota" required="True" caption="Kota" wizardCaption="Description" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_customer_updateFormnama_kota">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="492" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="nama_kecamatan" fieldSource="nama_kecamatan" required="True" caption="Description" wizardCaption="Description" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_customer_updateFormnama_kecamatan">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="493" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="nama_kelurahan" fieldSource="nama_kelurahan" required="True" caption="Description" wizardCaption="Description" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_customer_updateFormnama_kelurahan">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="494" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="address_rt_owner" fieldSource="address_rt_owner" required="False" caption="Description" wizardCaption="Description" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_customer_updateFormaddress_rt_owner">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="495" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="address_rw_owner" fieldSource="address_rw_owner" required="False" caption="Description" wizardCaption="Description" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_customer_updateFormaddress_rw_owner">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="496" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="zip_code_owner" fieldSource="zip_code_owner" required="False" caption="Description" wizardCaption="Description" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_customer_updateFormzip_code_owner">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="497" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="phone_no_owner" fieldSource="phone_no_owner" required="False" caption="Description" wizardCaption="Description" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_customer_updateFormphone_no_owner">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="498" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="mobile_no_owner" fieldSource="mobile_no_owner" required="True" caption="Description" wizardCaption="Description" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_customer_updateFormmobile_no_owner">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="499" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="email_address" fieldSource="email_address" required="False" caption="Description" wizardCaption="Description" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_customer_updateFormemail_address" inputMask="^[\w\.-]{1,}\@([\da-zA-Z-]{1,}\.){1,}[\da-zA-Z-]+$">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextArea id="500" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="address_name_owner" fieldSource="address_name_owner" required="True" caption="Alamat" wizardCaption="Description" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_customer_updateFormaddress_name_owner">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextArea>
				<TextBox id="501" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="company_owner" fieldSource="company_owner" required="True" caption="Nama Perusahaan" wizardCaption="Description" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_customer_updateFormcompany_owner">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Button id="28" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Cancel" operation="Cancel" wizardCaption="Cancel" PathID="t_customer_updateFormButton_Cancel" removeParameters="FLAG;p_customer_id;p_customerGridPage;s_keyword">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="25" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Update" operation="Update" wizardCaption="Submit" PathID="t_customer_updateFormButton_Update" removeParameters="FLAG">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Hidden id="502" fieldSourceType="DBColumn" dataType="Text" name="updated_by" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_customer_updateFormupdated_by" fieldSource="updated_by" defaultValue="CCGetUserLogin()">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="503" fieldSourceType="DBColumn" dataType="Text" name="p_job_position_id" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_customer_updateFormp_job_position_id" fieldSource="p_job_position_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="504" fieldSourceType="DBColumn" dataType="Text" name="p_region_id_kel_owner" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_customer_updateFormp_region_id_kel_owner" fieldSource="p_region_id_kel_owner">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="505" fieldSourceType="DBColumn" dataType="Text" name="p_region_id_kec_owner" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_customer_updateFormp_region_id_kec_owner" fieldSource="p_region_id_kec_owner">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="506" fieldSourceType="DBColumn" dataType="Text" name="p_region_id_owner" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_customer_updateFormp_region_id_owner" fieldSource="p_region_id_owner">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<TextBox id="507" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="fax_no_owner" fieldSource="fax_no_owner" required="False" caption="Description" wizardCaption="Description" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_customer_updateFormfax_no_owner">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="508" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="address_no_owner" fieldSource="address_no_owner" required="True" caption="No" wizardCaption="Description" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_customer_updateFormaddress_no_owner">
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
				<SQLParameter id="289" variable="t_customer_id" parameterType="URL" defaultValue="0" dataType="Float" parameterSource="t_customer_id"/>
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
				<SQLParameter id="425" variable="description" dataType="Text" parameterType="Control" parameterSource="description"/>
				<SQLParameter id="426" variable="created_by" dataType="Text" parameterType="Expression" parameterSource="CCGetUserLogin()"/>
				<SQLParameter id="427" variable="updated_by" dataType="Text" parameterType="Expression" parameterSource="CCGetUserLogin()"/>
				<SQLParameter id="430" variable="code" dataType="Text" parameterType="Control" parameterSource="code"/>
				<SQLParameter id="431" variable="is_head" dataType="Text" parameterType="Control" parameterSource="is_head"/>
				<SQLParameter id="432" variable="valid_from" dataType="Text" parameterType="Control" parameterSource="valid_from"/>
				<SQLParameter id="433" variable="valid_to" dataType="Text" parameterType="Control" parameterSource="valid_to"/>
				<SQLParameter id="434" variable="parent_id" dataType="Float" parameterType="Control" parameterSource="parent_id" defaultValue="0"/>
			</ISQLParameters>
			<IFormElements>
				<CustomParameter id="413" field="p_job_position_id" dataType="Float" parameterType="Control" parameterSource="p_job_position_id"/>
				<CustomParameter id="414" field="description" dataType="Text" parameterType="Control" parameterSource="description"/>
				<CustomParameter id="415" field="created_by" dataType="Text" parameterType="Control" parameterSource="created_by"/>
				<CustomParameter id="416" field="updated_by" dataType="Text" parameterType="Control" parameterSource="updated_by"/>
				<CustomParameter id="417" field="creation_date" dataType="Text" parameterType="Control" parameterSource="creation_date" format="dd-mmm-yyyy"/>
				<CustomParameter id="418" field="updated_date" dataType="Text" parameterType="Control" parameterSource="updated_date" format="dd-mmm-yyyy"/>
				<CustomParameter id="419" field="code" dataType="Text" parameterType="Control" parameterSource="code"/>
				<CustomParameter id="420" field="is_head" dataType="Text" parameterType="Control" parameterSource="is_head"/>
				<CustomParameter id="421" field="valid_from" dataType="Text" parameterType="Control" parameterSource="valid_from" format="dd-mmm-yyyy"/>
				<CustomParameter id="422" field="valid_to" dataType="Text" parameterType="Control" parameterSource="valid_to" format="dd-mmm-yyyy"/>
				<CustomParameter id="423" field="parent_id" dataType="Text" parameterType="Control" parameterSource="parent_id"/>
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
				<SQLParameter id="449" variable="updated_by" dataType="Text" parameterType="Expression" parameterSource="CCGetUserLogin()"/>
				<SQLParameter id="456" variable="p_job_position_id" parameterType="Control" dataType="Float" parameterSource="p_job_position_id" defaultValue="0"/>
				<SQLParameter id="509" variable="t_customer_id" parameterType="Control" dataType="Float" parameterSource="t_customer_id" defaultValue="0"/>
				<SQLParameter id="510" variable="company_owner" parameterType="Control" dataType="Text" parameterSource="company_owner"/>
				<SQLParameter id="511" variable="address_name_owner" parameterType="Control" dataType="Text" parameterSource="address_name_owner"/>
				<SQLParameter id="512" variable="address_no_owner" parameterType="Control" dataType="Text" parameterSource="address_no_owner"/>
				<SQLParameter id="513" variable="address_rt_owner" parameterType="Control" dataType="Text" parameterSource="address_rt_owner"/>
				<SQLParameter id="514" variable="address_rw_owner" parameterType="Control" dataType="Text" parameterSource="address_rw_owner"/>
				<SQLParameter id="515" variable="p_region_id_kel_owner" parameterType="Control" defaultValue="0" dataType="Float" parameterSource="p_region_id_kel_owner"/>
				<SQLParameter id="516" variable="p_region_id_kec_owner" parameterType="Control" defaultValue="0" dataType="Float" parameterSource="p_region_id_kec_owner"/>
				<SQLParameter id="517" variable="p_region_id_owner" parameterType="Control" defaultValue="0" dataType="Float" parameterSource="p_region_id_owner"/>
				<SQLParameter id="518" variable="phone_no_owner" parameterType="Control" dataType="Text" parameterSource="phone_no_owner"/>
				<SQLParameter id="519" variable="mobile_no_owner" parameterType="Control" dataType="Text" parameterSource="mobile_no_owner"/>
				<SQLParameter id="520" variable="fax_no_owner" parameterType="Control" dataType="Text" parameterSource="fax_no_owner"/>
				<SQLParameter id="521" variable="zip_code_owner" parameterType="Control" dataType="Text" parameterSource="zip_code_owner"/>
				<SQLParameter id="522" variable="email_address" parameterType="Control" dataType="Text" parameterSource="email_address"/>
			</USQLParameters>
			<UConditions>
				<TableParameter id="446" conditionType="Parameter" useIsNull="False" field="p_job_position_id" dataType="Float" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="p_job_position_id"/>
			</UConditions>
			<UFormElements>
				<CustomParameter id="436" field="description" dataType="Text" parameterType="Control" parameterSource="description"/>
				<CustomParameter id="437" field="created_by" dataType="Text" parameterType="Control" parameterSource="created_by"/>
				<CustomParameter id="438" field="updated_by" dataType="Text" parameterType="Control" parameterSource="updated_by"/>
				<CustomParameter id="439" field="creation_date" dataType="Text" parameterType="Control" parameterSource="creation_date" format="dd-mmm-yyyy"/>
				<CustomParameter id="440" field="updated_date" dataType="Text" parameterType="Control" parameterSource="updated_date" format="dd-mmm-yyyy"/>
				<CustomParameter id="441" field="code" dataType="Text" parameterType="Control" parameterSource="code"/>
				<CustomParameter id="442" field="is_head" dataType="Text" parameterType="Control" parameterSource="is_head"/>
				<CustomParameter id="443" field="valid_from" dataType="Text" parameterType="Control" parameterSource="valid_from" format="dd-mmm-yyyy"/>
				<CustomParameter id="444" field="valid_to" dataType="Text" parameterType="Control" parameterSource="valid_to" format="dd-mmm-yyyy"/>
			</UFormElements>
			<DSPParameters/>
			<DSQLParameters>
				<SQLParameter id="412" variable="p_job_position_id" parameterType="Control" dataType="Float" parameterSource="p_job_position_id" defaultValue="0"/>
			</DSQLParameters>
			<DConditions>
			</DConditions>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Record>
	</Components>
	<CodeFiles>
		<CodeFile id="Events" language="PHPTemplates" name="t_customer_events.php" forShow="False" comment="//" codePage="windows-1252"/>
		<CodeFile id="Code" language="PHPTemplates" name="t_customer.php" forShow="True" url="t_customer.php" comment="//" codePage="windows-1252"/>
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
