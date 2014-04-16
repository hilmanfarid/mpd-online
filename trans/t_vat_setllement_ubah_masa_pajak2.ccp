<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\trans" secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" validateRequest="True" cachingDuration="1 minutes" wizardTheme="sikm" wizardThemeVersion="3.0" needGeneration="0">
	<Components>
		<Record id="3" sourceType="SQL" urlType="Relative" secured="False" allowInsert="False" allowUpdate="True" allowDelete="False" validateData="True" preserveParameters="None" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="formPerubahanMasaPajak" returnPage="t_vat_setllement_ubah_masa_pajak2.ccp" PathID="formPerubahanMasaPajak" connection="ConnSIKP" pasteActions="pasteActions" parameterTypeListName="ParameterTypeList" activeCollection="USQLParameters" dataSource="SELECT t_vat_setllement_id, t_customer_order_id,
to_char(settlement_date,'YYYY-MM-DD') AS settlement_date, p_finance_period_id, t_cust_account_id,
npwd, total_trans_amount, total_vat_amount, creation_date,
created_by, updated_date, updated_by, is_anomali,
is_authorized, no_kohir, p_settlement_type_id,
debt_vat_amt, cr_adjustment, cr_payment, cr_others,
cr_stp, db_interest_charge, db_increasing_charge,
db_admin_penalty, due_date, is_settled, start_period,
end_period, qty_room_sold, total_penalty_amount, doc_no,
p_vat_type_dtl_id, old_id,
b.code as masa_pajak
FROM t_vat_setllement
LEFT JOIN p_finance_period AS b ON t_vat_setllement.p_finance_period_id = b.p_finance_period_id
WHERE t_vat_setllement_id = {t_vat_setllement_id}" customUpdateType="SQL" customUpdate="SELECT f_update_masa_pajak({t_vat_setllement_id},'{p_finance_period_id}', '{alasan}', '{user_name}') AS msg">
			<Components>
				<Button id="16" urlType="Relative" enableValidation="True" isDefault="False" name="Button1" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="formPerubahanMasaPajakButton1" operation="Update">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Hidden id="7" fieldSourceType="DBColumn" dataType="Text" name="t_vat_setllement_id" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="formPerubahanMasaPajakt_vat_setllement_id" fieldSource="t_vat_setllement_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<TextArea id="37" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="alasan" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="formPerubahanMasaPajakalasan" fieldSource="alasan" required="True">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextArea>
				<TextBox id="50" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="masa_pajak" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="formPerubahanMasaPajakmasa_pajak" fieldSource="masa_pajak">
<Components/>
<Events/>
<Attributes/>
<Features/>
</TextBox>
<Hidden id="51" fieldSourceType="DBColumn" dataType="Text" name="p_year_period_id" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="formPerubahanMasaPajakp_year_period_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
<TextBox id="53" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="year_code" PathID="formPerubahanMasaPajakyear_code">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
<TextBox id="54" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="code" PathID="formPerubahanMasaPajakcode">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
<Hidden id="56" fieldSourceType="DBColumn" dataType="Text" name="p_finance_period_id" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="formPerubahanMasaPajakp_finance_period_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
</Components>
			<Events>
				<Event name="BeforeShow" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="8"/>
					</Actions>
				</Event>
				<Event name="AfterInsert" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="22"/>
					</Actions>
				</Event>
				<Event name="AfterUpdate" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="27"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
				<TableParameter id="26" conditionType="Parameter" useIsNull="False" field="t_vat_setllement_id" dataType="Float" searchConditionType="Equal" parameterType="URL" logicOperator="And" defaultValue="0" parameterSource="t_vat_setllement_id"/>
			</TableParameters>
			<SPParameters/>
			<SQLParameters>
				<SQLParameter id="24" variable="t_vat_setllement_id" parameterType="URL" dataType="Text" parameterSource="t_vat_setllement_id" designDefaultValue="384979"/>
			</SQLParameters>
			<JoinTables/>
			<JoinLinks/>
			<Fields/>
			<ISPParameters/>
			<ISQLParameters>
				<SQLParameter id="18" variable="t_vat_setllement_id" parameterType="Control" defaultValue="0" dataType="Integer" parameterSource="t_vat_setllement_id"/>
				<SQLParameter id="19" variable="total_trans_amount" parameterType="Control" defaultValue="0" dataType="Float" parameterSource="total_trans_amount"/>
				<SQLParameter id="20" variable="alasan" parameterType="Control" dataType="Text" parameterSource="alasan"/>
				<SQLParameter id="21" variable="user_name" parameterType="Session" dataType="Text" parameterSource="UserLogin"/>
			</ISQLParameters>
			<IFormElements>
				<CustomParameter id="17" field="t_vat_setllement_id" dataType="Text" parameterType="Control" parameterSource="t_vat_setllement_id"/>
			</IFormElements>
			<USPParameters/>
			<USQLParameters>
				<SQLParameter id="34" variable="t_vat_setllement_id" parameterType="Control" dataType="Integer" parameterSource="t_vat_setllement_id" defaultValue="0"/>
				<SQLParameter id="35" variable="p_finance_period_id" parameterType="Control" dataType="Integer" parameterSource="p_finance_period_id" defaultValue="0"/>
				<SQLParameter id="36" variable="user_name" parameterType="Session" dataType="Text" parameterSource="UserLogin"/>
				<SQLParameter id="38" variable="alasan" parameterType="Control" dataType="Text" parameterSource="alasan"/>
			</USQLParameters>
			<UConditions/>
			<UFormElements>
				<CustomParameter id="11" field="t_vat_setllement_id" dataType="Text" parameterType="Control" parameterSource="t_vat_setllement_id"/>
			</UFormElements>
			<DSPParameters/>
			<DSQLParameters/>
			<DConditions/>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Record>
	</Components>
	<CodeFiles>
		<CodeFile id="Events" language="PHPTemplates" name="t_vat_setllement_ubah_masa_pajak2_events.php" forShow="False" comment="//" codePage="windows-1252"/>
		<CodeFile id="Code" language="PHPTemplates" name="t_vat_setllement_ubah_masa_pajak2.php" forShow="True" url="t_vat_setllement_ubah_masa_pajak2.php" comment="//" codePage="windows-1252"/>
	</CodeFiles>
	<SecurityGroups/>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events/>
</Page>
