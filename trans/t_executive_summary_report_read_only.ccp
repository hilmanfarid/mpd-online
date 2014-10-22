<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\trans" secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="None" wizardThemeVersion="3.0" pasteActions="pasteActions" needGeneration="0">
	<Components>
		<Record id="2" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="None" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="t_executive_sumary_filter" wizardCaption="Search T Payment Receipt " wizardOrientation="Vertical" wizardFormMethod="post" returnPage="t_executive_summary_report_read_only.ccp" PathID="t_executive_sumary_filter" pasteActions="pasteActions">
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
				<Hidden id="23" fieldSourceType="DBColumn" dataType="Text" name="p_vat_type_dtl_id" PathID="t_executive_sumary_filterp_vat_type_dtl_id" fieldSource="p_vat_type_dtl_id" defaultValue="null">
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
								<Action actionName="Custom Code" actionCategory="General" id="109"/>
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
				<Hidden id="105" fieldSourceType="DBColumn" dataType="Text" name="p_finance_period_id" PathID="t_executive_sumary_filterp_finance_period_id" fieldSource="p_finance_period_id" defaultValue="null">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<ListBox id="106" visible="Yes" fieldSourceType="DBColumn" sourceType="ListOfValues" dataType="Text" returnValueType="Number" name="ListBox1" wizardEmptyCaption="Select Value" PathID="t_executive_sumary_filterListBox1" connection="ConnSIKP" _valueOfList="3" _nameOfList="Per Semester" dataSource="1;Per Bulan;2;Per Triwulan;3;Per Semester" fieldSource="period_type" defaultValue="null">
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
				<ListBox id="107" visible="Yes" fieldSourceType="DBColumn" sourceType="ListOfValues" dataType="Text" returnValueType="Number" name="ListBox2" wizardEmptyCaption="Select Value" PathID="t_executive_sumary_filterListBox2" connection="ConnSIKP" dataSource="1;I;2;II;3;III;4;IV" _valueOfList="4" _nameOfList="IV" defaultValue="null">
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
				<ListBox id="108" visible="Yes" fieldSourceType="DBColumn" sourceType="ListOfValues" dataType="Text" returnValueType="Number" name="ListBox3" wizardEmptyCaption="Select Value" PathID="t_executive_sumary_filterListBox3" connection="ConnSIKP" dataSource="1;I;2;II" _valueOfList="4" _nameOfList="IV" defaultValue="null">
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
		<Record id="25" sourceType="SQL" urlType="Relative" secured="False" allowInsert="True" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="GET" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" connection="ConnSIKP" name="t_executive_summary_form" errorSummator="Error" wizardCaption="Add/Edit P App Role " wizardFormMethod="post" PathID="t_executive_summary_form" customDeleteType="SQL" activeCollection="IFormElements" customUpdateType="SQL" parameterTypeListName="ParameterTypeList" pasteAsReplace="pasteAsReplace" pasteActions="pasteActions" customInsertType="Table" customUpdate="UPDATE t_cust_acc_dtl_trans SET
service_desc = '{service_desc}',
description = '{description}',
bill_no = '{bill_no}',
service_charge = {service_charge},
vat_charge = {vat_charge},
updated_date = sysdate,
updated_by = '{UserName}'
WHERE t_cust_acc_dtl_trans_id = {t_cust_acc_dtl_trans_id}" customDelete="DELETE FROM t_cust_acc_dtl_trans
WHERE  t_cust_acc_dtl_trans_id = {t_cust_acc_dtl_trans_id}" dataSource="select * from t_executive_summary
limit 1" customInsert="t_executive_summary" activeTableType="t_executive_summary">
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
			</Events>
			<TableParameters>
				<TableParameter id="46" conditionType="Parameter" useIsNull="False" field="t_cust_acc_dtl_trans_id" dataType="Float" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="t_cust_acc_dtl_trans_id"/>
			</TableParameters>
			<SPParameters/>
			<SQLParameters>
				<SQLParameter id="47" parameterType="URL" variable="t_cust_acc_dtl_trans_id" dataType="Float" parameterSource="t_cust_acc_dtl_trans_id"/>
			</SQLParameters>
			<JoinTables>
			</JoinTables>
			<JoinLinks/>
			<Fields>
			</Fields>
			<ISPParameters/>
			<ISQLParameters>
				<SQLParameter id="74" variable="service_desc" parameterType="Control" dataType="Text" parameterSource="service_desc"/>
				<SQLParameter id="75" variable="description" parameterType="Control" dataType="Text" parameterSource="description"/>
				<SQLParameter id="76" variable="t_cust_account_id" parameterType="Control" defaultValue="0" dataType="Float" parameterSource="t_cust_account_id"/>
				<SQLParameter id="77" variable="bill_no" parameterType="Control" dataType="Text" parameterSource="bill_no"/>
				<SQLParameter id="78" variable="service_charge" parameterType="Control" defaultValue="0" dataType="Float" parameterSource="service_charge"/>
				<SQLParameter id="79" variable="vat_charge" parameterType="Control" defaultValue="0" dataType="Float" parameterSource="vat_charge"/>
				<SQLParameter id="80" variable="UserName" parameterType="Expression" dataType="Text" parameterSource="CCGetUserLogin()"/>
				<SQLParameter id="81" variable="trans_date" parameterType="Control" dataType="Text" parameterSource="trans_date"/>
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
		<CodeFile id="Events" language="PHPTemplates" name="t_executive_summary_report_read_only_events.php" forShow="False" comment="//" codePage="windows-1252"/>
		<CodeFile id="Code" language="PHPTemplates" name="t_executive_summary_report_read_only.php" forShow="True" url="t_executive_summary_report_read_only.php" comment="//" codePage="windows-1252"/>
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
