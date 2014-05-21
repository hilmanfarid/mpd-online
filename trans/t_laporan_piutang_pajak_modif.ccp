<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\trans" secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" validateRequest="True" cachingDuration="1 minutes" wizardTheme="sikm" wizardThemeVersion="3.0" needGeneration="0">
	<Components>
		<Record id="3" sourceType="SQL" urlType="Relative" secured="False" allowInsert="False" allowUpdate="True" allowDelete="False" validateData="True" preserveParameters="None" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="formPerubahanMasaPajak" connection="ConnSIKP" dataSource="select a.*,to_char(a.tgl_tap,'dd-mm-yyyy') as tgl_tap_formated, to_char(a.tgl_bayar,'dd-mm-yyyy') as tgl_bayar_formated , b.wp_name, c.code as periode_bayar
from t_piutang_pajak_penetapan_final as a
LEFT JOIN t_cust_account as b ON a.t_cust_account_id = b.t_cust_account_id
LEFT JOIN p_finance_period as c ON a.p_finance_period_id = c.p_finance_period_id
where a.t_piutang_pajak_penetapan_final_id = {t_piutang_pajak_penetapan_final_id}
" returnPage="t_laporan_piutang_pajak_modif.ccp" customUpdateType="SQL" customUpdate="UPDATE t_piutang_pajak_penetapan_final
SET realisasi_piutang = {realisasi_piutang},
sisa_piutang = {sisa_piutang},
tgl_bayar = '{tgl_bayar}',
keterangan = '{keterangan}'
WHERE t_piutang_pajak_penetapan_final_id = {t_piutang_pajak_penetapan_final_id}" PathID="formPerubahanMasaPajak" parameterTypeListName="ParameterTypeList" activeCollection="SQLParameters" pasteActions="pasteActions">
<Components>
<Button id="16" urlType="Relative" enableValidation="True" isDefault="False" name="Button1" operation="Update" PathID="formPerubahanMasaPajakButton1">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Button>
<Hidden id="7" fieldSourceType="DBColumn" dataType="Text" name="t_piutang_pajak_penetapan_final_id" fieldSource="t_piutang_pajak_penetapan_final_id" PathID="formPerubahanMasaPajakt_piutang_pajak_penetapan_final_id">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Hidden>
<TextArea id="37" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="keterangan" fieldSource="keterangan" required="True" PathID="formPerubahanMasaPajakketerangan">
<Components/>
<Events/>
<Attributes/>
<Features/>
</TextArea>
<TextBox id="41" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="tgl_bayar" fieldSource="tgl_bayar_formated" format="yyyy-mm-dd" required="True" PathID="formPerubahanMasaPajaktgl_bayar">
<Components/>
<Events/>
<Attributes/>
<Features/>
</TextBox>
<DatePicker id="42" name="DatePicker_settlement_date_new1" style="../Styles/sikp/Style.css" control="tgl_bayar" PathID="formPerubahanMasaPajakDatePicker_settlement_date_new1">
<Components/>
<Events/>
<Attributes/>
<Features/>
</DatePicker>
<TextBox id="52" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="nilai_piutang" fieldSource="nilai_piutang" PathID="formPerubahanMasaPajaknilai_piutang">
<Components/>
<Events/>
<Attributes/>
<Features/>
</TextBox>
<TextBox id="54" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="sisa_piutang" fieldSource="sisa_piutang" PathID="formPerubahanMasaPajaksisa_piutang">
<Components/>
<Events/>
<Attributes/>
<Features/>
</TextBox>
<TextBox id="59" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="temp_realisasi_piutang" fieldSource="realisasi_piutang" PathID="formPerubahanMasaPajaktemp_realisasi_piutang">
<Components/>
<Events/>
<Attributes/>
<Features/>
</TextBox>
<Label id="61" fieldSourceType="DBColumn" dataType="Text" html="False" name="masa_pajak" fieldSource="periode_bayar" PathID="formPerubahanMasaPajakmasa_pajak">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="62" fieldSourceType="DBColumn" dataType="Text" html="False" name="npwd" fieldSource="npwd" PathID="formPerubahanMasaPajaknpwd">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<TextBox id="63" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="realisasi_piutang" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="formPerubahanMasaPajakrealisasi_piutang" fieldSource="realisasi_piutang">
<Components/>
<Events/>
<Attributes/>
<Features/>
</TextBox>
<Label id="64" fieldSourceType="DBColumn" dataType="Text" html="False" name="wp_name" fieldSource="wp_name" PathID="formPerubahanMasaPajakwp_name">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
</Components>
<Events>
<Event name="AfterInsert" type="Server">
<Actions>
<Action actionName="Custom Code" actionCategory="General" id="59"/>
</Actions>
</Event>
<Event name="AfterUpdate" type="Server">
<Actions>
<Action actionName="Custom Code" actionCategory="General" id="60"/>
</Actions>
</Event>
<Event name="BeforeShow" type="Server">
<Actions>
<Action actionName="Custom Code" actionCategory="General" id="61"/>
</Actions>
</Event>
</Events>
<TableParameters>
<TableParameter id="26" conditionType="Parameter" useIsNull="False" field="t_vat_setllement_id" dataType="Float" searchConditionType="Equal" parameterType="URL" parameterSource="t_vat_setllement_id" logicOperator="And" defaultValue="0"/>
</TableParameters>
<SPParameters/>
<SQLParameters>
<SQLParameter id="24" variable="t_piutang_pajak_penetapan_final_id" dataType="Text" parameterType="URL" parameterSource="t_piutang_pajak_penetapan_final_id" designDefaultValue="0"/>
</SQLParameters>
<JoinTables/>
<JoinLinks/>
<Fields/>
<ISPParameters/>
<ISQLParameters>
<SQLParameter id="18" variable="t_vat_setllement_id" dataType="Integer" parameterType="Control" parameterSource="t_vat_setllement_id" defaultValue="0"/>
<SQLParameter id="19" variable="total_trans_amount" dataType="Float" parameterType="Control" parameterSource="total_trans_amount" defaultValue="0"/>
<SQLParameter id="20" variable="alasan" dataType="Text" parameterType="Control" parameterSource="alasan"/>
<SQLParameter id="21" variable="user_name" dataType="Text" parameterType="Session" parameterSource="UserLogin"/>
</ISQLParameters>
<IFormElements>
<CustomParameter id="17" field="t_vat_setllement_id" dataType="Text" parameterType="Control" parameterSource="t_vat_setllement_id"/>
</IFormElements>
<USPParameters/>
<USQLParameters>
<SQLParameter id="51" variable="t_piutang_pajak_penetapan_final_id" dataType="Integer" parameterType="Control" parameterSource="t_piutang_pajak_penetapan_final_id" defaultValue="0"/>
<SQLParameter id="55" variable="realisasi_piutang" dataType="Float" parameterType="Control" parameterSource="realisasi_piutang" defaultValue="0"/>
<SQLParameter id="56" variable="sisa_piutang" dataType="Float" parameterType="Control" parameterSource="sisa_piutang" defaultValue="0"/>
<SQLParameter id="57" variable="tgl_bayar" dataType="Text" parameterType="Control" parameterSource="tgl_bayar" defaultValue="NULL"/>
<SQLParameter id="58" variable="keterangan" dataType="Text" parameterType="Control" parameterSource="keterangan"/>
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
		<CodeFile id="Events" language="PHPTemplates" name="t_laporan_piutang_pajak_modif_events.php" forShow="False" comment="//" codePage="windows-1252"/>
		<CodeFile id="Code" language="PHPTemplates" name="t_laporan_piutang_pajak_modif.php" forShow="True" url="t_laporan_piutang_pajak_modif.php" comment="//" codePage="windows-1252"/>
	</CodeFiles>
	<SecurityGroups/>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events/>
</Page>
