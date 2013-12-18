<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\trans" secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="RWNet" wizardThemeVersion="3.0" needGeneration="0">
	<Components>
		<Record id="94" sourceType="SQL" urlType="Relative" secured="False" allowInsert="True" allowUpdate="True" allowDelete="True" validateData="True" preserveParameters="GET" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" connection="ConnSIKP" name="t_vat_registrationForm" errorSummator="Error" wizardCaption="Add/Edit V P App User " wizardFormMethod="post" PathID="t_vat_registrationForm" activeCollection="DSPParameters" pasteAsReplace="pasteAsReplace" pasteActions="pasteActions" customDeleteType="Procedure" parameterTypeListName="ParameterTypeList" customUpdateType="Procedure" customInsertType="Procedure" customUpdate="f_crud_vat_reg" customDelete="f_crud_vat_reg" customInsert="f_crud_vat_reg" dataSource="SELECT * 
FROM v_vat_registration
WHERE t_customer_order_id = {t_customer_order_id} ">
			<Components>
				<Button id="95" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Insert" operation="Insert" wizardCaption="Add" PathID="t_vat_registrationFormButton_Insert" removeParameters="FLAG">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="96" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Update" operation="Update" wizardCaption="Submit" PathID="t_vat_registrationFormButton_Update" removeParameters="FLAG">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="97" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Delete" operation="Delete" wizardCaption="Delete" PathID="t_vat_registrationFormButton_Delete" removeParameters="FLAG;t_vat_registration_id">
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
				<Button id="99" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Cancel" operation="Cancel" wizardCaption="Cancel" PathID="t_vat_registrationFormButton_Cancel" returnPage="t_customer_order.ccp" removeParameters="FLAG">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<TextBox id="124" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="created_by" fieldSource="created_by" required="False" caption="Created By" wizardCaption="Created By" wizardSize="16" wizardMaxLength="16" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_registrationFormcreated_by" defaultValue="CCGetUserLogin()">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="127" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="updated_by" fieldSource="updated_by" required="False" caption="Updated By" wizardCaption="Updated By" wizardSize="16" wizardMaxLength="16" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_registrationFormupdated_by" defaultValue="CCGetUserLogin()">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="122" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="creation_date" fieldSource="creation_date" required="False" caption="Creation Date" wizardCaption="Creation Date" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_registrationFormcreation_date" format="dd-mmm-yyyy" defaultValue="date(&quot;d-M-Y&quot;)">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="125" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="updated_date" fieldSource="updated_date" required="False" caption="Updated Date" wizardCaption="Updated Date" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_registrationFormupdated_date" defaultValue="date(&quot;d-M-Y&quot;)" format="dd-mmm-yyyy">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="460" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="order_no" fieldSource="order_no" required="True" caption="Nomor Order" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_registrationFormorder_no">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="33" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="registration_date" fieldSource="registration_date" required="True" caption="Tanggal Pendaftaran" wizardCaption="Valid From" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_registrationFormregistration_date" defaultValue="date(&quot;d-M-Y h:i:s&quot;)" format="dd-mmm-yyyy H:nn:ss">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Hidden id="101" fieldSourceType="DBColumn" dataType="Float" name="t_customer_order_id" fieldSource="t_customer_order_id" caption="Id" wizardCaption="P App User Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_registrationFormt_customer_order_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<TextBox id="620" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="kelurahan_code" fieldSource="kelurahan_code" required="True" caption="Kelurahan - Badan" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_registrationFormkelurahan_code">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="621" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="kecamatan_code" fieldSource="kecamatan_code" required="True" caption="Kecamatan - Badan" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_registrationFormkecamatan_code">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="622" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="kota_code" fieldSource="kota_code" required="True" caption="Kota/Kabupaten - Badan" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_registrationFormkota_code" defaultValue="'KOTA BANDUNG'">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Hidden id="623" fieldSourceType="DBColumn" dataType="Float" name="p_region_id_kelurahan" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_vat_registrationFormp_region_id_kelurahan" fieldSource="p_region_id_kelurahan" caption="Kelurahan - Badan" required="True">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="624" fieldSourceType="DBColumn" dataType="Float" name="p_region_id_kecamatan" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_vat_registrationFormp_region_id_kecamatan" fieldSource="p_region_id_kecamatan" caption="Kecamatan - Badan" required="True">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="625" fieldSourceType="DBColumn" dataType="Float" name="p_region_id" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_vat_registrationFormp_region_id" fieldSource="p_region_id" caption="Kota/Kabupaten - Badan" defaultValue="749" required="True">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<TextBox id="626" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="kelurahan_own_code" fieldSource="kelurahan_own_code" required="True" caption="Kelurahan - Pemilk" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_registrationFormkelurahan_own_code">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="627" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="kecamatan_own_code" fieldSource="kecamatan_own_code" required="True" caption="Kecamatan - Pemilik" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_registrationFormkecamatan_own_code">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="628" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="kota_own_code" fieldSource="kota_own_code" required="True" caption="Kota/Kabupaten - Pemilik" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_registrationFormkota_own_code" defaultValue="'KOTA BANDUNG'">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Hidden id="629" fieldSourceType="DBColumn" dataType="Float" name="p_region_id_kel_owner" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_vat_registrationFormp_region_id_kel_owner" fieldSource="p_region_id_kel_owner" caption="Kelurahan - Pemilk" required="True">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="630" fieldSourceType="DBColumn" dataType="Float" name="p_region_id_kec_owner" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_vat_registrationFormp_region_id_kec_owner" fieldSource="p_region_id_kec_owner" caption="Kecamatan - Pemilik" required="True">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="631" fieldSourceType="DBColumn" dataType="Float" name="p_region_id_owner" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_vat_registrationFormp_region_id_owner" fieldSource="p_region_id_owner" caption="Kota/Kabupaten - Pemilik" defaultValue="749" required="True">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<TextBox id="632" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="company_name" fieldSource="company_name" required="True" caption="Nama Badan/Perusahaan" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_registrationFormcompany_name">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextArea id="633" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="address_name" fieldSource="address_name" required="True" caption="Alamat Badan" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_registrationFormaddress_name">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextArea>
				<TextBox id="565" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="job_position_code" fieldSource="job_position_code" required="True" caption="Jabatan Pemilik" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_registrationFormjob_position_code">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Hidden id="567" fieldSourceType="DBColumn" dataType="Float" name="p_job_position_id" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_vat_registrationFormp_job_position_id" fieldSource="p_job_position_id" caption="p_order_status_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<TextBox id="634" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="company_brand" fieldSource="company_brand" required="True" caption="Nama Merk Dagang" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_registrationFormcompany_brand">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="635" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="address_no" fieldSource="address_no" required="True" caption="No - Badan" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_registrationFormaddress_no">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="636" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="address_rt" fieldSource="address_rt" required="False" caption="Rt - Badan" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_registrationFormaddress_rt">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="637" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="address_rw" fieldSource="address_rw" required="False" caption="Rw - Badan" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_registrationFormaddress_rw">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="638" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="address_no_owner" fieldSource="address_no_owner" required="True" caption="No - Pemilik" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_registrationFormaddress_no_owner">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="639" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="address_rt_owner" fieldSource="address_rt_owner" required="False" caption="Rt - Pemilik" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_registrationFormaddress_rt_owner">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="640" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="address_rw_owner" fieldSource="address_rw_owner" required="False" caption="Rw - Pemilik" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_registrationFormaddress_rw_owner">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="641" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="phone_no" fieldSource="phone_no" required="False" caption="No. Telephon - Badan" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_registrationFormphone_no">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="643" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="fax_no" fieldSource="fax_no" required="False" caption="No. Fax - Badan" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_registrationFormfax_no">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="644" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="zip_code" fieldSource="zip_code" required="False" caption="Kode Pos - Badan" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_registrationFormzip_code">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="647" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="company_owner" fieldSource="company_owner" required="True" caption="Nama Pemilik/Pengelola" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_registrationFormcompany_owner">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="648" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="mobile_no_owner" fieldSource="mobile_no_owner" required="True" caption="No. Selular - Pemilk" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_registrationFormmobile_no_owner">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="649" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="fax_no_owner" fieldSource="fax_no_owner" required="False" caption="No. Fax - Pemilk" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_registrationFormfax_no_owner">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="650" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="zip_code_owner" fieldSource="zip_code_owner" required="False" caption="Kode Pos - Pemilk" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_registrationFormzip_code_owner">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="651" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="mobile_no" fieldSource="mobile_no" required="False" caption="No. Handphone" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_registrationFormmobile_no">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextArea id="652" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="address_name_owner" fieldSource="address_name_owner" required="True" caption="Alamat Tempat Tinggal" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_registrationFormaddress_name_owner">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextArea>
				<Hidden id="824" fieldSourceType="DBColumn" dataType="Float" name="p_rqst_type_id" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_vat_registrationFormp_rqst_type_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="787" fieldSourceType="DBColumn" dataType="Text" html="False" name="rqst_type_code" wizardCaption="Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="t_vat_registrationFormrqst_type_code">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<TextBox id="825" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="email" fieldSource="email" required="False" caption="Email - Pemilik" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_registrationFormemail" inputMask="^[\w\.-]{1,}\@([\da-zA-Z-]{1,}\.){1,}[\da-zA-Z-]+$">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Button id="851" urlType="Relative" enableValidation="True" isDefault="False" name="Button1" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_vat_registrationFormButton1">
					<Components/>
					<Events>
						<Event name="OnClick" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="862"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Button>
				<TextBox id="852" visible="Dynamic" fieldSourceType="DBColumn" dataType="Text" name="validation_code" required="False" caption="Kode Validasi" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_registrationFormvalidation_code">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Hidden id="653" fieldSourceType="DBColumn" dataType="Float" name="t_vat_registration_id" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_vat_registrationFormt_vat_registration_id" fieldSource="t_vat_registration_id" caption="t_vat_registration_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Label id="855" fieldSourceType="DBColumn" dataType="Text" html="False" name="Label3" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_vat_registrationFormLabel3">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<TextBox id="856" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="wp_user_name" fieldSource="wp_user_name" required="True" caption="User Name" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_registrationFormwp_user_name">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="857" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="wp_user_pwd" fieldSource="wp_user_pwd" required="True" caption="Password" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_registrationFormwp_user_pwd">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Label id="863" fieldSourceType="DBColumn" dataType="Text" html="False" name="pesan" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_vat_registrationFormpesan">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<TextBox id="646" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="phone_no_owner" fieldSource="phone_no_owner" required="False" caption="No. Telephon - Pemilk" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_registrationFormphone_no_owner">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="864" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="wp_name" fieldSource="wp_name" required="True" caption="Nama Wajib Pajak" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_registrationFormwp_name">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextArea id="865" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="wp_address_name" fieldSource="wp_address_name" required="True" caption="Alamat Wajib Pajak" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_registrationFormwp_address_name">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextArea>
				<TextBox id="866" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="wp_address_no" fieldSource="wp_address_no" required="True" caption="No - WP" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_registrationFormwp_address_no">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="867" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="wp_address_rt" fieldSource="wp_address_rt" required="False" caption="Rt - WP" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_registrationFormwp_address_rt">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="868" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="wp_address_rw" fieldSource="wp_address_rw" required="False" caption="Rw - WP" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_registrationFormwp_address_rw">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="869" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="wp_kota" fieldSource="wp_kota" required="True" caption="Kota/Kabupaten - WP" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_registrationFormwp_kota" defaultValue="'KOTA BANDUNG'">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="870" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="wp_kecamatan" fieldSource="wp_kecamatan" required="True" caption="Kecamatan - WP" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_registrationFormwp_kecamatan">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="871" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="wp_kelurahan" fieldSource="wp_kelurahan" required="True" caption="Kelurahan - WP" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_registrationFormwp_kelurahan">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="872" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="brand_kelurahan" fieldSource="brand_kelurahan" required="True" caption="Kelurahan - Usaha" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_registrationFormbrand_kelurahan">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="873" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="brand_kota" fieldSource="brand_kota" required="True" caption="Kota/Kabupaten - Usaha" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_registrationFormbrand_kota" defaultValue="'KOTA BANDUNG'">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="874" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="brand_kecamatan" fieldSource="brand_kecamatan" required="True" caption="Kecamatan - Usaha" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_registrationFormbrand_kecamatan">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="877" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="brand_address_no" fieldSource="brand_address_no" required="True" caption="No - Usaha" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_registrationFormbrand_address_no">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="878" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="brand_address_rt" fieldSource="brand_address_rt" required="False" caption="Rt - Usaha" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_registrationFormbrand_address_rt">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="879" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="brand_address_rw" fieldSource="brand_address_rw" required="False" caption="Rw - Usaha" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_registrationFormbrand_address_rw">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="880" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="brand_phone_no" fieldSource="brand_phone_no" required="False" caption="No. Telephon - Usaha" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_registrationFormbrand_phone_no">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="881" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="wp_phone_no" fieldSource="wp_phone_no" required="False" caption="No. Telephon - WP" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_registrationFormwp_phone_no">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="882" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="wp_zip_code" fieldSource="wp_zip_code" required="False" caption="Kode Pos - WP" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_registrationFormwp_zip_code">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="883" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="brand_zip_code" fieldSource="brand_zip_code" required="False" caption="Kode Pos - Usaha" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_registrationFormbrand_zip_code">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="884" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="wp_mobile_no" fieldSource="wp_mobile_no" caption="No. Selular - WP" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_registrationFormwp_mobile_no" required="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Hidden id="885" fieldSourceType="DBColumn" dataType="Float" name="wp_p_region_id" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_vat_registrationFormwp_p_region_id" fieldSource="wp_p_region_id" caption="Kota/Kabupaten - WP" defaultValue="749" required="True">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="886" fieldSourceType="DBColumn" dataType="Float" name="brand_p_region_id" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_vat_registrationFormbrand_p_region_id" fieldSource="brand_p_region_id" caption="Kota/Kabupaten - Usaha" defaultValue="749" required="True">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="887" fieldSourceType="DBColumn" dataType="Float" name="wp_p_region_id_kecamatan" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_vat_registrationFormwp_p_region_id_kecamatan" fieldSource="wp_p_region_id_kecamatan" caption="Kecamatan - WP" required="True">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="888" fieldSourceType="DBColumn" dataType="Float" name="brand_p_region_id_kec" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_vat_registrationFormbrand_p_region_id_kec" fieldSource="brand_p_region_id_kec" caption="Kecamatan - Usaha" required="True">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="889" fieldSourceType="DBColumn" dataType="Float" name="wp_p_region_id_kelurahan" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_vat_registrationFormwp_p_region_id_kelurahan" fieldSource="wp_p_region_id_kelurahan" caption="Kelurahan - WP" required="True">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="890" fieldSourceType="DBColumn" dataType="Float" name="brand_p_region_id_kel" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_vat_registrationFormbrand_p_region_id_kel" fieldSource="brand_p_region_id_kel" caption="Kelurahan - Usaha" required="True">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<TextBox id="892" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="wp_email" fieldSource="wp_email" required="False" caption="Email - WP" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_registrationFormwp_email" inputMask="^[\w\.-]{1,}\@([\da-zA-Z-]{1,}\.){1,}[\da-zA-Z-]+$">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="893" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="wp_fax_no" fieldSource="wp_fax_no" required="False" caption="No. Fax - WP" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_registrationFormwp_fax_no">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextArea id="894" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="brand_address_name" fieldSource="brand_address_name" required="True" caption="Alamat" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_registrationFormbrand_address_name">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextArea>
				<ListBox id="898" visible="Yes" fieldSourceType="DBColumn" sourceType="Table" dataType="Text" returnValueType="Number" name="p_private_question_id" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" wizardEmptyCaption="Select Value" PathID="t_vat_registrationFormp_private_question_id" connection="ConnSIKP" dataSource="p_private_question" orderBy="p_private_question_id" boundColumn="p_private_question_id" textColumn="question_pwd" fieldSource="p_private_question_id" caption="Pilih Pertanyaan">
					<Components/>
					<Events/>
					<TableParameters/>
					<SPParameters/>
					<SQLParameters/>
					<JoinTables>
						<JoinTable id="901" tableName="p_private_question" posLeft="10" posTop="10" posWidth="160" posHeight="168"/>
					</JoinTables>
					<JoinLinks/>
					<Fields>
						<Field id="900" fieldName="*"/>
					</Fields>
					<Attributes/>
					<Features/>
				</ListBox>
				<TextBox id="899" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="private_answer" fieldSource="private_answer" required="True" caption="Jawaban" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_registrationFormprivate_answer">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="902" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="brand_mobile_no" fieldSource="brand_mobile_no" caption="No. Selular - Usaha" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_registrationFormbrand_mobile_no" required="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="903" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="brand_fax_no" fieldSource="brand_fax_no" required="False" caption="No. Fax - Usaha" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_registrationFormbrand_fax_no">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<ListBox id="904" visible="Yes" fieldSourceType="DBColumn" sourceType="SQL" dataType="Float" returnValueType="Number" name="p_vat_type_dtl_id" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" wizardEmptyCaption="Select Value" PathID="t_vat_registrationFormp_vat_type_dtl_id" fieldSource="p_vat_type_dtl_id" caption="Nama Ayat" connection="ConnSIKP" activeCollection="SQLParameters" parameterTypeListName="ParameterTypeList" dataSource="select * from v_p_vat_type_dtl_rqst_type
where p_rqst_type_id = {p_rqst_type_id}" boundColumn="p_vat_type_dtl_id" textColumn="nama_ayat">
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
			</Components>
			<Events>
				<Event name="BeforeSelect" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="842"/>
					</Actions>
				</Event>
				<Event name="BeforeInsert" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="853"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
				<TableParameter id="896" conditionType="Parameter" useIsNull="False" field="t_customer_order_id" dataType="Float" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="t_customer_order_id"/>
			</TableParameters>
			<SPParameters/>
			<SQLParameters>
				<SQLParameter id="897" parameterType="URL" variable="t_customer_order_id" dataType="Float" parameterSource="t_customer_order_id"/>
			</SQLParameters>
			<JoinTables>
			</JoinTables>
			<JoinLinks/>
			<Fields>
			</Fields>
			<ISPParameters>
				<SPParameter id="Key898" dataType="Char" parameterType="URL" dataSize="255" direction="ReturnValue" scale="0" precision="0" parameterName="o_res" parameterSource="o_res"/>
				<SPParameter id="Key899" parameterName="icode" parameterSource="validation_code" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key900" parameterName="iuser" parameterSource="CCGetUserLogin()" dataType="Char" parameterType="Expression" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key901" parameterName="cusorderid" parameterSource="t_customer_order_id" dataType="Numeric" parameterType="Control" dataSize="28" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key902" parameterName="regionidkel" parameterSource="p_region_id_kelurahan" dataType="Numeric" parameterType="Control" dataSize="28" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key903" parameterName="regionidkec" parameterSource="p_region_id_kecamatan" dataType="Numeric" parameterType="Control" dataSize="28" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key904" parameterName="regionid" parameterSource="p_region_id" dataType="Numeric" parameterType="Control" dataSize="28" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key905" parameterName="regionidkelown" parameterSource="p_region_id_kel_owner" dataType="Numeric" parameterType="Control" dataSize="28" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key906" parameterName="regionidkecown" parameterSource="p_region_id_kec_owner" dataType="Numeric" parameterType="Control" dataSize="28" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key907" parameterName="regionidown" parameterSource="p_region_id_owner" dataType="Numeric" parameterType="Control" dataSize="28" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key908" parameterName="companyname" parameterSource="company_name" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key909" parameterName="addressname" parameterSource="address_name" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key910" parameterName="jobid" parameterSource="p_job_position_id" dataType="Numeric" parameterType="Control" dataSize="28" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key911" parameterName="companybrand" parameterSource="company_brand" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key912" parameterName="addressno" parameterSource="address_no" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key913" parameterName="addressrt" parameterSource="address_rt" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key914" parameterName="addressrw" parameterSource="address_rw" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key915" parameterName="addressnoown" parameterSource="address_no_owner" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key916" parameterName="addressrtown" parameterSource="address_rt_owner" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key917" parameterName="addressrwown" parameterSource="address_rw_owner" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key918" parameterName="phoneno" parameterSource="phone_no" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key919" parameterName="faxno" parameterSource="fax_no" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key920" parameterName="zipcode" parameterSource="zip_code" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key921" parameterName="phonenoown" parameterSource="phone_no_owner" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key922" parameterName="companyown" parameterSource="company_owner" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key923" parameterName="mobilenoown" parameterSource="mobile_no_owner" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key924" parameterName="faxnoown" parameterSource="fax_no_owner" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key925" parameterName="zipcodeown" parameterSource="zip_code_owner" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key926" parameterName="mobileno" parameterSource="mobile_no" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key927" parameterName="addressnameown" parameterSource="address_name_owner" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key928" parameterName="i_email" parameterSource="email" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key933" parameterName="vattypedtlid" parameterSource="p_vat_type_dtl_id" dataType="Numeric" parameterType="Control" dataSize="28" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key934" parameterName="wpusername" parameterSource="wp_user_name" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key935" parameterName="wpuserpwd" parameterSource="wp_user_pwd" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key936" parameterName="wpname" parameterSource="wp_name" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key937" parameterName="wpaddressname" parameterSource="wp_address_name" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key938" parameterName="wpaddressno" parameterSource="wp_address_no" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key939" parameterName="wprt" parameterSource="wp_address_rt" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key940" parameterName="wprw" parameterSource="wp_address_rw" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key941" parameterName="wpkel" parameterSource="wp_p_region_id_kelurahan" dataType="Numeric" parameterType="Control" dataSize="28" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key942" parameterName="wpkec" parameterSource="wp_p_region_id_kecamatan" dataType="Numeric" parameterType="Control" dataSize="28" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key943" parameterName="wpkota" parameterSource="wp_p_region_id" dataType="Numeric" parameterType="Control" dataSize="28" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key944" parameterName="wpphoneno" parameterSource="wp_phone_no" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key945" parameterName="wpmobileno" parameterSource="wp_mobile_no" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key946" parameterName="wpfaxno" parameterSource="wp_fax_no" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key947" parameterName="wpzipcode" parameterSource="wp_zip_code" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key948" parameterName="wpemail" parameterSource="wp_email" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key949" parameterName="brandaddress" parameterSource="brand_address_name" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key950" parameterName="brandno" parameterSource="brand_address_no" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key951" parameterName="brandrt" parameterSource="brand_address_rt" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key952" parameterName="brandrw" parameterSource="brand_address_rw" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key953" parameterName="brandkel" parameterSource="brand_p_region_id_kel" dataType="Numeric" parameterType="Control" dataSize="28" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key954" parameterName="brandkec" parameterSource="brand_p_region_id_kec" dataType="Numeric" parameterType="Control" dataSize="28" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key955" parameterName="brandkota" parameterSource="brand_p_region_id" dataType="Numeric" parameterType="Control" dataSize="28" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key956" parameterName="brandphoneno" parameterSource="brand_phone_no" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key957" parameterName="brandmobileno" parameterSource="brand_mobile_no" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key958" parameterName="brandfaxno" parameterSource="brand_fax_no" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key959" parameterName="brandzipcode" parameterSource="brand_zip_code" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key960" parameterName="idvat" parameterSource="idvat" dataType="Numeric" parameterType="URL" dataSize="28" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key961" parameterName="questionid" parameterSource="p_private_question_id" dataType="Numeric" parameterType="Control" dataSize="28" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key962" parameterName="privateanswer" parameterSource="private_answer" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key963" parameterName="i_mode" parameterSource="'I'" dataType="Char" parameterType="Expression" dataSize="255" direction="Input" scale="10" precision="6"/>
			</ISPParameters>
			<ISQLParameters>
			</ISQLParameters>
			<IFormElements>
				<CustomParameter id="654" field="created_by" dataType="Text" parameterType="Control" parameterSource="created_by"/>
				<CustomParameter id="655" field="updated_by" dataType="Text" parameterType="Control" parameterSource="updated_by"/>
				<CustomParameter id="656" field="creation_date" dataType="Text" parameterType="Control" parameterSource="creation_date" format="dd-mmm-yyyy"/>
				<CustomParameter id="657" field="updated_date" dataType="Text" parameterType="Control" parameterSource="updated_date" format="dd-mmm-yyyy"/>
				<CustomParameter id="658" field="order_no" dataType="Text" parameterType="Control" parameterSource="order_no"/>
				<CustomParameter id="659" field="registration_date" dataType="Text" parameterType="Control" parameterSource="registration_date" format="dd-mmm-yyyy"/>
				<CustomParameter id="660" field="t_customer_order_id" dataType="Float" parameterType="Control" parameterSource="t_customer_order_id"/>
				<CustomParameter id="661" field="kelurahan_code" dataType="Text" parameterType="Control" parameterSource="kelurahan_code"/>
				<CustomParameter id="662" field="kecamatan_code" dataType="Text" parameterType="Control" parameterSource="kecamatan_code"/>
				<CustomParameter id="663" field="kota_code" dataType="Text" parameterType="Control" parameterSource="kota_code"/>
				<CustomParameter id="664" field="p_region_id_kelurahan" dataType="Float" parameterType="Control" parameterSource="p_region_id_kelurahan"/>
				<CustomParameter id="665" field="p_region_id_kecamatan" dataType="Float" parameterType="Control" parameterSource="p_region_id_kecamatan"/>
				<CustomParameter id="666" field="p_region_id" dataType="Float" parameterType="Control" parameterSource="p_region_id"/>
				<CustomParameter id="667" field="kelurahan_own_code" dataType="Text" parameterType="Control" parameterSource="kelurahan_own_code"/>
				<CustomParameter id="668" field="kecamatan_own_code" dataType="Text" parameterType="Control" parameterSource="kecamatan_own_code"/>
				<CustomParameter id="669" field="kota_own_code" dataType="Text" parameterType="Control" parameterSource="kota_own_code"/>
				<CustomParameter id="670" field="p_region_id_kel_owner" dataType="Float" parameterType="Control" parameterSource="p_region_id_kel_owner"/>
				<CustomParameter id="671" field="p_region_id_kec_owner" dataType="Float" parameterType="Control" parameterSource="p_region_id_kec_owner"/>
				<CustomParameter id="672" field="p_region_id_owner" dataType="Float" parameterType="Control" parameterSource="p_region_id_owner"/>
				<CustomParameter id="673" field="company_name" dataType="Text" parameterType="Control" parameterSource="company_name"/>
				<CustomParameter id="674" field="address_name" dataType="Text" parameterType="Control" parameterSource="address_name"/>
				<CustomParameter id="675" field="job_position_code" dataType="Text" parameterType="Control" parameterSource="job_position_code"/>
				<CustomParameter id="676" field="p_job_position_id" dataType="Float" parameterType="Control" parameterSource="p_job_position_id"/>
				<CustomParameter id="677" field="company_brand" dataType="Text" parameterType="Control" parameterSource="company_brand"/>
				<CustomParameter id="678" field="address_no" dataType="Text" parameterType="Control" parameterSource="address_no"/>
				<CustomParameter id="679" field="address_rt" dataType="Text" parameterType="Control" parameterSource="address_rt"/>
				<CustomParameter id="680" field="address_rw" dataType="Text" parameterType="Control" parameterSource="address_rw"/>
				<CustomParameter id="681" field="address_no_owner" dataType="Text" parameterType="Control" parameterSource="address_no_owner"/>
				<CustomParameter id="682" field="address_rt_owner" dataType="Text" parameterType="Control" parameterSource="address_rt_owner"/>
				<CustomParameter id="683" field="address_rw_owner" dataType="Text" parameterType="Control" parameterSource="address_rw_owner"/>
				<CustomParameter id="684" field="phone_no" dataType="Text" parameterType="Control" parameterSource="phone_no"/>
				<CustomParameter id="685" field="fax_no" dataType="Text" parameterType="Control" parameterSource="fax_no"/>
				<CustomParameter id="686" field="zip_code" dataType="Text" parameterType="Control" parameterSource="zip_code"/>
				<CustomParameter id="687" field="phone_no_owner" dataType="Text" parameterType="Control" parameterSource="phone_no_owner"/>
				<CustomParameter id="688" field="company_owner" dataType="Text" parameterType="Control" parameterSource="company_owner"/>
				<CustomParameter id="689" field="mobile_no_owner" dataType="Text" parameterType="Control" parameterSource="mobile_no_owner"/>
				<CustomParameter id="690" field="fax_no_owner" dataType="Text" parameterType="Control" parameterSource="fax_no_owner"/>
				<CustomParameter id="691" field="zip_code_owner" dataType="Text" parameterType="Control" parameterSource="zip_code_owner"/>
				<CustomParameter id="692" field="mobile_no" dataType="Text" parameterType="Control" parameterSource="mobile_no"/>
				<CustomParameter id="693" field="address_name_owner" dataType="Text" parameterType="Control" parameterSource="address_name_owner"/>
				<CustomParameter id="694" field="t_vat_registration_id" dataType="Float" parameterType="Control" parameterSource="t_vat_registration_id"/>
			</IFormElements>
			<USPParameters>
				<SPParameter id="Key905" dataType="Char" parameterType="URL" dataSize="255" direction="ReturnValue" scale="0" precision="0" parameterName="o_res" parameterSource="o_res"/>
				<SPParameter id="Key906" parameterName="icode" parameterSource="icode" dataType="Char" parameterType="URL" dataSize="255" direction="Input" scale="0" precision="0"/>
				<SPParameter id="Key907" parameterName="iuser" parameterSource="CCGetUserLogin()" dataType="Char" parameterType="Expression" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key908" parameterName="cusorderid" parameterSource="t_customer_order_id" dataType="Numeric" parameterType="Control" dataSize="28" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key909" parameterName="regionidkel" parameterSource="p_region_id_kelurahan" dataType="Numeric" parameterType="Control" dataSize="28" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key910" parameterName="regionidkec" parameterSource="p_region_id_kecamatan" dataType="Numeric" parameterType="Control" dataSize="28" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key911" parameterName="regionid" parameterSource="p_region_id" dataType="Numeric" parameterType="Control" dataSize="28" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key912" parameterName="regionidkelown" parameterSource="p_region_id_kel_owner" dataType="Numeric" parameterType="Control" dataSize="28" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key913" parameterName="regionidkecown" parameterSource="p_region_id_kec_owner" dataType="Numeric" parameterType="Control" dataSize="28" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key914" parameterName="regionidown" parameterSource="p_region_id_owner" dataType="Numeric" parameterType="Control" dataSize="28" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key915" parameterName="companyname" parameterSource="company_name" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key916" parameterName="addressname" parameterSource="address_name" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key917" parameterName="jobid" parameterSource="p_job_position_id" dataType="Numeric" parameterType="Control" dataSize="28" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key918" parameterName="companybrand" parameterSource="company_brand" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key919" parameterName="addressno" parameterSource="address_no" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key920" parameterName="addressrt" parameterSource="address_rt" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key921" parameterName="addressrw" parameterSource="address_rw" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key922" parameterName="addressnoown" parameterSource="address_no_owner" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key923" parameterName="addressrtown" parameterSource="address_rt_owner" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key924" parameterName="addressrwown" parameterSource="address_rw_owner" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key925" parameterName="phoneno" parameterSource="phone_no" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key926" parameterName="faxno" parameterSource="fax_no" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key927" parameterName="zipcode" parameterSource="zip_code" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key928" parameterName="phonenoown" parameterSource="phone_no_owner" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key929" parameterName="companyown" parameterSource="company_owner" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key930" parameterName="mobilenoown" parameterSource="mobile_no_owner" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key931" parameterName="faxnoown" parameterSource="fax_no_owner" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key932" parameterName="zipcodeown" parameterSource="zip_code_owner" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key933" parameterName="mobileno" parameterSource="mobile_no" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key934" parameterName="addressnameown" parameterSource="address_name_owner" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key935" parameterName="i_email" parameterSource="email" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key940" parameterName="vattypedtlid" parameterSource="p_vat_type_dtl_id" dataType="Numeric" parameterType="Control" dataSize="28" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key941" parameterName="wpusername" parameterSource="wp_user_name" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key942" parameterName="wpuserpwd" parameterSource="wp_user_pwd" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key943" parameterName="wpname" parameterSource="wp_name" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key944" parameterName="wpaddressname" parameterSource="wp_address_name" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key945" parameterName="wpaddressno" parameterSource="wp_address_no" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key946" parameterName="wprt" parameterSource="wp_address_rt" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key947" parameterName="wprw" parameterSource="wp_address_rw" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key948" parameterName="wpkel" parameterSource="wp_p_region_id_kelurahan" dataType="Numeric" parameterType="Control" dataSize="28" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key949" parameterName="wpkec" parameterSource="wp_p_region_id_kecamatan" dataType="Numeric" parameterType="Control" dataSize="28" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key950" parameterName="wpkota" parameterSource="wp_p_region_id" dataType="Numeric" parameterType="Control" dataSize="28" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key951" parameterName="wpphoneno" parameterSource="wp_phone_no" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key952" parameterName="wpmobileno" parameterSource="wp_mobile_no" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key953" parameterName="wpfaxno" parameterSource="wp_fax_no" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key954" parameterName="wpzipcode" parameterSource="wp_zip_code" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key955" parameterName="wpemail" parameterSource="wp_email" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key956" parameterName="brandaddress" parameterSource="brand_address_name" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key957" parameterName="brandno" parameterSource="brand_address_no" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key958" parameterName="brandrt" parameterSource="brand_address_rt" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key959" parameterName="brandrw" parameterSource="brand_address_rw" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key960" parameterName="brandkel" parameterSource="brand_p_region_id_kel" dataType="Numeric" parameterType="Control" dataSize="28" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key961" parameterName="brandkec" parameterSource="brand_p_region_id_kec" dataType="Numeric" parameterType="Control" dataSize="28" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key962" parameterName="brandkota" parameterSource="brand_p_region_id" dataType="Numeric" parameterType="Control" dataSize="28" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key963" parameterName="brandphoneno" parameterSource="brand_phone_no" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key964" parameterName="brandmobileno" parameterSource="brand_mobile_no" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key965" parameterName="brandfaxno" parameterSource="brand_fax_no" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key966" parameterName="brandzipcode" parameterSource="brand_zip_code" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key967" parameterName="idvat" parameterSource="t_vat_registration_id" dataType="Numeric" parameterType="Control" dataSize="28" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key968" parameterName="questionid" parameterSource="p_private_question_id" dataType="Numeric" parameterType="Control" dataSize="28" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key969" parameterName="privateanswer" parameterSource="private_answer" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key970" parameterName="i_mode" parameterSource="'U'" dataType="Char" parameterType="Expression" dataSize="255" direction="Input" scale="10" precision="6"/>
			</USPParameters>
			<USQLParameters>
			</USQLParameters>
			<UConditions>
				<TableParameter id="777" conditionType="Parameter" useIsNull="False" field="t_customer_order_id" dataType="Float" searchConditionType="Equal" parameterType="Control" logicOperator="And" parameterSource="t_customer_order_id"/>
				<TableParameter id="778" conditionType="Parameter" useIsNull="False" field="t_vat_registration_id" dataType="Float" searchConditionType="Equal" parameterType="Control" logicOperator="And" parameterSource="t_vat_registration_id"/>
			</UConditions>
			<UFormElements>
				<CustomParameter id="736" field="created_by" dataType="Text" parameterType="Control" parameterSource="created_by"/>
				<CustomParameter id="737" field="updated_by" dataType="Text" parameterType="Control" parameterSource="updated_by"/>
				<CustomParameter id="738" field="creation_date" dataType="Text" parameterType="Control" parameterSource="creation_date" format="dd-mmm-yyyy"/>
				<CustomParameter id="739" field="updated_date" dataType="Text" parameterType="Control" parameterSource="updated_date" format="dd-mmm-yyyy"/>
				<CustomParameter id="740" field="order_no" dataType="Text" parameterType="Control" parameterSource="order_no"/>
				<CustomParameter id="741" field="registration_date" dataType="Text" parameterType="Control" parameterSource="registration_date" format="dd-mmm-yyyy"/>
				<CustomParameter id="742" field="t_customer_order_id" dataType="Float" parameterType="Control" parameterSource="t_customer_order_id"/>
				<CustomParameter id="743" field="kelurahan_code" dataType="Text" parameterType="Control" parameterSource="kelurahan_code"/>
				<CustomParameter id="744" field="kecamatan_code" dataType="Text" parameterType="Control" parameterSource="kecamatan_code"/>
				<CustomParameter id="745" field="kota_code" dataType="Text" parameterType="Control" parameterSource="kota_code"/>
				<CustomParameter id="746" field="p_region_id_kelurahan" dataType="Float" parameterType="Control" parameterSource="p_region_id_kelurahan"/>
				<CustomParameter id="747" field="p_region_id_kecamatan" dataType="Float" parameterType="Control" parameterSource="p_region_id_kecamatan"/>
				<CustomParameter id="748" field="p_region_id" dataType="Float" parameterType="Control" parameterSource="p_region_id"/>
				<CustomParameter id="749" field="kelurahan_own_code" dataType="Text" parameterType="Control" parameterSource="kelurahan_own_code"/>
				<CustomParameter id="750" field="kecamatan_own_code" dataType="Text" parameterType="Control" parameterSource="kecamatan_own_code"/>
				<CustomParameter id="751" field="kota_own_code" dataType="Text" parameterType="Control" parameterSource="kota_own_code"/>
				<CustomParameter id="752" field="p_region_id_kel_owner" dataType="Float" parameterType="Control" parameterSource="p_region_id_kel_owner"/>
				<CustomParameter id="753" field="p_region_id_kec_owner" dataType="Float" parameterType="Control" parameterSource="p_region_id_kec_owner"/>
				<CustomParameter id="754" field="p_region_id_owner" dataType="Float" parameterType="Control" parameterSource="p_region_id_owner"/>
				<CustomParameter id="755" field="company_name" dataType="Text" parameterType="Control" parameterSource="company_name"/>
				<CustomParameter id="756" field="address_name" dataType="Text" parameterType="Control" parameterSource="address_name"/>
				<CustomParameter id="757" field="job_position_code" dataType="Text" parameterType="Control" parameterSource="job_position_code"/>
				<CustomParameter id="758" field="p_job_position_id" dataType="Float" parameterType="Control" parameterSource="p_job_position_id"/>
				<CustomParameter id="759" field="company_brand" dataType="Text" parameterType="Control" parameterSource="company_brand"/>
				<CustomParameter id="760" field="address_no" dataType="Text" parameterType="Control" parameterSource="address_no"/>
				<CustomParameter id="761" field="address_rt" dataType="Text" parameterType="Control" parameterSource="address_rt"/>
				<CustomParameter id="762" field="address_rw" dataType="Text" parameterType="Control" parameterSource="address_rw"/>
				<CustomParameter id="763" field="address_no_owner" dataType="Text" parameterType="Control" parameterSource="address_no_owner"/>
				<CustomParameter id="764" field="address_rt_owner" dataType="Text" parameterType="Control" parameterSource="address_rt_owner"/>
				<CustomParameter id="765" field="address_rw_owner" dataType="Text" parameterType="Control" parameterSource="address_rw_owner"/>
				<CustomParameter id="766" field="phone_no" dataType="Text" parameterType="Control" parameterSource="phone_no"/>
				<CustomParameter id="767" field="fax_no" dataType="Text" parameterType="Control" parameterSource="fax_no"/>
				<CustomParameter id="768" field="zip_code" dataType="Text" parameterType="Control" parameterSource="zip_code"/>
				<CustomParameter id="769" field="phone_no_owner" dataType="Text" parameterType="Control" parameterSource="phone_no_owner"/>
				<CustomParameter id="770" field="company_owner" dataType="Text" parameterType="Control" parameterSource="company_owner"/>
				<CustomParameter id="771" field="mobile_no_owner" dataType="Text" parameterType="Control" parameterSource="mobile_no_owner"/>
				<CustomParameter id="772" field="fax_no_owner" dataType="Text" parameterType="Control" parameterSource="fax_no_owner"/>
				<CustomParameter id="773" field="zip_code_owner" dataType="Text" parameterType="Control" parameterSource="zip_code_owner"/>
				<CustomParameter id="774" field="mobile_no" dataType="Text" parameterType="Control" parameterSource="mobile_no"/>
				<CustomParameter id="775" field="address_name_owner" dataType="Text" parameterType="Control" parameterSource="address_name_owner"/>
				<CustomParameter id="776" field="t_vat_registration_id" dataType="Float" parameterType="Control" parameterSource="t_vat_registration_id"/>
			</UFormElements>
			<DSPParameters>
				<SPParameter id="Key905" dataType="Char" parameterType="URL" dataSize="255" direction="ReturnValue" scale="0" precision="0"/>
				<SPParameter id="Key906" parameterName="icode" parameterSource="icode" dataType="Char" parameterType="URL" dataSize="255" direction="Input" scale="0" precision="0"/>
				<SPParameter id="Key907" parameterName="iuser" parameterSource="iuser" dataType="Char" parameterType="URL" dataSize="255" direction="Input" scale="0" precision="0"/>
				<SPParameter id="Key908" parameterName="cusorderid" parameterSource="cusorderid" dataType="Numeric" parameterType="URL" dataSize="28" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key909" parameterName="regionidkel" parameterSource="regionidkel" dataType="Numeric" parameterType="URL" dataSize="28" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key910" parameterName="regionidkec" parameterSource="regionidkec" dataType="Numeric" parameterType="URL" dataSize="28" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key911" parameterName="regionid" parameterSource="regionid" dataType="Numeric" parameterType="URL" dataSize="28" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key912" parameterName="regionidkelown" parameterSource="regionidkelown" dataType="Numeric" parameterType="URL" dataSize="28" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key913" parameterName="regionidkecown" parameterSource="regionidkecown" dataType="Numeric" parameterType="URL" dataSize="28" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key914" parameterName="regionidown" parameterSource="regionidown" dataType="Numeric" parameterType="URL" dataSize="28" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key915" parameterName="companyname" parameterSource="companyname" dataType="Char" parameterType="URL" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key916" parameterName="addressname" parameterSource="addressname" dataType="Char" parameterType="URL" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key917" parameterName="jobid" parameterSource="jobid" dataType="Numeric" parameterType="URL" dataSize="28" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key918" parameterName="companybrand" parameterSource="companybrand" dataType="Char" parameterType="URL" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key919" parameterName="addressno" parameterSource="addressno" dataType="Char" parameterType="URL" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key920" parameterName="addressrt" parameterSource="addressrt" dataType="Char" parameterType="URL" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key921" parameterName="addressrw" parameterSource="addressrw" dataType="Char" parameterType="URL" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key922" parameterName="addressnoown" parameterSource="addressnoown" dataType="Char" parameterType="URL" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key923" parameterName="addressrtown" parameterSource="addressrtown" dataType="Char" parameterType="URL" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key924" parameterName="addressrwown" parameterSource="addressrwown" dataType="Char" parameterType="URL" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key925" parameterName="phoneno" parameterSource="phoneno" dataType="Char" parameterType="URL" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key926" parameterName="faxno" parameterSource="faxno" dataType="Char" parameterType="URL" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key927" parameterName="zipcode" parameterSource="zipcode" dataType="Char" parameterType="URL" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key928" parameterName="phonenoown" parameterSource="phonenoown" dataType="Char" parameterType="URL" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key929" parameterName="companyown" parameterSource="companyown" dataType="Char" parameterType="URL" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key930" parameterName="mobilenoown" parameterSource="mobilenoown" dataType="Char" parameterType="URL" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key931" parameterName="faxnoown" parameterSource="faxnoown" dataType="Char" parameterType="URL" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key932" parameterName="zipcodeown" parameterSource="zipcodeown" dataType="Char" parameterType="URL" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key933" parameterName="mobileno" parameterSource="mobileno" dataType="Char" parameterType="URL" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key934" parameterName="addressnameown" parameterSource="addressnameown" dataType="Char" parameterType="URL" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key935" parameterName="i_email" parameterSource="i_email" dataType="Char" parameterType="URL" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key940" parameterName="vattypedtlid" parameterSource="vattypedtlid" dataType="Numeric" parameterType="URL" dataSize="28" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key941" parameterName="wpusername" parameterSource="wpusername" dataType="Char" parameterType="URL" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key942" parameterName="wpuserpwd" parameterSource="wpuserpwd" dataType="Char" parameterType="URL" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key943" parameterName="wpname" parameterSource="wpname" dataType="Char" parameterType="URL" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key944" parameterName="wpaddressname" parameterSource="wpaddressname" dataType="Char" parameterType="URL" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key945" parameterName="wpaddressno" parameterSource="wpaddressno" dataType="Char" parameterType="URL" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key946" parameterName="wprt" parameterSource="wprt" dataType="Char" parameterType="URL" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key947" parameterName="wprw" parameterSource="wprw" dataType="Char" parameterType="URL" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key948" parameterName="wpkel" parameterSource="wpkel" dataType="Numeric" parameterType="URL" dataSize="28" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key949" parameterName="wpkec" parameterSource="wpkec" dataType="Numeric" parameterType="URL" dataSize="28" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key950" parameterName="wpkota" parameterSource="wpkota" dataType="Numeric" parameterType="URL" dataSize="28" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key951" parameterName="wpphoneno" parameterSource="wpphoneno" dataType="Char" parameterType="URL" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key952" parameterName="wpmobileno" parameterSource="wpmobileno" dataType="Char" parameterType="URL" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key953" parameterName="wpfaxno" parameterSource="wpfaxno" dataType="Char" parameterType="URL" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key954" parameterName="wpzipcode" parameterSource="wpzipcode" dataType="Char" parameterType="URL" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key955" parameterName="wpemail" parameterSource="wpemail" dataType="Char" parameterType="URL" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key956" parameterName="brandaddress" parameterSource="brandaddress" dataType="Char" parameterType="URL" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key957" parameterName="brandno" parameterSource="brandno" dataType="Char" parameterType="URL" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key958" parameterName="brandrt" parameterSource="brandrt" dataType="Char" parameterType="URL" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key959" parameterName="brandrw" parameterSource="brandrw" dataType="Char" parameterType="URL" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key960" parameterName="brandkel" parameterSource="brandkel" dataType="Numeric" parameterType="URL" dataSize="28" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key961" parameterName="brandkec" parameterSource="brandkec" dataType="Numeric" parameterType="URL" dataSize="28" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key962" parameterName="brandkota" parameterSource="brandkota" dataType="Numeric" parameterType="URL" dataSize="28" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key963" parameterName="brandphoneno" parameterSource="brandphoneno" dataType="Char" parameterType="URL" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key964" parameterName="brandmobileno" parameterSource="brandmobileno" dataType="Char" parameterType="URL" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key965" parameterName="brandfaxno" parameterSource="brandfaxno" dataType="Char" parameterType="URL" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key966" parameterName="brandzipcode" parameterSource="brandzipcode" dataType="Char" parameterType="URL" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key967" parameterName="idvat" parameterSource="t_vat_registration_id" dataType="Numeric" parameterType="Control" dataSize="28" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key968" parameterName="questionid" parameterSource="questionid" dataType="Numeric" parameterType="URL" dataSize="28" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key969" parameterName="privateanswer" parameterSource="privateanswer" dataType="Char" parameterType="URL" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="Key970" parameterName="i_mode" parameterSource="'D'" dataType="Char" parameterType="Expression" dataSize="255" direction="Input" scale="10" precision="6"/>
			</DSPParameters>
			<DSQLParameters>
			</DSQLParameters>
			<DConditions>
			</DConditions>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Record>
	</Components>
	<CodeFiles>
		<CodeFile id="Events" language="PHPTemplates" name="t_vat_registration_events.php" forShow="False" comment="//" codePage="windows-1252"/>
		<CodeFile id="Code" language="PHPTemplates" name="t_vat_registration.php" forShow="True" url="t_vat_registration.php" comment="//" codePage="windows-1252"/>
	</CodeFiles>
	<SecurityGroups/>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events>
	</Events>
</Page>
