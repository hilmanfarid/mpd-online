<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\trans" secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="RWNet" wizardThemeVersion="3.0" needGeneration="0" pasteActions="pasteActions">
	<Components>
		<Record id="629" sourceType="SQL" urlType="Relative" secured="False" allowInsert="False" allowUpdate="True" allowDelete="False" validateData="True" preserveParameters="GET" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" connection="ConnSIKP" name="t_debt_letterForm" errorSummator="Error" wizardCaption="Add/Edit V P App User " wizardFormMethod="post" PathID="t_debt_letterForm" activeCollection="USQLParameters" pasteAsReplace="pasteAsReplace" pasteActions="pasteActions" customDeleteType="SQL" parameterTypeListName="ParameterTypeList" customUpdateType="SQL" customInsertType="SQL" customUpdate="UPDATE t_debt_letter SET
letter_no='{letter_no}', 
sms_content='{sms_content}',
updated_date=sysdate,
updated_by='{updated_by}'
WHERE t_debt_letter_id = {t_debt_letter_id} " customDelete="DELETE FROM t_vat_registration 
WHERE  t_vat_registration_id = {t_vat_registration_id} 
AND t_customer_order_id = {t_customer_order_id}" dataSource="SELECT * 
FROM v_debt_letter
WHERE t_customer_order_id = {CURR_DOC_ID} " customInsert="INSERT INTO t_vat_registration(t_vat_registration_id, created_by, updated_by, creation_date, updated_date, registration_date, 
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
				<Button id="630" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Insert" operation="Insert" wizardCaption="Add" PathID="t_debt_letterFormButton_Insert" removeParameters="FLAG">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="631" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Update" operation="Update" wizardCaption="Submit" PathID="t_debt_letterFormButton_Update" removeParameters="FLAG">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="632" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Delete" operation="Delete" wizardCaption="Delete" PathID="t_debt_letterFormButton_Delete" removeParameters="FLAG;t_vat_registration_id">
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
				<Button id="634" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Cancel" operation="Cancel" wizardCaption="Cancel" PathID="t_debt_letterFormButton_Cancel" returnPage="t_customer_order.ccp" removeParameters="FLAG">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<TextBox id="635" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="created_by" fieldSource="created_by" required="False" caption="Created By" wizardCaption="Created By" wizardSize="16" wizardMaxLength="16" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_debt_letterFormcreated_by" defaultValue="CCGetUserLogin()">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="636" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="updated_by" fieldSource="updated_by" required="False" caption="Updated By" wizardCaption="Updated By" wizardSize="16" wizardMaxLength="16" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_debt_letterFormupdated_by" defaultValue="CCGetUserLogin()">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="637" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="creation_date" fieldSource="creation_date" required="False" caption="Creation Date" wizardCaption="Creation Date" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_debt_letterFormcreation_date" format="dd-mmm-yyyy" defaultValue="date(&quot;d-M-Y&quot;)">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="638" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="updated_date" fieldSource="updated_date" required="False" caption="Updated Date" wizardCaption="Updated Date" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_debt_letterFormupdated_date" defaultValue="date(&quot;d-M-Y&quot;)" format="dd-mmm-yyyy">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="639" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="order_no" fieldSource="order_no" required="True" caption="Nomor Order" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_debt_letterFormorder_no">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="33" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="letter_date" fieldSource="letter_date" required="True" caption="Tanggal Pendaftaran" wizardCaption="Valid From" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_debt_letterFormletter_date" defaultValue="date(&quot;d-M-Y h:i:s&quot;)" format="dd-mmm-yyyy H:nn:ss">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Hidden id="640" fieldSourceType="DBColumn" dataType="Float" name="t_customer_order_id" fieldSource="t_customer_order_id" caption="Id" wizardCaption="P App User Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_debt_letterFormt_customer_order_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<TextBox id="666" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="finance_period_code" fieldSource="finance_period_code" required="False" caption="Periode" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_debt_letterFormfinance_period_code">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="671" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="letter_no" fieldSource="letter_no" required="True" caption="Nomor Surat" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_debt_letterFormletter_no">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Hidden id="684" fieldSourceType="DBColumn" dataType="Float" name="t_debt_letter_id" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_debt_letterFormt_debt_letter_id" fieldSource="t_debt_letter_id" caption="t_debt_letter_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<TextBox id="875" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="leter_type" fieldSource="leter_type" required="True" caption="Jenis Permohonan" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_debt_letterFormleter_type">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Hidden id="877" fieldSourceType="DBColumn" dataType="Text" name="TAKEN_CTL" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_debt_letterFormTAKEN_CTL">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="878" fieldSourceType="DBColumn" dataType="Text" name="IS_TAKEN" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_debt_letterFormIS_TAKEN">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="879" fieldSourceType="DBColumn" dataType="Text" name="CURR_DOC_ID" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_debt_letterFormCURR_DOC_ID">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="880" fieldSourceType="DBColumn" dataType="Text" name="CURR_DOC_TYPE_ID" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_debt_letterFormCURR_DOC_TYPE_ID">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="881" fieldSourceType="DBColumn" dataType="Text" name="CURR_PROC_ID" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_debt_letterFormCURR_PROC_ID">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="882" fieldSourceType="DBColumn" dataType="Text" name="CURR_CTL_ID" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_debt_letterFormCURR_CTL_ID">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="883" fieldSourceType="DBColumn" dataType="Text" name="USER_ID_DOC" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_debt_letterFormUSER_ID_DOC">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="884" fieldSourceType="DBColumn" dataType="Text" name="USER_ID_DONOR" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_debt_letterFormUSER_ID_DONOR">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="885" fieldSourceType="DBColumn" dataType="Text" name="USER_ID_LOGIN" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_debt_letterFormUSER_ID_LOGIN">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="886" fieldSourceType="DBColumn" dataType="Text" name="USER_ID_TAKEN" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_debt_letterFormUSER_ID_TAKEN">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="887" fieldSourceType="DBColumn" dataType="Text" name="IS_CREATE_DOC" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_debt_letterFormIS_CREATE_DOC">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="888" fieldSourceType="DBColumn" dataType="Text" name="IS_MANUAL" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_debt_letterFormIS_MANUAL">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="889" fieldSourceType="DBColumn" dataType="Text" name="CURR_PROC_STATUS" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_debt_letterFormCURR_PROC_STATUS">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="890" fieldSourceType="DBColumn" dataType="Text" name="CURR_DOC_STATUS" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_debt_letterFormCURR_DOC_STATUS">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="891" fieldSourceType="DBColumn" dataType="Text" name="PREV_DOC_ID" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_debt_letterFormPREV_DOC_ID">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="892" fieldSourceType="DBColumn" dataType="Text" name="PREV_DOC_TYPE_ID" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_debt_letterFormPREV_DOC_TYPE_ID">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="893" fieldSourceType="DBColumn" dataType="Text" name="PREV_PROC_ID" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_debt_letterFormPREV_PROC_ID">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="894" fieldSourceType="DBColumn" dataType="Text" name="PREV_CTL_ID" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_debt_letterFormPREV_CTL_ID">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="895" fieldSourceType="DBColumn" dataType="Text" name="SLOT_1" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_debt_letterFormSLOT_1">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="896" fieldSourceType="DBColumn" dataType="Text" name="SLOT_2" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_debt_letterFormSLOT_2">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="897" fieldSourceType="DBColumn" dataType="Text" name="SLOT_3" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_debt_letterFormSLOT_3">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="898" fieldSourceType="DBColumn" dataType="Text" name="SLOT_4" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_debt_letterFormSLOT_4">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="899" fieldSourceType="DBColumn" dataType="Text" name="SLOT_5" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_debt_letterFormSLOT_5">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="900" fieldSourceType="DBColumn" dataType="Text" name="MESSAGE" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_debt_letterFormMESSAGE">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Button id="901" urlType="Relative" enableValidation="True" isDefault="False" name="Button2" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_debt_letterFormButton2">
					<Components/>
					<Events>
						<Event name="OnClick" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="902" eventType="Server"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Button>
				<Hidden id="903" fieldSourceType="DBColumn" dataType="Float" name="p_debt_letter_type_id" fieldSource="p_debt_letter_type_id" caption="p_debt_letter_type_id" wizardCaption="P App User Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_debt_letterFormp_debt_letter_type_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<TextBox id="904" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="sms_content" fieldSource="sms_content" required="True" caption="SMS Konten" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_debt_letterFormsms_content">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Hidden id="905" fieldSourceType="DBColumn" dataType="Float" name="p_finance_period_id" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_debt_letterFormp_finance_period_id" fieldSource="p_finance_period_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="906" fieldSourceType="DBColumn" dataType="Text" name="is_approve_1" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_debt_letterFormis_approve_1" fieldSource="is_approve_1">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="907" fieldSourceType="DBColumn" dataType="Text" name="is_approve_2" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_debt_letterFormis_approve_2" fieldSource="is_approve_2">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="908" fieldSourceType="DBColumn" dataType="Text" name="is_approve_3" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_debt_letterFormis_approve_3" fieldSource="is_approve_3">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Button id="913" urlType="Relative" enableValidation="True" isDefault="False" name="Button3" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_debt_letterFormButton3">
					<Components/>
					<Events>
						<Event name="OnClick" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="914" eventType="Server"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="915" urlType="Relative" enableValidation="True" isDefault="False" name="Button4" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_debt_letterFormButton4">
					<Components/>
					<Events>
						<Event name="OnClick" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="916" eventType="Server"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Button>
				<TextBox id="917" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="sequence_no" fieldSource="sequence_no" required="True" caption="Surat Teguran Ke" wizardCaption="Valid From" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_debt_letterFormsequence_no">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
			</Components>
			<Events>
				<Event name="BeforeInsert" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="687" eventType="Server"/>
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
				<SQLParameter id="909" variable="letter_no" parameterType="Control" dataType="Text" parameterSource="letter_no"/>
				<SQLParameter id="910" variable="sms_content" parameterType="Control" dataType="Text" parameterSource="sms_content"/>
				<SQLParameter id="911" variable="t_debt_letter_id" parameterType="Control" defaultValue="0" dataType="Float" parameterSource="t_debt_letter_id"/>
				<SQLParameter id="912" variable="updated_by" parameterType="Expression" dataType="Text" parameterSource="CCGetUserLogin()"/>
			</USQLParameters>
			<UConditions>
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
		<CodeFile id="Events" language="PHPTemplates" name="t_debt_letter_events.php" forShow="False" comment="//" codePage="windows-1252"/>
		<CodeFile id="Code" language="PHPTemplates" name="t_debt_letter.php" forShow="True" url="t_debt_letter.php" comment="//" codePage="windows-1252"/>
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
