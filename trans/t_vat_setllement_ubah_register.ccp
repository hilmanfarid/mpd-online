<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\trans" secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" validateRequest="True" cachingDuration="1 minutes" wizardTheme="sikm" wizardThemeVersion="3.0" needGeneration="0">
	<Components>
		<Record id="3" sourceType="SQL" urlType="Relative" secured="False" allowInsert="False" allowUpdate="True" allowDelete="False" validateData="True" preserveParameters="None" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="LOV" returnPage="t_vat_setllement_ubah_register.ccp" PathID="LOV" connection="ConnSIKP" pasteActions="pasteActions" parameterTypeListName="ParameterTypeList" activeCollection="USQLParameters" customInsert="SELECT f_ubah_data_register(
{t_vat_setllement_id}, 
{total_trans_amount}, 
{total_vat_amount}, 
'{is_settled}', 
'{receipt_no}', 
{payment_amount}, 
{payment_vat_amount}
) AS msg" dataSource="select a.npwd,a.no_kohir, a.is_settled,a.total_trans_amount,a.total_vat_amount,
b.receipt_no,b.payment_amount,b.payment_vat_amount
from t_vat_setllement a
LEFT JOIN t_payment_receipt b on a.t_vat_setllement_id = b.t_vat_setllement_id
where a.t_vat_setllement_id={t_vat_setllement_id}" customUpdateType="SQL" customUpdate="SELECT f_ubah_data_register(
{t_vat_setllement_id}, 
{total_trans_amount}, 
{total_vat_amount}, 
'{is_settled}', 
'{receipt_no}', 
{payment_amount}, 
{payment_vat_amount}
) AS msg">
			<Components>
				<TextBox id="5" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="npwd" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="LOVnpwd" fieldSource="npwd" required="True">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Hidden id="7" fieldSourceType="DBColumn" dataType="Text" name="t_vat_setllement_id" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="LOVt_vat_setllement_id" fieldSource="t_vat_setllement_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Button id="16" urlType="Relative" enableValidation="True" isDefault="False" name="Button1" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="LOVButton1" operation="Update">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<TextBox id="24" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="total_trans_amount" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="LOVtotal_trans_amount" fieldSource="total_trans_amount" required="True">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="25" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="total_vat_amount" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="LOVtotal_vat_amount" fieldSource="total_vat_amount" required="True">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<ListBox id="26" visible="Yes" fieldSourceType="DBColumn" sourceType="ListOfValues" dataType="Text" returnValueType="Number" name="is_settled" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" wizardEmptyCaption="Select Value" PathID="LOVis_settled" fieldSource="is_settled" connection="ConnSIKP" activeCollection="SQLParameters" parameterTypeListName="ParameterTypeList" _valueOfList="Y" _nameOfList="Sudah Register" dataSource="Y;Sudah Register;N;Belum Register">
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
				<TextBox id="27" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="payment_amount" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="LOVpayment_amount" fieldSource="payment_amount" required="True">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="28" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="payment_vat_amount" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="LOVpayment_vat_amount" fieldSource="payment_vat_amount" required="True">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="29" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="receipt_no" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="LOVreceipt_no" fieldSource="receipt_no" required="True">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="30" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="no_kohir" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="LOVno_kohir" fieldSource="no_kohir" required="True">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
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
			</Events>
			<TableParameters/>
			<SPParameters/>
			<SQLParameters>
				<SQLParameter id="23" variable="t_vat_setllement_id" parameterType="URL" defaultValue="0" dataType="Float" parameterSource="t_vat_setllement_id"/>
			</SQLParameters>
			<JoinTables/>
			<JoinLinks/>
			<Fields/>
			<ISPParameters/>
			<ISQLParameters>
				<SQLParameter id="18" variable="t_vat_setllement_id" parameterType="Control" defaultValue="0" dataType="Integer" parameterSource="t_vat_setllement_id"/>
				<SQLParameter id="31" variable="total_trans_amount" parameterType="Control" defaultValue="0" dataType="Float" parameterSource="total_trans_amount"/>
				<SQLParameter id="32" variable="total_vat_amount" parameterType="Control" defaultValue="0" dataType="Float" parameterSource="total_vat_amount"/>
				<SQLParameter id="33" variable="is_settled" parameterType="Control" dataType="Text" parameterSource="is_settled"/>
				<SQLParameter id="34" variable="receipt_no" parameterType="Control" dataType="Text" parameterSource="receipt_no"/>
				<SQLParameter id="35" variable="payment_amount" parameterType="Control" defaultValue="0" dataType="Float" parameterSource="payment_amount"/>
				<SQLParameter id="36" variable="payment_vat_amount" parameterType="Control" defaultValue="0" dataType="Float" parameterSource="payment_vat_amount"/>
			</ISQLParameters>
			<IFormElements>
				<CustomParameter id="17" field="t_vat_setllement_id" dataType="Text" parameterType="Control" parameterSource="t_vat_setllement_id"/>
				<CustomParameter id="37" field="npwd" dataType="Text" parameterType="Control" parameterSource="npwd"/>
<CustomParameter id="38" field="total_trans_amount" dataType="Text" parameterType="Control" parameterSource="total_trans_amount"/>
<CustomParameter id="39" field="total_vat_amount" dataType="Text" parameterType="Control" parameterSource="total_vat_amount"/>
<CustomParameter id="40" field="is_settled" dataType="Text" parameterType="Control" parameterSource="is_settled"/>
<CustomParameter id="41" field="payment_amount" dataType="Text" parameterType="Control" parameterSource="payment_amount"/>
<CustomParameter id="42" field="payment_vat_amount" dataType="Text" parameterType="Control" parameterSource="payment_vat_amount"/>
<CustomParameter id="43" field="receipt_no" dataType="Text" parameterType="Control" parameterSource="receipt_no"/>
<CustomParameter id="44" field="no_kohir" dataType="Text" parameterType="Control" parameterSource="no_kohir"/>
</IFormElements>
			<USPParameters/>
			<USQLParameters>
				<SQLParameter id="12" variable="t_vat_setllement_id" parameterType="Control" dataType="Text" parameterSource="t_vat_setllement_id" defaultValue="0"/>
				<SQLParameter id="53" variable="total_trans_amount" parameterType="Control" defaultValue="0" dataType="Float" parameterSource="total_trans_amount"/>
<SQLParameter id="54" variable="total_vat_amount" parameterType="Control" defaultValue="0" dataType="Float" parameterSource="total_vat_amount"/>
<SQLParameter id="55" variable="is_settled" parameterType="Control" dataType="Text" parameterSource="is_settled"/>
<SQLParameter id="56" variable="receipt_no" parameterType="Control" dataType="Text" parameterSource="receipt_no"/>
<SQLParameter id="57" variable="payment_amount" parameterType="Control" dataType="Float" parameterSource="payment_amount" defaultValue="0"/>
<SQLParameter id="58" variable="payment_vat_amount" parameterType="Control" defaultValue="0" dataType="Float" parameterSource="payment_vat_amount"/>
</USQLParameters>
			<UConditions/>
			<UFormElements>
				<CustomParameter id="11" field="t_vat_setllement_id" dataType="Text" parameterType="Control" parameterSource="t_vat_setllement_id"/>
				<CustomParameter id="45" field="npwd" dataType="Text" parameterType="Control" parameterSource="npwd"/>
<CustomParameter id="46" field="total_trans_amount" dataType="Text" parameterType="Control" parameterSource="total_trans_amount"/>
<CustomParameter id="47" field="total_vat_amount" dataType="Text" parameterType="Control" parameterSource="total_vat_amount"/>
<CustomParameter id="48" field="is_settled" dataType="Text" parameterType="Control" parameterSource="is_settled"/>
<CustomParameter id="49" field="payment_amount" dataType="Text" parameterType="Control" parameterSource="payment_amount"/>
<CustomParameter id="50" field="payment_vat_amount" dataType="Text" parameterType="Control" parameterSource="payment_vat_amount"/>
<CustomParameter id="51" field="receipt_no" dataType="Text" parameterType="Control" parameterSource="receipt_no"/>
<CustomParameter id="52" field="no_kohir" dataType="Text" parameterType="Control" parameterSource="no_kohir"/>
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
		<CodeFile id="Events" language="PHPTemplates" name="t_vat_setllement_ubah_register_events.php" forShow="False" comment="//" codePage="windows-1252"/>
		<CodeFile id="Code" language="PHPTemplates" name="t_vat_setllement_ubah_register.php" forShow="True" url="t_vat_setllement_ubah_register.php" comment="//" codePage="windows-1252"/>
	</CodeFiles>
	<SecurityGroups/>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events/>
</Page>
