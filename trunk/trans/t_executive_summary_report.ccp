<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\trans" secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="None" wizardThemeVersion="3.0" pasteActions="pasteActions" needGeneration="0">
	<Components>
		<Record id="2" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="None" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="t_executive_sumary_filter" wizardCaption="Search T Payment Receipt " wizardOrientation="Vertical" wizardFormMethod="post" returnPage="t_executive_summary_report.ccp" PathID="t_executive_sumary_filter" pasteActions="pasteActions">
			<Components>
				<TextBox id="11" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="year_code" wizardCaption="Keyword" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" PathID="t_executive_sumary_filteryear_code" required="True" caption="Periode Tahun">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Hidden id="13" fieldSourceType="DBColumn" dataType="Float" name="p_year_period_id" PathID="t_executive_sumary_filterp_year_period_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<TextBox id="18" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="vat_code" wizardCaption="Keyword" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" PathID="t_executive_sumary_filtervat_code" required="True" caption="Ayat Pajak">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Hidden id="20" fieldSourceType="DBColumn" dataType="Text" name="p_vat_type_id" PathID="t_executive_sumary_filterp_vat_type_id" fieldSource="p_vat_type_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<TextBox id="21" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="vat_code_dtl" wizardCaption="Keyword" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" PathID="t_executive_sumary_filtervat_code_dtl" required="True" caption="Ayat Pajak" fieldSource="vat_code_dtl">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Hidden id="23" fieldSourceType="DBColumn" dataType="Text" name="p_vat_type_dtl_id" PathID="t_executive_sumary_filterp_vat_type_dtl_id" fieldSource="p_vat_type_dtl_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Button id="24" urlType="Relative" enableValidation="True" isDefault="False" name="Button2" PathID="t_executive_sumary_filterButton2">
					<Components/>
					<Events>
						<Event name="OnClick" type="Client">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="109" eventType="Client"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Button>
				<TextBox id="104" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="periode_code" wizardCaption="Keyword" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" PathID="t_executive_sumary_filterperiode_code" required="True" caption="Bulan" fieldSource="periode_code">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Hidden id="105" fieldSourceType="DBColumn" dataType="Text" name="p_finance_period_id" PathID="t_executive_sumary_filterp_finance_period_id" fieldSource="p_finance_period_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<ListBox id="106" visible="Yes" fieldSourceType="DBColumn" sourceType="ListOfValues" dataType="Text" returnValueType="Number" name="ListBox1" wizardEmptyCaption="Select Value" PathID="t_executive_sumary_filterListBox1" connection="ConnSIKP" _valueOfList="3" _nameOfList="Per Semester" dataSource="1;Per Bulan;2;Per Triwulan;3;Per Semester" fieldSource="period_type">
					<Components/>
					<Events/>
					<TableParameters/>
					<SPParameters/>
					<SQLParameters/>
					<JoinTables/>
					<JoinLinks/>
					<Fields/>
					<Attributes/>
					<Features/>
				</ListBox>
				<ListBox id="107" visible="Yes" fieldSourceType="DBColumn" sourceType="ListOfValues" dataType="Text" returnValueType="Number" name="ListBox2" wizardEmptyCaption="Select Value" PathID="t_executive_sumary_filterListBox2" connection="ConnSIKP" dataSource="1;I;2;II;3;III;4;IV" _valueOfList="4" _nameOfList="IV">
					<Components/>
					<Events/>
					<TableParameters/>
					<SPParameters/>
					<SQLParameters/>
					<JoinTables/>
					<JoinLinks/>
					<Fields/>
					<Attributes/>
					<Features/>
				</ListBox>
				<ListBox id="108" visible="Yes" fieldSourceType="DBColumn" sourceType="ListOfValues" dataType="Text" returnValueType="Number" name="ListBox3" wizardEmptyCaption="Select Value" PathID="t_executive_sumary_filterListBox3" connection="ConnSIKP" dataSource="1;I;2;II" _valueOfList="4" _nameOfList="IV">
					<Components/>
					<Events/>
					<TableParameters/>
					<SPParameters/>
					<SQLParameters/>
					<JoinTables/>
					<JoinLinks/>
					<Fields/>
					<Attributes/>
					<Features/>
				</ListBox>
			</Components>
			<Events/>
			<TableParameters/>
			<SPParameters/>
			<SQLParameters/>
			<JoinTables/>
			<JoinLinks/>
			<Fields/>
			<ISPParameters/>
			<ISQLParameters/>
			<IFormElements/>
			<USPParameters/>
			<USQLParameters/>
			<UConditions/>
			<UFormElements/>
			<DSPParameters/>
			<DSQLParameters/>
			<DConditions/>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Record>
		<Record id="25" sourceType="SQL" urlType="Relative" secured="False" allowInsert="True" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="GET" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" connection="ConnSIKP" name="t_executive_summary_form" errorSummator="Error" wizardCaption="Add/Edit P App Role " wizardFormMethod="post" PathID="t_executive_summary_form" customDeleteType="SQL" activeCollection="ISQLParameters" customUpdateType="SQL" parameterTypeListName="ParameterTypeList" pasteAsReplace="pasteAsReplace" pasteActions="pasteActions" customInsertType="SQL" customUpdate="UPDATE t_cust_acc_dtl_trans SET
service_desc = '{service_desc}',
description = '{description}',
bill_no = '{bill_no}',
service_charge = {service_charge},
vat_charge = {vat_charge},
updated_date = sysdate,
updated_by = '{UserName}'
WHERE t_cust_acc_dtl_trans_id = {t_cust_acc_dtl_trans_id}" customDelete="DELETE FROM t_cust_acc_dtl_trans
WHERE  t_cust_acc_dtl_trans_id = {t_cust_acc_dtl_trans_id}" dataSource="SELECT t_cust_acc_dtl_trans_id, t_cust_account_id, to_char(trans_date,'YYYY-MM-DD')as trans_date, bill_no, p_entertaintment_type_id, p_hotel_grade_id, p_room_type_id,
p_parking_classification_id, updated_by, to_char(updated_date,'DD-MON-YYYY')as updated_date, created_by, to_char(creation_date,'DD-MON-YYYY')as creation_date, description, portion_person, f_and_b,
booking_hour, clerk_qty, room_qty, seat_qty, vat_charge, service_charge, service_desc, p_rest_service_type_id, power_capacity,
p_pwr_classification_id 
FROM t_cust_acc_dtl_trans
WHERE t_cust_acc_dtl_trans_id = {t_cust_acc_dtl_trans_id} " customInsert="SELECT
	*
FROM
	f_insert_executive_summary (
		16,
		'{user_id}' ,{p_year_period_id},{p_vat_type_id}, {period_type}, {p_finance_period_id},{triwulan},{semester}, '{penjelasan}',
		'{permasalahan}',
		'{kesimpulan}',
		'{saran}'
	)" activeTableType="t_executive_summary">
			<Components>
				<Button id="26" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Insert" operation="Insert" wizardCaption="Add" PathID="t_executive_summary_formButton_Insert" removeParameters="FLAG">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<TextArea id="32" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="penjelasan" required="True" caption="No Faktur" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_executive_summary_formpenjelasan" fieldSource="penjelasan">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextArea>
				<TextArea id="38" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="permasalahan" fieldSource="permasalahan" required="True" caption="Nilai Transaksi" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_executive_summary_formpermasalahan" format="0">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextArea>
				<TextArea id="110" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="kesimpulan" fieldSource="kesimpulan" required="True" caption="Nilai Transaksi" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_executive_summary_formkesimpulan" format="0">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextArea>
				<TextArea id="111" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="saran" fieldSource="saran" required="True" caption="Nilai Transaksi" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_executive_summary_formsaran" format="0">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextArea>
				<Hidden id="112" fieldSourceType="DBColumn" dataType="Text" name="p_vat_type_id" PathID="t_executive_summary_formp_vat_type_id" fieldSource="p_vat_type_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="113" fieldSourceType="DBColumn" dataType="Float" name="p_year_period_id" PathID="t_executive_summary_formp_year_period_id" fieldSource="p_year_period_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="114" fieldSourceType="DBColumn" dataType="Text" name="p_finance_period_id" PathID="t_executive_summary_formp_finance_period_id" fieldSource="p_finance_period_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="115" fieldSourceType="DBColumn" dataType="Text" name="period_type" PathID="t_executive_summary_formperiod_type" fieldSource="period_type">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="116" fieldSourceType="DBColumn" dataType="Text" name="triwulan" PathID="t_executive_summary_formtriwulan" fieldSource="triwulan">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="117" fieldSourceType="DBColumn" dataType="Text" name="semester" PathID="t_executive_summary_formsemester" fieldSource="semester">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
			</Components>
			<Events>
				<Event name="BeforeSelect" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="45"/>
					</Actions>
				</Event>
				<Event name="AfterInsert" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="132"/>
					</Actions>
				</Event>
				<Event name="BeforeInsert" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="133"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
				<TableParameter id="46" conditionType="Parameter" useIsNull="False" field="t_cust_acc_dtl_trans_id" dataType="Float" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="t_cust_acc_dtl_trans_id"/>
			</TableParameters>
			<SPParameters/>
			<SQLParameters>
				<SQLParameter id="47" parameterType="URL" variable="t_cust_acc_dtl_trans_id" dataType="Float" parameterSource="t_cust_acc_dtl_trans_id"/>
			</SQLParameters>
			<JoinTables>
				<JoinTable id="48" tableName="t_cust_acc_dtl_trans" posLeft="10" posTop="10" posWidth="160" posHeight="180"/>
			</JoinTables>
			<JoinLinks/>
			<Fields>
				<Field id="49" tableName="t_cust_acc_dtl_trans" fieldName="t_cust_acc_dtl_trans_id"/>
				<Field id="50" tableName="t_cust_acc_dtl_trans" fieldName="t_cust_account_id"/>
				<Field id="51" tableName="t_cust_acc_dtl_trans" fieldName="trans_date"/>
				<Field id="52" tableName="t_cust_acc_dtl_trans" fieldName="bill_no"/>
				<Field id="53" tableName="t_cust_acc_dtl_trans" fieldName="p_entertaintment_type_id"/>
				<Field id="54" tableName="t_cust_acc_dtl_trans" fieldName="p_hotel_grade_id"/>
				<Field id="55" tableName="t_cust_acc_dtl_trans" fieldName="p_room_type_id"/>
				<Field id="56" tableName="t_cust_acc_dtl_trans" fieldName="p_parking_classification_id"/>
				<Field id="57" tableName="t_cust_acc_dtl_trans" fieldName="updated_by"/>
				<Field id="58" tableName="t_cust_acc_dtl_trans" fieldName="updated_date"/>
				<Field id="59" tableName="t_cust_acc_dtl_trans" fieldName="created_by"/>
				<Field id="60" tableName="t_cust_acc_dtl_trans" fieldName="creation_date"/>
				<Field id="61" tableName="t_cust_acc_dtl_trans" fieldName="description"/>
				<Field id="62" tableName="t_cust_acc_dtl_trans" fieldName="portion_person"/>
				<Field id="63" tableName="t_cust_acc_dtl_trans" fieldName="f_and_b"/>
				<Field id="64" tableName="t_cust_acc_dtl_trans" fieldName="booking_hour"/>
				<Field id="65" tableName="t_cust_acc_dtl_trans" fieldName="clerk_qty"/>
				<Field id="66" tableName="t_cust_acc_dtl_trans" fieldName="room_qty"/>
				<Field id="67" tableName="t_cust_acc_dtl_trans" fieldName="seat_qty"/>
				<Field id="68" tableName="t_cust_acc_dtl_trans" fieldName="vat_charge"/>
				<Field id="69" tableName="t_cust_acc_dtl_trans" fieldName="service_charge"/>
				<Field id="70" tableName="t_cust_acc_dtl_trans" fieldName="service_desc"/>
				<Field id="71" tableName="t_cust_acc_dtl_trans" fieldName="p_rest_service_type_id"/>
				<Field id="72" tableName="t_cust_acc_dtl_trans" fieldName="power_capacity"/>
				<Field id="73" tableName="t_cust_acc_dtl_trans" fieldName="p_pwr_classification_id"/>
			</Fields>
			<ISPParameters>
				<SPParameter id="Key135" parameterName="i_status_date" parameterSource="i_status_date" dataType="DateTime" parameterType="URL" dataSize="26" direction="Input" scale="0" precision="6"/>
				<SPParameter id="Key136" parameterName="o_result_code" parameterSource="o_result_code" dataType="Numeric" parameterType="URL" dataSize="0" direction="Output" scale="10" precision="6"/>
				<SPParameter id="Key137" parameterName="o_result_msg" parameterSource="o_result_msg" dataType="Char" parameterType="URL" dataSize="255" direction="Output" scale="10" precision="6"/>
			</ISPParameters>
			<ISQLParameters>
				<SQLParameter id="134" variable="penjelasan" dataType="Text" parameterType="Control" parameterSource="penjelasan"/>
				<SQLParameter id="135" variable="permasalahan" dataType="Text" parameterType="Control" parameterSource="permasalahan" format="0"/>
				<SQLParameter id="136" variable="kesimpulan" dataType="Text" parameterType="Control" parameterSource="kesimpulan" format="0"/>
				<SQLParameter id="137" variable="saran" dataType="Text" parameterType="Control" parameterSource="saran" format="0"/>
				<SQLParameter id="138" variable="p_vat_type_id" dataType="Text" parameterType="Control" parameterSource="p_vat_type_id"/>
				<SQLParameter id="139" variable="p_finance_period_id" dataType="Float" parameterType="Control" parameterSource="p_finance_period_id" defaultValue="0"/>
				<SQLParameter id="140" variable="period_type" dataType="Text" parameterType="Control" parameterSource="period_type"/>
				<SQLParameter id="141" variable="triwulan" dataType="Float" parameterType="Control" parameterSource="triwulan" defaultValue="0"/>
				<SQLParameter id="142" variable="semester" dataType="Float" parameterType="Control" parameterSource="semester" defaultValue="0"/>
				<SQLParameter id="145" variable="p_year_period_id" dataType="Float" parameterType="Control" parameterSource="p_year_period_id"/>
				<SQLParameter id="146" variable="user_id" parameterType="Session" dataType="Text" parameterSource="UserLogin"/>
			</ISQLParameters>
			<IFormElements>
				<CustomParameter id="118" field="penjelasan" dataType="Text" parameterType="Control" parameterSource="penjelasan" omitIfEmpty="True"/>
				<CustomParameter id="119" field="permasalahan" dataType="Text" parameterType="Control" parameterSource="permasalahan" format="0" omitIfEmpty="True"/>
				<CustomParameter id="120" field="kesimpulan" dataType="Text" parameterType="Control" parameterSource="kesimpulan" format="0" omitIfEmpty="True"/>
				<CustomParameter id="121" field="saran" dataType="Text" parameterType="Control" parameterSource="saran" format="0" omitIfEmpty="True"/>
				<CustomParameter id="122" field="p_vat_type_id" dataType="Text" parameterType="Control" parameterSource="p_vat_type_id" omitIfEmpty="True"/>
				<CustomParameter id="123" field="p_finance_period_id" dataType="Text" parameterType="Control" parameterSource="p_finance_period_id" omitIfEmpty="True"/>
				<CustomParameter id="124" field="period_type" dataType="Text" parameterType="Control" parameterSource="period_type" omitIfEmpty="True"/>
				<CustomParameter id="125" field="triwulan" dataType="Text" parameterType="Control" parameterSource="triwulan" omitIfEmpty="True"/>
				<CustomParameter id="126" field="semester" dataType="Text" parameterType="Control" parameterSource="semester" omitIfEmpty="True"/>
				<CustomParameter id="128" field="created_by" dataType="Text" parameterType="Session" format="UserLogin" omitIfEmpty="True" parameterSource="created_by"/>
				<CustomParameter id="130" field="updated_by" parameterType="Session" omitIfEmpty="True" parameterSource="updated_by" dataType="Text"/>
				<CustomParameter id="131" field="p_year_period_id" dataType="Float" parameterType="Control" omitIfEmpty="True" parameterSource="p_year_period_id"/>
			</IFormElements>
			<USPParameters/>
			<USQLParameters>
				<SQLParameter id="89" variable="service_desc" parameterType="Control" dataType="Text" parameterSource="service_desc"/>
				<SQLParameter id="90" variable="description" parameterType="Control" dataType="Text" parameterSource="description"/>
				<SQLParameter id="91" variable="bill_no" parameterType="Control" dataType="Text" parameterSource="bill_no"/>
				<SQLParameter id="92" variable="service_charge" parameterType="Control" defaultValue="0" dataType="Float" parameterSource="service_charge"/>
				<SQLParameter id="93" variable="vat_charge" parameterType="Control" defaultValue="0" dataType="Float" parameterSource="vat_charge"/>
				<SQLParameter id="94" variable="UserName" parameterType="Expression" dataType="Text" parameterSource="CCGetUserLogin()"/>
				<SQLParameter id="95" variable="t_cust_acc_dtl_trans_id" parameterType="Control" defaultValue="0" dataType="Float" parameterSource="t_cust_acc_dtl_trans_id"/>
			</USQLParameters>
			<UConditions>
			</UConditions>
			<UFormElements>
				<CustomParameter id="96" field="p_vat_type_id" dataType="Float" parameterType="Control" parameterSource="p_vat_type_id"/>
				<CustomParameter id="97" field="vat_code" dataType="Text" parameterType="Control" parameterSource="vat_code"/>
				<CustomParameter id="98" field="description" dataType="Text" parameterType="Control" parameterSource="description"/>
				<CustomParameter id="99" field="creation_date" dataType="Text" parameterType="Control" parameterSource="creation_date" format="dd-mmm-yyyy"/>
				<CustomParameter id="100" field="created_by" dataType="Text" parameterType="Control" parameterSource="created_by"/>
				<CustomParameter id="101" field="updated_date" dataType="Text" parameterType="Control" parameterSource="updated_date" format="dd-mmm-yyyy"/>
				<CustomParameter id="102" field="updated_by" dataType="Text" parameterType="Control" parameterSource="updated_by"/>
			</UFormElements>
			<DSPParameters/>
			<DSQLParameters>
				<SQLParameter id="103" variable="t_cust_acc_dtl_trans_id" parameterType="Control" dataType="Float" parameterSource="t_cust_acc_dtl_trans_id" defaultValue="0"/>
			</DSQLParameters>
			<DConditions>
			</DConditions>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Record>
	</Components>
	<CodeFiles>
		<CodeFile id="Events" language="PHPTemplates" name="t_executive_summary_report_events.php" forShow="False" comment="//" codePage="windows-1252"/>
		<CodeFile id="Code" language="PHPTemplates" name="t_executive_summary_report.php" forShow="True" url="t_executive_summary_report.php" comment="//" codePage="windows-1252"/>
	</CodeFiles>
	<SecurityGroups/>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events>
		<Event name="BeforeShow" type="Server">
			<Actions>
				<Action actionName="Custom Code" actionCategory="General" id="10"/>
			</Actions>
		</Event>
	</Events>
</Page>
