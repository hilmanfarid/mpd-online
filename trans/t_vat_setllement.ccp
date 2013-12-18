<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\trans" secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="CoffeeBreak" wizardThemeVersion="3.0" needGeneration="0" pasteActions="pasteActions">
	<Components>
		<Grid id="2" secured="False" sourceType="Table" returnValueType="Number" defaultPageSize="5" connection="ConnSIKP" name="t_vat_setllementGrid" pageSizeLimit="100" wizardCaption="List of P App Role " wizardGridType="Tabular" wizardAllowInsert="True" wizardAltRecord="True" wizardAltRecordType="Style" wizardRecordSeparator="False" wizardNoRecords="-" pasteAsReplace="pasteAsReplace" pasteActions="pasteActions" activeCollection="TableParameters" dataSource="v_vat_setllement">
			<Components>
				<Link id="11" visible="Yes" fieldSourceType="CodeExpression" html="True" hrefType="Page" urlType="Relative" preserveParameters="GET" name="DLink" wizardCaption="Detail" wizardSize="50" wizardMaxLength="60" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" dataType="Text" wizardDefaultValue="DLink" hrefSource="t_vat_setllement.ccp" wizardThemeItem="GridA" PathID="t_vat_setllementGridDLink" removeParameters="FLAG">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="219" sourceType="DataField" name="p_vat_type_id" source="p_vat_type_id"/>
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
				<ImageLink id="195" visible="Yes" fieldSourceType="DBColumn" dataType="Text" hrefType="Page" urlType="Relative" preserveParameters="GET" name="ImageLink1" PathID="t_vat_setllementGridImageLink1" hrefSource="t_vat_setllement_dtl.ccp">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="196" sourceType="DataField" name="t_vat_setllement_id" source="t_vat_setllement_id"/>
						<LinkParameter id="197" sourceType="DataField" name="npwd" source="npwd"/>
						<LinkParameter id="198" sourceType="DataField" name="t_cust_account_id" source="t_cust_account_id"/>
						<LinkParameter id="199" sourceType="DataField" name="finance_period_code" source="finance_period_code"/>
						<LinkParameter id="200" sourceType="DataField" name="p_finance_period_id" source="p_finance_period_id"/>
						<LinkParameter id="202" sourceType="DataField" name="t_customer_order_id" source="t_customer_order_id"/>
						<LinkParameter id="259" sourceType="DataField" name="order_no" source="order_no"/>
						<LinkParameter id="220" sourceType="DataField" name="p_rqst_type_id" source="p_rqst_type_id"/>
						<LinkParameter id="221" sourceType="DataField" name="rqst_type_code" source="rqst_type_code"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</ImageLink>
				<ImageLink id="207" visible="Yes" fieldSourceType="DBColumn" dataType="Text" hrefType="Page" urlType="Relative" preserveParameters="GET" name="ImageLink2" PathID="t_vat_setllementGridImageLink2" hrefSource="t_sptpd_legal_doc.ccp">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="208" sourceType="DataField" name="t_vat_setllement_id" source="t_vat_setllement_id"/>
						<LinkParameter id="209" sourceType="DataField" name="npwd" source="npwd"/>
						<LinkParameter id="210" sourceType="DataField" name="t_cust_account_id" source="t_cust_account_id"/>
						<LinkParameter id="211" sourceType="DataField" name="finance_period_code" source="finance_period_code"/>
						<LinkParameter id="212" sourceType="DataField" name="p_finance_period_id" source="p_finance_period_id"/>
						<LinkParameter id="214" sourceType="DataField" name="t_customer_order_id" source="t_customer_order_id"/>
						<LinkParameter id="216" sourceType="DataField" name="p_rqst_type_id" source="p_rqst_type_id"/>
						<LinkParameter id="218" sourceType="DataField" name="order_no" source="order_no"/>
						<LinkParameter id="222" sourceType="DataField" name="rqst_type_code" source="rqst_type_code"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</ImageLink>
			</Components>
			<Events>
				<Event name="BeforeSelect" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="226"/>
					</Actions>
				</Event>
				<Event name="BeforeShowRow" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="227"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
				<TableParameter id="256" conditionType="Parameter" useIsNull="False" field="t_cust_account_id" dataType="Float" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="t_cust_account_id"/>
				<TableParameter id="257" conditionType="Parameter" useIsNull="False" field="p_finance_period_id" dataType="Float" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="p_finance_period_id"/>
				<TableParameter id="258" conditionType="Parameter" useIsNull="False" field="p_rqst_type_id" dataType="Float" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="p_rqst_type_id"/>
				<TableParameter id="261" conditionType="Parameter" useIsNull="False" field="p_order_status_id" dataType="Float" searchConditionType="Equal" parameterType="Expression" logicOperator="And" parameterSource="1"/>
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
		<Record id="23" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="True" allowDelete="True" validateData="True" preserveParameters="GET" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" connection="ConnSIKP" name="t_vat_setllementForm" errorSummator="Error" wizardCaption="Add/Edit P App Role " wizardFormMethod="post" PathID="t_vat_setllementForm" activeCollection="DSQLParameters" parameterTypeListName="ParameterTypeList" pasteAsReplace="pasteAsReplace" pasteActions="pasteActions" dataSource="v_vat_setllement" customUpdate="select o_result_code, o_result_msg from f_first_submit_engine(501,{t_customer_order_id},'{UserName}')" customUpdateType="SQL" customDeleteType="SQL" customDelete="select * from f_del_vat_setllement({t_vat_setllement_id},null,null)">
			<Components>
				<Button id="24" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Insert" operation="Insert" wizardCaption="Add" PathID="t_vat_setllementFormButton_Insert" removeParameters="FLAG">
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
				<Button id="26" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Delete" operation="Delete" wizardCaption="Delete" PathID="t_vat_setllementFormButton_Delete" removeParameters="FLAG;p_vat_type_id;p_vat_typeGridPage;s_keyword">
					<Components/>
					<Events>
						<Event name="OnClick" type="Client">
							<Actions>
								<Action actionName="Confirmation Message" actionCategory="General" id="27" message="Delete record?" eventType="Client"/>
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
				<TextBox id="40" visible="Yes" fieldSourceType="DBColumn" dataType="Float" name="total_trans_amount" fieldSource="total_trans_amount" wizardCaption="Created By" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_setllementFormtotal_trans_amount" format="0">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="43" visible="Yes" fieldSourceType="DBColumn" dataType="Float" name="total_vat_amount" fieldSource="total_vat_amount" wizardCaption="Updated By" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_setllementFormtotal_vat_amount" format="0">
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
				<Hidden id="223" fieldSourceType="DBColumn" dataType="Float" html="False" name="p_rqst_type_id" fieldSource="p_rqst_type_id" wizardCaption="Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="t_vat_setllementFormp_rqst_type_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="251" fieldSourceType="DBColumn" dataType="Float" name="t_customer_order_id" PathID="t_vat_setllementFormt_customer_order_id" fieldSource="t_customer_order_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Button id="262" urlType="Relative" enableValidation="True" isDefault="False" name="Button1" PathID="t_vat_setllementFormButton1">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Hidden id="263" fieldSourceType="DBColumn" dataType="Text" name="p_vat_type_id" PathID="t_vat_setllementFormp_vat_type_id" fieldSource="p_vat_type_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Button id="274" urlType="Relative" enableValidation="True" isDefault="False" name="Button2" PathID="t_vat_setllementFormButton2">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Hidden id="30" fieldSourceType="DBColumn" dataType="Float" name="t_vat_setllement_id" fieldSource="t_vat_setllement_id" required="False" caption="Id" wizardCaption="Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_setllementFormt_vat_setllement_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
			</Components>
			<Events>
				<Event name="BeforeShow" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="275"/>
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
				<CustomParameter id="228" field="p_vat_type_id" dataType="Float" parameterType="Control" parameterSource="p_vat_type_id"/>
				<CustomParameter id="229" field="vat_code" dataType="Text" parameterType="Control" parameterSource="code"/>
				<CustomParameter id="230" field="description" dataType="Text" parameterType="Control" parameterSource="description"/>
				<CustomParameter id="231" field="creation_date" dataType="Text" parameterType="Control" parameterSource="creation_date" format="dd-mmm-yyyy"/>
				<CustomParameter id="232" field="created_by" dataType="Text" parameterType="Control" parameterSource="created_by"/>
				<CustomParameter id="233" field="updated_date" dataType="Text" parameterType="Control" parameterSource="updated_date" format="dd-mmm-yyyy"/>
				<CustomParameter id="234" field="updated_by" dataType="Text" parameterType="Control" parameterSource="updated_by"/>
			</IFormElements>
			<USPParameters/>
			<USQLParameters>
				<SQLParameter id="254" variable="t_customer_order_id" parameterType="Control" defaultValue="0" dataType="Float" parameterSource="t_customer_order_id"/>
				<SQLParameter id="255" variable="UserName" parameterType="Expression" dataType="Text" parameterSource="CCGetUserLogin()"/>
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
				<SQLParameter id="273" variable="t_vat_setllement_id" parameterType="Control" defaultValue="0" dataType="Float" parameterSource="t_vat_setllement_id"/>
			</DSQLParameters>
			<DConditions>
			</DConditions>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Record>
		<Record id="3" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="None" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="t_vat_setllementSearch" wizardCaption="Search P App Role " wizardOrientation="Vertical" wizardFormMethod="post" returnPage="t_vat_setllement.ccp" PathID="t_vat_setllementSearch" pasteActions="pasteActions">
			<Components>
				<TextBox id="5" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="npwd" wizardCaption="Keyword" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" PathID="t_vat_setllementSearchnpwd" required="True" caption="NPWD">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="165" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="finance_period_code" wizardCaption="Keyword" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" PathID="t_vat_setllementSearchfinance_period_code" required="True" caption="Periode">
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
				<Hidden id="167" fieldSourceType="DBColumn" dataType="Float" name="p_finance_period_id" PathID="t_vat_setllementSearchp_finance_period_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="170" fieldSourceType="DBColumn" dataType="Float" name="t_cust_account_id" PathID="t_vat_setllementSearcht_cust_account_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Button id="174" urlType="Relative" enableValidation="True" isDefault="False" name="button_submit" PathID="t_vat_setllementSearchbutton_submit">
					<Components/>
					<Events>
						<Event name="OnClick" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="177" eventType="Server"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="203" urlType="Relative" enableValidation="True" isDefault="False" name="Button1" PathID="t_vat_setllementSearchButton1" operation="Cancel">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Hidden id="44" fieldSourceType="DBColumn" dataType="Float" name="p_vat_type_id" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_vat_setllementSearchp_vat_type_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<TextBox id="276" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="year_code" wizardCaption="Keyword" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" PathID="t_vat_setllementSearchyear_code" required="True" caption="Periode Tahun">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
<Hidden id="278" fieldSourceType="DBColumn" dataType="Float" name="p_year_period_id" PathID="t_vat_setllementSearchp_year_period_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
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
		<CodeFile id="Events" language="PHPTemplates" name="t_vat_setllement_events.php" forShow="False" comment="//" codePage="windows-1252"/>
		<CodeFile id="Code" language="PHPTemplates" name="t_vat_setllement.php" forShow="True" url="t_vat_setllement.php" comment="//" codePage="windows-1252"/>
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
