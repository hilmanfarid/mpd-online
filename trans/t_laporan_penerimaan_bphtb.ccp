<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\trans" secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="None" wizardThemeVersion="3.0" pasteActions="pasteActions" needGeneration="0">
	<Components>
		<Record id="2" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="None" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="t_laporan_penerimaan_bphtb" wizardCaption="Search T Payment Receipt " wizardOrientation="Vertical" wizardFormMethod="post" returnPage="t_laporan_penerimaan_bphtb.ccp" PathID="t_laporan_penerimaan_bphtb" pasteActions="pasteActions">
			<Components>
				<Button id="7" urlType="Relative" enableValidation="True" isDefault="False" name="Button1" PathID="t_laporan_penerimaan_bphtbButton1">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<TextBox id="14" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="date_start_laporan" PathID="t_laporan_penerimaan_bphtbdate_start_laporan" format="yyyy-mm-dd" required="True">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<DatePicker id="15" name="DatePicker_date_start_laporan1" PathID="t_laporan_penerimaan_bphtbDatePicker_date_start_laporan1" control="date_start_laporan" wizardDatePickerType="Image" wizardPicture="../Styles/None/Images/DatePicker.gif" style="../Styles/sikp/Style.css">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</DatePicker>
				<TextBox id="16" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="date_end_laporan" PathID="t_laporan_penerimaan_bphtbdate_end_laporan" format="yyyy-mm-dd" required="True">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<DatePicker id="17" name="DatePicker_end_start_laporan1" PathID="t_laporan_penerimaan_bphtbDatePicker_end_start_laporan1" control="date_end_laporan" wizardDatePickerType="Image" wizardPicture="../Styles/None/Images/DatePicker.gif" style="../Styles/sikp/Style.css">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</DatePicker>
				<Hidden id="9" fieldSourceType="DBColumn" dataType="Text" name="cetak_laporan" PathID="t_laporan_penerimaan_bphtbcetak_laporan">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<TextBox id="18" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="receipt_no" PathID="t_laporan_penerimaan_bphtbreceipt_no" fieldSource="receipt_no">
<Components/>
<Events/>
<Attributes/>
<Features/>
</TextBox>
<TextBox id="19" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="njop_pbb" PathID="t_laporan_penerimaan_bphtbnjop_pbb" fieldSource="njop_pbb">
<Components/>
<Events/>
<Attributes/>
<Features/>
</TextBox>
<TextBox id="20" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="wp_name" PathID="t_laporan_penerimaan_bphtbwp_name" fieldSource="wp_name">
<Components/>
<Events/>
<Attributes/>
<Features/>
</TextBox>
<Hidden id="21" fieldSourceType="DBColumn" dataType="Text" name="p_region_id_kecamatan" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_laporan_penerimaan_bphtbp_region_id_kecamatan" fieldSource="p_region_id_kecamatan">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
<TextBox id="23" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="nama_kecamatan" fieldSource="nama_kecamatan" required="True" caption="Kecamatan" wizardCaption="Description" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_laporan_penerimaan_bphtbnama_kecamatan">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
<Hidden id="24" fieldSourceType="DBColumn" dataType="Text" name="p_region_id_kelurahan" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_laporan_penerimaan_bphtbp_region_id_kelurahan" fieldSource="p_region_id_kelurahan">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
<TextBox id="26" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="nama_kelurahan" fieldSource="nama_kelurahan" required="True" caption="Kelurahan" wizardCaption="Description" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="t_laporan_penerimaan_bphtbnama_kelurahan">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
<Button id="27" urlType="Relative" enableValidation="True" isDefault="False" name="Button2" PathID="t_laporan_penerimaan_bphtbButton2">
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
		<CodeFile id="Events" language="PHPTemplates" name="t_laporan_penerimaan_bphtb_events.php" forShow="False" comment="//" codePage="windows-1252"/>
		<CodeFile id="Code" language="PHPTemplates" name="t_laporan_penerimaan_bphtb.php" forShow="True" url="t_laporan_penerimaan_bphtb.php" comment="//" codePage="windows-1252"/>
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
