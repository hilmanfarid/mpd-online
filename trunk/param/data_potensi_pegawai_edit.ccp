<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\param" secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="RWNet" wizardThemeVersion="3.0" needGeneration="0" pasteActions="pasteActions">
	<Components>
		<Record id="94" sourceType="Table" urlType="Relative" secured="False" allowInsert="True" allowUpdate="True" allowDelete="False" validateData="True" preserveParameters="GET" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" connection="ConnSIKP" name="t_vat_reg_employeeForm" errorSummator="Error" wizardCaption="Add/Edit V P App User " wizardFormMethod="post" PathID="t_vat_reg_employeeForm" activeCollection="USQLParameters" pasteAsReplace="pasteAsReplace" pasteActions="pasteActions" customDeleteType="SQL" parameterTypeListName="ParameterTypeList" customUpdateType="SQL" customInsertType="SQL" customInsert="INSERT INTO t_cust_acc_employee(t_cust_acc_employee_id, description, created_by, updated_by, creation_date, updated_date, t_cust_account_id, p_job_position_id, employee_qty, employee_salery, valid_from, valid_to) 
VALUES(generate_id('sikp','t_cust_acc_employee','t_cust_acc_employee_id'), '{description}', '{created_by}', '{updated_by}', sysdate, sysdate, {t_cust_account_id}, {p_job_position_id}, {employee_qty}, {employee_salery}, to_date('{valid_from}','DD-MON-YYYY'),case when '{valid_to}' = '' then null else to_date('{valid_to}','dd-mon-yyyy') end)" customUpdate="UPDATE t_cust_acc_employee SET 
description='{description}', 
updated_by='{updated_by}', 
updated_date=sysdate, 
p_job_position_id={p_job_position_id}, 
employee_qty={employee_qty}, 
employee_salery={employee_salery},
valid_from = to_date('{valid_from}','DD-MON-YYYY'),
valid_to=case when '{valid_to}' = '' then null else to_date('{valid_to}','dd-mon-yyyy') end 
WHERE t_cust_acc_employee_id={t_cust_acc_employee_id}" customDelete="DELETE FROM t_vat_reg_employee
WHERE t_vat_reg_employee_id = {t_vat_reg_employee_id}" dataSource="v_cust_acc_employee">
			<Components>
				<Button id="95" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Insert" operation="Insert" wizardCaption="Add" PathID="t_vat_reg_employeeFormButton_Insert" removeParameters="FLAG">
					<Components/>
					<Events>
					</Events>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="96" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Update" operation="Update" wizardCaption="Submit" PathID="t_vat_reg_employeeFormButton_Update" removeParameters="FLAG">
					<Components/>
					<Events>
					</Events>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="97" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Delete" operation="Delete" wizardCaption="Delete" PathID="t_vat_reg_employeeFormButton_Delete" removeParameters="FLAG;t_vat_reg_dtl_hotel_id">
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
				<Button id="99" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Cancel" operation="Cancel" wizardCaption="Cancel" PathID="t_vat_reg_employeeFormButton_Cancel" removeParameters="FLAG;t_vat_reg_dtl_hotel_id">
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
				<Hidden id="101" fieldSourceType="DBColumn" dataType="Float" name="t_cust_acc_employee_id" fieldSource="t_cust_acc_employee_id" caption="Id" wizardCaption="P App User Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_reg_employeeFormt_cust_acc_employee_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<TextBox id="114" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="description" fieldSource="description" required="False" caption="Description" wizardCaption="Description" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_reg_employeeFormdescription">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="124" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="created_by" fieldSource="created_by" required="False" caption="Created By" wizardCaption="Created By" wizardSize="16" wizardMaxLength="16" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_reg_employeeFormcreated_by" defaultValue="CCGetUserLogin()">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="127" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="updated_by" fieldSource="updated_by" required="False" caption="Updated By" wizardCaption="Updated By" wizardSize="16" wizardMaxLength="16" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_reg_employeeFormupdated_by" defaultValue="CCGetUserLogin()">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="122" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="creation_date" fieldSource="creation_date" required="False" caption="Creation Date" wizardCaption="Creation Date" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_reg_employeeFormcreation_date" format="dd-mmm-yyyy" defaultValue="date(&quot;d-M-Y&quot;)">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="125" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="updated_date" fieldSource="updated_date" required="False" caption="Updated Date" wizardCaption="Updated Date" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_reg_employeeFormupdated_date" defaultValue="date(&quot;d-M-Y&quot;)" format="dd-mmm-yyyy">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Hidden id="677" fieldSourceType="DBColumn" dataType="Text" html="False" name="customer_name" wizardCaption="Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="t_vat_reg_employeeFormcustomer_name">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="752" fieldSourceType="DBColumn" dataType="Float" name="t_customer_id" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_vat_reg_employeeFormt_customer_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<TextBox id="757" visible="Yes" fieldSourceType="DBColumn" dataType="Float" name="employee_qty" fieldSource="employee_qty" required="True" caption="Jumlah Pegawai" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_reg_employeeFormemployee_qty" format="0">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="692" visible="Yes" fieldSourceType="DBColumn" dataType="Float" name="employee_salery" fieldSource="employee_salery" required="True" caption="Gaji Pegawai" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_reg_employeeFormemployee_salery" format="0">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Hidden id="619" fieldSourceType="DBColumn" dataType="Float" name="t_cust_account_id" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_vat_reg_employeeFormt_cust_account_id" fieldSource="t_cust_account_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<TextBox id="565" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="jabatan" fieldSource="jabatan" required="True" caption="Jabatan" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_reg_employeeFormjabatan">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Hidden id="567" fieldSourceType="DBColumn" dataType="Float" name="p_job_position_id" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_vat_reg_employeeFormp_job_position_id" fieldSource="p_job_position_id" caption="p_job_position_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<TextBox id="33" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="valid_from" fieldSource="valid_from" required="True" caption="Valid From" wizardCaption="Valid From" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_reg_employeeFormvalid_from" defaultValue="date(&quot;d-M-Y&quot;)" format="dd-mmm-yyyy">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
<DatePicker id="34" name="DatePicker_valid_from" control="valid_from" wizardSatellite="True" wizardControl="valid_from" wizardDatePickerType="Image" wizardPicture="../Styles/CoffeeBreak/Images/DatePicker.gif" style="../Styles/sikp/Style.css" PathID="t_vat_reg_employeeFormDatePicker_valid_from">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</DatePicker>
<TextBox id="35" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="valid_to" fieldSource="valid_to" required="False" caption="Valid To" wizardCaption="Valid To" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_reg_employeeFormvalid_to" format="dd-mmm-yyyy">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
<DatePicker id="36" name="DatePicker_valid_to" control="valid_to" wizardSatellite="True" wizardControl="valid_to" wizardDatePickerType="Image" wizardPicture="../Styles/CoffeeBreak/Images/DatePicker.gif" style="../Styles/sikp/Style.css" PathID="t_vat_reg_employeeFormDatePicker_valid_to">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</DatePicker>
</Components>
			<Events>
				<Event name="AfterExecuteUpdate" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="754"/>
					</Actions>
				</Event>
				<Event name="AfterExecuteInsert" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="755"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
				<TableParameter id="759" conditionType="Parameter" useIsNull="False" field="t_cust_acc_employee_id" dataType="Float" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="t_cust_acc_employee_id"/>
</TableParameters>
			<SPParameters/>
			<SQLParameters>
			</SQLParameters>
			<JoinTables>
				<JoinTable id="758" tableName="v_cust_acc_employee" posLeft="10" posTop="10" posWidth="160" posHeight="180"/>
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
				<SQLParameter id="711" variable="description" dataType="Text" parameterType="Control" parameterSource="description"/>
				<SQLParameter id="712" variable="created_by" dataType="Text" parameterType="Expression" parameterSource="CCGetUserLogin()"/>
				<SQLParameter id="713" variable="updated_by" dataType="Text" parameterType="Expression" parameterSource="CCGetUserLogin()"/>
				<SQLParameter id="716" variable="t_cust_account_id" dataType="Float" parameterType="Control" parameterSource="t_cust_account_id" defaultValue="0"/>
				<SQLParameter id="717" variable="p_job_position_id" dataType="Float" parameterType="Control" parameterSource="p_job_position_id" defaultValue="0"/>
				<SQLParameter id="720" variable="employee_qty" dataType="Float" parameterType="Control" parameterSource="employee_qty" defaultValue="0"/>
				<SQLParameter id="721" variable="employee_salery" dataType="Float" parameterType="Control" parameterSource="employee_salery" defaultValue="0"/>
				<SQLParameter id="760" variable="valid_from" parameterType="Control" dataType="Text" parameterSource="valid_from"/>
<SQLParameter id="761" variable="valid_to" parameterType="Control" dataType="Text" parameterSource="valid_to"/>
</ISQLParameters>
			<IFormElements>
				<CustomParameter id="695" field="t_vat_reg_dtl_hotel_id" dataType="Float" parameterType="Control" parameterSource="t_vat_reg_dtl_hotel_id"/>
				<CustomParameter id="696" field="description" dataType="Text" parameterType="Control" parameterSource="description"/>
				<CustomParameter id="697" field="created_by" dataType="Text" parameterType="Control" parameterSource="created_by"/>
				<CustomParameter id="698" field="updated_by" dataType="Text" parameterType="Control" parameterSource="updated_by"/>
				<CustomParameter id="699" field="creation_date" dataType="Text" parameterType="Control" parameterSource="creation_date" format="dd-mmm-yyyy"/>
				<CustomParameter id="700" field="updated_date" dataType="Text" parameterType="Control" parameterSource="updated_date" format="dd-mmm-yyyy"/>
				<CustomParameter id="701" field="t_vat_registration_id" dataType="Float" parameterType="Control" parameterSource="t_vat_registration_id"/>
				<CustomParameter id="704" field="p_room_type_id" dataType="Float" parameterType="Control" parameterSource="p_room_type_id"/>
				<CustomParameter id="705" field="services" dataType="Text" parameterType="Control" parameterSource="services"/>
				<CustomParameter id="706" field="p_hotel_grade_id" dataType="Float" parameterType="Control" parameterSource="p_hotel_grade_id"/>
				<CustomParameter id="707" field="room_qty" dataType="Float" parameterType="Control" parameterSource="room_qty"/>
				<CustomParameter id="708" field="service_charge" dataType="Text" parameterType="Control" parameterSource="service_charge"/>
				<CustomParameter id="709" field="service_qty" dataType="Float" parameterType="Control" parameterSource="service_qty"/>
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
				<SQLParameter id="738" variable="t_cust_acc_employee_id" dataType="Float" parameterType="Control" parameterSource="t_cust_acc_employee_id" defaultValue="0"/>
				<SQLParameter id="739" variable="description" dataType="Text" parameterType="Control" parameterSource="description"/>
				<SQLParameter id="741" variable="updated_by" dataType="Text" parameterType="Expression" parameterSource="CCGetUserLogin()"/>
				<SQLParameter id="745" variable="employee_qty" dataType="Float" parameterType="Control" parameterSource="employee_qty" defaultValue="0"/>
				<SQLParameter id="748" variable="p_job_position_id" dataType="Float" parameterType="Control" parameterSource="p_job_position_id" defaultValue="0"/>
				<SQLParameter id="749" variable="employee_salery" dataType="Float" parameterType="Control" parameterSource="employee_salery" defaultValue="0"/>
				<SQLParameter id="762" variable="valid_from" parameterType="Control" dataType="Text" parameterSource="valid_from"/>
<SQLParameter id="763" variable="valid_to" parameterType="Control" dataType="Text" parameterSource="valid_to"/>
</USQLParameters>
			<UConditions>
			</UConditions>
			<UFormElements>
				<CustomParameter id="723" field="t_vat_reg_dtl_hotel_id" dataType="Float" parameterType="Control" parameterSource="t_vat_reg_dtl_hotel_id"/>
				<CustomParameter id="724" field="description" dataType="Text" parameterType="Control" parameterSource="description"/>
				<CustomParameter id="725" field="created_by" dataType="Text" parameterType="Control" parameterSource="created_by"/>
				<CustomParameter id="726" field="updated_by" dataType="Text" parameterType="Control" parameterSource="updated_by"/>
				<CustomParameter id="727" field="creation_date" dataType="Text" parameterType="Control" parameterSource="creation_date" format="dd-mmm-yyyy"/>
				<CustomParameter id="728" field="updated_date" dataType="Text" parameterType="Control" parameterSource="updated_date" format="dd-mmm-yyyy"/>
				<CustomParameter id="729" field="t_vat_registration_id" dataType="Float" parameterType="Control" parameterSource="t_vat_registration_id"/>
				<CustomParameter id="732" field="p_room_type_id" dataType="Float" parameterType="Control" parameterSource="p_room_type_id"/>
				<CustomParameter id="733" field="services" dataType="Text" parameterType="Control" parameterSource="services"/>
				<CustomParameter id="734" field="p_hotel_grade_id" dataType="Float" parameterType="Control" parameterSource="p_hotel_grade_id"/>
				<CustomParameter id="735" field="room_qty" dataType="Float" parameterType="Control" parameterSource="room_qty"/>
				<CustomParameter id="736" field="service_charge" dataType="Float" parameterType="Control" parameterSource="service_charge"/>
				<CustomParameter id="737" field="service_qty" dataType="Float" parameterType="Control" parameterSource="service_qty"/>
			</UFormElements>
			<DSPParameters/>
			<DSQLParameters>
				<SQLParameter id="751" variable="t_vat_reg_employee_id" parameterType="Control" defaultValue="0" dataType="Float" parameterSource="t_vat_reg_employee_id"/>
			</DSQLParameters>
			<DConditions>
			</DConditions>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Record>
	</Components>
	<CodeFiles>
		<CodeFile id="Events" language="PHPTemplates" name="data_potensi_pegawai_edit_events.php" forShow="False" comment="//" codePage="windows-1252"/>
		<CodeFile id="Code" language="PHPTemplates" name="data_potensi_pegawai_edit.php" forShow="True" url="data_potensi_pegawai_edit.php" comment="//" codePage="windows-1252"/>
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
