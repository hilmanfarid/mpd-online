<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\trans" secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="RWNet" wizardThemeVersion="3.0" needGeneration="0" pasteActions="pasteActions" connection="ConnSIKP">
	<Components>
		<Record id="3" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="None" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="t_rep_lap_harian_bdhrSearch" returnPage="t_rep_lap_harian_teller.ccp" PathID="t_rep_lap_harian_bdhrSearch" pasteActions="pasteActions">
			<Components>
				<TextBox id="559" visible="Yes" fieldSourceType="DBColumn" dataType="Date" name="tgl_penerimaan" PathID="t_rep_lap_harian_bdhrSearchtgl_penerimaan" format="dd-mm-yyyy">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<DatePicker id="191" name="DatePicker_tgl_penerimaan" control="tgl_penerimaan" wizardSatellite="True" wizardControl="valid_from" wizardDatePickerType="Image" wizardPicture="../Styles/CoffeeBreak/Images/DatePicker.gif" style="../Styles/sikp/Style.css" PathID="t_rep_lap_harian_bdhrSearchDatePicker_tgl_penerimaan">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</DatePicker>
				<Hidden id="560" fieldSourceType="DBColumn" dataType="Text" name="kabid" PathID="t_rep_lap_harian_bdhrSearchkabid">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Button id="563" urlType="Relative" enableValidation="True" isDefault="False" name="Button_DoSearch1" PathID="t_rep_lap_harian_bdhrSearchButton_DoSearch1">
					<Components/>
					<Events>
					</Events>
					<Attributes/>
					<Features/>
				</Button>
				<ListBox id="564" visible="Yes" fieldSourceType="DBColumn" sourceType="ListOfValues" dataType="Text" returnValueType="Number" name="nama_teller" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" wizardEmptyCaption="Select Value" PathID="t_rep_lap_harian_bdhrSearchnama_teller" connection="ConnSIKP" dataSource="ESSYBKP;ESSYBKP;HERIBKP;HERIBKP;PAINCEBKP;PAINCEBKP" _valueOfList="ABDURACHIM" _nameOfList="ABDURACHIM">
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
				<Button id="565" urlType="Relative" enableValidation="True" isDefault="False" name="Button_DoSearch2" PathID="t_rep_lap_harian_bdhrSearchButton_DoSearch2">
					<Components/>
					<Events>
					</Events>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="566" urlType="Relative" enableValidation="True" isDefault="False" name="Button_DoSearch3" PathID="t_rep_lap_harian_bdhrSearchButton_DoSearch3">
					<Components/>
					<Events>
					</Events>
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
		<Label id="561" fieldSourceType="DBColumn" dataType="Text" html="True" name="Label1" PathID="Label1">
			<Components/>
			<Events/>
			<Attributes/>
			<Features/>
		</Label>
	</Components>
	<CodeFiles>
		<CodeFile id="Events" language="PHPTemplates" name="t_rep_lap_harian_teller_events.php" forShow="False" comment="//" codePage="windows-1252"/>
		<CodeFile id="Code" language="PHPTemplates" name="t_rep_lap_harian_teller.php" forShow="True" url="t_rep_lap_harian_teller.php" comment="//" codePage="windows-1252"/>
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
				<Action actionName="Custom Code" actionCategory="General" id="562"/>
			</Actions>
		</Event>
	</Events>
</Page>
