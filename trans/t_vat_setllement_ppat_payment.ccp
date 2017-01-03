<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\trans" secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="CoffeeBreak" wizardThemeVersion="3.0" needGeneration="0" pasteActions="pasteActions">
	<Components>
		<Record id="23" sourceType="SQL" urlType="Relative" secured="False" allowInsert="False" allowUpdate="True" allowDelete="False" validateData="True" preserveParameters="GET" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" connection="ConnSIKP" name="t_vat_setllementForm" errorSummator="Error" wizardCaption="Add/Edit P App Role " wizardFormMethod="post" PathID="t_vat_setllementForm" activeCollection="SQLParameters" parameterTypeListName="ParameterTypeList" pasteAsReplace="pasteAsReplace" pasteActions="pasteActions" dataSource="select 
case when sanksi_ajb is not null then '-' else a.p_finance_period_id::VARCHAR end as p_finance_period_id_denda_profesi,
case when sanksi_ajb is null then '-' else a.p_finance_period_id::VARCHAR end as p_finance_period_id_sanksi_ajb,
case when sanksi_ajb is not null then '-' else b.code end as finance_period_code_denda_profesi,
case when sanksi_ajb is null then '-' else b.code end as finance_period_code_sanksi_ajb,
case when sanksi_ajb is not null then '-' else c.year_code end as year_period_code_denda_profesi,
case when sanksi_ajb is null then '-' else c.year_code end as year_period_code_sanksi_ajb,
total_vat_amount,nvl(sanksi_ajb,'-')as sanksi_ajb,ppat_name,address_name,no_sk
from t_vat_setllement_ppat a
left join p_finance_period b on a.p_finance_period_id=b.p_finance_period_id
left join p_year_period c on c.p_year_period_id=b.p_year_period_id
where payment_key  = '{s_keyword}'">
			<Components>
				<Hidden id="30" fieldSourceType="DBColumn" dataType="Float" name="t_vat_setllement_id" fieldSource="t_vat_setllement_id" required="False" caption="Id" wizardCaption="Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_setllementFormt_vat_setllement_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Button id="382" urlType="Relative" enableValidation="True" isDefault="False" name="cetak_payment" PathID="t_vat_setllementFormcetak_payment">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<TextBox id="393" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="ppat_name" wizardCaption="Keyword" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" PathID="t_vat_setllementFormppat_name" caption="nama PPAT" required="True" fieldSource="ppat_name">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Hidden id="158" fieldSourceType="DBColumn" dataType="Float" name="t_ppat_id" PathID="t_vat_setllementFormt_ppat_id" fieldSource="t_ppat_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<TextBox id="166" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="address_name" caption="Alamat Perusahaan" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_setllementFormaddress_name" required="True" fieldSource="address_name">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="167" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="no_sk" wizardCaption="Keyword" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" PathID="t_vat_setllementFormno_sk" caption="NO SK" required="True" fieldSource="no_sk">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="162" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="year_period_code_denda_profesi" wizardCaption="Keyword" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" PathID="t_vat_setllementFormyear_period_code_denda_profesi" caption="Periode Tahun" fieldSource="year_period_code_denda_profesi">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="400" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="finance_period_code_denda_profesi" wizardCaption="Keyword" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" PathID="t_vat_setllementFormfinance_period_code_denda_profesi" caption="Periode" fieldSource="finance_period_code_denda_profesi">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="403" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="sanksi_ajb" caption="Sanksi AJB" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_setllementFormsanksi_ajb" fieldSource="sanksi_ajb">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="168" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="year_period_code_sanksi_ajb" wizardCaption="Keyword" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" PathID="t_vat_setllementFormyear_period_code_sanksi_ajb" caption="Periode Tahun" fieldSource="year_period_code_sanksi_ajb">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="171" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="finance_period_code_sanksi_ajb" wizardCaption="Keyword" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" PathID="t_vat_setllementFormfinance_period_code_sanksi_ajb" caption="Periode" fieldSource="finance_period_code_sanksi_ajb">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="404" visible="Yes" fieldSourceType="DBColumn" dataType="Float" name="total_vat_amount" wizardCaption="Keyword" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" PathID="t_vat_setllementFormtotal_vat_amount" caption="JUMLAH DENDA" required="True" fieldSource="total_vat_amount" format="#,##0.00">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
<Hidden id="405" fieldSourceType="DBColumn" dataType="Float" name="t_customer_order_id" fieldSource="t_customer_order_id" required="False" caption="Id" wizardCaption="Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_vat_setllementFormt_customer_order_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
</Components>
			<Events>
				<Event name="BeforeShow" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="380" eventType="Server"/>
					</Actions>
				</Event>
				<Event name="BeforeSelect" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="381" eventType="Server"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
				<TableParameter id="333" conditionType="Parameter" useIsNull="False" field="t_vat_setllement_id" dataType="Float" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="t_vat_setllement_id"/>
			</TableParameters>
			<SPParameters/>
			<SQLParameters>
				<SQLParameter id="379" parameterType="URL" variable="s_keyword" dataType="Text" parameterSource="s_keyword"/>
			</SQLParameters>
			<JoinTables>
			</JoinTables>
			<JoinLinks/>
			<Fields>
			</Fields>
			<ISPParameters/>
			<ISQLParameters>
			</ISQLParameters>
			<IFormElements>
				<CustomParameter id="335" field="p_vat_type_id" dataType="Float" parameterType="Control" parameterSource="p_vat_type_id"/>
				<CustomParameter id="336" field="vat_code" dataType="Text" parameterType="Control" parameterSource="code"/>
				<CustomParameter id="337" field="description" dataType="Text" parameterType="Control" parameterSource="description"/>
				<CustomParameter id="338" field="creation_date" dataType="Text" parameterType="Control" parameterSource="creation_date" format="dd-mmm-yyyy"/>
				<CustomParameter id="339" field="created_by" dataType="Text" parameterType="Control" parameterSource="created_by"/>
				<CustomParameter id="340" field="updated_date" dataType="Text" parameterType="Control" parameterSource="updated_date" format="dd-mmm-yyyy"/>
				<CustomParameter id="341" field="updated_by" dataType="Text" parameterType="Control" parameterSource="updated_by"/>
			</IFormElements>
			<USPParameters/>
			<USQLParameters>
				<SQLParameter id="342" variable="is_anomali" parameterType="Control" dataType="Text" parameterSource="is_anomali"/>
				<SQLParameter id="343" variable="t_vat_setllement_id" parameterType="Control" defaultValue="0" dataType="Float" parameterSource="t_vat_setllement_id"/>
				<SQLParameter id="344" variable="no_kohir" parameterType="Control" dataType="Text" parameterSource="no_kohir"/>
			</USQLParameters>
			<UConditions>
			</UConditions>
			<UFormElements>
				<CustomParameter id="345" field="t_vat_setllement_id" dataType="Float" parameterType="Control" parameterSource="t_vat_setllement_id"/>
				<CustomParameter id="346" field="finance_period_code" dataType="Text" parameterType="Control" parameterSource="finance_period_code"/>
				<CustomParameter id="347" field="order_no" dataType="Text" parameterType="Control" parameterSource="order_no"/>
				<CustomParameter id="348" field="total_trans_amount" dataType="Float" parameterType="Control" parameterSource="total_trans_amount" format="0"/>
				<CustomParameter id="349" field="total_vat_amount" dataType="Float" parameterType="Control" parameterSource="total_vat_amount" format="0"/>
				<CustomParameter id="350" field="npwd" dataType="Text" parameterType="Control" parameterSource="npwd"/>
				<CustomParameter id="351" field="p_rqst_type_id" dataType="Float" parameterType="Control" parameterSource="p_rqst_type_id"/>
				<CustomParameter id="352" field="t_customer_order_id" dataType="Float" parameterType="Control" parameterSource="t_customer_order_id"/>
				<CustomParameter id="353" field="p_vat_type_id" dataType="Text" parameterType="Control" parameterSource="p_vat_type_id"/>
			</UFormElements>
			<DSPParameters/>
			<DSQLParameters>
			</DSQLParameters>
			<DConditions>
			</DConditions>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Record>
		<Record id="355" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="None" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="t_vat_setllement_dtlSearch" wizardCaption="Search P App Module Role " wizardOrientation="Vertical" wizardFormMethod="post" returnPage="t_vat_setllement_ppat_payment.ccp" PathID="t_vat_setllement_dtlSearch" pasteActions="pasteActions">
			<Components>
				<TextBox id="356" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="s_keyword" wizardCaption="Keyword" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" PathID="t_vat_setllement_dtlSearchs_keyword">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Button id="4" urlType="Relative" enableValidation="True" isDefault="False" name="Button_DoSearch" operation="Search" wizardCaption="Search" PathID="t_vat_setllement_dtlSearchButton_DoSearch">
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
		<CodeFile id="Events" language="PHPTemplates" name="t_vat_setllement_ppat_payment_events.php" forShow="False" comment="//" codePage="windows-1252"/>
		<CodeFile id="Code" language="PHPTemplates" name="t_vat_setllement_ppat_payment.php" forShow="True" url="t_vat_setllement_ppat_payment.php" comment="//" codePage="windows-1252"/>
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
				<Action actionName="Custom Code" actionCategory="General" id="193"/>
			</Actions>
		</Event>
		<Event name="BeforeInitialize" type="Server">
			<Actions>
				<Action actionName="Custom Code" actionCategory="General" id="384"/>
			</Actions>
		</Event>
	</Events>
</Page>
