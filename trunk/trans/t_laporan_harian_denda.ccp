<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\trans" secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="None" wizardThemeVersion="3.0" pasteActions="pasteActions" needGeneration="0">
	<Components>
		<Record id="2" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="None" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="t_laporan_harian_denda" wizardCaption="Search T Payment Receipt " wizardOrientation="Vertical" wizardFormMethod="post" returnPage="t_laporan_harian_denda.ccp" PathID="t_laporan_harian_denda" pasteActions="pasteActions">
			<Components>
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
		<DatePicker id="30" name="DatePicker_date_start_laporan1" PathID="DatePicker_date_start_laporan1" control="date_start_laporan" wizardDatePickerType="Image" wizardPicture="../Styles/None/Images/DatePicker.gif" style="../Styles/sikp/Style.css">
			<Components/>
			<Events/>
			<Attributes/>
			<Features/>
		</DatePicker>
<TextBox id="31" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="date_end_laporan" PathID="date_end_laporan" format="yyyy-mm-dd" required="True">
			<Components/>
			<Events/>
			<Attributes/>
			<Features/>
		</TextBox>
<DatePicker id="32" name="DatePicker_end_start_laporan1" PathID="DatePicker_end_start_laporan1" control="date_end_laporan" wizardDatePickerType="Image" wizardPicture="../Styles/None/Images/DatePicker.gif" style="../Styles/sikp/Style.css">
			<Components/>
			<Events/>
			<Attributes/>
			<Features/>
		</DatePicker>
<TextBox id="33" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="vat_code" wizardCaption="Keyword" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" PathID="vat_code" required="True" caption="Ayat Pajak">
			<Components/>
			<Events/>
			<Attributes/>
			<Features/>
		</TextBox>
<TextBox id="34" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="date_start_laporan" PathID="date_start_laporan" format="yyyy-mm-dd" required="True">
			<Components/>
			<Events/>
			<Attributes/>
			<Features/>
		</TextBox>
<Hidden id="35" fieldSourceType="DBColumn" dataType="Text" name="p_vat_type_id" PathID="p_vat_type_id" fieldSource="p_vat_type_id">
			<Components/>
			<Events/>
			<Attributes/>
			<Features/>
		</Hidden>
</Components>
	<CodeFiles>
		<CodeFile id="Events" language="PHPTemplates" name="t_laporan_harian_denda_events.php" forShow="False" comment="//" codePage="windows-1252"/>
		<CodeFile id="Code" language="PHPTemplates" name="t_laporan_harian_denda.php" forShow="True" url="t_laporan_harian_denda.php" comment="//" codePage="windows-1252"/>
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
