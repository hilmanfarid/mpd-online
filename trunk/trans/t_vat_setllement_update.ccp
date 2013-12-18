<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\trans" secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="CoffeeBreak" wizardThemeVersion="3.0" needGeneration="0" pasteActions="pasteActions">
	<Components>
		<Record id="23" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="True" allowDelete="True" validateData="True" preserveParameters="GET" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" connection="ConnSIKP" name="t_vat_setllementForm" errorSummator="Error" wizardCaption="Add/Edit P App Role " wizardFormMethod="post" PathID="t_vat_setllementForm" activeCollection="USPParameters" parameterTypeListName="ParameterTypeList" pasteAsReplace="pasteAsReplace" pasteActions="pasteActions" dataSource="v_vat_setllement" customUpdateType="Procedure" customDeleteType="SQL" customDelete="select o_result_code, o_result_msg from f_first_submit_engine(501,{t_customer_order_id},'{UserName}')" customUpdate="f_crud_setllement_update">
			<Components>
				<Button id="24" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Insert" wizardCaption="Add" PathID="t_vat_setllementFormButton_Insert" removeParameters="FLAG" operation="Insert">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="25" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Update" operation="Update" wizardCaption="Submit" PathID="t_vat_setllementFormButton_Update" removeParameters="FLAG">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="26" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Delete" operation="Delete" wizardCaption="Delete" PathID="t_vat_setllementFormButton_Delete" removeParameters="FLAG;t_vat_setllement_id">
					<Components/>
					<Events>
						<Event name="OnClick" type="Client">
							<Actions>
								<Action actionName="Confirmation Message" actionCategory="General" id="27" message="Submit record?" eventType="Client"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Button>
				<TextBox id="40" visible="Yes" fieldSourceType="DBColumn" dataType="Float" name="total_trans_amount" fieldSource="total_trans_amount" wizardCaption="Created By" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_setllementFormtotal_trans_amount" format="#,##0.00" required="True" defaultValue="0">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="43" visible="Yes" fieldSourceType="DBColumn" dataType="Float" name="total_vat_amount" fieldSource="total_vat_amount" wizardCaption="Updated By" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_setllementFormtotal_vat_amount" format="#,##0.00" required="True" defaultValue="0">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Hidden id="30" fieldSourceType="DBColumn" dataType="Float" name="t_vat_setllement_id" fieldSource="t_vat_setllement_id" required="False" caption="Id" wizardCaption="Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_setllementFormt_vat_setllement_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<TextBox id="286" visible="Yes" fieldSourceType="DBColumn" dataType="Float" name="debt_vat_amt" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_setllementFormdebt_vat_amt" format="#,##0.00" fieldSource="debt_vat_amt" defaultValue="0" required="True">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="288" visible="Yes" fieldSourceType="DBColumn" dataType="Float" name="cr_adjustment" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_setllementFormcr_adjustment" format="#,##0.00" fieldSource="cr_adjustment" defaultValue="0" required="True">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="289" visible="Yes" fieldSourceType="DBColumn" dataType="Float" name="cr_others" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_setllementFormcr_others" format="#,##0.00" fieldSource="cr_others" defaultValue="0" required="True">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="290" visible="Yes" fieldSourceType="DBColumn" dataType="Float" name="cr_payment" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_setllementFormcr_payment" format="#,##0.00" fieldSource="cr_payment" defaultValue="0" required="True">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="291" visible="Yes" fieldSourceType="DBColumn" dataType="Float" name="cr_stp" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_setllementFormcr_stp" format="#,##0.00" fieldSource="cr_stp" defaultValue="0" required="True">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="292" visible="Yes" fieldSourceType="DBColumn" dataType="Float" name="db_interest_charge" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_setllementFormdb_interest_charge" format="#,##0.00" fieldSource="db_interest_charge" defaultValue="0" required="True">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="293" visible="Yes" fieldSourceType="DBColumn" dataType="Float" name="db_increasing_charge" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_setllementFormdb_increasing_charge" format="#,##0.00" fieldSource="db_increasing_charge" required="True" defaultValue="0">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Hidden id="251" fieldSourceType="DBColumn" dataType="Float" name="t_customer_order_id" PathID="t_vat_setllementFormt_customer_order_id" fieldSource="t_customer_order_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Button id="99" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Cancel" operation="Cancel" wizardCaption="Cancel" PathID="t_vat_setllementFormButton_Cancel" removeParameters="FLAG">
					<Components/>
					<Events>
						<Event name="OnClick" type="Client">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="345"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Button>
				<TextBox id="346" visible="Yes" fieldSourceType="DBColumn" dataType="Float" name="total_penalty_amount" fieldSource="total_penalty_amount" wizardCaption="Updated By" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_setllementFormtotal_penalty_amount" format="#,##0.00" required="True" defaultValue="0">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="285" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="due_date" fieldSource="due_date" required="True" wizardCaption="Valid From" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_setllementFormdue_date" defaultValue="date(&quot;d-M-Y&quot;)" format="dd-mmm-yyyy">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<DatePicker id="347" name="DatePicker_due_date" control="due_date" wizardSatellite="True" wizardControl="valid_from" wizardDatePickerType="Image" wizardPicture="../Styles/CoffeeBreak/Images/DatePicker.gif" style="../Styles/sikp/Style.css" PathID="t_vat_setllementFormDatePicker_due_date">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</DatePicker>
			</Components>
			<Events>
				<Event name="AfterExecuteUpdate" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="344"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
				<TableParameter id="250" conditionType="Parameter" useIsNull="False" field="t_vat_setllement_id" dataType="Float" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="t_vat_setllement_id"/>
			</TableParameters>
			<SPParameters/>
			<SQLParameters>
			</SQLParameters>
			<JoinTables>
				<JoinTable id="249" tableName="v_vat_setllement" posLeft="10" posTop="10" posWidth="155" posHeight="180"/>
			</JoinTables>
			<JoinLinks/>
			<Fields>
			</Fields>
			<ISPParameters/>
			<ISQLParameters>
			</ISQLParameters>
			<IFormElements>
				<CustomParameter id="316" field="finance_period_code" dataType="Text" parameterType="Control" parameterSource="finance_period_code"/>
				<CustomParameter id="317" field="order_no" dataType="Text" parameterType="Control" parameterSource="order_no"/>
				<CustomParameter id="318" field="total_trans_amount" dataType="Float" parameterType="Control" parameterSource="total_trans_amount" format="#,##0.00"/>
				<CustomParameter id="319" field="total_vat_amount" dataType="Float" parameterType="Control" parameterSource="total_vat_amount" format="#,##0.00"/>
				<CustomParameter id="320" field="npwd" dataType="Text" parameterType="Control" parameterSource="npwd"/>
				<CustomParameter id="321" field="t_vat_setllement_id" dataType="Float" parameterType="Control" parameterSource="t_vat_setllement_id"/>
				<CustomParameter id="322" field="t_cust_account_id" dataType="Float" parameterType="Control" parameterSource="t_cust_account_id"/>
				<CustomParameter id="323" field="p_vat_type_id" dataType="Text" parameterType="Control" parameterSource="p_vat_type_id"/>
				<CustomParameter id="324" field="p_rqst_type_id" dataType="Float" parameterType="Control" parameterSource="p_rqst_type_id"/>
				<CustomParameter id="325" field="year_code" dataType="Text" parameterType="Control" parameterSource="year_code"/>
				<CustomParameter id="326" field="p_year_period_id" dataType="Float" parameterType="Control" parameterSource="p_year_period_id"/>
				<CustomParameter id="327" field="jenis_pajak" dataType="Text" parameterType="Control" parameterSource="jenis_pajak"/>
				<CustomParameter id="328" field="wp_name" dataType="Text" parameterType="Control" parameterSource="wp_name"/>
				<CustomParameter id="329" field="wp_address_name" dataType="Text" parameterType="Control" parameterSource="wp_address_name"/>
				<CustomParameter id="330" field="start_period" dataType="Text" parameterType="Control" parameterSource="start_period" format="dd-mmm-yyyy"/>
				<CustomParameter id="331" field="end_period" dataType="Text" parameterType="Control" parameterSource="end_period" format="dd-mmm-yyyy"/>
				<CustomParameter id="332" field="due_date" dataType="Text" parameterType="Control" parameterSource="due_date" format="dd-mmm-yyyy H:nn:ss"/>
				<CustomParameter id="333" field="debt_vat_amt" dataType="Float" parameterType="Control" parameterSource="debt_vat_amt" format="#,##0.00"/>
				<CustomParameter id="334" field="cr_adjustment" dataType="Float" parameterType="Control" parameterSource="cr_adjustment" format="#,##0.00"/>
				<CustomParameter id="335" field="cr_others" dataType="Float" parameterType="Control" parameterSource="cr_others" format="#,##0.00"/>
				<CustomParameter id="336" field="cr_payment" dataType="Float" parameterType="Control" parameterSource="cr_payment" format="#,##0.00"/>
				<CustomParameter id="337" field="cr_stp" dataType="Float" parameterType="Control" parameterSource="cr_stp" format="#,##0.00"/>
				<CustomParameter id="338" field="db_interest_charge" dataType="Float" parameterType="Control" parameterSource="db_interest_charge" format="#,##0.00"/>
				<CustomParameter id="339" field="db_increasing_charge" dataType="Float" parameterType="Control" parameterSource="db_increasing_charge" format="#,##0.00"/>
				<CustomParameter id="340" field="t_customer_order_id" dataType="Float" parameterType="Control" parameterSource="t_customer_order_id"/>
				<CustomParameter id="341" field="p_finance_period_id" dataType="Float" parameterType="Control" parameterSource="p_finance_period_id"/>
			</IFormElements>
			<USPParameters>
<SPParameter id="Key349" dataType="Char" parameterType="URL" dataSize="255" direction="ReturnValue" scale="0" precision="0" parameterName="o_result_msg" parameterSource="o_result_msg"/>
<SPParameter id="Key350" parameterName="i_finance_period_id" parameterSource="i_finance_period_id" dataType="Numeric" parameterType="URL" dataSize="28" direction="Input" scale="10" precision="6"/>
<SPParameter id="Key351" parameterName="i_start_period" parameterSource="i_start_period" dataType="Char" parameterType="URL" dataSize="255" direction="Input" scale="10" precision="6"/>
<SPParameter id="Key352" parameterName="i_end_period" parameterSource="i_end_period" dataType="Char" parameterType="URL" dataSize="255" direction="Input" scale="10" precision="6"/>
<SPParameter id="Key353" parameterName="i_total_trans_amount" parameterSource="total_trans_amount" dataType="Numeric" parameterType="Control" dataSize="28" direction="Input" scale="10" precision="6"/>
<SPParameter id="Key354" parameterName="i_total_vat_amount" parameterSource="total_vat_amount" dataType="Numeric" parameterType="Control" dataSize="28" direction="Input" scale="10" precision="6"/>
<SPParameter id="Key355" parameterName="i_total_penalty_amount" parameterSource="total_penalty_amount" dataType="Numeric" parameterType="Control" dataSize="28" direction="Input" scale="10" precision="6"/>
<SPParameter id="Key356" parameterName="i_due_date" parameterSource="due_date" dataType="Char" parameterType="Control" dataSize="255" direction="Input" scale="10" precision="6"/>
<SPParameter id="Key357" parameterName="i_debt_vat_amt" parameterSource="debt_vat_amt" dataType="Numeric" parameterType="Control" dataSize="28" direction="Input" scale="10" precision="6"/>
<SPParameter id="Key358" parameterName="i_cr_adjustment" parameterSource="cr_adjustment" dataType="Numeric" parameterType="Control" dataSize="28" direction="Input" scale="10" precision="6"/>
<SPParameter id="Key359" parameterName="i_cr_payment" parameterSource="cr_payment" dataType="Numeric" parameterType="Control" dataSize="28" direction="Input" scale="10" precision="6"/>
<SPParameter id="Key360" parameterName="i_cr_others" parameterSource="cr_others" dataType="Numeric" parameterType="Control" dataSize="28" direction="Input" scale="10" precision="6"/>
<SPParameter id="Key361" parameterName="i_cr_stp" parameterSource="cr_stp" dataType="Numeric" parameterType="Control" dataSize="28" direction="Input" scale="10" precision="6"/>
<SPParameter id="Key362" parameterName="i_db_interest_charge" parameterSource="db_interest_charge" dataType="Numeric" parameterType="Control" dataSize="28" direction="Input" scale="10" precision="6"/>
<SPParameter id="Key363" parameterName="i_db_increasing_charge" parameterSource="db_increasing_charge" dataType="Numeric" parameterType="Control" dataSize="28" direction="Input" scale="10" precision="6"/>
<SPParameter id="Key364" parameterName="i_vat_setllement_id" parameterSource="t_vat_setllement_id" dataType="Numeric" parameterType="Control" dataSize="28" direction="Input" scale="10" precision="6"/>
<SPParameter id="Key365" parameterName="i_user" parameterSource="CCGetUserLogin()" dataType="Char" parameterType="Expression" dataSize="255" direction="Input" scale="10" precision="6"/>
<SPParameter id="Key366" parameterName="i_status" parameterSource="'2'" dataType="Char" parameterType="Expression" dataSize="255" direction="Input" scale="10" precision="6"/>
</USPParameters>
			<USQLParameters>
			</USQLParameters>
			<UConditions>
			</UConditions>
			<UFormElements>
				<CustomParameter id="264" field="t_vat_setllement_id" dataType="Float" parameterType="Control" parameterSource="t_vat_setllement_id"/>
				<CustomParameter id="265" field="finance_period_code" dataType="Text" parameterType="Control" parameterSource="finance_period_code"/>
				<CustomParameter id="266" field="order_no" dataType="Text" parameterType="Control" parameterSource="order_no"/>
				<CustomParameter id="267" field="total_trans_amount" dataType="Float" parameterType="Control" parameterSource="total_trans_amount" format="0"/>
				<CustomParameter id="268" field="total_vat_amount" dataType="Float" parameterType="Control" parameterSource="total_vat_amount" format="0"/>
				<CustomParameter id="269" field="npwd" dataType="Text" parameterType="Control" parameterSource="npwd"/>
				<CustomParameter id="270" field="p_rqst_type_id" dataType="Float" parameterType="Control" parameterSource="p_rqst_type_id"/>
				<CustomParameter id="271" field="t_customer_order_id" dataType="Float" parameterType="Control" parameterSource="t_customer_order_id"/>
				<CustomParameter id="272" field="p_vat_type_id" dataType="Text" parameterType="Control" parameterSource="p_vat_type_id"/>
			</UFormElements>
			<DSPParameters/>
			<DSQLParameters>
				<SQLParameter id="342" variable="t_customer_order_id" parameterType="Control" defaultValue="0" dataType="Float" parameterSource="t_customer_order_id"/>
				<SQLParameter id="343" variable="UserName" parameterType="Expression" dataType="Text" parameterSource="CCGetUserLogin()"/>
			</DSQLParameters>
			<DConditions>
			</DConditions>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Record>
	</Components>
	<CodeFiles>
		<CodeFile id="Events" language="PHPTemplates" name="t_vat_setllement_update_events.php" forShow="False" comment="//" codePage="windows-1252"/>
		<CodeFile id="Code" language="PHPTemplates" name="t_vat_setllement_update.php" forShow="True" url="t_vat_setllement_update.php" comment="//" codePage="windows-1252"/>
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
		<Event name="BeforeShow" type="Server">
			<Actions>
				<Action actionName="Custom Code" actionCategory="General" id="260"/>
			</Actions>
		</Event>
	</Events>
</Page>
