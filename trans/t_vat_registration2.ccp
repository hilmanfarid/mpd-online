<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\trans" secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="RWNet" wizardThemeVersion="3.0" needGeneration="0">
	<Components>
		<Record id="94" sourceType="Table" urlType="Relative" secured="False" allowInsert="True" allowUpdate="True" allowDelete="True" validateData="True" preserveParameters="GET" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" connection="ConnSIKP" name="t_vat_registrationForm" errorSummator="Error" wizardCaption="Add/Edit V P App User " wizardFormMethod="post" PathID="t_vat_registrationForm" activeCollection="USQLParameters" pasteAsReplace="pasteAsReplace" pasteActions="pasteActions" customDeleteType="SQL" parameterTypeListName="ParameterTypeList" customUpdateType="SQL" customInsertType="SQL" customUpdate="UPDATE t_vat_registration SET 
updated_by='{updated_by}', 
updated_date=sysdate, 
registration_date=to_date('{registration_date}','DD-MON-YYYY HH24:MI:SS'),  
p_region_id_kelurahan={p_region_id_kelurahan}, 
p_region_id_kecamatan={p_region_id_kecamatan}, 
p_region_id={p_region_id}, 
p_region_id_kel_owner={p_region_id_kel_owner}, 
p_region_id_kec_owner={p_region_id_kec_owner}, 
p_region_id_owner={p_region_id_owner}, 
company_name='{company_name}', 
address_name='{address_name}', 
p_job_position_id={p_job_position_id}, 
company_brand='{company_brand}', 
address_no='{address_no}', 
address_rt='{address_rt}', 
address_rw='{address_rw}', 
address_no_owner='{address_no_owner}', 
address_rt_owner='{address_rt_owner}', 
address_rw_owner='{address_rw_owner}', 
phone_no='{phone_no}', 
fax_no='{fax_no}', 
zip_code='{zip_code}', 
phone_no_owner='{phone_no_owner}', 
company_owner='{company_owner}', 
mobile_no_owner='{mobile_no_owner}', 
fax_no_owner='{fax_no_owner}', 
zip_code_owner='{zip_code_owner}',
mobile_no='{mobile_no}', 
address_name_owner='{address_name_owner}',
email='{email}',
company_additional_addr='{company_additional_addr}',
p_hotel_grade_id=decode({p_hotel_grade_id},0,null,{p_hotel_grade_id}),
p_rest_service_type_id=decode({p_rest_service_type_id},0,null,{p_rest_service_type_id}),
p_entertaintment_type_id=decode({p_entertaintment_type_id},0,null,{p_entertaintment_type_id}),
p_parking_classification_id=decode({p_parking_classification_id},0,null,{p_parking_classification_id})
WHERE  t_customer_order_id = {t_customer_order_id} 
AND t_vat_registration_id = {t_vat_registration_id}" customDelete="DELETE FROM t_vat_registration 
WHERE  t_vat_registration_id = {t_vat_registration_id} 
AND t_customer_order_id = {t_customer_order_id}" dataSource="v_vat_registration" customInsert="INSERT INTO t_vat_registration(t_vat_registration_id, created_by, updated_by, creation_date, updated_date, registration_date, 
t_customer_order_id, p_region_id_kelurahan, p_region_id_kecamatan, p_region_id, 
p_region_id_kel_owner, p_region_id_kec_owner, p_region_id_owner, company_name, address_name, 
p_job_position_id, company_brand, address_no, address_rt, address_rw, address_no_owner, address_rt_owner, 
address_rw_owner, phone_no, fax_no, zip_code, phone_no_owner, company_owner, mobile_no_owner, 
fax_no_owner, zip_code_owner, mobile_no, address_name_owner, email, company_additional_addr, p_hotel_grade_id, p_rest_service_type_id, p_entertaintment_type_id, p_parking_classification_id) 
VALUES(generate_id('sikp','t_vat_registration','t_vat_registration_id'), '{created_by}', '{updated_by}', sysdate, sysdate, to_date('{registration_date}','DD-MON-YYYY HH24:MI:SS'), 
{t_customer_order_id}, {p_region_id_kelurahan}, {p_region_id_kecamatan}, {p_region_id}, 
{p_region_id_kel_owner}, {p_region_id_kec_owner}, {p_region_id_owner}, '{company_name}', '{address_name}', 
{p_job_position_id}, '{company_brand}', '{address_no}', '{address_rt}', '{address_rw}', '{address_no_owner}', '{address_rt_owner}', 
'{address_rw_owner}', '{phone_no}', '{fax_no}', '{zip_code}', '{phone_no_owner}', '{company_owner}', '{mobile_no_owner}', 
'{fax_no_owner}', '{zip_code_owner}', '{mobile_no}', '{address_name_owner}', '{email}', '{company_additional_addr}', 
decode({p_hotel_grade_id},0,null,{p_hotel_grade_id}), decode({p_rest_service_type_id},0,null,{p_rest_service_type_id}), decode({p_entertaintment_type_id},0,null,{p_entertaintment_type_id}), decode({p_parking_classification_id},0,null,{p_parking_classification_id}))" activeTableType="customDelete">
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
				<TextBox id="620" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="kelurahan_code" fieldSource="kelurahan_code" required="True" caption="Kelurahan" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_registrationFormkelurahan_code">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="621" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="kecamatan_code" fieldSource="kecamatan_code" required="True" caption="Kecamatan" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_registrationFormkecamatan_code">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="622" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="kota_code" fieldSource="kota_code" required="True" caption="Kota/Kabupaten" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_registrationFormkota_code">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Hidden id="623" fieldSourceType="DBColumn" dataType="Float" name="p_region_id_kelurahan" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_vat_registrationFormp_region_id_kelurahan" fieldSource="p_region_id_kelurahan" caption="p_region_id_kelurahan">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="624" fieldSourceType="DBColumn" dataType="Float" name="p_region_id_kecamatan" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_vat_registrationFormp_region_id_kecamatan" fieldSource="p_region_id_kecamatan" caption="p_region_id_kecamatan">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="625" fieldSourceType="DBColumn" dataType="Float" name="p_region_id" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_vat_registrationFormp_region_id" fieldSource="p_region_id" caption="p_region_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<TextBox id="626" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="kelurahan_own_code" fieldSource="kelurahan_own_code" required="True" caption="Kelurahan" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_registrationFormkelurahan_own_code">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="627" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="kecamatan_own_code" fieldSource="kecamatan_own_code" required="True" caption="Kecamatan" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_registrationFormkecamatan_own_code">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="628" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="kota_own_code" fieldSource="kota_own_code" required="True" caption="Kota/Kabupaten" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_registrationFormkota_own_code">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Hidden id="629" fieldSourceType="DBColumn" dataType="Float" name="p_region_id_kel_owner" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_vat_registrationFormp_region_id_kel_owner" fieldSource="p_region_id_kel_owner" caption="p_order_status_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="630" fieldSourceType="DBColumn" dataType="Float" name="p_region_id_kec_owner" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_vat_registrationFormp_region_id_kec_owner" fieldSource="p_region_id_kec_owner" caption="p_order_status_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="631" fieldSourceType="DBColumn" dataType="Float" name="p_region_id_owner" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_vat_registrationFormp_region_id_owner" fieldSource="p_region_id_owner" caption="p_order_status_id">
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
				<TextArea id="633" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="address_name" fieldSource="address_name" required="True" caption="Alamat" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_registrationFormaddress_name">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextArea>
				<TextBox id="565" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="job_position_code" fieldSource="job_position_code" required="True" caption="Jabatan" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_registrationFormjob_position_code">
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
				<TextBox id="634" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="company_brand" fieldSource="company_brand" required="True" caption="Merek Usaha" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_registrationFormcompany_brand">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="635" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="address_no" fieldSource="address_no" required="True" caption="No" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_registrationFormaddress_no">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="636" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="address_rt" fieldSource="address_rt" required="False" caption="Rt" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_registrationFormaddress_rt">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="637" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="address_rw" fieldSource="address_rw" required="False" caption="Rw" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_registrationFormaddress_rw">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="638" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="address_no_owner" fieldSource="address_no_owner" required="True" caption="No" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_registrationFormaddress_no_owner">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="639" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="address_rt_owner" fieldSource="address_rt_owner" required="False" caption="Rt" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_registrationFormaddress_rt_owner">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="640" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="address_rw_owner" fieldSource="address_rw_owner" required="False" caption="Rw" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_registrationFormaddress_rw_owner">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="641" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="phone_no" fieldSource="phone_no" required="False" caption="No. Telephon" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_registrationFormphone_no">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="643" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="fax_no" fieldSource="fax_no" required="False" caption="No. Fax" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_registrationFormfax_no">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="644" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="zip_code" fieldSource="zip_code" required="False" caption="Kode Pos" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_registrationFormzip_code">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="646" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="phone_no_owner" fieldSource="phone_no_owner" required="False" caption="No. Telephon" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_registrationFormphone_no_owner">
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
				<TextBox id="648" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="mobile_no_owner" fieldSource="mobile_no_owner" required="False" caption="No. Handphone" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_registrationFormmobile_no_owner">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="649" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="fax_no_owner" fieldSource="fax_no_owner" required="False" caption="No. Fax" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_registrationFormfax_no_owner">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="650" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="zip_code_owner" fieldSource="zip_code_owner" required="False" caption="Kode Pos" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_registrationFormzip_code_owner">
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
				<TextArea id="652" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="address_name_owner" fieldSource="address_name_owner" required="True" caption="Alamat" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_registrationFormaddress_name_owner">
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
				<TextBox id="825" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="email" fieldSource="email" required="False" caption="Email" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_registrationFormemail" inputMask="^[\w\.-]{1,}\@([\da-zA-Z-]{1,}\.){1,}[\da-zA-Z-]+$">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextArea id="828" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="company_additional_addr" fieldSource="company_additional_addr" required="True" caption="Alamat Badan" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_registrationFormcompany_additional_addr">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextArea>
				<Label id="831" fieldSourceType="DBColumn" dataType="Text" html="False" name="Label1" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_vat_registrationFormLabel1">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<ListBox id="832" visible="Dynamic" fieldSourceType="DBColumn" sourceType="Table" dataType="Float" returnValueType="Number" name="p_hotel_grade_id" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" wizardEmptyCaption="Select Value" PathID="t_vat_registrationFormp_hotel_grade_id" connection="ConnSIKP" dataSource="p_hotel_grade" activeCollection="TableParameters" boundColumn="p_hotel_grade_id" textColumn="grade_name" fieldSource="p_hotel_grade_id">
					<Components/>
					<Events/>
					<TableParameters/>
					<SPParameters/>
					<SQLParameters/>
					<JoinTables>
						<JoinTable id="833" tableName="p_hotel_grade" schemaName="sikp" posLeft="10" posTop="10" posWidth="133" posHeight="180"/>
					</JoinTables>
					<JoinLinks/>
					<Fields/>
					<Attributes/>
					<Features/>
				</ListBox>
				<ListBox id="834" visible="Dynamic" fieldSourceType="DBColumn" sourceType="Table" dataType="Float" returnValueType="Number" name="p_rest_service_type_id" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" wizardEmptyCaption="Select Value" PathID="t_vat_registrationFormp_rest_service_type_id" connection="ConnSIKP" activeCollection="TableParameters" boundColumn="p_rest_service_type_id" textColumn="code" fieldSource="p_rest_service_type_id" dataSource="p_rest_service_type">
					<Components/>
					<Events/>
					<TableParameters/>
					<SPParameters/>
					<SQLParameters/>
					<JoinTables>
						<JoinTable id="835" tableName="p_rest_service_type" posLeft="10" posTop="10" posWidth="160" posHeight="168"/>
					</JoinTables>
					<JoinLinks/>
					<Fields/>
					<Attributes/>
					<Features/>
				</ListBox>
				<ListBox id="836" visible="Dynamic" fieldSourceType="DBColumn" sourceType="Table" dataType="Float" returnValueType="Number" name="p_entertaintment_type_id" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" wizardEmptyCaption="Select Value" PathID="t_vat_registrationFormp_entertaintment_type_id" connection="ConnSIKP" activeCollection="TableParameters" boundColumn="p_entertaintment_type_id" textColumn="code" fieldSource="p_entertaintment_type_id" dataSource="p_entertaintment_type">
					<Components/>
					<Events/>
					<TableParameters/>
					<SPParameters/>
					<SQLParameters/>
					<JoinTables>
						<JoinTable id="840" tableName="p_entertaintment_type" posLeft="10" posTop="10" posWidth="160" posHeight="180"/>
					</JoinTables>
					<JoinLinks/>
					<Fields/>
					<Attributes/>
					<Features/>
				</ListBox>
				<ListBox id="838" visible="Dynamic" fieldSourceType="DBColumn" sourceType="Table" dataType="Float" returnValueType="Number" name="p_parking_classification_id" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" wizardEmptyCaption="Select Value" PathID="t_vat_registrationFormp_parking_classification_id" connection="ConnSIKP" activeCollection="TableParameters" boundColumn="p_parking_classification_id" textColumn="code" fieldSource="p_parking_classification_id" dataSource="p_parking_classification">
					<Components/>
					<Events/>
					<TableParameters/>
					<SPParameters/>
					<SQLParameters/>
					<JoinTables>
						<JoinTable id="841" tableName="p_parking_classification" posLeft="10" posTop="10" posWidth="160" posHeight="168"/>
					</JoinTables>
					<JoinLinks/>
					<Fields/>
					<Attributes/>
					<Features/>
				</ListBox>
				<Button id="851" urlType="Relative" enableValidation="True" isDefault="False" name="Button1" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_vat_registrationFormButton1">
					<Components/>
					<Events/>
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
				<TableParameter id="619" conditionType="Parameter" useIsNull="False" field="t_customer_order_id" dataType="Float" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="t_customer_order_id"/>
			</TableParameters>
			<SPParameters/>
			<SQLParameters>
			</SQLParameters>
			<JoinTables>
				<JoinTable id="618" tableName="v_vat_registration" posLeft="10" posTop="10" posWidth="160" posHeight="180"/>
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
				<SQLParameter id="695" variable="created_by" dataType="Text" parameterType="Expression" parameterSource="CCGetUserLogin()"/>
				<SQLParameter id="696" variable="updated_by" dataType="Text" parameterType="Expression" parameterSource="CCGetUserLogin()"/>
				<SQLParameter id="700" variable="registration_date" dataType="Text" parameterType="Control" parameterSource="registration_date" format="dd-mmm-yyyy"/>
				<SQLParameter id="701" variable="t_customer_order_id" dataType="Float" parameterType="Control" parameterSource="t_customer_order_id"/>
				<SQLParameter id="705" variable="p_region_id_kelurahan" dataType="Float" parameterType="Control" parameterSource="p_region_id_kelurahan"/>
				<SQLParameter id="706" variable="p_region_id_kecamatan" dataType="Float" parameterType="Control" parameterSource="p_region_id_kecamatan"/>
				<SQLParameter id="707" variable="p_region_id" dataType="Float" parameterType="Control" parameterSource="p_region_id"/>
				<SQLParameter id="711" variable="p_region_id_kel_owner" dataType="Float" parameterType="Control" parameterSource="p_region_id_kel_owner"/>
				<SQLParameter id="712" variable="p_region_id_kec_owner" dataType="Float" parameterType="Control" parameterSource="p_region_id_kec_owner"/>
				<SQLParameter id="713" variable="p_region_id_owner" dataType="Float" parameterType="Control" parameterSource="p_region_id_owner"/>
				<SQLParameter id="714" variable="company_name" dataType="Text" parameterType="Control" parameterSource="company_name"/>
				<SQLParameter id="715" variable="address_name" dataType="Text" parameterType="Control" parameterSource="address_name"/>
				<SQLParameter id="717" variable="p_job_position_id" dataType="Float" parameterType="Control" parameterSource="p_job_position_id"/>
				<SQLParameter id="718" variable="company_brand" dataType="Text" parameterType="Control" parameterSource="company_brand"/>
				<SQLParameter id="719" variable="address_no" dataType="Text" parameterType="Control" parameterSource="address_no"/>
				<SQLParameter id="720" variable="address_rt" dataType="Text" parameterType="Control" parameterSource="address_rt"/>
				<SQLParameter id="721" variable="address_rw" dataType="Text" parameterType="Control" parameterSource="address_rw"/>
				<SQLParameter id="722" variable="address_no_owner" dataType="Text" parameterType="Control" parameterSource="address_no_owner"/>
				<SQLParameter id="723" variable="address_rt_owner" dataType="Text" parameterType="Control" parameterSource="address_rt_owner"/>
				<SQLParameter id="724" variable="address_rw_owner" dataType="Text" parameterType="Control" parameterSource="address_rw_owner"/>
				<SQLParameter id="725" variable="phone_no" dataType="Text" parameterType="Control" parameterSource="phone_no"/>
				<SQLParameter id="726" variable="fax_no" dataType="Text" parameterType="Control" parameterSource="fax_no"/>
				<SQLParameter id="727" variable="zip_code" dataType="Text" parameterType="Control" parameterSource="zip_code"/>
				<SQLParameter id="728" variable="phone_no_owner" dataType="Text" parameterType="Control" parameterSource="phone_no_owner"/>
				<SQLParameter id="729" variable="company_owner" dataType="Text" parameterType="Control" parameterSource="company_owner"/>
				<SQLParameter id="730" variable="mobile_no_owner" dataType="Text" parameterType="Control" parameterSource="mobile_no_owner"/>
				<SQLParameter id="731" variable="fax_no_owner" dataType="Text" parameterType="Control" parameterSource="fax_no_owner"/>
				<SQLParameter id="732" variable="zip_code_owner" dataType="Text" parameterType="Control" parameterSource="zip_code_owner"/>
				<SQLParameter id="733" variable="mobile_no" dataType="Text" parameterType="Control" parameterSource="mobile_no"/>
				<SQLParameter id="734" variable="address_name_owner" dataType="Text" parameterType="Control" parameterSource="address_name_owner"/>
				<SQLParameter id="735" variable="t_vat_registration_id" dataType="Float" parameterType="Control" parameterSource="t_vat_registration_id"/>
				<SQLParameter id="826" variable="email" parameterType="Control" dataType="Text" parameterSource="email"/>
				<SQLParameter id="829" variable="company_additional_addr" parameterType="Control" dataType="Text" parameterSource="company_additional_addr"/>
				<SQLParameter id="843" variable="p_hotel_grade_id" parameterType="Control" defaultValue="0" dataType="Float" parameterSource="p_hotel_grade_id"/>
				<SQLParameter id="844" variable="p_rest_service_type_id" parameterType="Control" defaultValue="0" dataType="Float" parameterSource="p_rest_service_type_id"/>
				<SQLParameter id="845" variable="p_entertaintment_type_id" parameterType="Control" defaultValue="0" dataType="Float" parameterSource="p_entertaintment_type_id"/>
				<SQLParameter id="846" variable="p_parking_classification_id" parameterType="Control" defaultValue="0" dataType="Float" parameterSource="p_parking_classification_id"/>
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
				<SQLParameter id="780" variable="updated_by" dataType="Text" parameterType="Expression" parameterSource="CCGetUserLogin()"/>
				<SQLParameter id="784" variable="registration_date" dataType="Text" parameterType="Control" parameterSource="registration_date" format="dd-mmm-yyyy"/>
				<SQLParameter id="785" variable="t_customer_order_id" dataType="Float" parameterType="Control" parameterSource="t_customer_order_id" defaultValue="0"/>
				<SQLParameter id="789" variable="p_region_id_kelurahan" dataType="Float" parameterType="Control" parameterSource="p_region_id_kelurahan"/>
				<SQLParameter id="790" variable="p_region_id_kecamatan" dataType="Float" parameterType="Control" parameterSource="p_region_id_kecamatan"/>
				<SQLParameter id="791" variable="p_region_id" dataType="Float" parameterType="Control" parameterSource="p_region_id"/>
				<SQLParameter id="795" variable="p_region_id_kel_owner" dataType="Float" parameterType="Control" parameterSource="p_region_id_kel_owner"/>
				<SQLParameter id="796" variable="p_region_id_kec_owner" dataType="Float" parameterType="Control" parameterSource="p_region_id_kec_owner"/>
				<SQLParameter id="797" variable="p_region_id_owner" dataType="Float" parameterType="Control" parameterSource="p_region_id_owner"/>
				<SQLParameter id="798" variable="company_name" dataType="Text" parameterType="Control" parameterSource="company_name"/>
				<SQLParameter id="799" variable="address_name" dataType="Text" parameterType="Control" parameterSource="address_name"/>
				<SQLParameter id="801" variable="p_job_position_id" dataType="Float" parameterType="Control" parameterSource="p_job_position_id"/>
				<SQLParameter id="802" variable="company_brand" dataType="Text" parameterType="Control" parameterSource="company_brand"/>
				<SQLParameter id="803" variable="address_no" dataType="Text" parameterType="Control" parameterSource="address_no"/>
				<SQLParameter id="804" variable="address_rt" dataType="Text" parameterType="Control" parameterSource="address_rt"/>
				<SQLParameter id="805" variable="address_rw" dataType="Text" parameterType="Control" parameterSource="address_rw"/>
				<SQLParameter id="806" variable="address_no_owner" dataType="Text" parameterType="Control" parameterSource="address_no_owner"/>
				<SQLParameter id="807" variable="address_rt_owner" dataType="Text" parameterType="Control" parameterSource="address_rt_owner"/>
				<SQLParameter id="808" variable="address_rw_owner" dataType="Text" parameterType="Control" parameterSource="address_rw_owner"/>
				<SQLParameter id="809" variable="phone_no" dataType="Text" parameterType="Control" parameterSource="phone_no"/>
				<SQLParameter id="810" variable="fax_no" dataType="Text" parameterType="Control" parameterSource="fax_no"/>
				<SQLParameter id="811" variable="zip_code" dataType="Text" parameterType="Control" parameterSource="zip_code"/>
				<SQLParameter id="812" variable="phone_no_owner" dataType="Text" parameterType="Control" parameterSource="phone_no_owner"/>
				<SQLParameter id="813" variable="company_owner" dataType="Text" parameterType="Control" parameterSource="company_owner"/>
				<SQLParameter id="814" variable="mobile_no_owner" dataType="Text" parameterType="Control" parameterSource="mobile_no_owner"/>
				<SQLParameter id="815" variable="fax_no_owner" dataType="Text" parameterType="Control" parameterSource="fax_no_owner"/>
				<SQLParameter id="816" variable="zip_code_owner" dataType="Text" parameterType="Control" parameterSource="zip_code_owner"/>
				<SQLParameter id="817" variable="mobile_no" dataType="Text" parameterType="Control" parameterSource="mobile_no"/>
				<SQLParameter id="818" variable="address_name_owner" dataType="Text" parameterType="Control" parameterSource="address_name_owner"/>
				<SQLParameter id="819" variable="t_vat_registration_id" dataType="Float" parameterType="Control" parameterSource="t_vat_registration_id" defaultValue="0"/>
				<SQLParameter id="827" variable="email" parameterType="Control" dataType="Text" parameterSource="email"/>
				<SQLParameter id="830" variable="company_additional_addr" parameterType="Control" dataType="Text" parameterSource="company_additional_addr"/>
				<SQLParameter id="847" variable="p_hotel_grade_id" parameterType="Control" defaultValue="0" dataType="Float" parameterSource="p_hotel_grade_id"/>
				<SQLParameter id="848" variable="p_rest_service_type_id" parameterType="Control" defaultValue="0" dataType="Float" parameterSource="p_rest_service_type_id"/>
				<SQLParameter id="849" variable="p_entertaintment_type_id" parameterType="Control" defaultValue="0" dataType="Float" parameterSource="p_entertaintment_type_id"/>
				<SQLParameter id="850" variable="p_parking_classification_id" parameterType="Control" defaultValue="0" dataType="Float" parameterSource="p_parking_classification_id"/>
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
			<DSPParameters/>
			<DSQLParameters>
				<SQLParameter id="822" variable="t_vat_registration_id" parameterType="Control" dataType="Float" parameterSource="t_vat_registration_id" defaultValue="0"/>
				<SQLParameter id="823" variable="t_customer_order_id" parameterType="Control" dataType="Float" parameterSource="t_customer_order_id" defaultValue="0"/>
			</DSQLParameters>
			<DConditions>
				<TableParameter id="820" conditionType="Parameter" useIsNull="False" field="t_vat_registration_id" dataType="Float" searchConditionType="Equal" parameterType="Control" logicOperator="And" parameterSource="t_vat_registration_id"/>
				<TableParameter id="821" conditionType="Parameter" useIsNull="False" field="t_customer_order_id" dataType="Float" searchConditionType="Equal" parameterType="Control" logicOperator="And" parameterSource="t_customer_order_id"/>
			</DConditions>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Record>
	</Components>
	<CodeFiles>
		<CodeFile id="Events" language="PHPTemplates" name="t_vat_registration2_events.php" forShow="False" comment="//" codePage="windows-1252"/>
<CodeFile id="Code" language="PHPTemplates" name="t_vat_registration2.php" forShow="True" url="t_vat_registration2.php" comment="//" codePage="windows-1252"/>
</CodeFiles>
	<SecurityGroups/>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events>
	</Events>
</Page>
