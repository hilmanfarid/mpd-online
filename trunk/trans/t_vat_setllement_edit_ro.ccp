<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\trans" secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="CoffeeBreak" wizardThemeVersion="3.0" needGeneration="0" pasteActions="pasteActions">
	<Components>
		<Grid id="2" secured="False" sourceType="Table" returnValueType="Number" defaultPageSize="5" connection="ConnSIKP" name="t_vat_setllementGrid" pageSizeLimit="100" wizardCaption="List of P App Role " wizardGridType="Tabular" wizardAllowInsert="True" wizardAltRecord="True" wizardAltRecordType="Style" wizardRecordSeparator="False" wizardNoRecords="-" pasteAsReplace="pasteAsReplace" pasteActions="pasteActions" activeCollection="TableParameters" dataSource="v_vat_setllement">
			<Components>
				<Link id="11" visible="Yes" fieldSourceType="CodeExpression" html="True" hrefType="Page" urlType="Relative" preserveParameters="GET" name="DLink" wizardCaption="Detail" wizardSize="50" wizardMaxLength="60" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" dataType="Text" wizardDefaultValue="DLink" hrefSource="t_vat_setllement_edit_ro.ccp" wizardThemeItem="GridA" PathID="t_vat_setllementGridDLink" removeParameters="FLAG">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="314" sourceType="DataField" name="t_vat_setllement_id" source="t_vat_setllement_id"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
				<Label id="17" fieldSourceType="DBColumn" dataType="Text" html="False" name="order_no" fieldSource="order_no" wizardCaption="Description" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="t_vat_setllementGridorder_no">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="19" fieldSourceType="DBColumn" dataType="Float" html="False" name="total_trans_amount" fieldSource="total_trans_amount" wizardCaption="Valid From" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="t_vat_setllementGridtotal_trans_amount" format="0">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="21" fieldSourceType="DBColumn" dataType="Float" html="False" name="total_vat_amount" fieldSource="total_vat_amount" wizardCaption="Valid To" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="t_vat_setllementGridtotal_vat_amount" format="0">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Navigator id="22" size="10" type="Centered" pageSizes="1;5;10;25;50" name="Navigator" wizardPagingType="Custom" wizardFirst="True" wizardFirstText="First" wizardPrev="True" wizardPrevText="Prev" wizardNext="True" wizardNextText="Next" wizardLast="True" wizardLastText="Last" wizardImages="Images" wizardPageNumbers="Centered" wizardSize="10" wizardTotalPages="False" wizardHideDisabled="False" wizardOfText="of" wizardPageSize="False" wizardUsePageScroller="True">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Navigator>
				<Label id="15" fieldSourceType="DBColumn" dataType="Text" html="False" name="finance_period_code" fieldSource="finance_period_code" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="t_vat_setllementGridfinance_period_code">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Hidden id="13" fieldSourceType="DBColumn" dataType="Float" html="False" name="t_vat_setllement_id" fieldSource="t_vat_setllement_id" wizardCaption="Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="t_vat_setllementGridt_vat_setllement_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Label id="244" fieldSourceType="DBColumn" dataType="Text" html="False" name="npwd" fieldSource="npwd" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="t_vat_setllementGridnpwd">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
			</Components>
			<Events>
				<Event name="BeforeSelect" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="226"/>
					</Actions>
				</Event>
				<Event name="BeforeShowRow" type="Server">
					<Actions>
						<Action actionName="Set Row Style" actionCategory="General" id="315" styles="Row;AltRow" name="rowStyle"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
				<TableParameter id="261" conditionType="Parameter" useIsNull="False" field="p_order_status_id" dataType="Float" searchConditionType="Equal" parameterType="Expression" logicOperator="And" leftBrackets="0" parameterSource="2"/>
				<TableParameter id="312" conditionType="Parameter" useIsNull="False" field="upper(npwd)" dataType="Text" searchConditionType="Contains" parameterType="URL" logicOperator="Or" parameterSource="s_keyword" leftBrackets="1"/>
				<TableParameter id="313" conditionType="Parameter" useIsNull="False" field="upper(finance_period_code)" dataType="Text" searchConditionType="Contains" parameterType="URL" logicOperator="And" parameterSource="s_keyword" rightBrackets="1"/>
			</TableParameters>
			<JoinTables>
				<JoinTable id="248" tableName="v_vat_setllement" posLeft="10" posTop="10" posWidth="155" posHeight="180"/>
			</JoinTables>
			<JoinLinks/>
			<Fields>
				<Field id="247" fieldName="*"/>
			</Fields>
			<SPParameters/>
			<SQLParameters>
			</SQLParameters>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Grid>
		<Record id="23" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="True" allowDelete="True" validateData="True" preserveParameters="GET" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" connection="ConnSIKP" name="t_vat_setllementForm" errorSummator="Error" wizardCaption="Add/Edit P App Role " wizardFormMethod="post" PathID="t_vat_setllementForm" activeCollection="DSQLParameters" parameterTypeListName="ParameterTypeList" pasteAsReplace="pasteAsReplace" pasteActions="pasteActions" dataSource="v_vat_setllement" customUpdateType="SQL" customDeleteType="SQL" customDelete="select o_result_code, o_result_msg from f_first_submit_engine(501,{t_customer_order_id},'{UserName}')" customUpdate="UPDATE t_vat_setllement SET
t_cust_account_id = {t_cust_account_id},
p_finance_period_id = {p_finance_period_id},
start_period = to_date('{start_period}','DD-MON-YYYY'),
end_period = to_date('{end_period}','DD-MON-YYYY'),
total_trans_amount = {total_trans_amount},
total_vat_amount = {total_vat_amount},
debt_vat_amt = {debt_vat_amt},
cr_adjustment = {cr_adjustment},
cr_payment = {cr_payment},
cr_others = {cr_others},
cr_stp = {cr_stp},
db_interest_charge = {db_interest_charge},
db_increasing_charge = {db_increasing_charge}
WHERE t_vat_setllement_id = {t_vat_setllement_id}">
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
				<TextBox id="31" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="finance_period_code" fieldSource="finance_period_code" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_setllementFormfinance_period_code">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="37" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="order_no" fieldSource="order_no" wizardCaption="Description" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_setllementFormorder_no">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="40" visible="Yes" fieldSourceType="DBColumn" dataType="Float" name="total_trans_amount" fieldSource="total_trans_amount" wizardCaption="Created By" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_setllementFormtotal_trans_amount" format="#,##0.00" defaultValue="0">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="43" visible="Yes" fieldSourceType="DBColumn" dataType="Float" name="total_vat_amount" fieldSource="total_vat_amount" wizardCaption="Updated By" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_setllementFormtotal_vat_amount" format="#,##0.00" defaultValue="0">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="243" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="npwd" fieldSource="npwd" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_setllementFormnpwd">
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
				<Hidden id="279" fieldSourceType="DBColumn" dataType="Float" name="t_cust_account_id" PathID="t_vat_setllementFormt_cust_account_id" fieldSource="t_cust_account_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="263" fieldSourceType="DBColumn" dataType="Text" name="p_vat_type_id" PathID="t_vat_setllementFormp_vat_type_id" fieldSource="p_vat_type_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="223" fieldSourceType="DBColumn" dataType="Float" html="False" name="p_rqst_type_id" fieldSource="p_rqst_type_id" wizardCaption="Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="t_vat_setllementFormp_rqst_type_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<TextBox id="280" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="year_code" wizardCaption="Keyword" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" PathID="t_vat_setllementFormyear_code" caption="Periode Tahun" fieldSource="year_code">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Hidden id="281" fieldSourceType="DBColumn" dataType="Float" name="p_year_period_id" PathID="t_vat_setllementFormp_year_period_id" fieldSource="p_year_period_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<TextBox id="282" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="jenis_pajak" fieldSource="jenis_pajak" caption="Jenis Pajak" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_setllementFormjenis_pajak">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="283" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="wp_name" fieldSource="wp_name" caption="Nama Wajib Pajak" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_setllementFormwp_name">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextArea id="284" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="wp_address_name" fieldSource="wp_address_name" caption="Alamat Wajib Pajak" wizardCaption="ORGANIZATION CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_setllementFormwp_address_name">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextArea>
				<TextBox id="33" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="start_period" caption="Masa Pajak" wizardCaption="Valid From" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_setllementFormstart_period" defaultValue="date(&quot;d-M-Y&quot;)" format="dd-mmm-yyyy" fieldSource="start_period">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="35" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="end_period" wizardCaption="Valid To" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_setllementFormend_period" format="dd-mmm-yyyy" defaultValue="date(&quot;d-M-Y&quot;)" fieldSource="end_period">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="285" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="due_date" fieldSource="due_date" wizardCaption="Valid From" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_setllementFormdue_date" defaultValue="date(&quot;d-M-Y h:i:s&quot;)" format="dd-mmm-yyyy H:nn:ss">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="286" visible="Yes" fieldSourceType="DBColumn" dataType="Float" name="debt_vat_amt" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_setllementFormdebt_vat_amt" format="#,##0.00" fieldSource="debt_vat_amt" defaultValue="0">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="288" visible="Yes" fieldSourceType="DBColumn" dataType="Float" name="cr_adjustment" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_setllementFormcr_adjustment" format="#,##0.00" fieldSource="cr_adjustment" defaultValue="0">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="289" visible="Yes" fieldSourceType="DBColumn" dataType="Float" name="cr_others" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_setllementFormcr_others" format="#,##0.00" fieldSource="cr_others" defaultValue="0">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="290" visible="Yes" fieldSourceType="DBColumn" dataType="Float" name="cr_payment" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_setllementFormcr_payment" format="#,##0.00" fieldSource="cr_payment" defaultValue="0">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="291" visible="Yes" fieldSourceType="DBColumn" dataType="Float" name="cr_stp" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_setllementFormcr_stp" format="#,##0.00" fieldSource="cr_stp" defaultValue="0">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="292" visible="Yes" fieldSourceType="DBColumn" dataType="Float" name="db_interest_charge" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_setllementFormdb_interest_charge" format="#,##0.00" fieldSource="db_interest_charge" defaultValue="0">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="293" visible="Yes" fieldSourceType="DBColumn" dataType="Float" name="db_increasing_charge" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_setllementFormdb_increasing_charge" format="#,##0.00" fieldSource="db_increasing_charge" defaultValue="0">
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
				<Hidden id="160" fieldSourceType="DBColumn" dataType="Float" name="p_finance_period_id" PathID="t_vat_setllementFormp_finance_period_id" fieldSource="p_finance_period_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Button id="344" urlType="Relative" enableValidation="True" isDefault="False" name="Button1" PathID="t_vat_setllementFormButton1">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<TextBox id="345" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="no_kohir" wizardCaption="Keyword" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" PathID="t_vat_setllementFormno_kohir" caption="No Kohir" fieldSource="no_kohir">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Button id="346" urlType="Relative" enableValidation="True" isDefault="False" name="Button2" PathID="t_vat_setllementFormButton2">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
</Components>
			<Events>
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
			<USPParameters/>
			<USQLParameters>
				<SQLParameter id="296" variable="t_cust_account_id" parameterType="Control" defaultValue="0" dataType="Float" parameterSource="t_cust_account_id"/>
				<SQLParameter id="298" variable="p_finance_period_id" parameterType="Control" defaultValue="0" dataType="Float" parameterSource="p_finance_period_id"/>
				<SQLParameter id="299" variable="start_period" parameterType="Control" dataType="Text" parameterSource="start_period"/>
				<SQLParameter id="300" variable="end_period" parameterType="Control" dataType="Text" parameterSource="end_period"/>
				<SQLParameter id="301" variable="total_trans_amount" parameterType="Control" defaultValue="0" dataType="Float" parameterSource="total_trans_amount"/>
				<SQLParameter id="302" variable="total_vat_amount" parameterType="Control" defaultValue="0" dataType="Float" parameterSource="total_vat_amount"/>
				<SQLParameter id="303" variable="debt_vat_amt" parameterType="Control" defaultValue="0" dataType="Float" parameterSource="debt_vat_amt"/>
				<SQLParameter id="304" variable="cr_adjustment" parameterType="Control" defaultValue="0" dataType="Float" parameterSource="cr_adjustment"/>
				<SQLParameter id="305" variable="cr_payment" parameterType="Control" defaultValue="0" dataType="Float" parameterSource="cr_payment"/>
				<SQLParameter id="306" variable="cr_others" parameterType="Control" defaultValue="0" dataType="Float" parameterSource="cr_others"/>
				<SQLParameter id="307" variable="cr_stp" parameterType="Control" defaultValue="0" dataType="Float" parameterSource="cr_stp"/>
				<SQLParameter id="308" variable="db_interest_charge" parameterType="Control" defaultValue="0" dataType="Float" parameterSource="db_interest_charge"/>
				<SQLParameter id="309" variable="db_increasing_charge" parameterType="Control" defaultValue="0" dataType="Float" parameterSource="db_increasing_charge"/>
				<SQLParameter id="310" variable="t_vat_setllement_id" parameterType="Control" defaultValue="0" dataType="Float" parameterSource="t_vat_setllement_id"/>
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
		<Record id="3" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="None" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="t_vat_setllementSearch" wizardCaption="Search P App Role " wizardOrientation="Vertical" wizardFormMethod="post" returnPage="t_vat_setllement_edit_ro.ccp" PathID="t_vat_setllementSearch" pasteActions="pasteActions">
			<Components>
				<TextBox id="5" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="s_keyword" wizardCaption="Keyword" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" PathID="t_vat_setllementSearchs_keyword">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Button id="4" urlType="Relative" enableValidation="True" isDefault="False" name="Button_DoSearch" operation="Search" wizardCaption="Search" PathID="t_vat_setllementSearchButton_DoSearch">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
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
	</Components>
	<CodeFiles>
		<CodeFile id="Events" language="PHPTemplates" name="t_vat_setllement_edit_ro_events.php" forShow="False" comment="//" codePage="windows-1252"/>
		<CodeFile id="Code" language="PHPTemplates" name="t_vat_setllement_edit_ro.php" forShow="True" url="t_vat_setllement_edit_ro.php" comment="//" codePage="windows-1252"/>
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
