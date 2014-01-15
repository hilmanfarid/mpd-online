<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\trans" secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" validateRequest="True" cachingDuration="1 minutes" wizardTheme="sikm" wizardThemeVersion="3.0" needGeneration="0">
	<Components>
		<Record id="3" sourceType="SQL" urlType="Relative" secured="False" allowInsert="False" allowUpdate="True" allowDelete="False" validateData="True" preserveParameters="None" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="formPerubahanAyat" returnPage="t_vat_setllement_ubah_ayat.ccp" PathID="formPerubahanAyat" connection="ConnSIKP" pasteActions="pasteActions" parameterTypeListName="ParameterTypeList" activeCollection="USQLParameters" dataSource="SELECT a.*, b.p_vat_type_id, b.nomor_ayat, b.nama_ayat, b.nama_jns_pajak 
FROM  t_vat_setllement AS a
LEFT JOIN v_p_vat_type_dtl_rep AS b ON a.p_vat_type_dtl_id = b.p_vat_type_dtl_id
WHERE a.t_vat_setllement_id = {t_vat_setllement_id}" customUpdateType="SQL" customUpdate="SELECT f_update_type_ayat({t_vat_setllement_id},{p_vat_type_dtl_id}, '{alasan}', '{user_name}') AS msg">
			<Components>
				<Button id="16" urlType="Relative" enableValidation="True" isDefault="False" name="Button1" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="formPerubahanAyatButton1" operation="Update">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<TextBox id="28" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="nomor_ayat" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="formPerubahanAyatnomor_ayat" fieldSource="nomor_ayat">
<Components/>
<Events/>
<Attributes/>
<Features/>
</TextBox>
<TextBox id="29" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="nama_ayat" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="formPerubahanAyatnama_ayat" fieldSource="nama_ayat">
<Components/>
<Events/>
<Attributes/>
<Features/>
</TextBox>
<Hidden id="7" fieldSourceType="DBColumn" dataType="Text" name="t_vat_setllement_id" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="formPerubahanAyatt_vat_setllement_id" fieldSource="t_vat_setllement_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
<TextBox id="30" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="nama_jns_pajak" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="formPerubahanAyatnama_jns_pajak" fieldSource="nama_jns_pajak">
<Components/>
<Events/>
<Attributes/>
<Features/>
</TextBox>
<TextBox id="31" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="vat_code_dtl" wizardCaption="Keyword" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" PathID="formPerubahanAyatvat_code_dtl" required="True" caption="Tipe Ayat">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
<Hidden id="33" fieldSourceType="DBColumn" dataType="Text" name="p_vat_type_dtl_id" PathID="formPerubahanAyatp_vat_type_dtl_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
<TextArea id="37" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="alasan" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="formPerubahanAyatalasan" fieldSource="alasan">
<Components/>
<Events/>
<Attributes/>
<Features/>
</TextArea>
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
<SQLParameter id="35" variable="p_vat_type_dtl_id" parameterType="Control" dataType="Integer" parameterSource="p_vat_type_dtl_id" defaultValue="0"/>
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
		<CodeFile id="Events" language="PHPTemplates" name="t_vat_setllement_ubah_ayat_events.php" forShow="False" comment="//" codePage="windows-1252"/>
		<CodeFile id="Code" language="PHPTemplates" name="t_vat_setllement_ubah_ayat.php" forShow="True" url="t_vat_setllement_ubah_ayat.php" comment="//" codePage="windows-1252"/>
	</CodeFiles>
	<SecurityGroups/>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events/>
</Page>
