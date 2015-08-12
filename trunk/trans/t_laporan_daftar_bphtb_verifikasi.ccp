<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\trans" secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="None" wizardThemeVersion="3.0" pasteActions="pasteActions" needGeneration="0">
	<Components>
		<Record id="2" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="None" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="t_laporan_daftar_bphtb" wizardCaption="Search T Payment Receipt " wizardOrientation="Vertical" wizardFormMethod="post" returnPage="t_laporan_daftar_bphtb_verifikasi.ccp" PathID="t_laporan_daftar_bphtb" pasteActions="pasteActions">
			<Components>
				<Button id="7" urlType="Relative" enableValidation="True" isDefault="False" name="Button1" PathID="t_laporan_daftar_bphtbButton1">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<TextBox id="14" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="date_start_laporan" PathID="t_laporan_daftar_bphtbdate_start_laporan" format="yyyy-mm-dd" required="True">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<DatePicker id="15" name="DatePicker_date_start_laporan1" PathID="t_laporan_daftar_bphtbDatePicker_date_start_laporan1" control="date_start_laporan" wizardDatePickerType="Image" wizardPicture="../Styles/None/Images/DatePicker.gif" style="../Styles/sikp/Style.css">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</DatePicker>
				<TextBox id="16" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="date_end_laporan" PathID="t_laporan_daftar_bphtbdate_end_laporan" format="yyyy-mm-dd" required="True">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<DatePicker id="17" name="DatePicker_end_start_laporan1" PathID="t_laporan_daftar_bphtbDatePicker_end_start_laporan1" control="date_end_laporan" wizardDatePickerType="Image" wizardPicture="../Styles/None/Images/DatePicker.gif" style="../Styles/sikp/Style.css">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</DatePicker>
				<Hidden id="9" fieldSourceType="DBColumn" dataType="Text" name="cetak_laporan" PathID="t_laporan_daftar_bphtbcetak_laporan">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="19" fieldSourceType="DBColumn" dataType="Float" name="object_p_region_id_kec" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_laporan_daftar_bphtbobject_p_region_id_kec" fieldSource="object_p_region_id_kec" caption="Kecamatan - Object" required="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<TextBox id="18" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="kecamatan" caption="Kecamatan - WP" required="False" PathID="t_laporan_daftar_bphtbkecamatan">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
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
		<CodeFile id="Events" language="PHPTemplates" name="t_laporan_daftar_bphtb_verifikasi_events.php" forShow="False" comment="//" codePage="windows-1252"/>
		<CodeFile id="Code" language="PHPTemplates" name="t_laporan_daftar_bphtb_verifikasi.php" forShow="True" url="t_laporan_daftar_bphtb_verifikasi.php" comment="//" codePage="windows-1252"/>
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
