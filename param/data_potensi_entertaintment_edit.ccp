<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\param" secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="RWNet" wizardThemeVersion="3.0" needGeneration="0" pasteActions="pasteActions">
	<Components>
		<Record id="94" sourceType="SQL" urlType="Relative" secured="False" allowInsert="True" allowUpdate="True" allowDelete="True" validateData="True" preserveParameters="GET" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" connection="ConnSIKP" name="t_vat_reg_dtl_entertaintmentForm" errorSummator="Error" wizardCaption="Add/Edit V P App User " wizardFormMethod="post" PathID="t_vat_reg_dtl_entertaintmentForm" activeCollection="ISQLParameters" pasteAsReplace="pasteAsReplace" pasteActions="pasteActions" customDeleteType="SQL" parameterTypeListName="ParameterTypeList" customUpdateType="SQL" customInsertType="SQL" customInsert="INSERT INTO t_cacc_dtl_entertaintment(t_cacc_dtl_entertaintment_id, portion_person, created_by, updated_by, creation_date, updated_date, t_cust_account_id, room_qty, clerk_qty, f_and_b, booking_hour, seat_qty, service_charge_wd, service_charge_we, entertainment_desc, valid_from, valid_to) 
VALUES(generate_id('sikp','t_cacc_dtl_entertaintment','t_cacc_dtl_entertaintment_id'), decode({portion_person},0,null,{portion_person}), '{created_by}', '{updated_by}', sysdate, sysdate, {t_cust_account_id}, '{room_qty}', {clerk_qty}, decode({f_and_b},0,null,{f_and_b}), decode({booking_hour},0,null,{booking_hour}), {seat_qty}, {service_charge_wd}, {service_charge_we}, '{entertainment_desc}', to_date('{valid_from}','DD-MON-YYYY'), case when '{valid_to}' = '' then null else to_date('{valid_to}','dd-mon-yyyy') end)" customUpdate="UPDATE t_cacc_dtl_entertaintment SET 
portion_person=decode({portion_person},0,null,{portion_person}),
updated_by='{updated_by}', 
updated_date=sysdate, 
t_cust_account_id={t_cust_account_id}, 
room_qty='{room_qty}', 
clerk_qty={clerk_qty}, 
f_and_b=decode({f_and_b},0,null,{f_and_b}),  
booking_hour=decode({booking_hour},0,null,{booking_hour}), 
seat_qty={seat_qty}, 
service_charge_wd={service_charge_wd},
service_charge_we={service_charge_we},
valid_from = to_date('{valid_from}','DD-MON-YYYY'),
valid_to=case when '{valid_to}' = '' then null else to_date('{valid_to}','dd-mon-yyyy') end
WHERE t_cacc_dtl_entertaintment_id={t_cacc_dtl_entertaintment_id}" customDelete="DELETE FROM t_cacc_dtl_entertaintment
WHERE t_cacc_dtl_entertaintment_id = {t_cacc_dtl_entertaintment_id}" dataSource="SELECT a.t_cacc_dtl_entertaintment_id, a.t_cust_account_id, a.entertainment_desc, a.service_charge_wd, a.service_charge_we, 
       to_char(a.valid_from,'DD-MON-YYYY')as valid_from, to_char(a.valid_to,'DD-MON-YYYY')as valid_to,	
       a.seat_qty, a.room_qty, a.clerk_qty, a.booking_hour, a.f_and_b, a.portion_person, to_char(a.creation_date, 'DD-MON-YYYY') AS creation_date, 
       a.created_by, to_char(a.updated_date, 'DD-MON-YYYY') AS updated_date, a.updated_by
   FROM t_cacc_dtl_entertaintment a, t_cust_account c
  WHERE a.t_cust_account_id = c.t_cust_account_id 
  AND a.t_cacc_dtl_entertaintment_id = {t_cacc_dtl_entertaintment_id}">
			<Components>
				<Button id="95" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Insert" operation="Insert" wizardCaption="Add" PathID="t_vat_reg_dtl_entertaintmentFormButton_Insert" removeParameters="FLAG">
					<Components/>
					<Events>
					</Events>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="96" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Update" operation="Update" wizardCaption="Submit" PathID="t_vat_reg_dtl_entertaintmentFormButton_Update" removeParameters="FLAG">
					<Components/>
					<Events>
					</Events>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="97" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Delete" operation="Delete" wizardCaption="Delete" PathID="t_vat_reg_dtl_entertaintmentFormButton_Delete" removeParameters="FLAG;t_vat_reg_dtl_entertaintment_id">
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
				<Button id="99" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Cancel" operation="Cancel" wizardCaption="Cancel" PathID="t_vat_reg_dtl_entertaintmentFormButton_Cancel" removeParameters="FLAG;t_vat_reg_dtl_entertaintment_id">
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
				<TextBox id="124" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="created_by" fieldSource="created_by" required="False" caption="Created By" wizardCaption="Created By" wizardSize="16" wizardMaxLength="16" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_reg_dtl_entertaintmentFormcreated_by" defaultValue="CCGetUserLogin()">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="127" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="updated_by" fieldSource="updated_by" required="False" caption="Updated By" wizardCaption="Updated By" wizardSize="16" wizardMaxLength="16" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_reg_dtl_entertaintmentFormupdated_by" defaultValue="CCGetUserLogin()">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="122" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="creation_date" fieldSource="creation_date" required="False" caption="Creation Date" wizardCaption="Creation Date" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_reg_dtl_entertaintmentFormcreation_date" format="dd-mmm-yyyy" defaultValue="date(&quot;d-M-Y&quot;)">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="125" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="updated_date" fieldSource="updated_date" required="False" caption="Updated Date" wizardCaption="Updated Date" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_reg_dtl_entertaintmentFormupdated_date" defaultValue="date(&quot;d-M-Y&quot;)" format="dd-mmm-yyyy">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Hidden id="619" fieldSourceType="DBColumn" dataType="Float" name="t_cust_account_id" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_vat_reg_dtl_entertaintmentFormt_cust_account_id" fieldSource="t_cust_account_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="677" fieldSourceType="DBColumn" dataType="Text" html="False" name="customer_name" wizardCaption="Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="t_vat_reg_dtl_entertaintmentFormcustomer_name">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<TextBox id="694" visible="Yes" fieldSourceType="DBColumn" dataType="Float" name="clerk_qty" fieldSource="clerk_qty" required="True" caption="Jumlah PL/Pramuria/Pemijat" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_reg_dtl_entertaintmentFormclerk_qty">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="756" visible="Yes" fieldSourceType="DBColumn" dataType="Float" name="seat_qty" fieldSource="seat_qty" required="True" caption="Jumlah Lembar Meja/Kursi" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_reg_dtl_entertaintmentFormseat_qty">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="757" visible="Yes" fieldSourceType="DBColumn" dataType="Float" name="service_charge_wd" fieldSource="service_charge_wd" required="True" caption="Cover Change/HTM/Tarif Weekend" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_reg_dtl_entertaintmentFormservice_charge_wd" format="0">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="758" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="entertainment_desc" fieldSource="entertainment_desc" required="True" caption="Jenis Hiburan" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_reg_dtl_entertaintmentFormentertainment_desc">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Hidden id="759" fieldSourceType="DBColumn" dataType="Float" name="p_entertaintment_type_id" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_vat_reg_dtl_entertaintmentFormp_entertaintment_type_id" fieldSource="p_entertaintment_type_id" caption="p_entertaintment_type_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="821" fieldSourceType="DBColumn" dataType="Float" name="t_cacc_dtl_entertaintment_id" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_vat_reg_dtl_entertaintmentFormt_cacc_dtl_entertaintment_id" fieldSource="t_cacc_dtl_entertaintment_id" caption="t_cacc_dtl_entertaintment_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="822" fieldSourceType="DBColumn" dataType="Float" name="t_customer_id" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_vat_reg_dtl_entertaintmentFormt_customer_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<TextBox id="692" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="room_qty" fieldSource="room_qty" required="True" caption="Jumlah Lembar Meja/Kursi" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_reg_dtl_entertaintmentFormroom_qty">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="753" visible="Yes" fieldSourceType="DBColumn" dataType="Float" name="booking_hour" fieldSource="booking_hour" required="False" caption="Booking Jam" wizardCaption="Description" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_reg_dtl_entertaintmentFormbooking_hour">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="752" visible="Yes" fieldSourceType="DBColumn" dataType="Float" name="f_and_b" fieldSource="f_and_b" required="False" caption="F &amp; B" wizardCaption="Description" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_reg_dtl_entertaintmentFormf_and_b">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="114" visible="Yes" fieldSourceType="DBColumn" dataType="Float" name="portion_person" fieldSource="portion_person" required="False" caption="Porsi/Orang" wizardCaption="Description" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_reg_dtl_entertaintmentFormportion_person">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="827" visible="Yes" fieldSourceType="DBColumn" dataType="Float" name="service_charge_we" fieldSource="service_charge_we" required="True" caption="Cover Change/HTM/Tarif Non Weekend" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_reg_dtl_entertaintmentFormservice_charge_we" format="0">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="33" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="valid_from" fieldSource="valid_from" required="True" caption="Valid From" wizardCaption="Valid From" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_reg_dtl_entertaintmentFormvalid_from" defaultValue="date(&quot;d-M-Y&quot;)" format="dd-mmm-yyyy">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<DatePicker id="34" name="DatePicker_valid_from" control="valid_from" wizardSatellite="True" wizardControl="valid_from" wizardDatePickerType="Image" wizardPicture="../Styles/CoffeeBreak/Images/DatePicker.gif" style="../Styles/sikp/Style.css" PathID="t_vat_reg_dtl_entertaintmentFormDatePicker_valid_from">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</DatePicker>
				<TextBox id="35" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="valid_to" fieldSource="valid_to" required="False" caption="Valid To" wizardCaption="Valid To" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_reg_dtl_entertaintmentFormvalid_to" format="dd-mmm-yyyy">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<DatePicker id="36" name="DatePicker_valid_to" control="valid_to" wizardSatellite="True" wizardControl="valid_to" wizardDatePickerType="Image" wizardPicture="../Styles/CoffeeBreak/Images/DatePicker.gif" style="../Styles/sikp/Style.css" PathID="t_vat_reg_dtl_entertaintmentFormDatePicker_valid_to">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</DatePicker>
			</Components>
			<Events>
				<Event name="AfterExecuteInsert" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="823"/>
					</Actions>
				</Event>
				<Event name="AfterExecuteUpdate" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="824"/>
					</Actions>
				</Event>
				<Event name="AfterExecuteDelete" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="825"/>
					</Actions>
				</Event>
				<Event name="BeforeSelect" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="826"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
			</TableParameters>
			<SPParameters/>
			<SQLParameters>
				<SQLParameter id="830" variable="t_cacc_dtl_entertaintment_id" parameterType="URL" defaultValue="0" dataType="Float" parameterSource="t_cacc_dtl_entertaintment_id"/>
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
				<SQLParameter id="776" variable="portion_person" dataType="Float" parameterType="Control" parameterSource="portion_person" defaultValue="0"/>
				<SQLParameter id="777" variable="created_by" dataType="Text" parameterType="Expression" parameterSource="CCGetUserLogin()"/>
				<SQLParameter id="778" variable="updated_by" dataType="Text" parameterType="Expression" parameterSource="CCGetUserLogin()"/>
				<SQLParameter id="781" variable="t_cust_account_id" dataType="Float" parameterType="Control" parameterSource="t_cust_account_id" defaultValue="0"/>
				<SQLParameter id="782" variable="room_qty" dataType="Text" parameterType="Control" parameterSource="room_qty"/>
				<SQLParameter id="783" variable="clerk_qty" dataType="Float" parameterType="Control" parameterSource="clerk_qty"/>
				<SQLParameter id="784" variable="f_and_b" dataType="Float" parameterType="Control" parameterSource="f_and_b" defaultValue="0"/>
				<SQLParameter id="785" variable="booking_hour" dataType="Float" parameterType="Control" parameterSource="booking_hour" defaultValue="0"/>
				<SQLParameter id="786" variable="seat_qty" dataType="Float" parameterType="Control" parameterSource="seat_qty"/>
				<SQLParameter id="787" variable="service_charge_wd" dataType="Float" parameterType="Control" parameterSource="service_charge_wd" defaultValue="0"/>
				<SQLParameter id="788" variable="entertainment_desc" dataType="Text" parameterType="Control" parameterSource="entertainment_desc"/>
				<SQLParameter id="828" variable="service_charge_we" parameterType="Control" defaultValue="0" dataType="Float" parameterSource="service_charge_we"/>
				<SQLParameter id="833" variable="valid_from" parameterType="Control" dataType="Text" parameterSource="valid_from"/>
				<SQLParameter id="834" variable="valid_to" parameterType="Control" dataType="Text" parameterSource="valid_to"/>
			</ISQLParameters>
			<IFormElements>
				<CustomParameter id="760" field="t_vat_reg_dtl_hotel_id" dataType="Float" parameterType="Control" parameterSource="t_vat_reg_dtl_hotel_id"/>
				<CustomParameter id="761" field="portion_person" dataType="Float" parameterType="Control" parameterSource="portion_person"/>
				<CustomParameter id="762" field="created_by" dataType="Text" parameterType="Control" parameterSource="created_by"/>
				<CustomParameter id="763" field="updated_by" dataType="Text" parameterType="Control" parameterSource="updated_by"/>
				<CustomParameter id="764" field="creation_date" dataType="Text" parameterType="Control" parameterSource="creation_date" format="dd-mmm-yyyy"/>
				<CustomParameter id="765" field="updated_date" dataType="Text" parameterType="Control" parameterSource="updated_date" format="dd-mmm-yyyy"/>
				<CustomParameter id="766" field="t_vat_registration_id" dataType="Float" parameterType="Control" parameterSource="t_vat_registration_id"/>
				<CustomParameter id="767" field="room_qty" dataType="Float" parameterType="Control" parameterSource="room_qty"/>
				<CustomParameter id="768" field="clerk_qty" dataType="Float" parameterType="Control" parameterSource="clerk_qty"/>
				<CustomParameter id="769" field="f_and_b" dataType="Float" parameterType="Control" parameterSource="f_and_b"/>
				<CustomParameter id="770" field="booking_hour" dataType="Float" parameterType="Control" parameterSource="booking_hour"/>
				<CustomParameter id="771" field="seat_qty" dataType="Float" parameterType="Control" parameterSource="seat_qty"/>
				<CustomParameter id="772" field="service_charge" dataType="Float" parameterType="Control" parameterSource="service_charge"/>
				<CustomParameter id="773" field="entertainment_desc" dataType="Text" parameterType="Control" parameterSource="entertainment_desc"/>
				<CustomParameter id="774" field="p_entertaintment_type_id" dataType="Float" parameterType="Control" parameterSource="p_entertaintment_type_id"/>
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
				<SQLParameter id="805" variable="t_cacc_dtl_entertaintment_id" dataType="Float" parameterType="Control" parameterSource="t_cacc_dtl_entertaintment_id" defaultValue="0"/>
				<SQLParameter id="806" variable="portion_person" dataType="Float" parameterType="Control" parameterSource="portion_person" defaultValue="0"/>
				<SQLParameter id="808" variable="updated_by" dataType="Text" parameterType="Expression" parameterSource="CCGetUserLogin()"/>
				<SQLParameter id="811" variable="t_cust_account_id" dataType="Float" parameterType="Control" parameterSource="t_cust_account_id" defaultValue="0"/>
				<SQLParameter id="812" variable="room_qty" dataType="Text" parameterType="Control" parameterSource="room_qty"/>
				<SQLParameter id="813" variable="clerk_qty" dataType="Float" parameterType="Control" parameterSource="clerk_qty"/>
				<SQLParameter id="814" variable="f_and_b" dataType="Float" parameterType="Control" parameterSource="f_and_b" defaultValue="0"/>
				<SQLParameter id="815" variable="booking_hour" dataType="Float" parameterType="Control" parameterSource="booking_hour" defaultValue="0"/>
				<SQLParameter id="816" variable="seat_qty" dataType="Float" parameterType="Control" parameterSource="seat_qty"/>
				<SQLParameter id="817" variable="service_charge_wd" dataType="Float" parameterType="Control" parameterSource="service_charge_wd" defaultValue="0"/>
				<SQLParameter id="829" variable="service_charge_we" parameterType="Control" defaultValue="0" dataType="Float" parameterSource="service_charge_we"/>
				<SQLParameter id="831" variable="valid_from" parameterType="Control" dataType="Text" parameterSource="valid_from"/>
				<SQLParameter id="832" variable="valid_to" parameterType="Control" dataType="Text" parameterSource="valid_to"/>
			</USQLParameters>
			<UConditions>
			</UConditions>
			<UFormElements>
				<CustomParameter id="790" field="t_vat_reg_dtl_entertaintment_id" dataType="Float" parameterType="Control" parameterSource="t_vat_reg_dtl_entertaintment_id"/>
				<CustomParameter id="791" field="portion_person" dataType="Float" parameterType="Control" parameterSource="portion_person"/>
				<CustomParameter id="792" field="created_by" dataType="Text" parameterType="Control" parameterSource="created_by"/>
				<CustomParameter id="793" field="updated_by" dataType="Text" parameterType="Control" parameterSource="updated_by"/>
				<CustomParameter id="794" field="creation_date" dataType="Text" parameterType="Control" parameterSource="creation_date" format="dd-mmm-yyyy"/>
				<CustomParameter id="795" field="updated_date" dataType="Text" parameterType="Control" parameterSource="updated_date" format="dd-mmm-yyyy"/>
				<CustomParameter id="796" field="t_vat_registration_id" dataType="Float" parameterType="Control" parameterSource="t_vat_registration_id"/>
				<CustomParameter id="797" field="room_qty" dataType="Text" parameterType="Control" parameterSource="room_qty"/>
				<CustomParameter id="798" field="clerk_qty" dataType="Float" parameterType="Control" parameterSource="clerk_qty"/>
				<CustomParameter id="799" field="f_and_b" dataType="Float" parameterType="Control" parameterSource="f_and_b"/>
				<CustomParameter id="800" field="booking_hour" dataType="Float" parameterType="Control" parameterSource="booking_hour"/>
				<CustomParameter id="801" field="seat_qty" dataType="Float" parameterType="Control" parameterSource="seat_qty"/>
				<CustomParameter id="802" field="service_charge" dataType="Float" parameterType="Control" parameterSource="service_charge"/>
				<CustomParameter id="803" field="entertainment_desc" dataType="Text" parameterType="Control" parameterSource="entertainment_desc"/>
				<CustomParameter id="804" field="p_entertaintment_type_id" dataType="Float" parameterType="Control" parameterSource="p_entertaintment_type_id"/>
			</UFormElements>
			<DSPParameters/>
			<DSQLParameters>
				<SQLParameter id="820" variable="t_cacc_dtl_entertaintment_id" parameterType="Control" defaultValue="0" dataType="Integer" parameterSource="t_cacc_dtl_entertaintment_id"/>
			</DSQLParameters>
			<DConditions>
			</DConditions>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Record>
	</Components>
	<CodeFiles>
		<CodeFile id="Events" language="PHPTemplates" name="data_potensi_entertaintment_edit_events.php" forShow="False" comment="//" codePage="windows-1252"/>
		<CodeFile id="Code" language="PHPTemplates" name="data_potensi_entertaintment_edit.php" forShow="True" url="data_potensi_entertaintment_edit.php" comment="//" codePage="windows-1252"/>
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
