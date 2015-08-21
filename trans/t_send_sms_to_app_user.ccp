<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\trans" secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="RWNet" wizardThemeVersion="3.0" needGeneration="0" pasteActions="pasteActions" connection="ConnSIKP">
	<Components>
		<Record id="2" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="None" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="grafik_pembayaran_form" wizardCaption="Search T Payment Receipt " wizardOrientation="Vertical" wizardFormMethod="post" returnPage="t_laporan_harian_denda.ccp" PathID="grafik_pembayaran_form" pasteActions="pasteActions">
			<Components>
				<Button id="20" urlType="Relative" enableValidation="True" isDefault="False" name="Button2" PathID="grafik_pembayaran_formButton2">
					<Components/>
					<Events>
<Event name="OnClick" type="Client">
<Actions>
<Action actionName="Custom Code" actionCategory="General" id="70"/>
</Actions>
</Event>
<Event name="OnClick" type="Server">
<Actions>
<Action actionName="Custom Code" actionCategory="General" id="71"/>
</Actions>
</Event>
</Events>
					<Attributes/>
					<Features/>
				</Button>
				<TextBox id="5" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="app_user_name" wizardCaption="Keyword" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" PathID="grafik_pembayaran_formapp_user_name" required="True" caption="NPWD">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Hidden id="68" fieldSourceType="DBColumn" dataType="Float" name="p_app_user_id" PathID="grafik_pembayaran_formp_app_user_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<TextBox id="69" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="mobile_no" caption="Nama Perusahaan" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="grafik_pembayaran_formmobile_no">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextArea id="37" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="message" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="grafik_pembayaran_formmessage" required="True">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextArea>
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
		<CodeFile id="Events" language="PHPTemplates" name="t_send_sms_to_app_user_events.php" forShow="False" comment="//" codePage="windows-1252"/>
		<CodeFile id="Code" language="PHPTemplates" name="t_send_sms_to_app_user.php" forShow="True" url="t_send_sms_to_app_user.php" comment="//" codePage="windows-1252"/>
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
	</Events>
</Page>
