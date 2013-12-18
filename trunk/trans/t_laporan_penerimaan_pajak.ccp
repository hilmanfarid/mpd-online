<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\trans" secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="None" wizardThemeVersion="3.0" pasteActions="pasteActions" needGeneration="0">
	<Components>
		<Record id="2" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="None" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="t_laporan_penerimaan_pajak" wizardCaption="Search T Payment Receipt " wizardOrientation="Vertical" wizardFormMethod="post" returnPage="t_laporan_penerimaan_pajak.ccp" PathID="t_laporan_penerimaan_pajak" pasteActions="pasteActions">
			<Components>
				<TextBox id="4" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="rqst_type_code" wizardCaption="T Vat Setllement Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" PathID="t_laporan_penerimaan_pajakrqst_type_code">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Button id="7" urlType="Relative" enableValidation="True" isDefault="False" name="Button1" PathID="t_laporan_penerimaan_pajakButton1">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Hidden id="9" fieldSourceType="DBColumn" dataType="Text" name="cetak_laporan" PathID="t_laporan_penerimaan_pajakcetak_laporan">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<TextBox id="11" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="year_code" wizardCaption="Keyword" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" PathID="t_laporan_penerimaan_pajakyear_code" required="True" caption="Periode Tahun">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
<Hidden id="13" fieldSourceType="DBColumn" dataType="Float" name="p_year_period_id" PathID="t_laporan_penerimaan_pajakp_year_period_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
<TextBox id="14" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="date_start_laporan" PathID="t_laporan_penerimaan_pajakdate_start_laporan" format="yyyy-mm-dd" required="True">
<Components/>
<Events/>
<Attributes/>
<Features/>
</TextBox>
<DatePicker id="15" name="DatePicker_date_start_laporan1" PathID="t_laporan_penerimaan_pajakDatePicker_date_start_laporan1" control="date_start_laporan" wizardDatePickerType="Image" wizardPicture="../Styles/None/Images/DatePicker.gif" style="../Styles/sikp/Style.css">
<Components/>
<Events/>
<Attributes/>
<Features/>
</DatePicker>
<TextBox id="16" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="date_end_laporan" PathID="t_laporan_penerimaan_pajakdate_end_laporan" format="yyyy-mm-dd" required="True">
<Components/>
<Events/>
<Attributes/>
<Features/>
</TextBox>
<DatePicker id="17" name="DatePicker_end_start_laporan1" PathID="t_laporan_penerimaan_pajakDatePicker_end_start_laporan1" control="date_end_laporan" wizardDatePickerType="Image" wizardPicture="../Styles/None/Images/DatePicker.gif" style="../Styles/sikp/Style.css">
<Components/>
<Events/>
<Attributes/>
<Features/>
</DatePicker>
<Hidden id="18" fieldSourceType="DBColumn" dataType="Text" name="p_rqst_type_id" PathID="t_laporan_penerimaan_pajakp_rqst_type_id">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Hidden>
<ListBox id="19" visible="Yes" fieldSourceType="DBColumn" sourceType="ListOfValues" dataType="Text" returnValueType="Number" name="jenis_tahun" wizardEmptyCaption="Select Value" PathID="t_laporan_penerimaan_pajakjenis_tahun" connection="ConnSIKP" _valueOfList="bayar" _nameOfList="Tahun Bayar" dataSource="bayar;Tahun Bayar;pajak;Tahun Pajak" defaultValue="bayar">
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
		<CodeFile id="Code" language="PHPTemplates" name="t_laporan_penerimaan_pajak.php" forShow="True" url="t_laporan_penerimaan_pajak.php" comment="//" codePage="windows-1252"/>
		<CodeFile id="Events" language="PHPTemplates" name="t_laporan_penerimaan_pajak_events.php" forShow="False" comment="//" codePage="windows-1252"/>
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
