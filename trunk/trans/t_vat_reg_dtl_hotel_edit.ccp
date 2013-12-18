<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\trans" secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="RWNet" wizardThemeVersion="3.0" needGeneration="0" pasteActions="pasteActions">
	<Components>
		<Record id="94" sourceType="Table" urlType="Relative" secured="False" allowInsert="True" allowUpdate="True" allowDelete="True" validateData="True" preserveParameters="GET" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" connection="ConnSIKP" name="t_vat_reg_dtl_hotelForm" errorSummator="Error" wizardCaption="Add/Edit V P App User " wizardFormMethod="post" PathID="t_vat_reg_dtl_hotelForm" activeCollection="USQLParameters" pasteAsReplace="pasteAsReplace" pasteActions="pasteActions" customDeleteType="SQL" parameterTypeListName="ParameterTypeList" customUpdateType="SQL" customInsertType="SQL" customInsert="INSERT INTO t_vat_reg_dtl_hotel(t_vat_reg_dtl_hotel_id, description, created_by, updated_by, creation_date, updated_date, t_vat_registration_id, p_room_type_id, room_qty, service_charge_wd, service_charge_we, service_qty) 
VALUES(generate_id('sikp','t_vat_reg_dtl_hotel','t_vat_reg_dtl_hotel_id'), '{description}', '{created_by}', '{updated_by}', sysdate, sysdate, {t_vat_registration_id}, {p_room_type_id}, {room_qty}, {service_charge_wd}, {service_charge_we}, {service_qty})" customUpdate="UPDATE t_vat_reg_dtl_hotel SET 
description='{description}', 
updated_by='{updated_by}', 
updated_date=sysdate, 
p_room_type_id={p_room_type_id}, 
room_qty={room_qty}, 
service_charge_wd={service_charge_wd},
service_charge_we={service_charge_we}, 
service_qty={service_qty}
WHERE t_vat_reg_dtl_hotel_id={t_vat_reg_dtl_hotel_id}" customDelete="DELETE FROM t_vat_reg_dtl_hotel
WHERE t_vat_reg_dtl_hotel_id = {t_vat_reg_dtl_hotel_id}" dataSource="v_vat_reg_dtl_hotel">
			<Components>
				<Button id="95" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Insert" operation="Insert" wizardCaption="Add" PathID="t_vat_reg_dtl_hotelFormButton_Insert" removeParameters="FLAG">
					<Components/>
					<Events>
					</Events>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="96" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Update" operation="Update" wizardCaption="Submit" PathID="t_vat_reg_dtl_hotelFormButton_Update" removeParameters="FLAG">
					<Components/>
					<Events>
					</Events>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="97" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Delete" operation="Delete" wizardCaption="Delete" PathID="t_vat_reg_dtl_hotelFormButton_Delete" removeParameters="FLAG;t_vat_reg_dtl_hotel_id">
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
				<Button id="99" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Cancel" operation="Cancel" wizardCaption="Cancel" PathID="t_vat_reg_dtl_hotelFormButton_Cancel" removeParameters="FLAG;t_vat_reg_dtl_hotel_id">
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
				<Hidden id="101" fieldSourceType="DBColumn" dataType="Float" name="t_vat_reg_dtl_hotel_id" fieldSource="t_vat_reg_dtl_hotel_id" caption="Id" wizardCaption="P App User Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_reg_dtl_hotelFormt_vat_reg_dtl_hotel_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<TextBox id="114" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="description" fieldSource="description" required="False" caption="Description" wizardCaption="Description" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_reg_dtl_hotelFormdescription">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="124" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="created_by" fieldSource="created_by" required="False" caption="Created By" wizardCaption="Created By" wizardSize="16" wizardMaxLength="16" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_reg_dtl_hotelFormcreated_by" defaultValue="CCGetUserLogin()">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="127" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="updated_by" fieldSource="updated_by" required="False" caption="Updated By" wizardCaption="Updated By" wizardSize="16" wizardMaxLength="16" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_reg_dtl_hotelFormupdated_by" defaultValue="CCGetUserLogin()">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="122" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="creation_date" fieldSource="creation_date" required="False" caption="Creation Date" wizardCaption="Creation Date" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_reg_dtl_hotelFormcreation_date" format="dd-mmm-yyyy" defaultValue="date(&quot;d-M-Y&quot;)">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="125" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="updated_date" fieldSource="updated_date" required="False" caption="Updated Date" wizardCaption="Updated Date" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_reg_dtl_hotelFormupdated_date" defaultValue="date(&quot;d-M-Y&quot;)" format="dd-mmm-yyyy">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<ListBox id="671" visible="Yes" fieldSourceType="DBColumn" sourceType="SQL" dataType="Float" returnValueType="Number" name="p_room_type_id" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" wizardEmptyCaption="Select Value" PathID="t_vat_reg_dtl_hotelFormp_room_type_id" connection="ConnSIKP" dataSource="SELECT p_room_type_id, code 
FROM p_room_type " activeCollection="TableParameters" boundColumn="p_room_type_id" textColumn="code" required="True" fieldSource="p_room_type_id" caption="Golongan Kamar">
					<Components/>
					<Events/>
					<TableParameters/>
					<SPParameters/>
					<SQLParameters/>
					<JoinTables>
						<JoinTable id="689" tableName="p_room_type" posLeft="10" posTop="10" posWidth="125" posHeight="168"/>
					</JoinTables>
					<JoinLinks/>
					<Fields>
						<Field id="690" tableName="p_room_type" fieldName="p_room_type_id"/>
						<Field id="691" tableName="p_room_type" fieldName="code"/>
					</Fields>
					<Attributes/>
					<Features/>
				</ListBox>
				<Hidden id="677" fieldSourceType="DBColumn" dataType="Text" html="False" name="rqst_type_code" wizardCaption="Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="t_vat_reg_dtl_hotelFormrqst_type_code">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="752" fieldSourceType="DBColumn" dataType="Float" name="p_rqst_type_id" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_vat_reg_dtl_hotelFormp_rqst_type_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="753" fieldSourceType="DBColumn" dataType="Float" name="t_customer_order_id" wizardCaption="P App User Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_reg_dtl_hotelFormt_customer_order_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<TextBox id="757" visible="Yes" fieldSourceType="DBColumn" dataType="Float" name="service_charge_wd" fieldSource="service_charge_wd" required="True" caption="Tarif Kamar" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_reg_dtl_hotelFormservice_charge_wd" format="0">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
<TextBox id="758" visible="Yes" fieldSourceType="DBColumn" dataType="Float" name="service_charge_we" fieldSource="service_charge_we" required="True" caption="Tarif Kamar" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_reg_dtl_hotelFormservice_charge_we" format="0">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
<TextBox id="694" visible="Yes" fieldSourceType="DBColumn" dataType="Float" name="service_qty" fieldSource="service_qty" required="True" caption="Frekwensi Penggunaan Layanan" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_reg_dtl_hotelFormservice_qty" format="0">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
<TextBox id="692" visible="Yes" fieldSourceType="DBColumn" dataType="Float" name="room_qty" fieldSource="room_qty" required="True" caption="Jumlah Kamr" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_reg_dtl_hotelFormroom_qty" format="0">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
<Hidden id="619" fieldSourceType="DBColumn" dataType="Float" name="t_vat_registration_id" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_vat_reg_dtl_hotelFormt_vat_registration_id" fieldSource="t_vat_registration_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
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
				<Event name="AfterExecuteDelete" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="756"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
				<TableParameter id="679" conditionType="Parameter" useIsNull="False" field="t_vat_reg_dtl_hotel_id" dataType="Float" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="t_vat_reg_dtl_hotel_id"/>
			</TableParameters>
			<SPParameters/>
			<SQLParameters>
			</SQLParameters>
			<JoinTables>
				<JoinTable id="678" tableName="v_vat_reg_dtl_hotel" posLeft="10" posTop="10" posWidth="160" posHeight="180"/>
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
				<SQLParameter id="716" variable="t_vat_registration_id" dataType="Float" parameterType="Control" parameterSource="t_vat_registration_id"/>
				<SQLParameter id="717" variable="p_room_type_id" dataType="Float" parameterType="Control" parameterSource="p_room_type_id"/>
				<SQLParameter id="720" variable="room_qty" dataType="Float" parameterType="Control" parameterSource="room_qty"/>
				<SQLParameter id="721" variable="service_charge_wd" dataType="Float" parameterType="Control" parameterSource="service_charge_wd" defaultValue="0"/>
				<SQLParameter id="722" variable="service_qty" dataType="Float" parameterType="Control" parameterSource="service_qty"/>
				<SQLParameter id="759" variable="service_charge_we" parameterType="Control" defaultValue="0" dataType="Float" parameterSource="service_charge_we"/>
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
				<SQLParameter id="738" variable="t_vat_reg_dtl_hotel_id" dataType="Float" parameterType="Control" parameterSource="t_vat_reg_dtl_hotel_id"/>
				<SQLParameter id="739" variable="description" dataType="Text" parameterType="Control" parameterSource="description"/>
				<SQLParameter id="741" variable="updated_by" dataType="Text" parameterType="Expression" parameterSource="CCGetUserLogin()"/>
				<SQLParameter id="744" variable="t_vat_registration_id" dataType="Float" parameterType="Control" parameterSource="t_vat_registration_id"/>
				<SQLParameter id="745" variable="p_room_type_id" dataType="Float" parameterType="Control" parameterSource="p_room_type_id"/>
				<SQLParameter id="748" variable="room_qty" dataType="Float" parameterType="Control" parameterSource="room_qty"/>
				<SQLParameter id="749" variable="service_charge_wd" dataType="Float" parameterType="Control" parameterSource="service_charge_wd" defaultValue="0"/>
				<SQLParameter id="750" variable="service_qty" dataType="Float" parameterType="Control" parameterSource="service_qty"/>
				<SQLParameter id="760" variable="service_charge_we" parameterType="Control" defaultValue="0" dataType="Float" parameterSource="service_charge_we"/>
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
				<SQLParameter id="751" variable="t_vat_reg_dtl_hotel_id" parameterType="Control" defaultValue="0" dataType="Float" parameterSource="t_vat_reg_dtl_hotel_id"/>
			</DSQLParameters>
			<DConditions>
			</DConditions>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Record>
	</Components>
	<CodeFiles>
		<CodeFile id="Events" language="PHPTemplates" name="t_vat_reg_dtl_hotel_edit_events.php" forShow="False" comment="//" codePage="windows-1252"/>
		<CodeFile id="Code" language="PHPTemplates" name="t_vat_reg_dtl_hotel_edit.php" forShow="True" url="t_vat_reg_dtl_hotel_edit.php" comment="//" codePage="windows-1252"/>
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
