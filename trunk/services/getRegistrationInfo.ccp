<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\services" secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="True" cachingEnabled="False" cachingDuration="1 minutes" needGeneration="0">
	<Components>
		<Grid id="2" secured="False" sourceType="SQL" returnValueType="Number" defaultPageSize="10" connection="ConnSIKP" activeCollection="SQLParameters" parameterTypeListName="ParameterTypeList" dataSource="SELECT * 
FROM v_vat_registration
WHERE t_customer_order_id ={t_customer_order_id}" name="f_SELECT_FROM_v_vat_regis" pageSizeLimit="100" wizardCaption="List of 

 SELECT * 
 FROM V Vat Registration
 WHERE T Customer Order Id ={t Customer Order Id}

 " wizardAllowInsert="False" pasteActions="pasteActions">
			<Components>
				<TextBox id="460" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="order_no" fieldSource="order_no" required="True" caption="Nomor Order" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="getRegistrationInfof_SELECT_FROM_v_vat_regisorder_no">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
<Hidden id="101" fieldSourceType="DBColumn" dataType="Float" name="t_customer_order_id" fieldSource="t_customer_order_id" caption="Id" wizardCaption="P App User Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="getRegistrationInfof_SELECT_FROM_v_vat_regist_customer_order_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
<Hidden id="824" fieldSourceType="DBColumn" dataType="Float" name="p_rqst_type_id" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="getRegistrationInfof_SELECT_FROM_v_vat_regisp_rqst_type_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
<Hidden id="653" fieldSourceType="DBColumn" dataType="Float" name="t_vat_registration_id1" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="getRegistrationInfof_SELECT_FROM_v_vat_regist_vat_registration_id1" fieldSource="t_vat_registration_id" caption="t_vat_registration_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
<TextBox id="33" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="registration_date" fieldSource="registration_date" required="True" caption="Tanggal Pendaftaran" wizardCaption="Valid From" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="getRegistrationInfof_SELECT_FROM_v_vat_regisregistration_date" defaultValue="date(&quot;d-M-Y h:i:s&quot;)" format="dd-mmm-yyyy H:nn:ss">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
<Hidden id="787" fieldSourceType="DBColumn" dataType="Text" html="False" name="rqst_type_code" wizardCaption="Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="getRegistrationInfof_SELECT_FROM_v_vat_regisrqst_type_code">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
<ListBox id="904" visible="Yes" fieldSourceType="DBColumn" sourceType="SQL" dataType="Float" returnValueType="Number" name="p_vat_type_dtl_id" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" wizardEmptyCaption="Select Value" PathID="getRegistrationInfof_SELECT_FROM_v_vat_regisp_vat_type_dtl_id" fieldSource="p_vat_type_dtl_id" caption="Nama Ayat" connection="ConnSIKP" activeCollection="SQLParameters" parameterTypeListName="ParameterTypeList" dataSource="select * from v_p_vat_type_dtl_rqst_type
where p_rqst_type_id = {p_rqst_type_id}" boundColumn="p_vat_type_dtl_id" textColumn="nama_ayat" required="True">
					<Components/>
					<Events/>
					<TableParameters/>
					<SPParameters/>
					<SQLParameters>
						<SQLParameter id="905" variable="p_rqst_type_id" parameterType="URL" defaultValue="0" dataType="Float" parameterSource="p_rqst_type_id"/>
					</SQLParameters>
					<JoinTables/>
					<JoinLinks/>
					<Fields/>
					<Attributes/>
					<Features/>
				</ListBox>
<TextBox id="856" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="wp_user_name" fieldSource="wp_user_name" required="True" caption="User Name" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="getRegistrationInfof_SELECT_FROM_v_vat_regiswp_user_name">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
<TextBox id="857" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="wp_user_pwd" fieldSource="wp_user_pwd" required="True" caption="Password" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="getRegistrationInfof_SELECT_FROM_v_vat_regiswp_user_pwd">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
<TextBox id="864" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="wp_name" fieldSource="wp_name" required="True" caption="Nama Wajib Pajak" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="getRegistrationInfof_SELECT_FROM_v_vat_regiswp_name">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
<TextArea id="865" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="wp_address_name" fieldSource="wp_address_name" required="True" caption="Alamat Wajib Pajak" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="getRegistrationInfof_SELECT_FROM_v_vat_regiswp_address_name">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextArea>
<TextBox id="866" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="wp_address_no" fieldSource="wp_address_no" required="True" caption="No - WP" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="getRegistrationInfof_SELECT_FROM_v_vat_regiswp_address_no">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
<TextBox id="867" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="wp_address_rt" fieldSource="wp_address_rt" required="False" caption="Rt - WP" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="getRegistrationInfof_SELECT_FROM_v_vat_regiswp_address_rt">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
<TextBox id="868" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="wp_address_rw" fieldSource="wp_address_rw" required="False" caption="Rw - WP" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="getRegistrationInfof_SELECT_FROM_v_vat_regiswp_address_rw">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
<TextBox id="869" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="wp_kota" fieldSource="wp_kota" required="True" caption="Kota/Kabupaten - WP" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="getRegistrationInfof_SELECT_FROM_v_vat_regiswp_kota" defaultValue="'KOTA BANDUNG'">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
<Hidden id="885" fieldSourceType="DBColumn" dataType="Float" name="wp_p_region_id" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="getRegistrationInfof_SELECT_FROM_v_vat_regiswp_p_region_id" fieldSource="wp_p_region_id" caption="Kota/Kabupaten - WP" defaultValue="749" required="True">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
<TextBox id="870" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="wp_kecamatan" fieldSource="wp_kecamatan" required="True" caption="Kecamatan - WP" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="getRegistrationInfof_SELECT_FROM_v_vat_regiswp_kecamatan">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
<Hidden id="887" fieldSourceType="DBColumn" dataType="Float" name="wp_p_region_id_kecamatan" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="getRegistrationInfof_SELECT_FROM_v_vat_regiswp_p_region_id_kecamatan" fieldSource="wp_p_region_id_kecamatan" caption="Kecamatan - WP" required="True">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
<TextBox id="871" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="wp_kelurahan" fieldSource="wp_kelurahan" required="True" caption="Kelurahan - WP" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="getRegistrationInfof_SELECT_FROM_v_vat_regiswp_kelurahan">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
<Hidden id="889" fieldSourceType="DBColumn" dataType="Float" name="wp_p_region_id_kelurahan" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="getRegistrationInfof_SELECT_FROM_v_vat_regiswp_p_region_id_kelurahan" fieldSource="wp_p_region_id_kelurahan" caption="Kelurahan - WP" required="True">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
<TextBox id="881" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="wp_phone_no" fieldSource="wp_phone_no" required="False" caption="No. Telephon - WP" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="getRegistrationInfof_SELECT_FROM_v_vat_regiswp_phone_no">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
<TextBox id="884" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="wp_mobile_no" fieldSource="wp_mobile_no" caption="No. Selular - WP" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="getRegistrationInfof_SELECT_FROM_v_vat_regiswp_mobile_no" required="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
<TextBox id="892" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="wp_email" fieldSource="wp_email" required="False" caption="Email - WP" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="getRegistrationInfof_SELECT_FROM_v_vat_regiswp_email" inputMask="^[\w\.-]{1,}\@([\da-zA-Z-]{1,}\.){1,}[\da-zA-Z-]+$">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
<TextBox id="893" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="wp_fax_no" fieldSource="wp_fax_no" required="False" caption="No. Fax - WP" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="getRegistrationInfof_SELECT_FROM_v_vat_regiswp_fax_no">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
<TextBox id="882" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="wp_zip_code" fieldSource="wp_zip_code" required="False" caption="Kode Pos - WP" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="getRegistrationInfof_SELECT_FROM_v_vat_regiswp_zip_code">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
<TextBox id="632" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="company_name" fieldSource="company_name" required="True" caption="Nama Badan/Perusahaan" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="getRegistrationInfof_SELECT_FROM_v_vat_regiscompany_name">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
<TextArea id="633" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="address_name" fieldSource="address_name" required="True" caption="Alamat Badan" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="getRegistrationInfof_SELECT_FROM_v_vat_regisaddress_name">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextArea>
<TextBox id="635" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="address_no" fieldSource="address_no" required="True" caption="No - Badan" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="getRegistrationInfof_SELECT_FROM_v_vat_regisaddress_no">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
<TextBox id="636" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="address_rt" fieldSource="address_rt" required="False" caption="Rt - Badan" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="getRegistrationInfof_SELECT_FROM_v_vat_regisaddress_rt">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
<TextBox id="637" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="address_rw" fieldSource="address_rw" required="False" caption="Rw - Badan" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="getRegistrationInfof_SELECT_FROM_v_vat_regisaddress_rw">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
<TextBox id="622" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="kota_code" fieldSource="kota_code" required="True" caption="Kota/Kabupaten - Badan" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="getRegistrationInfof_SELECT_FROM_v_vat_regiskota_code" defaultValue="'KOTA BANDUNG'">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
<Hidden id="625" fieldSourceType="DBColumn" dataType="Float" name="p_region_id" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="getRegistrationInfof_SELECT_FROM_v_vat_regisp_region_id" fieldSource="p_region_id" caption="Kota/Kabupaten - Badan" defaultValue="749" required="True">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
<TextBox id="621" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="kecamatan_code" fieldSource="kecamatan_code" required="True" caption="Kecamatan - Badan" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="getRegistrationInfof_SELECT_FROM_v_vat_regiskecamatan_code">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
<Hidden id="624" fieldSourceType="DBColumn" dataType="Float" name="p_region_id_kecamatan" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="getRegistrationInfof_SELECT_FROM_v_vat_regisp_region_id_kecamatan" fieldSource="p_region_id_kecamatan" caption="Kecamatan - Badan" required="True">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
<TextBox id="620" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="kelurahan_code" fieldSource="kelurahan_code" required="True" caption="Kelurahan - Badan" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="getRegistrationInfof_SELECT_FROM_v_vat_regiskelurahan_code">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
<Hidden id="623" fieldSourceType="DBColumn" dataType="Float" name="p_region_id_kelurahan" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="getRegistrationInfof_SELECT_FROM_v_vat_regisp_region_id_kelurahan" fieldSource="p_region_id_kelurahan" caption="Kelurahan - Badan" required="True">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
<TextBox id="641" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="phone_no" fieldSource="phone_no" required="False" caption="No. Telephon - Badan" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="getRegistrationInfof_SELECT_FROM_v_vat_regisphone_no">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
<TextBox id="651" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="mobile_no" fieldSource="mobile_no" required="False" caption="No. Handphone" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="getRegistrationInfof_SELECT_FROM_v_vat_regismobile_no">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
<TextBox id="643" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="fax_no" fieldSource="fax_no" required="False" caption="No. Fax - Badan" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="getRegistrationInfof_SELECT_FROM_v_vat_regisfax_no">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
<TextBox id="644" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="zip_code" fieldSource="zip_code" required="False" caption="Kode Pos - Badan" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="getRegistrationInfof_SELECT_FROM_v_vat_regiszip_code">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
<TextBox id="634" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="company_brand" fieldSource="company_brand" required="True" caption="Nama Merk Dagang" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="getRegistrationInfof_SELECT_FROM_v_vat_regiscompany_brand">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
<TextArea id="894" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="brand_address_name" fieldSource="brand_address_name" required="True" caption="Alamat" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="getRegistrationInfof_SELECT_FROM_v_vat_regisbrand_address_name">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextArea>
<TextBox id="877" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="brand_address_no" fieldSource="brand_address_no" required="True" caption="No - Usaha" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="getRegistrationInfof_SELECT_FROM_v_vat_regisbrand_address_no">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
<TextBox id="878" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="brand_address_rt" fieldSource="brand_address_rt" required="False" caption="Rt - Usaha" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="getRegistrationInfof_SELECT_FROM_v_vat_regisbrand_address_rt">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
<TextBox id="879" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="brand_address_rw" fieldSource="brand_address_rw" required="False" caption="Rw - Usaha" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="getRegistrationInfof_SELECT_FROM_v_vat_regisbrand_address_rw">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
<TextBox id="873" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="brand_kota" fieldSource="brand_kota" required="True" caption="Kota/Kabupaten - Usaha" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="getRegistrationInfof_SELECT_FROM_v_vat_regisbrand_kota" defaultValue="'KOTA BANDUNG'">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
<Hidden id="886" fieldSourceType="DBColumn" dataType="Float" name="brand_p_region_id" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="getRegistrationInfof_SELECT_FROM_v_vat_regisbrand_p_region_id" fieldSource="brand_p_region_id" caption="Kota/Kabupaten - Usaha" defaultValue="749" required="True">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
<TextBox id="874" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="brand_kecamatan" fieldSource="brand_kecamatan" required="True" caption="Kecamatan - Usaha" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="getRegistrationInfof_SELECT_FROM_v_vat_regisbrand_kecamatan">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
<Hidden id="888" fieldSourceType="DBColumn" dataType="Float" name="brand_p_region_id_kec" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="getRegistrationInfof_SELECT_FROM_v_vat_regisbrand_p_region_id_kec" fieldSource="brand_p_region_id_kec" caption="Kecamatan - Usaha" required="True">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
<TextBox id="872" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="brand_kelurahan" fieldSource="brand_kelurahan" required="True" caption="Kelurahan - Usaha" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="getRegistrationInfof_SELECT_FROM_v_vat_regisbrand_kelurahan">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
<Hidden id="890" fieldSourceType="DBColumn" dataType="Float" name="brand_p_region_id_kel" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="getRegistrationInfof_SELECT_FROM_v_vat_regisbrand_p_region_id_kel" fieldSource="brand_p_region_id_kel" caption="Kelurahan - Usaha" required="True">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
<TextBox id="880" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="brand_phone_no" fieldSource="brand_phone_no" required="False" caption="No. Telephon - Usaha" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="getRegistrationInfof_SELECT_FROM_v_vat_regisbrand_phone_no">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
<TextBox id="902" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="brand_mobile_no" fieldSource="brand_mobile_no" caption="No. Selular - Usaha" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="getRegistrationInfof_SELECT_FROM_v_vat_regisbrand_mobile_no" required="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
<TextBox id="903" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="brand_fax_no" fieldSource="brand_fax_no" required="False" caption="No. Fax - Usaha" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="getRegistrationInfof_SELECT_FROM_v_vat_regisbrand_fax_no">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
<TextBox id="883" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="brand_zip_code" fieldSource="brand_zip_code" required="False" caption="Kode Pos - Usaha" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="getRegistrationInfof_SELECT_FROM_v_vat_regisbrand_zip_code">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
<TextBox id="647" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="company_owner" fieldSource="company_owner" required="True" caption="Nama Pemilik/Pengelola" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="getRegistrationInfof_SELECT_FROM_v_vat_regiscompany_owner">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
<TextBox id="565" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="job_position_code" fieldSource="job_position_code" required="True" caption="Jabatan Pemilik" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="getRegistrationInfof_SELECT_FROM_v_vat_regisjob_position_code">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
<Hidden id="567" fieldSourceType="DBColumn" dataType="Float" name="p_job_position_id" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="getRegistrationInfof_SELECT_FROM_v_vat_regisp_job_position_id" fieldSource="p_job_position_id" caption="p_order_status_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
<TextArea id="652" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="address_name_owner" fieldSource="address_name_owner" required="True" caption="Alamat Tempat Tinggal" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="getRegistrationInfof_SELECT_FROM_v_vat_regisaddress_name_owner">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextArea>
<TextBox id="638" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="address_no_owner" fieldSource="address_no_owner" required="True" caption="No - Pemilik" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="getRegistrationInfof_SELECT_FROM_v_vat_regisaddress_no_owner">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
<TextBox id="639" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="address_rt_owner" fieldSource="address_rt_owner" required="False" caption="Rt - Pemilik" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="getRegistrationInfof_SELECT_FROM_v_vat_regisaddress_rt_owner">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
<TextBox id="640" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="address_rw_owner" fieldSource="address_rw_owner" required="False" caption="Rw - Pemilik" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="getRegistrationInfof_SELECT_FROM_v_vat_regisaddress_rw_owner">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
<TextBox id="628" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="kota_own_code" fieldSource="kota_own_code" required="True" caption="Kota/Kabupaten - Pemilik" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="getRegistrationInfof_SELECT_FROM_v_vat_regiskota_own_code" defaultValue="'KOTA BANDUNG'">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
<Hidden id="631" fieldSourceType="DBColumn" dataType="Float" name="p_region_id_owner" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="getRegistrationInfof_SELECT_FROM_v_vat_regisp_region_id_owner" fieldSource="p_region_id_owner" caption="Kota/Kabupaten - Pemilik" defaultValue="749" required="True">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
<TextBox id="627" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="kecamatan_own_code" fieldSource="kecamatan_own_code" required="True" caption="Kecamatan - Pemilik" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="getRegistrationInfof_SELECT_FROM_v_vat_regiskecamatan_own_code">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
<Hidden id="630" fieldSourceType="DBColumn" dataType="Float" name="p_region_id_kec_owner" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="getRegistrationInfof_SELECT_FROM_v_vat_regisp_region_id_kec_owner" fieldSource="p_region_id_kec_owner" caption="Kecamatan - Pemilik" required="True">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
<TextBox id="626" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="kelurahan_own_code" fieldSource="kelurahan_own_code" required="True" caption="Kelurahan - Pemilk" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="getRegistrationInfof_SELECT_FROM_v_vat_regiskelurahan_own_code">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
<Hidden id="629" fieldSourceType="DBColumn" dataType="Float" name="p_region_id_kel_owner" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="getRegistrationInfof_SELECT_FROM_v_vat_regisp_region_id_kel_owner" fieldSource="p_region_id_kel_owner" caption="Kelurahan - Pemilk" required="True">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
<TextBox id="825" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="email" fieldSource="email" required="False" caption="Email - Pemilik" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="getRegistrationInfof_SELECT_FROM_v_vat_regisemail" inputMask="^[\w\.-]{1,}\@([\da-zA-Z-]{1,}\.){1,}[\da-zA-Z-]+$">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
<TextBox id="646" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="phone_no_owner" fieldSource="phone_no_owner" required="False" caption="No. Telephon - Pemilk" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="getRegistrationInfof_SELECT_FROM_v_vat_regisphone_no_owner">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
<TextBox id="649" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="fax_no_owner" fieldSource="fax_no_owner" required="False" caption="No. Fax - Pemilk" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="getRegistrationInfof_SELECT_FROM_v_vat_regisfax_no_owner">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
<TextBox id="650" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="zip_code_owner" fieldSource="zip_code_owner" required="False" caption="Kode Pos - Pemilk" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="getRegistrationInfof_SELECT_FROM_v_vat_regiszip_code_owner">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
</Components>
			<Events/>
			<TableParameters/>
			<JoinTables>
				<JoinTable id="909" tableName="SELECT" alias="* 
FROM v_vat_registration
WHERE t_customer_order_id ={t_customer_order_id}" posLeft="10" posTop="10" posWidth="20" posHeight="40"/>
			</JoinTables>
			<JoinLinks/>
			<Fields/>
			<SPParameters/>
			<SQLParameters>
				<SQLParameter id="907" variable="t_customer_order_id" parameterType="URL" defaultValue="0" dataType="Integer" parameterSource="t_customer_order_id" designDefaultValue="22"/>
			</SQLParameters>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Grid>
	</Components>
	<CodeFiles>
		<CodeFile id="Code" language="PHPTemplates" name="getRegistrationInfo.php" forShow="True" url="getRegistrationInfo.php" comment="//" codePage="windows-1252"/>
	</CodeFiles>
	<SecurityGroups/>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events/>
</Page>
