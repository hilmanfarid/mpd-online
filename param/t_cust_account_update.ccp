<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\param" secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="RWNet" wizardThemeVersion="3.0" needGeneration="0" pasteActions="pasteActions">
	<Components>
		<Grid id="2" secured="False" sourceType="SQL" returnValueType="Number" defaultPageSize="5" connection="ConnSIKP" name="t_custAccountGrid" pageSizeLimit="100" wizardCaption="List of P App Role " wizardGridType="Tabular" wizardAllowInsert="True" wizardAltRecord="True" wizardAltRecordType="Style" wizardRecordSeparator="False" wizardNoRecords="-" pasteAsReplace="pasteAsReplace" pasteActions="pasteActions" activeCollection="SQLParameters" parameterTypeListName="ParameterTypeList" dataSource="SELECT a.t_cust_account_id, a.t_customer_id, a.npwd, a.p_vat_type_id, a.t_vat_registration_id, a.t_customer_order_id,
a.registration_date, a.company_name, a.company_brand, a.address_name, a.address_no, a.address_rt, a.address_rw, a.p_region_id_kelurahan, a.p_region_id_kecamatan, a.p_region_id, a.phone_no, a.mobile_no, a.fax_no, a.zip_code, a.creation_date, a.created_by, a.updated_date, a.updated_by,
b.vat_code,
c.registration_date AS vat_registration_date,
d.order_no, d. order_date,
e.region_name AS nama_kota,
f.region_name AS nama_kecamatan,
g.region_name AS nama_kelurahan

FROM t_cust_account a
LEFT JOIN p_vat_type b ON a.p_vat_type_id = b.p_vat_type_id
LEFT JOIN t_vat_registration c ON a.t_vat_registration_id = c.t_vat_registration_id
LEFT JOIN t_customer_order d ON a.t_customer_order_id = d.t_customer_order_id
LEFT JOIN p_region e ON a.p_region_id = e.p_region_id
LEFT JOIN p_region f ON a.p_region_id_kecamatan = f.p_region_id
LEFT JOIN p_region g ON a.p_region_id_kelurahan = g.p_region_id


WHERE (upper(a.company_name) ILIKE '%{s_keyword}%' OR upper(a.npwd) ILIKE '%{s_keyword}%')
AND a.t_customer_id = {t_customer_id}

ORDER BY a.t_cust_account_id">
			<Components>
				<Link id="11" visible="Yes" fieldSourceType="CodeExpression" html="True" hrefType="Page" urlType="Relative" preserveParameters="GET" name="DLink" wizardCaption="Detail" wizardSize="50" wizardMaxLength="60" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" dataType="Text" wizardDefaultValue="DLink" hrefSource="t_cust_account_update.ccp" wizardThemeItem="GridA" PathID="t_custAccountGridDLink" removeParameters="FLAG">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="479" sourceType="DataField" name="t_cust_account_id" source="t_cust_account_id"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
				<Label id="15" fieldSourceType="DBColumn" dataType="Text" html="False" name="npwd" fieldSource="npwd" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="t_custAccountGridnpwd">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="19" fieldSourceType="DBColumn" dataType="Text" html="False" name="registration_date" fieldSource="registration_date" wizardCaption="Valid From" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="t_custAccountGridregistration_date">
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
				<Hidden id="459" fieldSourceType="DBColumn" dataType="Text" name="t_cust_account_id" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_custAccountGridt_cust_account_id" fieldSource="t_cust_account_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Label id="478" visible="Yes" fieldSourceType="CodeExpression" dataType="Text" name="customer_name" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_custAccountGridcustomer_name" html="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="318" fieldSourceType="DBColumn" dataType="Text" html="False" name="vat_code" fieldSource="vat_code" wizardCaption="Valid From" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="t_custAccountGridvat_code">
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
				<SQLParameter id="476" variable="t_customer_id" parameterType="URL" defaultValue="0" dataType="Integer" parameterSource="t_customer_id"/>
			</SQLParameters>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Grid>
		<Record id="94" sourceType="SQL" urlType="Relative" secured="False" allowInsert="False" allowUpdate="True" allowDelete="False" validateData="True" preserveParameters="GET" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" connection="ConnSIKP" name="t_cust_account_updateForm" errorSummator="Error" wizardCaption="Add/Edit V P App User " wizardFormMethod="post" PathID="t_cust_account_updateForm" activeCollection="USQLParameters" pasteAsReplace="pasteAsReplace" pasteActions="pasteActions" parameterTypeListName="ParameterTypeList" dataSource="SELECT * FROM v_cust_account_update
WHERE t_cust_account_id = {t_cust_account_id}
AND t_customer_id = {t_customer_id}
" activeTableType="customUpdate" customUpdateType="SQL" customUpdate="UPDATE t_cust_account
   SET 
       npwd='{npwd}', 
       p_account_status_id={p_account_status_id},
       activation_no='{activation_no}',
       p_vat_type_id={p_vat_type_id}, 
       registration_date='{registration_date}', 
       company_name='{company_name}', 
       company_brand='{company_brand}', 
       address_name='{address_name}', 
       address_no='{address_no}', 
       address_rt='{address_rt}', 
       address_rw='{address_rw}', 
       p_region_id_kelurahan={p_region_id_kelurahan}, 
       p_region_id_kecamatan={p_region_id_kecamatan}, 
       p_region_id={p_region_id}, 
       phone_no='{phone_no}', 
       mobile_no='{mobile_no}', 
       fax_no='{fax_no}', 
       zip_code='{zip_code}', 
       updated_date=sysdate, 
       updated_by='{updated_by}',
       wp_name='{wp_name}', 
       wp_address_name='{wp_address_name}', 
       wp_address_no='{wp_address_no}', 
       wp_address_rt='{wp_address_rt}', 
       wp_address_rw='{wp_address_rw}', 
       wp_p_region_id_kelurahan={wp_p_region_id_kelurahan}, 
       wp_p_region_id_kecamatan={wp_p_region_id_kecamatan}, 
       wp_p_region_id={wp_p_region_id}, 
       wp_phone_no='{wp_phone_no}', 
       wp_mobile_no='{wp_mobile_no}', 
       wp_fax_no='{wp_fax_no}', 
       wp_zip_code='{wp_zip_code}', 
       wp_email='{wp_email}', 
       brand_address_name='{brand_address_name}', 
       brand_address_no='{brand_address_no}', 
       brand_address_rt='{brand_address_rt}', 
       brand_address_rw='{brand_address_rw}', 
       brand_p_region_id_kel={brand_p_region_id_kel}, 
       brand_p_region_id_kec={brand_p_region_id_kec}, 
       brand_p_region_id={brand_p_region_id}, 
       brand_phone_no='{brand_phone_no}', 
       brand_mobile_no='{brand_mobile_no}', 
       brand_fax_no='{brand_fax_no}', 
       brand_zip_code='{brand_zip_code}',
       p_vat_type_dtl_id={p_vat_type_dtl_id} 
WHERE t_cust_account_id={t_cust_account_id}">
			<Components>
				<Hidden id="474" fieldSourceType="DBColumn" dataType="Text" name="t_cust_account_id" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_cust_account_updateFormt_cust_account_id" fieldSource="t_cust_account_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Button id="25" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Update" operation="Update" wizardCaption="Submit" PathID="t_cust_account_updateFormButton_Update" removeParameters="FLAG">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="124" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Cancel" operation="Cancel" wizardCaption="Cancel" PathID="t_cust_account_updateFormButton_Cancel" removeParameters="p_region_id;s_keyword;FLAG;p_regionGridPage">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Hidden id="125" fieldSourceType="DBColumn" dataType="Float" name="p_cust_account_id" fieldSource="t_cust_account_id" required="False" caption="Id" wizardCaption="Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_cust_account_updateFormp_cust_account_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="204" fieldSourceType="DBColumn" dataType="Text" name="p_custGridPage" wizardCaption="Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_cust_account_updateFormp_custGridPage">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="495" fieldSourceType="DBColumn" dataType="Text" name="p_region_id" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_cust_account_updateFormp_region_id" fieldSource="p_region_id" defaultValue="749">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="496" fieldSourceType="DBColumn" dataType="Text" name="p_region_id_kecamatan" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_cust_account_updateFormp_region_id_kecamatan" fieldSource="p_region_id_kecamatan">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="497" fieldSourceType="DBColumn" dataType="Text" name="p_region_id_kelurahan" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_cust_account_updateFormp_region_id_kelurahan" fieldSource="p_region_id_kelurahan">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="499" fieldSourceType="DBColumn" dataType="Text" name="updated_by" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_cust_account_updateFormupdated_by" defaultValue="CCGetUserLogin()" fieldSource="updated_by">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<TextBox id="37" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="company_name" fieldSource="company_name" required="True" caption="Nama Perusahaan" wizardCaption="Description" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_cust_account_updateFormcompany_name">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="525" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="company_brand" fieldSource="company_brand" required="True" caption="Company Brand" wizardCaption="Description" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_cust_account_updateFormcompany_brand">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="526" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="npwd" fieldSource="npwd" required="True" caption="NPWD" wizardCaption="Description" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_cust_account_updateFormnpwd">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="527" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="vat_code" fieldSource="vat_code" required="True" caption="Jenis Pajak" wizardCaption="Description" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_cust_account_updateFormvat_code">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="528" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="registration_date" fieldSource="registration_date" required="True" caption="Tgl Registrasi" wizardCaption="Description" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_cust_account_updateFormregistration_date">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="531" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="nama_kota" fieldSource="nama_kota" required="True" caption="Kota" wizardCaption="Description" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_cust_account_updateFormnama_kota" defaultValue="'KOTA BANDUNG'">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="532" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="nama_kecamatan" fieldSource="nama_kecamatan" required="True" caption="Kecamatan" wizardCaption="Description" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_cust_account_updateFormnama_kecamatan">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="533" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="nama_kelurahan" fieldSource="nama_kelurahan" required="True" caption="Kelurahan" wizardCaption="Description" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_cust_account_updateFormnama_kelurahan">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="534" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="address_rt" fieldSource="address_rt" required="False" caption="Description" wizardCaption="Description" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_cust_account_updateFormaddress_rt">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="535" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="address_rw" fieldSource="address_rw" required="False" caption="Description" wizardCaption="Description" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_cust_account_updateFormaddress_rw">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="536" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="zip_code" fieldSource="zip_code" required="False" caption="Description" wizardCaption="Description" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_cust_account_updateFormzip_code">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="537" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="phone_no" fieldSource="phone_no" required="False" caption="Description" wizardCaption="Description" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_cust_account_updateFormphone_no">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Hidden id="540" fieldSourceType="DBColumn" dataType="Text" name="p_vat_type_id" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_cust_account_updateFormp_vat_type_id" fieldSource="p_vat_type_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<TextBox id="530" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="address_no" fieldSource="address_no" required="True" caption="No" wizardCaption="Description" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_cust_account_updateFormaddress_no">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextArea id="543" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="address_name" fieldSource="address_name" required="True" caption="Alamat" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_cust_account_updateFormaddress_name">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextArea>
				<TextArea id="544" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="brand_address_name" fieldSource="brand_address_name" required="True" caption="Alamat" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_cust_account_updateFormbrand_address_name">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextArea>
				<TextBox id="545" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="brand_address_no" fieldSource="brand_address_no" required="True" caption="No - Usaha" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_cust_account_updateFormbrand_address_no">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="548" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="brand_kota" fieldSource="brand_kota" required="True" caption="Kota/Kabupaten - Usaha" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_cust_account_updateFormbrand_kota" defaultValue="'KOTA BANDUNG'">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="549" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="brand_kecamatan" fieldSource="brand_kecamatan" required="True" caption="Kecamatan - Usaha" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_cust_account_updateFormbrand_kecamatan">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="550" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="brand_kelurahan" fieldSource="brand_kelurahan" required="True" caption="Kelurahan - Usaha" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_cust_account_updateFormbrand_kelurahan">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Hidden id="551" fieldSourceType="DBColumn" dataType="Float" name="brand_p_region_id" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_cust_account_updateFormbrand_p_region_id" fieldSource="brand_p_region_id" caption="Kota/Kabupaten - Usaha" defaultValue="749" required="True">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="552" fieldSourceType="DBColumn" dataType="Float" name="brand_p_region_id_kel" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_cust_account_updateFormbrand_p_region_id_kel" fieldSource="brand_p_region_id_kel" caption="Kelurahan - Usaha" required="True">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="553" fieldSourceType="DBColumn" dataType="Float" name="brand_p_region_id_kec" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_cust_account_updateFormbrand_p_region_id_kec" fieldSource="brand_p_region_id_kec" caption="Kecamatan - Usaha" required="True">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<TextBox id="554" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="brand_phone_no" fieldSource="brand_phone_no" required="False" caption="No. Telephon - Usaha" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_cust_account_updateFormbrand_phone_no">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="555" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="brand_mobile_no" fieldSource="brand_mobile_no" caption="No. Selular - Usaha" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_cust_account_updateFormbrand_mobile_no" required="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="556" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="brand_fax_no" fieldSource="brand_fax_no" required="False" caption="No. Fax - Usaha" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_cust_account_updateFormbrand_fax_no">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="557" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="brand_zip_code" fieldSource="brand_zip_code" required="False" caption="Kode Pos - Usaha" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_cust_account_updateFormbrand_zip_code">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="558" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="wp_name" fieldSource="wp_name" required="True" caption="Nama Wajib Pajak" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_cust_account_updateFormwp_name">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextArea id="559" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="wp_address_name" fieldSource="wp_address_name" required="True" caption="Alamat Wajib Pajak" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_cust_account_updateFormwp_address_name">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextArea>
				<TextBox id="560" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="wp_address_no" fieldSource="wp_address_no" required="True" caption="No - WP" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_cust_account_updateFormwp_address_no">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="561" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="wp_kota" fieldSource="wp_kota" required="True" caption="Kota/Kabupaten - WP" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_cust_account_updateFormwp_kota" defaultValue="'KOTA BANDUNG'">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="562" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="wp_kecamatan" fieldSource="wp_kecamatan" required="True" caption="Kecamatan - WP" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_cust_account_updateFormwp_kecamatan">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="563" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="wp_kelurahan" fieldSource="wp_kelurahan" required="True" caption="Kelurahan - WP" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_cust_account_updateFormwp_kelurahan">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="564" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="wp_phone_no" fieldSource="wp_phone_no" required="False" caption="No. Telephon - WP" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_cust_account_updateFormwp_phone_no">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="565" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="wp_email" fieldSource="wp_email" required="False" caption="Email - WP" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_cust_account_updateFormwp_email" inputMask="^[\w\.-]{1,}\@([\da-zA-Z-]{1,}\.){1,}[\da-zA-Z-]+$">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="566" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="wp_fax_no" fieldSource="wp_fax_no" required="False" caption="No. Fax - WP" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_cust_account_updateFormwp_fax_no">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="567" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="wp_zip_code" fieldSource="wp_zip_code" required="False" caption="Kode Pos - WP" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_cust_account_updateFormwp_zip_code">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Hidden id="568" fieldSourceType="DBColumn" dataType="Float" name="wp_p_region_id_kelurahan" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_cust_account_updateFormwp_p_region_id_kelurahan" fieldSource="wp_p_region_id_kelurahan" caption="Kelurahan - WP" required="True">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="569" fieldSourceType="DBColumn" dataType="Float" name="wp_p_region_id_kecamatan" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_cust_account_updateFormwp_p_region_id_kecamatan" fieldSource="wp_p_region_id_kecamatan" caption="Kecamatan - WP" required="True">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="570" fieldSourceType="DBColumn" dataType="Float" name="wp_p_region_id" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_cust_account_updateFormwp_p_region_id" fieldSource="wp_p_region_id" caption="Kota/Kabupaten - WP" defaultValue="749" required="True">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<TextBox id="571" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="wp_address_rt" fieldSource="wp_address_rt" required="False" caption="Rt - WP" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_cust_account_updateFormwp_address_rt">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="573" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="wp_mobile_no" fieldSource="wp_mobile_no" caption="No. Selular - WP" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_cust_account_updateFormwp_mobile_no" required="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="538" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="fax_no" fieldSource="fax_no" required="False" caption="Description" wizardCaption="Description" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_cust_account_updateFormfax_no">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="539" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="mobile_no" fieldSource="mobile_no" required="False" caption="Description" wizardCaption="Description" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_cust_account_updateFormmobile_no">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="574" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="wp_address_rw" fieldSource="wp_address_rw" required="False" caption="Rw - WP" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_cust_account_updateFormwp_address_rw">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="599" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="brand_address_rt" fieldSource="brand_address_rt" required="False" caption="Rt - Usaha" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_cust_account_updateFormbrand_address_rt">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="600" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="brand_address_rw" fieldSource="brand_address_rw" required="False" caption="Rw - Usaha" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_cust_account_updateFormbrand_address_rw">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="601" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="active_date" fieldSource="active_date" required="True" caption="Tgl Pengukuhan" wizardCaption="Description" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_cust_account_updateFormactive_date">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="602" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="last_satatus_date" fieldSource="last_satatus_date" required="True" caption="Tgl Pengukuhan" wizardCaption="Description" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_cust_account_updateFormlast_satatus_date">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="603" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="activation_no" fieldSource="activation_no" required="True" caption="No Pengukuhan" wizardCaption="Description" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_cust_account_updateFormactivation_no">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="605" visible="Yes" fieldSourceType="DBColumn" sourceType="Table" dataType="Text" returnValueType="Number" name="status_code" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" wizardEmptyCaption="Select Value" PathID="t_cust_account_updateFormstatus_code" fieldSource="status_code" connection="ConnSIKP" dataSource="p_account_status" orderBy="p_account_status_id" boundColumn="p_account_status_id" textColumn="code" required="True" html="False">
					<Components/>
					<Events/>
					<TableParameters/>
					<SPParameters/>
					<SQLParameters/>
					<JoinTables>
						<JoinTable id="606" tableName="p_account_status" posLeft="10" posTop="10" posWidth="154" posHeight="168"/>
					</JoinTables>
					<JoinLinks/>
					<Fields/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="621" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="nama_ayat" fieldSource="nama_ayat" required="True" caption="Nama Ayat" wizardCaption="Description" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_cust_account_updateFormnama_ayat">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Hidden id="622" fieldSourceType="DBColumn" dataType="Text" name="p_vat_type_dtl_id" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_cust_account_updateFormp_vat_type_dtl_id" fieldSource="p_vat_type_dtl_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Button id="623" urlType="Relative" enableValidation="True" isDefault="False" name="Button1" PathID="t_cust_account_updateFormButton1">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Hidden id="624" fieldSourceType="DBColumn" dataType="Text" name="p_account_status_id" PathID="t_cust_account_updateFormp_account_status_id" fieldSource="p_account_status_id">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Hidden>
</Components>
			<Events>
				<Event name="BeforeSelect" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="618"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
			</TableParameters>
			<SPParameters/>
			<SQLParameters>
				<SQLParameter id="289" variable="t_customer_id" parameterType="URL" defaultValue="0" dataType="Integer" parameterSource="t_customer_id"/>
				<SQLParameter id="477" variable="t_cust_account_id" parameterType="URL" defaultValue="0" dataType="Integer" parameterSource="t_cust_account_id"/>
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
				<SQLParameter id="501" variable="p_vat_type_id" parameterType="Control" dataType="Float" parameterSource="p_vat_type_id" defaultValue="0"/>
				<SQLParameter id="506" variable="registration_date" parameterType="Control" dataType="Text" parameterSource="registration_date"/>
				<SQLParameter id="507" variable="company_name" parameterType="Control" dataType="Text" parameterSource="company_name"/>
				<SQLParameter id="508" variable="company_brand" parameterType="Control" dataType="Text" parameterSource="company_brand"/>
				<SQLParameter id="509" variable="address_no" parameterType="Control" dataType="Text" parameterSource="address_no"/>
				<SQLParameter id="510" variable="address_name" parameterType="Control" dataType="Text" parameterSource="address_name"/>
				<SQLParameter id="511" variable="address_rt" parameterType="Control" dataType="Text" parameterSource="address_rt"/>
				<SQLParameter id="512" variable="address_rw" parameterType="Control" dataType="Text" parameterSource="address_rw"/>
				<SQLParameter id="513" variable="p_region_id_kelurahan" parameterType="Control" dataType="Text" parameterSource="p_region_id_kelurahan"/>
				<SQLParameter id="514" variable="p_region_id_kecamatan" parameterType="Control" dataType="Text" parameterSource="p_region_id_kecamatan"/>
				<SQLParameter id="515" variable="p_region_id" parameterType="Control" dataType="Text" parameterSource="p_region_id"/>
				<SQLParameter id="516" variable="phone_no" parameterType="Control" dataType="Text" parameterSource="phone_no"/>
				<SQLParameter id="517" variable="mobile_no" parameterType="Control" dataType="Text" parameterSource="mobile_no"/>
				<SQLParameter id="518" variable="fax_no" parameterType="Control" dataType="Text" parameterSource="fax_no"/>
				<SQLParameter id="519" variable="zip_code" parameterType="Control" dataType="Text" parameterSource="zip_code"/>
				<SQLParameter id="520" variable="updated_by" parameterType="Control" dataType="Text" parameterSource="updated_by"/>

				<SQLParameter id="521" variable="t_cust_account_id" parameterType="Control" dataType="Text" parameterSource="t_cust_account_id"/>
				<SQLParameter id="524" variable="npwd" parameterType="Control" dataType="Text" parameterSource="npwd"/>
				<SQLParameter id="575" variable="wp_name" parameterType="Control" dataType="Text" parameterSource="wp_name"/>
				<SQLParameter id="576" variable="wp_address_name" parameterType="Control" dataType="Text" parameterSource="wp_address_name"/>
				<SQLParameter id="577" variable="wp_address_no" parameterType="Control" dataType="Text" parameterSource="wp_address_no"/>
				<SQLParameter id="578" variable="wp_address_rt" parameterType="Control" dataType="Text" parameterSource="wp_address_rt"/>
				<SQLParameter id="579" variable="wp_address_rw" parameterType="Control" dataType="Text" parameterSource="wp_address_rw"/>
				<SQLParameter id="580" variable="wp_p_region_id_kelurahan" parameterType="Control" defaultValue="0" dataType="Float" parameterSource="wp_p_region_id_kelurahan"/>
				<SQLParameter id="581" variable="wp_p_region_id_kecamatan" parameterType="Control" defaultValue="0" dataType="Float" parameterSource="wp_p_region_id_kecamatan"/>
				<SQLParameter id="582" variable="wp_p_region_id" parameterType="Control" defaultValue="0" dataType="Float" parameterSource="wp_p_region_id"/>
				<SQLParameter id="583" variable="wp_phone_no" parameterType="Control" dataType="Text" parameterSource="wp_phone_no"/>
				<SQLParameter id="584" variable="wp_mobile_no" parameterType="Control" dataType="Text" parameterSource="wp_mobile_no"/>
				<SQLParameter id="585" variable="wp_fax_no" parameterType="Control" dataType="Text" parameterSource="wp_fax_no"/>
				<SQLParameter id="586" variable="wp_zip_code" parameterType="Control" dataType="Text" parameterSource="wp_zip_code"/>
				<SQLParameter id="587" variable="wp_email" parameterType="Control" dataType="Text" parameterSource="wp_email"/>
				<SQLParameter id="588" variable="brand_address_name" parameterType="Control" dataType="Text" parameterSource="brand_address_name"/>
				<SQLParameter id="589" variable="brand_address_no" parameterType="Control" dataType="Text" parameterSource="brand_address_no"/>
				<SQLParameter id="590" variable="brand_address_rt" parameterType="Control" dataType="Text" parameterSource="brand_address_rt"/>
				<SQLParameter id="591" variable="brand_address_rw" parameterType="Control" dataType="Text" parameterSource="brand_address_rw"/>
				<SQLParameter id="592" variable="brand_p_region_id_kel" parameterType="Control" defaultValue="0" dataType="Float" parameterSource="brand_p_region_id_kel"/>
				<SQLParameter id="593" variable="brand_p_region_id_kec" parameterType="Control" defaultValue="0" dataType="Float" parameterSource="brand_p_region_id_kec"/>
				<SQLParameter id="594" variable="brand_p_region_id" parameterType="Control" defaultValue="0" dataType="Float" parameterSource="brand_p_region_id"/>
				<SQLParameter id="595" variable="brand_phone_no" parameterType="Control" dataType="Text" parameterSource="brand_phone_no"/>
				<SQLParameter id="596" variable="brand_mobile_no" parameterType="Control" dataType="Text" parameterSource="brand_mobile_no"/>
				<SQLParameter id="597" variable="brand_fax_no" parameterType="Control" dataType="Text" parameterSource="brand_fax_no"/>
				<SQLParameter id="598" variable="brand_zip_code" parameterType="Control" dataType="Text" parameterSource="brand_zip_code"/>
				<SQLParameter id="607" variable="p_account_status_id" parameterType="Control" defaultValue="0" dataType="Float" parameterSource="p_account_status_id"/>
				<SQLParameter id="608" variable="activation_no" parameterType="Control" dataType="Text" parameterSource="activation_no"/>
				<SQLParameter id="620" variable="p_vat_type_dtl_id" parameterType="Control" defaultValue="0" dataType="Float" parameterSource="p_vat_type_dtl_id"/>
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
				<SQLParameter id="505" variable="t_cust_account_id" parameterType="Control" defaultValue="0" dataType="Float" parameterSource="t_cust_account_id"/>
			</DSQLParameters>
			<DConditions>
			</DConditions>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Record>
		<Record id="3" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="None" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="p_cust_account_updateSearch" wizardCaption="Search P App Role " wizardOrientation="Vertical" wizardFormMethod="post" returnPage="t_customer.ccp" PathID="p_cust_account_updateSearch" pasteActions="pasteActions">
			<Components>
				<Button id="4" urlType="Relative" enableValidation="True" isDefault="False" name="Button_DoSearch" operation="Search" wizardCaption="Search" PathID="p_cust_account_updateSearchButton_DoSearch">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<TextBox id="5" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="s_keyword" wizardCaption="Keyword" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" PathID="p_cust_account_updateSearchs_keyword">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Hidden id="541" fieldSourceType="DBColumn" dataType="Float" name="t_customer_id" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="p_cust_account_updateSearcht_customer_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="542" fieldSourceType="DBColumn" dataType="Text" name="customer_name" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="p_cust_account_updateSearchcustomer_name">
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
	</Components>
	<CodeFiles>
		<CodeFile id="Events" language="PHPTemplates" name="t_cust_account_update_events.php" forShow="False" comment="//" codePage="windows-1252"/>
		<CodeFile id="Code" language="PHPTemplates" name="t_cust_account_update.php" forShow="True" url="t_cust_account_update.php" comment="//" codePage="windows-1252"/>
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
