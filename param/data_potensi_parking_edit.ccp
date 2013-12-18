<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\param" secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="RWNet" wizardThemeVersion="3.0" needGeneration="0" pasteActions="pasteActions">
	<Components>
		<Record id="94" sourceType="SQL" urlType="Relative" secured="False" allowInsert="True" allowUpdate="True" allowDelete="False" validateData="True" preserveParameters="GET" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" connection="ConnSIKP" name="t_vat_reg_dtl_parkingForm" errorSummator="Error" wizardCaption="Add/Edit V P App User " wizardFormMethod="post" PathID="t_vat_reg_dtl_parkingForm" activeCollection="ISQLParameters" pasteAsReplace="pasteAsReplace" pasteActions="pasteActions" customDeleteType="SQL" parameterTypeListName="ParameterTypeList" customUpdateType="SQL" customInsertType="SQL" customInsert="INSERT INTO t_acc_dtl_parking(t_acc_dtl_parking_id, description, created_by, updated_by, creation_date, updated_date, t_cust_account_id, max_load_qty, first_service_charge, avg_subscription_qty, classification_desc, parking_size, next_service_charge, valid_from, valid_to) 
VALUES(generate_id('sikp','t_acc_dtl_parking','t_acc_dtl_parking_id'), '{description}', '{created_by}', '{updated_by}', sysdate, sysdate, {t_cust_account_id}, {max_load_qty}, {first_service_charge}, '{avg_subscription_qty}', '{classification_desc}', {parking_size}, {next_service_charge}, to_date('{valid_from}','DD-MON-YYYY'), case when '{valid_to}' = '' then null else to_date('{valid_to}','dd-mon-yyyy') end)" customUpdate="UPDATE t_acc_dtl_parking SET 
description='{description}', 
updated_by='{updated_by}', 
updated_date=sysdate, 
t_cust_account_id={t_cust_account_id}, 
max_load_qty={max_load_qty}, 
first_service_charge={first_service_charge}, 
avg_subscription_qty='{avg_subscription_qty}', 
parking_size={parking_size}, 
next_service_charge={next_service_charge},
valid_from = to_date('{valid_from}','DD-MON-YYYY'),
valid_to=case when '{valid_to}' = '' then null else to_date('{valid_to}','dd-mon-yyyy') end
WHERE t_acc_dtl_parking_id={t_acc_dtl_parking_id}" customDelete="DELETE FROM t_vat_reg_dtl_parking
WHERE t_vat_reg_dtl_parking_id = {t_vat_reg_dtl_parking_id}" dataSource="SELECT a.t_acc_dtl_parking_id, a.t_cust_account_id, a.classification_desc, a.parking_size, a.max_load_qty, a.avg_subscription_qty, 
to_char(a.valid_from,'DD-MON-YYYY')as valid_from, to_char(a.valid_to,'DD-MON-YYYY')as valid_to,
a.first_service_charge, a.next_service_charge, a.description, to_char(a.creation_date, 'DD-MON-YYYY') AS creation_date, 
a.created_by, to_char(a.updated_date, 'DD-MON-YYYY') AS updated_date, a.updated_by, c.p_parking_classification_id
FROM t_acc_dtl_parking a, t_cust_account c
WHERE a.t_cust_account_id = c.t_cust_account_id 
AND a.t_acc_dtl_parking_id = {t_acc_dtl_parking_id} ">
			<Components>
				<Button id="95" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Insert" operation="Insert" wizardCaption="Add" PathID="t_vat_reg_dtl_parkingFormButton_Insert" removeParameters="FLAG">
					<Components/>
					<Events>
					</Events>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="96" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Update" operation="Update" wizardCaption="Submit" PathID="t_vat_reg_dtl_parkingFormButton_Update" removeParameters="FLAG">
					<Components/>
					<Events>
					</Events>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="97" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Delete" operation="Delete" wizardCaption="Delete" PathID="t_vat_reg_dtl_parkingFormButton_Delete" removeParameters="FLAG;t_vat_reg_dtl_hotel_id">
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
				<Button id="99" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Cancel" operation="Cancel" wizardCaption="Cancel" PathID="t_vat_reg_dtl_parkingFormButton_Cancel" removeParameters="FLAG;t_vat_reg_dtl_hotel_id">
					<Components/>
					<Events>
						<Event name="OnClick" type="Client">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="673"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Button>
				<Hidden id="101" fieldSourceType="DBColumn" dataType="Float" name="t_acc_dtl_parking_id" fieldSource="t_acc_dtl_parking_id" caption="Id" wizardCaption="P App User Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_reg_dtl_parkingFormt_acc_dtl_parking_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<TextBox id="114" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="description" fieldSource="description" required="False" caption="Description" wizardCaption="Description" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_reg_dtl_parkingFormdescription">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="124" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="created_by" fieldSource="created_by" required="False" caption="Created By" wizardCaption="Created By" wizardSize="16" wizardMaxLength="16" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_reg_dtl_parkingFormcreated_by" defaultValue="CCGetUserLogin()">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="127" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="updated_by" fieldSource="updated_by" required="False" caption="Updated By" wizardCaption="Updated By" wizardSize="16" wizardMaxLength="16" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_reg_dtl_parkingFormupdated_by" defaultValue="CCGetUserLogin()">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="122" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="creation_date" fieldSource="creation_date" required="False" caption="Creation Date" wizardCaption="Creation Date" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_reg_dtl_parkingFormcreation_date" format="dd-mmm-yyyy" defaultValue="date(&quot;d-M-Y&quot;)">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="125" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="updated_date" fieldSource="updated_date" required="False" caption="Updated Date" wizardCaption="Updated Date" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_reg_dtl_parkingFormupdated_date" defaultValue="date(&quot;d-M-Y&quot;)" format="dd-mmm-yyyy">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Hidden id="677" fieldSourceType="DBColumn" dataType="Text" html="False" name="customer_name" wizardCaption="Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="t_vat_reg_dtl_parkingFormcustomer_name">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<TextBox id="692" visible="Yes" fieldSourceType="DBColumn" dataType="Float" name="max_load_qty" fieldSource="max_load_qty" required="True" caption="Daya Tampung" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_reg_dtl_parkingFormmax_load_qty">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="693" visible="Yes" fieldSourceType="DBColumn" dataType="Float" name="first_service_charge" fieldSource="first_service_charge" required="True" caption="Tarif Jam Pertama" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_reg_dtl_parkingFormfirst_service_charge" format="#,##0">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="694" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="avg_subscription_qty" fieldSource="avg_subscription_qty" required="True" caption="Frekwensi Kendaraan Bermotor" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_reg_dtl_parkingFormavg_subscription_qty">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="756" visible="Yes" fieldSourceType="DBColumn" dataType="Float" name="parking_size" fieldSource="parking_size" required="True" caption="Luas Lahan Parkir" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_reg_dtl_parkingFormparking_size" format="0">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="757" visible="Yes" fieldSourceType="DBColumn" dataType="Float" name="next_service_charge" fieldSource="next_service_charge" required="True" caption="Jam Berikutnya" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_reg_dtl_parkingFormnext_service_charge" format="#,##0">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Hidden id="678" fieldSourceType="DBColumn" dataType="Float" name="t_customer_id" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_vat_reg_dtl_parkingFormt_customer_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="619" fieldSourceType="DBColumn" dataType="Float" name="t_cust_account_id" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_vat_reg_dtl_parkingFormt_cust_account_id" fieldSource="t_cust_account_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="820" fieldSourceType="DBColumn" dataType="Float" name="p_parking_classification_id" wizardCaption="P App User Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_reg_dtl_parkingFormp_parking_classification_id" fieldSource="p_parking_classification_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<TextBox id="33" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="valid_from" fieldSource="valid_from" required="True" caption="Valid From" wizardCaption="Valid From" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_reg_dtl_parkingFormvalid_from" defaultValue="date(&quot;d-M-Y&quot;)" format="dd-mmm-yyyy">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<DatePicker id="34" name="DatePicker_valid_from" control="valid_from" wizardSatellite="True" wizardControl="valid_from" wizardDatePickerType="Image" wizardPicture="../Styles/CoffeeBreak/Images/DatePicker.gif" style="../Styles/sikp/Style.css" PathID="t_vat_reg_dtl_parkingFormDatePicker_valid_from">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</DatePicker>
				<TextBox id="35" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="valid_to" fieldSource="valid_to" required="False" caption="Valid To" wizardCaption="Valid To" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_reg_dtl_parkingFormvalid_to" format="dd-mmm-yyyy">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<DatePicker id="36" name="DatePicker_valid_to" control="valid_to" wizardSatellite="True" wizardControl="valid_to" wizardDatePickerType="Image" wizardPicture="../Styles/CoffeeBreak/Images/DatePicker.gif" style="../Styles/sikp/Style.css" PathID="t_vat_reg_dtl_parkingFormDatePicker_valid_to">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</DatePicker>
				<Hidden id="821" fieldSourceType="DBColumn" dataType="Text" name="classification_desc" wizardCaption="P App User Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_reg_dtl_parkingFormclassification_desc" fieldSource="classification_desc">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
</Components>
			<Events>
				<Event name="AfterExecuteUpdate" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="818"/>
					</Actions>
				</Event>
				<Event name="BeforeSelect" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="822"/>
					</Actions>
				</Event>
				<Event name="AfterExecuteInsert" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="832"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
				<TableParameter id="824" conditionType="Parameter" useIsNull="False" field="t_acc_dtl_parking.t_acc_dtl_parking_id" dataType="Float" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="t_acc_dtl_parking_id"/>
			</TableParameters>
			<SPParameters/>
			<SQLParameters>
				<SQLParameter id="827" parameterType="URL" variable="t_acc_dtl_parking_id" dataType="Float" parameterSource="t_acc_dtl_parking_id"/>
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
				<SQLParameter id="773" variable="description" dataType="Text" parameterType="Control" parameterSource="description"/>
				<SQLParameter id="774" variable="created_by" dataType="Text" parameterType="Expression" parameterSource="CCGetUserLogin()"/>
				<SQLParameter id="775" variable="updated_by" dataType="Text" parameterType="Expression" parameterSource="CCGetUserLogin()"/>
				<SQLParameter id="778" variable="t_cust_account_id" dataType="Float" parameterType="Control" parameterSource="t_cust_account_id" defaultValue="0"/>
				<SQLParameter id="779" variable="max_load_qty" dataType="Float" parameterType="Control" parameterSource="max_load_qty"/>
				<SQLParameter id="780" variable="first_service_charge" dataType="Float" parameterType="Control" parameterSource="first_service_charge"/>
				<SQLParameter id="781" variable="avg_subscription_qty" dataType="Text" parameterType="Control" parameterSource="avg_subscription_qty"/>
				<SQLParameter id="782" variable="classification_desc" dataType="Text" parameterType="Control" parameterSource="classification_desc"/>
				<SQLParameter id="784" variable="parking_size" dataType="Float" parameterType="Control" parameterSource="parking_size"/>
				<SQLParameter id="785" variable="next_service_charge" dataType="Float" parameterType="Control" parameterSource="next_service_charge"/>
				<SQLParameter id="830" variable="valid_from" parameterType="Control" dataType="Text" parameterSource="valid_from"/>
				<SQLParameter id="831" variable="valid_to" parameterType="Control" dataType="Text" parameterSource="valid_to"/>
			</ISQLParameters>
			<IFormElements>
				<CustomParameter id="758" field="t_vat_reg_dtl_parking_id" dataType="Float" parameterType="Control" parameterSource="t_vat_reg_dtl_parking_id"/>
				<CustomParameter id="759" field="description" dataType="Text" parameterType="Control" parameterSource="description"/>
				<CustomParameter id="760" field="created_by" dataType="Text" parameterType="Control" parameterSource="created_by"/>
				<CustomParameter id="761" field="updated_by" dataType="Text" parameterType="Control" parameterSource="updated_by"/>
				<CustomParameter id="762" field="creation_date" dataType="Text" parameterType="Control" parameterSource="creation_date" format="dd-mmm-yyyy"/>
				<CustomParameter id="763" field="updated_date" dataType="Text" parameterType="Control" parameterSource="updated_date" format="dd-mmm-yyyy"/>
				<CustomParameter id="764" field="t_vat_registration_id" dataType="Float" parameterType="Control" parameterSource="t_vat_registration_id"/>
				<CustomParameter id="765" field="max_load_qty" dataType="Float" parameterType="Control" parameterSource="max_load_qty"/>
				<CustomParameter id="766" field="first_service_charge" dataType="Float" parameterType="Control" parameterSource="first_service_charge"/>
				<CustomParameter id="767" field="avg_subscription_qty" dataType="Text" parameterType="Control" parameterSource="avg_subscription_qty"/>
				<CustomParameter id="768" field="classification_desc" dataType="Text" parameterType="Control" parameterSource="classification_desc"/>
				<CustomParameter id="769" field="p_parking_classification_id" dataType="Float" parameterType="Control" parameterSource="p_parking_classification_id"/>
				<CustomParameter id="770" field="parking_size" dataType="Float" parameterType="Control" parameterSource="parking_size"/>
				<CustomParameter id="771" field="next_service_charge" dataType="Float" parameterType="Control" parameterSource="next_service_charge"/>
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
				<SQLParameter id="800" variable="t_acc_dtl_parking_id" dataType="Float" parameterType="Control" parameterSource="t_acc_dtl_parking_id" defaultValue="0"/>
				<SQLParameter id="801" variable="description" dataType="Text" parameterType="Control" parameterSource="description"/>
				<SQLParameter id="803" variable="updated_by" dataType="Text" parameterType="Expression" parameterSource="CCGetUserLogin()"/>
				<SQLParameter id="806" variable="t_cust_account_id" dataType="Float" parameterType="Control" parameterSource="t_cust_account_id" defaultValue="0"/>
				<SQLParameter id="807" variable="max_load_qty" dataType="Float" parameterType="Control" parameterSource="max_load_qty"/>
				<SQLParameter id="808" variable="first_service_charge" dataType="Float" parameterType="Control" parameterSource="first_service_charge"/>
				<SQLParameter id="809" variable="avg_subscription_qty" dataType="Text" parameterType="Control" parameterSource="avg_subscription_qty"/>
				<SQLParameter id="812" variable="parking_size" dataType="Float" parameterType="Control" parameterSource="parking_size"/>
				<SQLParameter id="813" variable="next_service_charge" dataType="Float" parameterType="Control" parameterSource="next_service_charge"/>
				<SQLParameter id="828" variable="valid_from" parameterType="Control" dataType="Text" parameterSource="valid_from"/>
				<SQLParameter id="829" variable="valid_to" parameterType="Control" dataType="Text" parameterSource="valid_to"/>
			</USQLParameters>
			<UConditions>
			</UConditions>
			<UFormElements>
				<CustomParameter id="786" field="t_vat_reg_dtl_parking_id" dataType="Float" parameterType="Control" parameterSource="t_vat_reg_dtl_parking_id"/>
				<CustomParameter id="787" field="description" dataType="Text" parameterType="Control" parameterSource="description"/>
				<CustomParameter id="788" field="created_by" dataType="Text" parameterType="Control" parameterSource="created_by"/>
				<CustomParameter id="789" field="updated_by" dataType="Text" parameterType="Control" parameterSource="updated_by"/>
				<CustomParameter id="790" field="creation_date" dataType="Text" parameterType="Control" parameterSource="creation_date" format="dd-mmm-yyyy"/>
				<CustomParameter id="791" field="updated_date" dataType="Text" parameterType="Control" parameterSource="updated_date" format="dd-mmm-yyyy"/>
				<CustomParameter id="792" field="t_vat_registration_id" dataType="Float" parameterType="Control" parameterSource="t_vat_registration_id"/>
				<CustomParameter id="793" field="max_load_qty" dataType="Float" parameterType="Control" parameterSource="max_load_qty"/>
				<CustomParameter id="794" field="first_service_charge" dataType="Float" parameterType="Control" parameterSource="first_service_charge"/>
				<CustomParameter id="795" field="avg_subscription_qty" dataType="Text" parameterType="Control" parameterSource="avg_subscription_qty"/>
				<CustomParameter id="796" field="classification_desc" dataType="Text" parameterType="Control" parameterSource="classification_desc"/>
				<CustomParameter id="797" field="p_parking_classification_id" dataType="Float" parameterType="Control" parameterSource="p_parking_classification_id"/>
				<CustomParameter id="798" field="parking_size" dataType="Float" parameterType="Control" parameterSource="parking_size"/>
				<CustomParameter id="799" field="next_service_charge" dataType="Float" parameterType="Control" parameterSource="next_service_charge"/>
			</UFormElements>
			<DSPParameters/>
			<DSQLParameters>
				<SQLParameter id="751" variable="t_vat_reg_dtl_parking_id" parameterType="Control" defaultValue="0" dataType="Float" parameterSource="t_vat_reg_dtl_parking_id"/>
			</DSQLParameters>
			<DConditions>
			</DConditions>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Record>
	</Components>
	<CodeFiles>
		<CodeFile id="Events" language="PHPTemplates" name="data_potensi_parking_edit_events.php" forShow="False" comment="//" codePage="windows-1252"/>
		<CodeFile id="Code" language="PHPTemplates" name="data_potensi_parking_edit.php" forShow="True" url="data_potensi_parking_edit.php" comment="//" codePage="windows-1252"/>
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
