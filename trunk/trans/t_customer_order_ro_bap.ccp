<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\trans" secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="RWNet" wizardThemeVersion="3.0" needGeneration="0" pasteActions="pasteActions">
	<Components>
		<Record id="629" sourceType="SQL" urlType="Relative" secured="False" allowInsert="True" allowUpdate="True" allowDelete="True" validateData="True" preserveParameters="GET" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" connection="ConnSIKP" name="t_vat_registrationForm" errorSummator="Error" wizardCaption="Add/Edit V P App User " wizardFormMethod="post" PathID="t_vat_registrationForm" activeCollection="USQLParameters" pasteAsReplace="pasteAsReplace" pasteActions="pasteActions" customDeleteType="SQL" parameterTypeListName="ParameterTypeList" customUpdateType="SQL" customInsertType="SQL" customUpdate="UPDATE t_vat_registration SET 
npwpd = '{npwpd}'
WHERE  t_customer_order_id = {t_customer_order_id} 
AND t_vat_registration_id = {t_vat_registration_id}" customDelete="DELETE FROM t_vat_registration 
WHERE  t_vat_registration_id = {t_vat_registration_id} 
AND t_customer_order_id = {t_customer_order_id}" customInsert="INSERT INTO t_vat_registration(t_vat_registration_id, created_by, updated_by, creation_date, updated_date, registration_date, 
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
decode({p_hotel_grade_id},0,null,{p_hotel_grade_id}), decode({p_rest_service_type_id},0,null,{p_rest_service_type_id}), decode({p_entertaintment_type_id},0,null,{p_entertaintment_type_id}), decode({p_parking_classification_id},0,null,{p_parking_classification_id}))" activeTableType="customDelete" dataSource="SELECT * 
FROM v_vat_registration
WHERE t_customer_order_id = {CURR_DOC_ID} ">
			<Components>
				<Button id="630" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Insert" operation="Insert" wizardCaption="Add" PathID="t_vat_registrationFormButton_Insert" removeParameters="FLAG">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="631" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Update" operation="Update" wizardCaption="Submit" PathID="t_vat_registrationFormButton_Update">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="632" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Delete" operation="Delete" wizardCaption="Delete" PathID="t_vat_registrationFormButton_Delete" removeParameters="FLAG;t_vat_registration_id">
					<Components/>
					<Events>
						<Event name="OnClick" type="Client">
							<Actions>
								<Action actionName="Confirmation Message" actionCategory="General" id="633" message="Delete record?"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="634" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Cancel" operation="Cancel" wizardCaption="Cancel" PathID="t_vat_registrationFormButton_Cancel" returnPage="t_customer_order.ccp" removeParameters="FLAG">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<TextBox id="635" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="created_by" fieldSource="created_by" required="False" caption="Created By" wizardCaption="Created By" wizardSize="16" wizardMaxLength="16" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_registrationFormcreated_by" defaultValue="CCGetUserLogin()">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="636" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="updated_by" fieldSource="updated_by" required="False" caption="Updated By" wizardCaption="Updated By" wizardSize="16" wizardMaxLength="16" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_registrationFormupdated_by" defaultValue="CCGetUserLogin()">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="637" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="creation_date" fieldSource="creation_date" required="False" caption="Creation Date" wizardCaption="Creation Date" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_registrationFormcreation_date" format="dd-mmm-yyyy" defaultValue="date(&quot;d-M-Y&quot;)">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="638" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="updated_date" fieldSource="updated_date" required="False" caption="Updated Date" wizardCaption="Updated Date" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_registrationFormupdated_date" defaultValue="date(&quot;d-M-Y&quot;)" format="dd-mmm-yyyy">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="639" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="order_no" fieldSource="order_no" caption="Nomor Order" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_registrationFormorder_no">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="33" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="registration_date" fieldSource="registration_date" caption="Tanggal Pendaftaran" wizardCaption="Valid From" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_registrationFormregistration_date" defaultValue="date(&quot;d-M-Y h:i:s&quot;)" format="dd-mmm-yyyy H:nn:ss">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Hidden id="640" fieldSourceType="DBColumn" dataType="Float" name="t_customer_order_id" fieldSource="t_customer_order_id" caption="Id" wizardCaption="P App User Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_registrationFormt_customer_order_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<TextBox id="620" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="kelurahan_code" fieldSource="kelurahan_code" caption="Kelurahan" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_registrationFormkelurahan_code">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="621" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="kecamatan_code" fieldSource="kecamatan_code" caption="Kecamatan" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_registrationFormkecamatan_code">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="641" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="kota_code" fieldSource="kota_code" caption="Kota/Kabupaten" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_registrationFormkota_code">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Hidden id="642" fieldSourceType="DBColumn" dataType="Float" name="p_region_id_kelurahan" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_vat_registrationFormp_region_id_kelurahan" fieldSource="p_region_id_kelurahan" caption="p_region_id_kelurahan">
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
				<TextBox id="643" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="kelurahan_own_code" fieldSource="kelurahan_own_code" caption="Kelurahan" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_registrationFormkelurahan_own_code">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="644" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="kecamatan_own_code" fieldSource="kecamatan_own_code" caption="Kecamatan" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_registrationFormkecamatan_own_code">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="645" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="kota_own_code" fieldSource="kota_own_code" caption="Kota/Kabupaten" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_registrationFormkota_own_code" defaultValue="'KOTA BANDUNG'">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Hidden id="646" fieldSourceType="DBColumn" dataType="Float" name="p_region_id_kel_owner" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_vat_registrationFormp_region_id_kel_owner" fieldSource="p_region_id_kel_owner" caption="p_order_status_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="647" fieldSourceType="DBColumn" dataType="Float" name="p_region_id_kec_owner" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_vat_registrationFormp_region_id_kec_owner" fieldSource="p_region_id_kec_owner" caption="p_order_status_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="648" fieldSourceType="DBColumn" dataType="Float" name="p_region_id_owner" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_vat_registrationFormp_region_id_owner" fieldSource="p_region_id_owner" caption="p_order_status_id" defaultValue="749">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<TextBox id="649" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="company_name" fieldSource="company_name" caption="Nama Badan/Perusahaan" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_registrationFormcompany_name">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextArea id="650" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="address_name" fieldSource="address_name" caption="Alamat" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_registrationFormaddress_name">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextArea>
				<TextBox id="565" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="job_position_code" fieldSource="job_position_code" caption="Jabatan" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_registrationFormjob_position_code">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Hidden id="651" fieldSourceType="DBColumn" dataType="Float" name="p_job_position_id" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_vat_registrationFormp_job_position_id" fieldSource="p_job_position_id" caption="p_order_status_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<TextBox id="652" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="company_brand" fieldSource="company_brand" caption="Merek Usaha" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_registrationFormcompany_brand">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="653" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="address_no" fieldSource="address_no" caption="No" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_registrationFormaddress_no">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="654" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="address_rt" fieldSource="address_rt" required="False" caption="Rt" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_registrationFormaddress_rt">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="655" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="address_rw" fieldSource="address_rw" required="False" caption="Rw" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_registrationFormaddress_rw">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="656" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="address_no_owner" fieldSource="address_no_owner" caption="No" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_registrationFormaddress_no_owner">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="657" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="address_rt_owner" fieldSource="address_rt_owner" required="False" caption="Rt" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_registrationFormaddress_rt_owner">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="658" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="address_rw_owner" fieldSource="address_rw_owner" required="False" caption="Rw" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_registrationFormaddress_rw_owner">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="659" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="phone_no" fieldSource="phone_no" required="False" caption="No. Telephon" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_registrationFormphone_no">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="660" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="fax_no" fieldSource="fax_no" required="False" caption="No. Fax" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_registrationFormfax_no">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="661" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="zip_code" fieldSource="zip_code" required="False" caption="Kode Pos" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_registrationFormzip_code">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="662" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="phone_no_owner" fieldSource="phone_no_owner" required="False" caption="No. Telephon" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_registrationFormphone_no_owner">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="663" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="company_owner" fieldSource="company_owner" caption="Nama Pemilik/Pengelola" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_registrationFormcompany_owner">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="665" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="fax_no_owner" fieldSource="fax_no_owner" required="False" caption="No. Fax" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_registrationFormfax_no_owner">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="666" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="zip_code_owner" fieldSource="zip_code_owner" required="False" caption="Kode Pos" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_registrationFormzip_code_owner">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="667" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="mobile_no" fieldSource="mobile_no" required="False" caption="No. Handphone" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_registrationFormmobile_no">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextArea id="668" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="address_name_owner" fieldSource="address_name_owner" caption="Alamat" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_registrationFormaddress_name_owner">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextArea>
				<Hidden id="669" fieldSourceType="DBColumn" dataType="Float" name="p_rqst_type_id" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_vat_registrationFormp_rqst_type_id" fieldSource="p_rqst_type_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<TextBox id="671" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="email" fieldSource="email" required="False" caption="Email" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_registrationFormemail">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextArea id="672" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="company_additional_addr" fieldSource="company_additional_addr" caption="Alamat Badan" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_registrationFormcompany_additional_addr">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextArea>
				<Label id="673" fieldSourceType="DBColumn" dataType="Text" html="False" name="Label1" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_vat_registrationFormLabel1">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<ListBox id="674" visible="Dynamic" fieldSourceType="DBColumn" sourceType="Table" dataType="Float" returnValueType="Number" name="p_hotel_grade_id" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" wizardEmptyCaption="Select Value" PathID="t_vat_registrationFormp_hotel_grade_id" connection="ConnSIKP" dataSource="p_hotel_grade" activeCollection="TableParameters" boundColumn="p_hotel_grade_id" textColumn="grade_name" fieldSource="p_hotel_grade_id">
					<Components/>
					<Events/>
					<TableParameters/>
					<SPParameters/>
					<SQLParameters/>
					<JoinTables>
						<JoinTable id="675" tableName="p_hotel_grade" schemaName="sikp" posLeft="10" posTop="10" posWidth="133" posHeight="180"/>
					</JoinTables>
					<JoinLinks/>
					<Fields/>
					<Attributes/>
					<Features/>
				</ListBox>
				<ListBox id="676" visible="Dynamic" fieldSourceType="DBColumn" sourceType="Table" dataType="Float" returnValueType="Number" name="p_rest_service_type_id" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" wizardEmptyCaption="Select Value" PathID="t_vat_registrationFormp_rest_service_type_id" connection="ConnSIKP" activeCollection="TableParameters" boundColumn="p_rest_service_type_id" textColumn="code" fieldSource="p_rest_service_type_id" dataSource="p_rest_service_type">
					<Components/>
					<Events/>
					<TableParameters/>
					<SPParameters/>
					<SQLParameters/>
					<JoinTables>
						<JoinTable id="677" tableName="p_rest_service_type" posLeft="10" posTop="10" posWidth="160" posHeight="168"/>
					</JoinTables>
					<JoinLinks/>
					<Fields/>
					<Attributes/>
					<Features/>
				</ListBox>
				<ListBox id="678" visible="Dynamic" fieldSourceType="DBColumn" sourceType="Table" dataType="Float" returnValueType="Number" name="p_entertaintment_type_id" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" wizardEmptyCaption="Select Value" PathID="t_vat_registrationFormp_entertaintment_type_id" connection="ConnSIKP" activeCollection="TableParameters" boundColumn="p_entertaintment_type_id" textColumn="entertaintment_name" fieldSource="p_entertaintment_type_id" dataSource="p_entertaintment_type">
					<Components/>
					<Events/>
					<TableParameters/>
					<SPParameters/>
					<SQLParameters/>
					<JoinTables>
						<JoinTable id="679" tableName="p_entertaintment_type" posLeft="10" posTop="10" posWidth="160" posHeight="180"/>
					</JoinTables>
					<JoinLinks/>
					<Fields/>
					<Attributes/>
					<Features/>
				</ListBox>
				<ListBox id="680" visible="Dynamic" fieldSourceType="DBColumn" sourceType="Table" dataType="Float" returnValueType="Number" name="p_parking_classification_id" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" wizardEmptyCaption="Select Value" PathID="t_vat_registrationFormp_parking_classification_id" connection="ConnSIKP" activeCollection="TableParameters" boundColumn="p_parking_classification_id" textColumn="code" fieldSource="p_parking_classification_id" dataSource="p_parking_classification">
					<Components/>
					<Events/>
					<TableParameters/>
					<SPParameters/>
					<SQLParameters/>
					<JoinTables>
						<JoinTable id="681" tableName="p_parking_classification" posLeft="10" posTop="10" posWidth="160" posHeight="168"/>
					</JoinTables>
					<JoinLinks/>
					<Fields/>
					<Attributes/>
					<Features/>
				</ListBox>
				<Button id="682" urlType="Relative" enableValidation="True" isDefault="False" name="Button1" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_vat_registrationFormButton1">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Hidden id="684" fieldSourceType="DBColumn" dataType="Float" name="t_vat_registration_id" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_vat_registrationFormt_vat_registration_id" fieldSource="t_vat_registration_id" caption="t_vat_registration_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Label id="685" fieldSourceType="DBColumn" dataType="Text" html="False" name="Label3" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_vat_registrationFormLabel3">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<TextBox id="875" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="rqst_type_code" fieldSource="rqst_type_code" caption="Jenis Permohonan" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_registrationFormrqst_type_code">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Hidden id="877" fieldSourceType="DBColumn" dataType="Text" name="TAKEN_CTL" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_vat_registrationFormTAKEN_CTL">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="878" fieldSourceType="DBColumn" dataType="Text" name="IS_TAKEN" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_vat_registrationFormIS_TAKEN">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="879" fieldSourceType="DBColumn" dataType="Text" name="CURR_DOC_ID" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_vat_registrationFormCURR_DOC_ID">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="880" fieldSourceType="DBColumn" dataType="Text" name="CURR_DOC_TYPE_ID" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_vat_registrationFormCURR_DOC_TYPE_ID">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="881" fieldSourceType="DBColumn" dataType="Text" name="CURR_PROC_ID" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_vat_registrationFormCURR_PROC_ID">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="882" fieldSourceType="DBColumn" dataType="Text" name="CURR_CTL_ID" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_vat_registrationFormCURR_CTL_ID">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="883" fieldSourceType="DBColumn" dataType="Text" name="USER_ID_DOC" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_vat_registrationFormUSER_ID_DOC">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="884" fieldSourceType="DBColumn" dataType="Text" name="USER_ID_DONOR" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_vat_registrationFormUSER_ID_DONOR">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="885" fieldSourceType="DBColumn" dataType="Text" name="USER_ID_LOGIN" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_vat_registrationFormUSER_ID_LOGIN">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="886" fieldSourceType="DBColumn" dataType="Text" name="USER_ID_TAKEN" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_vat_registrationFormUSER_ID_TAKEN">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="887" fieldSourceType="DBColumn" dataType="Text" name="IS_CREATE_DOC" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_vat_registrationFormIS_CREATE_DOC">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="888" fieldSourceType="DBColumn" dataType="Text" name="IS_MANUAL" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_vat_registrationFormIS_MANUAL">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="889" fieldSourceType="DBColumn" dataType="Text" name="CURR_PROC_STATUS" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_vat_registrationFormCURR_PROC_STATUS">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="890" fieldSourceType="DBColumn" dataType="Text" name="CURR_DOC_STATUS" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_vat_registrationFormCURR_DOC_STATUS">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="891" fieldSourceType="DBColumn" dataType="Text" name="PREV_DOC_ID" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_vat_registrationFormPREV_DOC_ID">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="892" fieldSourceType="DBColumn" dataType="Text" name="PREV_DOC_TYPE_ID" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_vat_registrationFormPREV_DOC_TYPE_ID">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="893" fieldSourceType="DBColumn" dataType="Text" name="PREV_PROC_ID" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_vat_registrationFormPREV_PROC_ID">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="894" fieldSourceType="DBColumn" dataType="Text" name="PREV_CTL_ID" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_vat_registrationFormPREV_CTL_ID">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="895" fieldSourceType="DBColumn" dataType="Text" name="SLOT_1" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_vat_registrationFormSLOT_1">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="896" fieldSourceType="DBColumn" dataType="Text" name="SLOT_2" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_vat_registrationFormSLOT_2">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="897" fieldSourceType="DBColumn" dataType="Text" name="SLOT_3" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_vat_registrationFormSLOT_3">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="898" fieldSourceType="DBColumn" dataType="Text" name="SLOT_4" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_vat_registrationFormSLOT_4">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="899" fieldSourceType="DBColumn" dataType="Text" name="SLOT_5" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_vat_registrationFormSLOT_5">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="900" fieldSourceType="DBColumn" dataType="Text" name="MESSAGE" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_vat_registrationFormMESSAGE">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Button id="901" urlType="Relative" enableValidation="True" isDefault="False" name="Button2" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_vat_registrationFormButton2">
					<Components/>
					<Events>
						<Event name="OnClick" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="902"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Button>
				<Hidden id="908" fieldSourceType="DBColumn" dataType="Text" name="Hidden1" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_vat_registrationFormHidden1" fieldSource="npwpd">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Button id="909" urlType="Relative" enableValidation="True" isDefault="False" name="Button4" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_vat_registrationFormButton4">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<TextBox id="664" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="mobile_no_owner" fieldSource="mobile_no_owner" required="False" caption="No. Handphone" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_registrationFormmobile_no_owner">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextArea id="910" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="brand_address_name" fieldSource="brand_address_name" caption="Alamat" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_registrationFormbrand_address_name">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextArea>
				<TextBox id="911" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="brand_address_no" fieldSource="brand_address_no" caption="No - Usaha" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_registrationFormbrand_address_no">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="912" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="brand_address_rt" fieldSource="brand_address_rt" required="False" caption="Rt - Usaha" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_registrationFormbrand_address_rt">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="913" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="brand_address_rw" fieldSource="brand_address_rw" required="False" caption="Rw - Usaha" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_registrationFormbrand_address_rw">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="914" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="brand_kota" fieldSource="brand_kota" caption="Kota/Kabupaten - Usaha" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_registrationFormbrand_kota" defaultValue="'KOTA BANDUNG'">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Hidden id="915" fieldSourceType="DBColumn" dataType="Float" name="brand_p_region_id" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_vat_registrationFormbrand_p_region_id" fieldSource="brand_p_region_id" caption="Kota/Kabupaten - Usaha" defaultValue="749">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<TextBox id="916" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="brand_kecamatan" fieldSource="brand_kecamatan" caption="Kecamatan - Usaha" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_registrationFormbrand_kecamatan">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Hidden id="917" fieldSourceType="DBColumn" dataType="Float" name="brand_p_region_id_kec" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_vat_registrationFormbrand_p_region_id_kec" fieldSource="brand_p_region_id_kec" caption="Kecamatan - Usaha">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<TextBox id="918" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="brand_kelurahan" fieldSource="brand_kelurahan" caption="Kelurahan - Usaha" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_registrationFormbrand_kelurahan">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Hidden id="919" fieldSourceType="DBColumn" dataType="Float" name="brand_p_region_id_kel" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_vat_registrationFormbrand_p_region_id_kel" fieldSource="brand_p_region_id_kel" caption="Kelurahan - Usaha">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<TextBox id="920" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="brand_phone_no" fieldSource="brand_phone_no" required="False" caption="No. Telephon - Usaha" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_registrationFormbrand_phone_no">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="921" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="brand_fax_no" fieldSource="brand_fax_no" required="False" caption="No. Fax - Usaha" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_registrationFormbrand_fax_no">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="922" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="brand_zip_code" fieldSource="brand_zip_code" required="False" caption="Kode Pos - Usaha" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_registrationFormbrand_zip_code">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="923" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="brand_mobile_no" fieldSource="brand_mobile_no" caption="No. Selular - Usaha" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_registrationFormbrand_mobile_no" required="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="924" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="wp_user_name" fieldSource="wp_user_name" caption="User Name" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_registrationFormwp_user_name">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="925" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="wp_user_pwd" fieldSource="wp_user_pwd" caption="Password" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_registrationFormwp_user_pwd">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="926" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="wp_name" fieldSource="wp_name" caption="Nama Wajib Pajak" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_registrationFormwp_name">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextArea id="904" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="wp_address_name" fieldSource="wp_address_name" caption="Alamat Wajib Pajak" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_registrationFormwp_address_name">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextArea>
				<TextBox id="927" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="wp_address_no" fieldSource="wp_address_no" caption="No - WP" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_registrationFormwp_address_no">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="928" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="wp_kota" fieldSource="wp_kota" caption="Kota/Kabupaten - WP" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_registrationFormwp_kota" defaultValue="'KOTA BANDUNG'">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="929" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="wp_kelurahan" fieldSource="wp_kelurahan" caption="Kelurahan - WP" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_registrationFormwp_kelurahan">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="930" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="wp_kecamatan" fieldSource="wp_kecamatan" caption="Kecamatan - WP" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_registrationFormwp_kecamatan">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="931" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="wp_address_rt" fieldSource="wp_address_rt" required="False" caption="Rt - WP" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_registrationFormwp_address_rt">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="932" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="wp_address_rw" fieldSource="wp_address_rw" required="False" caption="Rw - WP" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_registrationFormwp_address_rw">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="933" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="wp_phone_no" fieldSource="wp_phone_no" required="False" caption="No. Telephon - WP" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_registrationFormwp_phone_no">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="934" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="wp_email" fieldSource="wp_email" required="False" caption="Email - WP" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_registrationFormwp_email">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="935" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="wp_fax_no" fieldSource="wp_fax_no" required="False" caption="No. Fax - WP" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_registrationFormwp_fax_no">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="936" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="wp_zip_code" fieldSource="wp_zip_code" required="False" caption="Kode Pos - WP" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_registrationFormwp_zip_code">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Hidden id="937" fieldSourceType="DBColumn" dataType="Float" name="wp_p_region_id" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_vat_registrationFormwp_p_region_id" fieldSource="wp_p_region_id" caption="Kota/Kabupaten - WP" defaultValue="749">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="938" fieldSourceType="DBColumn" dataType="Float" name="wp_p_region_id_kecamatan" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_vat_registrationFormwp_p_region_id_kecamatan" fieldSource="wp_p_region_id_kecamatan" caption="Kecamatan - WP">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="939" fieldSourceType="DBColumn" dataType="Float" name="wp_p_region_id_kelurahan" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_vat_registrationFormwp_p_region_id_kelurahan" fieldSource="wp_p_region_id_kelurahan" caption="Kelurahan - WP">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<TextBox id="940" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="wp_mobile_no" fieldSource="wp_mobile_no" caption="No. Selular - WP" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_registrationFormwp_mobile_no" required="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
			</Components>
			<Events>
				<Event name="BeforeSelect" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="686" eventType="Server"/>
					</Actions>
				</Event>
				<Event name="BeforeInsert" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="687" eventType="Server"/>
					</Actions>
				</Event>
				<Event name="BeforeShow" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="874"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
				<TableParameter id="688" conditionType="Parameter" useIsNull="False" field="CURR_DOC_ID" dataType="Float" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="CURR_DOC_ID"/>
			</TableParameters>
			<SPParameters/>
			<SQLParameters>
				<SQLParameter id="876" parameterType="URL" variable="CURR_DOC_ID" dataType="Float" parameterSource="CURR_DOC_ID" defaultValue="0"/>
			</SQLParameters>
			<JoinTables>
			</JoinTables>
			<JoinLinks/>
			<Fields>
			</Fields>
			<ISPParameters>
				<SPParameter id="690" parameterName="i_p_app_user_id" parameterSource="0" dataType="Numeric" parameterType="Expression" dataSize="0" direction="Input" scale="10" precision="6"/>
				<SPParameter id="691" parameterName="i_full_name" parameterSource="full_name" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="692" parameterName="i_email_address" parameterSource="email_address" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="693" parameterName="i_p_data_status_list_id" parameterSource="p_data_status_list_id" dataType="Numeric" parameterType="Control" dataSize="0" direction="Input" scale="10" precision="6"/>
				<SPParameter id="694" parameterName="i_p_region_id" parameterSource="p_region_id" dataType="Numeric" parameterType="Control" dataSize="0" direction="Input" scale="10" precision="6"/>
				<SPParameter id="695" parameterName="i_description" parameterSource="description" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="696" parameterName="i_ip_address" parameterSource="ip_address" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="697" parameterName="i_expired_pwd" parameterSource="expired_pwd" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="698" parameterName="i_user_by" parameterSource="UserName" dataType="Char" parameterType="Session" dataSize="255" direction="Input" scale="10" precision="6"/>
			</ISPParameters>
			<ISQLParameters>
				<SQLParameter id="699" variable="created_by" dataType="Text" parameterType="Expression" parameterSource="CCGetUserLogin()"/>
				<SQLParameter id="700" variable="updated_by" dataType="Text" parameterType="Expression" parameterSource="CCGetUserLogin()"/>
				<SQLParameter id="701" variable="registration_date" dataType="Text" parameterType="Control" parameterSource="registration_date" format="dd-mmm-yyyy"/>
				<SQLParameter id="702" variable="t_customer_order_id" dataType="Float" parameterType="Control" parameterSource="t_customer_order_id"/>
				<SQLParameter id="703" variable="p_region_id_kelurahan" dataType="Float" parameterType="Control" parameterSource="p_region_id_kelurahan"/>
				<SQLParameter id="704" variable="p_region_id_kecamatan" dataType="Float" parameterType="Control" parameterSource="p_region_id_kecamatan"/>
				<SQLParameter id="705" variable="p_region_id" dataType="Float" parameterType="Control" parameterSource="p_region_id"/>
				<SQLParameter id="706" variable="p_region_id_kel_owner" dataType="Float" parameterType="Control" parameterSource="p_region_id_kel_owner"/>
				<SQLParameter id="707" variable="p_region_id_kec_owner" dataType="Float" parameterType="Control" parameterSource="p_region_id_kec_owner"/>
				<SQLParameter id="708" variable="p_region_id_owner" dataType="Float" parameterType="Control" parameterSource="p_region_id_owner"/>
				<SQLParameter id="709" variable="company_name" dataType="Text" parameterType="Control" parameterSource="company_name"/>
				<SQLParameter id="710" variable="address_name" dataType="Text" parameterType="Control" parameterSource="address_name"/>
				<SQLParameter id="711" variable="p_job_position_id" dataType="Float" parameterType="Control" parameterSource="p_job_position_id"/>
				<SQLParameter id="712" variable="company_brand" dataType="Text" parameterType="Control" parameterSource="company_brand"/>
				<SQLParameter id="713" variable="address_no" dataType="Text" parameterType="Control" parameterSource="address_no"/>
				<SQLParameter id="714" variable="address_rt" dataType="Text" parameterType="Control" parameterSource="address_rt"/>
				<SQLParameter id="715" variable="address_rw" dataType="Text" parameterType="Control" parameterSource="address_rw"/>
				<SQLParameter id="716" variable="address_no_owner" dataType="Text" parameterType="Control" parameterSource="address_no_owner"/>
				<SQLParameter id="717" variable="address_rt_owner" dataType="Text" parameterType="Control" parameterSource="address_rt_owner"/>
				<SQLParameter id="718" variable="address_rw_owner" dataType="Text" parameterType="Control" parameterSource="address_rw_owner"/>
				<SQLParameter id="719" variable="phone_no" dataType="Text" parameterType="Control" parameterSource="phone_no"/>
				<SQLParameter id="720" variable="fax_no" dataType="Text" parameterType="Control" parameterSource="fax_no"/>
				<SQLParameter id="721" variable="zip_code" dataType="Text" parameterType="Control" parameterSource="zip_code"/>
				<SQLParameter id="722" variable="phone_no_owner" dataType="Text" parameterType="Control" parameterSource="phone_no_owner"/>
				<SQLParameter id="723" variable="company_owner" dataType="Text" parameterType="Control" parameterSource="company_owner"/>
				<SQLParameter id="724" variable="mobile_no_owner" dataType="Text" parameterType="Control" parameterSource="mobile_no_owner"/>
				<SQLParameter id="725" variable="fax_no_owner" dataType="Text" parameterType="Control" parameterSource="fax_no_owner"/>
				<SQLParameter id="726" variable="zip_code_owner" dataType="Text" parameterType="Control" parameterSource="zip_code_owner"/>
				<SQLParameter id="727" variable="mobile_no" dataType="Text" parameterType="Control" parameterSource="mobile_no"/>
				<SQLParameter id="728" variable="address_name_owner" dataType="Text" parameterType="Control" parameterSource="address_name_owner"/>
				<SQLParameter id="729" variable="t_vat_registration_id" dataType="Float" parameterType="Control" parameterSource="t_vat_registration_id"/>
				<SQLParameter id="730" variable="email" parameterType="Control" dataType="Text" parameterSource="email"/>
				<SQLParameter id="731" variable="company_additional_addr" parameterType="Control" dataType="Text" parameterSource="company_additional_addr"/>
				<SQLParameter id="732" variable="p_hotel_grade_id" parameterType="Control" defaultValue="0" dataType="Float" parameterSource="p_hotel_grade_id"/>
				<SQLParameter id="733" variable="p_rest_service_type_id" parameterType="Control" defaultValue="0" dataType="Float" parameterSource="p_rest_service_type_id"/>
				<SQLParameter id="734" variable="p_entertaintment_type_id" parameterType="Control" defaultValue="0" dataType="Float" parameterSource="p_entertaintment_type_id"/>
				<SQLParameter id="735" variable="p_parking_classification_id" parameterType="Control" defaultValue="0" dataType="Float" parameterSource="p_parking_classification_id"/>
			</ISQLParameters>
			<IFormElements>
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
			</IFormElements>
			<USPParameters>
				<SPParameter id="777" parameterName="i_flag" parameterSource="2" dataType="Numeric" parameterType="Expression" dataSize="0" direction="Input" scale="10" precision="6"/>
				<SPParameter id="778" parameterName="i_p_app_user_id" parameterSource="p_app_user_id" dataType="Numeric" parameterType="Control" dataSize="0" direction="Input" scale="10" precision="6"/>
				<SPParameter id="779" parameterName="i_user_name" parameterSource="user_name" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="780" parameterName="i_full_name" parameterSource="full_name" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="781" parameterName="i_email_address" parameterSource="email_address" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="782" parameterName="i_p_user_type_id" parameterSource="p_user_type_id" dataType="Numeric" parameterType="Control" dataSize="0" direction="Input" scale="10" precision="6"/>
				<SPParameter id="783" parameterName="i_p_data_status_list_id" parameterSource="p_data_status_list_id" dataType="Numeric" parameterType="Control" dataSize="0" direction="Input" scale="10" precision="6"/>
				<SPParameter id="784" parameterName="i_p_region_id" parameterSource="p_region_id" dataType="Numeric" parameterType="Control" dataSize="0" direction="Input" scale="10" precision="6"/>
				<SPParameter id="785" parameterName="i_p_region_structure_id" parameterSource="p_region_structure_id" dataType="Numeric" parameterType="Control" dataSize="0" direction="Input" scale="10" precision="6"/>
				<SPParameter id="786" parameterName="i_description" parameterSource="description" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="787" parameterName="i_ip_address" parameterSource="ip_address" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="788" parameterName="i_expired_user" parameterSource="expired_user" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="789" parameterName="i_expired_pwd" parameterSource="expired_pwd" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
				<SPParameter id="790" parameterName="i_user_by" parameterSource="UserName" dataType="Char" parameterType="Session" dataSize="255" direction="Input" scale="10" precision="6"/>
			</USPParameters>
			<USQLParameters>
				<SQLParameter id="820" variable="t_vat_registration_id" dataType="Float" parameterType="Control" parameterSource="t_vat_registration_id" defaultValue="0"/>
				<SQLParameter id="826" variable="t_customer_order_id" parameterType="Control" defaultValue="0" dataType="Float" parameterSource="t_customer_order_id"/>
				<SQLParameter id="905" variable="npwpd" parameterType="Control" dataType="Text" parameterSource="npwpd"/>
			</USQLParameters>
			<UConditions>
				<TableParameter id="827" conditionType="Parameter" useIsNull="False" field="t_customer_order_id" dataType="Float" searchConditionType="Equal" parameterType="Control" logicOperator="And" parameterSource="t_customer_order_id"/>
				<TableParameter id="828" conditionType="Parameter" useIsNull="False" field="t_vat_registration_id" dataType="Float" searchConditionType="Equal" parameterType="Control" logicOperator="And" parameterSource="t_vat_registration_id"/>
			</UConditions>
			<UFormElements>
				<CustomParameter id="829" field="created_by" dataType="Text" parameterType="Control" parameterSource="created_by"/>
				<CustomParameter id="830" field="updated_by" dataType="Text" parameterType="Control" parameterSource="updated_by"/>
				<CustomParameter id="831" field="creation_date" dataType="Text" parameterType="Control" parameterSource="creation_date" format="dd-mmm-yyyy"/>
				<CustomParameter id="832" field="updated_date" dataType="Text" parameterType="Control" parameterSource="updated_date" format="dd-mmm-yyyy"/>
				<CustomParameter id="833" field="order_no" dataType="Text" parameterType="Control" parameterSource="order_no"/>
				<CustomParameter id="834" field="registration_date" dataType="Text" parameterType="Control" parameterSource="registration_date" format="dd-mmm-yyyy"/>
				<CustomParameter id="835" field="t_customer_order_id" dataType="Float" parameterType="Control" parameterSource="t_customer_order_id"/>
				<CustomParameter id="836" field="kelurahan_code" dataType="Text" parameterType="Control" parameterSource="kelurahan_code"/>
				<CustomParameter id="837" field="kecamatan_code" dataType="Text" parameterType="Control" parameterSource="kecamatan_code"/>
				<CustomParameter id="838" field="kota_code" dataType="Text" parameterType="Control" parameterSource="kota_code"/>
				<CustomParameter id="839" field="p_region_id_kelurahan" dataType="Float" parameterType="Control" parameterSource="p_region_id_kelurahan"/>
				<CustomParameter id="840" field="p_region_id_kecamatan" dataType="Float" parameterType="Control" parameterSource="p_region_id_kecamatan"/>
				<CustomParameter id="841" field="p_region_id" dataType="Float" parameterType="Control" parameterSource="p_region_id"/>
				<CustomParameter id="842" field="kelurahan_own_code" dataType="Text" parameterType="Control" parameterSource="kelurahan_own_code"/>
				<CustomParameter id="843" field="kecamatan_own_code" dataType="Text" parameterType="Control" parameterSource="kecamatan_own_code"/>
				<CustomParameter id="844" field="kota_own_code" dataType="Text" parameterType="Control" parameterSource="kota_own_code"/>
				<CustomParameter id="845" field="p_region_id_kel_owner" dataType="Float" parameterType="Control" parameterSource="p_region_id_kel_owner"/>
				<CustomParameter id="846" field="p_region_id_kec_owner" dataType="Float" parameterType="Control" parameterSource="p_region_id_kec_owner"/>
				<CustomParameter id="847" field="p_region_id_owner" dataType="Float" parameterType="Control" parameterSource="p_region_id_owner"/>
				<CustomParameter id="848" field="company_name" dataType="Text" parameterType="Control" parameterSource="company_name"/>
				<CustomParameter id="849" field="address_name" dataType="Text" parameterType="Control" parameterSource="address_name"/>
				<CustomParameter id="850" field="job_position_code" dataType="Text" parameterType="Control" parameterSource="job_position_code"/>
				<CustomParameter id="851" field="p_job_position_id" dataType="Float" parameterType="Control" parameterSource="p_job_position_id"/>
				<CustomParameter id="852" field="company_brand" dataType="Text" parameterType="Control" parameterSource="company_brand"/>
				<CustomParameter id="853" field="address_no" dataType="Text" parameterType="Control" parameterSource="address_no"/>
				<CustomParameter id="854" field="address_rt" dataType="Text" parameterType="Control" parameterSource="address_rt"/>
				<CustomParameter id="855" field="address_rw" dataType="Text" parameterType="Control" parameterSource="address_rw"/>
				<CustomParameter id="856" field="address_no_owner" dataType="Text" parameterType="Control" parameterSource="address_no_owner"/>
				<CustomParameter id="857" field="address_rt_owner" dataType="Text" parameterType="Control" parameterSource="address_rt_owner"/>
				<CustomParameter id="858" field="address_rw_owner" dataType="Text" parameterType="Control" parameterSource="address_rw_owner"/>
				<CustomParameter id="859" field="phone_no" dataType="Text" parameterType="Control" parameterSource="phone_no"/>
				<CustomParameter id="860" field="fax_no" dataType="Text" parameterType="Control" parameterSource="fax_no"/>
				<CustomParameter id="861" field="zip_code" dataType="Text" parameterType="Control" parameterSource="zip_code"/>
				<CustomParameter id="862" field="phone_no_owner" dataType="Text" parameterType="Control" parameterSource="phone_no_owner"/>
				<CustomParameter id="863" field="company_owner" dataType="Text" parameterType="Control" parameterSource="company_owner"/>
				<CustomParameter id="864" field="mobile_no_owner" dataType="Text" parameterType="Control" parameterSource="mobile_no_owner"/>
				<CustomParameter id="865" field="fax_no_owner" dataType="Text" parameterType="Control" parameterSource="fax_no_owner"/>
				<CustomParameter id="866" field="zip_code_owner" dataType="Text" parameterType="Control" parameterSource="zip_code_owner"/>
				<CustomParameter id="867" field="mobile_no" dataType="Text" parameterType="Control" parameterSource="mobile_no"/>
				<CustomParameter id="868" field="address_name_owner" dataType="Text" parameterType="Control" parameterSource="address_name_owner"/>
				<CustomParameter id="869" field="t_vat_registration_id" dataType="Float" parameterType="Control" parameterSource="t_vat_registration_id"/>
			</UFormElements>
			<DSPParameters/>
			<DSQLParameters>
				<SQLParameter id="870" variable="t_vat_registration_id" parameterType="Control" dataType="Float" parameterSource="t_vat_registration_id" defaultValue="0"/>
				<SQLParameter id="871" variable="t_customer_order_id" parameterType="Control" dataType="Float" parameterSource="t_customer_order_id" defaultValue="0"/>
			</DSQLParameters>
			<DConditions>
				<TableParameter id="872" conditionType="Parameter" useIsNull="False" field="t_vat_registration_id" dataType="Float" searchConditionType="Equal" parameterType="Control" logicOperator="And" parameterSource="t_vat_registration_id"/>
				<TableParameter id="873" conditionType="Parameter" useIsNull="False" field="t_customer_order_id" dataType="Float" searchConditionType="Equal" parameterType="Control" logicOperator="And" parameterSource="t_customer_order_id"/>
			</DConditions>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Record>
	</Components>
	<CodeFiles>
		<CodeFile id="Events" language="PHPTemplates" name="t_customer_order_ro_bap_events.php" forShow="False" comment="//" codePage="windows-1252"/>
		<CodeFile id="Code" language="PHPTemplates" name="t_customer_order_ro_bap.php" forShow="True" url="t_customer_order_ro_bap.php" comment="//" codePage="windows-1252"/>
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
