<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\param" secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="RWNet" wizardThemeVersion="3.0" needGeneration="0" pasteActions="pasteActions">
	<Components>
		<Record id="94" sourceType="SQL" urlType="Relative" secured="False" allowInsert="True" allowUpdate="True" allowDelete="True" validateData="True" preserveParameters="GET" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" connection="ConnSIKP" name="t_vat_reg_dtl_restaurantForm" errorSummator="Error" wizardCaption="Add/Edit V P App User " wizardFormMethod="post" PathID="t_vat_reg_dtl_restaurantForm" activeCollection="DSQLParameters" pasteAsReplace="pasteAsReplace" pasteActions="pasteActions" customDeleteType="SQL" parameterTypeListName="ParameterTypeList" customUpdateType="SQL" customInsertType="SQL" customInsert="INSERT INTO t_cacc_dtl_restaurant(t_cacc_dtl_restaurant_id, description, created_by, updated_by, creation_date, updated_date, t_cust_account_id, table_qty, avg_subscription, seat_qty, max_service_qty, service_type_desc, valid_from, valid_to) 
VALUES(generate_id('sikp','t_cacc_dtl_restaurant','t_cacc_dtl_restaurant_id'), '{description}', '{created_by}', '{updated_by}', sysdate, sysdate, {t_cust_account_id}, '{table_qty}', {avg_subscription}, {seat_qty}, {max_service_qty}, '{service_type_desc}', to_date('{valid_from}','DD-MON-YYYY'), case when '{valid_to}' = '' then null else to_date('{valid_to}','dd-mon-yyyy') end)" customUpdate="UPDATE t_cacc_dtl_restaurant
SET description='{description}', 
updated_by='{updated_by}', 
updated_date=sysdate, 
t_cust_account_id={t_cust_account_id}, 
table_qty='{table_qty}', 
avg_subscription={avg_subscription}, 
seat_qty={seat_qty}, 
max_service_qty={max_service_qty},
valid_from = to_date('{valid_from}','DD-MON-YYYY'),
valid_to=case when '{valid_to}' = '' then null else to_date('{valid_to}','dd-mon-yyyy') end
WHERE t_cacc_dtl_restaurant_id={t_cacc_dtl_restaurant_id}" customDelete="DELETE FROM t_cacc_dtl_restaurant
WHERE t_cacc_dtl_restaurant_id = {t_cacc_dtl_restaurant_id}" dataSource="SELECT a.t_cacc_dtl_restaurant_id, a.t_cust_account_id, a.service_type_desc, 
	 to_char(a.valid_from,'DD-MON-YYYY')as valid_from, to_char(a.valid_to,'DD-MON-YYYY')as valid_to,	
	 a.seat_qty, a.table_qty, a.max_service_qty, a.avg_subscription, a.description, to_char(a.creation_date, 'DD-MON-YYYY') AS creation_date, 
	 a.created_by, to_char(a.updated_date, 'DD-MON-YYYY') AS updated_date, a.updated_by
   FROM t_cacc_dtl_restaurant a, t_cust_account c
  WHERE a.t_cust_account_id = c.t_cust_account_id 
  AND a.t_cacc_dtl_restaurant_id = {t_cacc_dtl_restaurant_id}">
			<Components>
				<Button id="95" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Insert" operation="Insert" wizardCaption="Add" PathID="t_vat_reg_dtl_restaurantFormButton_Insert" removeParameters="FLAG">
					<Components/>
					<Events>
					</Events>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="96" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Update" operation="Update" wizardCaption="Submit" PathID="t_vat_reg_dtl_restaurantFormButton_Update" removeParameters="FLAG">
					<Components/>
					<Events>
					</Events>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="97" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Delete" operation="Delete" wizardCaption="Delete" PathID="t_vat_reg_dtl_restaurantFormButton_Delete" removeParameters="FLAG;t_vat_reg_dtl_hotel_id">
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
				<Button id="99" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Cancel" operation="Cancel" wizardCaption="Cancel" PathID="t_vat_reg_dtl_restaurantFormButton_Cancel" removeParameters="FLAG;t_vat_reg_dtl_hotel_id">
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
				<Hidden id="101" fieldSourceType="DBColumn" dataType="Float" name="t_cacc_dtl_restaurant_id" fieldSource="t_cacc_dtl_restaurant_id" caption="Id" wizardCaption="P App User Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_reg_dtl_restaurantFormt_cacc_dtl_restaurant_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<TextBox id="114" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="description" fieldSource="description" required="False" caption="Description" wizardCaption="Description" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_reg_dtl_restaurantFormdescription">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="124" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="created_by" fieldSource="created_by" required="False" caption="Created By" wizardCaption="Created By" wizardSize="16" wizardMaxLength="16" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_reg_dtl_restaurantFormcreated_by" defaultValue="CCGetUserLogin()">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="127" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="updated_by" fieldSource="updated_by" required="False" caption="Updated By" wizardCaption="Updated By" wizardSize="16" wizardMaxLength="16" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_reg_dtl_restaurantFormupdated_by" defaultValue="CCGetUserLogin()">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="122" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="creation_date" fieldSource="creation_date" required="False" caption="Creation Date" wizardCaption="Creation Date" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_reg_dtl_restaurantFormcreation_date" format="dd-mmm-yyyy" defaultValue="date(&quot;d-M-Y&quot;)">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="125" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="updated_date" fieldSource="updated_date" required="False" caption="Updated Date" wizardCaption="Updated Date" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_reg_dtl_restaurantFormupdated_date" defaultValue="date(&quot;d-M-Y&quot;)" format="dd-mmm-yyyy">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Hidden id="677" fieldSourceType="DBColumn" dataType="Text" html="False" name="customer_name" wizardCaption="Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="t_vat_reg_dtl_restaurantFormcustomer_name">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<TextBox id="692" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="table_qty" fieldSource="table_qty" required="True" caption="Jumlah Meja" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_reg_dtl_restaurantFormtable_qty">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="758" visible="Yes" fieldSourceType="DBColumn" dataType="Float" name="seat_qty" fieldSource="seat_qty" required="True" caption="Jumlah Kursi" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_reg_dtl_restaurantFormseat_qty">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="759" visible="Yes" fieldSourceType="DBColumn" dataType="Float" name="max_service_qty" fieldSource="max_service_qty" required="True" caption="Daya Tampung" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_reg_dtl_restaurantFormmax_service_qty">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="786" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="service_type_desc" fieldSource="service_type_desc" required="True" caption="Jenis Pelayanan" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_reg_dtl_restaurantFormservice_type_desc">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Hidden id="678" fieldSourceType="DBColumn" dataType="Float" name="t_customer_id" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_vat_reg_dtl_restaurantFormt_customer_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<TextBox id="694" visible="Yes" fieldSourceType="DBColumn" dataType="Float" name="avg_subscription" fieldSource="avg_subscription" required="True" caption="Jumlah pengunjung rata-rata per Bulan" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_reg_dtl_restaurantFormavg_subscription">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Hidden id="619" fieldSourceType="DBColumn" dataType="Float" name="t_cust_account_id" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_vat_reg_dtl_restaurantFormt_cust_account_id" fieldSource="t_cust_account_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="787" fieldSourceType="DBColumn" dataType="Text" name="p_rest_service_type_id" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_vat_reg_dtl_restaurantFormp_rest_service_type_id" fieldSource="p_rest_service_type_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<TextBox id="33" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="valid_from" fieldSource="valid_from" required="True" caption="Valid From" wizardCaption="Valid From" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_reg_dtl_restaurantFormvalid_from" defaultValue="date(&quot;d-M-Y&quot;)" format="dd-mmm-yyyy">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<DatePicker id="34" name="DatePicker_valid_from" control="valid_from" wizardSatellite="True" wizardControl="valid_from" wizardDatePickerType="Image" wizardPicture="../Styles/CoffeeBreak/Images/DatePicker.gif" style="../Styles/sikp/Style.css" PathID="t_vat_reg_dtl_restaurantFormDatePicker_valid_from">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</DatePicker>
				<TextBox id="35" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="valid_to" fieldSource="valid_to" required="False" caption="Valid To" wizardCaption="Valid To" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_reg_dtl_restaurantFormvalid_to" format="dd-mmm-yyyy">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<DatePicker id="36" name="DatePicker_valid_to" control="valid_to" wizardSatellite="True" wizardControl="valid_to" wizardDatePickerType="Image" wizardPicture="../Styles/CoffeeBreak/Images/DatePicker.gif" style="../Styles/sikp/Style.css" PathID="t_vat_reg_dtl_restaurantFormDatePicker_valid_to">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</DatePicker>
			</Components>
			<Events>
				<Event name="AfterExecuteUpdate" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="817"/>
					</Actions>
				</Event>
				<Event name="BeforeSelect" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="819"/>
					</Actions>
				</Event>
				<Event name="AfterExecuteInsert" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="821"/>
					</Actions>
				</Event>
				<Event name="AfterExecuteDelete" type="Server">
<Actions>
<Action actionName="Custom Code" actionCategory="General" id="826"/>
</Actions>
</Event>
</Events>
			<TableParameters>
			</TableParameters>
			<SPParameters/>
			<SQLParameters>
				<SQLParameter id="820" variable="t_cacc_dtl_restaurant_id" parameterType="URL" defaultValue="0" dataType="Float" parameterSource="t_cacc_dtl_restaurant_id"/>
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
				<SQLParameter id="774" variable="description" dataType="Text" parameterType="Control" parameterSource="description"/>
				<SQLParameter id="775" variable="created_by" dataType="Text" parameterType="Expression" parameterSource="CCGetUserLogin()"/>
				<SQLParameter id="776" variable="updated_by" dataType="Text" parameterType="Expression" parameterSource="CCGetUserLogin()"/>
				<SQLParameter id="779" variable="t_cust_account_id" dataType="Float" parameterType="Control" parameterSource="t_cust_account_id" defaultValue="0"/>
				<SQLParameter id="781" variable="table_qty" dataType="Text" parameterType="Control" parameterSource="table_qty"/>
				<SQLParameter id="783" variable="avg_subscription" dataType="Float" parameterType="Control" parameterSource="avg_subscription"/>
				<SQLParameter id="784" variable="seat_qty" dataType="Float" parameterType="Control" parameterSource="seat_qty"/>
				<SQLParameter id="785" variable="max_service_qty" dataType="Float" parameterType="Control" parameterSource="max_service_qty"/>
				<SQLParameter id="815" variable="service_type_desc" parameterType="Control" dataType="Text" parameterSource="service_type_desc"/>
				<SQLParameter id="822" variable="valid_from" parameterType="Control" dataType="Text" parameterSource="valid_from"/>
				<SQLParameter id="823" variable="valid_to" parameterType="Control" dataType="Text" parameterSource="valid_to"/>
			</ISQLParameters>
			<IFormElements>
				<CustomParameter id="760" field="t_vat_reg_dtl_restaurant_id" dataType="Float" parameterType="Control" parameterSource="t_vat_reg_dtl_restaurant_id"/>
				<CustomParameter id="761" field="description" dataType="Text" parameterType="Control" parameterSource="description"/>
				<CustomParameter id="762" field="created_by" dataType="Text" parameterType="Control" parameterSource="created_by"/>
				<CustomParameter id="763" field="updated_by" dataType="Text" parameterType="Control" parameterSource="updated_by"/>
				<CustomParameter id="764" field="creation_date" dataType="Text" parameterType="Control" parameterSource="creation_date" format="dd-mmm-yyyy"/>
				<CustomParameter id="765" field="updated_date" dataType="Text" parameterType="Control" parameterSource="updated_date" format="dd-mmm-yyyy"/>
				<CustomParameter id="766" field="t_vat_registration_id" dataType="Float" parameterType="Control" parameterSource="t_vat_registration_id"/>
				<CustomParameter id="767" field="p_rest_service_type_id" dataType="Float" parameterType="Control" parameterSource="p_rest_service_type_id"/>
				<CustomParameter id="768" field="table_qty" dataType="Float" parameterType="Control" parameterSource="table_qty"/>
				<CustomParameter id="769" field="service_charge" dataType="Float" parameterType="Control" parameterSource="service_charge"/>
				<CustomParameter id="770" field="avg_subscription" dataType="Float" parameterType="Control" parameterSource="avg_subscription"/>
				<CustomParameter id="771" field="seat_qty" dataType="Float" parameterType="Control" parameterSource="seat_qty"/>
				<CustomParameter id="772" field="max_service_qty" dataType="Float" parameterType="Control" parameterSource="max_service_qty"/>
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
				<SQLParameter id="801" variable="t_cacc_dtl_restaurant_id" dataType="Float" parameterType="Control" parameterSource="t_cacc_dtl_restaurant_id" defaultValue="0"/>
				<SQLParameter id="802" variable="description" dataType="Text" parameterType="Control" parameterSource="description"/>
				<SQLParameter id="804" variable="updated_by" dataType="Text" parameterType="Expression" parameterSource="CCGetUserLogin()"/>
				<SQLParameter id="807" variable="t_cust_account_id" dataType="Float" parameterType="Control" parameterSource="t_cust_account_id" defaultValue="0"/>
				<SQLParameter id="808" variable="table_qty" dataType="Text" parameterType="Control" parameterSource="table_qty"/>
				<SQLParameter id="809" variable="avg_subscription" dataType="Float" parameterType="Control" parameterSource="avg_subscription"/>
				<SQLParameter id="810" variable="seat_qty" dataType="Float" parameterType="Control" parameterSource="seat_qty"/>
				<SQLParameter id="811" variable="max_service_qty" dataType="Float" parameterType="Control" parameterSource="max_service_qty"/>
				<SQLParameter id="824" variable="valid_from" parameterType="Control" dataType="Text" parameterSource="valid_from"/>
				<SQLParameter id="825" variable="valid_to" parameterType="Control" dataType="Text" parameterSource="valid_to"/>
			</USQLParameters>
			<UConditions>
			</UConditions>
			<UFormElements>
				<CustomParameter id="788" field="t_vat_reg_dtl_restaurant_id" dataType="Float" parameterType="Control" parameterSource="t_vat_reg_dtl_restaurant_id"/>
				<CustomParameter id="789" field="description" dataType="Text" parameterType="Control" parameterSource="description"/>
				<CustomParameter id="790" field="created_by" dataType="Text" parameterType="Control" parameterSource="created_by"/>
				<CustomParameter id="791" field="updated_by" dataType="Text" parameterType="Control" parameterSource="updated_by"/>
				<CustomParameter id="792" field="creation_date" dataType="Text" parameterType="Control" parameterSource="creation_date" format="dd-mmm-yyyy"/>
				<CustomParameter id="793" field="updated_date" dataType="Text" parameterType="Control" parameterSource="updated_date" format="dd-mmm-yyyy"/>
				<CustomParameter id="794" field="t_vat_registration_id" dataType="Float" parameterType="Control" parameterSource="t_vat_registration_id"/>
				<CustomParameter id="795" field="table_qty" dataType="Text" parameterType="Control" parameterSource="table_qty"/>
				<CustomParameter id="796" field="avg_subscription" dataType="Float" parameterType="Control" parameterSource="avg_subscription"/>
				<CustomParameter id="797" field="seat_qty" dataType="Float" parameterType="Control" parameterSource="seat_qty"/>
				<CustomParameter id="798" field="max_service_qty" dataType="Float" parameterType="Control" parameterSource="max_service_qty"/>
				<CustomParameter id="799" field="service_type_desc" dataType="Text" parameterType="Control" parameterSource="service_type_desc"/>
				<CustomParameter id="800" field="p_rest_service_type_id" dataType="Text" parameterType="Control" parameterSource="p_rest_service_type_id"/>
			</UFormElements>
			<DSPParameters/>
			<DSQLParameters>
				<SQLParameter id="814" variable="t_cacc_dtl_restaurant_id" parameterType="Control" defaultValue="0" dataType="Float" parameterSource="t_cacc_dtl_restaurant_id"/>
			</DSQLParameters>
			<DConditions>
			</DConditions>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Record>
	</Components>
	<CodeFiles>
		<CodeFile id="Events" language="PHPTemplates" name="data_potensi_restaurant_edit_events.php" forShow="False" comment="//" codePage="windows-1252"/>
		<CodeFile id="Code" language="PHPTemplates" name="data_potensi_restaurant_edit.php" forShow="True" url="data_potensi_restaurant_edit.php" comment="//" codePage="windows-1252"/>
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
