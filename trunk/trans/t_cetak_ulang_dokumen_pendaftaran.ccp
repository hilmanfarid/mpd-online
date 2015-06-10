<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\trans" secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="RWNet" wizardThemeVersion="3.0" needGeneration="0" pasteActions="pasteActions" connection="ConnSIKP">
	<Components>
		<Record id="3" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="None" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="t_rep_lap_spjpSearch" returnPage="t_cetak_ulang_dokumen_pendaftaran.ccp" PathID="t_rep_lap_spjpSearch" pasteActions="pasteActions" pasteAsReplace="pasteAsReplace">
			<Components>
				<TextBox id="574" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="search" PathID="t_rep_lap_spjpSearchsearch">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Button id="4" urlType="Relative" enableValidation="True" isDefault="False" name="Button_DoSearch" PathID="t_rep_lap_spjpSearchButton_DoSearch">
					<Components/>
					<Events>
					</Events>
					<Attributes/>
					<Features/>
				</Button>
<TextBox id="575" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="tgl" PathID="t_rep_lap_spjpSearchtgl">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
<DatePicker id="17" name="DatePicker_end_start_laporan1" PathID="t_rep_lap_spjpSearchDatePicker_end_start_laporan1" control="tgl" wizardDatePickerType="Image" wizardPicture="../Styles/None/Images/DatePicker.gif" style="../Styles/sikp/Style.css">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</DatePicker>
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
		<Label id="21" fieldSourceType="DBColumn" dataType="Text" html="True" name="Label1" PathID="Label1">
			<Components/>
			<Events/>
			<Attributes/>
			<Features/>
		</Label>
	</Components>
	<CodeFiles>
		<CodeFile id="Events" language="PHPTemplates" name="t_cetak_ulang_dokumen_pendaftaran_events.php" forShow="False" comment="//" codePage="windows-1252"/>
		<CodeFile id="Code" language="PHPTemplates" name="t_cetak_ulang_dokumen_pendaftaran.php" forShow="True" url="t_cetak_ulang_dokumen_pendaftaran.php" comment="//" codePage="windows-1252"/>
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
				<Action actionName="Custom Code" actionCategory="General" id="572"/>
			</Actions>
		</Event>
	</Events>
</Page>
